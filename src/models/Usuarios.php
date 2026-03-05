<?php

class Usuario {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Buscar usuário por email
    public function findByEmail($email) {
        
    $stmt = $this->pdo->prepare("
    SELECT pessoas.*, usuarios.email, usuarios.senha
    FROM pessoas
    INNER JOIN usuarios ON usuarios.id = pessoas.id_usuario
    WHERE usuarios.email = ?
    ");
    $stmt->execute([$email]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Cria um novo usuário
    public function createUser($email, $senhaHash, $tipo) {
        $stmt = $this->pdo->prepare("
        INSERT INTO usuarios (email, senha, tipo)
        VALUES (?, ?, ?)
        ");
        $stmt->execute([$email, $senhaHash, $tipo]);
        return $this->pdo->lastInsertId();
    }
}