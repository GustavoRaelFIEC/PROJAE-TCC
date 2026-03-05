<?php

session_start();

// Lida com configurações de sessão
class Session
{

    // Iniciar sessão
    public static function start()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Salvar usuário na Sessão
    public static function setUsuario($usuario)
    {
        $_SESSION['user_id'] = $usuario['id'];
        $_SESSION['user_email'] = $usuario['email'];
        $_SESSION['user_tipo'] = $usuario['tipo'];
    }

    // Pegar o usuário logado
    public static function getUsuario()
    {
        return [
            'id' => $_SESSION['user_id'] ?? null,
            'email' => $_SESSION['user_email'] ?? null,
            'tipo' => $_SESSION['user_tipo'] ?? null
        ];
    }

    // Verificar se está logado
    public static function isLogged() 
    {
        return isset($_SESSION['user_id']);
    }

    // Logout
    public static function destroy()
    {
        $_SESSION = [];
        session_destroy();
    }
}
