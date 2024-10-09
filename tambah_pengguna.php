<?php
session_start();
if ($_SESSION['login'] != 'admin') {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengguna</title>
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
        <h2>Tambah Pengguna</h2>
        <form method="POST" action="proses_tambah_pengguna.php">
            <label for="nama">Nama:</label>
            <input type="text" name="nama" required>

            <label for="username">Username:</label>
            <input type="text" name="username" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <label for="id_outlet">Outlet:</label>
            <select name="id_outlet" required>
                <?php
                include 'koneksi.php';
                $query = "SELECT * FROM tb_outlet";
                $result = mysqli_query($koneksi, $query);
                while ($data_outlet = mysqli_fetch_assoc($result)) {
                    ?>
                    <option value="<?php echo $data_outlet['id']; ?>"><?php echo $data_outlet['nama']; ?></option>
                    <?php
                }
                ?>
            </select>

            <label for="role">Role:</label>
            <select name="role" required>
                <option value="admin">Admin</option>
                <option value="kasir">Kasir</option>
                <option value="owner">Owner</option>
            </select>

            <button type="submit" name="tambah">Tambah</button>
        </form>
    </div>

    <footer>
        <p>Aplikasi Pengelolaan Laundry &copy; 2024</p>
    </footer>
</body>
</html>