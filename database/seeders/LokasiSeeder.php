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
            // --- DATA LAMA ---
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

            // --- DATA BARU (Disesuaikan menjadi LOK) ---
            ['kode_lokasi' => 'LOK-011', 'nama_lokasi' => 'Ruang Kelas 7A', 'deskripsi' => 'Ruang belajar siswa kelas 7A'],
            ['kode_lokasi' => 'LOK-012', 'nama_lokasi' => 'Ruang Kelas 8A', 'deskripsi' => 'Ruang belajar siswa kelas 8A'],
            ['kode_lokasi' => 'LOK-013', 'nama_lokasi' => 'Ruang Kelas 9A', 'deskripsi' => 'Ruang belajar siswa kelas 9A'],
            ['kode_lokasi' => 'LOK-014', 'nama_lokasi' => 'Laboratorium IPA', 'deskripsi' => 'Ruang praktik fisika dan biologi'],
            ['kode_lokasi' => 'LOK-015', 'nama_lokasi' => 'Laboratorium Komputer', 'deskripsi' => 'Ruang praktik TIK'],
            ['kode_lokasi' => 'LOK-016', 'nama_lokasi' => 'Perpustakaan', 'deskripsi' => 'Pusat literasi dan buku'],
            ['kode_lokasi' => 'LOK-017', 'nama_lokasi' => 'Ruang UKS', 'deskripsi' => 'Unit Kesehatan Sekolah'],
            ['kode_lokasi' => 'LOK-018', 'nama_lokasi' => 'Ruang Guru', 'deskripsi' => 'Ruang istirahat dan kerja para guru'],
            ['kode_lokasi' => 'LOK-019', 'nama_lokasi' => 'Ruang Kepala Sekolah', 'deskripsi' => 'Ruang kerja khusus Kepala Sekolah'],
            ['kode_lokasi' => 'LOK-020', 'nama_lokasi' => 'Ruang Tata Usaha', 'deskripsi' => 'Pusat administrasi sekolah'],
            ['kode_lokasi' => 'LOK-021', 'nama_lokasi' => 'Lapangan Olahraga', 'deskripsi' => 'Lapangan upacara dan olahraga'],
            ['kode_lokasi' => 'LOK-022', 'nama_lokasi' => 'Aula Serbaguna', 'deskripsi' => 'Gedung pertemuan sekolah'],
            ['kode_lokasi' => 'LOK-023', 'nama_lokasi' => 'Masjid Sekolah', 'deskripsi' => 'Fasilitas ibadah siswa dan guru'],
            ['kode_lokasi' => 'LOK-024', 'nama_lokasi' => 'Kantin Sekolah', 'deskripsi' => 'Area makan dan istirahat siswa'],
            ['kode_lokasi' => 'LOK-025', 'nama_lokasi' => 'Gudang Sarpras', 'deskripsi' => 'Gudang penyimpanan aset sekolah'],
        ];

        DB::table('lokasis')->insert($lokasis);
    }
}