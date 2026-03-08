function desbloquearIP(ip, usuario) {
    if (!confirm(`¿Desbloquear la IP de ${usuario}?`)) return;

    fetch('./../../../controller/processors/procUnBlocker.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: `ip=${ip}`
    })
    .then(res => res.text())
    .then(msg => {
        alert("IP desbloqueada correctamente");
        cargarUsuarios();
    });
}
