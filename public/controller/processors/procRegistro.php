<?php
require_once __DIR__ . '/../../config/config.php';

function redirigir_con_error($mensaje) {
    header("Location: /../../main/php/registro.php?error=" . urlencode($mensaje));
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirigir_con_error("Método no permitido");
}

$usuario = trim($_POST['usuario'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password']  ?? '';
$password2 = $_POST['password2'] ?? '';

if ($usuario === '' || $email === '' || $password === '' || $password2 === '') {
    redirigir_con_error("Todos los campos son obligatorios");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    redirigir_con_error("El formato del email no es correcto");
}

if ($password !== $password2) {
    redirigir_con_error("Las contraseñas no coinciden");
}

// Comprobar si el usuario ya existe
// Crea una consulta segura, evitando inyecciones SQL. ? es un placeholder que luego se sustituye por el valor real.
$stmt = $db->prepare("SELECT id FROM usuarios WHERE usuario = ? OR email = ?");

// Ejecuta la consulta y coloca el valor $usuario en el ?.
$stmt->execute([$usuario, $email]);

// Cuenta el numero de filas que devuelve la consulta.
if ($stmt->rowCount() > 0) {
    redirigir_con_error("El usuario o el email ya está registrado");
}

// Hashear contraseña
$password_hash = password_hash($password, PASSWORD_DEFAULT);

// Insertar en la BD
$stmt = $db->prepare("INSERT INTO usuarios (usuario, email, password_hash) VALUES (?, ?, ?)");
$stmt->execute([$usuario, $email, $password_hash]);

// Obtener el ID del usuario recién creado
$usuario_id = $db->lastInsertId();

// Crear carpeta del usuario
$directorio = __DIR__ . '/../../../uploads/usuarios/' . $usuario_id;

if (!file_exists($directorio)) {
    mkdir($directorio, 0777, true);
}


header("Location: /../../main/php/registro.php?success=1"); 
exit;

?>