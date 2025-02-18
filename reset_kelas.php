<?php
session_start();
include 'config.php'; // Pastikan file konfigurasi database sudah ada

// Pastikan hanya admin yang bisa mengakses
if (!isset($_SESSION['admin'])) {
    echo "Akses ditolak!";
    exit;
}

if (isset($_GET['kelas_id'])) {
    $kelas_id = $_GET['kelas_id'];
    
    // Hapus semua siswa dalam kelas tertentu
    $query = "UPDATE siswa SET kelas_id = NULL WHERE kelas_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $kelas_id);
    
    if ($stmt->execute()) {
        // Periksa apakah ada baris yang terpengaruh
        if ($stmt->affected_rows > 0) {
            echo "Data siswa dalam kelas berhasil direset.";
        } else {
            echo "Tidak ada data yang berubah. Pastikan kelas memiliki siswa.";
        }
    } else {
        echo "Gagal mereset data kelas. Kesalahan: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
} else {
    echo "ID kelas tidak ditemukan.";
}
?>
