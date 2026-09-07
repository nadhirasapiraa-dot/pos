-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table pos.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos.cache: ~0 rows (approximately)

-- Dumping structure for table pos.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos.cache_locks: ~0 rows (approximately)

-- Dumping structure for table pos.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table pos.item_penjualan
CREATE TABLE IF NOT EXISTS `item_penjualan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `penjualan_id` bigint unsigned NOT NULL,
  `produk_id` bigint unsigned NOT NULL,
  `kuantitas` int NOT NULL,
  `harga_satuan` int NOT NULL,
  `subtotal` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_penjualan_penjualan_id_foreign` (`penjualan_id`),
  KEY `item_penjualan_produk_id_foreign` (`produk_id`),
  CONSTRAINT `item_penjualan_penjualan_id_foreign` FOREIGN KEY (`penjualan_id`) REFERENCES `penjualan` (`id`),
  CONSTRAINT `item_penjualan_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos.item_penjualan: ~0 rows (approximately)
INSERT INTO `item_penjualan` (`id`, `penjualan_id`, `produk_id`, `kuantitas`, `harga_satuan`, `subtotal`, `created_at`, `updated_at`) VALUES
	(1, 2, 1, 7, 50700, 354900, '2026-09-07 04:12:19', '2026-09-07 04:12:19'),
	(2, 3, 8, 2, 17500, 35000, '2026-09-07 04:12:40', '2026-09-07 04:12:46'),
	(3, 3, 3, 1, 8000, 8000, '2026-09-07 04:12:49', '2026-09-07 04:12:49'),
	(4, 3, 9, 1, 20000, 20000, '2026-09-07 04:12:54', '2026-09-07 04:12:54'),
	(9, 5, 1, 1, 50700, 50700, '2026-09-07 04:18:42', '2026-09-07 04:18:42'),
	(11, 5, 8, 6, 17500, 105000, '2026-09-07 04:18:57', '2026-09-07 04:18:57'),
	(12, 6, 1, 1, 50700, 50700, '2026-09-07 04:19:16', '2026-09-07 04:19:16'),
	(13, 6, 12, 6, 5500, 33000, '2026-09-07 04:19:22', '2026-09-07 04:19:29'),
	(14, 7, 1, 1, 50700, 50700, '2026-09-07 04:20:39', '2026-09-07 04:20:39'),
	(15, 7, 9, 1, 20000, 20000, '2026-09-07 04:20:44', '2026-09-07 04:20:44'),
	(16, 7, 2, 3, 26000, 78000, '2026-09-07 04:20:54', '2026-09-07 04:20:54'),
	(17, 8, 8, 1, 17500, 17500, '2026-09-07 04:23:24', '2026-09-07 04:23:24'),
	(18, 8, 11, 1, 20000, 20000, '2026-09-07 04:23:30', '2026-09-07 04:23:30'),
	(19, 9, 5, 1, 7500, 7500, '2026-09-07 04:23:53', '2026-09-07 04:23:53'),
	(20, 10, 4, 1, 5000, 5000, '2026-09-07 04:24:09', '2026-09-07 04:24:09'),
	(21, 11, 1, 1, 50700, 50700, '2026-09-07 04:24:27', '2026-09-07 04:24:27'),
	(22, 12, 6, 1, 4000, 4000, '2026-09-07 04:24:51', '2026-09-07 04:24:51'),
	(23, 13, 1, 1, 50700, 50700, '2026-09-07 04:26:10', '2026-09-07 04:26:10');

-- Dumping structure for table pos.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos.jobs: ~0 rows (approximately)

-- Dumping structure for table pos.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos.job_batches: ~0 rows (approximately)

-- Dumping structure for table pos.kategoris
CREATE TABLE IF NOT EXISTS `kategoris` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos.kategoris: ~0 rows (approximately)
INSERT INTO `kategoris` (`id`, `nama`, `created_at`, `updated_at`) VALUES
	(1, 'sembako', '2026-09-07 03:02:33', '2026-09-07 03:02:33'),
	(2, 'snack', '2026-09-07 03:04:47', '2026-09-07 03:04:47'),
	(3, 'kebutuhan rumah tangga', '2026-09-07 04:08:35', '2026-09-07 04:09:22');

-- Dumping structure for table pos.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos.migrations: ~1 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_roles_table', 1),
	(2, '0001_01_01_000000_create_users_table', 1),
	(3, '0001_01_01_000001_create_cache_table', 1),
	(4, '0001_01_01_000002_create_jobs_table', 1),
	(5, '2026_07_23_124220_create_kategoris_table', 1),
	(6, '2026_07_23_124221_create_produk_table', 1),
	(7, '2026_07_23_124628_create_penjualan_table', 1),
	(8, '2026_07_24_084821_create_item_penjualan_table', 1);

-- Dumping structure for table pos.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table pos.penjualan
CREATE TABLE IF NOT EXISTS `penjualan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `total_pembayaran` int NOT NULL,
  `metode_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('OPEN','SUCCESS','COMPLETED') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `penjualan_user_id_foreign` (`user_id`),
  CONSTRAINT `penjualan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos.penjualan: ~0 rows (approximately)
