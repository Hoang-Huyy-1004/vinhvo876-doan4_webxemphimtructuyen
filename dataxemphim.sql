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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
-- Table structure for table `lich_su_views`
--

DROP TABLE IF EXISTS `lich_su_views`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lich_su_views` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `phim_id` bigint unsigned NOT NULL,
  `view_ngay` int NOT NULL DEFAULT '0',
  `ngay` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lich_su_views_phim_id_ngay_index` (`phim_id`,`ngay`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lich_su_views`
--

LOCK TABLES `lich_su_views` WRITE;
/*!40000 ALTER TABLE `lich_su_views` DISABLE KEYS */;
INSERT INTO `lich_su_views` VALUES (1,12,3655,'2025-12-04','2025-12-04 08:04:51','2025-12-04 01:09:51'),(2,18,360,'2025-12-04','2025-12-04 08:04:51','2025-12-04 01:10:31'),(3,22,8586,'2025-12-04','2025-12-04 08:04:51','2025-12-04 08:04:51'),(4,25,19860,'2025-12-04','2025-12-04 08:04:51','2025-12-04 08:04:51'),(5,26,7777,'2025-12-04','2025-12-04 08:04:51','2025-12-04 08:04:51'),(6,27,2780,'2025-12-04','2025-12-04 08:04:51','2025-12-04 08:04:51'),(7,28,5555,'2025-12-04','2025-12-04 08:04:51','2025-12-04 08:04:51'),(8,31,4665,'2025-12-04','2025-12-04 08:04:51','2025-12-04 08:04:51'),(9,126,11288,'2025-12-04','2025-12-04 08:04:51','2025-12-04 08:04:51'),(10,127,3665,'2025-12-04','2025-12-04 08:04:51','2025-12-04 08:04:51'),(16,29,1111,'2025-12-04','2025-12-04 01:16:03','2025-12-04 01:16:03'),(17,25,2,'2025-12-05','2025-12-04 20:49:32','2025-12-04 20:51:46'),(18,22,2,'2025-12-05','2025-12-04 21:07:09','2025-12-04 22:05:48'),(19,28,2,'2025-12-05','2025-12-04 21:22:27','2025-12-04 22:06:25'),(20,128,2,'2025-12-05','2025-12-04 21:38:43','2025-12-04 21:38:49'),(21,129,14,'2025-12-05','2025-12-04 21:39:58','2025-12-04 21:50:52'),(22,126,2,'2025-12-05','2025-12-04 21:40:15','2025-12-04 21:50:46'),(23,29,1,'2025-12-05','2025-12-04 21:40:20','2025-12-04 21:40:20'),(24,20,1,'2025-12-05','2025-12-04 21:50:38','2025-12-04 21:50:38'),(25,130,5,'2025-12-05','2025-12-04 21:52:34','2025-12-04 22:03:31'),(26,131,6,'2025-12-05','2025-12-04 21:53:25','2025-12-04 22:04:12'),(27,99,1,'2025-12-05','2025-12-04 22:05:58','2025-12-04 22:05:58'),(28,111,2,'2025-12-05','2025-12-04 22:06:29','2025-12-04 22:06:39'),(29,109,1,'2025-12-05','2025-12-04 22:07:09','2025-12-04 22:07:09'),(30,31,1,'2025-12-05','2025-12-04 22:23:47','2025-12-04 22:23:47'),(31,132,10,'2025-12-05','2025-12-04 23:07:21','2025-12-04 23:11:07'),(32,125,10,'2025-12-08','2025-12-08 00:14:57','2025-12-08 00:19:49'),(33,22,1,'2025-12-08','2025-12-08 00:15:15','2025-12-08 00:15:15'),(34,28,1,'2025-12-08','2025-12-08 00:16:27','2025-12-08 00:16:27'),(35,31,4,'2025-12-08','2025-12-08 00:18:42','2025-12-08 00:22:41'),(36,25,2,'2025-12-08','2025-12-08 00:21:30','2025-12-08 00:21:39'),(37,25,1,'2025-12-12','2025-12-12 04:09:30','2025-12-12 04:09:30'),(38,26,1,'2025-12-12','2025-12-12 04:42:50','2025-12-12 04:42:50'),(39,125,1,'2025-12-12','2025-12-12 04:42:53','2025-12-12 04:42:53'),(40,29,1,'2025-12-12','2025-12-12 04:42:57','2025-12-12 04:42:57'),(41,26,1,'2025-12-13','2025-12-13 07:21:28','2025-12-13 07:21:28'),(42,31,2,'2025-12-13','2025-12-13 07:21:55','2025-12-13 07:22:40'),(43,25,1,'2026-07-17','2026-07-17 08:43:03','2026-07-17 08:43:03'),(44,127,1,'2026-07-19','2026-07-19 04:15:38','2026-07-19 04:15:38'),(45,22,1,'2026-07-20','2026-07-19 19:57:52','2026-07-19 19:57:52'),(46,25,1,'2026-07-30','2026-07-30 10:32:32','2026-07-30 10:32:32'),(47,25,1,'2026-08-16','2026-08-16 05:17:04','2026-08-16 05:17:04');
/*!40000 ALTER TABLE `lich_su_views` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2025_09_21_150547_create_videos_table',2),(6,'2025_09_21_151552_create_notifications_table',2),(8,'2025_09_22_081108_add_uid_to_users_table',3),(9,'2025_09_22_073240_create_videos_table',4),(10,'2025_09_24_083159_rename_uid_to_user_id_in_users_table',4),(11,'2025_09_24_092738_create_the_loai_table',5),(12,'2025_09_24_092827_create_phim_table',5),(13,'2025_09_24_092858_create_tap_phim_table',5),(14,'2025_09_24_092930_create_phim_the_loai_table',5),(15,'2025_09_24_093004_create_luot_xem_table',5),(16,'2025_09_24_093033_create_binh_luan_table',5),(17,'2025_09_26_151049_add_hien_thi_to_phim_table',6),(18,'2025_09_30_145848_add_so_tap_to_phim_table',7),(19,'2025_09_30_164726_update_tap_phim_table',8),(20,'2025_10_02_104301_add_google_id_to_users_table',9),(21,'2025_10_30_090643_add_slug_to_phim_table',10);
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
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mo_ta` text COLLATE utf8mb4_unicode_ci,
  `nam_phat_hanh` int DEFAULT NULL,
  `duong_dan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anh_bia` text COLLATE utf8mb4_unicode_ci,
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
) ENGINE=InnoDB AUTO_INCREMENT=157 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phim`
--

LOCK TABLES `phim` WRITE;
/*!40000 ALTER TABLE `phim` DISABLE KEYS */;
INSERT INTO `phim` VALUES (11,'Phim Điện Ảnh Doraemon: Nobita Và Bản Giao Hưởng Địa Cầu (2024)',NULL,'Doraemon: Nobita và bản giao hưởng Địa Cầu là bộ phim hoạt hình phiêu lưu, khoa học viễn tưởng Nhật Bản năm 2024. Đây là phim điện ảnh thứ 43 trong loạt phim điện ảnh Doraemon.',2024,NULL,'img/ds_phim/ds_phim_le/phim_dien_anh_doraemon_nobita_va_ban_giao_huong_dia_cau_2024/1759242207_vimage.jpg','phim_le','img/ds_phim/ds_phim_le/phim_dien_anh_doraemon_nobita_va_ban_giao_huong_dia_cau_2024/1759242207_PHIM ĐIỆN ẢNH DORAEMON- NOBITA VÀ BẢN GIAO HƯỞNG ĐỊA CẦU - TRAILER - DKKC- 05.2024.mp4','img/ds_phim/ds_phim_le/phim_dien_anh_doraemon_nobita_va_ban_giao_huong_dia_cau_2024/1759242207_PHIM ĐIỆN ẢNH DORAEMON- NOBITA VÀ BẢN GIAO HƯỞNG ĐỊA CẦU - TRAILER - DKKC- 05.2024.mp4',NULL,150,'nhap','hot','2025-09-30 07:23:27','2025-10-30 01:22:47'),(12,'THÁM TỬ LỪNG DANH CONAN: NÀNG DÂU HALLOWEEN',NULL,'Thám tử lừng danh Conan: Nàng dâu Halloween là phim điện ảnh anime trinh thám năm 2022 của Nhật Bản dựa trên nguyên tác là bộ manga Thám tử lừng danh Conan của hoạ sĩ Aoyama Gōshō. Phim do Mitsunaka Susumu đạo diễn, dựa trên phần kịch bản do Okura Takahiro chấp bút.',2023,NULL,'img/ds_phim/ds_phim_le/tham_tu_lung_danh_conan_nang_dau_halloween/1759242281_images.jpg','phim_le','img/ds_phim/ds_phim_le/tham_tu_lung_danh_conan_nang_dau_halloween/1759242281_THÁM TỬ LỪNG DANH CONAN- NÀNG DÂU HALLOWEEN - Teaser trailer 30s - Vietsub.mp4','img/ds_phim/ds_phim_le/tham_tu_lung_danh_conan_nang_dau_halloween/1759242281_THÁM TỬ LỪNG DANH CONAN- NÀNG DÂU HALLOWEEN - Teaser trailer 30s - Vietsub.mp4',NULL,120,'cong_khai','hot','2025-09-30 07:24:41','2025-10-30 00:46:20'),(18,'CONAN',NULL,'Hayy',2025,NULL,'img/ds_phim/ds_phim_bo/conan/1759254095_conan-rewrite-2-172059.jpg','phim_bo','img/ds_phim/ds_phim_bo/conan/1759254095_THÁM TỬ LỪNG DANH CONAN- NÀNG DÂU HALLOWEEN - Teaser trailer 30s - Vietsub.mp4',NULL,12,45,'cong_khai','hot','2025-09-30 10:41:35','2025-12-02 01:24:48'),(20,'DORAEMON',NULL,'Doraemon là nhân vật chính hư cấu trong loạt Manga cùng tên của họa sĩ Fujiko F. Fujio. Trong truyện lấy bối cảnh ở thế kỷ 22, Doraemon là chú mèo robot của tương lai do xưởng Matsushiba — công xưởng chuyên sản xuất robot vốn dĩ nhằm mục đích chăm sóc trẻ nhỏ.',2025,NULL,'img/ds_phim/ds_phim_bo/doraemon/1759336350_doraemon.png','phim_bo','img/ds_phim/ds_phim_bo/doraemon/1759256853_(Trailer) Lồng Tiếng Đoraemon Movie 45 Tân Nobita Lâu Đài Dưới Đáy Biển (2026).mp4',NULL,10,15,'cong_khai','hot','2025-09-30 11:27:33','2025-12-02 01:25:04'),(22,'Thư Sinh Mèo Báo (Phần 2)',NULL,'A thousand-year-old cat demon and a doctoral student team up to uncover the truth behind a past family massacre, traveling through time and facing hidden dangers along the way.',2025,NULL,'img/ds_phim/ds_phim_bo/thu_sinh_meo_bao_phan_2/1760703358_thu-sinh-meo-bao-phan-2-thumb.webp','phim_bo','https://youtu.be/wr6MeifZCUs',NULL,20,10,'cong_khai','moi','2025-10-17 05:15:59','2025-10-17 05:15:59'),(23,'Shin – Cậu bé bút chì',NULL,'Shin – Cậu bé bút chì, hay cũng được biết với tên gốc Crayon Shin-chan là một bộ manga Nhật Bản được Usui Yoshito sáng tác và minh họa. Nội dung kể xoay quanh cậu bé Shin với những câu chuyện về cuộc sống hàng ngày cùng với bố mẹ, em gái, chú chó Bạch Tuyết, bạn bè, hàng xóm, họ hàng thân quen và những nhân vật khác.',2020,NULL,'img/ds_phim/ds_phim_le/shin_cau_be_but_chi/1760711820_Shin.jpg','phim_le','img/ds_phim/ds_phim_le/shin_cau_be_but_chi/1760711820_PHIM SHIN CẬU BÉ BÚT CHÌ- NÓNG BỎNG TAY! NHỮNG VŨ CÔNG SIÊU CAY KASUKABE - LỒNG TIẾNG - DKKC 22.08.mp4','img/ds_phim/ds_phim_le/shin_cau_be_but_chi/1760711820_THÁM TỬ LỪNG DANH CONAN- NÀNG DÂU HALLOWEEN - Teaser trailer 30s - Vietsub.mp4',NULL,15,'nhap','noi_bat','2025-10-17 07:37:00','2025-10-31 20:29:27'),(24,'The Leopard Cat Scholar (Season 2)',NULL,'A thousand-year-old cat demon and a doctoral student team up to uncover the truth behind a past family massacre, traveling through time and facing hidden dangers along the way.',2025,NULL,'img/ds_phim/ds_phim_le/the_leopard_cat_scholar_season_2/1760712911_thu-sinh-meo-bao-phan-2-thumb.webp','phim_le','https://youtu.be/hbm5gW3q35I','img/ds_phim/ds_phim_le/the_leopard_cat_scholar_season_2/1760712911_PHIM SHIN CẬU BÉ BÚT CHÌ- NÓNG BỎNG TAY! NHỮNG VŨ CÔNG SIÊU CAY KASUKABE - LỒNG TIẾNG - DKKC 22.08.mp4',NULL,10,'cong_khai','hot','2025-10-17 07:55:11','2025-10-17 10:50:40'),(25,'Khi Ánh Sao Rơi Xuống Biển Hoa',NULL,'Cố Lưu Tô, nhà sáng lập một thương hiệu trang sức, là người mạnh mẽ quyết đoán trong công việc, đồng thời cũng nghiêm túc thận trọng trong cuộc sống thường ngày. Do phát sinh \"sự cố\", cô bất ngờ trải qua tình một đêm với chàng \"thiếu gia\" Lục Tinh Thần cô mới chỉ gặp một lần, từ đó dẫn đến hiểu lầm nghiêm trọng! Tệ hơn là ngay sau đó Lục Tinh Thần được nhận vào công ty, trở thành thư ký thân cận của Cố Lưu Tô. Cặp đôi oan gia không thể ngờ rằng, người từng đối đầu gay gắt lại có thể dần thay đổi theo thời gian. Lục Tinh Thần nảy sinh lòng mến mộ không thể nói rõ với Cố Lưu Tô. Tài năng thiết kế của cậu cũng được một người tỉ mỉ kĩ tính như Cố Lưu Tô công nhận. Sự hòa hợp về tâm hồn khiến họ ngày càng say mê trong tỉnh táo, đắm chìm trong những phút giây bình yên mà rạo rực sóng ngầm.',2025,NULL,'img/ds_phim/ds_phim_bo/khi_anh_sao_roi_xuong_bien_hoa/1760718135_khi-anh-sao-roi-xuong-bien-hoa-thumb.webp','phim_bo','https://youtu.be/MNm77lvTfi4',NULL,14,15,'cong_khai','moi','2025-10-17 09:22:15','2025-10-17 10:49:53'),(26,'Mắt biếc',NULL,'Đi qua những đau khổ và phản bội, mối tình đơn phương của Ngạn dành cho cô bạn thân thời thơ ấu Hà Lan kéo dài cả một thế hệ trong bộ phim siêu lãng mạn này.',2019,NULL,'img/ds_phim/ds_phim_le/mat_biec/1760719279_mat-biec-thumb.webp','phim_le','https://youtu.be/MNm77lvTfi4','https://vip.opstream16.com/share/6ecbdd6ec859d284dc13885a37ce8d81',NULL,116,'cong_khai','noi_bat','2025-10-17 09:41:19','2025-10-17 10:49:01'),(27,'Trăm Mảnh Ký Ức',NULL,'A heartbreaking first love story of a man who was destined to be the fate of two women who were bus guides in the 1980s, and a melodrama-comedy of shining youths who were destined to be brilliant.',2025,NULL,'img/ds_phim/ds_phim_bo/tram_manh_ky_uc/1760922317_tram-manh-ky-uc-thumb.webp','phim_bo','https://youtu.be/UEqjUBGjvwI',NULL,12,60,'cong_khai','moi','2025-10-19 18:05:17','2025-10-19 18:05:17'),(28,'Doraemon: Nobita Và Cuộc Phiêu Lưu Vào Thế Giới Trong Tranh',NULL,'Tên khác: ĐIỆN ẢNH DORAEMON44: NOBITA VÀ CUỘC PHIÊU LƯU VÀO THẾ GIỚI TRONG TRANH,DORAEMON THE MOVIE: Nobita\'s Picture World Story,Doraemon Movie 44: Nobita no E Sekai Monogatari,Doraemon Movie 44: Nobita\'s Art World Tales,哆啦A梦：大雄的绘世界物语,電影哆啦A夢：大雄的繪畫世界物語,哆啦A梦：大雄的绘画奇遇记,哆啦A梦：大雄的绘画世界物语,도라에몽 극장판: 진구의 그림이야기,Doraemon: Nobita\'s Art World Tales,電影多啦A夢：大雄之繪畫世界物語,Doraemon il film: Nobita e il racconto del mondo della pittura,映画ドラえもん のび太の絵世界物語,Дораэмон: Истории о мире искусства Нобиты,Phim Điện Ảnh Doraemon: Nobita Và Cuộc Phiêu Lưu Vào Thế Giới Trong Tranh\r\nCâu chuyện kể về hòn đá \"Arturia\" khoảng thời gian Châu Âu Thế Kỷ 13 | Công Quốc \"ARTURIA\". Tại đây đã xảy ra nhiều hiện tượng kỳ lạ từ thế giới trong tranh.',2025,NULL,'img/ds_phim/ds_phim_le/doraemon_nobita_va_cuoc_phieu_luu_vao_the_gioi_trong_tranh/1761967849_doraemon-nobita-va-cuoc-phieu-luu-vao-the-gioi-trong-tranh-thumb.webp','phim_le','https://youtu.be/pyAKQBucymk','https://vip.opstream90.com/share/997ddfb43e587b1580a0caba67f9de24',NULL,105,'cong_khai','noi_bat','2025-10-31 20:30:49','2025-10-31 20:30:49'),(29,'Tee Yod: Quỷ Ăn Tạng',NULL,'Tên khác: Thee Yod,ທີ່ຫຍົດ,Tee Yod,Ölümü Fısılsayan,Birinci əcinnə. Təqəmmüs,Quando a Morte Sussurra,Surma sosistaja,鬼聲陰,Бірінші сиқыршы: Реинкарнация,Первая ведьма: Реинкарнация,鬼聲泣,Шепіт смерті\r\nKhi linh hồn khát máu nọ nhập vào một cô gái trẻ ở ngôi làng hẻo lánh, anh trai cô đi đầu trong nỗ lực trục xuất linh hồn đó trước khi cô bị cái ác lấn át.',2023,NULL,'img/ds_phim/ds_phim_le/tee_yod_quy_an_tang/1761967970_tee-yod-quy-an-tang-thumb.webp','phim_le','https://youtu.be/LyXDbLWEPwo','https://vip.opstream17.com/share/8710ef761bbb29a6f9d12e4ef8e4379c',NULL,121,'cong_khai','noi_bat','2025-10-31 20:32:50','2025-10-31 20:33:06'),(30,'Tee Yod: Quỷ Ăn Tạng 2',NULL,'Tên khác: Tee Yod 2,Susurros Mortales 2,噬魂灵声2,Ölümü Fısıldayan 2,Susurros mortales 2,Quando a Morte Sussura 2,Surma sosistaja 2,Первая ведьма. Новые души,鬼聲泣2,Tee Yod: Quỷ Ăn Tạng Phần 2\r\nBa năm sau cái chết của Yam, Yak vẫn tiếp tục săn lùng linh hồn bí ẩn mặc áo choàng đen. Gặp một cô gái có triệu chứng giống Yam, Yak phát hiện ra người bảo vệ linh hồn, pháp sư ẩn dật Puang, sống trong một khu rừng đầy nguy hiểm. Giữa những phép thuật ma quỷ và những sinh vật nguy hiểm. Khi họ đuổi theo linh hồn mặc áo choàng đen, tiếng kêu đầy ám ảnh của Tee Yod sắp quay trở lại một lần nữa...',2024,NULL,'img/ds_phim/ds_phim_le/tee_yod_quy_an_tang_2/1761968179_tee-yod-quy-an-tang-2-thumb.webp','phim_le','https://youtu.be/xVVZvSybaEc','https://vip.opstream15.com/share/af1ea7c59c7e37f0b95b48bc972ceb67',NULL,112,'cong_khai','noi_bat','2025-10-31 20:36:19','2025-10-31 20:36:19'),(31,'Người Vợ Cuối Cùng',NULL,'Lấy cảm hứng từ tiểu thuyết Hồ Oán Hận, của nhà văn Hồng Thái, Người Vợ Cuối Cùng là một bộ phim tâm lý cổ trang, lấy bối cảnh Việt Nam vào triều Nguyễn. LINH - Người vợ bất đắc dĩ của một viên quan tri huyện, xuất thân là con của một gia đình nông dân nghèo khó, vì không thể hoàn thành nghĩa vụ sinh con nối dõi nên đã chịu sự chèn ép của những người vợ lớn trong gia đình. Sự gặp gỡ tình cờ của cô và người yêu thời thanh mai trúc mã của mình - NHÂN đã dẫn đến nhiều câu chuyện bất ngờ xảy ra khiến cuộc sống cô hoàn toàn thay đổi.',2023,NULL,'img/ds_phim/ds_phim_le/nguoi_vo_cuoi_cung/1761968480_nguoi-vo-cuoi-cung-thumb.webp','phim_le','https://youtu.be/TtS_V55VcxA','https://vip.opstream13.com/share/839541bfa1e1f4a879c4a5d4e5f6d88b',NULL,133,'cong_khai','moi','2025-10-31 20:41:20','2025-10-31 20:41:41'),(32,'Cuộc Chiến Hạ Lưu',NULL,'Giữa cuộc chiến mưu sinh khốc liệt nơi đô thị hào nhoáng, một gia đình gồm già trẻ lớn bé trong một xóm nghèo bỗng đứng trước nguy cơ mất đi chốn nương thân duy nhất. Khi biến cố ập đến, quá khứ, bí mật và toan tính riêng của mỗi người dần lộ diện. Liệu họ sẽ cùng nhau vượt qua hay chính những ẩn khuất ấy sẽ xé nát mái ấm mong manh này?',2025,NULL,'img/ds_phim/ds_phim_bo/cuoc_chien_ha_luu/1761969049_cuoc-chien-ha-luu-thumb.webp','phim_bo','https://youtu.be/4Wi0BppqXFI',NULL,12,45,'cong_khai','moi','2025-10-31 20:50:49','2025-10-31 20:50:49'),(93,'Ngụ Ngôn Của Tiến Sĩ Seuss: Giống Chim Sneetch','ngu-ngon-cua-tien-si-seuss-giong-chim-sneetch-1762165823',NULL,NULL,NULL,'https://cdn.competinghypotheses.org/storage/images/ngu-ngon-cua-tien-si-seuss-giong-chim-sneetch/ngu-ngon-cua-tien-si-seuss-giong-chim-sneetch-thumb.webp','phim_le',NULL,NULL,NULL,NULL,'cong_khai','binh_thuong','2025-11-06 07:26:54','2025-12-03 23:34:53'),(95,'Trò Chơi Nghìn Tỷ','tro-choi-nghin-ty-1762162312',NULL,NULL,NULL,'https://cdn.competinghypotheses.org/storage/images/tro-choi-nghin-ty-2025/tro-choi-nghin-ty-2025-thumb.webp','phim_le',NULL,NULL,NULL,NULL,'cong_khai','binh_thuong','2025-11-06 07:27:02','2025-12-03 23:35:10'),(98,'Phóng viên mới Troko: Nếu tôi không làm thì ai sẽ làm?','phong-vien-moi-troko-neu-toi-khong-lam-thi-ai-se-lam-1762099312',NULL,NULL,NULL,'https://cdn.competinghypotheses.org/storage/images/phong-vien-moi-troko-neu-toi-khong-lam-thi-ai-se-lam/phong-vien-moi-troko-neu-toi-khong-lam-thi-ai-se-lam-thumb.webp','phim_le',NULL,NULL,NULL,NULL,'cong_khai','binh_thuong','2025-11-06 07:27:13','2025-12-03 23:35:20'),(99,'Cầu vồng nhợt nhạt trong dòng suối róc rách','cau-vong-nhot-nhat-trong-dong-suoi-roc-rach-1762099286',NULL,NULL,NULL,'https://cdn.competinghypotheses.org/storage/images/cau-vong-nhot-nhat-trong-dong-suoi-roc-rach/cau-vong-nhot-nhat-trong-dong-suoi-roc-rach-thumb.webp','phim_le',NULL,NULL,NULL,NULL,'cong_khai','binh_thuong','2025-11-06 07:27:19','2025-12-03 23:35:28'),(100,'Anh Chai và anh Miêu','anh-chai-va-anh-mieu-1762099247',NULL,NULL,NULL,'https://cdn.competinghypotheses.org/storage/images/anh-chai-va-anh-mieu/anh-chai-va-anh-mieu-thumb.webp','phim_le',NULL,NULL,NULL,NULL,'cong_khai','binh_thuong','2025-11-06 07:27:27','2025-12-03 23:35:35'),(109,'Đảo Hải Tặc','one-piece-1704013630',NULL,NULL,NULL,'https://cdn.competinghypotheses.org/storage/images/one-piece/one-piece-thumb.webp','phim_le',NULL,NULL,NULL,NULL,'cong_khai','binh_thuong','2025-11-06 07:27:54','2025-12-03 23:35:46'),(111,'Thủy Long Ngâm','thuy-long-ngam-1760617955',NULL,NULL,NULL,'https://cdn.competinghypotheses.org/storage/images/thuy-long-ngam/thuy-long-ngam-thumb.webp','phim_le',NULL,NULL,NULL,NULL,'cong_khai','binh_thuong','2025-11-06 07:28:00','2025-12-03 23:36:11'),(122,'Làm Chồng Em Nhé','lam-chong-em-nhe-1760153436',NULL,NULL,NULL,'https://cdn.phimmoic.tv/storage/images/lam-chong-em-nhe/lam-chong-em-nhe-thumb.webp','phim_le',NULL,NULL,NULL,NULL,'cong_khai','binh_thuong','2025-11-08 02:30:33','2025-12-03 23:36:18'),(123,'Thân gửi X','than-gui-x-1761197451',NULL,NULL,NULL,'https://cdn.phimmoic.tv/storage/images/than-gui-x/than-gui-x-thumb.webp','phim_le',NULL,NULL,NULL,NULL,'cong_khai','binh_thuong','2025-11-08 02:31:03','2025-12-03 23:36:30'),(124,'Trò Chơi Thao Túng','tro-choi-thao-tung-1762347652',NULL,NULL,NULL,'https://cdn.phimmoic.tv/storage/images/tro-choi-thao-tung/tro-choi-thao-tung-thumb.webp','phim_le',NULL,NULL,NULL,NULL,'cong_khai','binh_thuong','2025-11-08 02:31:10','2025-12-03 23:36:38'),(125,'Thanh Gươm Diệt Quỷ: Vô Hạn Thành',NULL,'Tên khác: Demon Slayer -Kimetsu no Yaiba- the Movie: Infinity Castle,Gekijōban Kimetsu no Yaiba Mugenjō-hen,Gekijouban Kimetsu no Yaiba Mugenjou-hen,Kimetsu no Yaiba: Mugenjou-hen,Kimetsu no Yaiba Movie: Mugen Jou-hen,「鬼滅之刃」無限城編,Demon Slayer: Infinity Castle Movie 1 - Akaza\'s Revenge,Kimetsu no Yaiba: Mugenjou-hen Movie 1 - Akaza Sairai,Demon Slayer: Kimetsu no Yaiba Sonsuzluk Kalesi,Demon Slayer: Kimetsu no Yaiba Infinity Castle Chapter 1: The Return of Akaza,Demon Slayer: Kimetsu no Yaiba - The Movie: Infinity Castle - Part 1: Akaza Returns,劇場版 鬼滅之刃 無限城篇,Demon Slayer Infinity Castle,Demon Slayer: Kimetsu no Yaiba - Castillo infinito,Demon Slayer: Kimetsu no Yaiba Infinity Castle - Teil 1,Gekijouban Kimetsu no Yaiba: Mugen-jou-hen Movie 1,Demon Slayer: Kimetsu no Yaiba La Forteresse Infinie Film 1,Demon Slaye- Kimetsu no Yaiba- The Movie: Infinity Castle,Demon Slayer -Kimetsu no Yaiba- Il Castello dell\'Infinito,Demon Slayer: Kimetsu no Yaiba Castelo Infinito,Истребитель демонов: Бесконечная крепость,Guardianes de la noche: Kimetsu no Yaiba - La fortaleza infinita,劇場版「鬼滅之刃」無限城篇 第一章 猗窩座再襲,Вбивця Демонів: Замок Нескінченності,დემონების მკვეთი ხმალი: უსასრულო ციხესიმაგრე,극장판 귀멸의 칼날: 무한성편 제1장 아카자 재래,Demon Slayer: Kimetsu No Yaiba Infinity Castle,Demon Slayer: Kimetsu no Yaiba - The Movie: Infinity Castle,「鬼滅之刃」無限城篇,Demon Slayer: Mivtzar Ha\'Einsof,Demon Slayer - Kimetsu No Yaiba - The Movie: Infinity Castle,劇場版「鬼滅の刃」無限城編 第一章 猗窩座再来,Demon Slayer: Kimetsu no Yaiba Begalybės Pilis,Demon Slayer: Kimetsu No Yaiba - Bezgalības cietoksnis,Demon Slayer: Infinity Castle,Ubica demona: Dvorac beskraja,Demon Slayer: Kimetsu No Yaiba the Movie: Infinity,Demon Slayer: Kimetsu No Yaiba the Movie: Infinity Castle,Demon Slayer: Kimetsu No Yaiba - Infinity Castle,Demon Slayer: Castillo Infinito,Demon Slayer: Kimetsu no Yaiba - Infinity Castle,Demon Slayer: Kimetsu no Yaiba La Forteresse,Demon Slayer: Kimetsu no Yaiba- The Movie - Infinity Castle,Demon Slayer: Kimetsu No Yaiba - Castillo Infinito,Истребитель демонов: Kimetsu No Yaiba Бесконечная крепость,Demon Slayer: Kimetsu No Yaiba - The Movie: Infinity Castle\r\nAs the Demon Slayer Corps members and Hashira engaged in a group strength training program, the Hashira Training, in preparation for the forthcoming battle against the demons, Muzan Kibutsuji appears at the Ubuyashiki Mansion. With the head of the Demon Corps in danger, Tanjiro and the Hashira rush to the headquarters but are plunged into a deep descent to a mysterious space by the hands of Muzan Kibutsuji. The destination of where Tanjiro and Demon Slayer Corps have fallen is the demons\' stronghold – the Infinity Castle. And so, the battleground is set as the final battle between the Demon Slayer Corps and the demons ignites.',2025,NULL,'img/ds_phim/ds_phim_le/thanh_guom_diet_quy_vo_han_thanh/1764668741_thanh-guom-diet-quy-vo-han-thanh-thumb.webp','phim_le','https://youtu.be/x7uLutVRBfI','https://vip.opstream90.com/share/f18288b44fa19637ee5476ac4cdc77d8',NULL,155,'cong_khai','moi','2025-12-02 02:45:41','2025-12-02 02:45:41'),(126,'Tân Nương Thế Thân',NULL,'Tên khác: 娶而代之, Qu Er Dai Zhi\r\nĐêm tân hôn, nữ thừa kế giàu có Lương Nghị bị chồng phản bội, bị biến dạng và bị ném xuống sông. Được cứu sống và có một khuôn mặt mới, nàng giả danh kỹ nữ Từ Ân và thân thiết với thủ lĩnh băng đảng Lâm Vân, quyết tâm trả thù.',2025,NULL,'img/ds_phim/ds_phim_bo/tan_nuong_the_than/1764669636_marry-him-in-her-place-thumb.webp','phim_bo','https://youtu.be/x7uLutVRBfI',NULL,24,20,'cong_khai','noi_bat','2025-12-02 03:00:36','2025-12-02 03:00:36'),(127,'Cây Táo Nở Hoa',NULL,'Cây táo nở hoa bắt đầu khi người cha của 5 đứa con đã trưởng thành đột nhiên quay về và chết. Đám ma kì quặc hé lộ những mâu thuẫn, bất ổn, bi kịch của nhà họ Đỗ bao gồm 5 người con: Ngọc, Ngà, Châu, Báu, Dư. Ngọc - anh trai cả trong 1 gia đình nghèo bình dân, phải đối mặt với rất nhiều bi kịch. Ngọc sống với các em trai em gái, vợ và con gái trong một căn nhà chật hẹp kiêm xưởng sửa chữa xe máy nhỏ. Cuộc sống đã khó khăn nhưng mọi sự ngày càng trở nên khó chấp nhận khi những người em vô cùng lười biếng, vô trách nhiệm đã không giúp đỡ mà còn gây ra vô vàn rắc rối. Ngà mê cờ bạc, liên tục chạy trốn chủ nợ và liên tục gây tai họa cho gia đình.',2021,NULL,'img/ds_phim/ds_phim_bo/cay_tao_no_hoa/1764670377_cay-tao-no-hoa-thumb.webp','phim_bo','https://youtu.be/y_taUCoa9m4',NULL,10,45,'cong_khai','binh_thuong','2025-12-02 03:12:57','2025-12-02 03:12:57');
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
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phim_the_loai`
--

