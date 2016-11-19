<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="google-signin-client_id" content="775836621108-lfm7lael8nlh5hq5v611jmqs9ub14jhh.apps.googleusercontent.com">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Code Ballad</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo ASSETS;?>css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo ASSETS;?>css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo ASSETS;?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="<?php echo ASSETS;?>css/main.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="https://apis.google.com/js/platform.js" async defer></script>
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Code Ballad</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="about.html">About</a>
                    </li>
                    <li>
                        <a href="about.html">Leaderboard</a>
                    </li>
                    <li>
                        <a href="about.html">Script Reference</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Header Carousel -->
    <header class="carousel slide">

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <div class="fill" style="background-image:url('<?php echo ASSETS;?>images/header.jpg');"></div>
            </div>
        </div>
    </header>

    <div class="bordering"></div>
    <!-- Page Content -->
    <div class="container">
        <!-- Marketing Icons Section -->
        <div class="row">
            <br>
            <div class="col-lg-8">
                <div class="col-md-12">
                    
                </div>
            </div>
            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading" id="panel-title">Login</div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <input id="user" type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon1">
                        </div>
                        <br><br>
                        <div class="col-md-12">
                            <input id="pass" type="password" class="form-control" placeholder="Password" aria-describedby="basic-addon1">
                        </div>
                        <br><br>
                        <div class="col-md-4">
                            <a class="btn btn-default btn-block" id="login">Login</a> 
                        </div>
                        <div class="col-md-2">
                            <p style="padding-top: 8px;"> or </p>
                        </div>
                        <div class="col-md-6">
                            <div class="g-signin2" data-onsuccess="onSignIn"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->

       <!-- Footer -->
    <footer>
        <div class="bordering" style="background-color: #4e565e"></div>
        <div class="row">
            <div class="col-lg-12">
                <p class="copy">Copyright &copy; Code Ballad 2014</p>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="<?php echo ASSETS;?>js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo ASSETS;?>js/bootstrap.min.js"></script>

    <script type="text/javascript">
        function onSignIn(googleUser) {
            var profile = googleUser.getBasicProfile();
            user = profile.getName();
            image = profile.getImageUrl();
            
            var login = $.post( 'main/Gsignin', { 
                user: user,
                image: image
            });
            
            login.done(function( data ) {
                data = JSON.parse(data);
                if(data == "noUser"){
                    panel.innerHTML = "Login : User account tidak ditemukan"
                }else if(data == "noPass"){
                    panel.innerHTML = "Login : Password salah"
                }else{
                    window.location = "dashboard";
                }
            });
        }
    </script>
    
    <script type="text/javascript">            
        $('#login').click(function () {
            user = document.getElementById("user").value;
            pass = document.getElementById("pass").value;
            panel = document.getElementById("panel-title");
            
            var login = $.post( 'main/verifyUser', { 
                user: user,
                pass: pass
            });
            
            login.done(function( data ) {
                data = JSON.parse(data);
                if(data == "noUser"){
                    panel.innerHTML = "Login : User account tidak ditemukan"
                }else if(data == "noPass"){
                    panel.innerHTML = "Login : Password salah"
                }else{
                    window.location = "dashboard";
                }
            });
        });
    </script>

</body>
</html>