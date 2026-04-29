<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/Usuarios.php';
require_once __DIR__ . '/../utils/Security.php';
require_once __DIR__ . '/../utils/Session.php';

Session::start();


function getRequestData()
{
    return $_POST;
}


function handleDadosPessoa($pdo)
{
    $errors = [];

    try {

        $userModel = new Usuario($pdo);

        $dados = $userModel->dadosByIdPessoa($_SESSION['user_id']);
    } catch (PDOException $e) {
        error_log("Erro ao trazer os dados: " . $e->getMessage());
        $errors[] = "Erro no sistema. Volte mais tarde.";
    }


    if (!empty($errors)) {
        header("Location: "); //<-- VOLTAR PAAR A TELA DE VAGAS
        exit();
    }

    return $dados;
}


function handleDadosEmpresa($pdo)
{
    $errors = [];

    try {

        $userModel = new Usuario($pdo);

        $dados = $userModel->dadosByIdEmpresa($_SESSION['user_id']);
    } catch (PDOException $e) {
        error_log("Erro ao trazer os dados: " . $e->getMessage());
        $errors[] = "Erro no sistema. Volte mais tarde.";
    }


    if (!empty($errors)) {
        header("Location: "); //<-- VOLTAR PAAR A TELA DE VAGAS
        exit();
    }

    return $dados;
}