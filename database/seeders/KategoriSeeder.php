<?php
// database/seeders/KategoriSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kosongkan tabel terlebih dahulu (opsional)
        Schema::disableForeignKeyConstraints();
        DB::table('kategoris')->truncate();
        Schema::enableForeignKeyConstraints();

        $kategoris = [
            ['kode_kategori' => 'KAT-001', 'nama_kategori' => 'Elektronik', 'deskripsi' => 'Perangkat elektronik dan gadget'],
            ['kode_kategori' => 'KAT-002', 'nama_kategori' => 'Furniture', 'deskripsi' => 'Perabotan kantor dan rumah'],
            ['kode_kategori' => 'KAT-003', 'nama_kategori' => 'Alat Tulis', 'deskripsi' => 'Perlengkapan tulis kantor'],
            ['kode_kategori' => 'KAT-004', 'nama_kategori' => 'Komputer', 'deskripsi' => 'Perangkat komputer dan aksesoris'],
            ['kode_kategori' => 'KAT-005', 'nama_kategori' => 'Jaringan', 'deskripsi' => 'Perangkat jaringan internet'],
            ['kode_kategori' => 'KAT-006', 'nama_kategori' => 'Kendaraan', 'deskripsi' => 'Kendaraan operasional'],
            ['kode_kategori' => 'KAT-007', 'nama_kategori' => 'Alat Kebersihan', 'deskripsi' => 'Perlengkapan kebersihan'],
            ['kode_kategori' => 'KAT-008', 'nama_kategori' => 'Peralatan Dapur', 'deskripsi' => 'Peralatan untuk pantry'],
            ['kode_kategori' => 'KAT-009', 'nama_kategori' => 'ATK', 'deskripsi' => 'Alat Tulis Kantor'],
            ['kode_kategori' => 'KAT-010', 'nama_kategori' => 'Perlengkapan Meeting', 'deskripsi' => 'Perlengkapan rapat dan presentasi'],
        ];

        DB::table('kategoris')->insert($kategoris);
    }
}