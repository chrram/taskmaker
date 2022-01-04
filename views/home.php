<?php

session_start();

//IF THE USER IS NOT LOGGED IN, BUT TRYING TO ACCESS THE SITE.
if (empty($_SESSION['user']))
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
         
        <?php
            require "./components/navbar.php";
        ?>

        <div class="container">
            <h4 class="">What do you want to accomplish?</h4>
            <br />
            <?php
                echo "Welcome user: ".$_SESSION['user']['email'];
            ?>
            <br />
            <a href="createTask.php"class="btn modal-trigger blue darken-1">Create task</a>
            <div id="tasks">
                <p>Total tasks:</p>
                <p>In progress:</p>
                <p>Deleted tasks:</p>
                <p>Completed tasks:</p>
            <div>

        </div>

        <script>
            (() => {

                const getTasks = () => {
                    const xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        console.log(this.readyState, this.status, "ready state")

                        if(this.readyState <= 4){
                            //Todo: Improve this and make it clearer.
                            document.getElementById("tasks").innerHTML = "<h4 style='font-weight:bold;'>Loading...</h4>";
                        }

                        if (this.readyState == 4 && this.status == 200) {   
                            document.getElementById("tasks").innerHTML = this.responseText;

                            var elems = document.querySelectorAll('.collapsible');
                            var instances = M.Collapsible.init(elems);

                        }

                        else if (this.readyState == 4 && this.status == 500) {
                            //Todo: Improve this and make it clearer.
                            document.getElementById("tasks").innerHTML = "<h4 id='header' style='font-weight:bold;color:red;'>DATABASE FAILURE, CONTACT ADMIN</h4>";
                        }

                    }
                    xmlhttp.open("GET", "../index.php?getTasks=all", true);
                    xmlhttp.send();
                }


                document.addEventListener('DOMContentLoaded', function() {
                    getTasks();
                });
                    
            })();
        </script>

    </body>
</html>