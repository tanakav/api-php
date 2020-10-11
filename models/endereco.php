<?php

class Endereco{
    private $connection;
    private $table = "`api-mentes`.enderecos";

    public $id;
    public $logradouro;
    public $created_at;
    public $updated_at;

    public function __construct($conn){
        $this->connection = $conn;
    }

    public function findAll(){
        $query = "SELECT *
                FROM ".$this->table."
        ";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function findById(){
        $query = "SELECT *
                FROM ".$this->table." enderecos
                WHERE enderecos.id = :id
        ";

        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        $enderecos = $stmt->fetch(PDO::FETCH_ASSOC);

        return $enderecos;
    }
}