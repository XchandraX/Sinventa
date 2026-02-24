<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// ! panggil semua mode agar kita bisa digunakan di funciton index()
use App\Models\Barang;
use App\Models\Bast;
use App\Models\Kategori;
use App\Models\Lokasi;
class DashboardController extends Controller
{
    /**
     * ?function index akan menjalankan view 'index.blade.php' di dalam folder 'dashboard
     * ? lalu mengirimkan data-data yang akan ditampilkan di halaman
     */

    public function index() {
        // hitung jumlah data di tabel kategori
        $jumlah_kategori = Kategori::count();

        $jumlah_lokasi = Lokasi::count();

        $jumlah_barang = Barang::count();

        $jumlah_bast = Bast::count();

        return view('dashboard.index', [
            'title' => 'Dashboard Sinvesta',
            'jumlah_kategori' => $jumlah_kategori,
            'jumlah_lokasi' => $jumlah_lokasi,
            'jumlah_barang' => $jumlah_barang,
            'jumlah_bast' => $jumlah_bast,
        ]);
    }
}
