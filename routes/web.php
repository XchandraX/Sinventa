<?php

// ! Panggil class AuthController agar bisa digunakan oleh route
use App\Http\Controllers\AuthController;

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
});
