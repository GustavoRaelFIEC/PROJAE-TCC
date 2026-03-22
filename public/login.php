<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="shortcut icon" href="assets/img/isotipo.png" type="image/x-icon">
    
    <link rel="stylesheet" href="assets/css/globalEimports.css">
    <link rel="stylesheet" href="assets/css/navegation.css">
    <link rel="stylesheet" href="assets/css/login.css">
    
    <title>Login - PROJAE</title>

</head>
<body class="corpo">
    <header class="cabecalho">
        <div class="logo"><img class="img" src="assets/img/imagotipo.png" alt="Projae logo"></div>
        <ul class="list">
            <li><a class="item-list active" href="index.php">Página Principal</a></li>
            <li><a class="item-list" href="about.php">Sobre</a></li>
            <li><a class="item-list" href="help.php">Ajuda</a></li>
        </ul>
        <div class="cta">
            <a href="#" class="btnLogin">Entrar</a>
            <a href="#" class="btnCadastro">Cadastrar</a>
        </div>
    </header>
    <main class="principal">
        <img class="logo-img" src="assets/img/imagotipo-removebg.png" alt="LOGO PROJAE">
        <div class="content">
            <h1 class="titulo">Entrar</h1>
            <form method="POST" action="../src/controllers/LoginController.php" class="form">
                <label class="input-label" for="email">
                    E-mail
                    <input class="input" placeholder="Digite seu Email" id="email" name="email" type="email" required>
                </label>
                <label class="input-label" for="senha">
                    Senha
                    <input class="input" placeholder="Digite sua senha" id="senha" name="senha" type="password" required>
                </label>

                <button class="btn-submit" type="submit">Entrar</button>
            </form>
            <!-- caso possivel aqui seria o redefinir senha -->
            <a href="cadastro.php" class="link">Criar uma conta!</a>
        </div>
    </main>
</body>
</html>