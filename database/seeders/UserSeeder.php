<?php
// database/seeders/UserSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();
        Schema::enableForeignKeyConstraints();

        $users = [
            [
                'id' => 1,  // ID ditentukan agar sinkron dengan BastSeeder
                'nama_lengkap' => 'Chandra Maulana',
                'username' => 'Chandrx28',
                'email' => 'chandra@sinvesta.com',
                'role' => 'admin',
                'lembaga' => 'Siswa Rpl',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nama_lengkap' => 'Budi Santoso',
                'username' => 'budi',
                'email' => 'budi@sinvesta.com',
                'role' => 'user',
                'lembaga' => 'Staf TU',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'nama_lengkap' => 'Siti Rahayu',
                'username' => 'siti',
                'email' => 'siti@sinvesta.com',
                'role' => 'user',
                'lembaga' => 'Guru Matematika',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'nama_lengkap' => 'Anto Wijaya',
                'username' => 'Anto',
                'email' => 'anto@sinvesta.com',  // Perbaiki email dari agus@ ke anto@
                'role' => 'admin',
                'lembaga' => 'Guru Rpl',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'nama_lengkap' => 'Dewi Lestari',
                'username' => 'dewi.lestari',
                'email' => 'dewi@sinvesta.com',
                'role' => 'user',
                'lembaga' => 'PT Sinvesta Media',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('users')->insert($users);
    }
}