<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<h1 align="center">E-Arsip Surat (Sistem Manajemen Surat Digital)</h1>

<p align="center">
    <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
    <a href="https://github.com/penoFahmi/e-arsip-surat/blob/main/LICENSE"><img src="https://img.shields.io/github/license/penoFahmi/e-arsip-surat" alt="License"></a>
    <img src="https://img.shields.io/badge/PHP-8.1%2B-blue" alt="PHP Version">
</p>

<p align="center">
  <strong>Solusi modern untuk digitalisasi arsip, disposisi surat, dan manajemen administrasi perkantoran.</strong>
</p>

<p align="center">
  <a href="#-fitur-unggulan">Fitur</a> •
  <a href="#-teknologi">Teknologi</a> •
  <a href="#-instalasi">Instalasi</a> 
</p>

---

## 📌 Tentang Project

**E-Arsip Surat** adalah aplikasi berbasis web yang dirancang untuk mempermudah instansi dalam mengelola sirkulasi surat-menyurat. Aplikasi ini menggantikan metode pencatatan manual (buku agenda) menjadi sistem digital yang terintegrasi.

Dengan sistem ini, proses pencarian arsip lama, pelacakan disposisi surat, hingga pembuatan laporan agenda bulanan dapat dilakukan secara instan dan akurat.

---

## 💻 Teknologi

Project ini dibangun menggunakan stack teknologi modern untuk performa dan keamanan yang optimal:

-   **Framework:** [Laravel](https://laravel.com)
-   **Database:** MySQL
-   **Frontend:** Blade Templating
-   **UI Kit:** Bootstrap 5 (Sneat Admin Template)
-   **Authentication:** Laravel Auth (Session based)

---

## 🚀 Fitur Unggulan

### 🔐 Keamanan & Akses
-   **Multi-Role Authentication:** Pemisahan akses tegas antara **Admin** (Superuser) dan **Staff** (Operator).
-   **Secure Session:** Proteksi CSRF dan enkripsi password standard industri.

### 📨 Manajemen Sirkulasi Surat
-   **Surat Masuk & Keluar:** Input data lengkap dengan validasi nomor agenda otomatis.
-   **Digitalisasi Dokumen:** Upload lampiran surat (PDF/Image) unlimited untuk arsip digital.
-   **Disposisi Digital:** Teruskan surat ke bawahan/staf terkait langsung dari sistem.

### 📊 Laporan & Utilitas
-   **Dashboard Statistik:** Grafik real-time volume surat masuk/keluar per bulan.
-   **Cetak Agenda Otomatis:** Generate Buku Agenda Masuk/Keluar siap cetak (PDF) berdasarkan periode tanggal.
-   **Galeri Arsip:** Sentralisasi pencarian dokumen berdasarkan tahun atau kategori.

### ⚙️ Konfigurasi Dinamis
-   **Pengaturan Instansi:** Ubah Kop Surat (Nama, Alamat, Logo) langsung dari menu pengaturan tanpa koding.
-   **Master Data:** Manajemen klasifikasi surat dan status disposisi yang fleksibel.

---

## ⚡ Instalasi (Setup Manual)

Pastikan environment Anda sudah memenuhi syarat: **PHP >= 8.1**, **Composer**, dan **MySQL**.

### 1) Clone Repository
```bash
git clone https://github.com/penoFahmi/e-arsip-surat.git
cd e-arsip-surat
```

### 2) Install Dependency

```sh
composer install
```

### 3) Setup Environment

Duplikasi file `.env.example` menjadi `.env`, lalu sesuaikan koneksi database.

```sh
cp .env.example .env
```

### 4) Generate Key

```sh
php artisan key:generate
```

### 5) Setup Database (Migrate)

```sh
php artisan migrate
```

### 6) Seeding Data (Penting)

Ini akan membuat user admin default dan pengaturan awal.

```sh
php artisan db:seed
```

### 7) Linking Storage (Wajib)

Agar file lampiran dan foto profil bisa tampil.

```sh
php artisan storage:link
```

### 8) Jalankan Aplikasi

```sh
php artisan serve
```

Akses di browser:

- http://127.0.0.1:8000

---

## 🔑 Akun Default

Gunakan akun ini untuk login pertama kali:

| Role  | Email           | Password |
|------|------------------|----------|
| Admin | sarjana@kopi.com | password |

> Demi keamanan, segera ganti password setelah login.

---

## 🧩 Struktur Role

- **Admin**
  - Kelola user (tambah/ubah/hapus)
  - Kelola surat masuk/keluar, disposisi, agenda
  - Kelola pengaturan instansi dan master data (klasifikasi/status)
- **Staff**
  - Akses terbatas sesuai kebijakan (misal input/kelola surat & disposisi)
  - Tidak mengubah master/pengaturan inti (opsional sesuai implementasi)

> Catatan: Detail hak akses mengikuti implementasi middleware/permission pada project.

---

## 🛠️ Kredit & Lisensi

- Template: [Sneat Admin Template](https://themeselection.com/item/sneat-free-bootstrap-html-admin-template/)
- Tim **ElHalc8n**
- Lisensi: [MIT License](LICENSE)

---
