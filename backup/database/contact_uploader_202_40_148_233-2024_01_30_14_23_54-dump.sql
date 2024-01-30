-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: contact_uploader
-- ------------------------------------------------------
-- Server version	8.0.35-0ubuntu0.20.04.1

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aggregators`
--

LOCK TABLES `aggregators` WRITE;
/*!40000 ALTER TABLE `aggregators` DISABLE KEYS */;
/*!40000 ALTER TABLE `aggregators` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
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
  `content` varchar(255) NOT NULL,
  `contact_id` bigint unsigned NOT NULL,
  `date` date DEFAULT NULL,
  `remarks` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `content_contact_id` (`content`,`contact_id`),
  KEY `contact_content_contact_id_foreign` (`contact_id`),
  CONSTRAINT `contact_content_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_content`
--

LOCK TABLES `contact_content` WRITE;
/*!40000 ALTER TABLE `contact_content` DISABLE KEYS */;
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
  `category_id` bigint unsigned NOT NULL,
  `remarks` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contacts_category_id_foreign` (`category_id`),
  CONSTRAINT `contacts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES (71,'2023-12-06-070614','App\\Database\\Migrations\\CreateCategoriesTable','default','App',1706534268,1),(72,'2023-12-07-081707','App\\Database\\Migrations\\CreateContactsTable','default','App',1706534268,1),(73,'2023-12-07-081714','App\\Database\\Migrations\\CreateContactContentTable','default','App',1706534268,1),(74,'2024-01-08-113413','App\\Database\\Migrations\\CreateAggregatorsTable','default','App',1706534268,1),(75,'2024-01-16-085951','App\\Database\\Migrations\\CreateSmsTable','default','App',1706534268,1),(76,'2024-01-17-061701','Modules\\OperatorBill\\Database\\Migrations\\CreteOperatorTable','default','Modules\\OperatorBill',1706534268,1),(77,'2024-01-17-061725','Modules\\OperatorBill\\Database\\Migrations\\CreteOperatorBillsTable','default','Modules\\OperatorBill',1706534268,1),(78,'2024-01-17-062534','Modules\\OperatorBill\\Database\\Migrations\\CreteOperatorBillFilesTable','default','Modules\\OperatorBill',1706534268,1);
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
  `type` enum('mobile','ios','igw','icx','landline') NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operators`
--

LOCK TABLES `operators` WRITE;
/*!40000 ALTER TABLE `operators` DISABLE KEYS */;
INSERT INTO `operators` (`id`, `name`, `address`, `phone`, `email`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES (1,'Grameenphone','Dhaka','01700000000',NULL,'mobile','2024-01-29 19:17:50','2024-01-29 19:17:50',NULL),(2,'Banglalink','Dhaka','01900000000',NULL,'mobile','2024-01-29 19:17:50','2024-01-29 19:17:50',NULL),(3,'Airtel','Dhaka','01600000000',NULL,'mobile','2024-01-29 19:17:50','2024-01-29 19:17:50',NULL),(4,'Teletalk','Dhaka','01500000000',NULL,'mobile','2024-01-29 19:17:50','2024-01-29 19:17:50',NULL),(5,'NovoTel','Dhaka',NULL,NULL,'ios','2024-01-29 19:17:50','2024-01-29 19:17:50',NULL),(6,'Softex.com','Dhaka',NULL,NULL,'icx','2024-01-29 19:17:50','2024-01-29 19:17:50',NULL);
/*!40000 ALTER TABLE `operators` ENABLE KEYS */;
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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-01-30 14:23:55
