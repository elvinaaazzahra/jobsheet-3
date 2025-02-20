<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id_kelas = $_GET['id'];

    $query = "DELETE FROM kelas WHERE id_kelas = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "i", $id_kelas);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Kelas berhasil dihapus!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus kelas!');</script>";
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($koneksi);
?>

