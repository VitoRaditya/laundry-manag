<?php
session_start();
if ($_SESSION['login'] != 'admin' && $_SESSION['login'] != 'kasir') {
    header("Location: index.php");
    exit();
}
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/registrasi.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <header>
        <div class="container">
            <div class="branding">
                <h1>Dashboard Transaksi</h1>
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

    <div class="container">
        <h2>Tambah Transaksi</h2>
        <form method="POST" action="proses_tambah_transaksi.php">
            <label for="id_outlet">Outlet:</label>
            <select name="id_outlet" id="id_outlet" required>
                <option value="">Pilih Outlet</option>
                <?php
                // Query untuk menampilkan semua outlet
                $outlet_query = "SELECT * FROM tb_outlet";
                $outlet_result = mysqli_query($koneksi, $outlet_query);
                while ($outlet = mysqli_fetch_assoc($outlet_result)) {
                    echo '<option value="'.$outlet['id'].'">'.$outlet['nama'].'</option>';
                }
                ?>
            </select>

            <label for="id_member">Member:</label>
            <select name="id_member" id="id_member" required>
                <option value="">Pilih Member</option>
                <?php
                // Query untuk menampilkan semua member
                $member_query = "SELECT * FROM tb_member";
                $member_result = mysqli_query($koneksi, $member_query);
                while ($member = mysqli_fetch_assoc($member_result)) {
                    echo '<option value="'.$member['id'].'">'.$member['nama'].'</option>';
                }
                ?>
            </select>

            <label for="id_paket">Paket:</label>
            <select name="id_paket" id="id_paket" required>
                <option value="">Pilih Paket</option>
                <!-- Paket akan diisi melalui AJAX -->
            </select>

            <label for="qty">Jumlah (Qty):</label>
            <input type="number" name="qty" id="qty" value="1" required>

            <label for="kode_invoice">Kode Invoice:</label>
            <input type="text" name="kode_invoice" required>

            <label for="tgl">Tanggal Transaksi:</label>
            <input type="datetime-local" name="tgl" required>

            <label for="batas_waktu">Batas Waktu:</label>
            <input type="datetime-local" name="batas_waktu" required>

            <label for="tgl_bayar">Tanggal Bayar:</label>
            <input type="datetime-local" name="tgl_bayar">

            <label for="biaya_tambahan">Biaya Tambahan:</label>
            <input type="number" name="biaya_tambahan" value="0" required>

            <label for="diskon">Diskon (%):</label>
            <input type="number" name="diskon" value="0" required>

            <label for="pajak">Pajak (%):</label>
            <input type="number" name="pajak" value="0" required>

            <label for="status">Status:</label>
            <select name="status" required>
                <option value="baru">Baru</option>
                <option value="proses">Proses</option>
                <option value="selesai">Selesai</option>
                <option value="diambil">Diambil</option>
            </select>

            <label for="dibayar">Status Pembayaran:</label>
            <select name="dibayar" required>
                <option value="dibayar">Dibayar</option>
                <option value="belum_dibayar">Belum Dibayar</option>
            </select>

            <input type="hidden" name="id_user" value="<?php echo $_SESSION['user_id']; ?>">

            <button type="submit" name="tambah">Tambah Transaksi</button>
        </form>
    </div>

    <footer>
        <p>Aplikasi Pengelolaan Laundry &copy; 2024</p>
    </footer>

    <script>
        // AJAX untuk mendapatkan paket berdasarkan outlet yang dipilih
        $('#id_outlet').on('change', function() {
            var outletID = $(this).val();
            if(outletID) {
                $.ajax({
                    type: 'POST',
                    url: 'get_paket.php', // File untuk mengambil data paket
                    data: {id_outlet: outletID},
                    success: function(html) {
                        $('#id_paket').html(html);
                    }
                });
            } else {
                $('#id_paket').html('<option value="">Pilih Outlet Dulu</option>');
            }
        });
    </script>
</body>
</html>
