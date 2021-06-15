<?php require 'gallery.php' ?>
<head>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhaina+2&display=swap" rel="stylesheet"> 
    <title>Home</title>
</head>
<body>
    <main>
    <?php
    if (isset($_SESSION['userId'])) {
        require 'header.php';
        ?>
        <form action="includes/logout.inc.php" method="post">
            <button href="index.php" type="submit" name="logout-submit">Logout</button>
            <a href="login.php" type="submit" name="logout-submit">Logout</a>
        </form>
    <?php
    }
    else {
        if (isset($_GET["newpwd"]) == "passwordupdated") {
            echo '<p class="signup-succes-msg">Your password has been reset !</p>';
        }
        elseif (isset($_GET["like"]) == "loginfirst") {
            echo '<p class="signup-succes-msg">To like a picture login first</p>';
        }
        ?>
        <div class="container-login-form">
            <form class="form-login" action="includes/login.inc.php" method="post"> 
                <h1 class="login-title">Camagru</h1>
                <input type="text" name="mailuid" placeholder="Username/E-mail..." required>
                <input type="password" name="pwd" placeholder="Password" required>
                <button class="login-button" type="submit" name="login-submit">Login</button>
                <a class="forgot-pass" href="forgotPassword.php">Forgot Password ?</a>
                <div class="signup-block">
                    <p class="signup-p">Not signed in yet?</p>
                    <a class="signup-button2" href="signup.php">Sign Up</a>
                </div>
            </form>
        </div>
    <?php
    }
    ?>
</main>
</body>
<?php
include "footer.php";
?>