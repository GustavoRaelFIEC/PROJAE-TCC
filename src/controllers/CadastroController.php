<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/Usuarios.php';
require_once __DIR__ . '/../utils/Security.php';
require_once __DIR__ . '/../utils/Session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        handleCadastro($pdo);
    
}

function handleCadastro($pdo)
{
    Session::start();

    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $senha = $_POST['senha'] ?? '';

    $errors = [];

    // Validações básicas
    if (!Security::validateEmail($email)) {
        $errors[] = "Email inválido!";
    }

    if (!Security::validatePassword($senha)) {
        $errors[] = "A senha deve ter pelo menos 8 caracteres";
    }

    if (!empty($errors)) {
        $_SESSION['login_errors'] = $errors;
        header("Location: ../../public/login.php");
        exit;
    }

    try {
        $userModel = new User($pdo);
        $usuario = $userModel->findByEmail($email);

        if (!$usuario) {
            $_SESSION['login_errors'] = ["Usuário não encontrado!"];
            header("Location: ../../public/login.php");
            exit;
        }

        // Verifica senha
        if (!Security::verifyPassword($senha, $usuario['senha'])) {
            $_SESSION['login_errors'] = ["Senha incorreta!"];
            header("Location: ../../public/login.php");
            exit;
        }

        // Login OK, cria sessão
        Session::setUsuario($usuario);

        // Redirecionamento por tipo
        if ($usuario['tipo'] === 'pessoa') {
            header("Location: ../../public/dashboard/pessoa.php");
            exit;
        }

        if ($usuario['tipo'] === 'empresa') {
            header("Location: ../../public/dashboard/empresa.php");
            exit;
        }

    } catch (PDOException $e) {
        error_log("Erro no login: " . $e->getMessage());
        $_SESSION['login_errors'] = ["Erro no sistema. Volte mais tarde."];
        header("Location: ../../public/login.php");
        exit;
    }
}