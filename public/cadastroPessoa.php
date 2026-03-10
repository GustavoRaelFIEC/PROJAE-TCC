<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="../src/controllers/CadastroController.php">
                <label class="input-label" for="email">
                    E-mail
                    <input class="input" placeholder="Digite seu Email" id="email" name="email" type="email" required>
                </label>
                <label class="input-label" for="email">
                    Senha
                    <input class="input" placeholder="Digite seu Email" id="senha" name="senha" type="text" required>
                </label>
                <label class="input-label" for="email">
                    Nome
                    <input class="input" placeholder="Digite seu Email" id="email" name="nome" type="text" required>
                </label>
                <label class="input-label" for="email">
                    cpf
                    <input class="input" placeholder="Digite seu Email" id="email" name="cpf" type="text" required>
                </label>
                <label class="input-label" for="email">
                    Telefone
                    <input class="input" placeholder="Digite seu Email" id="email" name="telefone" type="text" required>
                </label>
                <label class="input-label" for="email">
                    instituicao
                    <input class="input" placeholder="Digite seu Email" id="email" name="instituicao" type="text" required>
                </label>
                <label class="input-label" for="email">
                    curso
                    <input class="input" placeholder="Digite seu Email" id="email" name="curso" type="text" required>
                </label>
              
                    <input class="input" value="pessoa" id="email" name="tipo" type="text" required hidden>

                    <button class="btn-submit" type="submit">Entrar</button>
               
    </form>
</body>
</html>