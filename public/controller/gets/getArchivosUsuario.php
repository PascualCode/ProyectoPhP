<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../requesters/requireLogin.php';

$usuario_id = $_SESSION['usuario_id'];

$stmt = $db->prepare("SELECT * FROM archivos WHERE usuario_id = ? ORDER BY fecha_subida DESC");
$stmt->execute([$usuario_id]);

$archivos = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($archivos);
