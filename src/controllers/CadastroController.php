<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/Usuarios.php';
require_once __DIR__ . '/../utils/Security.php';
require_once __DIR__ . '/../utils/Session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    handleCadastro($pdo);
}

function getRequestData() {
    return $_POST;
}

function handleCadastro($pdo)
{
    Session::start();

    $dados = getRequestData();

    // Dados do formulário
    $email = filter_var($dados['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $senha = $dados['senha'] ?? '';
    $tipo = $dados['tipo'] ?? '';

    $errors = [];

    // Validações 
    if (!Security::validateEmail($email)) {
        $errors[] = "❌ Email inválido!";
    }

    if (!Security::validatePassword($senha)) {
        $errors[] = "❌ A senha deve ter pelo menos 8 caracteres";
    }

    if (!empty($errors)) {
        $_SESSION['cadastro_errors'] = $errors;
        var_dump($errors);
        exit;
    }

    try {
        $userModel = new Usuario($pdo);

        // Verifica se email já existe
        $usuario = $userModel->findByEmail($email);

        if ($usuario) {
            $_SESSION['cadastro_errors'] = ["⚠️ Email já cadastrado!"];
            header("Location: ../../public/cadastro.php");
            exit;
        }

        // Hash da senha
        $senhaHash = Security::hashPassword($senha);

        // Transação segura (banco empresa e pessoa)
        $pdo->beginTransaction();

        // Criar Usuário
        $userId = $userModel->createUser($email, $senhaHash, $tipo);

        // Criar dados específicos (Pessoa e Empresa)
        if ($tipo === 'pessoa') {
            $dados = [
                'nome' => Security::sanitizeInput($dados['nome'] ?? ''),
                'cpf' => Security::sanitizeInput($dados['cpf'] ?? ''),
                'telefone' => Security::sanitizeInput($dados['telefone'] ?? ''),
                'instituicao' => Security::sanitizeInput($dados['instituicao'] ?? ''),
                'curso' => Security::sanitizeInput($dados['curso'] ?? '')
            ];
            $userModel->createPessoa($userId, $dados);
        } elseif ($tipo === 'empresa') {
            $dados = [
                'nome' => Security::sanitizeInput($dados['nome'] ?? ''),
                'cnpj' => Security::sanitizeInput($dados['cnpj'] ?? ''),
                'telefone' => Security::sanitizeInput($dados['telefone'] ?? ''),
                'cidade' => Security::sanitizeInput($dados['cidade'] ?? '')
            ];
            $userModel->createEmpresa($userId, $dados);
        }

        // Se der tudo certo, confirma tudo
        $pdo->commit();

        // Sucesso
        $_SESSION['sucesso'] = "✅ Conta criada com sucesso!";
        header("Location: ../../public/login.php");
        exit;
    } catch (PDOException $e) {
        error_log("Erro no cadastro " . $e->getMessage());
        // Se estiver em transaction, o rollBack volta se der alguma coisa errada
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }
        $_SESSION['cadastro_errors'] = ["⚠️ Erro no sistema. Tente novamente mais tarde."];
        header("Location: ../../public/cadastro.php");
        exit;
    }
}
