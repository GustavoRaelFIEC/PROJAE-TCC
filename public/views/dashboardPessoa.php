<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="shortcut icon" href="../assets/img/isotipo.png" type="image/x-icon">

    <link rel="stylesheet" href="../assets/css/globalEimports.css">
    <link rel="stylesheet" href="../assets/css/navegation.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/dashboardPessoa.css">

    <title>Dashboard - PROJAE</title>
</head>

<body class="corpo">
    <header class="cabecalho">
        <div class="contentCabecalho">
            <div class="logo"><img class="img" src="../assets/img/imagotipo.png" alt="Projae logo"></div>

            <div class="cta">
                <a href="./logout.php" class="btnSair">Sair</a>
            </div>
        </div>
    </header>

    <main class="principal">
        <div class="content">
            <section class="perfil">
                <div class="detalhesPerfil">
                    <div class="fotoPerfil"><img src="" alt="Sua Foto de Perfil"></div>
                    <div>
                        <h1 class="nomePerfil">Nome</h1>
                        <h2 class="instituicaoPerfil">Instituição</h2>
                        <h2 class="regiaoPerfil">Região</h2>
                    </div>
                </div>
                <button class="btnEditar"><i class="fa-solid fa-pen-to-square"></i></button>
            </section>
            <section class="vagasInscritas">
                <h1 class="titulo">Vagas Inscritas</h1>
                <div class="cards">
                    <div class="card">
                    </div>
                </div>
            </section>
        </div>
        <a href="testeBuscarVaga.php">testeBuscarVaga</a>
    </main>
    
</body>

</html>