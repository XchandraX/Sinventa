<?php

namespace App\Http\Controllers;

// ! panggil semua model agar bisa digunakaan
use App\Exports\BastExport;
use App\Models\Barang;
use App\Models\Bast;
use App\Models\Kategori;
use App\Models\Lokasi;
use App\Models\User;
// ! panggil facades agar bisa digunakan di function
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Riskihajar\Terbilang\Facades\Terbilang;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class BastController extends Controller
{
    /**
     * ? hanya admin yang bisa melihat semua data bast
     */
    public function index(Request $request)
    {
        // ? hanya admin yang bisa melihat semua data bast
        $this->authorize('viewAny', Bast::class);

        // ? query inti untuk mengambil data bast dari database
        // ? dengan relasi ke tabel barang, user_serah, user_terima
        $query = Bast::with([
            'barang.kategori',
            'barang.lokasi',
            'userSerah',
            'userTerima',
        ]);

        // ? jika ada filter kategori data yang dipilih, tambahkan kondisi ke query tersebut
        if ($request->filled('kategori')) {
            $query->whereHas('barang', fn ($q) => $q->where('kategori_id', $request->kategori));
        }

        // ? jika ada filter lokasi data yang dipilih, tambahkan kondisi ke query tersebut
        if ($request->filled('lokasi')) {
            $query->whereHas('barang', fn ($q) => $q->where('lokasi_id', $request->lokasi));
        }

        // ? jika ada filter status barang data yang dipilih, tambahkan kondisi ke query tersebut
        if ($request->filled('status_barang')) {
            $query->whereHas('barang', fn ($q) => $q->where('status_barang', $request->status_barang));
        }

        // ? jika ada filter status bast data yang dipilih, tambahkan kondisi ke query tersebut
        // Filter status BAST
        if ($request->filled('status_bast')) {
            match ($request->status_bast) {
                'Disetujui' => $query->where('status_serah', 'Disetujui')
                    ->where('status_terima', 'Disetujui'),

                'Menunggu' => $query->where(function ($q) {
                    $q->where('status_serah', 'Menunggu')
                        ->orWhere('status_terima', 'Menunggu');
                })->whereNotIn('status_serah', ['Dibatalkan'])
                    ->whereNotIn('status_terima', ['Dibatalkan']),

                'Dibatalkan' => $query->where(function ($q) {
                    $q->where('status_serah', 'Dibatalkan')
                        ->orWhere('status_terima', 'Dibatalkan');
                })
            };
        }

        // ? ambil dat bast sesuia dengan filter yang dipilih, dan urutkan dari yang paling baru
        $basts = $query->latest()->get();

        // ? tampilkan view index.blade.php di folder dashboard/bast, lalu kirimkan data:
        return view('dashboard.bast.index', [
            'title' => 'Daftar Berita Acara Serah Terima', // judul halaman
            'basts' => $basts, // data bast yang diambil dari database
            'kategoris' => Kategori::latest()->get(),
            'lokasis' => Lokasi::latest()->get(),
        ]);

    }

    /**
     * ? menapilkan form buat berita baru
     */
    public function create()
    {
        //
        $this->authorize('create', Bast::class);

        return view('dashboard.bast.create', [
            'title' => 'Tambah Berita Acara Serah Terima Baru',
            'users' => User::select('id', 'nama_lengkap')->latest()->get(),
            'barangs' => Barang::with('kategori', 'lokasi')
                ->select('id', 'kode_barang', 'nama_barang', 'kategori_id', 'lokasi_id')
                ->latest()
                ->get(),
        ]);
    }

    /**
     * ? simpan berita acara baru ke database
     */
    public function store(Request $request)
    {
        // ? 1. membuat aturan validasi data
        $aturan = [
            'barang_id' => 'required|exists:barangs,id',
            'user_serah_id' => 'required|exists:users,id|different:user_terima_id',
            'status_serah' => 'required|in:Menunggu,Disetujui,Dibatalkan',
            'user_terima_id' => 'required|exists:users,id|different:user_serah_id',
            'status_terima' => 'required|in:Menunggu,Disetujui,Dibatalkan',
        ];

        // ? 2. membuat pesan custom validasi
        $pesan = [
            'required' => ':Attribute wajib diisi!',
            'in' => 'Attribute tidak valid!',
            'exists' => 'Attribute tidak ditemukan di database!',
            'user_terima_id.different' => 'Penerima tidak boleh sama dengan Penyerah!',
            'user_serah_id.different' => 'Penerima tidak boleh sama dengan Penerima!',
        ];

        // ? 3. aturan agar valid
        $validatedData = $request->validate($aturan, $pesan);

        // ? 4. simpan berita acara ke database
        $bast = Bast::create($validatedData);

        // ? 5. ambil tanggal dibuatnya berita acara dari kolom created_at, lalu ubah ke formta indonesai
        $tanggal = Carbon::parse($bast->created_at);

        // ? 6. buat dokumen berita acara menggunakan formt view dokumen.blade.php
        $pdf = Pdf::loadView('dashboard.bast.dokumen', [
            'bast' => $bast, // kirimkan data bast yg baru disimpan ke view
            'hari' => strtoupper($tanggal->translatedFormat('l')), // ambil hari dari tanggal (contoh : Senin)
            'tanggal' => strtoupper(Terbilang::make($tanggal->day)), // ubah tanggal menjadi terbilang (contoh : lima)
            'bulan' => strtoupper($tanggal->translatedFormat('F')), // ambil bulan dari tanggal (Contoh : Januari)
            'tahun_terbilang' => strtoupper(Terbilang::make($tanggal->year)), // ubah tahun menjadi  terbilang(contoh : Dua ribu dua puluh enam)
        ])->setPaper('a4', 'portrait'); // set ukuran kertas dan orientasi

        // ? 7. simpan dokumen pdf ke storage dengan nama berdasarkan id bast
        $filename = 'Bast-'.$bast->id.'.pdf';
        $path = 'bast-pdf/'.$filename;
        Storage::put($path, $pdf->output());

        // ? 8. ubah kolom file_export di table bast menjadi nama file pdf yang sudah disimpan di storage,
        // ? lalu simpan kembali ke database
        $bast->update([
            'file_export' => $path,
        ]);

        // ? 9. alihkan ke hlaman index bast, denga psena berhaisl dibuat
        return redirect()->route('bast.index')->with('berhasil', 'Berita Acara Serah Terima berhasil dibuat.');
    }

    /**
     * ? tampilan detail bast yg dipilih
     */
    public function show(Bast $bast)
    {
        // ?  hanya admin atau user penyerah atau penerima yg bisa membuak detail bast
        $this->authorize('view', $bast);

        // ? tampilkan view show.blade.php di folder dashboard/bast, lalu kirimkan data
        return view('dashboard.bast.show', [
            'title' => 'Detail Berita Acara Serah Terima', // judul halamana
            'bast' => $bast,
        ]);
    }

    /**
     * ? menampilkan form edit berita acara yg dipilih
     */
    public function edit(Bast $bast)
    {
        //  ? hanya admin yg bisa membuka
        $this->authorize('update', $bast);

        // ? tampilkan view edit.blade.php
        return view('dashboard.bast.edit', [
            'title' => 'Ubah Berita Acara',
            'bast' => $bast,
            'users' => User::latest()->select('id', 'nama_lengkap')->get(),
            'barangs' => Barang::with('kategori', 'lokasi')
                ->select('id', 'kode_barang', 'nama_barang', 'kategori_id', 'lokasi_id')
                ->latest()
                ->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bast $bast)
    {
        // ? 1. membuat aturan validasi data
        $aturan = [
            'barang_id' => 'required|exists:barangs,id',
            'user_serah_id' => 'required|exists:users,id|different:user_terima_id',
            'status_serah' => 'required|in:Menunggu,Disetujui,Dibatalkan',
            'user_terima_id' => 'required|exists:users,id|different:user_serah_id',
            'status_terima' => 'required|in:Menunggu,Disetujui,Dibatalkan',
        ];

        // ? 2. membuat pesan custom validasi
        $pesan = [
            'required' => ':Attribute wajib diisi!',
            'in' => 'Attribute tidak valid!',
            'exists' => 'Attribute tidak ditemukan di database!',
            'user_terima_id.different' => 'Penerima tidak boleh sama dengan Penyerah!',
            'user_serah_id.different' => 'Penerima tidak boleh sama dengan Penerima!',
        ];

        // ? 3. aturan agar valid
        $validatedData = $request->validate($aturan, $pesan);

        // ? 4. simpan berita acara ke database
        $bast->update($validatedData);

        // ? 5. ambil tanggal dibuatnya berita acara dari kolom created_at, lalu ubah ke formta indonesai
        $tanggal = Carbon::parse($bast->created_at);

        // ? 6. buat dokumen berita acara menggunakan formt view dokumen.blade.php
        $pdf = Pdf::loadView('dashboard.bast.dokumen', [
            'bast' => $bast, // kirimkan data bast yg baru disimpan ke view
            'hari' => strtoupper($tanggal->translatedFormat('l')), // ambil hari dari tanggal (contoh : Senin)
            'tanggal' => strtoupper(Terbilang::make($tanggal->day)), // ubah tanggal menjadi terbilang (contoh : lima)
            'bulan' => strtoupper($tanggal->translatedFormat('F')), // ambil bulan dari tanggal (Contoh : Januari)
            'tahun_terbilang' => strtoupper(Terbilang::make($tanggal->year)), // ubah tahun menjadi  terbilang(contoh : Dua ribu dua puluh enam)
        ])->setPaper('a4', 'portrait'); // set ukuran kertas dan orientasi

        // ? 7. simpan dokumen pdf ke storage dengan nama berdasarkan id bast
        $filename = 'Bast-'.$bast->id.'.pdf';
        $path = 'bast-pdf/'.$filename;
        Storage::put($path, $pdf->output());

        // ? 8. ubah kolom file_export di table bast menjadi nama file pdf yang sudah disimpan di storage,
        // ? lalu simpan kembali ke database
        $bast->update([
            'file_export' => $path,
        ]);

        // ? 9. alihkan ke hlaman index bast, denga psena berhaisl dibuat
        return redirect()->route('bast.index')->with('berhasil', 'Berita Acara Serah Terima berhasil diperbarui.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bast $bast)
    {
        // ? hanay admin yang bisa menghapus bast
        $this->authorize('delete', $bast);

        // ? 1. cek & hapus file pdf jika ada

        if ($bast->file_export && Storage::exists($bast->file_export)) {
            Storage::delete($bast->file_export);
        }

        // ? 2. hapus data bast
        $bast->delete();

        // ?  3. alihkan ke hlaman index bast, denga psena berhaisl dibuat
        return redirect()->route('bast.index')->with('berhasil', 'Berita Acara Serah Terima berhasil dihapus.');

    }

    /**
    // ? download file pdf berita acara yang sudah dibuat
     */
    public function downloadPdf(Bast $bast)
    {
        // ? donwload file dokumen berita acara yang sudah disimpan di strage,
        // ? dengan nama file sesuai dengan nama file yang ada di kolom file_export di tabel bast
        return Storage::download($bast->file_export);
    }

    public function exportToPdf()
    {
        // ? amibl semua data barang, urutkan dari paling baru
        $basts = Bast::with(['barang.kategori', 'barang.lokasi', 'userSerah', 'UserTerima'])->latest()->get();

        // ? buat QrCode untuk masing-masing barang menggunakan perualanga
        foreach ($basts as $bast) {
            $bast->qr_base64 = base64_encode(
                QrCode::format('svg') // buat dalam format svg
                    ->size(70) // ukuran 80
                    ->generate(route('public.barang.show', $barang->id)
                    )
            );
        }

        // ? buat file pdf dari view export.blade.php di folder bast
        $pdf = Pdf::loadView('dashboard.bast.export', [
            'title' => 'Daftar Berita Acara Serah Terima', // ? kirim judul halamannay
            'basts' => $basts, // ? dan data bast
        ])->setPaper('a4', 'portrait');

        // ? download PDF
        return $pdf->download('daftar_berita_acara_serah_terima.pdf');
    }

    public function exportToExcel()
    {
        // ? download excel berdasarkan konfigurasi yang ada di file BarangExport.php
        return Excel::download(new BastExport, 'daftar_berita_acara_serah_terima.xlsx');
    }

    public function print()
    {
        // ? amibl semua data barang, urutkan dari paling baru
        $basts = Bast::with(['barang.kategori', 'barang.lokasi', 'userSerah', 'UserTerima'])->latest()->get();

        // ? buat QrCode untuk masing-masing barang menggunakan perualanga
        foreach ($basts as $bast) {
            $bast->qr_base64 = base64_encode(
                QrCode::format('svg') // buat dalam format svg
                    ->size(80) // ukuran 80
                    ->generate(route('public.barang.show', $barang->id)
                    )
            );
        }

        // ? jalankan view export.blade.php sambil kirim data:
        return view('dashboard.bast.export', [
            'title' => 'Daftar Berita Acara Serah Terima',
            'basts' => $basts,
        ]);
    }

    public function bastSerahMenunggu()
    {
        $basts = Bast::with(['barang.kategori', 'barang.lokasi', 'userSerah', 'userTerima'])
            ->where('user_serah_id', Auth::id())
            ->where('status_serah', 'Menunggu')
            ->latest()->get();

        return view('dashboard.bast.basts', [
            'title' => 'Daftar BAST Penyerah',
            'deskripsi' => 'Lihat dan temukan berita acara serah terima untuk pihak penyerah yang menunggu persetujuan',
            'basts' => $basts]);

    }

    public function bastSerahDisetujui()
    {
        $basts = Bast::with(['barang.kategori', 'barang.lokasi', 'userSerah', 'userTerima'])
            ->where('user_serah_id', Auth::id())
            ->whereIn('status_serah', ['Disetujui', 'Dibatalkan'])
            ->latest()
            ->get();

        return view('dashboard.bast.basts', [
            'title' => 'Daftar BAST Penyerah (Disetujui)',
            'deskripsi' => 'Lihat dan temukan berita acara serha terima untuk pihak penyerah yang sudah disetujui',
            'basts' => $basts,
        ]);
    }

    public function setujuiSerah(Bast $bast)
    {
        $this->authorize('approveSerah', $bast);

        $bast->update([
            'status_serah' => 'Disetujui',
        ]);

        return redirect()->route('bast.show', $bast);
    }

    public function cancelSerah(Bast $bast)
    {
        $this->authorize('cancelSerah', $bast);

        $bast->update([
            'status_serah' => 'Dibatalkan',
        ]);

        return redirect()->route('bast.show', $bast);
    }

    public function bastTerimaMenunggu()
    {
        $basts = Bast::with(['barang.kategori', 'barang.lokasi', 'userSerah', 'userTerima'])
            ->where('user_terima_id', Auth::id())
            ->where('status_terima', 'Menunggu')
            ->latest()->get();

        return view('dashboard.bast.basts', [
            'title' => 'Daftar BAST Penerima',
            'deskripsi' => 'Lihat dan temukan berita acara serah terima untuk pihak penerima yang menunggu persetujuan',
            'basts' => $basts]);

    }

    public function bastTerimaDisetujui()
    {
        $basts = Bast::with(['barang.kategori', 'barang.lokasi', 'userSerah', 'userTerima'])
            ->where('user_terima_id', Auth::id())
            ->whereIn('status_terima', ['Disetujui', 'Dibatalkan'])
            ->latest()->get();

        return view('dashboard.bast.basts', [
            'title' => 'Daftar BAST Penerima (Disetujui)',
            'deskripsi' => 'Lihat dan temukan berita acara serha terima untuk pihak penerima yang sudah disetujui',
            'basts' => $basts,
        ]);
    }

    public function setujuiTerima(Bast $bast)
    {
        $this->authorize('approveTerima', $bast);

        $bast->update([
            'status_terima' => 'Disetujui',
        ]);

        return redirect()->route('bast.show', $bast);
    }

    public function cancelTerima(Bast $bast)
    {
        $this->authorize('cancelTerima', $bast);

        $bast->update([
            'status_terima' => 'Dibatalkan',
        ]);

        return redirect()->route('bast.show', $bast);
    }
}
