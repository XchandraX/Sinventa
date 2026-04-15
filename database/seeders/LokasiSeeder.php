<?php
// database/seeders/LokasiSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class LokasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('lokasis')->truncate();
        Schema::enableForeignKeyConstraints();

        $lokasis = [
            ['kode_lokasi' => 'LOK-001', 'nama_lokasi' => 'Gudang Pusat', 'deskripsi' => 'Gudang utama penyimpanan barang'],
            ['kode_lokasi' => 'LOK-002', 'nama_lokasi' => 'Ruang Server', 'deskripsi' => 'Ruangan khusus server dan jaringan'],
            ['kode_lokasi' => 'LOK-003', 'nama_lokasi' => 'Ruang IT', 'deskripsi' => 'Ruangan divisi IT'],
            ['kode_lokasi' => 'LOK-004', 'nama_lokasi' => 'Ruang HRD', 'deskripsi' => 'Ruangan divisi HRD'],
            ['kode_lokasi' => 'LOK-005', 'nama_lokasi' => 'Ruang Finance', 'deskripsi' => 'Ruangan divisi keuangan'],
            ['kode_lokasi' => 'LOK-006', 'nama_lokasi' => 'Ruang Marketing', 'deskripsi' => 'Ruangan divisi marketing'],
            ['kode_lokasi' => 'LOK-007', 'nama_lokasi' => 'Ruang Operasional', 'deskripsi' => 'Ruangan tim operasional'],
            ['kode_lokasi' => 'LOK-008', 'nama_lokasi' => 'Pantry', 'deskripsi' => 'Area pantry kantor'],
            ['kode_lokasi' => 'LOK-009', 'nama_lokasi' => 'Ruang Rapat', 'deskripsi' => 'Ruangan untuk meeting'],
            ['kode_lokasi' => 'LOK-010', 'nama_lokasi' => 'Lobi', 'deskripsi' => 'Area lobi/tamu'],
        ];

        DB::table('lokasis')->insert($lokasis);
    }
}