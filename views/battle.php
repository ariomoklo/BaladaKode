    <!-- Page Content -->
    <div class="container data-page" data-route="battle">
        <!-- Marketing Icons Section -->
        <div class="row"><br>
             <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a loadScene="dashboard">Dashboard</a></li>
                    <li class="active">Battle</li>
                </ol>
            </div>
            
            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Campaign Battle</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <?php $camp = $data['Campaign'];?>
                            <a campaign-id="1" class="dashboard-menu">
                                <div class="col-lg-2" style="width: 19%; padding: 10px; margin-left: 5px; margin-right: 5px;">
                                    <div class="panel panel-default" style="margin-bottom: 0px;">
                                        <div class="panel-body <?php echo $camp[0]->result;?>" style="height: 100px; text-align: center;">
                                            <h1> < / > </h1>
                                        </div>
                                        <div class="panel-footer" style="text-align: center;">
                                            Newb's Coder
                                        </div>
                                    </div>
                                </div>
                            </a>
                            
                            <a campaign-id="2" class="dashboard-menu">
                                <div class="col-lg-2" style="width: 19%; padding: 10px; margin-left: 5px; margin-right: 5px;">
                                    <div class="panel panel-default" style="margin-bottom: 0px;">
                                        <div class="panel-body <?php echo $camp[1]->result;?>" style="height: 100px; text-align: center;">
                                            <h1> IF() </h1>
                                        </div>
                                        <div class="panel-footer" style="text-align: center;">
                                            Condition
                                        </div>
                                    </div>
                                </div>
                            </a>
                            
                            <a campaign-id="3" class="dashboard-menu">
                                <div class="col-lg-2" style="width: 19%; padding: 10px; margin-left: 5px; margin-right: 5px;">
                                    <div class="panel panel-default" style="margin-bottom: 0px;">
                                        <div class="panel-body <?php echo $camp[2]->result;?>" style="height: 100px; text-align: center;">
                                            <h1> i++ </h1>
                                        </div>
                                        <div class="panel-footer" style="text-align: center;">
                                            The Loop's
                                        </div>
                                    </div>
                                </div>
                            </a>
                            
                            <a campaign-id="4" class="dashboard-menu">
                                <div class="col-lg-2" style="width: 19%; padding: 10px; margin-left: 5px; margin-right: 5px;">
                                    <div class="panel panel-default" style="margin-bottom: 0px;">
                                        <div class="panel-body <?php echo $camp[3]->result;?>" style="height: 100px; text-align: center;">
                                            <h1> (){ </h1>
                                        </div>
                                        <div class="panel-footer" style="text-align: center;">
                                            Prosedural
                                        </div>
                                    </div>
                                </div>
                            </a>
                            
                            <a campaign-id="5" class="dashboard-menu">
                                <div class="col-lg-2" style="width: 19%; padding: 10px; margin-left: 5px; margin-right: 5px;">
                                    <div class="panel panel-default" style="margin-bottom: 0px;">
                                        <div class="panel-body <?php echo $camp[4]->result;?>" style="height: 100px; text-align: center;">
                                            <h1> Re{} </h1>
                                        </div>
                                        <div class="panel-footer" style="text-align: center;">
                                            Function's
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>  
            </div>
            
            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Users Challange</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            
                        <?php if($data['allBattle']){
                                foreach($data['allBattle'] as $battle){
                                    echo '<a pick-battle="'.$battle['id'].'" img-url="'.$battle['image'].'" class="dashboard-menu">
                                        <div class="col-lg-2" style="width: 19%; padding: 10px; margin-left: 5px; margin-right: 5px;">
                                            <div class="panel panel-default" style="margin-bottom: 0px;">
                                                <div class="panel-body '.$battle['result'].'" style="height: 100px; text-align: center;">
                                                    <h1> '.strtoupper(substr($battle['username'], 0, 2)).' </h1>
                                                </div>
                                                <div class="panel-footer" style="text-align: center;">
                                                    '.$battle['name'].'
                                                </div>
                                            </div>
                                        </div>
                                    </a>';
                                }
                            }else{
                                echo '<div class="col-lg-12" style="text-align: center;"><h4>Data Empty</h4></div>';
                        }?>
                            
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>
        
        <div class="modal fade fight-detil" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Battle Detail</h4>
                </div>
                <div class="modal-body">
                    <table>
                        <tr>
                            <td rowspan="3" style="width: 15%">
                                <img src="<?php echo ASSETS;?>images/button-fighter.png" width="300px;" class="img-responsive user-pp" alt="profile picture">
                            </td>
                            <td colspan="2" style="padding-left: 15px;">
                                <h4 style="width: 100%; padding-top: 15px; padding-bottom: 15px; background-color: lightblue; text-align: center;">
                                    <b class="data-username">Dummy's</b>
                                </h4>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 15%; padding-left: 20px;"><b>Fighter</b></td>
                            <td class="data-fname">Fighting Booleer</td>
                        </tr>
                        <tr>
                            <td style="width: 15%; padding-left: 20px;"><b>Defeat</b></td>
                            <td class="data-defeat">0</td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a battle-id href="<?php echo BASE;?>battle/" type="button" class="btn btn-success battle-fight">Battle</a>
                </div>
            </div>
          </div>
        </div>
        
        <div class="modal fade cam-detil" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Campaign</h4>
                </div>
                <div class="modal-body">
                    <div class="cam1" style="display: block;">
                        <h4 style="width: 100%; padding-top: 15px; padding-bottom: 15px; background-color: lightblue; text-align: center;">
                            <b class="naming-model">Newb's Coder</b>
                        </h4>
                        <pre style="background-color: black; padding-left: 50px;"><code class="language-javascript scripting">
                        </code></pre>
                    </div>
                </div> 
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a battle-id href="<?php echo BASE;?>battle/" type="button" class="btn btn-success camp-fight">Battle</a>
                </div>
            </div>
          </div>
        </div>
        
<script type="text/javascript">
    $('a[campaign-id]').click(function(){
        id = $(this).attr('campaign-id');
        
        $.post( "dashboard/getFighter", { id: id }).done(function(data) {
            fighter = JSON.parse(data);
            $('.naming-model').text(fighter['name']);
            $('.scripting').text(fighter['script']);
            link = $('a[battle-id]').attr('href');
            $('a[battle-id]').attr('href', link+id);
            $('.cam-detil').modal('show');
        }).fail(function(data) {
            console.log('error, data: '+data);
        });
    });
    
    $('a[pick-battle]').click(function(){
        id = $(this).attr('pick-battle');
        image = $(this).attr('img-url');
        
        $.post( "dashboard/getFighter", { id: id }).done(function(data) {
            battle = JSON.parse(data);
            console.log(battle['username'] + ' | ' + battle['name'] + ' | ' + battle['defeated']);
            $('.data-username').html(battle['username']);
            $('.data-fname').html(battle['name']);
            $('.data-defeat').html(battle['defeated']);
            $('.battle-fight').attr('data-id', battle['id']);
            $('.user-pp').attr('src', image);
            link = $('a[battle-id]').attr('href');
            $('a[battle-id]').attr('href', link+battle['id']);
            
            $('.fight-detil').modal('show');
        }).fail(function(data) {
            console.log('error, data: '+data);
        });
        
    });
</script>