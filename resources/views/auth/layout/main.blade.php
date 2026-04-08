<!DOCTYPE html>
<html lang="en">

<head>
    {{-- ? variable title akan dikirim dari Controller --}}
    <title>{{ $title ?? 'SINVESTA' }}</title>

    {{-- Meta Tags --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1", shrink-to-fit=no>
    <meta name='author' content='Chandra Maulana'>
    <meta name='description' content='Uji Kompetensi Keahlian - Pengembangan Perangkat Lunak'>

    {{-- ? memanggil icon website (logo sekolah) --}}
    <link rel="shortcut icon" href="{{ asset('assets/icon/favicon.png') }}">

    {{-- ? memanggil file CSS BOOTSTRAP --}}
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    {{-- ? memanggil CSS ICPN BPPTSTRAP menggunakan CDN --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    {{-- ? memanggil file CSS TEMA DASHBOARD --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

</head>

<body>
    <main>

        <div class="header"
            style="position: sticky; top: 0; background: var(--header-bg); border-bottom: 1px solid var(--border-color); z-index: 1000;">

            <div class="header-left">
                <a href="{{ url('/') }}" class="logo">
                    <img src="{{ asset('assets/icon/SMKM2KNG.png') }}" alt="Sinvesta">
                </a>
            </div>

            <!-- MENU DESKTOP -->
            <ul class="nav user-menu align-items-center">

                <!-- Mode -->
                <li class="nav-item">
                    <button id="theme-toggle" class="theme-toggle d-flex align-items-center">
                        <span class="light-icon"><i class="bi bi-moon-fill"></i></span>
                        <span class="dark-icon"><i class="bi bi-sun-fill"></i></span>
                        <span class="mode-text ms-1">Mode</span>
                    </button>
                </li>

                <li class="nav-item">
                    <button class="theme-toggle d-flex align-items-center">
                        <a href="{{ url('/') }}">
                            <i class="bi bi-house-door me-1"></i>
                            <span>Beranda</span>
                        </a>
                    </button>
                </li>

            </ul>

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
                    <a href="{{ url('/') }}" class="dropdown-item">
                        <i class="bi bi-house-door me-2"></i>Beranda
                    </a>

                </div>
            </div>

        </div>

        <section class="p-0 d-flex align-items-center position-relative overflow-hidden">
            <div class="container-fluid">
                <div class="row">
                    {{-- 
                    ? @yield adalah perintah Blade yang berfungsi sebagai:
                    * Tempat menampilkan isi dari halaman lain ke dalam layout utama 
                    * 'konten' adalah nama dari @yield
                    ! @yied hanya digunakan di file layout
                    --}}
                    @yield('konten')
                </div>
            </div>
        </section>
    </main>

    {{-- ? javascript akan di panggil dibagian paling bawah sebelum penutup body --}}
    {{-- ? javascript feather --}}
    <script src="{{ asset('assets/js/feather.min.js') }}"></script>

    {{-- ? javascript jquery 3.6.0 --}}
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>

    {{-- ? javascript bootstrap --}}
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    {{-- ? javasccript tema dashboard --}}
    <script src="{{ asset('assets/js/script.js') }}"></script>


</body>

</html>
