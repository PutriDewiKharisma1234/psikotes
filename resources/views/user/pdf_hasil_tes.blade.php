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

        <!-- Menampilkan Hasil MBTI atau Big Five -->
        @if ($hasil->jenis_tes == 'MBTI')
            <p><strong>Hasil MBTI:</strong> {{ $hasil->hasil }}</p>
            <p><strong>Deskripsi:</strong> {{ $hasil->deskripsi }}</p>
        @elseif ($hasil->jenis_tes == 'Big Five')
            <p><strong>Hasil Big Five:</strong></p>
            <ul>
                @foreach ($hasil->big_five as $dimensi => $nilai)
                    <li><strong>{{ $dimensi }}</strong>: {{ $nilai }}%</li>
                @endforeach
            </ul>
        @endif

        <p><strong>Tanggal Tes:</strong> {{ $hasil->created_at->format('d M Y') }}</p>

        <!-- Menampilkan Saran Karir Jika Ada -->
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
