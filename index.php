<?php
declare(strict_types=1);
session_start();
require_once __DIR__ . '/includes/functions.php';

$errors = $_SESSION['errors'] ?? [];
$success = $_SESSION['success'] ?? null;
unset($_SESSION['errors'], $_SESSION['success']);
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PMB Kampus Cendekia</title>
    <meta name="description" content="Formulir Pendaftaran Mahasiswa Baru Kampus Cendekia">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark py-3">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">
            <span class="brand-mark"><i class="bi bi-mortarboard-fill"></i></span>
            Kampus Cendekia
        </a>
        <a class="btn btn-outline-light btn-sm px-3" href="daftar_pendaftar.php">
            <i class="bi bi-people me-1"></i> Data Pendaftar
        </a>
    </div>
</nav>

<header class="hero-section">
    <div class="container py-5">
        <div class="row align-items-center g-4">
            <div class="col-lg-7">
                <span class="badge hero-badge mb-3">PENERIMAAN MAHASISWA BARU 2027/2028</span>
                <h1 class="display-5 fw-800 text-white mb-3">Mulai perjalanan akademikmu bersama kami.</h1>
                <p class="lead text-white-50 mb-4">Isi formulir dengan data yang benar. Tim admisi akan menghubungi calon mahasiswa melalui email atau nomor telepon yang didaftarkan.</p>
                <div class="d-flex flex-wrap gap-3 hero-points">
                    <span><i class="bi bi-check-circle-fill"></i> Proses mudah</span>
                    <span><i class="bi bi-check-circle-fill"></i> Data aman</span>
                    <span><i class="bi bi-check-circle-fill"></i> Konfirmasi cepat</span>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block">
                <div class="hero-card ms-auto">
                    <i class="bi bi-person-vcard"></i>
                    <strong>Satu langkah lebih dekat</strong>
                    <span>Lengkapi identitas, asal sekolah, dan program studi pilihan.</span>
                </div>
            </div>
        </div>
    </div>
</header>

