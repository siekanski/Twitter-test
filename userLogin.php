<?php

session_start();
include_once 'src/User.php';
include_once 'src/config.php';
include_once 'src/Tweet.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM Users WHERE email = '$email';";
    $result = $conn->query($sql);
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
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tweet</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <div>
            <form method="POST" action="#">
                <textarea rows="10" cols="30" maxlength="140" 
                          placeholder="O czym teraz myślisz ?" name="tweet">
                </textarea>
                <button type="submit">Tweet</button>
            </form>
        </div>
        <div>
        </div>
    </body>
</html>

