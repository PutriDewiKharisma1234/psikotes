<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Menampilkan semua data pengguna
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // Form Tambah Pengguna
    public function tambah()
    {
        return view('admin.users.tambah');
    }

    // Simpan Data
    public function store(Request $request)
    {
        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'peran' => $request->peran,
        ]);

        return redirect('/admin/users');
    }


    // Form Edit
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
    }

    // Update Data
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'peran' => $request->peran,
        ]);

        return redirect('/admin/users');
    }

    // Hapus Data
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect('/admin/users');
    }
}
