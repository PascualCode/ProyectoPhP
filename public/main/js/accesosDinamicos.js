async function cargarAccesos() {
    try {
        const response = await fetch("./../../../controller/gets/getAccess.php", {
            cache: "no-store" // evita datos antiguos
        });

        if (!response.ok) {
            throw new Error(`Error HTTP: ${response.status}`);
        }

        const data = await response.json();

        const tbody = document.getElementById('tabla-accesos');
        if (!tbody) {
            console.error("No se encontró el elemento #tabla-accesos");
            return;
        }

        tbody.innerHTML = '';

        data.forEach(acc => {
            const fila = `
                <tr>
                    <td>${acc.id}</td>
                    <td>${acc.usuario}</td>
                    <td>${acc.ip}</td>
                    <td>${acc.fecha}</td>
                </tr>
            `;
            tbody.innerHTML += fila;
        });

    } catch (error) {
        console.error("Error cargando accesos:", error);
    }
}

document.addEventListener("DOMContentLoaded", () => {
    cargarAccesos();
    setInterval(cargarAccesos, 5000);
});
