<?php

require_once __DIR__."/src/connection.php";
require_once __DIR__."/src/functions.php";
require_once __DIR__."/src/header.php";

if(isset($_SESSION['loggedUserId']) === false) {
    header("Location: login.php");
}
?>

<div class="container">
    <div class="row">
        <div class="tweetInfo">
            <?php
            if(isset($_GET['commentText']) && !empty($_GET['commentText'])) {
                $newComment = new Comment();
                $newComment->setUserId($_SESSION['loggedUserId']);
                $newComment->setPostId($_GET['tweetID']);
                $newComment->setText($_GET['commentText']);
                $newComment->setDate(date("Y-m-d-H-i-s"));
                $newComment->saveCommentToDB($conn);
                if(($newCommentSucces = $newComment->saveCommentToDB($conn))== true) {
                    header("Location: showTweet.php?tweetID={$_GET['tweetID']}");
                };
            }
            if(isset($_GET['tweetID']) && !empty($_GET['tweetID'])) {
                $tweet = new Tweet();
                $tweet->loadFromDB($conn, $_GET['tweetID']);
                $tweetText = $tweet->getpostText();
                $tweetAuthor = $tweet->getUserId();
                $tweetDate = $tweet->getDate();
                $userLogin = $user = getUserLogin($conn, $tweetAuthor);
                echo "<p class='tweetP'>".$tweetText."</p><br>";
                echo "<p class='tweetP'>Author: ".$userLogin."</p><br>";
                echo "<p class='tweetP'>Date: ".$tweetDate."</p>";
                echo "<p class='tweetP'>Comments:</p>";
                echo "<div class='commentsAll'>";
                $comment = new Comment();
                $comments = $comment->getAllComments($conn, $tweet->getId());
                if(!empty($comments)) {
                    foreach($comments as $row) {
                        $text = $row->getText();
                        $userId = $row->getUserId();
                        $login = getUserLogin($conn, $userId);
                        echo "<div class='comment'><p>Author: ". $login . "</p>";
                        echo "<p>" . $text . "</p></div>";
                    }
                    echo "</div>";
                } else {
                    echo "Brak komentarzy do wpisu <br>";
                }
                echo "<form action='showTweet.php?tweetID={$_GET['tweetID']}' class='form-group' method='get'>
                      <label><input type='text' class='form-control' name='commentText'></label><br>
                      <input type='hidden' class='form-control' name='tweetID' value='{$_GET['tweetID']}'>
                      <button type='submit' class='btn btn-default'>Comment</button>
                      </form>";
            }
            $conn->close();
            $conn = null;
            ?>
        </div>
    </div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>