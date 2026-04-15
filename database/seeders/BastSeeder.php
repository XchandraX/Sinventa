<?php
// database/seeders/BastSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class BastSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('basts')->truncate();
        Schema::enableForeignKeyConstraints();

        // Data BAST harus sesuai dengan data yang ada di BarangSeeder dan UserSeeder
        $basts = [
            // Barang BRG-001 (Monitor LED) diserahkan oleh Budi ke Siti
            [
                'barang_id' => 1,        // BRG-001: Monitor LED
                'user_serah_id' => 2,    // Budi Santoso (user_serah)
                'user_terima_id' => 3,   // Siti Rahayu (user_terima)
                'status_serah' => 'Disetujui',
                'status_terima' => 'Disetujui',
                'file_export' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Barang BRG-002 (Keyboard) diserahkan oleh Siti ke Anto
            [
                'barang_id' => 2,        // BRG-002: Keyboard Mechanical
                'user_serah_id' => 3,    // Siti Rahayu
                'user_terima_id' => 4,   // Anto Wijaya
                'status_serah' => 'Disetujui',
                'status_terima' => 'Menunggu',
                'file_export' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Barang BRG-004 (Kursi) diserahkan oleh Dewi ke Budi
            [
                'barang_id' => 4,        // BRG-004: Kursi Kantor
                'user_serah_id' => 5,    // Dewi Lestari
                'user_terima_id' => 2,   // Budi Santoso
                'status_serah' => 'Disetujui',
                'status_terima' => 'Disetujui',
                'file_export' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Barang BRG-007 (PC Desktop) diserahkan oleh Anto ke Dewi
            [
                'barang_id' => 7,        // BRG-007: PC Desktop Core i5
                'user_serah_id' => 4,    // Anto Wijaya
                'user_terima_id' => 5,   // Dewi Lestari
                'status_serah' => 'Menunggu',
                'status_terima' => 'Menunggu',
                'file_export' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Barang BRG-010 (Router) diserahkan oleh Chandra ke Budi
            [
                'barang_id' => 10,       // BRG-010: Router MikroTik
                'user_serah_id' => 1,    // Chandra Maulana (admin)
                'user_terima_id' => 2,   // Budi Santoso
                'status_serah' => 'Disetujui',
                'status_terima' => 'Disetujui',
                'file_export' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Barang BRG-013 (Whiteboard) diserahkan oleh Siti ke Anto
            [
                'barang_id' => 13,       // BRG-013: Whiteboard
                'user_serah_id' => 3,    // Siti Rahayu
                'user_terima_id' => 4,   // Anto Wijaya
                'status_serah' => 'Dibatalkan',
                'status_terima' => 'Menunggu',
                'file_export' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Barang BRG-014 (Proyektor) diserahkan oleh Chandra ke Dewi
            [
                'barang_id' => 14,       // BRG-014: Proyektor Epson
                'user_serah_id' => 1,    // Chandra Maulana
                'user_terima_id' => 5,   // Dewi Lestari
                'status_serah' => 'Disetujui',
                'status_terima' => 'Menunggu',
                'file_export' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('basts')->insert($basts);
    }
}