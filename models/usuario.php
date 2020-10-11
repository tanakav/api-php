<?php

class Usuario{

    private $connection;
    private $table = "`api-mentes`.usuarios";

    public $id;
    public $nome;
    public $endereco_id;
    public $cidade_id;
    public $estado_id;
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
                FROM ".$this->table." as usuario
                WHERE usuario.id = :id
        ";

        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        return $usuario;
    }

    public function create(){
        $query = "
            INSERT INTO ".$this->table."
            SET
                nome =          :nome,
                endereco_id =   :endereco_id,
                cidade_id =     :cidade_id,
                estado_id =     :estado_id,
                created_at =    :created_at,
                updated_at =    :updated_at
        ";

        $stmt = $this->connection->prepare($query);

        $stmt->bindParam(":nome",$this->nome);
        $stmt->bindParam(":endereco_id",$this->endereco_id);
        $stmt->bindParam(":cidade_id",$this->cidade_id);
        $stmt->bindParam(":estado_id",$this->estado_id);
        $stmt->bindParam("created_at",$this->created_at);
        $stmt->bindParam("updated_at",$this->updated_at);

        if($stmt->execute()){
            return $this->connection->lastInsertId();;
        }else{
            return false;
        }
    }

    public function update(){

        $query = "
            UPDATE ".$this->table." as usuario
            SET
                nome =          :nome,
                endereco_id =   :endereco_id,
                cidade_id =     :cidade_id,
                estado_id =     :estado_id,
                updated_at =    :updated_at
            WHERE 
                usuario.id = :id
        ";

        $stmt = $this->connection->prepare($query);

        $stmt->bindParam(":nome",$this->nome);
        $stmt->bindParam(":endereco_id",$this->endereco_id);
        $stmt->bindParam(":cidade_id",$this->cidade_id);
        $stmt->bindParam(":estado_id",$this->estado_id);
        $stmt->bindParam("updated_at",$this->updated_at);
        $stmt->bindParam(":id",$this->id);

        if($stmt->execute()){
            return true;;
        }else{
            return false;
        }

    }

    public function delete(){

        $query="
            DELETE FROM ".$this->table."
            WHERE id = :id
        ";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(":id",$this->id);
        $temp = $stmt->execute();

        if($temp){
            return true;
        }else{
            return false;
        }
    }
}