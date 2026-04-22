<?php

require_once __DIR__ . "/../../src/controllers/InscricaoController.php";

$inscricoes = visualizarInscricoes($pdo);

?>

<!DOCTYPE html>
<html lang="pt-BR">

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
    <h1>BUSCAR VAGAS -TESTE</h1>
    <p>Página provisória para teste de listar e filtrar vagas</p>
    <form method="GET" action="" id="filtroForm">
        <select name="tipo" onchange="this.form.submit()">
            <option value="">Selecione Tipo</option>
            <option value="Aprendiz" <?= (($_GET['tipo'] ?? '') == 'Aprendiz') ? 'selected' : '' ?>>Aprendiz</option>
            <option value="Estagio" <?= (($_GET['tipo'] ?? '') == 'Estagio') ? 'selected' : '' ?>>Estágio</option>
        </select>
    </form>
    <?php
    foreach ($inscricoes as $inscricao):
    ?>
    <div style="border: 5px solid black;">
        <p><?= $inscricao['titulo_vaga'] ?></p>
        <p><?= $inscricao['nome_pessoa'] ?></p>
        <p><?= $inscricao['data_inscricao'] ?></p>
    </div>
    <?php
    endforeach;
    ?>
</body>

</html>