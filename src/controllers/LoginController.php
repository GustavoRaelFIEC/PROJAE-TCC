<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/Usuarios.php';
require_once __DIR__ . '/../utils/Security.php';
require_once __DIR__ . '/../utils/Session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    handleLogin($pdo);
}

function handleLogin($pdo)
{

    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $senha = $_POST['senha'] ?? '';

    //Validações
    $errors = [];

    if (!Security::validateEmail(($email))) {
        $errors[] = "Email inválido!";
    }

    //validate senha

    if (empty($errors)) {
        try {
            $userModel = new Usuario($pdo);

            $usuario = $userModel->findByEmail($email);

            if ($usuario && $senha === $usuario['senha']) { //trocar $senha por Security::verifyPassword($senha, $usuario['senha'])
                //Login bem-sucedido
                Session::setUsuario($usuario);

                header("Location: /PROJAE-TCC/src/views/pessoa.php");
                exit();
            } else {
                $errors[] = "Email ou senha incorretos";
            }
        } catch (PDOException $e) {
            error_log("Erro no login: " . $e->getMessage());
            $errors[] = "Erro no sistema. Volte mais tarde.";
        }
    }

    if (!empty($errors)) {
        header('Location: ../../public/login.php');
        exit();
    }
}
