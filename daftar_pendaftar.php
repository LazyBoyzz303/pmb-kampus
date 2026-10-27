<?php
declare(strict_types=1);
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/functions.php';

$registrants = [];
$databaseError = null;

try {
    $pdo = getConnection();
    $registrants = $pdo->query('SELECT id_pendaftar, nik, nama_lengkap, asal_sekolah, program_studi, jalur_pendaftaran, tanggal_daftar FROM pendaftar ORDER BY id_pendaftar DESC')->fetchAll();
} catch (PDOException $exception) {
    $databaseError = 'Database belum dapat diakses. Periksa config/database.php dan impor database/db_pmb.sql.';
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Pendaftar · PMB Kampus Cendekia</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body class="dashboard-body">
<nav class="navbar navbar-dark py-3"><div class="container"><a class="navbar-brand fw-bold" href="index.php"><span class="brand-mark"><i class="bi bi-mortarboard-fill"></i></span> Kampus Cendekia</a><a class="btn btn-light btn-sm px-3" href="index.php"><i class="bi bi-arrow-left me-1"></i> Formulir</a></div></nav>
<main class="container py-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3 mb-4">
        <div><span class="section-kicker">DASHBOARD SEDERHANA</span><h1 class="fw-bold mb-1">Data Pendaftar</h1><p class="text-secondary mb-0">Data terbaru ditampilkan di bagian paling atas.</p></div>
        <span class="badge text-bg-primary fs-6 px-3 py-2"><?= count($registrants) ?> pendaftar</span>
    </div>
    <?php if ($databaseError): ?><div class="alert alert-warning"><i class="bi bi-database-exclamation me-2"></i><?= e($databaseError) ?></div><?php endif; ?>
    <div class="card border-0 shadow-sm overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead><tr><th>No.</th><th>Nomor PMB</th><th>Nama</th><th>Asal Sekolah</th><th>Program Studi</th><th>Jalur</th><th>Tanggal Daftar</th></tr></thead>
                <tbody>
                <?php if (!$registrants): ?>
                    <tr><td colspan="7" class="text-center py-5 text-secondary"><i class="bi bi-inbox fs-1 d-block mb-2"></i>Belum ada data pendaftar.</td></tr>
                <?php else: foreach ($registrants as $index => $row): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><span class="registration-number">PMB-<?= date('Y', strtotime($row['tanggal_daftar'])) ?>-<?= str_pad((string) $row['id_pendaftar'], 4, '0', STR_PAD_LEFT) ?></span></td>
                        <td><strong><?= e($row['nama_lengkap']) ?></strong><div class="small text-secondary"><?= e(substr($row['nik'], 0, 4)) ?>********<?= e(substr($row['nik'], -4)) ?></div></td>
                        <td><?= e($row['asal_sekolah']) ?></td>
                        <td><?= e($row['program_studi']) ?></td>
                        <td><span class="badge rounded-pill text-bg-light border"><?= e($row['jalur_pendaftaran']) ?></span></td>
                        <td><?= date('d-m-Y H:i', strtotime($row['tanggal_daftar'])) ?></td>
                    </tr>
                <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
</body>
</html>
