{{-- ? panggil file layout.blade.php yg ada difolder dashboard/layout --}}
@extends('dashboard.layout.main')

{{-- ? tulis kode html untuk halaman create user diantara @section --}}
@section('konten')
    {{-- ! konten utama halaman dashboard ditulis disini --}}
    {{-- judul halaman --}}
    <div class="page-header">
        <div class="page-title">
            <h4>{{ $title }} </h4>
            <h6>Edit dan Update Kategori Barang Baru</h6>
        </div>
    </div>

    {{-- card form tambah data --}}
    <div class="card">
        <div class="card-body">

            {{-- form tambah data kategori --}}
            <form action="{{ route('kategori.update', $kategori) }}" method="POST">


                {{-- blade csrf --}}
                @csrf

                {{-- ganti method dari post -> put  --}}
                @method('put')

                <div class="row">

                    {{-- kolom kode_kategori --}}
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="kode_kategori">Kode Kategori *</label>
                            <input type="text" class="form-control  @error('kode_kategori') is-invalid @enderror" id="kode_kategori" name="kode_kategori"
                                value="{{ old('kode_kategori', $kategori->kode_kategori) }}" placeholder="Masukkan Kode Kategori">

                            {{-- jika kode_kategori tidak valid --}}
                            @error('kode_kategori')
                                {{-- tampilkan pesan error --}}
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- kolom nama_kategori --}}
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="nama_kategori">Nama Kategori *</label>
                            <input type="text" class="form-control  @error('nama_kategori') is-invalid @enderror" id="nama_kategori" name="nama_kategori"
                                value="{{ old('nama_kategori', $kategori->nama_kategori) }}" placeholder="Masukkan Nama Kategori">

                            {{-- jika nama_kategori tidak valid --}}
                            @error('nama_kategori')
                                {{-- tampilkan pesan error --}}
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- kolom deskripsi --}}
                    <div class="col-12">
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control  @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi"
                                 placeholder="Masukkan deskripsi pengguna">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>

                            {{-- jika deskripsi tidak valid --}}
                            @error('deskripsi')
                                {{-- tampilkan pesan error --}}
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- tombol simpan user --}}
                    <div class="col-12">
                        <button type="submit" class="btn btn-submit me-2">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
