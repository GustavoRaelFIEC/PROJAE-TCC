<?php

require_once __DIR__ . '../../utils/Session.php';
Session::start();  // <-- inicia a sessão

if (!Session::isLogged()) {
    header('Location: ../../public/login.php');
    exit;
}

$usuario = Session::getUsuario();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard PESSOA</title>
</head>
<body>
    <h1>DASH BOARD PESSOA</h1>
    
</body>
</html>