LOCK TABLES `phim_the_loai` WRITE;
/*!40000 ALTER TABLE `phim_the_loai` DISABLE KEYS */;
INSERT INTO `phim_the_loai` VALUES (15,11,6,NULL,NULL),(17,12,6,NULL,NULL),(34,18,3,NULL,NULL),(35,18,6,NULL,NULL),(40,20,6,NULL,NULL),(45,22,3,NULL,NULL),(46,22,5,NULL,NULL),(47,22,8,NULL,NULL),(48,22,9,NULL,NULL),(49,23,6,NULL,NULL),(50,24,5,NULL,NULL),(51,24,8,NULL,NULL),(52,24,9,NULL,NULL),(53,25,4,NULL,NULL),(54,26,4,NULL,NULL),(56,27,4,NULL,NULL),(57,28,6,NULL,NULL),(59,29,10,NULL,NULL),(60,30,10,NULL,NULL),(61,31,4,NULL,NULL),(62,31,7,NULL,NULL),(63,32,7,NULL,NULL),(64,22,4,NULL,NULL),(66,125,6,NULL,NULL),(69,126,4,NULL,NULL),(70,127,4,NULL,NULL),(71,32,4,NULL,NULL),(72,93,6,NULL,NULL),(73,95,3,NULL,NULL),(74,95,4,NULL,NULL),(75,98,7,NULL,NULL),(76,99,4,NULL,NULL),(77,100,4,NULL,NULL),(78,109,6,NULL,NULL),(79,111,4,NULL,NULL),(80,122,4,NULL,NULL),(81,123,3,NULL,NULL),(82,123,4,NULL,NULL),(83,124,3,NULL,NULL);
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
  `ten_phim` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tap` int DEFAULT NULL,
  `trang_thai` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `view_tap` bigint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tap_phim_phim_id_foreign` (`phim_id`),
  CONSTRAINT `tap_phim_phim_id_foreign` FOREIGN KEY (`phim_id`) REFERENCES `phim` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1080 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tap_phim`
--

LOCK TABLES `tap_phim` WRITE;
/*!40000 ALTER TABLE `tap_phim` DISABLE KEYS */;
INSERT INTO `tap_phim` VALUES (13,18,'CONAN','img/ds_phim/ds_phim_bo/conan/ds_tap_phim/1759333361_tham_tu_lung_danh_conan_nang_dau_halloween_teaser_trailer_30s_vietsub.mp4',1,'cong_khai',110,'2025-09-30 10:41:35','2025-12-03 22:47:03'),(14,18,'CONAN','img/ds_phim/ds_phim_bo/conan/ds_tap_phim/1759333380_tham_tu_lung_danh_conan_nang_dau_halloween_teaser_trailer_30s_vietsub.mp4',2,'cong_khai',250,'2025-09-30 10:41:35','2025-12-04 01:10:31'),(15,18,'CONAN',NULL,3,'nhap',0,'2025-09-30 10:41:35','2025-09-30 10:41:35'),(16,18,'CONAN',NULL,4,'nhap',0,'2025-09-30 10:41:35','2025-09-30 10:41:35'),(17,18,'CONAN',NULL,5,'nhap',0,'2025-09-30 10:41:35','2025-09-30 10:41:35'),(18,18,'CONAN',NULL,6,'nhap',0,'2025-09-30 10:41:35','2025-09-30 10:41:35'),(19,18,'CONAN',NULL,7,'nhap',0,'2025-09-30 10:41:35','2025-09-30 10:41:35'),(20,18,'CONAN',NULL,8,'nhap',0,'2025-09-30 10:41:35','2025-09-30 10:41:35'),(21,18,'CONAN',NULL,9,'nhap',0,'2025-09-30 10:41:35','2025-09-30 10:41:35'),(22,18,'CONAN',NULL,10,'nhap',0,'2025-09-30 10:41:35','2025-09-30 10:41:35'),(23,18,'CONAN',NULL,11,'nhap',0,'2025-09-30 10:41:35','2025-09-30 10:41:35'),(24,18,'CONAN',NULL,12,'nhap',0,'2025-09-30 10:41:35','2025-09-30 10:41:35'),(45,20,'DORAEMON','https://vip.opstream14.com/share/bcb05a6084cb31de74aeeb74e1ff1b92',1,'cong_khai',0,'2025-09-30 11:27:33','2025-12-04 21:50:29'),(46,20,'DORAEMON',NULL,2,'nhap',0,'2025-09-30 11:27:33','2025-09-30 11:27:33'),(47,20,'DORAEMON',NULL,3,'nhap',0,'2025-09-30 11:27:33','2025-09-30 11:27:33'),(48,20,'DORAEMON',NULL,4,'nhap',0,'2025-09-30 11:27:33','2025-09-30 11:27:33'),(49,20,'DORAEMON',NULL,5,'nhap',0,'2025-09-30 11:27:33','2025-09-30 11:27:33'),(50,20,'DORAEMON',NULL,6,'nhap',0,'2025-09-30 11:27:33','2025-09-30 11:27:33'),(51,20,'DORAEMON',NULL,7,'nhap',0,'2025-09-30 11:27:33','2025-09-30 11:27:33'),(52,20,'DORAEMON',NULL,8,'nhap',0,'2025-09-30 11:27:33','2025-09-30 11:27:33'),(53,20,'DORAEMON',NULL,9,'nhap',0,'2025-09-30 11:27:33','2025-09-30 11:27:33'),(54,20,'DORAEMON',NULL,10,'nhap',0,'2025-09-30 11:27:33','2025-09-30 11:27:33'),(67,22,'Thư Sinh Mèo Báo (Phần 2)','https://vip.opstream90.com/share/e38c9a9b9ca7607ce912ab7fe7106f3d',1,'nhap',1500,'2025-10-17 05:15:59','2025-12-03 23:26:37'),(68,22,'Thư Sinh Mèo Báo (Phần 2)','https://vip.opstream90.com/share/5b3b3e573becfa5d7fac4916f8bc0fed',2,'nhap',1486,'2025-10-17 05:15:59','2025-12-03 23:26:46'),(69,22,'Thư Sinh Mèo Báo (Phần 2)','https://vip.opstream90.com/share/956936879f66f5cf4ffbf3aefffd56ca',3,'nhap',5600,'2025-10-17 05:15:59','2025-12-03 23:30:23'),(70,22,'Thư Sinh Mèo Báo (Phần 2)',NULL,4,'nhap',0,'2025-10-17 05:15:59','2025-10-17 05:15:59'),(71,22,'Thư Sinh Mèo Báo (Phần 2)',NULL,5,'nhap',0,'2025-10-17 05:15:59','2025-10-17 05:15:59'),(72,22,'Thư Sinh Mèo Báo (Phần 2)',NULL,6,'nhap',0,'2025-10-17 05:15:59','2025-10-17 05:15:59'),(73,22,'Thư Sinh Mèo Báo (Phần 2)',NULL,7,'nhap',0,'2025-10-17 05:15:59','2025-10-17 05:15:59'),(74,22,'Thư Sinh Mèo Báo (Phần 2)',NULL,8,'nhap',0,'2025-10-17 05:15:59','2025-10-17 05:15:59'),(75,22,'Thư Sinh Mèo Báo (Phần 2)',NULL,9,'nhap',0,'2025-10-17 05:15:59','2025-10-17 05:15:59'),(76,22,'Thư Sinh Mèo Báo (Phần 2)',NULL,10,'nhap',0,'2025-10-17 05:15:59','2025-10-17 05:15:59'),(77,22,'Thư Sinh Mèo Báo (Phần 2)',NULL,11,'nhap',0,'2025-10-17 05:15:59','2025-10-17 05:15:59'),(78,22,'Thư Sinh Mèo Báo (Phần 2)',NULL,12,'nhap',0,'2025-10-17 05:15:59','2025-10-17 05:15:59'),(79,22,'Thư Sinh Mèo Báo (Phần 2)',NULL,13,'nhap',0,'2025-10-17 05:15:59','2025-10-17 05:15:59'),(80,22,'Thư Sinh Mèo Báo (Phần 2)',NULL,14,'nhap',0,'2025-10-17 05:15:59','2025-10-17 05:15:59'),(81,22,'Thư Sinh Mèo Báo (Phần 2)',NULL,15,'nhap',0,'2025-10-17 05:15:59','2025-10-17 05:15:59'),(82,22,'Thư Sinh Mèo Báo (Phần 2)',NULL,16,'nhap',0,'2025-10-17 05:15:59','2025-10-17 05:15:59'),(83,22,'Thư Sinh Mèo Báo (Phần 2)',NULL,17,'nhap',0,'2025-10-17 05:15:59','2025-10-17 05:15:59'),(84,22,'Thư Sinh Mèo Báo (Phần 2)',NULL,18,'nhap',0,'2025-10-17 05:15:59','2025-10-17 05:15:59'),(85,22,'Thư Sinh Mèo Báo (Phần 2)',NULL,19,'nhap',0,'2025-10-17 05:15:59','2025-10-17 05:15:59'),(86,22,'Thư Sinh Mèo Báo (Phần 2)',NULL,20,'nhap',0,'2025-10-17 05:15:59','2025-10-17 05:15:59'),(87,25,'Khi Ánh Sao Rơi Xuống Biển Hoa','https://vip.opstream90.com/share/729db3e07a09db3a41dc1734e04ce44e',1,'nhap',10000,'2025-10-17 09:22:15','2025-12-03 23:28:01'),(88,25,'Khi Ánh Sao Rơi Xuống Biển Hoa','https://vip.opstream90.com/share/1ef4c899cd6f0d5cae3a2ea3a91adc1c',2,'nhap',9860,'2025-10-17 09:22:15','2025-12-03 23:28:07'),(89,25,'Khi Ánh Sao Rơi Xuống Biển Hoa',NULL,3,'nhap',0,'2025-10-17 09:22:15','2025-10-17 09:22:15'),(90,25,'Khi Ánh Sao Rơi Xuống Biển Hoa',NULL,4,'nhap',0,'2025-10-17 09:22:15','2025-10-17 09:22:15'),(91,25,'Khi Ánh Sao Rơi Xuống Biển Hoa',NULL,5,'nhap',0,'2025-10-17 09:22:15','2025-10-17 09:22:15'),(92,25,'Khi Ánh Sao Rơi Xuống Biển Hoa',NULL,6,'nhap',0,'2025-10-17 09:22:15','2025-10-17 09:22:15'),(93,25,'Khi Ánh Sao Rơi Xuống Biển Hoa',NULL,7,'nhap',0,'2025-10-17 09:22:15','2025-10-17 09:22:15'),(94,25,'Khi Ánh Sao Rơi Xuống Biển Hoa',NULL,8,'nhap',0,'2025-10-17 09:22:15','2025-10-17 09:22:15'),(95,25,'Khi Ánh Sao Rơi Xuống Biển Hoa',NULL,9,'nhap',0,'2025-10-17 09:22:15','2025-10-17 09:22:15'),(96,25,'Khi Ánh Sao Rơi Xuống Biển Hoa',NULL,10,'nhap',0,'2025-10-17 09:22:15','2025-10-17 09:22:15'),(97,25,'Khi Ánh Sao Rơi Xuống Biển Hoa',NULL,11,'nhap',0,'2025-10-17 09:22:15','2025-10-17 09:22:15'),(98,25,'Khi Ánh Sao Rơi Xuống Biển Hoa',NULL,12,'nhap',0,'2025-10-17 09:22:15','2025-10-17 09:22:15'),(99,25,'Khi Ánh Sao Rơi Xuống Biển Hoa',NULL,13,'nhap',0,'2025-10-17 09:22:15','2025-10-17 09:22:15'),(100,25,'Khi Ánh Sao Rơi Xuống Biển Hoa',NULL,14,'nhap',0,'2025-10-17 09:22:15','2025-10-17 09:22:15'),(101,27,'Trăm Mảnh Ký Ức','https://vip.opstream90.com/share/f668bd04d1a6cfc29378e24829cddba9',1,'cong_khai',1100,'2025-10-19 18:05:17','2025-12-03 23:28:30'),(102,27,'Trăm Mảnh Ký Ức','https://vip.opstream90.com/share/a8ae104615cb4e966ddb435f3e575a02',2,'nhap',1680,'2025-10-19 18:05:17','2025-12-03 23:28:37'),(103,27,'Trăm Mảnh Ký Ức',NULL,3,'nhap',0,'2025-10-19 18:05:17','2025-10-19 18:05:17'),(104,27,'Trăm Mảnh Ký Ức',NULL,4,'nhap',0,'2025-10-19 18:05:17','2025-10-19 18:05:17'),(105,27,'Trăm Mảnh Ký Ức',NULL,5,'nhap',0,'2025-10-19 18:05:17','2025-10-19 18:05:17'),(106,27,'Trăm Mảnh Ký Ức',NULL,6,'nhap',0,'2025-10-19 18:05:17','2025-10-19 18:05:17'),(107,27,'Trăm Mảnh Ký Ức',NULL,7,'nhap',0,'2025-10-19 18:05:17','2025-10-19 18:05:17'),(108,27,'Trăm Mảnh Ký Ức',NULL,8,'nhap',0,'2025-10-19 18:05:17','2025-10-19 18:05:17'),(109,27,'Trăm Mảnh Ký Ức',NULL,9,'nhap',0,'2025-10-19 18:05:17','2025-10-19 18:05:17'),(110,27,'Trăm Mảnh Ký Ức',NULL,10,'nhap',0,'2025-10-19 18:05:17','2025-10-19 18:05:17'),(111,27,'Trăm Mảnh Ký Ức',NULL,11,'nhap',0,'2025-10-19 18:05:17','2025-10-19 18:05:17'),(112,27,'Trăm Mảnh Ký Ức',NULL,12,'nhap',0,'2025-10-19 18:05:17','2025-10-19 18:05:17'),(113,32,'Cuộc Chiến Hạ Lưu','https://vip.opstream17.com/share/c1a79e7f0d5d27de57b7ff4c3ccaf1b5',1,'cong_khai',0,'2025-10-31 20:50:49','2025-10-31 20:52:19'),(114,32,'Cuộc Chiến Hạ Lưu','https://vip.opstream17.com/share/022e5a923458991fab6f695c0c4def33',2,'cong_khai',0,'2025-10-31 20:50:49','2025-10-31 20:52:25'),(115,32,'Cuộc Chiến Hạ Lưu',NULL,3,'nhap',0,'2025-10-31 20:50:49','2025-10-31 20:50:49'),(116,32,'Cuộc Chiến Hạ Lưu',NULL,4,'nhap',0,'2025-10-31 20:50:49','2025-10-31 20:50:49'),(117,32,'Cuộc Chiến Hạ Lưu',NULL,5,'nhap',0,'2025-10-31 20:50:49','2025-10-31 20:50:49'),(118,32,'Cuộc Chiến Hạ Lưu',NULL,6,'nhap',0,'2025-10-31 20:50:49','2025-10-31 20:50:49'),(119,32,'Cuộc Chiến Hạ Lưu',NULL,7,'nhap',0,'2025-10-31 20:50:49','2025-10-31 20:50:49'),(120,32,'Cuộc Chiến Hạ Lưu',NULL,8,'nhap',0,'2025-10-31 20:50:49','2025-10-31 20:50:49'),(121,32,'Cuộc Chiến Hạ Lưu',NULL,9,'nhap',0,'2025-10-31 20:50:49','2025-10-31 20:50:49'),(122,32,'Cuộc Chiến Hạ Lưu',NULL,10,'nhap',0,'2025-10-31 20:50:49','2025-10-31 20:50:49'),(123,32,'Cuộc Chiến Hạ Lưu',NULL,11,'nhap',0,'2025-10-31 20:50:49','2025-10-31 20:50:49'),(124,32,'Cuộc Chiến Hạ Lưu',NULL,12,'nhap',0,'2025-10-31 20:50:49','2025-10-31 20:50:49'),(786,126,'Tân Nương Thế Thân','https://vip.opstream90.com/share/8de87e06e082806f690692c0ca47d3cc',1,'cong_khai',3668,'2025-12-02 03:00:36','2025-12-03 23:29:22'),(787,126,'Tân Nương Thế Thân','https://vip.opstream90.com/share/c9c0d8a434fdbcee4cd69ea2ce1fe371',2,'cong_khai',7620,'2025-12-02 03:00:36','2025-12-03 23:29:28'),(788,126,'Tân Nương Thế Thân',NULL,3,'nhap',0,'2025-12-02 03:00:36','2025-12-02 03:00:36'),(789,126,'Tân Nương Thế Thân',NULL,4,'nhap',0,'2025-12-02 03:00:36','2025-12-02 03:00:36'),(790,126,'Tân Nương Thế Thân',NULL,5,'nhap',0,'2025-12-02 03:00:36','2025-12-02 03:00:36'),(791,126,'Tân Nương Thế Thân',NULL,6,'nhap',0,'2025-12-02 03:00:36','2025-12-02 03:00:36'),(792,126,'Tân Nương Thế Thân',NULL,7,'nhap',0,'2025-12-02 03:00:36','2025-12-02 03:00:36'),(793,126,'Tân Nương Thế Thân',NULL,8,'nhap',0,'2025-12-02 03:00:36','2025-12-02 03:00:36'),(794,126,'Tân Nương Thế Thân',NULL,9,'nhap',0,'2025-12-02 03:00:36','2025-12-02 03:00:36'),(795,126,'Tân Nương Thế Thân',NULL,10,'nhap',0,'2025-12-02 03:00:36','2025-12-02 03:00:36'),(796,126,'Tân Nương Thế Thân',NULL,11,'nhap',0,'2025-12-02 03:00:36','2025-12-02 03:00:36'),(797,126,'Tân Nương Thế Thân',NULL,12,'nhap',0,'2025-12-02 03:00:36','2025-12-02 03:00:36'),(798,126,'Tân Nương Thế Thân',NULL,13,'nhap',0,'2025-12-02 03:00:36','2025-12-02 03:00:36'),(799,126,'Tân Nương Thế Thân',NULL,14,'nhap',0,'2025-12-02 03:00:36','2025-12-02 03:00:36'),(800,126,'Tân Nương Thế Thân',NULL,15,'nhap',0,'2025-12-02 03:00:36','2025-12-02 03:00:36'),(801,126,'Tân Nương Thế Thân',NULL,16,'nhap',0,'2025-12-02 03:00:36','2025-12-02 03:00:36'),(802,126,'Tân Nương Thế Thân',NULL,17,'nhap',0,'2025-12-02 03:00:36','2025-12-02 03:00:36'),(803,126,'Tân Nương Thế Thân',NULL,18,'nhap',0,'2025-12-02 03:00:36','2025-12-02 03:00:36'),(804,126,'Tân Nương Thế Thân',NULL,19,'nhap',0,'2025-12-02 03:00:36','2025-12-02 03:00:36'),(805,126,'Tân Nương Thế Thân',NULL,20,'nhap',0,'2025-12-02 03:00:36','2025-12-02 03:00:36'),(806,126,'Tân Nương Thế Thân',NULL,21,'nhap',0,'2025-12-02 03:00:36','2025-12-02 03:00:36'),(807,126,'Tân Nương Thế Thân',NULL,22,'nhap',0,'2025-12-02 03:00:36','2025-12-02 03:00:36'),(808,126,'Tân Nương Thế Thân',NULL,23,'nhap',0,'2025-12-02 03:00:36','2025-12-02 03:00:36'),(809,126,'Tân Nương Thế Thân',NULL,24,'nhap',0,'2025-12-02 03:00:36','2025-12-02 03:00:36'),(810,127,'Cây Táo Nở Hoa','https://vip.opstream17.com/share/3883cd645fd2fd862058839841a60f97',1,'cong_khai',3665,'2025-12-02 03:12:57','2025-12-03 23:32:06'),(811,127,'Cây Táo Nở Hoa',NULL,2,'nhap',0,'2025-12-02 03:12:57','2025-12-02 03:12:57'),(812,127,'Cây Táo Nở Hoa',NULL,3,'nhap',0,'2025-12-02 03:12:57','2025-12-02 03:12:57'),(813,127,'Cây Táo Nở Hoa',NULL,4,'nhap',0,'2025-12-02 03:12:57','2025-12-02 03:12:57'),(814,127,'Cây Táo Nở Hoa',NULL,5,'nhap',0,'2025-12-02 03:12:57','2025-12-02 03:12:57'),(815,127,'Cây Táo Nở Hoa',NULL,6,'nhap',0,'2025-12-02 03:12:57','2025-12-02 03:12:57'),(816,127,'Cây Táo Nở Hoa',NULL,7,'nhap',0,'2025-12-02 03:12:57','2025-12-02 03:12:57'),(817,127,'Cây Táo Nở Hoa',NULL,8,'nhap',0,'2025-12-02 03:12:57','2025-12-02 03:12:57'),(818,127,'Cây Táo Nở Hoa',NULL,9,'nhap',0,'2025-12-02 03:12:57','2025-12-02 03:12:57'),(819,127,'Cây Táo Nở Hoa',NULL,10,'nhap',0,'2025-12-02 03:12:57','2025-12-02 03:12:57');
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `the_loai`
--

LOCK TABLES `the_loai` WRITE;
/*!40000 ALTER TABLE `the_loai` DISABLE KEYS */;
INSERT INTO `the_loai` VALUES (3,'hành động','2025-09-24 03:19:30','2025-09-25 08:08:18'),(4,'tình cảm','2025-09-25 08:07:35','2025-09-25 08:08:23'),(5,'phiêu lưu','2025-09-25 08:08:31','2025-09-25 08:08:31'),(6,'hoạt hình','2025-09-25 09:12:18','2025-09-25 09:12:18'),(7,'điện ảnh','2025-09-25 09:12:22','2025-09-25 09:12:22'),(8,'viễn tưởng','2025-10-17 05:06:20','2025-10-17 05:06:20'),(9,'khoa học','2025-10-17 05:06:28','2025-10-17 05:06:28'),(10,'kinh dị','2025-10-31 20:31:28','2025-10-31 20:31:28');
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
  `status` tinyint DEFAULT '1' COMMENT '1 = Hoạt động, 0 = Đã khóa',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_uid_unique` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'31333635','ss','ss@gmail.com',NULL,'$2y$12$Dbpx0lbcWLKH9f4dN3R5SuXIAR3y2vArRsxedhvv3ORzqg/kUe8BO',1,NULL,NULL,NULL,'2025-09-22 01:40:06','2025-10-02 03:01:47'),(3,'13713027','loccanhong','loccanhong@gmail.com',NULL,'$2y$12$XGyUgSywN8SKG.FAVZZROeE/0zl4NCyBmOUQzvugjQMuiXaPe8/dK',0,NULL,NULL,NULL,'2025-10-02 04:48:39','2025-10-15 01:35:51'),(5,'28696553','Huy Le Hoang','lhhuyktpm2211032@student.ctuet.edu.vn',NULL,'$2y$12$2GgX0MMjF/5SUvLGKxy8z.0eMVqRf1tbEf86qc4OqxzqWesfsljUK',1,NULL,'106497050214402791451',NULL,'2025-10-02 04:56:21','2025-10-02 04:56:21'),(7,'96035889','ssz','ssz@gmail.com',NULL,'$2y$12$4lVxzO1sGdLjrNmSOt2R2.QnxqaivfczZT/4JDQCyBDvtiAKf53fm',1,NULL,NULL,NULL,'2025-10-02 05:07:46','2025-10-02 05:07:46'),(8,'91785150','Hoàng Huy','lhoanghuy100404@gmail.com',NULL,'$2y$12$1i2x03JsVFoq23plTmWIgeKGGaDDeAvgnJSSA5RyM9/FCwAdZ3EBa',1,NULL,'116177700193434702167',NULL,'2025-10-02 05:26:16','2025-10-02 05:26:16'),(9,'61047249','hoanghuy','hoanghuy@gmail.com',NULL,'$2y$12$drXL4D3BcjFf/jZMQ6hG1OIU5MhbvfEapU9jVZlGUAktBZ5n.lkou',1,NULL,NULL,NULL,'2025-12-13 07:26:23','2025-12-13 07:26:23');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `views`
