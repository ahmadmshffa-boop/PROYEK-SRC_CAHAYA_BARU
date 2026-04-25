# PROYEK-SRC_CAHAYA_BARU

 Proyek ini adalah sebuah sistem informasi berbasis web untuk Toko Sembako SRC CAHAYA BARU. Aplikasi ini dibangun
  menggunakan bahasa pemrograman PHP dan database MySQL. Sistem ini memiliki dua bagian utama: halaman publik untuk
  pelanggan dan halaman administrator untuk pengelolaan data.

  ---

  Struktur Folder & File Utama

   1. config.php
       * Berisi konfigurasi koneksi ke database MySQL (nama database: toko_sembako).
       * Mengatur dimulainya sesi (session_start) untuk sistem login.

   2. database.sql
       * File skema database yang berisi struktur tabel:
           * admin: Menyimpan data akun pengelola (default: admin/admin123).
           * produk: Menyimpan daftar barang sembako, harga, dan stok.
           * promo: Menyimpan informasi diskon atau penawaran khusus.
           * berita: Untuk mengunggah artikel atau pengumuman toko.
           * galeri: Foto-foto dokumentasi toko.
           * pesan: Menyimpan data dari formulir kontak pelanggan.

   3. index.php (Halaman Utama)
       * Berperan sebagai Landing Page bagi pengunjung.
       * Menampilkan Katalog Produk, Promo Spesial, Berita Terbaru, Galeri Foto, dan Formulir Kontak untuk mengirim
         pesan ke admin.

   4. Folder admin/
       * Berisi modul manajemen (Backend) yang hanya bisa diakses oleh pengelola setelah login.
       * Fungsi di dalamnya meliputi:
           * produk.php: Menambah, mengubah, dan menghapus data produk.
           * promo.php & berita.php: Mengelola konten promosi dan artikel.
           * kontak.php: Melihat pesan yang masuk dari pelanggan.
           * login.php & logout.php: Sistem keamanan akses admin.

   5. Folder uploads/
       * Tempat penyimpanan semua file gambar yang diunggah melalui halaman admin (foto produk, gambar berita, dll).

   6. Folder assets/
       * Menyimpan file pendukung seperti CSS (untuk desain tampilan) agar website terlihat rapi dan responsif.

  ---

  Fitur Utama
   * Katalog Dinamis: Menampilkan produk langsung dari database.
   * Sistem Promo: Fitur untuk menampilkan penawaran terbatas berdasarkan tanggal.
   * Formulir Kontak: Memungkinkan pelanggan berinteraksi langsung dengan pemilik toko.
   * Dashboard Admin: Memudahkan pemilik toko mengupdate harga barang atau stok tanpa harus mengubah kode program.
