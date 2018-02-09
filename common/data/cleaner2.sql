-- MySQL dump 10.13  Distrib 5.7.12, for Win32 (AMD64)
--
-- Host: 127.0.0.1    Database: cleaner
-- ------------------------------------------------------
-- Server version	5.7.14

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ad_place`
--

LOCK TABLES `ad_place` WRITE;
/*!40000 ALTER TABLE `ad_place` DISABLE KEYS */;
INSERT INTO `ad_place` VALUES (1,'One','2017-04-10 11:46:34'),(2,'Two','2017-04-11 01:15:31'),(3,'three','2017-04-11 09:57:21');
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
  `status` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_add_pool_cleaner1_idx` (`cleaner_user_id`),
  KEY `fk_add_pool_ad_place1_idx` (`ad_place_id`),
  KEY `subscription_id` (`subscription_id`),
  CONSTRAINT `fk_add_pool_ad_place1` FOREIGN KEY (`ad_place_id`) REFERENCES `ad_place` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_add_pool_cleaner1` FOREIGN KEY (`cleaner_user_id`) REFERENCES `cleaner` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `subscription_id` FOREIGN KEY (`subscription_id`) REFERENCES `subscription` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ad_pool`
--

LOCK TABLES `ad_pool` WRITE;
/*!40000 ALTER TABLE `ad_pool` DISABLE KEYS */;
INSERT INTO `ad_pool` VALUES (1,32,1,1,0),(2,34,2,2,0),(3,32,3,2,0),(4,34,1,2,2),(5,32,2,2,0),(6,34,3,1,0);
/*!40000 ALTER TABLE `ad_pool` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `advertisment`
--

DROP TABLE IF EXISTS `advertisment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `advertisment` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `pool_id` int(11) DEFAULT NULL,
  `login_user_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`login_user_id`),
  KEY `pool_id` (`pool_id`),
  CONSTRAINT `fk_login_user_id` FOREIGN KEY (`login_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `fk_pool_id` FOREIGN KEY (`pool_id`) REFERENCES `ad_pool` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `advertisment`
--

LOCK TABLES `advertisment` WRITE;
/*!40000 ALTER TABLE `advertisment` DISABLE KEYS */;
INSERT INTO `advertisment` VALUES (97,1,31),(98,2,31),(99,6,31),(100,4,31),(101,4,31),(102,1,31),(103,4,31),(104,4,31),(105,4,31),(106,1,31),(107,4,31),(108,4,31),(109,4,31),(110,4,31),(111,1,31);
/*!40000 ALTER TABLE `advertisment` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'parks cleaning');
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
  KEY `user_id` (`user_id`),
  CONSTRAINT `fk_rating_userId` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cleaner`
--

LOCK TABLES `cleaner` WRITE;
/*!40000 ALTER TABLE `cleaner` DISABLE KEYS */;
INSERT INTO `cleaner` VALUES (32),(34);
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cleaner_category`
--

LOCK TABLES `cleaner_category` WRITE;
/*!40000 ALTER TABLE `cleaner_category` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cleaner_region`
--

LOCK TABLES `cleaner_region` WRITE;
/*!40000 ALTER TABLE `cleaner_region` DISABLE KEYS */;
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
INSERT INTO `customer` VALUES (33),(35);
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
  `longitude` double DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_job_customer1_idx` (`customer_user_id`),
  KEY `fk_job_region1_idx` (`region_id`),
  KEY `fk_job_category1_idx` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job`
--

