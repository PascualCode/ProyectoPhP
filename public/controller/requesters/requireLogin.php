<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../../../index.php?error=" . urlencode("Debes iniciar sesión para acceder"));
    exit;
}