INSERT INTO `penjualan` (`id`, `user_id`, `total_pembayaran`, `metode_pembayaran`, `status`, `created_at`, `updated_at`) VALUES
	(2, 1, 354900, 'CASH', 'COMPLETED', '2026-09-07 04:12:14', '2026-09-07 04:12:29'),
	(3, 1, 63000, 'CASH', 'COMPLETED', '2026-09-07 04:12:35', '2026-09-07 04:13:36'),
	(5, 6, 155700, 'CASH', 'COMPLETED', '2026-09-07 04:16:36', '2026-09-07 04:19:05'),
	(6, 6, 83700, 'QRIS', 'COMPLETED', '2026-09-07 04:19:12', '2026-09-07 04:19:37'),
	(7, 6, 148700, 'QRIS', 'COMPLETED', '2026-09-07 04:20:35', '2026-09-07 04:21:04'),
	(8, 7, 37500, 'QRIS', 'COMPLETED', '2026-09-07 04:23:20', '2026-09-07 04:23:41'),
	(9, 7, 7500, 'QRIS', 'COMPLETED', '2026-09-07 04:23:46', '2026-09-07 04:24:01'),
	(10, 7, 5000, 'CASH', 'COMPLETED', '2026-09-07 04:24:05', '2026-09-07 04:24:18'),
	(11, 7, 50700, 'CASH', 'COMPLETED', '2026-09-07 04:24:22', '2026-09-07 04:24:34'),
	(12, 7, 4000, 'CASH', 'COMPLETED', '2026-09-07 04:24:40', '2026-09-07 04:24:58'),
	(13, 6, 50700, 'CASH', 'COMPLETED', '2026-09-07 04:26:05', '2026-09-07 04:26:24');

-- Dumping structure for table pos.produk
CREATE TABLE IF NOT EXISTS `produk` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `kategori_id` bigint unsigned NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_beli` int NOT NULL,
  `harga_jual` int NOT NULL,
  `stok` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `produk_user_id_foreign` (`user_id`),
  KEY `produk_kategori_id_foreign` (`kategori_id`),
  KEY `produk_nama_index` (`nama`),
  CONSTRAINT `produk_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategoris` (`id`) ON DELETE CASCADE,
  CONSTRAINT `produk_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos.produk: ~0 rows (approximately)
INSERT INTO `produk` (`id`, `user_id`, `kategori_id`, `foto`, `nama`, `harga_beli`, `harga_jual`, `stok`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 'products/tWhMx0VrvkUrA0IaGCKOgUpWrYwMYw6A9L7LQ8As.jpg', 'beras', 50000, 50700, 33, '2026-09-07 03:03:18', '2026-09-07 04:26:10'),
	(2, 1, 1, 'products/Zd9Vo8lmNAR9Il6PlcbjJEPnBBayDaCE1ym8l9ya.jpg', 'minyak', 25000, 26000, 47, '2026-09-07 03:04:17', '2026-09-07 04:20:54'),
	(3, 1, 2, 'products/yD3eTYwMyxJammRezi5aeQhCFwXmYUpEZ6DayOL7.jpg', 'lays', 7000, 8000, 20, '2026-09-07 03:05:18', '2026-09-07 04:12:49'),
	(4, 1, 2, 'products/uXt7ra2M2iE4YaQPCwMmf4Nd41CxTBJJN1iWPIQW.jpg', 'momogi', 4000, 5000, 31, '2026-09-07 04:01:25', '2026-09-07 04:24:09'),
	(5, 1, 2, 'products/yAMIhTuyFhKlqX5PKVunvPq8Evn3PizreYeOWsex.jpg', 'makaroni bon cabe', 7000, 7500, 2, '2026-09-07 04:02:09', '2026-09-07 04:23:53'),
	(6, 1, 2, 'products/WnkZVUHZ9UYn3mTFsLjaeGSIO0c5LHMQ3LUY1VJ6.jpg', 'french fries', 3500, 4000, 31, '2026-09-07 04:03:02', '2026-09-07 04:24:51'),
	(7, 1, 2, 'products/pUWoI8HM6iI3B26llY8cCr1C1t8LeiQzJA3Ox6Zi.jpg', 'gery', 3400, 4000, 65, '2026-09-07 04:03:32', '2026-09-07 04:18:12'),
	(8, 1, 2, 'products/6nplbTQQrjxyuygM5eO5XJZEvDw5rwzbANPla7Xd.jpg', 'dairy milk', 17000, 17500, 47, '2026-09-07 04:05:59', '2026-09-07 04:23:24'),
	(9, 1, 2, 'products/4Ya4JIAkcyohKw4U57nWhz0GJqZw7UqWaQiMoF8k.jpg', 'silverqueen', 17500, 20000, 21, '2026-09-07 04:06:45', '2026-09-07 04:20:44'),
	(10, 1, 2, 'products/I5tBY1RDREFc2gnKAc9a1UZndq3zy1W9NdCDy3JU.jpg', 'kitkat', 12000, 15000, 4, '2026-09-07 04:07:23', '2026-09-07 04:07:23'),
	(11, 1, 3, 'products/LKd0Lu9dhUTYGwrNdtncD7lpp9ZOh8caWpryi6SB.jpg', 'lifebuoy', 17000, 20000, 30, '2026-09-07 04:10:38', '2026-09-07 04:23:30'),
	(12, 1, 3, 'products/yIGgQblekv0MY4Fm7ElB3BzApzoZVcQXzNNrsQvp.jpg', 'sunlight', 5000, 5500, 25, '2026-09-07 04:11:47', '2026-09-07 04:19:29');

