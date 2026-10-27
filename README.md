# Formulir PMB Kampus Cendekia

Proyek praktikum PHP dan MySQL untuk mempelajari alur **form HTML → validasi PHP → INSERT data → menampilkan data dari database**.

## Fitur

- Tampilan responsif menggunakan Bootstrap 5.
- Formulir identitas, kontak, asal sekolah, program studi, dan jalur pendaftaran.
- Validasi dari browser dan validasi ulang di server.
- Koneksi MySQL menggunakan PDO.
- Prepared statement untuk menyimpan data.
- Perlindungan CSRF sederhana.
- NIK dan email bersifat unik.
- Halaman daftar pendaftar.
- Pesan kesalahan konfigurasi yang mudah dipahami mahasiswa.

## Struktur folder

```text
pmb-kampus/
├── assets/
│   ├── css/style.css
│   └── js/validation.js
├── config/database.php
├── database/db_pmb.sql
├── includes/functions.php
├── index.php
├── proses_pendaftaran.php
├── daftar_pendaftar.php
└── README.md
```

## Cara menjalankan dengan XAMPP

1. Clone atau unduh repository ini.
2. Letakkan folder `pmb-kampus` di dalam `C:\xampp\htdocs\`.
3. Jalankan **Apache** dan **MySQL** melalui XAMPP Control Panel.
4. Buka `http://localhost/phpmyadmin`.
5. Pilih menu **Import**, lalu impor `database/db_pmb.sql`.
6. Periksa `config/database.php`. Konfigurasi standar XAMPP:

```php
const DB_HOST = 'localhost';
const DB_PORT = '3306';
const DB_NAME = 'db_pmb_kampus';
const DB_USER = 'root';
const DB_PASS = '';
```

7. Buka `http://localhost/pmb-kampus/`.

Jika database sudah digunakan sebelum kolom nama panggilan ditambahkan, jalankan perintah berikut di phpMyAdmin untuk memperbarui tabel tanpa menghapus data:

```sql
ALTER TABLE pendaftar
ADD COLUMN nama_panggilan VARCHAR(50) NOT NULL DEFAULT '' AFTER nama_lengkap;
```

## Alur program

1. `index.php` menampilkan formulir pendaftaran.
2. Form dikirim dengan metode `POST` ke `proses_pendaftaran.php`.
3. PHP memvalidasi data dan menghubungkan aplikasi ke MySQL.
4. Data disimpan ke tabel `pendaftar` menggunakan prepared statement.
5. Pengguna kembali ke formulir dan memperoleh nomor pendaftaran.
6. `daftar_pendaftar.php` membaca dan menampilkan data dari MySQL.

## Latihan konfigurasi untuk mahasiswa

- Ubah nama kampus dan warna utama antarmuka.
- Tambahkan satu program studi baru pada form dan validasi PHP.
- Ubah nama database, lalu sesuaikan file SQL dan konfigurasi.
- Masukkan minimal lima data pendaftar.
- Tunjukkan bukti bahwa NIK atau email yang sama tidak dapat disimpan dua kali.

> Catatan: halaman daftar pendaftar pada proyek ini dibuat untuk pembelajaran. Pada aplikasi produksi, halaman tersebut harus dilindungi dengan autentikasi dan otorisasi.
