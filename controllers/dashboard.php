<?php

class Dashboard extends Controller{
    
    public $user;
    public $fighter;
    public $script;
    public $leaderboard;
    public $userid;
    public $username;
    
    private $notification;
    
    public function setData(){
        $this->userid = Session::get('userid');
        $this->username = Session::get('username');
        
        $this->user = new User($this->userid);
        $this->fighter = new Fighter();
        $this->script = new Script();
        $this->leaderboard = new MLeaderboard();
        $this->notification = array();
    }
    
    public function addNotification($msg, $type){
        $newNotif = array('msg' => $msg, 'type' => $type);
        $this->notification[] = $newNotif;
    }
    
    public function getFighter(){
        $data['fighter'] = $this->fighter->getFighter($this->userid);
        $data['script'] = $this->script->getAll($this->userid);
        
        $level = $this->user->level;
        if($level < 5){
            $data['belt'] = 'belt-white';
        }else if($level < 10 && $level > 4){
            $data['belt'] = 'belt-yellow';
        }else if($level >= 10){
            $data['belt'] = 'belt-black';
        }
        
        return $data;
    }
    
    public function match(){
        $userFighter = $this->fighter->getFighter($this->userid);
        
        $data['allOnline'] = $this->fighter->getAllOnline($this->userid);
        $data['matchHistory'] = $this->fighter->matchHistory($userFighter->id);        
        $data['idFighter'] = $userFighter->id;
        
        return $data;
    }
    
//    public function test($params){
//        $level = $params[0];
//        echo 'Level | different <br>';
//        
//        $nextExp = 0;
//        for($i=1; $i<=$level; $i++){
//            echo $i;
//            $nextExp += (500 + (intval($i/20)*500)) * $i;
//            echo ' | '.$nextExp.'<br>';
//        }
//        echo '...';
//    }
    
    public function getProfile(){
        $data['username']   = $this->user->getUserName();
        $data['image_url']  = $this->user->getUserImage();
        $data['exp']        = $this->user->exp;
        $data['level']      = $this->user->level;
        $data['rep']        = $this->user->rep;
        
        $myF = $this->fighter->getFighter($this->userid);
        
        $data['allWin'] = $myF->win;
        $data['allLose'] = $myF->lose;
        
        $data['chaRank'] = $this->leaderboard->getRank($this->userid, 'champion');
        $data['famRank'] = $this->leaderboard->getRank($this->userid, 'fame');
        $data['masRank'] = $this->leaderboard->getRank($this->userid, 'master');
        
        $dataAchieved = $this->user->getAchievement($this->userid);
        
        if($this->user->levelCheck($data['exp'], $data['level'])){
            $newLevel = $data['level'] + 1;
            $gift = $this->user->levelingGift($newLevel);
            
            $newExp = $data['exp'] + $gift['exp'];
            $newRep = $data['rep'] + $gift['rep'];
            
            $this->user->levelUp($this->userid, $newLevel, $newExp, $newRep);
            $data['exp'] = $newExp;
            $data['level'] = $newLevel;
            $data['rep'] = $newRep;
            
            $this->addNotification('<strong>Level Up!</strong> Congratulation in reaching level '.$newLevel, 'success');
            
            $this->user->exp = $data['exp'];
            $this->user->level = $data['level'];
            $this->user->rep = $data['rep'];
            
            if($newLevel < 5){
                $this->user->addAchievement('wbelt', $this->userid);
                $this->addNotification('<strong>Grade Up!</strong> Congratulation your fighter become White Belt', 'success');
            }else if($newLevel < 10 && $newLevel > 4){
                $this->user->addAchievement('ybelt', $this->userid);
                $this->addNotification('<strong>Grade Up!</strong> Congratulation your fighter become Yellow Belt', 'success');
            }else if($newLevel >= 10){
                $this->user->addAchievement('bbelt', $this->userid);
                $this->addNotification('<strong>Grade Up!</strong> Congratulation your fighter become Black Belt', 'success');
            }
            
        }
        
        $newAchieved = $this->user->checkAchieved($myF);
        if(count($newAchieved) > 0){
            $unlocked = 0;
            foreach($newAchieved as $key){
                if($this->user->addAchievement($key, $this->userid)){
                    $unlocked++;
                }
            }
            $newAchieved = $this->user->getAchievement($this->userid);
            if($unlocked > 0) {
                $this->addNotification('<strong>New Achievement!</strong> '.$unlocked.' achievement has been unlocked', 'success'); }
            
            $data['achieved'] = $newAchieved;
        }else{
            $data['achieved'] = $dataAchieved;
        }
        
        
        if(count($this->notification) > 0){
           $data['notif'] = $this->notification; 
        }
        
        return $data;
    }

	public function index(){
        if (!Session::get('userid')) {
            header('location: '.BASE);
        }else{
            $this->setData();
            
            $data = $this->getProfile();
            $this->loadView('layout/header', $data);
            $this->loadView('dashboard', $data);
            
            $this->loadView('match', $this->match());
            
            $this->loadView('fighter', $this->getFighter());
            $this->loadView('skill', $data);
            $this->loadView('profile', $data);
            $this->loadView('layout/footer');
        }
	}
    
    public function editor($params){
        $this->setData();
        $data['id'] = $params[0];
       
        if($data['id'] != 'new'){
            $scriptData = $this->script->getById($this->userid, $data['id']);
        
            $data['userid'] = $this->userid;
            $data['username'] = $this->username;
            $data['name'] = $scriptData['name'];
            $data['script'] = $scriptData['script'];
        }else{
            $data['userid'] = $this->userid;
            $data['username'] = $this->username;
            $data['name'] = '';
            $data['script'] = '	//Put your code bellow, example: Punch();';
        }
        
        $this->loadView('static/editor', $data);
    }
    
    public function newScript(){
        $userid = $_POST['userid'];
        $name = $_POST['name'];
        $script = $_POST['script'];
        
        $this->setData();
        
        echo $this->script->newScript($userid, $name, $script);
    }
    
    public function upScript(){
        $id = $_POST['id'];
        $userid = $_POST['userid'];
        $name = $_POST['name'];
        $script = $_POST['script'];
        
        $this->setData();
        
        echo $this->script->upScript($id, $userid, $name, $script);
    }
    
    public function delScript(){
        $id = $_POST['id'];
        
        $this->setData();
        
        echo $this->script->delScript($id);
    }
    
    public function upFighter(){
        $id = $_POST['id'];
        $script = $_POST['script'];
        $name = $_POST['name'];
        
        $this->setData();
        
        echo $this->fighter->upFighter($id, $script, $name);
    }
    
    public function CSFighter(){
        $id = $_POST['id'];
        $status = $_POST['status'];
        
        $this->setData();
        
        echo $this->fighter->changeStatus($id, $status);
    }
    
    public function logout(){
        Session::destroy();
        header('Location: '.BASE);
    }
}