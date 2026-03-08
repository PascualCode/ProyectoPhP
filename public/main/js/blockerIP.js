function bloquearIP(id, usuario) {
    if (!confirm(`¿Bloquear acceso a ${usuario}?`)) return;

    fetch("./../../../controller/processors/procBlocker.php", {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: `usuario_id=${id}`
    })
    .then(res => res.text())
    .then(msg => {
        alert("IP bloqueada correctamente");
        cargarUsuarios();
    });
}