LOCK TABLES `job` WRITE;
/*!40000 ALTER TABLE `job` DISABLE KEYS */;
INSERT INTO `job` VALUES (3,24,1,1,'hello',1200,2,NULL,'Hleoo','hi','2017-03-14 09:11:19','2017-04-18',0,0),(13,24,3,3,'Clean my gutter',12000,1,'0090900229','','eee','2017-04-04 12:25:39','2017-04-18',0,0),(18,24,1,3,'Clean my gutter',12000,1,'0090900229','','eee','2017-04-04 12:34:29','2017-04-18',0,0),(19,24,1,3,'Clean my gutter',12000,1,'0090900229','','eee','2017-04-04 12:34:48','2017-12-12',0,0),(20,24,3,2,'Clean our home',12000,1,'00903433343','Please do it.','','2017-04-05 05:25:48','2017-12-12',0,0),(21,24,2,1,'Clean my gutter',12999,NULL,'00989929929','Hello','Block 4-E','2017-04-05 12:44:45','2017-04-06',0,0),(22,26,1,1,'Garden cleaning',1200,1,'5433735','Hello there is lot of waste near the garden so want to it clean.','Defence phase 3','2017-04-07 10:20:44','2017-04-10',0,0),(23,26,2,3,'fdgdfs',446,10,'adgg','erwy','wywyw','2017-04-17 13:53:15','2017-04-12',0,0),(24,26,2,3,'fdgdfs',446,10,'adgg','erwy','wywyw','2017-04-17 13:58:24','2017-04-12',0,0),(25,26,2,3,'fdgdfs',446,10,'adgg','erwy','wywyw','2017-04-17 14:05:43','2017-04-12',0,0),(26,26,2,3,'fdgdfs',446,10,'adgg','erwy','wywyw','2017-04-17 14:07:03','2017-04-12',0,0),(27,26,2,3,'fdgdfs',446,10,'adgg','erwy','wywyw','2017-04-17 14:11:54','2017-04-12',0,0),(28,26,2,3,'fdgdfs',446,10,'adgg','erwy','wywyw','2017-04-17 14:19:44','2017-04-12',0,0),(29,33,2,1,'Park cleaning',12000,10,'5737353573','this is park cleaning job','Islamabad','2017-04-21 05:40:29','2017-04-19',0,0),(30,33,3,1,'this is title',4524,10,'4662','this is discription','Islamabad','2017-04-21 12:15:23','2017-04-26',NULL,NULL),(31,33,3,1,'this is title',3523,10,'536454','this is discription','Islamabad','2017-04-21 12:17:32','2017-04-11',NULL,NULL),(32,33,1,1,'this is title',322,10,'4662','thhhhh','karachi','2017-04-21 12:27:11','2017-04-25',NULL,NULL),(33,33,1,1,'',NULL,NULL,'dfdf','','','2017-04-21 14:34:40',NULL,666.99,778878),(34,33,5,1,'this is another title',675665,10,'67458484','this is another discription','karachi','2017-04-24 06:33:18',NULL,5.5635,56.5463),(35,35,6,1,'gilgat project',34590,10,'352326','this is gilgat project','gilgat','2017-04-24 07:33:09',NULL,34.3523,343.34343);
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
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification`
--

LOCK TABLES `notification` WRITE;
/*!40000 ALTER TABLE `notification` DISABLE KEYS */;
/*!40000 ALTER TABLE `notification` ENABLE KEYS */;
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
  `cleaner_id` int(11) NOT NULL,
  `rating` double DEFAULT NULL,
  `rated_by` int(11) NOT NULL,
  `review` varchar(32) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_rating_job1_idx` (`job_id`),
  KEY `fk_rating_user1_idx` (`user_id`),
  KEY `rated by` (`rated_by`),
  CONSTRAINT `fk_rating_job1` FOREIGN KEY (`job_id`) REFERENCES `job` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rating`
--

LOCK TABLES `rating` WRITE;
/*!40000 ALTER TABLE `rating` DISABLE KEYS */;
INSERT INTO `rating` VALUES (4,13,33,32,4,0,'bye','2017-04-19 08:35:33'),(6,18,33,32,3,20,'usaman','2017-04-19 12:39:42'),(7,18,33,32,2,20,'usmana','2017-04-19 12:41:10'),(14,13,33,34,4,10,'customer rated you','2017-04-21 07:30:32'),(17,13,33,34,3,10,'good work','2017-04-24 12:37:04'),(20,29,35,32,3.4,10,'rtytryr','2017-04-25 07:41:34');
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `region`
--

LOCK TABLES `region` WRITE;
/*!40000 ALTER TABLE `region` DISABLE KEYS */;
INSERT INTO `region` VALUES (1,'Defence'),(2,'Bahria'),(3,'B-17'),(4,'Airport'),(5,'Railway station'),(6,'etro Bus Station'),(8,'Red Zone'),(9,'Texila');
/*!40000 ALTER TABLE `region` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscription`
--

