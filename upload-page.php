<title>Upload</title>
<?php
require "header.php";
if (isset($_SESSION['uidUsers'])) {
?>
<div id="upload-container">
    <div class="form-login">
        <h1 class="login-title">Pick a picture</h1>
        <p class="pick-p">Pictures should be 320px by 240px</p>
        <?php
        if (isset($_GET['error'])) {
            if($_GET['error'] == "size") {
            ?>
                <p class="profil-p" style="color:red;font-size:16px">Please Upload a 320px by 240px picture</p>
            <?php
            }
            elseif($_GET['error'] == "wrongformat") {
            ?>
                <p class="profil-p" style="color:red;font-size:16px">Please Upload a image format like jpg, jpeg or png</p>
            <?php
            }
            elseif($_GET['error'] == "error") {
            ?>
                <p class="profil-p" style="color:red;font-size:16px">Something went wrong please try again later</p>
            <?php
            }
        }   
        ?>
        <form class="picture" action="upload.inc.php" method="post" enctype="multipart/form-data">
            <input class="file" type="file" name="file">
            <button class="login-button" type="submit" name="submit">submit</button>
        </form>
    </div>
</div>
<?php
}
require "footer.php";
?>