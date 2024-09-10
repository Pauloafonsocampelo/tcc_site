<?php
require_once __DIR__ . '/../Model/UserModel.php';

class UsuarioController
{
    private $usuarioModel;

    public function __construct()
    {
        $this->usuarioModel = new Usuario();
    }

    public function getUser($id) {
        if(!$id) {
            return (object) [
                "message" => "Invalid id",
                "code" => 500
            ];
        }

        return $this->usuarioModel->getUser($id);
    }

    public function registerUser($objetoUsuario)
    {
        $nome = $objetoUsuario->Nome;
        $Cpf = $objetoUsuario->Cpf;
        $email = $objetoUsuario->Email;
        $telefone = $objetoUsuario->Telefone;
        $senha = $objetoUsuario->Senha;

        return $this->usuarioModel->registerUser($nome, $Cpf, $email, $telefone, $senha);
    }

    public function loginUser($objetoUsuario)
    {
        $email = $objetoUsuario?->Email ?? null;
        $senha = $objetoUsuario?->Senha ?? null;

        if (isset($email) && isset($senha)) {
            $retorno = $this->usuarioModel->loginUser($email, $senha);
            if ($retorno?->success) {
                Sessao::incluir("Autenticado", true);
                if ($retorno?->id ?? null) {
                    Sessao::incluir("User_id", $retorno->id);
                }
            }

            return $retorno?->success;
        }
    }
}
?>