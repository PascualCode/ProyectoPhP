function compartirArchivo(id) {
    fetch('/controller/processors/procCompartirArch.php', {
        method: 'POST',
        body: new URLSearchParams({ id })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            cargarArchivos();
            cargarCompartidos();
        }
    });
}

function descompartirArchivo(id) {
    fetch('/controller/processors/procDescompartirArch.php', {
        method: 'POST',
        body: new URLSearchParams({ id })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            cargarArchivos();
            cargarCompartidos();
        }
    });
}
