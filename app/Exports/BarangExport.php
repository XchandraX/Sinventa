<?php

namespace App\Exports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BarangExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // ? tentukan data apa saja yang akan di ekspor ke Excel
        return Barang::with(['kategori', 'lokasi']) // amibl data barang, kategori, lokasi
            ->latest() //urutkan dari paling baru
            ->get() // ambil semua datanya
            ->map(function ($barang) { //kirimkan data berdasarkan ketentuan dibawah ini
                return [
                    'kode_barang'   => $barang->kode_barang, 
                    'nama_barang'   => $barang->nama_barang, 
                    
                    // kategori
                    'kode_kategori'   => $barang->kategori->kode_kategori ?? '-', 
                    'nama_kategori'   => $barang->kategori->nama_kategori ?? '-', 
                    
                    // lokaisi
                    'kode_lokasi'   => $barang->lokasi->kode_lokasi ?? '-', 
                    'nama_lokasi'   => $barang->lokasi->nama_lokasi ?? '-', 
                    
                    'status_barang' => $barang->status_barang,
                    'deskripsi' => $barang->deskripsi,
                ];
            });

    }
    
    // ? berfungsi untuk membuat judul kolom (baris paling atas di excel)
    public function headings(): array {
        return [
            'Kode Barang',
            'Nama Barang',
            'Kode Kategori',
            'Nama Kategori',
            'Kode Lokasi',
            'Nama Lokasi',
            'Status Barang',
            'Deskripsi',
        ];
    }
}
