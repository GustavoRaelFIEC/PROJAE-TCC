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

<!-- /*
// Uploads de Fotos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["fotoEmpresa"]) && $_FILES["FotoEmpresa"]["error"] == 0) {
        $pasta = "../public/assets/uploads/";
        if (!is_dir($pasta)) {
            mkdir($pasta, 0777, true);
        }
        $extensao = pathinfo($_FILES["fotoEmpresa"]["name"],PATHINFO_EXTENSION);
        $nomeArquivo = uniqid() . "." . $extensao;
        $caminho = $pasta . $nomeArquivo;

        move_uploaded_file($_FILES['foto']['tmp_name'], $caminho);

        $stmt = $pdo->prepare("UPDATE cliente SET foto = ? WHERE id = ?");
        $stmt->execute([$caminho, $userID]);

        $usuario['foto'] = $caminho;
    }
} */ -->



<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="assets/img/isotipo.png" type="image/x-icon">

    <link rel="stylesheet" href="assets/css/cadastroEmpresa.css">
    <link rel="stylesheet" href="assets/css/globalEimports.css">
    <link rel="stylesheet" href="assets/css/navegation.css">

    <title>Cadastro Empresa - PROJAE</title>
</head>

<body class="corpo">

    <header class="cabecalho">
        <div class="logo"><img class="img" src="assets/img/imagotipo.png" alt="Projae logo"></div>
        <ul class="list">
            <li><a class="item-list" href="index.php">Página Principal</a></li>
            <li><a class="item-list" href="about.php">Sobre</a></li>
            <li><a class="item-list" href="help.php">Ajuda</a></li>
        </ul>
    </header>

    <main class="principal">
        <div>
            <h1 class="titulo">Registrar <span>Empresa</span></h1>
            <div class="cadastro">
                <form method="POST" action="../src/controllers/CadastroController.php" class="fomulario">
                    <legend class="subTitulo">Dados do Usuário</legend>
                    <input type="hidden" name="tipo" value="empresa">

                    <!-- <label class="input-label" for="razaoSocial">
                        Razão Social
                        <input class="input" placeholder="Insira a Razão Social Registrada" id="razaoSocial" name="nome" type="text" required maxlength="100">
                    </label> -->

                    <label class="input-label" for="email">
                        E-mail
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
                        Senha
                        <input class="input"
                            placeholder="Digite sua senha"
                            id="senha"
                            name="senha"
                            type="password"
                            required minlength="6">

                        <?= error('senha') ?>
                    </label>

                    <label class="input-label" for="cnpj">
                        CNPJ
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
                        Telefone
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
                        Cidade
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
    <script src="./assets/js/mascara.js"></script>
    <script src="/assets/js/timeMessage.js"></script>
</body>

</html>