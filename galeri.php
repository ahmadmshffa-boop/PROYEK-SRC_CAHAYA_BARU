<?php
include '../config.php';
if (!isset($_SESSION['admin'])) header("Location: login.php");

if (isset($_POST['tambah'])) {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $gambar = mysqli_real_escape_string($conn, $_FILES['gambar']['name']);
    $target = "../uploads/".basename($gambar);
    move_uploaded_file($_FILES['gambar']['tmp_name'], $target);
    
    mysqli_query($conn, "INSERT INTO galeri (judul, gambar) VALUES ('$judul','$gambar')");
    header("Location: galeri.php");
}

if (isset($_GET['hapus'])) {
    $id = (int)$_GET['hapus'];
    mysqli_query($conn, "DELETE FROM galeri WHERE id=$id");
    header("Location: galeri.php");
}

$galeri = mysqli_query($conn, "SELECT * FROM galeri ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Galeri</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h2>Manajemen Galeri</h2>
    <a href="dashboard.php">Kembali</a>
    
    <form method="post" enctype="multipart/form-data">
        <input type="text" name="judul" placeholder="Judul Foto" required><br>
        <input type="file" name="gambar" accept="image/*" required><br>
        <button type="submit" name="tambah">Tambah Foto</button>
    </form>
    
    <div class="galeri-grid">
        <?php while($row = mysqli_fetch_assoc($galeri)): ?>
        <div class="galeri-item">
            <img src="../uploads/<?= $row['gambar'] ?>" width="150">
            <p><?= $row['judul'] ?></p>
            <a href="?hapus=<?= $row['id'] ?>" onclick="return confirm('Hapus?')">Hapus</a>
        </div>
        <?php endwhile; ?>
    </div>
</body>
</html>