<?php

session_start();
include_once 'src/User.php';
include_once 'src/config.php';
include_once 'src/Tweet.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['newUsername']) && !empty($_POST['newUsername'])) {
        $user = new User;
        $user->setUsername($_POST['newUsername']);
    } else {
        echo 'Podaj imię!';
    }

    if (isset($_POST['newEmail']) && !empty($_POST['newEmail'])) {
        $user->setEmail($_POST['newEmail']);
    } else {
        echo 'Podaj email!';
    }

    if (isset($_POST['newPassword']) && !empty($_POST['newPassword'])) {
        $user->setPassword($_POST['newPassword']);
    }

    if (isset($_POST['newUsername']) && isset($_POST['newEmail']) && isset($_POST['newPassword'])) {
        $user->saveToDB($conn);
        $_SESSION['id'] = $user->getId();
        $_SESSION['username'] = $_POST['newUsername'];

        header("Location: main.php");
    }
    //var_dump($user);
    //var_dump($_POST);
} else {
    echo "Coś poszło nie tak. Spróbuj jeszcze raz!";
}

