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
            // Elektronik (Kategori ID 1)
            [
                'kode_barang' => 'BRG-001',
                'nama_barang' => 'Monitor LED 24 Inch Samsung',
                'kategori_id' => 1,
                'lokasi_id' => 1,
                'status_barang' => 'Baik',
                'deskripsi' => 'Monitor LED ukuran 24 inch untuk keperluan kantor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_barang' => 'BRG-002',
                'nama_barang' => 'Keyboard Mechanical Logitech',
                'kategori_id' => 1,
                'lokasi_id' => 3,
                'status_barang' => 'Baik',
                'deskripsi' => 'Keyboard mechanical untuk programmer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_barang' => 'BRG-003',
                'nama_barang' => 'Mouse Wireless Logitech',
                'kategori_id' => 1,
                'lokasi_id' => 4,
                'status_barang' => 'Rusak Ringan',
                'deskripsi' => 'Mouse wireless, scroll agak macet',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Furniture (Kategori ID 2)
            [
                'kode_barang' => 'BRG-004',
                'nama_barang' => 'Kursi Kantor Olympic',
                'kategori_id' => 2,
                'lokasi_id' => 5,
                'status_barang' => 'Baik',
                'deskripsi' => 'Kursi kantor dengan sandaran tinggi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_barang' => 'BRG-005',
                'nama_barang' => 'Meja Kerja IKEA',
                'kategori_id' => 2,
                'lokasi_id' => 6,
                'status_barang' => 'Baik',
                'deskripsi' => 'Meja kerja ukuran 120x60 cm',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_barang' => 'BRG-006',
                'nama_barang' => 'Lemari Arsip Chitose',
                'kategori_id' => 2,
                'lokasi_id' => 1,
                'status_barang' => 'Rusak Berat',
                'deskripsi' => 'Lemari arsip 4 laci, laci depan rusak',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Komputer (Kategori ID 4)
            [
                'kode_barang' => 'BRG-007',
                'nama_barang' => 'PC Desktop Core i5 Dell',
                'kategori_id' => 4,
                'lokasi_id' => 3,
                'status_barang' => 'Baik',
                'deskripsi' => 'PC Desktop untuk development',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_barang' => 'BRG-008',
                'nama_barang' => 'Laptop ASUS Zenbook',
                'kategori_id' => 4,
                'lokasi_id' => 4,
                'status_barang' => 'Baik',
                'deskripsi' => 'Laptop untuk direktur',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_barang' => 'BRG-009',
                'nama_barang' => 'MacBook Pro Apple',
                'kategori_id' => 4,
                'lokasi_id' => 5,
                'status_barang' => 'Hilang',
                'deskripsi' => 'Laptop MacBook untuk desainer, dilaporkan hilang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Jaringan (Kategori ID 5)
            [
                'kode_barang' => 'BRG-010',
                'nama_barang' => 'Router MikroTik',
                'kategori_id' => 5,
                'lokasi_id' => 2,
                'status_barang' => 'Baik',
                'deskripsi' => 'Router untuk manajemen jaringan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_barang' => 'BRG-011',
                'nama_barang' => 'Switch 24 Port TP-Link',
                'kategori_id' => 5,
                'lokasi_id' => 2,
                'status_barang' => 'Baik',
                'deskripsi' => 'Switch jaringan 24 port Gigabit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_barang' => 'BRG-012',
                'nama_barang' => 'Access Point TP-Link',
                'kategori_id' => 5,
                'lokasi_id' => 10,
                'status_barang' => 'Rusak Ringan',
                'deskripsi' => 'Access Point WiFi, sinyal kadang putus',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Alat Tulis (Kategori ID 3)
            [
                'kode_barang' => 'BRG-013',
                'nama_barang' => 'Whiteboard Joyko',
                'kategori_id' => 3,
                'lokasi_id' => 9,
                'status_barang' => 'Baik',
                'deskripsi' => 'Whiteboard ukuran 90x120 cm',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Perlengkapan Meeting (Kategori ID 10)
            [
                'kode_barang' => 'BRG-014',
                'nama_barang' => 'Proyektor Epson',
                'kategori_id' => 10,
                'lokasi_id' => 9,
                'status_barang' => 'Baik',
                'deskripsi' => 'Proyektor untuk presentasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('barangs')->insert($barangs);
    }
}