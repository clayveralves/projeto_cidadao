<?php
class CidadaoModel {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Pega todos os cidadãos
    public function getAll() {
        $stmt = $this->pdo->query("SELECT nis, nome, criated_at FROM cidadaos ORDER BY nome");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Busca um cidadão pelo NIS
    public function getByNis(string $nis) {
        $stmt = $this->pdo->prepare("SELECT nis, nome, criated_at FROM cidadaos WHERE nis = ?");
        $stmt->execute([$nis]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Insere um novo cidadão
    public function insert(string $nis, string $nome) {
        $sql = "INSERT INTO cidadaos (nis, nome) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nis, $nome]);
    }
}
