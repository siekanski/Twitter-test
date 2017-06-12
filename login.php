<?php

require_once __DIR__."/src/connection.php";
require_once __DIR__."/src/functions.php";
require_once __DIR__."/src/header.php";
?>
<div class="container">
    <div class="row">
        <div class="UserInfo">

            <?php
            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                $loggedUser = User::LogIN($conn, $_POST['login'], $_POST['password']);
                if($loggedUser != null) {
                    $_SESSION['loggedUserId'] = $loggedUser->getId();
                    header("Location: index.php");
                } else {
                    echo "Nie udalo sie zalogowac";
                }
            }
            $conn->close();
            $conn = null;
            ?>
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <form action="#" method="post">
                        <div class="form-group>"
                        <label>Login: <input class="form-control" type="text" name="login" placeholder="Login"></label></div>
                        <div class="form-group>"
                        <label>Password: <input class="form-control" type="password" name="password"></label></div><br>
                        <button class="btn btn-primary" type="submit">Login</button>
                    </form>
                </div>
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