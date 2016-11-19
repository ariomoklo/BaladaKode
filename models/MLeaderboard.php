<?php

Class MLeaderboard extends Model{
    
    private $userid;
    
    public function getRank($userid, $key){
        
        if($key == 'champion'){
            $rankList = $this->Champion();
        }
        
        if($key == 'fame'){
            $rankList = $this->Fame();
        }
        
        if($key == 'master'){
            $rankList = $this->Master();
        }
        
        foreach($rankList as $rank => $value){
            if($value['id_user'] == $userid){
                $userRank = $rank;
                break;
            }else{
                $userRank = 'not found';
            }
        }
        
        return $userRank+1;
    }
    
    public function sortChamp($a, $b){
        return ($a['match'] > $b['match']) ? -1 : 1;
    }
    
    public function Champion(){
        $list = $this->runQuery("SELECT fight.*, user.* FROM `fight`, `user` WHERE fight.player = user.id AND fight.result='perfect' ORDER BY fight.player");
        
        $ranking = array();
        $data = array();
        $index = 0;
        $match = 0;
        foreach($list as $rank => $value){
            
            if($rank == 0){
                $currentPlayer = $value['player'];
            }
            
            if($currentPlayer == $value['player']){
                $data['id_user'] = $value['id_user'];
                $data['username'] = $value['username'];
                $data['match'] = $match;
                $match++;
            }else{
                $match = 0;
                $index++;
                
                $data['id_user'] = $value['id_user'];
                $data['username'] = $value['username'];
                $data['match'] = $match;
                $match++;
            }
            
            $ranking[$index] = $data;
        }
     
        if(count($ranking)){
            usort($ranking, array("MLeaderboard", "sortChamp"));
        }else{
            return false;
        }
    }
    
    public function Fame(){
        return $this->runQuery("SELECT profile.id_user, user.username, profile.reputation FROM `profile`, `user` WHERE profile.id_user = user.id ORDER BY `reputation` DESC");
    }
    
    public function Master(){
        return $this->runQuery("SELECT profile.id_user, user.username, profile.exp FROM `profile`, `user` WHERE profile.id_user = user.id ORDER BY `exp` DESC");
    }
}