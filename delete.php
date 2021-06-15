<?php
require 'includes/dbh.inc.php';
$photo = $_POST["photo"];
$sql = "SELECT * FROM userphotos WHERE photo='" . $photo . "'";
$stmt = $pdo->query($sql);
$row = $stmt->fetch();
$user = $row['uidUsers'];
if ($_POST['uidUsers'] === $user) {
    if(isset($_POST['delete'])){
        $sql = "DELETE FROM userphotos WHERE photo='" . $photo . "'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $sql = "DELETE FROM likes WHERE photo='" . $photo . "'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $sql = "DELETE FROM comments WHERE photo='" . $photo . "'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        header("Location: home.php?succes=deleted-photo");
        exit();
    }
    else {
        header("Location: home.php?error=clickondeletebutton");
        exit();
    }
}
else {
    header("Location: home.php?error=Noturphotbuddy");
}
?>