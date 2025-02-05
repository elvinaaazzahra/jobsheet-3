<?php
include 'koneksi.php';

// Ambil data kelas
$search = isset($_GET['search']) ? $_GET['search'] : '';

if (isset($_GET['reset'])) {
    header("Location: kelas.php");
    exit();
}

// Query ambil data kelas (diurutkan berdasarkan id_kelas)
$query = "SELECT * FROM kelas ORDER BY id_kelas ASC";
if (!empty($search)) {
    $query = "SELECT * FROM kelas WHERE nama_kelas LIKE '%$search%' ORDER BY id_kelas ASC";
}
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kelas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-4 text-center">Kelola Kelas</h2>

        <!-- Navigasi & Pencarian -->
        <div class="d-flex justify-content-between mb-3">
            <a href="index.php" class="btn btn-secondary">Kembali ke Data Siswa</a>

            <form method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Cari Nama Kelas" value="<?= htmlspecialchars($search) ?>">
                <button type="submit" class="btn btn-success">Cari</button>
                <a href="?reset=1" class="btn btn-danger ms-2">Reset</a>
            </form>
        </div>

        <!-- Form Tambah Kelas -->
        <form method="POST" action="tambah_kelas.php" class="mb-4">
            <div class="mb-3">
                <label class="form-label">Nama Kelas</label>
                <input type="text" name="nama_kelas" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Tambah Kelas</button>
        </form>

        <!-- Tabel Data Kelas -->
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>No</th> <!-- Tambah Kolom Nomor Urut -->
                    <th>Nama Kelas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1; // Inisialisasi nomor urut
                while ($row = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td><?php echo $no++; ?></td> <!-- Menampilkan nomor urut manual -->
                        <td><?php echo $row['nama_kelas']; ?></td>
                        <td>
                            <a href="edit_kelas.php?id=<?php echo $row['id_kelas']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="hapus_kelas.php?id=<?php echo $row['id_kelas']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus kelas ini?');">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

