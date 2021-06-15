<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Dosis|Lato|Montserrat|Oswald|Roboto|Sulphur+Point&display=swap" rel="stylesheet">
    <title>VerifyEmail</title>
</head>
<body>
<?php
require 'gallery.php';
if (isset($_GET['error']) == 'invalid') {
?>
    <div class="verified-text">
        <p>WRONG LINK</p>
        <a style="color:black;" href="">Something wrong happenend try to signup again and verify your mail for a verification link</a>'
    </div>
<?php
}
else {
    ?>
    <div class="verified-text">
        <h2>Please verify your email</h2>
        <button class="verified-button" onclick="window.location.href = 'login.php';">Login</button>
    </div>
</body>
<?php
}
require 'footer.php'
?>
