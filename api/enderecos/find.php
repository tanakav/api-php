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
$logradouro="";

$endereco->id = isset($_GET['id'])? $_GET['id'] : "";
$registro_endereco = $endereco->findById();

if($registro_endereco){
    extract($registro_endereco);

    $endereco = array(
        "id"            => $id,
        "logradouro"    => $logradouro,
        "created_at"    => $created_at,
        "updated_at"    => $updated_at
    );

    http_response_code(200);
    echo json_encode($endereco);

}else {
    http_response_code(404);
    echo json_encode(
        array("message" => "Endereco nao encontrado")
    );
}