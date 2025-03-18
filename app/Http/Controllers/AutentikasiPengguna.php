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
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'peran' => 'user' // Secara default user akan menjadi "user"
        ]);

        return redirect('/masuk')->with('success', 'Akun berhasil dibuat! Silakan masuk.');
    }


    // Halaman Login
    public function halamanLogin()
    {
        return view('auth.masuk');
    }

    // Proses Login
    public function prosesLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Cek apakah pengguna adalah admin atau user
            if ($user->peran === 'admin') {
                return redirect('/admin/dashboard')->with('success', 'Selamat datang, Admin!');
            } else {
                return redirect('/dashboard')->with('success', 'Selamat datang di Dashboard Pengguna!');
            }
        }

        return back()->with('error', 'Email atau kata sandi salah!');
    }

    public function halamanProfil()
    {
        $user = Auth::user(); // Ambil data user yang sedang login
        return view('user.profil', compact('user'));
    }

    public function updateProfil(Request $request)
    {
        $user = Auth::user(); // Ambil user yang sedang login

        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        // Update nama dan email
        $user->nama = $request->nama;
        $user->email = $request->email;

        // Jika password diisi, update password
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->save(); // Simpan perubahan

        return redirect('/user/profil')->with('success', 'Profil berhasil diperbarui!');
    }


    // Logout
    public function keluar()
    {
        Auth::logout();
        return redirect('/masuk');
    }
}
