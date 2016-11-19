<?php

class Dashboard extends Controller{
    
    public $user;
    public $fighter;
    public $battle;
    public $leaderboard;
    public $userid;
    public $username;
    
    private $notification;
    
    public function setData(){
        $this->userid = Session::get('userid');
        $this->username = Session::get('username');
        
        $this->user = new User($this->userid);
        $this->fighter = new Fighter();
        $this->battle = new Fight();
        $this->leaderboard = new MLeaderboard();
        $this->notification = array();
    }
    
    public function addNotification($msg, $type){
        $newNotif = array('msg' => $msg, 'type' => $type);
        $this->notification[] = $newNotif;
    }
    
    public function getProfile(){
        $data['username']   = $this->user->getUserName();
        $data['image_url']  = $this->user->getUserImage();
        $data['exp']        = $this->user->exp;
        $data['level']      = $this->user->level;
        $data['rep']        = $this->user->rep;
        
        
//        $data['chaRank'] = $this->leaderboard->getRank($this->userid, 'champion');
//        $data['famRank'] = $this->leaderboard->getRank($this->userid, 'fame');
//        $data['masRank'] = $this->leaderboard->getRank($this->userid, 'master');
        
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
        
        $newAchieved = $this->user->checkAchieved();
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
    
    public function test(){
        $this->setData();
        
        print_r($this->battle->allCampaign($this->userid));
    }

	public function index(){
        if (!Session::get('userid')) {
            header('location: '.BASE);
        }else{
            $this->setData();
            
            $data = $this->getProfile();
            $data["Myfighter"] = $this->fighter->getFighter($this->userid);
            $data["allBattle"] = $this->battle->allFight($this->userid);
            $data["Campaign"] = $this->battle->allCampaign($this->userid);
            
            $this->loadView('layout/header', $data);
            $this->loadView('dashboard', $data);
            $this->loadView('battle', $data);
            $this->loadView('achieved', $data);
            $this->loadView('layout/footer');
        }
	}
    
    public function editor($params){
        $this->setData();
        $data['id'] = $params[0];
       
        if($data['id'] != 'new'){
            $scriptData = $this->fighter->getFighterDetail($data['id']);
        
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
    
    public function newFighter(){
        $id = $_POST['userid'];
        $script = $_POST['script'];
        $name = $_POST['name'];
        $status = $_POST['status'];
        
        $this->setData();
        
        echo $this->fighter->newFighter($id, $script, $name, $status);
    }
    
    public function getFighter(){
        $id = $_POST['id'];
        
        $this->setData();
        $data = $this->fighter->getFighterDetail($id);
        
        echo json_encode($data);
    }
    
    public function getBattle(){
        $id = $_POST['id'];
        
        $this->setData();
        $data = $this->battle->fightDetail($id);
        
        echo json_encode($data);
    }
    
    public function upFighter(){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $status = $_POST['status'];
        
        $this->setData();
        
        echo $this->fighter->upFighter($id, $name, $status);
    }
    
    public function upScript(){
        $id = $_POST['id'];
        $script = $_POST['script'];
        
        $this->setData();
        
        echo $this->fighter->upScript($id, $script);
    }
    
    public function delFighter(){
        $id = $_POST['id'];
        
        $this->setData();
        $data = $this->fighter->delFighter($id);
        
        echo $data;
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