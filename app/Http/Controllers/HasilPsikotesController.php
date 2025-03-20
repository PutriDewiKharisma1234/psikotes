<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HasilPsikotes;
use App\Models\SaranKarir;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class HasilPsikotesController extends Controller
{
    // Menampilkan hasil tes pengguna
    public function show($id)
    {
        $hasil = HasilPsikotes::with('user')->findOrFail($id);

        if (!$hasil) {
            return redirect('/dashboard')->with('error', 'Hasil tes tidak ditemukan.');
        }

        $saranKarir = null;
        $dimensiTertinggi = null;

        if ($hasil->jenis_tes == 'MBTI') {
            // 🔹 Cari saran karir berdasarkan hasil MBTI
            $saranKarir = SaranKarir::where('tipe_kepribadian', $hasil->hasil)->first();

        } elseif ($hasil->jenis_tes == 'Big Five') {
            // 🔹 Konversi hasil dari JSON ke array
            $hasil->big_five = json_decode($hasil->hasil, true);

            // if (!empty($hasil->big_five)) {
            //     // 🔹 Ambil nilai tertinggi
            //     $nilaiTertinggi = max($hasil->big_five);
            //     $dimensiTertinggiArray = array_keys($hasil->big_five, $nilaiTertinggi);

            //     // 🔹 Pilih 1 dimensi jika ada lebih dari 1 (pakai random atau ambil yang pertama)
            //     $dimensiTertinggi = $dimensiTertinggiArray[0] ?? null;

            //     // 🔹 Cari saran karir berdasarkan dimensi tertinggi
            //     if ($dimensiTertinggi) {
            //         $saranKarir = SaranKarir::where('tipe_kepribadian', $dimensiTertinggi)->first();
            //     }
            // }
        }

        return view('user.hasil_tes', compact('hasil', 'saranKarir', 'dimensiTertinggi'));
    }

 
    // Simpan hasil tes ke database
    public function simpanHasil(Request $request)
    {
        $hasil = new HasilPsikotes();
        $hasil->user_id = auth()->id();
        $hasil->jenis_tes = 'MBTI';
        $hasil->hasil = strtoupper($request->hasil);
        $hasil->save();

        // Cari saran karir berdasarkan hasil MBTI
        $saran = SaranKarir::where('tipe_kepribadian', $request->hasil_mbti)->first();

        if ($saran) {
            $saran->hasil_psikotes_id = $hasil->id;
            $saran->save();
        }

        return redirect()->route('hasil.tes', $hasil->id);
    }

    // Generate PDF hasil tes
    public function downloadPDF($id)
    {
        // Ambil data hasil tes berdasarkan ID
        $hasil = HasilPsikotes::with('user')->findOrFail($id);

        // Pastikan hasil Big Five didekode dari JSON ke array
        if ($hasil->jenis_tes == 'Big Five') {
            $hasil->big_five = json_decode($hasil->hasil, true);
        }

        // Menentukan deskripsi berdasarkan hasil MBTI
        $deskripsi = ($hasil->jenis_tes == 'MBTI') ? $this->getDeskripsiMBTI($hasil->hasil) : null;

        // Ambil saran karir berdasarkan jenis tes
        if ($hasil->jenis_tes == 'MBTI') {
            $saranKarir = SaranKarir::where('tipe_kepribadian', $hasil->hasil)->first();
        } elseif ($hasil->jenis_tes == 'Big Five') {
            // Ambil dimensi dengan skor tertinggi untuk menentukan saran karir
            $dimensiTertinggi = array_keys($hasil->big_five, max($hasil->big_five))[0];
            $saranKarir = SaranKarir::where('tipe_kepribadian', $dimensiTertinggi)->first();
        } else {
            $saranKarir = null;
        }

        // Debugging: Cek apakah data telah dikirim dengan benar
        \Log::info('Data PDF:', [
            'jenis_tes' => $hasil->jenis_tes,
            'big_five' => $hasil->big_five ?? null,
            'saranKarir' => $saranKarir
        ]);

        // Generate PDF dengan data yang sudah diperbaiki
        $pdf = Pdf::loadView('user.pdf_hasil_tes', compact('hasil', 'deskripsi', 'saranKarir'));

        return $pdf->download('Hasil_Tes_' . $hasil->user->nama . '.pdf');
    }

    // Fungsi untuk mendapatkan deskripsi MBTI berdasarkan tipe
    private function getDeskripsiMBTI($tipe)
    {
        $deskripsiMBTI = [
            'ISTJ' => 'Teliti, bertanggung jawab, dan menghargai aturan serta keteraturan.',
            'ISFJ' => 'Setia, peduli terhadap orang lain, dan suka membantu sesama.',
            'INFJ' => 'Visioner, idealis, dan sangat empati dalam memahami orang lain.',
            'INTJ' => 'Pemikir strategis yang mandiri dan cenderung bekerja dengan visi jangka panjang.',
            'ISTP' => 'Suka memecahkan masalah dengan cara praktis dan logis.',
            'ISFP' => 'Kreatif, fleksibel, dan menikmati seni serta keindahan.',
            'INFP' => 'Idealistis, penuh empati, dan selalu mencari makna dalam kehidupan.',
            'INTP' => 'Analitis, logis, dan suka mengeksplorasi konsep serta ide baru.',
            'ESTP' => 'Spontan, energik, dan suka mengambil risiko dalam tindakan.',
            'ESFP' => 'Ceria, ekspresif, dan suka bersosialisasi dengan banyak orang.',
            'ENFP' => 'Penuh energi, kreatif, dan senang mencari pengalaman baru.',
            'ENTP' => 'Penuh ide, suka berargumen, dan berpikir di luar kebiasaan.',
            'ESTJ' => 'Tegas, terorganisir, dan menyukai kepemimpinan yang jelas.',
            'ESFJ' => 'Ramah, perhatian, dan suka membantu serta mendukung orang lain.',
            'ENFJ' => 'Karismatik, peduli, dan menginspirasi orang-orang di sekitarnya.',
            'ENTJ' => 'Percaya diri, berorientasi pada tujuan, dan pemimpin yang tegas.'
        ];

        return $deskripsiMBTI[$tipe] ?? 'Deskripsi untuk tipe ini belum tersedia.';
    }
 

}
