{{-- ? panggil file main.blade.php yang ada difolder dashboard/layout --}}
@extends('dashboard.layout.main')

{{-- ? tulis kode html untuk halaman edit barang diantara @section --}}
@section('konten')
    {{-- ! koten utama halaman dashboard ditulis disini --}}

    <div class="page-header">
        {{-- judul halaman --}}
        <div class="page-title">
            <h4>{{ $title }}</h4>
            <h6>Perbarui Data Barang</h6>
        </div>
    </div>

    {{-- card form edit barang baru --}}
    <div class="card">
        <div class="card-body">

            {{-- form edit barang baru --}}
            <form action="{{ route('barang.update', $barang) }}" method="POST">

                {{-- csrf untuk keamanan form --}}
                @csrf
                {{-- ubah method menjadi update --}}
                @method('PUT')

                <div class="row">

                    {{-- ubah variable --}}
                    @php
                        $cards = [
                            ['class' => 'col-12', 'id' => 'nama_barang', 'label' => 'Nama Barang'],
                            ['class' => 'col-lg-6 col-sm-6 col-12', 'id' => 'kode_barang', 'label' => 'Kode Barang'],
                        ];

                        $cardsKL = [
                            [
                                'id' => 'kategori_id',
                                'label' => 'Kategori',
                                'nama' => 'nama_kategori',
                                'items' => $kategoris,
                            ],
                            ['id' => 'lokasi_id', 'label' => 'Lokasi', 'nama' => 'nama_lokasi', 'items' => $lokasis],
                        ];

                        $cardsSt = [
                            ['id' => 'status_baik', 'label' => 'Baik'],
                            ['id' => 'status_rusak_ringan', 'label' => 'Rusak Ringan'],
                            ['id' => 'status_rusak_berat', 'label' => 'Rusak Berat'],
                            ['id' => 'status_hilang', 'label' => 'Hilang'],
                        ];
                    @endphp

                    {{-- kolom nama dan kode barang --}}
                    @foreach ($cards as $card)
                        <div class="{{ $card['class'] }}">
                            <div class="form-group">
                                <label for="{{ $card['id'] }}">{{ $card['label'] }} *</label>
                                <input type="text" class="form-control @error($card['id']) is-invalid @enderror"
                                    id="{{ $card['id'] }}" name="{{ $card['id'] }}" value="{{ old($card['id'], data_get($barang, $card['id'])) }}">

                                @error($card['id'])
                                    {{-- tampilkan pesan error --}}
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    @endforeach

                    {{-- kolom kategori dan lokasi barang --}}
                    @foreach ($cardsKL as $card)
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="{{ $card['id'] }}">{{ $card['label'] }} *</label>
                                <select name="{{ $card['id'] }}" id="{{ $card['id'] }}"
                                    class="select2 placeholder form-control @error($card['id']) is-invalid @enderror)">
                                    <option> Pilih {{ $card['label'] }} *</option>
                                    {{-- ? tampilka semua kategori / lokasi satu persatu menggunakan perulangan --}}
                                    @forelse ($card['items'] as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old($card['id'], data_get($barang, $card['id'])) == $item->id ? 'selected' : '' }}>
                                            {{ $item->{$card['nama']} }}
                                        </option>
                                        {{-- ? jika data kategori / lokasi tidak ada didatabase --}}
                                    @empty
                                        {{-- tampilkan informasi --}}
                                        <option>Data {{ $card['label'] }} Tidak Ditemukan!</option>
                                    @endforelse
                                </select>

                                {{-- ? jika kategori / lokasi yang dipilih tidak valid --}}
                                @error($card['id'])
                                    {{-- tampilkan pesan error --}}
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    @endforeach

                    {{-- kolom/input status --}}
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="status">Status Barang: *</label>
                            @foreach ($cardsSt as $card)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status_barang"
                                        id="{{ $card['id'] }}" value="{{ $card['label'] }}"
                                        {{ old('status_barang', $barang->status_barang) == $card['label'] ? 'checked' : '' }}>
                                    <label for="{{ $card['id'] }}" class="form-check-label">{{ $card['label'] }}</label>
                                </div>
                            @endforeach
                            {{-- jika status barang yang dipilih tidak valid --}}
                            @error('status_barang')
                                {{-- tampilkan pesan error --}}
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    {{-- kolom deskripsi --}}
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $barang->deskripsi) }}</textarea>

                            {{-- jika kolom deskripsi tidak valid --}}
                            @error('deskripsi')
                                {{-- tampilkan pesan error --}}
                                <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <button class="btn btn-submit me-2" type="submit">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

{{-- ? javascript untuk library select2 --}}
@section('js')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Cara barang...",
                allowClear: true,
                width: '100%',
            });
        });
    </script>
@endsection
