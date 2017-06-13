<?php

require_once __DIR__."/src/connection.php";
require_once __DIR__."/src/functions.php";
require_once __DIR__."/src/header.php";
if(isset($_SESSION['loggedUserId']) === false) {
    header("Location: login.php");
}
if($_SERVER['REQUEST_METHOD'] === 'GET') {
    if(isset($_GET['messageId']) && !empty($_GET['messageId'])) {
        $message = new Message();
        $message->loadMessageDB($conn, $_GET['messageId']);
        if($message->getReceiverId() == $_SESSION['loggedUserId']) {
            $message->setIsRead();
            $result = $message->saveMessageToDB($conn);
        } else {
            echo "Error";
        }
    }
}
?>

<div class="container">
    <div class="row">
        <div class="UserInfo">
            <div id='message' class="col-lg-offset-3 col-lg-6">
                <?php
                if($message) {
                    $loginId = $message->getSenderId();
                    $login = getUserLogin($conn, $loginId);
                    $text = $message->getMessageText();
                    $date = $message->getDate();
                    echo "<h3>Message author:  $login</h3>
                      <h4>Message date: $date</h4>
                      <h4>Message text:</h4>
                      <p>$text</p>";
                }
                $conn->close();
                $conn = null;
                ?>
            </div>
        </div>
    </div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>

</body>
</html>

