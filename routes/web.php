<?php

use App\Http\Controllers\AutentikasiPengguna;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

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

// Halaman Login Admin
Route::get('/admin/login', [AdminController::class, 'halamanLoginAdmin'])->name('admin.login');
Route::post('/admin/proses-login', [AdminController::class, 'prosesLoginAdmin']);

// **Agar saat akses /admin langsung diarahkan ke dashboard**
Route::redirect('/admin', '/admin/dashboard');

// Middleware untuk Admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // CRUD User
    Route::get('/admin/users', [UserController::class, 'index']);
    Route::get('/admin/users/tambah', [UserController::class, 'tambah']);
    Route::post('/admin/users/store', [UserController::class, 'store']);
    Route::get('/admin/users/edit/{id}', [UserController::class, 'edit']);
    Route::put('/admin/users/update/{id}', [UserController::class, 'update']);
    Route::delete('/admin/users/delete/{id}', [UserController::class, 'destroy']);
 // Logout Admin
    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
});