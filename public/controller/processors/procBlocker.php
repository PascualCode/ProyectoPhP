<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../requesters/requireAdmin.php';

if (!isset($_POST['usuario_id'])) {
    http_response_code(400);
    exit("Falta usuario_id");
}

$usuario_id = $_POST['usuario_id'];

// Obtener IP del usuario
$stmt = $db->prepare("SELECT ip FROM accesos WHERE usuario_id = ? ORDER BY fecha DESC LIMIT 1");
$stmt->execute([$usuario_id]);
$ip = $stmt->fetchColumn();

if (!$ip) {
    exit("El usuario no tiene accesos registrados");
}

// Insertar en tabla de bloqueos
$stmt = $db->prepare("INSERT IGNORE INTO ips_bloqueadas (ip, motivo, bloqueada_por) VALUES (?, 'Bloqueado por admin', 'admin')");
$stmt->execute([$ip]);

echo "OK";
