<?php

if(isset($_POST['submit'])) {
    
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);
    
    $url = "www.exchanger.ml/login/reset/create-new-password.php?selector=".$selector."&validator=".bin2hex($token);
    $tokenExpires = date("U") + 1800;
    
    require "db.inc.php";
    
    $userResetEmail = $_POST['resetmail'];
    
    $sql = "DELETE pwdReset WHERE pwdResetMail=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        echo "There was an error!";
        exit();
    }
    else {
        mysqli_stmt_bind_param($stmt, "s", $userResetEmail);
        mysqli_stmt_execute($stmt);
    }
    
    $sql = "INSERT INTO pwdReset (pwdResetMail, pwdResetSelector, pwdResetToken, pwdResetExp) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        echo "There was an error!";
        exit();
    }
    else {
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ssss", $userResetEmail, $selector, $hashedToken, $tokenExpires);
        mysqli_stmt_execute($stmt);
    }
    mysqli_stmt_close($stmt);
    mysqli_close();
    
    
    $to = $userResetEmail;
    $subject = "Password Reset For Exchanger";
    $message = "<p>We Received a password reset request for your account in exchanger. <br> The link to reset your password is below.if you didn't make this request, then you can ignore this email.</p> <br><br><br>
    <p>Password Reset Link: <br> <a href='".$url."'>'.$url.'</a></p>";
    $headers = "From: Exchanger \r\n";
    $headers .= "Reply-To: noreply@gmail.com\r\n";
    $headers .= "Content-type: text/html\r\n";
    
    mail($to, $subject, $message, $headers);
    
    header("Location: ../login/reset.php?reset=success");
    
    
}
else {
    header("Location: ../login.php");
}