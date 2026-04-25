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
            ['serah' => 'Menunggu',  'terima' => 'Disetujui'],   // Menunggu Konfirmasi Penerima
            ['serah' => 'Menunggu',  'terima' => 'Menunggu'],    // Draft / Baru Dibuat
            ['serah' => 'Dibatalkan', 'terima' => 'Menunggu'],   // Dibatalkan Pengirim
            ['serah' => 'Menunggu',  'terima' => 'Dibatalkan'],   // Dibatalkan Pengirim
            ['serah' => 'Disetujui', 'terima' => 'Dibatalkan'],  // Ditolak Penerima
        ];

        // 3. Kumpulkan ID user yang tersedia dari database
        $userIds = User::pluck('id')->toArray(); // [1,2,3,4,5,6,7,8,9,10,11,12,13,14]

        // 4. Kumpulkan ID barang yang tersedia
        $barangIds = Barang::pluck('id')->toArray(); // [1..45]

        for ($i = 1; $i <= 30; $i++) {
            // Pilih barang secara acak dari semua barang yang ada
            $barangId = $barangIds[array_rand($barangIds)];

            // Pilih user serah dan terima secara acak (pastikan berbeda)
            do {
                $userSerahId = $userIds[array_rand($userIds)];
                $userTerimaId = $userIds[array_rand($userIds)];
            } while ($userSerahId == $userTerimaId);

            // Ambil status secara acak dari skenario
            $status = $skenarioStatus[array_rand($skenarioStatus)];

            // 5. Simpan data ke Database
            $bast = Bast::create([
                'barang_id'      => $barangId,
                'user_serah_id'  => $userSerahId,
                'user_terima_id' => $userTerimaId,
                'status_serah'   => $status['serah'],
                'status_terima'  => $status['terima'],
                'file_export'    => null,
                'created_at'     => now()->subDays(30 - $i)->addHours($i),
                'updated_at'     => now()->subDays(30 - $i)->addHours($i),
            ]);

            // 6. Logika Pembuatan PDF (Sama dengan Controller)
            $tanggal = Carbon::parse($bast->created_at);

            $pdf = Pdf::loadView('dashboard.bast.dokumen', [
                'bast'            => $bast,
                'hari'            => strtoupper($tanggal->translatedFormat('l')),
                'tanggal'         => strtoupper(Terbilang::make($tanggal->day)),
                'bulan'           => strtoupper($tanggal->translatedFormat('F')),
                'tahun_terbilang' => strtoupper(Terbilang::make($tanggal->year)),
            ])->setPaper('a4', 'portrait');

            // 7. Simpan file PDF ke storage
            $filename = 'Bast-' . $bast->id . '.pdf';
            $path = 'bast-pdf/' . $filename;
            Storage::put($path, $pdf->output());

            // 8. Update database dengan path file yang benar
            $bast->update([
                'file_export' => $path,
            ]);
        }
    }
}