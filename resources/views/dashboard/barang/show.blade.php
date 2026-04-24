{{-- ? panggil file main.blade.php yang ada difolder dashboard/layout --}}
@extends('dashboard.layout.main')

{{-- ? sisipkan code css utnuk fitur cetak QRCode --}}
@section('css')
    <style>
        @media print {
            body * {
                visibility: hidden
            }

            .bar-code,
            .bar-code * {
                visibility: visible
            }

            .bar-code {
                position: absolute;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
                text-align: center;
            }
        }
    </style>
@endsection

{{-- ? tulis code html untuk halaman show barang --}}
@section('konten')
    <div class="page-header">
        {{-- judul halaman --}}
        <div class="page-title">
            <h4>{{ $title }}</h4>
            <h6>Lihat detail barang inventaris</h6>
        </div>
        <div class="page-btn">
            <a href="{{ route('barang.index') }}" class="btn btn-added">
                <i class="bi bi-arrow-left-square"></i>
            </a>
        </div>
    </div>

    {{-- card detail data barang --}}
    <div class="card">
        <div class="card-body">
            <div class="row">

                {{-- kolom kiri, menampilkan detail barang --}}
                <div class="col-lg-8 col-12">
                    <div class="row">

                        @php
                            $cards = [
                                ['label' => 'Kode Barang', 'id' => 'kode_barang'],
                                ['label' => 'Nama Barang', 'id' => 'nama_barang'],
                                ['label' => 'Kategori Barang', 'id' => 'kategori.nama_kategori'],
                                ['label' => 'Lokasi Barang', 'id' => 'lokasi.nama_lokasi'],
                            ];
                        @endphp

                        @foreach ($cards as $card)
                            <div class="col-6">
                                <div class="mb-3">
                                    <div>{{ $card['label'] }}:</div>
                                    <h4 class="fw-bold">{{ data_get($barang, $card['id'], '') }}</h4>
                                </div>
                            </div>
                        @endforeach

                        <div class="col-6">
                            <div class="mb-3">
                                <div>Status Barang:</div>
                                <h4 class="fw-bold">
                                    @if ($barang->status_barang == 'Baik')
                                        <span class="btn btn-sm btn-success">Baik</span>
                                    @elseif ($barang->status_barang == 'Rusak Ringan')
                                        <span class="btn btn-sm btn-warning">Rusak Ringan</span>
                                    @elseif ($barang->status_barang == 'Rusak Berat')
                                        <span class="btn btn-sm btn-danger">Rusak Berat</span>
                                    @else
                                        <span class="btn btn-sm btn-dark">Hilang</span>
                                    @endif
                                </h4>
                            </div>
                        </div>

                        {{-- tampilkan status barang --}}
                        <div class="col-6">
                            <div class="mb-03">
                                <div>Deskripsi Barang:</div>
                                <h6 class="fw-bold">{{ $barang->deskripsi ?? '-' }}</h6>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Di file show.blade.php, update bagian QR Code --}}
                <div class="col-lg-4 col-12">
                    <div>QR Code Barang:</div>
                    <div class="bar-code-view">
                        <div class="bar-code">
                            {!! QrCode::size(100)->generate(route('public.barang.show', $barang->id)) !!}
                            {{-- ↑ ubah ke route publik --}}
                        </div>

                        <a class="btn btn-secondary mx-0" onclick="window.print()">
                            <i class="bi bi-printer"></i>
                        </a>

                        <a href="{{ route('barang.downloadQr', $barang) }}" class="btn btn-primary">
                            <i class="bi bi-download"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        {{-- card footer --}}
        <div class="card-footer">

            {{-- tombol cetak detail barang --}}
            <a href="{{ route('barang.print.barang', $barang) }}" class="btn btn-secondary" target="_blank">
                <i class="bi bi-printer"></i>
            </a>

            {{-- jika user yang login adalah role = admin --}}
            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'root')
                {{-- tampilkan tombol edit --}}
                <a href="{{ route('barang.edit', $barang) }}" class="btn btn-primary">
                    <i class="bi bi-pencil-square"></i>
                </a>

                {{-- tampilkan tombol hapus --}}
                <form action="{{ route('barang.destroy', $barang) }}" class="d-inline" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit"
                        onclick="return confirm('Yakin ingin menghapus barang {{ $barang->nama_barang }}?')">
                        <i class="bi bi-trash" style="color: var(--text-secondary)"></i>
                    </button>
                </form>
            @endif
        </div>
    </div>

    {{-- jika user yang login adalah role - admin --}}
    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'root')
        {{-- card untuk menampilkan riwayat bast barang --}}
        <div class="card">
            <div class="card-body">
                {{-- jika tiak ada berita acara untuk barang ini --}}
                @if ($basts->isEmpty())
                    {{-- tampilkan pesan informasi --}}
                    <div class="card-title">
                        Belum Ada Riwayat Serah Terima Barang untuk {{ $barang->nama_barang }} dengan
                        Kode {{ $barang->kode_barang }}
                    </div>
                    {{-- jika ada berita acara untuk barang ini --}}
                @else
                    {{-- judul card --}}
                    <div class="card-title">
                        Riwayat Berita Acara Serah Terima Barang : {{ $barang->nama_barang }}
                    </div>

                    {{-- kolom pencarian --}}
                    <div class="table-top">
                        <div class="search-set">
                            <div class="search-input">
                                <a class="btn btn-searchset"><i class="bi bi-search"></i></a>
                            </div>
                        </div>
                    </div>

                    {{-- table riwayat berita acara --}}
                    <div class="table-responsive">
                        <table class="table datanew">

                            {{-- judul kolom --}}
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Barang</th>
                                    <th>Penyerah</th>
                                    <th>Penerima</th>
                                    <th>Status</th>
                                    {{-- jika user yang login adalah role = admin --}}
                                    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'root')
                                        <th>Aksi</th>
                                    @endif
                                </tr>
                            </thead>

                            {{-- isi table --}}
                            <tbody>
                                {{-- tampilkan berita acara satu persatu menggunakan perulangan --}}
                                @foreach ($basts as $bast)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $barang->nama_barang }}</td>
                                        <td>
                                            @if ($bast->status_serah == 'Menunggu')
                                                <span class="btn btn-sm text-white bg-secondary">
                                                    <i class="bi bi-hourglass-split"></i>
                                                </span>
                                            @else
                                                <span class="btn btn-sm text-white bg-success">
                                                    <i class="bi bi-check-circle"></i>
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($bast->status_terima == 'Menunggu')
                                                <span class="btn btn-sm text-white bg-secondary">
                                                    <i class="bi bi-hourglass-split"></i>
                                                </span>
                                            @else
                                                <span class="btn btn-sm text-white bg-success">
                                                    <i class="bi bi-check-circle"></i>
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($bast->status_serah == 'Disetujui' && $bast->status_terima == 'Disetujui')
                                                <span class="btn btn-sm text-white bg-success">
                                                    <i class="bi bi-check-circle"></i> Disetujui
                                                </span>
                                            @elseif($bast->status_serah == 'Disetujui' && $bast->status_terima == 'Dibatalkan')
                                                <span class="btn btn-sm text-white bg-danger"><i
                                                        class="bi bi-x-circle"></i></span> Dibatalkan
                                            @elseif($bast->status_serah == 'Menunggu' && $bast->status_terima == 'Dibatalkan')
                                                <span class="btn btn-sm text-white bg-danger"><i
                                                        class="bi bi-x-circle"></i></span> Dibatalkan
                                            @elseif($bast->status_serah == 'Dibatalkan' && $bast->status_terima == 'Disetujui')
                                                <span class="btn btn-sm text-white bg-danger"><i
                                                        class="bi bi-x-circle"></i></span> Dibatalkan
                                            @elseif($bast->status_serah == 'Dibatalkan' && $bast->status_terima == 'Menunggu')
                                                <span class="btn btn-sm text-white bg-danger"><i
                                                        class="bi bi-x-circle"></i></span> Dibatalkan
                                            @elseif($bast->status_serah == 'Dibatalkan' && $bast->status_terima == 'Dibatalkan')
                                                <span class="btn btn-sm text-white bg-danger"><i
                                                        class="bi bi-x-circle"></i></span> Dibatalkan
                                            @else
                                                <span class="btn btn-sm text-white bg-secondary">
                                                    <i class="bi bi-hourglass-split"></i> Menunggu
                                                </span>
                                            @endif
                                        </td>


                                        <td>
                                            {{-- tampilkan tombol cetak berita acara --}}
                                            <a href="{{ route('bast.downloadPdf', $bast) }}" class="me-3">
                                                <i class="bi bi-download"></i>
                                            </a>

                                            {{-- tombol lihat detail bast --}}
                                            <a href="{{ route('bast.show', $bast) }}" class="me-3">
                                                <i class="bi bi-eye"></i>
                                            </a>

                                            {{-- tombol edit bast --}}
                                            <a href="{{ route('bast.edit', $bast) }}" class="me-3">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>

                                            {{-- tombol hapus bast --}}
                                            <form action="{{ route('bast.destroy', $barang) }}" method="post"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="confirm-text btn" type="submit"
                                                    onclick="return confirm('Yakin ingin menghapus berita acara {{ $barang->kode_barang }}?')">
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
    @endif
@endsection
