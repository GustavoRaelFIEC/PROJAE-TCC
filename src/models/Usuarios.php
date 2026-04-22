<?php

class Usuario
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Buscar usuário por email
    public function findByEmail($email)
    {
        $stmt = $this->pdo->prepare("
            SELECT u.*, p.*, e.*
            FROM usuarios u
            LEFT JOIN pessoas p ON p.id_usuario = u.id
            LEFT JOIN empresas e ON e.id_usuario = u.id
            WHERE u.email = ?
        ");

        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Cria um novo usuário
    public function createUser($email, $senhaHash, $tipo)
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO usuarios (email, senha, tipo)
            VALUES (?, ?, ?)
        ");
        $stmt->execute([$email, $senhaHash, $tipo]);
        return $this->pdo->lastInsertId(); // Retorna o ID do novo usuário
    }

    // Cadastrar dados de pessoa no banco
    public function createPessoa($userId, $dados)
    {
        $stmt = $this->pdo->prepare("
        INSERT INTO pessoas (nome, cpf, telefone, instituicao, curso, id_usuario)
        VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $dados['nome'],
            $dados['cpf'],
            $dados['telefone'],
            $dados['instituicao'],
            $dados['curso'],
            $userId
        ]);
    }



    // Cadastrar dados de empresa no banco
    public function createEmpresa($userId, $dados)
    {
        $stmt = $this->pdo->prepare("
        INSERT INTO empresas (nome, cnpj, telefone, cidade, id_usuario)
        VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $dados['nome'],
            $dados['cnpj'],
            $dados['telefone'],
            $dados['cidade'],
            $userId
        ]);
    }


    // Cadastrar dados da vaga no banco
    public function createVaga($userId, $dados)
    { //o id_empresa deve ser puxado da session
        $stmt = $this->pdo->prepare("
        INSERT INTO vagas (titulo, descricao, tipo, salario, cidade, status, id_empresa)
        VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $dados['titulo'],
            $dados['descricao'],
            $dados['tipo'],
            $dados['salario'],
            $dados['cidade'],
            $dados['status'],
            $userId
        ]);
    }


    // Buscar/Trazer todas as vagas registradas
    public function buscarVaga(){
        $stmt = $this->pdo->prepare("
        SELECT vagas.*, empresas.nome
        FROM vagas
        INNER JOIN empresas ON vagas.id_empresa = empresas.id_empresa;
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // Realizar inscrição na vaga
    public function inscricao($userId, $vagaId){
        $stmt = $this->pdo->prepare("
        INSERT INTO inscricao (id_pessoa, id_vaga)
        VALUES (?, ?)
        ");
        $stmt->execute([
            $userId,
            $vagaId
        ]);
    }

    // Encontrar por ID da Pessoa
    public function findByIdPessoa($userId){
        $stmt = $this->pdo->prepare("
        SELECT id_pessoa 
        FROM pessoas 
        WHERE id_usuario = ?
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchColumn();
    }

    // Encontrar por ID da Empresa
    public function findByIdEmpresa($userId){
        $stmt = $this->pdo->prepare("
        SELECT id_empresa 
        FROM empresas 
        WHERE id_usuario = ?
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchColumn();
    }

    // Buscar/Trazer todas as inscrições
    public function visualizarInscricoes($userId){
        $stmt = $this->pdo->prepare("
        SELECT 
            inscricao.data_inscricao AS data_inscricao,
            pessoas.nome AS nome_pessoa,
            vagas.titulo AS titulo_vaga
        FROM inscricao
        JOIN pessoas ON inscricao.id_pessoa = pessoas.id_pessoa
        JOIN vagas ON inscricao.id_vaga = vagas.id_vaga
        JOIN empresas ON vagas.id_empresa = empresas.id_empresa
        WHERE empresas.id_empresa = ?
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}                    
