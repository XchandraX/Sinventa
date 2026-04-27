<!DOCTYPE html>
<html lang="en">

<head>
    {{-- ? variable titiel akan dikirim dari Controller --}}
    <title>{{ $title ?? 'SINVESTA' }}</title>

    {{-- ? meta tag --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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

    {{-- ? SweetAlert2 CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">


    {{-- ? memanggil file CSS TEMA DASHBOARD --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    {{-- ? @yield ini berfungsi untuk menambahkan css dari file view lain jika dibutuhkan --}}
    @yield('css')
</head>

<body>
    <div class="main-wrapper">

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

    {{-- ? di dalam tag <head> atau sebelum @yield('js') --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- Script Global untuk Semua Halaman --}}
    <script>
        $(document).ready(function() {
            // ============================================
            // 1. SWEETALERT UNTUK SEMUA TOMBOL HAPUS
            // ============================================
            // Tombol dengan class 'btn-delete' atau form dengan class 'delete-form'
            $(document).on('click', '.btn-delete, .delete-btn', function(e) {
                e.preventDefault();

                let form = $(this).closest('form');
                let namaItem = $(this).data('nama') || 'item ini';
                let title = $(this).data('title') || 'Hapus Data?';
                let confirmText = $(this).data('confirm-text') || 'Ya, hapus!';
                let cancelText = $(this).data('cancel-text') || 'Batal';

                Swal.fire({
                    title: title,
                    html: `Apakah Anda yakin ingin menghapus <strong>${namaItem}</strong>?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: confirmText,
                    cancelButtonText: cancelText,
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Tampilkan loading
                        Swal.fire({
                            title: 'Menghapus...',
                            text: 'Mohon tunggu',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        form.submit();
                    }
                });
            });

            // ============================================
            // 2. SWEETALERT UNTUK SUBMIT FORM (SETUJUI/BATALKAN)
            // ============================================
            $(document).on('click', '.confirm-submit', function(e) {
                e.preventDefault();

                let form = $(this).closest('form');
                let message = $(this).data('message') || 'Lanjutkan aksi ini?';
                let confirmText = $(this).data('confirm-text') || 'Ya, lanjutkan!';
                let icon = $(this).data('icon') || 'question';

                Swal.fire({
                    title: 'Konfirmasi',
                    text: message,
                    icon: icon,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: confirmText,
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Memproses...',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        form.submit();
                    }
                });
            });

            // ============================================
            // 3. NOTIFIKASI TOAST (OTOMATIS HILANG)
            // ============================================
            @if (session('success'))
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: '{{ session('error') }}',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            @endif

            @if (session('warning'))
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'warning',
                    title: '{{ session('warning') }}',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            @endif
        });

        // ============================================
        // 4. FUNGSI GLOBAL UNTUK PANGGIL MANUAL
        // ============================================
        function showAlert(title, message, icon = 'success') {
            Swal.fire(title, message, icon);
        }

        function showToast(message, icon = 'success') {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: icon,
                title: message,
                showConfirmButton: false,
                timer: 3000
            });
        }

        function confirmAction(url, method, message, callback) {
            Swal.fire({
                title: 'Konfirmasi',
                text: message,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: method
                        },
                        success: function(response) {
                            if (callback) callback(response);
                            else showToast(response.message || 'Berhasil!');
                        },
                        error: function() {
                            showToast('Terjadi kesalahan!', 'error');
                        }
                    });
                }
            });
        }
    </script>
    {{-- ? @yield() ini berfungsi untuk menambahkan javascript dari file view lain jika dibutuhkan --}}
    @yield('js')
</body>

</html>
