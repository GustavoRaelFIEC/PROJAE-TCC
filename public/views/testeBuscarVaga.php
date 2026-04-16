<?php

require_once __DIR__ . "/../../src/controllers/VagaController.php";

$vagas = handleBuscarVaga($pdo);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="../assets/img/isotipo.png" type="image/x-icon">

    <link rel="stylesheet" href="../assets/css/globalEimports.css">
    <link rel="stylesheet" href="../assets/css/navegation.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/buscarVaga.css">

    <title>Buscar vaga não será um página</title>
</head>
<body>
    <?php
        foreach($vagas as $vaga):
    ?>
    <div style="border: 5px solid black;">
        <p><?= $vaga['titulo'] ?></p>
        <p><?= $vaga['descricao'] ?></p>
        <p><?= $vaga['tipo'] ?></p>
        <p><?= $vaga['salario'] ?></p>
        <p><?= $vaga['cidade'] ?></p>
        <p><?= $vaga['status'] ?></p>
        <p><?= $vaga['data_publicacao'] ?></p>
        <p><?= $vaga['nome'] ?></p>
        <button>Inscrever-se</button>
    </div>
    <?php
    endforeach;
    ?>
</body>
</html>