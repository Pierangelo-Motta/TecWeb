-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: letturepremiate
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

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
-- Table structure for table `autore`
--

DROP TABLE IF EXISTS `autore`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `autore` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ID_AUTORE_IND` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `autore`
--

LOCK TABLES `autore` WRITE;
/*!40000 ALTER TABLE `autore` DISABLE KEYS */;
INSERT INTO `autore` VALUES (0,'unknow'),(1,'Christian Bobin'),(2,'A.A. Milne'),(3,'Toshikazu Kawaguchi'),(4,'Chandra Candiani'),(5,'Franco Arminio'),(6,'Sanaka Hiiragi'),(7,'Banana Yoshimoto'),(8,'Matteo Bussola'),(9,'Tahar Ben Jelloun'),(10,'Gianrico Carofiglio'),(11,'Francesco Occhetta'),(13,'Satoshi Yagisawa'),(14,'Alan Bradley'),(15,'Flavia de Luce'),(16,'Elisa Rocchi'),(17,'Guus Kuijer'),(19,'Patricia MacLachlan'),(39,'Giovanni Boccaccio'),(40,'Omero'),(41,'Umberto Eco'),(42,'Charlotte Link'),(43,'Ken Follett'),(44,'Fabio Volo'),(45,'George Orwell');
/*!40000 ALTER TABLE `autore` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commenti`
--

