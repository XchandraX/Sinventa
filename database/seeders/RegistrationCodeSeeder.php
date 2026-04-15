<?php

namespace Database\Seeders;

use App\Models\RegistrationCode;
use Illuminate\Database\Seeder;

class RegistrationCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        RegistrationCode::create(['code' => 'PROMO2024']);
    }
}
