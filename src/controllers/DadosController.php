<?php

require_once __DIR__ . '/../config/config.php';

require_once __DIR__ . '/../models/Pessoa.php';
require_once __DIR__ . '/../models/Empresa.php';
require_once __DIR__ . '/../models/Vaga.php';
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../models/Inscricao.php';

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

        $pessoaModel = new Pessoa($pdo);

        $dados = $pessoaModel->buscarDadosPorUsuario($_SESSION['user_id']);
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

        $empresaModel = new Empresa($pdo);

        $dados = $empresaModel->buscarEmpresaPorUsuario($_SESSION['user_id']);
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

function handleVagasDaEmpresa($pdo) 
{
    try {
        $empresaDados = handleDadosEmpresa($pdo);
        $idEmpresa = $empresaDados['id_empresa'];

        $vagaModel = new Vaga($pdo);
        return $vagaModel->buscarVagasPorEmpresa($idEmpresa);

    } catch (PDOException $e) {
        error_log("Erro ao buscar vagas: " . $e->getMessage());
        return [];
    } 
}


