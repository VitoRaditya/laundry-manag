<?php
session_start();
if ($_SESSION['login'] != 'admin') {
    header("Location: index.php");
    exit();
}

include 'koneksi.php';

$id = $_GET['id'];
$query = "SELECT * FROM tb_outlet WHERE id = '$id'";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

if (isset($_POST['edit'])) {
    $nama_outlet = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $tlp = mysqli_real_escape_string($koneksi, $_POST['tlp']);

    $query = "UPDATE tb_outlet SET nama = '$nama_outlet', alamat = '$alamat', tlp = '$tlp' WHERE id = '$id'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>alert('Data outlet berhasil diupdate!');</script>";
        header("Location: outlet.php");
    } else {
        echo "<script>alert('Gagal update data outlet!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Outlet</title>
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
        <h2>Edit Outlet</h2>
        <form method="POST" action="">
            <label for="nama">Nama Outlet:</label>
            <input type="text" name="nama" value="<?php echo $data['nama']; ?>" required>

            <label for="alamat">Alamat:</label>
            <textarea name="alamat" required><?php echo $data['alamat']; ?></textarea>

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