-- Dumping structure for table pos.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos.roles: ~4 rows (approximately)
INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'admin', '2026-09-07 02:58:43', '2026-09-07 02:58:43'),
	(2, 'kasir', '2026-09-07 02:58:43', '2026-09-07 02:58:43');

-- Dumping structure for table pos.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos.sessions: ~1 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('swuNFLiPbtQCDhnmxUhwOx7UpIeG7ymFc6iafvLq', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieEpCdzFqOGU1cHBHSzFMVUNMQUtERUhpVGJOUW1vbHJRNXVRVkFhRSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZW5qdWFsYW4iO3M6NToicm91dGUiO3M6MTU6InBlbmp1YWxhbi5pbmRleCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjY7fQ==', 1788755209);

-- Dumping structure for table pos.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  FULLTEXT KEY `users_name_email_fulltext` (`name`,`email`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos.users: ~5 rows (approximately)
INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Lilla Miller', 'lourdes.roberts@example.com', '2026-09-07 02:59:27', '$2y$12$r9GCndClRuxBw8aitVRXl.aNYRw2vLEYX0SsqzBUODT6qhu48dZey', 'kUMoDuW8pHlwOJcZIMOruhRlDj3d7phmqoZtx22djuAgl9CWG4w6Bb7Zkvjr', '2026-09-07 02:59:28', '2026-09-07 02:59:28'),
	(2, 2, 'Augustine Hagenes', 'donnell42@example.net', '2026-09-07 02:59:28', '$2y$12$r9GCndClRuxBw8aitVRXl.aNYRw2vLEYX0SsqzBUODT6qhu48dZey', 'CFILYl3yKM', '2026-09-07 02:59:28', '2026-09-07 02:59:28'),
	(3, 1, 'Mrs. Loma Stamm PhD', 'caesar.wintheiser@example.com', '2026-09-07 02:59:28', '$2y$12$r9GCndClRuxBw8aitVRXl.aNYRw2vLEYX0SsqzBUODT6qhu48dZey', 'BH4aKe0Qx0', '2026-09-07 02:59:28', '2026-09-07 02:59:28'),
	(4, 1, 'Miss Maye Farrell', 'heidenreich.claud@example.net', '2026-09-07 02:59:28', '$2y$12$r9GCndClRuxBw8aitVRXl.aNYRw2vLEYX0SsqzBUODT6qhu48dZey', 'dxrmNJDkW2', '2026-09-07 02:59:28', '2026-09-07 02:59:28'),
	(6, 1, 'nadira', 'nadira@gmail.com', NULL, '$2y$12$tOgWZF5ewnbTDF0D8w/pFuF5hUyUj/MMVme.Er3Qcwv1/gshN974u', NULL, '2026-09-07 03:00:15', '2026-09-07 03:00:15'),
	(7, 2, 'nanad', 'nanad@gmail.com', NULL, '$2y$12$pNaYg9T/pSBHnEuQydTU..DJaPmGtXezzZlxJT.BaIrk5l3jE4BNW', NULL, '2026-09-07 03:00:45', '2026-09-07 03:00:45'),
	(8, 1, 'nadirasapira', 'nadirasapira@gmail.com', NULL, '$2y$12$8jHDjiKEwE0NemcM8H3.oOGuOGpW63BRP2HojhxqobRWTtOSotezW', NULL, '2026-09-07 03:01:10', '2026-09-07 03:01:10');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
`pos-nad`