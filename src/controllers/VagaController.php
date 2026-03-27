<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/Usuarios.php';
require_once __DIR__ . '/../utils/Security.php';
require_once __DIR__ . '/../utils/Session.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $action = $_GET['action'] ?? '';

    if($action === 'postarVaga'){
        handlePostarVaga($pdo);
    }else if($action === 'buscarVaga'){
        handleBuscarVaga($pdo);
    }
}

function getRequestData() {
    return $_POST;
}

function handlePostarVaga($pdo)
{
    Session::start();

    $dados = getRequestData();

    try {
        $userModel = new Usuario($pdo);

        // Transação segura (banco empresa e pessoa)
        $pdo->beginTransaction();

        $dados = [
            'titulo' => Security::sanitizeInput($dados['titulo'] ?? ''),
            'descricao' => Security::sanitizeInput($dados['descricao'] ?? ''),
            'tipo' => $dados['tipo'] ?? '',
            'salario' => (float) ($dados['salario'] ?? 0),
            'cidade' => Security::sanitizeInput($dados['cidade'] ?? ''),
            'status' => $dados['status'] ?? ''
        ];

        if (empty($dados['titulo'])) {
            throw new Exception("Título é obrigatório");
        }

        $userModel->createVaga($_SESSION['user_id'], $dados);

        // Se der tudo certo, confirma tudo
        $pdo->commit();

        // Sucesso
        $_SESSION['sucesso'] = "✅ Vaga criada com sucesso!";
        header("Location: ../../../public/views/dashboardEmpresa.php");
        exit();

    } catch (PDOException $e) {
        echo $e->getMessage();
        exit();
        error_log("Erro ao criar vaga " . $e->getMessage());

        // Se estiver em transaction, o rollBack volta se der alguma coisa errada
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }

        $_SESSION['cadastro_errors'] = ["⚠️ Erro no sistema. Tente novamente mais tarde."];
        header("Location: ../../public/testePostarVaga.php"); // <-- MANDAR PARA O FORMULÁRIO DE VAGA NOVAMENTE
        exit();
    }
}


//function handleBuscarVaga -> AQUI