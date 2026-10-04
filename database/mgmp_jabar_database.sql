/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-11.8.3-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: laravel
-- ------------------------------------------------------
-- Server version	11.8.3-MariaDB-0+deb13u1 from Debian

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `agendas`
--

DROP TABLE IF EXISTS `agendas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `agendas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `status` enum('draft','published') NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agendas`
--

LOCK TABLES `agendas` WRITE;
/*!40000 ALTER TABLE `agendas` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `agendas` VALUES
(1,'agenda','<p>agenda a<strong>gehn<em>da</em></strong></p>',NULL,'2026-06-30','10:39:00','gedung sate','published','2026-06-29 01:37:43','2026-06-29 01:37:43'),
(2,'test2','<p>test2</p>',NULL,'2026-07-03',NULL,'test','published','2026-06-30 22:13:59','2026-06-30 22:13:59');
/*!40000 ALTER TABLE `agendas` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `beritas`
--

DROP TABLE IF EXISTS `beritas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `beritas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `excerpt` text DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('draft','published') NOT NULL DEFAULT 'draft',
  `published_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `beritas_slug_unique` (`slug`),
  KEY `beritas_user_id_foreign` (`user_id`),
  CONSTRAINT `beritas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `beritas`
--

LOCK TABLES `beritas` WRITE;
/*!40000 ALTER TABLE `beritas` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `beritas` VALUES
(5,'berita','berita','berita','<p>berita&nbsp;<strong>test&nbsp;</strong>mantapppp, <strong>123&nbsp;</strong></p>','berita/zjG7odBRQBmQr15YZOoK6IrA3IQ8hJf0ryxheLUA.jpg','published','2026-06-29 01:36:03',2,'2026-06-29 01:36:03','2026-06-29 01:36:03'),
(6,'test','test','test','<p>test</p>',NULL,'published','2026-06-30 11:56:46',19,'2026-06-30 11:56:46','2026-06-30 11:56:46'),
(7,'test2','test2','test2','<p>test2</p>','berita/AekQfh9t5zdGqwU3R2sTOQUdHA34jlQKRkHgLJxc.png','published','2026-06-30 22:11:50',20,'2026-06-30 22:11:50','2026-06-30 22:11:50');
/*!40000 ALTER TABLE `beritas` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `chat_messages`
--

DROP TABLE IF EXISTS `chat_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `chat_messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `chat_session_id` bigint(20) unsigned NOT NULL,
  `sender` enum('visitor','admin') NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `chat_messages_chat_session_id_foreign` (`chat_session_id`),
  CONSTRAINT `chat_messages_chat_session_id_foreign` FOREIGN KEY (`chat_session_id`) REFERENCES `chat_sessions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat_messages`
--

LOCK TABLES `chat_messages` WRITE;
/*!40000 ALTER TABLE `chat_messages` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `chat_messages` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `chat_sessions`
--

DROP TABLE IF EXISTS `chat_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `chat_sessions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `session_id` varchar(255) NOT NULL,
  `visitor_name` varchar(255) NOT NULL,
  `visitor_email` varchar(255) DEFAULT NULL,
  `status` enum('active','closed') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `chat_sessions_session_id_unique` (`session_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat_sessions`
--

LOCK TABLES `chat_sessions` WRITE;
/*!40000 ALTER TABLE `chat_sessions` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `chat_sessions` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `downloads`
--

DROP TABLE IF EXISTS `downloads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `downloads` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_size` int(11) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `status` enum('draft','published') NOT NULL DEFAULT 'draft',
  `is_public` tinyint(1) NOT NULL DEFAULT 1,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `downloads_user_id_foreign` (`user_id`),
  CONSTRAINT `downloads_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `downloads`
--

