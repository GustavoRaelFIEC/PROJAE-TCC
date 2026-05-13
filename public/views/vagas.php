<?php

require_once __DIR__ . "/../../src/middlewares/auth.php";
require_once __DIR__ . "/../../src/controllers/VagaController.php";

verificarLogin();

// Corrigido: o modelo Vaga é carregado pelo VagaController, não deve ser instanciado direto aqui.
// handleFiltrarPorTipo() no VagaController retorna JSON e dá exit() — não pode ser usado para renderizar a página.
// Solução: carrega TODAS as vagas via handleBuscarVaga() e o filtro por tipo é feito no frontend via JS,
// igual ao filtro de busca por texto — sem recarregar a página.
$vagas = handleBuscarVaga($pdo);

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
    <link rel="stylesheet" href="../assets/css/vagas.css">

    <title>Vagas - PROJAE</title>
</head>

<body class="corpo">
    <div id="overlay" onclick="fecharPopUps()"></div>
    <header class="cabecalho">
        <div class="contentCabecalho">
            <div class="logo"><img class="img" src="../assets/img/imagotipo.png" alt="Projae logo"></div>
            <ul class="list">
                <li><a class="item-list active" href="" onclick="location.reload()">Início</a></li>
                <li><a class="item-list" href="vagas.php">Buscar Vagas</a></li>
            </ul>
            <div class="cta">
                <a href="./logout.php" class="btnSair">Sair</a>
            </div>
        </div>
    </header>

    <main class="principal">
        <search class="search">
            <!-- Corrigido: input agora tem id para o JS capturar -->
            <input class="inputSearch" id="inputBusca" type="text" placeholder="Buscar vaga...">
            <i class="fa-solid fa-search"></i>
        </search>

        <div class="content">
            <aside class="filtros">
                <h1 style="font-weight: bold;">Filtros da vaga</h1>

                <!-- Corrigido: era um <form> com GET que recarregava a página e chamava
                     handleFiltrarPorTipo() que retorna JSON e dá exit() — quebraria a página.
                     Agora é um <select> simples capturado pelo JS abaixo. -->
                <select id="filtroTipo" class="input">
                    <option class="opcaoTipo" value="">Todas</option>
                    <option class="opcaoTipo" value="Aprendiz">Jovem Aprendiz</option>
                    <option class="opcaoTipo" value="Estágio">Estagiário</option>
                </select>
            </aside>
            <div id="listagemVagas">
                <?php foreach ($vagas as $vaga): ?>
                    <?php if (
                        empty(trim($vaga['titulo']    ?? '')) ||
                        empty(trim($vaga['descricao'] ?? ''))
                    ) continue; ?>

                    <!-- Variáveis que permitem ao JS filtrar sem recarregar -->
                    <div class="card"
                        data-titulo="<?= htmlspecialchars(strtolower($vaga['titulo'] ?? '')) ?>"
                        data-descricao="<?= htmlspecialchars(strtolower($vaga['descricao'] ?? '')) ?>"
                        data-cidade="<?= htmlspecialchars(strtolower($vaga['cidade'] ?? '')) ?>"
                        data-tipo="<?= htmlspecialchars($vaga['tipo'] ?? '') ?>">

                        <!-- Corrigido: havia dois <form> e dois botões "Inscrever-se" aninhados.
                         Apenas um form com um botão submit é necessário. -->
                        <form method="POST" action="../../src/controllers/InscricaoController.php">
                            <input type="hidden" name="id_vaga" value="<?= (int) $vaga['id_vaga'] ?>">

                            <?php
                            // Formata a data de publicação usando o array $meses
                            $dataRaw = $vaga['data_publicacao'] ?? '';
                            if ($dataRaw) {
                                $ts  = strtotime($dataRaw);
                                $dia = date('d', $ts);
                                $mes = $meses[(int) date('m', $ts)] ?? '';
                                $ano = date('Y', $ts);
                                $dataFormatada = "$dia de $mes de $ano";
                            } else {
                                $dataFormatada = '';
                            }
                            ?>

                            <p class="dataPublicacao"><?= htmlspecialchars($dataFormatada) ?></p>
                            <!-- Corrigido: era $vaga['nome'] — o alias correto do JOIN em buscarVaga() é 'nome_empresa' -->
                            <p class="nome"><?= htmlspecialchars($vaga['nome_empresa'] ?? '') ?></p>
                            <h1 class="cardTitulo"><?= htmlspecialchars($vaga['titulo']      ?? '') ?></h1>
                            <p class="descricao"><?= htmlspecialchars($vaga['descricao']   ?? '') ?></p>
                            <div class="tags">
                                <span class="tipo"><?= htmlspecialchars($vaga['tipo']    ?? '') ?></span>
                                <span class="salario">R$ <?= htmlspecialchars($vaga['salario'] ?? '') ?></span>
                                <span class="cidade"><?= htmlspecialchars($vaga['cidade']  ?? '') ?></span>
                            </div>
                            <div class="cta">
                                <!-- Corrigido: abrirDetalhes() não estava implementada — removido o onclick por ora -->
                                <button class="btn detalhes" type="button" onclick="abrirDetalhesVaga()">Detalhes</button>
                                <button class="btn inscreverSe" type="submit">Inscrever-se</button>
                            </div>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
            <div id="detalhesVaga">
                <?php
                foreach ($vagas as $vaga):
                    $data = new DateTime($vaga['data_publicacao_formatada']);
                ?>
                    <div class="cardDetalhes">
                        <p class="paragrafoCard dataPublicacao"><i class="fa-regular fa-clock"></i>Data de Publicação: <?= $data->format('d') . ' ' . $meses[$data->format('n')] . ' ' . $data->format('Y') ?></p>
                        <h1 class="cardTitulo"><?= $vaga['titulo'] ?></h1>
                        <div class="tags">
                            <span class="tipo"><?= $vaga['tipo'] ?></span>
                            <span class="salario">R$ <?= $vaga['salario'] ?></span>
                            <span class="cidade"><?= $vaga['cidade'] ?></span>
                        </div>
                        <div class="cta">
                            <button class="btn detalhes" type="button" onclick="fecharPopUps()">Sair</button>
                            <button id="desinscrever" class="btn cancelarInscricao" type="submit">Cancelar Inscrição</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>

    <script>
        const inputBusca = document.getElementById("inputBusca");
        const filtroTipo = document.getElementById("filtroTipo");
        const cards = document.querySelectorAll("#listagemVagas .card");
        const editPerfil = document.getElementById("editPerfil");
        const detalhesVaga = document.getElementById("detalhesVaga");
        const overlay = document.getElementById("overlay");

        // Oculta campos vazios nos cards
        document.querySelectorAll(
            "#listagemVagas .card p, #listagemVagas .card h1, #listagemVagas .card span"
        ).forEach(campo => {
            if (campo.textContent.trim() === "") {
                campo.style.display = "none";
            }
        });

        // Filtra cards por texto digitado e tipo selecionado
        function filtrarCards() {
            const termoBusca = inputBusca.value.toLowerCase().trim();
            const tipoSelecionado = filtroTipo.value;

            cards.forEach(card => {
                const tituloCard = card.dataset.titulo || "";
                const descricaoCard = card.dataset.descricao || "";
                const cidadeCard = card.dataset.cidade || "";
                const tipoCard = card.dataset.tipo || "";

                const combinaBusca = termoBusca === "" || tituloCard.includes(termoBusca) || descricaoCard.includes(termoBusca) || cidadeCard.includes(termoBusca);
                const combinaTipo = tipoSelecionado === "" || tipoCard === tipoSelecionado;

                card.style.display = (combinaBusca && combinaTipo) ? "" : "none";
            });
        }

        // Debounce: aguarda 300ms após parar de digitar para filtrar
        let debounce;
        inputBusca.addEventListener("input", () => {
            clearTimeout(debounce);
            debounce = setTimeout(filtrarCards, 300);
        });

        // Filtro por tipo aplica imediatamente
        filtroTipo.addEventListener("change", filtrarCards);

        // MODAIS

        function abrirDetalhesVaga() {
            detalhesVaga.classList.add("ativo");
            overlay.classList.add("ativo");
            document.body.style.overflow = "hidden";
        }

        function fecharPopUps() {
            if (detalhesVaga.classList.contains("ativo")) {
                detalhesVaga.classList.remove("ativo");
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