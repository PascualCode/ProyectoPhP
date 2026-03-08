<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../requesters/requireLogin.php';

if (!isset($_POST['id'])) {
    echo json_encode(['error' => 'ID no recibido']);
    exit;
}

$archivo_id = intval($_POST['id']);
$usuario_id = $_SESSION['usuario_id'];

// G4: Verificar que el archivo pertenece al usuario
$stmt = $db->prepare("SELECT * FROM archivos WHERE id = ? AND usuario_id = ?");
$stmt->execute([$archivo_id, $usuario_id]);
$archivo = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$archivo) {
    echo json_encode(['error' => 'Archivo no encontrado']);
    exit;
}

// Carpeta del usuario
$carpetaUsuario = realpath(__DIR__ . '/../../../uploads/usuarios/' . $usuario_id . '/');

// Ruta real del archivo
$ruta = realpath($carpetaUsuario . '/' . $archivo['nombre_guardado']);

// G3: Validar que la ruta es válida y está dentro de la carpeta del usuario
if ($ruta === false || strpos($ruta, $carpetaUsuario) !== 0) {
    echo json_encode(['error' => 'Acceso no permitido']);
    exit;
}

// Borrar archivo físico
if (file_exists($ruta)) {
    unlink($ruta);
}

// Borrar de la BD
$stmt = $db->prepare("DELETE FROM archivos WHERE id = ?");
$stmt->execute([$archivo_id]);

echo json_encode(['success' => true]);

