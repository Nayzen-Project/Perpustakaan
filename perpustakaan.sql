-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 20, 2025 at 02:16 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_buku_by_kategori` (IN `kategori_id` INT)   BEGIN
    SELECT b.id, b.judul, b.penulis, b.penerbit, b.tahun_terbit, b.jumlah
    FROM bukus b
    JOIN list_kategoris lk ON b.id = lk.buku_id
    WHERE lk.kategori_buku_id = kategori_id;
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `cek_ketersediaan_buku` (`buku_id` INT) RETURNS TINYINT(1) DETERMINISTIC BEGIN
    DECLARE jumlah_tersedia INT;
    
    -- Ambil jumlah buku yang tersedia
    SELECT jumlah INTO jumlah_tersedia FROM bukus WHERE id = buku_id;

    -- Jika jumlah buku lebih dari 0, maka bisa dipinjam
    RETURN jumlah_tersedia > 0;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `bukus`
--

CREATE TABLE `bukus` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `judul` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `penulis` varchar(255) NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `description` text,
  `code` varchar(255) NOT NULL,
  `tahun_terbit` varchar(255) NOT NULL,
  `jumlah` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bukus`
--

INSERT INTO `bukus` (`id`, `created_at`, `updated_at`, `deleted_at`, `foto`, `judul`, `slug`, `penulis`, `penerbit`, `description`, `code`, `tahun_terbit`, `jumlah`) VALUES
(1, '2025-03-20 11:49:05', '2025-03-20 11:49:05', NULL, 'storage/fotobuku/oCdT98kOSUsM0GZgfpijFpprtAJpQp4iAF5YplIg.jpg', 'Bulan', 'bulan', 'Tere Liye', 'Gramedia', 'Bulan', 'D01', '2012', 10);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dendas`
--

CREATE TABLE `dendas` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `peminjaman_id` bigint UNSIGNED NOT NULL,
  `nominal` int NOT NULL,
  `dibayar` tinyint(1) NOT NULL DEFAULT '0',
  `status` enum('dibayar','belum dibayar') NOT NULL DEFAULT 'belum dibayar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori_bukus`
--

CREATE TABLE `kategori_bukus` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `kode` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori_bukus`
--

INSERT INTO `kategori_bukus` (`id`, `created_at`, `updated_at`, `deleted_at`, `nama_kategori`, `slug`, `kode`) VALUES
(1, '2025-03-20 11:48:06', '2025-03-20 11:48:06', NULL, 'Drama', 'drama', 'D');

-- --------------------------------------------------------

--
-- Table structure for table `koleksi_bukus`
--

CREATE TABLE `koleksi_bukus` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `buku_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `list_kategoris`
--

CREATE TABLE `list_kategoris` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `kategori_buku_id` bigint UNSIGNED NOT NULL,
  `buku_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `list_kategoris`
--

INSERT INTO `list_kategoris` (`id`, `created_at`, `updated_at`, `deleted_at`, `kategori_buku_id`, `buku_id`) VALUES
(1, NULL, NULL, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `list_peminjamen`
--

CREATE TABLE `list_peminjamen` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `buku_id` bigint UNSIGNED NOT NULL,
  `peminjaman_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_02_07_030345_create_peminjams_table', 1),
