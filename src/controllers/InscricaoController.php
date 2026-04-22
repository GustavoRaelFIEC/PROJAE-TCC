<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/Usuarios.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    handleInscricao($pdo);
}

function handleInscricao($pdo)
{
    $errors = [];

    $userPessoa = new Usuario($pdo);

    $id_pessoa =  $userPessoa->findByIdPessoa($_SESSION['user_id']);;
    $id_vaga = (int) $_POST['id_vaga'];

    //Foi o Chat que deu esse código, então, mais tarde, revisar esta parte (esse IF)
    if (!$id_vaga || !$id_pessoa) {
        die("Dados inválidos.");
    }
    
    try {

        $userModel = new Usuario($pdo);
        $userModel->inscricao($id_pessoa, $id_vaga);

        header("Location: /PROJAE-TCC/public/views/dashboardPessoa.php");
        exit();

    } catch (PDOException $e) {
        error_log("Erro ao realizar inscrição: " . $e->getMessage());
        $errors[] = "Erro no sistema. Volte mais tarde.";
    }

    if (!empty($errors)) {
        header("Location: /PROJAE-TCC/public/views/testeBuscarVaga.php");
        exit();
    }
}