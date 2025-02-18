<?php
include 'koneksi.php';

// Ambil ID wali dari URL
$id_wali = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Jika ID tidak valid, kembalikan ke halaman utama
if ($id_wali <= 0) {
    header('Location: wali_murid.php');
    exit;
}

// Query untuk menghapus data wali
$query = "DELETE FROM wali_murid WHERE id_wali = ?";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "i", $id_wali);

if (mysqli_stmt_execute($stmt)) {
    echo "<script>alert('Data wali murid berhasil dihapus!'); window.location='wali_murid.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus data!'); window.location='wali_murid.php';</script>";
}

mysqli_stmt_close($stmt);
mysqli_close($koneksi);
?>
