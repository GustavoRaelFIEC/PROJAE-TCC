<?php

class Inscricao
{

    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Realizar inscrição na vaga
    public function criarInscricao($idPessoa, $idVaga)
    {
        $stmt = $this->pdo->prepare("
        INSERT INTO inscricao (id_pessoa, id_vaga)
        VALUES (?, ?)
        ");

        $stmt->execute([
            $idPessoa,
            $idVaga
        ]);
    }

    // Cancelar inscrição na vaga
    public function cancelarInscricao($idInscricao)
    {
        $stmt = $this->pdo->prepare("
        DELETE FROM inscricao
        WHERE id_inscricao = ?
        ");

        $stmt->execute([$idInscricao]);
        echo $stmt->rowCount();
        exit();
    }
}
