<?php

// Configuração do banco
$host = 'localhost';
$db = 'projae';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

// Variável
$dsn = "mysql:host=$host;port=3315;dbname=$db;charset=$charset";


// Opções PDO
$options = [
    PDO::ATTR_ERRMODE => PDO:: ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

// Conexão
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch(\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}