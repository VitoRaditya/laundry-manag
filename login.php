<?php
session_start();
include 'koneksi.php';

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    $query = "SELECT * FROM tb_user WHERE username='$username' AND password='$password'";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_assoc($result);

    if ($data) {
        $_SESSION['login'] = $data['role'];
        $_SESSION['user_id'] = $data['id'];

        if ($data['role'] == 'admin') {
            header("Location: admin_dashboard.php");
        } elseif ($data['role'] == 'kasir') {
            header("Location: kasir_dashboard.php");
        } else {
            header("Location: owner_dashboard.php");
        }
    } else {
        echo "<script>alert('Username atau password salah');</script>";
    }
}
?>
