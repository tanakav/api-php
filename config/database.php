<?php

class Database{
    
    private $host = "127.0.0.1";
    private $dbname = "api-mentes";
    private $port = 3307;
    private $username = "root";
    private $password = "password";
    public $connection;

    public function getConnection(){
        $this->connection = null;
        try{
            $this->connection = new PDO(
                "mysql:host=".$this->host.";
                port=".$this->port.";
                dbname=".$this->dbname."",
                $this->username,
                $this->password
            );
            $this->connection->exec("set names utf8");
        }catch (PDOException $e){
            echo "Problemas na conexão ao banco de dados: ".$e->getMessage();
        }
        return $this->connection;
    }
}