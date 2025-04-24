<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Psikotes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #FFF0BD;
        }

        .navbar {
            display: flex; 
            justify-content: space-between;
            padding: 20px 50px;
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
        }

        .text-content {
            max-width: 40%;
        }

        .text-content h1 {
            font-size: 36px;
            color: #333;
        }

        .text-content p {
            font-size: 16px;
            color: #555;
            line-height: 1.5;
        }

        .slider {
            max-width: 600px; /* Ukuran gambar lebih besar */
            margin-left: 50px;
            overflow: hidden;
        }

        .slider img {
            width: 100%; 
            height: auto; 
            border-radius: 10px;
            display: none;
        }

        .slider img.active {
            display: block;
        }

    </style>
</head>
<body>
    <div class="navbar">
        <div class="logo">PSIKOTESKU</div>
        <div>
            <a href="/daftar">Daftar</a>
            <a href="/masuk">Masuk</a>
            <a href="/metode">Metode Tes</a>
        </div>
    </div>

    <div class="container">
        <div class="text-content">
            <h1>Selamat Datang di Aplikasi Psikotes MBTI & Big Five</h1>
            <p>"Kenali diri Anda lebih dalam melalui Tes Psikologi yang akurat dan terpercaya untuk memahami kepribadian Anda."</p>
        </div>

        <div class="slider">
            <img src="{{ asset('images/dashboard.jpeg') }}" alt="Gambar 1" class="active">
            <img src="{{ asset('images/beranda.jpeg') }}" alt="Gambar 2">
        </div>
    </div>

    <script>
        const images = document.querySelectorAll('.slider img');
        let currentIndex = 0;

        setInterval(() => {
            images[currentIndex].classList.remove('active');
            currentIndex = (currentIndex + 1) % images.length;
            images[currentIndex].classList.add('active');
        }, 3000); // Gambar berganti setiap 3 detik
    </script>
</body>
</html>
