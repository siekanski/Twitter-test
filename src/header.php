<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/main.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" media="all" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700&subset=latin,latin-ext">

</head>
<body>
<header id="menu" class="navbar-fixed-top">
    <div class="row">
        <div class="col-xs-12 col-sm-10 col-md-12 col-lg-12">
            <nav class="navbar navbar-default" role="navigation" id="pasek_nawi">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#moje-menu">
                            <span class="sr-only">Navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <div id="logo">
                            <a class="navbar-brand ptak" href="index.php">
                                <img src="img/twitter-logo.png" class="img-circle" width="50" height="45">
                            </a>
                        </div>
                    </div>
                    <div class="collapse navbar-collapse" id="moje-menu">
                        <ul class="nav navbar-nav navbar-right" id="ul_nawigacja">
                            <li class=""><a href="index.php">Main</a></li>
                            <?php
                            if(isset($_SESSION['loggedUserId'])) {
                                $result = Message::getNewMessages($conn, $_SESSION['loggedUserId']);
                                if($result > 0) {
                                    $messageCounter = "<span class='badge'>$result</span>Messages";
                                } else {
                                    $messageCounter = "Messages";
                                }
                                echo "<li><a href=\"showAllUsers.php\">Users</a></li> ";
                                echo "<li><a href=\"showMessages.php\">$messageCounter</a></li> ";
                                echo "<li><a href=\"logout.php\">LogOut</a></li>";
                            } else {
                                echo "<li><a href=\"login.php\">Login</a></li>
                                      <li><a href=\"register.php\">Register</a></li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>

    </div>
</header>



