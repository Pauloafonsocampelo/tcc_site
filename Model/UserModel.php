<?php
require_once __DIR__ . '/DatabaseModel.php';

class Usuario
{
    private $pdo;

    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->getConnection();
    }

    public function registerUser($nome, $cpf, $email, $telefone, $senha)
    {
        $sqlVerificar = "SELECT id_usuario FROM Usuarios WHERE CPF = :cpf OR Email = :email OR Telefone = :telefone";
        try {
            $stmtVerificar = $this->pdo->prepare($sqlVerificar);
            $stmtVerificar->bindParam(":cpf", $cpf);
            $stmtVerificar->bindParam(":email", $email);
            $stmtVerificar->bindParam(":telefone", $telefone);
            $stmtVerificar->execute();
            
            if ($stmtVerificar->rowCount() > 0) {
                return (object) [
                    "success" => false,
                    "message" => "CPF, email ou telefone já cadastrados."
                ];
            }

            $sql = "INSERT INTO Usuarios (Nome, CPF, Email, Telefone, Senha) 
                    VALUES (:nome, :cpf, :email, :telefone, :senha)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":nome", $nome);
            $stmt->bindParam(":cpf", $cpf);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":telefone", $telefone);
            $stmt->bindParam(":senha", $senha);  // Senha sem hash
            $retorno = $stmt->execute();

            if (!$retorno) {
                return (object) [
                    "success" => false,
                    "message" => "Falha ao registrar o usuário."
                ];
            }

            return (object) [
                "success" => true,
                "message" => "Usuário registrado com sucesso."
            ];
        } catch (PDOException $ex) {
            return (object) [
                "success" => false,
                "message" => $ex->getMessage()
            ];
        }
    }

    public function loginUser($email, $senha)
    {
        $sql = "
            SELECT
            Email,
            Senha,
            id_usuario
            FROM Usuarios
            WHERE Email = :Email
        ";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":Email", $email);
            $stmt->execute();

            $res = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$res || $senha !== $res["Senha"]) { // Comparação direta de senha
                return (object) [
                    "success" => false,
                    "message" => "Email ou senha inválidos."
                ];
            }

            return (object) [
                "success" => true,
                "id" => $res["id_usuario"]
            ];
        } catch (PDOException $ex) {
            return (object) [
                "success" => false,
                "message" => $ex->getMessage()
            ];
        }
    }

    public function getUser($id)
    {
        $sql = "
            SELECT 
            Nome,
            CPF,
            Email,
            Telefone,
            Senha FROM Usuarios
            WHERE id_usuario = :id
        ";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $retorno = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$retorno) {
                return (object) [
                    "message" => "Usuário não encontrado",
                    "code" => 404
                ];
            }

            unset($retorno['Senha']);

            return (object) [
                "Dados" => $retorno,
                "code" => 200
            ];
        } catch (PDOException $ex) {
            return (object) [
                "success" => false,
                "message" => $ex->getMessage()
            ];
        }
    }
}
?>
