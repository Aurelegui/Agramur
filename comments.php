<?php 
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if (isset($_SESSION['userId'])) {
    ini_set('display_errors', 1);
    require 'includes/dbh.inc.php';
    $localhost = 'http://localhost';
    $id= $_POST['idUsers'];
    $username= $_POST['uidUsers'];
    $photo= $_POST['photo'];
    $comment= $_POST['comment'];

    if(!(empty($comment))) {
        $sql = "INSERT INTO comments (idUsers, uidUsers, photo, comment) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->bindValue(2, $username);
        $stmt->bindValue(3, $photo);
        $stmt->bindValue(4, $comment);
        $stmt->execute();
        //get id and username
        $sql = "SELECT * FROM userphotos WHERE photo = '" . $photo . "' ";
        $stmt = $pdo->query($sql);
        $row = $stmt->fetch();
        $authId = $row['idUsers'];
        $authUsername = $row['uidUsers'];
        //get email with id and username
        $sql = "SELECT * FROM users WHERE idUsers = '" . $authId . "' AND  uidUsers = '" . $authUsername . "'  ";
        $stmt = $pdo->query($sql);
        $row = $stmt->fetch();
        $email = $row['emailUsers'];
        $sql = "SELECT * FROM users WHERE emailUsers='".$email."'";
        $stmt = $pdo->query($sql);
        $row = $stmt->fetch();
        $getMail = $row['getMail'];
    
        if(($authUsername != $username) && ($getMail == 1)) {
            require 'includes/PHPMailer/src/Exception.php';
            require 'includes/PHPMailer/src/SMTP.php';
            require 'includes/PHPMailer/src/PHPMailer.php';

            $mail = new PHPMailer(true);
            $mail->SMTPDebug  = 1;  // Enable verbose debug output
            $mail->isSMTP();       
            $mail->Mailer     = "smtp";     // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';   // Set the SMTP server to send through
            $mail->SMTPAuth   = true;   // Enable SMTP authentication
            $mail->Username   = 'camagru.projet@gmail.com'; // SMTP username 
            $mail->Password   = 'aurele123';    // SMTP password
            $mail->SMTPSecure = "tls";  // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = 587;    // TCP port to connect to
            //if no mail is sent go on account change security params
            //Recipients
            $mail->setFrom('camagru.projet@gmail.com', 'Camagru Team');
            $mail->addAddress($email);  // Add a recipient
            // Content
            $mail->isHTML(true);        // Set email format to HTML
            $mail->Subject = 'Comment Notification';
            $mail->Body    = '<p>'.$username.' wrote a comment on your Picture! </p>';
            $mail->send();
        }
    }
}
header("Location: home.php");
?>