<?php

Class Fighter extends Model{
    
    public function getFighter($id_user){
        $result = $this->runQuery("SELECT fighter.id, fighter.id_user, fighter.id_script, fighter.name, fighter.status, fighter.win, fighter.lose, fighter.draw, script.name AS script_name FROM fighter, script WHERE fighter.id_user = '$id_user' AND fighter.id_script = script.id LIMIT 1");
        
        if(count($result)){
            foreach ($result as $key) {
                
                $totalMatch = $key['win'] + $key['lose'] + $key['draw'];
                
                $data = '{  "id": "'.$key['id'].'", 
                            "id_user": "'.$key['id_user'].'", 
                            "id_script": "'.$key['id_script'].'",
                            "name": "'.$key['name'].'", 
                            "status": "'.$key['status'].'", 
                            "win": "'.$key['win'].'", 
                            "lose": "'.$key['lose'].'",
                            "draw": "'.$key['draw'].'",
                            "match": "'.$totalMatch.'",
                            "script_name": "'.$key['script_name'].'"
                }';
            }
            
            return json_decode($data);
        }else{
            return false;
        }
    }
    
    public function getAllOnline($id_user){
        $result = $this->runQuery("SELECT fighter.id, fighter.name, fighter.id_user, user.username FROM fighter, user WHERE fighter.id_user != '$id_user' AND fighter.status='Online' AND fighter.id_user = user.id");

        if(count($result)){
            return $result;
        }else{
            return false;
        }
    }
    
    public function upFighter($id, $id_script, $name){
        $query = sprintf("UPDATE `fighter` SET id_script='%s', name='%s' WHERE fighter.id='%s'",
            mysql_real_escape_string($id_script),
            mysql_real_escape_string($name),
            mysql_real_escape_string($id)
        );
        
        $result = $this->runQuery($query);
        if($result){
            return true;
        }else{
            return $result;   
        }
    }
    
    public function resultMatch($id, $point, $key){
        
        if($key == 'win'){
            $query = "UPDATE `fighter` SET win='$point' WHERE fighter.id='$id'";
            $gift = array('exp'=>1000, 'rep'=>10);
        }else if($key == 'lose'){
            $query = "UPDATE `fighter` SET lose='$point' WHERE fighter.id='$id'";
            $gift = array('exp'=>500, 'rep'=>0);
        }else if($key == 'draw'){
            $query = "UPDATE `fighter` SET draw='$point' WHERE fighter.id='$id'";
            $gift = array('exp'=>0, 'rep'=>(-5));
        }
        
        $result = $this->runQuery($query);
        if($result){
            return $gift;
        }else{
            return $result;   
        }
    }
    
    public function changeStatus($id, $status){
        $result = $this->runQuery("UPDATE fighter SET status = '$status' WHERE fighter.id = '$id'");
        if($result){
            $result = $this->runQuery("SELECT fighter.status FROM fighter WHERE fighter.id = '$id' LIMIT 1");
            foreach ($result as $key) {
                $data = $key['status'];
            }
            return $data;
        }else{
            return $result;   
        }
    }
    
    public function newMatch($red, $blue, $win, $lose, $draw){
        $result = $this->runQuery("INSERT INTO `match` (`id`, `id_red`, `id_blue`, `sim`, `win`, `lose`, `draw`) VALUES (NULL, '$red', '$blue', '1', '$win', '$lose', '$draw')");
        
        $match = $this->runQuery("SELECT id FROM `match` WHERE id_red='$red' AND id_blue='$blue' OR win='$win' OR lose='$lose' OR draw='$draw'");
        foreach ($match as $key) {
            $data = $key['id'];
        }
        
        if($data){
            return $data;
        }else{
            return $result;   
        }
    }
    
    public function getMatch($id){
        $result = $this->runQuery("SELECT * FROM `match` WHERE id='$id' LIMIT 1");

        if(count($result)){
            foreach ($result as $key => $value) {
                $data = $value;
            }

            return $data;
        }else{
            return false;
        }
    }
    
    public function matchHistory($id){
        $history = $this->runQuery("SELECT * FROM `match` WHERE id_red='$id' OR id_blue='$id'");
        $fighterData = $this->runQuery('SELECT fighter.id, user.username, fighter.name FROM fighter, user WHERE fighter.id_user = user.id');
        
        $data = array();
        foreach($history as $match){
            $row = array();
            
            if($match['id_red'] == $id){
                $oppo = $match['id_blue'];
            }else{
                $oppo = $match['id_red'];
            }
            
            foreach($fighterData as $fighter){
                if($fighter['id'] == $oppo){
                    $row['id'] = $match['id'];
                    $row['opName'] = $fighter['username'];
                    $row['fName'] = $fighter['name'];
                    $row['sim'] = $match['sim'];
                    
                    if($match['draw']){
                        $row['result'] = 'Draw';
                    }else{
                        if($match['win'] == $id){
                            $row['result'] = 'Win';
                        }else{
                            $row['result'] = 'Lose';
                        }
                    }
                    break;
                }
            }
            $data[] = $row;
        }
        
        if(count($data)){
            return $data;
        }else{
            return false;
        }
    }
}