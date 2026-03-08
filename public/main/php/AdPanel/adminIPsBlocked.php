<?php
require_once __DIR__ . '/../../../controller/requesters/requireAdmin.php';
require_once __DIR__ . '/../../../templates/header.php';
?>
<link rel="stylesheet" href="/main/css/style.css">

<body>
    <div class="admin-container">
        <h2>IPs Bloqueadas</h2>

        <table class="adminU-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>IP</th>
                    <th>Motivo</th>
                    <th>Fecha</th>
                    <th>Bloqueada por</th>
                </tr>
            </thead>

            <tbody id="ips-body">
                <!-- Se llenará por AJAX -->
            </tbody>
        </table>
    </div>
</body>

<script src="./../../js/ipsBlocked.js"></script>
<?php require_once __DIR__ . '/../../../templates/footer.php'; ?>