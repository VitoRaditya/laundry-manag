<?php
session_start();
if ($_SESSION['login'] != 'admin') {
    header("Location: index.php");
    exit();
}

include 'koneksi.php';

$id = $_GET['id'];
$query = "DELETE FROM tb_user WHERE id = '$id'";
$result = mysqli_query($koneksi, $query);

if ($result) {
    echo "<script>alert('Data pengguna berhasil dihapus!');</script>";
    header("Location: pengguna.php");
} else {
    echo "<script>alert('Gagal hapus data pengguna!');</script>";
}
?>