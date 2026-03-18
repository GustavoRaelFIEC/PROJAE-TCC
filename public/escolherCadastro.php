<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PROJAE</title>

    <link rel="shortcut icon" href="assets/img/isotipo.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/login.css">

</head>

<body class="corpo">
    <main class="principal">
        <img class="logo-img" src="assets/img/imagotipo-removebg.png" alt="LOGO PROJAE">
        <div class="container">
            <h1 class="titulo">Cadastrar</h1>
            <h3>Escolha o tipo de conta que você deseja abrir</h3>
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
    </main>
</body>

</html>