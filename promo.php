<?php
include '../config.php';
if (!isset($_SESSION['admin'])) header("Location: login.php");

// Tambah promo
if (isset($_POST['tambah'])) {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $tgl_mulai = mysqli_real_escape_string($conn, $_POST['tgl_mulai']);
    $tgl_selesai = mysqli_real_escape_string($conn, $_POST['tgl_selesai']);
    $gambar = mysqli_real_escape_string($conn, $_FILES['gambar']['name']);
    $target = "../uploads/".basename($gambar);
    move_uploaded_file($_FILES['gambar']['tmp_name'], $target);
    
    $query = "INSERT INTO promo (judul, deskripsi, gambar, tanggal_mulai, tanggal_selesai) 
              VALUES ('$judul', '$deskripsi', '$gambar', '$tgl_mulai', '$tgl_selesai')";
    mysqli_query($conn, $query);
    header("Location: promo.php");
}

// Hapus promo
if (isset($_GET['hapus'])) {
    $id = (int)$_GET['hapus'];
    mysqli_query($conn, "DELETE FROM promo WHERE id=$id");
    header("Location: promo.php");
}

$data = mysqli_query($conn, "SELECT * FROM promo ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Promo</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h2>Manajemen Promo</h2>
    <a href="dashboard.php">Kembali</a>
    
    <form method="post" enctype="multipart/form-data">
        <input type="text" name="judul" placeholder="Judul Promo" required>
        <textarea name="deskripsi" placeholder="Deskripsi"></textarea>
        <input type="date" name="tgl_mulai" required>
        <input type="date" name="tgl_selesai" required>
        <input type="file" name="gambar" accept="image/*">
        <button type="submit" name="tambah">Tambah Promo</button>
    </form>
    
    <table border="1">
        <tr><th>ID</th><th>Judul</th><th>Deskripsi</th><th>Gambar</th><th>Aksi</th></tr>
        <?php while($row = mysqli_fetch_assoc($data)): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['judul'] ?></td>
            <td><?= substr($row['deskripsi'],0,50) ?>...</td>
            <td><img src="../uploads/<?= $row['gambar'] ?>" width="50"></td>
            <td><a href="?hapus=<?= $row['id'] ?>" onclick="return confirm('Hapus?')">Hapus</a></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>