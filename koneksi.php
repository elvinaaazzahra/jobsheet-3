<?php
// Aktifkan mode error reporting MySQLi
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Konfigurasi koneksi database
$host = "localhost";
$user = "root"; // Sesuaikan dengan username database Anda
$password = ""; // Jika ada password, isi di sini
$database = "sekolah"; // Sesuaikan dengan nama database Anda

// Membuat koneksi ke database
$koneksi = mysqli_connect($host, $user, $password, $database);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Menambahkan pengaturan charset ke UTF-8
mysqli_set_charset($koneksi, "utf8mb4");
?>

