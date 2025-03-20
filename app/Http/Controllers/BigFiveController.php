<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SoalBigFive;
use App\Models\HasilPsikotes;
use App\Models\SaranKarir;
use Illuminate\Support\Facades\Auth;

class BigFiveController extends Controller
{
    public function index()
    {
        $soal = SoalBigFive::all();
        return view('admin.bigfive.index', compact('soal'));
    }

    public function create()
    {
        return view('admin.bigfive.create');
    }

    public function store(Request $request)
    {
        SoalBigFive::create([
            'pertanyaan' => $request->pertanyaan,
            'dimensi' => $request->dimensi,
            'pilihan_a' => $request->pilihan_a,
            'pilihan_b' => $request->pilihan_b,
        ]);

        return redirect('/admin/bigfive')->with('success', 'Soal Big Five berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $soal = SoalBigFive::find($id);
        return view('admin.bigfive.edit', compact('soal'));
    }

    public function update(Request $request, $id)
    {
        $soal = SoalBigFive::find($id);
        $soal->update([
            'pertanyaan' => $request->pertanyaan,
            'dimensi' => $request->dimensi,
            'pilihan_a' => $request->pilihan_a,
            'pilihan_b' => $request->pilihan_b,
        ]);

        return redirect('/admin/bigfive')->with('success', 'Soal Big Five berhasil diperbarui!');
    }

    public function destroy($id)
    {
        SoalBigFive::destroy($id);
        return redirect('/admin/bigfive')->with('success', 'Soal Big Five berhasil dihapus!');
    }


    // Menampilkan halaman tes Big Five
    public function tesBigFive()
    {
        $soal = SoalBigFive::all();
        return view('user.tes_bigfive', compact('soal'));
    }

    // Memproses jawaban pengguna
    public function prosesTes(Request $request)
    {
        $jawaban = $request->input('jawaban', []);

        if (empty($jawaban)) {
            return redirect()->back()->with('error', 'Anda harus menjawab semua pertanyaan.');
        }

        // Inisialisasi skor Big Five
        $skor = [
            'Openness' => 0,
            'Conscientiousness' => 0,
            'Extraversion' => 0,
            'Agreeableness' => 0,
            'Neuroticism' => 0
        ];

        // Hitung jumlah pertanyaan per dimensi untuk normalisasi
        $jumlahPertanyaan = [
            'Openness' => 0,
            'Conscientiousness' => 0,
            'Extraversion' => 0,
            'Agreeableness' => 0,
            'Neuroticism' => 0
        ];

        foreach ($jawaban as $id => $pilihan) {
            $soal = SoalBigFive::find($id);

            if ($soal) {
                $dimensi = $soal->dimensi;
                $jumlahPertanyaan[$dimensi]++;

                // Reverse scoring jika ada
                if (isset($soal->reverse_scoring) && $soal->reverse_scoring) {
                    $skor[$dimensi] += ($pilihan == 'Setuju') ? 0 : 1;
                } else {
                    $skor[$dimensi] += ($pilihan == 'Setuju') ? 1 : 0;
                }
            }
        }

        // Normalisasi skor ke dalam persentase (0-100%)
        foreach ($skor as $dimensi => $nilai) {
            if ($jumlahPertanyaan[$dimensi] > 0) {
                $skor[$dimensi] = round(($nilai / $jumlahPertanyaan[$dimensi]) * 100, 2);
            }
        }

        // Simpan hasil ke database
        $hasil = HasilPsikotes::create([
            'user_id' => Auth::id(),
            'jenis_tes' => 'Big Five',
            'hasil' => json_encode($skor),
        ]);

        // Cari dimensi dengan skor tertinggi
        $dimensiTertinggi = array_keys($skor, max($skor))[0];

        // Cari saran karir berdasarkan dimensi tertinggi
        $saranKarir = SaranKarir::where('tipe_kepribadian', $dimensiTertinggi)->first();

        if ($saranKarir) {
            \App\Models\SaranKarir::create([
                'hasil_psikotes_id' => $hasil->id,
                'tipe_kepribadian' => $dimensiTertinggi,
                'saran' => $saranKarir->saran,
            ]);
        }

        return redirect()->route('tes.bigfive.hasil', ['id' => $hasil->id]);
    }



    // Menampilkan hasil tes Big Five
    public function hasilTes($id)
    {
        $hasil = HasilPsikotes::with('user')->findOrFail($id);

        if ($hasil->jenis_tes == 'Big Five') {
            $hasil->big_five = json_decode($hasil->hasil, true);
        }

        // Ambil dimensi dengan skor tertinggi
        $dimensiTertinggi = array_keys($hasil->big_five, max($hasil->big_five))[0];

        // Cari saran karir berdasarkan dimensi tertinggi
        $saranKarir = SaranKarir::where('tipe_kepribadian', $dimensiTertinggi)->first();

        return view('user.hasil_tes', compact('hasil', 'saranKarir', 'dimensiTertinggi'));
    }


}
