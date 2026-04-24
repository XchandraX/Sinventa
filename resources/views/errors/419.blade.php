{{-- resources/views/errors/419.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>419 - Sesi Kadaluarsa</title>
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
            background: linear-gradient(135deg, #f59e0b 0%, #ef4444 100%);
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
            margin-bottom: 24px;
            line-height: 1.6;
        }

        .error-suggestion {
            background: rgba(245, 158, 11, 0.1);
            border-left: 3px solid #f59e0b;
            padding: 16px;
            border-radius: 10px;
            text-align: left;
            margin-bottom: 32px;
        }

        .error-suggestion p {
            margin: 0 0 8px 0;
            font-size: 13px;
            color: var(--text-secondary);
        }

        .error-suggestion p:last-child {
            margin-bottom: 0;
        }

        .error-suggestion strong {
            color: #f59e0b;
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
            cursor: pointer;
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

        .btn-error-warning {
            background: #f59e0b;
            color: #1e293b;
        }

        .btn-error-warning:hover {
            background: #d97706;
            transform: translateY(-2px);
            color: #1e293b;
        }

        .icon-session {
            width: 80px;
            height: 80px;
            margin: 0 auto 16px;
            color: #f59e0b;
            opacity: 0.9;
        }

        /* Animasi rotate untuk icon refresh */
        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .error-card .icon-session svg {
            animation: rotate 20s linear infinite;
            transform-origin: center;
        }

        /* Countdown timer styling */
        .countdown-timer {
            display: inline-block;
            margin-top: 16px;
            font-size: 13px;
            color: var(--text-muted);
        }

        .countdown-number {
            font-weight: 700;
            color: #f59e0b;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="error-page-custom">
        <div class="error-card">
            <div class="icon-session">
                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 12a9 9 0 1 1-9-9c2.52 0 4.93 1 6.74 2.74L21 8"/>
                    <path d="M21 3v5h-5"/>
                    <circle cx="12" cy="12" r="2"/>
                    <path d="M12 8v4l2.5 2.5"/>
                </svg>
            </div>
            <h1 class="error-code">419</h1>
            <h2 class="error-title">Sesi Telah Kadaluarsa</h2>
            <p class="error-message">
                Sesi Anda telah berakhir karena tidak ada aktivitas dalam waktu lama atau token keamanan tidak valid.
            </p>

            <div class="error-suggestion">
                <p><strong>⏱️ Mengapa ini terjadi?</strong></p>
                <p>• Halaman terlalu lama dibuka tanpa aktivitas</p>
                <p>• Form dikirim ulang setelah refresh halaman</p>
                <p>• Token keamanan (CSRF) tidak cocok dengan server</p>
                <p style="margin-top: 10px;"><strong>💡 Solusi:</strong></p>
                <p>Refresh halaman atau kembali ke halaman sebelumnya, lalu coba lagi</p>
            </div>

            <div class="error-actions">
                <button onclick="refreshPage()" class="btn-error btn-error-warning" id="refreshBtn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                    Refresh Halaman
                </button>
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

            <div class="countdown-timer" id="countdownTimer">
                <span id="countdownText">Halaman akan di-refresh secara otomatis dalam</span>
                <span class="countdown-number" id="countdownSeconds">10</span>
                <span>detik</span>
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

        // Fungsi refresh halaman dengan parameter untuk membuang cache
        function refreshPage() {
            // Tambahkan timestamp untuk menghindari cache
            window.location.href = window.location.pathname + '?_=' + Date.now();
        }

        // Countdown auto refresh
        let countdown = 10;
        const countdownElement = document.getElementById('countdownSeconds');
        const refreshBtn = document.getElementById('refreshBtn');

        const timerInterval = setInterval(function() {
            countdown--;
            if (countdownElement) {
                countdownElement.textContent = countdown;
            }

            if (countdown <= 0) {
                clearInterval(timerInterval);
                // Ganti teks tombol
                if (refreshBtn) {
                    refreshBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg> Merefresh...';
                    refreshBtn.disabled = true;
                }
                refreshPage();
            }
        }, 1000);

        // Hentikan countdown jika pengguna melakukan interaksi dengan tombol manual
        if (refreshBtn) {
            refreshBtn.addEventListener('click', function() {
                clearInterval(timerInterval);
            });
        }
    </script>
</body>
</html>