<?php include 'config.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Toko SRC - Mitra Setia Anda</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <h1>TOKO SRC-CAHAYA-BARU</h1>
        <nav>
            <a href="#home">Home</a>
            <a href="#produk">Produk</a>
            <a href="#promo">Promo</a>
            <a href="#berita">Berita</a>
            <a href="#galeri">Galeri</a>
            <a href="#kontak">Kontak</a>
        </nav>
    </header>
    
    <main>
        <!-- Hero Section -->
        <section id="home">
            <h2>Selamat Datang di Toko Sembako SRC CAHAYA BARU</h2>
            <p>Toko terpercaya untuk kebutuhan sembako Anda sehari-hari. Harga bersahabat, kualitas terjamin.</p>
        </section>
        
        <!-- Produk -->
        <section id="produk">
            <h2>Produk Unggulan</h2>
            <div class="produk-grid">
                <?php 
                $produk = mysqli_query($conn, "SELECT * FROM produk LIMIT 6");
                while($row = mysqli_fetch_assoc($produk)): 
                ?>
                <div class="produk-card">
                    <img src="uploads/<?= $row['gambar'] ?>" width="150">
                    <h3><?= $row['nama'] ?></h3>
                    <p>Rp <?= number_format($row['harga'],0,',','.') ?></p>
                    <p>Stok: <?= $row['stok'] ?></p>
                </div>
                <?php endwhile; ?>
            </div>
        </section>
        
        <!-- Promo -->
        <section id="promo">
            <h2>Promo Spesial</h2>
            <div class="promo-list">
                <?php 
                $promo = mysqli_query($conn, "SELECT * FROM promo WHERE tanggal_selesai >= CURDATE()");
                while($row = mysqli_fetch_assoc($promo)):
                ?>
                <div class="promo-item">
                    <img src="uploads/<?= $row['gambar'] ?>" width="200">
                    <h3><?= $row['judul'] ?></h3>
                    <p><?= $row['deskripsi'] ?></p>
                    <small>Berlaku: <?= $row['tanggal_mulai'] ?> s/d <?= $row['tanggal_selesai'] ?></small>
                </div>
                <?php endwhile; ?>
            </div>
        </section>
        
        <!-- Berita -->
        <section id="berita">
            <h2>Berita Terbaru</h2>
            <?php 
            $berita = mysqli_query($conn, "SELECT * FROM berita ORDER BY tanggal DESC LIMIT 3");
            while($row = mysqli_fetch_assoc($berita)):
            ?>
            <div class="berita">
                <h3><?= $row['judul'] ?></h3>
                <small><?= $row['tanggal'] ?></small>
                <p><?= substr($row['isi'],0,150) ?>...</p>
            </div>
            <?php endwhile; ?>
        </section>
        
        <!-- Galeri -->
        <section id="galeri">
            <h2>Galeri Toko</h2>
            <div class="galeri">
                <?php 
                $galeri = mysqli_query($conn, "SELECT * FROM galeri LIMIT 8");
                while($row = mysqli_fetch_assoc($galeri)):
                ?>
                <img src="uploads/<?= $row['gambar'] ?>" width="150">
                <?php endwhile; ?>
            </div>
        </section>
        
        <!-- Form Kontak -->
        <section id="kontak">
            <h2>Hubungi Kami</h2>
            <?php
            if (isset($_POST['kirim'])) {
                $nama = mysqli_real_escape_string($conn, $_POST['nama']);
                $email = mysqli_real_escape_string($conn, $_POST['email']);
                $subjek = mysqli_real_escape_string($conn, $_POST['subjek']);
                $pesan = mysqli_real_escape_string($conn, $_POST['pesan']);
                
                mysqli_query($conn, "INSERT INTO pesan (nama, email, subjek, pesan) 
                                    VALUES ('$nama','$email','$subjek','$pesan')");
                echo "<p class='success'>Pesan terkirim! Kami akan segera merespon.</p>";
            }
            ?>
            <form method="post">
                <input type="text" name="nama" placeholder="Nama" required><br>
                <input type="email" name="email" placeholder="Email" required><br>
                <input type="text" name="subjek" placeholder="Subjek"><br>
                <textarea name="pesan" placeholder="Pesan Anda" required></textarea><br>
                <button type="submit" name="kirim">Kirim Pesan</button>
            </form>
            
            <div class="info-kontak">
                <p>Alamat: Jl. Roos Barat 3 </p>
                <p>Telepon: (021) 12345678</p>
                <p>Email: srccahayabaru@gmail.com</p>
            </div>
        </section>
    </main>
    
    <footer>
        <p>&copy; 2025 Toko SRC CAHAYA BARU. All rights reserved.</p>
    </footer>
</body>
</html>