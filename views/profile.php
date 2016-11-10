    <!-- Page Content -->
    <div class="container data-page" data-route="profile">
        <!-- Marketing Icons Section -->
        <div class="row"><br>
             <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a loadScene="dashboard">Dashboard</a></li>
                    <li class="active">Profile</li>
                </ol>
            </div>
            <div class="col-lg-12">
                <div class="col-lg-4">
                    <div class="panel panel-info">
                        <div class="panel-body" style="padding:0px;">
                            <img src="<?php echo($data['image_url']);?>" class="img-responsive" alt="profile picture">
                        </div>
                        <ul class="list-group">
                          <li class="list-group-item"><b>Username</b> <span class="desc"><?php echo $data['username'];?></span></li>
                          <li class="list-group-item"><b>Level</b> <span class="desc"><?php echo $data['level'];?></span></li>
                          <li class="list-group-item"><b>EXP Point</b> <span class="desc"><?php echo $data['exp'];?></span></li>
                          <li class="list-group-item"><b>Reputation Point</b> <span class="desc"><?php echo $data['rep'];?></span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-2" style="width: 20%; text-align: center;">
                            <div class="panel panel-default widget">
                                <div class="panel-body">
                                    <center>
                                        <h1 style="margin-top: 10px; color: white;"><?php echo $data['chaRank'];?></h1>
                                    </center>
                                </div>
                                <div class="panel-footer">Champion</div>
                            </div>  
                        </div>
                        <div class="col-lg-2" style="width: 20%; text-align: center;">
                            <div class="panel panel-default widget">
                                <div class="panel-body">
                                    <center>
                                        <h1 style="margin-top: 10px; color: white;"><?php echo $data['famRank'];?></h1>
                                    </center>
                                </div>
                                <div class="panel-footer">Fame</div>
                            </div>  
                        </div>
                        <div class="col-lg-2" style="width: 20%; text-align: center;">
                            <div class="panel panel-default widget">
                                <div class="panel-body">
                                    <center>
                                        <h1 style="margin-top: 10px; color: white;"><?php echo $data['masRank'];?></h1>
                                    </center>
                                </div>
                                <div class="panel-footer">Master</div>
                            </div>  
                        </div>
                        <div class="col-lg-2" style="width: 20%; text-align: center;">
                            <div class="panel panel-default win">
                                <div class="panel-body">
                                    <center>
                                        <h1 style="margin-top: 10px; color: white;"><?php echo $data['allWin'];?></h1>
                                    </center>
                                </div>
                                <div class="panel-footer">Win</div>
                            </div>  
                        </div>
                        <div class="col-lg-2" style="width: 20%; text-align: center;">
                            <div class="panel panel-default lose">
                                <div class="panel-body">
                                    <center>
                                        <h1 style="margin-top: 10px; color: white;"><?php echo $data['allLose'];?></h1>
                                    </center>
                                </div>
                                <div class="panel-footer">Lose</div>
                            </div>  
                        </div>
                        <div class="col-lg-12">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Achievement</h3>
                                </div>
                                <div class="panel-body">
                                    
                                    <div class="row">
                                        <?php foreach($data['achieved'] as $achieved){
                                            echo '<div class="col-lg-3">
                                                <div class="panel panel-default '.$achieved['status'].'">
                                                    <div class="panel-body" style="padding:0px;">
                                                        <img src="'.ASSETS.'achievement/'.$achieved['key'].'.png" class="img-responsive" alt="profile picture">
                                                    </div>
                                                    <div class="panel-footer">'.$achieved['name'].'</div>
                                                </div>
                                            </div>';
                                        }?>
                                    </div>
                                    
                                </div>
                            </div>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <br><br><br>
    </div>
    <!-- /.container -->