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

if(
    !empty($data->nome) &&
    !empty($data->endereco_id) &&
    !empty($data->cidade_id) &&
    !empty($data->estado_id)
){
    $usuario->nome = $data->nome;
    $usuario->endereco_id = $data->endereco_id;
    $usuario->cidade_id = $data->cidade_id;
    $usuario->estado_id = $data->estado_id;
    $usuario->created_at = date('Y-m-d H:i:s');
    $usuario->updated_at = date('Y-m-d H:i:s');

    if($id = $usuario->create()){
        http_response_code(201);

        $usuario->id = $id;
        echo json_encode($usuario);
    }else{
        http_response_code(503);
        echo json_encode(array("message"=>"Nao foi possivel criar usuario"));
    }
}else{
    http_response_code(400);
    echo json_encode(array("message"=>"Dados para criacao de usuario incompletos"));
}