# PROJAE-TCC
O PROJAE é um sistema web desenvolvido para intermediar a relação entre estudantes e empresas na oferta e busca por oportunidades de estágio e jovem aprendiz. A plataforma centraliza a divulgação de vagas, permite que empresas publiquem oportunidades e que estudantes pesquisem e se candidatem de forma organizada.

O objetivo principal é tornar o processo de recrutamento mais simples, acessível e eficiente para ambos os lados.

# TECNOLOGIAS UTILIZADAS
- Backend: PHP (PDO)
- Frontend: PHP, HTML, CSS, JavaScript
- Banco de dados: MySQL
- Controle de versão: Git

# ESTRUTURA DO PROJETO
O sistema segue uma organização baseada em separação de responsabilidades entre:

- Views: telas do sistema (formulários, páginas, dashboards)
- Controllers: recebem requisições e coordenam as ações
- Models: responsáveis pelas consultas ao banco de dados
- Config: conexão com o banco e configurações globais
- Utils: segurança, sessão e funções auxiliares

Essa divisão permite entender claramente o fluxo de cada funcionalidade.

# FLUXO BASICO DE FUNCIONAMENTO
Exemplo do fluxo de uma funcionalidade (filtro de vagas):

1. A View envia dados do formulário.
2. O Controller recebe a requisição.
3. O Model executa a consulta no banco.
4. O resultado retorna para a View e é exibido ao usuário.

Esse padrão se repete nas demais funcionalidades do sistema.

# FUNCIONALIDADES PRINCIPAIS
- Cadastro e login de usuários (empresa e estudante)
- Publicação de vagas por empresas
- Listagem e filtro de vagas
- Candidatura de estudantes às vagas
- Painéis distintos para empresa e estudante

# COMO EXECUTAR O PROJETO LOCALMENTE
1. Instale o MySQL e inicie o serviço.
2. Importe o banco de dados do projeto.
3. Configure a conexão com o banco no arquivo de configuração (config.php), ajustando:
- host
- porta
- nome do banco
- usuário e senha
4. Inicie um servidor PHP apontando para a pasta pública do projeto.
5. Acesse pelo navegador:

http://localhost/PROJAE-TCC/login.php

# OBJETIVO ACADEMICO
Este projeto foi desenvolvido como Trabalho de Conclusão de Curso do Técnico em Informática para Internet da FIEC, com foco na aplicação prática de conceitos de desenvolvimento web, banco de dados e organização de sistemas.