<?php

class Estado{
    private $connection;
    private $table = "`api-mentes`.estados";

    public $id;
    public $abreviacao;
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
                FROM ".$this->table." as estados
                WHERE estados.id = :id
        ";

        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        $estado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $estado;
    }

    public function usuariosPorEstado(){
        $query ="
            SELECT estados.id, estados.abreviacao, count(usuarios.id) as usuarios
            FROM ".$this->table." estados
            INNER JOIN `api-mentes`.usuarios usuarios
            ON estados.id = usuarios.estado_id
            GROUP BY estados.id
        ";

        $stmt = $this->connection->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function usuariosPorEstadoId(){
        $query ="
            SELECT estados.id, estados.abreviacao, count(usuarios.id) as usuarios
            FROM ".$this->table." estados
            INNER JOIN `api-mentes`.usuarios usuarios
            ON estados.id = usuarios.estado_id
            WHERE estados.id = :id
            GROUP BY estados.id
        ";

        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        $estado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $estado;
    }
}