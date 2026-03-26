<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/Usuarios.php';
require_once __DIR__ . '/../utils/Security.php';
require_once __DIR__ . '/../utils/Session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    handleCadastro($pdo);
}

function getRequestData()
{
    return $_POST;
}

function handleCadastro($pdo)
{
    Session::start();

    $dados = getRequestData();

    // Dados do formulário
    $email = filter_var($dados['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $senha = $dados['senha'] ?? '';
    $telefone = $dados['telefone'] ?? '';
    $cpf = $dados['cpf'];
    $cnpj = $dados['cnpj'];
    $tipo = $dados['tipo'] ?? '';

    // Redirect baseado no tipo
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $redirectCadastro = ($tipo === 'empresa')
            ? '../../public/cadastroEmpresa.php'
            : '../../public/cadastroPessoa.php';


        $errors = [];

        // Validações 
        if (!Security::validateEmail($email)) {
            $errors['email'] = "❌ Email inválido!";
        }

        if (!Security::validateTelefone($telefone)) {
            $errors['telefone'] = "❌ Telefone inválido!";
        }

        if (!Security::validatePassword($senha)) {
            $errors['senha'] = "❌ A senha deve ter pelo menos 8 caracteres";
        }

        if ($tipo === 'empresa') {
            if (!Security::validateCNPJ($cnpj)) {
                $errors['cnpj'] = "❌ CNPJ inválido!";
            }
        }

        if ($tipo === 'pessoa') {
            if (!Security::validateCPF($cpf)) {
                $errors['cpf'] = "❌ CPF inválido!";
            }
        }



        if (!empty($errors)) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'messages' => $errors,
                'old' => $dados
            ];

            header("Location: $redirectCadastro");
            exit;
        }
    }

    try {
        $userModel = new Usuario($pdo);

        // Verifica se email já existe
        $usuario = $userModel->findByEmail($email);

        if ($usuario) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'messages' => ["⚠️ Email já cadastrado!"],
                'old' => $dados
            ];

            header("Location: $redirectCadastro");
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
            $dadosPessoa = [
                'nome' => Security::sanitizeInput($dados['nome'] ?? ''),
                'cpf' => Security::sanitizeInput($dados['cpf'] ?? ''),
                'telefone' => Security::sanitizeInput($dados['telefone'] ?? ''),
                'instituicao' => Security::sanitizeInput($dados['instituicao'] ?? ''),
                'curso' => Security::sanitizeInput($dados['curso'] ?? '')
            ];
            $userModel->createPessoa($userId, $dadosPessoa);
        } elseif ($tipo === 'empresa') {
            $dadosEmpresa = [
                'nome' => Security::sanitizeInput($dados['nome'] ?? ''),
                'cnpj' => Security::sanitizeInput($dados['cnpj'] ?? ''),
                'telefone' => Security::sanitizeInput($dados['telefone'] ?? ''),
                'cidade' => Security::sanitizeInput($dados['cidade'] ?? '')
            ];
            $userModel->createEmpresa($userId, $dadosEmpresa);
        }

        // Se der tudo certo, confirma tudo
        $pdo->commit();

        // Sucesso
        $_SESSION['flash'] = [
            'type' => 'success',
            'messages' => ["✅ Conta criada com sucesso!"],
        ];

        header("Location: ../../public/login.php");
        exit;
    } catch (PDOException $e) {
        error_log("Erro no cadastro " . $e->getMessage());

        // Se estiver em transaction, o rollBack volta se der alguma coisa errada
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }

        $_SESSION['flash'] = [
            'type' => 'error',
            'messages' => ["⚠️ Erro no sistema. Tente novamente mais tarde."],
            'old' => $dados
        ];

        header("Location: $redirectCadastro");
        exit;
    }
}
