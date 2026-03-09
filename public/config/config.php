<?php
$DB_HOST = 'localhost';
$DB_NAME = 'miweb_seguridad';
$DB_USER = 'root';
$DB_PASS = 'Pasword69@'; // en XAMPP normalmente vacío

try {
    $db = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4", $DB_USER, $DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
