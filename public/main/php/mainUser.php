<?php
require_once __DIR__ . '/../../controller/requesters/requirelogin.php';
require_once __DIR__ . '/../../config/config.php'; 
require_once __DIR__ . '/../../controller/redirects/redirectIfBlocked.php';

// Obtener los accesos del usuario logueado 
$stmt = $db->prepare("SELECT fecha, ip FROM accesos WHERE usuario_id = ? ORDER BY fecha DESC LIMIT 10"); 
$stmt->execute([$_SESSION['usuario_id']]); 
$accesos = $stmt->fetchAll(PDO::FETCH_ASSOC);

require_once __DIR__ . '/../../templates/header.php';
?>
<head>
    <link rel="stylesheet" href="/main/css/style.css">
</head>
<div class="main-container user-panel">

    <!-- Contenedor izquierdo: información del usuario -->
    <div class="user-box">
        <h2>Panel de Usuario</h2>

        <p>Bienvenido, <strong><?php echo htmlspecialchars($_SESSION['usuario']); ?></strong>.</p>

        <p>Aquí podrás ver tu información personal, tus accesos y más.</p>
    </div>

    <!-- Contenedor derecho: accesos -->
    <div class="access-box">
        <h2>Últimos accesos</h2>

        <?php if (empty($accesos)): ?>
            <p>No hay accesos registrados.</p>
        <?php else: ?>
            <ul class="access-list">
                <?php foreach ($accesos as $acc): ?>
                    <li>
                        <strong><?php echo $acc['fecha']; ?></strong>
                        <br>
                        IP: <?php echo $acc['ip']; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</div>


<?php require_once __DIR__ . '/../../templates/footer.php'; ?>
