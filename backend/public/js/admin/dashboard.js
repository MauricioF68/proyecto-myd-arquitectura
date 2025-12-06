document.addEventListener('DOMContentLoaded', () => {

    /**
     * Función para extraer datos de una tabla HTML para Chart.js
     * @param {string} tableId - El ID de la tabla de la que se extraerán los datos.
     * @returns {object} - Un objeto con 'labels' y 'data'.
     */
    const extractDataFromTable = (tableId) => {
        const table = document.getElementById(tableId);
       
        if (!table) return { labels: [], data: [] };

        const labels = [];
        const data = [];
        const rows = table.querySelectorAll('tbody tr');

        rows.forEach(row => {
            const cells = row.querySelectorAll('td');
            if (cells.length >= 2) {
                labels.push(cells[0].innerText);
                data.push(parseInt(cells[1].innerText, 10));
            }
        });

        return { labels, data };
    };
    

    // --- GRÁFICO 1: VISITAS POR MES ---

    const visitasMesData = extractDataFromTable('visitasMesTable');
    const ctxMes = document.getElementById('visitasMesChart');
    

    if (ctxMes && visitasMesData.labels.length > 0) {
        new Chart(ctxMes, {
            type: 'bar',
            data: {
                labels: visitasMesData.labels,
                datasets: [{    
                    label: 'Total de Visitas',
                    data: visitasMesData.data,
                    backgroundColor: 'rgba(10, 88, 167, 0.7)',
                    borderColor: 'rgba(10, 88, 167, 1)',
                    borderWidth: 1,
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { color: 'rgba(255,255,255,0.1)' }, ticks: { color: '#8a92a6' } },
                    x: { grid: { display: false }, ticks: { color: '#8a92a6' } }
                }
            }
        });
    }

    // --- GRÁFICO 2: VISITAS POR SEMANA ---
    const visitasSemanaData = extractDataFromTable('visitasSemanaTable');
    const ctxSemana = document.getElementById('visitasSemanaChart');

    if (ctxSemana && visitasSemanaData.labels.length > 0) {
        new Chart(ctxSemana, {
            type: 'line',
            data: {
                labels: visitasSemanaData.labels,
                datasets: [{
                    label: 'Total de Visitas',
                    data: visitasSemanaData.data,
                    backgroundColor: 'rgba(252, 163, 17, 0.2)',
                    borderColor: 'rgba(252, 163, 17, 1)',
                    borderWidth: 2,
                    pointBackgroundColor: 'rgba(252, 163, 17, 1)',
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { color: 'rgba(255,255,255,0.1)' }, ticks: { color: '#8a92a6' } },
                    x: { grid: { display: false }, ticks: { color: '#8a92a6' } }
                }
            }
        });
    }

});