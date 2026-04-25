{{-- ? panggil file layout.blade.php yang ada difolder dashboard/layout --}}
@extends('dashboard.layout.main')

{{-- ? tulis kode html untuk halaman index user diantara @section --}}
@section('konten')
    {{-- ! konten utama halaman dashboard ditulis disini --}}
    {{-- judul halaman --}}
    <div class="page-header">
        <div class="page-title">
            <h4>Ubah Data Pengguna</h4>
            <h6>Mengubah Data Pengguna</h6>
        </div>
        <div class="page-btn">
            <a href="{{ route('users.index') }}" class="btn btn-added">
                <i class="bi bi-arrow-left-square"></i>
            </a>
        </div>
    </div>

    {{-- card form edit user --}}
    <div class="card">
        <div class="card-body">

            {{-- form edit data user --}}
            <form action="{{ route('users.update', $user) }}" method="POST">

                {{-- blade csrf --}}
                @csrf

                {{-- ubah method dari post ke put --}}
                @method('put')

                <div class="row">

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
                        ];
                    @endphp

                    @foreach ($cards as $card)
                        <div class="col-lg-6 col-sm-12">
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
                    <div class="col-lg-6 col-sm-12">
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
                    <div class="col-lg-6 col-sm-12">
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
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label class="form-label">{{ $card['label'] }}</label>

                                <div class="input-group">
                                    <input type="password" class="form-control @error($card['id']) is-invalid @enderror"
                                        name="{{ $card['id'] }}" placeholder="{{ $card['place'] }}"
                                        value="{{ old($card['id']) }}">

                                    <span class="bi toggle-password bi-eye-slash input-group-text"
                                        style="cursor: pointer;"></span>
                                </div>

                                @error($card['id'])
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    @endforeach

                    <div class="col-12">
                        <button class="btn btn-submit me-2" type="submit">Update</button>
                        <a href="{{ route('users.index') }}" class="btn btn-cancel">Batal</a>

                    </div>
                </div>
            </form>
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
