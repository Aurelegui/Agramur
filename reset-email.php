<?php 
if (isset($_POST['reset-email-submit']))
{
    require 'includes/dbh.inc.php';

    session_start();
    $iduser = $_SESSION['userId'];
    $realEmail = $_SESSION['emailUsers'];
    $oldEmail = $_POST['old-email'];
    $newEmail = $_POST['new-email'];
    $emailRepeat = $_POST['email-repeat'];

    if (empty($newEmail) || empty($emailRepeat) || empty($oldEmail)) {
        header ('Location: typeNewEmail.php?error=empty');
        exit;
    }
    elseif (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?error=invalidmail");
        exit();
    }
    elseif ($newEmail !== $emailRepeat) {
        header("Location: typeNewEmail.php?error=invalidrepeat");
        exit();
    }
    elseif ($oldEmail !== $realEmail) {
        
        header("Location: typeNewEmail.php?error=invalidrealemail");
        exit();
    }
    else {
        $sql = "SELECT emailUsers FROM users WHERE emailUsers='" . $newEmail . "'";
        $stmt = $pdo->query($sql); //prepare ce qu'on a besoin dans notre db
        $row = $stmt->fetch();  
        if ($row > 0) {
            header("Location: typeNewEmail.php?error=emailtaken&email=".$newEmail);
            exit();
        }
        else {
            $sql = "UPDATE users SET emailUsers=? WHERE idUsers=?;";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $newEmail);
            $stmt->bindValue(2, $iduser);
            $stmt->execute();

            $sql = "SELECT emailUsers FROM users WHERE emailUsers='" . $newEmail . "'";
            $stmt = $pdo->query($sql); //prepare ce qu'on a besoin dans notre db
            $row = $stmt->fetch();

            $_SESSION['emailUsers'] = $row['emailUsers'];
            header("Location: profil.php?success=emailchanged");
            exit();
        }
    }
}
else {
    header("Location: index.php");
}
?>