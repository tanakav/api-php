<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once '../../models/estado.php';

$database = new Database();
$db = $database->getConnection();

$estado = new Estado($db);

$stmt = $estado->findAll();
$num = $stmt->rowCount();

if($num>0){

    $estados = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $registro_estado = array(
            "id"            => $id,
            "abreviacao"    => $abreviacao,
            "created_at"    => $created_at,
            "updated_at"    => $updated_at
        );
        array_push($estados,$registro_estado);
    }

    http_response_code(200);
    echo json_encode($estados);

}else{
    http_response_code(404);
    echo json_encode(
        array("message"=>"Nenhum estado encontrado")
    );
}