<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Tes & Saran Karir</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FFF7DC;
            text-align: center;
            padding: 20px;
        }
        .container {
            width: 50%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
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
        .btn-download {
            display: inline-block;
            background-color: #C2A883;
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            margin-top: 20px;
        }
        .btn-download:hover {
            background-color: #A0764B;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Hasil Tes Psikotes</h2>
        <p><strong>Nama:</strong> {{ $hasil->user->nama }}</p>
        <p><strong>Jenis Tes:</strong> {{ $hasil->jenis_tes }}</p>

        @if ($hasil->jenis_tes == 'MBTI')
            <p><strong>Hasil MBTI:</strong> {{ $hasil->hasil }}</p>
            
        @elseif ($hasil->jenis_tes == 'Big Five')
            <p><strong>Hasil Big Five:</strong></p>
            <ul>
                @foreach ($hasil->big_five as $dimensi => $nilai)
                    <li><strong>{{ $dimensi }}</strong>: {{ $nilai }}%</li>
                @endforeach
            </ul>
        @endif

        <p><strong>Tanggal Tes:</strong> {{ $hasil->created_at->format('d M Y') }}</p>

        @if ($saranKarir)
        <div class="saran">
            <h3>Saran Karir:</h3>
            <p>{{ $saranKarir->saran }}</p>
        </div>
        @else
        <p><em>Belum ada saran karir untuk hasil ini.</em></p>
        @endif

        <a href="{{ route('hasil.tes.pdf', $hasil->id) }}" class="btn-download">Unduh PDF</a>
        <a href="/dashboard">Kembali ke Dashboard</a>
    </div>

</body>
</html>
