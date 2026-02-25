<!DOCTYPE html>
<html lang="en">
<head>
    {{-- ? variable titiel akan dikirim dari Controller --}}
    <title>{{ $title ?? 'SINVESTA'}}</title>

    {{-- ? meta tag --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1", shrink-to-fit=no>
    <meta name='author' content='Chandra Maulana'>
    <meta name='description' content='Uji Kompetensi Keahlian - Pengembangan Perangkat Lunak'>

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

    {{-- ? memanggil CSS ICON BPPTSTRAP menggunakan CDN --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    {{-- ? menanggil CSS ICON FONTAWESOME --}}
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/fontawesome/css/all.min.css') }}">

    {{-- ? memanggil file CSS TEMA DASHBOARD --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    {{-- ? @yield ini berfungsi untuk menambahkan css dari file view lain jika dibutuhkan --}}
    @yield('css')
</head>
<body>
    <div class="min-wrapper">

        {{-- ? memanggil file yang berisi code HTML bagian header --}}
        @include('dashboard.layout.header')

        {{-- ? memanggil file yang berisi code HTML bagian sidebar --}}
        @include('dashboard.layout.sidebar')

        {{-- ? wadah untuk konten utama --}}
        <div class="page-wrapper">
            <div class="content">
                {{-- 
                ? @yield adalah perintah Blade yang berfungsi sebagai :
                * Tempat menampilkan isi dari halaman lain ke dalam layout utama
                * 'konten' adalah nama dari @yield()
                ! @yield('konten') akan menampilkan isi dari @section('konten')
                --}}

                @yield('konten')
            </div>
        </div>
    </div>

    {{-- ? JAVASCRIPT  AKAN DI PANGGIL DIBAGIAN PALING BAWAH SEBELUM PENUTUP --}}
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