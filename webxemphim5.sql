-- MySQL dump 10.13  Distrib 8.0.42, for Win64 (x86_64)
--
-- Host: localhost    Database: webxemphim
-- ------------------------------------------------------
-- Server version	9.3.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `binh_luan`
--

DROP TABLE IF EXISTS `binh_luan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `binh_luan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `phim_id` bigint unsigned DEFAULT NULL,
  `tap_phim_id` bigint unsigned DEFAULT NULL,
  `noi_dung` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `binh_luan_user_id_foreign` (`user_id`),
  KEY `binh_luan_phim_id_foreign` (`phim_id`),
  KEY `binh_luan_tap_phim_id_foreign` (`tap_phim_id`),
  CONSTRAINT `binh_luan_phim_id_foreign` FOREIGN KEY (`phim_id`) REFERENCES `phim` (`id`) ON DELETE CASCADE,
  CONSTRAINT `binh_luan_tap_phim_id_foreign` FOREIGN KEY (`tap_phim_id`) REFERENCES `tap_phim` (`id`) ON DELETE CASCADE,
  CONSTRAINT `binh_luan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `binh_luan`
--

LOCK TABLES `binh_luan` WRITE;
/*!40000 ALTER TABLE `binh_luan` DISABLE KEYS */;
/*!40000 ALTER TABLE `binh_luan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `luot_xem`
--

DROP TABLE IF EXISTS `luot_xem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `luot_xem` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `phim_id` bigint unsigned DEFAULT NULL,
  `tap_phim_id` bigint unsigned DEFAULT NULL,
  `xem_luc` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `luot_xem_user_id_foreign` (`user_id`),
  KEY `luot_xem_phim_id_foreign` (`phim_id`),
  KEY `luot_xem_tap_phim_id_foreign` (`tap_phim_id`),
  CONSTRAINT `luot_xem_phim_id_foreign` FOREIGN KEY (`phim_id`) REFERENCES `phim` (`id`) ON DELETE CASCADE,
  CONSTRAINT `luot_xem_tap_phim_id_foreign` FOREIGN KEY (`tap_phim_id`) REFERENCES `tap_phim` (`id`) ON DELETE CASCADE,
  CONSTRAINT `luot_xem_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `luot_xem`
--

