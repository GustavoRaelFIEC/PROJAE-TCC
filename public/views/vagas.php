<?php

require_once __DIR__ . "/../../src/middlewares/auth.php";
require_once __DIR__ . "/../../src/controllers/InscricaoController.php";
require_once __DIR__ . "/../../src/controllers/VagaController.php";

verificarLogin();
$vagas = handleBuscarVaga($pdo);

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
    <link rel="stylesheet" href="../assets/css/vagas.css">

    <title>Dashboard Empresa</title>
</head>

<body>
    <header class="cabecalho">
        <div class="contentCabecalho">
            <div class="logo"><img class="img" src="../assets/img/imagotipo.png" alt="Projae logo"></div>
            <ul class="list">
                <li><a class="item-list active" href="" onclick="location.reload()">Início</a></li>
                <li><a class="item-list" href="vagas.php">Vagas</a></li>
            </ul>
            <div class="cta">
                <a href="./logout.php" class="btnSair">Sair</a>
            </div>
        </div>
    </header>
    <main class="principal">
        <div class="content">
            <aside>
                
            </aside>
            <div id="listagem-vagas">
                <?php foreach ($vagas as $vaga): ?>
                    <div class="card">
                        <form method="POST" action="../../src/controllers/InscricaoController.php">
                            <input type="hidden" name="id_vaga" value="<?= $vaga['id_vaga'] ?>">
                            <p><?= $vaga['data_publicacao'] ?></p>
                            <h1 class="cardTitulo"><?= $vaga['titulo'] ?></h1>
                            <p><?= $vaga['descricao'] ?></p>
                            <p><?= $vaga['tipo'] ?></p>
                            <p><?= $vaga['salario'] ?></p>
                            <p><?= $vaga['cidade'] ?></p>
                            <p><?= $vaga['nome'] ?></p>
                            <button type="submit">Inscrever-se</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>
</body>

</html>