<?php

session_start();

//IF THE USER IS NOT LOGGED IN, BUT TRYING TO ACCESS THE SITE.
if (empty($_SESSION['user_email']))
{
    echo "Not logged in";
    header('Refresh: 1; url=../index.php');
    exit;
}

?>
<html>
    <head>
        <title>
            Taskmanager
        </title>
            <!-- Compiled and minified CSS -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>
    <body>
         
        <nav>
            <div class="nav-wrapper blue darken-1">
            <a href="#!" class="brand-logo">Taskmaker</a>
            <ul class="right hide-on-med-and-down">
                <li><a href="options.php">Account Options</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
            </div>
        </nav>

        <div class="container">
            <h4 class="">What do you want to accomplish?</h4>
            <br />
            <?php
                echo "Welcome user: ".$_SESSION['user_email'];
            ?>
            <p>Total tasks:</p>
            <p>In progress:</p>
            <p>Deleted tasks:</p>
            <p>Completed tasks:</p>
            </div>
        </div>
    </body>
</html>