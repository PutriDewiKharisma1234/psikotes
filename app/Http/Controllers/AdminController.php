<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function halamanLoginAdmin()
    {
        return view('admin.login');
    }

    public function prosesLoginAdmin(Request $request)
    {
        $kredensial = [
            'email' => $request->email,
            'password' => $request->password,
            'peran' => 'admin' // Hanya untuk admin
        ];

        if (Auth::attempt($kredensial)) {
            return redirect('/admin');
        }

        return back()->with('gagal', 'Email atau Kata Sandi Admin Salah!');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
