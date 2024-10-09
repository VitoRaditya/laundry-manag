<?php
session_start();
if ($_SESSION['login'] != 'admin' && $_SESSION['login'] != 'kasir') {
    header("Location: index.php");
    exit();
}

include 'koneksi.php';

if (isset($_POST['tambah'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
    $tlp = mysqli_real_escape_string($koneksi, $_POST['tlp']);

    $query = "INSERT INTO tb_member (nama, alamat, jenis_kelamin, tlp) VALUES ('$nama', '$alamat', '$jenis_kelamin', '$tlp')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>alert('Data pelanggan berhasil ditambahkan!');</script>";
        header("Location: registrasi.php");
    } else {
        echo "<script>alert('Gagal menambahkan data pelanggan!');</script>";
    }
}
?>