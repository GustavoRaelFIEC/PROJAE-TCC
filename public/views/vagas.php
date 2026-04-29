<?php

<<<<<<< HEAD
// require_once __DIR__ . "/../../src/controllers/VagaController.php";

// $vagas = handleBuscarVaga($pdo);
=======
require_once __DIR__ . "/../../src/middlewares/auth.php";
require_once __DIR__ . "/../../src/controllers/InscricaoController.php";
require_once __DIR__ . "/../../src/controllers/VagaController.php";

verificarLogin();
$vagas = handleBuscarVaga($pdo);
>>>>>>> 30319de1b0acc4d0cce043743b3e5457629f14e3

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
<<<<<<< HEAD

    <!-- <?php
    // foreach ($vagas as $vaga):
    ?>
    <div style="border: 5px solid black;">
        <form method="POST" action="../../src/controllers/InscricaoController.php">
        <input type="hidden" name="id_vaga" value="<//?= $vaga['id_vaga'] ?>">
        <p><//?= $vaga['titulo'] ?></p>
        <p><//?= $vaga['descricao'] ?></p>
        <p><//?= $vaga['tipo'] ?></p>
        <p><//?= $vaga['salario'] ?></p>
        <p><//?= $vaga['cidade'] ?></p>
        <p><//?= $vaga['status'] ?></p>
        <p><//?= $vaga['data_publicacao'] ?></p>
        <p><//?= $vaga['nome'] ?></p>
        <button type="submit">Inscrever-se</button>
        </form>
        
    </div>
    <?php
    // endforeach;
    ?> -->

    <!-- tem que colocar a filtragem certa pra so aparecer as vagas da emmpresa -->

    <div id="overlay" onclick="fecharMenu()"></div>

=======
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
>>>>>>> 30319de1b0acc4d0cce043743b3e5457629f14e3
    <div>
        <form action="" role="search">
            <input type="search" class="input-search" id="search-bar" placeholder="Pesquise suas vagas" required>
            <button type="submit" class="btn-search">Procurar</button>
        </form>
    </div>

<<<<<<< HEAD
    <div id="postar-vaga">
        <h1 class="titulo">NOVA VAGA</h1>
        <form method="POST" action="../../src/controllers/VagaController.php/?action=postarVaga">
            <label class="input-label" for="nome">
                Titulo
                <input class="input"
                    type="text"
                    id="titulo"
                    name="titulo"
                    placeholder="Insira aqui o nome da vaga"
                    value=""
                    required
                    maxlength="150"
                    minlength="2"
                    autocomplete="off">
            </label>
            <label class="input-label" for="tipo">
                Tipo
                <select class="input"
                    name="tipo"
                    id="tipo"
                    default="Selecione o tipo da vaga"
                    required>
                    <option value="estagio">Estagio</option>
                    <option value="aprendiz">Jovem Aprendiz</option>
                    <!-- colacar as opçoes dps -->
                </select>
            </label>
            <label class="input-label" class="desc">
                Descrição
                <textarea
                    class="input-desc"
                    id="descricao"
                    name="descricao"
                    placeholder="Descreva sua vaga detalhadamente aqui"
                    maxlength="500"
                    required
                    autocomplete="off">
                </textarea>
            </label>
            <label class="input-label">
                Salario
                <input class="input"
                    type="number"
                    id="salario"
                    name="salario"
                    placeholder="Insira o salario da vaga aqui"
                    step="0.01"
                    value=""
                    min="0"
                    required
                    autocomplete="off">
            </label>
            <label class="input-label">
                Cidade
                <input class="input"
                    type="text"
                    id="cidade"
                    name="cidade"
                    placeholder="Coloque a cidade onde sua vaga é localizada"
                    value=""
                    required
                    maxlength="100"
                    autocomplete="off">
            </label>
            <input
                type="text"
                name="status"
                value="aberta"
                hidden>
            <!-- tags -->
            <button class="btn-submit-vaga" type="submit">Publicar</button>
=======


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
>>>>>>> 30319de1b0acc4d0cce043743b3e5457629f14e3
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