<?php

namespace App\Exports;

use App\Models\Bast;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BastExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // ? tentukan data apa saja yang akan di ekspor ke Excel
        return Bast::with(['barang', 'userSerah', 'userTerima']) // amibl data barang, kategori, lokasi
            ->latest() // urutkan dari paling baru
            ->get() // ambil semua datanya
            ->map(function ($bast) { // kirimkan data berdasarkan ketentuan dibawah ini
                return [
                    'kode' => $bast->barang->kategori->kode_barang.'/'.$bast->barang->lokasi->kode_lokasi.'/'.$bast->barang->kode_barang,
                    'nama_barang' => $bast->barang->nama_barang,
                    'nama_kategori' => $bast->barang->kategori->nama_kategori ?? '-',
                    'nama_lokasi' => $bast->barang->lokasi->nama_lokasi ?? '-',
                    'status_barang' => $bast->barang->status_barang,
                    'user_serah_id' => $bast->userSerah->nama_lengkap,
                    'status_serah' => $bast->status_serah,
                    'user_terima_id' => $bast->userTerima->nama_lengkap,
                    'status_terima' => $bast->status_terima,
                    'created_at' => $bast->created_at,
                ];
            });
    }

    public function headings(): array {
        return [
            'Kode',
            'Nama Barang',
            'Kategori',
            'Lokasi',
            'Status Barang',
            'Penyerah',
            'Status Penyerah',
            'Penerima',
            'Status Penerima',
            'Dibuat',
        ];
    }
}
