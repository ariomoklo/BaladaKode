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
    
    <script src="<?php echo ASSETS;?>codemirror/codemirror.js"></script>
    
    <link href="<?php echo ASSETS;?>codemirror/codemirror.css" rel="stylesheet" type="text/css">
    <link href="<?php echo ASSETS;?>codemirror/theme/ambiance.css" rel="stylesheet" type="text/css">
    <script src="<?php echo ASSETS;?>codemirror/javascript/javascript.js"></script>
    <script src="<?php echo ASSETS;?>js/jquery.js"></script>
    <script src="<?php echo ASSETS;?>js/bootstrap.min.js"></script>

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
        
        .dashboard-menu:hover > img{
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }
        
        .desc{
            float: right;
        }
        
        .widget{
            background-color: #245bb5;
        }
        
       .win{
            background-color: #29b524;
        }
        
        .lose{
            background-color: #bc3838;
        }
    </style>

</head>
    
<audio autoplay loop>
    <source src="<?php echo ASSETS;?>sounds/Monkey-Drama.mp3" type="audio/mpeg">
</audio>

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

    <!-- Header Carousel -->
    <header class="carousel slide" style="height: 10%">
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <div class="fill" style="background-image:url('<?php echo ASSETS;?>images/dashboard.jpg');">
                    <h2 class="header-page">Script Editor</h2>
                </div>
            </div>
        </div>
    </header>

    <div class="bordering"></div>  
