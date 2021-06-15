<?php

ini_set('display_errors', 1);
$localhost = 'http://localhost';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//protection contre l'acces direct au signup
if (isset($_POST['signup-submit'])) {
    require 'dbh.inc.php';
    //fetch info quand user s'inscrit
    $username = $_POST['uid'];
    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];
    // error handlers
    if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
        header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email);
        exit();
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^$[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=invaliduidmail=");
        exit();
    }
    //fonction si email valide
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?error=invalidmail&uid=".$username);
        exit();
    }
    //un bon username
    elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=invaliduid&mail=".$email);
        exit();
    }
    // check si password match passwordRepeat
    elseif ($password !== $passwordRepeat) {
        header("Location: ../signup.php?error=passwordcheckfail&uid=".$username."&mail".$email);
        exit();
    }
    //check si username exist deja et protection avec "prepare statement avec placeholders -> '?'
    else {
        $sql = "SELECT uidUsers FROM users WHERE uidUsers='" . $username . "'";
        $stmt = $pdo->query($sql); //prepare ce qu'on a besoin dans notre db
        $row = $stmt->fetch();
        if ($row > 0) {
            header("Location: ../signup.php?error=usernametaken&username=".$username);
            exit();
        }
        $sql = "SELECT uidUsers FROM users WHERE emailUsers='" . $email . "'";
        $stmt = $pdo->query($sql); //prepare ce qu'on a besoin dans notre db
        $row = $stmt->fetch();
        if ($row > 0) {
            header("Location: ../signup.php?error=emailtaken&email=".$email);
            exit();
        }
        else {
            //Insertion des infos tapper dans mysql
            $sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers, token) VALUES (?, ?, ?, ?)";
             
            //cryptage du pwd en "hashing" avec Becrypt
            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
            $token = md5(uniqid(rand(), true));
            
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $username);
            $stmt->bindValue(2, $email);
            $stmt->bindValue(3, $hashedPwd);
            $stmt->bindValue(4, $token);
            $stmt->execute();

            require 'PHPMailer/src/Exception.php';
            require 'PHPMailer/src/PHPMailer.php';
            require 'PHPMailer/src/SMTP.php';

            $mail = new PHPMailer(true);
            $mail->SMTPDebug  = 1;                      // Enable verbose debug output
            $mail->isSMTP();       
            $mail->Mailer     = "smtp";                                     // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'camagru.projet@gmail.com';                     // SMTP username
            $mail->Password   = 'aurele123';                               // SMTP password
            $mail->SMTPSecure = "tls";        // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('camagru.projet@gmail.com', 'Camagru Team');
            $mail->addAddress($email);     // Add a recipient

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Verify Email';
            $url = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
            $url2 = $url[0];
            $mail->Body    = '<a href="'. $localhost .'/'. $url2.'/confirm.php?token='. $token .'&email='. $email .'">VERIFY MY EMAIL ADRESSE</a>';

            $mail->send();

            //sendVerification($email, $token, $mail);
            header("Location: ../verifyEmail.php");
            exit();
        }
    }
}
else {
    header("Location: ../signup.php");
    exit();
}
