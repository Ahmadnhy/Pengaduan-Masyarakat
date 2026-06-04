# Sistem pengaduan masyarakat berbasis website

Selamat datang di **WPM (Web Pengaduan Masyarakat)**, portal modern untuk menyampaikan aspirasi, keluhan, dan laporan pelayanan publik atau fasilitas umum secara cepat, transparan, dan aman. Proyek ini direvitalisasi secara total menjadi web app premium dengan desain modern (Glassmorphism, gradien dinamis, bayangan halus, mikro-animasi) dan dioptimalkan agar responsif 100% pada semua perangkat.

🔗 **Repository**: [github repository](https://github.com/Ahmadnhy/Pengaduan-Masyarakat)

# 🌟 Key Features

1. **Desain Visual Eksklusif (Glassmorphic):** Sentuhan modern pada kartu input dan sidebar navigasi menggunakan Google Fonts (Plus Jakarta Sans & Inter).
2. **Hitungan Statistik Real-time (SQL COUNT):** Menampilkan jumlah laporan masuk, diproses, dan selesai secara live langsung dari database MySQL.
3. **Penyimpanan Upload File Bukti Fisik:** Pengunggahan gambar bukti laporan yang tervalidasi dan tersimpan secara fisik dalam server.
4. **Riwayat Pengaduan Mandiri:** Warga dapat memantau perkembangan status aduannya dan melihat tanggapan resmi dari petugas secara langsung.
5. **Panel Admin & Petugas:** Modul pengelolaan data petugas, proses verifikasi status laporan, serta grafik tren pengaduan (Line Chart & Doughnut Chart).

# 🛠️ Tech Stack

- **Backend:** PHP Native (7.4 ke atas)
- **Database:** MySQL
- **Frontend:** Bootstrap 4 & 5 Utilities, FontAwesome 5, Chart.js, Animate.css, Google Fonts (Plus Jakarta Sans & Inter)
- **Styling:** CSS3 Custom Glassmorphism & Custom Gradients

# 📂 Project Structure

```text
Pengaduan-Masyarakat/
├── assets/                  # Aset statis (css/style.css, js/main.js, gambar, vendor)
├── config/                  # Konfigurasi aplikasi & database (database.php)
├── layouts/                 # Shared template UI (header.php, footer.php, navigasi)
├── public/                  # Halaman Fitur Warga, Petugas, dan Admin
│   ├── admin/               # Panel fitur Admin
│   ├── petugas/             # Panel fitur Petugas
│   └── user/                # Panel fitur Warga
├── src/                     # Logika backend & controller (app.php)
├── index.php                # Landing page utama
└── laporan.sql              # Skema Basis Data MySQL
```

# 🚀 Getting Started

Untuk dapat menjalankan aplikasi ini di komputer lokal Anda, silakan ikuti petunjuk langkah-langkah di bawah ini.

## Petunjuk Instalasi Lokal

1. **Persiapan Database:**
   - Aktifkan database server MySQL Anda (misalnya melalui XAMPP/Laragon).
   - Buat database baru di phpMyAdmin dengan nama `laporan`.
   - Impor file `laporan.sql` ke dalam database `laporan` tersebut.

2. **Konfigurasi Database:**
   - Buka file [database.php](file:///d:/Pengaduan-Masyarakat/config/database.php) di folder `config/`.
   - Sesuaikan konfigurasi host, username, password, dan nama database dengan pengaturan server lokal Anda.

3. **Menjalankan Aplikasi:**
   - Letakkan folder proyek ini di direktori web server lokal Anda (`htdocs` pada XAMPP atau `www` pada Laragon).
   - Jalankan web server Anda lalu buka browser dan akses URL:
     `http://localhost/Pengaduan-Masyarakat/`
   - Atau, jalankan server internal PHP dari root direktori proyek:
     ```bash
     php -S localhost:8080
     ```
     Lalu buka `http://localhost:8080` di browser Anda.

## 🔑 Informasi Akun Login Demo

Berikut adalah daftar akun demo bawaan database yang dapat Anda gunakan:

- **Masyarakat / Warga:**
  - Username: `memver`
  - Password: `123`
- **Petugas:**
  - Username: `memver`
  - Password: `123`
- **Admin:**
  - Username: `admin`
  - Password: `admin`

# 📜 Database Schema

Sistem ini didukung oleh 4 tabel utama:

1. **`masyarakat`**: Menyimpan data akun warga (`nik` primary key, `nama`, `username`, `password`, `telp`).
2. **`pengaduan`**: Menyimpan laporan yang dikirim warga (`id_pengaduan` primary key, `tgl_pengaduan`, `nik` foreign key, `isi_laporan`, `foto` bukti, `status` enum: '0', 'proses', 'selesai').
3. **`petugas`**: Data akun staf internal (`id_petugas` primary key, `nama_petugas`, `username`, `password`, `telp`, `level` enum: 'admin', 'petugas').
4. **`tanggapan`**: Data tanggapan resmi yang diberikan (`id_tanggapan` primary key, `id_pengaduan` foreign key, `tgl_tanggapan`, `tanggapan` teks, `id_petugas` foreign key).

## 🤝🏼 Contributing

Contributions are welcome! If you have suggestions for improvements or new features, feel free to open an issue or submit a pull request.

---

## 📄 License

This project is licensed under the MIT License.

---

**Developed by Ahmad nh👾 | [ahmadnh.is-a.dev](https://ahmadnh.is-a.dev)**
