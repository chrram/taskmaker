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
                    <div class="card blue-grey darken-1">
                        <div class="card-content white-text">
                        <span class="card-title">Card Title</span>
                        <p>Sucessfully registered</p>
                        </div>
                    </div>
                    </div>
                </div>';
              }
            ?>
            
            <div class="row">
            
                <form class="col s12">
                    <div class="row">
                        <div class="input-field col s3">
                            <input id="email" type="email" class="validate">
                            <label for="email">Email</label>
                        </div>
                        
                        <div class="input-field col s3">
                            <input id="password" type="password" class="validate">
                            <label for="password">Password</label>
                        </div>
                        
                    </div>

                    <a class="waves-effect waves-light btn pulse" type="submit" name="action">Login</a>
                    <br />
                    <br />
                    <div class="divider"> </div>
                    <br />
                    <a href="register.html">Don't have an account yet? Register here!</a>
                </form>

            </div>
        </div>
    </body>
</html>