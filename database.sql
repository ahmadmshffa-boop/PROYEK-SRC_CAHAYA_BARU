-- phpMyAdmin SQL Dump
-- untuk database 'toko_sembako'

CREATE DATABASE IF NOT EXISTS toko_sembako;
USE toko_sembako;

-- Tabel admin
CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Default admin: username=admin, password=admin123
INSERT INTO admin (username, password) VALUES ('admin', MD5('admin123'));

-- Tabel promo
CREATE TABLE promo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(100) NOT NULL,
    deskripsi TEXT,
    gambar VARCHAR(255),
    tanggal_mulai DATE,
    tanggal_selesai DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel berita
CREATE TABLE berita (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(200) NOT NULL,
    isi TEXT NOT NULL,
    gambar VARCHAR(255),
    tanggal DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel produk
CREATE TABLE produk (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    kategori VARCHAR(50),
    harga DECIMAL(10,2),
    stok INT,
    deskripsi TEXT,
    gambar VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel galeri
CREATE TABLE galeri (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(100) NOT NULL,
    gambar VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel pesan kontak
CREATE TABLE pesan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    subjek VARCHAR(200),
    pesan TEXT NOT NULL,
    status ENUM('belum_dibaca','sudah_dibaca') DEFAULT 'belum_dibaca',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);