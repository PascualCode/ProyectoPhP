function borrarUsuario(id) {
    if (!confirm("¿Seguro que quieres borrar este usuario?")) return;

    fetch("./../../../controller/processors/procDeleteUser.php", {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: `id=${id}`
    })
    .then(res => res.text())
    .then(msg => {
        alert("Usuario borrado");
        cargarUsuarios();
    });
}