<!-- Page Content -->
    <div class="container">
        <!-- Marketing Icons Section -->
        <div class="row"><br>
             <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a href="<?php echo BASE;?>dashboard">Dashboard</a></li>
                    <li class="active">Editor</li>
                </ol>
            </div>
            <div class="col-lg-8">
                <div class="panel panel-default">
                    <div class="panel-heading" style="height: 50px;">
                        <h4 id='nameScript' script-name="<?php echo $data['name'];?>" style="width: 50%; float:left; margin:0px;"><?php 
                            if($data['id'] != 'new'){
                                echo $data['username'].'/'.$data['name'].'.js';    
                            }else{
                                echo $data['username'].'/ <input placeholder="Script Name" type="text" style="width:50%; display:inline;" class="form-control" id="scriptname"> .js';
                            }
                            
                        ?></h4>
                        <button id="link" class="btn btn-default pull-right">Compile</button>
                        <button id="save" class="btn btn-primary pull-right" style="margin-right: 15px;" disabled>Save</button>
                    </div>
                    <div class="panel-body" style="padding:0px;">
                        <textarea id="code" name="code"><?php echo $data['script'];?></textarea>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading" style="height: 50px;">
                        <h4 style="width: 50%; float:left;" class="panel-tittle">Console Panel</h4>
                    </div>
                    <div class="panel-body" style="padding:0px;">
                        <textarea id="error" name="error"></textarea>
                    </div>
                </div>
            </div>
            
            <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
              <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Notification</h4>
                    </div>
                    <div id="alertMsg" class="modal-body"></div>  
                </div>
              </div>
            </div>
        </div>
        <!-- /.row -->
        
        <script id="planted" type="text/javascript" data-script="<?php echo $data['id'];?>" data-user="<?php echo $data['userid'];?>">                  
            code = CodeMirror.fromTextArea(document.getElementById("code"),{
                lineNumbers : true,
                mode : 'javascript'
            });  

            error = CodeMirror.fromTextArea(document.getElementById("error"),{
                lineNumbers : true,
                readOnly : 'nocursor',
                mode : false
            }); 

            $('#link').click(function () {
                error.setValue('\[output\]:\ncompiling...\n');
                var codeValue = code.getValue();
//                running = Function(codeValue+'\n callBack();');
//                running();
                var red = new scriptHandler(codeValue+'callBack();', 'red');
                redseq = red.sequence();
                
                var blue = new scriptHandler('leftPunch(); leftKick();', 'blue');
                blueseq = blue.sequence();
                
                if(redseq.length >= blueseq.length){
                    for(i=0; i< redseq.length; i++){
                        if(typeof blueseq[i] != 'undefined'){
                            console.log('red :'+redseq[i].key + ' | '+ redseq[i].value);
                            console.log('blue :'+blueseq[i].key + ' | '+ blueseq[i].value);
                            
                            if(checkMove(redseq[i], blueseq[i])){
                                console.log('bintang untuk merah');
                            }
                            
                            if(checkMove(blueseq[i], redseq[i])){
                                console.log('bintang untuk biru');
                            }
                            
                        }else{
                            console.log('red :'+redseq[i].key + ' | '+redseq[i].value);
                            console.log('blueseq empty');
                            
                            if(checkMove(redseq[i], {key: 'none', value: 0, pos: 0})){
                                console.log('bintang untuk merah');
                            }
                        }
                        console.log('batch no : '+i);
                    }
                }else{
                    for(i=0; i< blueseq.length; i++){
                        if(typeof redseq[i] != 'undefined'){
                            console.log('red :'+redseq[i].key + ' | '+redseq[i].value);
                            console.log('blue :'+blueseq[i].key + ' | '+blueseq[i].value);
                            
                            if(checkMove(redseq[i], blueseq[i])){
                                console.log('bintang untuk merah');
                            }
                            
                            if(checkMove(blueseq[i], redseq[i])){
                                console.log('bintang untuk biru');
                            }
                        }else{
                            console.log('blue :'+blueseq[i].key + ' | '+blueseq[i].value);
                            console.log('redseq empty');
                            
                            if(checkMove(blueseq[i], {key: 'none', value: 0, pos: 0})){
                                console.log('bintang untuk biru');
                            }
                        }
                        console.log('batch no : '+i);
                    }
                }
                
            });
            
            function checkMove(pl, en){                
                //jarak = pl.pos - en.pos;
                //if(Math.abs(jarak) == 1){
                    if(pl.key == 'punch'){
                        if(en.key == 'kick'){
                            return false;
                        }else if(en.key == 'block'){
                            return false;
                        }else if(en.key == 'jump'){
                            return true;
                        }else if(en.key == 'evade'){
                            return false;
                        }else if(en.key == 'none'){
                            return true;
                        }else if(en.key == 'punch'){
                            return false;
                        }
                    }

                    if(pl.key == 'kick' && pl.value == 0){
                        if(en.key == 'kick'){
                            return false;
                        }else if(en.key == 'block'){
                            return true;
                        }else if(en.key == 'jump'){
                            return true;
                        }else if(en.key == 'evade'){
                            return false;
                        }else if(en.key == 'none'){
                            return true;
                        }else if(en.key == 'punch'){
                            return true;
                        }
                    }
                    
                    if(pl.key == 'kick' && pl.value == 1){
                        if(en.key == 'kick'){
                            if(en.value == 0){
                                return true;
                            }else{
                                return false;
                            }
                        }else if(en.key == 'block'){
                            return true;
                        }else if(en.key == 'jump'){
                            return true;
                        }else if(en.key == 'evade'){
                            return false;
                        }else if(en.key == 'none'){
                            return true;
                        }else if(en.key == 'punch'){
                            return true;
                        }
                    }
                //}
            }

            $('#save').click(function () {
                idScript = $('#planted').attr('data-script');
                idUser = $('#planted').attr('data-user');
                name = $('#scriptname').val();
                script = code.getValue();

                if(idScript == 'new'){
                    $.post( "../newscript", { userid:idUser,  name:name, script:script }).done(function( data ) {
                        if(data == true){
                            document.getElementById('alertMsg').innerHTML = name+'.js saved';
                            $('.bs-example-modal-sm').modal('show');
                        }else{
                            document.getElementById('alertMsg').innerHTML = data;
                            $('.bs-example-modal-sm').modal('show');
                        }
                    });   
                }else{
                    name = $('#nameScript').attr('script-name');
                    $.post( "../upscript", { id:idScript, userid:idUser, name:name, script:script }).done(function( data ) {
                        if(data == true){
                            document.getElementById('alertMsg').innerHTML = name+'.js saved';
                            $('.bs-example-modal-sm').modal('show');
                        }else{
                            document.getElementById('alertMsg').innerHTML = data;
                            $('.bs-example-modal-sm').modal('show');
                        }
                    });
                }
            });

            function callBack(){
                error.setValue(error.getValue()+'compiling done.\n');
                $('#save').removeAttr('disabled');
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
        <script src="<?php echo VIEW;?>compiler/scriptHandler.js"></script>
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
</body>
</html>