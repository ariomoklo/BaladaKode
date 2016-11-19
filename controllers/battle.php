<?php

class Battle extends Controller{
    public $user;
    public $fighter;
    public $battle;
    public $userid;
    public $username;
    
    public function setData(){
        $this->userid = Session::get('userid');
        $this->username = Session::get('username');
        
        $this->user = new User($this->userid);
        $this->fighter = new Fighter();
        $this->battle = new Fight();
    }
    
    public function index($params){
        $this->setData();
        $data['id'] = $params[0];
       
        $enemy = $this->fighter->getFighterDetail($data['id']);
        $fight = $this->battle->fightDetail($this->userid, $enemy['id']);
        
        $data['enid'] = $enemy['id'];
        $data['enuser'] = $enemy['username'];
        $data['enname'] = $enemy['name'];
        $data['enscript'] = $enemy['script'];
        
        $data['userid'] = $this->userid;
        
        if($fight){
            $data['battleid'] = $fight['id'];
            $data['result'] = $fight['result'];
        }else{
            $data['battleid'] = 'new';
            $data['result'] = 'none';
        }

        $this->loadView('static/battle', $data);
    }
    
    public function upFight(){
        $id = $_POST['id'];
        $result = $_POST['result'];
        
        $this->setData();
        
        return $this->battle->upResult($id, $result);
    }
    
    public function newBattle(){
        $userid = $_POST['userid'];
        $enemy  = $_POST['enemyid'];
        $result = $_POST['result'];
        
        $this->setData();
        
        return $this->battle->newResult($userid, $enemy, $result);
    }
    
    public function getScript(){
        $id = $_POST['id'];
        $this->loadModel();
        $match = $this->fighter->getMatch($id);
        $this->setData($match['player'], $match['enemy']);

        $script = array('red' => $this->redScript['script'], 'blue' => $this->blueScript['script']);
        
        echo json_encode($script);
    }
}