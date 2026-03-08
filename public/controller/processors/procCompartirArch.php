<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../requesters/requireLogin.php';

if (!isset($_POST['id'])) {
    echo json_encode(['error' => 'ID no recibido']);
    exit;
}

$archivo_id = intval($_POST['id']);
$usuario_id = $_SESSION['usuario_id'];

// Verificar propiedad
$stmt = $db->prepare("SELECT * FROM archivos WHERE id = ? AND usuario_id = ?");
$stmt->execute([$archivo_id, $usuario_id]);
$archivo = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$archivo) {
    echo json_encode(['error' => 'Archivo no encontrado']);
    exit;
}

$stmt = $db->prepare("UPDATE archivos SET compartido = 1 WHERE id = ?");
$stmt->execute([$archivo_id]);

echo json_encode(['success' => true]);