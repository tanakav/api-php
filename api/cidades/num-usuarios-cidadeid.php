<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once '../../models/cidade.php';

$database = new Database();
$db = $database->getConnection();
$cidade = new Cidade($db);

$cidade->id = isset($_GET['id'])? $_GET['id'] : "";
$registro_cidade = $cidade->usuariosPorCidadeId();

if($registro_cidade){
    extract($registro_cidade);

    $cidade = array(
        "id"            => $id,
        "nome"          => $nome,
        "usuarios"      => $usuarios
    );

    http_response_code(200);
    echo json_encode($cidade);

}else{
    http_response_code(404);
    echo json_encode(
        array("message"=>"Nenhum usuario na cidade")
    );
}