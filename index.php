<?php
session_start();
if (isset($_SESSION['userId'])) {
    header("Location: home.php");
}
else {
    header("Location: galleryPage.php");
}
require "footer.php";
?>