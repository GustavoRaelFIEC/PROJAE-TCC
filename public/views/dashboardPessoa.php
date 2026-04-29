<?php

require_once __DIR__ . "/../../src/middlewares/auth.php";
require_once __DIR__ . "/../../src/controllers/InscricaoController.php";
require_once __DIR__ . "/../../src/controllers/DadosController.php";

verificarTipo('pessoa');
$inscricoes = visualizarInscricoesPessoa($pdo);
$dados = handleDadosPessoa($pdo);

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
    <link rel="stylesheet" href="../assets/css/dashboardPessoa.css">

    <title>Dashboard - PROJAE</title>
</head>

<body class="corpo">
    <div id="overlay" onclick="fecharMenu()"></div>
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
            <div id="editPerfil">
                <h1 class="tituloForm">Editar Perfil</h1>
                <form class="formulario">
                    <input type="hidden" name="tipo" value="pessoa">

                    <!-- Fazer com que ele consiga editar a foto dele -->
                    <!-- <label class="input-label">
                        <p>Foto:</p>
                        <input class="input"
                            type="file"
                            name="foto"
                        >
                    </label> -->

                    <label class="input-label" for="nome">
                        <p>Nome:</p>
                        <input class="input"
                            placeholder="Digite seu Nome"
                            id="nome"
                            name="nome"
                            type="text"
                            maxlength="255">
                    </label>

                    <label class="input-label" for="instituicao">
                        <p>Instituição:</p>
                        <input class="input"
                            placeholder="Digite o nome da sua instituição"
                            id="instituicao"
                            name="instituicao"
                            type="text"
                            maxlength="255">
                    </label>

                    <label class="input-label" for="curso">
                        <p>Curso:</p>
                        <input class="input"
                            placeholder="Digite o seu curso"
                            id="curso"
                            name="curso"
                            type="text"
                            maxlength="255">

                    </label>

                    <label class="input-label" for="telefone">
                        <p>Telefone:</p>
                        <input class="input"
                            placeholder="Digite o nome da sua instituição"
                            id="telefone"
                            name="telefone"
                            type="tel"
                            maxlength="255">
                    </label>

                    <label class="input-label" for="regiao">
                        <p>Região:</p>
                        <?php /*mudar o input para select e option*/ ?>
                        <input class="input"
                            placeholder="Escolha sua Região"
                            id="regiao"
                            name="regiao"
                            type="text"
                            maxlength="255">
                    </label>

                    <button class="btn-submit" type="submit">Cadastrar</button>
                    <button class="btn-cancelar" type="submit">Cancelar</button>
                </form>
            </div>
            <section class="perfil">
                <div class="detalhesPerfil">
                    <div class="fotoPerfil"><img src="../assets/img/testeIMG.png" alt="Sua Foto de Perfil"></div>
                    <div>
                        <h1 class="nomePerfil"><?= $dados['nome'] ?></h1>
                        <h2 class="instituicaoPerfil"><?= $dados['instituicao'] ?></h2>
                        <h2 class="cursoPerfil"><?= $dados['curso'] ?></h2>
                        <h2 class="telefonePerfil"><?= $dados['telefone'] ?></h2>
                        <h2 class="regiaoPerfil"><?= $dados['cpf'] ?></h2>
                    </div>
                </div>
                <button onclick="abrirMenu()" class="btnEditar"><i class="fa-solid fa-pen-to-square"></i></button>
            </section>
            <section class="vagasInscritas">
                <h1 class="titulo">Vagas Inscritas</h1>
                <div class="cards">
                    <div class="card">
                        <?php
                            foreach ($inscricoes as $inscricao):
                            ?>
                            <div style="border: 5px solid black;">
                                <p><?= $inscricao['titulo'] ?></p>
                                <p><?= $inscricao['descricao'] ?></p>
                                <p><?= $inscricao['tipo'] ?></p>
                                <p><?= $inscricao['salario'] ?></p>
                                <p><?= $inscricao['cidade'] ?></p>
                                <p><?= $inscricao['status'] ?></p>
                                <p><?= $inscricao['data_publicacao'] ?></p>
                                <p><?= $inscricao['data_inscricao'] ?></p>
                            </div>
                            <?php
                            endforeach;
                        ?>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <!-- Criar um arquivo javaScript -->
    <script>
        const editPerfil = document.getElementById("editPerfil");
        const overlay = document.getElementById("overlay");

        function abrirMenu() {
            editPerfil.classList.add("ativo");
            overlay.classList.add("ativo");
            document.body.style.overflow = "hidden";
        }

        function fecharMenu() {
            editPerfil.classList.remove("ativo");
            overlay.classList.remove("ativo");
            document.body.style.overflow = "auto";
        }
    </script>
</body>

</html>