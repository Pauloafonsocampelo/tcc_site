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

    public function registerCard($id_usuario, $numero_cartao, $nome_titular, $validade, $cvv, $tipo)
    {
        try {
            $sql = "INSERT INTO cartoes (id_usuario, numero_cartao, nome_titular, validade, cvv, tipo) 
                    VALUES (:id_usuario, :numero_cartao, :nome_titular, :validade, :cvv, :tipo)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id_usuario', $id_usuario);
            $stmt->bindParam(':numero_cartao', $numero_cartao);
            $stmt->bindParam(':nome_titular', $nome_titular);
            $stmt->bindParam(':validade', $validade);
            $stmt->bindParam(':cvv', $cvv);
            $stmt->bindParam(':tipo', $tipo);
        
            $teste = $stmt->execute();
            echo $teste;
            if ($stmt->execute()) {
                return (object)[
                    "message" => "Cartão cadastrado com sucesso.",
                    "code" => 200
                ];
            } else {
                $errorInfo = $stmt->errorInfo();
                error_log("Erro SQL: " . print_r($errorInfo, true)); // Log de erro
                return (object)[
                    "message" => "Erro ao cadastrar o cartão: " . $errorInfo[2],
                    "code" => 500
                ];
            }
        } catch (PDOException $e) {
            error_log("Erro PDO: " . $e->getMessage()); // Log de erro PDO
            return (object)[
                "message" => "Erro ao cadastrar o cartão: " . $e->getMessage(),
                "code" => 500
            ];
        }
    }

    public function getUserCards($id_usuario)
    {
        $sql = "SELECT * FROM cartoes WHERE id_usuario = :id_usuario";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
