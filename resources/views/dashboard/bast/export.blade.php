{{-- ? Buat struktur HTML yang berbeda --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Data Kategori Barang' }}</title>

    {{-- ? buat styling css di sini --}}
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #000;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
            font-size: 16px;
            text-transform: uppercase;
        }

        .header p {
            margin: 4px 0 0;
            font-size: 11px;
        }

        .meta {
            margin-bottom: 15px;
            font-size: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table thead th {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
            background-color: #f2f2f2;
        }

        table tbody td {
            border: 1px solid #000;
            padding: 6px;
            vertical-align: top;
        }

        .text-center {
            text-align: center;
        }

        .qr {
            width: 60px;
            height: 60px;
        }

        .footer {
            margin-top: 30px;
            font-size: 11px;
        }
    </style>
</head>

{{-- ? Jika url = /dashboard/print-bast maka print halaman ini --}}

<body @if (Request::is('dashboard/print-bast')) onload='window.print()' @endif>
    {{-- HEADER --}}
    <div class="header">
        <h2>{{ $title ?? 'Daftar Berita Acara Serah Terima Barang' }}</h2>
        <p>Dicetak pada: {{ now()->format('d-m-Y') }}</p>
    </div>

    {{-- tabel data --}}
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Qr Code</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Lokasi</th>
                <th>Status Barang</th>
                <th>Penyerah</th>
                <th>Penerima</th>
                <th>Status BAST</th>
                <th>Tanggal Dibuat</th>
            </tr>
        </thead>
        <tbody>
            {{-- jika data kategori ada didatabase maka ditampilkan --}}
            @forelse ($basts as $bast)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="qr text-center">
                        <img src="data:image/svg+xml;base64,{{ $bast->qr_base64 }}" alt="qr" width="70"
                            height="70">
                    </td>
                    <td>{{ $bast->barang->nama_barang }}</td>
                    <td>{{ $bast->barang->kategori->nama_kategori }}</td>
                    <td>{{ $bast->barang->lokasi->nama_lokasi }}</td>
                    <td class="text-center">{{ $bast->barang->status_barang }}</td>

                    <td>{{ $bast->userSerah->nama_lengkap }}</td>
                    <td>{{ $bast->userTerima->nama_lengkap }}</td>
                    <td class="text-center">
                    @if ($bast->status_serah === 'Disetujui' && $bast->status_terima === 'Disetujui')
                        Disetujui
                    @else
                        Menunggu
                    @endif
                    </td>
                    <td class="text-center">
                        {{ $bast->created_at->format('d-m-Y') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center">
                        Tidak ada data Berita Acara Serah Terima
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- footer --}}
    <div class="footer">
        <p>
            Dokumen ini dihasilkan secara otomatis oleh sistem dan sah tanpa tanda tangan.
        </p>
    </div>
</body>

</html>
