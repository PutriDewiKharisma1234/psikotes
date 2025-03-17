<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SoalMBTI;


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
}
