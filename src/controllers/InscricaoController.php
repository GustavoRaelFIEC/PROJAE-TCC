<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/Usuarios.php';
require_once __DIR__ . '/../utils/Security.php';
require_once __DIR__ . '/../utils/Session.php';
require_once __DIR__ . "/../../src/controllers/VagaController.php";


function handleInscricao($pdo)
{

    $vagas = handleBuscarVaga($pdo);

    $errors = [];

    try {

    $userModel = new Usuario($pdo);
    $userModel->inscricao($_SESSION['user_id'], $vagas['id_vaga']);

    } catch (PDOException $e) {
        error_log("Erro ao realizar inscrição: " . $e->getMessage());
        $errors[] = "Erro no sistema. Volte mais tarde.";
    }
    
    
    if (!empty($errors)) {
      header("Location: "); //<-- VOLTAR PAAR A TELA DE VAGAS
        exit();
    }

}
