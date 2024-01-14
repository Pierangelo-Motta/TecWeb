-- MariaDB dump 10.19  Distrib 10.4.28-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: letturepremiate
-- ------------------------------------------------------
-- Server version	10.4.28-MariaDB

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
-- Table structure for table `utente`
--

DROP TABLE IF EXISTS `utente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utente` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `username` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `pwd` varchar(120) NOT NULL,
  `immagineProfilo` varchar(255) NOT NULL,
  `isAdmin` int(1) NOT NULL,
  `descrizione` varchar(150) DEFAULT NULL,
  `stato` int(1) NOT NULL,
  `numeroFollow` int(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utente`
--

LOCK TABLES `utente` WRITE;
/*!40000 ALTER TABLE `utente` DISABLE KEYS */;
INSERT INTO `utente` VALUES (1,'pier','pier@tecweb.com','$2y$10$gFrPumcEaL5CcXvtGXM9xuMJXNf/UQ01qwAzFXR5XPwsPXbtJV.B6','65a25d1737bf9_Senza_nome.png',0,'Ciao, mi chiamo Pierangelo Motta',0,0),(2,'luca','luca@webtec.it','$2y$10$YU5cUJ4u1mijevPHw6/eA.HpBmhiy.V6b/GQ7Ft9XaYWsIuZKW7He','luca.png',0,'Ciao sono LUCA',0,0),(3,'jacopo','jacopo@webtec.it','$2y$10$42RzrrImDVkkEM3LsluT0ekx6hGZPWod7kTXa/S6.9dhct8TcxskS','659df9bbcb885_incisione.jpg',0,NULL,0,0),(4,'user1','user1@tecweb.it','$2y$10$xTlnGZDq.deb1ZDaJdrpT.G7amPo1OH74wWkkmX2upyGf1PDcdMeS','',0,NULL,0,0),(5,'sara','sara@tecweb.it','$2y$10$YuoPVQMqbSz390utkBmV6.Csh4aDxGO5fyALnG3/xhDbSGkOSunh.','',0,NULL,0,0),(6,'lory','lory.casa.it','$2y$10$pBfSQJJBR60xqPkhLqi5yuCZC2dagqhc56SPMmRI4qNoEgsfVbLgm','',0,NULL,1,0),(7,'admin','admin@tecweb.it','$2y$10$3OlMvmQbXDETNgS8Mqdi6.nIi0ZRT88H0ud2JHL4hWZ3tC1VJcn12','65a25733abf6d_root.jpg',1,'System Admin',0,0);
/*!40000 ALTER TABLE `utente` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-01-14 10:42:22
