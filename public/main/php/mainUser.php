<?php
require_once __DIR__ . '/../../controller/requesters/requirelogin.php';
require_once __DIR__ . '/../../config/config.php'; 
require_once __DIR__ . '/../../controller/redirects/redirectIfBlocked.php';

// Obtener los accesos del usuario logueado 
$stmt = $db->prepare("SELECT fecha, ip FROM accesos WHERE usuario_id = ? ORDER BY fecha DESC LIMIT 10"); 
$stmt->execute([$_SESSION['usuario_id']]); 
$accesos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obtener los datos actuales del usuario para rellenar el formulario
$stmtUser = $db->prepare("SELECT usuario, email FROM usuarios WHERE id = ?");
$stmtUser->execute([$_SESSION['usuario_id']]);
$datosUsuario = $stmtUser->fetch(PDO::FETCH_ASSOC);

require_once __DIR__ . '/../../templates/header.php';
?>
<head>
    <link rel="stylesheet" href="/main/css/mainUser.css">
</head>
<div class="main-container user-panel">

    <!-- Contenedor izquierdo: información del usuario -->
    <div class="user-box">
        <h2>Panel de Usuario</h2>
        <p>Bienvenido, <strong><?php echo htmlspecialchars($_SESSION['usuario']); ?></strong>.</p>
        <p>Aquí podrás ver tu información personal, tus accesos y más.</p>
        
        <hr style="margin: 25px 0; border: 0; border-top: 1px solid #ddd;">
        <h3 style="margin-bottom: 15px;">Editar Perfil</h3>

        <?php if (isset($_GET['success'])): ?>
            <div class="success"><?php echo htmlspecialchars($_GET['success']); ?></div>
        <?php endif; ?>
        <?php if (isset($_GET['error'])): ?>
            <div class="error"><?php echo htmlspecialchars($_GET['error']); ?></div>
        <?php endif; ?>

        <form action="../../controller/processors/procUpdateUser.php" method="POST" style="text-align: left;">
            <div class="form-group">
                <label for="usuario">Nombre de usuario</label>
                <input type="text" name="usuario" id="usuario" value="<?php echo htmlspecialchars($datosUsuario['usuario']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($datosUsuario['email']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="password">Nueva contraseña (opcional)</label>
                <input type="password" name="password" id="password" placeholder="Déjalo en blanco para no cambiarla">
            </div>
            
            <button type="submit" class="home-btn" style="width: 100%; border: none; cursor: pointer; margin-top: 10px;">
                Guardar Cambios
            </button>
        </form>
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
