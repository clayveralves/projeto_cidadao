<?php
header('Content-Type: application/json');
try {
    $pdo = new PDO("mysql:host=db;dbname=projeto_cidadao_db;charset=utf8", 'user', 'secret');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT nis, nome FROM cidadaos ORDER BY nome");
    $cidadaos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($cidadaos);
} catch (PDOException $e) {
    echo json_encode([]);
}
