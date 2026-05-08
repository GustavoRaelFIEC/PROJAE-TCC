<?php

class Vaga
{

    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
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
    public function buscarVaga()
    {
        $stmt = $this->pdo->prepare("
        SELECT vagas.*, empresas.nome
        FROM vagas
        INNER JOIN empresas ON vagas.id_empresa = empresas.id_empresa;
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Realizar inscrição na vaga
    public function inscricao($userId, $vagaId)
    {
        $stmt = $this->pdo->prepare("
        INSERT INTO inscricao (id_pessoa, id_vaga)
        VALUES (?, ?)
        ");
        $stmt->execute([
            $userId,
            $vagaId
        ]);
    }

    public function handleFiltrarPorTipo($tipo)
    {
        if ($tipo === '') {
            $stmt = $this->pdo->query("SELECT * FROM vagas WHERE status = 'aberta'");
        } else {

            $stmt = $this->pdo->prepare("
            SELECT * 
            FROM vagas 
            WHERE tipo = (?) 
            AND status = 'aberta'
            ");

            $stmt->execute([$tipo]);
        }


        return $stmt->fetchAll();
    }
}
