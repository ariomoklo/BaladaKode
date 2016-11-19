<?php

class Leaderboard extends Controller{
    
    public $leaderboard;
    public $data = array();
    
    public function index(){
        $this->leaderboard = new MLeaderboard();
        $this->data['cham'] = $this->leaderboard->Champion();
        $this->data['fame'] = $this->leaderboard->Fame();
        $this->data['mast'] = $this->leaderboard->Master();
        
        $this->loadView('static/leaderboard', $this->data);
    }
    
    public function test(){
        $this->leaderboard = new MLeaderboard();
        print_r($this->leaderboard->Champion());
    }
}