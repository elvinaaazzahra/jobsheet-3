<?php
include 'koneksi.php';

// Ambil ID wali dari URL
$id_wali = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Jika ID tidak valid, kembalikan ke halaman utama
if ($id_wali <= 0) {
    header('Location: wali_murid.php');
    exit;
}

// Query untuk mendapatkan data wali berdasarkan ID
$query = "SELECT * FROM wali_murid WHERE id_wali = ?";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "i", $id_wali);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Jika data ditemukan
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $nama_wali = $row['nama_wali'];
    $kontak = $row['kontak'];
} else {
    echo "<script>alert('Data wali tidak ditemukan!'); window.location='wali_murid.php';</script>";
    exit;
}

// Proses update data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_wali = mysqli_real_escape_string($koneksi, $_POST['nama_wali']);
    $kontak = mysqli_real_escape_string($koneksi, $_POST['kontak']);

    $query_update = "UPDATE wali_murid SET nama_wali = ?, kontak = ? WHERE id_wali = ?";
    $stmt_update = mysqli_prepare($koneksi, $query_update);
    mysqli_stmt_bind_param($stmt_update, "ssi", $nama_wali, $kontak, $id_wali);

    if (mysqli_stmt_execute($stmt_update)) {
        echo "<script>alert('Data wali murid berhasil diperbarui!'); window.location='wali_murid.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data!');</script>";
    }

    mysqli_stmt_close($stmt_update);
}

mysqli_stmt_close($stmt);
mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Wali Murid</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-3">Edit Wali Murid</h2>
        <form method="POST" action="edit_wali.php?id=<?php echo $id_wali; ?>">
            <div class="mb-3">
                <label class="form-label">Nama Wali</label>
                <input type="text" name="nama_wali" class="form-control" value="<?php echo htmlspecialchars($nama_wali); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">No. Telepon</label>
                <input type="text" name="kontak" class="form-control" value="<?php echo htmlspecialchars($kontak); ?>" required>
            </div>
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            <a href="wali_murid.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/bootstrap.bundle.min.js"></script>
</body>
</html>
