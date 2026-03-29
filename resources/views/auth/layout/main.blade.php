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
            style="position: sticky; background: var(--header-bg); border-bottom: 1px solid var(--border-color);">
            <div class="header-left">
                {{-- Logo Dashboard --}}
                <a href="{{ url('/') }}" class="logo">
                    <img src="{{ asset('assets/icon/logo.png') }}" alt="Sinvesta">
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
            </ul>


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
