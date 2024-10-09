<?php
session_start();
if ($_SESSION['login'] != 'admin') {
    header("Location: index.php");
    exit();
}

include 'koneksi.php';

$id = $_GET['id'];
$query = "SELECT * FROM tb_paket WHERE id = '$id'";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

if (isset($_POST['edit'])) {
    $id_outlet = mysqli_real_escape_string($koneksi, $_POST['id_outlet']);
    $jenis = mysqli_real_escape_string($koneksi, $_POST['jenis']);
    $nama_paket = mysqli_real_escape_string($koneksi, $_POST['nama_paket']);
    $harga = mysqli_real_escape_string($koneksi, $_POST['harga']);

    $query = "UPDATE tb_paket SET id_outlet = '$id_outlet', jenis = '$jenis', nama_paket = '$nama_paket', harga = '$harga' WHERE id = '$id'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>alert('Data paket berhasil diupdate!');</script>";
        header("Location: paket.php");
    } else {
        echo "<script>alert('Gagal update data paket!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Paket</title>
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
        <h2>Edit Paket</h2>
        <form method="POST" action="">
            <label for="id_outlet">Outlet:</label>
            <select name="id_outlet" required>
                <?php
                include 'koneksi.php';
                $query = "SELECT * FROM tb_outlet";
                $result = mysqli_query($koneksi, $query);
                while ($data_outlet = mysqli_fetch_assoc($result)) {
                    ?>
                    <option value="<?php echo $data_outlet['id']; ?>" <?php if ($data_outlet['id'] == $data['id_outlet']) echo 'selected'; ?>><?php echo $data_outlet['nama']; ?></option>
                    <?php
                }
                ?>
            </select>

            <label for="jenis">Jenis:</label>
            <select name="jenis" required>
                <option value="kiloan" <?php if ($data['jenis'] == 'kiloan') echo 'selected'; ?>>Kiloan</option>
                <option value="selimut" <?php if ($data['jenis'] == 'selimut') echo 'selected'; ?>>Selimut</option>
                <option value="bed_cover" <?php if ($data['jenis'] == 'bed_cover') echo 'selected'; ?>>Bed Cover</option>
                <option value="kaos" <?php if ($data['jenis'] == 'kaos') echo 'selected'; ?>>Kaos</option>
                <option value="lain" <?php if ($data['jenis'] == 'lain') echo 'selected'; ?>>Lain</option>
            </select>

            <label for="nama_paket">Nama Paket:</label>
            <input type="text" name="nama_paket" value="<?php echo $data['nama_paket']; ?>" required>

            <label for="harga">Harga:</label>
            <input type="number" name="harga" value="<?php echo $data['harga']; ?>" required>

            <button type="submit" name="edit">Edit</button>
        </form>
    </div>

    <footer>
        <p>Aplikasi Pengelolaan Laundry &copy; 2024</p>
    </footer>
</body>
</html>