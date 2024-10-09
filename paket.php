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
    <title>Produk/Paket Cucian</title>
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
        <h2>Produk/Paket Cucian</h2>
        <table class="registrasi-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Paket</th>
                    <th>Jenis</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'koneksi.php';
                $query = "SELECT * FROM tb_paket";
                $result = mysqli_query($koneksi, $query);
                $no = 1;
                while ($data = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $data['nama_paket']; ?></td>
                        <td><?php echo $data['jenis']; ?></td>
                        <td><?php echo $data['harga']; ?></td>
                        <td>
                            <a href="edit_paket.php?id=<?php echo $data['id']; ?>">Edit</a> |
                            <a href="hapus_paket.php?id=<?php echo $data['id']; ?>">Hapus</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <a href="tambah_paket.php">Tambah Paket</a>
    </div>

    <footer>
        <p>Aplikasi Pengelolaan Laundry &copy; 2024</p>
    </footer>
</body>
</html>