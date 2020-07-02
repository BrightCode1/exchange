
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Reset Your Password | Exchanger</title>
    <link rel="stylesheet" href="../css/reset.css">
</head>

<body>
    <div class="main">

        <div class="container">
            <h1 class="title">Reset Your Password</h1>
            <p>An email will be sent to you soon!</p>
            <?php 
                if(isset($_GET['reset'])) {
                            if($_GET['reset'] == "success") {
                                echo "<p class='success' style='padding: 10px;color: green;font-weight: bolder;font-family: sans-serif;'> Check Your Email! </p>";
                            }
                        }
            ?>
            <form action="../getInfo/password-reset.php" method="post">
                <input type="text" placeholder="Enter Email Address" name="resetmail" id="mail">
                <button type="submit" name="submit">Reset Password</button>
            </form>

        </div>

    </div>



</body>

</html>
