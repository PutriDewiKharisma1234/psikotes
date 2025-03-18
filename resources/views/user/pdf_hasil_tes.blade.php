<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Tes Psikologi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 20px;
        }
        .container {
            width: 100%;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
        }
        h2 {
            color: #C2A883;
        }
        .saran {
            background-color: #F3E8D0;
            padding: 15px;
            border-radius: 10px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Hasil Tes Psikologi</h2>
        <p><strong>Nama:</strong> {{ $hasil->user->nama }}</p>
        <p><strong>Jenis Tes:</strong> {{ $hasil->jenis_tes }}</p>
        <p><strong>Hasil:</strong> {{ $hasil->hasil }}</p>
        <p><strong>Tanggal Tes:</strong> {{ $hasil->created_at->format('d M Y') }}</p>

        @if ($saranKarir)
        <div class="saran">
            <h3>Saran Karir:</h3>
            <p>{{ $saranKarir->saran }}</p>
        </div>
        @else
        <p><em>Belum ada saran karir untuk hasil ini.</em></p>
        @endif
    </div>
</body>
</html>
