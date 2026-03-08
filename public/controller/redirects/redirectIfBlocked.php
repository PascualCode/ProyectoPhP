<?php

$ip = $_SERVER['REMOTE_ADDR'];

// Comprobar si la IP está bloqueada
$stmt = $db->prepare("SELECT id FROM ips_bloqueadas WHERE ip = ?");
$stmt->execute([$ip]);

if ($stmt->rowCount() > 0) {
    header("Location: /../../main/php/Blocked/bloqueado.php");
    exit;
}
?>
