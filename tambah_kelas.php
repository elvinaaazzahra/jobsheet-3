<?php
include 'koneksi.php';

// Cek apakah form sudah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_kelas = trim(mysqli_real_escape_string($koneksi, $_POST['nama_kelas']));

    if (!empty($nama_kelas)) {
        $insert_query = "INSERT INTO kelas (nama_kelas) VALUES ('$nama_kelas')";

        if (mysqli_query($koneksi, $insert_query)) {
            echo "<script>alert('Kelas berhasil ditambahkan!'); window.location='kelas.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan kelas!'); window.location='kelas.php';</script>";
        }
    } else {
        echo "<script>alert('Nama kelas tidak boleh kosong!'); window.location='kelas.php';</script>";
    }
}

// Tutup koneksi
mysqli_close($koneksi);
?>
