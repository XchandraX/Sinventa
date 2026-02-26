<?php

namespace App\Exports;

use App\Models\Kategori;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KategoriExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // ? tentukan data apa saja yang akan di ekspor ke Excel
        return Kategori::select(
            'kode_kategori',
            'nama_kategori',
            'deskripsi',
            'created_at',
        )->get();

    }
    
    // ? berfungsi untuk membuat judul kolom (baris paling atas di excel)
    public function headings(): array {
        return [
            'Kode Kategori',
            'Nama Kategori',
            'Deskripsi',
            'Tanggal Dibuat'
        ];
    }
}
