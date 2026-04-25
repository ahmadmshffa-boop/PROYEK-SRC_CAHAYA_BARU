<?php
include '../config.php';
if (!isset($_SESSION['admin'])) header("Location: login.php");

// Tandai sebagai sudah dibaca
if (isset($_GET['baca'])) {
    $id = (int)$_GET['baca'];
    mysqli_query($conn, "UPDATE pesan SET status='sudah_dibaca' WHERE id=$id");
    header("Location: kontak.php");
}

// Hapus pesan
if (isset($_GET['hapus'])) {
    $id = (int)$_GET['hapus'];
    mysqli_query($conn, "DELETE FROM pesan WHERE id=$id");
    header("Location: kontak.php");
}

$pesan = mysqli_query($conn, "SELECT * FROM pesan ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pesan Masuk</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h2>Pesan Masuk dari Pengunjung</h2>
    <a href="dashboard.php">Kembali</a>
    
    <?php while($row = mysqli_fetch_assoc($pesan)): ?>
    <div class="pesan-card" style="background:<?= $row['status']=='belum_dibaca'?'#fff3cd':'#f8f9fa' ?>">
        <h3><?= $row['nama'] ?> (<?= $row['email'] ?>)</h3>
        <p><strong>Subjek:</strong> <?= $row['subjek'] ?></p>
        <p><?= nl2br($row['pesan']) ?></p>
        <small><?= $row['created_at'] ?></small>
        <div>
            <?php if($row['status']=='belum_dibaca'): ?>
            <a href="?baca=<?= $row['id'] ?>">Tandai Dibaca</a> |
            <?php endif; ?>
            <a href="?hapus=<?= $row['id'] ?>" onclick="return confirm('Hapus pesan?')">Hapus</a>
        </div>
    </div>
    <?php endwhile; ?>
</body>
</html>