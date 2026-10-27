CREATE DATABASE IF NOT EXISTS db_pmb_kampus
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE db_pmb_kampus;

CREATE TABLE IF NOT EXISTS pendaftar (
    id_pendaftar INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nik CHAR(16) NOT NULL UNIQUE,
    nama_lengkap VARCHAR(100) NOT NULL,
    tempat_lahir VARCHAR(60) NOT NULL,
    tanggal_lahir DATE NOT NULL,
    jenis_kelamin ENUM('Laki-laki', 'Perempuan') NOT NULL,
    agama VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    no_hp VARCHAR(15) NOT NULL,
    alamat VARCHAR(255) NOT NULL,
    asal_sekolah VARCHAR(120) NOT NULL,
    tahun_lulus YEAR NOT NULL,
    program_studi VARCHAR(80) NOT NULL,
    jalur_pendaftaran VARCHAR(40) NOT NULL,
    tanggal_daftar TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Data contoh opsional. Hapus tanda komentar jika ingin digunakan.
-- INSERT INTO pendaftar
-- (nik, nama_lengkap, tempat_lahir, tanggal_lahir, jenis_kelamin, agama, email, no_hp, alamat, asal_sekolah, tahun_lulus, program_studi, jalur_pendaftaran)
-- VALUES
-- ('3573010101080001', 'Alya Putri Ramadhani', 'Malang', '2008-01-01', 'Perempuan', 'Islam', 'alya@example.com', '81234567890', 'Jl. Merdeka No. 10, Malang', 'SMA Cendekia Malang', 2026, 'Sistem Informasi', 'Reguler');
