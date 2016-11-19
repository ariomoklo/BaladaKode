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
    <script src="<?php echo ASSETS;?>js/scriptHandler.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <style>        
        body{
            overflow-y: scroll;
        }
        
        .header-page{
            margin: 0px 0px 0px 0px;
            padding-top: 28px;
            padding-left: 150px;
            color: white;
            font-weight: bold;
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
                        <a href="../dashboard">Dashboard</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    
        <!-- Header Carousel -->
    <header class="carousel slide" style="height: 15%">
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <div class="fill" style="background-image:url('<?php echo ASSETS;?>images/dashboard.jpg');">
                    <h2 class="header-page">Leaderboard</h2>
                </div>
            </div>
        </div>
    </header>
    
    <div class="bordering"></div>
<!-- Header -->

<!-- Page Content -->
    <div class="container">
        <!-- Marketing Icons Section -->
        <div class="row"><br>
            <div class="col-lg-12">
                <div class="col-lg-4">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">The Fighting Master</h3>
                        </div>
                        <table class="table">
                            <thead style="background-color: ghostwhite;">
                                <td><b>#</b></td>
                                <td><b>Username</b></td>
                                <td><b>EXP</b></td>
                            </thead>
                            <tbody>

                                <?php foreach($data['mast'] as $rank => $value){
                                    echo '<tr><td>'.($rank+1).'</td><td>'.$value['username'].'</td><td>'.$value['exp'].'</td>
                                    </tr>';
                                }?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">The Fame Fighter</h3>
                        </div>
                        <table class="table">
                            <thead style="background-color: ghostwhite;">
                                <td><b>#</b></td>
                                <td><b>Username</b></td>
                                <td><b>REP</b></td>
                            </thead>
                            <tbody>

                                <?php foreach($data['fame'] as $rank => $value){
                                    echo '<tr><td>'.($rank+1).'</td><td>'.$value['username'].'</td><td>'.$value['reputation'].'</td>
                                    </tr>';
                                }?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">The Champion</h3>
                        </div>
                        <table class="table">
                            <thead style="background-color: ghostwhite;">
                                <td><b>#</b></td>
                                <td><b>Username</b></td>
                                <td style="text-align: center;"><b>Perfect Battle</b></td>
                            </thead>
                            <tbody>

                                <?php if($data['cham']){
                                        foreach($data['cham'] as $rank => $value){
                                            echo '<tr><td>'.($rank+1).'</td><td>'.$value['username'].'</td><td>'.$value['match'].'</td>
                                            </tr>';
                                        }
                                    }else{
                                        echo '<tr><td colspan="3" style="text-align: center;">Data Empty</td></tr>';
                                }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
    
<!-- footer -->

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