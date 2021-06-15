<?php
require 'gallery.php';
?>
<head>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhaina+2&display=swap" rel="stylesheet"> 
    <title>Signup</title>
</head>
</body>
    <main>
        <div class="wrapper-main">
            <section class="container-login-form2">
                <form class="form-login" action="includes/signup.inc.php" method="post">
                    <h1 class="login-title">Register</h1>
                    <?php
                    if (isset($_GET['error'])) {
                        if ($_GET['error'] == "emptyfields") {
                            echo '<p class="signup-error-msg">Fill in all fields</p>';
                        }
                        elseif ($_GET["error"] == "invaliduidmail") {
                            echo '<p class="signup-error-msg">Invalid username and e-mail</p>'; 
                        }
                        elseif ($_GET["error"] == "invalidmail") {
                            echo '<p class="signup-error-msg">Invalid e-mail</p>'; 
                        }
                        elseif ($_GET["error"] == "invaliduid") {
                            echo '<p class="signup-error-msg">Invalid username</p>'; 
                        }
                        elseif ($_GET["error"] == "passwordcheckfail") {
                            echo '<p class="signup-error-msg">Your passwords dont match</p>'; 
                        }
                        elseif ($_GET["error"] == "usernametaken") {
                            echo '<p class="signup-error-msg">"' . $_GET['username'] .'" is already taken</p>'; 
                        }
                        elseif ($_GET["error"] == "emailtaken") {
                            echo '<p class="signup-error-msg">' . $_GET['email'] .' is already taken</p>';
                        }
                    }
                    elseif (isset($_GET["signup"]) == "success") {
                        echo '<p class="signup-succes-msg">Sign up successful</p>'; 
                    }
                    ?>
                    <input type="text" name="uid" placeholder="Username" minlength="8" required>
                    <input type="text" name="mail" placeholder="E-mail" required>
                    <input type="password" name="pwd" placeholder="Password" minlength="8" required>
                    <input type="password" name="pwd-repeat" placeholder="Repeat password" required>
                    <button class="signup-button" type="submit" name="signup-submit">Sign Up</button>
                </form>
            </section>
        </div>
    </main>
</body>
<?php
require "footer.php";
?>