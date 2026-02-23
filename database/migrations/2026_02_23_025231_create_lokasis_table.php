<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lokasis', function (Blueprint $table) {
            $table->id();
            // untuk menyimpan data kode_lokasi | maks 20 karatker | harus unik
            $table->string('kode_lokasi', 20)->unique();
            // untuk menyimpan data nama_loksai | maks 100 karat
            $table->string('nama_lokasi', 100);
            // untuk menyimpan data deskripsi | text muat banyak | boleh kosong
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lokasis');
    }
};
