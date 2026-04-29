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
        return '<span class="erro-input">' . htmlspecialchars($errors[$key]) . '</span>';
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
    <link rel="stylesheet" href="../assets/css/cadastroEmpresa.css">

    <title>Cadastro Empresa - PROJAE</title>
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
            <h1 class="titulo">Registrar <span>Empresa</span></h1>
            <div class="cadastro">
                <form method="POST" action="../../src/controllers/CadastroController.php" class="formulario">
                    <legend class="subTitulo">Dados da Empresa</legend>
                    <input type="hidden" name="tipo" value="empresa">

                    <label class="input-label" for="razaoSocial">
                        <p>Razão Social<span>*</span></p>
                        <input class="input"
                            placeholder="Insira a Razão Social Registrada"
                            id="razaoSocial"
                            name="nome"
                            value="<?= old('nome') ?>"
                            type="text"
                            required
                            maxlength="100">

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
                            required>

                        <?= error('email') ?>
                    </label>

                    <label class="input-label" for="senha">
                        <p>Senha<span>*</span></p>
                        <input class="input"
                            placeholder="Digite sua senha"
                            id="senha"
                            name="senha"
                            type="password"
                            required minlength="8">

                        <?= error('senha') ?>
                    </label>

                    <label class="input-label" for="cnpj">
                        <p>CNPJ<span>*</span></p>
                        <input class="input"
                            placeholder="__.___.___/____-__"
                            id="cnpj"
                            name="cnpj"
                            maxlength="18"
                            minlength="18"
                            type="text"
                            value="<?= old('cnpj') ?>"
                            required>

                        <?= error('cnpj') ?>
                    </label>

                    <label class="input-label" for="telefone">
                        <p>Telefone<span>*</span></p>
                        <input class="input"
                            placeholder="(__) _____-____"
                            id="telefone" name="telefone"
                            maxlength="15"
                            minlength="15"
                            type="text"
                            value="<?= old('telefone') ?>"
                            required>

                        <?= error('telefone') ?>
                    </label>

                    <label class="input-label" for="cidade">
                        <p>Cidade<span>*</span></p>
                        <input class="input"
                            placeholder="Ex: São Paulo - SP"
                            id="cidade"
                            name="cidade"
                            type="text"
                            value="<?= old('cidade') ?>"
                            required>

                        <?= error('cidade') ?>
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