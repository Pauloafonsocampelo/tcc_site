<?php
    class Sessao {
        static function incluir($nome, $valor) {
            $_SESSION[$nome] = $valor;
        }
        
        static function obter($nome) {
            return $_SESSION[$nome];
        }

        static function excluir($nome) {
            unset($_SESSION[$nome]);
        }
    }
?>