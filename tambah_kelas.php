<?php
include 'koneksi.php';

if (isset($_POST['tambah'])) {
    $nama_kelas = mysqli_real_escape_string($koneksi, $_POST['nama_kelas']);

    if (!empty($nama_kelas)) {
        $query = "INSERT INTO kelas (nama_kelas) VALUES (?)";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "s", $nama_kelas);

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Kelas berhasil ditambahkan!'); window.location='index.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan kelas!');</script>";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Nama kelas tidak boleh kosong!');</script>";
    }
}


mysqli_close($koneksi);
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
    <div class="container mt-5">
        <h3>Tambah Kelas</h3>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nama Kelas</label>
                <input type="text" name="nama_kelas" class="form-control" required>
            </div>
            <button type="submit" name="tambah" class="btn btn-success">Tambah</button>
            <a href="kelas.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>
