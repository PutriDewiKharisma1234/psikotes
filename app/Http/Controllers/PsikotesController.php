<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HasilPsikotes;
use Illuminate\Support\Facades\Auth;

class PsikotesController extends Controller
{
    // ✅ 1. Menampilkan semua hasil psikotes di Dashboard Admin
    public function index()
    {
        $hasil = HasilPsikotes::with('user')->get();
        return view('admin.psikotes.index', compact('hasil'));
    }

    // ✅ 2. Menyimpan hasil tes psikotes setelah pengguna selesai mengikuti tes
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
}
