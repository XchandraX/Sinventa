{{-- 
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