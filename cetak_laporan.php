<?php
include 'koneksi.php';

if (isset($_POST['tgl_awal'], $_POST['tgl_akhir'])) {
    $tgl_awal = mysqli_real_escape_string($koneksi, $_POST['tgl_awal']);
    $tgl_akhir = mysqli_real_escape_string($koneksi, $_POST['tgl_akhir']);
    
    // Pastikan nama kolom dari tb_paket sesuai
    $query = "
        SELECT 
            t.*, 
            dt.qty, 
            p.nama_paket  -- Ambil nama_paket dari tb_paket
        FROM 
            tb_transaksi t 
        LEFT JOIN 
            tb_detail_transaksi dt ON t.id = dt.id_transaksi 
        LEFT JOIN 
            tb_paket p ON dt.id_paket = p.id  -- Sesuaikan nama kolom dari tb_paket, ganti p.id_paket dengan p.id
        WHERE 
            t.tgl BETWEEN '$tgl_awal' AND '$tgl_akhir'
    ";
    $result = mysqli_query($koneksi, $query);
    $transaksi = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    echo "Tidak ada data yang ditemukan.";
    exit();
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Transaksi</title>
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
</header>
<body>
    <div class="container">
        <h2>Laporan Transaksi dari <?php echo $tgl_awal; ?> sampai <?php echo $tgl_akhir; ?></h2>
        <table class="registrasi-table">
            <thead>
                <tr>
                    <th>No. Laporan</th>
                    <th>ID Outlet</th>
                    <th>Kode Invoice</th>
                    <th>ID Member</th>
                    <th>Tanggal</th>
                    <th>Batas Waktu</th>
                    <th>Tanggal Bayar</th>
                    <th>Biaya Tambahan</th>
                    <th>Diskon</th>
                    <th>Pajak</th>
                    <th>Status</th>
                    <th>Dibayar</th>
                    <th>Total Harga</th>
                    <th>Qty</th> <!-- Kolom qty ditambahkan -->
                    <th>Nama Paket</th> <!-- Kolom Nama Paket ditambahkan -->
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                foreach ($transaksi as $item): ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $item['id_outlet']; ?></td>
                        <td><?php echo $item['kode_invoice']; ?></td>
                        <td><?php echo $item['id_member']; ?></td>
                        <td><?php echo $item['tgl']; ?></td>
                        <td><?php echo $item['batas_waktu']; ?></td>
                        <td><?php echo $item['tgl_bayar']; ?></td>
                        <td><?php echo $item['biaya_tambahan']; ?></td>
                        <td><?php echo $item['diskon']; ?></td>
                        <td><?php echo $item['pajak']; ?></td>
                        <td><?php echo $item['status']; ?></td>
                        <td><?php echo $item['dibayar']; ?></td>
                        <td><?php echo $item['total_harga']; ?></td>
                        <td><?php echo $item['qty']; ?></td> <!-- Kolom qty ditambahkan -->
                        <td><?php echo $item['nama_paket']; ?></td> <!-- Kolom Nama Paket ditambahkan -->
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
        window.onload = function() {
            window.print(); // Laporan otomatis siap untuk dicetak
        }
    </script>
</body>
</html>
