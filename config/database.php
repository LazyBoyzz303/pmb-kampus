<?php
declare(strict_types=1);

// Sesuaikan nilai berikut dengan konfigurasi MySQL di komputer masing-masing.
const DB_HOST = 'localhost';
const DB_PORT = '3306';
const DB_NAME = 'db_pmb_kampus';
const DB_USER = 'root';
const DB_PASS = '';

function getConnection(): PDO
{
    $dsn = sprintf(
        'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
        DB_HOST,
        DB_PORT,
        DB_NAME
    );

    return new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
}
