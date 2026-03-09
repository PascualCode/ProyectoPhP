const fileInput = document.getElementById("file-input");
const uploadArea = document.getElementById("upload-area");

//Tipos de archivos permitidos
const tiposPermitidos = [
    "image/jpeg",
    "image/png",
    "image/webp",
    "image/gif",
    "image/bmp",
    "image/svg+xml",

    "video/mp4",
    "video/webm",
    "video/ogg",
    "video/mpeg",
    "video/quicktime"
];

const TAMANO_MAX = 100 * 1024 * 1024; // 100 MB
const MAX_ARCHIVOS = 10; // máximo por subida

//Precarga de contenido de la pagina
document.addEventListener("DOMContentLoaded", () => {
    cargarArchivos();
    cargarCompartidos();
});

// Click abre el selector
uploadArea.addEventListener("click", () => fileInput.click());

// Cuando se seleccionan archivos desde el input
fileInput.addEventListener("change", () => {
    if (fileInput.files.length > 0) {
        manejarArchivos(fileInput.files);
        fileInput.value = ""; // limpiar selección
    }
});

// Evitar que el navegador abra el archivo al soltarlo
["dragenter", "dragover", "dragleave", "drop"].forEach(eventName => {
    uploadArea.addEventListener(eventName, e => {
        e.preventDefault();
        e.stopPropagation();
    });
});

// Estilo al arrastrar encima
["dragenter", "dragover"].forEach(eventName => {
    uploadArea.addEventListener(eventName, () => {
        uploadArea.classList.add("dragover");
    });
});

// Quitar estilo al salir
["dragleave", "drop"].forEach(eventName => {
    uploadArea.addEventListener(eventName, () => {
        uploadArea.classList.remove("dragover");
    });
});

// Cuando se sueltan archivos
uploadArea.addEventListener("drop", e => {
    const files = e.dataTransfer.files;
    if (files.length > 0) {
        manejarArchivos(files);
    }
});


// Detecta cambios en el selector
document.getElementById("ordenar").addEventListener("change", cargarArchivos);

function manejarArchivos(fileList) {
    const archivos = Array.from(fileList);

    // Validar número máximo
    if (archivos.length > MAX_ARCHIVOS) {
        mostrarError(`Máximo permitido: ${MAX_ARCHIVOS} archivos por subida`);
        return;
    }

    // Filtrar archivos válidos
    const validos = archivos.filter(file => {

        // Validar tipo
        if (!tiposPermitidos.includes(file.type)) {
            mostrarError(`Tipo no permitido: ${file.name}`);
            return false;
        }

        // Validar tamaño
        if (file.size > TAMANO_MAX) {
            mostrarError(`El archivo ${file.name} supera los ${TAMANO_MAX / 1024 / 1024} MB`);
            return false;
        }

        return true;
    });

    if (validos.length === 0) {
        mostrarError("No hay archivos válidos para subir");
        return;
    }

    // Subir archivos válidos
    subirArchivos(validos);
}


//Funcion para mostrar mensajes de error
function mostrarError(msg) {
    const div = document.createElement("div");
    div.className = "error-upload";
    div.textContent = msg;

    document.body.appendChild(div);

    setTimeout(() => div.remove(), 3000);
}


// Función de subida
function subirArchivos(archivos) {
    for (let archivo of archivos) {
        let formData = new FormData();
        formData.append("archivo", archivo);

        fetch('./../../../controller/processors/procSubirArchivo.php', {
            method: 'POST',
            body: formData
        })
            .then(res => res.json())
            .then(data => {
                if (data.error) {
                    alert("Error: " + data.error);
                } else {
                    cargarArchivos();
                }
            });
    }
}


// Cargar archivos del usuario
function cargarArchivos() {

    const orden = document.getElementById("ordenar").value;

    fetch('./../../../controller/gets/getArchivosUsuario.php')
        .then(res => res.json())
        .then(data => {
            const grid = document.getElementById("files-grid");
            grid.innerHTML = "";

            //Ordenación según la opción elegida en el DOM
            if (orden === "nombre") data.sort((a, b) => a.nombre_original.localeCompare(b.nombre_original));
            if (orden === "tamano") data.sort((a, b) => a.tamano - b.tamano);
            if (orden === "fecha") data.sort((a, b) => new Date(b.fecha_subida) - new Date(a.fecha_subida));

            data.forEach(file => {
                let preview = "";

                if (file.tipo && file.tipo.startsWith("image")) {
                    preview = `<img src="./../../../controller/gets/getArchivoVisual.php?id=${file.id}">`;
                } else if (file.tipo && file.tipo.startsWith("video")) {
                    preview = `
                        <video controls>
                            <source src="./../../../controller/gets/getArchivoVisual.php?id=${file.id}">
                        </video>`;
                } else {
                    preview = `<div class="file-icon">📄</div>`;
                }

                grid.innerHTML += `
                    <div class="file-card">
                        ${preview}
                        <p>${file.nombre_original}</p>
                        <p class="file-meta">
                            ${(file.tamano / 1024 / 1024).toFixed(2)} MB<br>
                            ${new Date(file.fecha_subida).toLocaleString()}
                        </p>
                        <div class="file-actions">
                            <a href="/controller/processors/procDescargaArchivos.php?id=${file.id}" class="file-btn">Descargar</a>
                            <a href="#" onclick="borrarArchivo(${file.id})" class="file-btn delete">Borrar</a>

                            ${file.compartido == 1
                                ? `<button class="file-btn unshare" onclick="descompartirArchivo(${file.id})">Dejar de compartir</button>`
                                : `<button class="file-btn share" onclick="compartirArchivo(${file.id})">Compartir</button>`
                            }
                        </div>
                    </div>
                `;

            });
        });
}
