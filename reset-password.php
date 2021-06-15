<?php
if (isset($_POST['reset-password-submit'])) {
    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $password = $_POST["pwd"];
    $passwordRepeat = $_POST["pwd-repeat"];

    if (empty($password || empty($passwordRepeat))) {
        header("Location: newPassword.php?password=empty");
        exit();
    }
    elseif ($password != $passwordRepeat) {
        header("Location: newPassword.php?password=nomatch");
        exit();
}
$currentDate = date("U");
require 'includes/dbh.inc.php';

$sql = "SELECT * FROM pwdReset WHERE pwdResetSelector=? AND pwdResetExpires >= ?";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(1, $selector);
$stmt->bindValue(2, $currentDate);
$stmt->execute();
$row = $stmt->fetch();

if(!$row) {
    echo "You need to re-submit your reset request";
    exit();
} 
else {
    $tokenBin = hex2bin($validator);
    $tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);
    if ($tokenCheck === false) {
        echo "You need to re-submit your reset request";
        exit();
    }
    elseif ($tokenCheck === true) {
        $tokenEmail = $row["pwdResetEmail"];
        $sql = "SELECT * FROM users WHERE emailUsers=?;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $tokenEmail);
        $stmt->execute();

        $sql = "UPDATE users SET pwdUsers=? WHERE emailUsers=?;";
        $newPwdHash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $newPwdHash);
        $stmt->bindValue(2, $tokenEmail);
        $stmt->execute();

        $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $tokenEmail);
        $stmt->execute();

        header("Location: login.php?newpwd=passwordupdated");
        }
    }   
}
else {
header("Location: ../index.php");
}
?>