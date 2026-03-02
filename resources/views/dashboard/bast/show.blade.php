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


            </div>
        </div>
    </div>
@endsection
