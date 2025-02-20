<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id_kelas = $_GET['id'];

    // Ambil data kelas berdasarkan ID
    $query = "SELECT * FROM kelas WHERE id_kelas = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "i", $id_kelas);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
}

if (isset($_POST['update'])) {
    $nama_kelas = mysqli_real_escape_string($koneksi, $_POST['nama_kelas']);

    if (!empty($nama_kelas)) {
        $query = "UPDATE kelas SET nama_kelas = ? WHERE id_kelas = ?";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "si", $nama_kelas, $id_kelas);

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Kelas berhasil diperbarui!'); window.location='kelas.php';</script>";
        } else {
            echo "<script>alert('Gagal memperbarui kelas!');</script>";
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
    <title>Edit Kelas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h3>Edit Kelas</h3>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nama Kelas</label>
                <input type="text" name="nama_kelas" class="form-control" value="<?php echo htmlspecialchars($data['nama_kelas']); ?>" required>
            </div>
            <button type="submit" name="update" class="btn btn-warning">Update</button>
            <a href="kelas.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>


</body>
</html>