LOCK TABLES `downloads` WRITE;
/*!40000 ALTER TABLE `downloads` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `downloads` VALUES
(1,'test','<p>test</p>','download/BSNECA0kEzL7MzRWmDzxqxzeopG4Iz3vEEQsXYpj.pdf',96804,'test','published',1,20,'2026-06-30 22:15:12','2026-06-30 22:15:12');
/*!40000 ALTER TABLE `downloads` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `galeris`
--

DROP TABLE IF EXISTS `galeris`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `galeris` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('draft','published') NOT NULL DEFAULT 'draft',
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `galeris_user_id_foreign` (`user_id`),
  CONSTRAINT `galeris_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galeris`
--

LOCK TABLES `galeris` WRITE;
/*!40000 ALTER TABLE `galeris` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `galeris` VALUES
(1,'gallery','galeri/hzsi58BcR5Hcp5H9t6ukC80bxDZ0bWvhjbklYYsp.jpg','gallery','published',2,'2026-06-29 01:36:46','2026-06-29 01:36:46'),
(2,'test produk','galeri/vGYjxG5YtcaoxFa7KEyji34Wl463iC9rAe13JmKj.png','test produk','published',20,'2026-06-30 22:13:07','2026-06-30 22:13:07');
/*!40000 ALTER TABLE `galeris` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` smallint(5) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `kegiatans`
--

DROP TABLE IF EXISTS `kegiatans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `kegiatans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `status` enum('draft','published') NOT NULL DEFAULT 'draft',
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kegiatans_slug_unique` (`slug`),
  KEY `kegiatans_user_id_foreign` (`user_id`),
  CONSTRAINT `kegiatans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kegiatans`
--

LOCK TABLES `kegiatans` WRITE;
/*!40000 ALTER TABLE `kegiatans` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `kegiatans` VALUES
(1,'kegiatan','kegiatan','<p><strong><em>kegiatan</em></strong></p>','kegiatan/1ED5dKLskWSdC8VPxSrjTcEx8O7UuuS7n7usou61.png','2026-06-23','bdg','published',2,'2026-06-29 01:37:11','2026-06-29 01:37:11'),
(2,'test2','test2','<p>test2</p>',NULL,'2026-06-29','test','published',20,'2026-06-30 22:13:34','2026-06-30 22:13:34');
/*!40000 ALTER TABLE `kegiatans` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `migrations` VALUES
(1,'0001_01_01_000000_create_users_table',1),
(2,'0001_01_01_000001_create_cache_table',1),
(3,'0001_01_01_000002_create_jobs_table',1),
(4,'2025_08_14_170933_add_two_factor_columns_to_users_table',1),
(5,'2026_05_18_130203_create_students_table',1),
(6,'2026_06_27_062538_add_role_to_users_table',2),
(7,'2026_06_27_062624_create_beritas_table',2),
(8,'2026_06_27_062625_create_programs_table',2),
(9,'2026_06_27_062626_create_galeris_table',2),
(10,'2026_06_27_062627_create_kegiatans_table',2),
(11,'2026_06_27_062628_create_downloads_table',2),
(12,'2026_06_27_121102_create_agendas_table',3),
(13,'2026_06_28_000000_add_avatar_to_users_table',4),
(14,'2026_06_29_003152_create_settings_table',5),
(15,'2026_06_29_004306_create_strukturs_table',6),
(16,'2026_06_29_101507_add_image_to_programs_and_agendas_tables',7),
(17,'2026_06_29_104531_add_is_public_to_downloads_table',7),
(18,'2026_06_30_112704_seed_default_users',7),
(19,'2026_06_30_123000_add_sekolah_fields_to_users_table',7),
(20,'2026_06_30_214935_create_chat_sessions_table',8),
(21,'2026_06_30_214936_create_chat_messages_table',9),
(22,'2026_06_30_235000_add_user_id_to_strukturs_table',10);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `programs`
--

DROP TABLE IF EXISTS `programs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `programs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `icon` varchar(255) NOT NULL DEFAULT 'fa-star',
  `status` enum('draft','published') NOT NULL DEFAULT 'draft',
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `programs_slug_unique` (`slug`),
  KEY `programs_user_id_foreign` (`user_id`),
  CONSTRAINT `programs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `programs`
--

LOCK TABLES `programs` WRITE;
/*!40000 ALTER TABLE `programs` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `programs` VALUES
(1,'test program','test-program','<p>test <strong>program</strong></p>',NULL,'fa-star','published',2,'2026-06-29 01:36:31','2026-06-29 01:36:31'),
(2,'test2','test2','<p>test2</p>','program/NSXlsnPWdF62ib7YqbcIgFMOUcQL5m4zw5udly8o.png','fa-star','published',20,'2026-06-30 22:12:29','2026-06-30 22:12:29');
/*!40000 ALTER TABLE `programs` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `sessions` VALUES
('BT4iSP10dhn2ooryAySCz1efSn1xInXpH5DZ8pPh',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTU45WWRYazZlaEhGZFRucUFzR1Rsa0pEZHl3ZnVneXZ2am50aldocCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NjM6Imh0dHA6Ly9pby54cmlzb25lLm15LmlkL3Byb2plY3RzL01HTVBfSkFCQVIvaW5kZXgucGhwP3ByZXZpZXc9MSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1782865450),
('hK4grfx6f4h09bDfPqd64RnSNc5oJ517a1Bd2NNP',20,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRW13SHZMTmhNUDVnUDM4aUxqSVphZU9tYWNsTUczb1g4ZmdEV1RCNyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTE6Imh0dHA6Ly9pby54cmlzb25lLm15LmlkL3Byb2plY3RzL01HTVBfSkFCQVIvYW5nZ290YSI7czo1OiJyb3V0ZSI7czo3OiJhbmdnb3RhIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjA7fQ==',1782866318),
('O6JoK6zwzrHPkGRbqhsLhe6RYheiBe0P8IVCTWRv',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZWh1YmZnRFZmd0dkaVpBOEpqbXdNbGV0ZjdLY3lLQ01DVmFES3lHcSI7czo3OiJzdWNjZXNzIjtzOjI2OiJCZXJoYXNpbCBrZWx1YXIgZGFyaSBha3VuLiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjE6e2k6MDtzOjc6InN1Y2Nlc3MiO319fQ==',1782865203),
('u8iPKTr0V2NtRpwhuKoz558LdsdMG6NDJ0LCr1bI',3,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoicEJuMzNITXNwQWU3and4S2NIdG82Y3RjWmc2RUdkeUtsV05YRHcwRSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTk6Imh0dHA6Ly9pby54cmlzb25lLm15LmlkL3Byb2plY3RzL01HTVBfSkFCQVIvcHJvZmlsZS9hbmdnb3RhIjtzOjU6InJvdXRlIjtzOjE1OiJwcm9maWxlLmFuZ2dvdGEiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=',1782866356);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `strukturs`
--

DROP TABLE IF EXISTS `strukturs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `strukturs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `education` varchar(255) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `order_num` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `strukturs_user_id_foreign` (`user_id`),
  CONSTRAINT `strukturs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `strukturs`
--

LOCK TABLES `strukturs` WRITE;
/*!40000 ALTER TABLE `strukturs` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `strukturs` VALUES
(2,6,'Iman Firmansyah, S.Pd','Sekretaris','assets/struktur/Iman Firmansyah,.S.Pd.jpeg','S1 Pendidikan, S.Pd.','SMKN 4 Kota Bandung',2,'2026-06-28 17:46:43','2026-07-01 07:28:35'),
(3,7,'Winny Febrianti, SE','Sekretaris','assets/struktur/Winny Febrianti,SE.jpeg','S1 Ekonomi, S.E.','SMK Madani Bandung',3,'2026-06-28 17:46:43','2026-07-01 07:28:35'),
(4,8,'Anni Supriatin S.Pd., M.M.Pd','Bendahara','assets/struktur/Anni Supriatin,S.Pd.,M.Pd.jpeg','S2 Manajemen Pendidikan, M.M.Pd.','SMKN 1 Kota Badung',4,'2026-06-28 17:46:43','2026-07-01 07:28:35'),
(5,9,'Anggita Septiani S.T.P., M.Pd','Bendahara','assets/struktur/Anggita Septiani,STP.,M.Pd.jpeg','S2 Pendidikan, M.Pd.','SMKN 13 Kota Bandung',5,'2026-06-28 17:46:43','2026-07-01 07:28:35'),
(6,10,'Dina Agustin, S.Pd','Bendahara','assets/struktur/Dina Agustin, S.E., Gr SMK MVP ARS INTR.jpeg','S1 Pendidikan, S.Pd.','SMK MVP ARS Bandung',6,'2026-06-28 17:46:43','2026-07-01 07:28:35'),
(7,11,'Drs. Sugiyo, MM','Kepala Bidang DIKLAT','assets/struktur/Sugiyo, S. Sos, MM.jpeg','S2 Manajemen, M.M.','SMK ICB Cinta Teknika Bandung',7,'2026-06-28 17:46:43','2026-07-01 07:28:35'),
(8,12,'Emma Mulyaningsih, S.Pd., MM','Kepala Bidang DIKLAT','assets/struktur/Emma Mulyaningsih,S.Pd. M.M..jpeg','S2 Manajemen, M.M.','SMKN 2 Sukabumi',8,'2026-06-28 17:46:43','2026-07-01 07:28:35'),
(9,13,'Dr. Deden Sukirman, SE., MM','Humas & Kerja Sama','assets/struktur/Dr. Deden Sukirman smkn 2 bdg .jpeg','S3 Manajemen, M.M.','SMKN 2 Kota Bandung',9,'2026-06-28 17:46:43','2026-07-01 07:28:35'),
(10,14,'Neni Dewi M, SP','Humas & Kerja Sama','assets/struktur/Neni Dewi.M, S.P.jpeg','S1 Pertanian, S.P.','SMK PPN Tanjungsari',10,'2026-06-28 17:46:43','2026-07-01 07:28:35'),
(11,15,'Yudi Hermawan MM','Kepala Bidang DIKLAT','','S2 Manajemen, M.M.','SMK Plus Ashabulyamin Cianjur',11,'2026-06-28 17:46:43','2026-07-01 07:28:35'),
(12,16,'Cempaka Dewi SE','Humas & Kerja Sama','','S1 Ekonomi, S.E.','SMKN Padaherang Pangandaran',12,'2026-06-28 17:46:43','2026-07-01 07:28:35'),
(13,17,'H. Aan Subhan, MM., MP','Pengembangan Organisasi','struktur/HecLUwpvp4K3zG8mV9Kal2EhIqEbrB4km1DnzbHH.jpg','S2 Manajemen Pendidikan','SMK Bina Putra Nusantara Tasikmalaya',13,'2026-06-28 17:46:43','2026-07-01 07:28:35'),
(14,18,'Dadan Syarifudin, S.Pd','Pengembangan Organisasi','','S1 Pendidikan, S.Pd.','SMKN 3 Kota Bandung',14,'2026-06-28 17:46:43','2026-07-01 07:28:35'),
(25,5,'Dr. Asep Totoh, SE., MM','Ketua','avatars/user_5_dr_asep_totoh_se_mm.jpeg',NULL,'SMK Bakti Nusantara 666 Kab. Bandung',0,'2026-07-01 07:12:12','2026-07-01 07:12:12');
/*!40000 ALTER TABLE `strukturs` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `students` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `major` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `students_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `students` VALUES
(1,'Budi Santoso','budi@example.com','Informatika',NULL,NULL),
(2,'Siti Aminah','siti@example.com','Sistem Informasi',NULL,NULL),
(3,'Agus Setiawan','agus@example.com','Teknik Komputer',NULL,NULL),
(4,'Rina Marlina','rina@example.com','Informatika',NULL,NULL),
(5,'Joko Widodo','joko@example.com','Manajemen Informatika',NULL,NULL);
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `asal_sekolah` varchar(255) NOT NULL,
  `npsn_sekolah` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'member',
  `avatar` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `users` VALUES
(2,'Administrator','','','admin@mgmp.com','admin',NULL,NULL,'$2y$12$G98WG.jXj.w/0Gx6rGsyFOaXbSpvOdultpMvTAspsTnI4RLDIQEgK',NULL,NULL,NULL,'6pqkDGOKQ6gRaJshGRIE2JBmrCASH9hEANe0pWs6EK8u5YKOaIFzTx6uMqbZ','2026-06-28 16:24:21','2026-06-28 16:24:21'),
(3,'Administrator','','','admin@example.com','admin',NULL,'2026-06-30 07:59:09','$2y$12$o1zOvG4o891gXUmdZ4478OV9WRm4TlCuTVnRBNB8NLnKsNRqxvOTy',NULL,NULL,NULL,'EKEsAHzZaXNHsoIWHGMKBkEXybFs58xAi9YFMgjrrhYmJLlf3KBpsIuvNM6X','2026-06-30 07:59:09','2026-06-30 07:59:09'),
(5,'Dr. Asep Totoh, SE., MM','SMK Bakti Nusantara 666 Kab. Bandung','00000000','draseptotohsemm@mgmppkkjabar.id','member','avatars/user_5_dr_asep_totoh_se_mm.jpeg','2026-06-30 11:47:02','$2y$12$CP4zzLYWg84k0ttVgrLu9uZ1Frkn4c3NKRp58Q6AJoENu6zHqjyFm',NULL,NULL,NULL,NULL,'2026-06-30 11:42:32','2026-06-30 11:47:02'),
(6,'Iman Firmansyah, S.Pd','SMKN 4 Kota Bandung','00000000','imanfirmansyahspd@mgmppkkjabar.id','member','avatars/user_6_iman_firmansyah_s_pd.jpeg','2026-06-30 11:47:05','$2y$12$Yx1opdtgTOPWncCbdpkASuDIMVjlVOftXxvn8nFpzlz4wCsgzhCXO',NULL,NULL,NULL,NULL,'2026-06-30 11:42:33','2026-06-30 11:47:05'),
(7,'Winny Febrianti, SE','SMK Madani Bandung','00000000','winnyfebriantise@mgmppkkjabar.id','member','avatars/user_7_winny_febrianti_se.jpeg','2026-06-30 11:47:08','$2y$12$S07f6a4GVbNxxXH.9rD09egYkXunwSMLdw.ZaaoimbuvvS4m8CfjC',NULL,NULL,NULL,NULL,'2026-06-30 11:42:33','2026-06-30 11:47:08'),
(8,'Anni Supriatin S.Pd., M.M.Pd','SMKN 1 Kota Badung','00000000','annisupriatinspdmmpd@mgmppkkjabar.id','member','avatars/user_8_anni_supriatin_s_pd_m_m_pd.jpeg','2026-06-30 11:46:53','$2y$12$VSic2rqEWEpXeBsvs02CZOt2Sm8FYnUudzYiq539nwzDd7UjmMAQS',NULL,NULL,NULL,NULL,'2026-06-30 11:42:34','2026-06-30 11:46:53'),
(9,'Anggita Septiani S.T.P., M.Pd','SMKN 13 Kota Bandung','00000000','anggitaseptianistpmpd@mgmppkkjabar.id','member','avatars/user_9_anggita_septiani_s_t_p_m_pd.jpeg','2026-06-30 11:46:57','$2y$12$mrHVo.54asZcpXEL93DZSuHHNSwSCnoniLG72iyj3lw06RSPJrHQe',NULL,NULL,NULL,NULL,'2026-06-30 11:42:34','2026-06-30 11:46:57'),
(10,'Dina Agustin, S.Pd','SMK MVP ARS Bandung','00000000','dinaagustinspd@mgmppkkjabar.id','member','avatars/user_10_dina_agustin_s_pd.jpeg','2026-06-30 11:46:46','$2y$12$B3Hsh1G0yzN3XnjW0Zvs8ei8MnHV2scpeZd16p48p1TpaPCs0pP.y',NULL,NULL,NULL,NULL,'2026-06-30 11:42:35','2026-06-30 11:46:46'),
(11,'Drs. Sugiyo, MM','SMK ICB Cinta Teknika Bandung','00000000','drssugiyomm@mgmppkkjabar.id','member','avatars/user_11_drs_sugiyo_mm.jpeg','2026-06-30 11:46:49','$2y$12$6LPouakcqj7JXEMqyV0HLuuIfSZpktZv8rC4wSsVkk/uSumdgllte',NULL,NULL,NULL,NULL,'2026-06-30 11:42:35','2026-06-30 11:46:49'),
(12,'Emma Mulyaningsih, S.Pd., MM','SMKN 2 Sukabumi','00000000','emmamulyaningsihspdmm@mgmppkkjabar.id','member','avatars/user_12_emma_mulyaningsih_s_pd_mm.jpeg','2026-06-30 11:46:41','$2y$12$E39Cz2ViMUmZ8M9z6x3MquPTrqnPm1rFX3LLckD7w4K2dIrfcWQYS',NULL,NULL,NULL,NULL,'2026-06-30 11:42:37','2026-06-30 11:46:41'),
(13,'Dr. Deden Sukirman, SE., MM','SMKN 2 Kota Bandung','00000000','drdedensukirmansemm@mgmppkkjabar.id','member','avatars/user_13_dr_deden_sukirman_se_mm.jpeg','2026-06-30 11:46:43','$2y$12$gCDYY3ZAYt4vt7m/ip.VUOvEv64m89vzVuWHyIkOURE6aUPTkOlaq',NULL,NULL,NULL,NULL,'2026-06-30 11:42:37','2026-06-30 11:46:43'),
(14,'Neni Dewi M, SP','SMK PPN Tanjungsari','00000000','nenidewimsp@mgmppkkjabar.id','member','avatars/user_14_neni_dewi_m_sp.jpeg','2026-06-30 11:46:37','$2y$12$qlWFb9s./FT3F8.JHux19ewM4QTQqwyzI3OjaKKy4E9iQYaDizRPG',NULL,NULL,NULL,NULL,'2026-06-30 11:42:38','2026-06-30 11:46:37'),
(15,'Yudi Hermawan MM','SMK Plus Ashabulyamin Cianjur','00000000','yudihermawanmm@mgmppkkjabar.id','member','','2026-06-30 11:46:39','$2y$12$QS0uKCaGuAo.bctx6GOA0u8DCQTP9sKOeIjy95KPijPs0gGIaHexi',NULL,NULL,NULL,NULL,'2026-06-30 11:42:38','2026-06-30 11:46:39'),
(16,'Cempaka Dewi SE','SMKN Padaherang Pangandaran','00000000','cempakadewise@mgmppkkjabar.id','member','','2026-06-30 11:46:34','$2y$12$hRzkbrpivUaTJkCsDNs8neej5MSSevfCA.Q85Ox046c2o0oYi4/Gm',NULL,NULL,NULL,NULL,'2026-06-30 11:42:39','2026-06-30 11:46:34'),
(17,'H. Aan Subhan, MM., MP','SMK Bina Putra Nusantara Tasikmalaya','00000000','haansubhanmmmp@mgmppkkjabar.id','member','avatars/user_17_h_aan_subhan_mm_mp.jpg','2026-06-30 11:46:31','$2y$12$FUV1NphA0HTQCJ841Ra6uuzjD/qXo19BJfhuEvyM33Zu2tXd8OFmm',NULL,NULL,NULL,NULL,'2026-06-30 11:42:40','2026-06-30 11:46:31'),
(18,'Dadan Syarifudin, S.Pd','SMKN 3 Kota Bandung','00000000','dadansyarifudinspd@mgmppkkjabar.id','member','','2026-06-30 11:46:23','$2y$12$PlXZDi43mFee7mqNWN7vNe3bF52p0MfUR9Cucr.NFbZZ/ggX92xh.',NULL,NULL,NULL,NULL,'2026-06-30 11:42:41','2026-06-30 11:46:23'),
(19,'Salman Avicenna S, T, E','SMKN 3 Bandung','48137','12@com','member',NULL,NULL,'$2y$12$XKSL0TpUFhYBFy16EnEPNuGYqlvGA/FHlHUCrkrS.89c5finRf2yO',NULL,NULL,NULL,NULL,'2026-06-30 11:56:31','2026-06-30 11:56:31'),
(20,'Krisna','Test','00000','krisssna@gmail.com','member','avatars/20/1782866047_6a44607f2eba2.jpg','2026-06-30 20:34:02','$2y$12$QfNr.gbNOApJbERBxulhSeAlF3.3PQwTbKGi2ur2snjKVJMwo/5JS',NULL,NULL,NULL,NULL,'2026-06-30 20:17:32','2026-07-01 07:36:28'),
(21,'krisss','Test','0969','krisss@gmail.com','member',NULL,NULL,'$2y$12$ogzSPf4r8YlbvWarIvXDv.1sAgkmSNuN.ajKYNRBY34sg0wARU/eC',NULL,NULL,NULL,NULL,'2026-06-30 20:34:54','2026-06-30 20:34:54');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
commit;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2026-07-01  0:45:22
