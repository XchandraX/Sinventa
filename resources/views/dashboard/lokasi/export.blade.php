{{-- ? Buat struktur HTML yang berbeda --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Data lokasi Barang' }}</title>

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

        .footer {
            margin-top: 30px;
            font-size: 11px;
        }

        .signature {
            margin-top: 50px;
            width: 100%;
        }

        .signature td {
            width: 50%;
            text-align: center;
        }
    </style>
</head>

{{-- ? Jika url = /dashboard/print-lokasi maka print halaman ini --}}
<body @if(Request::is('dashboard/print-lokasi')) onload='window.print()' @endif>
    {{-- HEADER --}}
    <div class="header">
        <h2>{{ $title ?? 'Daftar lokasi Barang' }}</h2>
        <p>Sistem Manajemen Inventaris</p>
    </div>

    {{-- Informasi --}}
    <div class="meta">
        <strong>Tanggal Cetak:</strong> {{ now()->format('d F Y ') }} <br>
        <strong>Jumlah Data:</strong> {{ $lokasis->count() }} Lokasi
    </div>

    {{-- tabel data --}}
    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="20%">Kode lokasi</th>
                <th width="25%">Nama lokasi</th>
                <th width="30%">Deskripsi</th>
                <th width="20%">Tanggall Dibuat</th>
            </tr>
        </thead>
        <tbody>
            {{-- jika data lokasi ada didatabase maka ditampilkan --}}
            @forelse ($lokasis as $lokasi)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $lokasi->kode_lokasi }}</td>
                    <td>{{ $lokasi->nama_lokasi }}</td>
                    <td>{{ $lokasi->deskripsi }}</td>
                    <td class="text-center">{{ $lokasi->created_at->format('d-m-Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">
                        Tidak ada data lokasi barang
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- footer --}}
    <div class="footer">
        <table class="signature">
            <tr>
                <td>
                    Mengetahui,<br>
                    <strong>Admin Inventaris</strong>
                    <br><br><br>
                    ( _____________________ )
                </td>
                <td>
                    Dicetak Oleh,<br>
                    {{ auth()->user()->nama_lengkap ?? 'Administrator' }}
                    <br><br><br>
                    ( _____________________ )
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
