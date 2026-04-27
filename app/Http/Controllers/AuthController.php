<?php

namespace App\Http\Controllers;

// ? panggil model user agar bisa di gunakan oleh funciton login
use App\Models\User;
// ? panggil class fecades auth agar bisa digunakan oleh function login
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

    public function index()
    {
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
    public function login(Request $request)
    {
        // 1. Validasi awal (Hanya cek username, password dicek manual nanti agar tidak stop di sini)
        $request->validate([
            'username' => 'required',
        ], [
            'username.required' => 'Username tidak boleh kosong',
        ]);

        // 2. Cek apakah username ada di database
        $user = User::where('username', $request->username)->first();

        if (! $user) {
            return back()->withErrors([
                'username' => 'Username tidak terdaftar',
            ])->withInput();
        }

        // 3. Cek apakah password kosong (Manual, agar pesan username tetap bisa muncul barengan)
        if (! $request->password) {
            return back()->withErrors([
                'password' => 'Password tidak boleh kosong',
            ])->withInput();
        }

        // 4. Proses Login
        $credentials = $request->only('username', 'password');

        if (! Auth::attempt($credentials)) {
            return back()->withErrors([
                'password' => 'Ups! password kamu salah',
            ])->withInput();
        }

        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    /**
     * ? function logout digunakan untuk proses keluar dari sistem
     * * gunakan class Request agar dapat menerima data dari view form'logout.blade.php'
     */
    public function logout(Request $request)
    {
        // ? Keluar dari sistem
        Auth::logout();

        // ? hapus session dari browser
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // ? alihkan ke halaman login
        return redirect()->route('/');
    }
}
