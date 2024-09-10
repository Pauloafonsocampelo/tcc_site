<?php
require_once __DIR__ . '/../Model/CardModel.php';

class CardController
{
    private $cardModel;

    public function __construct()
    {
        $this->cardModel = new CardModel();
    }

    public function registerCard($id_usuario, $numero_cartao, $nome_titular, $validade, $cvv, $tipo)
{
    header('Content-Type: text/plain');

    $id_usuario = Sessao::obter("User_id") ?? null;

    if (!$id_usuario || !$numero_cartao || !$nome_titular || !$validade || !$cvv || !$tipo) {
        echo "Todos os campos são obrigatórios.\n";
        http_response_code(400);
        exit;
    }

    $result = $this->cardModel->registerCard($id_usuario, $numero_cartao, $nome_titular, $validade, $cvv, $tipo);

    if ($result->code === 200) {
        echo $result->message . "\n";
        http_response_code(200);
    } else {
        echo "Erro: " . $result->message . "\n";
        http_response_code(500);
    }
    exit;
}

    public function getUserCards($id_usuario)
    {
        header('Content-Type: text/plain');

        if (!$id_usuario) {
            echo "ID de usuário inválido.\n";
            http_response_code(500);
            exit;
        }

    }
}
?>
