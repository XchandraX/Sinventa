{{-- ? panggil file main.blade.php yang ada difolder dashboard/layout --}}
@extends('dashboard.layout.main')

@section('konten')

    <div class="page-header">
        <div class="page-title">
            <h4>{{ $title }}</h4>
            <h6>{{ $deskripsi }}</h6>
        </div>
    </div>
    <div class="card">
        <div class="card-body">


            {{-- jika data bast tidak ada --}}
            @if ($basts->isEmpty())
                {{-- tampilkan infomasi --}}
                <div class="alert alert-info" role="alert">
                    Tidak ada berita acara tersedia
                </div>
            @else
                <div class="table-top">
                    <div class="search-set">
                        <div class="search-input">
                            <a class="btn btn-searchset"><i class="bi bi-search"></i></a>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table datanew">

                        {{-- judlu tabel --}}
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Barang</th>
                                <th>Kategori Barang</th>
                                <th>Lokasi Barang</th>
                                <th>Status Barang</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        {{-- isi tabel --}}
                        <tbody>
                            {{-- tampilan bast 1 per1 --}}
                            @foreach ($basts as $bast)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $bast->barang->nama_barang }}</td>
                                    <td>{{ $bast->barang->kategori->nama_kategori }}</td>
                                    <td>{{ $bast->barang->lokasi->nama_lokasi }}</td>
                                    <td>
                                        @if ($bast->barang->status_barang == 'Baik')
                                            <span class="btn btn-sm text-white bg-success">Baik</span>
                                        @elseif ($bast->barang->status_barang == 'Rusak Ringan')
                                            <span class="btn btn-sm text-white bg-warning">Rusak Ringan</span>
                                        @elseif ($bast->barang->status_barang == 'Rusak Berat')
                                            <span class="btn btn-sm text-white bg-danger">Rusak Berat</span>
                                        @else
                                            <span class="btn btn-sm text-white bg-secondary">Hilang</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if (auth()->user()->id == $bast->user_serah_id)
                                            @if ($bast->status_serah == 'Menunggu')
                                                <span class="btn btn-sm text-white bg-secondary"><i
                                                        class="bi bi-hourglass-split"></i></span> {{ $bast->status_serah }}
                                            @else
                                                <span class="btn btn-sm text-white bg-success"><i
                                                        class="bi bi-check-circle-fill"></i></span> {{ $bast->status_serah }}
                                            @endif
                                        @else
                                            @if ($bast->status_terima == 'Menunggu')
                                                <span class="btn btn-sm text-white bg-secondary"><i
                                                        class="bi bi-hourglass-split"></i></span> {{ $bast->status_serah }}
                                            @else
                                                <span class="btn btn-sm text-white bg-success"><i
                                                        class="bi bi-check-circle-fill"></i></span> {{ $bast->status_serah }}
                                            @endif
                                        @endif
                                    </td>
                                    <td>

                                        {{-- tombol lihat detail berita acara --}}
                                        <a href="{{ route('bast.show', $bast) }}" class="me-3">
                                            <i class="bi bi-eye"></i>
                                        </a>
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

@section('js')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                allowClear: true,
                width: '100%'
            });
        });
    </script>
@endsection
