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
        if($_SERVER['REQUEST_METHOD'] === 'GET') {
            $sender = "sender_id";
            $receiver = "receiver_id";
            if(isset($_GET['messageType']) && !empty($_GET['messageType'])) {
                switch($_GET['messageType']) {
                    case "sent":
                        $result = Message::getAllMessages($conn, $sender, $_SESSION['loggedUserId']);
                        echo "<h3>Your sent messages</h3>";
                        if(count($result) > 0) {
                            echo "<table class='table'>";
                            echo "<th>Message text</th><th>Receiver</th><th>Date</th><th>Read</th>";
                            foreach($result as $row) {
                                $message = $row->getMessageText();
                                $id = $row->getId();
                                $loginId = $row->getReceiverId();
                                $login = getUserLogin($conn, $loginId);
                                $date = $row->getDate();
                                echo "<tr><td>".substr($message,0,30)."...</td>
                                          <td>$login</td>
                                          <td>$date</td>
                                          <td><a href='readMessage.php?messageId=$id'>Read</a></td></tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "<p>Empty</p>";
                        }
                        break;
                    case "received":
                        $result = Message::getAllMessages($conn, $receiver, $_SESSION['loggedUserId']);
                        echo "<h3>Your received messages</h3>";
                        if(count($result) > 0) {
                            echo "<table class='table'>";
                            echo "<th>Message text</th><th>Sender</th><th>Date</th><th>Is read?</th><th>Read</th>";
                            foreach($result as $row) {
                                $message = $row->getMessageText();
                                $id = $row->getId();
                                $loginId = $row->getSenderId();
                                $login = getUserLogin($conn, $loginId);
                                $date = $row->getDate();
                                $is_read = $row->checkMessage();
                                echo "<tr><td>".substr($message,0,30)."...</td>
                                          <td>$login</td>
                                          <td>$date</td>
                                          <td>$is_read</td>
                                          <td><a href='readMessage.php?messageId=$id'>Read</a></td></tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "<p>Empty</p>";
                        }
                        break;
                }
            }
        }
        $conn->close();
        $conn = null;
        ?>
            <a href="showMessages.php?messageType=received"><button class="btn btn-primary">Show Received Messages</button></a>
            <a href="showMessages.php?messageType=sent"><button class="btn btn-primary">Show Sent Messages</button></a>

        </div>
    </div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>

</body>
</html>

