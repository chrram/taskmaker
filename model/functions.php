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
                $_SESSION['user'] = $user;
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

    function delete_user() {
        
        global $pdo;

        try{
            $sql = 'DELETE FROM users WHERE email = (?)';
            $statement = $pdo->prepare($sql);
            $statement->execute([$_SESSION['user']['email']]);
            return 200;
            
        }
        catch (PDOException $error) {
            return 500;
        }
    }

    function getUserTasks() {
        
        global $pdo;

        try{
            $sql = 'SELECT * FROM tasks WHERE userId = (?)';
            $statement = $pdo->prepare($sql);
            $statement->execute([$_SESSION['user']['id']]);
            $tasks = $statement->fetchAll();

            $_SESSION['user_tasks'] = $tasks;
            return 200;
        }
        catch (PDOException $error) {
            return 500;
        }
    }

    function deleteTask($userId, $taskId){

        global $pdo;

        try{
            $sql = 'SELECT * FROM tasks WHERE userId = (?) AND id = (?)';
            $statement = $pdo->prepare($sql);
            $statement->execute([$userId, $taskId]);

            $result = $statement->fetch();
            
            //IF THE RESULT IS EMPTY
            if(empty($result)) {
                return 500;
            }
            else {
                
                if($result['deleted'] == 0){
                    //SHOULD BE UPDATED TO 1
                    $sql = 'UPDATE tasks SET deleted = 1 WHERE id = (?)';
                    $statement = $pdo->prepare($sql);
                    $statement->execute([$taskId]);

                } else {
                    // SHOULD BE DELETED FROM DATABASE
                    $sql = 'DELETE FROM tasks WHERE id = (?)';
                    $statement = $pdo->prepare($sql);
                    $statement->execute([$taskId]);
                }
                return 200;
            }
        }
        catch (PDOException $error) {
            return 500;
        }

    }

    function createTask($userId, $title, $description) {
        
        global $pdo;
        try{
            $sql = 'INSERT INTO tasks (userId, title, description) VALUES (?,?,?)';
            $statement = $pdo->prepare($sql);
            $statement->execute([$userId, $title, $description]);
            return 201;
        }
        catch (PDOException $error) {
            return 500;
        }
    }

?>