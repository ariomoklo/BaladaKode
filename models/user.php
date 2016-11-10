<?php

Class User extends Model{

    protected $id;
    protected $name;
    protected $pass;
    protected $image;
    
    public $exp;
    public $level;
    public $rep;

    public function __construct($id=null){
        if(!is_null($id)){
            $this->user_id = $id;
            $this->getUserData($id);
        }
    }
    
    public function levelingGift($level){
        if($level <= 3){
            return array('exp' => 250, 'rep' => 5);
        }else if($level == 4){
            return array('exp' => 500, 'rep' => 5);
        }else if($level == 5){
            return array('exp' => 750, 'rep' => 5);
        }else if($level < 10  && $level > 5){
            return array('exp' => 750, 'rep' => 7);
        }else if($level == 10){
            return array('exp' => 1000, 'rep' => 10);
        }else{
            return array('exp' => ((($level/5)-1)*250)+500, 'rep' => ((($level/5)-1)*5)+10);
        }
    }
    
    public function levelCheck($exp, $level){
        if($level <= 10){
            $constant = 500;
        }else if($level <= 30){
            $constant = 700;
        }else{
            $constant = 1000;
        }
        
        $nextExp = 0;
        for($i=1; $i<=$level; $i++){
            $nextExp += (500 + (intval($i/20)*500)) * $i;
        }
        
        if($exp > $nextExp){
            return true;
        }else{
            return false;
        }
    }
    
    public function levelUp($userid, $level, $exp, $rep){
        $result = $this->runQuery("UPDATE `profile` SET exp='$exp', level='$level', reputation='$rep' WHERE id_user='$userid'");
        
        if($result){
            return true;
        }else{
            return $result;   
        }
    }
    
    public function processGift($gift){
        $newExp = $this->exp + $gift['exp'];
        $newRep = $this->rep + $gift['rep'];
        $userid = $this->id;
        
        $result = $this->runQuery("UPDATE `profile` SET exp='$newExp', reputation='$newRep' WHERE id_user='$userid'");
        if($result){
            return true;
        }else{
            return $result;   
        }
    }
    
    public function addAchievement($key, $userid){
        $result = $this->runQuery("SELECT * FROM profile WHERE profile.id_user = '$userid' LIMIT 1");
        
        if($result){
            foreach ($result as $val) {
                $achieved = $val['achievement'];
            }
            
            foreach (explode("#", $achieved) as $val){
                if($val == $key){
                    return false;
                }
            }

            $achieved = $achieved.$key.'#';
        }else{
            $achieved = $key.'#';
        }
        
        return $this->runQuery("UPDATE `profile` SET achievement='$achieved' WHERE id_user='$userid'");
    }
    
    public function checkAchieved($fighter){
        
        $win = $fighter->win;
        $lose = $fighter->lose;
        $draw = $fighter->draw;
        $match = $fighter->match;
        $achieved = array();
        
        if($win > 3 && $lose == 0){
            $achieved[] = 'unbre';
        }
        
        if($win > 5 && $lose == 0){
            $achieved[] = 'crush';
        }
        
        if($match > 10){
            $achieved[] = 'famef';
        }
        
        if($win == $lose && $lose == $draw && $win != 0){
            $achieved[] = 'joker';
        }
        
        if($lose > $win && $win > $draw){
            $achieved[] = 'poops';
        }
        
        if($lose > 0){
            $achieved[] = 'loser';
        }
        
        if($win > 0){
            $achieved[] = 'stfig';
        }
        
        return $achieved;
    }
    
    public function getAchievement($userid){
        $result = $this->runQuery("SELECT * FROM profile WHERE profile.id_user = '$userid' LIMIT 1");
        $achievement = $this->runQuery("SELECT * FROM `achievement`");

        if(count($result)){
            foreach ($result as $key) {
                $achieved = explode("#", $key['achievement']);
            }
            
            $data = array();
            foreach($achievement as $list){
                $row = array();
                
                $row['key'] = $list['key'];
                $row['name'] = $list['name'];
                
                $i = 0;
                while($achieved[$i] != ''){
                    
                    if($list['key'] == $achieved[$i]){
                        $row['status'] = 'achieved';
                        break;
                    }
                    
                    $i++;
                }
                
                if(!isset($row['status'])){
                    $row['status'] = 'unachieved';
                }
                
                $data[] = $row;
            }

            return $data;
        }else{
            return false;
        }
    }

    public function searchUser($name){
        $result = $this->runQuery("SELECT * FROM user WHERE user.username = '$name' LIMIT 1");

        if(count($result)){
            foreach ($result as $key) {
                $data['id'] = $key['id'];
                $data['name'] = $key['username'];
                $data['pass'] = $key['password'];
            }

            return $data;
        }else{
            return false;
        }
    }

    public function getUserData($id){
        $result = Model::runQuery("SELECT user.id, user.username, user.password,
        user.image, profile.exp, profile.level, profile.reputation
        FROM user, profile WHERE user.id = '$id' AND profile.id_user = user.id LIMIT 1");

        foreach ($result as $data){
            $this->id = $data['id'];
            $this->name = $data['username'];
            $this->pass = $data['password'];
            $this->image = $data['image'];
            $this->exp = $data['exp'];
            $this->level = $data['level'];
            $this->rep = $data['reputation'];
        }
    }

    public function setUserId($user_id){
        $this->user_id = $user_id;
    }

    public function getUserId(){
        return $this->id;
    }

    public function getUserName(){
        return $this->name;
    }

    public function getUserPass(){
        return $this->pass;
    }
    
    public function getUserImage(){
        return $this->image;
    }
}