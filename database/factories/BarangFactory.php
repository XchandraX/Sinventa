<?php
// database/factories/BarangFactory.php

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

        // Hasil: BRG011, BRG012, dst (untuk data factory)
        $kodeBarang = 'BRG' . str_pad(self::$sequence, 3, '0', STR_PAD_LEFT);

        $kategori = Kategori::inRandomOrder()->first();
        $lokasi = Lokasi::inRandomOrder()->first();

        // Jika belum ada data kategori/lokasi, buat dummy dulu
        if (!$kategori) {
            $kategori = Kategori::factory()->create();
        }
        if (!$lokasi) {
            $lokasi = Lokasi::factory()->create();
        }

        return [
            'kode_barang'   => $kodeBarang,
            'nama_barang'   => $this->generateNamaBarang($kategori->nama_kategori),
            'kategori_id'   => $kategori->id,
            'lokasi_id'     => $lokasi->id,
            'status_barang' => $this->faker->randomElement(['Baik', 'Rusak Ringan', 'Rusak Berat', 'Hilang']),
            'deskripsi'     => $this->faker->optional(0.7)->sentence(10), // 70% terisi deskripsi
            'created_at'    => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at'    => now(),
        ];
    }

    private function generateNamaBarang($namaKategori): string
    {
        $brands = [
            'Elektronik' => ['Epson', 'Samsung', 'LG', 'Sharp', 'Panasonic', 'Philips', 'Sony'],
            'Komputer'   => ['Asus', 'Acer', 'Lenovo', 'HP', 'Dell', 'MSI', 'Apple'],
            'Jaringan'   => ['TP-Link', 'Cisco', 'Mikrotik', 'Logitech', 'Totolink', 'D-Link'],
            'Audio'      => ['Polytron', 'Simbadda', 'JBL', 'Yamaha', 'Sony', 'Bose'],
            'Furniture'  => ['Olympic', 'IKEA', 'Informa', 'Chitose', 'Dekson'],
            'Keamanan'   => ['Hikvision', 'Dahua', 'Ezviz', 'Xiaomi'],
            'Video'      => ['Canon', 'Sony', 'Nikon', 'Panasonic', 'Fujifilm'],
            'Alat Tulis' => ['Joyko', 'Kenko', 'Standard', 'Faber-Castell', 'Snowman'],
            'ATK'        => ['Joyko', 'Kenko', 'Standard', 'Faber-Castell', 'Snowman'],
            'Perlengkapan Meeting' => ['Epson', 'Polytron', 'Samsung', 'LG'],
        ];

        $items = [
            'Elektronik' => ['Proyektor', 'Televisi', 'Printer', 'AC Split', 'Dispenser', 'Kulkas', 'Microwave'],
            'Furniture'  => ['Meja Kerja', 'Kursi Putar', 'Lemari Arsip', 'Papan Tulis', 'Rak Buku', 'Sofa'],
            'Komputer'   => ['Laptop', 'PC Desktop', 'Monitor LED', 'Keyboard Bundle', 'Mouse', 'External HDD'],
            'Jaringan'   => ['Router', 'Switch Hub', 'Access Point', 'Modem', 'Kabel UTP', 'WiFi Extender'],
            'Audio'      => ['Speaker Active', 'Microphone Wireless', 'Mixer Audio', 'Headset', 'Sound System'],
            'Keamanan'   => ['Kamera CCTV', 'IP Cam Outdoor', 'DVR Unit', 'CCTV Kit', 'Fingerprint'],
            'Video'      => ['Kamera DSLR', 'Handycam', 'Tripod Professional', 'Layar Proyektor', 'Webcam'],
            'Alat Tulis' => ['Spidol Whiteboard', 'Penghapus', 'Penggaris', 'Stabilo', 'Paper Clip'],
            'ATK'        => ['Spidol Whiteboard', 'Penghapus', 'Penggaris', 'Stabilo', 'Paper Clip'],
            'Perlengkapan Meeting' => ['Proyektor', 'Wireless Presenter', 'Soundbar', 'TV 55 Inch'],
        ];

        $item = $this->faker->randomElement($items[$namaKategori] ?? ['Barang Inventaris', 'Perlengkapan Kantor', 'Aset Perusahaan']);
        $brand = $this->faker->randomElement($brands[$namaKategori] ?? ['Maspion', 'Krisbow', 'Miyako', 'Philips']);

        return "{$item} {$brand}";
    }
}