(5, '2025_02_07_030618_create_petugas_table', 1),
(6, '2025_02_07_030725_create_peminjamen_table', 1),
(7, '2025_02_07_030908_create_bukus_table', 1),
(8, '2025_02_07_031138_create_kategori_bukus_table', 1),
(9, '2025_02_07_031231_create_koleksi_bukus_table', 1),
(10, '2025_02_07_031325_create_list_kategoris_table', 1),
(11, '2025_02_07_031515_create_ulasans_table', 1),
(12, '2025_02_07_031553_create_dendas_table', 1),
(13, '2025_02_07_031657_create_list_peminjamen_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peminjamen`
--

CREATE TABLE `peminjamen` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_peminjaman` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `peminjam_id` bigint UNSIGNED NOT NULL,
  `petugas_id` bigint UNSIGNED DEFAULT NULL,
  `tanggal_dikembalikan` date DEFAULT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `tanggal_peminjaman` date NOT NULL,
  `status` enum('dipinjam','dikembalikan','menunggu pengambilan','telat dikembalikan') NOT NULL DEFAULT 'menunggu pengambilan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Triggers `peminjamen`
--
DELIMITER $$
CREATE TRIGGER `hitung_denda_setelah_pengembalian` AFTER UPDATE ON `peminjamen` FOR EACH ROW BEGIN
    DECLARE keterlambatan INT;
    DECLARE total_denda INT;

    -- Hitung keterlambatan (jika tanggal_pengembalian melebihi batas 7 hari)
    SET keterlambatan = DATEDIFF(NEW.tanggal_pengembalian, DATE_ADD(NEW.tanggal_peminjaman, INTERVAL 7 DAY));

    -- Jika terlambat, hitung denda (Rp 1.000 per hari)
    IF keterlambatan > 0 THEN
        SET total_denda = keterlambatan * 1000;

        -- Masukkan data denda ke tabel 'dendas'
        INSERT INTO dendas (peminjaman_id, nominal, dibayar, status, created_at, updated_at)
        VALUES (NEW.id, total_denda, FALSE, 'belum dibayar', NOW(), NOW());
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `peminjams`
--

CREATE TABLE `peminjams` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `location` json NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `status` enum('active','nonactive') NOT NULL DEFAULT 'active',
  `nik` varchar(255) DEFAULT NULL,
  `foto_ktp` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `peminjams`
--

INSERT INTO `peminjams` (`id`, `created_at`, `updated_at`, `deleted_at`, `user_id`, `nama_lengkap`, `location`, `alamat`, `phone`, `photo`, `status`, `nik`, `foto_ktp`) VALUES
(1, '2025-03-20 11:23:19', '2025-03-20 11:29:04', NULL, 3, 'User', '{\"provinsi\": \"RIAU\", \"kabupaten\": \"KABUPATEN BENGKALIS\", \"kecamatan\": \"PINGGIR\", \"provinsi_id\": \"14\", \"kabupaten_id\": \"1408\", \"kecamatan_id\": \"1408011\"}', 'Riau, Indonesia', '089432671876', 'peminjams/Kl2PtyTHyUuimRmdp9bm4APa8nETFBjz1zOUJcx8.jpg', 'active', '0867532441', 'peminjams/ktp/irqefSgEsxNLL9cKJtvf5RuLLehp2i0h0zSaizHC.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `role` enum('petugas','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id`, `created_at`, `updated_at`, `deleted_at`, `user_id`, `email`, `nama_lengkap`, `phone`, `alamat`, `role`) VALUES
(1, '2025-03-20 11:09:57', '2025-03-20 11:09:57', NULL, 2, 'sachie@gmail.com', 'Sachie', '08129876543', 'Jakarta, Indonesia', 'petugas'),
(2, '2025-03-20 11:09:57', '2025-03-20 11:09:57', NULL, 1, 'velia@gmail.com', 'Velia', '08129876541', 'Jakarta, Indonesia', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `payload` longtext NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('dhWjK145yveXj8L3ECQ26HP0Pi2fl1nb2QzR8h88', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYnFFWDlQeXhkeHpKWlpQcUVjd2ZvQ3Q2cThadlRRYVROdnVkclRSZSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1742472911),
('dVCw37XK0rHDZtNPyr5l9nkaT9UGtzZlZvGRAVhz', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMVVuUXZDUmFMNmlXQUNIZlZFVGxCMUl0SXdPdjdablJPYkhWcVBRRSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9idWt1Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1742479007),
('UOW41NXoHvEH40kUc6cEh2Ce9CY1HQtDpxCLsnOg', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicEphSjJ2OTgzSnB3TnZZZFJFNXRRczhYWEVpcXdBWDhXNG1hS3o2SSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1742474894);

-- --------------------------------------------------------

--
-- Table structure for table `ulasans`
--

CREATE TABLE `ulasans` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `peminjam_id` bigint UNSIGNED NOT NULL,
  `buku_id` bigint UNSIGNED NOT NULL,
  `ulasan` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ulasans`
--

INSERT INTO `ulasans` (`id`, `created_at`, `updated_at`, `deleted_at`, `peminjam_id`, `buku_id`, `ulasan`) VALUES
(1, '2025-03-20 12:25:28', '2025-03-20 12:25:28', NULL, 1, 1, 'Bagus');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `role` enum('user','petugas','admin') NOT NULL DEFAULT 'user',
  `is_confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `role`, `is_confirmed`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '2025-03-20 11:09:53', '$2y$12$Sz7LnutI5pWu4NAaMl9op.QMJibuEnPBmTHOqdhW3Xkg00wpksNzO', NULL, 'admin', 1, '2025-03-20 11:09:55', '2025-03-20 11:09:55'),
