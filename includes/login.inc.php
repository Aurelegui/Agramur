<?php
if (isset($_POST['login-submit'])) 
{  
    require 'dbh.inc.php';
    $mailuid = $_POST['mailuid'];
    $password = $_POST['pwd'];
    if (empty($mailuid) || empty($password)) {
        header("Location: ../login.php?error=emptyfields");
        exit();
    }
    elseif (!preg_match("/^$[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../login.php?error=somethingwentwrong");
        exit();
    }
    else {//recherche si l'uidUsers ou email est dans la DB
        $sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $mailuid);
        $stmt->bindValue(2, $mailuid);
        $stmt->execute();
        if ($row = $stmt->fetch())
        {
            $pwdCheck = password_verify($password, $row['pwdUsers']);
            if ($pwdCheck == false) {
                header("Location: ../login.php?error=wrongpwd");
                exit();
            }
            else if ($pwdCheck == true) {
                session_start();    
                $_SESSION['userId'] = $row['idUsers'];
                $_SESSION['userUid'] = $row['uidUsers'];
                $_SESSION['uidUsers'] = $row['uidUsers'];
                $_SESSION['emailUsers'] = $row['emailUsers'];  
                if ($row['token'] !== '0') {
                    header("Location: ../verifyEmail.php");
                }
                else {
                    header("Location: ../home.php?login=success");
                    exit();
                }
            }
            else { //aucun match
                header("Location: ../login.php?error=wrongpwd");
                exit();
            }
        }
        else {
            header("Location: ../login.php?error=nouser");
            exit();
        }
    }
}
else {
    header("Location: ../login.php");
    exit();
}