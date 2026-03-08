<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../requesters/requireLogin.php';

$stmt = $db->query("
    SELECT archivos.*, usuarios.usuario AS nombre_usuario
    FROM archivos
    JOIN usuarios ON archivos.usuario_id = usuarios.id
    WHERE archivos.compartido = 1
    ORDER BY archivos.fecha_subida DESC
");

echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
