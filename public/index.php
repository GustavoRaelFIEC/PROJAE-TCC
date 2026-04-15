<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="assets/img/isotipo.png" type="image/x-icon">

    <link rel="stylesheet" href="assets/css/globalEimports.css">
    <link rel="stylesheet" href="assets/css/navegation.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/index.css">

    <title> Ínicio - PROJAE</title>
</head>

<body>
    <header class="cabecalho">
        <div class="contentCabecalho">
            <div class="logo"><img class="img" src="assets/img/imagotipo.png" alt="Projae logo"></div>
            <ul class="list">
                <li><a class="item-list active" href="" onclick="location.reload()">Página Principal</a></li>
                <li><a class="item-list" href="views/about.php">Sobre Nós</a></li>
                <li><a class="item-list" href="views/help.php">Ajuda</a></li>
            </ul>
            <div class="cta">
                <a href="views/login.php" class="btnLogin">Entrar</a>
                <a href="views/escolherCadastro.php" class="btnCadastro">Cadastrar</a>
            </div>
        </div>
    </header>
    <main class="principal">
        <div class="content">
            <div class="sideLeft">
                <p class="welcome">Bem-Vindo ao <span class="azul">PRO</span><span class="vermelho">JAE</span>, <br> sua Plataforma de Estágio</p>
                <p class="paragrafo">Se <a href="views/escolherCadastro.php">Cadastre</a> ou <a href="views/login.php">Entre</a> caso já tenha uma conta.</p>
            </div>
            <div class="sideRight">
                <img draggable="false" src="assets/img/background2-index.png" alt="">
            </div>
        </div>
    </main>
</body>

</html>