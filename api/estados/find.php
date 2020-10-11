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
$abreviacao="";

$estado->id = isset($_GET['id'])? $_GET['id'] : "";
$registro_estado = $estado->findById();

if($registro_estado){
    extract($registro_estado);

    $estado = array(
        "id"            => $id,
        "abreviacao"    => $abreviacao,
        "created_at"    => $created_at,
        "updated_at"    => $updated_at
    );

    http_response_code(200);
    echo json_encode($estado);

}else {
    http_response_code(404);
    echo json_encode(
        array("message" => "Estado nao encontrado")
    );
}