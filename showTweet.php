<?php

include_once 'src/User.php';
include_once 'src/config.php';
include_once 'src/Tweet.php';
include_once 'src/Comment.php';
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id'])) {
    $username = $_SESSION['username'];
    $userId = $_SESSION['id'];
    echo "Twoje wpisy i komentarze, $username<hr>";
    //var_dump($_SESSION);
}
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['tweetId'])) {
    $tweetId = $_GET['tweetId'];

    $commTweet = Tweet::loadTweetById($conn, $tweetId);
    $comments = Comment::allTweetComments($conn, $tweetId);
    //Tweet::loadTweetById($conn, $_GET['tweetId']);

    echo "Napisane przex $username w dniu " . $commTweet->getCreationDate() . ":<br>";
    echo "<h1>" . $commTweet->getText() . "</h1><br><hr>";
    if ($comments) {
        foreach ($comments as $comment) {
            $commenter = User::loadUserById($conn, $comment->getUserId());
            echo "<h3>" . $comment->getText() . "</h3>";
            echo "<p>Skomentowane przez " . $commenter->getUsername() . " w dniu " . $comment->getCreationDate() . "<br>";
        }
    } else {
        echo "Brak komentarzy!";
    }
}
$date = gmdate("Y-m-d");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['comment']) && !empty($_POST['comment'])) {
        $newComment = new Comment();
        $newComment->setUserId($userId);
        $newComment->setText($_POST['comment']);
        $newComment->setCreationDate($date);
        $newComment->setTweetId($tweetId);
        $newComment->saveToDB($conn);
    } else {
        echo "Skomentuj coś!";
    }
}
/*
$tweet = new Tweet();
$tweet->loadTweetById($conn, $tweetId);
*/
//var_dump($_GET);

