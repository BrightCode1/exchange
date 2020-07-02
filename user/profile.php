<?php 
    session_start();
    include "../getInfo/db.inc.php";
include "../getInfo/comment.inc.php";

    if(!isset($_SESSION['userMail'])) {
        header("Location: ../login.php");
    }


    $email = mysqli_real_escape_string($conn, $_SESSION['userMail'] ?? "");
    $useN = mysqli_real_escape_string($conn, $_SESSION['userId'] ?? "");

    $urlMail = $_GET['mail'];
    $urlId = $_GET['userId'];

    $dbinfo = "SELECT username, usernumber, userscountry, userstate, userProfileImg FROM usersinfo WHERE emails='$email'";

    $dbresult = mysqli_query($conn,$dbinfo);
    $retrieve = mysqli_fetch_array($dbresult);

    $name = $retrieve['username'];
    $numbers = $retrieve['usernumber'];
    $country = $retrieve['userscountry'];
    $state = $retrieve['userstate'];
    $profileImg = $retrieve['userProfileImg'];




    if(isset(($_GET['mail']))) {
        if($_GET['mail'] !== $email) {

            $mm = $_GET['mail'];
            $nn = $_GET['userId'];
            
            
            $dbinfos = "SELECT username, usernumber, userscountry, userstate, userProfileImg FROM usersinfo WHERE emails='$mm'";

            $dbresults = mysqli_query($conn, $dbinfos);
            $retrieves = mysqli_fetch_array($dbresults);
       
            $names = $retrieves['username'];
            $number = $retrieves['usernumber'];
            $countrys = $retrieves['userscountry'];
            $states = $retrieves['userstate'];
            $profileImgs = $retrieves['userProfileImg'];
            
        }
    };




    require "../getInfo/url.inc.php";

    $hello = "http://localhost:8080/exchange/user/profile.php";
        if(c_url() == $hello) {
            header("location: ../login.php");
    };





function getPost($conn) {
    
    $email = mysqli_real_escape_string($conn, $_SESSION['userMail'] ?? "");
    $urlMail = $_GET['mail'];
    date_default_timezone_set('Europe/Copenhagen');
    
    $postSql = "SELECT * FROM userpost WHERE postermail='$urlMail' ORDER BY postImg DESC";
    $postR = mysqli_query($conn, $postSql);
    
    while($postrow = mysqli_fetch_array($postR)) {
        $pmail = $postrow['postermail'];
        $ptitle = $postrow['postTitle'];
        $pcat = $postrow['postCategory'];
        $ptrade = $postrow['postTradeFor'];
        $pimg = $postrow['postImg'];
        $pdesc = nl2br($postrow['postDesc']);
        $pdt = $postrow['postDate'];
        echo '<div class="post">
                <div class="img">
                    <img src="../create/images/'.$pimg.'" alt="Post Image">
                </div>
                <div class="post-info">
                    <h3 class="post-title">'.$ptitle.'</h3>
                    <div class="post-flex">
                        <span class="post-date">'.$pdt.'</span>
                    </div>
                    <p class="post-category">Category: '.$pcat.'</p>
                    <p class="post-want">Exchange For: '.$ptrade.'</p>
                    <p class="post-desc">'.$pdesc.'</p>';
                    if($_GET['mail'] == $email) {
                            echo '<div class="dIcon">
                                    <span class="deletePost"><i class="fa fa-trash"></i>
                                    <span class="editPost"><i class="fa fa-edit"></i>
                                </div>';
                        }
                    echo '</div>
                </div>';
                                    
    }
}


    function setComment($conn) {
        if(isset($_POST['comment-submit'])) {
            $urlMail = $_GET['mail'];
            $useN = mysqli_real_escape_string($conn, $_SESSION['userId'] ?? "");


            $commentInput = $_POST['post-comment'];
            $commentD = $_POST['commentD'];
            $commentorE = $_POST['commentorN'];

            $sql = "INSERT INTO comment_review (commentorN, commentorE, commentD, message) VALUES ('$useN', '$urlMail', '$commentD', '$commentInput')";
            $result = $conn->query($sql);

        }  
    }

