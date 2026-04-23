@extends('dashboard.layout.main')

@section('konten')
    <div class="page-header">
        <div class="page-titile">
            <h4>{{ $title }}</h4>
            <h6>Buat Berita Acara Baru</h6>
        </div>
         <div class="page-btn">
            <a href="{{ route('bast.index') }}" class="btn btn-added">
                <i class="bi bi-arrow-left-square"></i>
            </a>
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
                                'class' => 'col-lg-12 col-12',
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
                                'for' => 'status_serah',
                                'idM' => 'status_menunggu1',
                                'idD' => 'status_disetujui1',
                                'idC' => 'status_dibatalkan1',
                                'options' => [
                                    ['label' => 'Menunggu', 'value' => 'Menunggu', 'class' => 'btn-secondary'],
                                    ['label' => 'Disetujui', 'value' => 'Disetujui', 'class' => 'btn-success'],
                                ],
                            ],
                            [
                                'class' => 'col-lg-6 col-sm-6 col-12',
                                'id' => 'user_terima_id',
                                'items' => $users,
                                'label' => 'Penerima',
                                'nama' => 'nama_lengkap',
                                'name' => 'Terima',
                                'for' => 'status_terima',
                                'idM' => 'status_menunggu2',
                                'idD' => 'status_disetujui2',
                                'idC' => 'status_dibatalkan2',
                                'options' => [
                                    ['label' => 'Menunggu', 'value' => 'Menunggu', 'class' => 'btn-secondary'],
                                    ['label' => 'Disetujui', 'value' => 'Disetujui', 'class' => 'btn-success'],
                                ],
                            ],
                        ];
                    @endphp

                    @foreach ($cards as $card)
                        @if ($card['label'] == 'Barang')
                            {{-- Input Select Barang --}}
                            <div class="{{ $card['class'] }}">
                                <div class="form-group">
                                    <label for="{{ $card['id'] }}">{{ $card['label'] }} Inventaris *</label>
                                    <select class="form-control select2 @error($card['id']) is-invalid @enderror"
                                        name="{{ $card['id'] }}" id="{{ $card['id'] }}">
                                        <option value="">Pilih {{ $card['label'] }}</option>
                                        @foreach ($card['items'] as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old($card['id']) == $item->id ? 'selected' : '' }}>
                                                {{ $item->{$card['nama']} }} -
                                                {{ $item->kode_barang }} - 
                                                {{ $item->kategori->kode_kategori ?? 'Tanpa Kategori'}} -
                                                {{ $item->lokasi->kode_lokasi ?? 'Lokasi Tidak Set'}} 
                                            </option>
                                        @endforeach
                                    </select>
                                    @error($card['id'])
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        @else
                            {{-- Input Select User --}}
                            <div class="{{ $card['class'] }}">
                                <div class="form-group">
                                    <label for="{{ $card['id'] }}">{{ $card['label'] }} *</label>
                                    <select class="form-control select2 @error($card['id']) is-invalid @enderror"
                                        name="{{ $card['id'] }}" id="{{ $card['id'] }}">
                                        <option value="">Pilih {{ $card['label'] }}</option>
                                        @foreach ($card['items'] as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old($card['id']) == $item->id ? 'selected' : '' }}>
                                                {{ $item->{$card['nama']} }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error($card['id'])
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Input Radio Status --}}
                            <div class="{{ $card['class'] }}">
                                <div class="form-group">
                                    <label>Status {{ $card['name'] }}: *</label>
                                    <br>
                                    @foreach ($card['options'] as $index => $opt)
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="{{ $card['for'] }}"
                                                id="{{ $card['for'] . $index }}" value="{{ $opt['value'] }}"
                                                {{ old($card['for']) == $opt['value'] ? 'checked' : ($loop->first ? 'checked' : '') }}>
                                            <label class="form-check-label" for="{{ $card['for'] . $index }}">
                                                <span class="btn {{ $opt['class'] }} btn-sm">{{ $opt['label'] }}</span>
                                            </label>
                                        </div>
                                    @endforeach

                                    @error($card['for'])
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        @endif
                    @endforeach

                    <div class="col-lg-12">
                        <button class="btn btn-submit me-2" type="submit">Simpan</button>
                        <a href="{{ route('bast.index') }}" class="btn btn-cancel">Batal</a>

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
                placeholder: 'Pilih...',
                allowClear: true,
                width: '100%'
            });
        });
    </script>
@endsection
