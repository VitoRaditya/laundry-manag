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
    <title>Outlet</title>
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
        <?php if ($_SESSION['login'] == 'admin') { ?>
            <li><a href="admin_dashboard.php">Home</a></li>
        <?php } elseif ($_SESSION['login'] == 'kasir') { ?>
            <li><a href="kasir_dashboard.php">Home</a></li>
        <?php } ?>
    </ul>
</header>
<body>
    <div class="container">
        <h2>Outlet</h2>
        <table class="registrasi-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Outlet</th>
                    <th>Alamat</th>
                    <th>No. Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'koneksi.php';
                $query = "SELECT * FROM tb_outlet";
                $result = mysqli_query($koneksi, $query);
                $no = 1;
                while ($data = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $data['nama']; ?></td>
                        <td><?php echo $data['alamat']; ?></td>
                        <td><?php echo $data['tlp']; ?></td>
                        <td>
                            <a href="edit_outlet.php?id=<?php echo $data['id']; ?>">Edit</a> |
                            <a href="hapus_outlet.php?id=<?php echo $data['id']; ?>">Hapus</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <a href="tambah_outlet.php">Tambah Outlet</a>
    </div>

    <footer>
        <p>Aplikasi Pengelolaan Laundry &copy; 2024</p>
    </footer>
</body>
</html>