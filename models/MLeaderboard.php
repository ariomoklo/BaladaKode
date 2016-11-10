<?php

class MLeaderboard extends Model{
    
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
    
    public function Champion(){
        $list = $this->runQuery("SELECT fighter.id_user, user.username, fighter.win, fighter.lose, fighter.draw FROM `fighter`, `user` WHERE fighter.id_user = user.id ORDER BY fighter.win DESC");
        
        $ranking = array();
        foreach($list as $rank => $value){
            $data = array();
            $data['id_user'] = $value['id_user'];
            $data['username'] = $value['username'];
            $data['win'] = $value['win'];
            $data['match'] = $value['win'] + $value['lose'] + $value['draw'];
            $ranking[] = $data;
        }
     
        return $ranking;
    }
    
    public function Fame(){
        return $this->runQuery("SELECT profile.id_user, user.username, profile.reputation FROM `profile`, `user` WHERE profile.id_user = user.id ORDER BY `reputation` DESC");
    }
    
    public function Master(){
        return $this->runQuery("SELECT profile.id_user, user.username, profile.exp FROM `profile`, `user` WHERE profile.id_user = user.id ORDER BY `exp` DESC");
    }
}