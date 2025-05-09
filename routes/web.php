<?php

use App\Http\Controllers\AutentikasiPengguna;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MbtiController;
use App\Http\Controllers\BigFiveController;
use App\Http\Controllers\PsikotesController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\HasilPsikotesController;


// Halaman Beranda
Route::view('/', 'welcome');

// Halaman Metode Tes (MBTI dan Big Five)
Route::get('/metode', function () {
    return view('auth.metode');
});

// Halaman Register
Route::get('/daftar', [AutentikasiPengguna::class, 'halamanRegistrasi']);
Route::post('/proses-daftar', [AutentikasiPengguna::class, 'prosesRegistrasi']);

// Halaman Login
Route::get('/masuk', [AutentikasiPengguna::class, 'halamanLogin'])->name('login');
Route::post('/proses-masuk', [AutentikasiPengguna::class, 'prosesLogin']);

// Dashboard Pengguna (User)
Route::middleware(['auth'])->group(function () {
    // Dashboard Pengguna
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    // Halaman Edit Profil
    Route::get('/user/profil', [AutentikasiPengguna::class, 'halamanProfil'])->name('user.profil');
    Route::post('/user/profil/update', [AutentikasiPengguna::class, 'updateProfil'])->name('user.profil.update');

    // Tes MBTI
    Route::get('/user/tes_mbti', [MbtiController::class, 'tesMBTI'])->name('tes.mbti');
    Route::post('/user/tes_mbti/proses', [MbtiController::class, 'prosesTes'])->name('tes.mbti.proses');
    Route::get('/user/tes_mbti/hasil', [MbtiController::class, 'hasilTes'])->name('tes.mbti.hasil');
    

    // Download Hasil Tes MBTI dalam PDF
    Route::get('/user/tes_mbti/hasil/{id}/pdf', [MbtiController::class, 'downloadPDF'])->name('tes.mbti.pdf');

    // Tes Big Five untuk pengguna
    Route::get('/user/tes_bigfive', [BigFiveController::class, 'tesBigFive'])->name('tes.bigfive');
    Route::post('/user/tes_bigfive/proses', [BigFiveController::class, 'prosesTes'])->name('tes.bigfive.proses');
    Route::get('/user/tes_bigfive/hasil/{id}', [BigFiveController::class, 'hasilTes'])->name('tes.bigfive.hasil');

    // Menampilkan hasil tes psikotes
    Route::get('/hasil_tes/{id}', [HasilPsikotesController::class, 'show'])->name('hasil.tes');

    // Download hasil tes dalam PDF
    Route::get('/user/pdf_hasil_tes/{id}/pdf', [HasilPsikotesController::class, 'downloadPdf'])->name('hasil.tes.pdf');

    Route::get('/user/semua_hasil_tes', [HasilPsikotesController::class, 'semuaHasil'])->name('user.hasil.semua');

    // Simpan hasil tes psikotes otomatis
    Route::post('/simpan-hasil', [PsikotesController::class, 'simpanHasil'])->name('psikotes.simpan');

    // Saran Karir untuk hasil tes
    Route::get('/saran_karir/{id}', [PsikotesController::class, 'hasilTes'])->name('saran.karir');
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
    Route::get('/admin/psikotes/detail/{id}', [PsikotesController::class, 'detail'])->name('admin.psikotes.detail');
    Route::get('/admin/psikotes/edit/{id}', [PsikotesController::class, 'edit'])->name('admin.psikotes.edit');
    Route::put('/admin/psikotes/update/{id}', [PsikotesController::class, 'update'])->name('admin.psikotes.update');
    Route::delete('/admin/psikotes/delete/{id}', [PsikotesController::class, 'destroy'])->name('admin.psikotes.delete');

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
