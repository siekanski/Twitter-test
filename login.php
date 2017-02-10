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
                <label class="login-header"><p>Zaloguj się!</p></label><br>
                <input type="text" name="email" placeholder="Twój e-mail"><br>
                <input type="password" name="password" placeholder="Twoje hasło"><br>
                <button type="submit" name="Log in">Zaloguj</button>
            </form>
        </div>
        <div class="register">
            <form class="register-form" method="POST" action="newUser.php">
                <label class="register-header"><p>Dołącz do nas!</p></label><br>
                <input type="text" name="newUsername" placeholder="Twoja nazwa użytkownika"><br>
                <input type="text" name="newEmail" placeholder="Twój adres e-mails"><br>
                <input type="password" name="newPassword" placeholder="Twoje hasło"><br>
                <button type="submit" name="Sign up">Dołącz</button> 
            </form>
        </div>
    </body>
</html>

