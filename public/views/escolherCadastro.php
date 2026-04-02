<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="../assets/img/isotipo.png" type="image/x-icon">

    <link rel="stylesheet" href="../assets/css/globalEimports.css">
    <link rel="stylesheet" href="../assets/css/navegation.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/escolherCadastro.css">

    <title>Cadastro - PROJAE</title>

</head>

<body class="corpo">
    <header class="cabecalho">
        <div class="contentCabecalho">
            <div class="logo"><img class="img" src="../assets/img/imagotipo.png" alt="Projae logo"></div>
            <ul class="list">
                <li><a class="item-list" href="../index.php">Página Principal</a></li>
                <li><a class="item-list" href="about.php">Sobre Nós</a></li>
                <li><a class="item-list" href="help.php">Ajuda</a></li>
            </ul>
            <div class="cta">
                <a href="login.php" class="btnLogin">Entrar</a>
                <a href="escolherCadastro.php" class="btnCadastro activeBtn">Cadastrar</a>
            </div>
        </div>
    </header>
    <main class="principal">
        <div class="content">
            <img class="img" src="../assets/img/imagotipo-removebg.png" alt="Projae logo">
            <div class="container">
                <h1 class="titulo">Cadastrar</h1>
                <h2 class="descricao">Escolha o tipo de conta que você deseja abrir</h2>
                <div class="tipoConta">
                    <a href="cadastroPessoa.php">
                        <button class="btn-pessoa" id="pessoa" name="tipoConta" value="pessoa">Pessoa</button>
                    </a>
                    <p class="pessoa-sub">Pessoas usam a plataforma para buscar e se candidatar a vagas</p>
                    <a href="cadastroEmpresa.php">
                        <button class="btn-empresa" id="empresa" name="tipoConta" value="empresa">Empresa</button>
                    </a>
                    <p class="empresa-sub">Empresas usam a plataforma para cadastrar e gerenciar vagas</p>
                </div>
            </div>
        </div>
    </main>
</body>

</html>