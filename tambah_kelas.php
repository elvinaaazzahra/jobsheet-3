<?php
include 'koneksi.php';

// Cek apakah form sudah disubmit
if (isset($_POST['tambah_kelas'])) {
    $nama_kelas = mysqli_real_escape_string($koneksi, $_POST['nama_kelas']);

    // Query untuk menambahkan kelas baru ke database
    $insert_query = "INSERT INTO kelas (nama_kelas) VALUES ('$nama_kelas')";
   
    if (mysqli_query($koneksi, $insert_query)) {
        // Redirect ke kelas.php yang benar
        echo "<script>alert('Kelas berhasil ditambahkan!'); window.location='kelas.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan kelas!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kelas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-4 text-center">Tambah Kelas Baru</h2>

        <!-- Form untuk Menambahkan Kelas -->
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nama Kelas</label>
                <input type="text" name="nama_kelas" class="form-control" required>
            </div>
            <button type="submit" name="tambah_kelas" class="btn btn-success">Tambah Kelas</button>
            <a href="kelas.php" class="btn btn-secondary ms-2">Kembali ke Kelola Kelas</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
