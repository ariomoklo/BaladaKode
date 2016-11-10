<?php

Class Database{
    protected $connection;
    protected $host;
    protected $user;
    protected $pass;
    protected $dbname;

    public function __construct(){
        $this->host = Config::get('DB.HOST');
        $this->user = Config::get('DB.USER');
        $this->pass = Config::get('DB.PASSWORD');
        $this->dbname = Config::get('DB.NAME');

        $this->startConnection();
    }

    protected function startConnection(){
        $this->connection = new mysqli($this->host, $this->user, $this->pass, $this->dbname);

        if (mysqli_connect_error()){
            throw new Exception('Could not connect to Database');
        }

        if(!$this->connection){
            return false;
        }else{
            return true;
        }
    }

    public function query($sql){
        if(!$this->connection){
            return false;
        }

        $result = $this->connection->query($sql);

        if(mysqli_error($this->connection)){
            throw new Exception(mysqli_error($this->connection));
        }

        if(is_bool($result)){
            return $result;
        }

        $data = array();
        while ( $row = mysqli_fetch_assoc($result) ){
            $data[] = $row;
        }
        return $data;
    }
}