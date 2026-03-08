<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../requesters/requireAdmin.php';

if (!isset($_POST['ip'])) {
    http_response_code(400);
    exit("Falta IP");
}

$ip = $_POST['ip'];

$stmt = $db->prepare("DELETE FROM ips_bloqueadas WHERE ip = ?");
$stmt->execute([$ip]);

echo "OK";
