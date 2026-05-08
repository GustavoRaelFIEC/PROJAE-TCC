<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/Pessoa.php';
require_once __DIR__ . '/../models/Empresa.php';
require_once __DIR__ . '/../models/Vaga.php';
require_once __DIR__ . '/../utils/Session.php';

Session::start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    handleInscricao($pdo);
}

function handleInscricao($pdo)
{
    $errors = [];

    $pessoaModel = new Pessoa($pdo);

    $id_pessoa =  $pessoaModel->findByIdPessoa($_SESSION['user_id']);
    $id_vaga = (int) $_POST['id_vaga'];

    //Foi o Chat que deu esse código, então, mais tarde, revisar esta parte (esse IF)
    if (!$id_vaga || !$id_pessoa) {
        die("Dados inválidos.");
    }

    try {

        $vagaModel = new Vaga($pdo);
        $vagaModel->inscricao($id_pessoa, $id_vaga);

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

function visualizarInscricoesEmpresa($pdo)
{

    $errors = [];

    $empresaModel = new Empresa($pdo);

    $id_empresa =  $empresaModel->findByIdEmpresa($_SESSION['user_id']);

    try {

        $empresaModel = new Empresa($pdo);

        $inscricoes = $empresaModel->visualizarInscricoesEmpresa($id_empresa);
    } catch (PDOException $e) {
        error_log("Erro ao trazer inscrições: " . $e->getMessage());
        $errors[] = "Erro no sistema. Volte mais tarde.";
    }


    if (!empty($errors)) {
        header("Location: "); //<-- VOLTAR PAAR A TELA DE VAGAS
        exit();
    }

    return $inscricoes;
}

function visualizarInscricoesPessoa($pdo)
{

    $errors = [];

    $pessoaModel = new Pessoa($pdo);

    $id_pessoa =  $pessoaModel->findByIdPessoa($_SESSION['user_id']);

    try {

        $pessoaModel = new Pessoa($pdo);

        $inscricoes = $pessoaModel->visualizarInscricoesPessoa($id_pessoa);
    } catch (PDOException $e) {
        error_log("Erro ao trazer inscrições: " . $e->getMessage());
        $errors[] = "Erro no sistema. Volte mais tarde.";
    }


    if (!empty($errors)) {
        header("Location: "); //<-- VOLTAR PAAR A TELA DE VAGAS
        exit();
    }

    return $inscricoes;
}
