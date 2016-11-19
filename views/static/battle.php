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
    
    <script src="<?php echo ASSETS;?>codemirror/codemirror.js"></script>
    
    <link href="<?php echo ASSETS;?>codemirror/codemirror.css" rel="stylesheet" type="text/css">
    <link href="<?php echo ASSETS;?>codemirror/theme/ambiance.css" rel="stylesheet" type="text/css">
    <script src="<?php echo ASSETS;?>codemirror/javascript/javascript.js"></script>
    <script src="<?php echo ASSETS;?>js/jquery.js"></script>
    <script src="<?php echo ASSETS;?>js/bootstrap.min.js"></script>
    <script src="<?php echo ASSETS;?>js/phaser.min.js"></script>
    
    <script src='<?php echo VIEW;?>battle/library/quintus.js'></script>
    <script src='<?php echo VIEW;?>battle/library/quintus_sprites.js'></script>
    <script src='<?php echo VIEW;?>battle/library/quintus_scenes.js'></script>
    <script src='<?php echo VIEW;?>battle/library/quintus_input.js'></script>
    <script src='<?php echo VIEW;?>battle/library/quintus_anim.js'></script>
    <script src='<?php echo VIEW;?>battle/library/quintus_2d.js'></script>
    <script src='<?php echo VIEW;?>battle/library/quintus_touch.js'></script>
    <script src='<?php echo VIEW;?>battle/library/quintus_ui.js'></script>
    
    <script src="<?php echo VIEW;?>battle/scriptHandler.js"></script>

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
        
        #preview{
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }
        
        .phaser-heading{
            background-color: dimgrey;
            color: ghostwhite;
        }
        
        .phaser-body{
            background-color: #333;
            color: ghostwhite;
        }
        
        .none{
            background-color: lightgrey;
        }
        
        .good{
            background-color: lightskyblue;
        }
        
        .perfect{
            background-color: lightgreen;
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
                        <a href="<?php echo BASE;?>main/leaderboard">Leaderboard</a>
                    </li>
                    <li>
                        <a href="about.html">Tutorial</a>
                    </li>
                    <li>
                        <a href="<?php echo BASE;?>dashboard/logout">Logout</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

<!-- Page Content -->
    <div class="container">
        <!-- Marketing Icons Section -->
        <div class="row"><br>
            
            <div class="col-lg-12">
                <div battle-id="<?php echo $data['battleid'];?>" last-res="<?php echo $data['result'];?>" class="panel panel-default <?php echo $data['result'];?>">
                    <div class="panel-body" style="height: 70px;">
                        <a href="<?php echo BASE;?>dashboard" class="btn btn-default">Back Home</a>
                        <h3 class="pull-right" style="margin-top: 5px;">
                            <?php if($data['result'] == 'none'){
                                echo 'Not Yet Defeated';
                            }else if($data['result'] == 'good'){
                                echo 'Been Defeated';
                            }else if($data['result'] == 'perfect'){
                                echo 'Perfectly Defeated';
                            }?>
                        </h3>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading" style="height: 50px;">
                        <h4 id='nameScript' userid="<?php echo $data['userid'];?>" script-name="<?php echo $data['enname'];?>" style="width: 50%; float:left; margin:0px; margin-top: 5px;">Script Editor</h4>
                        <button id="link" class="btn btn-default pull-right">Compile</button>
                        <button id="battle" class="btn btn-primary pull-right" style="margin-right: 15px;" disabled>Battle</button>
                    </div>
                    <div class="panel-body" style="padding:0px;">
                        <textarea id="code" name="code"></textarea>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading" style="height: 50px;">
                        <h4 enid="<?php echo $data['enid'];?>" style="width: 50%; float:left; margin:0px; margin-top: 5px;" class="panel-tittle enid">
                            <?php echo $data['enname'];?>
                        </h4>
                    </div>
                    <div class="panel-body" style="padding:0px;">
                        <textarea id="enemy" name="enemy"><?php echo $data['enscript'];?></textarea>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="height: 50px;">
                        <h4 style="width: 50%; float:left;" class="panel-tittle">Control Panel</h4>
                    </div>
                    <div class="panel-body" style="padding:0px;">
                        <textarea id="error" name="error" disabled></textarea>
                    </div>
                </div>
            </div>
            
            <div class="modal fade notif" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
              <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Congratulation</h4>
                    </div>
                    <div id="alertMsg" class="modal-body">
                        <h3> You win this match </h3>
                        <button id="save" class="btn btn-default pull-right">back</button>
                    </div>  
                </div>
              </div>
            </div>
        </div>
        <!-- /.row -->
        
        <div class="modal fade battle" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Battle Simulation</h4>
                </div>
                <div class="modal-body">
                    <center>
                        <canvas id='example1' width='800' height='400'></canvas>
                    </center>
                </div>  
            </div>
          </div>
        </div>
        
        <script type="text/javascript" data-location="<?php echo VIEW;?>" match-id="<?php echo $data['id'];?>">
            var matchId = $('script[data-location]').attr('match-id');
            var imgLoc = $('script[data-location]').attr('data-location');
            
            var player; var enemy; var playerWin = false;

            var redSequ, blueSequ; var result = 'none';
            
            botScript = CodeMirror.fromTextArea(document.getElementById("enemy"),{
                lineNumbers : true,
                mode : 'javascript',
                readOnly : 'nocursor'
            });  
            
            code = CodeMirror.fromTextArea(document.getElementById("code"),{
                lineNumbers : true,
                mode : 'javascript'
            });  

            error = CodeMirror.fromTextArea(document.getElementById("error"),{
                lineNumbers : true,
                mode : 'javascript',
                readOnly : 'nocursor',
                theme : 'ambiance'
            }); 
        </script>
        
        <script src="<?php echo VIEW;?>battle/game.js"></script>
        
        <script id="planted" type="text/javascript" data-script="<?php echo $data['id'];?>" data-user="<?php echo $data['userid'];?>">
            
            $('#battle').click(function (){
                red = new scriptHandler(code.getValue(), 'red');
                player.p.seq = red.sequence();

                blue = new scriptHandler(botScript.getValue(), 'blue');
                enemy.p.seq = blue.sequence();

                console.log('opening simulation window . .');
                $('.battle').modal('show');
            });

            $('#link').click(function () {
                error.setValue('compiling . . \n');
                var codeValue = code.getValue();
                
                player.trigger('resetGame');
                
                var red = new scriptHandler(codeValue+'callBack();', 'red'); 
                compiling = red.sequence();
            });

            function callBack(){
                error.setValue(error.getValue()+'compiling done.\n');
                $('#battle').removeAttr('disabled');
                
                console.log('simulation ready . .');
            }
            
            window.onerror = function(msg, url, linenumber) {
                $('#save').attr('disabled', 'disabled');
                errormsg = msg+' | Line Number: '+linenumber;
                error.setValue(error.getValue() + errormsg + '\n');
                return true;
            };
            
            console.log = function(message) {
                error.setValue(error.getValue() + message + '\n');
            };
            console.error = console.debug = console.info =  console.log
        </script>
    </div>
    <!-- /.container -->

       <!-- Footer -->
    <footer style="z-index: 10;">
        <div class="bordering" style="background-color: #4e565e"></div>
        <div class="row">
            <div class="col-lg-12">
                <p class="copy">Copyright &copy; Code Ballad 2014</p>
            </div>
        </div>
    </footer>
</body>
</html>