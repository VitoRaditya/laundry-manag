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
    <title>Pengguna</title>
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
        <h2>Pengguna</h2>
        <table class="registrasi-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Outlet</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'koneksi.php';
                $query = "SELECT * FROM tb_user";
                $result = mysqli_query($koneksi, $query);
                $no = 1;
                while ($data = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $data['nama']; ?></td>
                        <td><?php echo $data['username']; ?></td>
                        <td>
                            <?php
                            $query_outlet = "SELECT * FROM tb_outlet WHERE id = '$data[id_outlet]'";
                            $result_outlet = mysqli_query($koneksi, $query_outlet);
                            $data_outlet = mysqli_fetch_assoc($result_outlet);
                            echo $data_outlet['nama'];
                            ?>
                        </td>
                        <td><?php echo $data['role']; ?></td>
                        <td>
                            <a href="edit_pengguna.php?id=<?php echo $data['id']; ?>">Edit</a> |
                            <a href="hapus_pengguna.php?id=<?php echo $data['id']; ?>">Hapus</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <a href="tambah_pengguna.php">Tambah Pengguna</a>
    </div>

    <footer>
        <p>Aplikasi Pengelolaan Laundry &copy; 2024</p>
    </footer>
</body>
</html>