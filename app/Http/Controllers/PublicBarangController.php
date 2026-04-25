<?php

// app/Http/Controllers/PublicBarangController.php

namespace App\Http\Controllers;

use App\Models\Barang;

class PublicBarangController extends Controller
{
    /**
     * Tampilkan detail barang untuk publik (tanpa login)
     * Mendukung pencarian berdasarkan ID atau kode_barang
     */
    public function show($identifier)
    {
        // Cari barang berdasarkan ID atau Kode Barang
        $barang = \App\Models\Barang::with(['kategori', 'lokasi'])
            ->where('id', $identifier)
            ->orWhere('kode_barang', $identifier)
            ->first();

        // Jika barang tidak ditemukan di database
        if (! $barang) {
            abort(404, 'Barang dengan ID atau Kode tersebut tidak ditemukan di database Aiven.');
        }

        return view('public.show', [
            'title' => 'Detail Barang Inventaris',
            'barang' => $barang,
        ]);
    }
}
