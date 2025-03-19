<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;
use App\Models\SoalMBTI;
use App\Models\HasilMBTI;
use App\Models\HasilPsikotes;
use Illuminate\Support\Facades\Auth;


class MbtiController extends Controller
{
    public function index()
    {
        $soal = SoalMBTI::all();
        return view('admin.mbti.index', compact('soal'));
    }

    public function create()
    {
        return view('admin.mbti.create');
    }

    public function store(Request $request)
    {
        SoalMBTI::create([
            'pertanyaan' => $request->pertanyaan,
            'dimensi' => $request->dimensi,
            'pilihan_a' => $request->pilihan_a,
            'pilihan_b' => $request->pilihan_b,
        ]);

        return redirect('/admin/mbti')->with('success', 'Soal MBTI berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $soal = SoalMBTI::find($id);
        $dimensi = ['Ekstrovert vs Introvert', 'Sensing vs Intuition', 'Thinking vs Feeling', 'Judging vs Perceiving'];

        return view('admin.mbti.edit', compact('soal', 'dimensi'));
    }

    public function update(Request $request, $id)
    {
        $soal = SoalMBTI::find($id);

        $soal->update([
            'pertanyaan' => $request->pertanyaan,
            'dimensi' => $request->dimensi,
            'pilihan_a' => $request->pilihan_a,
            'pilihan_b' => $request->pilihan_b,
        ]);

        return redirect('/admin/mbti')->with('success', 'Soal MBTI berhasil diperbarui!');
    }

    // Menampilkan halaman tes MBTI
    public function tesMBTI()
    {
        $soal = SoalMBTI::all();
        return view('user/tes_mbti', compact('soal'));
    }

    // Memproses jawaban pengguna dan menyimpan hasil tes
    public function prosesTes(Request $request)
    {
        $jawaban = $request->input('jawaban', []);

        // Cek apakah jawaban kosong
        if (empty($jawaban)) {
            return redirect()->back()->with('error', 'Anda harus menjawab semua pertanyaan.');
        }

        // Hitung skor MBTI
        $skor = ['E' => 0, 'I' => 0, 'S' => 0, 'N' => 0, 'T' => 0, 'F' => 0, 'J' => 0, 'P' => 0];

        foreach ($jawaban as $id => $pilihan) {
            $soal = SoalMBTI::find($id);
            if ($soal) {
                $dimensi = explode(' vs ', $soal->dimensi);
                $key = ($pilihan === 'Setuju') ? substr($dimensi[0], 0, 1) : substr($dimensi[1], 0, 1);
                if (array_key_exists($key, $skor)) {
                    $skor[$key]++;
                }
            }
        }

        // Tentukan hasil MBTI
        $hasilMBTI = ($skor['E'] > $skor['I'] ? 'E' : 'I') .
                    ($skor['S'] > $skor['N'] ? 'S' : 'N') .
                    ($skor['T'] > $skor['F'] ? 'T' : 'F') .
                    ($skor['J'] > $skor['P'] ? 'J' : 'P');
        // Simpan ke database
        $hasil = HasilPsikotes::create([
            'user_id' => Auth::id(),
            'jenis_tes' => 'MBTI',
            'hasil' => $hasilMBTI,
        ]);


        return redirect()->route('hasil.tes', $hasil->id);
    }


    //Download hasil tes MBTI
    public function downloadPDF()
    {
        $user = Auth::user();
        $hasil = HasilMBTI::where('user_id', $user->id)->latest()->first(); // Ambil hasil terbaru

        if (!$hasil) {
            return redirect('/user/tes_mbti/hasil')->with('error', 'Belum ada hasil tes yang tersedia.');
        }

        $pdf = PDF::loadView('user.pdf-hasil-mbti', compact('user', 'hasil'));
        return $pdf->download('Hasil_Tes_MBTI.pdf');
    }


    // Tampilkan hasil tes
    public function hasilTes()
    {
        // Ambil hasil terbaru dari user yang sedang login
        $hasil = HasilPsikotes::where('user_id', Auth::id())->latest()->first();

        // Jika tidak ada hasil, kembalikan dengan pesan error
        if (!$hasil) {
            return redirect()->route('tes.mbti')->with('error', 'Belum ada hasil tes yang tersedia.');
        }

        return view('user.hasil-mbti', compact('hasil'));
    }


    


}
