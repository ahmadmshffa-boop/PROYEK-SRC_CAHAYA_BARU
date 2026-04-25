<?php
include '../config.php';
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
}

// Ambil data statistik
$total_promo = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM promo"))['total'];
$total_berita = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM berita"))['total'];
$total_produk = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM produk"))['total'];
$total_pesan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM pesan WHERE status='belum_dibaca'"))['total'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="admin-container">
        <h1>Dashboard Admin Toko Sembako</h1>
        <div class="menu">
            <a href="dashboard.php">Dashboard</a>
            <a href="promo.php">Promo</a>
            <a href="berita.php">Berita</a>
            <a href="produk.php">Produk</a>
            <a href="galeri.php">Galeri</a>
            <a href="kontak.php">Pesan Masuk</a>
            <a href="logout.php">Logout</a>
        </div>
        
        <div class="stats">
            <div class="stat-card">Total Promo: <?php echo $total_promo; ?></div>
            <div class="stat-card">Total Berita: <?php echo $total_berita; ?></div>
            <div class="stat-card">Total Produk: <?php echo $total_produk; ?></div>
            <div class="stat-card">Pesan Baru: <?php echo $total_pesan; ?></div>
        </div>
    </div>
</body>
</html>