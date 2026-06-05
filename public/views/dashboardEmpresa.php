<?php

require_once __DIR__ . "/../../src/middlewares/auth.php";
require_once __DIR__ . "/../../src/controllers/InscricaoController.php";
require_once __DIR__ . "/../../src/controllers/DadosController.php";

verificarTipo('empresa');

$vagas = handleVagasDaEmpresa($pdo);
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
    <div id="overlay" onclick="fecharPopUps()"></div>
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
                <div>
                    <button onclick="abrirMenuVaga()" id="btn" class="btn" style="background-color: #4938BE; font-size: 20px;">Nova Vaga</button>
                </div>
            </section>

            <div class="pageSelector">
                <button id="pageCandidatos" class="page pageCandidatos pageCandidatosAtivo" onclick="toggleCandidatos()">CANDIDATOS</button>
                <button id="pageVagas" class="page pageVagas" onclick="toggleVagas()">VAGAS</button>
            </div>

            <section class="conteudo">
                <h1 id="tituloSecao" class="titulo">Seus candidatos</h1>

                <div id="conteudoCandidatos">
                    <div id="listagem">

                        <?php foreach ($inscricoes as $inscricao):
                            $data = new DateTime($inscricao['data_inscricao']);
                        ?>
                            <div class="card cardCandidato">

                                <p class="paragrafoCard" id="nomeVaga">
                                    Vaga: <strong><?= htmlspecialchars($inscricao['titulo_vaga']) ?></strong>
                                </p>

                                <h1 class="cardTitulo" id="nomeCandidato">
                                    <?= htmlspecialchars($inscricao['nome_pessoa']) ?>
                                </h1>

                                <p class="paragrafoCard">
                                    Curso: <strong><?= htmlspecialchars($inscricao['curso_pessoa']) ?></strong>
                                </p>

                                <p class="paragrafoCard telefoneCandidato">
                                    Telefone: <strong><?= htmlspecialchars($inscricao['telefone_pessoa']) ?></strong>
                                </p>

                                <p class="paragrafoCard">
                                    Email: <strong><?= htmlspecialchars($inscricao['email_pessoa']) ?></strong>
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
                                <p>Nenhuma Vaga cadastrada.</p>
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
                                            <button class="btn btnAbrirDetalhes" type="button" data-id="<?= $vaga['id_vaga'] ?>">Detalhes</button>
                                            <button class="btn fecharVaga <?= $vaga['status'] ?>" type="button" data-id="<?= $vaga['id_vaga'] ?>">
                                                <?= $vaga['status'] === 'aberta' ? 'Fechar Vaga' : 'Abrir Vaga' ?>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="confirmacao" style="box-shadow: 0 0 20px;">
                                        <h1>DESEJA REALMENTE EXCLUIR ESTA VAGA?</h1>
                                        <div class="cta">
                                            <button onclick="fecharPopUps()">NÃO</button>
                                            <button class="cancelarInscricao" data-id="<?= $vaga['id_vaga'] ?>">SIM</button>
                                        </div>
                                    </div>

                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
            </section>

            <div id="detalhesVaga">
                <div class="cardDetalhes">
                    <p class="paragrafoCard dataPublicacao" id="data_publicacao_formatada"></p>
                    <h1 class="nomeEmpresa" id="nomeEmpresa"></h1>
                    <h1 class="cardTitulo" id="titulo"></h1>
                    <p id="descricao"></p>
                    <div class="tags">
                        <span class="tipo" id="tipo"></span>
                        <span class="salario" id="salario">R$</span>
                        <span class="cidade" id="cidade"></span>
                    </div>
                    <div class="cta">
                        <button class="btn btnSairDetalhes" type="button" onclick="fecharPopUps()">Sair</button>
                        <button class="btn btn-excluir-vaga" type="button" onclick="popUpConfirmacao()">
                            Excluir Vaga
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div id="novaVaga">
            <h1 class="tituloForm">Nova Vaga</h1>
            <form class="formulario" method="POST" action="../../src/controllers/VagaController.php?action=postarVaga">
                <input type="hidden" name="action" value="postarVaga">
                <label class="input-label" for="nome">
                    Título
                    <input class="input"
                        type="text"
                        name="titulo"
                        placeholder="Insira aqui o nome da vaga"
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
                    <textarea class="input"
                        id="descricao"
                        name="descricao"
                        maxlength="500"
                        style="resize: none; height: 100px;"
                        placeholder="Descreva sua vaga detalhadamente aqui"
                        required></textarea>
                </label>
                <label class="input-label">
                    Salário
                    <input class="input"
                        type="number"
                        id="salario"
                        name="salario"
                        placeholder="Insira o salário da vaga aqui"
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
                <input type="hidden" name="status" value="aberta">
                <button class="btn-submit" type="submit">Publicar</button>
                <button type="button" class="btn-cancelar" onclick="fecharPopUps()">Fechar</button>
            </form>
        </div>
    </main>

    <script src="../assets/js/mascara.js"></script>

    <script>
        const telefoneEmpresa = document.querySelector("#telefoneEmpresa span");
        const cnpjEmpresa = document.querySelector("#cnpjEmpresa span");
        const telefoneCandidato = document.querySelector("#telefoneCandidato span");

        if (telefoneEmpresa) {
            telefoneEmpresa.textContent =
                mascaraTelefone(telefoneEmpresa.textContent);
        }

        if (cnpjEmpresa) {
            cnpjEmpresa.textContent =
                mascaraCNPJ(cnpjEmpresa.textContent);
        }

        document.querySelectorAll(".telefoneCandidato").forEach(elemento => {
            const telefone = elemento.querySelector("strong");

            if (telefone) {
                telefone.textContent = mascaraTelefone(telefone.textContent);
            }
        });

        // resto do seu código...
    </script>

    <script>
        const titulo = document.getElementById('tituloSecao')
        const editPerfil = document.getElementById("editPerfil");
        const novaVaga = document.getElementById("novaVaga")
        const overlay = document.getElementById("overlay");
        const picker = document.getElementById("cor");
        const candidatos = document.getElementById("conteudoCandidatos");
        const vagas = document.getElementById("conteudoVagas");
        const pageCandidatos = document.getElementById("pageCandidatos");
        const pageVagas = document.getElementById("pageVagas")
        const botoesFechar = document.querySelectorAll(".fecharVaga");
        const detalhesVaga = document.getElementById("detalhesVaga");
        const confirmacao = document.getElementById("confirmacao");

        const meses = [
            'Janeiro',
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

        botoesFechar.forEach(botao => {

            botao.addEventListener("click", async () => {

                const idVaga = botao.dataset.id;

                const response = await fetch(
                    "../../src/controllers/VagaController.php?action=alternarStatusVaga", {
                        method: "PUT",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            id_vaga: idVaga
                        })
                    }
                );

                const data = await response.json();

                if (data.success) {
                    if (botao.classList.contains("aberta")) {
                        botao.classList.replace("aberta", "fechada");

                        botao.innerText = "Abrir Vaga";
                    } else {
                        botao.classList.replace("fechada", "aberta");

                        botao.innerText = "Fechar Vaga";
                    }
                }


            });

        });

        let idVagaAtual = null; // guarda o ID da vaga aberta no modal

        document.querySelectorAll('.btnAbrirDetalhes').forEach(botao => {

            botao.addEventListener('click', async () => {

                const id = botao.dataset.id;

                idVagaAtual = id;

                // abre modal
                detalhesVaga.classList.add("ativo");
                overlay.classList.add("ativo");

                document.body.style.overflow = "hidden";

                // busca dados
                const resposta = await fetch(`../../src/controllers/DadosController.php?id=${id}`);

                const vaga = await resposta.json();

                Object.keys(vaga).forEach(chave => {

                    const elemento = document.getElementById(chave);

                    if (!elemento) return;

                    // tratamento das datas
                    if (chave === "data_publicacao_formatada") {

                        const [ano, mesNumero, dia] = vaga[chave].split("-");

                        const mes = meses[parseInt(mesNumero) - 1];

                        elemento.innerHTML = `<i class="fa-regular fa-clock"></i> Data de Publicação: ${dia} ${mes} ${ano}`;

                        return;
                    }

                    if (chave === "data_inscricao_formatada") {

                        const [ano, mesNumero, dia] = vaga[chave].split("-");

                        const mes = meses[parseInt(mesNumero) - 1];

                        elemento.innerHTML = `<i class="fa-regular fa-clock"></i> Data de Inscrição: ${dia} ${mes} ${ano}`;

                        return;
                    }

                    if (chave === "salario") {

                        elemento.innerText = 'R$ ' + vaga[chave];

                        return;
                    }

                    elemento.innerText = vaga[chave];

                });

            });

        });

        document.querySelectorAll('.cancelarInscricao').forEach(botao => {
            botao.addEventListener('click', async () => {
                const resposta = await fetch(
                    `../../src/controllers/VagaController.php?id=${idVagaAtual}`
                );
                const texto = await resposta.text();

                console.log("Status HTTP:", resposta.status);
                console.log("Resposta:", texto);
                console.log("ID enviado:", idVagaAtual);

                if (texto.trim() === "1") {
                    fecharPopUps();
                    location.reload();
                }
            });
        });

        function fecharPopUps() {
            if (detalhesVaga.classList.contains("ativo")) {
                detalhesVaga.classList.remove("ativo");
            }
            if (novaVaga.classList.contains("ativo")) {
                novaVaga.classList.remove("ativo");
            }

            document.querySelectorAll(".confirmacao").forEach(elemento => {
                elemento.classList.remove("ativo");
            });

            overlay.classList.remove("ativo");
            document.body.style.overflow = "auto";
        }

        function abrirMenuPerfil() {
            novaVaga.classList.remove("ativo");
            editPerfil.classList.add("ativo");
            overlay.classList.add("ativo");
            document.body.style.overflow = "hidden";
        }

        function abrirMenuVaga() {
            // editPerfil.classList.remove("ativo");
            novaVaga.classList.add("ativo");
            overlay.classList.add("ativo");
            document.body.style.overflow = "hidden";
        }

        if (picker) {

            picker.addEventListener("input", () => {
                localStorage.setItem("corEscolhida", picker.value);
            });

        }


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

        function popUpConfirmacao() {
            document.querySelector(".confirmacao").classList.add("ativo");
            overlay.classList.add("ativo");
        }
    </script>
</body>

</html>