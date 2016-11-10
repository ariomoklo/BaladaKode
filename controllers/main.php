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

    public function PasstoHash($param){
        $crypt = password_hash($param[0], PASSWORD_DEFAULT);

        echo strrev($crypt);;
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

    public function logout(){
        unset($_COOKIE['userid']);
        setcookie('userid', null);
        setcookie('username', null);
        unset($_COOKIE['username']);
        header('Location: '.BASE);
    }
}