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
            <h4 class="">Create task</h4>
            <br />

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
            
            <div class="row">
                <form method="post" action="../index.php" class="col s12">
                    <div class="row">
                        <div class="input-field col s6">
                            <i class="material-icons prefix">mode_edit</i>
                            <input id="input_text" type="text" data-length="10" name="task_title">
                            <label for="input_text">Task title</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">mode_edit</i>
                            <textarea id="icon_prefix2" class="materialize-textarea" name="task_description"></textarea>
                            <label for="textarea2">Description of the task</label>
                        </div>
                    </div>

                    <button class="waves-effect waves-light btn pulse blue darken-1" type="submit" name="action"> Create task </button>
                </form>
            </div>

        </div>

        <script>
        </script>
    </body>
</html>