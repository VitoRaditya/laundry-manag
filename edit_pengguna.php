<?php
session_start();
if ($_SESSION['login'] != 'admin') {
    header("Location: index.php");
    exit();
}

include 'koneksi.php';

$id = $_GET['id'];
$query = "SELECT * FROM tb_user WHERE id = '$id'";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

if (isset($_POST['edit'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    $id_outlet = mysqli_real_escape_string($koneksi, $_POST['id_outlet']);
    $role = mysqli_real_escape_string($koneksi, $_POST['role']);

    $query = "UPDATE tb_user SET nama = '$nama', username = '$username', password = '$password', id_outlet = '$id_outlet', role = '$role' WHERE id = '$id'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>alert('Data pengguna berhasil diupdate!');</script>";
        header("Location: pengguna.php");
    } else {
        echo "<script>alert('Gagal update data pengguna!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna</title>
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
        <h2>Edit Pengguna</h2>
        <form method="POST" action="">
            <label for="nama">Nama:</label>
            <input type="text" name="nama" value="<?php echo $data['nama']; ?>" required>

            <label for="username">Username:</label>
            <input type="text" name="username" value="<?php echo $data['username']; ?>" required>

            <label for="password">Password:</label>
            <input type="password" name="password" value="<?php echo $data['password']; ?>" required>

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

            <label for="role">Role:</label>
            <select name="role" required>
                <option value="admin" <?php if ($data['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                <option value="kasir" <?php if ($data['role'] == 'kasir') echo 'selected'; ?>>Kasir</option>
                <option value="owner" <?php if ($data['role'] == 'owner') echo 'selected'; ?>>Owner</option>
            </select>

            <button type="submit" name="edit">Edit</button>
        </form>
    </div>

    <footer>
        <p>Aplikasi Pengelolaan Laundry &copy; 2024</p>
    </footer>
</body>
</html>