<?php 
if (isset($_POST['reset-username-submit']))
{
    require 'includes/dbh.inc.php';

    session_start();
    $iduser = $_SESSION['userId'];
    $realUsername = $_SESSION['uidUsers'];
    $oldUsername = $_POST['old-username'];
    $newUsername = $_POST['new-username'];
    $usernameRepeat = $_POST['username-repeat'];

    if (empty($newUsername) || empty($usernameRepeat) || empty($oldUsername)) {
        header ('Location: typeNewUsername.php?error=empty');
        exit;
    }
    elseif (!preg_match("/^[a-zA-Z0-9]*$/", $newUsername)) {
        header("Location: typeNewUsername.php?error=invalidusername");
        exit();
    }
    elseif ($newUsername !== $usernameRepeat) {
        header("Location: typeNewUsername.php?error=invalidrepeat");
        exit();
    }
    elseif ($oldUsername !== $realUsername) {
        header("Location: typeNewUsername.php?error=invalidrealusername");
        exit();
    }
    else {
        $sql = "SELECT uidUsers FROM users WHERE uidUsers='" . $newUsername . "'";
        $stmt = $pdo->query($sql); //prepare ce qu'on a besoin dans notre db
        $row = $stmt->fetch();
        if ($row > 0) {
            header("Location: typeNewUsername.php?error=usernametaken&username=".$newUsername);
            exit();
        }
        else {
            $sql = "UPDATE users SET uidUsers=? WHERE idUsers=?;";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $newUsername);
            $stmt->bindValue(2, $iduser);
            $stmt->execute();

            $sql = "SELECT uidUsers FROM users WHERE uidUsers='" . $newUsername . "'";
            $stmt = $pdo->query($sql); //prepare ce qu'on a besoin dans notre db
            $row = $stmt->fetch();

            $_SESSION['uidUsers'] = $row['uidUsers'];
            header("Location: profil.php?success=usernamechanged");
            exit();
        }
    }
}
else {
    header("Location: index.php");
}
?>