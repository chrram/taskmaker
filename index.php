<?php
    session_start();

    if(!empty($_POST["register_password"]) && !empty($_POST["register_email"])){

        $email = $_POST["register_email"];
        $pwd = $_POST["register_password"];
        
        header("Location: views/login.php?action=success");
        exit;
    }

    if(empty($_SESSION['loggedin'])) {
        header("Location: views/login.php");
    }

?>