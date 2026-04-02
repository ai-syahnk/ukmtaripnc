-- phpMyAdmin SQL Dump
-- version 6.0.0-dev+20250514.f6d6473767
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 31, 2026 at 05:20 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ukmtaripnc_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `tari_id` bigint UNSIGNED NOT NULL,
  `nama_pemesan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_pentas` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_tampil` date NOT NULL,
  `waktu_tampil` time NOT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `jumlah_penari` tinyint UNSIGNED NOT NULL,
  `harga_per_penari` decimal(15,2) NOT NULL,
  `total_harga` decimal(15,2) NOT NULL,
  `status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `approved_at` timestamp NULL DEFAULT NULL,
  `payment_deadline` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `tari_id`, `nama_pemesan`, `alamat_pentas`, `no_telp`, `tanggal_tampil`, `waktu_tampil`, `catatan`, `jumlah_penari`, `harga_per_penari`, `total_harga`, `status`, `approved_at`, `payment_deadline`, `created_at`, `updated_at`) VALUES
(4, 2, 6, 'Inayah Rusli', 'Jl. Dr. Soetomo 1, Cilacap Selatan', '08123456789', '2026-03-31', '09:00:00', 'acara hiburan saja', 2, 450000.00, 900000.00, 'approved', NULL, NULL, '2026-03-28 23:15:43', '2026-03-28 23:54:37'),
(5, 2, 5, 'Inayah Rusli', 'Jl. Dr. Soetomo 1, Cilacap Selatan', '08123456789', '2026-03-31', '10:00:00', 'coba saja sih', 1, 450000.00, 450000.00, 'approved', NULL, NULL, '2026-03-28 23:27:27', '2026-03-28 23:54:33'),
(6, 3, 5, 'Inaya', 'Jl Cakalang', '0890123551037391', '2026-04-16', '14:00:00', 'Yg Cantik cantik ya penarinya', 3, 450000.00, 1350000.00, 'paid', '2026-03-30 09:35:40', '2026-03-31 09:35:40', '2026-03-29 01:51:26', '2026-03-31 01:00:19'),
(7, 3, 2, 'Inaya', 'Jl Cakalang', '0890123551037391', '2026-04-02', '09:00:00', NULL, 2, 450000.00, 900000.00, 'paid', NULL, NULL, '2026-03-30 07:10:47', '2026-03-30 09:33:31'),
(8, 3, 5, 'Inaya', 'Jl Cakalang', '0890123551037391', '2026-04-10', '13:00:00', 'wkwkwkwk', 2, 450000.00, 900000.00, 'pending', NULL, NULL, '2026-03-31 00:57:19', '2026-03-31 00:57:19'),
(9, 3, 4, 'Inaya', 'Jl MT. Haryono No 123', '0890123551037391', '2026-04-09', '11:00:00', 'Pakaian jangan terbuka', 5, 450000.00, 2250000.00, 'approved', '2026-03-31 03:07:55', '2026-04-01 03:07:55', '2026-03-31 03:04:07', '2026-03-31 03:07:55'),
(10, 3, 5, 'Inaya', 'Jl Baleng No 14', '089012355103', '2026-04-11', '19:00:00', NULL, 1, 450000.00, 450000.00, 'paid', '2026-03-31 03:34:07', '2026-04-01 03:34:07', '2026-03-31 03:30:34', '2026-03-31 03:37:48'),
(11, 3, 2, 'Inaya', 'Jl Cakalang', '0890123551037391', '2026-04-02', '10:00:00', 'Yang tinggi tinggi ya penarinya', 4, 450000.00, 1800000.00, 'rejected', NULL, NULL, '2026-03-31 04:06:09', '2026-03-31 04:07:21'),
(12, 3, 6, 'Inaya', 'Jl Cakalang', '0890123551037391', '2026-04-03', '14:00:00', NULL, 3, 450000.00, 1350000.00, 'pending', NULL, NULL, '2026-03-31 04:17:48', '2026-03-31 04:17:48');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_03_23_132245_add_username_to_users_table', 1),
(5, '2026_03_28_000001_create_taris_table', 1),
(6, '2026_03_29_021113_add_alamat_and_no_telp_to_users_table', 1),
(7, '2026_03_29_120000_create_bookings_table', 1),
(8, '2026_03_30_000001_update_bookings_add_payment_fields', 2),
(9, '2026_03_30_000002_create_payments_table', 2),
(10, '2026_03_31_000001_add_waktu_tampil_to_bookings_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint UNSIGNED NOT NULL,
  `booking_id` bigint UNSIGNED NOT NULL,
  `bukti_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pengirim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_pengirim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_transfer` decimal(15,2) NOT NULL,
  `catatan_admin` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `confirmed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `booking_id`, `bukti_pembayaran`, `nama_pengirim`, `bank_pengirim`, `jumlah_transfer`, `catatan_admin`, `status`, `confirmed_at`, `created_at`, `updated_at`) VALUES
(1, 7, 'bukti_pembayaran/g0peUNvM7W3ib2AF3ChdaF0A9boyhjH4RCSZvMms.png', 'Inaya', 'BCA', 900000.00, NULL, 'confirmed', '2026-03-30 09:33:31', '2026-03-30 09:27:46', '2026-03-30 09:33:31'),
(2, 6, 'bukti_pembayaran/LEHCuPzzh8sxE4VAEyGGG4YJzN1dxL1BNvyAfGd9.png', 'Inaya', 'BCA', 1350000.00, NULL, 'confirmed', '2026-03-31 01:00:19', '2026-03-31 00:59:00', '2026-03-31 01:00:19'),
(3, 10, 'bukti_pembayaran/uc7VCkACY8TicQuXuOsTUpeeLsyv4qI3LuMkpWLU.png', 'Inaya', 'BCA', 450000.00, NULL, 'confirmed', '2026-03-31 03:37:48', '2026-03-31 03:35:37', '2026-03-31 03:37:48');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('8UzyEtpWmERWekNRzxZHZpXHGXguMZpEkA4KewkV', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWGx0U2RHN2hQZVRnMkk0RmRJU2pmOVgxdks3TU5RT1Fnb1RoQzVDaCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODA4MC9hZG1pbi9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6MTU6ImFkbWluLmRhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1774934152),
('epLONYFurzC4UObpUJgZX02kJH79nFZuRlG7MiPl', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQ1h5U21BNjNNbERocWU2RXBRd2VxVlpCV1B3ZjRocWU2ZzVMMEJxWiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly90ZWNoLmxhYnNpLm15LmlkL2xvZ2luIjtzOjU6InJvdXRlIjtzOjU6ImxvZ2luIjt9czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7fQ==', 1774928365),
('fuRF4EHpWoe8Q8O05QEXzkdfOBfO7ZvYw8GBIyta', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidzA2Y1dqb1NWU0UwSGpCY0FNcERja0dmRXhDRnh6MzNBU2t4UnpUUyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODA4MC9pbmZvcm1hc2ktYm9va2luZyI7czo1OiJyb3V0ZSI7czoxMjoiYm9va2luZy5pbmZvIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mzt9', 1774929877),
('Hm88PCQhr0YBi6RD8toa3eUnl5vUoWIgCMwwqISs', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMkxxbkVXMXFYUmJFWG00ODJ2a3JVSTE1RzFDNG5VTUJNcHZoYVRZaCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly90ZWNoLmxhYnNpLm15LmlkL2Jvb2tpbmcvaGlzdG9yeSI7czo1OiJyb3V0ZSI7czoxNToiYm9va2luZy5oaXN0b3J5Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mzt9', 1774928392),
('Yy56EBDlaNlh6nPKsqwwuo1DyJtDWN0m9nW89Adi', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQlYwaG1LZmRNNWJveHdrQjBtUzRBSFY2dlZuRzI0eWdXV1hlWmlrTCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly90ZWNoLmxhYnNpLm15LmlkL2JlcmFuZGEiO3M6NToicm91dGUiO047fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7fQ==', 1774934364);

-- --------------------------------------------------------

--
-- Table structure for table `tari`
--

CREATE TABLE `tari` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` decimal(15,2) NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tari`
--

INSERT INTO `tari` (`id`, `nama`, `deskripsi`, `harga`, `gambar`, `created_at`, `updated_at`) VALUES
(2, 'Tari Gambyong', 'Tari Gambyong adalah tarian klasik Jawa Tengah dari Surakarta yang terkenal dengan gerakan anggun, lembut, dan dinamis, sering dibawakan untuk penyambutan tamu atau acara adat. Berasal dari tradisi tledhek (tari rakyat), tarian ini dikembangkan menjadi tari keraton yang menggambarkan keluwesan wanita dan kesuburan, sering diiringi gamelan dan sinden.', 450000.00, 'tari/44LgEc3IJIAGB5KzyJJ5fEdNaLCozHspuLKdFknn.jpg', '2026-03-27 23:53:48', '2026-03-30 02:56:36'),
(4, 'Tari Serimpi', 'Tari Serimpi merupakan tarian klasik yang tumbuh di kalangan Keraton Jawa Tengah dan Yogyakarta. Tarian ini dianggap suci, bernuansa kerajaan, dan biasanya dibawakan oleh empat orang penari wanita dengan gerakan yang sangat halus dan lambat, mencerminkan kesopanan dan budi pekerti wanita Jawa', 450000.00, 'tari/yPGAtbBL60cHhHDLONTiCG2zcM0CUl8RYen7rxFt.jpg', '2026-03-28 11:56:12', '2026-03-30 02:56:26'),
(5, 'Tari Bondhan', 'Tari Bondan adalah tarian tradisional asal Surakarta yang menggambarkan kasih sayang seorang ibu kepada anaknya. Tarian ini memiliki ciri khas unik, di mana penari membawa boneka bayi, payung kertas, dan kendi, bahkan sering menari di atas kendi tersebut tanpa menjatuhkannya, melambangkan kehati-hatian ibu dalam merawat anak.', 450000.00, 'tari/Hvlf2Hd8rUlXNOKoiZx4iz79vM4gmJ6mlkjvoAag.webp', '2026-03-28 11:57:55', '2026-03-30 07:18:47'),
(6, 'Tari Bedhaya', 'Tarian Bedhaya merupakan tari klasik keraton, terutama dari Keraton Surakarta, yang sering dipentaskan dalam acara formal keraton. Tari Bedhaya biasanya dibawakan oleh sembilan orang penari wanita dengan gerakan yang sangat teratur, lambat, dan anggun, membawa pesan filosofis, spiritual, dan kisah-kisah kerajaan.', 450000.00, 'tari/Ii3Yq8Wgayn7kvJuH0KINqQHT2UnY5uxixmENNti.webp', '2026-03-28 11:58:36', '2026-03-30 02:54:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_telp` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `alamat`, `no_telp`, `email_verified_at`, `password`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', 'admin@ukmtaripnc.com', NULL, NULL, NULL, '$2y$12$d7wGQuKYZrxDbJOa54aCp.qcjzYQL1UgAsA5tMvM.w1WLw.IVBIUa', 'admin', NULL, '2026-03-30 02:26:12', '2026-03-30 02:26:12'),
(2, 'enay123', 'Inayah Rusli', NULL, 'Jl. Dr. Soetomo 1, Cilacap Selatan', '08123456789', NULL, '$2y$12$ABZWQUz9fendTVG9RtpO6uLMB4dPGW/yBqTbWJDgjo3gBoW3zxAp2', 'user', NULL, '2026-03-28 12:24:58', '2026-03-28 12:24:58'),
(3, 'Imup', 'Inaya', NULL, 'Jl Cakalang', '0890123551037391', NULL, '$2y$12$CkM4B5Pi9xEn1kqhm23csOL8fHTie34dZbnkgWZ0crBXn4v9xEkYy', 'user', NULL, '2026-03-29 01:50:08', '2026-03-29 01:50:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_user_id_foreign` (`user_id`),
  ADD KEY `bookings_tari_id_foreign` (`tari_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

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
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_booking_id_foreign` (`booking_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tari`
--
ALTER TABLE `tari`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tari`
--
ALTER TABLE `tari`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_tari_id_foreign` FOREIGN KEY (`tari_id`) REFERENCES `tari` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
