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


-- Dumping database structure for db_dinas_perkim
CREATE DATABASE IF NOT EXISTS `db_dinas_perkim` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `db_dinas_perkim`;

-- Dumping structure for table db_dinas_perkim.activity_logs
CREATE TABLE IF NOT EXISTS `activity_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_id` bigint unsigned DEFAULT NULL,
  `model_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `old_values` json DEFAULT NULL,
  `new_values` json DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_logs_user_id_created_at_index` (`user_id`,`created_at`),
  KEY `activity_logs_model_model_id_index` (`model`,`model_id`),
  CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_dinas_perkim.activity_logs: ~109 rows (approximately)
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `model`, `model_id`, `model_title`, `old_values`, `new_values`, `description`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES
	(1, 1, 'login', NULL, NULL, NULL, NULL, NULL, 'Login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36', '2025-08-18 19:48:00', '2025-08-18 19:53:00'),
	(2, 1, 'create', 'Berita', 1, 'Pengumuman Terbaru dari Dinas Perkim', NULL, NULL, 'Membuat berita: Pengumuman Terbaru dari Dinas Perkim', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36', '2025-08-18 19:43:00', '2025-08-18 19:53:00'),
	(3, 1, 'update', 'Halaman', 1, 'Profil Dinas', NULL, NULL, 'Memperbarui halaman: Profil Dinas', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36', '2025-08-18 19:38:00', '2025-08-18 19:53:00'),
	(4, 1, 'create', 'Galeri', 1, 'Kegiatan Pembangunan Jalan', NULL, NULL, 'Membuat foto galeri: Kegiatan Pembangunan Jalan', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36', '2025-08-18 19:33:00', '2025-08-18 19:53:00'),
	(5, 1, 'view', 'Pesan', NULL, NULL, NULL, NULL, 'Melihat pesan dari masyarakat', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36', '2025-08-18 19:28:00', '2025-08-18 19:53:00'),
	(6, 1, 'update', 'Pejabat', 1, 'Kepala Dinas Perkim', NULL, NULL, 'Memperbarui data pejabat: Kepala Dinas Perkim', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36', '2025-08-18 19:23:00', '2025-08-18 19:53:00'),
	(7, 1, 'logout', NULL, NULL, NULL, NULL, NULL, 'Logout dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-18 19:54:50', '2025-08-18 19:54:50'),
	(8, 1, 'login', NULL, NULL, NULL, NULL, NULL, 'Login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-18 20:03:31', '2025-08-18 20:03:31'),
	(9, 1, 'logout', NULL, NULL, NULL, NULL, NULL, 'Logout dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-18 20:03:47', '2025-08-18 20:03:47'),
	(10, 1, 'login', NULL, NULL, NULL, NULL, NULL, 'Login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-18 20:08:46', '2025-08-18 20:08:46'),
	(11, 1, 'logout', NULL, NULL, NULL, NULL, NULL, 'Logout dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-18 20:15:56', '2025-08-18 20:15:56'),
	(12, 1, 'login', NULL, NULL, NULL, NULL, NULL, 'Login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-18 20:35:07', '2025-08-18 20:35:07'),
	(13, 1, 'logout', NULL, NULL, NULL, NULL, NULL, 'Logout dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-18 20:37:31', '2025-08-18 20:37:31'),
	(14, 1, 'login', NULL, NULL, NULL, NULL, NULL, 'Login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-18 20:37:45', '2025-08-18 20:37:45'),
	(15, 1, 'logout', NULL, NULL, NULL, NULL, NULL, 'Logout dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-18 20:48:15', '2025-08-18 20:48:15'),
	(16, 1, 'login', NULL, NULL, NULL, NULL, NULL, 'Login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-19 00:09:22', '2025-08-19 00:09:22'),
	(17, 1, 'logout', NULL, NULL, NULL, NULL, NULL, 'Logout dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-19 00:09:53', '2025-08-19 00:09:53'),
	(18, 1, 'login', NULL, NULL, NULL, NULL, NULL, 'Login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-19 01:23:48', '2025-08-19 01:23:48'),
	(19, 1, 'create', 'Halaman', 5, 'testing page dengan gambar', NULL, NULL, 'Membuat halaman: testing page dengan gambar', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-19 01:30:34', '2025-08-19 01:30:34'),
	(20, 1, 'logout', NULL, NULL, NULL, NULL, NULL, 'Logout dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-19 01:32:14', '2025-08-19 01:32:14'),
	(21, 1, 'login', NULL, NULL, NULL, NULL, NULL, 'Login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-19 01:45:17', '2025-08-19 01:45:17'),
	(22, 1, 'logout', NULL, NULL, NULL, NULL, NULL, 'Logout dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-19 02:55:51', '2025-08-19 02:55:51'),
	(23, 1, 'login', NULL, NULL, NULL, NULL, NULL, 'Login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-19 02:56:40', '2025-08-19 02:56:40'),
	(24, 1, 'update', 'Halaman', 5, 'testing page dengan gambar', NULL, NULL, 'Memperbarui halaman: testing page dengan gambar', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-19 03:18:02', '2025-08-19 03:18:02'),
	(25, 1, 'logout', NULL, NULL, NULL, NULL, NULL, 'Logout dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-19 03:18:08', '2025-08-19 03:18:08'),
	(26, 1, 'login', NULL, NULL, NULL, NULL, NULL, 'Login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-19 03:22:50', '2025-08-19 03:22:50'),
	(27, 1, 'update', 'Halaman', 5, 'testing page dengan gambar', NULL, NULL, 'Memperbarui halaman: testing page dengan gambar', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-19 03:23:41', '2025-08-19 03:23:41'),
	(28, 1, 'update', 'Halaman', 5, 'testing page dengan gambar', NULL, NULL, 'Memperbarui halaman: testing page dengan gambar', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-19 03:37:05', '2025-08-19 03:37:05'),
	(29, 1, 'update', 'Halaman', 5, 'testing page dengan gambar', NULL, NULL, 'Memperbarui halaman: testing page dengan gambar', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-19 03:37:14', '2025-08-19 03:37:14'),
	(30, 1, 'update', 'Halaman', 5, 'testing page dengan gambar', NULL, NULL, 'Memperbarui halaman: testing page dengan gambar', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-19 03:40:24', '2025-08-19 03:40:24'),
	(31, 1, 'update', 'Halaman', 5, 'testing page dengan gambar', NULL, NULL, 'Memperbarui halaman: testing page dengan gambar', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-19 03:40:39', '2025-08-19 03:40:39'),
	(32, 1, 'login', NULL, NULL, NULL, NULL, NULL, 'Login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-19 19:34:05', '2025-08-19 19:34:05'),
	(33, 1, 'delete', 'Berita', 11, 'string', NULL, NULL, 'Menghapus berita: string', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-19 19:42:43', '2025-08-19 19:42:43'),
	(34, 1, 'delete', 'Berita', 10, 'Test Berita dari HTML', NULL, NULL, 'Menghapus berita: Test Berita dari HTML', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-19 19:44:27', '2025-08-19 19:44:27'),
	(35, 1, 'delete', 'Berita', 6, 'Pembangunan Jembatan Baru di Kota Tanjung', NULL, NULL, 'Menghapus berita: Pembangunan Jembatan Baru di Kota Tanjung', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-19 19:44:30', '2025-08-19 19:44:30'),
	(36, 1, 'delete', 'Berita', 7, 'Program Peningkatan Infrastruktur Jalan Desa', NULL, NULL, 'Menghapus berita: Program Peningkatan Infrastruktur Jalan Desa', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-19 19:44:34', '2025-08-19 19:44:34'),
	(37, 1, 'delete', 'Berita', 8, 'Rapat Koordinasi Perencanaan Pembangunan 2025', NULL, NULL, 'Menghapus berita: Rapat Koordinasi Perencanaan Pembangunan 2025', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-19 19:44:37', '2025-08-19 19:44:37'),
	(38, 1, 'delete', 'Berita', 9, 'Sosialisasi Program Perumahan Rakyat', NULL, NULL, 'Menghapus berita: Sosialisasi Program Perumahan Rakyat', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-19 19:44:40', '2025-08-19 19:44:40'),
	(39, 1, 'update', 'Berita', 5, 'Ini adalah ujicoba fitur tambah berita baru (111)', NULL, NULL, 'Memperbarui berita: Ini adalah ujicoba fitur tambah berita baru (111)', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-19 19:52:35', '2025-08-19 19:52:35'),
	(40, 1, 'update', 'Berita', 5, 'Ini adalah ujicoba fitur tambah berita baru (111)', NULL, NULL, 'Memperbarui berita: Ini adalah ujicoba fitur tambah berita baru (111)', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-19 19:55:04', '2025-08-19 19:55:04'),
	(41, 1, 'logout', NULL, NULL, NULL, NULL, NULL, 'Logout dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-19 19:55:11', '2025-08-19 19:55:11'),
	(42, 1, 'login', NULL, NULL, NULL, NULL, NULL, 'Login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-19 20:07:47', '2025-08-19 20:07:47'),
	(43, 1, 'update', 'Berita', 5, 'Ini adalah ujicoba fitur tambah berita baru (111)', NULL, NULL, 'Memperbarui berita: Ini adalah ujicoba fitur tambah berita baru (111)', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-19 20:12:07', '2025-08-19 20:12:07'),
	(44, 1, 'create', 'Berita', 12, 'testing page dengan gambar', NULL, NULL, 'Membuat berita: testing page dengan gambar', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-19 20:37:43', '2025-08-19 20:37:43'),
	(45, 1, 'update', 'Berita', 12, 'testing page dengan gambar', NULL, NULL, 'Memperbarui berita: testing page dengan gambar', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-19 20:37:53', '2025-08-19 20:37:53'),
	(46, 1, 'create', 'Berita', 13, 'testing fitur gambar', NULL, NULL, 'Membuat berita: testing fitur gambar', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-19 20:51:08', '2025-08-19 20:51:08'),
	(47, 1, 'logout', NULL, NULL, NULL, NULL, NULL, 'Logout dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-19 20:51:14', '2025-08-19 20:51:14'),
	(48, 1, 'login', NULL, NULL, NULL, NULL, NULL, 'Login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-19 20:52:30', '2025-08-19 20:52:30'),
	(49, 1, 'update', 'Berita', 13, 'testing fitur gambar', NULL, NULL, 'Memperbarui berita: testing fitur gambar', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-19 20:52:54', '2025-08-19 20:52:54'),
	(50, 1, 'create', 'Halaman', 6, 'Evaluasi UX dan Analisis Sentimen Pengguna E-Commerce: Studi Komparatif Shopee dan Tokopedia dengan Metode UEQ dan Pendekatan NLP', NULL, NULL, 'Membuat halaman: Evaluasi UX dan Analisis Sentimen Pengguna E-Commerce: Studi Komparatif Shopee dan Tokopedia dengan Metode UEQ dan Pendekatan NLP', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-19 20:53:24', '2025-08-19 20:53:24'),
	(51, 1, 'update', 'Halaman', 6, 'tester', NULL, NULL, 'Memperbarui halaman: tester', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-19 20:54:13', '2025-08-19 20:54:13'),
	(52, 1, 'login', NULL, NULL, NULL, NULL, NULL, 'Login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-20 01:08:14', '2025-08-20 01:08:14'),
	(53, 1, 'logout', NULL, NULL, NULL, NULL, NULL, 'Logout dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-20 01:49:19', '2025-08-20 01:49:19'),
	(54, 1, 'login', NULL, NULL, NULL, NULL, NULL, 'Login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-20 01:52:11', '2025-08-20 01:52:11'),
	(55, 1, 'logout', NULL, NULL, NULL, NULL, NULL, 'Logout dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-20 01:59:07', '2025-08-20 01:59:07'),
	(56, 1, 'login', NULL, NULL, NULL, NULL, NULL, 'Login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-20 18:45:48', '2025-08-20 18:45:48'),
	(57, 1, 'logout', NULL, NULL, NULL, NULL, NULL, 'Logout dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-20 18:45:56', '2025-08-20 18:45:56'),
	(58, 1, 'login', NULL, NULL, NULL, NULL, NULL, 'Login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-20 20:55:39', '2025-08-20 20:55:39'),
	(59, 1, 'login', NULL, NULL, NULL, NULL, NULL, 'Login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-21 00:46:25', '2025-08-21 00:46:25'),
	(60, 1, 'delete', 'Halaman', 6, 'tester', NULL, NULL, 'Menghapus halaman: tester', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-21 00:47:24', '2025-08-21 00:47:24'),
	(61, 1, 'delete', 'Halaman', 5, 'testing page dengan gambar', NULL, NULL, 'Menghapus halaman: testing page dengan gambar', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-21 00:47:28', '2025-08-21 00:47:28'),
	(62, 1, 'update', 'Halaman', 4, 'Visi & Misi', NULL, NULL, 'Memperbarui halaman: Visi & Misi', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-21 00:50:28', '2025-08-21 00:50:28'),
	(63, 1, 'delete', 'Halaman', 4, 'Visi & Misi', NULL, NULL, 'Menghapus halaman: Visi & Misi', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-21 01:35:36', '2025-08-21 01:35:36'),
	(64, 1, 'delete', 'Halaman', 3, 'Profil Dinas', NULL, NULL, 'Menghapus halaman: Profil Dinas', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-21 01:35:40', '2025-08-21 01:35:40'),
	(65, 1, 'login', NULL, NULL, NULL, NULL, NULL, 'Login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-21 19:31:58', '2025-08-21 19:31:58'),
	(66, 1, 'logout', NULL, NULL, NULL, NULL, NULL, 'Logout dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-21 20:40:20', '2025-08-21 20:40:20'),
	(67, 1, 'login', NULL, NULL, NULL, NULL, NULL, 'Login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-22 20:18:04', '2025-08-22 20:18:04'),
	(68, 1, 'logout', NULL, NULL, NULL, NULL, NULL, 'Logout dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-22 21:52:02', '2025-08-22 21:52:02'),
	(69, 1, 'login', NULL, NULL, NULL, NULL, NULL, 'Login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-22 22:45:47', '2025-08-22 22:45:47'),
	(70, 1, 'logout', NULL, NULL, NULL, NULL, NULL, 'Logout dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-22 22:59:18', '2025-08-22 22:59:18'),
	(71, 1, 'login', NULL, NULL, NULL, NULL, NULL, 'Login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-22 23:02:48', '2025-08-22 23:02:48'),
	(72, 1, 'login', NULL, NULL, NULL, NULL, NULL, 'Login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-24 21:03:39', '2025-08-24 21:03:39'),
	(73, 1, 'delete', 'Berita', 18, 'Test API Create Berita', NULL, NULL, 'Menghapus berita: Test API Create Berita', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-24 21:29:10', '2025-08-24 21:29:10'),
	(74, 1, 'delete', 'Berita', 16, 'Rapat Koordinasi Perencanaan Pembangunan 2025', NULL, NULL, 'Menghapus berita: Rapat Koordinasi Perencanaan Pembangunan 2025', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-24 21:29:18', '2025-08-24 21:29:18'),
	(75, 1, 'login', NULL, NULL, NULL, NULL, NULL, 'Login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-25 18:54:25', '2025-08-25 18:54:25'),
	(76, 1, 'delete', 'Berita', 14, 'Pembangunan Jembatan Baru di Kota Tanjung', NULL, NULL, 'Menghapus berita: Pembangunan Jembatan Baru di Kota Tanjung', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-25 18:54:35', '2025-08-25 18:54:35'),
	(77, 1, 'delete', 'Berita', 15, 'Program Peningkatan Infrastruktur Jalan Desa', NULL, NULL, 'Menghapus berita: Program Peningkatan Infrastruktur Jalan Desa', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-25 18:54:38', '2025-08-25 18:54:38'),
	(78, 1, 'delete', 'Berita', 17, 'Sosialisasi Program Perumahan Rakyat', NULL, NULL, 'Menghapus berita: Sosialisasi Program Perumahan Rakyat', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-25 18:54:41', '2025-08-25 18:54:41'),
	(79, 1, 'update', 'Berita', 13, 'testing fitur gambar', NULL, NULL, 'Memperbarui berita: testing fitur gambar', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-25 18:56:05', '2025-08-25 18:56:05'),
	(80, 1, 'login', NULL, NULL, NULL, NULL, NULL, 'Login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 18:29:24', '2025-08-26 18:29:24'),
	(81, 1, 'delete', 'Berita', 13, 'testing fitur update judul', NULL, NULL, 'Menghapus berita: testing fitur update judul', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 20:28:10', '2025-08-26 20:28:10'),
	(82, 1, 'delete', 'Berita', 12, 'testing page dengan gambar', NULL, NULL, 'Menghapus berita: testing page dengan gambar', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 20:28:14', '2025-08-26 20:28:14'),
	(83, 1, 'delete', 'Berita', 4, 'Evaluasi UX dan Analisis Sentimen Pengguna E-Commerce: Studi Komparatif Shopee dan Tokopedia dengan Metode UEQ dan Pendekatan NLP', NULL, NULL, 'Menghapus berita: Evaluasi UX dan Analisis Sentimen Pengguna E-Commerce: Studi Komparatif Shopee dan Tokopedia dengan Metode UEQ dan Pendekatan NLP', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 20:28:19', '2025-08-26 20:28:19'),
	(84, 1, 'update', 'Pejabat', 5, 'AHMAD FADLILAH RAMADLAN', NULL, NULL, 'Memperbarui data pejabat: AHMAD FADLILAH RAMADLAN', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 20:30:39', '2025-08-26 20:30:39'),
	(85, 1, 'update', 'Pejabat', 6, 'Depro Winoto', NULL, NULL, 'Memperbarui data pejabat: Depro Winoto', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 20:30:50', '2025-08-26 20:30:50'),
	(86, 1, 'update', 'Pejabat', 7, 'Abu Bakar', NULL, NULL, 'Memperbarui data pejabat: Abu Bakar', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 20:31:00', '2025-08-26 20:31:00'),
	(87, 1, 'update', 'Pejabat', 8, 'Umar bin Khat', NULL, NULL, 'Memperbarui data pejabat: Umar bin Khat', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-26 20:31:12', '2025-08-26 20:31:12'),
	(88, 1, 'login', NULL, NULL, NULL, NULL, NULL, 'Login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-27 00:47:37', '2025-08-27 00:47:37'),
	(89, 1, 'login', NULL, NULL, NULL, NULL, NULL, 'Login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-27 18:43:51', '2025-08-27 18:43:51'),
	(90, 1, 'logout', NULL, NULL, NULL, NULL, NULL, 'Logout dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-27 18:51:41', '2025-08-27 18:51:41'),
	(91, 1, 'login', NULL, NULL, NULL, NULL, NULL, 'Login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-27 19:17:19', '2025-08-27 19:17:19'),
	(92, 1, 'login', NULL, NULL, NULL, NULL, NULL, 'Login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-31 19:10:57', '2025-08-31 19:10:57'),
	(93, 1, 'logout', NULL, NULL, NULL, NULL, NULL, 'Logout dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-31 19:11:18', '2025-08-31 19:11:18'),
	(94, 1, 'login', NULL, NULL, NULL, NULL, NULL, 'Login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-31 19:36:44', '2025-08-31 19:36:44'),
	(95, 1, 'logout', NULL, NULL, NULL, NULL, NULL, 'Logout dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-31 19:45:23', '2025-08-31 19:45:23'),
	(96, 1, 'login', NULL, NULL, NULL, NULL, NULL, 'Login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-01 19:53:19', '2025-09-01 19:53:19'),
	(97, 1, 'login', NULL, NULL, NULL, NULL, NULL, 'Login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-02 01:23:41', '2025-09-02 01:23:41'),
	(98, 1, 'logout', NULL, NULL, NULL, NULL, NULL, 'Logout dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-02 01:26:19', '2025-09-02 01:26:19'),
	(99, 1, 'login', NULL, NULL, NULL, NULL, NULL, 'Login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-02 19:45:22', '2025-09-02 19:45:22'),
	(100, 1, 'delete', 'Berita', 19, 'Test Berita API CRUD', NULL, NULL, 'Menghapus berita: Test Berita API CRUD', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-02 19:45:53', '2025-09-02 19:45:53'),
	(101, 1, 'delete', 'Berita', 21, 'Final Test CRUD Complete', NULL, NULL, 'Menghapus berita: Final Test CRUD Complete', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-02 19:45:57', '2025-09-02 19:45:57'),
	(102, 1, 'update', 'Berita', 3, 'Pembangunan Rumah Layak Huni Tahap 1', NULL, NULL, 'Memperbarui berita: Pembangunan Rumah Layak Huni Tahap 1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-02 19:47:07', '2025-09-02 19:47:07'),
	(103, 1, 'logout', NULL, NULL, NULL, NULL, NULL, 'Logout dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-02 19:58:02', '2025-09-02 19:58:02'),
	(104, 1, 'login', NULL, NULL, NULL, NULL, NULL, 'Login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-02 21:28:02', '2025-09-02 21:28:02'),
	(105, 1, 'logout', NULL, NULL, NULL, NULL, NULL, 'Logout dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-02 21:28:31', '2025-09-02 21:28:31'),
	(106, 1, 'login', NULL, NULL, NULL, NULL, NULL, 'Login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-02 23:22:07', '2025-09-02 23:22:07'),
	(107, 1, 'delete', 'Pejabat', 8, 'Umar bin Khat', NULL, NULL, 'Menghapus data pejabat: Umar bin Khat', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-02 23:26:58', '2025-09-02 23:26:58'),
	(108, 1, 'create', 'Pejabat', 9, 'AHMAD FADLILAH RAMADLANnnn', NULL, NULL, 'Membuat data pejabat: AHMAD FADLILAH RAMADLANnnn', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-03 00:36:03', '2025-09-03 00:36:03'),
	(109, 1, 'create', 'Pejabat', 10, 'Sri Mulyani', NULL, NULL, 'Membuat data pejabat: Sri Mulyani', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-03 00:50:46', '2025-09-03 00:50:46'),
	(110, 1, 'create', 'Pejabat', 11, 'Ahmad Syahrul', NULL, NULL, 'Membuat data pejabat: Ahmad Syahrul', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-03 00:51:33', '2025-09-03 00:51:33'),
	(111, 1, 'delete', 'Pejabat', 9, 'AHMAD FADLILAH RAMADLANnnn', NULL, NULL, 'Menghapus data pejabat: AHMAD FADLILAH RAMADLANnnn', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-03 00:52:08', '2025-09-03 00:52:08'),
	(112, 1, 'update', 'Pejabat', 5, 'AHMAD FADLILAH RAMADLAN', NULL, NULL, 'Memperbarui data pejabat: AHMAD FADLILAH RAMADLAN', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-03 00:52:42', '2025-09-03 00:52:42'),
	(113, 1, 'logout', NULL, NULL, NULL, NULL, NULL, 'Logout dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-03 00:59:30', '2025-09-03 00:59:30'),
	(114, 1, 'login', NULL, NULL, NULL, NULL, NULL, 'Login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-03 01:22:46', '2025-09-03 01:22:46'),
	(115, 1, 'login', NULL, NULL, NULL, NULL, NULL, 'Login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-07 18:50:59', '2025-09-07 18:50:59'),
	(116, 1, 'delete', 'Berita', 5, 'Test Update FINALLY FIXED', NULL, NULL, 'Menghapus berita: Test Update FINALLY FIXED', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-07 18:52:57', '2025-09-07 18:52:57'),
	(117, 1, 'delete', 'Berita', 3, 'Pembangunan Rumah Layak Huni Tahap 1', NULL, NULL, 'Menghapus berita: Pembangunan Rumah Layak Huni Tahap 1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-07 18:53:03', '2025-09-07 18:53:03'),
	(118, 1, 'delete', 'Berita', 2, 'Ini adalah ujicoba fitur tambah berita baru (02)', NULL, NULL, 'Menghapus berita: Ini adalah ujicoba fitur tambah berita baru (02)', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-07 18:53:08', '2025-09-07 18:53:08'),
	(119, 1, 'logout', NULL, NULL, NULL, NULL, NULL, 'Logout dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-07 20:06:57', '2025-09-07 20:06:57'),
	(120, 1, 'login', NULL, NULL, NULL, NULL, NULL, 'Login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-07 20:08:25', '2025-09-07 20:08:25'),
	(121, 1, 'logout', NULL, NULL, NULL, NULL, NULL, 'Logout dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-07 20:09:43', '2025-09-07 20:09:43'),
	(122, 10, 'login', NULL, NULL, NULL, NULL, NULL, 'Login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-07 20:09:57', '2025-09-07 20:09:57'),
	(123, 10, 'logout', NULL, NULL, NULL, NULL, NULL, 'Logout dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-07 20:25:17', '2025-09-07 20:25:17'),
	(124, 1, 'login', NULL, NULL, NULL, NULL, NULL, 'Login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-08 00:58:47', '2025-09-08 00:58:47'),
	(125, 1, 'login', NULL, NULL, NULL, NULL, NULL, 'Login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-08 19:51:59', '2025-09-08 19:51:59'),
	(126, 1, 'logout', NULL, NULL, NULL, NULL, NULL, 'Logout dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-08 19:55:00', '2025-09-08 19:55:00'),
	(127, 1, 'login', NULL, NULL, NULL, NULL, NULL, 'Login ke sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-08 20:16:10', '2025-09-08 20:16:10'),
	(128, 1, 'create', 'Berita', 22, 'Pembangunan Rumah Layak Huni Tahap 1', NULL, NULL, 'Membuat berita: Pembangunan Rumah Layak Huni Tahap 1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-08 20:17:29', '2025-09-08 20:17:29'),
	(129, 1, 'logout', NULL, NULL, NULL, NULL, NULL, 'Logout dari sistem', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-08 20:17:34', '2025-09-08 20:17:34');

-- Dumping structure for table db_dinas_perkim.agendas
CREATE TABLE IF NOT EXISTS `agendas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `konten` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_agenda` date NOT NULL,
  `waktu_mulai` time DEFAULT NULL,
  `waktu_selesai` time DEFAULT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penyelenggara` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lampiran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kategori` enum('rapat','sosialisasi','workshop','acara_publik') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'rapat',
  `prioritas` enum('rendah','sedang','tinggi','mendesak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'sedang',
  `status` enum('draft','published','selesai','dibatalkan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `is_publik` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `agendas_slug_unique` (`slug`),
  KEY `agendas_created_by_foreign` (`created_by`),
  KEY `agendas_status_tanggal_agenda_index` (`status`,`tanggal_agenda`),
  KEY `agendas_kategori_tanggal_agenda_index` (`kategori`,`tanggal_agenda`),
  KEY `agendas_is_featured_status_index` (`is_featured`,`status`),
  KEY `agendas_is_publik_status_index` (`is_publik`,`status`),
  CONSTRAINT `agendas_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_dinas_perkim.agendas: ~0 rows (approximately)

-- Dumping structure for table db_dinas_perkim.beritas
CREATE TABLE IF NOT EXISTS `beritas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `penulis` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('published','draft') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `beritas_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_dinas_perkim.beritas: ~1 rows (approximately)
INSERT INTO `beritas` (`id`, `judul`, `slug`, `isi`, `penulis`, `gambar`, `status`, `published_at`, `created_at`, `updated_at`) VALUES
	(22, 'Pembangunan Rumah Layak Huni Tahap 1', 'pembangunan-rumah-layak-huni-tahap-1', '<p>Ini Adalah contoh berita dari superAdmin</p>', 'SuperAdmin', 'dlWosM2triw01uGJQWWie1kutEQ7upCUkP33UAWF.jpg', 'published', '2025-09-08 20:17:29', '2025-09-08 20:17:29', '2025-09-08 20:17:29');

-- Dumping structure for table db_dinas_perkim.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_dinas_perkim.cache: ~7 rows (approximately)
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
	('5c785c036466adea360111aa28563bfd556b5fba', 'i:1;', 1757384938),
	('5c785c036466adea360111aa28563bfd556b5fba:timer', 'i:1757384938;', 1757384938),
	('spatie.permission.cache', 'a:3:{s:5:"alias";a:4:{s:1:"a";s:2:"id";s:1:"b";s:4:"name";s:1:"c";s:10:"guard_name";s:1:"r";s:5:"roles";}s:11:"permissions";a:9:{i:0;a:4:{s:1:"a";i:1;s:1:"b";s:13:"kelola berita";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:1;a:4:{s:1:"a";i:3;s:1:"b";s:14:"kelola pejabat";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:2;}}i:2;a:4:{s:1:"a";i:4;s:1:"b";s:14:"kelola unduhan";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:2;}}i:3;a:4:{s:1:"a";i:5;s:1:"b";s:13:"kelola galeri";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:2;}}i:4;a:4:{s:1:"a";i:6;s:1:"b";s:12:"kelola pesan";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:2;}}i:5;a:3:{s:1:"a";i:7;s:1:"b";s:15:"kelola pengguna";s:1:"c";s:3:"web";}i:6;a:4:{s:1:"a";i:8;s:1:"b";s:13:"kelola slider";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:2;}}i:7;a:4:{s:1:"a";i:9;s:1:"b";s:14:"kelola halaman";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:2;}}i:8;a:4:{s:1:"a";i:10;s:1:"b";s:13:"kelola agenda";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:2;}}}s:5:"roles";a:2:{i:0;a:3:{s:1:"a";i:1;s:1:"b";s:7:"penulis";s:1:"c";s:3:"web";}i:1;a:3:{s:1:"a";i:2;s:1:"b";s:5:"admin";s:1:"c";s:3:"web";}}}', 1757387866),
	('visi_misi_all_grouped_active', 'a:2:{s:4:"visi";a:2:{s:4:"name";s:4:"Visi";s:5:"items";O:39:"Illuminate\\Database\\Eloquent\\Collection":2:{s:8:"\0*\0items";a:1:{i:0;O:19:"App\\Models\\VisiMisi":30:{s:13:"\0*\0connection";s:5:"mysql";s:8:"\0*\0table";s:10:"visi_misis";s:13:"\0*\0primaryKey";s:2:"id";s:10:"\0*\0keyType";s:3:"int";s:12:"incrementing";b:1;s:7:"\0*\0with";a:0:{}s:12:"\0*\0withCount";a:0:{}s:19:"preventsLazyLoading";b:0;s:10:"\0*\0perPage";i:15;s:6:"exists";b:1;s:18:"wasRecentlyCreated";b:0;s:28:"\0*\0escapeWhenCastingToString";b:0;s:13:"\0*\0attributes";a:11:{s:2:"id";i:1;s:4:"type";s:4:"visi";s:5:"title";s:35:"Visi Dinas Perumahan dan Permukiman";s:7:"content";s:156:"Terwujudnya perumahan dan permukiman yang layak huni, berkelanjutan, dan terjangkau bagi seluruh masyarakat menuju kehidupan yang sejahtera dan bermartabat.";s:11:"description";N;s:4:"icon";N;s:11:"color_class";N;s:14:"order_position";i:1;s:9:"is_active";i:1;s:10:"created_at";s:19:"2025-08-27 03:49:42";s:10:"updated_at";s:19:"2025-08-27 03:49:42";}s:11:"\0*\0original";a:11:{s:2:"id";i:1;s:4:"type";s:4:"visi";s:5:"title";s:35:"Visi Dinas Perumahan dan Permukiman";s:7:"content";s:156:"Terwujudnya perumahan dan permukiman yang layak huni, berkelanjutan, dan terjangkau bagi seluruh masyarakat menuju kehidupan yang sejahtera dan bermartabat.";s:11:"description";N;s:4:"icon";N;s:11:"color_class";N;s:14:"order_position";i:1;s:9:"is_active";i:1;s:10:"created_at";s:19:"2025-08-27 03:49:42";s:10:"updated_at";s:19:"2025-08-27 03:49:42";}s:10:"\0*\0changes";a:0:{}s:8:"\0*\0casts";a:2:{s:9:"is_active";s:7:"boolean";s:14:"order_position";s:7:"integer";}s:17:"\0*\0classCastCache";a:0:{}s:21:"\0*\0attributeCastCache";a:0:{}s:13:"\0*\0dateFormat";N;s:10:"\0*\0appends";a:0:{}s:19:"\0*\0dispatchesEvents";a:0:{}s:14:"\0*\0observables";a:0:{}s:12:"\0*\0relations";a:0:{}s:10:"\0*\0touches";a:0:{}s:10:"timestamps";b:1;s:13:"usesUniqueIds";b:0;s:9:"\0*\0hidden";a:0:{}s:10:"\0*\0visible";a:0:{}s:11:"\0*\0fillable";a:8:{i:0;s:4:"type";i:1;s:5:"title";i:2;s:7:"content";i:3;s:11:"description";i:4;s:4:"icon";i:5;s:11:"color_class";i:6;s:14:"order_position";i:7;s:9:"is_active";}s:10:"\0*\0guarded";a:1:{i:0;s:1:"*";}}}s:28:"\0*\0escapeWhenCastingToString";b:0;}}s:4:"misi";a:2:{s:4:"name";s:4:"Misi";s:5:"items";O:39:"Illuminate\\Database\\Eloquent\\Collection":2:{s:8:"\0*\0items";a:5:{i:0;O:19:"App\\Models\\VisiMisi":30:{s:13:"\0*\0connection";s:5:"mysql";s:8:"\0*\0table";s:10:"visi_misis";s:13:"\0*\0primaryKey";s:2:"id";s:10:"\0*\0keyType";s:3:"int";s:12:"incrementing";b:1;s:7:"\0*\0with";a:0:{}s:12:"\0*\0withCount";a:0:{}s:19:"preventsLazyLoading";b:0;s:10:"\0*\0perPage";i:15;s:6:"exists";b:1;s:18:"wasRecentlyCreated";b:0;s:28:"\0*\0escapeWhenCastingToString";b:0;s:13:"\0*\0attributes";a:11:{s:2:"id";i:2;s:4:"type";s:4:"misi";s:5:"title";s:6:"Misi 1";s:7:"content";s:102:"Menyelenggarakan perencanaan dan pembangunan perumahan yang berkualitas, terjangkau, dan berkelanjutan";s:11:"description";N;s:4:"icon";N;s:11:"color_class";N;s:14:"order_position";i:1;s:9:"is_active";i:1;s:10:"created_at";s:19:"2025-08-27 03:49:42";s:10:"updated_at";s:19:"2025-08-27 03:49:42";}s:11:"\0*\0original";a:11:{s:2:"id";i:2;s:4:"type";s:4:"misi";s:5:"title";s:6:"Misi 1";s:7:"content";s:102:"Menyelenggarakan perencanaan dan pembangunan perumahan yang berkualitas, terjangkau, dan berkelanjutan";s:11:"description";N;s:4:"icon";N;s:11:"color_class";N;s:14:"order_position";i:1;s:9:"is_active";i:1;s:10:"created_at";s:19:"2025-08-27 03:49:42";s:10:"updated_at";s:19:"2025-08-27 03:49:42";}s:10:"\0*\0changes";a:0:{}s:8:"\0*\0casts";a:2:{s:9:"is_active";s:7:"boolean";s:14:"order_position";s:7:"integer";}s:17:"\0*\0classCastCache";a:0:{}s:21:"\0*\0attributeCastCache";a:0:{}s:13:"\0*\0dateFormat";N;s:10:"\0*\0appends";a:0:{}s:19:"\0*\0dispatchesEvents";a:0:{}s:14:"\0*\0observables";a:0:{}s:12:"\0*\0relations";a:0:{}s:10:"\0*\0touches";a:0:{}s:10:"timestamps";b:1;s:13:"usesUniqueIds";b:0;s:9:"\0*\0hidden";a:0:{}s:10:"\0*\0visible";a:0:{}s:11:"\0*\0fillable";a:8:{i:0;s:4:"type";i:1;s:5:"title";i:2;s:7:"content";i:3;s:11:"description";i:4;s:4:"icon";i:5;s:11:"color_class";i:6;s:14:"order_position";i:7;s:9:"is_active";}s:10:"\0*\0guarded";a:1:{i:0;s:1:"*";}}i:1;O:19:"App\\Models\\VisiMisi":30:{s:13:"\0*\0connection";s:5:"mysql";s:8:"\0*\0table";s:10:"visi_misis";s:13:"\0*\0primaryKey";s:2:"id";s:10:"\0*\0keyType";s:3:"int";s:12:"incrementing";b:1;s:7:"\0*\0with";a:0:{}s:12:"\0*\0withCount";a:0:{}s:19:"preventsLazyLoading";b:0;s:10:"\0*\0perPage";i:15;s:6:"exists";b:1;s:18:"wasRecentlyCreated";b:0;s:28:"\0*\0escapeWhenCastingToString";b:0;s:13:"\0*\0attributes";a:11:{s:2:"id";i:3;s:4:"type";s:4:"misi";s:5:"title";s:6:"Misi 2";s:7:"content";s:108:"Mengembangkan kawasan permukiman yang layak huni dengan infrastruktur yang memadai dan berwawasan lingkungan";s:11:"description";N;s:4:"icon";N;s:11:"color_class";N;s:14:"order_position";i:2;s:9:"is_active";i:1;s:10:"created_at";s:19:"2025-08-27 03:49:42";s:10:"updated_at";s:19:"2025-08-27 03:49:42";}s:11:"\0*\0original";a:11:{s:2:"id";i:3;s:4:"type";s:4:"misi";s:5:"title";s:6:"Misi 2";s:7:"content";s:108:"Mengembangkan kawasan permukiman yang layak huni dengan infrastruktur yang memadai dan berwawasan lingkungan";s:11:"description";N;s:4:"icon";N;s:11:"color_class";N;s:14:"order_position";i:2;s:9:"is_active";i:1;s:10:"created_at";s:19:"2025-08-27 03:49:42";s:10:"updated_at";s:19:"2025-08-27 03:49:42";}s:10:"\0*\0changes";a:0:{}s:8:"\0*\0casts";a:2:{s:9:"is_active";s:7:"boolean";s:14:"order_position";s:7:"integer";}s:17:"\0*\0classCastCache";a:0:{}s:21:"\0*\0attributeCastCache";a:0:{}s:13:"\0*\0dateFormat";N;s:10:"\0*\0appends";a:0:{}s:19:"\0*\0dispatchesEvents";a:0:{}s:14:"\0*\0observables";a:0:{}s:12:"\0*\0relations";a:0:{}s:10:"\0*\0touches";a:0:{}s:10:"timestamps";b:1;s:13:"usesUniqueIds";b:0;s:9:"\0*\0hidden";a:0:{}s:10:"\0*\0visible";a:0:{}s:11:"\0*\0fillable";a:8:{i:0;s:4:"type";i:1;s:5:"title";i:2;s:7:"content";i:3;s:11:"description";i:4;s:4:"icon";i:5;s:11:"color_class";i:6;s:14:"order_position";i:7;s:9:"is_active";}s:10:"\0*\0guarded";a:1:{i:0;s:1:"*";}}i:2;O:19:"App\\Models\\VisiMisi":30:{s:13:"\0*\0connection";s:5:"mysql";s:8:"\0*\0table";s:10:"visi_misis";s:13:"\0*\0primaryKey";s:2:"id";s:10:"\0*\0keyType";s:3:"int";s:12:"incrementing";b:1;s:7:"\0*\0with";a:0:{}s:12:"\0*\0withCount";a:0:{}s:19:"preventsLazyLoading";b:0;s:10:"\0*\0perPage";i:15;s:6:"exists";b:1;s:18:"wasRecentlyCreated";b:0;s:28:"\0*\0escapeWhenCastingToString";b:0;s:13:"\0*\0attributes";a:11:{s:2:"id";i:4;s:4:"type";s:4:"misi";s:5:"title";s:6:"Misi 3";s:7:"content";s:99:"Memberikan pelayanan prima dalam bidang pertanahan untuk menjamin kepastian hukum kepemilikan tanah";s:11:"description";N;s:4:"icon";N;s:11:"color_class";N;s:14:"order_position";i:3;s:9:"is_active";i:1;s:10:"created_at";s:19:"2025-08-27 03:49:42";s:10:"updated_at";s:19:"2025-08-27 03:49:42";}s:11:"\0*\0original";a:11:{s:2:"id";i:4;s:4:"type";s:4:"misi";s:5:"title";s:6:"Misi 3";s:7:"content";s:99:"Memberikan pelayanan prima dalam bidang pertanahan untuk menjamin kepastian hukum kepemilikan tanah";s:11:"description";N;s:4:"icon";N;s:11:"color_class";N;s:14:"order_position";i:3;s:9:"is_active";i:1;s:10:"created_at";s:19:"2025-08-27 03:49:42";s:10:"updated_at";s:19:"2025-08-27 03:49:42";}s:10:"\0*\0changes";a:0:{}s:8:"\0*\0casts";a:2:{s:9:"is_active";s:7:"boolean";s:14:"order_position";s:7:"integer";}s:17:"\0*\0classCastCache";a:0:{}s:21:"\0*\0attributeCastCache";a:0:{}s:13:"\0*\0dateFormat";N;s:10:"\0*\0appends";a:0:{}s:19:"\0*\0dispatchesEvents";a:0:{}s:14:"\0*\0observables";a:0:{}s:12:"\0*\0relations";a:0:{}s:10:"\0*\0touches";a:0:{}s:10:"timestamps";b:1;s:13:"usesUniqueIds";b:0;s:9:"\0*\0hidden";a:0:{}s:10:"\0*\0visible";a:0:{}s:11:"\0*\0fillable";a:8:{i:0;s:4:"type";i:1;s:5:"title";i:2;s:7:"content";i:3;s:11:"description";i:4;s:4:"icon";i:5;s:11:"color_class";i:6;s:14:"order_position";i:7;s:9:"is_active";}s:10:"\0*\0guarded";a:1:{i:0;s:1:"*";}}i:3;O:19:"App\\Models\\VisiMisi":30:{s:13:"\0*\0connection";s:5:"mysql";s:8:"\0*\0table";s:10:"visi_misis";s:13:"\0*\0primaryKey";s:2:"id";s:10:"\0*\0keyType";s:3:"int";s:12:"incrementing";b:1;s:7:"\0*\0with";a:0:{}s:12:"\0*\0withCount";a:0:{}s:19:"preventsLazyLoading";b:0;s:10:"\0*\0perPage";i:15;s:6:"exists";b:1;s:18:"wasRecentlyCreated";b:0;s:28:"\0*\0escapeWhenCastingToString";b:0;s:13:"\0*\0attributes";a:11:{s:2:"id";i:5;s:4:"type";s:4:"misi";s:5:"title";s:6:"Misi 4";s:7:"content";s:111:"Melakukan pembinaan dan pengawasan terhadap pembangunan perumahan dan permukiman sesuai standar yang ditetapkan";s:11:"description";N;s:4:"icon";N;s:11:"color_class";N;s:14:"order_position";i:4;s:9:"is_active";i:1;s:10:"created_at";s:19:"2025-08-27 03:49:42";s:10:"updated_at";s:19:"2025-08-27 03:49:42";}s:11:"\0*\0original";a:11:{s:2:"id";i:5;s:4:"type";s:4:"misi";s:5:"title";s:6:"Misi 4";s:7:"content";s:111:"Melakukan pembinaan dan pengawasan terhadap pembangunan perumahan dan permukiman sesuai standar yang ditetapkan";s:11:"description";N;s:4:"icon";N;s:11:"color_class";N;s:14:"order_position";i:4;s:9:"is_active";i:1;s:10:"created_at";s:19:"2025-08-27 03:49:42";s:10:"updated_at";s:19:"2025-08-27 03:49:42";}s:10:"\0*\0changes";a:0:{}s:8:"\0*\0casts";a:2:{s:9:"is_active";s:7:"boolean";s:14:"order_position";s:7:"integer";}s:17:"\0*\0classCastCache";a:0:{}s:21:"\0*\0attributeCastCache";a:0:{}s:13:"\0*\0dateFormat";N;s:10:"\0*\0appends";a:0:{}s:19:"\0*\0dispatchesEvents";a:0:{}s:14:"\0*\0observables";a:0:{}s:12:"\0*\0relations";a:0:{}s:10:"\0*\0touches";a:0:{}s:10:"timestamps";b:1;s:13:"usesUniqueIds";b:0;s:9:"\0*\0hidden";a:0:{}s:10:"\0*\0visible";a:0:{}s:11:"\0*\0fillable";a:8:{i:0;s:4:"type";i:1;s:5:"title";i:2;s:7:"content";i:3;s:11:"description";i:4;s:4:"icon";i:5;s:11:"color_class";i:6;s:14:"order_position";i:7;s:9:"is_active";}s:10:"\0*\0guarded";a:1:{i:0;s:1:"*";}}i:4;O:19:"App\\Models\\VisiMisi":30:{s:13:"\0*\0connection";s:5:"mysql";s:8:"\0*\0table";s:10:"visi_misis";s:13:"\0*\0primaryKey";s:2:"id";s:10:"\0*\0keyType";s:3:"int";s:12:"incrementing";b:1;s:7:"\0*\0with";a:0:{}s:12:"\0*\0withCount";a:0:{}s:19:"preventsLazyLoading";b:0;s:10:"\0*\0perPage";i:15;s:6:"exists";b:1;s:18:"wasRecentlyCreated";b:0;s:28:"\0*\0escapeWhenCastingToString";b:0;s:13:"\0*\0attributes";a:11:{s:2:"id";i:6;s:4:"type";s:4:"misi";s:5:"title";s:6:"Misi 5";s:7:"content";s:117:"Meningkatkan kapasitas kelembagaan dan sumber daya manusia untuk memberikan pelayanan yang profesional dan transparan";s:11:"description";N;s:4:"icon";N;s:11:"color_class";N;s:14:"order_position";i:5;s:9:"is_active";i:1;s:10:"created_at";s:19:"2025-08-27 03:49:42";s:10:"updated_at";s:19:"2025-08-27 03:49:42";}s:11:"\0*\0original";a:11:{s:2:"id";i:6;s:4:"type";s:4:"misi";s:5:"title";s:6:"Misi 5";s:7:"content";s:117:"Meningkatkan kapasitas kelembagaan dan sumber daya manusia untuk memberikan pelayanan yang profesional dan transparan";s:11:"description";N;s:4:"icon";N;s:11:"color_class";N;s:14:"order_position";i:5;s:9:"is_active";i:1;s:10:"created_at";s:19:"2025-08-27 03:49:42";s:10:"updated_at";s:19:"2025-08-27 03:49:42";}s:10:"\0*\0changes";a:0:{}s:8:"\0*\0casts";a:2:{s:9:"is_active";s:7:"boolean";s:14:"order_position";s:7:"integer";}s:17:"\0*\0classCastCache";a:0:{}s:21:"\0*\0attributeCastCache";a:0:{}s:13:"\0*\0dateFormat";N;s:10:"\0*\0appends";a:0:{}s:19:"\0*\0dispatchesEvents";a:0:{}s:14:"\0*\0observables";a:0:{}s:12:"\0*\0relations";a:0:{}s:10:"\0*\0touches";a:0:{}s:10:"timestamps";b:1;s:13:"usesUniqueIds";b:0;s:9:"\0*\0hidden";a:0:{}s:10:"\0*\0visible";a:0:{}s:11:"\0*\0fillable";a:8:{i:0;s:4:"type";i:1;s:5:"title";i:2;s:7:"content";i:3;s:11:"description";i:4;s:4:"icon";i:5;s:11:"color_class";i:6;s:14:"order_position";i:7;s:9:"is_active";}s:10:"\0*\0guarded";a:1:{i:0;s:1:"*";}}}s:28:"\0*\0escapeWhenCastingToString";b:0;}}}', 1757388559),
	('visi_misi_misi_active', 'O:39:"Illuminate\\Database\\Eloquent\\Collection":2:{s:8:"\0*\0items";a:5:{i:0;O:19:"App\\Models\\VisiMisi":30:{s:13:"\0*\0connection";s:5:"mysql";s:8:"\0*\0table";s:10:"visi_misis";s:13:"\0*\0primaryKey";s:2:"id";s:10:"\0*\0keyType";s:3:"int";s:12:"incrementing";b:1;s:7:"\0*\0with";a:0:{}s:12:"\0*\0withCount";a:0:{}s:19:"preventsLazyLoading";b:0;s:10:"\0*\0perPage";i:15;s:6:"exists";b:1;s:18:"wasRecentlyCreated";b:0;s:28:"\0*\0escapeWhenCastingToString";b:0;s:13:"\0*\0attributes";a:11:{s:2:"id";i:2;s:4:"type";s:4:"misi";s:5:"title";s:6:"Misi 1";s:7:"content";s:102:"Menyelenggarakan perencanaan dan pembangunan perumahan yang berkualitas, terjangkau, dan berkelanjutan";s:11:"description";N;s:4:"icon";N;s:11:"color_class";N;s:14:"order_position";i:1;s:9:"is_active";i:1;s:10:"created_at";s:19:"2025-08-27 03:49:42";s:10:"updated_at";s:19:"2025-08-27 03:49:42";}s:11:"\0*\0original";a:11:{s:2:"id";i:2;s:4:"type";s:4:"misi";s:5:"title";s:6:"Misi 1";s:7:"content";s:102:"Menyelenggarakan perencanaan dan pembangunan perumahan yang berkualitas, terjangkau, dan berkelanjutan";s:11:"description";N;s:4:"icon";N;s:11:"color_class";N;s:14:"order_position";i:1;s:9:"is_active";i:1;s:10:"created_at";s:19:"2025-08-27 03:49:42";s:10:"updated_at";s:19:"2025-08-27 03:49:42";}s:10:"\0*\0changes";a:0:{}s:8:"\0*\0casts";a:2:{s:9:"is_active";s:7:"boolean";s:14:"order_position";s:7:"integer";}s:17:"\0*\0classCastCache";a:0:{}s:21:"\0*\0attributeCastCache";a:0:{}s:13:"\0*\0dateFormat";N;s:10:"\0*\0appends";a:0:{}s:19:"\0*\0dispatchesEvents";a:0:{}s:14:"\0*\0observables";a:0:{}s:12:"\0*\0relations";a:0:{}s:10:"\0*\0touches";a:0:{}s:10:"timestamps";b:1;s:13:"usesUniqueIds";b:0;s:9:"\0*\0hidden";a:0:{}s:10:"\0*\0visible";a:0:{}s:11:"\0*\0fillable";a:8:{i:0;s:4:"type";i:1;s:5:"title";i:2;s:7:"content";i:3;s:11:"description";i:4;s:4:"icon";i:5;s:11:"color_class";i:6;s:14:"order_position";i:7;s:9:"is_active";}s:10:"\0*\0guarded";a:1:{i:0;s:1:"*";}}i:1;O:19:"App\\Models\\VisiMisi":30:{s:13:"\0*\0connection";s:5:"mysql";s:8:"\0*\0table";s:10:"visi_misis";s:13:"\0*\0primaryKey";s:2:"id";s:10:"\0*\0keyType";s:3:"int";s:12:"incrementing";b:1;s:7:"\0*\0with";a:0:{}s:12:"\0*\0withCount";a:0:{}s:19:"preventsLazyLoading";b:0;s:10:"\0*\0perPage";i:15;s:6:"exists";b:1;s:18:"wasRecentlyCreated";b:0;s:28:"\0*\0escapeWhenCastingToString";b:0;s:13:"\0*\0attributes";a:11:{s:2:"id";i:3;s:4:"type";s:4:"misi";s:5:"title";s:6:"Misi 2";s:7:"content";s:108:"Mengembangkan kawasan permukiman yang layak huni dengan infrastruktur yang memadai dan berwawasan lingkungan";s:11:"description";N;s:4:"icon";N;s:11:"color_class";N;s:14:"order_position";i:2;s:9:"is_active";i:1;s:10:"created_at";s:19:"2025-08-27 03:49:42";s:10:"updated_at";s:19:"2025-08-27 03:49:42";}s:11:"\0*\0original";a:11:{s:2:"id";i:3;s:4:"type";s:4:"misi";s:5:"title";s:6:"Misi 2";s:7:"content";s:108:"Mengembangkan kawasan permukiman yang layak huni dengan infrastruktur yang memadai dan berwawasan lingkungan";s:11:"description";N;s:4:"icon";N;s:11:"color_class";N;s:14:"order_position";i:2;s:9:"is_active";i:1;s:10:"created_at";s:19:"2025-08-27 03:49:42";s:10:"updated_at";s:19:"2025-08-27 03:49:42";}s:10:"\0*\0changes";a:0:{}s:8:"\0*\0casts";a:2:{s:9:"is_active";s:7:"boolean";s:14:"order_position";s:7:"integer";}s:17:"\0*\0classCastCache";a:0:{}s:21:"\0*\0attributeCastCache";a:0:{}s:13:"\0*\0dateFormat";N;s:10:"\0*\0appends";a:0:{}s:19:"\0*\0dispatchesEvents";a:0:{}s:14:"\0*\0observables";a:0:{}s:12:"\0*\0relations";a:0:{}s:10:"\0*\0touches";a:0:{}s:10:"timestamps";b:1;s:13:"usesUniqueIds";b:0;s:9:"\0*\0hidden";a:0:{}s:10:"\0*\0visible";a:0:{}s:11:"\0*\0fillable";a:8:{i:0;s:4:"type";i:1;s:5:"title";i:2;s:7:"content";i:3;s:11:"description";i:4;s:4:"icon";i:5;s:11:"color_class";i:6;s:14:"order_position";i:7;s:9:"is_active";}s:10:"\0*\0guarded";a:1:{i:0;s:1:"*";}}i:2;O:19:"App\\Models\\VisiMisi":30:{s:13:"\0*\0connection";s:5:"mysql";s:8:"\0*\0table";s:10:"visi_misis";s:13:"\0*\0primaryKey";s:2:"id";s:10:"\0*\0keyType";s:3:"int";s:12:"incrementing";b:1;s:7:"\0*\0with";a:0:{}s:12:"\0*\0withCount";a:0:{}s:19:"preventsLazyLoading";b:0;s:10:"\0*\0perPage";i:15;s:6:"exists";b:1;s:18:"wasRecentlyCreated";b:0;s:28:"\0*\0escapeWhenCastingToString";b:0;s:13:"\0*\0attributes";a:11:{s:2:"id";i:4;s:4:"type";s:4:"misi";s:5:"title";s:6:"Misi 3";s:7:"content";s:99:"Memberikan pelayanan prima dalam bidang pertanahan untuk menjamin kepastian hukum kepemilikan tanah";s:11:"description";N;s:4:"icon";N;s:11:"color_class";N;s:14:"order_position";i:3;s:9:"is_active";i:1;s:10:"created_at";s:19:"2025-08-27 03:49:42";s:10:"updated_at";s:19:"2025-08-27 03:49:42";}s:11:"\0*\0original";a:11:{s:2:"id";i:4;s:4:"type";s:4:"misi";s:5:"title";s:6:"Misi 3";s:7:"content";s:99:"Memberikan pelayanan prima dalam bidang pertanahan untuk menjamin kepastian hukum kepemilikan tanah";s:11:"description";N;s:4:"icon";N;s:11:"color_class";N;s:14:"order_position";i:3;s:9:"is_active";i:1;s:10:"created_at";s:19:"2025-08-27 03:49:42";s:10:"updated_at";s:19:"2025-08-27 03:49:42";}s:10:"\0*\0changes";a:0:{}s:8:"\0*\0casts";a:2:{s:9:"is_active";s:7:"boolean";s:14:"order_position";s:7:"integer";}s:17:"\0*\0classCastCache";a:0:{}s:21:"\0*\0attributeCastCache";a:0:{}s:13:"\0*\0dateFormat";N;s:10:"\0*\0appends";a:0:{}s:19:"\0*\0dispatchesEvents";a:0:{}s:14:"\0*\0observables";a:0:{}s:12:"\0*\0relations";a:0:{}s:10:"\0*\0touches";a:0:{}s:10:"timestamps";b:1;s:13:"usesUniqueIds";b:0;s:9:"\0*\0hidden";a:0:{}s:10:"\0*\0visible";a:0:{}s:11:"\0*\0fillable";a:8:{i:0;s:4:"type";i:1;s:5:"title";i:2;s:7:"content";i:3;s:11:"description";i:4;s:4:"icon";i:5;s:11:"color_class";i:6;s:14:"order_position";i:7;s:9:"is_active";}s:10:"\0*\0guarded";a:1:{i:0;s:1:"*";}}i:3;O:19:"App\\Models\\VisiMisi":30:{s:13:"\0*\0connection";s:5:"mysql";s:8:"\0*\0table";s:10:"visi_misis";s:13:"\0*\0primaryKey";s:2:"id";s:10:"\0*\0keyType";s:3:"int";s:12:"incrementing";b:1;s:7:"\0*\0with";a:0:{}s:12:"\0*\0withCount";a:0:{}s:19:"preventsLazyLoading";b:0;s:10:"\0*\0perPage";i:15;s:6:"exists";b:1;s:18:"wasRecentlyCreated";b:0;s:28:"\0*\0escapeWhenCastingToString";b:0;s:13:"\0*\0attributes";a:11:{s:2:"id";i:5;s:4:"type";s:4:"misi";s:5:"title";s:6:"Misi 4";s:7:"content";s:111:"Melakukan pembinaan dan pengawasan terhadap pembangunan perumahan dan permukiman sesuai standar yang ditetapkan";s:11:"description";N;s:4:"icon";N;s:11:"color_class";N;s:14:"order_position";i:4;s:9:"is_active";i:1;s:10:"created_at";s:19:"2025-08-27 03:49:42";s:10:"updated_at";s:19:"2025-08-27 03:49:42";}s:11:"\0*\0original";a:11:{s:2:"id";i:5;s:4:"type";s:4:"misi";s:5:"title";s:6:"Misi 4";s:7:"content";s:111:"Melakukan pembinaan dan pengawasan terhadap pembangunan perumahan dan permukiman sesuai standar yang ditetapkan";s:11:"description";N;s:4:"icon";N;s:11:"color_class";N;s:14:"order_position";i:4;s:9:"is_active";i:1;s:10:"created_at";s:19:"2025-08-27 03:49:42";s:10:"updated_at";s:19:"2025-08-27 03:49:42";}s:10:"\0*\0changes";a:0:{}s:8:"\0*\0casts";a:2:{s:9:"is_active";s:7:"boolean";s:14:"order_position";s:7:"integer";}s:17:"\0*\0classCastCache";a:0:{}s:21:"\0*\0attributeCastCache";a:0:{}s:13:"\0*\0dateFormat";N;s:10:"\0*\0appends";a:0:{}s:19:"\0*\0dispatchesEvents";a:0:{}s:14:"\0*\0observables";a:0:{}s:12:"\0*\0relations";a:0:{}s:10:"\0*\0touches";a:0:{}s:10:"timestamps";b:1;s:13:"usesUniqueIds";b:0;s:9:"\0*\0hidden";a:0:{}s:10:"\0*\0visible";a:0:{}s:11:"\0*\0fillable";a:8:{i:0;s:4:"type";i:1;s:5:"title";i:2;s:7:"content";i:3;s:11:"description";i:4;s:4:"icon";i:5;s:11:"color_class";i:6;s:14:"order_position";i:7;s:9:"is_active";}s:10:"\0*\0guarded";a:1:{i:0;s:1:"*";}}i:4;O:19:"App\\Models\\VisiMisi":30:{s:13:"\0*\0connection";s:5:"mysql";s:8:"\0*\0table";s:10:"visi_misis";s:13:"\0*\0primaryKey";s:2:"id";s:10:"\0*\0keyType";s:3:"int";s:12:"incrementing";b:1;s:7:"\0*\0with";a:0:{}s:12:"\0*\0withCount";a:0:{}s:19:"preventsLazyLoading";b:0;s:10:"\0*\0perPage";i:15;s:6:"exists";b:1;s:18:"wasRecentlyCreated";b:0;s:28:"\0*\0escapeWhenCastingToString";b:0;s:13:"\0*\0attributes";a:11:{s:2:"id";i:6;s:4:"type";s:4:"misi";s:5:"title";s:6:"Misi 5";s:7:"content";s:117:"Meningkatkan kapasitas kelembagaan dan sumber daya manusia untuk memberikan pelayanan yang profesional dan transparan";s:11:"description";N;s:4:"icon";N;s:11:"color_class";N;s:14:"order_position";i:5;s:9:"is_active";i:1;s:10:"created_at";s:19:"2025-08-27 03:49:42";s:10:"updated_at";s:19:"2025-08-27 03:49:42";}s:11:"\0*\0original";a:11:{s:2:"id";i:6;s:4:"type";s:4:"misi";s:5:"title";s:6:"Misi 5";s:7:"content";s:117:"Meningkatkan kapasitas kelembagaan dan sumber daya manusia untuk memberikan pelayanan yang profesional dan transparan";s:11:"description";N;s:4:"icon";N;s:11:"color_class";N;s:14:"order_position";i:5;s:9:"is_active";i:1;s:10:"created_at";s:19:"2025-08-27 03:49:42";s:10:"updated_at";s:19:"2025-08-27 03:49:42";}s:10:"\0*\0changes";a:0:{}s:8:"\0*\0casts";a:2:{s:9:"is_active";s:7:"boolean";s:14:"order_position";s:7:"integer";}s:17:"\0*\0classCastCache";a:0:{}s:21:"\0*\0attributeCastCache";a:0:{}s:13:"\0*\0dateFormat";N;s:10:"\0*\0appends";a:0:{}s:19:"\0*\0dispatchesEvents";a:0:{}s:14:"\0*\0observables";a:0:{}s:12:"\0*\0relations";a:0:{}s:10:"\0*\0touches";a:0:{}s:10:"timestamps";b:1;s:13:"usesUniqueIds";b:0;s:9:"\0*\0hidden";a:0:{}s:10:"\0*\0visible";a:0:{}s:11:"\0*\0fillable";a:8:{i:0;s:4:"type";i:1;s:5:"title";i:2;s:7:"content";i:3;s:11:"description";i:4;s:4:"icon";i:5;s:11:"color_class";i:6;s:14:"order_position";i:7;s:9:"is_active";}s:10:"\0*\0guarded";a:1:{i:0;s:1:"*";}}}s:28:"\0*\0escapeWhenCastingToString";b:0;}', 1757388559),
	('visi_misi_public_only', 'a:2:{s:4:"visi";a:2:{s:4:"name";s:4:"Visi";s:5:"items";O:39:"Illuminate\\Database\\Eloquent\\Collection":2:{s:8:"\0*\0items";a:1:{i:0;O:19:"App\\Models\\VisiMisi":30:{s:13:"\0*\0connection";s:5:"mysql";s:8:"\0*\0table";s:10:"visi_misis";s:13:"\0*\0primaryKey";s:2:"id";s:10:"\0*\0keyType";s:3:"int";s:12:"incrementing";b:1;s:7:"\0*\0with";a:0:{}s:12:"\0*\0withCount";a:0:{}s:19:"preventsLazyLoading";b:0;s:10:"\0*\0perPage";i:15;s:6:"exists";b:1;s:18:"wasRecentlyCreated";b:0;s:28:"\0*\0escapeWhenCastingToString";b:0;s:13:"\0*\0attributes";a:11:{s:2:"id";i:1;s:4:"type";s:4:"visi";s:5:"title";s:35:"Visi Dinas Perumahan dan Permukiman";s:7:"content";s:156:"Terwujudnya perumahan dan permukiman yang layak huni, berkelanjutan, dan terjangkau bagi seluruh masyarakat menuju kehidupan yang sejahtera dan bermartabat.";s:11:"description";N;s:4:"icon";N;s:11:"color_class";N;s:14:"order_position";i:1;s:9:"is_active";i:1;s:10:"created_at";s:19:"2025-08-27 03:49:42";s:10:"updated_at";s:19:"2025-08-27 03:49:42";}s:11:"\0*\0original";a:11:{s:2:"id";i:1;s:4:"type";s:4:"visi";s:5:"title";s:35:"Visi Dinas Perumahan dan Permukiman";s:7:"content";s:156:"Terwujudnya perumahan dan permukiman yang layak huni, berkelanjutan, dan terjangkau bagi seluruh masyarakat menuju kehidupan yang sejahtera dan bermartabat.";s:11:"description";N;s:4:"icon";N;s:11:"color_class";N;s:14:"order_position";i:1;s:9:"is_active";i:1;s:10:"created_at";s:19:"2025-08-27 03:49:42";s:10:"updated_at";s:19:"2025-08-27 03:49:42";}s:10:"\0*\0changes";a:0:{}s:8:"\0*\0casts";a:2:{s:9:"is_active";s:7:"boolean";s:14:"order_position";s:7:"integer";}s:17:"\0*\0classCastCache";a:0:{}s:21:"\0*\0attributeCastCache";a:0:{}s:13:"\0*\0dateFormat";N;s:10:"\0*\0appends";a:0:{}s:19:"\0*\0dispatchesEvents";a:0:{}s:14:"\0*\0observables";a:0:{}s:12:"\0*\0relations";a:0:{}s:10:"\0*\0touches";a:0:{}s:10:"timestamps";b:1;s:13:"usesUniqueIds";b:0;s:9:"\0*\0hidden";a:0:{}s:10:"\0*\0visible";a:0:{}s:11:"\0*\0fillable";a:8:{i:0;s:4:"type";i:1;s:5:"title";i:2;s:7:"content";i:3;s:11:"description";i:4;s:4:"icon";i:5;s:11:"color_class";i:6;s:14:"order_position";i:7;s:9:"is_active";}s:10:"\0*\0guarded";a:1:{i:0;s:1:"*";}}}s:28:"\0*\0escapeWhenCastingToString";b:0;}}s:4:"misi";a:2:{s:4:"name";s:4:"Misi";s:5:"items";O:39:"Illuminate\\Database\\Eloquent\\Collection":2:{s:8:"\0*\0items";a:5:{i:0;O:19:"App\\Models\\VisiMisi":30:{s:13:"\0*\0connection";s:5:"mysql";s:8:"\0*\0table";s:10:"visi_misis";s:13:"\0*\0primaryKey";s:2:"id";s:10:"\0*\0keyType";s:3:"int";s:12:"incrementing";b:1;s:7:"\0*\0with";a:0:{}s:12:"\0*\0withCount";a:0:{}s:19:"preventsLazyLoading";b:0;s:10:"\0*\0perPage";i:15;s:6:"exists";b:1;s:18:"wasRecentlyCreated";b:0;s:28:"\0*\0escapeWhenCastingToString";b:0;s:13:"\0*\0attributes";a:11:{s:2:"id";i:2;s:4:"type";s:4:"misi";s:5:"title";s:6:"Misi 1";s:7:"content";s:102:"Menyelenggarakan perencanaan dan pembangunan perumahan yang berkualitas, terjangkau, dan berkelanjutan";s:11:"description";N;s:4:"icon";N;s:11:"color_class";N;s:14:"order_position";i:1;s:9:"is_active";i:1;s:10:"created_at";s:19:"2025-08-27 03:49:42";s:10:"updated_at";s:19:"2025-08-27 03:49:42";}s:11:"\0*\0original";a:11:{s:2:"id";i:2;s:4:"type";s:4:"misi";s:5:"title";s:6:"Misi 1";s:7:"content";s:102:"Menyelenggarakan perencanaan dan pembangunan perumahan yang berkualitas, terjangkau, dan berkelanjutan";s:11:"description";N;s:4:"icon";N;s:11:"color_class";N;s:14:"order_position";i:1;s:9:"is_active";i:1;s:10:"created_at";s:19:"2025-08-27 03:49:42";s:10:"updated_at";s:19:"2025-08-27 03:49:42";}s:10:"\0*\0changes";a:0:{}s:8:"\0*\0casts";a:2:{s:9:"is_active";s:7:"boolean";s:14:"order_position";s:7:"integer";}s:17:"\0*\0classCastCache";a:0:{}s:21:"\0*\0attributeCastCache";a:0:{}s:13:"\0*\0dateFormat";N;s:10:"\0*\0appends";a:0:{}s:19:"\0*\0dispatchesEvents";a:0:{}s:14:"\0*\0observables";a:0:{}s:12:"\0*\0relations";a:0:{}s:10:"\0*\0touches";a:0:{}s:10:"timestamps";b:1;s:13:"usesUniqueIds";b:0;s:9:"\0*\0hidden";a:0:{}s:10:"\0*\0visible";a:0:{}s:11:"\0*\0fillable";a:8:{i:0;s:4:"type";i:1;s:5:"title";i:2;s:7:"content";i:3;s:11:"description";i:4;s:4:"icon";i:5;s:11:"color_class";i:6;s:14:"order_position";i:7;s:9:"is_active";}s:10:"\0*\0guarded";a:1:{i:0;s:1:"*";}}i:1;O:19:"App\\Models\\VisiMisi":30:{s:13:"\0*\0connection";s:5:"mysql";s:8:"\0*\0table";s:10:"visi_misis";s:13:"\0*\0primaryKey";s:2:"id";s:10:"\0*\0keyType";s:3:"int";s:12:"incrementing";b:1;s:7:"\0*\0with";a:0:{}s:12:"\0*\0withCount";a:0:{}s:19:"preventsLazyLoading";b:0;s:10:"\0*\0perPage";i:15;s:6:"exists";b:1;s:18:"wasRecentlyCreated";b:0;s:28:"\0*\0escapeWhenCastingToString";b:0;s:13:"\0*\0attributes";a:11:{s:2:"id";i:3;s:4:"type";s:4:"misi";s:5:"title";s:6:"Misi 2";s:7:"content";s:108:"Mengembangkan kawasan permukiman yang layak huni dengan infrastruktur yang memadai dan berwawasan lingkungan";s:11:"description";N;s:4:"icon";N;s:11:"color_class";N;s:14:"order_position";i:2;s:9:"is_active";i:1;s:10:"created_at";s:19:"2025-08-27 03:49:42";s:10:"updated_at";s:19:"2025-08-27 03:49:42";}s:11:"\0*\0original";a:11:{s:2:"id";i:3;s:4:"type";s:4:"misi";s:5:"title";s:6:"Misi 2";s:7:"content";s:108:"Mengembangkan kawasan permukiman yang layak huni dengan infrastruktur yang memadai dan berwawasan lingkungan";s:11:"description";N;s:4:"icon";N;s:11:"color_class";N;s:14:"order_position";i:2;s:9:"is_active";i:1;s:10:"created_at";s:19:"2025-08-27 03:49:42";s:10:"updated_at";s:19:"2025-08-27 03:49:42";}s:10:"\0*\0changes";a:0:{}s:8:"\0*\0casts";a:2:{s:9:"is_active";s:7:"boolean";s:14:"order_position";s:7:"integer";}s:17:"\0*\0classCastCache";a:0:{}s:21:"\0*\0attributeCastCache";a:0:{}s:13:"\0*\0dateFormat";N;s:10:"\0*\0appends";a:0:{}s:19:"\0*\0dispatchesEvents";a:0:{}s:14:"\0*\0observables";a:0:{}s:12:"\0*\0relations";a:0:{}s:10:"\0*\0touches";a:0:{}s:10:"timestamps";b:1;s:13:"usesUniqueIds";b:0;s:9:"\0*\0hidden";a:0:{}s:10:"\0*\0visible";a:0:{}s:11:"\0*\0fillable";a:8:{i:0;s:4:"type";i:1;s:5:"title";i:2;s:7:"content";i:3;s:11:"description";i:4;s:4:"icon";i:5;s:11:"color_class";i:6;s:14:"order_position";i:7;s:9:"is_active";}s:10:"\0*\0guarded";a:1:{i:0;s:1:"*";}}i:2;O:19:"App\\Models\\VisiMisi":30:{s:13:"\0*\0connection";s:5:"mysql";s:8:"\0*\0table";s:10:"visi_misis";s:13:"\0*\0primaryKey";s:2:"id";s:10:"\0*\0keyType";s:3:"int";s:12:"incrementing";b:1;s:7:"\0*\0with";a:0:{}s:12:"\0*\0withCount";a:0:{}s:19:"preventsLazyLoading";b:0;s:10:"\0*\0perPage";i:15;s:6:"exists";b:1;s:18:"wasRecentlyCreated";b:0;s:28:"\0*\0escapeWhenCastingToString";b:0;s:13:"\0*\0attributes";a:11:{s:2:"id";i:4;s:4:"type";s:4:"misi";s:5:"title";s:6:"Misi 3";s:7:"content";s:99:"Memberikan pelayanan prima dalam bidang pertanahan untuk menjamin kepastian hukum kepemilikan tanah";s:11:"description";N;s:4:"icon";N;s:11:"color_class";N;s:14:"order_position";i:3;s:9:"is_active";i:1;s:10:"created_at";s:19:"2025-08-27 03:49:42";s:10:"updated_at";s:19:"2025-08-27 03:49:42";}s:11:"\0*\0original";a:11:{s:2:"id";i:4;s:4:"type";s:4:"misi";s:5:"title";s:6:"Misi 3";s:7:"content";s:99:"Memberikan pelayanan prima dalam bidang pertanahan untuk menjamin kepastian hukum kepemilikan tanah";s:11:"description";N;s:4:"icon";N;s:11:"color_class";N;s:14:"order_position";i:3;s:9:"is_active";i:1;s:10:"created_at";s:19:"2025-08-27 03:49:42";s:10:"updated_at";s:19:"2025-08-27 03:49:42";}s:10:"\0*\0changes";a:0:{}s:8:"\0*\0casts";a:2:{s:9:"is_active";s:7:"boolean";s:14:"order_position";s:7:"integer";}s:17:"\0*\0classCastCache";a:0:{}s:21:"\0*\0attributeCastCache";a:0:{}s:13:"\0*\0dateFormat";N;s:10:"\0*\0appends";a:0:{}s:19:"\0*\0dispatchesEvents";a:0:{}s:14:"\0*\0observables";a:0:{}s:12:"\0*\0relations";a:0:{}s:10:"\0*\0touches";a:0:{}s:10:"timestamps";b:1;s:13:"usesUniqueIds";b:0;s:9:"\0*\0hidden";a:0:{}s:10:"\0*\0visible";a:0:{}s:11:"\0*\0fillable";a:8:{i:0;s:4:"type";i:1;s:5:"title";i:2;s:7:"content";i:3;s:11:"description";i:4;s:4:"icon";i:5;s:11:"color_class";i:6;s:14:"order_position";i:7;s:9:"is_active";}s:10:"\0*\0guarded";a:1:{i:0;s:1:"*";}}i:3;O:19:"App\\Models\\VisiMisi":30:{s:13:"\0*\0connection";s:5:"mysql";s:8:"\0*\0table";s:10:"visi_misis";s:13:"\0*\0primaryKey";s:2:"id";s:10:"\0*\0keyType";s:3:"int";s:12:"incrementing";b:1;s:7:"\0*\0with";a:0:{}s:12:"\0*\0withCount";a:0:{}s:19:"preventsLazyLoading";b:0;s:10:"\0*\0perPage";i:15;s:6:"exists";b:1;s:18:"wasRecentlyCreated";b:0;s:28:"\0*\0escapeWhenCastingToString";b:0;s:13:"\0*\0attributes";a:11:{s:2:"id";i:5;s:4:"type";s:4:"misi";s:5:"title";s:6:"Misi 4";s:7:"content";s:111:"Melakukan pembinaan dan pengawasan terhadap pembangunan perumahan dan permukiman sesuai standar yang ditetapkan";s:11:"description";N;s:4:"icon";N;s:11:"color_class";N;s:14:"order_position";i:4;s:9:"is_active";i:1;s:10:"created_at";s:19:"2025-08-27 03:49:42";s:10:"updated_at";s:19:"2025-08-27 03:49:42";}s:11:"\0*\0original";a:11:{s:2:"id";i:5;s:4:"type";s:4:"misi";s:5:"title";s:6:"Misi 4";s:7:"content";s:111:"Melakukan pembinaan dan pengawasan terhadap pembangunan perumahan dan permukiman sesuai standar yang ditetapkan";s:11:"description";N;s:4:"icon";N;s:11:"color_class";N;s:14:"order_position";i:4;s:9:"is_active";i:1;s:10:"created_at";s:19:"2025-08-27 03:49:42";s:10:"updated_at";s:19:"2025-08-27 03:49:42";}s:10:"\0*\0changes";a:0:{}s:8:"\0*\0casts";a:2:{s:9:"is_active";s:7:"boolean";s:14:"order_position";s:7:"integer";}s:17:"\0*\0classCastCache";a:0:{}s:21:"\0*\0attributeCastCache";a:0:{}s:13:"\0*\0dateFormat";N;s:10:"\0*\0appends";a:0:{}s:19:"\0*\0dispatchesEvents";a:0:{}s:14:"\0*\0observables";a:0:{}s:12:"\0*\0relations";a:0:{}s:10:"\0*\0touches";a:0:{}s:10:"timestamps";b:1;s:13:"usesUniqueIds";b:0;s:9:"\0*\0hidden";a:0:{}s:10:"\0*\0visible";a:0:{}s:11:"\0*\0fillable";a:8:{i:0;s:4:"type";i:1;s:5:"title";i:2;s:7:"content";i:3;s:11:"description";i:4;s:4:"icon";i:5;s:11:"color_class";i:6;s:14:"order_position";i:7;s:9:"is_active";}s:10:"\0*\0guarded";a:1:{i:0;s:1:"*";}}i:4;O:19:"App\\Models\\VisiMisi":30:{s:13:"\0*\0connection";s:5:"mysql";s:8:"\0*\0table";s:10:"visi_misis";s:13:"\0*\0primaryKey";s:2:"id";s:10:"\0*\0keyType";s:3:"int";s:12:"incrementing";b:1;s:7:"\0*\0with";a:0:{}s:12:"\0*\0withCount";a:0:{}s:19:"preventsLazyLoading";b:0;s:10:"\0*\0perPage";i:15;s:6:"exists";b:1;s:18:"wasRecentlyCreated";b:0;s:28:"\0*\0escapeWhenCastingToString";b:0;s:13:"\0*\0attributes";a:11:{s:2:"id";i:6;s:4:"type";s:4:"misi";s:5:"title";s:6:"Misi 5";s:7:"content";s:117:"Meningkatkan kapasitas kelembagaan dan sumber daya manusia untuk memberikan pelayanan yang profesional dan transparan";s:11:"description";N;s:4:"icon";N;s:11:"color_class";N;s:14:"order_position";i:5;s:9:"is_active";i:1;s:10:"created_at";s:19:"2025-08-27 03:49:42";s:10:"updated_at";s:19:"2025-08-27 03:49:42";}s:11:"\0*\0original";a:11:{s:2:"id";i:6;s:4:"type";s:4:"misi";s:5:"title";s:6:"Misi 5";s:7:"content";s:117:"Meningkatkan kapasitas kelembagaan dan sumber daya manusia untuk memberikan pelayanan yang profesional dan transparan";s:11:"description";N;s:4:"icon";N;s:11:"color_class";N;s:14:"order_position";i:5;s:9:"is_active";i:1;s:10:"created_at";s:19:"2025-08-27 03:49:42";s:10:"updated_at";s:19:"2025-08-27 03:49:42";}s:10:"\0*\0changes";a:0:{}s:8:"\0*\0casts";a:2:{s:9:"is_active";s:7:"boolean";s:14:"order_position";s:7:"integer";}s:17:"\0*\0classCastCache";a:0:{}s:21:"\0*\0attributeCastCache";a:0:{}s:13:"\0*\0dateFormat";N;s:10:"\0*\0appends";a:0:{}s:19:"\0*\0dispatchesEvents";a:0:{}s:14:"\0*\0observables";a:0:{}s:12:"\0*\0relations";a:0:{}s:10:"\0*\0touches";a:0:{}s:10:"timestamps";b:1;s:13:"usesUniqueIds";b:0;s:9:"\0*\0hidden";a:0:{}s:10:"\0*\0visible";a:0:{}s:11:"\0*\0fillable";a:8:{i:0;s:4:"type";i:1;s:5:"title";i:2;s:7:"content";i:3;s:11:"description";i:4;s:4:"icon";i:5;s:11:"color_class";i:6;s:14:"order_position";i:7;s:9:"is_active";}s:10:"\0*\0guarded";a:1:{i:0;s:1:"*";}}}s:28:"\0*\0escapeWhenCastingToString";b:0;}}}', 1757320350),
	('visi_misi_visi_active', 'O:39:"Illuminate\\Database\\Eloquent\\Collection":2:{s:8:"\0*\0items";a:1:{i:0;O:19:"App\\Models\\VisiMisi":30:{s:13:"\0*\0connection";s:5:"mysql";s:8:"\0*\0table";s:10:"visi_misis";s:13:"\0*\0primaryKey";s:2:"id";s:10:"\0*\0keyType";s:3:"int";s:12:"incrementing";b:1;s:7:"\0*\0with";a:0:{}s:12:"\0*\0withCount";a:0:{}s:19:"preventsLazyLoading";b:0;s:10:"\0*\0perPage";i:15;s:6:"exists";b:1;s:18:"wasRecentlyCreated";b:0;s:28:"\0*\0escapeWhenCastingToString";b:0;s:13:"\0*\0attributes";a:11:{s:2:"id";i:1;s:4:"type";s:4:"visi";s:5:"title";s:35:"Visi Dinas Perumahan dan Permukiman";s:7:"content";s:156:"Terwujudnya perumahan dan permukiman yang layak huni, berkelanjutan, dan terjangkau bagi seluruh masyarakat menuju kehidupan yang sejahtera dan bermartabat.";s:11:"description";N;s:4:"icon";N;s:11:"color_class";N;s:14:"order_position";i:1;s:9:"is_active";i:1;s:10:"created_at";s:19:"2025-08-27 03:49:42";s:10:"updated_at";s:19:"2025-08-27 03:49:42";}s:11:"\0*\0original";a:11:{s:2:"id";i:1;s:4:"type";s:4:"visi";s:5:"title";s:35:"Visi Dinas Perumahan dan Permukiman";s:7:"content";s:156:"Terwujudnya perumahan dan permukiman yang layak huni, berkelanjutan, dan terjangkau bagi seluruh masyarakat menuju kehidupan yang sejahtera dan bermartabat.";s:11:"description";N;s:4:"icon";N;s:11:"color_class";N;s:14:"order_position";i:1;s:9:"is_active";i:1;s:10:"created_at";s:19:"2025-08-27 03:49:42";s:10:"updated_at";s:19:"2025-08-27 03:49:42";}s:10:"\0*\0changes";a:0:{}s:8:"\0*\0casts";a:2:{s:9:"is_active";s:7:"boolean";s:14:"order_position";s:7:"integer";}s:17:"\0*\0classCastCache";a:0:{}s:21:"\0*\0attributeCastCache";a:0:{}s:13:"\0*\0dateFormat";N;s:10:"\0*\0appends";a:0:{}s:19:"\0*\0dispatchesEvents";a:0:{}s:14:"\0*\0observables";a:0:{}s:12:"\0*\0relations";a:0:{}s:10:"\0*\0touches";a:0:{}s:10:"timestamps";b:1;s:13:"usesUniqueIds";b:0;s:9:"\0*\0hidden";a:0:{}s:10:"\0*\0visible";a:0:{}s:11:"\0*\0fillable";a:8:{i:0;s:4:"type";i:1;s:5:"title";i:2;s:7:"content";i:3;s:11:"description";i:4;s:4:"icon";i:5;s:11:"color_class";i:6;s:14:"order_position";i:7;s:9:"is_active";}s:10:"\0*\0guarded";a:1:{i:0;s:1:"*";}}}s:28:"\0*\0escapeWhenCastingToString";b:0;}', 1757388559);

-- Dumping structure for table db_dinas_perkim.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_dinas_perkim.cache_locks: ~0 rows (approximately)

-- Dumping structure for table db_dinas_perkim.failed_jobs
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

-- Dumping data for table db_dinas_perkim.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table db_dinas_perkim.galeris
CREATE TABLE IF NOT EXISTS `galeris` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_dinas_perkim.galeris: ~0 rows (approximately)
INSERT INTO `galeris` (`id`, `gambar`, `keterangan`, `created_at`, `updated_at`) VALUES
	(1, '1qzZV6V8Kp1Z5Hxn2RnMwUJMqoCPhpxuTmjOWwE1.jpg', 'Pembukaan Mahasiswa KKN Periode I Universitas Palangkaraya - Selasa-Rabu, 08-09 Juli 2025', '2025-08-12 01:45:23', '2025-08-19 00:31:35');

-- Dumping structure for table db_dinas_perkim.jobs
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

-- Dumping data for table db_dinas_perkim.jobs: ~0 rows (approximately)

-- Dumping structure for table db_dinas_perkim.job_batches
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

-- Dumping data for table db_dinas_perkim.job_batches: ~0 rows (approximately)

-- Dumping structure for table db_dinas_perkim.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_dinas_perkim.migrations: ~10 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2025_08_12_032859_create_beritas_table', 2),
	(5, '2025_08_12_070027_create_halamen_table', 3),
	(6, '2025_08_12_072617_create_pejabats_table', 4),
	(7, '2025_08_12_082050_create_unduhans_table', 5),
	(8, '2025_08_12_083621_create_galeris_table', 6),
	(9, '2025_08_13_014626_create_pesans_table', 7),
	(10, '2025_08_13_022806_create_permission_tables', 8),
	(11, '2025_08_13_041041_create_slides_table', 9),
	(12, '2025_08_14_112848_create_personal_access_tokens_table', 10),
	(13, '2025_08_19_024700_create_activity_logs_table', 11),
	(14, '2025_08_23_000001_create_agendas_table', 12),
	(15, '2025_08_23_044055_remove_deskripsi_from_agendas_table', 13),
	(16, '2025_08_25_040908_add_role_and_status_to_users_table', 14),
	(17, '2025_08_26_063333_remove_lampiran_from_pesans_table', 15),
	(18, '2025_08_26_070400_create_visi_misis_table', 16),
	(19, '2025_08_27_033020_cleanup_nilai_tujuan_from_visi_misis_table', 17),
	(20, '2025_09_03_064436_add_plt_fields_to_pejabats_table', 18),
	(21, '2025_09_03_115945_remove_plt_fields_from_pejabats_table', 19);

-- Dumping structure for table db_dinas_perkim.model_has_permissions
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_dinas_perkim.model_has_permissions: ~0 rows (approximately)

-- Dumping structure for table db_dinas_perkim.model_has_roles
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_dinas_perkim.model_has_roles: ~2 rows (approximately)
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(3, 'App\\Models\\User', 1),
	(3, 'App\\Models\\User', 7),
	(1, 'App\\Models\\User', 10);

-- Dumping structure for table db_dinas_perkim.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_dinas_perkim.password_reset_tokens: ~0 rows (approximately)
INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
	('audentkent@gmail.com', '$2y$12$imR7.CJjEF2bPshDl1Pj/O0dCfLdayIP9odHGbGvT.oKBheLQSRQi', '2025-09-08 19:22:26');

-- Dumping structure for table db_dinas_perkim.pejabats
CREATE TABLE IF NOT EXISTS `pejabats` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urutan` int NOT NULL DEFAULT '0',
  `status` enum('aktif','nonaktif','pensiun') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `keterangan_status` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pejabats_nip_unique` (`nip`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_dinas_perkim.pejabats: ~5 rows (approximately)
INSERT INTO `pejabats` (`id`, `nama`, `jabatan`, `nip`, `foto`, `urutan`, `status`, `keterangan_status`, `created_at`, `updated_at`) VALUES
	(5, 'AHMAD FADLILAH RAMADLAN', 'Kepala Dinas', '011010101010', 'a7dueX0Xt6ObWIsFmlrlpOlG6NizavpMIxw4M7Vq.png', 0, 'aktif', NULL, '2025-08-13 20:04:52', '2025-08-26 20:30:39'),
	(6, 'Depro Winoto', 'Sekretaris', '011010101010110', '2GcavnsRb0YfPQWW6MQMWINXAcgZWhgAvXoe0R54.png', 1, 'aktif', NULL, '2025-08-13 20:05:23', '2025-08-26 20:30:50'),
	(7, 'Abu Bakar', 'Kepala Bidang Bidang Keamanan Informasi Data', '011010101010100', 'wFOMo2YswXaatzjYYMO8M1y1NZMw1a1LJtCID9VQ.png', 2, 'aktif', NULL, '2025-08-13 20:05:57', '2025-08-26 20:31:00'),
	(10, 'Sri Mulyani', 'Kasubag Keuangan', '2618936180630163131', 'ruek33lTFDdoxIPGCvCeGRFP4ADSad7daXCBJ918.png', 0, 'aktif', NULL, '2025-09-03 00:50:46', '2025-09-03 00:50:46'),
	(11, 'Ahmad Syahrul', 'Kepala Seksi Penataan Bangunan', '746387462754239', 'gDq3P4vQaMOW2c5nTGqOk68QGgHX6C51f8uOXtsC.png', 0, 'aktif', NULL, '2025-09-03 00:51:33', '2025-09-03 00:51:33');

-- Dumping structure for table db_dinas_perkim.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_dinas_perkim.permissions: ~7 rows (approximately)
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'kelola berita', 'web', '2025-08-12 19:34:41', '2025-08-12 19:34:41'),
	(3, 'kelola pejabat', 'web', '2025-08-12 19:34:41', '2025-08-12 19:34:41'),
	(4, 'kelola unduhan', 'web', '2025-08-12 19:34:41', '2025-08-12 19:34:41'),
	(5, 'kelola galeri', 'web', '2025-08-12 19:34:41', '2025-08-12 19:34:41'),
	(6, 'kelola pesan', 'web', '2025-08-12 19:34:41', '2025-08-12 19:34:41'),
	(7, 'kelola pengguna', 'web', '2025-08-12 19:34:41', '2025-08-12 19:34:41'),
	(8, 'kelola slider', 'web', '2025-08-12 21:18:20', '2025-08-12 21:18:20'),
	(9, 'kelola halaman', 'web', '2025-08-24 20:46:01', '2025-08-24 20:46:01'),
	(10, 'kelola agenda', 'web', '2025-09-07 20:17:08', '2025-09-07 20:17:08');

-- Dumping structure for table db_dinas_perkim.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  KEY `personal_access_tokens_expires_at_index` (`expires_at`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_dinas_perkim.personal_access_tokens: ~8 rows (approximately)
INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
	(1, 'App\\Models\\User', 1, 'test-token', 'af8a1023c66eeeee92db6ed2d9b0a13a508dfc59a933349caad223f26f85586d', '["*"]', NULL, NULL, '2025-08-14 04:33:49', '2025-08-14 04:33:49'),
	(2, 'App\\Models\\User', 7, 'api-token', '1d89fd78297e7f68d27a4916a5aa4d21321ac86713080c921d5048596615ef07', '["*"]', '2025-08-14 04:47:18', NULL, '2025-08-14 04:46:01', '2025-08-14 04:47:18'),
	(3, 'App\\Models\\User', 6, 'api-token', '1a50e481aa48ad387f8eac167a476310a0bd2baf7debf24487db27e75e4fd2ed', '["*"]', NULL, NULL, '2025-08-14 06:40:06', '2025-08-14 06:40:06'),
	(5, 'App\\Models\\User', 7, 'api-token', '0b010a4f794087e23c6d2f5f5b47800364b9c8e05d87e0163de29abbac1bb23e', '["*"]', '2025-08-24 21:24:02', NULL, '2025-08-24 21:20:34', '2025-08-24 21:24:02'),
	(6, 'App\\Models\\User', 1, 'api-token', 'b921dce34f297d02eca9d71a1e9f46070bea8d0ac665d96ed6e4ec524eb8b5d6', '["*"]', NULL, NULL, '2025-08-26 21:19:18', '2025-08-26 21:19:18'),
	(7, 'App\\Models\\User', 1, 'api-token', 'eebe996584d831e244779a225fd84d5a0b11f057c07facc3f4da741a45201618', '["*"]', '2025-08-26 21:19:52', NULL, '2025-08-26 21:19:27', '2025-08-26 21:19:52'),
	(8, 'App\\Models\\User', 7, 'api-token', 'cba6ba6ebae930c7a27cc489907ef1491f00f38017456fc024841617178f4093', '["*"]', NULL, NULL, '2025-08-27 19:28:07', '2025-08-27 19:28:07'),
	(9, 'App\\Models\\User', 7, 'api-token', 'efe2cef4fd5b8ab1c63f678957c964106f6ba351351d1484a8a63437da999426', '["*"]', '2025-08-27 19:45:25', NULL, '2025-08-27 19:28:24', '2025-08-27 19:45:25'),
	(10, 'App\\Models\\User', 7, 'api-token', '51f024f359b097025e8be84fbdd3a36dd1162ed944fe45154b1cbc38b50ec59d', '["*"]', '2025-08-27 19:54:16', NULL, '2025-08-27 19:49:33', '2025-08-27 19:54:16'),
	(11, 'App\\Models\\User', 1, 'api-token', 'b345c267e767b3d84afa4fd968666e326e376e926505a7da0a046f919049d5aa', '["*"]', '2025-09-08 01:01:27', NULL, '2025-09-08 01:00:55', '2025-09-08 01:01:27');

-- Dumping structure for table db_dinas_perkim.pesans
CREATE TABLE IF NOT EXISTS `pesans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_pengirim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_pengirim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipe_pesan` enum('Pengaduan','Permohonan','Informasi') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subjek` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi_pesan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Belum Dibaca','Sedang Proses','Sudah Dibaca') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Belum Dibaca',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_dinas_perkim.pesans: ~4 rows (approximately)
INSERT INTO `pesans` (`id`, `nama_pengirim`, `email_pengirim`, `telepon`, `tipe_pesan`, `subjek`, `isi_pesan`, `status`, `created_at`, `updated_at`) VALUES
	(2, 'Ahmad Fadlilah r', 'ahmad@example.com', '0812345678', 'Informasi', 'Ingin mendapatkan pengumuman', 'bisakah saya mendapatkan makanan gratis', 'Sudah Dibaca', '2025-08-14 01:07:58', '2025-08-14 01:08:32'),
	(3, 'Ahmad Fadlilah r', 'ahmad@example.com', '0812345678', 'Informasi', 'permohonan acara kampus google', 'demi meningkatkan kualitas dari universitas maka perlu dilakukan kolaborasi antara', 'Sudah Dibaca', '2025-08-21 00:46:04', '2025-08-21 00:46:38'),
	(4, 'Test User', 'test@example.com', NULL, 'Pengaduan', 'Test Message', 'This is a test message from API', 'Sudah Dibaca', '2025-08-24 20:50:54', '2025-08-24 21:29:46'),
	(5, 'Ini tuh namanya test', 'test@example.com', '0812345678', 'Permohonan', 'ingin mendapatkan test', 'ausdusaufausfui usgfusgaufguspagfup saauogfusagfuias', 'Sudah Dibaca', '2025-08-25 23:58:14', '2025-08-27 19:20:14');

-- Dumping structure for table db_dinas_perkim.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_dinas_perkim.roles: ~3 rows (approximately)
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'penulis', 'web', '2025-08-12 19:34:41', '2025-08-12 19:34:41'),
	(2, 'admin', 'web', '2025-08-12 19:34:41', '2025-08-12 19:34:41'),
	(3, 'super-admin', 'web', '2025-08-12 19:34:41', '2025-08-12 19:34:41');

-- Dumping structure for table db_dinas_perkim.role_has_permissions
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_dinas_perkim.role_has_permissions: ~9 rows (approximately)
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
	(1, 1),
	(1, 2),
	(3, 2),
	(4, 2),
	(5, 2),
	(6, 2),
	(8, 2),
	(9, 2),
	(10, 2);

-- Dumping structure for table db_dinas_perkim.sessions
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

-- Dumping data for table db_dinas_perkim.sessions: ~38 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('3nh4a09k2OUq4eqx9R3XGG5soWLZhD6veCWkuYvq', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoic3R2UVFZY213YnAweHdMbDZPdExtbjROSmhrbWtzSzZtNFREc0tLSiI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NztzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozMDoiaHR0cDovL2RpbmFzLXBlcmtpbS50ZXN0L2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1755183175),
	('5QkfnjH2Jppg5sdjwy7dbgU5qCOfEMUqKRUj0CZR', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUEVnaWZmVjl2dXM2UUU5UWFNTFlwVFZJalBUSzczUkJtMWF2OWpRVSI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NztzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozNDoiaHR0cDovL2RpbmFzLXBlcmtpbS50ZXN0L2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1755183176),
	('60k7kjMUOVCgjltRO9DV1ws6ZfdOdlH9MON3ShIb', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiN1A2cDNpMWcxSHFxbzJsZlBiTkVDVVg1NUlDb1E2MUNGNWZTOUV1ZiI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NztzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozNDoiaHR0cDovL2RpbmFzLXBlcmtpbS50ZXN0L2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1755183830),
	('8DP1N2RanZyZO7j8hCmJTta4nLUGQwB3bJ5Okjur', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiekllbno1bGVPenB1QkRFdEVRUDFDUHBZa2hqRWpGdVVkT3JVcUZJRCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9kaW5hcy1wZXJraW0udGVzdC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo3O30=', 1755183331),
	('93Eb7gNLmYPx6i8zUwqlAFIOVZOC9PTPdwAceaMV', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoid2g0Q3NUS0xPUkVpQ0xsOWVrRUpCaGJLRVVHMDRFcE1LR1I1NEtqWSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9kaW5hcy1wZXJraW0udGVzdC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1755181135),
	('BHK9uvd3bZMRvpPjVq2L6qLUScyuZz53ljUKLtn0', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibzlZVEFiZG9tTDZhUGVsUnRXZ2hqM3BCekxZbWJTYzRQTjBkNWoyZSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NztzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozNDoiaHR0cDovL2RpbmFzLXBlcmtpbS50ZXN0L2Rhc2hib2FyZCI7fX0=', 1755183360),
	('cCmvDsto8joSYwxbEz8zSBnBJgkjMcsZod8OIGm6', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWHREUExmMlpXWEJCVjBlTnl3MlV6UXVZRHBMYjFiQzE4V2JWQTk2NCI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NztzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozNDoiaHR0cDovL2RpbmFzLXBlcmtpbS50ZXN0L2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1755183219),
	('d0kooZ9IkZ6gB7NGlET6dxqh9A00n1XumFDP7JcF', 1, '127.0.0.1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Mobile Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWE9VbUNvOXQ1MEtqaUIxdlhvbWZGeTA3SmNpUW1pVVVGY1RTM2xvVCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMwOiJodHRwOi8vZGluYXMtcGVya2ltLnRlc3QvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1755181166),
	('ewwvvz7lgFuxM1e1iB8MvUNXYx9DIKcril84Qr6p', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoidVg0bmtMeFdCNDF1VXdmR0piNFN1QXR3WExYQWd3c1lBWkR6cnk4ayI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMwOiJodHRwOi8vZGluYXMtcGVya2ltLnRlc3QvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1755181145),
	('g4XeW5ukB4ysI3ludn6dsfd2YEbw2GMLtxNQzBki', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoielg3Y2pUbXNhbTNXTHdpaVFNbGJjWmdYTDBGOEtNamZaMnU1eXl5eSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNDoiaHR0cDovL2RpbmFzLXBlcmtpbS50ZXN0L2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM1OiJodHRwOi8vZGluYXMtcGVya2ltLnRlc3QvdGVzdC1sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjc7fQ==', 1755183055),
	('g87Y1Z44monj3iJ4pbHrg6WnF8vYvPvDbaov2ZdD', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTmY2ZXg3NW9manFYNUZYMVRSZHhoVXBMZkZ0TTRwUkw1M2N5MEhyYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9kaW5hcy1wZXJraW0udGVzdC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjc7fQ==', 1755183830),
	('HDlClXOX9Cnpe6IRUlQAsvjMDyu3cjW5XrNJherp', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidmdib0hPbEtwVzZRZjdRcE1WNkhkamNSODJBM0psMjFxUXBkRHVMdCI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NztzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozNDoiaHR0cDovL2RpbmFzLXBlcmtpbS50ZXN0L2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1755183331),
	('hlgP0kL5LS2i6AZQ8Lc2leTvSbfsB5zNuc9BsVie', NULL, '127.0.0.1', 'GuzzleHttp/7', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ0FmWTZiVklWY0NRUjJZSGR2SURJdWFxazBXZG4zZG14MXNwQnBkeiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9kaW5hcy1wZXJraW0udGVzdC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1755179510),
	('IQE4vAiojRQpkUgtbRQoPpNLXIWJyp4kad9LWP2K', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoibXczNmttOUN0NzlaT0tJMmpNZm5JYkloT2dQejVBRFVCYzR4bnF3YyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMwOiJodHRwOi8vZGluYXMtcGVya2ltLnRlc3QvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo3O30=', 1755181956),
	('iugT2L2Xv7aeGZHeSujWxYxAmAsGrV6GWnfhjciu', NULL, '127.0.0.1', 'GuzzleHttp/7', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVkdjZk1xMlIzeGN0UTBnMTd1TUVFaHNlSnRhQ1ZoVXRaWlVESkxFbSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9kaW5hcy1wZXJraW0udGVzdC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1755179832),
	('Jnyxkmp1Af4nszdvfMbaqrE8ajOeOGScfAzUrQaD', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZnF6eFZuSkJqNlV1aGRUOEZRdDM0UTdxaGxtaDFpa1I4NFJWR3NRTSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNDoiaHR0cDovL2RpbmFzLXBlcmtpbS50ZXN0L2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM1OiJodHRwOi8vZGluYXMtcGVya2ltLnRlc3QvdGVzdC1sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjc7fQ==', 1755182731),
	('k1gRTiG4hm3bvh7k5QPLeMvOQbsejvm6OX6kg2Xy', NULL, '127.0.0.1', 'GuzzleHttp/7', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSzJmbUdNZk9WVERRdW5paTVDOEZHcUN5cmhQZTdZQktuZkUycFk0QyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9kaW5hcy1wZXJraW0udGVzdC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1755179734),
	('kuIoukgpcYxzhVbmm51Od4YfhNpUTgkp2fjWYN2N', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNjdqWDdlTmdEck5FYmQ5RndEY0lmYnA5THVMc0cwWTNKNHdkbXVGOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9kaW5hcy1wZXJraW0udGVzdC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjA6e31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1755183867),
	('kvGlDKGZUjzdEq4Wrq8YzVzqY2aei3g9hAqN54jy', NULL, '127.0.0.1', 'GuzzleHttp/7', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYUYzQUxIZld5bGFWRGNhdjBseDg5N3BORjcxdGtpZkE3SFFvMjg0RCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9kaW5hcy1wZXJraW0udGVzdC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1755179908),
	('L1v1JlFzIYcASdQMuUC4s9mOEsoTm38qaCgx0Bbs', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiOGQ0WWxMOEVtWFNXcmV5OWRqVTNkcFY4ZTZkNjJadnVQRVVjRVo3VCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMwOiJodHRwOi8vZGluYXMtcGVya2ltLnRlc3QvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1755181913),
	('Ln6cnMCCZyTOw1hFHKbP06Rr0BXTh7sHffrx5GcL', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoidDFvVTFtWW13WHRFSXRSOGVNYTIySnFCT0pKaFd5UG5SRlY5TVNNQSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMwOiJodHRwOi8vZGluYXMtcGVya2ltLnRlc3QvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1755184108),
	('mhnhK6Ck5FYbzuVWtMqGxyGTfUziuJYvaUVOFNXk', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicGFNTGJ0dDQ0VmVMRlA3RHFvc0k2Tm1LMklzTjZFU2I1c0NWVDRaRCI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NztzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozNDoiaHR0cDovL2RpbmFzLXBlcmtpbS50ZXN0L2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1755183772),
	('NFhyPOnRADWvCPLViYdWg8AZc3hc10NXSBf3QwQG', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWXpndHZ0V3dFcE1lbnNLYXFuRkJMc0hid0lVVVBIYlNSSE5UTUJFcSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMwOiJodHRwOi8vZGluYXMtcGVya2ltLnRlc3QvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1755181906),
	('NnyzSKBcpOPDiYkR3X8eJjUlou3GtI4fHH1QdGEb', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoic2laZFZVWkFRbFE2OWZDaHRtT2xZYUJFRnJOZnI1MlQ2NnF2TGc2USI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NztzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozNDoiaHR0cDovL2RpbmFzLXBlcmtpbS50ZXN0L2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1755183175),
	('qsQ6wxH444MSsgksmTWqZqgmljc8SJ1CTyjXJyDt', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiRDl6SVZ5dEJnMkMzQTJsZVgzZzlua24yQlVoTGhWSXdDY0N3UjROSCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNDoiaHR0cDovL2RpbmFzLXBlcmtpbS50ZXN0L2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQwOiJodHRwOi8vZGluYXMtcGVya2ltLnRlc3QvdGVzdC1sb2dpbi1mb3JtIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1755184077),
	('qyU1U0G8caInNgSpFzVkOBuI9pCQcL6OJyvhNRQJ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTozOntzOjY6InN0YXR1cyI7czoyMjoiRm9yY2UgbG9nb3V0IGNvbXBsZXRlZCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjE6e2k6MDtzOjY6InN0YXR1cyI7fX1zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozNzoiaHR0cDovL2RpbmFzLXBlcmtpbS50ZXN0L2ZvcmNlLWxvZ291dCI7fX0=', 1755183837),
	('ry2hWth326DquJiVLlPhJbQqmkGbnB6ZeuREUzs4', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMFJXRXpCY09PcnNwaGJpUk5tNW02MkNwTUw5WUNWSDVaNW8yUzllaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9kaW5hcy1wZXJraW0udGVzdC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo3O30=', 1755183219),
	('tCVKrL0r2QtO2inzKGkvXYuDONCwRBIRQs2ujPYy', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVXByb3pMQ21XVFR6VWdxNDMwemw5S0EyN0F1SXZQYkNmTklxTXZDTyI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NztzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozNDoiaHR0cDovL2RpbmFzLXBlcmtpbS50ZXN0L2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1755183369),
	('TkB8nfUniCTJir9fQzJgQmHENEDAyNWLdmsjic52', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWWliWkdUbHBZOTFTeGZRaGZPRVNWaFh3TXJheDdqRzFvUkpWaklRQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9kaW5hcy1wZXJraW0udGVzdC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjc7fQ==', 1755183175),
	('Uf4GOiMODC0vBjeN3edVYkXWueX0VGZgg0UNOUnF', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiN05nTGt2d0UxQW5TanB2YVFoaDJqaTlmd2lUR3JidVQ0YUx6Q1ZNRSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMwOiJodHRwOi8vZGluYXMtcGVya2ltLnRlc3QvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo3O30=', 1755182787),
	('uMjzzJnmSNEXtWyrJTaWgE5UajtL8glXZtFgW9Jc', NULL, '127.0.0.1', 'GuzzleHttp/7', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaGJqZTBSNW1wY2ZXamxzbDJsNVJTejFGV2p4Q2x2VUs2Y2l3WW1sZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9kaW5hcy1wZXJraW0udGVzdC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1755179785),
	('vUzjoz1N69strpi0HWxMf6j3IgG3o943ADjCMDZR', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVXFkVFVmNnFVMlVDSVVwYjRpUk1ENjBJT0RWeWdTWDZoR0Noc2FGZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly9kaW5hcy1wZXJraW0udGVzdC90ZXN0LW1hbnVhbC1mb3JtIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Nzt9', 1755183084),
	('wViOnBqF2zXQVcJDCpHct7a4P1H8Fex2QXwn9zTf', NULL, '127.0.0.1', 'GuzzleHttp/7', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWnRteXRxSFlNTkFPQ3VCTTlhTmxtQ29vd3RIZFN4Z1lwQVQ0YnQ2VyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9kaW5hcy1wZXJraW0udGVzdC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1755179548),
	('XsAuu2sLrJWGCyYb41L9dN6Ax4zt8v83EbIBKW2k', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTjlTMW04OHU5TkpxVXpuM3hBYmY5MGZJVTBwVU9CM2F3Rjg1N0tsSSI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NztzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozNToiaHR0cDovL2RpbmFzLXBlcmtpbS50ZXN0L2RlYnVnLWF1dGgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1755183112),
	('xYAIz0xj3fNssGg2fvpyG6HVMiAeRObypQVAkUsR', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiRGlob1l1RjZpYWJ6c0RJRGhlSGhycHE4S05RbWVNRmU4eWVVZE5vcSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNDoiaHR0cDovL2RpbmFzLXBlcmtpbS50ZXN0L2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQwOiJodHRwOi8vZGluYXMtcGVya2ltLnRlc3QvdGVzdC1sb2dpbi1mb3JtIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1755184093),
	('ZdWM06eXgGEVDS948DaAZ8WfM5ezhlcfuHhjvci2', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRnRjT1J0a0lYc3RWMmpwQmpZYkdqMTFnOW00UFlhNlNSY2dsMlZiZiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9kaW5hcy1wZXJraW0udGVzdC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjc7fQ==', 1755183369),
	('zm0T2KE1taRwbQPtj3JZB3WQXjogUWboWdJ6Iz0N', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNExpbFFEUHUyalI5Q0VZVllLYlpWR2xLSnE0djFjVTlBa3BaM25wSSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNDoiaHR0cDovL2RpbmFzLXBlcmtpbS50ZXN0L2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM1OiJodHRwOi8vZGluYXMtcGVya2ltLnRlc3QvY2hlY2stYXV0aCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1755184303),
	('zmNf4jiS39pz6vXLtJBHfkcgyih5dMpQul3pZkgU', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibURrYTR3Q2wwTUI1SlBQejg2WnZuZUUwTnV4b3g2bnhhNTFqOThoRCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NztzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozNDoiaHR0cDovL2RpbmFzLXBlcmtpbS50ZXN0L2Rhc2hib2FyZCI7fX0=', 1755183754);

-- Dumping structure for table db_dinas_perkim.slides
CREATE TABLE IF NOT EXISTS `slides` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subjudul` text COLLATE utf8mb4_unicode_ci,
  `tombol_teks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tombol_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urutan` int NOT NULL DEFAULT '0',
  `status` enum('published','draft') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_dinas_perkim.slides: ~1 rows (approximately)
INSERT INTO `slides` (`id`, `gambar`, `judul`, `subjudul`, `tombol_teks`, `tombol_url`, `urutan`, `status`, `created_at`, `updated_at`) VALUES
	(5, 'b7kzffSwMdTA29KFOes6jKry0XmgUgcgT4aHmbKL.jpg', NULL, NULL, NULL, NULL, 0, 'published', '2025-09-07 19:45:47', '2025-09-07 19:45:47');

-- Dumping structure for table db_dinas_perkim.unduhans
CREATE TABLE IF NOT EXISTS `unduhans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_dinas_perkim.unduhans: ~0 rows (approximately)
INSERT INTO `unduhans` (`id`, `judul`, `deskripsi`, `file`, `created_at`, `updated_at`) VALUES
	(2, 'Ini adalah ujicoba fitur tambah dokumen baru (1)', 'Dokumen', 'KRS-223020503135-AHMAD FADLILAH RAMADLAN (sudah diajukan).pdf', '2025-08-12 18:32:53', '2025-08-12 18:32:53');

-- Dumping structure for table db_dinas_perkim.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_dinas_perkim.users: ~2 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `role`, `status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Audent Kent', 'audentkent@gmail.com', 'user', 'active', '2025-08-14 07:28:22', '$2y$12$/qiK4GNhCU7sNTBRrJ0S5eQel.yLb6g6/lMs/VkPcJd7azN6ruGQm', 'iE2IbIZcoKHLIMz44ipsp9N1A9IY5aJG5cDX6eePAOVtVAVDOuMX67CfxGCl', '2025-08-11 21:01:52', '2025-08-26 21:19:03'),
	(7, 'Administrator', 'admin@dinasperkim.go.id', 'admin', 'active', '2025-08-14 04:17:33', '$2y$12$QdSuBVi//n9Yyy.wUP3hr.RKzOd68w9cOb.Y4PUnKNJ3LcBrRbLHK', 'xb0wkQEB4Kj2g7a814JCx3bhE6NYAYsbA0du7B3Z8j2Yo2fRWWgBwzlHkGYp', '2025-08-14 04:17:33', '2025-08-24 21:20:26'),
	(10, 'Penulis Konten', 'penulis@example.com', 'user', 'active', NULL, '$2y$12$zMxifVLpCjvHf/lW5uLAHOsHkiYZo.Ke.Fw6C.ei3B3vChYSwWGMy', NULL, '2025-09-07 20:09:22', '2025-09-07 20:09:22');

-- Dumping structure for table db_dinas_perkim.visi_misis
CREATE TABLE IF NOT EXISTS `visi_misis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'visi, misi, nilai, tujuan',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci COMMENT 'Deskripsi tambahan untuk nilai dan tujuan',
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Icon class untuk nilai-nilai',
  `color_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'CSS class untuk warna',
  `order_position` int NOT NULL DEFAULT '0' COMMENT 'Urutan tampil',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `visi_misis_type_is_active_order_position_index` (`type`,`is_active`,`order_position`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_dinas_perkim.visi_misis: ~6 rows (approximately)
INSERT INTO `visi_misis` (`id`, `type`, `title`, `content`, `description`, `icon`, `color_class`, `order_position`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 'visi', 'Visi Dinas Perumahan dan Permukiman', 'Terwujudnya perumahan dan permukiman yang layak huni, berkelanjutan, dan terjangkau bagi seluruh masyarakat menuju kehidupan yang sejahtera dan bermartabat.', NULL, NULL, NULL, 1, 1, '2025-08-26 20:49:42', '2025-08-26 20:49:42'),
	(2, 'misi', 'Misi 1', 'Menyelenggarakan perencanaan dan pembangunan perumahan yang berkualitas, terjangkau, dan berkelanjutan', NULL, NULL, NULL, 1, 1, '2025-08-26 20:49:42', '2025-08-26 20:49:42'),
	(3, 'misi', 'Misi 2', 'Mengembangkan kawasan permukiman yang layak huni dengan infrastruktur yang memadai dan berwawasan lingkungan', NULL, NULL, NULL, 2, 1, '2025-08-26 20:49:42', '2025-08-26 20:49:42'),
	(4, 'misi', 'Misi 3', 'Memberikan pelayanan prima dalam bidang pertanahan untuk menjamin kepastian hukum kepemilikan tanah', NULL, NULL, NULL, 3, 1, '2025-08-26 20:49:42', '2025-08-26 20:49:42'),
	(5, 'misi', 'Misi 4', 'Melakukan pembinaan dan pengawasan terhadap pembangunan perumahan dan permukiman sesuai standar yang ditetapkan', NULL, NULL, NULL, 4, 1, '2025-08-26 20:49:42', '2025-08-26 20:49:42'),
	(6, 'misi', 'Misi 5', 'Meningkatkan kapasitas kelembagaan dan sumber daya manusia untuk memberikan pelayanan yang profesional dan transparan', NULL, NULL, NULL, 5, 1, '2025-08-26 20:49:42', '2025-08-26 20:49:42');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
