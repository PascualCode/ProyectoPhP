<?php
session_start();
require_once __DIR__ . '/../../config/config.php';

function redirigir_con_error($mensaje) {
    global $db; //SE INVOCA CON GLOBAL PARA VERLA PESE A SER EXTERNA

    $ip = $_SERVER['REMOTE_ADDR'];
    $usuario_introducido = $_POST['usuario'] ?? 'desconocido';

    $stmt = $db->prepare("
        INSERT INTO accesos_fallidos (usuario_introducido, ip, motivo)
        VALUES (?, ?, ?)
    ");
    $stmt->execute([$usuario_introducido, $ip, "Credenciales incorrectas"]);

    // Comprobar cuántos fallos tiene esta IP en los últimos 10 minutos 
    $stmt = $db->prepare(" SELECT COUNT(*) FROM accesos_fallidos WHERE ip = ? AND fecha >= (NOW() - INTERVAL 10 MINUTE) "); 
    $stmt->execute([$ip]); $fallos = $stmt->fetchColumn(); 
    
    // Si supera el límite → bloquear IP 
    if ($fallos >= 3) { 
        $stmt = $db->prepare("INSERT IGNORE INTO ips_bloqueadas (ip, motivo, bloqueada_por) 
        VALUES (?, 'Demasiados intentos fallidos', 'sistema')
        "); 
        $stmt->execute([$ip]); 
    }

    header("Location: /../../main/php/login.php?error=" . urlencode($mensaje));
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirigir_con_error("Método no permitido");
}

$usuario = trim($_POST['usuario'] ?? '');
$password = $_POST['password'] ?? '';

if ($usuario === '' || $password === '') {
    redirigir_con_error("Todos los campos son obligatorios");
}

// Buscar usuario en la BD
$stmt = $db->prepare("SELECT id, password_hash, rol FROM usuarios WHERE usuario = ?");
$stmt->execute([$usuario]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    redirigir_con_error("Usuario o contraseña incorrectos");
}

// Verificar contraseña
if (!password_verify($password, $user['password_hash'])) {
    redirigir_con_error("Usuario o contraseña incorrectos");
}

// Login correcto → guardar datos en sesión
$_SESSION['usuario_id'] = $user['id'];
$_SESSION['usuario'] = $usuario;
$_SESSION['rol'] = $user['rol'];

// Registrar acceso
$ip = $_SERVER['REMOTE_ADDR'];
$fecha = date('Y-m-d H:i:s');

$stmt = $db->prepare("INSERT INTO accesos (usuario_id, ip, fecha) VALUES (?, ?, ?)");
$stmt->execute([$user['id'], $ip, $fecha]);

// Redirigir al index
header("Location: /../../../index.php");
exit;
