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

-- Dumping structure for table synewave.failed_jobs
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

-- Dumping data for table synewave.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table synewave.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table synewave.migrations: ~0 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2023_10_19_074824_create_token_lists_table', 1),
	(6, '2023_10_19_075225_create_token_purchases_table', 1),
	(7, '2023_10_19_080108_create_wallet_histories_table', 1),
	(8, '2023_10_19_081013_create_songs_table', 1),
	(9, '2023_10_19_133305_create_song_reactions_table', 1),
	(10, '2023_11_21_100910_create_playlists_table', 1),
	(11, '2023_11_21_102853_create_playlist_songs_table', 1),
	(12, '2023_11_30_090301_create_user_playlists_table', 1);

-- Dumping structure for table synewave.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table synewave.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table synewave.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table synewave.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table synewave.playlists
CREATE TABLE IF NOT EXISTS `playlists` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `playlist_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `playlist_art` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `playlist_genre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `playlist_streams` int NOT NULL DEFAULT '0',
  `playlist_credits` double(8,2) NOT NULL DEFAULT '0.00',
  `playlist_expiration_in_days` int NOT NULL DEFAULT '30',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table synewave.playlists: ~0 rows (approximately)

-- Dumping structure for table synewave.playlist_songs
CREATE TABLE IF NOT EXISTS `playlist_songs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `playlist_id` int NOT NULL,
  `song_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table synewave.playlist_songs: ~0 rows (approximately)

-- Dumping structure for table synewave.songs
CREATE TABLE IF NOT EXISTS `songs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `song_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `song_art` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `song_desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `song_feat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `song_album` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `song_track_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `song_streams` int NOT NULL DEFAULT '0',
  `song_stored` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table synewave.songs: ~0 rows (approximately)

-- Dumping structure for table synewave.song_reactions
CREATE TABLE IF NOT EXISTS `song_reactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `song_id` int NOT NULL,
  `reaction` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table synewave.song_reactions: ~0 rows (approximately)

-- Dumping structure for table synewave.token_lists
CREATE TABLE IF NOT EXISTS `token_lists` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `token_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token_desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token_price` double(8,2) NOT NULL DEFAULT '0.00',
  `token_expiry` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credits` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table synewave.token_lists: ~0 rows (approximately)

-- Dumping structure for table synewave.token_purchases
CREATE TABLE IF NOT EXISTS `token_purchases` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `token_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token_price` double(8,2) NOT NULL DEFAULT '0.00',
  `credits` int NOT NULL DEFAULT '0',
  `token_purchase_txref` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token_purchase_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table synewave.token_purchases: ~0 rows (approximately)

-- Dumping structure for table synewave.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','user','artist') COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nickname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password_reset` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wallet` double(8,2) NOT NULL DEFAULT '0.00',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_nickname_unique` (`nickname`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table synewave.users: ~1 rows (approximately)
INSERT INTO `users` (`id`, `unique_id`, `role`, `name`, `avatar`, `nickname`, `phone`, `email`, `dob`, `email_verified_at`, `password_reset`, `password`, `wallet`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, '001', 'admin', 'Admin', NULL, 'superman', '08077665544', 'admin@admin.com', NULL, '2023-12-18 12:59:00', NULL, '$2y$10$py5PwQ32WShpplFmd.0jYe8a5ZaIcqe7BG9zWzo0xpR8Ilx0wwGqq', 0.00, 'szakzgJR4K', '2023-12-18 12:59:00', '2023-12-18 12:59:00');

-- Dumping structure for table synewave.user_playlists
CREATE TABLE IF NOT EXISTS `user_playlists` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `playlist_id` int NOT NULL,
  `playlist_to_expire` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table synewave.user_playlists: ~0 rows (approximately)

-- Dumping structure for table synewave.wallet_histories
CREATE TABLE IF NOT EXISTS `wallet_histories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `credit_from_id` int NOT NULL DEFAULT '0',
  `credit_to_id` int NOT NULL DEFAULT '0',
  `credits` double(8,2) NOT NULL DEFAULT '0.00',
  `playlist_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table synewave.wallet_histories: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
