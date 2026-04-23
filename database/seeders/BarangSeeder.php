<?php
// database/seeders/BarangSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('barangs')->truncate();
        Schema::enableForeignKeyConstraints();

        $barangs = [
            // --- DATA LAMA ---
            ['kode_barang' => 'BRG-001', 'nama_barang' => 'Monitor LED 24 Inch Samsung', 'kategori_id' => 1, 'lokasi_id' => 1, 'status_barang' => 'Baik', 'deskripsi' => 'Monitor LED ukuran 24 inch', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG-002', 'nama_barang' => 'Keyboard Mechanical Logitech', 'kategori_id' => 1, 'lokasi_id' => 3, 'status_barang' => 'Baik', 'deskripsi' => 'Keyboard mechanical', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG-003', 'nama_barang' => 'Mouse Wireless Logitech', 'kategori_id' => 1, 'lokasi_id' => 4, 'status_barang' => 'Rusak Ringan', 'deskripsi' => 'Mouse wireless', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG-004', 'nama_barang' => 'Kursi Kantor Olympic', 'kategori_id' => 2, 'lokasi_id' => 5, 'status_barang' => 'Baik', 'deskripsi' => 'Kursi kantor', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG-005', 'nama_barang' => 'Meja Kerja IKEA', 'kategori_id' => 2, 'lokasi_id' => 6, 'status_barang' => 'Baik', 'deskripsi' => 'Meja kerja 120x60 cm', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG-006', 'nama_barang' => 'Lemari Arsip Chitose', 'kategori_id' => 2, 'lokasi_id' => 1, 'status_barang' => 'Rusak Berat', 'deskripsi' => 'Lemari arsip 4 laci', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG-007', 'nama_barang' => 'PC Desktop Core i5 Dell', 'kategori_id' => 4, 'lokasi_id' => 3, 'status_barang' => 'Baik', 'deskripsi' => 'PC Desktop', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG-008', 'nama_barang' => 'Laptop ASUS Zenbook', 'kategori_id' => 4, 'lokasi_id' => 4, 'status_barang' => 'Baik', 'deskripsi' => 'Laptop direktur', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG-009', 'nama_barang' => 'MacBook Pro Apple', 'kategori_id' => 4, 'lokasi_id' => 5, 'status_barang' => 'Hilang', 'deskripsi' => 'Laptop MacBook', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG-010', 'nama_barang' => 'Router MikroTik', 'kategori_id' => 5, 'lokasi_id' => 2, 'status_barang' => 'Baik', 'deskripsi' => 'Router manajemen', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG-011', 'nama_barang' => 'Switch 24 Port TP-Link', 'kategori_id' => 5, 'lokasi_id' => 2, 'status_barang' => 'Baik', 'deskripsi' => 'Switch jaringan', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG-012', 'nama_barang' => 'Access Point TP-Link', 'kategori_id' => 5, 'lokasi_id' => 10, 'status_barang' => 'Rusak Ringan', 'deskripsi' => 'Access Point WiFi', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG-013', 'nama_barang' => 'Whiteboard Joyko', 'kategori_id' => 3, 'lokasi_id' => 9, 'status_barang' => 'Baik', 'deskripsi' => 'Whiteboard 90x120 cm', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG-014', 'nama_barang' => 'Proyektor Epson', 'kategori_id' => 10, 'lokasi_id' => 9, 'status_barang' => 'Baik', 'deskripsi' => 'Proyektor presentasi', 'created_at' => now(), 'updated_at' => now()],

            // --- DATA BARU (30 Barang Sekolah) ---
            // ID Kategori Baru: 11-25 | ID Lokasi Baru: 11-25
            ['kode_barang' => 'BRG-015', 'nama_barang' => 'Papan Tulis Kapur', 'kategori_id' => 18, 'lokasi_id' => 11, 'status_barang' => 'Baik', 'deskripsi' => 'Papan tulis kelas 7A', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG-016', 'nama_barang' => 'Mikroskop Binokuler', 'kategori_id' => 12, 'lokasi_id' => 14, 'status_barang' => 'Baik', 'deskripsi' => 'Alat lab IPA', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG-017', 'nama_barang' => 'Bola Basket Spalding', 'kategori_id' => 13, 'lokasi_id' => 21, 'status_barang' => 'Baik', 'deskripsi' => 'Bola untuk ekskul', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG-018', 'nama_barang' => 'Gitar Akustik Yamaha', 'kategori_id' => 14, 'lokasi_id' => 22, 'status_barang' => 'Baik', 'deskripsi' => 'Gitar untuk seni musik', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG-019', 'nama_barang' => 'Tandu Lipat Medis', 'kategori_id' => 16, 'lokasi_id' => 17, 'status_barang' => 'Baik', 'deskripsi' => 'Tandu darurat UKS', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG-020', 'nama_barang' => 'Buku Cetak Matematika Kls 7', 'kategori_id' => 11, 'lokasi_id' => 16, 'status_barang' => 'Rusak Ringan', 'deskripsi' => 'Buku paket perpustakaan', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG-021', 'nama_barang' => 'Meja Guru Utama', 'kategori_id' => 20, 'lokasi_id' => 18, 'status_barang' => 'Baik', 'deskripsi' => 'Meja kayu jati', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG-022', 'nama_barang' => 'Tenda Regu Pramuka', 'kategori_id' => 17, 'lokasi_id' => 25, 'status_barang' => 'Baik', 'deskripsi' => 'Tenda kapasitas 10 orang', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG-023', 'nama_barang' => 'Kanvas Lukis 40x60', 'kategori_id' => 15, 'lokasi_id' => 12, 'status_barang' => 'Baik', 'deskripsi' => 'Kanvas ujian praktek', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG-024', 'nama_barang' => 'Proyektor Mini Infocus', 'kategori_id' => 22, 'lokasi_id' => 15, 'status_barang' => 'Baik', 'deskripsi' => 'Proyektor lab komputer', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG-025', 'nama_barang' => 'Lemari Arsip Besi 2 Pintu', 'kategori_id' => 23, 'lokasi_id' => 20, 'status_barang' => 'Baik', 'deskripsi' => 'Penyimpanan dokumen TU', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG-026', 'nama_barang' => 'Sapu Lidi Gagang Panjang', 'kategori_id' => 24, 'lokasi_id' => 21, 'status_barang' => 'Rusak Ringan', 'deskripsi' => 'Sapu lapangan', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG-027', 'nama_barang' => 'Sajadah Roll Panjang', 'kategori_id' => 25, 'lokasi_id' => 23, 'status_barang' => 'Baik', 'deskripsi' => 'Sajadah jamaah masjid', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG-028', 'nama_barang' => 'Buku Induk Siswa', 'kategori_id' => 23, 'lokasi_id' => 19, 'status_barang' => 'Baik', 'deskripsi' => 'Buku catatan kepsek', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG-029', 'nama_barang' => 'Rak Buku Kayu 3 Susun', 'kategori_id' => 20, 'lokasi_id' => 16, 'status_barang' => 'Baik', 'deskripsi' => 'Rak novel perpustakaan', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG-030', 'nama_barang' => 'Tabung Reaksi Kaca', 'kategori_id' => 12, 'lokasi_id' => 14, 'status_barang' => 'Baik', 'deskripsi' => 'Alat uji kimia', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG-031', 'nama_barang' => 'Net Bola Voli', 'kategori_id' => 13, 'lokasi_id' => 21, 'status_barang' => 'Rusak Berat', 'deskripsi' => 'Jaring net robek', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG-032', 'nama_barang' => 'Keyboard Sintesizer PSR', 'kategori_id' => 14, 'lokasi_id' => 22, 'status_barang' => 'Baik', 'deskripsi' => 'Keyboard paduan suara', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG-033', 'nama_barang' => 'Timbangan Badan & Tinggi', 'kategori_id' => 16, 'lokasi_id' => 17, 'status_barang' => 'Baik', 'deskripsi' => 'Alat ukur kesehatan siswa', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG-034', 'nama_barang' => 'Globe Bumi Ukuran Sedang', 'kategori_id' => 22, 'lokasi_id' => 16, 'status_barang' => 'Baik', 'deskripsi' => 'Media ajar geografi', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG-035', 'nama_barang' => 'Kursi Siswa Besi Kayu', 'kategori_id' => 20, 'lokasi_id' => 13, 'status_barang' => 'Baik', 'deskripsi' => 'Kursi kelas 9A', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG-036', 'nama_barang' => 'Peta Indonesia Pigura', 'kategori_id' => 22, 'lokasi_id' => 11, 'status_barang' => 'Baik', 'deskripsi' => 'Hiasan dinding edukasi', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG-037', 'nama_barang' => 'Tongkat Pramuka', 'kategori_id' => 17, 'lokasi_id' => 25, 'status_barang' => 'Baik', 'deskripsi' => 'Tongkat bambu', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG-038', 'nama_barang' => 'Set Cat Air Joyko', 'kategori_id' => 15, 'lokasi_id' => 12, 'status_barang' => 'Baik', 'deskripsi' => 'Cat air untuk ujian', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG-039', 'nama_barang' => 'PC Client Lab Lenovo', 'kategori_id' => 4, 'lokasi_id' => 15, 'status_barang' => 'Baik', 'deskripsi' => 'Komputer ujian CBT', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG-040', 'nama_barang' => 'Router Kelas TP-Link', 'kategori_id' => 5, 'lokasi_id' => 15, 'status_barang' => 'Baik', 'deskripsi' => 'WiFi untuk lab komputer', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG-041', 'nama_barang' => 'Jam Dinding Seiko', 'kategori_id' => 18, 'lokasi_id' => 13, 'status_barang' => 'Rusak Ringan', 'deskripsi' => 'Baterai habis/mati', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG-042', 'nama_barang' => 'Alat Pel Dorong', 'kategori_id' => 24, 'lokasi_id' => 20, 'status_barang' => 'Baik', 'deskripsi' => 'Pel ruang TU', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG-043', 'nama_barang' => 'Mukena Katun', 'kategori_id' => 25, 'lokasi_id' => 23, 'status_barang' => 'Baik', 'deskripsi' => 'Mukena jamaah putri', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG-044', 'nama_barang' => 'Buku Cetak Bahasa Indonesia', 'kategori_id' => 11, 'lokasi_id' => 16, 'status_barang' => 'Baik', 'deskripsi' => 'Buku referensi guru', 'created_at' => now(), 'updated_at' => now()],
            ['kode_barang' => 'BRG-045', 'nama_barang' => 'Buku Cetak Bahasa Indonesia', 'kategori_id' => 11, 'lokasi_id' => 16, 'status_barang' => 'Baik', 'deskripsi' => 'Buku referensi guru', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('barangs')->insert($barangs);
    }
}