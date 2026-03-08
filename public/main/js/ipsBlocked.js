function cargarIPs() {
    fetch('./../../../controller/gets/getIPsBloqueadas.php')
        .then(res => res.json())
        .then(data => {
            const tbody = document.getElementById('ips-body');
            tbody.innerHTML = '';

            data.forEach(ip => {
                tbody.innerHTML += `
                    <tr>
                        <td>${ip.id}</td>
                        <td>${ip.ip}</td>
                        <td>${ip.motivo}</td>
                        <td>${ip.fecha}</td>
                        <td>${ip.bloqueada_por}</td>
                    </tr>
                `;
            });
        });
}
setInterval(cargarIPs, 2000);
cargarIPs();