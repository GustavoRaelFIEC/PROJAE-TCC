<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../public/assets/css/cadastroPessoa.css">

    <title>Cadastrar Estagiário</title>
</head>

<body class="corpo">

    <header class="cabecalho">

        <div class="logo">
            <img src="assets/img/imagotipo.png">
        </div>

        <ul class="list">
            <li><a class="item-list" href="index.php">Página Principal</a></li>
            <li><a class="item-list" href="about.php">Sobre</a></li>
            <li><a class="item-list" href="help.php">Ajuda</a></li>
        </ul>

    </header>

    <main class="principal">

        <h1 class="titulo">Cadastrar <span>Estagiários</span></h1>

        <div class="cadastro">

            <form class="formulario" method="POST" action="processaCadastro.php">

                <legend class="subTitulo">Dados do Usuário</legend>

                <label class="input-label">
                    Nome
                    <input
                        class="input"
                        type="text"
                        name="nome"
                        placeholder="Digite seu nome completo"
                        required>
                </label>

                <label class="input-label" for="email">
                    E-mail
                    <input class="input" placeholder="Digite seu Email" id="email" name="email" type="email" required>
                </label>
                
                <label class="input-label" for="senha">
                    Sua Senha
                    <input class="input" placeholder="Digite sua senha" id="senha" name="senha" type="password" required>
                </label>

                <label class="input-label">
                    CPF
                    <input
                        class="input"
                        type="text"
                        name="cpf"
                        placeholder="___.___.___-__"
                        required>
                </label>

                <label class="input-label">
                    Telefone
                    <input
                        class="input"
                        type="text"
                        name="telefone"
                        placeholder="(__) _____-____">
                </label>

                <label class="input-label">
                    Instituição
                    <input
                        class="input"
                        type="text"
                        name="instituicao"
                        placeholder="Nome da faculdade ou escola">
                </label>

                <label class="input-label">
                    Curso
                    <input
                        class="input"
                        type="text"
                        name="curso"
                        placeholder="Ex: Ciência da Computação">
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

</body>

</html>