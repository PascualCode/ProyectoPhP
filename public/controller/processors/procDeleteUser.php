<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../requesters/requireAdmin.php';

if (!isset($_POST['id'])) {
    http_response_code(400);
    exit("Falta id");
}

$id = $_POST['id'];
$carpetaUsuario = __DIR__ . '/../../../uploads/usuarios/' . $id;

// Función para borrar la carpeta y su contenido
if (is_dir($carpetaUsuario)) {
    $archivos = glob($carpetaUsuario . '/*'); 
    foreach ($archivos as $archivo) {
        if (is_file($archivo)) unlink($archivo); // Borra cada archivo
    }
    rmdir($carpetaUsuario); // Borra la carpeta vacía
}

// Ahora sí, borramos al usuario de la BD
$stmt = $db->prepare("DELETE FROM usuarios WHERE id = ?");


$stmt->execute([$id]);

