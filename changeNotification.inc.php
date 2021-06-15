<?php
require 'includes/dbh.inc.php';
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['uidUsers'])) {
    $sql = "SELECT getMail FROM users WHERE uidUsers='".$_SESSION['uidUsers']."'";
    $stmt = $pdo->query($sql);
    $row = $stmt->fetch();
    $getMail = $row['getMail']; 
    if ($getMail == 0) {
        $sql = "UPDATE users SET getMail= 1 WHERE  uidUsers=?";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $_SESSION['uidUsers']);
        $stmt->execute();
        Header ('Location: profil.php');
    }
    elseif($getMail != 0) {
        $sql = "UPDATE users SET getMail= 0 WHERE  uidUsers=?";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $_SESSION['uidUsers']);
        $stmt->execute();
        Header ('Location: profil.php');
    }
}
Header ('Location: profil.php');
?>

