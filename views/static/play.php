<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
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
        }
    </style>

</head>

<body style="padding: 0px;">    
        <!-- Header Carousel -->
    <header class="carousel slide">
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <div class="fill" style="background-image:url('<?php echo ASSETS;?>images/dashboard.jpg');"></div>
            </div>
        </div>
    </header>
<!-- Header -->

<!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-2" style="margin-top: 30px;">
                <div class="row">
                    <div class="col-md-12" style="text-align: center;">
                        <a side-button href="<?php echo BASE;?>dashboard">
                            <div class="panel panel-default widget">
                                <div class="panel-body">
                                    <h4 style="margin-top: 10px;"><span class="glyphicon glyphicon-th-large" aria-hidden="true"></span> Dashboard</h4>
                                </div>
                            </div>  
                        </a>
                    </div>
                    <div class="col-md-12" style="text-align: center;">
                        <a side-button id="play_button">
                            <div class="panel panel-default widget">
                                <div class="panel-body">
                                    <h4 style="margin-top: 10px;"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span> Play</h4>
                                </div>
                            </div>  
                        </a>
                    </div>
                    <div class="col-md-12" style="text-align: center;">
                        <a side-button data-toggle="modal" data-target=".console-log">
                            <div class="panel panel-default widget">
                                <div class="panel-body">
                                    <h4 style="margin-top: 10px;"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Console</h4>
                                </div>
                            </div>  
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-10" style="margin-top: 30px;">
                <div class="panel panel-info">
                    <div class="phaser-heading panel-heading">
                        <h3 class="panel-title">
                            <span fighter-red="<?php echo $data['redUser'];?>" class="label label-danger">
                                <?php echo $data['red']->name;?>
                            </span>
                            <span fighter-blue="<?php echo $data['blueUser'];?>" class="label label-info pull-right">
                                <?php echo $data['blue']->name;?>
                            </span>
                        </h3>
                    </div>
                    <div class="panel-body phaser-body" style="background-image: url('<?php echo ASSETS;?>images/Background-Stage.png');">
                        <center>
                            <div id="playPhaser" style="width: 860px; height: 480px;"></div>
                        </center>
                    </div>
                </div>
            </div>
            
            <div class="modal fade console-log" tabindex="-1" role="dialog" aria-labelledby="ConsoleLog">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Console Log</h4>
                    </div>
                    <div class="modal-body" style="background-color: #333;">
                        <div console>
                            <p><span class="label label-danger">Red </span>Hit</p>
                            <p><span class="label label-info">Blue</span><span class="glyphicon glyphicon-star" aria-hidden="true"></span> 1 point</p>
                            <p><span class="label label-info">Blue</span><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span> Win</p>
                            <p><span class="label label-danger">Red </span><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span> Lose</p>
                            <p><span class="label label-danger">Red </span><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> masuk</p>
                        </div>
                    </div>
                </div>
              </div>
            </div>
        </div>        
    </div>
    
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo ASSETS;?>js/bootstrap.min.js"></script>
    <script src="<?php echo ASSETS;?>codemirror/codemirror.js"></script>
    
    <script src="<?php echo VIEW;?>compiler/scriptHandler.js"></script>
    <script src="<?php echo VIEW;?>compiler/playPhaser.js"></script>
    <script type="text/javascript" data-location="<?php echo VIEW;?>" match-id="<?php echo $data['id'];?>">
        var matchId = $('script[data-location]').attr('match-id');
        var imgLoc = $('script[data-location]').attr('data-location');
        var redUser = $('span[fighter-red]').attr('fighter-red');
        var blueUser = $('span[fighter-blue]').attr('fighter-blue');
        var redName = $('span[fighter-red]').html().replace(/\s/g, '');
        var blueName = $('span[fighter-blue]').html().replace(/\s/g, '');
        
        var redScript = 'Block(); Evade(); leftKick();';
        var blueScript = 'leftPunch(); leftKick();';
        
        var redSeq, blueSeq;
        var playOnce = true;
        
        $('#play_button').click(function(){
            if(playOnce){
                $.post("../getScript", { id:matchId }).done(function( data ) {
                    script = JSON.parse(data);
                    //redScript = script.red;
                    blueScript = script.blue;
                    
                    console.log(redScript);
                    console.log(blueScript);
                    
                    red = new scriptHandler(redScript, 'red');
                    redSeq = red.sequence();

                    blue = new scriptHandler(blueScript, 'blue');
                    blueSeq = blue.sequence();

                    console.log(redSeq[0]);
                    console.log(blueSeq[0]);
                    
                    playing = true;
                });
                
                playOnce = false;
                $("#play_button > .panel").css('background-color','dimgrey');
                $("#play_button > .panel").css('color','black');
                $("#play_button > .panel").css('cursor','auto');
            }
        });
    </script>
    
</body>
</html>