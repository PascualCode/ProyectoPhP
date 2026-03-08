<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../requesters/requireLogin.php';

$usuario_id = $_SESSION['usuario_id'];

// Directorio del usuario
$directorio = __DIR__ . '/../../../uploads/usuarios/' . $usuario_id;

// Crear si no existe
if (!file_exists($directorio)) {
    mkdir($directorio, 0777, true);
}

// Validar que se envió un archivo
if (!isset($_FILES['archivo'])) {
    echo json_encode(['error' => 'No se recibió ningún archivo']);
    exit;
}

$archivo = $_FILES['archivo'];

// Validaciones básicas en back
$max_tamano = 100 * 1024 * 1024; // 100 MB
$ext_permitidas = ['jpg','jpeg','png','webp','mp4','webm','mov'];

$nombre_original = $archivo['name'];
$extension = strtolower(pathinfo($nombre_original, PATHINFO_EXTENSION));
$tamano = $archivo['size'];

// Validar extensión
if (!in_array($extension, $ext_permitidas)) {
    echo json_encode(['error' => 'Tipo de archivo no permitido']);
    exit;
}

// Validar tamaño
if ($tamano > $max_tamano) {
    echo json_encode(['error' => 'Archivo demasiado grande']);
    exit;
}

// Validar MIME real con finfo (G2)
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime_real = finfo_file($finfo, $archivo['tmp_name']);

$mime_permitidos = [
    "image/jpeg",
    "image/png",
    "image/webp",
    "image/gif",
    "image/bmp",
    "video/mp4",
    "video/webm",
    "video/quicktime"
];

if (!in_array($mime_real, $mime_permitidos)) {
    echo json_encode(['error' => 'Tipo MIME no válido']);
    exit;
}

// Generar nombre seguro
$nombre_guardado = uniqid() . '.' . $extension;

// Mover archivo
$ruta_destino = $directorio . '/' . $nombre_guardado;

if (!move_uploaded_file($archivo['tmp_name'], $ruta_destino)) {
    echo json_encode(['error' => 'Error al guardar el archivo']);
    exit;
}

// Registrar en BD
$stmt = $db->prepare("
    INSERT INTO archivos (usuario_id, nombre_original, nombre_guardado, tipo, tamano)
    VALUES (?, ?, ?, ?, ?)
");
$stmt->execute([$usuario_id, $nombre_original, $nombre_guardado, $mime_real, $tamano]);

echo json_encode(['success' => true]);
