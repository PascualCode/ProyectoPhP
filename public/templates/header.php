<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="/main/css/header.css?v=3">
    <meta charset="UTF-8">
    <title>Mi Web</title>
    <script src="/main/js/app.js"></script>
</head>

<body>
    <header>
        <div class="header-container">
            <a href="../../index.php" class="brand-logo">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="box-icon">
                    <path
                        d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z">
                    </path>
                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                    <line x1="12" y1="22.08" x2="12" y2="12"></line>
                </svg>
                <h1 class="brand-title">La cajita de Manu</h1>
            </a>

            <nav class="header-nav">
                <?php if (isset($_SESSION['usuario'])): ?>
                    <?php if ($_SESSION['rol'] == 'admin'): ?>
                        <a href="/../main/php/adminPanel.php" class="header-btn">Mi Panel</a>
                    <?php else: ?>
                        <a href="/../main/php/UserPanel/panelUsuario.php" class="header-btn">Mi Panel</a>
                    <?php endif; ?>
                    <a href="/../main/php/logout.php" class="header-btn">Cerrar sesión</a>
                <?php else: ?>
                    <a href="../main/php/login.php" class="header-btn">Login</a>
                    <a href="../main/php/registro.php" class="header-btn">Registro</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>
</body>