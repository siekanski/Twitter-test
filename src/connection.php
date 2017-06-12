<?php

session_start();
require_once __DIR__."/User.php";
require_once __DIR__."/Tweet.php";
require_once __DIR__."/Comment.php";
require_once __DIR__."/Message.php";

$db_host = 'localhost';
$db_user = 'root';
$db_password = 'coderslab';
$db_name = 'Tweeter';

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);
$conn->set_charset("utf8");

if($conn->connect_error != 0) {
    die("Blad polaczenia do bazy danych: $conn->connect_error");
}

