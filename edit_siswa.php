<?php
include 'koneksi.php';

// Ambil data siswa berdasarkan ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_siswa = $id");
    $siswa = mysqli_fetch_assoc($result);

    if (!$siswa) {
        die("Data siswa tidak ditemukan.");
    }
}

// Jika form dikirim
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nis = $_POST['nis'];
    $nama_siswa = $_POST['nama_siswa'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $id_kelas = $_POST['id_kelas'];
    $id_wali = $_POST['id_wali'];

    // Update data siswa
    $query = "UPDATE siswa SET nis=?, nama_siswa=?, jenis_kelamin=?, tempat_lahir=?, tanggal_lahir=?, id_kelas=?, id_wali=? WHERE id_siswa=?";
    $stmt = mysqli_prepare($koneksi, $query);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssssssi", $nis, $nama_siswa, $jenis_kelamin, $tempat_lahir, $tanggal_lahir, $id_kelas, $id_wali, $id);
        if (mysqli_stmt_execute($stmt)) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}

// Ambil data kelas
$kelas_result = mysqli_query($koneksi, "SELECT * FROM kelas");

// Ambil data wali murid
$wali_result = mysqli_query($koneksi, "SELECT * FROM wali_murid");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-3">Edit Siswa</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="nis" class="form-label">NIS</label>
                <input type="text" class="form-control" id="nis" name="nis" value="<?= $siswa['nis']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="nama_siswa" class="form-label">Nama Siswa</label>
                <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="<?= $siswa['nama_siswa']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="L" <?= ($siswa['jenis_kelamin'] == 'L') ? 'selected' : ''; ?>>Laki-laki</option>
                    <option value="P" <?= ($siswa['jenis_kelamin'] == 'P') ? 'selected' : ''; ?>>Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?= $siswa['tempat_lahir']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= $siswa['tanggal_lahir']; ?>" required>
            </div>

            <!-- Dropdown Kelas -->
            <div class="mb-3">
                <label for="id_kelas" class="form-label">Kelas</label>
                <select class="form-select" id="id_kelas" name="id_kelas" required>
                    <?php while ($row = mysqli_fetch_assoc($kelas_result)) : ?>
                        <option value="<?= $row['id_kelas']; ?>" <?= ($siswa['id_kelas'] == $row['id_kelas']) ? 'selected' : ''; ?>><?= $row['nama_kelas']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <!-- Dropdown Wali Murid -->
            <div class="mb-3">
                <label for="id_wali" class="form-label">Wali Murid</label>
                <select class="form-select" id="id_wali" name="id_wali" required>
                    <?php while ($row = mysqli_fetch_assoc($wali_result)) : ?>
                        <option value="<?= $row['id_wali']; ?>" <?= ($siswa['id_wali'] == $row['id_wali']) ? 'selected' : ''; ?>><?= $row['nama_wali']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="index.php" class="btn btn-primary">Kembali</a>
        </form>
    </div>
</body>
</html>
