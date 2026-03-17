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
                <form method="POST" action="../src/controllers/CadastroController.php" class="fomulario">
                    <legend class="subTitulo">Dados do Usuário</legend>
                    <label class="input-label" for="razaoSocial">
                        titulo
                        <input class="input" id="razaoSocial" name="titulo" type="text" required>
                    </label>
                    <label class="input-label" for="email">
                        descricao
                        <input class="input" id="email" name="descricao" type="email" required>
                    </label>
                    <label class="input-label" for="senha">
                        tipo
                        <input class="input" id="senha" name="tipo" type="password" required>
                    </label>
                    <label class="input-label" for="cnpj">
                        salario
                        <input class="input" id="cnpj" name="salario" type="text" required>
                    </label>
                    <label class="input-label" for="telefone">
                        cidade
                        <input class="input" id="telefone" name="cidade" type="text" required>
                    </label>
                    <label class="input-label" for="uf">
                        status
                        <input class="input" id="uf" name="status" type="text" required>
                    </label>
                    <button class="btn-submit" type="submit">Cadastrar</button>
                </form>
                <div class="fotoUpload">
                    <div class="fotoEmpresa">
                        <h1>Foto de Perfil</h1>
                        <img src="" alt="">
                    </div>
                    <p>Use uma imagem de boa qualidade, que mostre sua logotipo, ou que reflita sua Razão Social</p>
                    <input class="btn-upload" name="fotoEmpresa" type="file">
                </div>
            </div>
        </main>
    </main>
</body>
</html>