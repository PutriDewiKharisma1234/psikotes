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
        .hasil-mbti {
            font-size: 24px;
            font-weight: bold;
            color: #A0764B;
        }
        .deskripsi {
            background-color: #F3E8D0;
            padding: 15px;
            border-radius: 10px;
            margin-top: 20px;
            text-align: left;
        }
        .saran {
            background-color: #F3E8D0;
            padding: 15px;
            border-radius: 10px;
            margin-top: 20px;
        }
        .btn-download, .btn-kembali {
            display: inline-block;
            background-color: #C2A883;
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            margin-top: 20px;
        }
        .btn-download:hover, .btn-kembali:hover {
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
            <p><strong>Hasil MBTI:</strong> <span class="hasil-mbti">{{ $hasil->hasil }}</span></p>
            
            <!-- Deskripsi Kepribadian MBTI -->
            <div class="deskripsi">
                <h3>Deskripsi Kepribadian</h3>
                @switch($hasil->hasil)
                    @case('ISTJ')
                        <p><strong>ISTJ - Si Logis</strong>: Teliti, bertanggung jawab, dan sangat menghargai tradisi serta keteraturan. Cocok dalam pekerjaan yang memerlukan ketelitian tinggi.</p>
                        @break
                    @case('ISFJ')
                        <p><strong>ISFJ - Si Pelindung</strong>: Setia, perhatian, dan peduli terhadap orang lain. Sangat cocok dalam pekerjaan sosial atau medis.</p>
                        @break
                    @case('INFJ')
                        <p><strong>INFJ - Si Advokat</strong>: Visioner, idealis, dan penuh empati. Cocok dalam bidang konseling, psikologi, atau kepemimpinan.</p>
                        @break
                    @case('INTJ')
                        <p><strong>INTJ - Si Arsitek</strong>: Pemikir strategis dan sangat mandiri. Cocok dalam bidang teknologi, sains, atau manajemen.</p>
                        @break
                    @case('ISTP')
                        <p><strong>ISTP - Si Mekanik</strong>: Praktis, logis, dan suka memecahkan masalah teknis. Cocok dalam bidang teknik atau investigasi.</p>
                        @break
                    @case('ISFP')
                        <p><strong>ISFP - Si Seniman</strong>: Kreatif, fleksibel, dan menikmati keindahan. Cocok dalam bidang seni, desain, atau musik.</p>
                        @break
                    @case('INFP')
                        <p><strong>INFP - Si Mediator</strong>: Idealistis, penuh perasaan, dan selalu mencari makna dalam kehidupan. Cocok dalam bidang sastra, seni, atau psikologi.</p>
                        @break
                    @case('INTP')
                        <p><strong>INTP - Si Pemikir</strong>: Analitis, logis, dan suka mengeksplorasi konsep baru. Cocok dalam bidang penelitian atau IT.</p>
                        @break
                    @default
                        <p>Deskripsi untuk tipe kepribadian ini belum tersedia.</p>
                @endswitch
            </div>

            
        @elseif ($hasil->jenis_tes == 'Big Five')
            <p><strong>Hasil Big Five:</strong></p>
            <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse; text-align: center;">
                <tr>
                    <th>Dimensi</th>
                    <th>Skor (1-7)</th>
                    <th>Interpretasi</th>
                </tr>
                @foreach ($hasil->big_five as $dimensi => $nilai)
                    @php
                        // Konversi skor dari persentase ke skala Likert (1-7)
                        $skala_likert = round(($nilai / 100) * 6) + 1;

                        // Interpretasi hasil berdasarkan skala Likert
                        $interpretasi = "";
                        if ($skala_likert == 1) {
                            $interpretasi = "Sangat Rendah";
                        } elseif ($skala_likert == 2) {
                            $interpretasi = "Rendah";
                        } elseif ($skala_likert == 3) {
                            $interpretasi = "Agak Rendah";
                        } elseif ($skala_likert == 4) {
                            $interpretasi = "Sedang";
                        } elseif ($skala_likert == 5) {
                            $interpretasi = "Agak Tinggi";
                        } elseif ($skala_likert == 6) {
                            $interpretasi = "Tinggi";
                        } else {
                            $interpretasi = "Sangat Tinggi";
                        }
                    @endphp
                    <tr>
                        <td><strong>{{ $dimensi }}</strong></td>
                        <td>{{ $skala_likert }}</td>
                        <td>{{ $interpretasi }}</td>
                    </tr>
                @endforeach
            </table>

            <!-- Interpretasi Hasil Big Five -->
            <div class="deskripsi">
                <h3>Interpretasi Hasil</h3>
                <p>
                    @php
                        $openness = $hasil->big_five['Openness'] ?? 0;
                        $conscientiousness = $hasil->big_five['Conscientiousness'] ?? 0;
                        $extraversion = $hasil->big_five['Extraversion'] ?? 0;
                        $agreeableness = $hasil->big_five['Agreeableness'] ?? 0;
                        $neuroticism = $hasil->big_five['Neuroticism'] ?? 0;

                        // Konversi skor ke skala Likert
                        $openness = round(($openness / 100) * 6) + 1;
                        $conscientiousness = round(($conscientiousness / 100) * 6) + 1;
                        $extraversion = round(($extraversion / 100) * 6) + 1;
                        $agreeableness = round(($agreeableness / 100) * 6) + 1;
                        $neuroticism = round(($neuroticism / 100) * 6) + 1;

                        if ($openness > 5 && $extraversion > 5) {
                            echo "Anda adalah individu yang sangat kreatif dan suka bertemu orang baru. Anda menikmati pengalaman baru dan suka mengeksplorasi ide-ide unik.";
                        } elseif ($conscientiousness > 5 && $agreeableness > 5) {
                            echo "Anda adalah pribadi yang bertanggung jawab dan suka membantu orang lain. Anda cenderung disiplin dan sangat peduli terhadap hubungan sosial.";
                        } elseif ($neuroticism > 5) {
                            echo "Anda memiliki sensitivitas emosional yang tinggi. Anda cenderung mudah cemas dan lebih rentan terhadap stres, tetapi juga memiliki empati yang mendalam.";
                        } elseif ($extraversion > 5) {
                            echo "Anda sangat sosial dan menikmati interaksi dengan banyak orang. Anda memiliki energi tinggi dan mudah beradaptasi dengan lingkungan sosial baru.";
                        } elseif ($openness < 3 && $conscientiousness < 3) {
                            echo "Anda lebih suka kenyamanan dan rutinitas dibandingkan dengan perubahan atau tantangan baru. Anda cenderung lebih santai dalam menjalani hidup.";
                        } else {
                            echo "Hasil Anda menunjukkan kombinasi karakteristik yang unik. Anda memiliki keseimbangan dalam berbagai aspek kepribadian Anda.";
                        }
                    @endphp
                </p>
            </div>
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
        <a href="/dashboard" class="btn-kembali">Kembali ke Dashboard</a>
    </div>
</body>
</html>
