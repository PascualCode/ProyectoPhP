<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../requesters/requireAdmin.php';

header('Content-Type: application/json');

$stmt = $db->query("
    SELECT id, usuario_introducido, ip, fecha, motivo
    FROM accesos_fallidos
    ORDER BY fecha DESC
");

echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
