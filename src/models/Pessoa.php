<?php

class Pessoa
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

    // Encontrar por ID da Pessoa
    public function findByIdPessoa($userId)
    {
        $stmt = $this->pdo->prepare("
        SELECT id_pessoa 
        FROM pessoas 
        WHERE id_usuario = ?
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchColumn();
    }

    // Dados por ID da Pessoa
    public function dadosByIdPessoa($userId)
    {
        $stmt = $this->pdo->prepare("
        SELECT * 
        FROM pessoas 
        WHERE id_usuario = ?
        ");
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Buscar/Trazer todas as inscrições pela Pessoa
    public function visualizarInscricoesPessoa($userId)
    {
        $stmt = $this->pdo->prepare("
    SELECT 
        inscricao.data_inscricao,
        DATE(inscricao.data_inscricao) AS data_inscricao_formatada,
        vagas.*,
        DATE(vagas.data_publicacao) AS data_publicacao_formatada
    FROM inscricao
    JOIN vagas ON inscricao.id_vaga = vagas.id_vaga
    WHERE inscricao.id_pessoa = ?");

        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
