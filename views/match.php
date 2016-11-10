    <!-- Page Content -->
    <div id="codeballad" class="container data-page" data-route="match">
        <!-- Marketing Icons Section -->
        <div class="row"><br>
             <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a loadScene="dashboard">Dashboard</a></li>
                    <li class="active">Match</li>
                </ol>
            </div>
            <div class="col-lg-12">
                <div class="col-lg-4">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">Available Opponent</h3>
                        </div>
                        <table idFighter="<?php echo $data['idFighter'];?>" id="matchList" class="table">
                            <tbody>
                            <?php 
                            if($data['allOnline'] != null){    
                                foreach($data['allOnline'] as $fighter){
                                    echo '<tr class="list-group-item">
                                            <td style="width:80%;"><h4>'.$fighter['username'].'</h4></td>
                                            <td><a f-id="'.$fighter['id'].'" class="btn btn-default" style="margin-top:5px; margin-left: 15px">Fight</a></td>
                                        </tr>';
                                }
                            }else{
                                echo "<center noFighter><h3>None Available</h3></center>";
                            }?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-8">
                        <div class="col-lg-12">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Match History</h3>
                                </div>
                                <table class="table">
                                    <thead <thead style="background-color: ghostwhite;">
                                        <td>#</td>
                                        <td>Opponent</td>
                                        <td>Opponent Fighter</td>
                                        <td>Result</td>
                                        <td style="text-align: center;">Simulation</td>
                                    </thead>
                                    <tbody>
                                        <?php if($data['matchHistory']){
                                            foreach($data['matchHistory'] as $match => $value){
                                                if($value['sim']){
                                                    $sim = '<a sim-play href="'.BASE.'match/play/'.$value['id'].'" class="btn btn-default">Play</a>';
                                                }else{
                                                    $sim = 'NONE';
                                                }
                                                
                                                echo '<tr>
                                                    <td>'.($match+1).'</td>
                                                    <td>'.$value['opName'].'</td>
                                                    <td>'.$value['fName'].'</td>
                                                    <td>'.$value['result'].'</td>
                                                    <td><center>'.$sim.'</center></td>
                                                </tr>';
                                            }
                                        }?>
                                    </tbody>
                                </table>
                            </div>  
                        </div> 
                    </div>
                </div>
            <div class="col-lg-12"><br><br></div>
            </div>
        </div>
        <!-- /.row -->
    </div>

    <script type="text/javascript">
        $('a[f-id]').click(function(){
            userFighter = $('#matchList').attr('idFighter');
            opponent = $(this).attr('f-id');
            
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
            
            $.post( "match", { red:userFighter, blue:opponent, win:win, lose:lose, draw:draw }).done(function( data ) {
                id = data.replace(/\s/g, '');
                window.location = 'match/play/'+id;
            });
        });
    </script>