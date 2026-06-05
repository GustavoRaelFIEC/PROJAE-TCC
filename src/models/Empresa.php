<?php

class Empresa
{

    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Cadastrar dados de empresa no banco
    public function createEmpresa($idUsuario, $dados)
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
            $idUsuario
        ]);
    }

    // Descobrir o id da empresa pelo id do usuário
    public function buscarIdEmpresaPorUsuario($idUsuario)
    {
        $stmt = $this->pdo->prepare("
        SELECT id_empresa 
        FROM empresas 
        WHERE id_usuario = ?
        ");

        $stmt->execute([$idUsuario]);
        return $stmt->fetchColumn();
    }

    // Buscar dados pelo id da empresa
    public function buscarEmpresaPorUsuario($idUsuario)
    {
        $stmt = $this->pdo->prepare("
        SELECT * 
        FROM empresas 
        WHERE id_usuario = ?
        ");

        $stmt->execute([$idUsuario]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Alterna status da vaga
    public function alternarStatus($idVaga)
    {
        $stmt = $this->pdo->prepare("
        UPDATE vagas 
        SET status = 
                CASE 
                    WHEN status = 'aberta' THEN 'fechada'
                    ELSE 'aberta'
                END
            WHERE id_vaga = ?
        ");

        return $stmt->execute([$idVaga]);
    }

    // Buscar todas as inscrições da empresa
    public function visualizarInscricoesEmpresa($idEmpresa)
    {
        $stmt = $this->pdo->prepare("
        SELECT 
            inscricao.data_inscricao AS data_inscricao,
            pessoas.nome AS nome_pessoa,
            pessoas.curso AS curso_pessoa,
            pessoas.telefone AS telefone_pessoa,
            usuarios.email AS email_pessoa,
            vagas.titulo AS titulo_vaga
        FROM inscricao
        JOIN pessoas 
            ON inscricao.id_pessoa = pessoas.id_pessoa
        JOIN usuarios 
            ON pessoas.id_usuario = usuarios.id
        JOIN vagas 
            ON inscricao.id_vaga = vagas.id_vaga
        JOIN empresas 
            ON vagas.id_empresa = empresas.id_empresa
        WHERE empresas.id_empresa = ?;
        ");

        $stmt->execute([$idEmpresa]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarEmpresaPorCNPJ($cnpj)
    {
        $stmt = $this->pdo->prepare("
         SELECT * 
         FROM empresas 
         WHERE cnpj = ? 
         ");

        $stmt->execute([$cnpj]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function buscarEmpresaPorTelefone($telefone)
    {
        $stmt = $this->pdo->prepare("
        SELECT * 
        FROM empresas 
        WHERE telefone = ? 
        ");

        $stmt->execute([$telefone]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
