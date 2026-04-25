{{-- 
? @extends() digunakan untuk memanggil auth/layout/main.blade.php
* jika penamman folder dan file yang dipanggil tidak sama, maka layouting tidak dapat berjalan
--}}
@extends('auth.layout.main')

{{-- 
? konten utama view form login harus di tulis diantara @section('kontent')
* 'konten' adalah nama dari @yield('konten') yang ada di file main.blade.php
--}}
@section('konten')
    {{-- ! konten utama halaman form pendaftaran user ditulis disini!! --}}
    <div class="col-12 col-lg-5 m-auto py-3 py-lg-5">
        <span class="mb-0 fs-1">👋</span>
        <h1 class="-fs-1">Daftar ke SINVESTA!</h1>
        <p class="lead mb-4">Buat akun baru untuk mengakses sistem inventarsi aset dan berita acara.</p>

        <hr>

        {{-- formulir pendftaran --}}
        <form action="{{ route('daftar.store') }}" method="POST">
            {{-- csrf token untuk keamanan --}}
            @csrf

            @php
                $cards = [
                    ['id' => 'nama_lengkap', 'label' => 'Nama Lengkap', 'place' => 'Isi Nama Lengkap'],
                    ['id' => 'username', 'label' => 'Username', 'place' => 'Isi UserName'],
                    ['id' => 'email', 'label' => 'Email', 'place' => 'Isi Email'],
                ];
                $cards2 = [
                    ['id' => 'password', 'label' => 'Password', 'place' => 'Isi Password'],
                    [
                        'id' => 'password_confirmation',
                        'label' => 'Konfirmasi Password',
                        'place' => 'Isi Konfirmasi Password',
                    ],
                    [
                        'id' => 'reg_code',
                        'label' => 'Kode Registrasi',
                        'place' => 'Masukkan kode akses pendaftaran (Dari Admin)',
                    ],
                ];
            @endphp

            @foreach ($cards as $card)
                <div class="mb-4">
                    <div class="form-group">
                        <label for="{{ $card['id'] }}" class="form-label">{{ $card['label'] }}</label>
                        <input type="text" id="{{ $card['id'] }}"
                            class="form-control @error($card['id']) is-invalid @enderror" name="{{ $card['id'] }}"
                            placeholder="{{ $card['place'] }}" value="{{ old($card['id']) }}" autofocus>

                        {{-- jika"{{ $card['id'] }}"tidak valid --}}
                        @error($card['id'])
                            <div class="invalid-feedback" id="{{ $card['id'] }}">
                                {{-- tampilkan pesan error --}}
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            @endforeach


            {{-- role --}}
            <div class="mb-4">
                <div class="form-group">

                    <label class="d-block form-label">Daftar Sebagai:</label>

                    {{-- admin --}}
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="role" id="role_admin" value="admin"
                            @if (old('role' == 'admin' ? 'checked' : '')) checked @endif>
                        <label for="role_admin" class="form-check-label">Admin</label>
                    </div>

                    {{-- user --}}
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="role" id="role_user" value="user"
                            @if (old('role' == 'user' ? 'checked' : '')) checked @endif>
                        <label for="role_user" class="form-check-label">User</label>
                    </div>

                    {{-- jika role tidak valid --}}
                    @error('role')
                        <div id="role" class="text-danger">
                            {{-- tampilkan pesan error --}}
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            {{-- lembaga --}}
            <div class="mb-4">
                <div class="form-group">
                    <label for="lembaga" class="form-label">Lembaga</label>
                    <input type="text" id="lembaga" class="form-control @error('lembaga') is-invalid @enderror"
                        placeholder="Isi Lembaga" name="lembaga" value="{{ old('lembaga') }}">

                    {{-- jika lembaga tidak valid --}}
                    @error('lembaga')
                        <div id="lembaga" class="invalid-feedback">
                            {{-- tampilkan pesan error --}}
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            @foreach ($cards2 as $card)
                <div class="mb-4">
                    <div class="form-group">
                        <label for="{{ $card['id'] }}" class="form-label">{{ $card['label'] }}</label>

                        <div class="input-group">
                            <input type="password" id="{{ $card['id'] }}"
                                class="form-control @error($card['id']) is-invalid @enderror" name="{{ $card['id'] }}"
                                placeholder="{{ $card['place'] }}" value="{{ old($card['id']) }}">
                            <span class="bi toggle-password bi-eye-slash input-group-text"></span>
                        </div>

                        {{-- jika password tidak valid --}}
                        {{-- jika"{{ $card['id'] }}"tidak valid --}}
                        @error($card['id'])
                            <div class="invalid-feedback" id="{{ $card['id'] }}">
                                {{-- tampilkan pesan error --}}
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            @endforeach

            <hr>

            {{-- tombol daftar  --}}
            <div class="align-items-center mt-0">
                <div class="d-grid">
                    <button class="btn btn-primary mb-9" type="submit">Daftar</button>
                </div>
            </div>

        </form>
        {{-- form pendaftaran selesai --}}


        {{-- link menuju halam login --}}
        <div class="mt-4 text-center">
            <span>Sudah punya akun? <a href="{{ route('login') }}">Login</a></span>
        </div>
    </div>
@endsection
@section('js')
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
