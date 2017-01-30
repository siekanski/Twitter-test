<?php

session_start();
include_once 'src/User.php';
include_once 'src/config.php';
include_once 'src/Tweet.php';
include_once 'src/Comment.php';
if (isset($_SESSION['username'])) {
    echo "Witaj " . $_SESSION['username'];
}
if (isset($_POST['tweet']) && !empty($_POST['tweet'])) {
    $tweeting = $_POST['tweet'];
}
if (isset($_POST['tweet']) && !empty($_POST['tweet'])) {
    $userId = $_SESSION['id'];
    $date = gmdate("Y-m-d");
    $tweet = new Tweet();
    $tweet->setUserId($userId);
    $tweet->setText($tweeting);
    $tweet->setCreationDate($date);
    $tweet->saveToDB($conn);
    header("Location: main.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <div>
            <form method="POST">
                <textarea rows="10" cols="30" maxlength="140" 
                          placeholder="O czym teraz myślisz?" name="tweet"></textarea>
                <button type="submit">Tweet</button>
            </form>
        </div>
        <br>
        <div>
<?php
$list = Tweet::loadTweetsByUser($conn, $_SESSION['id']);
if ($list) {
    foreach ($list as $tweet) {
        $tweetId = $tweet->getId();
        echo "<h2>" . $tweet->getText() . "</h2>";
        echo "<p>Twoje wpisy " . $tweet->getCreationDate() .
        "</p><br>";
        echo "<a href=showTweet.php?tweetId=$tweetId>Pokaż komentarze</a><hr>";
    }
}
?>
        </div>
    </body>
</html>

