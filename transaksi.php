<?php
session_start();
if ($_SESSION['login'] != 'admin' && $_SESSION['login'] != 'kasir') {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/transaksi.css">
</head>
<header>
    <div class="container">
        <div class="branding">
            <h1>Transaksi Dashboard</h1>
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
        <h2>Transaksi</h2>
        <table class="registrasi-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>ID Outlet</th>
                    <th>Kode Invoice</th>
                    <th>ID Member</th>
                    <th>Tanggal</th>
                    <th>Batas Waktu</th>
                    <th>Tanggal Bayar</th>
                    <th>Biaya Tambahan</th>
                    <th>Diskon (%)</th>
                    <th>Pajak (%)</th>
                    <th>Status</th>
                    <th>Dibayar</th>
                    <th>ID User</th>
                    <th>Total Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'koneksi.php';
                $query = "SELECT *, total_harga FROM tb_transaksi";
                $result = mysqli_query($koneksi, $query);
                $no = 1;
                while ($data = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $data['id_outlet']; ?></td>
                        <td><?php echo $data['kode_invoice']; ?></td>
                        <td><?php echo $data['id_member']; ?></td>
                        <td><?php echo $data['tgl']; ?></td>
                        <td><?php echo $data['batas_waktu']; ?></td>
                        <td><?php echo $data['tgl_bayar']; ?></td>
                        <td><?php echo number_format($data['biaya_tambahan'], 0, ',', '.'); ?></td>
                        <td><?php echo number_format($data['diskon'], 0, ',', '.'); ?></td>
                        <td><?php echo number_format($data['pajak'], 0, ',', '.'); ?></td>
                        <td><?php echo $data['status']; ?></td>
                        <td><?php echo $data['dibayar']; ?></td>
                        <td><?php echo $data['id_user']; ?></td>
                        <td><?php echo number_format($data['total_harga'], 0, ',', '.'); ?></td>
                        <td>
                            <a href="edit_transaksi.php?id=<?php echo $data['id']; ?>">Edit</a> |
                            <a href="hapus_transaksi.php?id=<?php echo $data['id']; ?>">Hapus</a> |
                            <a href="detail_transaksi.php?id=<?php echo $data['id']; ?>">Detail</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <a href="tambah_transaksi.php">Tambah Transaksi</a>
    </div>

    <footer>
        <p>Aplikasi Pengelolaan Laundry &copy; 2024</p>
    </footer>
</body>
</html>
