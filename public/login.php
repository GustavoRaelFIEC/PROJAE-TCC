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
            <h1 class="titulo">Entrar</h1>
            <form method="POST" action="../src/controllers/LoginController.php" class="form">
                <label class="input-label" for="email">
                    E-mail
                    <input class="input" placeholder="Digite seu Email" id="email" name="email" type="email" required>
                </label>
                <!-- onde ficará a mensagem de erro da email (span) -->
                <label class="input-label" for="senha">
                    Senha
                    <input class="input" placeholder="Digite sua senha" id="senha" name="senha" type="password" required>
                </label>
                <!-- onde ficará a mensagem de erro da senha (span) -->

                <button class="btn-submit" type="submit">Entrar</button>
            </form>
            <!-- caso possivel aqui seria o redefinir senha -->
            <a href="cadastro.php" class="link">Criar uma conta!</a>
        </div>
    </main>
</body>
</html>