<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;

// ! panggil class facade PDF agar bisa digunakan di function exportToPdf()
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

// ! panggil clss kategori export dan facade excel agar bisa digunakan di function exportToExcel()
use App\Exports\LokasiExport;
use Maatwebsite\Excel\Facades\Excel;

class LokasiController extends Controller
{
    /**
     * ? tampilkan semua data lokasi barang di view index
     */
    public function index()
    {
        // ? jalankan view index.blade.php di folder dashboard/lokasi, lalu kirimkan data:
        return view('dashboard.lokasi.index', [
            'title' => 'Daftar Lokasi Barang', // judul halaman
            'lokasis' => Lokasi::latest()->get(), // semua data lokasi barang yang ada di database
        ]);
    }

    /**
     * ? tampilkan halaman form tambah lokasi baru
     */
    public function create()
    {
        // ? jalankan view create.blade.php di folder dashboard/lokasi
        return view('dashboard.lokasi.create', [
            'title' => 'Tambah Lokasi Barang',
        ]);
    }

    /**
     * ? simpan dat lokasi baru ke database
     */
    public function store(Request $request)
    {
        // ? 1. membuat aturan validasi data
        $aturan = [
            // kode lokasi wajib diisi, maks 20 kara, harus unik
            'kode_lokasi' => 'required|string|max:20|unique:lokasis,kode_lokasi',

            // nama lokasi wajib diisi, maks 100 kara
            'nama_lokasi' => 'required|string|max:100',

            // deskripsi harus berupa teks, boleh dikosongkan
            'deskripsi' => 'nullable|string',
        ];

        // ? 2. membuat pesan validasi custom
        $pesan = [
            'required' => 'Kolom :attribute nggak boleh kosong!!.',
            'unique' => 'Kolom :attribute sudah ada yg pakai!!.',
            'max' => 'Kolom :attribute maksimal :max karakter !!.',
        ];

        // ? 3.validasi data berdasarkan aturan dan pesan yang telah dibuat
        $validatedData = $request->validate($aturan, $pesan);

        // ? 4. simpan data ke database
        Lokasi::create($validatedData);

        // ? 5. alihkan ke halaman list lokasi dengan pesan sukses
        return redirect()->route('lokasi.index')->with('berhasil', 'Yes! lokasi barang berhasil ditambahkan.');
    }

    /**
     * ? menampilkan halaman detail lokasi
     */
    public function show(Lokasi $lokasi)
    {
        // ? alihkan langsung ke halaman edit lokasi
        return redirect()->route('lokasi.edit');
    }

    /**
     * ? menampilkan form edit data lokasi yang dipilih
     */
    public function edit(Lokasi $lokasi)
    {
        // ? menampilkan view edit.blade.php di folder dashboard/lokasi, sambil kirim data:
        return view('dashboard.lokasi.edit', [
            'title' => 'Perbarui Data lokasi', // judul halaman
            'lokasi' => $lokasi, // data lokasi yang mau diedit
        ]);
    }

    /**
     * ? manampilkan data lokasi yang diedit ke database
     */
    public function update(Request $request, Lokasi $lokasi)
    {
        // ? 1. membuat aturan validasi data untuk nama lokasi dan deskripsi
        $aturan = [
            // nama lokasi wajib diisi, maks 100 kara
            'nama_lokasi' => 'required|string|max:100',
            // deskripsi harus berupa teks, boleh dikosongkan
            'deskripsi' => 'nullable|string',
        ];

        // ? 2. jika kode_lokasi diubah, buat aturan untuk kode lokasi baru
        if ($request->kode_lokasi !== $lokasi->kode_lokasi) {
            $aturan['kode_lokasi'] = 'required|string|max:10|unique:lokasis,kode_lokasi';
        }

        // ? 3. membuat pesan validasi custom
        $pesan = [
            'required' => 'Kolom :attribute nggak boleh kosong!!.',
            'unique' => 'Kolom :attribute sudah ada yg pakai!!.',
            'max' => 'Kolom :attribute maksimal :max karakter !!.',
        ];

        // ? 4. validasi data berdasrkan aturan dan pesan yang telah dibuat
        $validatedData = $request->validate($aturan, $pesan);

        // ? 5. update data ke database
        $lokasi->update($validatedData);

        // ? 6. redirect ke halaman lokasi dan kirimkan pesan konfirmasi berhasil
        return redirect()->route('lokasi.index')->with('berhasil', 'lokasi barang berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lokasi $lokasi)
    {
        // ? hapus lokasi dari database
        $lokasi->delete();

        // ? alihkan ke halaman list data pengguna
        return redirect()->route('lokasi.index')->with('berhasil', 'lokasi berhasil dihapus!');
    }

    /**
     * ? ekspor semua data lokasi ke file PDF
     */
    public function exportToPdf()
    {
        // ? 1. ambil semua dat lokasi dari database
        $lokasis = Lokasi::latest()->get();

        // ? 2. Buat pdf dari view export.blade.php yang ada di folder dashboard/lokasi
        $pdf = Pdf::loadView('dashboard.lokasi.export', [
            'title' => 'Daftar lokasi Barang', // tempilkan judul halaman
            'lokasis' => $lokasis, // tampilkan semua data yg ada di database
        ])->setPaper('a4', 'portrait'); // set PDF menggunakan ukuran kerta A4 dan potrait

        // ? 3. download file PDF yang udah dibuat pada langkah 2
        return $pdf->download('daftar_lokasi_barang.pdf');
    }

    /**
     * ? ekspor semua data ke lokasi ke file Excel
     */
    public function exportToExcel()
    {
        // ? download file excel, isinya sesuai dengan yang dikonfigurasidi fiel lokasiExport.php
        return Excel::download(new LokasiExport, 'daftar_lokasi_barang.xlsx');
    }

    /**
     * ? cetak list data lokasi
     */
    public function print()
    {
        // ? ambil semua dat lokasi dari database
        $lokasis = Lokasi::latest()->get();

        // ? jalankan view export.blade.php sambil kirim data:
        return view('dashboard.lokasi.export', [
            'title' => 'Daftar lokasi Barang', // judul halaman
            'lokasis' => $lokasis,
        ]);
    }
}
