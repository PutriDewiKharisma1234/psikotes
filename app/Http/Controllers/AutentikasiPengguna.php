<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AutentikasiPengguna extends Controller
{
    // Halaman Registrasi
    public function halamanRegistrasi()
    {
        return view('auth.register');
    }

    // Proses Registrasi
    public function prosesRegistrasi(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'kata_sandi' => 'required|min:6|confirmed',
        ]);

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'kata_sandi' => bcrypt($request->kata_sandi),
        ]);

        return redirect('/masuk')->with('berhasil', 'Akun berhasil dibuat!');
    }

    // Halaman Login
    public function halamanLogin()
    {
        return view('auth.masuk');
    }

    // Proses Login
    public function prosesLogin(Request $request)
    {
        $kredensial = [
            'email' => $request->email,
            'password' => $request->kata_sandi // Password Laravel tetap membaca dari kata_sandi
        ];

        if (Auth::attempt($kredensial)) {
            return redirect('/beranda');
        }

        return back()->with('gagal', 'Email atau Kata Sandi Salah!');
    }

    // Logout
    public function keluar()
    {
        Auth::logout();
        return redirect('/masuk');
    }
}
