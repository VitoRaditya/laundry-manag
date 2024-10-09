<?php
session_start();
if ($_SESSION['login'] != 'admin' && $_SESSION['login'] != 'kasir') {
    header("Location: index.php");
    exit();
}

include 'koneksi.php';

// Cek apakah ada parameter id yang dikirim melalui URL
if (isset($_GET['id'])) {
    $id_transaksi = mysqli_real_escape_string($koneksi, $_GET['id']);

    // Query untuk mengambil data detail transaksi berdasarkan ID transaksi
    $query = "SELECT dt.*, p.nama_paket 
              FROM tb_detail_transaksi dt 
              JOIN tb_paket p ON dt.id_paket = p.id 
              WHERE dt.id_transaksi = '$id_transaksi'";
    
    $result = mysqli_query($koneksi, $query);
    
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/registrasi.css">
</head>
<header>
    <div class="container">
        <div class="branding">
            <h1>Detail Transaksi</h1>
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
        <h2>Detail Transaksi</h2>
        <table class="registrasi-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Paket</th>
                    <th>Qty</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0) { ?>
                    <?php while ($detail = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $detail['id']; ?></td>
                            <td><?php echo $detail['nama_paket']; ?></td>
                            <td><?php echo $detail['qty']; ?></td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="3">Tidak ada detail transaksi ditemukan.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <footer>
        <p>Aplikasi Pengelolaan Laundry &copy; 2024</p>
    </footer>
</body>
</html>

<?php
// Tutup koneksi database
mysqli_close($koneksi);
?>
