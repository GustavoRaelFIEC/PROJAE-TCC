<?php

// --- Implementar Interfaces Independentes

interface Notificavel
{
    public function getDestinatarioNotificacao(): string;
    public function getMensagemNotificacao(): string;
}

interface Exportavel
{
    public function exportarJSON(): string;
    public function exportarCSV(): string;
}

interface Auditavel extends Notificavel
{
    public function getCreatedAt(): string;
    public function getUpdatedAt(): string;
    public function getLog(): array;
}

interface StatusChamado
{
    // Constantes disponiveis em qualquer classe que implemente
    const ABERTO = 'aberto';
    const EM_ANDAMENTO = 'em_andamento';
    const AGUARDANDO = 'aguardando_cliente';
    const RESOLVIDO = 'resolvido';
    const CANCELADO = 'cancelado';

    // Status finais (fechados)
    const STATUS_FINAIS = [self::RESOLVIDO, self::CANCELADO];

    public function getStatus(): string;
    public function estaFechado(): bool;
}



// --- Classe que implementa DUAS interfaces
class Chamado implements Exportavel, Auditavel, StatusChamado
{
    private array $log;
    private string $createdAt;
    private string $updatedAt;
    private string $status = 'aberto';

    public function __construct(
        private int $id,
        private string $titulo,
        private string $descricao,
    ) {
        $this->status = self::ABERTO;
        $this->createdAt = date('Y-m-d H:i:s');
        $this->updatedAt = $this->createdAt;
        $this->log[] = "Chamado #{$id} criado em {$this->createdAt}";
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function estaFechado(): bool
    {
        return in_array($this->status, self::STATUS_FINAIS);
    }

    public function atualizarStatus(string $novoStatus): void
    {
        $this->status = $novoStatus;
        $this->updatedAt = date('Y-m-d H:i:s');
        $this->log[] = "Status alterado para '{$novoStatus}' em {$this->updatedAt}";
    }

    // --- Exportavel ---
    public function exportarJSON(): string
    {
        return json_encode([
            'id' => $this->id,
            'titulo' => $this->titulo,
            'descricao' => $this->descricao,
            'status' => $this->status
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function exportarCSV(): string
    {
        return "{$this->id}, {$this->titulo}, {$this->descricao}, {$this->status}";
    }

    // --- Métodos herdados de Notificavel ---
    public function getDestinatarioNotificacao(): string
    {
        throw new Exception('Not implemented');
    }

    public function getMensagemNotificacao(): string
    {
        throw new Exception('Not implemented');
    }

    // --- Auditavel ---
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function getLog(): array
    {
        return $this->log;
    }

    // --- Função polimorfica: aceita qualquer Exportavel ---
    public function exportarDados(Exportavel $obj): void
    {
        echo "=== JSON ===<br>" . $obj->exportarJSON() . "<br>";

        echo "=== CSV ===<br>" . $obj->exportarCSV() . "<br>";
    }

    // --- Função de auditoria: aceita qualquer Auditavel
    public function exibirAuditoria(Auditavel $obj): void
    {
        echo "Criado em: " . $this->getCreatedAt() . "<br>";

        echo "Atualizado em: " . $this->getUpdatedAt() . "<br>";

        echo "Log: <br>";
        foreach ($obj->getLog() as $entrada) {
            echo " >> {$entrada}<br>";
        }
    }
}

$chamado = new Chamado(01, 'Sistema fora do ar', 'Servidor de produção inacessível.');
$chamado->exportarDados($chamado);


$chamado->atualizarStatus('em_andamento');

$chamado->exibirAuditoria($chamado);