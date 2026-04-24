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
            ['kode_lokasi' => 'GDP-001', 'nama_lokasi' => 'Gudang Pusat', 'deskripsi' => 'Gudang utama penyimpanan barang', 'created_at' => now(), 'updated_at' => now()],
            ['kode_lokasi' => 'SRV-002', 'nama_lokasi' => 'Ruang Server', 'deskripsi' => 'Ruangan khusus server dan jaringan', 'created_at' => now(), 'updated_at' => now()],
            ['kode_lokasi' => 'RIT-003', 'nama_lokasi' => 'Ruang IT', 'deskripsi' => 'Ruangan divisi IT', 'created_at' => now(), 'updated_at' => now()],
            ['kode_lokasi' => 'HRD-004', 'nama_lokasi' => 'Ruang HRD', 'deskripsi' => 'Ruangan divisi HRD', 'created_at' => now(), 'updated_at' => now()],
            ['kode_lokasi' => 'FIN-005', 'nama_lokasi' => 'Ruang Finance', 'deskripsi' => 'Ruangan divisi keuangan', 'created_at' => now(), 'updated_at' => now()],
            ['kode_lokasi' => 'MKT-006', 'nama_lokasi' => 'Ruang Marketing', 'deskripsi' => 'Ruangan divisi marketing', 'created_at' => now(), 'updated_at' => now()],
            ['kode_lokasi' => 'OPS-007', 'nama_lokasi' => 'Ruang Operasional', 'deskripsi' => 'Ruangan tim operasional', 'created_at' => now(), 'updated_at' => now()],
            ['kode_lokasi' => 'PAN-008', 'nama_lokasi' => 'Pantry', 'deskripsi' => 'Area pantry kantor', 'created_at' => now(), 'updated_at' => now()],
            ['kode_lokasi' => 'RPT-009', 'nama_lokasi' => 'Ruang Rapat', 'deskripsi' => 'Ruangan untuk meeting', 'created_at' => now(), 'updated_at' => now()],
            ['kode_lokasi' => 'LOB-010', 'nama_lokasi' => 'Lobi', 'deskripsi' => 'Area lobi/tamu', 'created_at' => now(), 'updated_at' => now()],

            // --- DATA BARU ---
            ['kode_lokasi' => 'K7A-011', 'nama_lokasi' => 'Ruang Kelas 7A', 'deskripsi' => 'Ruang belajar siswa kelas 7A', 'created_at' => now(), 'updated_at' => now()],
            ['kode_lokasi' => 'K8A-012', 'nama_lokasi' => 'Ruang Kelas 8A', 'deskripsi' => 'Ruang belajar siswa kelas 8A', 'created_at' => now(), 'updated_at' => now()],
            ['kode_lokasi' => 'K9A-013', 'nama_lokasi' => 'Ruang Kelas 9A', 'deskripsi' => 'Ruang belajar siswa kelas 9A', 'created_at' => now(), 'updated_at' => now()],
            ['kode_lokasi' => 'LIP-014', 'nama_lokasi' => 'Laboratorium IPA', 'deskripsi' => 'Ruang praktik fisika dan biologi', 'created_at' => now(), 'updated_at' => now()],
            ['kode_lokasi' => 'LKO-015', 'nama_lokasi' => 'Laboratorium Komputer', 'deskripsi' => 'Ruang praktik TIK', 'created_at' => now(), 'updated_at' => now()],
            ['kode_lokasi' => 'PER-016', 'nama_lokasi' => 'Perpustakaan', 'deskripsi' => 'Pusat literasi dan buku', 'created_at' => now(), 'updated_at' => now()],
            ['kode_lokasi' => 'UKS-017', 'nama_lokasi' => 'Ruang UKS', 'deskripsi' => 'Unit Kesehatan Sekolah', 'created_at' => now(), 'updated_at' => now()],
            ['kode_lokasi' => 'RGU-018', 'nama_lokasi' => 'Ruang Guru', 'deskripsi' => 'Ruang istirahat dan kerja para guru', 'created_at' => now(), 'updated_at' => now()],
            ['kode_lokasi' => 'RKS-019', 'nama_lokasi' => 'Ruang Kepala Sekolah', 'deskripsi' => 'Ruang kerja khusus Kepala Sekolah', 'created_at' => now(), 'updated_at' => now()],
            ['kode_lokasi' => 'RTU-020', 'nama_lokasi' => 'Ruang Tata Usaha', 'deskripsi' => 'Pusat administrasi sekolah', 'created_at' => now(), 'updated_at' => now()],
            ['kode_lokasi' => 'LOR-021', 'nama_lokasi' => 'Lapangan Olahraga', 'deskripsi' => 'Lapangan upacara dan olahraga', 'created_at' => now(), 'updated_at' => now()],
            ['kode_lokasi' => 'AUL-022', 'nama_lokasi' => 'Aula Serbaguna', 'deskripsi' => 'Gedung pertemuan sekolah', 'created_at' => now(), 'updated_at' => now()],
            ['kode_lokasi' => 'MSJ-023', 'nama_lokasi' => 'Masjid Sekolah', 'deskripsi' => 'Fasilitas ibadah siswa dan guru', 'created_at' => now(), 'updated_at' => now()],
            ['kode_lokasi' => 'KNT-024', 'nama_lokasi' => 'Kantin Sekolah', 'deskripsi' => 'Area makan dan istirahat siswa', 'created_at' => now(), 'updated_at' => now()],
            ['kode_lokasi' => 'GSP-025', 'nama_lokasi' => 'Gudang Sarpras', 'deskripsi' => 'Gudang penyimpanan aset sekolah', 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('lokasis')->insert($lokasis);
    }
}
