<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'nama_lengkap' => 'Chandra Maulana',
            'username' => 'Chandrx28',
            'email' => 'chx28@gmail.com',
            'role' => 'admin',
            'lembaga' => 'Siswa',
            'password' => 'admin28'

        ]);
    }
}
