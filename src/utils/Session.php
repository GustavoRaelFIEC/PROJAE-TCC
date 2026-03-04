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

    // Inserir Usuário
    public static function setUsuario($usuario)
    {
        $_SESSION['user_id'] = $usuario['id'];
        $_SESSION['email'] = $usuario['email'];
        $_SESSION['tipo'] = $usuario['tipo'];
    }

    // Destruir a variável de sessão
    public static function destroy()
    {
        $_SESSION = [];
        session_destroy();
    }

    // Pegar o usuário
    public static function getUsuario()
    {
        return [
            'id' => $_SESSION['user_id'] ?? null,
            'email' => $_SESSION['email'],
            'tipo' => $_SESSION['tipo'],
        ];
    }
}
