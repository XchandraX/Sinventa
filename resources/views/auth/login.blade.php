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

    {{-- Judul halaman login --}}
    <span class="mb-0 fs-1">👋</span>
    <h1 class="fs-2">Masuk ke SINVESTA!</h1>
    <p class="lead mb-4">Senang melihat Anda kembali, silahkan masuk menggunakan Akun Anda!</p>
    
    <hr>

    {{-- form login --}}

    <form action="" method="POST">
        @csrf
        {{-- username --}}
        <div class="mb-4"></div>
    </form>
</div>