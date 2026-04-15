<?php
// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil semua seeder dengan urutan yang benar
         $this->call([
            RegistrationCodeSeeder::class,  // Tidak ada foreign key
            KategoriSeeder::class,          // Tidak ada foreign key
            LokasiSeeder::class,            // Tidak ada foreign key
            UserSeeder::class,              // Tidak ada foreign key ke tabel lain
            BarangSeeder::class,            // Bergantung pada Kategori & Lokasi
            BastSeeder::class,              // Bergantung pada Barang & User
        ]);

        // Gunakan factory untuk generate data tambahan (opsional)
        // \App\Models\User::factory(10)->create();
        // \App\Models\Barang::factory(50)->create();
    }
}