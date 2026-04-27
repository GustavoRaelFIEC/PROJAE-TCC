<?php

require_once __DIR__ . "/../../src/middlewares/auth.php";

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="../assets/img/isotipo.png" type="image/x-icon">

    <link rel="stylesheet" href="../assets/css/globalEimports.css">
    <link rel="stylesheet" href="../assets/css/navegation.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/postarVaga.css">

    <title>Postar vaga não será um página</title>
</head>

<body class="corpo">
    <!-- Postar vaga não será um página -->
    <main class="principal2">
        <main class="principal">
            <h1 class="titulo">Postar <span>Vaga</span></h1>
            <div class="cadastro">
                <form method="POST" action="../../src/controllers/VagaController.php/?action=postarVaga" class="fomulario">
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
                        <select name="" id="">
                            <option value="">Selecione um tipo</option>
                            <option value="estagio">Estagiário</option>
                            <option value="aprendiz">Jovem Aprendiz</option>
                        </select>
                        <!-- <input class="input" id="tipo" name="tipo" type="text" required> -->
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
                        <select name="" id="">
                            <option value="">selecione status</option>
                            <option value="aberta">Aberta</option>
                            <option value="fechada">Fechada</option>
                        </select>
                        <!-- <input class="input" id="status" name="status" type="text" required> -->
                    </label>
                    <button class="btn-submit" type="submit">Cadastrar</button>
                </form>
            </div>
        </main>
    </main>
</body>

</html>