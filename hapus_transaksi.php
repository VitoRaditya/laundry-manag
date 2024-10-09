<?php
session_start();

// Cek apakah pengguna memiliki akses sebagai admin atau kasir
if ($_SESSION['login'] != 'admin' && $_SESSION['login'] != 'kasir') {
    header("Location: index.php");
    exit();
}

// Koneksi ke database
include 'koneksi.php';

// Mengecek apakah ada parameter id yang dikirim melalui URL
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);

    // Hapus data dari tb_detail_transaksi yang terkait
    $query_detail = "DELETE FROM tb_detail_transaksi WHERE id_transaksi = '$id'";
    mysqli_query($koneksi, $query_detail);

    // Query untuk menghapus transaksi dari tb_transaksi
    $query = "DELETE FROM tb_transaksi WHERE id = '$id'";
    $result = mysqli_query($koneksi, $query);

    // Cek apakah query berhasil
    if ($result) {
        // Jika berhasil, arahkan kembali ke halaman transaksi dengan pesan sukses
        echo "<script>alert('Transaksi berhasil dihapus!'); window.location='transaksi.php';</script>";
    } else {
        // Jika gagal, tampilkan pesan error
        echo "<script>alert('Gagal menghapus transaksi!'); window.location='transaksi.php';</script>";
    }
} else {
    // Jika tidak ada ID yang dikirim, arahkan kembali ke halaman transaksi
    header("Location: transaksi.php");
    exit();
}
?>
