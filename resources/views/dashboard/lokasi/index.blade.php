{{-- ? panggil file layout.blade.php yang ada difolder dashboard/layout --}}
@extends('dashboard.layout.main')

{{-- ? tulis kode html untk halaman index lokasi diantara @section --}}
@section('konten')
    {{-- ! konten utama halaman dashboard ditulis disini --}}

    {{-- judul halaman --}}
    <div class="page-header">
        <div class="page-title">
            <h4>{{ $title }}</h4>
            <h6>Lihat atau cari lokasi Barang</h6>
        </div>

        {{-- tombol tambah lokasi baru --}}
        <div class="page-btn">
            <a href="{{ route('lokasi.create') }}" class="btn btn-added">
                <i class="bi bi-plus-circle"></i> Tambah Lokasi Barang
            </a>
        </div>

    </div>
    
    {{-- card list lokasi Barang --}}
    <div class="card">
        <div class="card-body">

            {{-- ! jika dat lokasi tidak ada di database --}}
            @if ($lokasis->isEmpty())
                {{-- tampilkan informasi ini --}}
                <div class="alert alert-info" role="alert">
                    Tidak ada Lokasi Barang tersedia.
                </div>
                {{-- ! jika data lokasi ada di database --}}
            @else

                <div class="table-top">

                    {{-- kolom pencarian --}}
                    <div class="search-set">
                        <div class="search-input">
                            <a href="" class="btn btn-searchset"><i class="bi bi-search"></i></a>
                        </div>
                    </div>

                    
                    {{-- menu eksport data lokasi ke PDF, EXCEL, dan cetak --}}
                    <div class="wordset">
                        <ul>
                            <li>
                                <a href="{{ route('lokasi.exportToPdf') }}">
                                    <img src="{{ asset('assets/icon/pdf.svg') }}" alt="img">
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('lokasi.exporToExcel') }}">
                                    <img src="{{ asset('assets/icon/excel.svg') }}" alt="img">
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('lokasi.print') }}">
                                    <img src="{{ asset('assets/icon/printer.svg') }}" alt="img">
                                </a>
                            </li>
                        </ul>
                    </div>
                    
                </div>

                {{-- table daftar lokasi --}}
                <div class="table-responsive">
                    <table class="table datanew">

                        {{-- judul kolom --}}
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode</th>
                                <th>Nama Lokasi</th>
                                <th>Keterangan</th>
                                <th>Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        {{-- isi kolom --}}
                        <tbody>
                            {{-- tampilkan data user satu persatu menggunakan perulangan foreach --}}
                            @foreach ($lokasis as $lokasi)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $lokasi->kode_lokasi }}</td>
                                    <td>{{ $lokasi->nama_lokasi }}</td>
                                    <td>{{ $lokasi->deskripsi }}</td>
                                    <td>{{ $lokasi->created_at }}</td>
                                    <td>
                                        <a href="{{ route('lokasi.edit', $lokasi) }}" class="me-3">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('lokasi.destroy', $lokasi) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="confirm-text btn p-0 m-0"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data lokasi {{ $lokasi->nama_lokasi }} ini?')">
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
