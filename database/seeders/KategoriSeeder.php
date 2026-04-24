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
        Schema::disableForeignKeyConstraints();
        DB::table('kategoris')->truncate();
        Schema::enableForeignKeyConstraints();

        $kategoris = [
            // --- DATA LAMA ---
            ['kode_kategori' => 'ELK-001', 'nama_kategori' => 'Elektronik', 'deskripsi' => 'Perangkat elektronik dan gadget', 'created_at' => now(), 'updated_at' => now()],
            ['kode_kategori' => 'FRN-002', 'nama_kategori' => 'Furniture', 'deskripsi' => 'Perabotan kantor dan rumah', 'created_at' => now(), 'updated_at' => now()],
            ['kode_kategori' => 'ALT-003', 'nama_kategori' => 'Alat Tulis', 'deskripsi' => 'Perlengkapan tulis kantor', 'created_at' => now(), 'updated_at' => now()],
            ['kode_kategori' => 'KOM-004', 'nama_kategori' => 'Komputer', 'deskripsi' => 'Perangkat komputer dan aksesoris', 'created_at' => now(), 'updated_at' => now()],
            ['kode_kategori' => 'JAR-005', 'nama_kategori' => 'Jaringan', 'deskripsi' => 'Perangkat jaringan internet', 'created_at' => now(), 'updated_at' => now()],
            ['kode_kategori' => 'KND-006', 'nama_kategori' => 'Kendaraan', 'deskripsi' => 'Kendaraan operasional', 'created_at' => now(), 'updated_at' => now()],
            ['kode_kategori' => 'ALB-007', 'nama_kategori' => 'Alat Kebersihan', 'deskripsi' => 'Perlengkapan kebersihan', 'created_at' => now(), 'updated_at' => now()],
            ['kode_kategori' => 'APD-008', 'nama_kategori' => 'Peralatan Dapur', 'deskripsi' => 'Peralatan untuk pantry', 'created_at' => now(), 'updated_at' => now()],
            ['kode_kategori' => 'ATK-009', 'nama_kategori' => 'ATK', 'deskripsi' => 'Alat Tulis Kantor', 'created_at' => now(), 'updated_at' => now()],
            ['kode_kategori' => 'PLM-010', 'nama_kategori' => 'Perlengkapan Meeting', 'deskripsi' => 'Perlengkapan rapat dan presentasi', 'created_at' => now(), 'updated_at' => now()],

            // --- DATA BARU ---
            ['kode_kategori' => 'BKP-011', 'nama_kategori' => 'Buku Pelajaran', 'deskripsi' => 'Buku paket dan LKS siswa', 'created_at' => now(), 'updated_at' => now()],
            ['kode_kategori' => 'ALB-012', 'nama_kategori' => 'Alat Laboratorium', 'deskripsi' => 'Peralatan praktik sains dan kimia', 'created_at' => now(), 'updated_at' => now()],
            ['kode_kategori' => 'ALO-013', 'nama_kategori' => 'Alat Olahraga', 'deskripsi' => 'Peralatan praktik pendidikan jasmani', 'created_at' => now(), 'updated_at' => now()],
            ['kode_kategori' => 'ALM-014', 'nama_kategori' => 'Alat Musik', 'deskripsi' => 'Instrumen untuk pelajaran kesenian', 'created_at' => now(), 'updated_at' => now()],
            ['kode_kategori' => 'PSR-015', 'nama_kategori' => 'Perlengkapan Seni Rupa', 'deskripsi' => 'Bahan dan alat untuk melukis/menggambar', 'created_at' => now(), 'updated_at' => now()],
            ['kode_kategori' => 'UKS-016', 'nama_kategori' => 'Perlengkapan Medis UKS', 'deskripsi' => 'Obat dan alat pertolongan pertama', 'created_at' => now(), 'updated_at' => now()],
            ['kode_kategori' => 'PRM-017', 'nama_kategori' => 'Perlengkapan Pramuka', 'deskripsi' => 'Tenda, tongkat, dan alat kemah', 'created_at' => now(), 'updated_at' => now()],
            ['kode_kategori' => 'PLK-018', 'nama_kategori' => 'Perlengkapan Kelas', 'deskripsi' => 'Papan tulis, spidol, penghapus kelas', 'created_at' => now(), 'updated_at' => now()],
            ['kode_kategori' => 'SRG-019', 'nama_kategori' => 'Seragam Sekolah', 'deskripsi' => 'Stok seragam siswa dan atribut', 'created_at' => now(), 'updated_at' => now()],
            ['kode_kategori' => 'MBS-020', 'nama_kategori' => 'Meubelair Sekolah', 'deskripsi' => 'Meja dan kursi khusus siswa/guru', 'created_at' => now(), 'updated_at' => now()],
            ['kode_kategori' => 'EKS-021', 'nama_kategori' => 'Ekstrakurikuler', 'deskripsi' => 'Alat pendukung kegiatan ekskul lainnya', 'created_at' => now(), 'updated_at' => now()],
            ['kode_kategori' => 'MPB-022', 'nama_kategori' => 'Media Pembelajaran', 'deskripsi' => 'Alat peraga edukatif (peta, torso, globe)', 'created_at' => now(), 'updated_at' => now()],
            ['kode_kategori' => 'DKA-023', 'nama_kategori' => 'Dokumen & Arsip', 'deskripsi' => 'Map, buku induk, dan rapor siswa', 'created_at' => now(), 'updated_at' => now()],
            ['kode_kategori' => 'AKS-024', 'nama_kategori' => 'Alat Kebersihan Sekolah', 'deskripsi' => 'Sapu, pel, tempat sampah untuk area sekolah', 'created_at' => now(), 'updated_at' => now()],
            ['kode_kategori' => 'PIB-025', 'nama_kategori' => 'Perlengkapan Ibadah', 'deskripsi' => 'Fasilitas untuk masjid/musholla sekolah', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('kategoris')->insert($kategoris);
    }
}
