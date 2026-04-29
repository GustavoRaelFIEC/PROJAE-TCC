<?php

require_once __DIR__ . "/../../src/middlewares/auth.php";
require_once __DIR__ . "/../../src/controllers/InscricaoController.php";


verificarTipo('empresa');
$inscricoes = visualizarInscricoesEmpresa($pdo);

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
    <link rel="stylesheet" href="../assets/css/dashboardEmpresa.css">
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
    <div>
        <button onclick="abrirMenu()" class="btn-vaga">Nova Vaga</button>
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

    <div id="postar-vaga">
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

    <script>
        function abrirMenu() {
            document.body.style.overflow = "hidden";
            document.getElementById("overlay").style.display = "block";
            document.getElementById("postar-vaga").style.display = "block";
        }

        function fecharMenu() {
            document.body.style.overflow = "auto";
            document.getElementById("overlay").style.display = "none";
            document.getElementById("postar-vaga").style.display = "none";
        }
    </script>
</body>

</html>