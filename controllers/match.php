<?php

class Match extends Controller{
    public $id;
    public $red_id;
    public $blue_id;
    
    private $red;
    private $blue;
    private $redScript;
    private $blueScript;
    
    private $fighter;
    private $script;
    
    public function loadModel(){
        $this->fighter = new Fighter();
        $this->script = new Script();
    }
    
    public function setData($red_id, $blue_id){
        $this->red_id = $red_id;
        $this->blue_id = $blue_id;
        
        $this->red = $this->fighter->getFighter($this->red_id);
        $this->blue = $this->fighter->getFighter($this->blue_id);
        
        $this->redScript = $this->script->getById($this->red_id, $this->red->id_script);
        $this->blueScript = $this->script->getById($this->blue_id, $this->blue->id_script);
    }
    
    public function index(){
        if(isset($_POST)){
            $this->loadModel();
            $this->setData($_POST['red'], $_POST['blue']);

            $win = $_POST['win'];
            $lose = $_POST['lose'];
            $draw = $_POST['draw'];
            
            if($draw){
                $this->red->draw += 1;
                $this->blue->draw += 1;
                
                $red_gift = $this->fighter->resultMatch($this->red_id, $this->red->draw, 'draw');
                $blue_gift = $this->fighter->resultMatch($this->blue_id, $this->blue->draw, 'draw');
            }else{
                if($win == $this->red_id){
                    $this->red->win += 1;
                    $this->blue->lose += 1;
                    
                    $red_gift = $this->fighter->resultMatch($this->red_id, $this->red->win, 'win');
                    $blue_gift = $this->fighter->resultMatch($this->blue_id, $this->blue->lose, 'lose');
                }else{
                    $this->red->lose += 1;
                    $this->blue->win += 1;
                    
                    $red_gift = $this->fighter->resultMatch($this->red_id, $this->red->lose, 'lose');
                    $blue_gift = $this->fighter->resultMatch($this->blue_id, $this->blue->win, 'win');
                }
            }
            
            $red_user = new User($this->red->id_user);
            $blue_user = new User($this->blue->id_user);
            
            $red_user->processGift($red_gift);
            $blue_user->processGift($blue_gift);

            echo $this->fighter->newMatch($this->red_id, $this->blue_id, $win, $lose, $draw);
        }else{
            header('location: '.BASE);
        }
    }
    
    public function play($params){
        $this->loadModel();
        $this->id = $params[0];
        $match = $this->fighter->getMatch($this->id);
        
        if($match['sim']){
            $this->setData($match['id_red'], $match['id_blue']);
            
            $data['id'] = $this->id;
            
            $data['red'] = $this->red;
            $data['blue'] = $this->blue;
            
            $redUser = new User($this->red->id_user);
            $blueUser = new User($this->blue->id_user);
            
            $data['redUser'] = $redUser->getUserName();
            $data['blueUser'] = $blueUser->getUserName();
            
            $data['redScript'] = $this->redScript;
            $data['blueScript'] = $this->blueScript;
            
            $this->loadView('static/play', $data);
        }else{
            $data['message'] = 'Simulation is not available';
            $this->loadView('static/404', $data);
        }
    }
    
    public function getScript(){
        $id = $_POST['id'];
        $this->loadModel();
        $match = $this->fighter->getMatch($id);
        $this->setData($match['id_red'], $match['id_blue']);

        $script = array('red' => $this->redScript['script'], 'blue' => $this->blueScript['script']);
        
        echo json_encode($script);
    }
}