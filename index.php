<?php

require_once __DIR__."/src/connection.php";
require_once __DIR__."/src/functions.php";
require_once __DIR__."/src/header.php";
?>

<div class="container">
    <?php
    if(isset($_SESSION['loggedUserId'])) {
        $loggedUser = new User();
        $loggedUser->loadFromDB($conn, $_SESSION['loggedUserId']);
        $userLogin  = getUserLogin($conn, $_SESSION['loggedUserId']);
        echo "<div class='jumbotron'>
              <h1>Hello $userLogin</h1>
              <p>Nice to see You again!</p>
              <br>
              </div>";
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST['postText'])) {
                $newTweet = new Tweet();
                $newTweet->setText($_POST['postText']);
                $newTweet->setUserId($_SESSION['loggedUserId']);
                $newTweet->setDate(date("Y-m-d-H-i-s"));
                if(($newTweetSucces = $newTweet->saveTweetToDB($conn))== true) {
                    header("Location: index.php");
                };
            }
        }
        $tweets = $loggedUser->loadAllTweetFromDB($conn);
        echo "<div class='row'><div class='col-lg-12'>";
        if(count($tweets) > 0) {
            displayAllTweets($conn, $tweets);
        } else {
            echo "Brak Tweetów";
        }
        echo "<form action='#' method='post'>";
        echo "<div class='form-group'><label>New Tweet: <input class='form-control' type='text' size='255' name='postText'></label></div>";
        echo "<button class='btn btn-primary' type='submit'>Tweet</button></form>";
    } else {
        echo "<div class='jumbotron'>
        <h1>Hello Stranger!</h1>
        <p>Join us!</p>
        <p><a class='btn btn-primary btn-lg' href='register.php' role='button'>Register</a></p>
        </div>";
    }
    $conn->close();
    $conn = null;
    ?>

</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>