--

DROP TABLE IF EXISTS `views`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `views` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `phim_id` bigint unsigned DEFAULT NULL,
  `tong_views` bigint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `views`
--

LOCK TABLES `views` WRITE;
/*!40000 ALTER TABLE `views` DISABLE KEYS */;
INSERT INTO `views` VALUES (1,11,0,'2025-12-02 02:39:18','2025-12-02 02:39:18'),(2,12,3655,'2025-12-02 02:39:18','2025-12-04 01:09:51'),(3,18,360,'2025-12-02 02:39:18','2025-12-04 01:10:31'),(4,20,1,'2025-12-02 02:39:18','2025-12-04 21:50:38'),(5,22,8590,'2025-12-02 02:39:18','2026-07-19 19:57:52'),(6,23,0,'2025-12-02 02:39:18','2025-12-02 02:39:18'),(7,24,0,'2025-12-02 02:39:18','2025-12-02 02:39:18'),(8,25,19868,'2025-12-02 02:39:18','2026-08-16 05:17:04'),(9,26,7779,'2025-12-02 02:39:18','2025-12-13 07:21:28'),(10,27,2780,'2025-12-02 02:39:18','2025-12-03 23:28:37'),(11,28,5558,'2025-12-02 02:39:18','2025-12-08 00:16:27'),(12,29,1113,'2025-12-02 02:39:18','2025-12-12 04:42:57'),(13,30,0,'2025-12-02 02:39:18','2025-12-02 02:39:18'),(14,31,4672,'2025-12-02 02:39:18','2025-12-13 07:22:40'),(15,32,0,'2025-12-02 02:39:18','2025-12-02 02:39:18'),(16,93,0,'2025-12-02 02:39:18','2025-12-02 02:39:18'),(17,95,0,'2025-12-02 02:39:18','2025-12-02 02:39:18'),(18,98,0,'2025-12-02 02:39:18','2025-12-02 02:39:18'),(19,99,1,'2025-12-02 02:39:18','2025-12-04 22:05:58'),(20,100,0,'2025-12-02 02:39:18','2025-12-02 02:39:18'),(21,109,1,'2025-12-02 02:39:18','2025-12-04 22:07:09'),(22,111,2,'2025-12-02 02:39:18','2025-12-04 22:06:39'),(23,122,0,'2025-12-02 02:39:18','2025-12-02 02:39:18'),(24,123,0,'2025-12-02 02:39:18','2025-12-02 02:39:18'),(25,124,0,'2025-12-02 02:39:18','2025-12-02 02:39:18'),(26,125,11,'2025-12-02 09:55:37','2025-12-12 04:42:53'),(27,126,11290,'2025-12-02 03:00:36','2025-12-04 21:50:46'),(28,127,3666,'2025-12-02 03:12:57','2026-07-19 04:15:38'),(29,128,2,'2025-12-04 21:38:04','2025-12-04 21:38:49'),(30,129,14,'2025-12-04 21:39:54','2025-12-04 21:50:52'),(31,130,5,'2025-12-04 21:52:02','2025-12-04 22:03:31'),(32,131,6,'2025-12-04 21:53:21','2025-12-04 22:04:12'),(33,132,10,'2025-12-04 23:07:11','2025-12-04 23:11:07'),(34,133,0,'2026-07-19 04:09:35','2026-07-19 04:09:35'),(35,134,0,'2026-07-19 04:09:35','2026-07-19 04:09:35'),(36,135,0,'2026-07-19 04:09:36','2026-07-19 04:09:36'),(37,136,0,'2026-07-19 04:09:36','2026-07-19 04:09:36'),(38,137,0,'2026-07-19 04:09:37','2026-07-19 04:09:37'),(39,138,0,'2026-07-19 04:09:37','2026-07-19 04:09:37'),(40,139,0,'2026-07-19 04:09:38','2026-07-19 04:09:38'),(41,140,0,'2026-07-19 04:09:39','2026-07-19 04:09:39'),(42,141,0,'2026-07-19 04:09:39','2026-07-19 04:09:39'),(43,142,0,'2026-07-19 04:09:39','2026-07-19 04:09:39'),(44,143,0,'2026-07-19 04:09:40','2026-07-19 04:09:40'),(45,144,0,'2026-07-19 04:09:40','2026-07-19 04:09:40'),(46,145,0,'2026-07-19 04:09:41','2026-07-19 04:09:41'),(47,146,0,'2026-07-19 04:09:41','2026-07-19 04:09:41'),(48,147,0,'2026-07-19 04:09:42','2026-07-19 04:09:42'),(49,148,0,'2026-07-19 04:09:42','2026-07-19 04:09:42'),(50,149,0,'2026-07-19 04:09:43','2026-07-19 04:09:43'),(51,150,0,'2026-07-19 04:09:43','2026-07-19 04:09:43'),(52,151,0,'2026-07-19 04:09:44','2026-07-19 04:09:44'),(53,152,0,'2026-07-19 04:09:44','2026-07-19 04:09:44'),(54,153,0,'2026-07-19 04:09:44','2026-07-19 04:09:44'),(55,154,0,'2026-07-19 04:09:45','2026-07-19 04:09:45'),(56,155,0,'2026-07-19 04:09:45','2026-07-19 04:09:45'),(57,156,0,'2026-07-19 04:09:46','2026-07-19 04:09:46');
/*!40000 ALTER TABLE `views` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-08-16 19:37:08
