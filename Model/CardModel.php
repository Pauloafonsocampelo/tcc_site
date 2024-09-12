<?php
require_once __DIR__ . '/DatabaseModel.php';

class CardModel
{
    private $pdo;

    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->getConnection();
    }

    public function registerCard($body)
    {
        $sql = "INSERT INTO Cartoes (id_usuario,
        numero_cartao,
        nome_titular,
        validade,
        cvv,
        tipo
        ) VALUES (
            :id_usuario,
            :numero_cartao,
            :nome_titular,
            :validade,
            :cvv,
            :tipo
        )
        ";

        $stmt = $this->pdo->prepare($sql);
        $params = [
            ":id_usuario" => $body->IdUsuario,
            ":numero_cartao" => $body->Numero,
            ":nome_titular" => $body->Titular,
            ":validade" => $body->Validade,
            ":cvv" => $body->CVV,
            ":tipo" => $body->Tipo
        ];
        
        return $stmt->execute($params);
    }

    public function getCardBy($param) {
        $filters = [];
        if(array_key_exists("IdUsuario", $param)) {
            $filters[] = "Usuarios.id_usuario = :IdUsuario";
        }

        $where = count($filters) ? "\rWHERE " . implode(" AND ", $filters) : "";

        $sql = "SELECT Usuarios.Nome,
                Cartoes.numero_cartao,
                Cartoes.nome_titular,
                Cartoes.validade,
                Cartoes.cvv,
                Cartoes.tipo
                FROM Usuarios
                INNER JOIN Cartoes ON Usuarios.id_usuario = Cartoes.id_usuario
                {$where}
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($param);
        
        $retorno = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($retorno === false) {
            $retorno = ["Erro" => true];
        }

        return $retorno;
    }
}
?>