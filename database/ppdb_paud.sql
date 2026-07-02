-- =========================================================
-- SQL DATABASE PPDB PAUD
-- Import file ini lewat phpMyAdmin kalau tidak mau pakai
-- perintah `php spark migrate`
-- =========================================================

CREATE DATABASE IF NOT EXISTS ppdb_paud;
USE ppdb_paud;

-- Hapus dulu kalau sudah ada tabel lama yang strukturnya beda
DROP TABLE IF EXISTS pendaftaran;
DROP TABLE IF EXISTS users;

-- =========================================================
-- Tabel users (untuk login admin)
-- =========================================================
CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','panitia') NOT NULL DEFAULT 'admin',
    created_at DATETIME NULL,
    updated_at DATETIME NULL
);

-- Akun admin default -> username: admin | password: admin123
-- (password di bawah sudah dalam bentuk hash bcrypt untuk "admin123")
INSERT INTO users (nama, username, password, role, created_at, updated_at)
VALUES (
    'Administrator',
    'admin',
    '$2b$10$5zJCMkFp5sjGaY5YD9zvfei37CFQ/V.dAY9jKYnuOuKHEz9ULDfQu',
    'admin',
    NOW(),
    NOW()
);

-- =========================================================
-- Tabel pendaftaran (data CRUD PPDB)
-- =========================================================
CREATE TABLE pendaftaran (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    no_pendaftaran VARCHAR(30) NOT NULL UNIQUE,
    nama_anak VARCHAR(100) NOT NULL,
    jenis_kelamin ENUM('Laki-laki','Perempuan') NOT NULL,
    tempat_lahir VARCHAR(100) NOT NULL,
    tanggal_lahir DATE NOT NULL,
    agama VARCHAR(30) NOT NULL,
    anak_ke INT NULL,
    nama_ayah VARCHAR(100) NOT NULL,
    nama_ibu VARCHAR(100) NOT NULL,
    pekerjaan_ayah VARCHAR(100) NULL,
    pekerjaan_ibu VARCHAR(100) NULL,
    no_hp VARCHAR(20) NOT NULL,
    alamat TEXT NOT NULL,
    foto VARCHAR(255) NULL,
    kartu_keluarga VARCHAR(255) NULL,
    akta_kelahiran VARCHAR(255) NULL,
    status ENUM('Menunggu','Diterima','Ditolak') NOT NULL DEFAULT 'Menunggu',
    tahun_ajaran VARCHAR(20) NOT NULL,
    created_by INT UNSIGNED NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL
);

-- =========================================================
-- Tabel migrations (biar CodeIgniter tahu migration sudah "jalan"
-- dan tidak mencoba membuat ulang tabel di atas)
-- =========================================================
CREATE TABLE IF NOT EXISTS migrations (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    version VARCHAR(255) NOT NULL,
    class VARCHAR(255) NOT NULL,
    `group` VARCHAR(255) NOT NULL,
    namespace VARCHAR(255) NOT NULL,
    time INT NOT NULL,
    batch INT UNSIGNED NOT NULL
);

INSERT INTO migrations (version, class, `group`, namespace, time, batch) VALUES
('2026-01-01-000001', '\\App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', UNIX_TIMESTAMP(), 1),
('2026-01-01-000002', '\\App\\Database\\Migrations\\CreatePendaftaranTable', 'default', 'App', UNIX_TIMESTAMP(), 1);
