<?php
session_start();
if ($_SESSION['login'] != 'admin' && $_SESSION['login'] != 'kasir') {
    header("Location: index.php");
    exit();
}

include 'koneksi.php';

if (isset($_POST['tambah'])) {
    // Mengambil data dari form
    $id_outlet = mysqli_real_escape_string($koneksi, $_POST['id_outlet']);
    $id_member = mysqli_real_escape_string($koneksi, $_POST['id_member']);
    $tgl = mysqli_real_escape_string($koneksi, $_POST['tgl']);
    $batas_waktu = mysqli_real_escape_string($koneksi, $_POST['batas_waktu']);
    $tgl_bayar = mysqli_real_escape_string($koneksi, $_POST['tgl_bayar']);
    $biaya_tambahan = mysqli_real_escape_string($koneksi, $_POST['biaya_tambahan']);
    $status = mysqli_real_escape_string($koneksi, $_POST['status']);
    $dibayar = mysqli_real_escape_string($koneksi, $_POST['dibayar']);
    $id_user = mysqli_real_escape_string($koneksi, $_POST['id_user']);
    $kode_invoice = mysqli_real_escape_string($koneksi, $_POST['kode_invoice']);
    $id_paket = mysqli_real_escape_string($koneksi, $_POST['id_paket']); // Paket yang dipilih
    $qty = mysqli_real_escape_string($koneksi, $_POST['qty']); // Jumlah (qty)

    // Pajak dan diskon tetap
    $pajak = 3; // Pajak 3%
    $diskon = 5; // Diskon 5%

    // Ambil harga paket berdasarkan id_paket
    $total_harga_paket = 0;
    $query_paket = "SELECT harga FROM tb_paket WHERE id = '$id_paket'";
    $result_paket = mysqli_query($koneksi, $query_paket);
    if ($row_paket = mysqli_fetch_assoc($result_paket)) {
        $total_harga_paket = $row_paket['harga'] * $qty; // Hitung total harga berdasarkan qty
    }

    // Perhitungan total harga
    $diskon_value = $total_harga_paket * ($diskon / 100);
    $pajak_value = $total_harga_paket * ($pajak / 100);
    $total_harga = ($total_harga_paket - $diskon_value) + $pajak_value + $biaya_tambahan;

    // Menyimpan transaksi ke database
    $query = "INSERT INTO tb_transaksi (id_outlet, kode_invoice, id_member, tgl, batas_waktu, tgl_bayar, biaya_tambahan, diskon, pajak, status, dibayar, id_user, total_harga) 
              VALUES ('$id_outlet', '$kode_invoice', '$id_member', '$tgl', '$batas_waktu', '$tgl_bayar', '$biaya_tambahan', '$diskon', '$pajak', '$status', '$dibayar', '$id_user', '$total_harga')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Mendapatkan ID transaksi yang baru saja ditambahkan
        $id_transaksi = mysqli_insert_id($koneksi);

        // Menambahkan detail transaksi ke tb_detail_transaksi
        $query_detail = "INSERT INTO tb_detail_transaksi (id_transaksi, id_paket, qty) VALUES ('$id_transaksi', '$id_paket', '$qty');";
        mysqli_query($koneksi, $query_detail);

        // Redirect ke halaman transaksi setelah sukses
        echo "<script>alert('Data transaksi berhasil ditambahkan!');</script>";
        header("Location: transaksi.php");
    } else {
        // Jika gagal, tampilkan pesan error
        echo "<script>alert('Gagal menambahkan data transaksi!');</script>";
    }
}
?>
