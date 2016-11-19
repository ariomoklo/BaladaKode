    <!-- Page Content -->
    <div class="container data-page" data-route="achieved">
        <!-- Marketing Icons Section -->
        <div class="row"><br>
             <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a loadScene="dashboard">Dashboard</a></li>
                    <li class="active">Achievement</li>
                </ol>
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
                                        <div class="panel-body">
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