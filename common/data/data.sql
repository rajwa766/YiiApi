-- MySQL dump 10.13  Distrib 5.7.9, for Win32 (AMD64)
--
-- Host: localhost    Database: cleaner
-- ------------------------------------------------------
-- Server version	5.6.17

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ad_place`
--

DROP TABLE IF EXISTS `ad_place`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ad_place` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ad_place`
--

LOCK TABLES `ad_place` WRITE;
/*!40000 ALTER TABLE `ad_place` DISABLE KEYS */;
/*!40000 ALTER TABLE `ad_place` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ad_pool`
--

DROP TABLE IF EXISTS `ad_pool`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ad_pool` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cleaner_user_id` int(11) unsigned NOT NULL,
  `ad_place_id` int(11) NOT NULL,
  `subscription_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_add_pool_cleaner1_idx` (`cleaner_user_id`),
  KEY `fk_add_pool_ad_place1_idx` (`ad_place_id`),
  KEY `fk_add_pool_subscription1_idx` (`subscription_id`),
  CONSTRAINT `fk_add_pool_ad_place1` FOREIGN KEY (`ad_place_id`) REFERENCES `ad_place` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_add_pool_cleaner1` FOREIGN KEY (`cleaner_user_id`) REFERENCES `cleaner` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_add_pool_subscription1` FOREIGN KEY (`subscription_id`) REFERENCES `subscription` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ad_pool`
--

LOCK TABLES `ad_pool` WRITE;
/*!40000 ALTER TABLE `ad_pool` DISABLE KEYS */;
/*!40000 ALTER TABLE `ad_pool` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(450) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Garden Cleaning'),(2,'Gutter Cleaning'),(3,'Home Cleaning'),(4,'Pool Cleaning');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cleaner`
--

