<?php

class Database{
    
    private $host = "localhost";
    private $dbname = "demo_api";
    private $username = "root";
    private $password = "";
    public $connection;

    public function getConnection(){
        $this->connection = null;

        try{
            $this->connection = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname,$this->username,$this->password);
            $this->connection->exec("set names utf8");
        }catch (PDOException $e){
            echo "Problemas na conexão ao banco de dados: ".$e->getMessage();
        }

        return $this->connection;
    }
}