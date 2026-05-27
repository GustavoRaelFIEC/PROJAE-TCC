<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nós - PROJAE</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4938BE;
            --secondary: #CF0021;
            --bg-light: #f0fdf4; /* Tom levemente esverdeado da imagem original */
            --text-dark: #333;
            --text-light: #666;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--bg-light);
            color: var(--text-dark);
            line-height: 1.6;
        }

        /* Header Estilizado */
        header {
            background: white;
            padding: 20px 10%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .logo {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo span { color: var(--secondary); }

        nav ul {
            display: flex;
            list-style: none;
            gap: 30px;
        }

        nav a {
            text-decoration: none;
            color: #555;
            font-weight: 500;
            font-size: 14px;
            transition: color 0.3s;
        }

        nav a:hover { color: var(--primary); }

        .btn-header {
            background: var(--primary);
            color: white;
            padding: 12px 25px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: opacity 0.3s;
        }

        .btn-header:hover { opacity: 0.9; }

        /* Layout Principal */
        .container {
            display: flex;
            max-width: 1200px;
            margin: 0 auto;
            padding: 80px 20px;
            gap: 50px;
        }

        /* Coluna Esquerda (Título Fixo) */
        .intro-section {
            flex: 1;
            position: sticky;
            top: 150px;
            height: fit-content;
        }

        .intro-section h1 {
            font-size: 56px;
            font-weight: 700;
            margin-bottom: 30px;
            color: #1a1a1a;
        }

        .intro-section h2 {
            font-size: 24px;
            margin-bottom: 15px;
            color: var(--primary);
        }

        .intro-section p {
            color: var(--text-light);
            font-size: 16px;
            margin-bottom: 30px;
            max-width: 450px;
        }

        .btn-main {
            background: var(--primary);
            color: white;
            padding: 15px 35px;
            border-radius: 50px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            font-size: 16px;
        }

        /* Coluna Direita (Linha do Tempo) */
        .timeline-section {
            flex: 1;
            position: relative;
            padding-left: 50px;
        }

        /* A Linha Vertical */
        .timeline-section::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 2px;
            height: 100%;
            background-color: #ddd;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 80px;
        }

        /* O Círculo na linha */
        .timeline-dot {
            position: absolute;
            left: -58px;
            top: 0;
            width: 18px;
            height: 18px;
            background: white;
            border: 2px solid var(--primary);
            border-radius: 50%;
            z-index: 2;
        }

        .timeline-item:nth-child(even) .timeline-dot {
            border-color: var(--secondary);
        }

        /* Balão de Categoria/Data */
        .category-tag {
            background: white;
            padding: 8px 25px;
            border-radius: 50px;
            display: inline-block;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 25px;
            color: #333;
        }

        .timeline-item h2, .timeline-item h1 {
            font-size: 32px;
            margin-bottom: 15px;
            color: #1a1a1a;
        }

        .timeline-item p {
            color: var(--text-light);
            font-size: 16px;
        }

        .timeline-item ul {
            list-style: none;
            margin-top: 15px;
        }

        .timeline-item li {
            position: relative;
            padding-left: 20px;
            margin-bottom: 10px;
            color: var(--text-light);
        }

        .timeline-item li::before {
            content: '•';
            color: var(--secondary);
            font-weight: bold;
            position: absolute;
            left: 0;
        }

        /* Responsividade */
        @media (max-width: 900px) {
            .container { flex-direction: column; padding: 40px 20px; }
            .intro-section { position: relative; top: 0; margin-bottom: 50px; }
            .intro-section h1 { font-size: 40px; }
            header { padding: 15px 5%; }
            nav { display: none; }
        }
    </style>
</head>
<body>

    <header>
        <div class="logo">PROJAE<span>.</span></div>
        <nav>
            <ul>
                <li><a href="#">Para Estudantes</a></li>
                <li><a href="#">Para Empresas</a></li>
                <li><a href="#">Vagas</a></li>
                <li><a href="#">Blog</a></li>
            </ul>
        </nav>
        <a href="#" class="btn-header">Fale Conosco!</a>
    </header>

    <main class="container">
        <!-- Coluna da Esquerda -->
        <section class="intro-section">
            <h1>Sobre Nós</h1>
            <h2>Quem Somos</h2>
            <p>
                O PROJAE é uma plataforma criada para aproximar estudantes, recém-formados e empresas durante o processo de estágio e inserção no mercado de trabalho. Nosso objetivo é tornar a busca por oportunidades mais simples, prática e eficiente para ambos os lados.
            </p>
            <button class="btn-main">Fale com o PROJAE</button>
        </section>

        <!-- Coluna da Direita (Linha do Tempo) -->
        <section class="timeline-section">
            
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="category-tag">MISSÃO</div>
                <h2>Nossa Missão</h2>
                <p>Facilitar a conexão entre talentos e empresas, ajudando estudantes a encontrarem estágios compatíveis com suas qualificações e permitindo que empresas encontrem profissionais mais preparados.</p>
            </div>

            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="category-tag">PROCESSO</div>
                <h2>Como Funciona</h2>
                <p>A plataforma permite que:</p>
                <ul>
                    <li>Estudantes criem perfis e se candidatem às vagas;</li>
                    <li>Empresas publiquem oportunidades de estágio;</li>
                    <li>O sistema recomende vagas e candidatos com base em compatibilidade;</li>
                </ul>
            </div>

            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="category-tag">FOCO</div>
                <h1>Nosso Objetivo</h1>
                <p>Queremos reduzir as dificuldades enfrentadas por estudantes na busca pelo primeiro estágio e ajudar empresas a encontrarem talentos qualificados de forma mais rápida e eficiente.</p>
            </div>

            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="category-tag">PLATAFORMA</div>
                <h1>Sobre o PROJAE</h1>
                <p>
                    O PROJAE é uma plataforma desenvolvida para conectar estudantes e empresas de forma prática e eficiente. Nosso sistema facilita a busca por estágios e oportunidades profissionais através de recomendações inteligentes e um sistema de pontuação que destaca candidatos e empresas com base em qualificações e avaliações.
                </p>
            </div>

        </section>
    </main>

</body>
</html>