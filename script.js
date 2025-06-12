function fetchSpeed() {
    fetch('api/mikrotik.php')
        .then(response => response.json())
        .then(data => {
            if (!data.error) {
                document.getElementById('rx-speed').innerText = data.rx;
                document.getElementById('tx-speed').innerText = data.tx;
                document.getElementById('total-usage').innerText = data.total_usage;
            } else {
                document.getElementById('rx-speed').innerText = 'Error';
                document.getElementById('tx-speed').innerText = 'Error';
                document.getElementById('total-usage').innerText = 'Error';
            }
        });
}

function loadChart() {
    fetch('api/usage_chart.php')
        .then(response => response.json())
        .then(data => {
            const ctx = document.getElementById('usageChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [...Array(24).keys()].map(h => `${h}:00`),
                    datasets: [{
                        label: 'Data Terpakai (MB)',
                        data: data,
                        backgroundColor: 'rgba(33, 150, 243, 0.6)',
                        borderColor: 'rgba(33, 150, 243, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return value + ' MB';
                                }
                            }
                        }
                    }
                }
            });
        });
}

setInterval(fetchSpeed, 2000);
fetchSpeed();
loadChart();
