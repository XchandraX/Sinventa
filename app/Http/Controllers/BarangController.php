<?php

namespace App\Http\Controllers;

use App\Models\Barang;
// ! panggil class modul yang dibutuhkan di function
use App\Models\Kategori;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * ? tampilkan semua list barang, krena di soal minta fitur filter, kita tambahkan query untuk filter data
     */
    public function index(Request $request)
    {
        // ? hanay admin yang boleh melihat semua data barang
        $this->authorize('viewAny', Barang::class);

        // ? Query untuk mengambil data barang dari database
        $barangs = Barang::query()
            ->with(['kategori', 'lokasi']) // ? sekalian ambil data kategori dan lokasi
            ->when($request->kategori, function ($query, $kategori) { // ? jika ada filter berdasarkan kategori
                $query->where('kategori_id', $kategori); // ? ambil data barang berdasarkan kategori yang dipilih
            })->when($request->lokasi, function ($query, $lokasi) { // ? jika ada filter berdasarkan lokasi
                $query->where('lokasi_id', $lokasi); // ? ambil data barang berdasarkan lokasi yang dipilih
            })->when($request->status, function ($query, $status) { // ? jika ada filter berdasarkan status
                $query->where('status_barang', $status); // ? ambil data barang berdasarkan status yang dipilih
            })->latest()->get(); // ? urutkan dari yang terbaru
            
        // ? tampilkan view index.blade.php di folder dashboard/barang
        return view('dashboard.barang.index', [
            'title' => 'Daftar Barang', // ? kirim judul halaman
            'barangs' => $barangs, // ? kirim data barang
            'kategoris' => Kategori::latest()->get(), // ? kirim semua data kategori (untuk fitur filter)
            'lokasis' => Lokasi::latest()->get(), // ? kirim semua data kategori (untuk fitur filter)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        //
    }
}
