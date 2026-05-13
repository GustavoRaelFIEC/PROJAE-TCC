<?php

class Usuario
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Buscar usuário por email
    public function buscarUsuarioPorEmail($email)
    {
        $stmt = $this->pdo->prepare("
            SELECT * 
            FROM usuarios 
            WHERE email = ?
        ");

        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Cria um novo usuário
    public function criarUsuario($email, $senhaHash, $tipo)
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO usuarios (email, senha, tipo)
            VALUES (?, ?, ?)
        ");

        $stmt->execute([$email, $senhaHash, $tipo]);
        return $this->pdo->lastInsertId(); // Retorna o ID do novo usuário
    }
}
