<?php

require_once __DIR__ . "/../../src/middlewares/auth.php";
require_once __DIR__ . "/../../src/controllers/InscricaoController.php";
require_once __DIR__ . "/../../src/controllers/VagaController.php";

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
                <li><a class="item-list" href="dashboardPessoa.php">Início</a></li>
                <li><a class="item-list active" onclick="location.reload()">Vagas</a></li>
            </ul>
            <div class="cta">
                <a href="./logout.php" class="btnSair">Sair</a>
            </div>
        </div>
    </header>
    <div>
        <form action="" role="search">
            <input type="search" class="input-search" id="search-bar" placeholder="Pesquise suas vagas" required>
            <button type="submit" class="btn-search">Procurar</button>
        </form>
    </div>



    <main> <!--conteudo principal da pagina -->
        <section class="vagas">
            <!-- onde irao ficar as vagas da empresa, caso não tenha vagas tera um botão ou link para criar vagas aqui -->
            <p>teste</p>
        </section>
        <aside class="filtros">
            <ul>
                <li>Filtro 1</li>
                <li>Filtro 2</li>
            </ul>
        </aside>
    </main>

    <!-- ainda decidir onde colocar botão de criar vagas -->


    <a href="testePostarVaga.php">teste para postar vaga</a>

    <div>
        <form method="GET" action="" id="filtroForm">
            <select name="tipo" onchange="this.form.submit()">
                <option value="">Selecione Tipo</option>
                <option value="Aprendiz" <?= (($_GET['tipo'] ?? '') == 'Aprendiz') ? 'selected' : '' ?>>Aprendiz</option>
                <option value="Estagio" <?= (($_GET['tipo'] ?? '') == 'Estagio') ? 'selected' : '' ?>>Estágio</option>
            </select>
        </form>
        <?php
        foreach ($vagas as $vaga):
        ?>
            <div style="border: 5px solid black;">
                <form method="POST" action="../../src/controllers/InscricaoController.php">
                    <input type="hidden" name="id_vaga" value="<?= $vaga['id_vaga'] ?>">
                    <p><?= $vaga['titulo'] ?></p>
                    <p><?= $vaga['descricao'] ?></p>
                    <p><?= $vaga['tipo'] ?></p>
                    <p><?= $vaga['salario'] ?></p>
                    <p><?= $vaga['cidade'] ?></p>
                    <p><?= $vaga['status'] ?></p>
                    <p><?= $vaga['data_publicacao'] ?></p>
                    <p><?= $vaga['nome'] ?></p>
                    <button type="submit">Inscrever-se</button>
                </form>

            </div>
        <?php
        endforeach;
        ?>
    </div>
</body>


</html>