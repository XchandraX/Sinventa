<?php

// ! Panggil class AuthController agar bisa digunakan oleh route
use App\Http\Controllers\AuthController;
// ! Panggil class DaftarController agar bisa digunakan oleh route
use App\Http\Controllers\DaftarController;
use Illuminate\Support\Facades\Route;

/**
 * ? fungsi Group Middlweare "Guest"
 * * Digunakan khusus untuk menangani permintaan dari user yang belum melakukan autentikasi (login)
 * ! "Guest" = "Tamu" artinya orang yang belum masuk / belum login ke sistem
 */
Route::middleware('guest')->group(function () {
    /**
     * ? Route untuk menampilkan halaman form login
     * * Panggil AuthController lalu menjalankan function 'index'
     */
    Route::get('/', [AuthController::class, 'index'])->name('login');

    /**
     * ? Route untuk menampilkan halaman form daftar
     * * Panggil DaftarController lalu menjalankan funciton 'index'
     */
    Route::get('/daftar', [DaftarController::class, 'index'])->name('daftar.index');

    /**
     * ? Route untuk simpan data user ke database (store)
     * * Panggil DaftarController lalu menjalankan funciton 'store'
     * ! karena ada data yang dikirim dari form pendaftaran ke DaftarController,,
     * ! maks method yang digunakan adalah 'POST'
     */
    Route::post('/daftar', [DaftarController::class, 'store'])->name('daftar.store');

    /**
     * ? Route untuk proses login (autentikasi)
     * * Panggil AuthController lalu menjalankan funciton 'login'
     * ! karena ada data yang dikirim dari form login ke AuthController,,
     * ! maks method yang digunakan adalah 'POST'
     */
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
});