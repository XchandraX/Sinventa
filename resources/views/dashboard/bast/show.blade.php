{{-- ? panggil file main.blade.php yang ada difolder dashboard/layout --}}
@extends('dashboard.layout.main')

{{-- ?code styling css untuk halaman detail berita acara --}}
@section('css')
    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            .bar-code,
            .bar-code * {
                visibility: visible;
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

@section('konten')
    <div class="page-header">
        <div class="page-title">
            <h4>{{ $title }}</h4>
            <h6>Lihat detail {{ $title }}</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-header pb-0">
            <h5>
                Kode Kategori: {{ $bast->barang->kategori->kode_kategori }} | Kode Lokasi:
                {{ $bast->barang->lokasi->kode_lokasi }} | Kode Barang: {{ $bast->barang->kode_barang }}
            </h5>
        </div>
        <hr>

        <div class="card-body">
            <div class="fw-bold text-secondary mb-3">Detail Barang Inventris:</div>
            <div class="row">

                {{-- kolom kiri --}}
                <div class="col-lg-8 col-12">
                    <div class="row">

                        @php
                            $cards = [
                                ['id' => 'barang.kode_barang', 'label' => 'Kode'],
                                ['id' => 'barang.nama_barang', 'label' => 'Nama'],
                                ['id' => 'barang.kategori.nama_kategori', 'label' => 'Kategori'],
                                ['id' => 'barang.lokasi.nama_lokasi', 'label' => 'Lokasi'],
                                ['id' => 'barang.status_barang', 'label' => 'Status'],
                                ['id' => 'barang.deskripsi', 'label' => 'Deskripsi'],
                            ];
                        @endphp
                        @foreach ($cards as $card)
                            <div class="col-6">
                                <div class="mb-3">
                                    @if ($card['label'] == 'Kode' || $card['label'] == 'Nama' || $card['label'] == 'Kategori' || $card['label'] == 'Lokasi')
                                        <div>{{ $card['label'] }} Barang:</div>
                                        <h4 class="fw-bold">{{ data_get($bast, $card['id']) }}</h4>
                                    @elseif ($card['label'] == 'Status')
                                        <div>{{ $card['label'] }} Barang:</div>
                                        <h4 class="fw-bold">
                                            @if (data_get($bast, $card['id']) == 'Baik')
                                                <span class="btn btn-sm btn-success">Baik</span>
                                            @elseif (data_get($bast, $card['id']) == 'Rusak Ringan')
                                                <span class="btn btn-sm btn-warning">Rusak Ringan</span>
                                            @elseif (data_get($bast, $card['id']) == 'Rusak Berat')
                                                <span class="btn btn-sm btn-danger">Rusak Berat</span>
                                            @else
                                                <span class="btn btn-sm btn-dark">Hilang</span>
                                            @endif
                                        </h4>
                                    @else
                                        <div>{{ $card['label'] }} Barang:</div>
                                        <p class="fw-bold">{{ data_get($bast, $card['id']) }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- kolom kanan --}}
                <div class="col-lg-4 col-12">
                    <div>QR Code Barang:</div>
                    <div class="bar-code-view">
                        {{-- generate QRCode dari data link detail barang --}}
                        <div class="bar-code">
                            {!! QrCode::size(100)->generate(route('barang.show', $bast->barang)) !!}
                        </div>

                        {{-- tombol cetak QRcode --}}
                        <a class="btn btn-secondary mx-0" onclick="window.print()">
                            <i class="bi bi-printer"></i>
                        </a>

                        {{-- tombol download QRCode --}}
                        <a href="{{ route('barang.downloadQr', $bast->barang) }}" class="btn btn-primary">
                            <i class="bi bi-download"></i>
                        </a>
                    </div>
                </div>
            </div>

            <hr>

            {{-- detail penyerah dan peneria --}}
            <div class="fw-bold text-secondary mb-3">Detail Penyerah dan Penerima:</div>
            <div class="row">
                @php
                    $cards = [
                        ['label' => 'Penerima', 'id' => 'userTerima.nama_lengkap', 'if' => 'status_terima'],
                        ['label' => 'Penyerah', 'id' => 'userSerah.nama_lengkap', 'if' => 'status_serah'],
                    ];
                @endphp
                @foreach ($cards as $card)
                    <div class="col-lg-4 col-6">
                        <div class="mb-3">
                            <div>Nama {{ $card['label'] }}:</div>
                            <h4 class="fw-bold">{{ data_get($bast, $card['id']) }}</h4>
                        </div>
                        <div class="mb-3">
                            <div>Status {{ $card['label'] }}:</div>
                            <h4 class="fw-bold">
                                @if ($bast->{$card['if']} == 'Menunggu')
                                    <span class="btn btn-sm text-white bg-secondary">
                                        <i class="bi bi-hourglass-split"></i> Menunggu
                                    </span>
                                @else
                                    <span class="btn btn-sm text-white bg-success">
                                        <i class="bi bi-check-circle"></i> Disetujui
                                    </span>
                                @endif
                            </h4>
                        </div>
                    </div>
                @endforeach
                <div class="col-lg-4 col-12">
                    <div class="mb-3">
                        <div>Waktu Dibuat:</div>
                        <h4 class="fw-bold">{{ $bast->created_at->translatedFormat('l, d m Y') }}</h4>
                    </div>
                </div>
            </div>
        </div>

        {{-- card footer --}}
        <div class="card-footer">
            @if (auth()->user()->role == 'admin')
                <a href="#" class="btn btn-secondary" target="_blank">
                    <i class="bi bi-download"></i>
                </a>

                <a href="{{ route('bast.edit', $bast) }}" class="btn btn-primary">
                    <i class="bi bi-pencil-square"></i>
                </a>

                {{-- tampilkan tombol hapus --}}
                <form action="{{ route('bast.destroy', $bast) }}" class="d-inline" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit"
                        onclick="return confirm('Yakin ingin menghapus Berita Acara ini?')">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            @endif

            @if (auth()->user()->id == $bast->user_serah_id && $bast->status_serah == 'Menunggu')
                <form action="#" method="POST" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-success" 
                        onclick="return confirm('Anda akan menyetujui Berita Acara ini sebagai pihak Penyerah! Lanjutkan?')">
                        <i class="bi bi-check-circle">Setujui Penyerah</i>
                    </button>
                </form>
            @endif
            @if (auth()->user()->id == $bast->user_terima_id && $bast->status_terima == 'Menunggu')
                <form action="#" method="POST" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-success" 
                        onclick="return confirm('Anda akan menyetujui Berita Acara ini sebagai pihak Penerima! Lanjutkan?')">
                        <i class="bi bi-check-circle">Setujui Penerima</i>
                    </button>
                </form>
            @endif
        </div>
    </div>
@endsection