function getComment($conn) {
    $urlMail = $_GET['mail'];
    $sql = "SELECT * FROM comment_review WHERE commentorE='$urlMail' ORDER BY commentD DESC";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
        echo "<div class='comment-box'><p style='font-weight: bold; line-height: 20px;'>";
            echo $row['commentorN']."</p><p style='font-size: 12px; line-height: 20px; font-weight: bold;'>";
            echo $row['commentD']."</p><p>";
            echo nl2br($row['message'])."</p>";
        echo "</div>";
    }
}
function haha() {
    echo 'hello';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php if($_GET['mail'] !== $email) {echo $names;}else { echo $name;}; ?> | Exchanger</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/fontawesome/css/all.css">
    <link rel="stylesheet" href="../css/header.css" />
    <link rel="stylesheet" href="../css/profile.css">

    <link rel="stylesheet" href="../css/style.css">
    <style>
        .post-cover {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(33.3%, 1fr));

        }

        .post-info {
            text-align: left;
        }

        .post {
            grid-template-columns: 1fr;
        }

        .post .img {
            width: 100%;
        }

        @media(max-width: 999px) {
            .post-cover {
                grid-template-columns: repeat(auto-fit, minmax(30%, 1fr));
                margin: 0px;
            }
        }

        @media(max-width: 768px) {
            .post-cover {
                grid-template-columns: repeat(auto-fit, minmax(30%, 1fr));
                margin: 0px;
            }


        }



        @media(max-width: 550px) {
            .post-cover {
                grid-template-columns: repeat(auto-fit, minmax(50%, 1fr));
                margin: 0px;
            }


        }

        @media(max-width: 350px) {
            .post-cover {
                grid-template-columns: repeat(auto-fit, minmax(100%, 1fr));
            }

        }

    </style>
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
                <a href="../index.php">
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
                        if($_GET['mail'] !== $email) {
                            echo '<div class="create-nav">
                    <a href="../create/post.php">
                        <button class="loginbtn"><span><i class="fa fa-plus"></i></span>Create</button>
                    </a>
                </div>';
                            echo '<div class="create-nav">
                    <a href="./profile.php?userId='.$name.'&mail='.$email.'">
                        <button class="loginbtn"><span><i class="fa fa-user"></i></span>Account</button>
                    </a>
                </div>';
                        echo '<div class="profile-nav">
                                <form action="../getInfo/logout.php" method="post">
                                    <button type="submit" name="logout" class="loginbtn"><span><i class="fa fa-sign-out"></i></span>Logout</button>
                                </form>
                            </div>';
                        }else {
                            echo '<div class="create-nav">
                    <a href="../create/post.php">
                        <button class="loginbtn"><span><i class="fa fa-plus"></i></span>Create</button>
                    </a>
                </div>';
                        echo '<div class="profile-nav">
                                <form action="../getInfo/logout.php" method="post">
                                    <button type="submit" name="logout" class="loginbtn"><span><i class="fa fa-sign-out"></i></span>Logout</button>
                                </form>
                            </div>';
                        };
                        
                        
                    }
                else {
                    echo '<div class="login">
                    <a href="../login.php">
                        <button class="loginbtn"><span><i class="fa fa-user"></i></span>Login</button>
                    </a>
                </div>';
                }
                ?>


            </div>
        </div>
        <div class="mobile-nav">
            <ul>
                <li class="active"><a href="../index.php"><span><i class="fas fa-home"></i></span>Home</a></li>
                <li><a class="mobile-search" href="#"><span><i class="fas fa-search"></i></span>Search</a></li>
                <li class="mobile-category"><a class="mobile-cat" href="../create/post.php"><span><i class="fa fa-plus"></i></span>Create Post</a></li>
                <?php 
                    if(isset($_SESSION['userNo'])) {
                        echo '<li>
                                <form action="../getInfo/logout.php" method="post">
                                
                                    <button type="submit" name="logout">
                                        <span><i class="fa fa-sign-out"></i></span>Logout
                                    </button>
                                
                                </form>
                            </li>';
                    }
                else {
                    echo '<li><a href="../login.php"><span><i class="fas fa-user"></i></span>Login</a></li>';
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
    <div class="container">
        <div class="profile-header">
            <div class="profile-img"><img src="./images/<?php if($_GET['mail'] !== $email) {echo $profileImgs;}else { echo $profileImg;};?>" width="200" alt="Profile Image"></div>



            <div class="profile-nav-info">
                <h3 class="user-name"><?php if($_GET['mail'] !== $email) {echo $names;}else { echo $name;}; ?></h3>
                <div class="address">
                    <p id="state" class="state"><?php if($_GET['mail'] !== $email) {echo $states;}else { echo $state;}; ?></p>
                    <span id="country" class="country"><?php if($_GET['mail'] !== $email) {echo $countrys; }else { echo $country;}; ?></span>
                </div>

            </div>
            <div class="profile-option">
                <div class="notification">
                    <i class="fa fa-bell"></i>
                    <span class="alert-message">3</span>
                </div>
            </div>
        </div>



        <div class="main-bd">
            <div class="left-side">
                <div class="profile-side">
                    <p class="mobile-no"><i class="fa fa-phone"></i> +<?php if($_GET['mail'] !== $email) {echo $number;}else { echo $numbers;}; ?></p>
                    <p class="user-mail"><i class="fa fa-envelope"></i> <?php if($_GET['mail'] !== $email) {echo $mm;}else { echo $email;}; ?></p>
                    <div class="user-bio">
                        <h3>Bio</h3>
                        <p class="bio" style="color: #ccc;">
                            Nothing Yet!
                        </p>
                    </div>
                    <div class="profile-btn">
                        <?php
                            if(isset(($_GET['mail']))) {
                                if($_GET['mail'] == $email) {
                                    echo '<a href="../create/post.php" class="chatbtn" id="chatBtn"><i class="fa fa-plus"></i> Create</a>';
                                }
                                else if($_GET['mail'] !== $email) {
                                    echo '<button class="chatbtn" id="chatBtn"><i class="fa fa-comment"></i> Chat</button>';
                                }
                                else {
                                    echo '<a href="../create/post.php" class="chatbtn" id="chatBtn"><i class="fa fa-plus"></i> Create</a>';
                                }
                            };
                            ?>
                    </div>
                    <div class="user-rating" disabled>
                        <h3 class="rating">4.5</h3>
                        <div class="rate">
                            <div class="star-outer">
                                <div class="star-inner">
                                    <i class="fa fa-star" data-index="0"></i>
                                    <i class="fa fa-star" data-index="1"></i>
                                    <i class="fa fa-star" data-index="2"></i>
                                    <i class="fa fa-star" data-index="3"></i>
                                    <i class="fa fa-star" data-index="4"></i>
                                </div>
                            </div>
                            <span class="no-of-user-rate"><span>123</span>&nbsp;&nbsp;reviews</span>
                        </div>

                    </div>
                </div>

            </div>
            <div class="right-side">

                <div class="nav">
                    <ul>
                        <li onclick="tabs(0)" class="user-post active">Your Posts</li>
                        <li onclick="tabs(1)" class="user-review">Reviews</li>
                        <li onclick="tabs(2)" class="user-setting"> Settings</li>
                    </ul>
                </div>
                <div class="profile-body">
                    <div class="profile-posts tab">
                        <div class="post-wrapper">
                            <div class="post-cover">
                                <?php
                                        getPost($conn);
                                    ?>


                            </div>
                            <div class="post-next">
                                <!--                                <button class="next-btn">See More</button>-->
                            </div>
                        </div>
                    </div>
                    <div class="profile-reviews tab">
                        <h1>User reviews</h1>
                        <?php
                        
                            echo '<form id="comment" action="'.setComment($conn).'" method="post">
                            <input type="hidden" name="commentorN" value="'.$useN.'">
                            <input type="hidden" name="commentD" value="'.date('Y-m-d H:i').'">
                            <textarea autofocus name="post-comment" id="commentInput"></textarea> <br>
                            

                        ';
                            if(isset(($_GET["mail"]))) {
                                if($_GET["mail"] == $email) {
                                    echo '<button type="submit" onclick="alert("You cant comment on your profile!")" name="comment-submit" class="commentBtn" disabled>Comment</button>';
                                }
                                else {
                                    echo '<button type="submit"  name="comment-submit" class="commentBtn">Comment</button>';
                                }
                            };
                            echo '</form>';
                            getComment($conn);
                        ?>
                        <button class="nextComment">More Comments</button>


                    </div>
                    <div class="profile-settings tab">
                        <div class="account-setting">
                            <h1>Acount Setting</h1>
                            <form action="#" method="post" enctype="multipart/form-data">
                              <div>
                                  <label for="addBio">Add Your Bio</label>
                                  <textarea name="addBio" id="addBio"></textarea>
                              </div>
                               <div>
                                   
                                <input type="file" name="file">
                               </div>
                               <div>
                                  <label for="changeN">Change Your User Name</label>
                                   <input type="text" name="changeN" placeholder="Change Your Name...">
                               </div>
                               <div>
                                   <label for="changeE">Change Your Email Address</label>
                                   <input type="text" name="changeE">
                               </div>
                               <div>
                                   <label for="changeM">Change Your Mobile Number</label>
                                   <input type="text" name="changeM">
                               </div>
                               <div>
                                   <label for="changeA">Change Your Address</label>
                                   <div class="addCh">
                                       
                                   <select name="changeC" id="countryC">
                                       <option>Change Country</option>
                                   </select> <br>
                                   <input type="text" placeholder="Add New State...">
                                   </div>
                                   
                               </div>
                               <div>
                                   <button id="deleteAccount"> Delete Account</button>
                                   <button type="submit" name="update-submit">Update Info</button>
                               </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>







    <script src="../js/jquery/jquery.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/jquery.js"></script>
    <script>
        $('.nav ul li').click(function() {
            $(this).addClass('active').siblings().removeClass('active');
        })

    </script>
    <script>
        const tabBtn = document.querySelectorAll('.nav ul li');
        const tab = document.querySelectorAll('.tab');

        function tabs(panelIndex) {
            tab.forEach(function(node) {
                node.style.display = "none";
            });
            tab[panelIndex].style.display = "block";
        }

        tabs(0);




        let bio = document.querySelector('.bio');
        const bioMore = document.querySelector('#see-more-bio');
        const bioLength = bio.innerText.length;

        if (bio.innerText.length > 100) {
            function bioText() {
                bio.oldText = bio.innerText;

                bio.innerText = bio.innerText.substring(0, 100) + "...";
                bio.innerHTML += `<span onclick='addLength()' id='see-more-bio'>See More</span>`;
            }

            function addLength() {
                bio.innerText = bio.oldText;
                bio.innerHTML += "&nbsp;" + `<span onclick='bioText()' id='see-less-bio'>See Less</span>`;
                document.getElementById('see-less-bio').addEventListener('click', () => {
                    document.getElementById('see-less-bio').style.display = 'none';
                })

            }

        }
        bioText();


        if (document.querySelector('.alert-message').innerText > 9) {
            document.querySelector('.alert-message').style.fontSize = '.7rem';
        }

    </script>
    <script>
        var ratedIndex = -1;

        $(document).ready(function() {
            colorS();
            if (localStorage.getItem('ratedIndex') != null) {
                setStars(parseInt(localStorage.getItem('ratedIndex')));
            }
            $('.fa-star').click(function() {
                ratedIndex = parseInt($(this).attr('data-index'));
                localStorage.setItem('ratedIndex', ratedIndex);
            })
            $('.fa-star').mouseover(function() {
                colorS();
                var currentIndex = parseInt($(this).attr('data-index'));
                setStars(currentIndex);

            });
            $('.fa-star').mouseleave(function() {
                colorS();
                if (ratedIndex != -1) {
                    setStars(ratedIndex);
                }
            })
        });

        function setStars(max) {
            for (i = 0; i <= max; i++) {
                $('.fa-star:eq(' + i + ')').css('color', '#e40046');
            }
        }

        function colorS() {
            $('.fa-star').css('color', '#aaa');
        }

    </script>

    <script>
        //        $(document).ready(function() {
        //            let commentCount = 4;
        //            $('.nextComment').click(function() {
        //                commentCount = commentCount + 4;
        //                $('.comment-box').load('profile.php', {
        //                    cNewCount: commentCount
        //                });
        //            })
        //        })

    </script>
    <script>
        getCountry = () => {
    fetch('../data/countries.json')
        .then((res) => res.json())
        .then((data) => {
            let output = '<option>Change Your Country</option>';
            data.forEach((user) => {
                output += `<option value='${user.name}'>${user.name}&nbsp;(${user.code})</option>`;
            })
            document.getElementById('countryC').innerHTML = output;
        })
}
getCountry();
    </script>

</body>

</html>
