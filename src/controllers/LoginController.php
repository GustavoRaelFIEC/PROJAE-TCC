<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/Pessoa.php';
require_once __DIR__ . '/../models/Empresa.php';
require_once __DIR__ . '/../models/Vaga.php';
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
        $errors['email'] = "Email Inválido!";
    }

    //validate senha AQUI
    if (empty($senha)) {
        $errors['senha'] = "Senha Inválida!";
    }


    if (empty($errors)) {
        try {

            $pessoaModel = new Pessoa($pdo);

            $usuario = $pessoaModel->findByEmail($email);

            if ($usuario && Security::verifyPassword($senha, $usuario['senha'])) {
                //Login bem-sucedido
                Session::setUsuario($usuario);

                if ($usuario['tipo'] === 'pessoa') {
                    header("Location: /PROJAE-TCC/public/views/dashboardPessoa.php");
                    exit();
                } else if ($usuario['tipo'] === 'empresa') {
                    header("Location: /PROJAE-TCC/public/views/dashboardEmpresa.php");
                    exit();
                }

                //LEMBRAR DE USAR "FIND BY ID" PARA TRAZER AS INFORMAÇÕES DE CADA UM EM SUAS RESPECTIVAS PÁGINAS (INFORMAÇÕES NO DASHBOARD, perfil por exemplo)
            } else {
                $errors['login'] = "Email ou Senha Incorretos!";
            }
        } catch (PDOException $e) {
            error_log("Erro no login: " . $e->getMessage());
            $errors['sistema'] = "Erro no sistema. Volte mais tarde.";
        }
    }

    $_SESSION['errors'] = $errors;

    header("Location: ../../public/views/login.php");
    exit();
}