LOCK TABLES `luot_xem` WRITE;
/*!40000 ALTER TABLE `luot_xem` DISABLE KEYS */;
/*!40000 ALTER TABLE `luot_xem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2025_09_21_150547_create_videos_table',2),(6,'2025_09_21_151552_create_notifications_table',2),(8,'2025_09_22_081108_add_uid_to_users_table',3),(9,'2025_09_22_073240_create_videos_table',4),(10,'2025_09_24_083159_rename_uid_to_user_id_in_users_table',4),(11,'2025_09_24_092738_create_the_loai_table',5),(12,'2025_09_24_092827_create_phim_table',5),(13,'2025_09_24_092858_create_tap_phim_table',5),(14,'2025_09_24_092930_create_phim_the_loai_table',5),(15,'2025_09_24_093004_create_luot_xem_table',5),(16,'2025_09_24_093033_create_binh_luan_table',5),(17,'2025_09_26_151049_add_hien_thi_to_phim_table',6),(18,'2025_09_30_145848_add_so_tap_to_phim_table',7),(19,'2025_09_30_164726_update_tap_phim_table',8);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `message` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_user_id_foreign` (`user_id`),
  CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phim`
--

DROP TABLE IF EXISTS `phim`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phim` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ten_phim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mo_ta` text COLLATE utf8mb4_unicode_ci,
  `nam_phat_hanh` int DEFAULT NULL,
  `duong_dan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anh_bia` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loai` enum('phim_le','phim_bo') COLLATE utf8mb4_unicode_ci NOT NULL,
  `trailer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `so_tap` int DEFAULT NULL,
  `thoi_luong` int DEFAULT NULL,
  `trang_thai` enum('cong_khai','nhap') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cong_khai',
  `hien_thi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'binh_thuong',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `phim_duong_dan_unique` (`duong_dan`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phim`
--

LOCK TABLES `phim` WRITE;
/*!40000 ALTER TABLE `phim` DISABLE KEYS */;
INSERT INTO `phim` VALUES (11,'Phim Điện Ảnh Doraemon: Nobita Và Bản Giao Hưởng Địa Cầu (2024)','Doraemon: Nobita và bản giao hưởng Địa Cầu là bộ phim hoạt hình phiêu lưu, khoa học viễn tưởng Nhật Bản năm 2024. Đây là phim điện ảnh thứ 43 trong loạt phim điện ảnh Doraemon.',2024,NULL,'img/ds_phim/ds_phim_le/phim_dien_anh_doraemon_nobita_va_ban_giao_huong_dia_cau_2024/1759242207_vimage.jpg','phim_le','img/ds_phim/ds_phim_le/phim_dien_anh_doraemon_nobita_va_ban_giao_huong_dia_cau_2024/1759242207_PHIM ĐIỆN ẢNH DORAEMON- NOBITA VÀ BẢN GIAO HƯỞNG ĐỊA CẦU - TRAILER - DKKC- 05.2024.mp4','img/ds_phim/ds_phim_le/phim_dien_anh_doraemon_nobita_va_ban_giao_huong_dia_cau_2024/1759242207_PHIM ĐIỆN ẢNH DORAEMON- NOBITA VÀ BẢN GIAO HƯỞNG ĐỊA CẦU - TRAILER - DKKC- 05.2024.mp4',NULL,150,'cong_khai','noi_bat','2025-09-30 07:23:27','2025-09-30 10:15:45'),(12,'THÁM TỬ LỪNG DANH CONAN: NÀNG DÂU HALLOWEEN','Thám tử lừng danh Conan: Nàng dâu Halloween là phim điện ảnh anime trinh thám năm 2022 của Nhật Bản dựa trên nguyên tác là bộ manga Thám tử lừng danh Conan của hoạ sĩ Aoyama Gōshō. Phim do Mitsunaka Susumu đạo diễn, dựa trên phần kịch bản do Okura Takahiro chấp bút.',2023,NULL,'img/ds_phim/ds_phim_le/tham_tu_lung_danh_conan_nang_dau_halloween/1759242281_images.jpg','phim_le','img/ds_phim/ds_phim_le/tham_tu_lung_danh_conan_nang_dau_halloween/1759242281_THÁM TỬ LỪNG DANH CONAN- NÀNG DÂU HALLOWEEN - Teaser trailer 30s - Vietsub.mp4','img/ds_phim/ds_phim_le/tham_tu_lung_danh_conan_nang_dau_halloween/1759242281_THÁM TỬ LỪNG DANH CONAN- NÀNG DÂU HALLOWEEN - Teaser trailer 30s - Vietsub.mp4',NULL,120,'cong_khai','hot','2025-09-30 07:24:41','2025-09-30 08:45:59'),(18,'CONAN','Hayy',2025,NULL,'img/ds_phim/ds_phim_bo/conan/1759254095_conan-rewrite-2-172059.jpg','phim_bo','img/ds_phim/ds_phim_bo/conan/1759254095_THÁM TỬ LỪNG DANH CONAN- NÀNG DÂU HALLOWEEN - Teaser trailer 30s - Vietsub.mp4',NULL,12,45,'cong_khai','moi','2025-09-30 10:41:35','2025-09-30 11:16:53'),(20,'DORAEMON','Doraemon là nhân vật chính hư cấu trong loạt Manga cùng tên của họa sĩ Fujiko F. Fujio. Trong truyện lấy bối cảnh ở thế kỷ 22, Doraemon là chú mèo robot của tương lai do xưởng Matsushiba — công xưởng chuyên sản xuất robot vốn dĩ nhằm mục đích chăm sóc trẻ nhỏ.',2025,NULL,'img/ds_phim/ds_phim_bo/doraemon/1759258945_doraemon.png','phim_bo','img/ds_phim/ds_phim_bo/doraemon/1759256853_(Trailer) Lồng Tiếng Đoraemon Movie 45 Tân Nobita Lâu Đài Dưới Đáy Biển (2026).mp4',NULL,10,15,'cong_khai','moi','2025-09-30 11:27:33','2025-09-30 12:02:25'),(21,'CONAN ( Phiên ngoại )','Thám tử lừng danh Conan là một series manga trinh thám được sáng tác bởi Aoyama Gōshō. Tác phẩm được đăng tải trên tạp chí Weekly Shōnen Sunday của nhà xuất bản Shogakukan vào năm 1994 và được đóng gói thành 107 tập tankōbon tính đến tháng 4 năm 2025.',2025,NULL,'img/ds_phim/ds_phim_bo/conan_phien_ngoai/1759257520_conan-rewrite-2-172059.jpg','phim_bo','img/ds_phim/ds_phim_bo/conan_phien_ngoai/1759257520_THÁM TỬ LỪNG DANH CONAN- NÀNG DÂU HALLOWEEN - Teaser trailer 30s - Vietsub.mp4',NULL,12,45,'cong_khai','moi','2025-09-30 11:38:40','2025-09-30 11:38:40');
/*!40000 ALTER TABLE `phim` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phim_the_loai`
--

DROP TABLE IF EXISTS `phim_the_loai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `phim_the_loai` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `phim_id` bigint unsigned NOT NULL,
  `the_loai_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `phim_the_loai_phim_id_the_loai_id_unique` (`phim_id`,`the_loai_id`),
  KEY `phim_the_loai_the_loai_id_foreign` (`the_loai_id`),
  CONSTRAINT `phim_the_loai_phim_id_foreign` FOREIGN KEY (`phim_id`) REFERENCES `phim` (`id`) ON DELETE CASCADE,
  CONSTRAINT `phim_the_loai_the_loai_id_foreign` FOREIGN KEY (`the_loai_id`) REFERENCES `the_loai` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phim_the_loai`
--

LOCK TABLES `phim_the_loai` WRITE;
/*!40000 ALTER TABLE `phim_the_loai` DISABLE KEYS */;
INSERT INTO `phim_the_loai` VALUES (15,11,6,NULL,NULL),(16,11,7,NULL,NULL),(17,12,6,NULL,NULL),(18,12,7,NULL,NULL),(34,18,3,NULL,NULL),(35,18,6,NULL,NULL),(36,18,7,NULL,NULL),(40,20,6,NULL,NULL),(41,20,7,NULL,NULL),(42,21,3,NULL,NULL),(43,21,6,NULL,NULL),(44,21,7,NULL,NULL);
/*!40000 ALTER TABLE `phim_the_loai` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tap_phim`
--

DROP TABLE IF EXISTS `tap_phim`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tap_phim` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `phim_id` bigint unsigned NOT NULL,
  `ten_phim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tap` int DEFAULT NULL,
  `trang_thai` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tap_phim_phim_id_foreign` (`phim_id`),
  CONSTRAINT `tap_phim_phim_id_foreign` FOREIGN KEY (`phim_id`) REFERENCES `phim` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tap_phim`
--

LOCK TABLES `tap_phim` WRITE;
/*!40000 ALTER TABLE `tap_phim` DISABLE KEYS */;
INSERT INTO `tap_phim` VALUES (13,18,'CONAN',NULL,1,'nhap','2025-09-30 10:41:35','2025-09-30 10:41:35'),(14,18,'CONAN',NULL,2,'nhap','2025-09-30 10:41:35','2025-09-30 10:41:35'),(15,18,'CONAN',NULL,3,'nhap','2025-09-30 10:41:35','2025-09-30 10:41:35'),(16,18,'CONAN',NULL,4,'nhap','2025-09-30 10:41:35','2025-09-30 10:41:35'),(17,18,'CONAN',NULL,5,'nhap','2025-09-30 10:41:35','2025-09-30 10:41:35'),(18,18,'CONAN',NULL,6,'nhap','2025-09-30 10:41:35','2025-09-30 10:41:35'),(19,18,'CONAN',NULL,7,'nhap','2025-09-30 10:41:35','2025-09-30 10:41:35'),(20,18,'CONAN',NULL,8,'nhap','2025-09-30 10:41:35','2025-09-30 10:41:35'),(21,18,'CONAN',NULL,9,'nhap','2025-09-30 10:41:35','2025-09-30 10:41:35'),(22,18,'CONAN',NULL,10,'nhap','2025-09-30 10:41:35','2025-09-30 10:41:35'),(23,18,'CONAN',NULL,11,'nhap','2025-09-30 10:41:35','2025-09-30 10:41:35'),(24,18,'CONAN',NULL,12,'nhap','2025-09-30 10:41:35','2025-09-30 10:41:35'),(45,20,'DORAEMON',NULL,1,'nhap','2025-09-30 11:27:33','2025-09-30 11:27:33'),(46,20,'DORAEMON',NULL,2,'nhap','2025-09-30 11:27:33','2025-09-30 11:27:33'),(47,20,'DORAEMON',NULL,3,'nhap','2025-09-30 11:27:33','2025-09-30 11:27:33'),(48,20,'DORAEMON',NULL,4,'nhap','2025-09-30 11:27:33','2025-09-30 11:27:33'),(49,20,'DORAEMON',NULL,5,'nhap','2025-09-30 11:27:33','2025-09-30 11:27:33'),(50,20,'DORAEMON',NULL,6,'nhap','2025-09-30 11:27:33','2025-09-30 11:27:33'),(51,20,'DORAEMON',NULL,7,'nhap','2025-09-30 11:27:33','2025-09-30 11:27:33'),(52,20,'DORAEMON',NULL,8,'nhap','2025-09-30 11:27:33','2025-09-30 11:27:33'),(53,20,'DORAEMON',NULL,9,'nhap','2025-09-30 11:27:33','2025-09-30 11:27:33'),(54,20,'DORAEMON',NULL,10,'nhap','2025-09-30 11:27:33','2025-09-30 11:27:33'),(55,21,'CONAN ( Phiên ngoại )',NULL,1,'nhap','2025-09-30 11:38:40','2025-09-30 11:38:40'),(56,21,'CONAN ( Phiên ngoại )',NULL,2,'nhap','2025-09-30 11:38:40','2025-09-30 11:38:40'),(57,21,'CONAN ( Phiên ngoại )',NULL,3,'nhap','2025-09-30 11:38:40','2025-09-30 11:38:40'),(58,21,'CONAN ( Phiên ngoại )',NULL,4,'nhap','2025-09-30 11:38:40','2025-09-30 11:38:40'),(59,21,'CONAN ( Phiên ngoại )',NULL,5,'nhap','2025-09-30 11:38:40','2025-09-30 11:38:40'),(60,21,'CONAN ( Phiên ngoại )',NULL,6,'nhap','2025-09-30 11:38:40','2025-09-30 11:38:40'),(61,21,'CONAN ( Phiên ngoại )',NULL,7,'nhap','2025-09-30 11:38:40','2025-09-30 11:38:40'),(62,21,'CONAN ( Phiên ngoại )',NULL,8,'nhap','2025-09-30 11:38:40','2025-09-30 11:38:40'),(63,21,'CONAN ( Phiên ngoại )',NULL,9,'nhap','2025-09-30 11:38:40','2025-09-30 11:38:40'),(64,21,'CONAN ( Phiên ngoại )',NULL,10,'nhap','2025-09-30 11:38:40','2025-09-30 11:38:40'),(65,21,'CONAN ( Phiên ngoại )',NULL,11,'nhap','2025-09-30 11:38:40','2025-09-30 11:38:40'),(66,21,'CONAN ( Phiên ngoại )',NULL,12,'nhap','2025-09-30 11:38:40','2025-09-30 11:38:40');
/*!40000 ALTER TABLE `tap_phim` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `the_loai`
--

DROP TABLE IF EXISTS `the_loai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `the_loai` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ten_the_loai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `the_loai_ten_the_loai_unique` (`ten_the_loai`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `the_loai`
--

LOCK TABLES `the_loai` WRITE;
/*!40000 ALTER TABLE `the_loai` DISABLE KEYS */;
INSERT INTO `the_loai` VALUES (3,'hành động','2025-09-24 03:19:30','2025-09-25 08:08:18'),(4,'tình cảm','2025-09-25 08:07:35','2025-09-25 08:08:23'),(5,'phiêu lưu','2025-09-25 08:08:31','2025-09-25 08:08:31'),(6,'hoạt hình','2025-09-25 09:12:18','2025-09-25 09:12:18'),(7,'điện ảnh','2025-09-25 09:12:22','2025-09-25 09:12:22');
/*!40000 ALTER TABLE `the_loai` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_uid_unique` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'31333635','ss','ss@gmail.com',NULL,'$2y$12$Dbpx0lbcWLKH9f4dN3R5SuXIAR3y2vArRsxedhvv3ORzqg/kUe8BO',NULL,'2025-09-22 01:40:06','2025-09-22 01:40:06');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-10-01  2:03:58
