# Dokumen Analisis Sistem Inventaris Barang

## 1. Modul Autentikasi (Auth)

### A. Pendaftaran (Register)
*   **Akses:** Melalui URL khusus (Hanya diketahui Admin).

* **Token Pendaftaran**:
    * Untuk mendaftar akun, pengguna harus memasukkan **token dari Admin**.
    * Token hanya dapat digunakan **1 kali**.
    * Jika token sudah digunakan, maka token tidak berlaku lagi.

*   **Field Input:** Nama Lengkap, Username, Email, Role, Lembaga, Password, Konfirmasi Password, Token.
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
    *   `Token kosong`: "Token tidak boleh kosong"
    *   `Token tidak valid` "Token tidak valid"
    *   `Token sudah digunakan` "Token sudah tidak berlaku"
*   **Ketentuan Unik:** `Username` dan `Email` tidak boleh sama dengan yang sudah ada di database.
*   **Output Berhasil:** 
    *   Muncul alert "Pendaftaran berhasil silahkan login."
    *   Sistem otomatis mengganti token yang sudah digunakan.

---

## 2. Dashboard User

### Mode Light & Dark

* Pengguna dapat memilih tampilan **Light Mode** atau **Dark Mode**.

*   **Fitur:**
    *   Tombol ganti mode tersedia pada halaman utama.
    *   Pilihan mode akan disimpan.
    *   Saat aplikasi dibuka kembali, mode terakhir tetap digunakan.

### A. Komponen UI (Header & Sidebar)
*   **Header:** 
    *   *Tablet:* Logo emblem (hover to expand), pin sidebar, profil dropdown (Info, Profilku, Keluar).
    *   *Mobile:* Tombol hamburger, logo wordmark di tengah, profil versi ringkas.
*   **Sidebar:** Menu Dashboard, BAST Penyerah (Menunggu/Riwayat), BAST Penerima (Menunggu/Riwayat).

### B. Konten Utama (Main Content)

1.  **Dashboard:** Greeting *"Selamat Datang, [Nama]"* & Summary (Kategori, Lokasi, Barang, BAST).
2.  **BAST (Menunggu Disetujui):**
    *   **Logic:**
        *   `IF (Database Ada)`: Tampilkan summary data (Nama Barang, Kategori, Lokasi, Status). Tersedia tombol **Show**; di dalam detail terdapat tombol **"Setujui Penyerah/Penerima"**.
        *   `ELSE`: Tampilkan pesan "Tidak ada berita acara tersedia".
3.  **BAST (Riwayat):**
    *   **Logic:**
        *   `IF (Database Ada)`: Tampilkan summary data (Nama Barang, Kategori, Lokasi, Status). Tersedia tombol **Show**.
        *   `ELSE`: Tampilkan pesan "Tidak ada berita acara tersedia".

---

## 3. Dashboard Admin

### Mode Light & Dark

* Pengguna dapat memilih tampilan **Light Mode** atau **Dark Mode**.

*   **Fitur:**
    *   Tombol ganti mode tersedia pada halaman utama.
    *    Pilihan mode akan disimpan.
    *    Saat aplikasi dibuka kembali, mode terakhir tetap digunakan.

### A. Manajemen Sidebar
*   **Master Data:** Kategori Barang, Lokasi Barang, Data Barang.
*   **Transaksi:** Berita Acara (BAST).
*   **Sistem:** Manajemen Pengguna.

### B. Manajemen List & Filter
*   **Header Tabel:** Judul list, tombol Tambah, Fitur Ekspor (PDF, Excel, Print).
*   **Logic Tampilan:**
    *   `IF (Data Kosong)`: Pesan "Tidak ada list tersedia".
    *   `IF (Data Ada)`: Tabel dengan kolom: Kode, Nama, Keterangan, Waktu Dibuat, dan Tombol Aksi (Edit, Hapus, Show).
*   **Fitur Pencarian:**
    *   *Barang:* Search berdasarkan kategori, lokasi, dan status.
    *   *BAST:* Filter status BAST dan status barang.

### C. Detail Struktur Data (Input)


| Modul | Field Input |
| :--- | :--- |
| **Kategori & Lokasi** | Kode, Nama, Deskripsi. |
| **Barang** | Nama, Kode, Kategori, Lokasi, Status, Deskripsi. |
| **BAST** | Pilih Barang, Penyerah, Status Serah, Penerima, Status Terima. |
| **Pengguna** | Nama Lengkap, Username, Lembaga, Role, Password & Konfirmasi. |

### D. Tampilan Detail (Show)

#### 1. Show BAST
*   **Header:** Kode (Kategori, Lokasi, Barang).
*   **Detail Inventaris:** Kode Barang, Nama, Kategori, Lokasi, Status, Deskripsi, dan **QR Code Barang**.
*   **Detail Pihak:** Nama Penyerah vs Nama Penerima.
*   **Timestamps:** Waktu dibuat (Format: Day, DD-MM-YYYY).

#### 2. Show Barang
*   **Info Utama:** Kode, Nama, Kategori, Lokasi, Status, dan **QR Code**.
*   **Riwayat BAST:** Tabel daftar riwayat serah terima khusus barang tersebut (Searchable).

### E. Fitur Ekspor
Admin memiliki akses penuh untuk melakukan **Download/Ekspor** (PDF, Excel, Print) pada data Kategori, Lokasi, dan Data Barang (Full).