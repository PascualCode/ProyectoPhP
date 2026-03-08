<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: /../../../index.php?error=" . urlencode("Debes iniciar sesión"));
    exit;
}

if ($_SESSION['rol'] !== 'admin') {
    header("Location: /../../../index.php?error=" . urlencode("No tienes permisos para acceder"));
    exit;
}
