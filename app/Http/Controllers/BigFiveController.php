<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SoalBigFive;

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
}
