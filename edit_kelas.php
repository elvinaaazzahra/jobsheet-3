<?php
include 'koneksi.php';

// Periksa apakah ada ID kelas yang dikirim
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('ID Kelas tidak ditemukan!'); window.location='kelas.php';</script>";
    exit();
}

$id_kelas = mysqli_real_escape_string($koneksi, $_GET['id']);

// Ambil data kelas berdasarkan ID
$query = "SELECT * FROM kelas WHERE id_kelas = '$id_kelas'";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) == 0) {
    echo "<script>alert('Kelas tidak ditemukan!'); window.location='kelas.php';</script>";
    exit();
}

$row = mysqli_fetch_assoc($result);

// Proses update kelas
if (isset($_POST['update_kelas'])) {
    $nama_kelas = mysqli_real_escape_string($koneksi, $_POST['nama_kelas']);

    if (!empty($nama_kelas)) {
        $update_query = "UPDATE kelas SET nama_kelas = '$nama_kelas' WHERE id_kelas = '$id_kelas'";
        if (mysqli_query($koneksi, $update_query)) {
            echo "<script>alert('Kelas berhasil diperbarui!'); window.location='kelas.php';</script>";
        } else {
            echo "<script>alert('Gagal memperbarui kelas!');</script>";
        }
    } else {
        echo "<script>alert('Nama Kelas tidak boleh kosong!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kelas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-4 text-center">Edit Kelas</h2>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nama Kelas</label>
                <input type="text" name="nama_kelas" class="form-control" value="<?= htmlspecialchars($row['nama_kelas']); ?>" required>
            </div>
            <button type="submit" name="update_kelas" class="btn btn-primary">Simpan Perubahan</button>
            <a href="kelas.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
