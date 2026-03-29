<?php

namespace Database\Factories;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Lokasi;
use Illuminate\Database\Eloquent\Factories\Factory;

class BarangFactory extends Factory
{
    protected static $sequence = null;

    public function definition(): array
    {
        if (self::$sequence === null) {
            self::$sequence = Barang::max('id') ?? 0;
        }

        self::$sequence++;

        // Hasil: BRG011, BRG012, dst
        $kodeBarang = 'BRG' . str_pad(self::$sequence, 3, '0', STR_PAD_LEFT);

        $kategori = Kategori::inRandomOrder()->first();
        $lokasi = Lokasi::inRandomOrder()->first();

        return [
            'kode_barang'   => $kodeBarang,
            // Hasil murni nama barang: "Laptop Asus"
            'nama_barang'   => $this->generateNamaBarang($kategori->nama_kategori),
            'kategori_id'   => $kategori->id,
            'lokasi_id'     => $lokasi->id,
            'status_barang' => $this->faker->randomElement(['Baik', 'Rusak Ringan', 'Rusak Berat', 'Hilang']),
            'deskripsi'     => null, // Perbaikan: gunakan null, bukan null()
            'created_at'    => now(),
            'updated_at'    => now(),
        ];
    }

    private function generateNamaBarang($namaKategori): string
    {
        $brands = [
            'Elektronik' => ['Epson', 'Samsung', 'LG', 'Sharp', 'Panasonic'],
            'Komputer'   => ['Asus', 'Acer', 'Lenovo', 'HP', 'Dell', 'MSI'],
            'Jaringan'   => ['TP-Link', 'Cisco', 'Mikrotik', 'Logitech', 'Totolink'],
            'Audio'      => ['Polytron', 'Simbadda', 'JBL', 'Yamaha', 'Sony'],
            'Furniture'  => ['Olympic', 'IKEA', 'Informa', 'Chitose'],
            'Keamanan'   => ['Hikvision', 'Dahua', 'Ezviz'],
            'Video'      => ['Canon', 'Sony', 'Nikon', 'Panasonic', 'Fujifilm'],
        ];

        $items = [
            'Elektronik' => ['Proyektor', 'Televisi', 'Printer', 'AC Split', 'Dispenser'],
            'Furniture'  => ['Meja Kerja', 'Kursi Putar', 'Lemari Arsip', 'Papan Tulis', 'Rak Buku'],
            'Komputer'   => ['Laptop', 'PC Desktop', 'Monitor LED', 'Keyboard Bundle'],
            'Jaringan'   => ['Router', 'Switch Hub', 'Access Point', 'Modem'],
            'Audio'      => ['Speaker Active', 'Microphone Wireless', 'Mixer Audio'],
            'Keamanan'   => ['Kamera CCTV', 'IP Cam Outdoor', 'DVR Unit'],
            'Video'      => ['Kamera DSLR', 'Handycam', 'Tripod Professional', 'Layar Proyektor'],
        ];

        $item = $this->faker->randomElement($items[$namaKategori] ?? ['Barang Inventaris']);
        $brand = $this->faker->randomElement($brands[$namaKategori] ?? ['Maspion', 'Krisbow']);

        // Mengembalikan hanya Nama Barang + Merk saja
        return "{$item} {$brand}";
    }
}