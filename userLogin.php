<?php

session_start();
include_once 'src/User.php';
include_once 'src/config.php';
include_once 'src/Tweet.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $stmt = $conn->prepare("INSERT * INTO Users (email, password) VALUES (?, ?)");
    $bind_param = $stmt->bind_param("s", $email, $password);
    
    $email = $_POST['email'];
    $password = $_POST['password'];

    $execute = $stmt->execute();
            
    $result = $conn->querry($stmt);
    if ($result->num_rows === 1) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if (password_verify($password, $row['hashed_password'])) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            echo "Witaj {$row['username']}";
            header("Location: main.php");
        } else {
            echo 'Złe hasło lub email';
        }
    }
}

$userId = $_SESSION['id'];
$date = gmdate("Y-m-d");
if (isset($_POST['tweet']) && !empty($_POST['tweet'])) {
$tweet = ($_POST['tweet']);
$tweet = new Tweet();
$tweet->setUserId($_SESSION['id']);
$tweet->setText($tweet);
$tweet->setCreationDate($date);
$tweet->saveToDB($conn);
} 


