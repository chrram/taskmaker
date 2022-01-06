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
            <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script> -->
    </head>
    <body>
         
        <?php
            require "./components/navbar.php";
        ?>

        <div class="container">
            <h4 id="header">Options</h4>
            <br />

            
            <p>User information</p>
            <p>Account email: <?php echo $_SESSION['user']['email']; ?> </p>
            <p>Account created at: <?php echo $_SESSION['user']['created_at']; ?> </p>
            <button data-target="modal1" class="btn modal-trigger red accent-3">Delete account</button>
            </div>
        </div>

        <!-- Modal Structure -->
        <div id="modal1" class="modal">
            <div class="modal-content">
                <h4>Deletion of account</h4>
                <p>Are you sure you want to delete your account?</p>
            </div>
            <div class="modal-footer">
                <button id="confirmDelete" class="modal-close waves-effect waves-green btn-flat">Yes</button>
                <a href="#!" class="modal-close waves-effect waves-green btn-flat">No</a>
            </div>
        </div>
        
        <script>
            (() => {

                const deleteAccount = () => {
                    const xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                    console.log(this.readyState, this.status, "ready state")

                    if(this.readyState <= 4){
                        //Todo: Improve this and make it clearer.
                        document.getElementById("header").innerHTML = "<h4 style='font-weight:bold;'>Loading...</h4>";
                    }

                    if (this.readyState == 4 && this.status == 200) {   
                        window.location.href = "logout.php?delete=yes";
                    }

                    else if (this.readyState == 4 && this.status == 500) {
                        //Todo: Improve this and make it clearer.
                        document.getElementById("header").innerHTML = "<h4 id='header' style='font-weight:bold;color:red;'>DATABASE FAILURE, CONTACT ADMIN</h4>";
                    }

                    }
                    const vars = "delete_account=true";
                    xmlhttp.open("POST", "../index.php", true);
                    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xmlhttp.send(vars);
                }

                document.addEventListener('DOMContentLoaded', function() {

                    var elems = document.querySelectorAll('.modal');
                    var instances = M.Modal.init(elems);

                    document.getElementById('confirmDelete').onclick = () => {
                        deleteAccount();
                    }

                });

            })();
        </script>
    </body>
</html>