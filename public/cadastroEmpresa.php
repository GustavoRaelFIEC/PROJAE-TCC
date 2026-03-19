<?php
session_start();

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);


/*
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
} */

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/assets/css/cadastroEmpresa.css">
    <link rel="shortcut icon" href="assets/img/isotipo.png" type="image/x-icon">
    <title>Cadastrar Empresa</title>
</head>

<body class="corpo">
    <header class="cabecalho">
        <div class="logo"><img class="img" src="assets/img/imagotipo.png" alt=""></div>
        <ul class="list">
            <li><a class="item-list" href="index.php">Página Principal</a></li>
            <li><a class="item-list" href="about.php">Sobre</a></li>
            <li><a class="item-list" href="help.php">Ajuda</a></li>
        </ul>
    </header>
    <main class="principal2">
        <main class="principal">
            <h1 class="titulo">Registrar <span>Empresa</span></h1>
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
                <form method="POST" action="../src/controllers/CadastroController.php" class="fomulario">
                    <legend class="subTitulo">Dados do Usuário</legend>
                    <input type="hidden" name="tipo" value="empresa">
                    <label class="input-label" for="razaoSocial">
                        Razão Social
                        <input class="input" placeholder="Insira a Razão Social Registrada" id="razaoSocial" name="nome" type="text" required maxlength="100">
                    </label>
                    <label class="input-label" for="email">
                        E-mail
                        <input class="input" placeholder="Digite seu Email" id="email" name="email" type="email" required maxlength="255">
                    </label>

                    <label class="input-label" for="senha">
                        Senha
                        <input class="input" placeholder="Digite sua senha" id="senha" name="senha" type="password" required minlength="6">
                    </label>
                    <label class="input-label" for="cnpj">
                        CNPJ
                        <input class="input" placeholder="__.___.___/____-__" id="cnpj" name="cnpj" maxlength="18" minlength="18" type="text" required>
                    </label>
                    <label class="input-label" for="telefone">
                        Telefone
                        <input class="input" placeholder="(__) _____-____" id="telefone" name="telefone" maxlength="15" minlength="15" type="text" required>
                    </label>
                    <label class="input-label" for="cidade">
                        Cidade
                        <input class="input" placeholder="Ex: São Paulo - SP" id="cidade" name="cidade" type="text" required>
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
    </main>
    <script src="./assets/js/mascara.js"></script>
</body>

</html>