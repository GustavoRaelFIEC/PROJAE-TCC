<?php

class Pessoa
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
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
            vagas.*
        FROM inscricao
        JOIN vagas ON inscricao.id_vaga = vagas.id_vaga
        WHERE inscricao.id_pessoa = ?");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByCPF($cpf)
    {
        $sql = "SELECT * FROM pessoas WHERE cpf = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$cpf]);

        return $stmt->fetch();
    }

    public function findByTelefone($telefone)
    {
        $sql = "SELECT * FROM pessoas WHERE telefone = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$telefone]);

        return $stmt->fetch();
    }
}
