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
            ['id' => 1, 'nama_lengkap' => 'Chandra Maulana', 'username' => 'Chandrx28', 'email' => 'chandra@sinvesta.com', 'role' => 'root', 'lembaga' => 'Siswa Rpl', 'password' => Hash::make('admin123')],
            ['id' => 4, 'nama_lengkap' => 'Anto Wijaya', 'username' => 'Anto', 'email' => 'anto@sinvesta.com', 'role' => 'admin', 'lembaga' => 'Guru Rpl', 'password' => Hash::make('admin123')],
            ['id' => 2, 'nama_lengkap' => 'Budi Santoso', 'username' => 'budi', 'email' => 'budi@sinvesta.com', 'role' => 'user', 'lembaga' => 'Staf TU', 'password' => Hash::make('admin123')],
            ['id' => 3, 'nama_lengkap' => 'Siti Rahayu', 'username' => 'siti', 'email' => 'siti@sinvesta.com', 'role' => 'user', 'lembaga' => 'Guru Matematika', 'password' => Hash::make('admin123')],
            ['id' => 5, 'nama_lengkap' => 'Dewi Lestari', 'username' => 'dewi.lestari', 'email' => 'dewi@sinvesta.com', 'role' => 'user', 'lembaga' => 'Siswa Tkj', 'password' => Hash::make('admin123')],
            
            // Tambahan User untuk mencukupi kebutuhan BastSeeder (ID 6 - 14)
            ['id' => 6, 'nama_lengkap' => 'Eko Prasetyo', 'username' => 'eko.pras', 'email' => 'eko@sinvesta.com', 'role' => 'user', 'lembaga' => 'Sarpras', 'password' => Hash::make('admin123')],
            ['id' => 7, 'nama_lengkap' => 'Fajar Nugraha', 'username' => 'fajar.nug', 'email' => 'fajar@sinvesta.com', 'role' => 'user', 'lembaga' => 'Laboran', 'password' => Hash::make('admin123')],
            ['id' => 8, 'nama_lengkap' => 'Gita Permata', 'username' => 'gita.p', 'email' => 'gita@sinvesta.com', 'role' => 'user', 'lembaga' => 'Perpustakaan', 'password' => Hash::make('admin123')],
            ['id' => 9, 'nama_lengkap' => 'Hendra Kurnia', 'username' => 'hendra.k', 'email' => 'hendra@sinvesta.com', 'role' => 'user', 'lembaga' => 'Kesiswaan', 'password' => Hash::make('admin123')],
            ['id' => 10, 'nama_lengkap' => 'Indah Sari', 'username' => 'indah.s', 'email' => 'indah@sinvesta.com', 'role' => 'user', 'lembaga' => 'Bendahara', 'password' => Hash::make('admin123')],
            ['id' => 11, 'nama_lengkap' => 'Joko Susilo', 'username' => 'joko.s', 'email' => 'joko@sinvesta.com', 'role' => 'user', 'lembaga' => 'Keamanan', 'password' => Hash::make('admin123')],
            ['id' => 12, 'nama_lengkap' => 'Kiki Amalia', 'username' => 'kiki.a', 'email' => 'kiki@sinvesta.com', 'role' => 'user', 'lembaga' => 'Kebersihan', 'password' => Hash::make('admin123')],
            ['id' => 13, 'nama_lengkap' => 'Lutfi Hakim', 'username' => 'lutfi.h', 'email' => 'lutfi@sinvesta.com', 'role' => 'user', 'lembaga' => 'UKS', 'password' => Hash::make('admin123')],
            ['id' => 14, 'nama_lengkap' => 'Maya Sofa', 'username' => 'maya.s', 'email' => 'maya@sinvesta.com', 'role' => 'user', 'lembaga' => 'Konseling', 'password' => Hash::make('admin123')],
        ];

        foreach ($users as $user) {
            DB::table('users')->insert(array_merge($user, [
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}