<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// ? panggil model user agar dapat digunakan oleh function store
use App\Models\User;

class DaftarController extends Controller
{
    /**
     * ? function index akan menjalankan view 'daftar.blade.php' di dalam folder 'auth'
     * ? lalu mengirimkan data 'title'
     */
    public function index()
    {
        return view('auth.daftar', [
            'title' => 'Daftar Sinvesta',
        ]);
    }

    /**
     * ? function store digunakan untuk menyimpan data user ke database
     * * gunakan class Request agar dapat menerima data dari view form daftar.blade.php
     */
    public function store(Request $request) {
        // ? 1. buat aturan validasi, agar user tidak memasukan data sembarangan
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
            'min' => 'Kolom :attribute tidak valid!!.',
            'max' => 'Kolom :attribute maksimal :max karakter !!.',
        ];

        // ? 3. lakukan validasi data 
        $validatedDate = $request->validate($aturan, $pesan);

        // ? 4. simpan dat ayang sudah divalidasi ke database melalui model user
        User::create($validatedDate);

        // ? 5. alihkan ke halaman lgin dengan pesan sukses
        return redirect()->route('login')->with('berhasil', 'Pendaftaran berhasil silahkan login.');
    }
}