DROP TABLE IF EXISTS `commenti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commenti` (
  `utenteIdPost` int(8) NOT NULL,
  `dataOraPost` datetime NOT NULL,
  `utenteIdComm` int(8) NOT NULL,
  `dataOraComm` datetime NOT NULL,
  `commento` varchar(1023) NOT NULL,
  PRIMARY KEY (`utenteIdPost`,`dataOraPost`,`utenteIdComm`,`dataOraComm`),
  UNIQUE KEY `ID_COMMENTI_IND` (`utenteIdPost`,`dataOraPost`,`utenteIdComm`,`dataOraComm`),
  KEY `REF_COMME_UTENT_IND` (`utenteIdComm`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commenti`
--

LOCK TABLES `commenti` WRITE;
/*!40000 ALTER TABLE `commenti` DISABLE KEYS */;
INSERT INTO `commenti` VALUES (1,'2024-02-05 17:13:40',3,'2024-02-05 17:14:46','bellissimo');
/*!40000 ALTER TABLE `commenti` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compone`
--

DROP TABLE IF EXISTS `compone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compone` (
  `medagliereId` int(8) NOT NULL,
  `libroId` int(8) NOT NULL,
  PRIMARY KEY (`libroId`,`medagliereId`),
  UNIQUE KEY `ID_Compone_IND` (`libroId`,`medagliereId`),
  KEY `EQU_Compo_MEDAG_IND` (`medagliereId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compone`
--

LOCK TABLES `compone` WRITE;
/*!40000 ALTER TABLE `compone` DISABLE KEYS */;
INSERT INTO `compone` VALUES (4,2),(5,2),(6,2),(4,3),(5,3),(6,3),(3,4),(4,4),(5,4),(6,4),(3,5),(4,5),(5,5),(6,5),(3,6),(4,6),(5,6),(6,6),(0,7),(1,7),(3,7),(5,7),(6,7),(3,8),(4,8),(5,8),(6,8),(5,9),(6,9),(1,10),(4,10),(5,10),(6,10),(5,11),(6,11),(4,12),(5,12),(6,12),(5,13),(6,13),(4,14),(5,14),(6,14),(5,15),(6,15),(4,16),(5,16),(6,16),(5,17),(6,17),(1,18),(2,18),(4,18),(5,18),(6,18),(5,19),(6,19);
/*!40000 ALTER TABLE `compone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `libro`
--

DROP TABLE IF EXISTS `libro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `libro` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `titolo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `libro`
--

LOCK TABLES `libro` WRITE;
/*!40000 ALTER TABLE `libro` DISABLE KEYS */;
INSERT INTO `libro` VALUES (1,'Questo immenso non sapere'),(2,'Sacro minore'),(3,'L\\\' abito di piume'),(4,'Un buon posto in cui fermarsi'),(5,'L\'urlo'),(6,'Della gentilezza e del coraggio'),(7,'L\'uomo che cammina'),(8,'Fede e giustizia'),(9,'Kitchen'),(10,'Il primo caffè della giornata'),(11,'I miei giorni alla libreria Morisaki'),(12,'Le trecce d\'oro dei defunti'),(13,'Il gatto striato miagola tre volte'),(14,'Talenti non fondamentali'),(15,'Il libro di tutte le cose'),(16,'Geai'),(17,'Una parola dopo l\'altra'),(18,'Winnie Pooh'),(19,'Il magnifico studio fotografico di Hirasaka'),(22,'Libro'),(61,'Il Decamerone'),(62,'Odissea'),(65,'Il nome della rosa'),(66,'La palude'),(67,'La casa delle sorelle'),(68,'L\\\'ultima traccia'),(69,'La scelta decisiva'),(70,'Il terzo gemello'),(71,'I pilastri della terra'),(72,'Le armi della luce'),(73,'Quando tutto inizia'),(74,'Le prime luci del mattino'),(75,'l\'oraa'),(76,'1984'),(97,'default');
/*!40000 ALTER TABLE `libro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medagliere`
--

DROP TABLE IF EXISTS `medagliere`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medagliere` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `titolo` varchar(50) NOT NULL,
  `descrizione` varchar(800) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Un nuovo medagliere ti aspetta!',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ID_MEDAGLIERE_IND` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medagliere`
--

LOCK TABLES `medagliere` WRITE;
/*!40000 ALTER TABLE `medagliere` DISABLE KEYS */;
INSERT INTO `medagliere` VALUES (0,'Benvenuto!','Ti diamo il benvenuto nel nostro social con questo primissimo medagliere facilissimo da completare, infatti ti basterà leggere soltanto 1 libro. Vedi qui sotto per scoprire quale!'),(1,'Continua così!','Se ti è piaciuta la scorsa sfida, sicuramente amerai anche questa! Ti sfidiamo ad arricchire il medagliere di benvenuto leggendo questi nuovi 2 libri!'),(2,'debug1','debug1debug1debug1'),(3,'Lorem ipsum dolor sit amet','risus, ornare nec diam id, sollicitudin vestibulum urna. Nam tempor accumsan ligula, vitae dictum tortor faucibus eu. Nulla nec efficitur massa, sed egestas dolor. Donec lao'),(4,'Sed ac tempus magna','Phasellus consectetur nisl vitae mi ultrices rutrum tincidunt vitae nisi. Integer imperdiet dignissim dapibus. Proin id sem semper, consectetur metus in, sodales ipsum. Maecenas malesuada at nisl sed vulputate. Integer maximus diam at eros vehicula blandit.'),(5,'Phasellus venenatis, nisi eu finibus porta, risus',''),(6,'Massimizzazione d e l _ t e s t o','Lorem ipsum dolor sit amet, consectetur adipiscing elit.');
/*!40000 ALTER TABLE `medagliere` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifica`
--

DROP TABLE IF EXISTS `notifica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifica` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `dataOra` datetime NOT NULL DEFAULT current_timestamp(),
  `tipo` char(1) NOT NULL,
  `utenteId` int(8) NOT NULL,
  `utenteIdPost` int(1) DEFAULT NULL,
  `dataOraPost` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ID_NOTIFICA_IND` (`id`),
  KEY `REF_NOTIF_UTENT_IND` (`utenteId`),
  KEY `REF_NOTIF_POST_IND` (`utenteIdPost`,`dataOraPost`)
) ENGINE=InnoDB AUTO_INCREMENT=387 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifica`
--

LOCK TABLES `notifica` WRITE;
/*!40000 ALTER TABLE `notifica` DISABLE KEYS */;
INSERT INTO `notifica` VALUES (382,'2024-02-05 17:12:43','F',2,3,'2024-02-05 17:12:43'),(383,'2024-02-05 17:12:57','F',2,3,'2024-02-05 17:12:57'),(384,'2024-02-05 17:13:57','F',1,3,'2024-02-05 17:13:57'),(385,'2024-02-05 17:14:38','K',1,3,'2024-02-05 17:13:40'),(386,'2024-02-05 17:14:46','C',1,3,'2024-02-05 17:13:40');
/*!40000 ALTER TABLE `notifica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post` (
  `utenteId` int(8) NOT NULL,
  `dataOra` datetime NOT NULL,
  `citazioneTestuale` varchar(255) DEFAULT NULL,
  `fotoCitazione` varchar(127) DEFAULT NULL,
  `riflessione` varchar(2047) NOT NULL,
  `counterMiPiace` decimal(6,0) NOT NULL,
  `counterAdoro` decimal(6,0) NOT NULL,
  `libroId` int(8) NOT NULL,
  PRIMARY KEY (`utenteId`,`dataOra`),
  UNIQUE KEY `ID_POST_IND` (`utenteId`,`dataOra`),
  KEY `REF_POST_LIBRO_IND` (`libroId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` VALUES (1,'2024-02-05 17:13:40','ooooooooooooo','pier__2024_02_05__17_13_40.jpg','ooooooooooooooo',1,0,18),(2,'2024-02-05 17:12:16','wwwww','luca__2024_02_05__17_12_16.jpeg','wwwwww',0,0,6);
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `scrittoda`
--

DROP TABLE IF EXISTS `scrittoda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `scrittoda` (
  `libroId` int(8) NOT NULL,
  `autoreId` int(8) NOT NULL,
  PRIMARY KEY (`autoreId`,`libroId`),
  UNIQUE KEY `ID_ScrittoDa_IND` (`autoreId`,`libroId`),
  KEY `EQU_Scrit_LIBRO_IND` (`libroId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `scrittoda`
--

LOCK TABLES `scrittoda` WRITE;
/*!40000 ALTER TABLE `scrittoda` DISABLE KEYS */;
INSERT INTO `scrittoda` VALUES (61,39),(62,40),(65,41),(66,42),(67,42),(68,42),(69,42),(70,43),(71,43),(72,43),(75,43),(73,44),(74,44),(45,76);
/*!40000 ALTER TABLE `scrittoda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `segue`
--

DROP TABLE IF EXISTS `segue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `segue` (
  `seguitoId` int(8) NOT NULL,
  `seguenteId` int(8) NOT NULL,
  PRIMARY KEY (`seguitoId`,`seguenteId`),
  UNIQUE KEY `ID_Segue_IND` (`seguitoId`,`seguenteId`),
  KEY `REF_Segue_UTENT_1_IND` (`seguenteId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `segue`
--

LOCK TABLES `segue` WRITE;
/*!40000 ALTER TABLE `segue` DISABLE KEYS */;
INSERT INTO `segue` VALUES (1,3);
/*!40000 ALTER TABLE `segue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sottoscrive`
--

DROP TABLE IF EXISTS `sottoscrive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sottoscrive` (
  `utenteId` int(8) NOT NULL,
  `medagliereId` int(8) NOT NULL,
  PRIMARY KEY (`medagliereId`,`utenteId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sottoscrive`
--

LOCK TABLES `sottoscrive` WRITE;
/*!40000 ALTER TABLE `sottoscrive` DISABLE KEYS */;
INSERT INTO `sottoscrive` VALUES (1,0),(2,0),(3,0),(4,0),(5,0),(6,0),(8,0),(9,0),(12,0),(13,0),(14,0),(1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(8,1),(9,1),(12,1),(13,1),(14,1);
/*!40000 ALTER TABLE `sottoscrive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tagperpost`
--

DROP TABLE IF EXISTS `tagperpost`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tagperpost` (
  `utenteIdPost` int(8) NOT NULL,
  `dataOraPost` datetime NOT NULL,
  `tagId` int(8) NOT NULL,
  PRIMARY KEY (`utenteIdPost`,`dataOraPost`,`tagId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tagperpost`
--

LOCK TABLES `tagperpost` WRITE;
/*!40000 ALTER TABLE `tagperpost` DISABLE KEYS */;
INSERT INTO `tagperpost` VALUES (1,'2024-02-05 17:13:40',43),(1,'2024-02-05 17:13:40',44),(1,'2024-02-05 17:13:40',45),(2,'2024-02-05 17:12:16',42),(2,'2024-02-05 17:12:16',43),(2,'2024-02-05 17:12:16',44);
/*!40000 ALTER TABLE `tagperpost` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `testo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (42,'wow'),(43,'figo'),(44,'bello'),(45,'pooh');
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utente`
--

LOCK TABLES `utente` WRITE;
/*!40000 ALTER TABLE `utente` DISABLE KEYS */;
INSERT INTO `utente` VALUES (1,'pier','pier@tecweb.com','$2y$10$gFrPumcEaL5CcXvtGXM9xuMJXNf/UQ01qwAzFXR5XPwsPXbtJV.B6','65a25d1737bf9_Senza_nome.png',0,'Ciao, mi chiamo Pierangelo Motta',0),(2,'luca','luca@webtec.it','$2y$10$OafpmGEbm04ki4c1j18wbuw5CgAimvQApc9IoZeDzHT4oB8145Oe6','65b6b9e60eb74_273754719_4856560301129833_2961398596313220444_n.jpg',0,'Ciao sono LUCA',0),(3,'jacopo','jacopo@webtec.it','$2y$10$42RzrrImDVkkEM3LsluT0ekx6hGZPWod7kTXa/S6.9dhct8TcxskS','659df9bbcb885_incisione.jpg',0,'',0),(4,'user1','user1@tecweb.it','$2y$10$xTlnGZDq.deb1ZDaJdrpT.G7amPo1OH74wWkkmX2upyGf1PDcdMeS','',0,NULL,0),(5,'sara','sara@tecweb.it','$2y$10$YuoPVQMqbSz390utkBmV6.Csh4aDxGO5fyALnG3/xhDbSGkOSunh.','',0,NULL,0),(6,'lory','lory.casa.it','$2y$10$pBfSQJJBR60xqPkhLqi5yuCZC2dagqhc56SPMmRI4qNoEgsfVbLgm','',0,NULL,1),(7,'admin','admin@tecweb.it','$2y$10$3OlMvmQbXDETNgS8Mqdi6.nIi0ZRT88H0ud2JHL4hWZ3tC1VJcn12','65a25733abf6d_root.jpg',1,'System Admin',0),(8,'nuovo','nuovo@gmail.com','$2y$10$qs0x5.a7igiKKM0fCanPneScTRY86bdlasZbQ65stwTYKysml9Oki','65a3fbb56505e_propic_nuovo.jpg',0,NULL,0),(9,'novo','novo@gmail.com','$2y$10$X66ClJRut7T1YW9uNfis8.pZan2NMowVRk5GW8L35lLLUidNlGEnu','',0,NULL,0),(12,'nnovo','nnovo@gmail.com','$2y$10$4yS10rMejYIxjZ8NW18WW.a3f6crGuglqgaSrPIQ93WFg1Xv5ZTFC','',0,NULL,0),(13,'liuk','a@a','$2y$10$b8UYIet7EhFNveWM4KVnquXx.AY2d5v0gVTId2yY.PaspGfjqCt/2','',0,NULL,0),(14,'l','l@a','$2y$10$n4FZLsUDrXQu209nZHJ5EOB8cuUz48F1nwh1p9K8ag2vYOx2pj3jm','',0,NULL,0);
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

-- Dump completed on 2024-02-05 17:19:53
