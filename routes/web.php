<?php

use App\Http\Controllers\AutentikasiPengguna;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MbtiController;
use App\Http\Controllers\BigFiveController;
use App\Http\Controllers\PsikotesController;
use App\Http\Controllers\LaporanController;

// Halaman Beranda
Route::view('/', 'welcome');

// Halaman Register
Route::get('/daftar', [AutentikasiPengguna::class, 'halamanRegistrasi']);
Route::post('/proses-daftar', [AutentikasiPengguna::class, 'prosesRegistrasi']);

// Halaman Login
Route::get('/masuk', [AutentikasiPengguna::class, 'halamanLogin'])->name('login');
Route::post('/proses-masuk', [AutentikasiPengguna::class, 'prosesLogin']);

// Dashboard Pengguna (User)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });

    // Simpan hasil tes psikotes otomatis
    Route::post('/simpan-hasil', [PsikotesController::class, 'simpanHasil']);
});

// Logout Pengguna
Route::get('/keluar', [AutentikasiPengguna::class, 'keluar']);

// Halaman Login Admin
Route::get('/admin/login', [AdminController::class, 'halamanLoginAdmin'])->name('admin.login');
Route::post('/admin/proses-login', [AdminController::class, 'prosesLoginAdmin']);

// Akses `/admin` langsung diarahkan ke Dashboard Admin
Route::redirect('/admin', '/admin/dashboard');

// Middleware untuk Admin
Route::middleware(['auth', 'admin'])->group(function () {
    // Dashboard Admin
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // CRUD Data Pengguna
    Route::get('/admin/users', [UserController::class, 'index']);
    Route::get('/admin/users/tambah', [UserController::class, 'tambah']);
    Route::post('/admin/users/store', [UserController::class, 'store']);
    Route::get('/admin/users/edit/{id}', [UserController::class, 'edit']);
    Route::put('/admin/users/update/{id}', [UserController::class, 'update']);
    Route::delete('/admin/users/delete/{id}', [UserController::class, 'destroy']);

    // Manajemen Hasil Psikotes
    Route::get('/admin/psikotes', [PsikotesController::class, 'index']);
    Route::delete('/admin/psikotes/delete/{id}', [PsikotesController::class, 'destroy']);

    //Laporan psikotes
    Route::get('/admin/laporan', [LaporanController::class, 'index']);

    // Manajemen Soal MBTI
    Route::get('/admin/mbti', [MbtiController::class, 'index']);
    Route::get('/admin/mbti/create', [MbtiController::class, 'create']);
    Route::post('/admin/mbti/store', [MbtiController::class, 'store']);
    Route::get('/admin/mbti/edit/{id}', [MbtiController::class, 'edit']);
    Route::put('/admin/mbti/update/{id}', [MbtiController::class, 'update']);
    Route::delete('/admin/mbti/delete/{id}', [MbtiController::class, 'destroy']);

    // Manajemen Soal Big Five
    Route::get('/admin/bigfive', [BigFiveController::class, 'index']);
    Route::get('/admin/bigfive/create', [BigFiveController::class, 'create']);
    Route::post('/admin/bigfive/store', [BigFiveController::class, 'store']);
    Route::get('/admin/bigfive/edit/{id}', [BigFiveController::class, 'edit']);
    Route::put('/admin/bigfive/update/{id}', [BigFiveController::class, 'update']);
    Route::delete('/admin/bigfive/delete/{id}', [BigFiveController::class, 'destroy']);

    // Logout Admin
    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
});
