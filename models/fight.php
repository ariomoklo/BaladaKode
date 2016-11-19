<?php

Class Fight extends Model{
    
    public function allFight($userid){
        $fight = $this->runQuery("SELECT fighter.*, user.username, user.image FROM fighter, user WHERE fighter.id_user != '$userid' AND fighter.status='Online' AND fighter.id_user = user.id");
        $result = $this->runQuery("SELECT fight.enemy, fight.result FROM fight WHERE fight.player = '$userid'");
        
        if(count($result)){
            $data = array();
            foreach($fight as $key => $val){
                $battle = array();
                
                $battle['id'] = $val['id'];
                $battle['id_user'] = $val['id_user'];
                $battle['script']   = $val['script'];
                $battle['name']   = $val['name'];
                $battle['status']   = $val['status'];
                $battle['defeated']   = $val['defeated'];
                $battle['username']   = $val['username'];
                $battle['image']   = $val['image'];
                foreach($result as $i => $dat){
                    if($val['id'] == $dat['enemy']){
                        $battle['result'] = $dat['result'];
                    }
                }
                
                if(!isset($battle['result'])){
                    $battle['result'] = 'none';
                }
                
                $data[] = $battle;
            }
            
            return $data;
        }else{
            return false;
        }
    }
    
    public function allCampaign($userid){
        $fight = $this->runQuery("SELECT fighter.id FROM fighter WHERE fighter.status='Campaign'");
        $result = $this->runQuery("SELECT fight.enemy, fight.result FROM fight WHERE fight.player = '$userid'");
        
        if(count($result)){
            $data = array();
            foreach($fight as $key => $val){
                $res = null;
                foreach($result as $i => $dat){
                    if($val['id'] == $dat['enemy']){
                        $res = $dat['result'];
                    }
                }
                
                if(is_null($res)){
                    $res = 'none';
                }
                
                $data[] = json_decode('{ "id": "'.$val['id'].'", "result": "'.$res.'" }');
            }
            
            return $data;
        }else{
            return false;
        }
    }
    
    public function fightDetail($userid, $enemy){
        $result = $this->runQuery("SELECT * FROM fight WHERE fight.player = '$userid' AND fight.enemy = '$enemy' LIMIT 1");

        if(count($result)){
            foreach ($result as $key => $val) {                
                $data = $val;
            }
            
            return $data;
        }else{
            return false;
        }
    }
    
    
    
    public function newResult($userid, $fighter, $res){      
        $result = $this->runQuery("INSERT INTO `fight` (`id`, `player`, `enemy`, `result`) VALUES (NULL, '$userid', '$fighter', '$res')");
        if(res == 'good'){
            $gift = array('exp'=>500, 'rep'=>5);
        }else if(res == 'perfect'){
            $gift = array('exp'=>1000, 'rep'=>10);
        }
        
        if($result){
            return $gift;
        }else{
            return $result;   
        }
    }
    
    public function upResult($id, $res){
        $result = $this->runQuery("UPDATE `fight` SET result='$res' WHERE fighter.id='$id'");
        if($result){
            return true;
        }else{
            return $result;   
        }
    }
}