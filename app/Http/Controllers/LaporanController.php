<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HasilPsikotes;
use App\Models\User;

class LaporanController extends Controller
{
    public function index()
    {
        // Hitung total pengguna yang telah mengikuti tes
        $totalTes = HasilPsikotes::count();

        // Hitung jumlah pengguna berdasarkan tipe MBTI
        $mbtiData = HasilPsikotes::where('jenis_tes', 'MBTI')
            ->selectRaw('hasil, COUNT(*) as jumlah')
            ->groupBy('hasil')
            ->pluck('jumlah', 'hasil');

        // Hitung persentase hasil Big Five
        $bigFiveData = HasilPsikotes::where('jenis_tes', 'Big Five')
            ->selectRaw('hasil, COUNT(*) as jumlah')
            ->groupBy('hasil')
            ->pluck('jumlah', 'hasil');

        return view('admin.laporan', compact('totalTes', 'mbtiData', 'bigFiveData'));
    }
}
