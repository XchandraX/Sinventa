<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * ? menampilkan semua data user
     */
    public function index()
    {
        // ? mengambil function viewAny UserPolicy untuk menentukan siapa yang bisa akses view index
        $this->authorize('viewAny', User::class);

        // ? jalankan view index.blade.php di folder users, sambil kirimkan data
        return view('dashboard.users.index', [
            'title' => 'Daftar Pengguna Sinvesta', // judul halaman
            'users' => User::latest()->get(), // semua data user diurutkan berdasarkan waktu terbaru dibuat
        ]);
    }

    /**
     * ? menampilkan halaman formulis tambah user baru
     */
    public function create()
    {
        // ? panggil function create UserPolicy untuk menentukan siapa yang bisa akses view create
        $this->authorize('create', User::class);

        // ? jalankan view create.blade.php di folder dashboard/users
        return view('dashboard.users.create', [
            'title' => 'Tambah Pengguna Baru Sinvesta',
        ]);
    }

    /**
     * ? simpan data user baru ke database mysql
     */
    public function store(Request $request)
    {
        // ? 1. buat aturan validasi, agar user tidak memasukan dat sembaranga
        $aturan = [
            // nama_lengkap wajib diisi, harus berupa text, maks kara 100
            'nama_lengkap' => 'required|string|max:100',
            // username wajib diisi, harus berupa text, maks kara 50, harus unik
            'username' => 'required|string|max:50|unique:users,username',
            // email wajib diisi, harus berupa email, maks kara 100, harus unik
            'email' => 'required|email|max:100|unique:users,email',
            // password wajib diisi, harus berupa text, min 8 dan maks 100 kara, harus sama dengan konfirmasi password
            'password' => 'required|string|min:8|max:32|confirmed',
            // role wajib diisi, pilihan hanya 2 'admin' atau 'user'
            'role' => 'required|in:admin,user',
            // lembaga wajib diisi, harus berupa text, maks 100 kara
            'lembaga' => 'required|string|max:100',
        ];

        // ? 2. tentukan pesan error saat data yang dikirm tidak valid (tidak sesuai aturan diatas)
        $pesan = [
            //
            'required' => 'Kolom :attribute nggak boleh kosong!!.',
            'unique' => 'Kolom :attribute sudah ada yg pakai!!.',
            'email' => 'Kolom:attribute pakai email yang valid dong!!.',
            'min' => 'Kolom :attribute minimal :m karakter.',
            'confirmed' => ':attribute tidak sama!!.',
            'in' => 'Kolom :attribute tidak valid!!.',
            'max' => 'Kolom :attribute maksimal :max karakter !!.',
        ];

        // ? 3. lakukan validasi data
        $validatedDate = $request->validate($aturan, $pesan);

        // ? 4. simpan data yang sudah divalidasi ke dtabase melalui model user
        User::create($validatedDate);

        // ? 5. Alihkan ke halaman login dengan pesan sukses
        return redirect()->route('users.index')->with('berhasil', 'Yes! Data user berhasil disimpan!');
    }

    /**
     * ? menampilkan detail 1 data user
     */
    public function show(User $user)
    {
        // * pada tabel user, kita tidak akan menampikan halaman detail
        // * kita akan langsung mengalihkan ke form edit data user
        return redirect()->route('users.edit', $user);
    }

    /**
     * ? menampilkan form edit user
     */
    public function edit(User $user)
    {
        // ? panggil function update UserPolicy untuk menentukan siapa yang bisa mengubah data user
        $this->authorize('update', $user);

        // ? jalankan view edit.blade.php di folder dashboard/users, sambil kirim data:
        return view('dashboard.users.edit', [
            'title' => 'Edit Pengguna', // judul halaman
            'user' => $user, // data suer yang mau di ubah
        ]);
    }

    /**
     * ? Perbarui 1 data user ke database
     */
    public function update(Request $request, User $user)
    {
        // ? 1. membuat aturan validasi untuk nama dan lembaga
        $aturan = [
            'nama_lengkap' => 'required|string|max:100',
            'lembaga' => 'required|string|max:100',
        ];

        // ? 2. jika username diubah, tambahkan aturan untuk username yang baru
        if ($request->username !== $user->username) {
            // username wajib diisini, harus berupa text, maks 50 karakter, harus unik
            $aturan['username'] = 'required|string|max:100|unique:users,username';
        }

        // ? 3. jika email diubah, tambahkan aturan untuk email yang baru
        if ($request->email !== $user->email) {
            // email wajib diisini, harus berupa text, maks 50 karakter, harus unik
            $aturan['email'] = 'required|email|max:100|unique:users,email';
        }

        // ? 4. jika kolom password diisini, tambahkan aturan untuk password yang baru
        if ($request->password) {
            // password wajib diisii, harus berupa text, min 8 kara, maks 32 kara, harus sama dengan konfirmasi apssword
            $aturan['password'] = 'string|min:8|max:32|confirmed';
        }

        // ? 5. keamaan tambahan, hanay admin yang bisa memperbarui role
        if (Auth::user()->role === 'admin') {
            // role wajib diisin, bilihan antara admin dan user
            $aturan['role'] = 'required|in:admin,user';
        }

        // ? 6. pesan validasi
        $pesan = [
            //
            'required' => 'Kolom :attribute nggak boleh kosong!!.',
            'unique' => 'Kolom :attribute sudah ada yg pakai!!.',
            'email' => 'Kolom:attribute pakai email yang valid dong!!.',
            'min' => 'Kolom :attribute minimal :m karakter.',
            'confirmed' => ':attribute tidak sama!!.',
            'in' => 'Kolom :attribute tidak valid!!.',
            'max' => 'Kolom :attribute maksimal :max karakter !!.',
        ];

        // ? 7. validasi data dari request
        $validatedDate = $request->validate($aturan, $pesan);

        // ? 8. jika password yang baru diubah kedalam bentuk enkripsi
        if ($request->password) {
            $validatedDate['password'] = bcrypt($request->password);
        }

        // ? 9. update data user dengan data yang sudah divalidasi
        $user->update($validatedDate);

        // ? 10. kembali ke halaman edit user sambil kirim pesan konfirmasi berhasil
        return redirect()->route('users.edit', $user)->with('berhasil', 'Yeaay! Data Pengguna berhasil diperbarui.');

    }

    /**
     * ? hapus 1 data user yang dipilih
     */
    public function destroy(User $user)
    {
        // ? panggil funciton delete UserPolicy untuk menentukan siapa yg bisa menghapus data user
        $this->authorize('delete', $user);

        // ? hapus user dari database
        $user->delete();

        // ? alihkan ke halaman list data pengguna
        return redirect()->route('users.index')->with('berhasil', 'User berhasil dihapus!');
    }
}
