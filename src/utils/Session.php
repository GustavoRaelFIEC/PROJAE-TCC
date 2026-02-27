<?php

class Session
{

    // Iniciar sessão
    public static function start()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Salvar login
    public static function setUser($usuario) {
        
    }
}
