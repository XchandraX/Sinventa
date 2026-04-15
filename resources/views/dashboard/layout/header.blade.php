{{-- ? Bagian header dashboard --}}
<div class="header">
    <div class="header-left">
        {{-- Logo Dashboard --}}
        <a href="{{ route('dashboard') }}" class="logo">
            <img src="{{ asset('assets/icon/SMKM2KNG.png') }}" alt="Sinvesta">
        </a>

        {{-- Logo Dashboard saat sidebar disembunyikan --}}
        <a href="{{ route('dashboard') }}" class="logo-small">
            <img src="{{ asset('assets/icon/favicon.png') }}" alt="Sinvesta">
        </a>

        {{-- Tombol Toggle Muncul / Sembunyi --}}
        <a href="#" id="toggle_btn"> </a>
    </div>

    {{-- Tombol khusus untuk mobile  --}}
    <a href="#sidebar" id="mobile_btn" class="mobile_btn">
        <span class="bar-icon">
            <span></span>
            <span></span>
            <span></span>
        </span>
    </a>

    {{-- menu bagian kanan --}}
    <ul class="nav user-menu">
        {{-- Tombol toggle mode - ditempatkan di sini --}}
        <li class="nav-item">
            <button id="theme-toggle" class="theme-toggle">
                <span class="light-icon"><i class="bi bi-moon-fill"></i></span>
                <span class="dark-icon"><i class="bi bi-sun-fill"></i></span>
                <span class="mode-text">Mode</span>
            </button>
        </li>

        {{-- alert pemberitahuan saat ada update data (store/update/delete) --}}
        @session('berhasil')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('berhasil') }}
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endsession

        {{-- menu profil --}}
        <li class="nav-item dropdown has-arrow main-drop">
            {{-- tombol toggle profil --}}
            <a href="#" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                <span class="user-img">
                    <i class="bi bi-person-circle"></i>
                    <span class="status online"></span>
                </span>
            </a>

            {{-- menu profil user --}}
            <div class="dropdown-menu menu-drop-user">
                <div class="profilename">
                    {{-- menampilkan info user --}}
                    <div class="profileset">
                        <span class="user-img">
                            <i class="bi bi-person-circle" style="color: var(--text-main);"></i>
                            <span class="status online"></span>
                        </span>
                        <div class="profilesets">
                            <h6>{{ Auth::user()->username }}</h6>
                            <h5>{{ Auth::user()->role }}</h5>
                        </div>
                    </div>

                    <hr class="m-0">

                    {{-- tombol edit profil --}}
                    <a href="{{ route('users.edit', Auth::user()) }}" class="dropdown-item">Profil Ku</a>

                    {{-- tombol logout --}}
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="dropdown-item logout pb-0" type="submit">Logout</button>
                    </form>
                </div>
            </div>
        </li>
    </ul>

    {{-- menu profil khusus untuk di mobile --}}
    <div class="dropdown mobile-user-menu">
        {{-- tombol toggle menu profil --}}
        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-ellipsis-v"></i>
        </a>

        {{-- menu profil khusus mobile --}}
        <div class="dropdown-menu dropdown-menu-right">
            {{-- Theme toggle untuk mobile --}}
            <div class="px-3 py-2">
                <button id="theme-toggle-mobile" class="theme-toggle w-100">
                    <span class="light-icon"><i class="bi bi-moon-fill"></i></span>
                    <span class="dark-icon"><i class="bi bi-sun-fill"></i></span>
                    <span class="mode-text">Ganti Mode</span>
                </button>
            </div>
            <div class="dropdown-divider"></div>

            {{-- tombol edit profil khusus mobile --}}
            <a href="{{ route('users.edit', Auth::user()) }}" class="dropdown-item">Profil Ku</a>

            {{-- tombol logout khusus mobile --}}
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="dropdown-item py-0" type="submit">Logout</button>
            </form>
        </div>
    </div>
</div>
