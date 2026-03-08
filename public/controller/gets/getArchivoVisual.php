<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../requesters/requireLogin.php';

if (!isset($_GET['id'])) {
    http_response_code(400);
    exit("Falta el ID del archivo");
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
        http_response_code(404);
        exit("Archivo no encontrado o no tienes permiso");
    }

    // El archivo pertenece a otro usuario
    $propietario = $archivo['usuario_id'];
}

// Ruta real del archivo
$ruta = __DIR__ . '/../../../uploads/usuarios/' . $propietario . '/' . $archivo['nombre_guardado'];
//$ruta = $_SERVER['HTTP_HOST'];


if (!file_exists($ruta)) {
    http_response_code(404);
    exit("El archivo no existe en el servidor");
}

// Enviar headers
header("Content-Type: " . $archivo['tipo']);
header("Content-Length: " . filesize($ruta));
header("Content-Disposition: inline; filename=\"" . $archivo['nombre_original'] . "\"");

// Leer archivo
readfile($ruta);
exit;
