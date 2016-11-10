<?php

Class Model{
    protected $db;

    protected function loadDatabase(){
        $this->db = CodeBallad::getDatabase();
    }

    public function runQuery($sql){
        $this->loadDatabase();
        return $this->db->query($sql);
    }
}