<?php

use Illuminate\Support\Facades\Artisan;
// ! Panggil class AuthController agar bisa digunakan oleh route
use App\Http\Controllers\AuthController;
// ! Panggil class DaftarController agar bisa digunakan oleh route
use App\Http\Controllers\BarangController;
// ! Panggil class DaftarController agar bisa digunakan oleh route
use App\Http\Controllers\PublicBarangController;
// ! Panggil class DashboardController agar bisa digunakan oleh route
use App\Http\Controllers\BastController;
// ! Panggil class UserController agar bisa digunakan oleh route
use App\Http\Controllers\DaftarController;
// ! Panggil class KategoriController agar bisa digunakan oleh route
use App\Http\Controllers\DashboardController;
// ! Panggil class Lokasicontroller agar bisa digunakan oleh route
use App\Http\Controllers\KategoriController;
// ! Panggil class Barangcontroller agar bisa digunakan oleh route
use App\Http\Controllers\LokasiController;
// ! Panggil class BastController agar bisa digunakan oleh route
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

Route::get('/public/barang/{id}', [App\Http\Controllers\PublicBarangController::class, 'show'])->name('public.barang.show');
/**
 * ? fungsi Group Middlweare "Guest"
 * * Digunakan khusus untuk menangani permintaan dari user yang belum melakukan autentikasi (login)
 * ! "Guest" = "Tamu" artinya orang yang belum masuk / belum login ke sistem
 */
Route::middleware('guest')->group(function () {

    Route::get('/', function () {
        return view('index');
    })->name('/');

    /**
     * ? Route untuk menampilkan halaman form login
     * * Panggil AuthController lalu menjalankan function 'index'
     */
    Route::get('/login', [AuthController::class, 'index'])->name('login');

    /**
     * ? Route untu menampilkan halaman form pendaftaran user
     * * Panggil DaftarController lalu menjalankan function 'index'
     */
    Route::get('/register', [DaftarController::class, 'index'])->name('daftar.index');

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

    /**
     * ? Route untuk mengelola data kategori
     * * karena controller yang digunakan adalah controller resource, maka method route juga pake resource
     * * 1 route ini bisa menangani: index, create, store, show, edit, update dan destroy
     */
    Route::resource('/dashboard/barang', BarangController::class);

    /**
     * ? Route untuk mengelola data bast
     * * karena controller yang digunakan adalah controller resource, maka method route juga pake resource
     * * 1 route ini bisa menangani permintaan: index, create, store, show, edit, update dan destroy
     */
    Route::resource('/dashboard/bast', BastController::class);

    Route::get('/dashboard/bast-serah/menunggu', [BastController::class, 'bastSerahMenunggu'])->name('bast.serah.menunggu');

    Route::get('/dashboard/bast-serah/disetujui', [BastController::class, 'bastSerahDisetujui'])->name('bast.serah.disetujui');

    Route::put('/dashboard/bast-serah/{bast}/setujui', [BastController::class, 'setujuiSerah'])->name('bast.serah.setujui');

    Route::put('/dashboard/bast-serah/{bast}/cancel', [BastController::class, 'cancelSerah'])->name('bast.serah.cancel');

    Route::get('/dashboard/bast-terima/menunggu', [BastController::class, 'bastTerimaMenunggu'])->name('bast.terima.menunggu');

    Route::get('/dashboard/bast-terima/disetujui', [BastController::class, 'bastTerimaDisetujui'])->name('bast.terima.disetujui');

    Route::put('/dashboard/bast-terima/{bast}/setujui', [BastController::class, 'setujuiTerima'])->name('bast.terima.setujui');

    Route::put('/dashboard/bast-terima/{bast}/cancel', [BastController::class, 'cancelTerima'])->name('bast.terima.cancel');

    // ? Route untuk download QRCode Barang dari halaman show detail barang
    Route::get('/dashboard/barang/{barang}/download-qrcode', [BarangController::class, 'downloadQr'])->name('barang.downloadQr');
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

    // ? Route untuk fitur ekspor data barang ke file dpf
    Route::get('/dashboard/expor/barang-to/pdf', [BarangController::class, 'exportToPdf'])->name('barang.exportToPdf');

    // ? Route utnuk fitur eskpor data ke file excel
    Route::get('/dashboard/export-barang-to/excel', [Barangcontroller::class, 'exportToExcel'])->name('barang.exportToExcel');

    // ? Route untuk fitur cetak daftar barang
    Route::get('/dashboard/print-barang', [Barangcontroller::class, 'print'])->name('barang.print');

    // ? Route untuk fitur cetak daftar satu barang
    Route::get('/barang/{barang}/print', [BarangController::class, 'printBarang'])->name('barang.print.barang');

    // ? route untuk fitur download dockumen BAST dalam format PDF
    Route::get('/dashboard/bast{bast}/download-pdf', [BastController::class, 'downloadPdf'])->name('bast.downloadPdf');

    // ? route untuk ekspor list bast ke file pdf
    Route::get('/dashboard/export-bast-to/pdf', [BastController::class, 'exportToPdf'])->name('bast.exportToPdf');
    // ? Route utnuk fitur eskpor data ke file excel
    Route::get('/dashboard/export-bast-to/excel', [BastController::class, 'exportToExcel'])->name('bast.exportToExcel');
    // ? Route untuk fitur cetak daftar bast
    Route::get('/dashboard/print-bast', [BastController::class, 'print'])->name('bast.print');
});

Route::get('/rahasia-migrate-fresh', function () {
    try {
        // Menjalankan migrate:fresh --seed melalui kode
        Artisan::call('migrate:fresh', ['--force' => true, '--seed' => true]);
        return "Database berhasil di-reset dan di-seed!";
    } catch (\Exception $e) {
        return "Gagal: " . $e->getMessage();
    }
});