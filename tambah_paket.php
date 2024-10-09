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
    <title>Tambah Paket</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/registrasi.css">
</head>
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
    <ul class="home">
        <li><a href="admin_dashboard.php">Home</a></li>
    </ul>
</header>
<body>
    <div class="container">
        <h2>Tambah Paket</h2>
        <form method="POST" action="proses_tambah_paket.php">
            <label for="id_outlet">Outlet:</label>
            <select name="id_outlet" required>
                <?php
                include 'koneksi.php';
                $query = "SELECT * FROM tb_outlet";
                $result = mysqli_query($koneksi, $query);
                while ($data = mysqli_fetch_assoc($result)) {
                    ?>
                    <option value="<?php echo $data['id']; ?>"><?php echo $data['nama']; ?></option>
                    <?php
                }
                ?>
            </select>

            <label for="jenis">Jenis:</label>
            <select name="jenis" required>
                <option value="kiloan">Kiloan</option>
                <option value="selimut">Selimut</option>
                <option value="bed_cover">Bed Cover</option>
                <option value="kaos">Kaos</option>
                <option value="lain">Lain</option>
            </select>

            <label for="nama_paket">Nama Paket:</label>
            <input type="text" name="nama_paket" required>

            <label for="harga">Harga:</label>
            <input type="number" name="harga" required>

            <button type="submit" name="tambah">Tambah</button>
        </form>
    </div>

    <footer>
        <p>Aplikasi Pengelolaan Laundry &copy; 2024</p>
    </footer>
</body>
</html>