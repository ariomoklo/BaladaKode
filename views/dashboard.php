    <!-- Page Content -->
    <div class="container data-page" data-route="dashboard">
        <!-- Marketing Icons Section -->
        <div class="row"><br>
             <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li class="active">Dashboard</li>
                </ol>
            </div>
            <div class="col-lg-12">
                <div class="col-lg-4">
                    <div class="panel panel-info">
                        <div class="panel-body bg-success" style="padding:0px;">
                            <img src="<?php echo $data['image_url'];?>" class="img-responsive center-block" style="width: 40%;" alt="profile picture">
                        </div>
                        <ul class="list-group">
                          <li class="list-group-item"><b>Username</b> <span class="desc user-username"><?php echo $data['username'];?></span></li>
                          <li class="list-group-item"><b>Level</b> <span class="desc user-level"><?php echo $data['level'];?></span></li>
                          <li class="list-group-item"><b>EXP Point</b> <span class="desc user-exp"><?php echo $data['exp'];?></span></li>
                          <li class="list-group-item"><b>Reputation Point</b> <span class="desc user-rep"><?php echo $data['rep'];?></span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <a loadScene="battle">
                            <div class="col-lg-6" style="text-align: center;">
                                <div class="panel panel-default widget">
                                    <div class="panel-body">
                                        <center>
                                            <h1 style="margin-top: 10px; color: white;">Battle</h1>
                                        </center>
                                    </div>
                                </div>  
                            </div>
                        </a>
                        <a loadScene="achieved">
                            <div class="col-lg-6" style="text-align: center;">
                                <div class="panel panel-default widget">
                                    <div class="panel-body">
                                        <center>
                                            <h1 style="margin-top: 10px; color: white;">Achievement</h1>
                                        </center>
                                    </div>
                                </div>  
                            </div>
                        </a>
                        
                        <div class="col-lg-12">
                            <div class="panel panel-info">
                                <div class="panel-heading" style="height: 50px;">
                                    <h4 style="width: 50%; float:left; margin:0px; padding-top: 5px;">My Fighter</h4>
                                    <a href="<?php echo BASE;?>dashboard/editor/new" class="btn btn-default pull-right">New Fighter</a>
                                </div>
                                <table class="table" style="text-align: center;">
                                    <thead style="background-color: ghostwhite;">
                                        <td>#</td>
                                        <td>Name</td>
                                        <td>Status</td>
                                        <td>Defeated</td>
                                        <td>Action</td>
                                    </thead>
                                    <tbody>
                                        
                                    <?php if($data['Myfighter']){
                                        foreach($data['Myfighter'] as $i => $fighter){
                                            echo '<tr class="fighter'.$fighter['id'].'">
                                                <td>'.($i+1).'</td>
                                                <td class="naming" style="text-align: left;">'.$fighter['name'].'</td>
                                                <td class="status">'.$fighter['status'].'</td>
                                                <td>'.$fighter['defeated'].'</td>
                                                <td>
                                                    <a f-edit f-id="'.$fighter['id'].'" f-link="'.BASE.'dashboard/editor/'.$fighter['id'].'" f-name="'.$fighter['name'].'" f-stat="'.$fighter['status'].'" class="btn btn-default">Edit</a>
                                                    <a f-delete="'.$fighter['id'].'" data-name="'.$fighter['name'].'" class="btn btn-default">Delete</a>
                                                </td>
                                            </tr>';
                                        }
                                    }else{
                                        echo '<tr><td colspan="5" style="text-align: center;"> Data Empty </td></tr>';
                                    }?>
                                        
                                    </tbody>
                                </table>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->

        <div class="modal fade notif" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
          <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Notification</h4>
                </div>
                <div class="modal-body">
                    <p class="notif-msg" style="text-align: center"></p>
                </div>
                <div class="modal-footer notif-foot">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-default extra">Button</button>
                </div>
            </div>
          </div>
        </div>

        <div class="modal fade edit-Fighter" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="edit-title">Edit Fighter</h4>
                </div>
                <div class="modal-body">
                    <label for="edit-name">Name</label>
                    <div class="input-group" style="width: 100%;">
                      <input type="text" class="form-control" id="edit-name" aria-describedby="basic-addon3">
                    </div>
                    <label for="edit-status" style="padding-top: 25px;">Status</label>
                    <div class="input-group" style="width: 100%; padding-bottom: 30px;">
                        <select id="edit-status" class="form-control">
                          <option value="Online">Online</option>
                          <option value="Offline">Offline</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">Close</button>
                    <a type="button" class="btn btn-success edit-scripting">Edit Script</a>
                    <button class="btn btn-success edit-button">Update</button>
                </div>
            </div>
          </div>
        </div>

    <script type="text/javascript">
        function showNotif(msg, foot=false){
            $(".notif-msg").html(msg);
            
            if(foot){
                $('.notif-foot > .extra').removeClass('btn-default');
                $('.notif-foot > .extra').addClass(foot[0]);
                $('.notif-foot > .extra').text(foot[1]);
                $('.notif-foot > .extra').attr('onclick', foot[2]);
                
                $('.notif-foot').css('display', 'block');
            }else{
                $('.notif-foot').css('display', 'none');
            }
            
            $('.notif').modal('show');
        }
    </script>

    <script type="text/javascript">
        $('div[data-route="dashboard"]').ready(function(){
            lv = $('.user-level').html();
            name = $('.user-username').html();
            console.log( parseInt(lv) );
            if(parseInt(lv) < 10){
                $('#newFighter').css('display', 'none');
            }
            
            if(name == 'ariomoklo'){
                $('#newFighter').css('display', 'block');
                $('#edit-status').append('<option val="Campaign">Campaign</option>')
            }
        });
        
        $('a[f-delete]').click(function(){
            id = $(this).attr('f-delete');
            nama = $(this).attr('data-name');
            showNotif('You sure to delete '+nama+' ?', ["btn-danger", "Delete", "deleting("+id+")"]); 
        });
        
        $('a[f-edit]').click(function(){
            name = $(this).attr('f-name');
            stat = $(this).attr('f-stat');
            link = $(this).attr('f-link');
            
            $('.edit-scripting').attr('href', link);
            
            $('#edit-name').val(name);
            $('#edit-status').val(stat);
            $('.edit-button').attr('f-id', $(this).attr('f-id'));
            
            $('.edit-Fighter').modal('show');
        });
        
        $('.edit-button').click(function(){
             name = $('#edit-name').val();
             stat = $('#edit-status').val();
             fid  = $(this).attr('f-id');
            
             $.post( "dashboard/upFighter", { id: fid, name: name, status: stat }).done(function(data) {
                $('.fighter'+fid+' > .naming').html(name);
                $('.fighter'+fid+' > .status').html(stat);
                $('.edit-Fighter').modal('hide'); 
                showNotif('Fighter is updated');
             }).fail(function(data) {
                showNotif('error, msg: '+data);
             });
        });
        
        function deleting (id){
            $.post( "dashboard/delFighter", { id: id }).done(function(data) {
                showNotif('Fighter is deleted');
            }).fail(function(data) {
                showNotif('error, msg: '+data);
            });
        }
    </script>