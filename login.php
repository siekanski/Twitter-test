<?php

session_start();
include_once 'src/User.php';
include_once 'src/config.php';
?>

<!DOCTYPE html>
<html lang="pl-PL">
    <head>
        <meta charset="UTF-8">
        <title>Twitter/test - rejestracja</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <div class="login">
            <form class ="login-form" method="POST" action="userLogin.php">
                <label class="login-header"><p>Log In!</p></label><br>
                <input type="text" name="email" placeholder="Your e-mail"><br>
                <input type="password" name="password" placeholder="Your password"><br>
                <button type="submit" name="Log in">Log In</button>
            </form>
        </div>
        <div class="register">
            <form class="register-form" method="POST" action="newUser.php">
                <label class="register-header"><p>Sign up TODAY!</p></label><br>
                <input type="text" name="newUsername" placeholder="Your desired username"><br>
                <input type="text" name="newEmail" placeholder="Your e-mail address"><br>
                <input type="password" name="newPassword" placeholder="Your desired password"><br>
                <button type="submit" name="Sign up">Sign Up</button> 
            </form>
        </div>
    </body>
</html>

