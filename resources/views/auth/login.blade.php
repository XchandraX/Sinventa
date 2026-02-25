{{-- 
? @extends() digunakan untuk memanggil auth/layout/main.blade.php
* jika penamaan folder dan file yang dipanggil tidak sama, maak layouting tidak dapat berjalan
--}}
@extends('auth.layout.main')

{{-- 
? konten utama view form login harus di tulis diantara section('konten')
* 'konten' adalah nama dari @yield('konten') yang ada di file main.blade.php
--}}
@section('konten')

    {{-- ! konten utama halaman form login ditulis disini! --}}
    <div class="col-12 col-lg-4 m-auto py-3 py-lg-5">

        {{-- ? Jika ada session dengan nama 'berhasil' dikirim dari contorller --}}
        @session('berhasil')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{-- ? tampilkan pesan --}}
            {{ session('berhasil') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endsession

        {{-- Judul halaman login --}}
        <span class="mb-0 fs-1">👋</span>
        <h1 class="fs-2">Masuk ke SINVESTA!</h1>
        <p class="lead mb-4">Senang melihat Anda kembali, silahkan masuk menggunakan Akun Anda!</p>

        <hr>

        {{-- form login --}}

        <form action="{{ route('login.store') }}" method="POST">
            @csrf
            {{-- username --}}
            <div class="mb-4">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" class="form-control @error('username') is-invalid @enderror"
                    name="username" placeholder="Masukan Username Anda!">
                {{-- jika invalid --}}
                @error('username')
                    {{-- tampilkan pesan errornya --}}
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- password --}}
            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" placeholder="Masukan Password Anda!">
                {{-- jika invalid --}}
                @error('password')
                    {{-- tampilkan pesan errornya --}}
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <hr>

            {{-- tombol login --}}
            <div class="align-items-center mt-0">
                <div class="d-grid">
                    <button class="btn btn-primary mb-0" type="submit">Login</button>
                </div>
            </div>
        </form>
        {{-- form selesai --}}

        {{-- link menuju halaman daftar user --}}
        {{-- <div class="mt-4 text-center">
            <span>Belum punya akun? <a href="{{ route('daftar.index') }}">Daftar</a></span>
        </div> --}}
    </div>

@endsection