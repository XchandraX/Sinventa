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
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            // untuk menyimpan data kode_barang | maks 20 kara | tipe unik
            $table->string('kode_barang', 20)->unique();

            // untuk menyimpan data nama_barang | maks 100 kara
            $table->string('nama_barang', 100);

            // untuk menyimpan data kategori_id 
            // jika kategori di hapus, semua data barang yang memiliki id kategori tersebut juga akan ikut terhapus
            $table->integer('kategori_id')->constrained('kategoris')->onDelete('cascade');

            /*
                untuk menyimpan data lokasi_id
                jika lokasi di hapus, smeua data barang yang memiliki id lokasi tersebut juga akan ikut terhapus
            */
            $table->integer('lokasi_id')->constrained('lokasis')->onDelete('cascade');

            // untuk menyimpan status barang | pilihannya hanya Baik, Rusak Ringan, Rusak Berat, dan Hilang, selain itu akan error
            $table->enum('status_barang', ['Baik', 'Rusak Ringan', 'Rusak Berat', 'Hilang'])->default('Baik');

            // untuk menyimpan deskripsi barang (ini tambahan)
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
