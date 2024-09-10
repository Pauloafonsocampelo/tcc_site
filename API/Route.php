<?php
$path = $_SERVER["REQUEST_URI"];
$body = file_get_contents('php://input');
$controller = new UsuarioController();

$retorno = match (basename($path)) {
    "registrar-usuario" => $controller->registerUser(json_decode($body)),
    "logar-usuario" => $controller->loginUser(json_decode($body))
};

return $retorno;

?>