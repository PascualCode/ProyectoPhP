<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../requesters/requireLogin.php';

function redirigir_con_mensaje($tipo, $mensaje) {
    // Usamos ruta relativa para evitar fallos en XAMPP
    header("Location: ../../main/php/mainUser.php?$tipo=" . urlencode($mensaje));
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirigir_con_mensaje('error', "Método no permitido");
}

$usuario_id = $_SESSION['usuario_id'];
$nuevo_usuario = trim($_POST['usuario'] ?? '');
$nuevo_email = trim($_POST['email'] ?? '');
$nueva_password = $_POST['password'] ?? '';

// 1. Validaciones básicas
if ($nuevo_usuario === '' || $nuevo_email === '') {
    redirigir_con_mensaje('error', "El usuario y el email son obligatorios");
}

if (!filter_var($nuevo_email, FILTER_VALIDATE_EMAIL)) {
    redirigir_con_mensaje('error', "El formato del email no es correcto");
}

// 2. Comprobar que el nuevo nombre o email no estén pillados por OTRO usuario
$stmt = $db->prepare("SELECT id FROM usuarios WHERE (usuario = ? OR email = ?) AND id != ?");
$stmt->execute([$nuevo_usuario, $nuevo_email, $usuario_id]);
if ($stmt->rowCount() > 0) {
    redirigir_con_mensaje('error', "Ese nombre de usuario o email ya está en uso");
}

// 3. Preparar la actualización (con o sin contraseña)
if ($nueva_password !== '') {
    // Si escribió algo, validamos que la contraseña sea robusta
    $longitud_valida = strlen($nueva_password) >= 8;
    $tiene_mayuscula = preg_match('/[A-Z]/', $nueva_password);
    $tiene_especial = preg_match('/[\W_]/', $nueva_password);

    if (!$longitud_valida || !$tiene_mayuscula || !$tiene_especial) {
        redirigir_con_mensaje('error', "La contraseña debe tener al menos 8 caracteres, una mayúscula y un carácter especial.");
    }

    $password_hash = password_hash($nueva_password, PASSWORD_DEFAULT);
    
    $stmt = $db->prepare("UPDATE usuarios SET usuario = ?, email = ?, password_hash = ? WHERE id = ?");
    $stmt->execute([$nuevo_usuario, $nuevo_email, $password_hash, $usuario_id]);

} else {
    // Si la dejó en blanco, actualizamos solo usuario y email
    $stmt = $db->prepare("UPDATE usuarios SET usuario = ?, email = ? WHERE id = ?");
    $stmt->execute([$nuevo_usuario, $nuevo_email, $usuario_id]);
}

// 4. Actualizamos la sesión en caso de que haya cambiado su nombre de usuario
$_SESSION['usuario'] = $nuevo_usuario;

redirigir_con_mensaje('success', "Perfil actualizado correctamente");