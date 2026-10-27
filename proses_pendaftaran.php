<?php
declare(strict_types=1);
session_start();

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('index.php');
}

if (!hash_equals($_SESSION['csrf_token'] ?? '', $_POST['csrf_token'] ?? '')) {
    $_SESSION['errors'] = ['Sesi formulir tidak valid. Silakan muat ulang halaman.'];
    redirect('index.php');
}

$data = [
    'nik' => trim($_POST['nik'] ?? ''),
    'nama_lengkap' => trim($_POST['nama_lengkap'] ?? ''),
    'tempat_lahir' => trim($_POST['tempat_lahir'] ?? ''),
    'tanggal_lahir' => trim($_POST['tanggal_lahir'] ?? ''),
    'jenis_kelamin' => trim($_POST['jenis_kelamin'] ?? ''),
    'agama' => trim($_POST['agama'] ?? ''),
    'email' => trim($_POST['email'] ?? ''),
    'no_hp' => trim($_POST['no_hp'] ?? ''),
    'alamat' => trim($_POST['alamat'] ?? ''),
    'asal_sekolah' => trim($_POST['asal_sekolah'] ?? ''),
    'tahun_lulus' => trim($_POST['tahun_lulus'] ?? ''),
    'program_studi' => trim($_POST['program_studi'] ?? ''),
    'jalur_pendaftaran' => trim($_POST['jalur_pendaftaran'] ?? ''),
];

$_SESSION['old'] = $data;
$errors = [];

foreach ($data as $field => $value) {
    if ($value === '') {
        $errors[] = 'Semua kolom wajib diisi.';
        break;
    }
}

if (!preg_match('/^\d{16}$/', $data['nik'])) {
    $errors[] = 'NIK harus terdiri dari 16 digit angka.';
}
if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Format email tidak valid.';
}
if (!preg_match('/^\d{9,15}$/', $data['no_hp'])) {
    $errors[] = 'Nomor WhatsApp harus terdiri dari 9–15 digit angka.';
}

$allowedGender = ['Laki-laki', 'Perempuan'];
$allowedReligion = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu', 'Lainnya'];
$allowedProgram = ['Sistem Informasi', 'Teknik Informatika', 'Desain Komunikasi Visual', 'Manajemen', 'Akuntansi', 'Farmasi'];
$allowedRoute = ['Reguler', 'Prestasi Akademik', 'Prestasi Nonakademik', 'Beasiswa'];

if (!in_array($data['jenis_kelamin'], $allowedGender, true)) $errors[] = 'Jenis kelamin tidak valid.';
if (!in_array($data['agama'], $allowedReligion, true)) $errors[] = 'Agama tidak valid.';
if (!in_array($data['program_studi'], $allowedProgram, true)) $errors[] = 'Program studi tidak valid.';
if (!in_array($data['jalur_pendaftaran'], $allowedRoute, true)) $errors[] = 'Jalur pendaftaran tidak valid.';
if (!isset($_POST['persetujuan'])) $errors[] = 'Persetujuan calon mahasiswa wajib diberikan.';

$year = filter_var($data['tahun_lulus'], FILTER_VALIDATE_INT);
if ($year === false || $year < 2020 || $year > ((int) date('Y') + 1)) {
    $errors[] = 'Tahun lulus tidak valid.';
}

$birthDate = DateTime::createFromFormat('Y-m-d', $data['tanggal_lahir']);
if (!$birthDate || $birthDate->format('Y-m-d') !== $data['tanggal_lahir'] || $birthDate > new DateTime()) {
    $errors[] = 'Tanggal lahir tidak valid.';
}

if ($errors) {
    $_SESSION['errors'] = array_values(array_unique($errors));
    redirect('index.php');
}

try {
    $pdo = getConnection();
    $sql = 'INSERT INTO pendaftar
        (nik, nama_lengkap, tempat_lahir, tanggal_lahir, jenis_kelamin, agama, email, no_hp, alamat, asal_sekolah, tahun_lulus, program_studi, jalur_pendaftaran)
        VALUES
        (:nik, :nama_lengkap, :tempat_lahir, :tanggal_lahir, :jenis_kelamin, :agama, :email, :no_hp, :alamat, :asal_sekolah, :tahun_lulus, :program_studi, :jalur_pendaftaran)';
    $statement = $pdo->prepare($sql);
    $statement->execute($data);

    $registrationNumber = 'PMB-' . date('Y') . '-' . str_pad((string) $pdo->lastInsertId(), 4, '0', STR_PAD_LEFT);
    unset($_SESSION['old']);
    $_SESSION['success'] = 'Pendaftaran berhasil disimpan. Nomor pendaftaran: ' . $registrationNumber;
} catch (PDOException $exception) {
    if ((int) $exception->errorInfo[1] === 1062) {
        $_SESSION['errors'] = ['NIK atau email sudah pernah digunakan untuk mendaftar.'];
    } else {
        $_SESSION['errors'] = ['Data belum dapat disimpan. Pastikan database telah diimpor dan konfigurasi sudah benar.'];
    }
}

redirect('index.php');
