{{-- ? panggil file layout.blade.php yang ada difolder dashboard/layout --}}
@extends('dashboard.layout.main')

{{-- ? tulis kode html untk halaman index kategori diantara @section --}}
@section('konten')
    {{-- ! konten utama halaman dashboard ditulis disini --}}

    {{-- judul halaman --}}
    <div class="page-header">
        <div class="page-title">
            <h4>List Kategori Barang</h4>
            <h6>Lihat atau cari Kategori Barang</h6>
        </div>

        {{-- tombol tambah kategori baru --}}
        <div class="page-btn">
            <a href="{{ route('kategori.create') }}" class="btn-btn-added">
                <i class="bi bi-plus-circle"></i> Tambah Kategori Barang
            </a>
        </div>

    </div>

    {{-- card list Kategori Barang --}}
    <div class="card">
        <div class="card-body">

            {{-- ! jika dat kategori tidak ada di database --}}
            @if ($kategoris->isEmpty())
                {{-- tampilkan informasi ini --}}
                <div class="alert alert-info" role="alert">
                    Tidak ada Kategori Barang tersedia.
                </div>
                {{-- ! jika data kategori ada di database --}}
            @else

                <div class="table-top">

                    {{-- kolom pencarian --}}
                    <div class="search-set">
                        <div class="search-input">
                            <a href="" class="btn btn-searchset"><i class="bi bi-search"></i></a>
                        </div>
                    </div>

                    
                    {{-- menu eksport data kategori ke PDF, EXCEL, dan cetak --}}
                    <div class="wordset">
                        <ul>
                            <li>
                                <a href="{{ route('kategori.exportToPdf') }}">
                                    <img src="{{ asset('assets/icon/pdf.svg') }}" alt="img">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="{{ asset('assets/icon/excel.svg') }}" alt="img">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="{{ asset('assets/icon/printer.svg') }}" alt="img">
                                </a>
                            </li>
                        </ul>
                    </div>
                    
                </div>

                {{-- table daftar kategori --}}
                <div class="table-responsive">
                    <table class="table datanew">

                        {{-- judul kolom --}}
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode</th>
                                <th>Nama Kategori</th>
                                <th>Keterangan</th>
                                <th>Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        {{-- isi kolom --}}
                        <tbody>
                            {{-- tampilkan data user satu persatu menggunakan perulangan foreach --}}
                            @foreach ($kategoris as $kategori)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $kategori->kode_kategori }}</td>
                                    <td>{{ $kategori->nama_kategori }}</td>
                                    <td>{{ $kategori->deskripsi }}</td>
                                    <td>{{ $kategori->created_at }}</td>
                                    <td>
                                        <a href="{{ route('kategori.edit', $kategori) }}" class="me-3">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('kategori.destroy', $kategori) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="confirm-text btn p-0 m-0"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data Kategori {{ $kategori->nama_kategori }} ini?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
