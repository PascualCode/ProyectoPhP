<?php
require_once __DIR__ . '/../requesters/requireAdmin.php';
require_once __DIR__ . '/../../config/config.php';

header('Content-Type: application/json');

$stmt = $db->query("
    SELECT a.id, u.usuario, a.ip, a.fecha
    FROM accesos a
    INNER JOIN usuarios u ON a.usuario_id = u.id
    ORDER BY a.fecha DESC
");

echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
?>
