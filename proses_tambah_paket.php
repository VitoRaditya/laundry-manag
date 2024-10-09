<?php
session_start();
if ($_SESSION['login'] != 'admin') {
    header("Location: index.php");
    exit();
}

include 'koneksi.php';

if (isset($_POST['tambah'])) {
    $id_outlet = mysqli_real_escape_string($koneksi, $_POST['id_outlet']);
    $jenis = mysqli_real_escape_string($koneksi, $_POST['jenis']);
    $nama_paket = mysqli_real_escape_string($koneksi, $_POST['nama_paket']);
    $harga = mysqli_real_escape_string($koneksi, $_POST['harga']);

    $query = "INSERT INTO tb_paket (id_outlet, jenis, nama_paket, harga) VALUES ('$id_outlet', '$jenis', '$nama_paket', '$harga')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>alert('Data paket berhasil ditambahkan!');</script>";
        header("Location: paket.php");
    } else {
        echo "<script>alert('Gagal menambahkan data paket!');</script>";
    }
}
?>