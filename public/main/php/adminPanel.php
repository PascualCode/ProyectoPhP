<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../controller/requesters/requireAdmin.php';
require_once __DIR__ . '/../../controller/redirects/redirectIfBlocked.php';
require_once __DIR__ . '/../../templates/header.php';

?>

<head>
    <link rel="stylesheet" href="/main/css/administrador.css">
</head>

<body>
    <div class="admin-container">
        <h2>Panel de Administración</h2>

        <div class="admin-grid">
            <a href="./AdPanel/adminUsuarios.php" class="admin-card">Ver todos los usuarios</a>
            <a href="./AdPanel/adminAccesos.php" class="admin-card">Ver accesos</a>
            <a href="./AdPanel/adminAccesosFallidos.php" class="admin-card">Ver accesos fallidos</a>
            <a href="./AdPanel/adminIPsBlocked.php" class="admin-card">Ver IPs bloqueadas</a>
        </div>
    </div>
</body>


<?php require_once __DIR__ . '/../../templates/footer.php'; ?>