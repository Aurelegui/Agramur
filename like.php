<?php
$id= $_POST['idUsers'];
$username= $_POST['uidUsers'];
$photo= $_POST['photo'];
    if(isset($_POST["like"])) {
        require 'includes/dbh.inc.php';
        $sql = "SELECT * FROM likes WHERE idUsers='" . $id . "' AND uidUsers='" . $username . "' AND photo='" . $photo . "' ";
        $stmt = $pdo->query($sql);
        $row = $stmt->fetch();
        if (empty($row)) {
            $sql = "INSERT INTO likes (idUsers, uidUsers, photo, liked) VALUES (?, ?, ?, liked + 1)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $id);
            $stmt->bindValue(2, $username);
            $stmt->bindValue(3, $photo);
            $stmt->execute();

            $sql = "UPDATE userphotos SET liked= liked + 1 WHERE photo=?";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $photo);
            $stmt->execute();
            header("Location: home.php");
            exit();
        }
        elseif (!(empty($row)) && ($row['liked'] > 0)) {
            $sql = "UPDATE likes SET liked= liked - 1 WHERE idUsers=? AND uidUsers=? AND photo=?";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $id);
            $stmt->bindValue(2, $username);
            $stmt->bindValue(3, $photo);
            $stmt->execute();

            $sql = "UPDATE userphotos SET liked= liked - 1 WHERE photo=?";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $photo);
            $stmt->execute();
            header("Location: home.php");
            exit();
        } 
        else {
            $sql = "UPDATE likes SET liked= liked + 1 WHERE idUsers=? AND uidUsers=? AND photo=?";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $id);
            $stmt->bindValue(2, $username);
            $stmt->bindValue(3, $photo);
            $stmt->execute();

            $sql = "UPDATE userphotos SET liked= liked + 1 WHERE photo=?";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $photo);
            $stmt->execute();
            header("Location: home.php");
            exit();
        }
    }
header("Location: home.php");
?>