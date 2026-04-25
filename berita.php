<?php
include '../config.php';
if (!isset($_SESSION['admin'])) header("Location: login.php");

if (isset($_POST['tambah'])) {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $isi = mysqli_real_escape_string($conn, $_POST['isi']);
    $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal']);
    $gambar = mysqli_real_escape_string($conn, $_FILES['gambar']['name']);
    $target = "../uploads/".basename($gambar);
    move_uploaded_file($_FILES['gambar']['tmp_name'], $target);
    
    mysqli_query($conn, "INSERT INTO berita (judul, isi, gambar, tanggal) VALUES ('$judul','$isi','$gambar','$tanggal')");
    header("Location: berita.php");
}

if (isset($_GET['hapus'])) {
    $id = (int)$_GET['hapus'];
    mysqli_query($conn, "DELETE FROM berita WHERE id=$id");
    header("Location: berita.php");
}

$berita = mysqli_query($conn, "SELECT * FROM berita ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Berita</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h2>Manajemen Berita</h2>
    <a href="dashboard.php">Kembali</a>
    
    <form method="post" enctype="multipart/form-data">
        <input type="text" name="judul" placeholder="Judul Berita" required><br>
        <textarea name="isi" placeholder="Isi Berita" rows="5" required></textarea><br>
        <input type="date" name="tanggal" required><br>
        <input type="file" name="gambar" accept="image/*"><br>
        <button type="submit" name="tambah">Simpan Berita</button>
    </form>
    
    <?php while($row = mysqli_fetch_assoc($berita)): ?>
    <div class="berita-item">
        <h3><?= $row['judul'] ?></h3>
        <small><?= $row['tanggal'] ?></small>
        <p><?= substr($row['isi'],0,100) ?>...</p>
        <a href="?hapus=<?= $row['id'] ?>" onclick="return confirm('Hapus berita ini?')">Hapus</a>
    </div>
    <?php endwhile; ?>
</body>
</html>