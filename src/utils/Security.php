<?php

class Security
{

    // Sanitizar o input
    public static function sanitizeInput($input)
    {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }

    // Validar senha
    public static function validatePassword($senha)
    {
        return strlen($senha) >= 8;
    }

    // Validar email
    public static function validateEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    // Validar telefone
    public static function validateTelefone($telefone)
    {
        return strlen($telefone) === 15;
    }

    // Validar CPF
    public static function validateCPF($cpf)
    {
        return strlen($cpf) === 14;
    }

    // Validar CNPJ
    public static function validateCNPJ($cnpj)
    {
        return strlen($cnpj) === 18;
    }

    // Validar tipo
    public static function validateTipo($tipo)
    {
        $tiposValidos = ['pessoa', 'empresa'];
        return in_array($tipo, $tiposValidos);
    }

    // Gerar hash da senha
    public static function hashPassword($senha)
    {
        return password_hash($senha, PASSWORD_DEFAULT);
    }

    // Verificar senha
    public static function verifyPassword($senha, $senhaHash)
    {
        return password_verify($senha, $senhaHash);
    }
}
