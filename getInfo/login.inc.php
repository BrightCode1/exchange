<?php 
    
    if(isset($_POST["lg-submit"])) {
        
        require "db.inc.php";
        
        $usermail = $_POST["lg-mail"];
        $userpwd = $_POST["lg-pwd"];
            
        if(empty($usermail) || empty($userpwd)) {
            header("Location: ../login.php?error=emptyLoginField");
            exit();
        }
        else {
            $sql = "SELECT * FROM usersinfo WHERE emails=?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../login.php?error=sqlerror");
                exit();
            }
            else {
                mysqli_stmt_bind_param($stmt, "s", $usermail);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if($row = mysqli_fetch_assoc($result)) {
                    $pwdcheck = password_verify($userpwd, $row['passwords']);
                    if($pwdcheck == false) {
                        header("Location: ../login.php?error=incorrectpassword");
                        exit();
                    }
                    else if($pwdcheck == true) {
                        session_start();
                        $_SESSION['userId'] = $row['username'];
                        $_SESSION['userNo'] = $row['id'];
                        $_SESSION['userMail'] = $row['emails'];
                        
                        header("Location: ../index.php?login=success");
                        exit();
                    }
                    else {
                        header("Location: ../login.php?error=incorrectpassword");
                        exit();
                    }
                }
                else {
                    header("Location: ../login.php?error=nouser");
                    exit();
                }
            }
        }
    }
else {
    header("Location: ../index.php");
    exit();
}
