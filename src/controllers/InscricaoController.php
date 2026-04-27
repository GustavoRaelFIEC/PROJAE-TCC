<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/Usuarios.php';
require_once __DIR__ . '/../utils/Session.php';

Session::start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    handleInscricao($pdo);
}

function handleInscricao($pdo)
{
    $errors = [];

    $userPessoa = new Usuario($pdo);

    $id_pessoa =  $userPessoa->findByIdPessoa($_SESSION['user_id']);
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

function visualizarInscricoes($pdo)
{

    $errors = [];

    $userEmpresa = new Usuario($pdo);

    $id_empresa =  $userEmpresa->findByIdEmpresa($_SESSION['user_id']);

    try {

        $userModel = new Usuario($pdo);

        $inscricoes = $userModel->visualizarInscricoes($id_empresa);
    } catch (PDOException $e) {
        error_log("Erro ao trazer vagas: " . $e->getMessage());
        $errors[] = "Erro no sistema. Volte mais tarde.";
    }


    if (!empty($errors)) {
        header("Location: "); //<-- VOLTAR PAAR A TELA DE VAGAS
        exit();
    }

    return $inscricoes;
}
