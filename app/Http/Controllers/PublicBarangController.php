<?php
// app/Http/Controllers/PublicBarangController.php

namespace App\Http\Controllers;

use App\Models\Barang;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;

class PublicBarangController extends Controller
{
    /**
     * Tampilkan detail barang untuk publik (tanpa login)
     * Mendukung pencarian berdasarkan ID atau kode_barang
     */
    public function show($identifier)
    {
        // Coba cari berdasarkan ID atau kode_barang
        if (is_numeric($identifier)) {
            $barang = Barang::with(['kategori', 'lokasi'])->findOrFail($identifier);
        } else {
            $barang = Barang::with(['kategori', 'lokasi'])
                ->where('kode_barang', $identifier)
                ->firstOrFail();
        }
        
        // Disable cache untuk halaman publik
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header('Pragma: no-cache');
        header('Expires: Sat, 01 Jan 2000 00:00:00 GMT');
        
        return view('public.show', [
            'title' => 'Detail Barang Inventaris',
            'barang' => $barang,
        ]);
    }
}