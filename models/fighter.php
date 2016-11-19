<?php

Class Fighter extends Model{
    
    public function getFighter($id_user){
        $result = $this->runQuery("SELECT * FROM fighter WHERE fighter.id_user = '$id_user'");
        
        if(count($result)){
            return $result;
        }else{
            return false;
        }
    }
    
    public function getFighterDetail($id){
        $result = $this->runQuery("SELECT fighter.*, user.username, user.image FROM fighter, user WHERE fighter.id_user = user.id AND fighter.id = '$id' LIMIT 1");
        
        if($result){
            foreach ($result as $key => $val) {                
                $data = $val;
            }
            
            return $data;
        }else{
            return false;   
        }
    }
    
    public function newFighter($userid, $script, $name, $status){
        $query = sprintf("INSERT INTO `fighter` (`id`, `id_user`, `script`, `name`, `status`, `defeated`) VALUES (NULL, '%s', '%s', '%s', '%s', '0')",
            mysql_real_escape_string($userid),
            mysql_real_escape_string($script),
            mysql_real_escape_string($name),
            mysql_real_escape_string($status)
        );
        
        $result = $this->runQuery($query);
        if($result){
            return true;
        }else{
            return $result;   
        }
    }
    
    public function upFighter($id, $name, $status){
        $query = sprintf("UPDATE `fighter` SET name='%s', status='%s' WHERE fighter.id='%s'",
            mysql_real_escape_string($name),
            mysql_real_escape_string($status),
            mysql_real_escape_string($id)
        );
        
        $result = $this->runQuery($query);
        if($result){
            return true;
        }else{
            return $result;   
        }
    }
    
    public function upScript($id, $script){
        $query = sprintf("UPDATE `fighter` SET script='%s' WHERE fighter.id='%s'",
            mysql_real_escape_string($script),
            mysql_real_escape_string($id)
        );
        
        $result = $this->runQuery($query);
        if($result){
            return true;
        }else{
            return $result;   
        }
    }
    
    public function changeStatus($id, $status){
        $result = $this->runQuery("UPDATE fighter SET status = '$status' WHERE fighter.id = '$id'");
        if($result){
            $result = $this->runQuery("SELECT fighter.status FROM fighter WHERE fighter.id = '$id' LIMIT 1");
            foreach ($result as $key) {
                $data = $key['status'];
            }
            return $data;
        }else{
            return $result;   
        }
    }
    
    public function delFighter($id){
        $result = $this->runQuery("DELETE FROM `fighter` WHERE id='$id'");
        
        if($result){
            return true;
        }else{
            return $result;   
        }
    }
}