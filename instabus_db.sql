-- MySQL dump 10.18  Distrib 10.3.27-MariaDB, for debian-linux-gnueabihf (armv8l)
--
-- Host: localhost    Database: busdiscoverer_db
-- ------------------------------------------------------
-- Server version	10.3.27-MariaDB-0+deb10u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `likes` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`post_id`),
  KEY `post_id` (`post_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likes`
--

LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
INSERT INTO `likes` VALUES (1,1),(12,1),(1,2),(2,2),(3,2),(4,2),(5,2),(6,2),(10,2),(12,2),(19,2),(23,2),(2,3),(4,4),(23,4),(2,5),(5,5),(10,5),(12,6);
/*!40000 ALTER TABLE `likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `station_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `creation_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `img_path` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`post_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` VALUES (1,1,777,'hahaha','2021-02-01 16:31:01','http://90.45.23.115:8080/uploads/1.jpg'),(2,1,1498,'SOOOLEIIIIL','2021-02-01 16:42:09','http://90.45.23.115:8080/uploads/2.jpg'),(3,3,2,'Night druuuugs','2021-02-01 16:54:29','http://90.45.23.115:8080/uploads/3.jpg'),(4,2,1,'Bus renforcé','2021-02-01 16:58:32','http://90.45.23.115:8080/uploads/4.jpg'),(5,4,109318,'J\'aime le vert','2021-02-01 17:00:37','http://90.45.23.115:8080/uploads/5.jpg'),(6,2,2,'Let It Bus','2021-02-01 17:02:43','http://90.45.23.115:8080/uploads/6.jpg'),(10,5,667,'Reject humanity, become monkey','2021-02-01 17:12:26','http://90.45.23.115:8080/uploads/7.jpg'),(12,6,1533,'Photo de moi hihi','2021-02-01 17:21:07','http://90.45.23.115:8080/uploads/11.jpg'),(23,4,39,'patrick','2021-02-03 11:10:43','http://90.45.23.115:8080/uploads/23.jpg'),(22,7,133,'Coffer','2021-02-03 11:04:54','http://90.45.23.115:8080/uploads/13.jpg');
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tokens`
--

DROP TABLE IF EXISTS `tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tokens` (
  `token_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `selector` char(12) DEFAULT NULL,
  `token` char(64) DEFAULT NULL,
  `expires` datetime NOT NULL,
  PRIMARY KEY (`token_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tokens`
--

LOCK TABLES `tokens` WRITE;
/*!40000 ALTER TABLE `tokens` DISABLE KEYS */;
INSERT INTO `tokens` VALUES (4,2,'7na/LeaSPeCO','662d8279d24082f1489b3baf2fb4852f4ed64380737fe2c370c8163c74fc8ef6','2021-08-03 03:28:06'),(5,2,'d8hp30WR2Agp','b15270fe13f299045259fcb79f090e7641e659bfb094bf20f02e9b5355b0087b','2021-08-03 03:28:45'),(8,2,'3EF5f6HnqCS7','8276549eeb4dff34964648b3dcb743eab35807fbdbb2f662413f2b1469a17dc6','2021-08-03 03:31:32'),(18,1,'YVxyzoxjivIw','db34480797b863f0cfdb320d9d963d98e5001a6539eb194669f6f3f9fd7b5027','2021-08-03 05:51:31'),(22,3,'BCdj98b4DN9y','1a5ed4594f015015717c6a124e7d99d63ea592bd26ea2baac2237d5b1aa543bd','2021-08-03 05:54:29'),(25,4,'jvO40AwPfU99','8349dcbc59c3f8d83f3228a58cad164ca05460cf97ff3c09274798ba741abf9c','2021-08-03 06:00:37'),(37,5,'tgE3M9xq7MmN','c3272a5de7669b34f72ec9ff7ca99bb008f9e8b816c03d467823b0b2249775ad','2021-08-03 06:13:00'),(41,6,'cscJ7LPZc0Rw','9db45813d1cab14da0652aea6b49583a9ac2a0a99cb96bb73c89d1644479df62','2021-08-03 06:21:07'),(45,2,'DUs1Sbgenf5p','ebdc7e112301f570f984f341c80e37babb4d88cd2e8c7268e78584795ca1fa94','2021-08-03 06:30:01'),(61,1,'Kg8tKVIAnNOD','e3969494ade11085e9c27433ce0bd1a7ef7b8cf5233d702dfc747358dfc8081d','2021-08-03 13:37:51'),(66,2,'5XitpVAsIYvm','22bafd142b80a388236e113812b2bcd25e56b34db9ff3166b87cf71ecf49e023','2021-08-04 00:00:47'),(70,2,'F+9bKqFRhc+A','56a179518640a195982dbb64c1b776b1928c7c4e69e1a84341e5b1118fdec4dc','2021-08-04 00:02:42'),(78,2,'w/UYjmEnA6Os','3daf4fe50fbf41c39afc3e50908d191a727e226a41250a5e2afe6d69cfccabc8','2021-08-04 01:12:33'),(81,2,'ken6OtvbGgmt','db3fd9edcf1e7e6cfb0a7da516b90e4c3e73a1bf33d9995a475068a43a82389e','2021-08-04 02:34:02'),(84,2,'AamDmOL4kfvE','7eded28653a46e54aa9f0d088a2900129071709a0ceb0ed5931781b6e932be28','2021-08-04 03:20:26'),(86,2,'FTWcrh2/YAbH','b6e35e0aa3b3edb6f7e5623523917b4efb53985db38972c1d9a1422ac686380c','2021-08-04 04:26:43'),(87,1,'kWUNsCFX1lTH','a5b3148d9356c325046ba1b355c21cc5e2459787295f9c205d4f1daf50591a7f','2021-08-04 09:32:28'),(88,2,'bbjgULqpDyLN','0d3810328f87e51160b6b9d8dd0569ff62113a5df4fa7af44707ce460cfb77f9','2021-08-04 22:12:55'),(93,4,'FY00n0vqS7Hj','739c78f40c67cc2612269a610033a02b81d5ecc040cccf932eb2857e3f119a02','2021-08-04 22:41:45'),(102,1,'ifSfuO966vcc','66ee3addcf5571074fd3ee0c4c80e7cfb92274eb373c4a2804d7e0e558715c79','2021-08-04 22:57:33'),(103,4,'EoqLac7hXWLO','87352ae6b914ebd0246c9686ac4dec38f7e95975bc486b4686e2d7e3a36e6c02','2021-08-04 22:58:22'),(104,5,'yNglZEv1uROj','03c164c5fbc5de4eed12b1811b3e77e22f77f2a09f473c52633034e23a187a4d','2021-08-04 22:59:11'),(107,7,'upagn72YIKQi','f1c4ce35da027f6d6c5ff65338b3a7027e32ece04a86402cedac290e46c853c6','2021-08-05 00:06:08'),(113,2,'NMGc/B9ilXxQ','d6e7897bbe3a7755df305d9dbb726fea1312497c2b76f89eed63fb7639a13b4e','2021-08-05 00:11:07'),(116,4,'I8MedpzQN27Y','a51d9a174bb7e4a7b5ac3570013ed024581498ad5c0c0dd52e03da057180bf3a','2021-08-09 02:36:38');
/*!40000 ALTER TABLE `tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) COLLATE latin1_general_ci NOT NULL,
  `password` text COLLATE latin1_general_ci NOT NULL,
  `mail` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'LouanLeNoob','$argon2id$v=19$m=65536,t=4,p=1$WVJRMmVPcUE3Z0lGcXRYUA$dkTP4ggU1C6I/CK+vb9wV/KwZwlm8FulMWFY++/60rg','louan.le@super.noob'),(2,'Jean-Eudes','$argon2id$v=19$m=65536,t=4,p=1$dE9IY1M2eUtxZFphZXpQOA$1QuoedJHhQoV3WTw7zT4B7hFEGRYoGXCtifl6FnL0+E','a@a.fr'),(3,'MangeTesPrédécesseur','$argon2id$v=19$m=65536,t=4,p=1$aFNxaUZ3NUNmMmhFQVBDOA$1k5iGPswaxfbgAZIejhErgZpemvLPAYL9ARvsSD4c6M','mmmh@miam.miam'),(4,'Représentant Transville','$argon2id$v=19$m=65536,t=4,p=1$VkJybUpDTHZpL2FncE1GZQ$F5rPLUdlWJqV5YCyWEiFWrzVfoARM2LaWWrEhFl4PFQ','representant@transville.com'),(5,'LeMonke','$argon2id$v=19$m=65536,t=4,p=1$cjZXWkVVTTNaZEw4TVZMNQ$nEgaS++STtWWtnyTSKvvkI6SfQIYOLjr9sij7zw6h8U','lemonke@uh.oh'),(6,'Nathalie Kosciusko-Morizet','$argon2id$v=19$m=65536,t=4,p=1$QlMycVAvcWlVOE9LekhyTg$Hg9kJ/2T5Txvs6gcedk3P1GG3z5gb9H6eiOS2jmDEJM','nathalie@trop.long'),(7,'Maxence','$argon2id$v=19$m=65536,t=4,p=1$YXlsWm1GeVp6WTZFYzdyOQ$EJA6hmWDwv16fXOjKcK/3E5x+0yrkRmcHmPYSuc7Kf4','max.ence@mail.com');
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

-- Dump completed on 2021-02-10 12:56:20
