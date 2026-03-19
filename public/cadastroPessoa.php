<?php
session_start();

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../public/assets/css/cadastroPessoa.css">
    <link rel="shortcut icon" href="assets/img/isotipo.png" type="image/x-icon">

    <title>Cadastrar Estagiário</title>
</head>

<body class="corpo">

    <header class="cabecalho">

        <div class="logo">
            <img src="assets/img/imagotipo.png">
        </div>

        <ul class="list">
            <li><a class="item-list" href="index.php">Página Principal</a></li>
            <li><a class="item-list" href="about.php">Sobre</a></li>
            <li><a class="item-list" href="help.php">Ajuda</a></li>
        </ul>
    </header>
    <div class="principal2">
        <main class="principal">
            <h1 class="titulo">Registrar <span>Estagiário</span></h1>
            <div class="cadastro">
                <!-- <?php if (!empty($flash['errors'])): ?>
                    <div class="erro">
                        <ul>
                            <?php foreach ($flash['errors'] as $erro): ?>
                                <li><?= htmlspecialchars($erro); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?> -->
                <form class="formulario" method="POST" action="../src/controllers/CadastroController.php">
                    <legend class="subTitulo">Dados do Usuário</legend>
                    <input type="hidden" name="tipo" value="pessoa">
                    <label class="input-label">
                        Nome
                        <input class="input" type="text" name="nome" placeholder="Digite seu nome completo" required maxlength="100" minlength="2">
                    </label>
                    <label class="input-label" for="email">
                        E-mail
                        <input class="input" placeholder="Digite seu Email" id="email" name="email" type="email" required maxlength="255">
                    </label>
                    <label class="input-label" for="senha">
                        Senha
                        <input class="input" placeholder="Digite sua senha" id="senha" name="senha" type="password" required minlength="6">
                    </label>
                    <label class="input-label">
                        CPF
                        <input class="input" type="text" id="cpf" name="cpf" placeholder="___.___.___-__" required maxlength="14" minlength="14">
                    </label>
                    <label class="input-label">
                        Telefone
                        <input class="input" type="text" id="telefone" name="telefone" placeholder="(__) _____-____" maxlength="15" minlength="15">
                    </label>
                    <label class="input-label">
                        Instituição
                        <input
                            class="input"
                            type="text"
                            name="instituicao"
                            placeholder="Nome da faculdade ou escola">
                    </label>
                    <label class="input-label">
                        Curso
                        <input class="input" type="text" name="curso" placeholder="Ex: Ciência da Computação">
                    </label>
                    <button class="btn-submit" type="submit">Cadastrar</button>
                </form>
                <div class="fotoUpload">
                    <div class="fotoEmpresa">
                        <h1>Foto de Perfil</h1>
                        <img src="" alt="">
                    </div>
                    <p>Use uma imagem de boa qualidade, que mostre sua logotipo, ou que reflita sua Razão Social</p>
                    <input class="btn-upload" name="fotoEmpresa" type="file">
                </div>
            </div>
        </main>
    </div>
    <script src="./assets/js/mascara.js"></script>
</body>

</html>