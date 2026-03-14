<?php

namespace App\Http\Controllers;

use App\Models\RegistrationCode;
// ? panggil model user agar dapat digunakan oleh function store
use App\Models\User;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:users,username',
            'email' => 'required|email|max:100|unique:users,email',
            'password' => 'required|string|min:8|max:32|confirmed',
            'role' => 'required|in:admin,user',
            'lembaga' => 'required|string|max:100',
            'reg_code' => 'required', // Input kode dari form
        ], [
            'required' => 'Kolom :attribute nggak boleh kosong!!.',
            'unique' => 'Kolom :attribute sudah ada yg pakai!!.',
            'email' => 'Kolom:attribute pakai email yang valid dong!!.',
            'min' => 'Kolom :attribute minimal :m karakter.',
            'confirmed' => ':attribute tidak sama!!.',
            'in' => 'Kolom :attribute tidak valid!!.',
            'max' => 'Kolom :attribute maksimal :max karakter !!.',
        ]);

        // 2. Ambil kode yang sedang aktif di database
        $currentCode = RegistrationCode::first();

        // 3. Cek apakah kode yang diinput user cocok
        if (! $currentCode || $request->reg_code !== $currentCode->code) {
            return back()->withErrors(['reg_code' => 'Kode salah atau sudah kadaluarsa!'])->withInput();
        }

        // 4. Jika cocok, Simpan User Baru
        User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'lembaga' => $request->lembaga,
        ]);

        // 5. ACAK ULANG KODE (Agar pendaftar berikutnya pakai kode berbeda)
        $newCode = substr(md5(time().rand()), 0, 6);
        $currentCode->update(['code' => $newCode]);

        return redirect()->route('login')->with('berhasil', 'Daftar berhasil! Silakan login.');
    }
}
