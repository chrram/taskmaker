<?php

    include "./model/functions.php";
    
    session_start();

    if(!empty($_POST["register_password"]) && !empty($_POST["register_email"])){

        $email = $_POST["register_email"];
        $pwd = $_POST["register_password"];
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        $result = register_user($email, $hashedPwd);
        switch($result){
            case 201:
                header("Location: views/login.php?action=success");
                break;
            default:
                header('Location: views/register.php?action=failure');
                break;
        }
        exit;
    }

    if(!empty($_POST["login_email"]) && !empty($_POST["login_password"])){

        $email = $_POST["login_email"];
        $pwd = $_POST["login_password"];
        $result = login($email, $pwd);

        switch($result){
            case 200:
                header('Refresh: 0');
                break;
            case 401:
                header('Location: views/login.php?action=failure');
                break;
            default:
                header('Location: views/login.php?action=failure');
                break;
        }
        exit;

    }

    if(empty($_SESSION['user_email'])) {
        header("Location: views/login.php");
    }
    else{
        echo "Logging you in!";
        header('Refresh: 2; url=./views/home.php');
        exit;
    }

?>