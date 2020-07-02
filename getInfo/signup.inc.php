<?php 


if(isset($_POST["sg-submit"])) {
    
    require "db.inc.php";
    
    $username = $_POST["sg-name"];
    $usernumber = $_POST["sg-number"];
    $usercountry = $_POST["country"];
    $userstate = $_POST["sg-state"];
    $usermail = $_POST["sg-email"];
    $userpwd = $_POST["sg-pwd"];
    $userpwd_c = $_POST["sg-pwd-c"];

    $userProfileImg = $_FILES["file_img"];
    $profileFileName = $userProfileImg['name'];
    $profileFileTmpName = $userProfileImg['tmp_name'];
    $profileFileSize = $userProfileImg['size'];
    $profileFileError = $userProfileImg['error'];
    $profileFileType = $userProfileImg['type'];
    
    $profileFileExt = explode('.', $profileFileName);
    $profileFileActualExt = strtolower(end($profileFileExt));
    $profileFileAllowed = array('jpg', 'jpeg', 'png', 'pdf', 'webg');
    
    
    
    
    
    if(empty($username) || empty($usernumber) || empty($usercountry) || empty($userstate) || empty($usermail) || empty($userpwd) || empty($userpwd_c) || empty($profileFileName)) {
       
        header("location: ../login.php?error=emptyFields&username=".$username."&number=".$usernumber."&country=".$usercountry."&state=".$userstate."&mail=".$usermail);        
        exit();
    }
    
    else if(!preg_match("/^[a-zA-Z\s\.\,]*$/", $userstate)) {
        header("location: ../login.php?error=invalidState&username&usernumber&userstate");
        exit();
    }
    else if(!preg_match("/^[0-9+]*$/", $usernumber)) {
        header("location: ../login.php?error=invalidNumber&username&usernumber&userstate");
        exit();
    }
    else if($usercountry == "Add Your Country") {
        header("location: ../login.php?error=invalidCountry&username&usernumber&userstate");
        exit();
    }
    
    else if(!filter_var($usermail, FILTER_VALIDATE_EMAIL)) {
         header("location: ../login.php?error=invalidEmail&username=".$username."&number=".$usernumber."&country=".$usercountry."&state=".$userstate);
        exit();
    }
    else if(!preg_match("/^[a-zA-Z0-9\s]*$/", $username)) {
         header("location: ../login.php?error=invalidUsername&number=".$usernumber."&country=".$usercountry."&state=".$userstate."&mail".$usermail);
        exit();
    }
    else if($userpwd !== $userpwd_c) {
        header("location: ../login.php?error=passwordcheck&username=".$username."&number=".$usernumber."&country=".$usercountry."&state=".$userstate."&mail=".$usermail);        
        exit();
    }
    else {
        $sql = "SELECT emails FROM usersinfo WHERE emails=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../login.php?error=sqlerror");      
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $usermail);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if($resultCheck > 0) {
                header("location: ../login.php?error=mailTaken&username=".$username."&number=".$usernumber."&country=".$usercountry."&state=".$userstate."&mail=".$usermail);      
            exit();
            }
            else {
                if(in_array($profileFileActualExt, $profileFileAllowed)) {
        if($profileFileError === 0) {
            if($profileFileSize < 50000000) {
                $profileFileNewName = uniqid(''. true).".".$profileFileActualExt;
                $profileFileDestination = '../user/images/'.$profileFileNewName;
                move_uploaded_file($profileFileTmpName, $profileFileDestination);
                $sql = "INSERT INTO usersinfo (username, usernumber, userscountry, userstate, emails, passwords, userProfileImg) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)) {
                    header("location: ../login.php?error=sqlerror");      
                    exit();
                }
                else {
                    $hashpwd = password_hash($userpwd, PASSWORD_DEFAULT);
                    
                    mysqli_stmt_bind_param($stmt, "sssssss", $username, $usernumber, $usercountry, $userstate, $usermail, $hashpwd, $profileFileNewName);
                    mysqli_stmt_execute($stmt);
                    
                    
                    
                     header("location: ../login.php?signup=success");      
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
        
        }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    }
    
    


?>
