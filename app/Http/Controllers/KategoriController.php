<?php

namespace App\Http\Controllers;

use App\Models\Kategori;

// ! panggil class facade PDF agar bisa digunakan di function exportToPdf()
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

// ! panggil clss kategori export dan facade excel agar bisa digunakan di function exportToExcel()
use App\Exports\KategoriExport;
use Maatwebsite\Excel\Facades\Excel;

class KategoriController extends Controller
{
    /**
     * ? tampilkan semua data kategori barang di view index
     */
    public function index()
    {
        // ? jalankan view index.blade.php di folder dashboard/kategori, lalu kirimkan data:
        return view('dashboard.kategori.index', [
            'title' => 'Daftar Kategori Barang', // judul halaman
            'kategoris' => Kategori::latest()->get(), // semua data kategori barang yang ada di database
        ]);
    }

    /**
     * ? tampilkan halaman form tambah kategori baru
     */
    public function create()
    {
        // ? jalankan view create.blade.php di folder dashboard/kategori
        return view('dashboard.kategori.create', [
            'title' => 'Tambah Kategori Barang',
        ]);
    }

    /**
     * ? simpan dat kategori baru ke database
     */
    public function store(Request $request)
    {
        // ? 1. membuat aturan validasi data
        $aturan = [
            // kode kategori wajib diisi, maks 20 kara, harus unik
            'kode_kategori' => 'required|string|max:20|unique:kategoris,kode_kategori',

            // nama kategori wajib diisi, maks 100 kara
            'nama_kategori' => 'required|string|max:100',

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
        Kategori::create($validatedData);

        // ? 5. alihkan ke halaman list kategori dengan pesan sukses
        return redirect()->route('kategori.index')->with('berhasil', 'Yes! Kategori barang berhasil ditambahkan.');
    }

    /**
     * ? menampilkan halaman detail kategori
     */
    public function show(Kategori $kategori)
    {
        // ? alihkan langsung ke halaman edit kategori
        return redirect()->route('kategori.edit');
    }

    /**
     * ? menampilkan form edit data kategori yang dipilih
     */
    public function edit(Kategori $kategori)
    {
        // ? menampilkan view edit.blade.php di folder dashboard/kategori, sambil kirim data:
        return view('dashboard.kategori.edit', [
            'title' => 'Perbarui Data Kategori', // judul halaman
            'kategori' => $kategori, // data kategori yang mau diedit
        ]);
    }

    /**
     * ? manampilkan data kategori yang diedit ke database
     */
    public function update(Request $request, Kategori $kategori)
    {
        // ? 1. membuat aturan validasi data untuk nama kategori dan deskripsi
        $aturan = [
            // nama kategori wajib diisi, maks 100 kara
            'nama_kategori' => 'required|string|max:100',
            // deskripsi harus berupa teks, boleh dikosongkan
            'deskripsi' => 'nullable|string',
        ];

        // ? 2. jika kode_kategori diubah, buat aturan untuk kode kategori baru
        if ($request->kode_kategori !== $kategori->kode_kategori) {
            $aturan['kode_kategori'] = 'required|string|max:10|unique:kategoris,kode_kategori';
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
        $kategori->update($validatedData);

        // ? 6. redirect ke halaman kategori dan kirimkan pesan konfirmasi berhasil
        return redirect()->route('kategori.index')->with('berhasil', 'Kategori barang berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        // ? hapus kategori dari database
        $kategori->delete();

        // ? alihkan ke halaman list data pengguna
        return redirect()->route('kategori.index')->with('berhasil', 'kategori berhasil dihapus!');
    }

    /**
     * ? ekspor semua data kategori ke file PDF
     */
    public function exportToPdf() {
        // ? 1. ambil semua dat kategori dari database
        $kategoris = Kategori::latest()->get();

        // ? 2. Buat pdf dari view export.blade.php yang ada di folder dashboard/kategori
        $pdf = Pdf::loadView('dashboard.kategori.export', [
            'title' => 'Daftar Kategori Barang', // tempilkan judul halaman
            'kategoris' => $kategoris // tampilkan semua data yg ada di database
        ])->setPaper('a4', 'portrait'); // set PDF menggunakan ukuran kerta A4 dan potrait

        // ? 3. download file PDF yang udah dibuat pada langkah 2
        return $pdf->download('daftar_kategori_barang.pdf');
    }

    /**
     * ? ekspor semua data ke kategori ke file Excel
     */
    public function exportToExcel() {
        // ? download file excel, isinya sesuai dengan yang dikonfigurasidi fiel KategoriExport.php
        return Excel::download(new KategoriExport, 'daftar_kategori_barang.xlsx');
    }

    /**
     * ? cetak list data kategori
     */
    public function print() {
        // ? ambil semua dat kategori dari database
        $kategoris = Kategori::latest()->get();

        // ? jalankan view export.blade.php sambil kirim data:
        return view('dashboard.kategori.export', [
            'title' => 'Daftar Kategori Barang', // judul halaman
            'kategoris' => $kategoris,
        ]);
    }
}
