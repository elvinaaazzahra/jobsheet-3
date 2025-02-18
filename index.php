<?php
include 'koneksi.php';

$search = isset($_GET['search']) ? $_GET['search'] : '';

$search_query = $search ? "WHERE siswa.nama_siswa LIKE '%$search%'" : '';

$limit = 10;  

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;  

$query = "SELECT siswa.*, kelas.nama_kelas, wali_murid.nama_wali 
          FROM siswa 
          LEFT JOIN kelas ON siswa.id_kelas = kelas.id_kelas
          LEFT JOIN wali_murid ON siswa.id_wali = wali_murid.id_wali
          $search_query LIMIT $start, $limit";


$result = mysqli_query($koneksi, $query);

$total_result = mysqli_query($koneksi, "SELECT COUNT(*) as total 
                                        FROM siswa 
                                        LEFT JOIN wali_murid ON siswa.id_wali = wali_murid.id_wali
                                        $search_query");
$row_total = mysqli_fetch_assoc($total_result);
$total_rows = $row_total['total'];

$total_pages = ceil($total_rows / $limit);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h2 class="mb-3">Data Siswa</h2>
        <div class="d-flex mb-3">
        <a href="kelas.php" class="btn btn-primary">Kelola Kelas</a>
        <a href="wali_murid.php" class="btn btn-primary ms-1">Kelola Wali Murid</a>
            <form method="GET" class="d-flex ms-auto">
                <input type="text" name="search" class="form-control me-2" placeholder="Cari siswa..." value="<?php echo $search; ?>">
                <button type="submit" class="btn btn-success">Cari</button>
            </form>
            <a href="tambah_siswa.php" class="btn btn-success ms-auto">Tambah Siswa</a>
        </div>

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Kelas</th>
                    <th>Wali</th>
                    <th>Aksi</th>                
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td><?php echo $row['nis']; ?></td>
                        <td><?php echo $row['nama_siswa']; ?></td>
                        <td><?php echo $row['jenis_kelamin']; ?></td>
                        <td><?php echo $row['tempat_lahir']; ?></td>
                        <td><?php echo $row['tanggal_lahir']; ?></td>
                        <td><?php echo $row['nama_kelas']; ?></td>
                        <td><?php echo $row['nama_wali']; ?></td>
                        <td>
                            <a href="edit_siswa.php?id=<?php echo $row['id_siswa']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="hapus_siswa.php?id=<?php echo $row['id_siswa']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <nav>
            <ul class="pagination">
                <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                    <li class="page-item <?php if ($page == $i) echo 'active'; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo $search; ?>"> <?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>       
</body>

</html>