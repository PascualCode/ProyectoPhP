<?php
require_once __DIR__ . '/../../../controller/requesters/requireAdmin.php';
require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../../templates/header.php';

// Obtener todos los accesos con el nombre del usuario
$stmt = $db->query("
    SELECT a.id, a.usuario_id, a.ip, a.fecha, u.usuario 
    FROM accesos a
    INNER JOIN usuarios u ON a.usuario_id = u.id
    ORDER BY a.fecha DESC
");

$accesos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<link rel="stylesheet" href="/main/css/style.css">

<body>
    <div class="adminU-container">
        <h2>Accesos de Usuarios</h2>

        <table class="adminU-table">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>IP</th>
                    <th>Fecha</th>
                </tr>
            </thead>

            <tbody id="tabla-accesos">
                <!-- Aquí se insertarán los accesos automáticamente -->
            </tbody>

        </table>
    </div>
</body>

<script src="./../../js/accesosDinamicos.js"></script>
<?php require_once __DIR__ . '/../../../templates/footer.php'; ?>