<?php

require_once __DIR__ . "/../../src/middlewares/auth.php";
require_once __DIR__ . "/../../src/controllers/InscricaoController.php";


verificarTipo('empresa');
$inscricoes = visualizarInscricoes($pdo);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/globalEimports.css">
    <link rel="stylesheet" href="../assets/css/navegation.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <!-- <link rel="stylesheet" href="../assets/css/dashboardEmpresa.css"> -->
    <link rel="stylesheet" href="../assets/css/dashboardPessoa.css">
</head>

<body>
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
                        <h1 class="nomePerfil">Nome</h1>
                        <h2 class="instituicaoPerfil">FIEC</h2>
                        <h2 class="cursoPerfil">TI - Tecnologia da Informação</h2>
                        <h2 class="telefonePerfil">11 98734-1209</h2>
                        <h2 class="regiaoPerfil">São Paulo - SP</h2>
                    </div>
                </div>
                <button onclick="abrirMenuPerfil()" class="btnEditar"><i class="fa-solid fa-pen-to-square"></i></button>
            </section>
        <div>
            <button onclick="abrirMenuVaga()" class="btn-vaga">Nova Vaga</button>
        </div>

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

        <div class="editPerfil" id="novaVaga">
            <form class="formulario" method="POST" action="../../src/controllers/VagaController.php/?action=postarVaga">
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
                        minlength="2">
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
                        required>
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
                        required>
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
                        maxlength="100">
                </label>
                <input
                    type="text"
                    name="status"
                    value="aberta"
                    hidden>
                <!-- tags -->
                <button class="btn-submit-vaga" type="submit">Publicar</button>
            </form>

            <button onclick="fecharMenu()">Fechar</button>
        </div>
    </div>
    </main>


    <script>
        const editPerfil = document.getElementById("editPerfil");
        const novaVaga = document.getElementById("novaVaga")
        const overlay = document.getElementById("overlay");

        function abrirMenuPerfil() {
            editPerfil.classList.add("ativo");
            overlay.classList.add("ativo");
            document.body.style.overflow = "hidden";
        }

        function abrirMenuVaga() {
            novaVaga.classList.add("ativo");
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