(2, 'Petugas', 'petugas@gmail.com', '2025-03-20 11:09:55', '$2y$12$pYKwKMcZlzGv/5DyVnSb5umWbfa085G1YlFzNchFztFJMJ8wRSp/i', NULL, 'petugas', 1, '2025-03-20 11:09:56', '2025-03-20 11:09:56'),
(3, 'User', 'user@gmail.com', '2025-03-20 11:09:56', '$2y$12$ufLBf1qS1NTVrGJhT/GkdOPVipl0y.J39tTuDUh6tVBUoaf1NszLK', NULL, 'user', 1, '2025-03-20 11:09:57', '2025-03-20 11:20:01'),
(4, 'Darren', 'darren@gmail.com', NULL, '$2y$12$WGM.ko2k.QhI1HfujK/78eTrFLH2CWRis6cZlAFI3IbcF1vmXijAa', NULL, 'user', 0, '2025-03-20 11:35:13', '2025-03-20 11:35:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bukus`
--
ALTER TABLE `bukus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bukus_slug_unique` (`slug`),
  ADD UNIQUE KEY `bukus_code_unique` (`code`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `dendas`
--
ALTER TABLE `dendas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dendas_peminjaman_id_foreign` (`peminjaman_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_bukus`
--
ALTER TABLE `kategori_bukus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kategori_bukus_slug_unique` (`slug`),
  ADD UNIQUE KEY `kategori_bukus_kode_unique` (`kode`);

--
-- Indexes for table `koleksi_bukus`
--
ALTER TABLE `koleksi_bukus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `koleksi_bukus_user_id_foreign` (`user_id`),
  ADD KEY `koleksi_bukus_buku_id_foreign` (`buku_id`);

--
-- Indexes for table `list_kategoris`
--
ALTER TABLE `list_kategoris`
  ADD PRIMARY KEY (`id`),
  ADD KEY `list_kategoris_kategori_buku_id_foreign` (`kategori_buku_id`),
  ADD KEY `list_kategoris_buku_id_foreign` (`buku_id`);

--
-- Indexes for table `list_peminjamen`
--
ALTER TABLE `list_peminjamen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `list_peminjamen_buku_id_foreign` (`buku_id`),
  ADD KEY `list_peminjamen_peminjaman_id_foreign` (`peminjaman_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `peminjamen`
--
ALTER TABLE `peminjamen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `peminjamen_kode_peminjaman_unique` (`kode_peminjaman`),
  ADD KEY `peminjamen_peminjam_id_foreign` (`peminjam_id`),
  ADD KEY `peminjamen_petugas_id_foreign` (`petugas_id`);

--
-- Indexes for table `peminjams`
--
ALTER TABLE `peminjams`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `peminjams_nik_unique` (`nik`),
  ADD KEY `peminjams_user_id_foreign` (`user_id`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `petugas_email_unique` (`email`),
  ADD KEY `petugas_user_id_foreign` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `ulasans`
--
ALTER TABLE `ulasans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ulasans_peminjam_id_foreign` (`peminjam_id`),
  ADD KEY `ulasans_buku_id_foreign` (`buku_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bukus`
--
ALTER TABLE `bukus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dendas`
--
ALTER TABLE `dendas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori_bukus`
--
ALTER TABLE `kategori_bukus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `koleksi_bukus`
--
ALTER TABLE `koleksi_bukus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `list_kategoris`
--
ALTER TABLE `list_kategoris`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `list_peminjamen`
--
ALTER TABLE `list_peminjamen`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `peminjamen`
--
ALTER TABLE `peminjamen`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `peminjams`
--
ALTER TABLE `peminjams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ulasans`
--
ALTER TABLE `ulasans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dendas`
--
ALTER TABLE `dendas`
  ADD CONSTRAINT `dendas_peminjaman_id_foreign` FOREIGN KEY (`peminjaman_id`) REFERENCES `peminjamen` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `koleksi_bukus`
--
ALTER TABLE `koleksi_bukus`
  ADD CONSTRAINT `koleksi_bukus_buku_id_foreign` FOREIGN KEY (`buku_id`) REFERENCES `bukus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `koleksi_bukus_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `list_kategoris`
--
ALTER TABLE `list_kategoris`
  ADD CONSTRAINT `list_kategoris_buku_id_foreign` FOREIGN KEY (`buku_id`) REFERENCES `bukus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `list_kategoris_kategori_buku_id_foreign` FOREIGN KEY (`kategori_buku_id`) REFERENCES `kategori_bukus` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `list_peminjamen`
--
ALTER TABLE `list_peminjamen`
  ADD CONSTRAINT `list_peminjamen_buku_id_foreign` FOREIGN KEY (`buku_id`) REFERENCES `bukus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `list_peminjamen_peminjaman_id_foreign` FOREIGN KEY (`peminjaman_id`) REFERENCES `peminjamen` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `peminjamen`
--
ALTER TABLE `peminjamen`
  ADD CONSTRAINT `peminjamen_peminjam_id_foreign` FOREIGN KEY (`peminjam_id`) REFERENCES `peminjams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `peminjamen_petugas_id_foreign` FOREIGN KEY (`petugas_id`) REFERENCES `petugas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `peminjams`
--
ALTER TABLE `peminjams`
  ADD CONSTRAINT `peminjams_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `petugas`
--
ALTER TABLE `petugas`
  ADD CONSTRAINT `petugas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ulasans`
--
ALTER TABLE `ulasans`
  ADD CONSTRAINT `ulasans_buku_id_foreign` FOREIGN KEY (`buku_id`) REFERENCES `bukus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ulasans_peminjam_id_foreign` FOREIGN KEY (`peminjam_id`) REFERENCES `peminjams` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
