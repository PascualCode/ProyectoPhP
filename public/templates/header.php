<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="/main/css/header.css">
    <meta charset="UTF-8">
    <title>Mi Web</title>
    <script src="/main/js/app.js"></script>
</head>
<body>
    <header>
        <div class="header-container">
            <a href="/../index.php" class="no-a"><h1>La cajita de Manu</h1></a>

            <nav class="header-nav">
                <?php if (isset($_SESSION['usuario'])): ?>
                    <?php if ($_SESSION['rol'] == 'admin'): ?>
                        <a href="/../main/php/adminPanel.php" class="header-btn">Mi Panel</a>
                    <?php else: ?>
                        <a href="/../main/php/UserPanel/panelUsuario.php" class="header-btn">Mi Panel</a>
                    <?php endif; ?>
                    <a href="/../main/php/logout.php" class="header-btn">Cerrar sesión</a>
                <?php else: ?>
                    <a href="/../main/php/login.php" class="header-btn">Login</a>
                    <a href="/../main/php/registro.php" class="header-btn">Registro</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>
</body>

