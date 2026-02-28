<?php

namespace App\Http\Controllers;

use App\Models\Barang;

// ! panggil class modul yang dibutuhkan di function
use App\Models\Kategori;
use App\Models\Lokasi;
use App\Models\Bast;
use Illuminate\Http\Request;

// ! panggil class facades agar bisa digunakan di function downloadQr
use Illuminate\Support\Facades\Response;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class BarangController extends Controller
{
    /**
     * ? tampilkan semua list barang, krena di soal minta fitur filter, kita tambahkan query untuk filter data
     */
    public function index(Request $request)
    {
        // ? hanay admin yang boleh melihat semua data barang
        $this->authorize('viewAny', Barang::class);

        // ? Query untuk mengambil data barang dari database
        $barangs = Barang::query()
            ->with(['kategori', 'lokasi']) // ? sekalian ambil data kategori dan lokasi
            ->when($request->kategori, function ($query, $kategori) { // ? jika ada filter berdasarkan kategori
                $query->where('kategori_id', $kategori); // ? ambil data barang berdasarkan kategori yang dipilih
            })->when($request->lokasi, function ($query, $lokasi) { // ? jika ada filter berdasarkan lokasi
                $query->where('lokasi_id', $lokasi); // ? ambil data barang berdasarkan lokasi yang dipilih
            })->when($request->status, function ($query, $status) { // ? jika ada filter berdasarkan status
                $query->where('status_barang', $status); // ? ambil data barang berdasarkan status yang dipilih
            })->latest()->get(); // ? urutkan dari yang terbaru
            
        // ? tampilkan view index.blade.php di folder dashboard/barang
        return view('dashboard.barang.index', [
            'title' => 'Daftar Barang', // ? kirim judul halaman
            'barangs' => $barangs, // ? kirim data barang
            'kategoris' => Kategori::latest()->get(), // ? kirim semua data kategori (untuk fitur filter)
            'lokasis' => Lokasi::latest()->get(), // ? kirim semua data kategori (untuk fitur filter)
        ]);
    }

    /**
     * ? tampilkan halman form tambahan barang baru
     */
    public function create()
    {
        // ? hanya admin yang boleh membuaka halaman form tambah barang baru
        $this->authorize('create', Barang::class);

        // ? tampilkan view crete.blade.php di folder dashboard/barang
        return view('dashboard.barang.create', [
            'title' => 'Tambah Barang', //kirim judul halaman
            'kategoris' => Kategori::latest()->get(), // ? kirim semua data kategori
            'lokasis' => Lokasi::latest()->get() // ? kirim semua data lokasi
        ]);
    }

    /**
     * ? simpan data barangbaru ke database
     */
    public function store(Request $request)
    {
        // ? 1. buat data barang baru ke database
        $aturan = [
            'kode_barang' => 'required|string|max:20|unique:barangs,kode_barang',
            'nama_barang' => 'required|string|max:100',
            'kategori_id' => 'required|exists:kategoris,id',
            'lokasi_id' => 'required|exists:lokasis,id',
            'status_barang' => 'required|in:Baik,Rusak Ringan,Rusak Berat,Hilang',
            'deskripsi' => 'nullable|string'
        ];

        // ? 2. buat pesan untuk kolom yang tidak valid
        $pesan = [
            // 
            'required' => 'Kolom :attribute nggak boleh kosong!!.',
            'unique' => 'Kolom :attribute sudah ada yg pakai!!.',
            'exists' => 'Kolom :attribute tidak valid!!.',
            'in' => 'Kolom :attribute tidak valid!!.',
            'max' => 'Kolom :attribute maksimal :max karakter !!.',
            'string' => 'Kolom :attribute mharus berupa teks!',
        ];

        // ? 3. lakukan validasi data
        $validatedData = $request->validate($aturan, $pesan);

        // ? 4. simpan data ke database
        Barang::create($validatedData);

        // ? 5. alihkan ke halaman list data barang dan kirimkan pesan konfimrasi berhasil
        return redirect()->route('barang.index')->with('berhasil', 'teay! Barang berhasil ditambahkan.');
    }

    /**
     * ? tampilkan detail barang yang dipilih
     */
    public function show(Barang $barang)
    {
        // ? kirim data berita acara untuk barang yang ini
        // ? data ini digunakan untuk melihat riwayat berita acara untuk barang ini
        $basts = Bast::with(['barang', 'userSerah', 'userTerima'])
            ->where('barang_id', $barang->id)
            ->latest()->get();

        // ? tampilkan view show.blade.php di folder dashboard/barang
        return view('dashboard.barang.show', [
            'title' => 'Detail Barang', // ? kirimkan judul halaman
            'barang' => $barang, // ? kirim detail barang
            'basts' => $basts, // ? kirimkan data bast untuk barang ini
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        //
    }

    /**
     * ? download QRCode barang
     */
    public function downloadQr(Barang $barang) {
        // ? Buat file QrCode dengan format .svg
        $qr = QrCode::format('svg')
            ->size(300)
            ->generate(route('barang.show', $barang)); //! yang dibuat menjadi QrCode adalah link detail barang

        // ? tentukan nama file QrCode menggunak kode_barang
        $filename = 'qroce-'.$barang->kode_barang.'.svg';

        // ? download qr yg sudah dibuat
        return Response::make($qr, 200, [
            'Content-Type' => 'image/svg+xml',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ]);
    }
}
