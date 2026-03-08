function cargarCompartidos() {
    fetch('./../../../controller/gets/getArchivosCompartidos.php')
        .then(r => r.json())
        .then(data => {
            const zona = document.getElementById("zonaCompartidos");
            zona.innerHTML = "";

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

                zona.innerHTML += `
                    <div class="file-card">
                        ${preview}
                        <p>${file.nombre_original}</p>
                        <p class="file-meta">
                            Compartido por: <strong>${file.nombre_usuario}</strong><br>
                            ${(file.tamano / 1024 / 1024).toFixed(2)} MB<br>
                            ${new Date(file.fecha_subida).toLocaleString()}
                        </p>
                        <div class="file-actions">
                            <a href="/controller/processors/procDescargaArchivos.php?id=${file.id}" class="file-btn">Descargar</a>
                        </div>
                    </div>
                `;
            });
        });
}
