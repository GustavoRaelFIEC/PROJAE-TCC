<?php

class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function findByEmail($email) {
        $sql = "SELECT pessoas.*, usuarios.email, usuarios.tipo
                FROM pessoas
                INNER JOIN usuarios ON usuarios.id = pessoas.id_usuario
                WHERE usuarios.email = ?";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}