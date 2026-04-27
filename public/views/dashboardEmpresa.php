<?php

require_once __DIR__ . "/../../src/middlewares/auth.php";
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
    <link rel="stylesheet" href="../assets/css/dashboardEmpresa.css">

    <title>Dashboard Empresa</title>
</head>

<body>
    <header class="cabecalho">
        <div class="logo"><a href="../index.php"><img class="img" src="../assets/img/imagotipo.png" alt="Projae logo"></a></div>
        <ul class="list">
            <li><a class="item-list active" href="../index.php">Página Principal</a></li>
            <li><a class="item-list" href="about.php">Sobre</a></li>
            <li><a class="item-list" href="help.php">Ajuda</a></li>
        </ul>
        <div class="cta">
            <!-- Foto de Perfil -->
            <!-- Notificações -->
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
                <li>teste 1</li>
                <li>teste 2</li>
            </ul>
        </aside>
    </main>

    <!-- ainda decidir onde colocar botão de criar vagas -->


    <a href="testePostarVaga.php">teste para postar vaga</a>

    <div>
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
    </div>
</body>


</html>