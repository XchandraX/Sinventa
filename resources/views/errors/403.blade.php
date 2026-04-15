{{-- resources/views/errors/403.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Akses Ditolak</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <style>
        /* Gaya tambahan khusus untuk halaman error */
        .error-page-custom {
            background-color: var(--bg-dark);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .error-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 48px 32px;
            text-align: center;
            max-width: 500px;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
        }

        .error-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary);
            box-shadow: 0 20px 30px -12px rgba(0, 0, 0, 0.1);
        }

        .error-code {
            font-size: 88px;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent-blue) 100%);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            margin: 0;
            line-height: 1;
        }

        .error-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-primary);
            margin: 24px 0 12px;
        }

        .error-message {
            color: var(--text-secondary);
            margin-bottom: 32px;
            line-height: 1.6;
        }

        .error-actions {
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-error {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
            border: 1px solid transparent;
        }

        .btn-error-primary {
            background: var(--primary);
            color: var(--bg-dark);
        }

        .btn-error-primary:hover {
            background: var(--accent-blue);
            color: var(--bg-dark);
            transform: translateY(-2px);
        }

        .btn-error-secondary {
            background: transparent;
            border-color: var(--border-color);
            color: var(--text-primary);
        }

        .btn-error-secondary:hover {
            background: var(--hover-bg);
            border-color: var(--primary);
            transform: translateY(-2px);
        }

        .icon-lock {
            width: 80px;
            height: 80px;
            margin: 0 auto 16px;
            color: var(--primary);
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div class="error-page-custom">
        <div class="error-card">
            <div class="icon-lock">
                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    <circle cx="12" cy="16" r="1"></circle>
                </svg>
            </div>
            <h1 class="error-code">403</h1>
            <h2 class="error-title">Akses Tidak Diizinkan</h2>
            <p class="error-message">
                Maaf, Anda tidak memiliki izin untuk mengakses halaman ini.<br>
                Silakan hubungi administrator jika Anda merasa ini adalah kesalahan.
            </p>
            <div class="error-actions">
                <a href="javascript:history.back()" class="btn-error btn-error-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                    Kembali
                </a>
                <a href="{{ url('/') }}" class="btn-error btn-error-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2h-5v-7H9v7H4a2 2 0 0 1-2-2z"/>
                    </svg>
                    Beranda
                </a>
            </div>
        </div>
    </div>

    <!-- Dark Mode Script (sinkron dengan tema yang sudah ada) -->
    <script>
        // Fungsi untuk membaca tema yang tersimpan
        function getCurrentTheme() {
            return localStorage.getItem('theme') || 'light';
        }

        // Fungsi untuk menerapkan tema
        function applyTheme(theme) {
            const root = document.documentElement;
            if (theme === 'dark') {
                root.setAttribute('data-theme', 'dark');
            } else {
                root.removeAttribute('data-theme');
            }
        }

        // Inisialisasi tema saat halaman dimuat
        const savedTheme = getCurrentTheme();
        applyTheme(savedTheme);

        // Mendengarkan perubahan tema dari storage (jika ada tab lain yang berubah)
        window.addEventListener('storage', function(e) {
            if (e.key === 'theme') {
                applyTheme(e.newValue || 'light');
            }
        });
    </script>
</body>
</html>