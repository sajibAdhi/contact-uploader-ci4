-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: contact_uploader
-- ------------------------------------------------------
-- Server version	8.0.30

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
-- Table structure for table `aggregators`
--

DROP TABLE IF EXISTS `aggregators`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `aggregators` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `aggregators_pk` (`name`),
  KEY `aggregators_name_index` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aggregators`
--

LOCK TABLES `aggregators` WRITE;
/*!40000 ALTER TABLE `aggregators` DISABLE KEYS */;
INSERT INTO `aggregators` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES (10,'Infobip',NULL,'2024-02-22 15:29:45','2024-02-22 15:29:45',NULL);
/*!40000 ALTER TABLE `aggregators` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_groups_users`
--

LOCK TABLES `auth_groups_users` WRITE;
/*!40000 ALTER TABLE `auth_groups_users` DISABLE KEYS */;
INSERT INTO `auth_groups_users` (`id`, `user_id`, `group`, `created_at`) VALUES (1,1,'superadmin','2024-01-31 12:23:42');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_identities`
--

LOCK TABLES `auth_identities` WRITE;
/*!40000 ALTER TABLE `auth_identities` DISABLE KEYS */;
INSERT INTO `auth_identities` (`id`, `user_id`, `type`, `name`, `secret`, `secret2`, `expires`, `extra`, `force_reset`, `last_used_at`, `created_at`, `updated_at`) VALUES (1,1,'email_password',NULL,'superadmin@admin.com','$2y$12$aCGGDtOFCEp3Mq5i67SUm.K4Q1o/IOthQhSQY/eBid5zVnfowlHvG',NULL,NULL,0,'2024-02-22 12:49:08','2024-01-30 17:25:07','2024-02-22 12:49:08');
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_logins`
--

