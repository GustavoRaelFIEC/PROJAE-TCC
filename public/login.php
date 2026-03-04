<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PROJAE</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <main class="principal">
        <img src="" alt="PROJAE" class="logo">
            <div class="container">
                <h1 class="titulo">Entrar</h1>
                <form method="post" class="form">
                    <label for="email">E-mail:</label>
                    <p><input class="" placeholder="Digite seu Email" id="email" type="email" required></p>
                    <!-- onde ficara a mensagem de erro da email -->
                    <label for="senha">Sua Senha:</label>
                    <p><input class="" placeholder="Digite sua senha" id="senha" type="password" required></p>
                    <!-- onde ficara a mensagem de erro da senha -->
                    <button class="" type="submit">Entrar</button>
                </form>
                <!-- caso possivel aqui seria o redefinir senha -->
                <p><a href="cadastro.php">Criar uma conta!</a></p>
            </div>
    </main>
</body>
</html>