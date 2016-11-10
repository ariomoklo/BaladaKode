<?php

Class Script extends Model{
    
    public function getAll($id_user){
        $result = $this->runQuery("SELECT * FROM script WHERE script.id_user = '$id_user'");

        if(count($result)){
            return $result;
        }else{
            return false;
        }
    }
    
    public function getById($id_user, $id){
        $result = $this->runQuery("SELECT * FROM script WHERE script.id_user = '$id_user' AND script.id = '$id' LIMIT 1");

        if(count($result)){
            foreach ($result as $key => $value) {
                $data = $value;
            }

            return $data;
        }else{
            return false;
        }
    }
    
    public function newScript($id_user, $name, $script){
        $query = sprintf("INSERT INTO `script` (`id`, `id_user`, `name`, `script`) VALUES (NULL, '%s', '%s', '%s')",
            mysql_real_escape_string($id_user),
            mysql_real_escape_string($name),
            mysql_real_escape_string($script)
        );
        
        $result = $this->runQuery($query);
        if($result){
            return true;
        }else{
            return $result;   
        }
    }
    
    public function upScript($id, $id_user, $name, $script){
        $query = sprintf("UPDATE `script` SET id_user='%s', name='%s', script='%s' WHERE script.id='%s'",
            mysql_real_escape_string($id_user),
            mysql_real_escape_string($name),
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
    
    public function delScript($id){
        $result = $this->runQuery("DELETE FROM script WHERE script.id = '$id'");
        if($result){
            return true;
        }else{
            return $result;   
        }
    }
    
    
}