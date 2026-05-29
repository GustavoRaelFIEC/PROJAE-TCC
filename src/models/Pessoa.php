<?php

class Pessoa
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Cadastrar dados de pessoa 
    public function criarPessoa($idUsuario, $dados)
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
            $idUsuario
        ]);
    }

    // Encontrar por ID da Pessoa
    public function buscarPessoaPorUsuario($idUsuario)
    {
        $stmt = $this->pdo->prepare("
        SELECT id_pessoa 
        FROM pessoas 
        WHERE id_usuario = ?
        ");

        $stmt->execute([$idUsuario]);
        return $stmt->fetchColumn();
    }

    // Dados por ID da Pessoa
    public function buscarDadosPorUsuario($idUsuario)
    {
        $stmt = $this->pdo->prepare("
        SELECT * 
        FROM pessoas 
        WHERE id_usuario = ?
        ");

        $stmt->execute([$idUsuario]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Buscar/Trazer todas as inscrições pela Pessoa
    public function visualizarInscricoesPessoa($idUsuario)
    {
        $stmt = $this->pdo->prepare("
        SELECT 
            inscricao.id_inscricao,
            inscricao.data_inscricao,
            empresas.nome AS nomeEmpresa,
            DATE(inscricao.data_inscricao) AS data_inscricao_formatada,
            vagas.*,
            DATE(vagas.data_publicacao) AS data_publicacao_formatada
            FROM inscricao
            JOIN vagas 
                ON inscricao.id_vaga = vagas.id_vaga
            JOIN empresas 
                ON vagas.id_empresa = empresas.id_empresa
            WHERE inscricao.id_pessoa = ?
        ");

        $stmt->execute([$idUsuario]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorCPF($cpf)
    {
        $stmt = $this->pdo->prepare("
        SELECT * 
        FROM pessoas 
        WHERE cpf = ?
        ");

        $stmt->execute([$cpf]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function buscarPorTelefone($telefone)
    {
        $stmt = $this->pdo->prepare("
        SELECT * 
        FROM pessoas 
        WHERE telefone = ?
        ");

        $stmt->execute([$telefone]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
