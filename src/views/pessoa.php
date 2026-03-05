<?php

require_once './src/config/database.php';
require_once '../src/models/User.php';

//Buscar os dados do usuário
try {
    $userModel = new User($pdo);
    $usuario = $userModel->findByEmail($usuario['email']);
} catch (\PDOException $e) {
    error_log("Erro ao carregar usuario: " . $e->getMessage() . "\n", 3, "../src/logs/errors_logs.log");
    die("Erro ao carregar os dados.");
}


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="dashboard-header">
                <h1>Dashboard Usuário</h1>
                <p>Bem-vindo de volta!</p>
            </div>

            <div class="user-info">
                <span>Olá, <strong><?php echo htmlspecialchars($usuario['nome']); ?></strong></span>
            </div>
        </div>


        <div class="dashboard-grid">
            <div class="info-card">
                <h3>Informações da Conta</h3>
                <div class="info-list">
                    <p><strong>ID: </strong> <?php echo $usuario['id']; ?></p>
                    <p><strong>Nome: </strong> <?php echo htmlspecialchars($usuario['nome']); ?></p>
                    <p><strong>Email: </strong> <?php echo htmlspecialchars($usuario['email']); ?></p>
                    <p><strong>Data de Cadastro: </strong> <?php echo date('d/m/Y H:i', strtotime($usuario['data_cadastro'])); ?></p>
                    <p><strong>Último Login: </strong> <?php echo $usuario['ultimo_login'] ? date('d/m/Y H:i', strtotime($usuario['ultimo_login'])) : 'Primeiro Acesso'; ?></p>
                </div>
            </div>