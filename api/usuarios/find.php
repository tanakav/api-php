<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once '../../models/usuario.php';

$database = new Database();
$db = $database->getConnection();
$usuario = new Usuario($db);
$nome="";

$usuario->id = isset($_GET['id'])? $_GET['id'] : "";
$registro_usuario = $usuario->findById();

if($registro_usuario){
    extract($registro_usuario);

    $usuario = array(
        "id"            => $id,
        "nome"          => $nome,
        "endereco_id"   => $endereco_id,
        "cidade_id"     => $cidade_id,
        "estado_id"     => $estado_id,
        "created_at"    => $created_at,
        "updated_at"    => $updated_at
    );

    http_response_code(200);
    echo json_encode($usuario);

}else{
    http_response_code(404);
    echo json_encode(
        array("message"=>"Usuario nao encontrado")
    );
}