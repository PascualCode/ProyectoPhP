<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../requesters/requireAdmin.php';

$stmt = $db->query("SELECT id, ip, motivo, fecha, bloqueada_por FROM ips_bloqueadas ORDER BY fecha DESC");
$ips = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($ips);
