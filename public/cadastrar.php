<?php
// Conexão com o banco
$host = 'db'; // nome do container no docker-compose
$dbname = 'projeto_cidadao_db';
$user = 'user';
$pass = 'secret';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => 'Erro ao conectar no banco.']);
    exit;
}

if (!isset($_POST['nome']) || trim($_POST['nome']) === '') {
    echo json_encode(['success' => false, 'error' => 'Nome obrigatório.']);
    exit;
}

$nome = trim($_POST['nome']);

// Gerar NIS único
function gerarNIS($pdo) {
    do {
        $nis = str_pad(mt_rand(0, 99999999999), 11, '0', STR_PAD_LEFT);
        $stmt = $pdo->prepare("SELECT nis FROM cidadaos WHERE nis = ?");
        $stmt->execute([$nis]);
    } while ($stmt->rowCount() > 0);
    return $nis;
}

$nis = gerarNIS($pdo);

// Inserir no banco
try {
    $stmt = $pdo->prepare("INSERT INTO cidadaos (nis, nome) VALUES (?, ?)");
    $stmt->execute([$nis, $nome]);

    echo json_encode(['success' => true, 'nis' => $nis]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => 'Erro ao salvar cidadão.']);
}
