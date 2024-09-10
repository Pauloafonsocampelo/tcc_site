<?php
define('PROJECT_ROOT', __DIR__);
session_start();
include "utils/Page.php";
include "utils/Sessao.php";
include "Controllers/UserController.php";


$server = str_replace("tcc_site/", "", strtolower($_SERVER["REQUEST_URI"]));
$rota = $server;

if(str_starts_with($rota, "/api")) {
    $respostaApi = include_once "API/Route.php";
    header('Content-Type: application/json');
    if (!$respostaApi) {
        http_response_code(500);
        echo json_encode(['error' => 'Internal server error']);
    } elseif (empty($respostaApi)) {
        http_response_code(404);
        echo json_encode(['error' => 'Not found']);
    } else {
        http_response_code(200);
        echo json_encode($respostaApi);
    }
    exit();
}

switch(basename(trim($rota))) {
    case "":
        Page::render("Register");
        break;
    case "login":
        Page::render("Login");
        break;
    case "home":
        Page::render("Home");
        break;
    default:
        echo "Rota não encontrada";
        break;
}