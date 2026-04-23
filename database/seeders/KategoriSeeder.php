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

            // --- DATA BARU (Disesuaikan menjadi KAT) ---
            ['kode_kategori' => 'KAT-011', 'nama_kategori' => 'Buku Pelajaran', 'deskripsi' => 'Buku paket dan LKS siswa'],
            ['kode_kategori' => 'KAT-012', 'nama_kategori' => 'Alat Laboratorium', 'deskripsi' => 'Peralatan praktik sains dan kimia'],
            ['kode_kategori' => 'KAT-013', 'nama_kategori' => 'Alat Olahraga', 'deskripsi' => 'Peralatan praktik pendidikan jasmani'],
            ['kode_kategori' => 'KAT-014', 'nama_kategori' => 'Alat Musik', 'deskripsi' => 'Instrumen untuk pelajaran kesenian'],
            ['kode_kategori' => 'KAT-015', 'nama_kategori' => 'Perlengkapan Seni Rupa', 'deskripsi' => 'Bahan dan alat untuk melukis/menggambar'],
            ['kode_kategori' => 'KAT-016', 'nama_kategori' => 'Perlengkapan Medis UKS', 'deskripsi' => 'Obat dan alat pertolongan pertama'],
            ['kode_kategori' => 'KAT-017', 'nama_kategori' => 'Perlengkapan Pramuka', 'deskripsi' => 'Tenda, tongkat, dan alat kemah'],
            ['kode_kategori' => 'KAT-018', 'nama_kategori' => 'Perlengkapan Kelas', 'deskripsi' => 'Papan tulis, spidol, penghapus kelas'],
            ['kode_kategori' => 'KAT-019', 'nama_kategori' => 'Seragam Sekolah', 'deskripsi' => 'Stok seragam siswa dan atribut'],
            ['kode_kategori' => 'KAT-020', 'nama_kategori' => 'Meubelair Sekolah', 'deskripsi' => 'Meja dan kursi khusus siswa/guru'],
            ['kode_kategori' => 'KAT-021', 'nama_kategori' => 'Ekstrakurikuler', 'deskripsi' => 'Alat pendukung kegiatan ekskul lainnya'],
            ['kode_kategori' => 'KAT-022', 'nama_kategori' => 'Media Pembelajaran', 'deskripsi' => 'Alat peraga edukatif (peta, torso, globe)'],
            ['kode_kategori' => 'KAT-023', 'nama_kategori' => 'Dokumen & Arsip', 'deskripsi' => 'Map, buku induk, dan rapor siswa'],
            ['kode_kategori' => 'KAT-024', 'nama_kategori' => 'Alat Kebersihan Sekolah', 'deskripsi' => 'Sapu, pel, tempat sampah untuk area sekolah'],
            ['kode_kategori' => 'KAT-025', 'nama_kategori' => 'Perlengkapan Ibadah', 'deskripsi' => 'Fasilitas untuk masjid/musholla sekolah'],
        ];

        DB::table('kategoris')->insert($kategoris);
    }
}