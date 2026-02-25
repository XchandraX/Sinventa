<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
            'title' => 'Daftar Pengguna Sinvesta', //judul halaman
            'users' => User::latest()->get(), //semua data user diurutkan berdasarkan waktu terbaru dibuat
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
