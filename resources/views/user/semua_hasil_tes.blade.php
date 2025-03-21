<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Tes</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #FFF7DC; text-align: center; padding: 20px; }
        .container { width: 80%; margin: auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1); }
        h2 { color: #C2A883; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: center; }
        th { background-color: #D5C7A3; color: white; }
        .btn-detail { background-color: #C2A883; color: white; padding: 8px 15px; border-radius: 5px; text-decoration: none; }
        .btn-detail:hover { background-color: #A0764B; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Hasil Tes Anda</h2>

        @if(session('error'))
            <p style="color: red;">{{ session('error') }}</p>
        @endif

        <table>
            <tr>
                <th>No</th>
                <th>Jenis Tes</th>
                <th>Hasil</th>
                <th>Tanggal Tes</th>
                <th>Aksi</th>
            </tr>
            @foreach ($hasilTes as $index => $hasil)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $hasil->jenis_tes }}</td>
                <td>
                    @if ($hasil->jenis_tes === 'MBTI')
                        {{ $hasil->hasil }}
                    @elseif ($hasil->jenis_tes === 'Big Five')
                        @php
                            $bigFiveScores = json_decode($hasil->hasil, true);
                            // Ambil dimensi dengan skor tertinggi
                            $dimensiTertinggi = array_keys($bigFiveScores, max($bigFiveScores))[0];
                        @endphp
                        {{ $dimensiTertinggi }} ({{ max($bigFiveScores) }}%)
                    @endif
                </td>
            <td>{{ $hasil->created_at->format('d M Y') }}</td>
                <td>
                    <a href="{{ route('hasil.tes', ['id' => $hasil->id]) }}" class="btn-detail">Lihat Detail</a>
                </td>
            </tr>
            @endforeach
        </table>

        <br>
        <a href="/dashboard" class="btn-detail">Kembali ke Dashboard</a>
    </div>
</body>
</html>
