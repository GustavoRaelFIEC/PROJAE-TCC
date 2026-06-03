<?php

require_once __DIR__ . "/../../src/middlewares/auth.php";
require_once __DIR__ . "/../../src/controllers/InscricaoController.php";
require_once __DIR__ . "/../../src/controllers/DadosController.php";

verificarTipo('pessoa');
$inscricoes = visualizarInscricoesPessoa($pdo);
$dados = handleDadosPessoa($pdo);

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
            <div id="editPerfil">
                <h1 class="tituloForm">Editar Perfil</h1>
                <form class="formulario">
                    <input type="hidden" name="tipo" value="pessoa">

                    <label class="input-label" for="nome">
                        <p>Nome</p>
                        <input class="input"
                            placeholder="Digite o seu nome"
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
                            placeholder="Digite o nome do seu curso"
                            id="curso"
                            name="curso"
                            type="text"
                            maxlength="255">

                    </label>

                    <label class="input-label" for="telefone">
                        <p>Telefone Celular</p>
                        <input class="input"
                            placeholder="Digite o seu telefone celular"
                            id="telefone"
                            name="telefone"
                            type="tel"
                            maxlength="255">
                    </label>

                    <button class="btn-submit" type="submit">Salvar</button>
                    <button class="btn-cancelar" type="submit">Cancelar</button>
                </form>
            </div>
            <section class="perfil">
                <div class="detalhesPerfil">
                    <div class="fotoPerfil"><img src="../assets/img/fotoPerfilPadrao.jpg" alt="Sua Foto de Perfil"></div>
                    <div>
                        <h1 class="nomePerfil"><?= $dados['nome'] ?></h1>
                        <h2 class="cursoPerfil"><?= $dados['curso'] ?></h2>
                        <h2 class="instituicaoPerfil"><?= $dados['instituicao'] ?></h2>
                        <h2 id="telefonePessoa" class="telefonePerfil">
                            <i class="fa-solid fa-phone"></i>
                            <span><?= $dados['telefone'] ?></span>
                        </h2>

                        <h2 id="cpfPessoa" class="cpf">
                            <i class="fa-regular fa-id-badge"></i>
                            <span><?= $dados['cpf'] ?></span>
                        </h2>
                    </div>
                </div>
                <button onclick="abrirEditarPerfil()" class="btnEditar"><i class="fa-solid fa-pen-to-square"></i></button>
            </section>
            <section class="vagasInscritas">
                <h1 class="titulo">Vagas Inscritas</h1>
                <div id="listagemVagas">
                    <?php
                    foreach ($inscricoes as $inscricao):
                        $data = new DateTime($inscricao['data_publicacao_formatada']);
                        $dataInscricao = new DateTime($inscricao['data_inscricao']);
                    ?>
                        <div class="card">
                            <p class="paragrafoCard dataPublicacao"><i class="fa-regular fa-clock"></i>Data de Publicação: <?= $data->format('d') . ' ' . $meses[$data->format('n')] . ' ' . $data->format('Y') ?></p>
                            <h1 class="nomeEmpresa"><?= $inscricao['nomeEmpresa'] ?></h1>
                            <h2 class="cardTitulo"><?= $inscricao['titulo'] ?></h2>
                            <div class="tags">
                                <span class="tipo"><?= $inscricao['tipo'] ?></span>
                                <span class="salario">R$ <?= $inscricao['salario'] ?></span>
                                <span class="cidade"><?= $inscricao['cidade'] ?></span>
                            </div>
                            <p class="paragrafoCard dataInscricao"><i class="fa-regular fa-clock"></i>Data de Inscrição: <?= $dataInscricao->format('d') . ' ' . $meses[$dataInscricao->format('n')] . ' ' . $dataInscricao->format('Y') ?></p>
                            <div class="cta">
                                <button class="btn btnAbrirDetalhes" type="button" data-id="<?= $inscricao['id_vaga'] ?>">Detalhes</button>
                                <button class="btn confirmacao" type="button cancelarInscricao" onclick="popUpConfirmacao()">Cancelar Inscrição</button>
                            </div>
                        </div>

                        <div id="confirmacao">
                            <h1>DESEJA REALMENTE CANCELAR SUA INSCRIÇÃO NESTA VAGA?</h1>
                            <div class="cta">
                                <button onclick="fecharPopUps()">NÃO</button>
                                <button class="cancelarInscricao" data-id="<?= $inscricao['id_inscricao'] ?>">SIM</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

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
                        <p class="paragrafoCard dataPublicacao" id="data_inscricao_formatada"></p>
                        <div class="cta">
                            <button class="btn btnSairDetalhes" type="button" onclick="fecharPopUps()">Sair</button>
                        </div>
                    </div>
                </div>



            </section>
        </div>
    </main>
    <!-- Criar um arquivo javaScript -->

    <script src="../assets/js/mascara.js"></script>

    <script>
        const telefonePessoa = document.querySelector("#telefonePessoa span");
        const cpfPessoa = document.querySelector("#cpfPessoa span");

        if (telefonePessoa) {
            telefonePessoa.textContent =
                mascaraTelefone(telefonePessoa.textContent.trim());
        }

        if (cpfPessoa) {
            cpfPessoa.textContent =
                mascaraCPF(cpfPessoa.textContent.trim());
        }

        const editPerfil = document.getElementById("editPerfil");
        const detalhesVaga = document.getElementById("detalhesVaga");
        const confirmacao = document.getElementById("confirmacao");
        const overlay = document.getElementById("overlay");

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

        function abrirEditarPerfil() {
            editPerfil.classList.add("ativo");
            overlay.classList.add("ativo");
            document.body.style.overflow = "hidden";
        }

        document.querySelectorAll('.btnAbrirDetalhes').forEach(botao => {

            botao.addEventListener('click', async () => {

                const id = botao.dataset.id;

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

                console.log("clicado!")

                const id = botao.dataset.id;

                console.log("ID:", id);

                const resposta = await fetch(`../../src/controllers/InscricaoController.php?id=${id}`);

                const texto = await resposta.text();

                console.log("Status:", resposta.status);
                console.log("Resposta:", texto);

                if (texto.trim() === "1") {
                    location.reload();
                }

            });

        });

        function popUpConfirmacao() {
            confirmacao.classList.add("ativo");
            overlay.classList.add("ativo");
        }

        function fecharPopUps() {

            if (editPerfil.classList.contains("ativo")) {
                editPerfil.classList.remove("ativo");
            }

            if (detalhesVaga.classList.contains("ativo")) {
                detalhesVaga.classList.remove("ativo");
            }

            if (confirmacao.classList.contains("ativo")) {
                confirmacao.classList.remove("ativo");
            }

            overlay.classList.remove("ativo");
            document.body.style.overflow = "auto";
        }

        document.querySelectorAll(
            "#listagemVagas .card p, #listagemVagas .card h1, #listagemVagas .card span"
        ).forEach(campo => {

            if (campo.textContent.trim() === "") {
                campo.style.display = "none";
            }

        });
    </script>
</body>

</html>