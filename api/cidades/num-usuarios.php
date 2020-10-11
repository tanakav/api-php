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

$stmt = $cidade->usuariosPorCidade();
$num = $stmt->rowCount();

if($num>0){

    $cidades = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $registro_cidade = array(
            "id"            => $id,
            "nome"          => $nome,
            "usuarios"      => $usuarios
        );
        array_push($cidades,$registro_cidade);
    }

    http_response_code(200);
    echo json_encode($cidades);

}else{
    http_response_code(404);
    echo json_encode(
        array("message"=>"Nenhuma cidade encontrada")
    );
}