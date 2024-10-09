<?php
session_start();
if ($_SESSION['login'] != 'admin' && $_SESSION['login'] != 'kasir') {
    header("Location: index.php");
    exit();
}

include 'koneksi.php';

$id = $_GET['id'];
$query = "SELECT * FROM tb_member WHERE id = '$id'";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

if (isset($_POST['edit'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
    $tlp = mysqli_real_escape_string($koneksi, $_POST['tlp']);

    $query = "UPDATE tb_member SET nama = '$nama', alamat = '$alamat', jenis_kelamin = '$jenis_kelamin', tlp = '$tlp' WHERE id = '$id'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>alert('Data pelanggan berhasil diupdate!');</script>";
        header("Location: registrasi.php");
    } else {
        echo "<script>alert('Gagal update data pelanggan!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Registrasi</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/registrasi.css">
</head>
<header>
    <div class="container">
        <div class="branding">
            <h1>Dashboard Registrasi</h1>
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
        <h2>Edit Registrasi</h2>
        <form method="POST" action="" class="tambah-registrasi-form">
            <label for="nama">Nama:</label>
            <input type="text" name="nama" value="<?php echo $data['nama']; ?>" required>

            <label for="alamat">Alamat:</label>
            <textarea name="alamat" required><?php echo $data['alamat']; ?></textarea>

            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <select name="jenis_kelamin" required>
                <option value="L" <?php if ($data['jenis_kelamin'] == 'L') echo 'selected'; ?>>Laki-laki</option>
                <option value="P" <?php if ($data['jenis_kelamin'] == 'P') echo 'selected'; ?>>Perempuan</option>
            </select>

            <label for="tlp">No. Telepon:</label>
            <input type="text" name="tlp" value="<?php echo $data['tlp']; ?>" required>

            <button type="submit" name="edit">Edit</button>
        </form>
    </div>

    <footer>
        <p>Aplikasi Pengelolaan Laundry &copy; 2024</p>
    </footer>
</body>
</html>