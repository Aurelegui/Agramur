<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="https://img.icons8.com/ultraviolet/40/000000/cloud.png">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhaina+2&display=swap" rel="stylesheet"> 
    <title>Camagru</title>
</head>
<body>
<?php
if (isset($_SESSION['userId'])) {
?>
    <header>
        <nav class="nav-bar">
            <ul class="ul-navbar">
                <li class="logo">
                    <a href="index.php"><img class="logo-img1" src="img/logo-img1.png" alt="logo"></a>
                </li>
                <li class="li-navbar">
                    <a href="profil.php">Profil</a>
                </li>
                <li class="li-navbar"><a href="post-image.php">Post Image</a></li>
                <li class="li-navbar"><a href="upload-page.php">Upload</a></li>
                <li class="li-navbar-logout">
                <a href="includes/logout.inc.php" type="submit" name="logout-submit">Logout</a>
                </li>
            </ul>
        </nav>
    </header>
<?php
}
else {
header ("Location: login.php");
}
?>