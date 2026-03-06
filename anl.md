# Dokumen Analisis Sistem Inventaris Barang

## 1. Autentikasi (Auth)

### A. Pendaftaran (Register)
*   **Akses:** Melalui URL khusus yang hanya diketahui oleh Admin.
*   **Field Input:** Nama Lengkap, Username, Email, Daftar Sebagai (Role), Lembaga, Password, Konfirmasi Password.
*   **Validasi Input:**
    *   `Nama Lengkap` kosong: "Nama lengkap tidak boleh kosong"
    *   `Username` kosong: "Username tidak boleh kosong"
    *   `Email` kosong: "Email tidak boleh kosong"
    *   `Format Email` salah: "Format salah"
    *   `Daftar Sebagai` kosong: "Kolom role tidak boleh kosong!!"
    *   `Lembaga` kosong: "Lembaga tidak boleh kosong"
    *   `Password` kosong: "Password tidak boleh kosong"
    *   `Password tidak sama`: "Password tidak sesuai"
    *   `Password < 8 karakter`: "Password terlalu pendek"
*   **Ketentuan Unik:** `Username` dan `Email` tidak boleh sama dengan yang sudah ada di database.
*   **Output Berhasil:** Muncul alert "Pendaftaran berhasil silahkan login."

### B. Login
*   **Field Input:** Username dan Password.
*   **Validasi Input:**
    *   `Username` kosong: "Username tidak boleh kosong"
    *   `Username` salah: "Username tidak ditemukan"
    *   `Password` kosong: "Password tidak boleh kosong"
    *   `Password` salah: "Ups! Password kamu salah"
*   **Output Berhasil:** Dialihkan ke halaman Dashboard Utama (sesuai Role Admin/User).

### C. Logout
*   **Proses:** Keluar dari akun dan kembali ke halaman Login.

---

## 2. Dashboard User

Halaman utama terbagi menjadi 3 bagian: **Header**, **Sidebar**, dan **Isi (Content)**.

### A. Header
Terdiri dari dua bagian utama:
1.  **Sisi Kiri:**
    *   **Mode Tablet:** Logo emblem (link ke `#`). Jika kursor diarahkan (hover), sidebar melebar dan logo berubah menjadi *wordmark*. Terdapat tombol untuk mengunci (*pin*) sidebar.
    *   **Mode Mobile:** Logo berubah menjadi tombol hamburger. Jika ditekan, sidebar muncul. Logo *wordmark* berpindah ke posisi tengah.
2.  **Sisi Kanan:**
    *   **Mode Tablet:** Ikon profil/user. Jika ditekan, muncul info user, tombol "Profilku" (Edit), dan tombol "Keluar".
    *   **Mode Mobile:** Versi ringkas; jika ditekan langsung muncul tombol "Profilku" dan "Keluar".

### B. Sidebar (Navigasi)
Menampilkan opsi menu sebagai berikut:
*   **Dashboard** (Beranda)
*   **BAST Penyerah:**
    *   Menunggu Disetujui
    *   Riwayat BAST
*   **BAST Penerima:**
    *   Menunggu Disetujui
    *   Riwayat BAST

### C.1. Isi (Main Content)
*   **Greeting:** Menampilkan teks "Selamat Datang, `[Nama User]`".
*   **Data Summary:** Di bawah greeting, tampilkan ringkasan data dari:
    *   Kategori
    *   Lokasi
    *   Barang
    *   Berita Acara (BAST)



