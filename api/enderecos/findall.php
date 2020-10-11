<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once '../../models/endereco.php';

$database = new Database();
$db = $database->getConnection();

$endereco = new Endereco($db);

$stmt = $endereco->findAll();
$num = $stmt->rowCount();

if($num>0){

    $enderecos = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $registro_endereco = array(
            "id"            => $id,
            "logradouro"    => $logradouro,
            "created_at"    => $created_at,
            "updated_at"    => $updated_at
        );
        array_push($enderecos,$registro_endereco);
    }

    http_response_code(200);
    echo json_encode($enderecos);

}else{
    http_response_code(404);
    echo json_encode(
        array("message"=>"Nenhum endereco encontrado")
    );
}