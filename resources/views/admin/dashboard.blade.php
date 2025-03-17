<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: #4CAF50;
            color: white;
            padding-top: 20px;
            position: fixed;
            height: 100%;
        }

        .sidebar a {
            padding: 15px 20px;
            text-decoration: none;
            color: white;
            display: block;
        }

        .sidebar a:hover {
            background-color: #45a049;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            background-color: #f5f5f5;
            width: 100%;
        }

        h1 {
            margin-bottom: 20px;
        }

        .card {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

    </style>
</head>
<body>
    <div class="sidebar">
        <h2 style="text-align: center;">Admin Panel</h2>
        <a href="#dashboard">Dashboard</a>
        <a href="#pengguna">Kelola Pengguna</a>
        <a href="#soal">Kelola Soal</a>
        <a href="#hasil">Hasil Tes</a>
        <a href="#logout">Keluar</a>
    </div>

    <div class="content">
        <h1>Dashboard Admin</h1>

        <div class="dashboard-grid">
            <div class="card">
                <h3>Total Pengguna</h3>
                <p>150</p>
            </div>

            <div class="card">
                <h3>Total Soal Psikotes</h3>
                <p>80 Soal</p>
            </div>

            <div class="card">
                <h3>Hasil Tes Terbaru</h3>
                <p>12 Hasil Tes Baru</p>
            </div>
        </div>
    </div>

</body>
</html>
