<?php
session_start();

$flash = $_SESSION['flash'] ?? null;
$errors = $flash['messages'] ?? [];
$old = $flash['old'] ?? [];


unset($_SESSION['flash']);

function old($key)
{
    global $old;
    return htmlspecialchars($old[$key] ?? '');
}

function error($key)
{
    global $errors;
    if (isset($errors[$key])) {
        return '<p class="erro-input">' . htmlspecialchars($errors[$key]) . '</p>';
    }
    return '';
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="assets/img/isotipo.png" type="image/x-icon">

    <link rel="stylesheet" href="../assets/css/globalEimports.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/navegation.css">
    <link rel="stylesheet" href="../assets/css/cadastroPessoa.css">

    <title>Cadastro Pessoa - PROJAE</title>
</head>

<body class="corpo">

    <header class="cabecalho">
        <div class="contentCabecalho">
            <div class="logo"><img class="img" src="../assets/img/imagotipo.png" alt="Projae logo"></div>
            <ul class="list">
                <li><a class="item-list active" href="../index.php">Página Principal</a></li>
                <li><a class="item-list" href="about.php">Sobre Nós</a></li>
                <li><a class="item-list" href="help.php">Ajuda</a></li>
            </ul>
            <div class="cta">
                <a href="login.php" class="btnLogin">Entrar</a>
                <a href="escolherCadastro.php" class="btnCadastro">Cadastrar</a>
            </div>
        </div>
    </header>
    
    <main class="principal">
        <div class="content">
            <h1 class="titulo">Registrar <span>Estagiário</span></h1>
            <div class="cadastro">
                <form class="formulario" method="POST" action="../../src/controllers/CadastroController.php">
                    <legend class="subTitulo">Dados do Usuário</legend>
                    <input type="hidden" name="tipo" value="pessoa">

                    <label class="input-label">
                        Nome
                        <input class="input"
                            type="text"
                            name="nome"
                            placeholder="Digite seu nome completo"
                            value="<?= old('nome') ?>"
                            required
                            maxlength="100"
                            minlength="2">

                        <?= error('nome') ?>
                    </label>

                    <label class="input-label" for="email">
                        E-mail
                        <input class="input"
                            placeholder="Digite seu Email"
                            id="email"
                            name="email"
                            type="email"
                            value="<?= old('email') ?>"
                            required 
                            maxlength="255">

                        <?= error('email') ?>
                    </label>

                    <label class="input-label" for="senha">
                        Senha
                        <input class="input"
                            placeholder="Digite sua senha"
                            id="senha"
                            name="senha"
                            type="password"
                            required 
                            minlength="8">

                        <?= error('senha') ?>
                    </label>
                    <label class="input-label">
                        CPF
                        <input class="input"
                            type="text"
                            id="cpf"
                            name="cpf"
                            placeholder="___.___.___-__"
                            value="<?= old('cpf') ?>"
                            required
                            maxlength="14"
                            minlength="14">

                        <?= error('cpf') ?>
                    </label>
                    <label class="input-label">
                        Telefone
                        <input class="input"
                            type="text"
                            id="telefone"
                            name="telefone"
                            placeholder="(__) _____-____"
                            value="<?= old('telefone') ?>"
                            required
                            maxlength="15"
                            minlength="15">

                        <?= error('telefone') ?>
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
        </div>
    </main>
    <script src="../assets/js/mascara.js"></script>
    <script src="../assets/js/timeMessage.js"></script>
</body>

</html>