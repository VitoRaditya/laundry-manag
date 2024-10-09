<?php
session_start();
if ($_SESSION['login'] != 'admin') {
    header("Location: index.php");
    exit();
}

include 'koneksi.php';

if (isset($_POST['tambah'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    $id_outlet = mysqli_real_escape_string($koneksi, $_POST['id_outlet']);
    $role = mysqli_real_escape_string($koneksi, $_POST['role']);

    $query = "INSERT INTO tb_user (nama, username, password, id_outlet, role) VALUES ('$nama', '$username', '$password', '$id_outlet', '$role')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>alert('Data pengguna berhasil ditambahkan!');</script>";
        header("Location: pengguna.php");
    } else {
        echo "<script>alert('Gagal menambahkan data pengguna!');</script>";
    }
}
?>