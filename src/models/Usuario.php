<?php

class Usuario
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Buscar usuário por email
    public function findByEmail($email)
    {
        $stmt = $this->pdo->prepare("
            SELECT u.*, p.*, e.*
            FROM usuarios u
            LEFT JOIN pessoas p ON p.id_usuario = u.id
            LEFT JOIN empresas e ON e.id_usuario = u.id
            WHERE u.email = ?
        ");

        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Cria um novo usuário
    public function createUser($email, $senhaHash, $tipo)
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO usuarios (email, senha, tipo)
            VALUES (?, ?, ?)
        ");
        $stmt->execute([$email, $senhaHash, $tipo]);
        return $this->pdo->lastInsertId(); // Retorna o ID do novo usuário
    }
}
