function cargarUsuarios() {
    fetch("./../../../controller/gets/getUsuarios.php")
        .then(res => res.json())
        .then(data => {
            const tbody = document.getElementById('usuarios-body');
            tbody.innerHTML = '';

            data.forEach(u => {
                let accionHTML = "";
                if (!u.ip) {
                    // El usuario no tiene IP registrada
                    accionHTML = `<span style="color:gray">Sin IP</span>`;
                } else {
                    // El usuario tiene IP → decidir si mostrar Bloquear o Desbloquear
                    if (u.bloqueado == 1) {
                        accionHTML = `
                            <a href="#" onclick="desbloquearIP('${u.ip}', '${u.usuario}')" 
                            class="action-btn edit">
                            Desbloquear
                            </a>
                        `;
                    } else {
                        accionHTML = `
                            <a href="#" onclick="bloquearIP('${u.id}', '${u.usuario}')" 
                            class="action-btn danger">
                            Bloquear
                            </a>
                        `;
                    }
                }
                // Construcción final del <tr>
                tbody.innerHTML += `
                    <tr>
                        <td>${u.id}</td>
                        <td>${u.usuario}</td>
                        <td>${u.email}</td>
                        <td>${u.rol}</td>
                        <td>${u.creado_en}</td>
                        <td>
                            ${accionHTML}
                            <a href="#" onclick="borrarUsuario(${u.id})" 
                            class="action-btn danger">
                            Borrar
                            </a>
                        </td>
                    </tr>
                `;

            });
        });
}

// Recargar cada 5 segundos
setInterval(cargarUsuarios, 5000);
cargarUsuarios();

