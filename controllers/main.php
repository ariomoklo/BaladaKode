<?php

class Main extends Controller{
    
    public $user;
    public $login = array('id'=>'','user'=>'', 'pass'=>'');

	public function index(){
        if (!Session::get('userid')) {
            $this->loadView('login');
        }else{
            header('location: '.BASE.'dashboard');
        }
	}

    public function PasstoHash($pass){
        $crypt = password_hash($pass, PASSWORD_DEFAULT);

        return strrev($crypt);;
    }

    // public function testhash($param){
    //     if (password_verify('nopasslikeadmin', strrev($param[0]))) {
    //         echo 'masuk';
    //     }else{
    //         echo 'tidak';
    //     }
    // }

    public function verifyUser(){
        $this->login['user'] = $_POST['user'];
        $this->login['pass'] = $_POST['pass'];

        $this->user = new User();
        $userfound = $this->user->searchUser($this->login['user']);
        if($userfound){
            // $userid = $this->user->getUserId();
            // header('Location: '.BASE.'home/dashboard/'.$userid);

            if(password_verify($this->login['pass'], strrev($userfound['pass']))){
                Session::set('userid', $userfound['id']);
                Session::set('username', $userfound['name']);
                echo json_encode($userfound);
            }else{
                echo json_encode("noPass");
            }
        }else{
            echo json_encode("noUser");
        }
    }
    
    public function Gsignin(){
        $username = $_POST['user'];
        $image = $_POST['image'];
        
        $this->user = new User();
        $userfound = $this->user->searchUser($username);
        if($userfound){
            Session::set('userid', $userfound['id']);
            Session::set('username', $userfound['name']);
            echo json_encode($userfound);
        }else{
            $fName = explode(" ", $username);
            $pass = $this->PasstoHash("google".$fName[0]);
            
            $this->user->newAccount($username, $pass, $image);
            $newUser = $this->user->searchUser($username);
            $this->user->newProfile($newUser['id']);
            Session::set('userid', $newUser['id']);
            Session::set('username', $newUser['name']);
            echo json_encode($newUser);
        }
    }

    public function logout(){
        unset($_COOKIE['userid']);
        setcookie('userid', null);
        setcookie('username', null);
        unset($_COOKIE['username']);
        header('Location: '.BASE);
    }
}