<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../requesters/requireAdmin.php';

// Obtener usuarios
$stmt = $db->query("SELECT id, usuario, email, rol, creado_en FROM usuarios ORDER BY id ASC");
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($usuarios as &$u) {
    // Obtener la última IP del usuario
    $stmt2 = $db->prepare("SELECT ip FROM accesos WHERE usuario_id = ? ORDER BY fecha DESC LIMIT 1");
    $stmt2->execute([$u['id']]);
    $ip = $stmt2->fetchColumn();

    $u['ip'] = $ip ?: null;

    // Comprobar si esa IP está bloqueada
    if ($ip) {
        $stmt3 = $db->prepare("SELECT id FROM ips_bloqueadas WHERE ip = ?");
        $stmt3->execute([$ip]);
        $u['bloqueado'] = $stmt3->rowCount() > 0 ? 1 : 0;
    } else {
        $u['bloqueado'] = 0;
    }
}

header('Content-Type: application/json');
echo json_encode($usuarios);

