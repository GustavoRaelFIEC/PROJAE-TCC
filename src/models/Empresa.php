<?php

class Empresa
{

    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
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

    // Encontrar por ID da Empresa
    public function findByIdEmpresa($userId)
    {
        $stmt = $this->pdo->prepare("
        SELECT id_empresa 
        FROM empresas 
        WHERE id_usuario = ?
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchColumn();
    }

    // Dados por ID da Empresa
    public function dadosByIdEmpresa($userId)
    {
        $stmt = $this->pdo->prepare("
        SELECT * 
        FROM empresas 
        WHERE id_usuario = ?
        ");
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Buscar/Trazer todas as inscrições pela Empresa
    public function visualizarInscricoesEmpresa($userId)
    {
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
