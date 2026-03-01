{{-- ? panggil file main.blade.php yang ada difolder dashboard/layout --}}
@extends('dashboard.layout.main')

@section('konten')
    <div class="page-header">
        <div class="page-title">
            <h4>{{ $title }}</h4>
            <h6>Lihat atau cari berita acara serah terima</h6>
        </div>

        <div class="page-btn">
            <a href="{{ route('bast.create') }}" class="btn btn-added">
                <i class="bi bi-plus-circle"></i> Buat Berita Acara
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-top">

                <div class="search-set">
                    <div class="search-input">
                        <a class="btn btn-searchset"><i class="bi bi-search"></i></a>
                    </div>
                </div>

                <div class="wordset">
                    <ul>

                        <li>
                            <a href="">
                                <img src="{{ asset('assets/icon/pdf.svg') }}" alt="img">
                            </a>
                        </li>


                        <li>
                            <a href="">
                                <img src="{{ asset('assets/icon/excel.svg') }}" alt="img">
                            </a>
                        </li>


                        <li>
                            <a href="">
                                <img src="{{ asset('assets/icon/printer.svg') }}" alt="img">
                            </a>
                        </li>

                    </ul>
                </div>
            </div>

            <form action="{{ route('bast.index') }}" method="GET">

                <div class="row">

                    @php
                        $cards = [
                            [
                                'id' => 'kategori_id',
                                'name' => 'kategori',
                                'items' => $kategoris,
                                'label' => 'Kategori',
                                'nama' => 'nama_kategori',
                            ],
                            [
                                'id' => 'lokasi_id',
                                'name' => 'lokasi',
                                'items' => $lokasis,
                                'label' => 'Lokasi',
                                'nama' => 'nama_lokasi',
                            ],
                        ];
                    @endphp

                    {{-- kolom filter data berdasarkan kategori / lokasi --}}
                    @foreach ($cards as $card)
                        <div class="col-lg-3 col-6 mb-3">
                            <select class="select2 placeholder form-control" name="{{ $card['name'] }}"
                                id="{{ $card['id'] }}">
                                <option value="">Semua {{ $card['label'] }}</option>
                                @forelse ($card['items'] as $item)
                                    <option value="{{ $item->id }}"
                                        {{ request($card['name']) == $item->id ? 'selected' : '' }}>
                                        {{ $item->{$card['nama']} }}
                                    </option>
                                @empty
                                    <option>Data {{ $card['label'] }} Tidak Ditemukan!</option>
                                @endforelse
                            </select>
                        </div>
                    @endforeach

                    {{-- kolom filter data berdasarkan status barang --}}
                    <div class="col-lg-2 col-6 mb-3">
                        <select class="select2 placeholder form-control" name="status_barang" id="status_barang">
                            <option value="">Semua Status Barang</option>
                            <option value="Baik" {{ request('status_barang') == 'Baik' ? 'selected' : '' }}>Baik</option>
                            <option value="Rusak Ringan"
                                {{ request('status_barang') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                            <option value="Rusak Berat" {{ request('status_barang') == 'Rusak Berat' ? 'selected' : '' }}>
                                Rusak Berat</option>
                            <option value="Hilang" {{ request('status_barang') == 'Hilang' ? 'selected' : '' }}>Hilang
                            </option>
                        </select>
                    </div>

                    {{-- kolom filter data berdasar status bast --}}
                    <div class="col-lg-2 col-6 mb-3">
                        <select class="select2 placeholder form-control" name="status_bast" id="status_bast">
                            <option value="">Semua Status BAST</option>
                            <option value="Disetujui" {{ request('status_bast') == 'Disetujui' ? 'selected' : '' }}>
                                Disetujui</option>
                            <option value="Menunggu" {{ request('status_bast') == 'Menunggu' ? 'selected' : '' }}>Menunggu
                            </option>
                        </select>
                    </div>

                    {{-- tombol filter data --}}
                    <div class="col-lg-2 col-6 mb-3">
                        <button class="btn btn-warning" type="submit"><i class="bi bi-funnel"></i></button>

                        @if (request('kategori') || request('lokasi') || request('status_barang') || request('status_bast'))
                            <a href="{{ route('bast.index') }}" class="btn btn-danger">
                                <i class="bi bi-x-lg"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </form>

            {{-- jika data bast tidak ada --}}
            @if ($basts->isEmpty())
                {{-- tampilkan infomasi --}}
                <div class="alert alert-info" role="alert">
                    Tidak ada berita acara tersedia
                </div>
            @else
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
                                <th>Penyerah</th>
                                <th>Penerima</th>
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
                                            <span
                                                class="btn btn-sm text-white bg-success">Baik</span>
                                        @elseif ($bast->barang->status_barang == 'Rusak Ringan')
                                            <span
                                                class="btn btn-sm text-white bg-warning">Rusak Ringan</span>
                                        @elseif ($bast->barang->status_barang == 'Rusak Berat')
                                            <span
                                                class="btn btn-sm text-white bg-danger">Rusak Berat</span>
                                        @else
                                            <span
                                                class="btn btn-sm text-white bg-secondary">Hilang</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($bast->status_serah == 'Menunggu')
                                            <span class="btn btn-sm text-white bg-secondary"><i
                                                    class="bi bi-hourglass-split"></i></span>
                                        @else
                                            <span class="btn btn-sm text-white bg-success"><i
                                                    class="bi bi-check-circle"></i></span>
                                        @endif
                                        <span class="ms-2">{{ $bast->userSerah->nama_lengkap }}</span>
                                    </td>
                                    <td>
                                        @if ($bast->status_terima == 'Menunggu')
                                            <span class="btn btn-sm text-white bg-secondary"><i
                                                    class="bi bi-hourglass-split"></i></span>
                                        @else
                                            <span class="btn btn-sm text-white bg-success"><i
                                                    class="bi bi-check-circle"></i></span>
                                        @endif
                                        <span class="ms-2">{{ $bast->userTerima->nama_lengkap }}</span>
                                    </td>
                                    <td>
                                        @if ($bast->status_serah == 'Disetujui' && $bast->status_terima == 'Disetujui')
                                            <span class="btn btn-sm text-white bg-success"><i
                                                    class="bi bi-check-circle"></i></span> Disetujui
                                        @else
                                            <span class="btn btn-sm text-white bg-secondary"><i
                                                    class="bi bi-hourglass-split"></i></span> Menunggu
                                        @endif
                                    </td>
                                    <td>
                                        {{-- tombol download dokumen berita acara --}}
                                        <a href="#" class="me-3">
                                            <i class="bi bi-download"></i>
                                        </a>

                                        {{-- tombol lihat detail berita acara --}}
                                        <a href="{{ route('bast.show', $bast) }}" class="me-3">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        {{-- tombol edit berita acara --}}
                                        <a href="{{ route('bast.edit', $bast) }}" class="me-3">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        {{-- tombol hapus berita acara --}}
                                        <form action="{{ route('bast.destroy', $bast) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="confirm-text btn p-0 m-0" type="submit"
                                                onclick="return confirm('Yakin ingin menghapus berita acara ini?')">
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
