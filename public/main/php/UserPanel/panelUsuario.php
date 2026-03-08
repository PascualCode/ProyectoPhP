<link rel="stylesheet" href="/main/css/panelArchivos.css">
<?php
require_once __DIR__ . '/../../../controller/requesters/requireLogin.php';
require_once __DIR__ . '/../../../templates/header.php';
?>

<div class="user-panel-container">

    <a href="./../mainUser.php" class="back-btn">Panel de Control</a>

    <h2>Mis archivos</h2>

    <!-- Zona de subida (luego añadiremos drag & drop) -->
    <div class="upload-area" id="upload-area">
        <p>Arrastra tus archivos aquí o haz clic para subir</p>
        <input type="file" id="file-input" multiple hidden>
    </div>

    <!-- Opciones de ordenacion -->
    <select id="ordenar" class="ordenar-select">
        <option value="fecha">Más recientes</option>
        <option value="nombre">Nombre</option>
        <option value="tamano">Tamaño</option>
    </select>

    <!-- Contenedor de archivos -->
    <div class="files-grid" id="files-grid">
        <!-- Se llenará por AJAX -->
    </div>

    <h2>Archivos Compartidos</h2>
    
    <div id="zonaCompartidos" class="files-grid">

    </div>

</div>

<script src="./../../js/panelArchivos.js"></script>
<script src="./../../js/borradorArchivos.js"></script>
<script src="./../../js/archivosCompartidos.js"></script>
<script src="./../../js/comparticionArchivos.js"></script>
<?php require_once __DIR__ . '/../../../templates/footer.php'; ?>