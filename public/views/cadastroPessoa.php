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

    <link rel="shortcut icon" href="../assets/img/isotipo.png" type="image/x-icon">

    <link rel="stylesheet" href="../assets/css/globalEimports.css">
    <link rel="stylesheet" href="../assets/css/navegation.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/cadastroPessoa.css">

    <title>Cadastro Pessoa - PROJAE</title>
</head>

<body class="corpo">

    <header class="cabecalho">
        <div class="contentCabecalho">
            <div class="logo"><a href="../index.php"><img class="img" src="../assets/img/imagotipo.png" alt="Projae logo"></a></div>
            <ul class="list">
                <li><a class="item-list" href="../index.php">Página Principal</a></li>
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
            <h1 class="titulo">Registrar <span>Usuário</span></h1>
            <div class="cadastro">
                <form class="formulario" method="POST" action="../../src/controllers/CadastroController.php">
                    <legend class="subTitulo">Dados do Usuário</legend>
                    <input type="hidden" name="tipo" value="pessoa">

                    <label class="input-label">
                        <p>Nome<span>*</span></p>
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
                        <p>E-mail<span>*</span></p>
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
                        <p>Senha<span>*</span></p>
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
                        <p>CPF<span>*</span></p>
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
                        <p>Telefone<span>*</span></p>
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
                        <p>Instituição</p>
                        <input
                            class="input"
                            type="text"
                            name="instituicao"
                            placeholder="Nome da faculdade ou escola">
                    </label>
                    <label class="input-label">
                        <p>Curso</p>
                        <input class="input" type="text" name="curso" placeholder="Ex: Ciência da Computação">
                    </label>
                    <button class="btn-submit" type="submit">Cadastrar</button>
                </form>
            </div>
        </div>
    </main>
    <script src="../assets/js/mascara.js"></script>
    <script src="../assets/js/timeMessage.js"></script>
</body>

</html>