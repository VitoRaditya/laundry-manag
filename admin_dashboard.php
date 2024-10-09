<?php
session_start();
if ($_SESSION['login'] != 'admin') {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/registrasi.css">
</head>
<body>
<header>
    <div class="container">
        <div class="branding">
            <h1>Admin Dashboard</h1>
            <h2>Pengelolaan Laundry</h2>
        </div>
    </div>
    <ul class="logout">
        <li><a href="logout.php">Logout</a></li>
    </ul>
</header>

    <nav>
        <ul>
            <li><a href="registrasi.php">Registrasi Pelanggan</a></li>
            <li><a href="outlet.php">CRUD Outlet</a></li>
            <li><a href="paket.php">CRUD Produk/Paket Cucian</a></li>
            <li><a href="pengguna.php">CRUD Pengguna</a></li>
            <li><a href="transaksi.php">Entri Transaksi</a></li>
            <li><a href="laporan.php">Generate Laporan</a></li>
        </ul>
    </nav>

    <div class="container">
        <div class="dashboard-content">
            <h2>Selamat datang, Admin!</h2>
            <p>Gunakan navigasi di atas untuk mengakses fitur sesuai hak akses Anda.</p>
        </div>
    </div>

    <footer>
        <p>Aplikasi Pengelolaan Laundry &copy; 2024</p>
    </footer>
</body>
</html>
