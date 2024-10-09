<?php
session_start();
if ($_SESSION['login'] != 'admin' && $_SESSION['login'] != 'kasir') {
    header("Location: index.php");
    exit();
}

include 'koneksi.php';

if (isset($_POST['edit'])) {
    $id = mysqli_real_escape_string($koneksi, $_POST['id']);
    $id_outlet = mysqli_real_escape_string($koneksi, $_POST['id_outlet']);
    $id_member = mysqli_real_escape_string($koneksi, $_POST['id_member']);
    $harga_paket = mysqli_real_escape_string($koneksi, $_POST['harga_paket']);
    $qty = mysqli_real_escape_string($koneksi, $_POST['qty']);
    $diskon = mysqli_real_escape_string($koneksi, $_POST['diskon']);
    $pajak = mysqli_real_escape_string($koneksi, $_POST['pajak']);
    $biaya_tambahan = mysqli_real_escape_string($koneksi, $_POST['biaya_tambahan']);
    $kode_invoice = mysqli_real_escape_string($koneksi, $_POST['kode_invoice']);
    $tgl = mysqli_real_escape_string($koneksi, $_POST['tgl']);
    $batas_waktu = mysqli_real_escape_string($koneksi, $_POST['batas_waktu']);
    $tgl_bayar = mysqli_real_escape_string($koneksi, $_POST['tgl_bayar']);
    $status = mysqli_real_escape_string($koneksi, $_POST['status']);
    $dibayar = mysqli_real_escape_string($koneksi, $_POST['dibayar']);

    // Perhitungan harga berdasarkan qty
    $total_harga_paket = $harga_paket * $qty;

    // Diskon dan pajak
    $diskon_value = ($diskon / 100) * $total_harga_paket;
    $pajak_value = ($pajak / 100) * $total_harga_paket;

    // Total harga akhir
    $total_harga = ($total_harga_paket - $diskon_value) + $pajak_value + $biaya_tambahan;

    // Update data transaksi
    $query = "UPDATE tb_transaksi SET id_member = '$id_member', kode_invoice = '$kode_invoice', tgl = '$tgl', batas_waktu = '$batas_waktu', tgl_bayar = '$tgl_bayar', biaya_tambahan = '$biaya_tambahan', diskon = '$diskon', pajak = '$pajak', status = '$status', dibayar = '$dibayar', total_harga = '$total_harga' WHERE id = '$id'";
    $update = mysqli_query($koneksi, $query);

    if ($update) {
        // Update detail transaksi (tanpa kolom total_harga)
        $query_detail = "UPDATE tb_detail_transaksi SET qty = '$qty' WHERE id_transaksi = '$id'";
        mysqli_query($koneksi, $query_detail);

        $_SESSION['success'] = "Transaksi berhasil diperbarui!";
        header("Location: transaksi.php");
    } else {
        $_SESSION['error'] = "Gagal memperbarui transaksi!";
        header("Location: edit_transaksi.php?id=$id");
    }
}
?>
