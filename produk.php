<?php
include '../config.php';
if (!isset($_SESSION['admin'])) header("Location: login.php");

if (isset($_POST['tambah'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
    $harga = mysqli_real_escape_string($conn, $_POST['harga']);
    $stok = mysqli_real_escape_string($conn, $_POST['stok']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $gambar = mysqli_real_escape_string($conn, $_FILES['gambar']['name']);
    $target = "../uploads/".basename($gambar);
    move_uploaded_file($_FILES['gambar']['tmp_name'], $target);
    
    mysqli_query($conn, "INSERT INTO produk (nama, kategori, harga, stok, deskripsi, gambar) 
                         VALUES ('$nama','$kategori','$harga','$stok','$deskripsi','$gambar')");
    header("Location: produk.php");
}

if (isset($_GET['hapus'])) {
    $id = (int)$_GET['hapus'];
    mysqli_query($conn, "DELETE FROM produk WHERE id=$id");
    header("Location: produk.php");
}

$produk = mysqli_query($conn, "SELECT * FROM produk ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Produk</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h2>Manajemen Produk</h2>
    <a href="dashboard.php">Kembali</a>
    
    <form method="post" enctype="multipart/form-data">
        <input type="text" name="nama" placeholder="Nama Produk" required><br>
        <input type="text" name="kategori" placeholder="Kategori (Beras, Minyak, dll)"><br>
        <input type="number" name="harga" placeholder="Harga" required><br>
        <input type="number" name="stok" placeholder="Stok"><br>
        <textarea name="deskripsi" placeholder="Deskripsi"></textarea><br>
        <input type="file" name="gambar" accept="image/*"><br>
        <button type="submit" name="tambah">Tambah Produk</button>
    </form>
    
    <table border="1">
        <tr><th>Nama</th><th>Kategori</th><th>Harga</th><th>Stok</th><th>Gambar</th><th>Aksi</th></tr>
        <?php while($row = mysqli_fetch_assoc($produk)): ?>
        <tr>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['kategori'] ?></td>
            <td>Rp <?= number_format($row['harga'],0,',','.') ?></td>
            <td><?= $row['stok'] ?></td>
            <td><img src="../uploads/<?= $row['gambar'] ?>" width="50"></td>
            <td><a href="?hapus=<?= $row['id'] ?>" onclick="return confirm('Hapus?')">Hapus</a></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>