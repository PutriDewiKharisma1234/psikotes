<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <style>
        /* Warna Latar */
        body {
            background-color: #fff8dc;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #d1b58d;
            color: white;
            position: fixed;
        }

        .sidebar h4 {
            text-align: center;
            padding: 20px 0;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 15px 20px;
            margin-bottom: 5px;
            transition: 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #c4a484;
        }

        /* Content */
        .content {
            margin-left: 250px;
            padding: 20px;
        }

        .header {
            background-color: #d1b58d;
            padding: 15px;
            color: white;
            border-radius: 10px;
            text-align: center;
        }

        /* Card */
        .card {
            background-color: #f9f1e7;
            padding: 20px;
            margin: 10px 0;
            border-radius: 15px;
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* Grid */
        .row {
            display: flex;
            justify-content: space-around;
        }

        .col {
            width: 30%;
        }

        /* Tombol Logout */
        .logout {
            background-color: #c4a484;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            text-align: center;
        }

        .logout:hover {
            background-color: #b19068;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h4>Admin Panel</h4>
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="/admin/users">Data Pengguna</a>
        <a href="/admin/psikotes">Data Psikotes</a>
        <a href="/admin/mbti">Soal MBTI</a> 
        <a href="/admin/bigfive">Soal Big Five</a>
        <a href="#" onclick="document.getElementById('logout-form').submit();">Logout</a>

        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>

    <!-- Content -->
    <div class="content">
        <div class="header">
            <h2>Selamat Datang, Admin!</h2>
        </div>

        <!-- Dashboard Stats -->
        <div class="row">
            <div class="col">
                <div class="card">
                    <h3>Jumlah Pengguna</h3>
                    <p>120 User</p>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <h3>Jumlah Tes Psikotes</h3>
                    <p>45 Tes</p>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <h3>Hasil Tes</h3>
                    <p>85 Hasil</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
