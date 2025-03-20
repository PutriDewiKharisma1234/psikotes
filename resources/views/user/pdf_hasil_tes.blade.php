<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Tes Psikologi</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; padding: 20px; }
        .container { width: 100%; padding: 20px; border: 1px solid #ddd; border-radius: 10px; }
        h2 { color: #C2A883; }
        .saran, .deskripsi {
            background-color: #F3E8D0; padding: 15px; border-radius: 10px; margin-top: 20px;
        }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Hasil Tes Psikologi</h2>
        <p><strong>Nama:</strong> {{ $hasil->user->nama }}</p>
        <p><strong>Jenis Tes:</strong> {{ $hasil->jenis_tes }}</p>
        <p><strong>Tanggal Tes:</strong> {{ $hasil->created_at->format('d M Y') }}</p>

        @if ($hasil->jenis_tes == 'MBTI')
            <p><strong>Hasil MBTI:</strong> {{ $hasil->hasil }}</p>
            <div class="deskripsi">
                <h3>Deskripsi Kepribadian</h3>
                <p>{{ $deskripsi }}</p>
            </div>
        @elseif ($hasil->jenis_tes == 'Big Five')
            <h3>Hasil Big Five</h3>
            <table>
                <tr>
                    <th>Dimensi</th>
                    <th>Skor (1-7)</th>
                    <th>Interpretasi</th>
                </tr>
                @foreach ($hasil->big_five as $dimensi => $nilai)
                    @php
                        // Konversi skor ke skala Likert 1-7
                        $skala_likert = round(($nilai / 100) * 6) + 1;
                        $interpretasi = match($skala_likert) {
                            1 => "Sangat Rendah",
                            2 => "Rendah",
                            3 => "Agak Rendah",
                            4 => "Sedang",
                            5 => "Agak Tinggi",
                            6 => "Tinggi",
                            default => "Sangat Tinggi"
                        };
                    @endphp
                    <tr>
                        <td><strong>{{ $dimensi }}</strong></td>
                        <td>{{ $skala_likert }}</td>
                        <td>{{ $interpretasi }}</td>
                    </tr>
                @endforeach
            </table>

            <div class="deskripsi">
                <h3>Interpretasi Hasil</h3>
                <p>
                    @php
                        $openness = round(($hasil->big_five['Openness'] ?? 0) / 100 * 6) + 1;
                        $conscientiousness = round(($hasil->big_five['Conscientiousness'] ?? 0) / 100 * 6) + 1;
                        $extraversion = round(($hasil->big_five['Extraversion'] ?? 0) / 100 * 6) + 1;
                        $agreeableness = round(($hasil->big_five['Agreeableness'] ?? 0) / 100 * 6) + 1;
                        $neuroticism = round(($hasil->big_five['Neuroticism'] ?? 0) / 100 * 6) + 1;

                        if ($openness > 5 && $extraversion > 5) {
                            echo "Anda sangat kreatif dan suka bertemu orang baru.";
                        } elseif ($conscientiousness > 5 && $agreeableness > 5) {
                            echo "Anda bertanggung jawab dan peduli dengan orang lain.";
                        } elseif ($neuroticism > 5) {
                            echo "Anda memiliki sensitivitas emosional tinggi.";
                        } elseif ($extraversion > 5) {
                            echo "Anda sangat sosial dan menikmati interaksi dengan orang lain.";
                        } elseif ($openness < 3 && $conscientiousness < 3) {
                            echo "Anda lebih suka kenyamanan dan rutinitas.";
                        } else {
                            echo "Hasil Anda menunjukkan kombinasi kepribadian yang unik.";
                        }
                    @endphp
                </p>
            </div>
        @endif

        @if ($saranKarir)
            <div class="saran">
                <h3>Saran Karir</h3>
                <p>{{ $saranKarir->saran }}</p>
            </div>
        @else
            <p><em>Belum ada saran karir untuk hasil ini.</em></p>
        @endif
    </div>
</body>
</html>
