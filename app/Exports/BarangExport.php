<?php

namespace App\Exports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class BarangExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // ? tentukan data apa saja yang akan di ekspor ke Excel
        return Lokasi::select(
            'kode_barang',
            'nama_barang',
            'deskripsi',
            'created_at',
        )->get();

    }
    
    // ? berfungsi untuk membuat judul kolom (baris paling atas di excel)
    public function headings(): array {
        return [
            'Kode Barang',
            'Nama Barang',
            'Deskripsi',
            'Tanggal Dibuat'
        ];
    }
}