<main class="container form-wrapper">
    <div class="card registration-card border-0 shadow-lg">
        <div class="card-body p-4 p-lg-5">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                <div>
                    <span class="section-kicker">FORMULIR ONLINE</span>
                    <h2 class="fw-bold mb-1">Pendaftaran Mahasiswa Baru</h2>
                    <p class="text-secondary mb-0">Kolom bertanda <span class="text-danger">*</span> wajib diisi.</p>
                </div>
                <div class="step-pill"><span>1</span> Isi data calon mahasiswa</div>
            </div>

            <?php if ($success): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i><?= e($success) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>
            <?php endif; ?>

            <?php if ($errors): ?>
                <div class="alert alert-danger" role="alert">
                    <div class="fw-bold mb-1"><i class="bi bi-exclamation-triangle-fill me-2"></i>Periksa kembali data berikut:</div>
                    <ul class="mb-0">
                        <?php foreach ($errors as $error): ?><li><?= e($error) ?></li><?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="proses_pendaftaran.php" method="post" class="needs-validation" novalidate>
                <input type="hidden" name="csrf_token" value="<?= e(csrfToken()) ?>">

                <div class="form-section">
                    <div class="form-section-title"><span>01</span><div><h3>Identitas pribadi</h3><p>Data dasar calon mahasiswa</p></div></div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nik" class="form-label">NIK <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nik" name="nik" value="<?= old('nik') ?>" maxlength="16" pattern="[0-9]{16}" inputmode="numeric" placeholder="16 digit NIK" required>
                            <div class="invalid-feedback">NIK harus berisi 16 digit angka.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="nama_lengkap" class="form-label">Nama lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= old('nama_lengkap') ?>" maxlength="100" placeholder="Sesuai ijazah" required>
                            <div class="invalid-feedback">Nama lengkap wajib diisi.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="nama_panggilan" class="form-label">Nama panggilan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama_panggilan" name="nama_panggilan" value="<?= old('nama_panggilan') ?>" maxlength="50" placeholder="Nama yang biasa digunakan" required>
                            <div class="invalid-feedback">Nama panggilan wajib diisi.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="nama_panggilan" class="form-label">Nama panggilan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama_panggilan" name="nama_panggilan" value="<?= old('nama_panggilan') ?>" maxlength="50" placeholder="Nama yang biasa digunakan" required>
                            <div class="invalid-feedback">Nama panggilan wajib diisi.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="tempat_lahir" class="form-label">Tempat lahir <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?= old('tempat_lahir') ?>" maxlength="60" required>
                            <div class="invalid-feedback">Tempat lahir wajib diisi.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_lahir" class="form-label">Tanggal lahir <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= old('tanggal_lahir') ?>" max="<?= date('Y-m-d') ?>" required>
                            <div class="invalid-feedback">Tanggal lahir wajib diisi.</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label d-block">Jenis kelamin <span class="text-danger">*</span></label>
                            <div class="gender-options">
                                <input class="btn-check" type="radio" name="jenis_kelamin" id="laki_laki" value="Laki-laki" <?= checked('jenis_kelamin', 'Laki-laki') ?> required>
                                <label class="btn btn-outline-primary" for="laki_laki"><i class="bi bi-gender-male"></i> Laki-laki</label>
                                <input class="btn-check" type="radio" name="jenis_kelamin" id="perempuan" value="Perempuan" <?= checked('jenis_kelamin', 'Perempuan') ?> required>
                                <label class="btn btn-outline-primary" for="perempuan"><i class="bi bi-gender-female"></i> Perempuan</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="agama" class="form-label">Agama <span class="text-danger">*</span></label>
                            <select class="form-select" id="agama" name="agama" required>
                                <option value="">Pilih agama</option>
                                <?php foreach (['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu','Lainnya'] as $agama): ?>
                                    <option value="<?= e($agama) ?>" <?= selected('agama', $agama) ?>><?= e($agama) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">Pilih agama.</div>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <div class="form-section-title"><span>02</span><div><h3>Kontak dan alamat</h3><p>Informasi untuk komunikasi admisi</p></div></div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email aktif <span class="text-danger">*</span></label>
                            <div class="input-group"><span class="input-group-text"><i class="bi bi-envelope"></i></span><input type="email" class="form-control" id="email" name="email" value="<?= old('email') ?>" maxlength="100" placeholder="nama@email.com" required><div class="invalid-feedback">Masukkan email yang valid.</div></div>
                        </div>
                        <div class="col-md-6">
                            <label for="no_hp" class="form-label">Nomor WhatsApp <span class="text-danger">*</span></label>
                            <div class="input-group"><span class="input-group-text">+62</span><input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= old('no_hp') ?>" maxlength="15" pattern="[0-9]{9,15}" inputmode="numeric" placeholder="81234567890" required><div class="invalid-feedback">Gunakan 9–15 digit angka tanpa +62.</div></div>
                        </div>
                        <div class="col-12">
                            <label for="alamat" class="form-label">Alamat lengkap <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" maxlength="255" placeholder="Jalan, nomor rumah, kecamatan, kota/kabupaten" required><?= old('alamat') ?></textarea>
                            <div class="invalid-feedback">Alamat wajib diisi.</div>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <div class="form-section-title"><span>03</span><div><h3>Informasi pendidikan</h3><p>Asal sekolah dan pilihan studi</p></div></div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="asal_sekolah" class="form-label">Asal sekolah <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" value="<?= old('asal_sekolah') ?>" maxlength="120" placeholder="SMA/SMK/MA asal" required>
                            <div class="invalid-feedback">Asal sekolah wajib diisi.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="tahun_lulus" class="form-label">Tahun lulus <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="tahun_lulus" name="tahun_lulus" value="<?= old('tahun_lulus') ?>" min="2020" max="<?= date('Y') + 1 ?>" placeholder="2027" required>
                            <div class="invalid-feedback">Masukkan tahun lulus yang valid.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="program_studi" class="form-label">Program studi <span class="text-danger">*</span></label>
                            <select class="form-select" id="program_studi" name="program_studi" required>
                                <option value="">Pilih program studi</option>
                                <?php foreach (['Sistem Informasi','Teknik Informatika','Desain Komunikasi Visual','Manajemen','Akuntansi','Farmasi'] as $prodi): ?>
                                    <option value="<?= e($prodi) ?>" <?= selected('program_studi', $prodi) ?>><?= e($prodi) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">Pilih program studi.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="jalur_pendaftaran" class="form-label">Jalur pendaftaran <span class="text-danger">*</span></label>
                            <select class="form-select" id="jalur_pendaftaran" name="jalur_pendaftaran" required>
                                <option value="">Pilih jalur</option>
                                <?php foreach (['Reguler','Prestasi Akademik','Prestasi Nonakademik','Beasiswa'] as $jalur): ?>
                                    <option value="<?= e($jalur) ?>" <?= selected('jalur_pendaftaran', $jalur) ?>><?= e($jalur) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">Pilih jalur pendaftaran.</div>
                        </div>
                    </div>
                </div>

                <div class="form-check consent-box mb-4">
                    <input class="form-check-input" type="checkbox" value="1" id="persetujuan" name="persetujuan" required>
                    <label class="form-check-label" for="persetujuan">Saya menyatakan bahwa data yang diisi benar dan bersedia dihubungi oleh tim admisi. <span class="text-danger">*</span></label>
                    <div class="invalid-feedback">Persetujuan wajib diberikan.</div>
                </div>

                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
                    <p class="small text-secondary mb-0"><i class="bi bi-shield-lock me-1"></i> Data digunakan untuk proses penerimaan mahasiswa baru.</p>
                    <button type="submit" class="btn btn-primary btn-lg px-5">Kirim Pendaftaran <i class="bi bi-arrow-right ms-2"></i></button>
                </div>
            </form>
        </div>
    </div>
</main>

<footer class="py-4 mt-5"><div class="container text-center text-secondary small">&copy; <?= date('Y') ?> Kampus Cendekia · Proyek Praktikum PHP &amp; MySQL</div></footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/validation.js"></script>
</body>
</html>
<?php unset($_SESSION['old']); ?>
