<?php
require 'header.php';
if (isset($_SESSION['userId'])){
?>
    <div id="profil-page-container">
        <div class="form-login">
            <h1 class="login-title">Profil Details</h1>
            <div id="profil-username">
                <h3 class="h3-profil">Username <a href="typeNewUsername.php" alt="edit"><img src="https://img.icons8.com/pastel-glyph/64/000000/edit.png" width="30px" height="30px"></a></h3>
                <p class="profil-p"><?php echo $_SESSION['uidUsers']?></p>
            </div>
            <div id="profil-username">
                <h3 class="h3-profil">E-mail <a href="typeNewEmail.php" alt="edit"><img src="https://img.icons8.com/pastel-glyph/64/000000/edit.png" width="30px" height="30px"></a></h3>
                <p class="profil-p"><?php echo $_SESSION['emailUsers']?></p>
            </div>
            <div id="profil-username">
            <?php
            require 'includes/dbh.inc.php';
            $sql = "SELECT getMail FROM users WHERE uidUsers='".$_SESSION['uidUsers']."' ";
            $stmt = $pdo->query($sql);
            $row = $stmt->fetch();
            $getMail = $row['getMail'];
            ?>
                <h3 class="h3-profil">Receive Notification <a href="changeNotification.php" alt="edit"><img src="https://img.icons8.com/pastel-glyph/64/000000/edit.png" width="30px" height="30px"></a></h3>
                <p class="profil-p">Notifications: <?php if($getMail == 0){ echo 'OFF';} else {echo 'ON';} ?></p>
            </div>
            <div id="profil-username">
                <button id="button-changepwd">Change Password</button>
                <script>
                var btn = document.getElementById('button-changepwd');
                btn.addEventListener('click', function() {
                document.location.href = 'forgotPassword.php';
                });
                </script>
            </div>
        </div>
    </div>
<?php 
} else {
    header ('Location: login.php');
}
require 'footer.php';
?>
