function borrarArchivo(id) {
    if (!confirm("¿Seguro que quieres borrar este archivo?")) return;

    fetch('./../../../controller/processors/procBorrarArchivo.php', {
        method: 'POST',
        body: new URLSearchParams({ id })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            cargarArchivos();
        } else {
            alert("Error: " + data.error);
        }
    });
}
