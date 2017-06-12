<?php

function getUserLogin(mysqli $conn, $id) {
    $user = new User();
    $user->loadFromDB($conn, $id);
    $login = $user->getLogin();
    if($login == true) {
        return $login;
    }
    return false;
}
function displayAllTweets(mysqli $conn, $tweets) {
    $count = 0;
    foreach ($tweets as $tweet) {
        $heading = "heading". $count;
        $collapse = "collapse". $count;
        echo "<div class='panel-group' id='accordion' role='tablist' aria-multiselectable='true'>
                <div class='panel panel-default'>
                <div class='panel-heading' role='tab' id='$heading'>
                <h4 class='panel-title'>
                <a role='button' data-toggle='collapse' data-parent='#accordion' href='#$collapse' aria-expanded='true' aria-controls='$collapse'>";
        echo '<div class="tweet">';
        $text = $tweet->showTweet();
        echo "<p>".$text."</p>";
        echo '</div>';
        echo "</a></h4></div>
                  <div id='$collapse' class='panel-collapse collapse' role='tabpanel' aria-labelledby='$heading'>
                  <div class='panel-body'>";
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
        } else {
            echo "Brak komentarzy do wpisu <br>";
        }
        echo "<a href=showTweet.php?tweetID={$tweet->getId()}> More / Comment</a>
                  </div>
                  </div>
                  </div>
                  </div>";
        $count++;
    }
}

