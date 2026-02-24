<?php

namespace App\Http\Controllers;

// ? panggil model user agar bisa di gunakan oleh funciton login
use App\Models\User;

// ? panggil class fecades auth agar bisa digunakan oleh function login
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
class AuthController extends Controller
{
    //

    public function index() {
        /**
         * ? function index akan menjalankan view 'login.blade.ph di dalam folder 'auth'
         * ? lalu mengirimkan data 'title'
         */

        return view('auth.login', [
            'title' => 'Login Sinvesta',
        ]);
    }

    /**
     * ? function logi ndigunakan untuk proses autentikasi
     * * gunakan class Request agar dapat menerima data dari view form'login.bladle.php'
     */
    public function login(Request $request) {
        // ? 1. membuat aturan validasi
        $aturan = [
            'username' => 'required|string',
            'password' => 'required|string',
        ];

        // ? 2. pesan jika data yang dikirm tidak valid
        $pesan = [
            'required' => ':attribute tidak boleh kosong',
            'string' => ':attribute harus berupa teks.'
        ];

        // ? 3. lakuakn validasi data
        $request->validate($aturan, $pesan);

        // ? 4. cek apakah username sudah terdaftar
        $user = User::where('username', $request->username)->first();

        // jika user tidak ditemukan
        if (!$user) {
            // kirim pesan error di kolom username
            return back()->withErrors([
                'username' => 'Username tidak terdaftar',
            ])->withInput();
        }
        // jiaka username sudah terdaftar, lanjut ke proses 5

        // ? 5. coba login menggunakan class auth
        // atur data yang digunakana untuk autentikasi = username dan password (defaultnya email)

        $credentials = $request->only('username', 'password');
        // jika proses login gagal
        if (!Auth::attempt($credentials)) {
            // kirim pesan error di kolom password
            return back()->withErrors([
                'password' => 'Ups! password kamu salah'
            ])->withInput();
        }
        // jika proses login berhasil, lanjut ke proses 6

        // ? 6. regenerasi session (keamanan) dan simpan data user yang sedang login di browser
        $request->session()->regenerate();

        // ? 7. alihkan ke halaman dashboard
        // ! karena kita belum punya route dashboard
        return "Gila, proses login berhasil, Welcome ". Auth::user()->nama_lengkap;

    }

}
