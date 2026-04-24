<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak_{{ $barang->kode_barang }}</title>
    <style>
        body { font-family: sans-serif; padding: 20px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .info-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .info-table td { padding: 10px; border-bottom: 1px solid #ddd; }
        .label { font-weight: bold; width: 30%; }
        .qr-section { text-align: center; margin-top: 30px; }
        
        /* Trigger print otomatis saat halaman dibuka */
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="header">
        <h2>DETAIL INVENTARIS BARANG</h2>
        <p>Kode Barang: {{ $barang->kode_barang }}</p>
    </div>

    <table class="info-table">
        <tr>
            <td class="label">Nama Barang</td>
            <td>: {{ $barang->nama_barang }}</td>
        </tr>
        <tr>
            <td class="label">Kategori</td>
            <td>: {{ $barang->kategori->nama_kategori ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Lokasi</td>
            <td>: {{ $barang->lokasi->nama_lokasi ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Status</td>
            <td>: {{ $barang->status_barang }}</td>
        </tr>
        <tr>
            <td class="label">Deskripsi</td>
            <td>: {{ $barang->deskripsi ?? '-' }}</td>
        </tr>
    </table>

    <div class="qr-section">
        <p>QR Code Barang:</p>
        {!! QrCode::size(150)->generate(route('barang.show', $barang)) !!}
        <br>
        <small>{{ $barang->kode_barang }}</small>
    </div>

    <div class="no-print" style="margin-top: 20px; text-align: center;">
        <button onclick="window.print()" style="padding: 10px 20px;">Cetak Sekarang</button>
    </div>
</body>
</html>