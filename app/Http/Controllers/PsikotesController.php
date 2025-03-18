<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HasilPsikotes;
use App\Models\SaranKarir;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;

class PsikotesController extends Controller
{
    //Menampilkan semua hasil psikotes di Dashboard Admin
    public function index()
    {
        $hasil = HasilPsikotes::with('user')->get();
        return view('admin.psikotes.index', compact('hasil'));
    }

    //Menyimpan hasil tes psikotes setelah pengguna selesai mengikuti tes
    public function simpanHasil(Request $request)
    {
        // Validasi input
        $request->validate([
            'jenis_tes' => 'required|in:MBTI,Big Five',
            'hasil' => 'required|string',
        ]);

        // Simpan hasil tes ke dalam database
        HasilPsikotes::create([
            'user_id' => Auth::id(),
            'jenis_tes' => $request->jenis_tes, 
            'hasil' => $request->hasil, 
        ]);

        return redirect('/dashboard')->with('success', 'Hasil tes telah disimpan!');
    }

    //Detail Hasil Tes
    public function detail($id)
    {
        $hasil = HasilPsikotes::with('user')->find($id);
        
        if (!$hasil) {
            return redirect('/admin/psikotes')->with('error', 'Hasil tes tidak ditemukan.');
        }

        return view('admin.psikotes.detail', compact('hasil'));
    }

    //Bagian Edit
    public function edit($id)
    {
        $hasil = HasilPsikotes::with('user')->find($id);
        
        if (!$hasil) {
            return redirect('/admin/psikotes')->with('error', 'Hasil tes tidak ditemukan.');
        }

        return view('admin.psikotes.edit', compact('hasil'));
    }

    //Bagian Update
    public function update(Request $request, $id)
    {
        $request->validate([
            'hasil' => 'required|string',
        ]);

        $hasil = HasilPsikotes::find($id);
        if (!$hasil) {
            return redirect('/admin/psikotes')->with('error', 'Hasil tes tidak ditemukan.');
        }

        $hasil->update([
            'hasil' => $request->hasil,
        ]);

        return redirect('/admin/psikotes')->with('success', 'Hasil tes berhasil diperbarui!');
    }


    //Menghapus hasil tes psikotes (hanya admin yang bisa)
    public function destroy($id)
    {
        $hasil = HasilPsikotes::find($id);
        if ($hasil) {
            $hasil->delete();
            return redirect('/admin/psikotes')->with('success', 'Hasil tes berhasil dihapus!');
        }
        return redirect('/admin/psikotes')->with('error', 'Hasil tes tidak ditemukan!');
    }

    //Saran Karir
    public function hasilTes($id)
    {
        $hasil = HasilPsikotes::with('user')->find($id);
        
        if (!$hasil) {
            return redirect('/dashboard')->with('error', 'Hasil tes tidak ditemukan.');
        }

        $saranKarir = SaranKarir::where('tipe_kepribadian', $hasil->hasil)->first();

        return view('user.hasil_tes', compact('hasil', 'saranKarir'));
    }

    //Simpan PDF
    public function downloadPDF($id)
    {
        $hasil = HasilPsikotes::with('user')->find($id);

        if (!$hasil) {
            return redirect('/dashboard')->with('error', 'Hasil tes tidak ditemukan.');
        }

        $saranKarir = SaranKarir::where('tipe_kepribadian', $hasil->hasil)->first();

        $pdf = PDF::loadView('user.pdf_hasil_tes', compact('hasil', 'saranKarir'));
        
        return $pdf->download('Hasil_Tes_' . $hasil->user->nama . '.pdf');
    }

}
