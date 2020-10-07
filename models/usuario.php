<?php

class Usuario{

    private $connection;
    private $table = "usuarios";

    public $id;
    public $name;
    public $endereco_id;
    public $cidade_id;
    public $estado_id;

    public function __construct($conn){
        $this->connection = $conn;
    }
}