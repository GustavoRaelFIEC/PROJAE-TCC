<?php

require_once __DIR__ . "/../../src/middlewares/auth.php";
require_once __DIR__ . "/../../src/controllers/InscricaoController.php";
require_once __DIR__ . "/../../src/controllers/DadosController.php";

$vagas = handleVagasDaEmpresa($pdo);

verificarTipo('empresa');
$inscricoes = visualizarInscricoesEmpresa($pdo);
$dados = handleDadosEmpresa($pdo);

$meses = [
    1 => 'Janeiro',
    'Fevereiro',
    'Março',
    'Abril',
    'Maio',
    'Junho',
    'Julho',
    'Agosto',
    'Setembro',
    'Outubro',
    'Novembro',
    'Dezembro'
];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - PROJAE</title>
    <link rel="shortcut icon" href="../assets/img/isotipo.png" type="image/x-icon">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="stylesheet" href="../assets/css/globalEimports.css">
    <link rel="stylesheet" href="../assets/css/navegation.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/dashboardEmpresa.css">
</head>

<body class="corpo">
    <div id="overlay" onclick="fecharMenu()"></div>
    <header class="cabecalho">
        <div class="contentCabecalho">
            <div class="logo"><img class="img" src="../assets/img/imagotipo.png" alt="Projae logo"></div>
            <ul class="list">
                <li><a class="item-list active" href="" onclick="location.reload()">Perfil</a></li>
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
                    <input type="hidden" name="tipo" value="empresa">

                    <label class="input-label" for="nome">
                        <p>Nome</p>
                        <input class="input"
                            placeholder="Digite seu Nome"
                            id="nome"
                            name="nome"
                            type="text"
                            maxlength="255">
                    </label>

                    <label class="input-label" for="instituicao">
                        <p>Instituição</p>
                        <input class="input"
                            placeholder="Digite o nome da sua instituição"
                            id="instituicao"
                            name="instituicao"
                            type="text"
                            maxlength="255">
                    </label>

                    <label class="input-label" for="curso">
                        <p>Curso</p>
                        <input class="input"
                            placeholder="Digite o seu curso"
                            id="curso"
                            name="curso"
                            type="text"
                            maxlength="255">

                    </label>

                    <label class="input-label" for="telefone">
                        <p>Telefone</p>
                        <input class="input"
                            placeholder="Digite o nome da sua instituição"
                            id="telefone"
                            name="telefone"
                            type="tel"
                            maxlength="255">
                    </label>

                    <label class="input-label" for="regiao">
                        <p>Região</p>
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
                        <h2 class="regiaoPerfil"><?= $dados['cidade'] ?></h2>
                        <h2 id="telefoneEmpresa" class="telefonePerfil">
                            <i class="fa-solid fa-phone"></i>
                            <span><?= $dados['telefone'] ?></span>
                        </h2>

                        <h2 id="cnpjEmpresa" class="regiaoperfil">
                            <i class="fa-regular fa-id-badge"></i>
                            <span><?= $dados['cnpj'] ?></span>
                        </h2>
                    </div>
                </div>
                <button onclick="abrirMenuPerfil()" class="btnEditar"><i class="fa-solid fa-pen-to-square"></i></button>
            </section>

            <div>
                <button onclick="abrirMenuVaga()" class="btn" style="background-color: #4938BE; font-size: 20px;">Nova Vaga</button>
            </div>

            <div class="pageSelector">
                <button id="pageCandidatos" class="page pageCandidatos pageCandidatosAtivo" onclick="toggleCandidatos()">CANDIDATOS</button>
                <button id="pageVagas" class="page pageVagas" onclick="toggleVagas()">VAGAS</button>
            </div>

            <section class="conteudo">
                <h1 id="titulo" class="titulo">Seus candidatos</h1>

                <div id="conteudoCandidatos">
                    <div id="listagem">

                        <?php foreach ($inscricoes as $inscricao):
                            $data = new DateTime($inscricao['data_inscricao']);
                        ?>
                            <div class="card cardCandidato">


                                <h1 class="cardTitulo" id="nomeCandidato">
                                    <?= htmlspecialchars($inscricao['nome_pessoa']) ?>
                                </h1>

                                <p class="paragrafoCard" id="nomeVaga">
                                    Vaga: <strong><?= htmlspecialchars($inscricao['titulo_vaga']) ?></strong>
                                </p>

                                <p class="paragrafoCard dataPublicacao">
                                    <!--A classe está dataPublicacao, mas é a data de inscrição, usei a mesma só pra agilizar-->
                                    <i class="fa-regular fa-clock"></i>
                                    <?= $data->format('d/m/Y') ?>
                                </p>


                            </div>

                        <?php endforeach; ?>

                    </div>
                </div>

                <div id="conteudoVagas" class="hidden">
                    <div class="listarVagas">
                        <?php if (empty($vagas)): ?>
                            <div style="
                                display: flex;
                                flex-direction: column;
                                align-items: center;
                                justify-content: center;
                                ">
                                <p>Nenhuma Vaga cadastrada</p>
                                <div>
                                    <button onclick="abrirMenuVaga()" class="btn">Nova Vaga</button>
                                </div>
                            </div>
                        <?php else: ?>
                            <div id="listagem">

                                <?php foreach ($vagas as $vaga):
                                    $data = new DateTime($vaga['data_publicacao']); ?>

                                    <div class="card">

                                        </p>
                                        <p class="paragrafoCard dataPublicacao">
                                            <i class="fa-regular fa-clock"></i>
                                            Data de Publicação:
                                            <?= $data->format('d') . ' ' .
                                                $meses[$data->format('n')] . ' ' .
                                                $data->format('Y') ?>
                                        </p>

                                        <h1 class="cardTitulo">
                                            <?= htmlspecialchars($vaga['titulo']) ?>
                                        </h1>

                                        <p class="paragrafoCard">
                                            <?= htmlspecialchars($vaga['descricao']) ?>
                                        </p>

                                        <div class="tags">
                                            <span class="tipo">
                                                <?= htmlspecialchars($vaga['tipo']) ?>
                                            </span>
                                            <span class="salario">
                                                R$ <?= $vaga['salario'] ?>
                                            </span>
                                            <span class="cidade">
                                                <?= htmlspecialchars($vaga['cidade']) ?>
                                            </span>
                                        </div>

                                        <div class="cta">
                                            <button class="btn excluirVaga" type="button">Excluir</button>
                                            <button class="btn fecharVaga" type="submit">Fechar Vaga</button>
                                        </div>

                                    </div>

                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>
            </section>


            <div id="novaVaga">
                <h1 class="tituloForm">Nova Vaga</h1>
                <form class="formulario" method="POST" action="../../src/controllers/VagaController.php?action=postarVaga">
                    <input type="hidden" name="action" value="postarVaga">
                    <label class="input-label" for="nome">
                        Título
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
                        Salário
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
                    <label class="input-label" for="cor">
                        <p>Cor:</p>
                        <p style="color: gray;">Escolha uma cor para representar sua vaga</p>
                    </label>
                    <input
                        style="margin-top: -15px;"
                        id="cor"
                        name="cor"
                        type="color">
                    <input type="hidden" name="status" value="aberta">
                    <button class="btn-submit" type="submit">Publicar</button>
                    <button class="btn-cancelar" onclick="fecharMenu()">Fechar</button>
                </form>


            </div>
        </div>
    </main>

    <script src="../assets/js/mascara.js"></script>

    <script>
        const telefoneEmpresa = document.querySelector("#telefoneEmpresa span");
        const cnpjEmpresa = document.querySelector("#cnpjEmpresa span");

        if (telefoneEmpresa) {
            telefoneEmpresa.textContent =
                mascaraTelefone(telefoneEmpresa.textContent);
        }

        if (cnpjEmpresa) {
            cnpjEmpresa.textContent =
                mascaraCNPJ(cnpjEmpresa.textContent);
        }

        // resto do seu código...
    </script>

    <script>
        const titulo = document.getElementById('titulo')
        const editPerfil = document.getElementById("editPerfil");
        const novaVaga = document.getElementById("novaVaga")
        const overlay = document.getElementById("overlay");
        const picker = document.getElementById("colorPicker");
        const candidatos = document.getElementById("conteudoCandidatos");
        const vagas = document.getElementById("conteudoVagas");
        const pageCandidatos = document.getElementById("pageCandidatos");
        const pageVagas = document.getElementById("pageVagas")

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
            pageVagas.classList.remove("pageVagasAtivo")
            pageCandidatos.classList.add("pageCandidatosAtivo")
            titulo.textContent = 'Seus Candidatos'
        }

        function toggleVagas() {
            candidatos.classList.add('hidden')
            vagas.classList.remove('hidden')
            pageCandidatos.classList.remove("pageCandidatosAtivo")
            pageVagas.classList.add("pageVagasAtivo")
            titulo.textContent = "Suas Vagas"
        }
    </script>
</body>

</html>