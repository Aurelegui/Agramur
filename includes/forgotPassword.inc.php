<?php

ini_set('display_errors', 1);
$localhost = 'http://localhost';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//protection contre l'acces direct au signup
if (isset($_POST['reset-submit'])) {
    //timing attack protection. (use 2 tokens)
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);
    //expire date (1h from now)
    $expires = date("U")+ 1800;
    //run connection au database
    require 'dbh.inc.php';
    $email = $_POST['mail'];
    // deleting previous tokens if exist
    $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(1, $email);
    $stmt->execute();

    $sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?);";
    //hashed for + security (timing atacks)
    $hashedToken = password_hash($token, PASSWORD_DEFAULT); 
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(1, $email);
    $stmt->bindValue(2, $selector);
    $stmt->bindValue(3, $hashedToken);
    $stmt->bindValue(4, $expires);
    $stmt->execute();
    if (empty($email)) {
        header("Location: forgotPassword.php?error=emptyfield&mail=empty");
        exit();
    }
    //fonction si email valide
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: forgotPassword.php?error=invalidmail");
        exit();
    } 
    else {
        require 'PHPMailer/src/Exception.php';
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';

        //email setup
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
        $mail->Subject = 'Reset Password';
        $url = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        $url2 = $url[0];
        $mail->Body    = '
        <p>This is your reset password link</p>
        <a href="'. $localhost .':'.$_SERVER['SERVER_PORT'].'/'.$url2.'/typeNewPassword.php?selector='. $selector .'&validator='. bin2hex($token) .'">Change my Password!</a>';
        
        $mail->send();

        header("Location: ../forgotPassword.php?reset=success");
        exit();
        }
    }
else {
    header("Location: forgotPassword.php?error");
    exit();
}