@extends('dashboard.layout.main')

@section('konten')
    <div class="page-header">
        <div class="page-titile">
            <h4>{{ $title }}</h4>
            <h6>Buat Berita Acara Baru</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">

            <form action="{{ route('bast.store') }}" method="POST">

                @csrf
                <div class="row">
                    @php
                        $cards = [
                            [
                                'class' => 'col-lg-8 col-12',
                                'id' => 'barang_id',
                                'items' => $barangs,
                                'label' => 'Barang',
                                'nama' => 'nama_barang',
                            ],
                            [
                                'class' => 'col-lg-6 col-sm-6 col-12',
                                'id' => 'user_serah_id',
                                'items' => $users,
                                'label' => 'Penyerah',
                                'nama' => 'nama_lengkap',

                                'name' => 'Serah',
                                'value' => 'Menunggu',
                                'nama1' => 'Menunggu',
                                'nama2' => 'Disetujui',

                                'for' => 'status_serah',
                                'idM' => 'status_menunggu1',
                                'idD' => 'status_disetujui1',
                            ],
                            [
                                'class' => 'col-lg-6 col-sm-6 col-12',
                                'id' => 'user_terima_id',
                                'items' => $users,
                                'label' => 'Penerima',
                                'nama' => 'nama_lengkap',

                                'name' => 'Terima',
                                'value' => 'Disetujui',
                                'nama1' => 'Menunggu',
                                'nama2' => 'Disetujui',
                                'for' => 'status_terima',
                                'idM' => 'status_menunggu2',
                                'idD' => 'status_disetujui2',
                            ],
                        ];
                    @endphp

                    @foreach ($cards as $card)
                        @if ($card['label'] == 'Barang')
                            <div class="{{ $card['class'] }}">
                                <div class="form-group">
                                    <label for="{{ $card['id'] }}">{{ $card['label'] }} Inventaris *</label>
                                    <select
                                        class="form-control placeholder select2 @error($card['id']) is-invalid @enderror"
                                        name="{{ $card['id'] }}" id="{{ $card['id'] }}">
                                        <option>Pilih {{ $card['label'] }}</option>
                                        @forelse ($card['items'] as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old($card['id']) == $item->id ? 'selected' : '' }}>
                                                {{ $item->{$card['nama']} }}
                                            </option>
                                        @empty
                                            <option>Data {{ $card['label'] }} Tidak Ditemukan!</option>
                                        @endforelse
                                    </select>
                                    @error($card['id'])
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        @else
                            <div class="{{ $card['class'] }}">
                                <div class="form-group">
                                    <label for="{{ $card['id'] }}">{{ $card['label'] }} Inventaris *</label>
                                    <select
                                        class="form-control placeholder select2 @error($card['id']) is-invalid @enderror"
                                        name="{{ $card['id'] }}" id="{{ $card['id'] }}">
                                        <option>Pilih {{ $card['label'] }}</option>
                                        @forelse ($card['items'] as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old($card['id']) == $item->id ? 'selected' : '' }}>
                                                {{ $item->{$card['nama']} }}
                                            </option>
                                        @empty
                                            <option>Data {{ $card['label'] }} Tidak Ditemukan!</option>
                                        @endforelse
                                    </select>
                                    @error($card['id'])
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="{{ $card['class'] }}">
                                <div class="form-group">
                                    <label for="{{ $card['for'] }}">Status {{ $card['name'] }}: *</label>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="{{ $card['for'] }}"
                                            id="{{ $card['idM'] }}" value="{{ $card['value'] }}"
                                            {{ old($card['for']) == $card['value'] ? 'checked' : '' }}>
                                        <label for="{{ $card['idM'] }}">
                                            <span class="btn btn-secondary">{{ $card['nama1'] }}</span>
                                        </label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="{{ $card['for'] }}"
                                            id="{{ $card['idD'] }}" value="{{ $card['value'] }}"
                                            {{ old($card['for']) == $card['value'] ? 'checked' : '' }}>
                                        <label for="{{ $card['idD'] }}">
                                            <span class="btn btn-success">{{ $card['nama2'] }}</span>
                                        </label>
                                    </div>

                                    @error($card['for'])
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                            </div>
                        @endif
                    @endforeach

                    {{-- tombol simpan --}}
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
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: 'Cari Barang...',
                allowClear: true,
                width: '100%'
            });
        });
    </script>
@endsection
