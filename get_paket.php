<?php
include 'koneksi.php';

if (isset($_POST['id_outlet'])) {
    $id_outlet = $_POST['id_outlet'];

    // Query untuk mendapatkan paket berdasarkan id_outlet
    $query_paket = "SELECT * FROM tb_paket WHERE id_outlet = '$id_outlet'";
    $result_paket = mysqli_query($koneksi, $query_paket);

    if (mysqli_num_rows($result_paket) > 0) {
        echo '<option value="">Pilih Paket</option>';
        while ($paket = mysqli_fetch_assoc($result_paket)) {
            echo '<option value="'.$paket['id'].'">'.$paket['nama_paket'].' - Rp. '.$paket['harga'].'</option>';
        }
    } else {
        echo '<option value="">Tidak ada paket tersedia</option>';
    }
}
?>
