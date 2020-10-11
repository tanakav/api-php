<?php

class Cidade{
    private $connection;
    private $table = "`api-mentes`.cidades";

    public $id;
    public $nome;
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
                FROM ".$this->table." cidades
                WHERE cidades.id = :id
        ";

        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        $cidade = $stmt->fetch(PDO::FETCH_ASSOC);

        return $cidade;
    }

    public function usuariosPorCidade(){
        $query ="
            SELECT cidades.id, cidades.nome, count(usuarios.id) as usuarios
            FROM ".$this->table." cidades
            INNER JOIN `api-mentes`.usuarios usuarios
            ON cidades.id = usuarios.cidade_id
            GROUP BY cidades.id
        ";

        $stmt = $this->connection->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function usuariosPorCidadeId(){
        $query ="
            SELECT cidades.id, cidades.nome, count(usuarios.id) as usuarios 
            FROM ".$this->table." cidades 
            INNER JOIN `api-mentes`.usuarios usuarios 
            ON cidades.id = usuarios.cidade_id 
            WHERE cidades.id = :id 
            GROUP BY cidades.id 
        ";

        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        $cidade = $stmt->fetch(PDO::FETCH_ASSOC);

        return $cidade;
    }
}