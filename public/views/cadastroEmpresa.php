<?php
require_once __DIR__ . '/../../src/utils/Session.php';

Session::start();

$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];

unset($_SESSION['errors'], $_SESSION['old']);

function old($key)
{
    global $old;
    return htmlspecialchars($old[$key] ?? '');
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

                        <?php if (isset($errors['email'])): ?>
                            <span class="erro"><?= $errors['email'] ?></span>
                        <?php endif; ?>
                        <?php if (isset($errors['usuario'])): ?>
                            <span class="erro"><?= $errors['usuario'] ?></span>
                        <?php endif; ?>
                    </label>

                    <label class="input-label" for="senha">
                        <p>Senha<span>*</span></p>
                        <input class="input"
                            placeholder="Digite sua senha"
                            id="senha"
                            name="senha"
                            type="password"
                            required minlength="8">

                        <?php if (isset($errors['senha'])): ?>
                            <span class="erro"><?= $errors['senha'] ?></span>
                        <?php endif; ?>
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

                        <?php if (isset($errors['cnpj'])): ?>
                            <span class="erro"><?= $errors['cnpj'] ?></span>
                        <?php endif; ?>
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

                        <?php if (isset($errors['telefone'])): ?>
                            <span class="erro"><?= $errors['telefone'] ?></span>
                        <?php endif; ?>
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