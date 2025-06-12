<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Método inválido']);
    exit;
}

if (empty($_POST['nis']) || strlen($_POST['nis']) !== 11) {
    echo json_encode(['success' => false, 'error' => 'NIS inválido']);
    exit;
}

$nis = $_POST['nis'];

try {
    $pdo = new PDO("mysql:host=db;dbname=projeto_cidadao_db;charset=utf8", 'user', 'secret');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("SELECT nis, nome FROM cidadaos WHERE nis = :nis LIMIT 1");
    $stmt->execute(['nis' => $nis]);
    $cidadao = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($cidadao) {
        echo json_encode(['success' => true, 'cidadao' => $cidadao]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Cidadão não encontrado']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => 'Erro no banco de dados']);
}
