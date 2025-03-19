<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengguna</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #FFF7DC;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            padding: 15px 50px;
            background-color: #D5C7A3;
            color: white;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh;
            text-align: center;
            flex-direction: column;
        }

        .content {
            max-width: 60%;
        }

        .content h1 {
            font-size: 36px;
            color: #333;
        }

        .content p {
            font-size: 18px;
            color: #555;
        }

        .btn {
            padding: 12px 25px;
            background-color: #C2A883;
            color: white;
            text-decoration: none;
            border-radius: 10px;
            margin: 10px;
            font-size: 16px;
            display: inline-block;
        }

        .btn:hover {
            background-color: #A0764B;
        }

        .images {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
        }

        .images img {
            width: 300px;
            height: auto;
            border-radius: 15px;
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.1);
        }

    </style>
</head>
<body>

    <div class="navbar">
        <div class="logo">PSIKOTESKU</div>
        <div>
            <a href="/user/profil">Profil</a>
            <a href="/user/tes_mbti">Tes MBTI</a>
            <a href="/user/tes-bigfive">Tes Big Five</a>
            <a href="/user/hasil-tes">Hasil Tes</a>
            <a href="/keluar">Logout</a>
        </div>
    </div>

    <div class="container">
        <div class="content">
            <h1>Selamat Datang di Dashboard Pengguna!</h1>
            <p>"Kenali kepribadianmu dan temukan jalur karirmu melalui psikotes ini."</p>
            <a href="/user/tes_mbti" class="btn">Mulai Tes MBTI</a>
            <a href="/user/tes-bigfive" class="btn">Mulai Tes Big Five</a>
        </div>

        <div class="images">
            <img src="{{ asset('images/beranda.jpeg') }}" alt="Tes Psikologi">
            <img src="{{ asset('images/dashboard.jpeg') }}" alt="MBTI & Big Five">
        </div>
    </div>

</body>
</html>
