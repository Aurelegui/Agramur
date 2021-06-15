<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    if (isset($_SESSION['userId'])) {
        require 'header.php';
    }
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Dosis|Lato|Montserrat|Oswald|Roboto|Sulphur+Point&display=swap" rel="stylesheet">
    <title>forgot password</title>
</head>
<div class="container-forgot-form">
    <form class="form-login" action="includes/forgotPassword.inc.php" method="post"> 
        <h1 class="login-title">Reset Password</h1>
        <h4 class="title-pass-recovery">Send password recovery email</h3>
<?php
    if (isset($_GET['error'])) {
        if ($_GET['error'] == "emptyfield") {
            echo '<p class="signup-error-msg">Fill in all fields</p>';
        }
        elseif ($_GET['error'] == "invalidmail") {
            echo '<p class="signup-error-msg">Invalid e-mail</p>';
        }
        elseif ($_GET['error']) {
            echo '<p class="signup-error-msg">Something went wrong try again</p>';
        }
        elseif ($_GET['reset'] == "success") {
            echo '<p class="signup-succes-msg">E-mail sent !</p>';
        }
    }
?>
        <input type="text" name="mail" placeholder="E-mail...">
        <button class="login-button" type="submit" name="reset-submit">Reset</button>
    </form>
</div>
<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['userId'])) {
    require 'footer.php';
}
?>