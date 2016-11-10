<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
    
    <link href="<?php echo ASSETS;?>codemirror/codemirror.css" rel="stylesheet" type="text/css">
    <link href="<?php echo ASSETS;?>codemirror/theme/ambiance.css" rel="stylesheet" type="text/css">
    <script src="<?php echo ASSETS;?>js/jquery.js"></script>
    <script src="<?php echo ASSETS;?>js/phaser.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <style>
        a[side-button]{
            cursor: pointer;
            text-decoration: none;
        }
        
        .header-page{
            margin: 0px 0px 0px 0px;
            padding-top: 28px;
            padding-left: 150px;
            color: white;
            font-weight: bold;
        }
        
        header.carousel{
            height: 100%;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index:0;
        }
        
        div[console]{
            background-color: #333;
            color: ghostwhite;
            width: 100%;
            height: 400px;
            border: none;
            resize: none;
            overflow-y: scroll;
        }
        
        .glyphicon-star, .glyphicon-ok-sign{
            color: yellow;
        }
        
        .glyphicon-remove-sign{
            color: red;
        }
        
        span.label{
            text-align: center;
            margin-right: 10px;
        }
        
        .container{
            z-index:1;
        }
        
        .phaser-heading{
            background-color: dimgrey;
            color: ghostwhite;
        }
        
        .phaser-body{
            background-color: #333;
            color: ghostwhite;
            height: 480px;
        }
    </style>

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
                        <a href="about.html">Tutorial</a>
                    </li>
                    <li>
                        <a href="<?php echo BASE;?>dashboard">Dashboard</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    
<!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-offset-4 col-lg-4">
                <center>
                    <h1><?php echo $data['message'];?></h1>
                </center>
            </div>
        </div>        
    </div>
    
           <!-- Footer -->
    <footer>
        <div class="bordering" style="background-color: #4e565e"></div>
        <div class="row">
            <div class="col-lg-12">
                <p class="copy">Copyright &copy; Code Ballad 2014</p>
            </div>
        </div>
    </footer>
    
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo ASSETS;?>js/bootstrap.min.js"></script>
    <script src="<?php echo ASSETS;?>codemirror/codemirror.js"></script>
    
</body>
</html>