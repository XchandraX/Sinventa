{{-- ? panggil file main.blade.php yang ada difolder dashboard/layout --}}
@extends('dashboard.layout.main')

{{-- ? tulis kode html untuk halaman index user diantara @section --}}
@section('konten')
    {{-- ! konten utama halaman dashboard ditulis disini --}}
    <div class="page-header">
        {{-- judul halaman --}}
        <div class="page-title">
            <h4>{{ $title }} </h4>
            <h6>Buat Data Barang Baru</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">

            {{-- form tambah barang baru --}}
            <form action="{{ route('barang.store') }}" method="POST">

                {{-- csrf untuk keamanan form --}}
                @csrf

                <div class="row">
                    @php
                        $cards = [
                            ['label' => 'Nama Barang', 'id' => 'nama_barang', 'class' => 'col-12'],
                            ['label' => 'Kode Barang', 'id' => 'kode_barang', 'class' => 'col-lg-6 col-sm-6 col-12'],
                        ];
                        
                        $cardsKL = [
                            ['id' => 'kategori_id', 'items' => $kategoris, 'nama' => 'nama_kategori', 'label' => 'Kategori'],
                            ['id' => 'lokasi_id', 'items' => $lokasis, 'nama' => 'nama_lokasi', 'label' => 'Lokasi'],
                        ];

                        $cardsSt = [
                            ['id' => 'status_baik', 'label' => 'Baik'],
                            ['id' => 'status_rusak_ringan', 'label' => 'Rusak Ringan'],
                            ['id' => 'status_rusak_besar', 'label' => 'Rusak Besar'],
                            ['id' => 'status_hilang', 'label' => 'Hilang'],
                        ];
                    @endphp

                    {{-- kolom nama barang --}}
                    @foreach ( $cards as $card )
                    <div class="{{ $card['class'] }}">
                        <div class="form-group">
                            <label for="{{ $card['id'] }}">{{ $card['label'] }} *</label>
                            <input 
                            type="text"
                            class="form-control @error($card['id']) is-invalid @enderror"
                            id="{{ $card['id'] }}"
                            name="{{ $card['id'] }}"
                            value="{{ old($card['id']) }}"
                            >

                            {{-- jika tidak valid --}}
                            @error($card['id'])

                                {{-- tampilan pesan error --}}
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    @endforeach

                    {{-- kolom kategori / lokasi barang --}}
                    @foreach ($cardsKL as $card)
                        
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="{{ $card['id'] }}">{{ $card['label'] }} *</label>
                                <select 
                                class="select2 placeholder form-control @error($card['id']) is-invalid @enderror"
                                id="{{ $card['id'] }}"
                                name="{{ $card['id'] }}">
                                <option>Pilih {{ $card['label']}}</option>
                                {{-- ? tamplkan semua kategori/lokasi satu persatu menggunakan perulangan --}}
                                @forelse ($card['items'] as $item)
                                    <option value="{{ $item->id }}" {{ old($card['id']) == $item->id ? 'selected' : '' }}>
                                        {{ $item->{$card['nama']} }}
                                    </option>
                                    {{-- ? jika data kategori tidak ada didatabase --}}
                                @empty
                                    {{-- tampilkal informasi --}}
                                    <option disabled>Data {{$card['label']}} Tidak Ditemukan</option>
                                @endforelse
                            </select>

                            {{-- jika kategori yang dipilih tidak valid --}}
                            @error($card['id'])
                                <div class="invalid-feedback">{{ $message}}</div>
                            @enderror
                            </div>
                        </div>
                    @endforeach

                    {{-- kolom status barang --}}
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="status">Status Barang: *</label>
                            @foreach ($cardsSt as $card)
                                <div class="form-check form-check-inline">
                                    <input 
                                    type="radio"
                                    class="form-check-input"
                                    name="status_barang"
                                    id="{{ $card['id'] }}"
                                    value="{{ $card['label'] }}"
                                    {{ old('status_barang') == $card['label'] ? 'checked' : '' }}
                                    >
                                    <label 
                                    for="{{ $card['id'] }}" class="form-check-label"> {{ $card['label'] }}</label>
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
                            <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi') }}</textarea>

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

@section('js')
<script>
    $(document).ready(function () {
        $('.select2').select2({
            placeholder: "Cari barang...",
            allowClear: true,
            width: '100%'
        });
    });
</script>
@endsection