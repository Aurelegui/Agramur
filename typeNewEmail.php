<?php
require 'header.php';
if (isset($_SESSION['userId'])) {
?>
    <form action="reset-email.php" method="post">
        <input type="email" name="old-email" placeholder="Enter Old email">
        <input type="email" name="new-email" placeholder="Enter New email">
        <input type="email" name="email-repeat" placeholder="Enter New email Again">
        <button type="submit" name="reset-email-submit">Confirm</button>
    </form>
<?php 
} 
else {
Header ('Location: profil.php');
} 
require 'footer.php';
?>