<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../assets/css/globalEimports.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/navegation.css">
    <link rel="stylesheet" href="../assets/css/dashboardEmpresa.css">
    <link rel="stylesheet" href="../assets/css/cadastroEmpresa.css">

    <title>Dashboard Empresa</title>
</head>

<body>
    <header class="cabecalho">
        <div class="logo"><img class="img" src="../assets/img/imagotipo.png" alt=""></div>
        <ul class="list">
            <li><a class="item-list active" href="../index.php">Página Principal</a></li>
            <li><a class="item-list" href="about.php">Sobre</a></li>
            <li><a class="item-list" href="help.php">Ajuda</a></li>
        </ul>
        <div class="cta">
            <!-- Foto de Perfil -->
            <!-- Notificações -->
        </div>
    </header>
    <div>
        <form action=""  role="search" >
            <input type="search" id="search-bar" placeholder="Pesquise suas vagas" required>
            <button type="submit" class="btn-submit">Procurar</button>
        </form>
    </div>

    <div id="overlay" onclick="fecharMenu()"></div>

    <div>
        <button onclick="abrirMenu()" class="btn-vaga">Nova Vaga</button>
    </div>

    <div id="postar-vaga">
        <form action="" method="post">
            <label class="input-label" for="nome">
                Cargo
                <input class="input"
                    type="text"
                    name="nome"
                    placeholder="Insira aqui o cargo da vaga"
                    value=""
                    required
                    maxlength="50"
                    minlength="2">
            </label>
             <label class="input-label" for="tipo">
                Área
                <select class="input"
                    name="tipo"
                    placeholder="Selecione a area que a vaga pertence"
                    required
                    maxlength="50"
                    minlength="2">
                    <option value="adm">Administrativa</option>
                    <option value="ti">Tecnico de informatica</option>
                                <!-- colacar as opçoes dps -->
                </select>
            </label>
             <label class="input-label">
                Descrição
                <input class="input"
                    type="text"
                    name="descricao"
                    placeholder="Descreva sua vaga detalhadamente aqui"
                    value=""
                    required
                    maxlength="5000">
            </label>
            <label class="input-label">
                Salario
                <input class="input"
                    type="number"
                    name="salario"
                    placeholder="Insira o salario da vaga aqui"
                    value=""
                    step="0.01"
                    required>
            </label>
            <label class="input-label">
                Cidade 
                <input class="input"
                    type="text"
                    name="cidade"
                    placeholder="Coloque a cidade onde sua vaga é localizada"
                    value=""
                    required
                    maxlength="100">
            </label>
<!-- tags -->
            <button class="btn-submit" type="submit">Publicar</button>
        </form>

        <button onclick="fecharMenu()">Fechar</button>
    </div> 

    <div> <!--conteudo principal da pagina -->
        <main>
            <!-- onde irao ficar as vagas da empresa, caso não tenha vagas tera um botão ou link para criar vagas aqui -->
        </main>
        <aside>
            <!-- filtros -->
        </aside>
    </div>

    <!-- ainda decidir onde colocar botão de criar vagas -->
    

    <a href="testePostarVaga.php">teste para postar vaga</a>
</body>

<script>
    function abrirMenu() {
  document.body.style.overflow = "hidden";
  document.getElementById("overlay").style.display = "block";
  document.getElementById("postar-vaga").style.display = "block";
}

function fecharMenu() {
  document.body.style.overflow = "auto";
  document.getElementById("overlay").style.display = "none";
  document.getElementById("postar-vaga").style.display = "none";
}
</script>

</html>