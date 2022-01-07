<?php

    include "./model/functions.php";
    
    session_start();
    
    //REGISTRATION OF AN ACCOUNT
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

    //LOGIN OF AN ACCOUNT
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

    if(!empty($_POST['task_title']) && !empty($_POST['task_description'])){
        
        //NEEDS TO BE SANITIZED & TESTED
        $userId = $_SESSION['user']['id'];
        $title = htmlspecialchars($_POST['task_title'], ENT_QUOTES);
        $description = htmlspecialchars($_POST['task_description'], ENT_QUOTES);
        
        $result = createTask($userId, $title, $description);
        switch($result){
            case 201:
                header("HTTP/1.1 201 OK");
                header('Refresh: 0; url=./views/home.php');
                break;
            default:
                header("HTTP/1.1 500 OK");
                header('Refresh: 0; url=./views/createTask.php?action=failure');
                break;
        }
        exit;
    }

    // DELETION OF A USER ACCOUNT
    if(!empty($_POST['delete_account'])){

        $result = delete_user();
        switch($result){
            case 200:
                header("HTTP/1.1 200 OK");
                break;
            default:
                header("HTTP/1.1 500 OK");
                break;
        }
        exit;
    }


    // THIS ONE NEEDS TO BE TESTED EXTENSIVLY
    if(!empty($_POST['delete_task'])){

        $userId = $_SESSION['user']['id'];
        //NEEDS TO BE FURTHER CHECKED
        $task = htmlspecialchars($_POST['delete_task'], ENT_QUOTES);

        $result = deleteTask($userId, $task);
        switch($result){
            case 200:
                header("HTTP/1.1 200 OK");
                header('Refresh: 0; url=./views/home.php');
                break;
            default:
                header("HTTP/1.1 500 OK");
                header('Refresh: 0; url=./views/home.php?action=failure');
                break;
        }
        exit;
    }

    if(!empty($_POST['complete_task'])){
        $userId = $_SESSION['user']['id'];
        //NEEDS TO BE FURTHER CHECKED
        $task = htmlspecialchars($_POST['complete_task'], ENT_QUOTES);

        $result = completeTask($userId, $task);
        switch($result){
            case 200:
                header("HTTP/1.1 200 OK");
                header('Refresh: 0; url=./views/home.php');
                break;
            default:
                header("HTTP/1.1 500 OK");
                header('Refresh: 0; url=./views/home.php?action=failure');
                break;
        }
        exit;
    }

    if(!empty($_GET['getTasks'])){
        
        $result = getUserTasks();
        switch($result){
            case 200:
                header("HTTP/1.1 200 OK");
                include "./views/components/tasks.php";
                break;
            default:
                header("HTTP/1.1 500 OK");
                break;
        }
        exit;
    }

    //IF WE ARE NOT LOGGED IN
    if(empty($_SESSION['user'])) {
        header("Location: views/login.php");
    }
    else{
        header('Refresh: 0; url=./views/home.php');
        exit;
    }

?>