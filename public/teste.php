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
            <h1 class="titulo">Postar <span>Vaga</span></h1>
            <div class="cadastro">
                <form method="POST" action="../src/controllers/VagaController.php" class="fomulario">
                    <legend class="subTitulo">Dados do Usuário</legend>
                    <label class="input-label" for="titulo">
                        titulo
                        <input class="input" id="titulo" name="titulo" type="text" required>
                    </label>
                    <label class="input-label" for="descricao">
                        descricao
                        <input class="input" id="descricao" name="descricao" type="text" required>
                    </label>
                    <label class="input-label" for="tipo">
                        tipo
                        <input class="input" id="tipo" name="tipo" type="text" required>
                    </label>
                    <label class="input-label" for="salario">
                        salario
                        <input class="input" id="salario" name="salario" type="text" required>
                    </label>
                    <label class="input-label" for="cidade">
                        cidade
                        <input class="input" id="cidade" name="cidade" type="text" required>
                    </label>
                    <label class="input-label" for="status">
                        status
                        <input class="input" id="status" name="status" type="text" required>
                    </label>
                    <button class="btn-submit" type="submit">Cadastrar</button>
                </form>
            </div>
        </main>
    </main>
</body>
</html>