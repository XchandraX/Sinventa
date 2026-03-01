<?php

namespace App\Http\Controllers;

// ! panggil semua model agar bisa digunakaan
use App\Models\Barang;
use App\Models\Bast;
use App\Models\Kategori;
use App\Models\Lokasi;
use App\Models\User;
use Illuminate\Http\Request;

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
        if ($request->filled('status_bast')) {
            match ($request->status_bast) {
                'Disetujui' => $query
                    ->where('status_serah', 'Disetujui')
                    ->where('status_terima', 'Disetujui'),

                'Menunggu' => $query->where(fn ($q) => $q->where('status_serah', 'Menunggu')
                    ->orWhere('status_terima', 'Menunggu')
                ),
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

        return view('dashboard.bast.create',[
            'title' => 'Buat Berita Acara Serah Terima Baru',
            'users' => User::latest()->select('id', 'nama_lengkap')->get(),
            'barangs' => Barang::latest()->select('id', 'kode_barang', 'nama_barang')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Bast $bast)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bast $bast)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bast $bast)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bast $bast)
    {
        //
    }
}
