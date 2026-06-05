<?php

class Vaga
{

    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function criarVaga($idEmpresa, $dados)
    {
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
            $idEmpresa
        ]);
    }


    public function buscarVagasAbertas()
    {
        $stmt = $this->pdo->prepare("
        SELECT 
            empresas.nome AS nomeEmpresa,
            vagas.*,
            DATE(vagas.data_publicacao) AS data_publicacao_formatada
            FROM vagas
            INNER JOIN empresas ON vagas.id_empresa = empresas.id_empresa
            WHERE vagas.status = 'aberta'
        ");

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function filtrarPorTipo($tipo)
    {
        $stmt = $this->pdo->prepare("
        SELECT 
            vagas.*,
            empresas.nome,
            DATE(vagas.data_publicacao) AS data_publicacao_formatada
        FROM vagas
        INNER JOIN empresas ON vagas.id_empresa = empresas.id_empresa
        WHERE vagas.tipo = ? AND vagas.status = 'aberta'
        ");

        $stmt->execute([$tipo]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarVagasPorEmpresa($id_empresa)
    {
        $stmt = $this->pdo->prepare("
        SELECT * 
        FROM vagas 
        WHERE id_empresa = ?
        ORDER BY data_publicacao DESC
        ");

        $stmt->execute([$id_empresa]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarDadosVaga($idVaga)
    {
        $stmt = $this->pdo->prepare(
            "
        SELECT DISTINCT
            vagas.*,
            empresas.nome AS nomeEmpresa,
            DATE(inscricao.data_inscricao) AS data_inscricao_formatada,
            DATE(vagas.data_publicacao) AS data_publicacao_formatada
        FROM vagas

        LEFT JOIN inscricao 
            ON inscricao.id_vaga = vagas.id_vaga

        JOIN empresas 
            ON vagas.id_empresa = empresas.id_empresa

        WHERE vagas.id_vaga = ?
        "
        );

        $stmt->execute([$idVaga]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function alternarStatusVaga($idVaga)
    {

        $stmt = $this->pdo->prepare("
    UPDATE vagas
    SET status =
    CASE WHEN status = 'aberta' THEN 'fechada'
    ELSE 'aberta'
    END
    WHERE id_vaga = ?
    ");

        return $stmt->execute([$idVaga]);
    }

    public function excluirVaga($idVaga)
    {
        try {

            $this->pdo->beginTransaction();

            $stmt = $this->pdo->prepare("
            DELETE FROM inscricao
            WHERE id_vaga = ?
        ");
            $stmt->execute([$idVaga]);

            $stmt = $this->pdo->prepare("
            DELETE FROM vagas
            WHERE id_vaga = ?
        ");
            $stmt->execute([$idVaga]);

            $this->pdo->commit();

            return $stmt->rowCount();
        } catch (PDOException $e) {

            $this->pdo->rollBack();
            return 0;
        }
    }
}
