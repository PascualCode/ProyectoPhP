<?php
require_once __DIR__ . '/../../../controller/requesters/requireAdmin.php';
require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../../templates/header.php';

// Obtener todos los usuarios
$stmt = $db->query("SELECT id, usuario, email, rol, creado_en FROM usuarios ORDER BY id ASC");
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<link rel="stylesheet" href="/main/css/style.css">

<body>
    <div class="admin-container">
        <h2>Listado de Usuarios</h2>

        <table class="adminU-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Fecha Registro</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody id="usuarios-body">
                <!-- Aquí se insertarán los usuarios automáticamente -->
            </tbody>

        </table>
    </div>
</body>
<script src="./../../js/usuariosDinamicos.js"></script>
<script src="./../../js/blockerIP.js"></script>
<script src="./../../js/deletUser.js"></script>
<script src="./../../js/unBlock.js"></script>
<?php require_once __DIR__ . '/../../../templates/footer.php'; ?>