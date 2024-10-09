<?php
session_start();
if ($_SESSION['login'] != 'admin' && $_SESSION['login'] != 'kasir' && $_SESSION['login'] != 'owner') {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/transaksi.css">
</head>
<header>
    <div class="container">
        <div class="branding">
            <h1>Laporan Transaksi</h1>
            <h2>Pengelolaan Laundry</h2>
        </div>
    </div>
    <ul class="logout">
        <li><a href="logout.php">Logout</a></li>
    </ul>
    <ul class="home">
        <?php if ($_SESSION['login'] == 'admin') { ?>
            <li><a href="admin_dashboard.php">Home</a></li>
        <?php } elseif ($_SESSION['login'] == 'kasir') { ?>
            <li><a href="kasir_dashboard.php">Home</a></li>
        <?php } elseif ($_SESSION['login'] == 'owner') { ?>
            <li><a href="owner_dashboard.php">Home</a></li>
        <?php } ?>
    </ul>
</header>
<body>
<div class="container">
    <form method="POST" action="cetak_laporan.php" target="_blank">
        <label for="tgl_awal">Tanggal Awal:</label>
        <input type="date" id="tgl_awal" name="tgl_awal" required>

        <label for="tgl_akhir">Tanggal Akhir:</label>
        <input type="date" id="tgl_akhir" name="tgl_akhir" required>

        <button type="submit" name="generate">Generate Laporan</button>
    </form>
</div>

<footer>
    <p>Aplikasi Pengelolaan Laundry &copy; 2024</p>
</footer>
</body>
</html>