LOCK TABLES `auth_logins` WRITE;
/*!40000 ALTER TABLE `auth_logins` DISABLE KEYS */;
INSERT INTO `auth_logins` (`id`, `ip_address`, `user_agent`, `id_type`, `identifier`, `user_id`, `date`, `success`) VALUES (1,'202.40.190.154','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36 Edg/121.0.0.0','email_password','favira@mailinator.com',NULL,'2024-01-30 17:11:49',0),(2,'202.40.190.154','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36 Edg/121.0.0.0','email_password','admin@admin.com',1,'2024-01-30 17:26:46',1),(3,'202.40.190.22','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36','email_password','admin@admin.com',1,'2024-01-31 11:20:24',1),(4,'202.40.190.154','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36 Edg/121.0.0.0','email_password','admin@admin.com',1,'2024-01-31 11:39:46',1),(5,'202.40.190.154','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36 Edg/121.0.0.0','email_password','admin@admin.com',1,'2024-01-31 11:39:54',1),(6,'202.40.190.154','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36 Edg/121.0.0.0','email_password','admin@admin.com',1,'2024-01-31 11:53:06',1),(7,'202.40.190.154','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36 Edg/121.0.0.0','email_password','admin@admin.com',1,'2024-01-31 12:15:27',1),(8,'202.40.190.154','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36 Edg/121.0.0.0','email_password','admin@admin.com',NULL,'2024-01-31 16:40:38',0),(9,'202.40.190.154','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36 Edg/121.0.0.0','email_password','superadmin@admin.com',1,'2024-01-31 16:40:53',1),(10,'202.40.190.154','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:122.0) Gecko/20100101 Firefox/122.0','email_password','superadmin@admin.com',1,'2024-02-01 14:07:17',1),(11,'202.40.190.154','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:122.0) Gecko/20100101 Firefox/122.0','email_password','superadmin@admin.com',1,'2024-02-01 15:31:25',1),(12,'202.40.190.154','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36 Edg/121.0.0.0','email_password','superadmin@admin.com',1,'2024-02-01 17:18:33',1),(13,'202.40.190.22','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36 Edg/121.0.0.0','email_password','superadmin@admin.com',1,'2024-02-04 16:43:56',1),(14,'202.40.187.253','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36','email_password','superadmin@admin.com',1,'2024-02-04 16:44:26',1),(15,'202.40.190.154','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36 Edg/121.0.0.0','email_password','superadmin@admin.com',1,'2024-02-06 14:56:04',1),(16,'202.40.190.154','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36 Edg/121.0.0.0','email_password','superadmin@admin.com',1,'2024-02-20 11:10:52',1),(17,'202.40.190.154','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36 Edg/121.0.0.0','email_password','superadmin@admin.com',1,'2024-02-20 12:49:34',1),(18,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36 Edg/121.0.0.0','email_password','superadmin@admin.com',1,'2024-02-22 12:49:08',1);
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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES (1,'Category 1','2024-01-29 19:17:50',NULL,NULL),(2,'Category 2','2024-01-29 19:17:50',NULL,NULL),(3,'Category 3','2024-01-29 19:17:50',NULL,NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_content`
--

DROP TABLE IF EXISTS `contact_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact_content` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `aggregator_id` bigint NOT NULL,
  `date` date DEFAULT NULL,
  `from_contact_id` bigint NOT NULL,
  `to_contact_id` bigint NOT NULL,
  `operator_name` varchar(100) NOT NULL,
  `content` varchar(160) NOT NULL,
  `status` enum('pending','sent','delivered','read','failed') NOT NULL DEFAULT 'pending',
  `remarks` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `contact_content_pk` (`to_contact_id`,`content`,`from_contact_id`,`date`),
  KEY `contact_content_aggregator_id_index` (`aggregator_id`),
  KEY `contact_content_date_index` (`date`),
  KEY `contact_content_to_contact_id_index` (`to_contact_id`),
  KEY `contact_content_status_index` (`status`),
  KEY `contact_content_from_contact_id_index` (`from_contact_id`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_content`
--

LOCK TABLES `contact_content` WRITE;
/*!40000 ALTER TABLE `contact_content` DISABLE KEYS */;
INSERT INTO `contact_content` (`id`, `aggregator_id`, `date`, `from_contact_id`, `to_contact_id`, `operator_name`, `content`, `status`, `remarks`, `created_at`, `updated_at`, `deleted_at`) VALUES (1,10,'2024-02-22',1,2,'Grameenphone','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/uazFD','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(2,10,'2024-02-22',1,3,'Grameenphone','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/RkNTg','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(3,10,'2024-02-22',1,4,'Grameenphone','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/eKnHL','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(4,10,'2024-02-22',1,5,'Grameenphone','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/9wlIR','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(5,10,'2024-02-22',1,6,'Banglalink (Orascom Telecom Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/oFnsi','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(6,10,'2024-02-22',1,7,'Robi (Robi Axiata Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/apl1f','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(7,10,'2024-02-22',1,8,'Robi (Robi Axiata Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/8R18D','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(8,10,'2024-02-22',1,9,'Grameenphone','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/ASciU','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(9,10,'2024-02-22',1,10,'Banglalink (Orascom Telecom Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/QK9FS','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(10,10,'2024-02-22',1,11,'Grameenphone','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/JQ9in','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(11,10,'2024-02-22',1,12,'Grameenphone','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/SLhlU','',NULL,'2024-02-22 18:16:25',NULL,NULL),(12,10,'2024-02-22',1,13,'Grameenphone','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/olie0','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(13,10,'2024-02-22',1,14,'Grameenphone','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/IzoCL','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(14,10,'2024-02-22',1,15,'Grameenphone','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/sFE6Z','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(15,10,'2024-02-22',1,16,'Robi (Robi Axiata Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/adqYB','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(16,10,'2024-02-22',1,17,'Robi (Robi Axiata Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/GwFls','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(17,10,'2024-02-22',1,18,'Banglalink (Orascom Telecom Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/GjKA1','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(18,10,'2024-02-22',1,19,'Banglalink (Orascom Telecom Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/SIBJc','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(19,10,'2024-02-22',1,20,'Robi (Robi Axiata Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/pbf47','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(20,10,'2024-02-22',1,21,'Robi (Robi Axiata Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/k6AmQ','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(21,10,'2024-02-22',1,22,'Banglalink (Orascom Telecom Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/91gwJ','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(22,10,'2024-02-22',1,23,'Robi (Robi Axiata Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/Z1hlr','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(23,10,'2024-02-22',1,24,'Robi (Robi Axiata Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/4Gk36','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(24,10,'2024-02-22',1,25,'Grameenphone','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/BDr85','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(25,10,'2024-02-22',1,26,'Grameenphone','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/PJC6U','',NULL,'2024-02-22 18:16:25',NULL,NULL),(26,10,'2024-02-22',1,27,'Grameenphone','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/b7AfU','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(27,10,'2024-02-22',1,28,'Robi (Robi Axiata Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/KjQSu','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(28,10,'2024-02-22',1,29,'Robi (Robi Axiata Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/DfbAR','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(29,10,'2024-02-22',1,30,'Robi (Robi Axiata Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/8qyqV','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(30,10,'2024-02-22',1,31,'Banglalink (Orascom Telecom Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/7VgLE','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(31,10,'2024-02-22',1,32,'Grameenphone','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/5X7CW','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(32,10,'2024-02-22',1,33,'Grameenphone','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/rtsTD','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(33,10,'2024-02-22',1,34,'Grameenphone','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/kQeAp','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(34,10,'2024-02-22',1,35,'Grameenphone','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/ZoJ7c','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(35,10,'2024-02-22',1,36,'Banglalink (Orascom Telecom Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/HEStb','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(36,10,'2024-02-22',1,37,'Grameenphone','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/9RJcd','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(37,10,'2024-02-22',1,38,'Robi (Robi Axiata Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/7mmhZ','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(38,10,'2024-02-22',1,39,'Robi (Robi Axiata Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/ZjbNT','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(39,10,'2024-02-22',1,40,'Robi (Robi Axiata Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/T8qqu','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(40,10,'2024-02-22',1,41,'Banglalink (Orascom Telecom Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/l9hwv','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(41,10,'2024-02-22',1,42,'Banglalink (Orascom Telecom Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/W4SIL','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(42,10,'2024-02-22',1,43,'Banglalink (Orascom Telecom Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/QcbU5','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(43,10,'2024-02-22',1,44,'Banglalink (Orascom Telecom Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/OFgfi','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(44,10,'2024-02-22',1,45,'Grameenphone','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/V3ZUF','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(45,10,'2024-02-22',1,46,'Grameenphone','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/l9RFC','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(46,10,'2024-02-22',1,47,'Banglalink (Orascom Telecom Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/72yC3','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(47,10,'2024-02-22',1,48,'Robi (Robi Axiata Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/Rsh4g','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(48,10,'2024-02-22',1,49,'Banglalink (Orascom Telecom Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/EEn5s','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(49,10,'2024-02-22',1,50,'Grameenphone','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/oDI9M','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(50,10,'2024-02-22',1,51,'Grameenphone','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/czxU5','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(51,10,'2024-02-22',1,52,'Robi (Robi Axiata Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/8ag0X','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(52,10,'2024-02-22',1,53,'Banglalink (Orascom Telecom Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/wIIiP','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(53,10,'2024-02-22',1,54,'Banglalink (Orascom Telecom Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/mll0o','',NULL,'2024-02-22 18:16:25',NULL,NULL),(54,10,'2024-02-22',1,55,'Robi (Robi Axiata Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/0x5Ii','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(55,10,'2024-02-22',1,56,'Banglalink (Orascom Telecom Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/g4dBw','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(56,10,'2024-02-22',1,57,'Banglalink (Orascom Telecom Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/GmVqm','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(57,10,'2024-02-22',1,58,'Grameenphone','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/daUEk','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(58,10,'2024-02-22',1,59,'Banglalink (Orascom Telecom Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/ptEWE','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(59,10,'2024-02-22',1,60,'Grameenphone','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/2feL5','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(60,10,'2024-02-22',1,61,'Banglalink (Orascom Telecom Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/Q2Mri','',NULL,'2024-02-22 18:16:25',NULL,NULL),(61,10,'2024-02-22',1,62,'Robi (Robi Axiata Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/mI6DE','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(62,10,'2024-02-22',1,63,'Robi (Robi Axiata Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/5vl6o','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(63,10,'2024-02-22',1,64,'Banglalink (Orascom Telecom Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/Su42k','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(64,10,'2024-02-22',1,65,'Grameenphone','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/G0tUD','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(65,10,'2024-02-22',1,66,'Banglalink (Orascom Telecom Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/Q4g4J','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(66,10,'2024-02-22',1,67,'Robi (Robi Axiata Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/Tkt7E','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(67,10,'2024-02-22',1,68,'Banglalink (Orascom Telecom Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/j5Atd','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(68,10,'2024-02-22',1,69,'Grameenphone','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/c6pj5','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(69,10,'2024-02-22',1,70,'Grameenphone','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/W5MCD','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(70,10,'2024-02-22',1,71,'Robi (Robi Axiata Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/oS87w','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(71,10,'2024-02-22',1,72,'Banglalink (Orascom Telecom Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/7KWNL','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(72,10,'2024-02-22',1,73,'Banglalink (Orascom Telecom Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/Fini3','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(73,10,'2024-02-22',1,74,'Banglalink (Orascom Telecom Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/BQDDA','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(74,10,'2024-02-22',1,75,'Grameenphone','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/oCaOs','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(75,10,'2024-02-22',1,76,'Robi (Robi Axiata Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/kGRpW','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(76,10,'2024-02-22',1,77,'Robi (Robi Axiata Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/9k9I4','',NULL,'2024-02-22 18:16:25',NULL,NULL),(77,10,'2024-02-22',1,78,'Grameenphone','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/cXByK','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(78,10,'2024-02-22',1,79,'Banglalink (Orascom Telecom Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/eIrIy','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL),(79,10,'2024-02-22',1,80,'Banglalink (Orascom Telecom Ltd)','প্রিয় গ্রাহক, লংকাবাংলা কার্ডে Christmas শপিং এর আকর্ষণীয় সব অফার জানতে ভিজিট করুন eej.at/Yv7Pm','delivered',NULL,'2024-02-22 18:16:25',NULL,NULL);
/*!40000 ALTER TABLE `contact_content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contacts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `number` varchar(255) NOT NULL,
  `category_id` bigint NOT NULL,
  `remarks` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `contacts_number_uindex` (`number`),
  KEY `contacts_category_id_index` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=100001 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` (`id`, `number`, `category_id`, `remarks`, `created_at`, `updated_at`, `deleted_at`) VALUES (1,'8809617616325',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(2,'8801711090610',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(3,'8801711548983',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(4,'8801746603305',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(5,'8801713038474',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(6,'8801715006345',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(7,'8801711533445',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(8,'8801979273000',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(9,'8801713229949',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(10,'8801711273231',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(11,'8801708119102',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(12,'8801788772355',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(13,'8801711618050',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(14,'8801713006363',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(15,'8801711171651',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(16,'8801552389480',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(17,'8801729297555',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(18,'8801817031441',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(19,'8801819249081',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(20,'8801912111877',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(21,'8801716922542',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(22,'8801819229421',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(23,'8801711224030',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(24,'8801715330030',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(25,'8801914836322',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(26,'8801775777525',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(27,'8801936312996',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(28,'8801552498640',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(29,'8801853745423',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(30,'8801738173039',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(31,'8801712850322',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(32,'8801707079876',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(33,'8801798918003',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(34,'8801799988575',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(35,'8801721139713',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(36,'8801677250580',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(37,'8801975080300',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(38,'8801829374677',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(39,'8801737870214',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(40,'8801709641291',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(41,'8801970083032',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(42,'8801735315992',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(43,'8801677284924',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(44,'8801916300707',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(45,'8801714251661',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(46,'8801689342184',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(47,'8801708355211',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(48,'8801847310858',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(49,'8801616583088',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(50,'8801913824595',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(51,'8801917285758',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(52,'8801685767892',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(53,'8801714928084',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(54,'8801725326584',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(55,'8801713525785',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(56,'8801725616880',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(57,'8801735365361',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(58,'8801737985878',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(59,'8801762619665',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(60,'8801648935551',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(61,'8801609811397',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(62,'8801770272575',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(63,'8801910956175',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(64,'8801759489807',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(65,'8801688459636',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(66,'8801745505593',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(67,'8801725365953',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(68,'8801685763286',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(69,'8801854393395',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(70,'8801753504937',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(71,'8801615862686',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(72,'8801670016943',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(73,'8801521101052',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(74,'8801741777024',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(75,'8801722077170',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(76,'8801723255447',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(77,'8801842133727',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(78,'8801875984160',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(79,'8801728514643',1,NULL,'2024-02-22 18:16:25',NULL,NULL),(80,'8801725863439',1,NULL,'2024-02-22 18:16:25',NULL,NULL);
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES (71,'2023-12-06-070614','App\\Database\\Migrations\\CreateCategoriesTable','default','App',1706534268,1),(72,'2023-12-07-081707','App\\Database\\Migrations\\CreateContactsTable','default','App',1706534268,1),(73,'2023-12-07-081714','App\\Database\\Migrations\\CreateContactContentTable','default','App',1706534268,1),(74,'2024-01-08-113413','App\\Database\\Migrations\\CreateAggregatorsTable','default','App',1706534268,1),(75,'2024-01-16-085951','App\\Database\\Migrations\\CreateSmsTable','default','App',1706534268,1),(76,'2024-01-17-061701','Modules\\OperatorBill\\Database\\Migrations\\CreteOperatorTable','default','Modules\\OperatorBill',1706534268,1),(77,'2024-01-17-061725','Modules\\OperatorBill\\Database\\Migrations\\CreteOperatorBillsTable','default','Modules\\OperatorBill',1706534268,1),(78,'2024-01-17-062534','Modules\\OperatorBill\\Database\\Migrations\\CreteOperatorBillFilesTable','default','Modules\\OperatorBill',1706534268,1),(79,'2020-12-28-223112','Modules\\Shield\\Database\\Migrations\\CreateAuthTables','default','Modules\\Shield',1706609372,2),(80,'2021-07-04-041948','CodeIgniter\\Settings\\Database\\Migrations\\CreateSettingsTable','default','CodeIgniter\\Settings',1706609372,2),(81,'2021-11-14-143905','CodeIgniter\\Settings\\Database\\Migrations\\AddContextColumn','default','CodeIgniter\\Settings',1706609372,2);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operator_bill_files`
--

LOCK TABLES `operator_bill_files` WRITE;
/*!40000 ALTER TABLE `operator_bill_files` DISABLE KEYS */;
INSERT INTO `operator_bill_files` (`id`, `operator_bill_id`, `file_name`, `file_path`, `created_at`, `updated_at`, `deleted_at`) VALUES (1,3,'GP-2194.pdf','uploads/operator_bills//1706589836_1374ab27a4c875617656.pdf','2024-01-30 10:43:56','2024-01-30 10:43:56',NULL);
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operator_bill_histories`
--

LOCK TABLES `operator_bill_histories` WRITE;
/*!40000 ALTER TABLE `operator_bill_histories` DISABLE KEYS */;
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
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operator_bills`
--

LOCK TABLES `operator_bills` WRITE;
/*!40000 ALTER TABLE `operator_bills` DISABLE KEYS */;
INSERT INTO `operator_bills` (`id`, `sbu`, `year`, `month`, `operator_id`, `successful_calls`, `effective_duration`, `voice_amount`, `voice_amount_with_vat`, `sms_count`, `sms_amount`, `sms_amount_with_vat`, `created_at`, `updated_at`, `deleted_at`) VALUES (1,'ritt',2023,12,5,NULL,9.5,122.74,141.15,NULL,NULL,NULL,'2024-01-29 19:19:03','2024-01-29 19:19:03',NULL),(2,'ritt',2023,12,6,539263,734210,29368.42,33774,NULL,NULL,NULL,'2024-01-29 19:21:15','2024-01-29 19:21:15',NULL),(3,'ritt',2023,12,1,NULL,504563,50456,58025,23853834,1073423,161013,'2024-01-30 10:43:56','2024-01-30 10:43:56',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operators`
--

LOCK TABLES `operators` WRITE;
/*!40000 ALTER TABLE `operators` DISABLE KEYS */;
INSERT INTO `operators` (`id`, `name`, `address`, `phone`, `email`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES (1,'Grameenphone','Dhaka','01700000000',NULL,'mobile','2024-01-30 15:11:18','2024-01-30 15:11:18',NULL),(2,'Banglalink','Dhaka','01900000000',NULL,'mobile','2024-01-30 15:11:18','2024-01-30 15:11:18',NULL),(3,'Robi','Dhaka',NULL,NULL,'mobile','2024-01-30 15:11:18','2024-01-30 15:11:18',NULL),(4,'Teletalk','Dhaka','01500000000',NULL,'mobile','2024-01-30 15:11:18','2024-01-30 15:11:18',NULL),(5,'NovoTel','Dhaka',NULL,NULL,'ios','2024-01-30 15:11:18','2024-01-30 15:11:18',NULL),(6,'Softex Communication','Dhaka',NULL,NULL,'icx','2024-01-30 15:11:18','2024-01-30 15:11:18',NULL),(7,'BTCL','Dhaka',NULL,NULL,'ans','2024-01-30 15:11:18','2024-01-30 15:14:52',NULL),(8,'Mir Telecom','Dhaka',NULL,NULL,'ios','2024-01-30 15:11:18','2024-01-30 15:11:18',NULL),(9,'Bangla Trac','Dhaka',NULL,NULL,'ios','2024-01-30 15:11:18','2024-01-30 15:11:18',NULL),(10,'M & H Telecom','Dhaka',NULL,NULL,'icx','2024-01-30 15:11:18','2024-01-30 15:11:18',NULL),(11,'BTCL','Dhaka',NULL,NULL,'icx','2024-01-30 15:11:18','2024-01-30 15:11:18',NULL),(12,'Infobip','Dhaka',NULL,NULL,'vendor','2024-01-30 15:11:18','2024-01-30 15:14:52',NULL);
/*!40000 ALTER TABLE `operators` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_qrcodes`
--

DROP TABLE IF EXISTS `product_qrcodes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_qrcodes` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `product_id` int DEFAULT NULL,
  `batch_no` varchar(300) DEFAULT NULL,
  `qrcode` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_qrcodes_id_index` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_qrcodes`
--

LOCK TABLES `product_qrcodes` WRITE;
/*!40000 ALTER TABLE `product_qrcodes` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_qrcodes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(16) DEFAULT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_pk` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
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
-- Table structure for table `sms`
--

DROP TABLE IF EXISTS `sms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sms` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `aggregator_id` bigint DEFAULT NULL,
  `from_contact_id` bigint NOT NULL,
  `to_contact_id` bigint NOT NULL,
  `content` text,
  `status` enum('pending','sent','failed') NOT NULL DEFAULT 'pending',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sms`
--

LOCK TABLES `sms` WRITE;
/*!40000 ALTER TABLE `sms` DISABLE KEYS */;
/*!40000 ALTER TABLE `sms` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `status`, `status_message`, `active`, `last_active`, `created_at`, `updated_at`, `deleted_at`) VALUES (1,'superadmin',NULL,NULL,0,'2024-02-22 18:17:01','2024-01-30 17:25:07','2024-01-31 12:22:23',NULL);
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

-- Dump completed on 2024-02-25 11:12:43
