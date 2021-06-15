<?php
require 'includes/dbh.inc.php';
if (isset($_GET['token']) && isset($_GET['email'])) {
    $sql = "SELECT * FROM users WHERE emailUsers=?";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(1, $_GET['email']);
    $stmt->execute();
    $row = $stmt->fetch();
    if ($row['token'] !== '0' && $row['token'] == $_GET['token']) {
        $sql = "UPDATE users SET token=0 WHERE emailUsers=?";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $_GET['email']);
        $stmt->execute();
        header('Location: home.php');
        exit();
    }
    else {
        header ('Location: verifyEmail.php?erro=invalid');
        exit();
    }
}
?>