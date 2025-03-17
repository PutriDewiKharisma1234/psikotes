<?php

use App\Http\Controllers\AutentikasiPengguna;
use App\Http\Controllers\AdminController;


// Halaman Beranda
Route::view('/', 'welcome');

// Halaman Register
Route::get('/daftar', [AutentikasiPengguna::class, 'halamanRegistrasi']);
Route::post('/proses-daftar', [AutentikasiPengguna::class, 'prosesRegistrasi']);

// Halaman Login
Route::get('/masuk', [AutentikasiPengguna::class, 'halamanLogin'])->name('login');
Route::post('/proses-masuk', [AutentikasiPengguna::class, 'prosesLogin']);

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

// Logout
Route::get('/keluar', [AutentikasiPengguna::class, 'keluar']);

//admin
Route::get('/admin', [AdminController::class, 'dashboard'])->middleware('admin');
Route::get('/admin/login', [AdminController::class, 'halamanLoginAdmin']);
Route::post('/admin/proses-login', [AdminController::class, 'prosesLoginAdmin']);