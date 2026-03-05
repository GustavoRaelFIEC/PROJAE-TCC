<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/Usuarios.php';
require_once __DIR__ . '/../utils/Security.php';
require_once __DIR__ . '/../utils/Session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        handleCadastro($pdo);
    
}

function handleCadastro($pdo) {
    Session::start();

    // Dados do formulário
    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $senha = $_POST['senha'] ?? '';
    $tipo = $_POST['tipo'] ?? '';

    $errors = [];

    // Validações 
    if (!Security::validateEmail($email)) {
        $errors[] = "❌ Email inválido!";
    }

    if (!Security::validatePassword($senha)) {
        $errors[] = "❌ A senha deve ter pelo menos 8 caracteres";
    }

    if(!Security::validateTipo($tipo)) {
        $errors[] = "❌ Tipo de usuário inválido";
    }

    if (!empty($errors)) {
        $_SESSION['cadastro_errors'] = $errors;
        header("Location: ../../public/cadastro.php");
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
        if($tipo === 'pessoa') {

        $nome = Security::sanitizeInput($_POST['nome'] ?? '');
        $cpf = Security::sanitizeInput($_POST['cpf'] ?? '');        
        $telefone = Security::sanitizeInput($_POST['telefone'] ?? '');
        $instituicao = Security::sanitizeInput( $_POST['instituicao'] ?? '');
        $curso = Security::sanitizeInput($_POST['curso'] ?? '');

        $stmt = $pdo->prepare("
        INSERT INTO pessoas (nome, cpf, telefone, instituicao, curso, id_usuario)
        VALUES (?, ?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $nome,
            $cpf,
            $telefone,
            $instituicao,
            $curso,
            $userId
        ]);
        } elseif($tipo === 'empresa') {

        $nome = Security::sanitizeInput($_POST['nome'] ?? '');
        $cnpj = Security::sanitizeInput($_POST['cnpj'] ?? '');        
        $telefone = Security::sanitizeInput($_POST['telefone'] ?? '');
        $cidade = Security::sanitizeInput($_POST['cidade'] ?? '');

        $stmt = $pdo->prepare("
        INSERT INTO empresas (nome, cnpj, telefone, cidade, id_usuario)
        VALUES (?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $nome,
            $cnpj,
            $telefone,
            $cidade,
            $userId
        ]);    
    }
    
    // Se der tudo certo, confirma tudo
    $pdo->commit();

    // Sucesso
    $_SESSION['sucesso'] = "✅ Conta criada com sucesso!";
    
    header("Location: ../../public/login.php");
    exit;
    

    } catch (PDOException $e) {
        
        error_log("Erro no cadastro " . $e->getMessage());

        $_SESSION['cadastro_errors'] = ["⚠️ Erro no sistema. Tente novamente mais tarde."];

        // Se estiver em transaction o rollBack volta, se der alguma coisa errada
        if ($pdo->inTransaction()) {
             $pdo->rollBack();
        }

        header("Location: ../../public/cadastro.php");
        exit;
    }
}
