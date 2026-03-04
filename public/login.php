<?php

require_once './src/config/database.php';

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema Seguro</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>Cadastro de Usuários</h1>

                <form method="POST" action="../src/controllers/AuthController.php?action=login" class="form">
                    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; //verificar se o token muda ao recarregar a página, para isso, troque o type pra text e recarregue o navegador?>">

                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="email" name="email" id="email" required value="<?php echo $_POST['email'] ?? ''; ?>" placeholder="seu@email.com">
                    </div>

                    <div class="form-group">
                        <label for="senha">Senha:</label>
                        <input type="password" name="senha" id="senha" required minlength="8" autocomplete="new-password" placeholder="Digite sua senha (Min. 8 caracteres">
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Cadastrar</button>
                </form>
                <div class="links">
                    <a href="index.php">Voltar para Home</a>
                    <a href="cadastro.php">Voltar para Cadastro</a>
                </div>
        </div>
    </div>
</body>
</html>