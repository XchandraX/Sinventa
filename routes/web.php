<?php

// ! Panggil class AuthController agar bisa digunakan oleh route
use App\Http\Controllers\AuthController;
// ! Panggil class DaftarController agar bisa digunakan oleh route
use App\Http\Controllers\DaftarController;
// ! Panggil class DashboardController agar bisa digunakan oleh route
use App\Http\Controllers\DashboardController;
// ! Panggil class UserController agar bisa digunakan oleh route
use App\Http\Controllers\UserController;
// ! Panggil class KategoriController agar bisa digunakan oleh route
use App\Http\Controllers\KategoriController;
// ! Panggil class Lokasicontroller agar bisa digunakan oleh route
use App\Http\Controllers\LokasiController;
// ! Panggil class Barangcontroller agar bisa digunakan oleh route
use App\Http\Controllers\BarangController;


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
     * ? Route untu menampilkan halaman form pendaftaran user
     * * Panggil DaftarController lalu menjalankan function 'index'
     */
    Route::get('/chx1xhc', [DaftarController::class, 'index'])->name('daftar.index');
    
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

/**
 * ? Fungsi Group Miiddleware 'Auth"
 * * Digunakan khusus untuk menangani permintaan dari user yg sudah melakukan autentikasi
 * ! "Auth" = "Autentikasi" artinya orang yg sudah masuk / sudah berhasil login ke sistem
 */

Route::middleware('auth')->group(function () {

    /**
     * ? Route untuk nemapilkan halaman dashbaord
     * * panggil DashboardController lalu jalankan funciton "index"
     */
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /**
     * ? Route untuk menangani permintaan logout
     * * karena fitur logout menggunakan foorm dengan method post, maka method route juga menggunakan post
     */
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    /**
     * ? Route untuk mengelola data user
     * * karena controller yang digunakan adalah controller resource, maka method route juga pake resource
     * * 1 route ini bisa menangani permintaan: index, create, store, show, edit, update, destroy
     */
    Route::resource('/dashboard/users', UserController::class);
});

/**
 * ? fungsi group middleware auth dengan role = admin
 * * digunakan khusus untuk fitur2 yang tersedia hanya untuk user yang sudah login dan role = admin
 * ! user yang blum login dan user dengan = user tidak akan bisa akses fitur didalam group ini
 */
Route::middleware(['auth', 'role:admin'])->group(function () {

    /**
     * ? Route untuk mengelola data kategori
     * * karena controller yang digunakan adalah controller resource, maka method route juga pake resource
     * * 1 route ini bisa menangani: index, create, store, show, edit, update dan destroy
     */
    Route::resource('/dashboard/kategori', KategoriController::class);
    
    // ? Route untuk fitur ekspor data kategori ke file PDF
    Route::get('/dashboard/export-kategori-to/pdf', [KategoriController::class, 'exportToPdf'])->name('kategori.exportToPdf');

    // ? Route untuk fitur ekspor data kategori ke file Excel
    Route::get('/dashboard/export-kategori-to/excel', [KategoriController::class, 'exportToExcel'])->name('kategori.exporToExcel');

    // ? Route untuk fitur print daftar kategori barang
    Route::get('/dashboard/print-kategori', [KategoriController::class, 'print'])->name('kategori.print');

    /**
     * ? Route untuk mengelola data kategori
     * * karena controller yang digunakan adalah controller resource, maka method route juga pake resource
     * * 1 route ini bisa menangani: index, create, store, show, edit, update dan destroy
     */
    Route::resource('/dashboard/lokasi', LokasiController::class);

    // ? Route untuk fitur ekspor data lokasi ke file PDF
    Route::get('/dashboard/export-lokasi-to/pdf', [LokasiController::class, 'exportToPdf'])->name('lokasi.exportToPdf');

    // ? Route untuk fitur ekspor data lokasi ke file Excel
    Route::get('/dashboard/export-lokasi-to/excel', [LokasiController::class, 'exportToExcel'])->name('lokasi.exporToExcel');

    // ? Route untuk fitur print daftar lokasi barang
    Route::get('/dashboard/print-lokasi', [LokasiController::class, 'print'])->name('lokasi.print');


    /**
     * ? Route untuk mengelola data kategori
     * * karena controller yang digunakan adalah controller resource, maka method route juga pake resource
     * * 1 route ini bisa menangani: index, create, store, show, edit, update dan destroy
     */
    Route::resource('/dashboard/barang', BarangController::class);

    // ? Route untuk download QRCode Barang dari halaman show detail barang
    Route::get('/dashboard/barang/{barang}/download-qrcode', [BarangController::class, 'downloadQr'])->name('barang.downloadQr');
});