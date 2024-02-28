-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: operator_bills
-- ------------------------------------------------------
-- Server version	8.0.36-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `auth_groups_users`
--

DROP TABLE IF EXISTS `auth_groups_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auth_groups_users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `group` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `auth_groups_users_user_id_foreign` (`user_id`),
  CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_groups_users`
--

LOCK TABLES `auth_groups_users` WRITE;
/*!40000 ALTER TABLE `auth_groups_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_groups_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_identities`
--

DROP TABLE IF EXISTS `auth_identities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auth_identities` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `secret` varchar(255) NOT NULL,
  `secret2` varchar(255) DEFAULT NULL,
  `expires` datetime DEFAULT NULL,
  `extra` text,
  `force_reset` tinyint(1) NOT NULL DEFAULT '0',
  `last_used_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `type_secret` (`type`,`secret`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `auth_identities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_identities`
--

LOCK TABLES `auth_identities` WRITE;
/*!40000 ALTER TABLE `auth_identities` DISABLE KEYS */;
INSERT INTO `auth_identities` (`id`, `user_id`, `type`, `name`, `secret`, `secret2`, `expires`, `extra`, `force_reset`, `last_used_at`, `created_at`, `updated_at`) VALUES (1,1,'email_password',NULL,'superadmin@admin.com','$2y$12$pOLeliZbrOZ8z5yHDeQ7f.W6wRXDlod4lz5pn.2e6dIl1gra3Dypy',NULL,NULL,0,'2024-02-28 13:20:13','2024-02-28 13:18:20','2024-02-28 13:20:13'),(2,2,'email_password',NULL,'admin@admin.com','$2y$12$3c5rc/Gw32bCDMa/vZmA3.Pe1j1GPUOvOqt.VK32MP1yj83Lt3Rkm',NULL,NULL,0,'2024-02-28 13:35:24','2024-02-28 13:21:06','2024-02-28 13:35:24'),(3,3,'email_password',NULL,'maruf.billah@ranksitt.com','$2y$12$vhWwkaR.BcC/rO4dqUoA7ery.zv9fKVItYDipKtAV7zDIl8p8Vj.W',NULL,NULL,0,'2024-02-28 07:40:05','2024-02-28 13:30:16','2024-02-28 07:40:05');
/*!40000 ALTER TABLE `auth_identities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_logins`
--

DROP TABLE IF EXISTS `auth_logins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auth_logins` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `id_type` varchar(255) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_type_identifier` (`id_type`,`identifier`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_logins`
--

LOCK TABLES `auth_logins` WRITE;
/*!40000 ALTER TABLE `auth_logins` DISABLE KEYS */;
INSERT INTO `auth_logins` (`id`, `ip_address`, `user_agent`, `id_type`, `identifier`, `user_id`, `date`, `success`) VALUES (1,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36 Edg/122.0.0.0','email_password','superadmin@admin.com',1,'2024-02-28 13:20:13',1),(2,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36 Edg/122.0.0.0','email_password','admin@admin.com',2,'2024-02-28 13:35:24',1),(3,'202.40.190.154','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36 Edg/122.0.0.0','email_password','maruf.billah@ranksitt.com',3,'2024-02-28 07:37:11',1),(4,'202.40.190.154','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36','email_password','maruf.billah@ranksitt.com',3,'2024-02-28 07:40:05',1);
/*!40000 ALTER TABLE `auth_logins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_permissions_users`
--

DROP TABLE IF EXISTS `auth_permissions_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auth_permissions_users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `permission` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `auth_permissions_users_user_id_foreign` (`user_id`),
  CONSTRAINT `auth_permissions_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_permissions_users`
--

LOCK TABLES `auth_permissions_users` WRITE;
/*!40000 ALTER TABLE `auth_permissions_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_permissions_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_remember_tokens`
--

DROP TABLE IF EXISTS `auth_remember_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auth_remember_tokens` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int unsigned NOT NULL,
  `expires` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `selector` (`selector`),
  KEY `auth_remember_tokens_user_id_foreign` (`user_id`),
  CONSTRAINT `auth_remember_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_remember_tokens`
--

LOCK TABLES `auth_remember_tokens` WRITE;
/*!40000 ALTER TABLE `auth_remember_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_remember_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_token_logins`
--

DROP TABLE IF EXISTS `auth_token_logins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auth_token_logins` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `id_type` varchar(255) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_type_identifier` (`id_type`,`identifier`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_token_logins`
--

LOCK TABLES `auth_token_logins` WRITE;
/*!40000 ALTER TABLE `auth_token_logins` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_token_logins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int NOT NULL,
  `batch` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES (1,'2020-12-28-223112','App\\Modules\\Shield\\Database\\Migrations\\CreateAuthTables','default','App\\Modules\\Shield',1709104476,1),(2,'2021-07-04-041948','CodeIgniter\\Settings\\Database\\Migrations\\CreateSettingsTable','default','CodeIgniter\\Settings',1709104476,1),(3,'2021-11-14-143905','CodeIgniter\\Settings\\Database\\Migrations\\AddContextColumn','default','CodeIgniter\\Settings',1709104476,1),(4,'2024-01-17-061701','App\\Modules\\OperatorBill\\Database\\Migrations\\CreteOperatorTable','default','App\\Modules\\OperatorBill',1709104476,1),(5,'2024-01-17-061725','App\\Modules\\OperatorBill\\Database\\Migrations\\CreteOperatorBillsTable','default','App\\Modules\\OperatorBill',1709104476,1),(6,'2024-01-17-062534','App\\Modules\\OperatorBill\\Database\\Migrations\\CreteOperatorBillFilesTable','default','App\\Modules\\OperatorBill',1709104476,1),(7,'2024-02-06-085821','App\\Modules\\OperatorBill\\Database\\Migrations\\CreateOperatorBillsHistory','default','App\\Modules\\OperatorBill',1709104477,1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `operator_bill_files`
--

DROP TABLE IF EXISTS `operator_bill_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `operator_bill_files` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `operator_bill_id` bigint unsigned NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` text NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operator_bill_files`
--

LOCK TABLES `operator_bill_files` WRITE;
/*!40000 ALTER TABLE `operator_bill_files` DISABLE KEYS */;
INSERT INTO `operator_bill_files` (`id`, `operator_bill_id`, `file_name`, `file_path`, `created_at`, `updated_at`, `deleted_at`) VALUES (1,3,'GP-2194.pdf','uploads/operator_bills//1706589836_1374ab27a4c875617656.pdf','2024-01-30 10:43:56','2024-01-30 10:43:56',NULL),(3,5,'Notesheet_ Infobip_iatl_May_2022.pdf','uploads\\operator_bills\\/1709027157_64ec883f39ef800d934a.pdf','2024-02-27 15:45:57','2024-02-27 15:45:57',NULL);
/*!40000 ALTER TABLE `operator_bill_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `operator_bill_histories`
--

DROP TABLE IF EXISTS `operator_bill_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `operator_bill_histories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `previous_id` bigint unsigned DEFAULT NULL,
  `action` enum('create','update','delete') DEFAULT NULL,
  `added_by` bigint unsigned DEFAULT NULL,
  `added_at` datetime DEFAULT NULL,
  `sbu` enum('ritt','ritigw','softex','qtech') NOT NULL,
  `year` year NOT NULL,
  `month` int NOT NULL,
  `operator_id` bigint unsigned NOT NULL,
  `successful_calls` bigint DEFAULT NULL,
  `effective_duration` double DEFAULT NULL,
  `voice_amount` double DEFAULT NULL,
  `voice_amount_with_vat` double DEFAULT NULL,
  `sms_count` bigint DEFAULT NULL,
  `sms_amount` double DEFAULT NULL,
  `sms_amount_with_vat` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operator_bill_histories`
--

LOCK TABLES `operator_bill_histories` WRITE;
/*!40000 ALTER TABLE `operator_bill_histories` DISABLE KEYS */;
INSERT INTO `operator_bill_histories` (`id`, `previous_id`, `action`, `added_by`, `added_at`, `sbu`, `year`, `month`, `operator_id`, `successful_calls`, `effective_duration`, `voice_amount`, `voice_amount_with_vat`, `sms_count`, `sms_amount`, `sms_amount_with_vat`) VALUES (1,NULL,'create',2,'2024-02-27 15:45:57','ritt',2024,1,13,NULL,NULL,NULL,NULL,48788,21755,21755);
/*!40000 ALTER TABLE `operator_bill_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `operator_bills`
--

DROP TABLE IF EXISTS `operator_bills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `operator_bills` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sbu` enum('ritt','ritigw','softex','qtech') NOT NULL,
  `year` year NOT NULL,
  `month` int NOT NULL,
  `operator_id` bigint unsigned NOT NULL,
  `successful_calls` bigint DEFAULT NULL,
  `effective_duration` double DEFAULT NULL,
  `voice_amount` double DEFAULT NULL,
  `voice_amount_with_vat` double DEFAULT NULL,
  `sms_count` bigint DEFAULT NULL,
  `sms_amount` double DEFAULT NULL,
  `sms_amount_with_vat` double DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operator_bills`
--

LOCK TABLES `operator_bills` WRITE;
/*!40000 ALTER TABLE `operator_bills` DISABLE KEYS */;
INSERT INTO `operator_bills` (`id`, `sbu`, `year`, `month`, `operator_id`, `successful_calls`, `effective_duration`, `voice_amount`, `voice_amount_with_vat`, `sms_count`, `sms_amount`, `sms_amount_with_vat`, `created_at`, `updated_at`, `deleted_at`) VALUES (1,'ritt',2023,12,5,NULL,9.5,122.74,141.15,NULL,NULL,NULL,'2024-01-29 19:19:03','2024-01-29 19:19:03',NULL),(2,'ritt',2023,12,6,539263,734210,29368.42,33774,NULL,NULL,NULL,'2024-01-29 19:21:15','2024-01-29 19:21:15',NULL),(3,'ritt',2023,12,1,NULL,504563,50456,58025,23853834,1073423,161013,'2024-01-30 10:43:56','2024-01-30 10:43:56',NULL),(5,'ritt',2024,1,13,NULL,NULL,NULL,NULL,48788,21755,21755,'2024-02-27 15:45:57','2024-02-27 15:45:57',NULL);
/*!40000 ALTER TABLE `operator_bills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `operators`
--

DROP TABLE IF EXISTS `operators`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `operators` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `address` text,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `type` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operators`
--

LOCK TABLES `operators` WRITE;
/*!40000 ALTER TABLE `operators` DISABLE KEYS */;
INSERT INTO `operators` (`id`, `name`, `address`, `phone`, `email`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES (1,'Grameenphone','Dhaka','01700000000',NULL,'mobile','2024-02-28 13:16:03','2024-02-28 13:16:03',NULL),(2,'Banglalink','Dhaka','01900000000',NULL,'mobile','2024-02-28 13:16:03','2024-02-28 13:16:03',NULL),(3,'Robi','Dhaka',NULL,NULL,'mobile','2024-02-28 13:16:03','2024-02-28 13:16:03',NULL),(4,'Teletalk','Dhaka','01500000000',NULL,'mobile','2024-02-28 13:16:03','2024-02-28 13:16:03',NULL),(5,'NovoTel','Dhaka',NULL,NULL,'ios','2024-02-28 13:16:03','2024-02-28 13:16:03',NULL),(6,'Softex Communication','Dhaka',NULL,NULL,'icx','2024-02-28 13:16:03','2024-02-28 13:16:03',NULL),(7,'BTCL','Dhaka',NULL,NULL,'ans','2024-02-28 13:16:03','2024-02-28 13:16:03',NULL),(8,'Mir Telecom','Dhaka',NULL,NULL,'ios','2024-02-28 13:16:03','2024-02-28 13:16:03',NULL),(9,'Bangla Trac','Dhaka',NULL,NULL,'ios','2024-02-28 13:16:03','2024-02-28 13:16:03',NULL),(10,'M & H Telecom','Dhaka',NULL,NULL,'icx','2024-02-28 13:16:03','2024-02-28 13:16:03',NULL),(11,'BTCL','Dhaka',NULL,NULL,'icx','2024-02-28 13:16:03','2024-02-28 13:16:03',NULL),(12,'Infobip','Dhaka',NULL,NULL,'vendor','2024-02-28 13:16:03','2024-02-28 13:16:03',NULL),(13,'IATL','Intelligent Automation Techology Ltd (IATL)','','','vendor','2024-02-28 07:41:51','2024-02-28 07:41:51',NULL);
/*!40000 ALTER TABLE `operators` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `class` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text,
  `type` varchar(31) NOT NULL DEFAULT 'string',
  `context` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `last_active` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `status`, `status_message`, `active`, `last_active`, `created_at`, `updated_at`, `deleted_at`) VALUES (1,'superadmin',NULL,NULL,0,'2024-02-28 13:35:09','2024-02-28 13:18:20','2024-02-28 13:18:20',NULL),(2,'admin',NULL,NULL,0,'2024-02-28 13:35:32','2024-02-28 13:21:06','2024-02-28 13:21:06',NULL),(3,'maruf.billah',NULL,NULL,0,'2024-02-28 07:43:48','2024-02-28 13:30:15','2024-02-28 13:30:15',NULL);
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

-- Dump completed on 2024-02-28 13:45:26
