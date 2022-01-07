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
            $sql = 'SELECT id, title, description, deleted, completed FROM tasks WHERE userId = (?)';
            $sql2 = 'select count(id) as active_tasks from tasks WHERE userId = (?) AND deleted != 1 AND completed != 1';
            $sql3 = 'select count(id) as deleted_tasks from tasks WHERE userId = (?) AND deleted';
            $sql4 = 'select count(id) as completed_tasks from tasks WHERE userId = (?) AND completed';

            $statement = $pdo->prepare($sql);
            $statement->execute([$_SESSION['user']['id']]);

            $statement2 = $pdo->prepare($sql2);
            $statement2->execute([$_SESSION['user']['id']]);

            $statement3 = $pdo->prepare($sql3);
            $statement3->execute([$_SESSION['user']['id']]);

            $statement4 = $pdo->prepare($sql4);
            $statement4->execute([$_SESSION['user']['id']]);
            
            $tasks = $statement->fetchAll();
            $amountOf = $statement2->fetch();
            $amountOfDeleted = $statement3->fetch();
            $amountOfCompleted = $statement4->fetch();

            $_SESSION['amount_active_tasks'] = $amountOf;
            $_SESSION['amount_deleted_tasks'] = $amountOfDeleted;
            $_SESSION['amount_completed_tasks'] = $amountOfCompleted;
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
                    
                    $_SESSION['user_tab'] = "active";
                } else {
                    // SHOULD BE DELETED FROM DATABASE
                    $sql = 'DELETE FROM tasks WHERE id = (?)';
                    $statement = $pdo->prepare($sql);
                    $statement->execute([$taskId]);

                    // TODO : TO PUT US ON THE RIGHT TAB, WHEN DELETING
                    $_SESSION['user_tab'] = "deleted";
                }
                return 200;
            }
        }
        catch (PDOException $error) {
            return 500;
        }

    }

    function completeTask($userId, $taskId){

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
                
                if($result['completed'] == 0){

                    $sql = 'UPDATE tasks SET completed = 1 WHERE id = (?)';
                    $statement = $pdo->prepare($sql);
                    $statement->execute([$taskId]);
                    
                    // $_SESSION['user_tab'] = "active";
                } else {

                    $sql = 'UPDATE tasks SET completed = 0 WHERE id = (?)';
                    $statement = $pdo->prepare($sql);
                    $statement->execute([$taskId]);

                    // TODO : TO PUT US ON THE RIGHT TAB, WHEN DELETING
                    // $_SESSION['user_tab'] = "deleted";
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