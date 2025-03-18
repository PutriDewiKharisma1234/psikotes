<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan & Statistik</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FFF7DC;
            text-align: center;
        }
        .container {
            width: 80%;
            margin: auto;
        }
        canvas {
            background: white;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Laporan & Statistik Tes Psikotes</h2>
        <p>Total Pengguna yang Telah Mengikuti Tes: <strong>{{ $totalTes }}</strong></p>

        <h3>Distribusi MBTI</h3>
        <canvas id="mbtiChart"></canvas>

        <h3>Persentase Hasil Big Five</h3>
        <canvas id="bigFiveChart"></canvas>
    </div>

    <script>
        // Data MBTI
        const mbtiData = @json($mbtiData);
        const mbtiLabels = Object.keys(mbtiData);
        const mbtiValues = Object.values(mbtiData);

        const ctx1 = document.getElementById('mbtiChart').getContext('2d');
        new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: mbtiLabels,
                datasets: [{
                    label: 'Jumlah Peserta',
                    data: mbtiValues,
                    backgroundColor: '#C2A883'
                }]
            }
        });

        // Data Big Five
        const bigFiveData = @json($bigFiveData);
        const bigFiveLabels = Object.keys(bigFiveData);
        const bigFiveValues = Object.values(bigFiveData);

        const ctx2 = document.getElementById('bigFiveChart').getContext('2d');
        new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: bigFiveLabels,
                datasets: [{
                    data: bigFiveValues,
                    backgroundColor: ['#FF5733', '#33FF57', '#337BFF', '#F3FF33', '#FF33E3']
                }]
            }
        });
    </script>
</body>
</html>
