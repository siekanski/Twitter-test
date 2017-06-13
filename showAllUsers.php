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
        <div class="showUsers">
            <div class="col-lg-6">
        <?php
        $allUsers = User::GetAllUsers($conn);
        if(count($allUsers) > 0) {
            foreach($allUsers as $user) {
                echo "<div class='list-group'>
                        <a class='list-group-item active' href='showUser.php?idToShow={$user->getID()}'>
                        <h4 class='list-group-item-heading'>{$user->getLogin()}</h4>
                        <p class='list-group-item-text'>{$user->getDescription()}</p>
                        </a>
                    </div>";
            }
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

