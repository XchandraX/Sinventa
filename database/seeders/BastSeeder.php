<?php

namespace Database\Seeders;

use App\Models\Bast;
use App\Models\User;
use App\Models\Barang;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Riskihajar\Terbilang\Facades\Terbilang;

class BastSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Bersihkan folder storage agar bersih
        Storage::deleteDirectory('bast-pdf');
        Storage::makeDirectory('bast-pdf');

        // 2. Daftar variasi skenario status (Serah - Terima)
        $skenarioStatus = [
            ['serah' => 'Disetujui', 'terima' => 'Disetujui'],   // Selesai
            ['serah' => 'Disetujui', 'terima' => 'Menunggu'],    // Menunggu Konfirmasi Penerima
            ['serah' => 'Menunggu', 'terima' => 'Disetujui'],    // Menunggu Konfirmasi Penerima
            ['serah' => 'Menunggu',  'terima' => 'Menunggu'],    // Draft / Baru Dibuat
            ['serah' => 'Dibatalkan', 'terima' => 'Menunggu'],   // Dibatalkan Pengirim
            ['serah' => 'Menunggu', 'terima' => 'Dibatalkan'],   // Dibatalkan Pengirim
            ['serah' => 'Disetujui', 'terima' => 'Dibatalkan'],  // Ditolak Penerima
        ];

        for ($i = 1; $i <= 30; $i++) {
            // Rotasi ID agar sinkron dengan User & Barang Seeder (1-14)
            $barangId = ($i % 14) ?: 14;
            $userSerahId = ($i % 14) ?: 1;
            $userTerimaId = (($i + 2) % 14) ?: 2; // +2 agar user serah & terima tidak sama

            // Ambil status secara acak dari skenario di atas
            $status = $skenarioStatus[array_rand($skenarioStatus)];

            // 3. Simpan data ke Database
            $bast = Bast::create([
                'barang_id'      => $barangId,
                'user_serah_id'  => $userSerahId,
                'user_terima_id' => $userTerimaId,
                'status_serah'   => $status['serah'],
                'status_terima'  => $status['terima'],
                'file_export'    => null, // Diupdate setelah PDF dibuat
                'created_at'     => now()->subDays(30 - $i)->addHours($i),
                'updated_at'     => now()->subDays(30 - $i)->addHours($i),
            ]);

            // 4. Logika Pembuatan PDF (Sama dengan Controller)
            $tanggal = Carbon::parse($bast->created_at);
            
            $pdf = Pdf::loadView('dashboard.bast.dokumen', [
                'bast'            => $bast,
                'hari'            => strtoupper($tanggal->translatedFormat('l')),
                'tanggal'         => strtoupper(Terbilang::make($tanggal->day)),
                'bulan'           => strtoupper($tanggal->translatedFormat('F')),
                'tahun_terbilang' => strtoupper(Terbilang::make($tanggal->year)),
            ])->setPaper('a4', 'portrait');

            // 5. Simpan file PDF ke storage
            $filename = 'Bast-' . $bast->id . '.pdf';
            $path = 'bast-pdf/' . $filename;
            Storage::put($path, $pdf->output());

            // 6. Update database dengan path file yang benar
            $bast->update([
                'file_export' => $path,
            ]);
        }
    }
}