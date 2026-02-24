<!DOCTYPE html>
<html lang="en">

<head>
    {{-- ? variable title akan dikirim dari Controller --}}
    <title>{{ $title ?? 'SINVESTA' }}</title>

    {{-- Meta Tags --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

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
