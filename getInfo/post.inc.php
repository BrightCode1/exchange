<?php
session_start();
require "db.inc.php";
if(isset($_POST['submitP'])) {
    
    require "db.inc.php";
    $email = mysqli_real_escape_string($conn, $_SESSION['userMail'] ?? "");
    $uName = mysqli_real_escape_string($conn, $_SESSION['userId'] ?? "");
    
    $title = $_POST['title'];
    $category = $_POST['category'];
    $tradeFor = $_POST['tradeFor'];
    $desc = $_POST['create-desc'];
    $pDate = $_POST['pDate'];
    
    $postImg = $_FILES["file_P"];
    $postFileName = $postImg['name'];
    $postFileTmpName = $postImg['tmp_name'];
    $postFileSize = $postImg['size'];
    $postFileError = $postImg['error'];
    $postFileType = $postImg['type'];
    
    $profileFileExt = explode('.', $postFileName);
    $profileFileActualExt = strtolower(end($profileFileExt));
    $profileFileAllowed = array('jpg', 'jpeg', 'png', 'pdf', 'webg');
    
    if(empty($title) || empty($desc) || $category == 'Category' || $tradeFor == 'Exchange For:') {
       
        header("location: ../create/post.php?error=emptyFields&title=".$title."&category=".$category."&exchange=".$tradeFor."&desc=".$desc."img=".$postImg);        
        exit();
    }
    else if(!preg_match("/^[a-zA-Z0-9\s]*$/", $title)) {
         header("location: ../create/post.php?error=invalidTitle&category=".$category."&exchange=".$tradeFor."&desc=".$desc."img=".$postImg);
        exit();
    }
            else {
                if(in_array($profileFileActualExt, $profileFileAllowed)) {
        if($postFileError === 0) {
            if($postFileSize < 10000000) {
                $profileFileNewName = uniqid(''. true).".".$profileFileActualExt;
                $profileFileDestination = '../create/images/'.$profileFileNewName;
                move_uploaded_file($postFileTmpName, $profileFileDestination);
                $sql = "INSERT INTO userpost (postermail, postername, postTitle, postCategory, postTradeFor, postImg, postDesc, postDate) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)) {
                    header("location: ../create/post.php?error=sqlerror");      
                    exit();
                }
                else {
                    
                    
                    mysqli_stmt_bind_param($stmt, "ssssssss", $email, $uName, $title, $category, $tradeFor, $profileFileNewName, $desc, $pDate);
                    mysqli_stmt_execute($stmt);
                    
                    
                    
                     header("location: ../user/profile.php?userId=".$uName."&mail=".$email."");      
                    exit();
                    
                    
                    
                }
            }
            else {
                echo "Your File Is Too Big To Be Uploaded!";
            }
        }
        else {
            echo "There Was An Error Uploading Your File!";
        }
    }
    else {
        echo "This File Type/Format Isn't Supported!";
    }
                
            }
        }










            $cNc = $_POST['cNewCount'];
            date_default_timezone_set('Europe/Copenhagen');

            $postSql = "SELECT * FROM userpost ORDER BY postImg DESC LIMIT $cNc";
            $postR = mysqli_query($conn, $postSql);

            while($postrow = mysqli_fetch_array($postR)) {
                $pmail = $postrow['postermail'];
                $pname = $postrow['postername'];
                $ptitle = $postrow['postTitle'];
                $pcat = $postrow['postCategory'];
                $ptrade = $postrow['postTradeFor'];
                $pimg = $postrow['postImg'];
                $pdesc = nl2br($postrow['postDesc']);
                $pdt = $postrow['postDate'];
                echo '<div class="post">
                            <div class="img">
                                <img src="create/images/'.$pimg.'" alt="Post Image">
                            </div>
                            <div class="post-info">
                                <h3 class="post-title">'.$ptitle.'</h3>
                                <div class="post-flex">
                                    <span class="post-date">'.$pdt.'</span>
                                </div>
                                <p class="post-category">Category: '.$pcat.'</p>
                                <p class="post-want">Exchange For: '.$ptrade.'</p>
                                <p class="post-desc">'.$pdesc.'</p>
                                <div class="btn">
                                    <a href="./user/profile.php?userId='.$pname.'&mail='.$pmail.'" class="post-btn" >Exchange</a>
                                </div>
                            </div>
                        </div>';
            }








