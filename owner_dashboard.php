<?php
session_start();
if ($_SESSION['login'] != 'owner') {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/registrasi.css">
</head>
<body>
    <header>
    <div class="container">
        <div class="branding">
            <h1>Owner Dashboard</h1>
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

    <nav>
        <ul>
            <li><a href="laporan.php">Generate Laporan</a></li>
        </ul>
    </nav>

    <div class="container">
        <div class="dashboard-content">
            <h2>Selamat datang, Owner!</h2>
            <p>Gunakan navigasi di atas untuk mengakses fitur sesuai hak akses Anda.</p>
        </div>
    </div>

    <footer>
        <p>Aplikasi Pengelolaan Laundry &copy; 2024</p>
    </footer>
</body>
</html>
