<?php
    session_start();

    include "getInfo/db.inc.php";


    $email = mysqli_real_escape_string($conn, $_SESSION['userMail'] ?? "");
    $uName = mysqli_real_escape_string($conn, $_SESSION['userId'] ?? "");


    $dbinfo = "SELECT username, usernumber, userscountry, userstate, passwords, userProfileImg FROM usersinfo WHERE emails='$email'";
    $dbresult = mysqli_query($conn,$dbinfo);
    $retrieve = mysqli_fetch_array($dbresult);

    $name = $retrieve['username'];
    $numbers = $retrieve['usernumber'];
    $country = $retrieve['userscountry'];
    $state = $retrieve['userstate'];
    $profileImg = $retrieve['userProfileImg'];





    function postTrade($conn) {
    
            date_default_timezone_set('Europe/Copenhagen');

            $postSql = "SELECT * FROM userpost ORDER BY postImg DESC LIMIT 12";
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
    }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exchange Website</title>
    <link rel="stylesheet" href="./css/header.css" />
    <link rel="stylesheet" href="./css/aside.css" />
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="./css/fontawesome/css/all.css" />
    <link href="https://fonts.googleapis.com/css?family=Grenze&display=swap" rel="stylesheet" />
</head>

<body>
    <header>
        <div class="top-nav">
            <ul>
                <li><a href="#">Help</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Q&A</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>
        <div class="bt-nav">
            <div class="logo">
                <a href="index.php">
                    <h3>EXCHANGER</h3>
                </a>
            </div>
            <div class="searchfield">
                <form>
                    <span><i class="fal insearch fa-search"></i></span>
                    <input type="text" placeholder="Search..." autocomplete="off" name="search" id="searchIn">
                    <button type="submit" id="searchbtn" class="searchbtn"><i class="fas fa-search"></i></button>
                </form>
                <div class="mobile-search-icon">
                    <span style="display: none"><i class="far fa-search"></i></span>
                </div>
                <div class="searchresult"></div>
            </div>
            <div class="account-right"> 
                <?php 
                    if(isset($_SESSION['userNo'])) {
                        echo '<div class="profile-nav">
                                <a href="./user/profile.php?userId='.$name.'&mail='.$email.'">
                                    <button class="loginbtn"><span><i class="fa fa-user"></i></span>Account</button>
                                </a>
                            </div>';
                        echo '<div class="create-nav">
                    <a href="./create/post.php">
                        <button class="loginbtn"><span><i class="fa fa-plus"></i></span>Create</button>
                    </a>
                </div>';
                    }
                else {
                    echo '<div class="login">
                    <a href="./login.php">
                        <button class="loginbtn"><span><i class="fa fa-user"></i></span>Login</button>
                    </a>
                </div>';
                }
                ?>


            </div>
        </div>
        <div class="mobile-nav">
            <ul>
                <li class="active"><a href="./index.php"><span><i class="fas fa-home"></i></span>Home</a></li>
                <li class="mobile-category"><a class="mobile-cat" href="#"><span><i class="far fa-bars"></i></span>Category </a></li>
                <li><a class="mobile-search" href="#"><span><i class="fas fa-search"></i></span>Search</a></li>
                <?php 
                    if(isset($_SESSION['userNo'])) {
                        echo '<li><a href="./user/profile.php?userId='.$name.'&mail='.$email.'"><span><i class="fas fa-user"></i></span>Account</a></li>';
                    }
                else {
                    echo '<li><a href="./login.php"><span><i class="fas fa-user"></i></span>Login</a></li>';
                }
                ?>


            </ul>
        </div>
        <div class="form-bg">
            <form>
                <div class="cancelsearch"><span><i class="fa fa-arrow-left"></i></span></div>
                <div class="inputs">
                    <input type="text" placeholder="Search..." autocomplete="off" name="search" id="searchInput">
                    <button type="submit" id="searchBtn" class="searchbtn"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <div class="searchresult"></div>
        </div>
    </header>
    <aside>
        <?php   
            require "aside.php";
        ?>
    </aside>

    <section class="main">
        <div class="post-wrapper">
            <div class="post-cover">

                <?php
            postTrade($conn)
        ?>
            </div>
            <div class="post-next">
                <button href="#" class="next-btn">See More</button>
            </div>
        </div>
    </section>
    <div class="create-float-btn">
        <?php 
            if(isset($_SESSION['userNo'])) {
                echo '<a href="./create/post.php"><span><i class="far fa-plus"></i></span></a>';
            }
        else {
            echo '<a href="./login.php"><span><i class="far fa-plus"></i></span></a>';
        }
        ?>

    </div>
    <footer>
        <?php 
        require "footer.php";    
    ?>
    </footer>
    <script src="./js/jquery/jquery.js"></script>
    <script src="./js/main.js"></script>
    <script src="./js/jquery.js"></script>
    <script>
        $(document).ready(function() {
            let commentCount = 12;
            $('.next-btn').click(function() {
                commentCount = commentCount + 8;
                $('.post-cover').load('getInfo/post.inc.php', {
                    cNewCount: commentCount
                });
            })
        })

    </script>
</body>

</html>
