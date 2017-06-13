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
        <div class="UserInfo">

        <?php
        if(isset($_POST['newDescription']) && !empty($_POST['newDescription'])) {
            $userToUpdate = new User();
            $userToUpdate->loadFromDB($conn, $_SESSION['loggedUserId']);
            $userToUpdate->setDescription($_POST['newDescription']);
            $userToUpdate->saveToDB($conn);
        }
        if((isset($_POST['password1']) && !empty($_POST['password1'])) && $_POST['password1'] === $_POST['password2'] ) {
            $userToUpdate = new User();
            $userToUpdate->loadFromDB($conn, $_SESSION['loggedUserId']);
            $userToUpdate->setHashedPassword($_POST['password1'], $_POST['password2']);
            $userToUpdate->saveToDB($conn);
        }
        if(isset($_GET['idToShow']) && ($_GET['idToShow'] != $_SESSION['loggedUserId'])) {
            $userToShow = new User();
            $userToShow->loadFromDB($conn, $_GET['idToShow']);
            $userLogin = getUserLogin($conn, $_GET['idToShow']);
            echo "<h3>User $userLogin info page</h3>";
            echo "<h4>$userLogin tweets:</h4>";
            $tweets = $userToShow->loadAllTweetFromDB($conn);
            if(count($tweets) > 0) {
                displayAllTweets($conn, $tweets);
            } else {
                echo "<h5>Brak Tweetów</h5>";
            }
            echo "<a href='sendMessage.php?UserId={$_GET['idToShow']}'><button class='btn btn-primary'>Send Message</button></a>";
        } else {
            $userToShow = new User();
            $userToShow->loadFromDB($conn, $_SESSION['loggedUserId']);
        }
        if($userToShow->getId() != -1) {
            if($userToShow->getId() == $_SESSION['loggedUserId']) {
                echo "<h2>Edit your data</h2>";
                echo "<form action='showUser.php?idToShow={$_GET['idToShow']}' method='post'>";
                echo "<div class='form-group'>";
                echo "<label>Description: <input class='form-control' type='text' name='newDescription'></label></div>";
                echo "<div class='form-group'>";
                echo "<label>New Password<input class='form-control' type='text' name='password1'></label></div>";
                echo "<div class='form-group'>";
                echo "<label>Confirm new password<input class='form-control' type='text' name='password2'></label></div>";
                echo "<button type='submit' class='btn btn-success'>Update</button>";
                echo "</form>";
            }
        } else {
            echo "Nie ma takiego User'a";
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

