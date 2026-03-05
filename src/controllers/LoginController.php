<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/Usuarios.php';
require_once __DIR__ . '/../utils/Security.php';
require_once __DIR__ . '/../utils/Session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        handleLogin($pdo);
}

function handleLogin($pdo){
   
    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $senha = $_POST['senha'] ?? '';

    //Validações
    $errors = [];

    if(!Security::validateEmail(($email))){
        $errors[] = "Email inválido!";
    }

    if(!Security::validatePassword($senha)){
        $errors[] = "A senha deve ter pelo menos 2 caracteres";
    }


    if(empty($errors)){
        try{
        $userModel = new User($pdo);

        $usuario = $userModel->findByEmail($email);

        if($usuario && password_verify($senha, $usuario['senha_hash'])){
                //Login bem-sucedido
                Session::setUsuario($usuario);

                 $opcao = $_POST['opcao'];

                if($opcao == 1){
                    header('Location: ../../src/views/pessoa.php');
                }else{
                    header('Location: ../../src/views/empresa.php');
                }

                exit();
        }else{
            $errors[] = "Email ou senha incorretos";
        }
    }catch(PDOException $e){
        error_log("Erro no login: " . $e->getMessage());
        $errors[] = "Erro no sistema. Volte mais tarde.";
    }
}

    if(!empty($errors)){
        header('Location: ../../public/login.php');
        exit();
    }
}

?>