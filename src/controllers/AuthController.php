<?php

require_once './src/config/database.php';
require_once './src/models/User.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $action = $_GET['action'] ?? '';

    if($action === 'login'){
        handleLogin($pdo);
    }
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

    }catch(PDOException $e){
        error_log("Erro no login: " . $e->getMessage());
        $errors[] = "Erro no sistema. Volte mais tarde.";
    }
}
}