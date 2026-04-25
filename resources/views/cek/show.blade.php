{{-- resources/views/public/barang/show.blade.php --}}
<!DOCTYPE html>
<html lang="id" data-theme="dark">

<head>
    <title>{{ $title }} - {{ $barang->nama_barang }}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Chandra Maulana">
    <meta name="description"
        content="Demo Sistem Inventaris Sarana dan Prasarana Sekolah (SINVESTA) - Uji Kompetensi Keahlian - Pengembangan Perangkat Lunak">

    <link rel="shortcut icon" href="{{ asset('assets/icon/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <style>
        /* Variabel tambahan untuk halaman detail */
        .detail-card {
            max-width: 800px;
            margin: 40px auto;
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            overflow: hidden;
            animation: fadeInUp 0.5s ease-out;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .detail-header {
            background: linear-gradient(135deg, var(--primary) 0%, #059669 100%);
            color: white;
            padding: 28px 24px;
            text-align: center;
        }

        .detail-header h1 {
            font-size: 24px;
            margin-bottom: 8px;
            font-weight: 700;
        }

        .detail-header p {
            opacity: 0.9;
            font-size: 13px;
            margin-bottom: 0;
        }

        .detail-body {
            padding: 28px 32px;
        }

        .info-row {
            margin-bottom: 24px;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 16px;
        }

        .info-row:last-of-type {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .info-label {
            font-size: 11px;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 6px;
            font-weight: 600;
        }

        .info-value {
            font-size: 18px;
            color: var(--text-primary);
            font-weight: 600;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 18px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 700;
            text-align: center;
        }

        .status-baik {
            background: #d4edda;
            color: #155724;
        }

        .status-ringan {
            background: #fff3cd;
            color: #856404;
        }

        .status-berat {
            background: #f8d7da;
            color: #721c24;
        }

        .status-hilang {
            background: #e2e3e5;
            color: #383d41;
        }

        [data-theme="dark"] .status-baik {
            background: #1a3a2a;
            color: #6fcf97;
        }

        [data-theme="dark"] .status-ringan {
            background: #3a2a1a;
            color: #f9ca7f;
        }

        [data-theme="dark"] .status-berat {
            background: #3a1a1a;
            color: #e74c3c;
        }

        [data-theme="dark"] .status-hilang {
            background: #2a2a2a;
            color: #bdc3c7;
        }

        .deskripsi-box {
            background: var(--bg-dark);
            padding: 16px 20px;
            border-radius: 12px;
            margin-top: 8px;
            border-left: 3px solid var(--primary);
        }

        .qr-section {
            text-align: center;
            margin-top: 32px;
            padding-top: 24px;
            border-top: 2px dashed var(--border-color);
        }

        .qr-title {
            font-size: 13px;
            font-weight: 500;
            color: var(--text-muted);
            margin-bottom: 16px;
        }

        .detail-footer {
            text-align: center;
            padding: 20px 24px;
            background: var(--bg-dark);
            border-top: 1px solid var(--border-color);
        }

        .btn-print-custom {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 4px;
            padding: 10px 24px;
            background: var(--primary);
            color: white;
            text-decoration: none;
            border-radius: 30px;
            transition: all 0.25s ease;
            border: none;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
        }

        .btn-print-custom:hover {
            background: var(--accent-blue);
            transform: translateY(-2px);
            color: white;
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }

            .btn-print-custom {
                display: none;
            }

            .detail-card {
                box-shadow: none;
                margin: 0;
                border: none;
            }

            .detail-header {
                background: #667eea;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .qr-section {
                display: none;
            }
        }

        /* debug url kecil */
        .debug-url {
            font-size: 10px;
            color: var(--text-muted);
            word-break: break-all;
            margin-top: 10px;
            font-family: monospace;
        }
    </style>
</head>

<body class="bg-dark">
    <div class="container" style="max-width: 800px;">
        <div class="detail-card">
            <div class="detail-header">
                <h1>📦 Informasi Barang Inventaris</h1>
                <p>Data resmi dari sistem inventaris</p>
            </div>

            <div class="detail-body">
                <div class="info-row">
                    <div class="info-label">Kode Barang</div>
                    <div class="info-value">{{ $barang->kode_barang }}</div>
                </div>

                <div class="info-row">
                    <div class="info-label">Nama Barang</div>
                    <div class="info-value">{{ $barang->nama_barang }}</div>
                </div>

                <div class="info-row">
                    <div class="info-label">Kategori</div>
                    <div class="info-value">{{ $barang->kategori->nama_kategori ?? '-' }}</div>
                </div>

                <div class="info-row">
                    <div class="info-label">Lokasi</div>
                    <div class="info-value">{{ $barang->lokasi->nama_lokasi ?? '-' }}</div>
                </div>

                <div class="info-row">
                    <div class="info-label">Status Barang</div>
                    <div class="info-value">
                        @php
                            $statusMap = [
                                'Baik' => ['class' => 'status-baik', 'icon' => '✅'],
                                'Rusak Ringan' => ['class' => 'status-ringan', 'icon' => '⚠️'],
                                'Rusak Berat' => ['class' => 'status-berat', 'icon' => '🔴'],
                            ];
                            $defaultStatus = ['class' => 'status-hilang', 'icon' => '❓'];
                            $status = $statusMap[$barang->status_barang] ?? $defaultStatus;
                        @endphp
                        <span class="status-badge {{ $status['class'] }}">
                            {{ $status['icon'] }} {{ $barang->status_barang }}
                        </span>
                    </div>
                </div>

                @if ($barang->deskripsi)
                    <div class="deskripsi-box">
                        <div class="info-label" style="margin-bottom: 8px;">📝 Deskripsi</div>
                        <div style="font-size: 14px; color: var(--text-secondary); line-height: 1.5;">
                            {{ $barang->deskripsi }}
                        </div>
                    </div>
                @endif

                <div class="qr-section">
                    <div class="qr-title">
                        🔍 Scan QR Code untuk melihat detail barang
                    </div>
                    @php
                        $qrUrl = route('barang.show', $barang->kode_barang);
                    @endphp
                    {!! QrCode::size(150)->generate($qrUrl) !!}

                    <div class="debug-url">
                        URL: {{ $qrUrl }}
                    </div>

                    <div style="font-size: 11px; color: var(--text-muted); margin-top: 12px;">
                        📅 Terakhir diperbarui: {{ $barang->updated_at->translatedFormat('d F Y H:i') }}
                    </div>
                </div>
            </div>

            <div class="detail-footer">
                <button onclick="window.print()" class="btn-print-custom">
                    🖨️ Cetak Halaman Ini
                </button>
                <div style="margin-top: 14px; font-size: 11px; color: var(--text-muted);">
                    Sistem Informasi Inventaris Barang &copy; {{ date('Y') }}
                </div>
            </div>
        </div>
    </div>

    <script>
        // Memastikan dark mode aktif sesuai default sistem dan halaman
        document.documentElement.setAttribute('data-theme', 'dark');
        if (localStorage) {
            localStorage.setItem('darkMode', 'true');
        }
    </script>
</body>

</html>