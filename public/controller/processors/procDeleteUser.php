<?php
require_once __DIR__ . '/../../config/config.php';

if (!isset($_POST['id'])) {
    http_response_code(400);
    exit("Falta id");
}

$id = $_POST['id'];

$stmt = $db->prepare("DELETE FROM usuarios WHERE id = ?");
$stmt->execute([$id]);

echo "OK";
