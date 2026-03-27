<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/Usuarios.php';
require_once __DIR__ . '/../utils/Security.php';
require_once __DIR__ . '/../utils/Session.php';
Session::start();


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

    //validate senha AQUI
      if (!Security::validatePassword($senha)) {
        $errors[] = "Senha inválida!";
    }
    

    if (empty($errors)) {
        try {

            $userModel = new Usuario($pdo);

            $usuario = $userModel->findByEmail($email);

            if ($usuario && Security::verifyPassword($senha, $usuario['senha'])) { //trocar $senha por Security::verifyPassword($senha, $usuario['senha'])
                //Login bem-sucedido
                Session::setUsuario($usuario);

                if ($usuario['tipo'] === 'pessoa') {
                    header("Location: ../../../public/views/dashboardPessoa.php");
                    exit();
                } else if ($usuario['tipo'] === 'empresa') {
                    header("Location: ../../../public/views/dashboardEmpresa.php");
                    exit();
                }

                //LEMBRAR DE USAR "FIND BY ID" PARA TRAZER AS INFORMAÇÕES DE CADA UM EM SUAS RESPECTIVAS PÁGINAS (INFORMAÇÕES NO DASHBOARD, perfil por exemplo)
            } else {
                $errors[] = "Email ou senha incorretos";
            }
        } catch (PDOException $e) {
            error_log("Erro no login: " . $e->getMessage());
            $errors[] = "Erro no sistema. Volte mais tarde.";
        }
    }
    
    if (!empty($errors)) {
      header("Location: ../../../public/views/login.php");
        exit();
    }
}