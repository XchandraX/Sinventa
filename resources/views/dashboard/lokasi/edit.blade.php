{{-- ? panggil file layout.blade.php yg ada difolder dashboard/layout --}}
@extends('dashboard.layout.main')

{{-- ? tulis kode html untuk halaman create user diantara @section --}}
@section('konten')
    {{-- ! konten utama halaman dashboard ditulis disini --}}
    {{-- judul halaman --}}
    <div class="page-header">
        <div class="page-title">
            <h4>{{ $title }} </h4>
            <h6>Edit dan Update Lokasi Barang Baru</h6>
        </div>
    </div>

    {{-- card form tambah data --}}
    <div class="card">
        <div class="card-body">

            {{-- form tambah data lokasi --}}
            <form action="{{ route('lokasi.update', $lokasi) }}" method="POST">


                {{-- blade csrf --}}
                @csrf

                {{-- ganti method dari post -> put  --}}
                @method('put')

                <div class="row">
                    @php
                        $cards = [
                            ['id' => 'kode_lokasi', 'label' => 'Kode Lokasi'],
                            ['id' => 'nama_lokasi', 'label' => 'Nama Lokasi']
                            ]
                    @endphp

                    @foreach ($cards as $card)
                        
                    {{-- kolom kode dan nama lokasi --}}
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="{{ $card['id'] }}">{{ $card['label'] }} *</label>
                            <input type="text" class="form-control  @error($card['id']) is-invalid @enderror" id="{{ $card['id'] }}" name="{{ $card['id'] }}"
                                value="{{ old($card['id'], $lokasi->{$card['id']} ?? '') }}" placeholder="Masukkan {{ $card['label'] }}">

                            {{-- jika kode_lokasi tidak valid --}}
                            @error($card['id'])
                                {{-- tampilkan pesan error --}}
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    @endforeach


                    {{-- kolom deskripsi --}}
                    <div class="col-12">
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control  @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi"
                                 placeholder="Masukkan deskripsi pengguna">{{ old('deskripsi', $lokasi->deskripsi) }}</textarea>

                            {{-- jika deskripsi tidak valid --}}
                            @error('deskripsi')
                                {{-- tampilkan pesan error --}}
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- tombol simpan user --}}
                    <div class="col-12">
                        <button type="submit" class="btn btn-submit me-2">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
