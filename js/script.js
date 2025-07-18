fetch('api/traffic_per_hour.php')
  .then(res => res.json())
  .then(data => {
    const labels = data.map(d => d.hour + ":00");
    const rx = data.map(d => (d.total_rx / 1024 / 1024).toFixed(2));
    const tx = data.map(d => (d.total_tx / 1024 / 1024).toFixed(2));

    new Chart(document.getElementById('peakChart'), {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [
          {
            label: 'Download (Mbps)',
            data: rx,
            backgroundColor: '#42a5f5'
          },
          {
            label: 'Upload (Mbps)',
            data: tx,
            backgroundColor: '#66bb6a'
          }
        ]
      },
      options: {
        responsive: true,
        plugins: {
          title: {
            display: true,
            text: 'Trafik per Jam Hari Ini'
          }
        }
      }
    });
  });