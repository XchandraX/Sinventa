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
                <div class="form-group">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" class="form-control @error('username') is-invalid @enderror"
                        name="username" placeholder="Masukan Username Anda!" value="{{ old('username') }}">
                    {{-- jika invalid --}}
                    @error('username')
                        {{-- tampilkan pesan errornya --}}
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- passowrd --}}
            <div class="mb-4">
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">

                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" id="password" placeholder="Masukan Password Anda!">

                        <span class="bi toggle-password bi-eye-slash input-group-text"></span>
                        {{-- jika password tidak valid --}}

                    </div>

                    @error('password')
                        <div id="password" class="invalid-feedback d-block">
                            {{-- tampilkan pesan error --}}
                            {{ $message }}
                        </div>
                    @enderror
                </div>
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
        <div class="mt-4 text-center">
            <span>Belum punya akun? <a href="{{ route('daftar.index') }}">Daftar</a></span>
        </div>
    </div>

@endsection
@section('js'){{-- 
? @extends() digunakan untuk memanggil auth/layout/main.blade.php
* jika penamaan folder dan file yang dipanggil tidak sama, maka layouting tidak dapat berjalan
--}}
@extends('auth.layout.main')

@section('konten')

    {{-- ! konten utama halaman form login ditulis disini! --}}
    {{-- Kita gunakan wrapper bawaan style.css --}}
    <div class="login-wrapper" style="height: auto; min-height: 100vh; display: flex; align-items: center;">
        <div class="login-content w-100 m-auto" style="height: auto; padding: 20px;">
            
            {{-- Menggunakan class .card-guest agar serasi dengan tema --}}
            <div class="login-userset card-guest p-4 p-lg-5 shadow-sm" style="max-width: 450px; margin: 0 auto; width: 100%;">

                {{-- ? Jika ada session dengan nama 'berhasil' --}}
                @session('berhasil')
                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                        {{ session('berhasil') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endsession

                <div class="login-userheading text-center">
                    <span class="mb-2 d-block fs-1">👋</span>
                    <h3>Masuk ke SINVESTA!</h3>
                    <h4>Senang melihat Anda kembali, silahkan masuk menggunakan Akun Anda!</h4>
                </div>

                <hr class="mb-4">

                {{-- form login --}}
                <form action="{{ route('login.store') }}" method="POST">
                    @csrf
                    
                    {{-- username --}}
                    <div class="form-login">
                        <label for="username">Username</label>
                        <div class="form-addons">
                            <input type="text" id="username" class="@error('username') is-invalid @enderror" 
                                name="username" placeholder="Masukan Username Anda!" value="{{ old('username') }}" autocomplete="off">
                            @error('username')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- password --}}
                    <div class="form-login">
                        <label for="password">Password</label>
                        <div class="pass-group">
                            <input type="password" class="@error('password') is-invalid @enderror" 
                                name="password" id="password" placeholder="Masukan Password Anda!">
                            {{-- Icon mata menggunakan style absolute dari pass-group --}}
                            <span class="bi toggle-password bi-eye-slash"></span>
                            
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- tombol login --}}
                    <div class="form-login mt-4">
                        <button class="btn btn-login w-100" type="submit">Login</button>
                    </div>

                    {{-- link menuju halaman daftar user --}}
                    <div class="signinform text-center mt-4">
                        <h4>Belum punya akun? <a href="{{ route('daftar.index') }}" class="hover-a">Daftar</a></h4>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        $(document).ready(function() {
            // Event listener disesuaikan untuk struktur .pass-group
            $(document).on('click', '.toggle-password', function() {
                var input = $(this).siblings('input');

                // Toggle icon
                $(this).toggleClass("bi-eye bi-eye-slash");

                // Toggle type input
                if (input.attr("type") === "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });
        });
    </script>
@endsection
    <script>
        $(document).ready(function() {
            // Satu event listener untuk semua toggle password
            $(document).on('click', '.toggle-password', function() {
                // Cari input password dalam satu grup (input-group yang sama)
                var input = $(this).closest('.input-group').find(
                    'input[type="password"], input[type="text"]');

                // Toggle icon
                $(this).toggleClass("bi-eye bi-eye-slash");

                // Toggle type input
                if (input.attr("type") === "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });
        });
    </script>
@endsection
