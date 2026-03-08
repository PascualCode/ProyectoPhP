async function cargarAccesosFallidos() {
    try {
        const response = await fetch("./../../../controller/gets/getAccesosFallidos.php", {
            cache: "no-store" // evita datos antiguos
        });

        if (!response.ok) {
            throw new Error(`Error HTTP: ${response.status}`);
        }

        const data = await response.json();

        const tbody = document.getElementById('tabla-fallidos');
        if (!tbody) {
            console.error("No se encontró el elemento #tabla-fallidos");
            return;
        }

        tbody.innerHTML = '';

        data.forEach(f => {
            const fila = `
                <tr>
                    <td>${f.usuario_introducido}</td>
                    <td>${f.ip}</td>
                    <td>${f.fecha}</td>
                    <td>${f.motivo}</td>
                </tr>
            `;
            tbody.innerHTML += fila;
        });

    } catch (error) {
        console.error("Error cargando accesos fallidos:", error);
    }
}

document.addEventListener("DOMContentLoaded", () => {
    cargarAccesosFallidos();
    setInterval(cargarAccesosFallidos, 5000);
});
