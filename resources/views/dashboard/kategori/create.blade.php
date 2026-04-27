{{-- ? panggil file layout.blade.php yg ada difolder dashboard/layout --}}
@extends('dashboard.layout.main')

@section('konten')
    {{-- ! konten utama halaman dashboard ditulis disini --}}
    
    {{-- header halaman --}}
    <div class="page-header mb-4">
        <div class="page-title">
            <h4>{{ $title }}</h4>
            <h6 class="text-muted">Buat Kategori Barang Baru</h6>
        </div>
        <div class="page-btn">
            <a href="{{ route('kategori.index') }}" class="btn btn-added">
                <i class="bi bi-arrow-left-square"></i>
            </a>
        </div>
    </div>

    {{-- card form tambah data --}}
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">

            {{-- form tambah data kategori --}}
            <form action="{{ route('kategori.store') }}" method="POST">
                @csrf

                <div class="row">
                    {{-- kolom kode_kategori --}}
                    <div class="col-lg-6 col-md-6 col-12 mb-3">
                        <div class="form-group">
                            <label for="kode_kategori" class="fw-semibold mb-2">Kode Kategori</label>
                            <input type="text" class="form-control @error('kode_kategori') is-invalid @enderror"
                                id="kode_kategori" name="kode_kategori" value="{{ old('kode_kategori') }}"
                                placeholder="Masukkan Kode Kategori" autocomplete="off">

                            @error('kode_kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- kolom nama_kategori --}}
                    <div class="col-lg-6 col-md-6 col-12 mb-3">
                        <div class="form-group">
                            <label for="nama_kategori" class="fw-semibold mb-2">Nama Kategori</label>
                            <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror"
                                id="nama_kategori" name="nama_kategori" value="{{ old('nama_kategori') }}"
                                placeholder="Masukkan Nama Kategori" autocomplete="off">

                            @error('nama_kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- kolom deskripsi --}}
                    <div class="col-12 mb-4">
                        <div class="form-group">
                            <label for="deskripsi" class="fw-semibold mb-2">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                id="deskripsi" name="deskripsi" rows="4"
                                placeholder="Masukkan deskripsi kategori (opsional)">{{ old('deskripsi') }}</textarea>

                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- tombol aksi --}}
                    <div class="col-12 mt-2">
                        <button type="submit" class="btn btn-submit me-2 px-4">Simpan
                        </button>
                        <a href="{{ route('kategori.index') }}" class="btn btn-cancel px-4">
                            Batal
                        </a>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
@endsection