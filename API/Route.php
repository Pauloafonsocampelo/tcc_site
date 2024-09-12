<?php
$path = $_SERVER["REQUEST_URI"];
$body = file_get_contents('php://input');
$userController = new UsuarioController();
$cardController = new CardController();

$retorno = match (basename($path)) {
    "registrar-usuario" => $userController->registerUser(json_decode($body)),
    "logar-usuario"     => $userController->loginUser(json_decode($body)),
    "registrar-cartao"  => $cardController->registerCard(json_decode($body)),
    "obter-cartao"      => $cardController->getCardByUser()
};

return $retorno;

?>