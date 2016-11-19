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
    
    <link href="<?php echo ASSETS;?>codemirror/codemirror.css" rel="stylesheet" type="text/css">
    <link href="<?php echo ASSETS;?>codemirror/theme/ambiance.css" rel="stylesheet" type="text/css">
    <script src="<?php echo ASSETS;?>js/jquery.js"></script>
    <script src="<?php echo ASSETS;?>js/phaser.min.js"></script>
    
    <link href="<?php echo ASSETS;?>css/prism.css" rel="stylesheet" type="text/css">
    <script src="<?php echo ASSETS;?>js/prism.js"></script>

    <script src="https://apis.google.com/js/platform.js" async defer></script>
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <style>
        .loading-view{
            background-color: ghostwhite;
            color: dimgray;
            width: 100%;
            height: 100%;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
        }
        
        a[campaign-id], a[pick-battle]{
            cursor: pointer;
        }
        
        div[notif]{
            position: fixed;
            top: 75px;
            right: 25px;
            z-index: 2;
        }
        
        .achieved > div.panel-footer{
            background-color: #d9edf7;
            border: #d9edf7;
        }
        
        .unachieved > div.panel-footer{
            background-color: dimgray;
            border: dimgray;
            color: grey;
        }
        
        .unachieved > div > img {
            -webkit-filter: grayscale(100%);
            filter: grayscale(100%);
        }
        
        .loading-view > div[mid]{
            vertical-align: middle;
            text-align: center;
        }
        
        body{
            overflow-y: scroll;
        }
        
        td{
            vertical-align: middle !important;
        }
        
        .header-page{
            margin: 0px 0px 0px 0px;
            padding-top: 28px;
            padding-left: 150px;
            color: white;
            font-weight: bold;
        }
        
        .belt{
            padding: 10px 15px;
            border-top-left-radius: 3px;
            border-top-right-radius: 3px;
        }
        
        .belt-white{
            color: grey;
            background-color: ghostwhite;
            border-color: grey;
        }
        
        .belt-yellow{
            color: grey;
            background-color: gold;
            border-color: grey;
        }
        
        .belt-black{
            color: ghostwhite;
            background-color: dimgray;
            border-color: ghostwhite;
        }
        
        .belt-white > h4 > .white,
        .belt-yellow > h4 > .yellow,
        .belt-black > h4 > .black{
            display: block;
        }
        
        .belt-black > h4 > .white,
        .belt-black > h4 > .yellow{
            display: none;
        }
        
        .belt-yellow > h4 > .white,
        .belt-yellow > h4 > .black{
            display: none;
        }
        
        .belt-white > h4 > .black,
        .belt-white > h4 > .yellow{
            display: none;
        }
        
        #preview{
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }
        
        .dashboard-menu:hover > div{
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }
        
        a[f-status].on{
              color: #fff;
              background-color: #5cb85c;
              border-color: #4cae4c;
        }
        
        a[f-status].on:hover{
              color: #fff;
              background-color: #f0ad4e;
              border-color: #eea236;
        }
        
        a[f-status].on > span[val],
        a[f-status].off > span[val],
        a[f-status].off:hover > span[on],
        a[f-status].on:hover > span[off]{
            display: block;
        }
        
        a[f-status].on:hover > span[on],
        a[f-status].on:hover > span[val],
        a[f-status].off:hover > span[off],
        a[f-status].off:hover > span[val],
        a[f-status].on > span[on],
        a[f-status].off > span[on],
        a[f-status].off > span[off],
        a[f-status].on > span[off]{
            display: none;
        }
        
        a[f-status].off:hover{
              color: #fff;
              background-color: #5cb85c;
              border-color: #4cae4c;
        }
        
        a[f-status].off{
              color: #fff;
              background-color: #f0ad4e;
              border-color: #eea236;
        }
        
        .desc{
            float: right;
        }
        
        .fighter-off{
            background-color: #f5f5f5;
            color: darkgray;
        }
        
        .widget{
            background-color: #bc3838;
        }
        
       .win{
            background-color: #29b524;
        }
        
        .lose{
            background-color: #bc3838;
        }
        
        .good{
            background-color: lightblue;
        }
        
        .perfect{
            background-color: lightgreen;
        }
    </style>

</head>
    <header class="loading-view">
        <div class="col-lg-12" style="height: 20%;"></div>
        <div mid class="col-lg-offset-4 col-lg-4">
            <img src="<?php echo ASSETS;?>images/loading.gif" class="img-responsive" alt="profile picture">
        </div>
    </header>
<body>
    
    <div notif>
        <?php 
            if(isset($data['notif'])){
                foreach($data['notif'] as $notif){
                    echo '<div class="alert alert-'.$notif['type'].' alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                      </button>'.$notif['msg'].'</div>';
                }
            }
        ?>
    </div>
    
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
                        <a href="leaderboard">Leaderboard</a>
                    </li>
                    <li>
                        <a logout-butt style="cursor: pointer;">Logout</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    
    <script type="text/javascript">
        $('a[logout-butt]').click(function(){
            var auth2 = gapi.auth2.getAuthInstance();
            auth2.signOut().then(function () {
              window.location.href = 'dashboard/logout';
            }); 
        });
    </script>

    <!-- Header Carousel -->
    <header class="carousel slide" style="height: 90px;">
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <div class="fill" style="background-image:url('<?php echo ASSETS;?>images/dashboard.jpg');">
                    <h2 class="header-page"><?php echo $data['username'];?></h2>
                </div>
            </div>
        </div>
    </header>

    <div class="bordering"></div>