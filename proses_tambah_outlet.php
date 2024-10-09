<?php
session_start();
if ($_SESSION['login'] != 'admin') {
    header("Location: index.php");
    exit();
}

include 'koneksi.php';

if (isset($_POST['tambah'])) {
    $nama_outlet = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $tlp = mysqli_real_escape_string($koneksi, $_POST['tlp']);

    $query = "INSERT INTO tb_outlet (nama, alamat, tlp) VALUES ('$nama_outlet', '$alamat', '$tlp')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>alert('Data outlet berhasil ditambahkan!');</script>";
        header("Location: outlet.php");
    } else {
        echo "<script>alert('Gagal menambahkan data outlet!');</script>";
    }
}
?>