<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/database.php';
include_once '../../models/usuario.php';

$database = new Database();
$db = $database->getConnection();
$usuario = new Usuario($db);
$data = json_decode(file_get_contents("php://input"));

if(($usuario->id = $data->id) != null && ($usuario_original = $usuario->findById()) !=null){

    $usuario->nome = isset($data->nome) ?  $data->nome : $usuario_original["nome"];
    $usuario->endereco_id = isset($data->endereco_id) ?  $data->endereco_id : $usuario_original["endereco_id"];
    $usuario->cidade_id = isset($data->cidade_id) ?  $data->cidade_id : $usuario_original["cidade_id"];
    $usuario->estado_id = isset($data->estado_id) ?  $data->estado_id : $usuario_original["estado_id"];

    $usuario->created_at = $usuario_original["created_at"];
    $usuario->updated_at = date('Y-m-d H:i:s');

    if($usuario->update()){
        http_response_code(200);
        echo json_encode($usuario->findById());
    }else{
        http_response_code(503);
        echo json_encode(array("message" => "Nao foi possivel atualizar o usuario"));
    }
}else{
    http_response_code(404);
    echo json_encode(array("message" => "Usuario nao encontrado"));
}