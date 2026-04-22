<?php

// require_once __DIR__ . "/../../src/controllers/VagaController.php";

// $vagas = handleBuscarVaga($pdo);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/globalEimports.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/vagas.css">
</head>

<body>

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

    <div>
        <button onclick="abrirMenu()" class="btn-vaga">Nova Vaga</button>
    </div>

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
        </form>

        <button onclick="fecharMenu()">Fechar</button>

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

    </div>
</body>

</html>