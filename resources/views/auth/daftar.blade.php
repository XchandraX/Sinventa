{{-- 
? @extends() digunakan untuk memanggil auth/layout/main.blade.php
--}}
@extends('auth.layout.main')

@section('konten')
    {{-- Menggunakan wrapper otentikasi --}}
    <div class="login-wrapper" style="height: auto; min-height: 100vh; display: flex; align-items: center;">
        <div class="login-content w-100 m-auto" style="height: auto; padding: 20px;">
            
            <div class="login-userset card-guest p-4 p-lg-5 shadow-sm" style="max-width: 600px; margin: 0 auto; width: 100%;">
                
                <div class="login-userheading text-center">
                    <span class="mb-2 d-block fs-1">👋</span>
                    <h3>Daftar ke SINVESTA!</h3>
                    <h4>Buat akun baru untuk mengakses sistem inventaris aset dan berita acara.</h4>
                </div>

                <hr class="mb-4">

                {{-- formulir pendaftaran --}}
                <form action="{{ route('daftar.store') }}" method="POST">
                    @csrf

                    @php
                        $cards = [
                            ['id' => 'nama_lengkap', 'label' => 'Nama Lengkap', 'place' => 'Isi Nama Lengkap', 'type' => 'text'],
                            ['id' => 'username', 'label' => 'Username', 'place' => 'Isi Username', 'type' => 'text'],
                            ['id' => 'email', 'label' => 'Email', 'place' => 'Isi Email', 'type' => 'email'],
                        ];
                        $cards2 = [
                            ['id' => 'password', 'label' => 'Password', 'place' => 'Isi Password'],
                            ['id' => 'password_confirmation', 'label' => 'Konfirmasi Password', 'place' => 'Isi Konfirmasi Password'],
                            ['id' => 'reg_code', 'label' => 'Kode Registrasi', 'place' => 'Masukkan kode akses pendaftaran (Dari Admin)'],
                        ];
                    @endphp

                    <div class="row">
                        @foreach ($cards as $card)
                            <div class="col-12">
                                <div class="form-login">
                                    <label for="{{ $card['id'] }}">{{ $card['label'] }}</label>
                                    <div class="form-addons">
                                        <input type="{{ $card['type'] }}" id="{{ $card['id'] }}" 
                                            class="form-control @error($card['id']) is-invalid @enderror" name="{{ $card['id'] }}"
                                            placeholder="{{ $card['place'] }}" value="{{ old($card['id']) }}">
                                        @error($card['id'])
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="row">
                        {{-- role --}}
                        <div class="col-12 col-md-6">
                            <div class="form-login">
                                <label class="d-block mb-3">Daftar Sebagai:</label>
                                <div>
                                    <label class="inputcheck d-inline-block me-4"> Admin
                                        <input type="radio" name="role" id="role_admin" value="admin" @if(old('role') == 'admin') checked @endif>
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="inputcheck d-inline-block"> User
                                        <input type="radio" name="role" id="role_user" value="user" @if(old('role', 'user') == 'user') checked @endif>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                @error('role')
                                    <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- lembaga --}}
                        <div class="col-12 col-md-6">
                            <div class="form-login">
                                <label for="lembaga">Lembaga</label>
                                <div class="form-addons">
                                    <input type="text" id="lembaga" class="form-control @error('lembaga') is-invalid @enderror"
                                        placeholder="Isi Lembaga" name="lembaga" value="{{ old('lembaga') }}">
                                    @error('lembaga')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        @foreach ($cards2 as $card)
                            <div class="col-12">
                                <div class="form-login">
                                    <label for="{{ $card['id'] }}">{{ $card['label'] }}</label>
                                    
                                    {{-- Cek dinamis: apakah input ini bertipe password? --}}
                                    @php $isPassword = str_contains($card['id'], 'password'); @endphp
                                    
                                    <div class="{{ $isPassword ? 'pass-group' : 'form-addons' }}">
                                        <input type="{{ $isPassword ? 'password' : 'text' }}" 
                                            class="@error($card['id']) is-invalid @enderror"
                                            name="{{ $card['id'] }}" id="{{ $card['id'] }}" 
                                            placeholder="{{ $card['place'] }}" value="{{ old($card['id']) }}">
                                        
                                        @if($isPassword)
                                            <span class="bi toggle-password bi-eye-slash" style="cursor: pointer;"></span>
                                        @endif
                                        
                                        @error($card['id'])
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <hr class="mt-2 mb-4">

                    {{-- tombol daftar  --}}
                    <div class="form-login">
                        <button class="btn btn-login w-100" type="submit">Daftar Sekarang</button>
                    </div>

                </form>

                {{-- link menuju halaman login --}}
                <div class="signinform text-center mt-4">
                    <h4>Sudah punya akun? <a href="{{ route('login') }}" class="hover-a">Login</a></h4>
                </div>
                
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            // JS khusus untuk handle custom class .pass-group
            $(document).on('click', '.toggle-password', function() {
                var input = $(this).siblings('input');
                $(this).toggleClass("bi-eye bi-eye-slash");
                if (input.attr("type") === "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });
        });
    </script>
@endsection