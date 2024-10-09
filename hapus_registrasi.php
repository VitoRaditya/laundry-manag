<?php
session_start();
if ($_SESSION['login'] != 'admin' && $_SESSION['login'] != 'kasir') {
    header("Location: index.php");
    exit();
}

include 'koneksi.php';

$id = $_GET['id'];
$query = "DELETE FROM tb_member WHERE id = '$id'";
$result = mysqli_query($koneksi, $query);

if ($result) {
    echo "<script>alert('Data pelanggan berhasil dihapus!');</script>";
    header("Location: registrasi.php");
} else {
    echo "<script>alert('Gagal hapus data pelanggan!');</script>";
}
?>