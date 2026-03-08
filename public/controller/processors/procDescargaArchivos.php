<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../requesters/requireLogin.php';

if (!isset($_GET['id'])) {
    exit("ID no recibido");
}

$archivo_id = intval($_GET['id']);
$usuario_id = $_SESSION['usuario_id'];

// 1. Intentar obtener el archivo como propio
$stmt = $db->prepare("SELECT * FROM archivos WHERE id = ? AND usuario_id = ?");
$stmt->execute([$archivo_id, $usuario_id]);
$archivo = $stmt->fetch(PDO::FETCH_ASSOC);

if ($archivo) {
    // El archivo es del usuario logueado
    $propietario = $usuario_id;
} else {
    // 2. Intentar obtenerlo como archivo compartido
    $stmt = $db->prepare("SELECT * FROM archivos WHERE id = ? AND compartido = 1");
    $stmt->execute([$archivo_id]);
    $archivo = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$archivo) {
        exit("Archivo no encontrado");
    }

    // El archivo pertenece a otro usuario
    $propietario = $archivo['usuario_id'];
}

// Construir ruta segura
$carpetaUsuario = realpath(__DIR__ . '/../../../uploads/usuarios/' . $propietario . '/');
$ruta = realpath($carpetaUsuario . '/' . $archivo['nombre_guardado']);

if ($ruta === false || strpos($ruta, $carpetaUsuario) !== 0) {
    exit("Acceso no permitido");
}

if (!file_exists($ruta)) {
    exit("El archivo no existe");
}

// Enviar archivo
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"" . $archivo['nombre_original'] . "\"");
header("Content-Length: " . filesize($ruta));

readfile($ruta);
exit;
