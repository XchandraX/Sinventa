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

                    {{-- kolom nama lengkap --}}
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="nama_lengkap">Nama Lengkap</label>
                            <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror"
                                id="nama_lengkap" name="nama_lengkap"
                                value="{{ old('nama_lengkap', $user->nama_lengkap) }}">

                            {{-- jika nama_lengkap tidak valid --}}
                            @error('nama_lengkap')
                                {{-- tampilkan pesan error --}}
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- kolom email --}}
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" value="{{ old('email', $user->email) }}">

                            {{-- jika email tidak valid --}}
                            @error('email')
                                {{-- tampilkan pesan error --}}
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- kolom username --}}
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                id="username" name="username" value="{{ old('username', $user->username) }}">

                            {{-- jika username tidak valid --}}
                            @error('username')
                                {{-- tampilkan pesan error --}}
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- kolom lembaga --}}
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="lembaga">Lembaga</label>
                            <input type="text" class="form-control @error('lembaga') is-invalid @enderror" id="lembaga"
                                name="lembaga" value="{{ old('lembaga', $user->lembaga) }}">

                            {{-- jika lembaga tidak valid --}}
                            @error('lembaga')
                                {{-- tampilkan pesan error --}}
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- ? untuk keamanan, kolom role hanya ditampilkan jika user = admin --}}
                    @if (Auth::user()->role == 'admin')
                        {{-- kolom role --}}
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="d-block from-label">Role:</label>
                                {{-- admin --}}
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="role" id="role_admin"
                                        value="admin" @if (old('role', $user->role) == 'admin') checked @endif>
                                    <label for="role_admin" class="form-check-label">Admin</label>
                                </div>
                                {{-- role --}}
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="role" id="role_user"
                                        value="user" @if (old('role', $user->role) == 'user') checked @endif>
                                    <label for="role_user" class="form-check-label">User</label>
                                </div>


                                {{-- jika role tidak valid --}}
                                @error('role')
                                    {{-- tampilkan pesan error --}}
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    @endif

                    <hr>
                    <h6 class="mb-3">Kosongkan password jika tidak ingin diubahF!</h6>

                    {{-- kolom password --}}
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="pass-group">
                                <input type="password" class="pass-input @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="Masukkan password pengguna">
                                <span class="bi toggle-password bi-eye-slash"></span>
                            </div>

                            {{-- jika password tidak valid --}}
                            @error('password')
                                {{-- tampilkan pesan error --}}
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- kolom password_confirmation --}}
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi Password</label>
                            <div class="pass-group">
                                <input type="password"
                                    class="pass-input @error('password_confirmation') is-invalid @enderror"
                                    id="password_confirmation" name="password_confirmation"
                                    placeholder="Masukkan password confirmation">
                                <span class="bi toggle-password bi-eye-slash"></span>
                            </div>

                            {{-- jika password_confirmation tidak valid --}}
                            @error('password_confirmation')
                                {{-- tampilkan pesan error --}}
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <button class="btn btn-submit me-2" type="submit">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
