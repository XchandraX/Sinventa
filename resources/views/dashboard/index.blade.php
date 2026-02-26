{{-- ? @extends() digunakan untuk memanggil dashboard/layout.main.blade.php --}}
@extends('dashboard.layout.main')

{{-- 
? konten utama view halaman dashboard harus di tulis diantara @section('konten')
* 'konten' adlah nama dari @yield('konten') yang ada di dashboard/layout.main.blade.php
--}}

@section('konten')
    {{-- ! konten utama halaman dashboard ditulis diisini --}}
    <h6>Selamat Datang,</h6>
    <h2 class="fw-bold mb-5">{{ Auth::user()->nama_lengkap ?? 'Pengguna' }}</h2>

    {{-- memapilkan jumlah data di database --}}
    <div class="row">
        @php
            $cards = [
                ['icon' => 'bi-card-list', 'label' => 'Kategori', 'count' => $jumlah_kategori],
                ['icon' => 'bi-buildings', 'label' => 'Lokasi', 'count' => $jumlah_lokasi],
                ['icon' => 'bi-box-seam', 'label' => 'Barang', 'count' => $jumlah_barang],
                ['icon' => 'bi-file-earmark-medical', 'label' => 'Berita Acara', 'count' => $jumlah_bast],
            ];
        @endphp

        @foreach ($cards as $card)
            <div class="col-lg-3 col-12 mb-3">
                <div class="card h-20">
                    <div class="card-body">
                        <div class="d-flex gap-3 align-items-center">
                            <div class="p-3 bg-warning rounded-3">
                                <i class="bi {{ $card['icon'] }}"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold mb-0">{{ $card['count'] }}</h4>
                                <div>Total Data {{ $card['label'] }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
