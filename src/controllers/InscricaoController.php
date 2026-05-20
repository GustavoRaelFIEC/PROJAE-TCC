<?php

require_once __DIR__ . '/../config/config.php';

require_once __DIR__ . '/../models/Pessoa.php';
require_once __DIR__ . '/../models/Empresa.php';
require_once __DIR__ . '/../models/Vaga.php';
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../models/Inscricao.php';

require_once __DIR__ . '/../utils/Session.php';

Session::start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    handleInscricao($pdo);
}

function handleInscricao($pdo)
{
    $errors = [];

    $pessoaModel = new Pessoa($pdo);

    $id_pessoa =  $pessoaModel->buscarPessoaPorUsuario($_SESSION['user_id']);
    $id_vaga = (int) $_POST['id_vaga'];


    if (!$id_vaga || !$id_pessoa) {
        die("Dados inválidos.");
    }

    try {

        $vagaModel = new Inscricao($pdo);
        $vagaModel->criarInscricao($id_pessoa, $id_vaga);

        header("Location: /PROJAE-TCC/public/views/dashboardPessoa.php");
        exit();
    } catch (PDOException $e) {
        error_log("Erro ao realizar inscrição: " . $e->getMessage());
        $errors[] = "Erro no sistema. Volte mais tarde.";
    }

    if (!empty($errors)) {
        header("Location: /PROJAE-TCC/public/views/vagas.php");
        exit();
    }
}

function visualizarInscricoesEmpresa($pdo)
{

    $errors = [];

    $empresaModel = new Empresa($pdo);

    $id_empresa =  $empresaModel->buscarIdEmpresaPorUsuario($_SESSION['user_id']);

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

    $id_pessoa =  $pessoaModel->buscarPessoaPorUsuario($_SESSION['user_id']);

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
