# 📸 POTO KITA STUDIO - Sistem Informasi Pelayanan Pengaduan & Reservasi Sesi Foto

Aplikasi berbasis web yang dirancang khusus untuk mengelola sistem manajemen booking studio foto secara real-time, transparan, dan terintegrasi. Aplikasi ini dibangun menggunakan framework **CodeIgniter 4** dengan antarmuka modern bertema gelap (_Dark Mode Theme_) berbasis **Bootstrap 5**.

---

## 🚀 Fitur Utama Sistem (All-in-One Portal)

Aplikasi ini dibagi menjadi beberapa modul aktor (Multi-User Role) dengan fitur-fitur unggulan sebagai berikut:

### 1. 👥 Portal Publik & Manajemen Booking (Customer Experience)

- **Anti-Double Booking Validation (Real-Time Core Logic):** Fitur proteksi tingkat tinggi pada sistem back-end. Aplikasi secara otomatis mendeteksi dan mengunci slot jadwal berdasarkan kombinasi **Tanggal Sesi + Jam Sesi + Pilihan Ruangan Studio**. Jika slot waktu pada studio tersebut sudah dipesan pelanggan lain, sistem akan menolak otomatis melalui _flash message validation alert_.
- **Aritmatika Bersyarat (Dynamic Pricing):** Kalkulasi biaya total tagihan dihitung secara otomatis berdasarkan:
  - Harga dasar kategori studio (_Regular, Largest, atau VVIP Box_).
  - Charge kelebihan kuota orang secara otomatis (Charge Rp 25.000 per kepala jika melewati limit kapasitas studio).
  - Biaya tambahan kebersihan (+Rp 20.000) secara dinamis jika memilih opsi membawa hewan peliharaan.
- **Unique Invoice Generator:** Sistem secara otomatis menerbitkan kode unik invoice aman dengan format `INV-TANGGAL-KODEACAK` (Contoh: `INV-20260706-FF96`) begitu reservasi sukses dibuat.
- **Cek Status Transaksi Instan:** Pelanggan dapat melacak status pemesanan mereka secara fleksibel hanya dengan memasukkan nomor Invoice atau nomor WhatsApp terdaftar.

### 2. 🔐 Customer Dashboard Portal

- **Riwayat Foto Terintegrasi:** Halaman khusus bagi customer terdaftar untuk memantau semua riwayat transaksi booking sesi studio yang pernah mereka lakukan.
- **Modul Mandiri Upload Bukti Bayar:** Fitur untuk mengunggah berkas gambar struk transfer bank (`.jpg`, `.jpeg`, `.png`) secara langsung ke server lokal (`public/uploads/`) dengan enkripsi penamaan acak (_random encrypted name_) demi keamanan file berkas.
- **Pemisahan Sidebar Output Berkas Foto (Private Drive Link):** Menu khusus yang bersih untuk mengakses dan mengunduh hasil foto mentah (_raw files_). Tautan tombol langsung mengarah ke folder privat **Google Drive** yang telah disiapkan oleh tim studio.
- **Direct WhatsApp Gateway Shortcode:** Tombol komunikasi interaktif terintegrasi yang otomatis mengarahkan pelanggan ke chat WhatsApp Admin resmi untuk konfirmasi pembayaran cepat menggunakan template pesan otomatis yang presisi.

### 3. 🛠️ Administrator & Staff Dashboard

- **Ringkasan Indikator Keuangan (Widget Real-Time):** Menampilkan total sesi masuk, total pendapatan riil dari transaksi yang sudah divalidasi, dan jumlah antrean validasi pembayaran.
- **Jadwal Sesi Foto Hari Ini:** Tabel pantauan terpusat untuk melihat daftar pelanggan yang akan melangsungkan sesi foto pada tanggal berjalan agar operasional kru studio berjalan teratur.
- **Manajemen Antrean Verifikasi:** Otoritas penuh bagi admin untuk memeriksa keaslian gambar struk transfer, melakukan approval perubahan status invoice (`Pending`, `Confirmed / Paid`, `Batal`), serta hak akses bagi tim Editor untuk memasukkan link Google Drive customer.

### 4. 👑 Owner Dashboard (Strategic Oversight)

- **Monitoring Total Pendapatan Riil:** Owner memiliki hak akses eksklusif untuk memantau total omzet pendapatan studio foto secara keseluruhan berdasarkan grafik dan rekapitulasi data transaksi yang sudah divalidasi `Lunas` oleh Admin.
- **Laporan Performa Bisnis:** Memantau metrik ringkasan performa sesi foto yang berjalan untuk kebutuhan analisis manajemen strategis studio.

---

## 🛠️ Stack Teknologi

- **Framework Back-End:** CodeIgniter 4 (Model-View-Controller Architecture)
- **Bahasa Pemrograman:** PHP 8.2+
- **Database Relasional:** MySQL / MariaDB (Driven by mysqli Engine)
- **Front-End Styling:** Bootstrap 5.3 & FontAwesome Icons v6.4
- **Typography:** Plus Jakarta Sans Google Fonts Ecosystem

---

## ⚙️ Petunjuk Pemasangan Lokal (Deployment)

1. Clone repositori ini atau ekstrak file `.zip` ke dalam direktori server lokal Anda (`htdocs` atau `laragon/www`).
2. Impor berkas database `.sql` yang telah disediakan ke dalam phpMyAdmin Anda.
3. Sesuaikan konfigurasi database Anda pada file `.env` atau `app/Config/Database.php` (atur _hostname, username, password,_ dan nama _database_).
4. Jalankan perintah `php spark serve` pada terminal direktori proyek.
5. Akses aplikasi melalui peramban di alamat: `http://localhost:8080`

## ⚙️ Kredensial
| Role     | Username         | Password                |
| -------- | ---------------- | ----------------------- |
| Admin    | admin            | admin123                |
| Editor   | editor           | editor123               |
| Owner    | owner            | owner123                |
| Customer | ramdhani         | lutfi                   |

