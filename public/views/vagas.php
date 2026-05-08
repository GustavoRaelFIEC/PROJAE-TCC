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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="shortcut icon" href="../assets/img/isotipo.png" type="image/x-icon">

    <link rel="stylesheet" href="../assets/css/globalEimports.css">
    <link rel="stylesheet" href="../assets/css/navegation.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/vagas.css">

    <title>Vagas</title>
</head>

<body class="corpo">
    <header class="cabecalho">
        <div class="contentCabecalho">
            <div class="logo"><img class="img" src="../assets/img/imagotipo.png" alt="Projae logo"></div>
            <ul class="list">
                <li><a class="item-list active" href="" onclick="location.reload()">Início</a></li>
                <li><a class="item-list" href="vagas.php">Buscar Vagas</a></li>
            </ul>
            <div class="cta">
                <a href="./logout.php" class="btnSair">Sair</a>
            </div>
        </div>
    </header>
    <main class="principal">
        <search class="search">
            <input class="inputSearch" type="text"><i class="fa-solid fa-search"></i>
        </search>
        <div class="content">
            <aside class="filtros">
                <h1 style="font-weight: bold;">Filtros da vaga</h1>

                <form class="filtroTipo" method="GET" action="../../src/controllers/VagaController.php">
                    <input type="hidden" name="action" value="filtrarPorTipo">

                    <select name="tipo" onchange="this.form.submit()">
                        <option value="">Selecione o tipo da vaga</option>
                        <option value="aprendiz">Jovem Aprendiz</option>
                        <option value="estagio">Estagiário</option>
                    </select>
                </form>
            </aside>
            <div id="listagemVagas">
                <?php foreach ($vagas as $vaga): ?>
                    <div class="card">
                        <form method="POST" action="../../src/controllers/InscricaoController.php">
                            <input type="hidden" name="id_vaga" value="<?= $vaga['id_vaga'] ?>">
                            <p class="dataPublicacao"><?= $vaga['data_publicacao'] ?></p>
                            <p class="nome"><?= $vaga['nome'] ?></p>
                            <h1 class="cardTitulo"><?= $vaga['titulo'] ?></h1>
                            <p class="descricao"><?= $vaga['descricao'] ?></p>
                            <div class="tags">
                                <span class="tipo"><?= $vaga['tipo'] ?></span>
                                <span class="salario"><?= $vaga['salario'] ?></span>
                                <span class="cidade"><?= $vaga['cidade'] ?></span>
                            </div>
                            <div class="cta">
                                <button class="btn detalhes" type="button" onclick="abrirDetalhes()">Detalhes</button> <!-- Fazer a função para abrir e fechar os detalhes de cada Card -->
                                <button id="inscreverSe" class="btn inscreverSe" type="submit">Inscrever-se</button>
                            </div>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
    </main>
</body>

</html>