<?php

    $pdo = require('database.php');

    function login($email, $pwd){

        global $pdo;
        //DB QUERY FOR LOGIN
        try{
            $sql = 'SELECT * FROM users WHERE (email) = (?)';
            $statement = $pdo->prepare($sql);
            $statement->execute([$email]);
            $user = $statement->fetch();
            
            //COMPARING THE PASSWORDS
            if(password_verify($pwd, $user['password'])){
                $_SESSION['user_email'] = $user['email'];
                return 200;
            }
            return 401;
        }
        catch (PDOException $error) {
            //TODO: DISPLAY INTERNAL SERVER ERROR
            return 500;
        }
    }

    function register_user($email, $hashedPwd) {

        global $pdo;
        // DB QUERY FOR REGISTRERING USER
        try{
            $sql = 'INSERT INTO  users (email, password) VALUES (?,?)';
            $statement = $pdo->prepare($sql);
            $statement->execute([$email, $hashedPwd]);
            return 201;
            
        }
        catch (PDOException $error) {
            // REGISTRATION ERROR 
            $_SESSION['registrationError'] = $error->getMessage();
            return 500;
        }
    }
?>