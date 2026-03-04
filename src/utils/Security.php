<?php

class Security
{
    
    // Sanitizar o input
    public static function sanitizeInput($input)
    {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }

    // Criar hash da senha
    public static function hashPassword($senha)
    {
        return password_hash($senha, PASSWORD_DEFAULT);
    }

    // Verificar senha
    public static function verifyPassword($senha, $hash) 
    {
        return password_verify($senha, $hash);
    }

    // Validar email
    public static function validateEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    // Validar senha
    public static function validatePassword($senha)
    {
        return strlen($senha) >= 8;
    }

    // Validar tipo
    public static function validateTipo($tipo)
    {
        $validos = ['pessoa', 'empresa'];
        return in_array($tipo, $validos);
    }
}
