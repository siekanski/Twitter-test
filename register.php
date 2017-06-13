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
            $userToRegister = new User();
            $userToRegister->setLogin($_POST['login']);
            $userToRegister->setHashedPassword($_POST['password1'], $_POST['password2']);
            $userToRegister->activate();
            $registerSucess = $userToRegister->saveToDB($conn);
            if($registerSucess) {
                $_SESSION['loggedUserId'] = $userToRegister->getId();
                header("Location: index.php");
            } else {
                echo "rejestracja sie nie powiodla";
            }
        }
        $conn->close();
        $conn = null;
        ?>
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <div class="MessageForm">
                    <form action="#" method="post">
                        <div class="form-group"><label>Login: <input class="form-control" type="text" name="login" placeholder="Login"></label></div>
                        <div class="form-group"><label>Password: <input class="form-control" type="password" name="password1"></label></div>
                        <div class="form-group"><label>Confirm Password: <input class="form-control" type="password" name="password2"></label></div>
                        <button class="btn btn-primary" type="submit">Register</button>
                    </form>
                    </div>
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

