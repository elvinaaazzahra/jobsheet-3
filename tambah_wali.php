<?php
// Menyertakan koneksi ke database
include 'koneksi.php';

// Proses tambah data wali murid
if (isset($_POST['tambah_wali'])) {
    // Mengambil data dari form
    $nama_wali = mysqli_real_escape_string($koneksi, $_POST['nama_wali']);
    $kontak = mysqli_real_escape_string($koneksi, $_POST['kontak']);
    
    // Cek apakah data tidak kosong
    if (!empty($nama_wali) && !empty($kontak)) {
        // Query untuk menambah data wali murid
        $insert_query = "INSERT INTO wali_murid (nama_wali, kontak) VALUES (?, ?)";
        $stmt = mysqli_prepare($koneksi, $insert_query);
        
        // Menyambungkan parameter dengan prepared statement
        mysqli_stmt_bind_param($stmt, "ss", $nama_wali, $kontak);
        
        // Menjalankan query
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Wali Murid berhasil ditambahkan!'); window.location='wali_murid.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan wali murid!');</script>";
        }
        
        // Menutup prepared statement
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Semua kolom harus diisi!');</script>";
    }
}

// Menutup koneksi
mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Wali Murid</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f7f7f7;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background: linear-gradient(145deg, #ffffff, #e6e6e6);
        }
        .card-header {
            background-color: #6c63ff;
            color: white;
            border-radius: 20px 20px 0 0;
            padding: 15px;
            font-size: 24px;
            font-weight: bold;
            text-align: center;
        }
        .card-body {
            padding: 25px;
        }
        .form-label {
            font-weight: 600;
            color: #333;
        }
        .btn-custom {
            background-color: #6c63ff;
            color: white;
            border-radius: 30px;
            padding: 12px 25px;
            border: none;
            transition: background-color 0.3s;
        }
        .btn-custom:hover {
            background-color: #5a53e6;
        }
        .form-control {
            border-radius: 12px;
            padding: 10px;
            border: 1px solid #dcdcdc;
        }
        .form-control:focus {
            border-color: #6c63ff;
            box-shadow: 0 0 5px rgba(108, 99, 255, 0.5);
        }
        .footer {
            text-align: center;
            padding: 10px;
            background-color: #f1f1f1;
            border-radius: 0 0 20px 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5 d-flex justify-content-center">
        <div class="card" style="width: 100%; max-width: 500px;">
            <div class="card-header">
                Tambah Wali Murid
            </div>
            <div class="card-body">
                <!-- Form untuk tambah wali murid -->
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Nama Wali</label>
                        <input type="text" name="nama_wali" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor Telepon</label>
                        <input type="text" name="kontak" class="form-control" required>
                    </div>
                    <button type="submit" name="tambah_wali" class="btn btn-custom w-100">Tambah</button>
                </form>
            </div>
            <div class="footer">
                <a href="wali_murid.php" class="btn btn-outline-secondary" style="border-radius: 30px;">Kembali</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/bootstrap.bundle.min.js"></script>
</body>
</html>