DROP TABLE IF EXISTS `subscription`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `days` int(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscription`
--

LOCK TABLES `subscription` WRITE;
/*!40000 ALTER TABLE `subscription` DISABLE KEYS */;
INSERT INTO `subscription` VALUES (1,'subscription1',10000,'2017-04-10 11:34:57',2),(2,'subscription2',6000,'2017-04-11 01:14:41',3);
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
  `role` int(11) DEFAULT NULL,
  `account_activation_token` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_paid` int(11) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (26,'wajid khan','wajid','khan','578893','B0mvcGnZ--nTjByxrYHWaYsKzJoqbpOW','$2y$13$bGUApbFCL7SiGSq0eALVuu4z0cjwB2SgqkWr9IOxXPZchbU2YHWHy',NULL,'waji@gmail.com',NULL,'karachi',10,NULL,NULL,10,1491476243,1493014997),(29,'waleed hayat','waleed ','hayat ','43543','DGzzHM4G2VQk0qYxg4xpj-a1kLSjuhrv','$2y$13$M2tcf0d86t1oCEnVkU8EVefjP9.s82OKfHituIhrAREu5Cl2mkVIW',NULL,'waleed@gmail.com',NULL,'dera',30,NULL,NULL,10,1491484242,1491484283),(30,'naeem khan','naeem','khan','546346','a-4cUiwcPg7reoKAD7Tq544uSW5uYxSY','$2y$13$EleXjgcHWkTho6Ae10fbZ.mr4HQlN4FpuhLvJ.dFsV1eWSkP4eki2',NULL,'naeem@gmail.com',NULL,'karachi',30,NULL,NULL,10,1491537095,1491537168),(31,'Admin Admin','Admin','Admin','9299992','iwn8Y0oV-9TpUgBv4JtdggvHnj4PMvzG','$2y$13$NYvFjcW.xK3zqDvLYbSUku.PnxLLR/Amr1QzEsk1/DM1lSiBe11vS',NULL,'admin@admin.com',NULL,'Lahore',30,NULL,NULL,10,1491808118,1493018200),(32,'Faheem Khan','Faheem','khan','4536353357','cxpyOIqYPa_-qD6YZQ5cnjWC5bkN0uBr','$2y$13$PPJC2ylTwmn/JDen.HX.VOweTUZ.tkiTWXHBZttGvwbE4AgfHuLmO',NULL,'faheem@gmail.com',NULL,'Islamabad',20,NULL,NULL,10,1492590719,1492590719),(33,'hasib hali','hasib ','hali','464563','aVUuejVDocDXj-rM2LgHZsJE9WG0or7M','$2y$13$1ZUeH7Fu0fNj6Y1xL0tflO3tZ/V7yPDb0COpjNPvkRZ9ZN.OixLSa',NULL,'hasib@gmail.com',NULL,'Islamabad',10,NULL,NULL,10,1492590901,1492590901),(34,'neaam khan','naeem','khan','65773573','B2I_yGs6J_12M9Ie-O6DyKZ00GQBxcug','$2y$13$FTskBZp2VVRQZkSRlrggDOo7hkU.Y33heZqOiokmzoITTIcB7hAh2',NULL,'naee@gmail.com',NULL,'Islamabad',20,NULL,NULL,10,1492753088,1492753088),(35,'sajid sayeed','sajid','sayed','4646462','ER29jmuiXshAw5MZpU8aZgZ1YS8uB2SY','$2y$13$KEzFqxpYuhAzZLgso6EjeuIj/qpD6awAwo2qLL0tbgUnjXLuup1OS',NULL,'sajid@gmail.com',NULL,'gilgat',10,NULL,NULL,10,1493019057,1493020432);
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

-- Dump completed on 2017-04-27 16:51:03
