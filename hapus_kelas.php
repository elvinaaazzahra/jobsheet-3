<?php
include 'koneksi.php';

// Periksa apakah ID dikirim
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('ID Kelas tidak ditemukan!'); window.location='kelas.php';</script>";
    exit();
}

$id_kelas = mysqli_real_escape_string($koneksi, $_GET['id']);

// Periksa apakah kelas dengan ID tersebut ada
$query = "SELECT * FROM kelas WHERE id_kelas = '$id_kelas'";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) == 0) {
    echo "<script>alert('Kelas tidak ditemukan!'); window.location='kelas.php';</script>";
    exit();
}

// Hapus data kelas
$delete_query = "DELETE FROM kelas WHERE id_kelas = '$id_kelas'";
if (mysqli_query($koneksi, $delete_query)) {
    echo "<script>alert('Kelas berhasil dihapus!'); window.location='kelas.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus kelas!'); window.location='kelas.php';</script>";
}
exit();
?>

