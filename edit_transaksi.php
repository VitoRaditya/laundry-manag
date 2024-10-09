<?php
session_start();
if ($_SESSION['login'] != 'admin' && $_SESSION['login'] != 'kasir') {
    header("Location: index.php");
    exit();
}

include 'koneksi.php';

// Cek apakah ada parameter id yang dikirim melalui URL
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);

    // Query untuk mengambil data transaksi berdasarkan ID
    $query = "SELECT * FROM tb_transaksi WHERE id = '$id'";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_assoc($result);

    // Ambil detail transaksi untuk mendapatkan qty dan id_paket
    $query_detail = "SELECT * FROM tb_detail_transaksi WHERE id_transaksi = '$id'";
    $result_detail = mysqli_query($koneksi, $query_detail);
    $detail = mysqli_fetch_assoc($result_detail);
}

// Ambil harga paket dari database sesuai id_paket
$id_paket = $detail['id_paket'];
$query_paket = "SELECT harga FROM tb_paket WHERE id = '$id_paket'";
$result_paket = mysqli_query($koneksi, $query_paket);
$paket = mysqli_fetch_assoc($result_paket);
$harga_paket = $paket['harga'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaksi</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/registrasi.css">
    <script>
        function hitungTotal() {
            let hargaPaket = document.getElementById('harga_paket').value || 0;
            let qty = document.getElementById('qty').value || 1;
            let diskon = document.getElementById('diskon').value || 0;
            let pajak = document.getElementById('pajak').value || 0;
            let biayaTambahan = document.getElementById('biaya_tambahan').value || 0;

            // Perhitungan harga berdasarkan qty
            let totalHargaPaket = hargaPaket * qty;

            diskon = (diskon / 100) * totalHargaPaket;
            pajak = (pajak / 100) * totalHargaPaket;

            let totalHarga = (totalHargaPaket - diskon) + pajak + parseInt(biayaTambahan);
            document.getElementById('total_harga').value = totalHarga;
        }
    </script>
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
        <h2>Form Edit Transaksi</h2>
        <form method="POST" action="proses_edit_transaksi.php">
            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
            <input type="hidden" id="id_outlet" name="id_outlet" value="<?php echo $data['id_outlet']; ?>">
            <input type="hidden" id="harga_paket" name="harga_paket" value="<?php echo $harga_paket; ?>" oninput="hitungTotal()" readonly>

            <label for="id_member">Member:</label>
            <select name="id_member" id="id_member" required>
                <option value="">Pilih Member</option>
                <?php
                $member_query = "SELECT * FROM tb_member";
                $member_result = mysqli_query($koneksi, $member_query);
                while ($member = mysqli_fetch_assoc($member_result)) {
                    $selected = ($member['id'] == $data['id_member']) ? 'selected' : '';
                    echo "<option value='{$member['id']}' $selected>{$member['nama']}</option>";
                }
                ?>
            </select>

            <label for="qty">Jumlah (Qty):</label>
            <input type="number" id="qty" name="qty" value="<?php echo $detail['qty']; ?>" oninput="hitungTotal()" required>

            <label for="diskon">Diskon (%):</label>
            <input type="number" id="diskon" name="diskon" value="<?php echo $data['diskon']; ?>" oninput="hitungTotal()" required>

            <label for="pajak">Pajak (%):</label>
            <input type="number" id="pajak" name="pajak" value="<?php echo $data['pajak']; ?>" oninput="hitungTotal()" required>

            <label for="biaya_tambahan">Biaya Tambahan:</label>
            <input type="number" id="biaya_tambahan" name="biaya_tambahan" value="<?php echo $data['biaya_tambahan']; ?>" oninput="hitungTotal()" required>

            <label for="total_harga">Total Harga:</label>
            <input type="number" id="total_harga" name="total_harga" value="<?php echo $data['total_harga']; ?>"readonly >

            <label for="kode_invoice">Kode Invoice:</label>
            <input type="text" id="kode_invoice" name="kode_invoice" value="<?php echo $data['kode_invoice']; ?>" required>

            <label for="tgl">Tanggal:</label>
            <input type="datetime-local" id="tgl" name="tgl" value="<?php echo $data['tgl']; ?>" required>

            <label for="batas_waktu">Batas Waktu:</label>
            <input type="datetime-local" id="batas_waktu" name="batas_waktu" value="<?php echo $data['batas_waktu']; ?>" required>

            <label for="tgl_bayar">Tanggal Bayar:</label>
            <input type="datetime-local" id="tgl_bayar" name="tgl_bayar" value="<?php echo $data['tgl_bayar']; ?>" required>

            <label for="status">Status:</label>
            <select name="status" id="status" required>
                <option value="baru" <?php echo ($data['status'] == 'baru') ? 'selected' : ''; ?>>Baru</option>
                <option value="proses" <?php echo ($data['status'] == 'proses') ? 'selected' : ''; ?>>Proses</option>
                <option value="selesai" <?php echo ($data['status'] == 'selesai') ? 'selected' : ''; ?>>Selesai</option>
                <option value="diambil" <?php echo ($data['status'] == 'diambil') ? 'selected' : ''; ?>>Diambil</option>
            </select>

            <label for="dibayar">Dibayar:</label>
            <select name="dibayar" id="dibayar" required>
                <option value="belum_dibayar" <?php echo ($data['dibayar'] == 'belum_dibayar') ? 'selected' : ''; ?>>Belum Dibayar</option>
                <option value="dibayar" <?php echo ($data['dibayar'] == 'dibayar') ? 'selected' : ''; ?>>Dibayar</option>
            </select>

            <button type="submit" name="edit">Update Transaksi</button>
        </form>
    </div>

    <footer>
        <p>Aplikasi Pengelolaan Laundry &copy; 2024</p>
    </footer>
</body>
</html>
