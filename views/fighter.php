    <!-- Page Content -->
    <div class="container data-page" data-route="fighter">
        <!-- Marketing Icons Section -->
        <div class="row"><br>
             <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a loadScene="dashboard">Dashboard</a></li>
                    <li class="active">Fighter</li>
                </ol>
            </div>
            <div class="col-lg-12">
                <div class="col-lg-4">
                    <a class="btn btn-info pull-right" style="margin-top: 15px;" href="dashboard/editor/new">New Script</a>
                    <h3>Script</h3>
                    <hr>
                    <div class="col-lg-12">
                        <div class="row">
                            <?php 
                            if($data['script'] != null){
                                foreach($data['script'] as $script){
                                    echo '<div id="script'.$script['id'].'" class="panel panel-default">
                                            <div class="panel-body">
                                                '.$script['name'].'
                                                <a scriptUpdate data-link="'.BASE.'dashboard/editor/'.$script['id'].'" class="btn btn-info pull-right" style="margin-top: 15px; margin-left: 15px">Edit</a>
                                                <a onclick="delScript('.$script['id'].');" class="btn btn-danger pull-right" style="margin-top: 15px; margin-left: 15px">Delete</a>
                                            </div>
                                        </div>';
                                }   
                            }else{
                                echo "<center noFighter><h3>No Script Available</h3></center>";
                            }?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    
                    <div class="panel panel-default">
                        <div class="belt <?php echo $data['belt'];?>" style="height: 50px;">
                            <h4 style="width: 50%; float:left; margin:0px; padding-top:5px;">
                                <span class="white">White Belt Fighter</span>
                                <span class="yellow">Yellow Belt Fighter</span>
                                <span class="black">Black Belt Fighter</span>
                            </h4>
                            <a f-edit class="btn btn-default pull-right">Edit</a>
                        </div>
                        <div class="collapse" id="NewFighter">
                            <div style="margin-top: 15px; margin-bottom: 15px;" class="col-lg-12">
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <label for="NFName">Fighter Name</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="NFName">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <label for="NFScript">Core Script</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select id='NFScript' class="form-control">
                                                <option value="0">Choose Script</option>
                                                <?php foreach($data['script'] as $script){
                                                    echo '<option value="'.$script['id'].'">'.$script['name'].'</option>';
                                                }?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-9">
                                            <button data-id="<?php echo $data['fighter']->id;?>" id="updateFighter" type="submit" class="btn btn-info">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <table id="fighterDesc" class="table">
                            <tr>
                                <td style="width: 20%;"><b>Name</b></td>
                                <td id="fighterName" ><?php echo $data['fighter']->name;?></td>
                            </tr>
                            <tr>
                                <td style="width: 20%;"><b>Core Script</b></td>
                                <td id="fighterScript" s-id="<?php echo $data['fighter']->id_script;?>"><?php echo $data['fighter']->script_name;?></td>
                            </tr>
                            <tr>
                                <td style="width: 20%; vertical-align: midle;"><b>Online Match</b></td>
                                <td>
                                    <?php if($data['fighter']->status == 'Online'){
                                            $f_stat = 'on';
                                        }else{
                                            $f_stat = 'off';
                                    }?>

                                    <a f-status f-id="<?php echo $data['fighter']->id;?>" type="submit" class="btn btn-info <?php echo $f_stat;?>">
                                        <span val><?php echo $data['fighter']->status;?></span>
                                        <span on>Set Online</span>
                                        <span off>Set Offline</span>
                                    </a>
                                </td>
                            </tr>
                            <tr></tr>
                        </table>
                        <table class="table">
                            <thead>
                                <td style="width: 25%; text-align: center; background-color: #245bb5; color: white;"><b><?php echo $data['fighter']->draw;?></b></td>
                                <td style="width: 25%; text-align: center; background-color: #29b524; color: white;"><b><?php echo $data['fighter']->win;?></b></td>
                                <td style="width: 25%; text-align: center; background-color: #bc3838; color: white;"><b><?php echo $data['fighter']->lose;?></b></td>
                                <td style="width: 25%; text-align: center; background-color: #245bb5; color: white;"><b><?php echo $data['fighter']->match;?></b></td>
                            <thead>
                            <tr>
                                <td style="text-align: center; background-color: lightblue; color: dimgrey;"><b>Draw</b></td>
                                <td style="text-align: center; background-color: lightgreen; color: dimgrey;"><b>Win</b></td>
                                <td style="text-align: center; background-color: lightcoral; color: dimgrey;"><b>Lose</b></td>
                                <td style="text-align: center; background-color: lightblue; color: dimgrey;"><b>Total Match</b></td>
                            </tr>
                        </table>
                    </div>
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
        
        <!-- /.row -->
        <br><br><br>
    </div>
    <!-- /.container -->

    <script type="text/javascript">
        function showNotif(msg){
            document.getElementById('alertMsg').innerHTML = msg;
            $('.bs-example-modal-sm').modal('show');
        }
        
        function delScript(id){
            $.post( "dashboard/delScript", { id:id }).done(function( data ) {
                if(data == true){
                    showNotif('Script is deleted successfully!');
                    $('#script'+id).remove();
                }
            });
        }
        
        $("#updateFighter").click(function(){
            id = $(this).attr('data-id');
            name = $('#NFName').val();
            script = $('#NFScript').val();
            
            $.post( "dashboard/upFighter", { id:id, script:script, name:name }).done(function( data ) {
                if(data == true){                    
                    script_name = $('#NFScript>option[value='+script+']').text();
                    name = $('#NFName').val();
                    
                    $('#fighterName').html(name);
                    $('#fighterScript').html(script_name);
                    
                    showNotif(name + ' is updated!');
                }else{
                    showNotif(data);
                }
            });
            $('#fighterDesc').removeClass('fighter-off');
            $(this).removeClass('active');
            $('#NewFighter').collapse('toggle');
        });
        
        $("a[f-edit]").click(function(){
            id = $(this).attr('f-id');
            name = $('#fighterName').text();
            id_script = $('#fighterScript').attr('s-id');
            
            $('#NFName').val(name);
            $('#NFScript').val(id_script);
            $('#createNF').attr('data-id', id).html('Update');
            
            if($(this).hasClass('active')){
                $('#fighterDesc').removeClass('fighter-off');
                $(this).removeClass('active');
            }else{
                $('#fighterDesc').addClass('fighter-off');
                $(this).addClass('active');
            }
            
            $('#NewFighter').collapse('toggle');
        });
        
        $("a[f-status]").click(function(){
            if($(this).hasClass('on')){
                data = 'Offline';
            }else{
                data = 'Online';
            }
            
            id = $(this).attr('f-id');
            var button = $(this);
            $.post( "dashboard/CSFighter", { id:id, status:data }).done(function( result ) {
                if(result != null){
                    clean = result.replace(/\s/g, '');
                    button.find('span[val]').html(clean);
                    if(clean == 'Online'){
                        button.removeClass('off');
                        button.addClass('on');
                    }else{
                        button.removeClass('on');
                        button.addClass('off');
                    }
                    showNotif('Status Changed to '+result+'!');
                }else{
                    showNotif(result);
                }
            });
        });
        
        $("a[scriptUpdate]").click(function(){
            window.location = $(this).attr('data-link');
        });
    </script>