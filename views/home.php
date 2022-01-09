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
            <link rel="stylesheet" href="./css/stylesheet.css">
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

            <?php
                    if (@$_GET['action']=='failure'){
                        echo 
                        '<div class="row">
                            <div class="col s12 m6">
                                <div class="card blue-grey red accent-3">
                                    <div class="card-content white-text">
                                        <span class="card-title">Database error</span>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    }
            ?>
            <br />
            <br />
            <a href="createTask.php"class="btn pulse modal-trigger blue darken-1">Create task</a>

            <br /> 
            <br />
            <br />

            <div id="tasks">
                <p>Your tasks.<p>
            <div>

        </div>

        <script>
            (() => {

                const getTasks = () => {
                    const xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        console.log(this.readyState, this.status, "ready state")

                        if(this.readyState <= 4){

                            //LOADING CIRCLE
                            const loadingElement = `
                            <div class="center-align">
                                <div class="preloader-wrapper big active">
                                    <div class="spinner-layer spinner-blue-only">
                                        <div class="circle-clipper left">
                                            <div class="circle"></div>
                                        </div>
                                        <div class="gap-patch">
                                            <div class="circle"></div>
                                        </div>
                                        <div class="circle-clipper right">
                                            <div class="circle"></div>
                                        </div>
                                    </div>
                                </div>
                            <div>
                            `
                            //Todo: Improve this and make it clearer.
                            document.getElementById("tasks").innerHTML = loadingElement;
                        }

                        if (this.readyState == 4 && this.status == 200) {
                              
                            document.getElementById("tasks").innerHTML = this.responseText;

                            const el = document.querySelectorAll('.tabs');
                            const instance = M.Tabs.init(el);
                            const collapsibleElements = document.querySelectorAll('.collapsible');
                            const instances = M.Collapsible.init(collapsibleElements);

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