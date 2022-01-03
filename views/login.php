<html>
    <head>
        <title>
            Login
        </title>
            <!-- Compiled and minified CSS -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    </head>
    <body>
        <div class="container">
            <h4 class="">Login</h4>
            <br />

            <?php
              if (@$_GET['action']=='success'){
                echo 
                '<div class="row">
                    <div class="col s12 m6">
                    <div class="card blue-grey green accent-2">
                        <div class="card-content white-text">
                        <span class="card-title">Sucessfully registered</span>
                        </div>
                    </div>
                    </div>
                </div>';
              }
            ?>
            
            <div class="row">
            
                <form action="../index.php" method="post" class="col s12">
                    <div class="row">
                        <div class="input-field col s3">
                            <input id="email" type="email" name="login_email" class="validate">
                            <label for="email">Email</label>
                        </div>
                        
                        <div class="input-field col s3">
                            <input id="password" type="password" name="login_password" class="validate">
                            <label for="password">Password</label>
                        </div>
                        
                    </div> 

                    <?php

                    if (@$_GET['action']=='failure'){
                        echo 
                        '<div class="row">
                            <div class="col s12 m6">
                            <div class="card blue-grey red accent-3">
                                <div class="card-content white-text">
                                <span class="card-title">Login failed!</span>
                                <p>Wrong email or password.</p>
                                </div>
                            </div>
                            </div>
                        </div>';
                    }

                    ?>

                    <button class="waves-effect waves-light btn pulse" type="submit" name="action">Login</button>
                    <br />
                    <br />
                    <div class="divider"> </div>
                    <br />
                    <a href="register.php">Don't have an account yet? Register here!</a>
                </form>

            </div>
        </div>
    </body>
</html>