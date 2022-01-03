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
            <h4>Register</h4>
            <br />
            <div class="row">
                
                <form method="post" action="../index.php" class="col s12">
                    <div class="row">
                        <div class="input-field col s3">
                            <input id="email" type="email" name="register_email" class="validate">
                            <label for="email">Email</label>
                        </div>
                        
                        <div class="input-field col s3">
                            <input id="password" type="password" name="register_password" class="validate">
                            <label for="password">Password</label>
                        </div>
                    </div>

                    <?php
                    session_start();

                    if (@$_GET['action']=='failure'){
                        
                        if(isset($_SESSION["registrationError"])) {
                            $registrationError = $_SESSION['registrationError'];
                            unset($_SESSION['registrationError']);
                        } else {
                            $registrationError = "";
                        }

                        echo 
                        '<div class="row">
                            <div class="col s12 m6">
                                <div class="card blue-grey red accent-3">
                                    <div class="card-content white-text">
                                        <span class="card-title">Database error</span>
                                        <p>'.$registrationError.'</p>
                                    </div>
                                </div>
                            </div>
                        </div>';
                        
                    }
                    ?>
            

                    <button class="waves-effect waves-light btn pulse blue darken-1" type="submit" name="action"> Register </button>
                    <br />
                    <br />
                    <div class="divider"> </div>
                    <br />
                    <a href="login.php">Already have an account? Login!</a>
                </form>

            </div>
        </div>
    </body>
</html>