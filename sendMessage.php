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
            echo "<div class='MessageForm'>
                    <div class='row'>
                        <h3>Send Message:</h3>
                        <div class='col-lg-offset-3 col-lg-6'>
                            <form action='sendMessage.php?UserId={$_GET['UserId']}' class='form-group' method='post'>
                                <label>Your Message: <textarea name=messageText class='form-control' rows='5' cols='20' maxlength='255'></textarea></label><br>
                                <button type='submit' class='btn btn-success'>Send</button>
                            </form>
                        </div>
                    </div>
                  </div>";
            if(isset($_POST['messageText']) && !empty($_POST['messageText'])) {
                $newMessage = new Message();
                $newMessage->setSenderId($_SESSION['loggedUserId']);
                if($_GET['UserId'] != $_SESSION['loggedUserId']) {
                    $newMessage->setReceiverId($_GET['UserId']);
                    $newMessage->setMessageText($_POST['messageText']);
                    $newMessage->setDate(date("Y-m-d-H-i-s"));
                } else {
                    echo "<h2>Seriously?</h2>";
                }
                $newMessageSucces = $newMessage->saveMessageToDB($conn);
                if($newMessageSucces == true) {
                    echo "<h2>Message success!</h2>";
                } else {
                    echo "<h2>Message error!</h2>";
                }
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