DROP TABLE IF EXISTS `cleaner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cleaner` (
  `user_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `fk_cleaner_user_idx` (`user_id`),
  CONSTRAINT `fk_cleaner_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cleaner`
--

LOCK TABLES `cleaner` WRITE;
/*!40000 ALTER TABLE `cleaner` DISABLE KEYS */;
INSERT INTO `cleaner` VALUES (1);
/*!40000 ALTER TABLE `cleaner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cleaner_category`
--

DROP TABLE IF EXISTS `cleaner_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cleaner_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cleaner_user_id` int(11) unsigned NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cleaner_category_cleaner1_idx` (`cleaner_user_id`),
  KEY `fk_cleaner_category_category1_idx` (`category_id`),
  CONSTRAINT `fk_cleaner_category_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cleaner_category_cleaner1` FOREIGN KEY (`cleaner_user_id`) REFERENCES `cleaner` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cleaner_category`
--

LOCK TABLES `cleaner_category` WRITE;
/*!40000 ALTER TABLE `cleaner_category` DISABLE KEYS */;
INSERT INTO `cleaner_category` VALUES (13,1,1),(14,1,2),(15,1,3),(16,1,2);
/*!40000 ALTER TABLE `cleaner_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cleaner_region`
--

DROP TABLE IF EXISTS `cleaner_region`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cleaner_region` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `region_id` int(11) NOT NULL,
  `cleaner_user_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cleaner_region_region1_idx` (`region_id`),
  KEY `fk_cleaner_region_cleaner1_idx` (`cleaner_user_id`),
  CONSTRAINT `fk_cleaner_region_cleaner1` FOREIGN KEY (`cleaner_user_id`) REFERENCES `cleaner` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cleaner_region_region1` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cleaner_region`
--

LOCK TABLES `cleaner_region` WRITE;
/*!40000 ALTER TABLE `cleaner_region` DISABLE KEYS */;
INSERT INTO `cleaner_region` VALUES (9,1,1);
/*!40000 ALTER TABLE `cleaner_region` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `user_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `fk_customer_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (24);
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job`
--

DROP TABLE IF EXISTS `job`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_user_id` int(11) unsigned NOT NULL,
  `region_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(45) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `contact_no` varchar(45) DEFAULT NULL,
  `description` text,
  `address` varchar(45) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_job_customer1_idx` (`customer_user_id`),
  KEY `fk_job_region1_idx` (`region_id`),
  KEY `fk_job_category1_idx` (`category_id`),
  CONSTRAINT `fk_job_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_job_customer1` FOREIGN KEY (`customer_user_id`) REFERENCES `customer` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_job_region1` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job`
--

LOCK TABLES `job` WRITE;
/*!40000 ALTER TABLE `job` DISABLE KEYS */;
INSERT INTO `job` VALUES (3,24,1,1,'hello',1200,NULL,NULL,'Hleoo','hi','2017-03-14 09:11:19','0000-00-00'),(13,24,3,3,'Clean my gutter',12000,1,'0090900229','','eee','2017-04-04 12:25:39','0000-00-00'),(18,24,1,3,'Clean my gutter',12000,1,'0090900229','','eee','2017-04-04 12:34:29','0000-00-00'),(19,24,1,3,'Clean my gutter',12000,1,'0090900229','','eee','2017-04-04 12:34:48','2017-12-12'),(20,24,3,2,'Clean our home',12000,1,'00903433343','Please do it.','','2017-04-05 05:25:48','2017-12-12'),(21,24,2,1,'Clean my gutter',12999,NULL,'00989929929','Hello','Block 4-E','2017-04-05 12:44:45','2017-04-06');
/*!40000 ALTER TABLE `job` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` VALUES ('m000000_000000_base',1488517617),('m130524_201442_init',1488517625);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rating`
--

DROP TABLE IF EXISTS `rating`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` int(11) NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_rating_job1_idx` (`job_id`),
  KEY `fk_rating_user1_idx` (`user_id`),
  CONSTRAINT `fk_rating_job1` FOREIGN KEY (`job_id`) REFERENCES `job` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_rating_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rating`
--

LOCK TABLES `rating` WRITE;
/*!40000 ALTER TABLE `rating` DISABLE KEYS */;
/*!40000 ALTER TABLE `rating` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `region`
--

DROP TABLE IF EXISTS `region`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `region` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(450) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `region`
--

LOCK TABLES `region` WRITE;
/*!40000 ALTER TABLE `region` DISABLE KEYS */;
INSERT INTO `region` VALUES (1,'Defence'),(2,'Bahria'),(3,'B-17'),(4,'Airport'),(5,'Railway station'),(6,'etro Bus Station');
/*!40000 ALTER TABLE `region` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscription`
--

DROP TABLE IF EXISTS `subscription`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscription`
--

LOCK TABLES `subscription` WRITE;
/*!40000 ALTER TABLE `subscription` DISABLE KEYS */;
/*!40000 ALTER TABLE `subscription` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_no` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `profile_pic` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` smallint(6) DEFAULT NULL,
  `account_activation_token` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_paid` int(11) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'mushahidh224',NULL,NULL,NULL,'wxkw1_0VmoStgGcYqxouBtPhVIaX9Ia_','$2y$13$YFLGfLk8aYVPndycU5raoOC8WxkegR6ZRbBTWdyWZVErKvZeYP.BW',NULL,'mushahidh224@gmail.com',NULL,NULL,30,NULL,NULL,10,1488778369,1488778369),(24,'mushahid',NULL,NULL,NULL,'V44f9eeXkv3TqUwf6zbHcAlzhTfbokto','$2y$13$WuQ17rkt1KMB6bInrQicDuvn1syBhyKueGB8A38cxeFKF/c1GNUzO',NULL,'mushahidh@live.com',NULL,NULL,10,'9Ar6dr0sG8lMcp_zBEqCNJxCrV4WjUDq_1488877566',NULL,10,1488877567,1488877567);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-04-06 12:29:58
