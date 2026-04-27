<!DOCTYPE html>
<html lang="en">

<head>
    {{-- ? variable titiel akan dikirim dari Controller --}}
    <title>{{ $title ?? 'SINVESTA - Sistem Inventaris Sekolah' }}</title>

    {{-- ? meta tag --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name='author' content='Chandra Maulana'>
    <meta name='description'
        content='Demo Sistem Inventaris Sarana dan Prasarana Sekolah (SINVESTA) - Uji Kompetensi Keahlian - Pengembangan Perangkat Lunak'>

    {{-- ? memanggil icon website (logo sekolah) --}}
    <link rel="shortcut icon" href="{{ asset('assets/icon/favicon.png') }}">

    {{-- ? memanggil file CSS BOOTSTRAP --}}
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    {{-- ? memanggil CSS SELECT2 --}}
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/select2/css/select2.min.css') }}">

    {{-- ? memanggil CSS ANIMATE --}}
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">

    {{-- ? memanggil CSS DATA TABLES --}}
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}">

    {{-- ? memanggil CSS ICON BOOTSTRAP menggunakan CDN --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    {{-- ? menanggil CSS ICON FONTAWESOME --}}
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/fontawesome/css/all.min.css') }}">

    {{-- ? memanggil file CSS TEMA DASHBOARD --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    {{-- ? @yield ini berfungsi untuk menambahkan css dari file view lain jika dibutuhkan --}}
    @yield('css')
    <style>
        /* Additional custom styles for the guest page to enhance the "demo" feel */
        .guest-stat-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            border-radius: 1rem;
            background: var(--card-bg);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .guest-stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.1);
        }

        .stat-icon {
            font-size: 2.5rem;
            opacity: 0.8;
        }

        .feature-card {
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: 0.75rem;
            transition: all 0.3s ease;
            height: 100%;
        }

        .feature-card:hover {
            border-color: var(--primary);
            transform: translateY(-5px);
        }

        .badge-condition {
            padding: 0.35rem 0.65rem;
            border-radius: 50px;
            font-weight: 500;
            font-size: 0.75rem;
        }

        .badge-status-available {
            background-color: rgba(46, 204, 113, 0.15);
            color: #2ecc71;
        }

        .badge-status-borrowed {
            background-color: rgba(241, 196, 15, 0.15);
            color: #f1c40f;
        }

        .badge-status-maintenance {
            background-color: rgba(231, 76, 60, 0.15);
            color: #e74c3c;
        }

        .hero-section {
            background: linear-gradient(135deg, var(--bg-secondary) 0%, var(--card-bg) 100%);
            border-radius: 1.5rem;
            border: 1px solid var(--border-color);
        }

        .btn-demo {
            background: var(--primary);
            color: #fff;
            border: none;
            padding: 10px 25px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-demo:hover {
            background: var(--accent-blue);
            transform: scale(1.02);
            color: #fff;
        }

        .table-guest thead th {
            background-color: var(--table-header-bg);
            color: var(--text-primary);
            font-weight: 600;
            border-bottom: 2px solid var(--border-color);
        }

        .table-guest tbody tr {
            transition: background 0.2s ease;
        }

        .table-guest tbody tr:hover {
            background-color: var(--table-row-hover);
        }

        @media (max-width: 768px) {
            .guest-stat-card .stat-icon {
                font-size: 1.8rem;
            }
        }
    </style>
</head>

<body>

    <div class="header"
        style="position: sticky; top: 0; background: var(--header-bg); border-bottom: 1px solid var(--border-color); z-index: 1000; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
        <div class="header-left">
            {{-- Logo Dashboard --}}
            <a href="{{ url('/') }}" class="logo">
                <img src="{{ asset('assets/icon/SMKM2KNG.png') }}" alt="Sinvesta">
            </a>

            {{-- Logo Dashboard saat sidebar disembunyikan --}}
            <a href="{{ url('/') }}" class="logo-small">
                <img src="{{ asset('assets/icon/favicon.png') }}" alt="Sinvesta">
            </a>
        </div>

        {{-- menu bagian kanan untuk guest --}}
        <ul class="nav user-menu">
            {{-- Tombol toggle mode --}}
            <li class="nav-item">
                <button id="theme-toggle" class="theme-toggle">
                    <span class="light-icon"><i class="bi bi-moon-fill"></i></span>
                    <span class="dark-icon"><i class="bi bi-sun-fill"></i></span>
                    <span class="mode-text">Mode</span>
                </button>
            </li>

            <li class="nav-item">
                <button class="theme-toggle d-flex align-items-center">
                    <a href="{{ route('login') }}">
                        <i class="bi bi-box-arrow-in-right me-1"></i>
                        <span>Login</span>
                    </a>
                </button>
            </li>

        </ul>

        {{-- menu profil khusus untuk di mobile --}}
        <!-- HAMBURGER MOBILE -->
        <div class="dropdown mobile-user-menu d-md-none">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <i class="bi bi-list fs-4"></i>
            </a>

            <div class="dropdown-menu dropdown-menu-end p-2">

                <!-- Mode -->
                <button id="theme-toggle-mobile" class="theme-toggle w-100 mb-2">
                    <span class="light-icon"><i class="bi bi-moon-fill"></i></span>
                    <span class="dark-icon"><i class="bi bi-sun-fill"></i></span>
                    <span class="mode-text">Mode</span>
                </button>

                <!-- Beranda -->
                <a href="{{ route('login') }}" class="dropdown-item">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Login
                </a>

            </div>
        </div>
    </div>


    <div class="page-wrapper {{ !Auth::check() ? 'm-0 p-0' : '' }}">
        <div class="container py-4">

            {{-- Hero Section --}}
            <div class="row mb-5">
                <div class="col-12">
                    <div class="hero-section p-4 p-lg-5 text-center">
                        <h1 class="display-4 fw-bold mb-3" style="color: var(--primary);">
                            <i class="bi bi-box-seam me-2"></i>SINVESTA
                        </h1>
                        <p class="lead mb-4 text-muted">Sistem Inventaris Berita Acara</p>

                        <div class="d-flex flex-wrap gap-3 justify-content-center">
                            <a href="{{ route('daftar.index') }}" class="btn btn-demo">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Daftar
                            </a>
                            <a href="{{ route('login') }}" class="btn btn-demo">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Login
                            </a>

                        </div>
                    </div>
                </div>
            </div>

            {{-- Fitur Unggulan --}}
            <div class="row mb-5">
                <div class="col-12 mb-4 text-center">
                    <h2 class="fw-bold">Fitur Unggulan <span style="color: var(--primary);">SINVESTA</span></h2>
                    <p class="text-muted">Kelola inventaris sekolah dengan lebih mudah dan terstruktur</p>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-card p-4 text-center">
                        <i class="bi bi-qr-code-scan mb-3" style="font-size: 2rem; color: var(--primary);"></i>
                        <h5 class="fw-bold">Scan Barcode</h5>
                        <p class="small text-muted">Cepat dan akurat dalam proses pencatatan keluar masuk barang.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-card p-4 text-center">
                        <i class="bi bi-graph-up mb-3" style="font-size: 2rem; color: var(--primary);"></i>
                        <h5 class="fw-bold">Laporan Real-time</h5>
                        <p class="small text-muted">Pantau kondisi aset dengan grafik dan laporan yang informatif.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-card p-4 text-center">
                        <i class="bi bi-shield-lock mb-3" style="font-size: 2rem; color: var(--primary);"></i>
                        <h5 class="fw-bold">Manajemen Role</h5>
                        <p class="small text-muted">Pengaturan hak akses untuk admin, petugas, dan peminjam.</p>
                    </div>
                </div>
            </div>

            {{-- Daftar Barang Terbaru --}}
            <div class="row">
                <div class="col-12">
                    <div class="card card-guest shadow-sm border-0">
                        <div class="card-header bg-transparent border-0 py-3">
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <h5 class="card-title mb-0 fw-bold">
                                    <i class="bi bi-list-stars me-2 text-warning"></i>Daftar Barang Terbaru
                                </h5>
                                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">Demo
                                    Data</span>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-guest align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kode</th>
                                            <th>Nama Barang</th>
                                            <th>Kategori</th>
                                            <th>Kondisi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td><span>LAB-001</span>
                                            </td>
                                            <td class="fw-semibold">PC All-in-One Core i5</td>
                                            <td>Komputer</td>
                                            <td><span class="btn btn-sm text-white bg-success">Baik</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td><span>PRJ-045</span>
                                            </td>
                                            <td class="fw-semibold">Proyektor Epson EB-X41</td>
                                            <td>Elektronik</td>
                                            <td><span class="btn btn-sm text-white bg-warning">Kurang
                                                    Baik</span></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td><span>MES-032</span>
                                            </td>
                                            <td class="fw-semibold">Meja Siswa 2 Dudukan</td>
                                            <td>Furniture</td>
                                            <td><span class="btn btn-sm text-white bg-success">Baik</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td><span>LAB-022</span>
                                            </td>
                                            <td class="fw-semibold">Monitor LED 21 Inch</td>
                                            <td>Komputer</td>
                                            <td><span class="btn btn-sm text-white bg-success">Baik</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td><span>SPK-011</span>
                                            </td>
                                            <td class="fw-semibold">Speaker Aktif 15 Watt</td>
                                            <td>Elektronik</td>
                                            <td><span class="btn btn-sm text-white bg-danger">Rusak</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-0 text-center py-3">
                            <small class="text-muted">*Data di atas merupakan contoh.</small>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Call to Action --}}
            <div class="row mt-5">
                <div class="col-12 text-center">
                    <div class="p-4 rounded-3"
                        style="background: var(--bg-secondary); border: 1px solid var(--border-color);">
                        <h4 class="fw-bold">Siap Mengelola Inventaris Sekolah?</h4>
                        <p class="text-muted mb-3">Masuk ke sistem untuk akses penuh fitur manajemen aset dan
                            pelaporan.</p>
                        <a href="{{ route('login') }}" class="btn btn-demo px-4 py-2 fw-semibold">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Masuk ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ? JAVASCRIPT AKAN DI PANGGIL DIBAGIAN PALING BAWAH SEBELUM PENUTUP --}}
    {{-- ? JAVASCRIPT JQUERY 3.6.0 --}}
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>

    {{-- ? JAVASCRIPT FEATHER --}}
    <script src="{{ asset('assets/js/feather.min.js') }}"></script>

    {{-- ? JAVASCRIPT SLIM SCROLL --}}
    <script src="{{ asset('assets/js/jquery.slimscroll.min.js') }}"></script>

    {{-- ? JAVASCRIPT SELECT2 --}}
    <script src="{{ asset('assets/css/vendor/select2/js/select2.min.js') }}"></script>

    {{-- ? JAVASCRIPT DATA TABLES --}}
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>

    {{-- ? JAVASCRIPT BOOTSTRAP --}}
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    {{-- ? JAVASCRIPT TEMA DASHBOARD --}}
    <script src="{{ asset('assets/js/script.js') }}"></script>

    {{-- ? @yield() ini berfungsi untuk menambahkan javascript dari file view lain jika dibutuhkan --}}
    @yield('js')
</body>

</html>
