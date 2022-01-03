<?php

    $pdo = require('./model/database.php');
    session_start();

    if(!empty($_POST["register_password"]) && !empty($_POST["register_email"])){

        $email = $_POST["register_email"];
        $pwd = $_POST["register_password"];
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        // DB QUERY FOR REGISTRERING USER
        try{
            $sql = 'INSERT INTO  users (email, password) VALUES (?,?)';
            $statement = $pdo->prepare($sql);
            $statement->execute([$email, $hashedPwd]);

            header("Location: views/login.php?action=success");
            exit;
        }
        catch (PDOException $error) {
            
            // REGISTRATION ERROR 
            $_SESSION['registrationError'] = $error->getMessage();
            header('Location: views/register.php?action=failure');
            exit;
        }           
    }

    if(!empty($_POST["login_email"]) && !empty($_POST["login_password"])){

        $email = $_POST["login_email"];
        $pwd = $_POST["login_password"];

        //DB QUERY FOR LOGIN
        try{
            $sql = 'SELECT * FROM users WHERE (email) = (?)';
            $statement = $pdo->prepare($sql);
            $statement->execute([$email]);
            $user = $statement->fetch();
            
            //COMPARING THE PASSWORDS
            if(password_verify($pwd, $user['password'])){
                echo "Logged in!";
                exit;
            }
            header('Location: views/login.php?action=failure');
            exit;
        }
        catch (PDOException $error) {
            header('Location: views/login.php?action=failure');
            exit;
        }    
    }

    if(empty($_SESSION['loggedin'])) {
        header("Location: views/login.php");
    }

?>