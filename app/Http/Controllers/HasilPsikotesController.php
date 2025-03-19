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

        

        // Ambil saran karir berdasarkan hasil tes
        $saranKarir = SaranKarir::where('tipe_kepribadian', $hasil->hasil)->first();

        return view('user.hasil_tes', compact('hasil', 'saranKarir'));
    }

    
    // Simpan hasil tes ke database
    public function simpanHasil(Request $request)
    {
        $hasil = new HasilPsikotes();
        $hasil->user_id = auth()->id();
        $hasil->jenis_tes = 'MBTI';
        $hasil->hasil = strtoupper($request->hasil);
        $hasil->save();

        return redirect()->route('hasil.tes', $hasil->id);
    }

    // Generate PDF hasil tes
    public function downloadPdf($id)
    {
        $hasil = HasilPsikotes::with('user')->findOrFail($id);
        $saranKarir = SaranKarir::where('tipe_kepribadian', $hasil->hasil)->first();

        // Generate PDF
        $pdf = Pdf::loadView('user.pdf_hasil_tes', compact('hasil', 'saranKarir'));

        return $pdf->download('Hasil_Tes_Psikologi.pdf');
    }

 

}
