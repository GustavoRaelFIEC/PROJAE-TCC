<?php

require_once __DIR__ . '/../config/config.php';

require_once __DIR__ . '/../models/Pessoa.php';
require_once __DIR__ . '/../models/Empresa.php';
require_once __DIR__ . '/../models/Vaga.php';
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../models/Inscricao.php';

require_once __DIR__ . '/../utils/Security.php';
require_once __DIR__ . '/../utils/Session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === "postarVaga") {
        handlePostarVaga($pdo);
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $action = $_GET['action'] ?? '';

    if ($action === "filtrarPorTipo") {

        handleFiltrarPorTipo($pdo);
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {

    $action = $_GET['action'] ?? '';

    if ($action === "alternarStatusVaga") {

        handleAlternarStatusVaga($pdo);
    }
}
function getRequestData()
{
    return $_POST;
}

function handlePostarVaga($pdo)
{
    Session::start();

    $dados = getRequestData();

    $empresaModel = new Empresa($pdo);

    $id_empresa =  $empresaModel->buscarIdEmpresaPorUsuario($_SESSION['user_id']);

    try {
        $vagaModel = new Vaga($pdo);

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

        $vagaModel->criarVaga($id_empresa, $dados);

        // Se der tudo certo, confirma tudo
        $pdo->commit();

        // Sucesso
        $_SESSION['sucesso'] = "✅ Vaga criada com sucesso!";
        header("Location: ../../public/views/dashboardEmpresa.php");
        exit();
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}


function handleBuscarVaga($pdo)
{
    try {

        $vagaModel = new Vaga($pdo);
        return $vagaModel->buscarVagasAbertas();
    } catch (PDOException $e) {
        error_log("Erro ao trazer vagas: " . $e->getMessage());
        return [];
    }
}

function handleFiltrarPorTipo($pdo)
{
    $tipo = $_GET['tipo'] ?? '';

    $vagaModel = new Vaga($pdo);

    $vagas = $vagaModel->filtrarPorTipo($tipo);

    require '../PROJAE-TCC/public/views/vagas.php';
}

function handleAlternarStatusVaga($pdo)
{

    $dados = json_decode(file_get_contents("php://input"), true);

    $idVaga = $dados['id_vaga'];

    $vagaModel = new Vaga($pdo);

    $resultado = $vagaModel->alternarStatusVaga($idVaga);

    echo json_encode([
        "success" => $resultado
    ]);
}
