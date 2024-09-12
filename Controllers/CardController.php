<?php
require_once __DIR__ . '/../Model/CardModel.php';

class CardController
{
    private $cardModel;

    public function __construct()
    {
        $this->cardModel = new CardModel();
    }

    public function registerCard($body)
    {
        $idUsuario = Sessao::obter("User_id") ?? 1;
        if (
            !$body ||
            !isset($body->Numero) ||
            !isset($body->Titular) ||
            !isset($body->Validade) ||
            !isset($body->CVV) ||
            !isset($body->Tipo) ||
            !isset($idUsuario)
        ) {
            throw new Exception("Dados insuficientes");
        }

        $body->IdUsuario = $idUsuario;

        return (new CardModel())->registerCard($body);
    }

    public function getCardByUser() {
        return (new CardModel())->getCardBy([
            "IdUsuario" => Sessao::obter("User_id") ?? 1
        ]);
    }
}
?>