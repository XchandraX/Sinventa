{{-- ? bagian menu sidebar dashboard --}}
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">

        {{-- menu sidebar dimulai dari sini --}}
        <div id="sidebar-menu" class="sidebar-menu">

            {{-- jika user yang login adalah admin --}}
            @if (Auth::user()->role == 'admin')
                {{-- tampilkan menu khusus untuk admin --}}
                <ul>

                    {{-- menu halaman dashboard --}}
                    <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                        <a href="{{ route('dashboard') }}">
                            <i class="bi bi-speedometer2"></i>
                            <span>Dashboard</span>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    {{-- menu halaman kategori barang --}}
                    <li class="submenu">
                        <a href="#">
                            <i class="bi bi-card-list"></i>
                            <span>Kategori Barang</span>
                            <span class="ms-auto bi bi-caret-down"></span>
                        </a>
                        <ul>
                            <li><a href="">List Kategori</a></li>
                            <li><a href="">Tambah Kategori</a></li>
                        </ul>
                    </li>

                    {{-- menu halaman lokasi barang --}}
                    <li class="submenu">
                        <a href="#">
                            <i class="bi bi-buildings"></i>
                            <span>Lokasi Barang</span>
                            <span class="ms-auto bi bi-caret-down"></span>
                        </a>
                        <ul>
                            <li><a href="">List Lokasi</a></li>
                            <li><a href="">Tambah Lokasi</a></li>
                        </ul>
                    </li>

                    {{-- menu halaman barang --}}
                    <li class="submenu"></li>
                        <a href="#">
                            <i class="bi bi-box-seam"></i>
                            <span>Barang</span>
                            <span class="ms-auto bi bi-caret-down"></span>
                        </a>
                        <ul>
                            <li><a href="">List Barang</a></li>
                            <li><a href="">Tambah Barang</a></li>
                        </ul>
                    </li>

                    {{-- menu halaman berita acara --}}
                    <li class="submenu">
                        <a href="#">
                            <i class="bi bi-file-earmark-medical"></i>
                            <span>BAST</span>
                            <span class="ms-auto bi bi-caret-down"></span>
                        </a>
                        <ul>
                            <li><a href="">List Berita Acara</a></li>
                            <li><a href="">Buat Berita Acara</a></li>
                        </ul>
                    </li>
                </ul>

                {{-- jika user yang login adalah user biasa --}}
                @else

                {{-- tampilkan menu khusus untuk user biasa --}}
                <ul>


                    {{-- menu dashboard --}}
                    <li class="active">
                        <a href="#">
                            <i class="bi bi-speedometer2"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    {{-- menu halaman berita acara sebagai penyerah --}}
                    <li class="submenu">
                        <a href="#">
                            <i class="bi bi-person-down"></i>
                            <span>BAST Penyerah</span>
                            <span class="ms-auto bi bi-caret-down"></span>
                        </a>
                        <ul>
                            <li><a href="">Menunggu Disetujui</a></li>
                            <li><a href="">Riwayat BAST</a></li>
                        </ul>
                    </li>

                    {{-- menu halaman berita acara sebagai penerima --}}
                    <li class="submenu">
                        <a href="#">
                            <i class="bi bi-person-up"></i>
                            <span>BAST Penerima</span>
                            <span class="ms-auto bi bi-caret-down"></span>
                        </a>
                        <ul>
                            <li><a href="">Menunggu Disetujui</a></li>
                            <li><a href="">Riwayat BAST</a></li>
                        </ul>
                    </li>
                </ul>
            @endif
            
        </div>
    </div>
</div>
