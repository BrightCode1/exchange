<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | Exchanger</title>
    <link rel="stylesheet" href="./css/register.css">
</head>

<body>
    <div class="register-body">
        <div class="register">
            <div class="signup">
                <form action="getInfo/signup.inc.php" method="post" id="sg-form" enctype="multipart/form-data">
                    <h2>Join Exchanger</h2>
                    <p class="sg-info">Please be aware that some of the information provided will be made public</p>
                    <input type="text" name="sg-name" class="input sgname" title="Your Name" placeholder="Enter Your Name"><br>
                    <input type="text" class="input" placeholder="Mobile Number eg 234xxxxxxxx03" title="Enter Number With Country Code" name="sg-number"><br>
                    <select name="country" class="countries" id="country">
                    </select>
                    <input type="text" placeholder="Enter Your State/Address" title="Only Letters Allowed" name="sg-state" class="input"><br>
                    <input type="email" class="input" name="sg-email" placeholder="Enter Email"><br>
                    <input type="password" name="sg-pwd" class="input sg-pwd" placeholder="Enter Password"><br>
                    <input type="password" name="sg-pwd-c" class="input sg-pwd-c" placeholder="Confirm Password"><br>
                    <div>
                        <input type="file" name="file_img" id="file" hidden>
                        <input type="button" id="btnfile" onclick="btnFile()" class="btnfile btn-secondary" value="Upload Profile Photo">
                        <span id="filename" class="filename">No Files Chosen</span>
                    </div>

                    <?php
                        if(isset($_GET['error'])) {
                            if($_GET['error'] == "emptyFields") {
                                echo "<p class='error' style='padding: 10px'> Fill In All The Blanks! </p>";
                             
                            }
                            else if($_GET['error'] == "invalidEmail") {
                                echo "<p class='error' style='padding: 10px'> Please Input A Correct Email Address </p>";
                            }
                            else if($_GET['error'] == "invalidState") {
                                echo "<p class='error' style='padding: 10px'> Enter A Valid State (Only Letters Allowed) </p>";
                            }
                            else if($_GET['error'] == "invalidCountry") {
                                echo "<p class='error' style='padding: 10px'> Please Select A Country </p>";
                            }
                            else if($_GET['error'] == "invalidNumber") {
                                echo "<p class='error' style='padding: 10px'> Enter A Valid Mobile Number (Numbers Only) </p>";
                            }
                            else if($_GET['error'] == "invalidUsername") {
                                echo "<p class='error' style='padding: 10px'> Enter A Valid Name (Characters Not Only) </p>";
                            }
                            else if($_GET['error'] == "passwordcheck") {
                                echo "<p class='error' style='padding: 10px'> Your Password Does Not Match! </p>";
                            }
                            else if($_GET['error'] == "passwordwrong") {
                                echo "<p class='error' style='padding: 10px'> Your Password should be Greater Than 8 Letters </p>";
                            }
                            else if($_GET['error'] == "mailTaken") {
                                echo "<p class='error' style='padding: 10px'> Email Already Exits! </p>";
                            }
                        }
                        else if(isset($_GET['signup'])) {
                            if($_GET['signup'] == "success") {
                                echo "<p class='success' style='padding: 10px'> Registration Successful! Go To Login Page And Log In </p>";
                            }
                        }
                    ?>
                    <p class="errorj" style="display: none;padding: 10px;"></p>

                    <button type="submit" name="sg-submit" class="submit s-submit">Register</button>
                </form>
                <p class="next-acc">Already have An Account? <a href class="loginBtn">Login</a></p>
            </div>
            <div class="login">
                <form action="getInfo/login.inc.php" method="post" id="login-form">
                    <h2>Welcome Back To Exchanger</h2>
                    <input type="text" name="lg-mail" class="input" placeholder="Enter Email Address"><br>
                    <input type="password" name="lg-pwd" class="input" placeholder="Enter Password"><br>
                    <div class="checkbox">
                        <input type="checkbox" value="hello" name="lg-check" id="check">
                        <p class="check-text">Remember Me</p>
                    </div>
                    <button type="submit" name="lg-submit" class="submit">Log In</button>
                    
                </form>
                <a href="./login/reset.php" class="forgotP">Forgot Your Password?</a>
                <p class="next-acc">Are You New Here? <a href class="registerBtn">Register</a></p>
            </div>
        </div>
    </div>
    <script src="./js/login.js"></script>
</body>

</html>
