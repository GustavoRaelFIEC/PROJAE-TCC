<?php

require_once __DIR__ . "/../../src/middlewares/auth.php";
require_once __DIR__ . "/../../src/controllers/InscricaoController.php";
require_once __DIR__ . "/../../src/controllers/DadosController.php";


verificarTipo('empresa');
$inscricoes = visualizarInscricoesEmpresa($pdo);
$dados = handleDadosEmpresa($pdo)


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="shortcut icon" href="/public/assets/img/isotipo.png" type="image/x-icon">
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

                    <label class="input-label" for="cor">
                        <p>Cor:</p>
                        <p style="color: gray;">Escolha uma cor para representar sua empresa</p>
                    </label>
                    <input
                        style="margin-top: -15px;"
                        id="cor"
                        name="cor"
                        type="color">

                    <button class="btn-submit" type="submit">Salvar</button>
                    <button class="btn-cancelar" onclick="fecharMenu()">Cancelar</button>
                </form>
            </div>
            <section class="perfil">
                <div class="detalhesPerfil">
                    <div class="fotoPerfil"><img src="../assets/img/fotoPerfilPadrao.jpg" alt="Sua Foto de Perfil"></div>
                    <div>
                        <h1 class="nomePerfil"><?= $dados['nome'] ?></h1>
                        <h2 class="telefonePerfil"><?= $dados['telefone'] ?></h2>
                        <h2 class="regiaoPerfil"><?= $dados['cidade'] ?></h2>
                    </div>
                </div>
                <button onclick="abrirMenuPerfil()" class="btnEditar"><i class="fa-solid fa-pen-to-square"></i></button>
            </section>
            <div>
                <button onclick="abrirMenuVaga()" class="btn-vaga">Nova Vaga</button>
            </div>

            <div>
                <p id="page-candidatos" onclick="toggleCandidatos()">Seus candidatos</p>
                <p id="page-vagas" onclick="toggleVagas()">Suas vagas</p>
            </div>

            <div id="conteudoCandidatos">
                <?php foreach ($inscricoes as $inscricao): ?>
                    <div style="border: 5px solid black;">
                        <p><?= $inscricao['titulo_vaga'] ?></p>
                        <p><?= $inscricao['nome_pessoa'] ?></p>
                        <p><?= $inscricao['data_inscricao'] ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div id="conteudoVagas" class="hidden">
                <p>Conteúdo de teste</p>
            </div>

            <div id="novaVaga">
                <form class="formulario" method="POST" action="../../src/controllers/VagaController.php?action=postarVaga">
                    <input type="hidden" name="action" value="postarVaga">
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
                            <option value="Estágio">Estágio</option>
                            <option value="aprendiz">Jovem Aprendiz</option>
                            <!-- colacar as opçoes dps -->
                        </select>
                    </label>
                    <label class="input-label" for="descricao">
                        Descrição
                        <input class="input"
                            id="descricao"
                            name="descricao"
                            placeholder="Descreva sua vaga detalhadamente aqui"
                            maxlength="500"
                            required>
                        </input>
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
                    <label class="input-label">
                        Cor
                        <input type="color" id="colorPicker">
                    </label>
                    <input
                        type="text"
                        name="status"
                        value="aberta"
                        hidden>
                    <button class="btn-submit" type="submit">Publicar</button>
                    <button class="btn-cancelar" onclick="fecharMenu()">Fechar</button>
                </form>

                
            </div>
        </div>
    </main>


    <script>
        let conteudo = 1;
        const editPerfil = document.getElementById("editPerfil");
        const novaVaga = document.getElementById("novaVaga")
        const overlay = document.getElementById("overlay");
        const picker = document.getElementById("colorPicker");
        const candidatos = document.getElementById("conteudoCandidatos");
        const vagas = document.getElementById("conteudoVagas");

        function abrirMenuPerfil() {
            novaVaga.classList.remove("ativo");
            editPerfil.classList.add("ativo");
            overlay.classList.add("ativo");
            document.body.style.overflow = "hidden";
        }

        function abrirMenuVaga() {
            editPerfil.classList.remove("ativo");
            novaVaga.classList.add("ativo");
            overlay.classList.add("ativo");
            document.body.style.overflow = "hidden";
        }

        function fecharMenu() {
            editPerfil.classList.remove("ativo");
            novaVaga.classList.remove("ativo");
            overlay.classList.remove("ativo");
            document.body.style.overflow = "auto";
        }

        picker.addEventListener("input", () => {
            localStorage.setItem("corEscolhida", picker.value);
        });


    function toggleCandidatos() {
        vagas.classList.add('hidden')
        candidatos.classList.remove('hidden')
    }

    function toggleVagas() {
        candidatos.classList.add('hidden')
        vagas.classList.remove('hidden')
    }
    </script>
</body>

</html>