<html>
    <head>
        <title>
            Logging out
        </title>
            <!-- Compiled and minified CSS -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    </head>
    <body>
        <div class="container">

            <?php
            session_start();

            if (@$_GET['delete']=='yes'){
                echo " You deleted your account!! ";
                echo "<h4> Goodbye !</h4>";
                session_destroy();
                header('Refresh: 2; url=../index.php');
                exit;
            }

            echo "<h4> Goodbye !</h4>";
            echo "<p>See you again soon!</p>";
            session_destroy();
            header('Refresh: 2; url=../index.php');
            ?>
            <br />
            </div>
        </div>
    </body>
</html>