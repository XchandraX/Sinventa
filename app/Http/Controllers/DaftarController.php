<?php

namespace App\Http\Controllers;

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
}
