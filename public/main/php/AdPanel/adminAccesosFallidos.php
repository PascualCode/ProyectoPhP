<?php
require_once __DIR__ . '/../../../controller/requesters/requireAdmin.php';
require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../../templates/header.php';

$stmt = $db->query("
    SELECT id, usuario_introducido, ip, fecha, motivo
    FROM accesos_fallidos
    ORDER BY fecha DESC
");

$fallidos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<link rel="stylesheet" href="/main/css/style.css">

<body>
    <div class="adminU-container">
        <h2>Accesos Fallidos</h2>

        <table class="adminU-table">
            <thead>
                <tr>
                    <th>Usuario introducido</th>
                    <th>IP</th>
                    <th>Fecha</th>
                    <th>Motivo</th>
                </tr>
            </thead>

            <tbody id="tabla-fallidos">
                <!-- Aquí se insertarán los accesos fallidos automáticamente -->
            </tbody>
        </table>
    </div>
</body>


<script src="./../../js/accesosFallidosDinamicos.js"></script>
<?php require_once __DIR__ . '/../../../templates/footer.php'; ?>