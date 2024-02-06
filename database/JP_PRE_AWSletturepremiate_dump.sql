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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `autore`
--

LOCK TABLES `autore` WRITE;
/*!40000 ALTER TABLE `autore` DISABLE KEYS */;
INSERT INTO `autore` VALUES (0,'unknow'),(1,'Christian Bobin'),(2,'A.A. Milne'),(3,'Toshikazu Kawaguchi'),(4,'Chandra Candiani'),(5,'Franco Arminio'),(6,'Sanaka Hiiragi'),(7,'Banana Yoshimoto'),(8,'Matteo Bussola'),(9,'Tahar Ben Jelloun'),(10,'Gianrico Carofiglio'),(11,'Francesco Occhetta'),(13,'Satoshi Yagisawa'),(14,'Alan Bradley'),(15,'Flavia de Luce'),(16,'Elisa Rocchi'),(17,'Guus Kuijer'),(19,'Patricia MacLachlan'),(22,'J'),(23,'qq'),(24,'gg');
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
INSERT INTO `commenti` VALUES (26,'2024-02-05 22:11:40',28,'2024-02-05 22:51:14','a'),(26,'2024-02-05 22:11:40',31,'2024-02-05 23:00:48','aa'),(26,'2024-02-05 22:11:40',31,'2024-02-05 23:04:58','s');
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
INSERT INTO `compone` VALUES (4,2),(5,2),(6,2),(7,2),(4,3),(5,3),(6,3),(3,4),(4,4),(5,4),(6,4),(7,4),(3,5),(4,5),(5,5),(6,5),(3,6),(4,6),(5,6),(6,6),(0,7),(1,7),(3,7),(5,7),(6,7),(3,8),(4,8),(5,8),(6,8),(5,9),(6,9),(1,10),(4,10),(5,10),(6,10),(7,10),(5,11),(6,11),(7,11),(4,12),(5,12),(6,12),(7,12),(5,13),(6,13),(7,13),(4,14),(5,14),(6,14),(5,15),(6,15),(4,16),(5,16),(6,16),(7,16),(5,17),(6,17),(1,18),(2,18),(4,18),(5,18),(6,18),(5,19),(6,19);
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
  UNIQUE KEY `ID_LIBRO_IND` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `libro`
--

LOCK TABLES `libro` WRITE;
/*!40000 ALTER TABLE `libro` DISABLE KEYS */;
INSERT INTO `libro` VALUES (2,'Sacro minore'),(3,'L\' abito di piume'),(4,'Un buon posto in cui fermarsi'),(5,'L\'urlo'),(6,'Della gentilezza e del coraggio'),(7,'L\'uomo che cammina'),(8,'Fede e giustizia'),(9,'Kitchen'),(10,'Il primo caffè della giornata'),(11,'I miei giorni alla libreria Morisaki'),(12,'Le trecce d\'oro dei defunti'),(13,'Il gatto striato miagola tre volte'),(14,'Talenti non fondamentali'),(15,'Il libro di tutte le cose'),(16,'Geai'),(17,'Una parola dopo l\'altra'),(18,'Winnie Pooh'),(19,'Il magico studio fotografico di Hirasaka'),(22,'Libro'),(23,'L\\\'orlo del buratello'),(24,'L\\\'orso Yoghi'),(25,'a'),(26,'aa'),(27,'aaaa'),(28,'aaaa'),(29,'q'),(30,'gg');
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medagliere`
--

LOCK TABLES `medagliere` WRITE;
/*!40000 ALTER TABLE `medagliere` DISABLE KEYS */;
INSERT INTO `medagliere` VALUES (0,'Benvenuto!','Ti diamo il benvenuto nel nostro social con questo primissimo medagliere facilissimo da completare, infatti ti basterà leggere soltanto 1 libro. Vedi qui sotto per scoprire quale!'),(1,'Continua così!','Se ti è piaciuta la scorsa sfida, sicuramente amerai anche questa! Ti sfidiamo ad arricchire il medagliere di benvenuto leggendo questi nuovi 2 libri!'),(2,'debug1','debug1debug1debug1'),(3,'Lorem ipsum dolor sit amet','risus, ornare nec diam id, sollicitudin vestibulum urna. Nam tempor accumsan ligula, vitae dictum tortor faucibus eu. Nulla nec efficitur massa, sed egestas dolor. Donec lao'),(4,'Sed ac tempus magna','Phasellus consectetur nisl vitae mi ultrices rutrum tincidunt vitae nisi. Integer imperdiet dignissim dapibus. Proin id sem semper, consectetur metus in, sodales ipsum. Maecenas malesuada at nisl sed vulputate. Integer maximus diam at eros vehicula blandit.'),(5,'Phasellus venenatis, nisi eu finibus porta, risus',''),(6,'Massimizzazione d e l _ t e s t o','Lorem ipsum dolor sit amet, consectetur adipiscing elit.'),(7,'Medagliere di prova','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis venenatis ultrices sem sagittis accumsan. Pellentesque eget justo commodo, ultrices nisl viverra, pellentesque mauris. Nunc rutrum venenatis erat ut tincidunt. Etiam porttitor sed lorem eu aliquet. Pellentesque commodo ac orci rutrum tincidunt. Suspendisse vitae diam ut dolor pharetra convallis id et massa. Praesent eu nulla vitae enim tincidunt mollis.  Suspendisse a ullamcorper magna. Nullam risus ligula, consectetur consequat arcu non, egestas maximus magna. Duis non lacus vitae enim fermentum congue. Aliquam quis vestibulum dui. In ante mi, posuere eget rhoncus id, lacinia a quam. Nunc nec iaculis elit, at suscipit mi. Cras condimvestibulum dui. In ante mi, posuere eget rhoncus id, vestibulum dui. In ante mi, posue');
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
) ENGINE=InnoDB AUTO_INCREMENT=246 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifica`
--

LOCK TABLES `notifica` WRITE;
/*!40000 ALTER TABLE `notifica` DISABLE KEYS */;
INSERT INTO `notifica` VALUES (243,'2024-02-05 22:51:14','C',26,28,'2024-02-05 22:11:40'),(244,'2024-02-05 23:00:48','C',26,31,'2024-02-05 22:11:40'),(245,'2024-02-05 23:04:58','C',26,31,'2024-02-05 22:11:40');
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
INSERT INTO `post` VALUES (25,'2024-02-05 19:22:22',NULL,'jp__2024_02_05__19_22_22.jpeg','sono curiosissimo di inizialo!',0,0,4),(25,'2024-02-05 19:22:46','camminando',NULL,'si impara',0,0,7),(25,'2024-02-05 19:45:38','l\'orsetto pooh','jp__2024_02_05__19_45_38.jpeg','e i suoi amici',1,0,18),(26,'2024-02-05 19:26:13','piume','luca__2024_02_05__19_26_13.jpeg','voleggianti',1,1,3),(26,'2024-02-05 22:11:40','c',NULL,'c',1,1,3),(27,'2024-02-05 19:28:36','gentile','pier__2024_02_05__19_28_36.jpeg','il coraggio ',0,0,6),(28,'2024-02-05 19:33:40','evviva cristo',NULL,'evviva cristo',0,0,8),(28,'2024-02-05 20:09:22','a',NULL,'a',0,0,2),(28,'2024-02-05 20:10:08','ss','w__2024_02_05__20_10_08.jpeg','qq',0,0,6);
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
INSERT INTO `scrittoda` VALUES (7,1),(16,1),(18,2),(25,2),(10,3),(1,4),(2,5),(9,6),(19,6),(3,7),(4,8),(5,9),(6,10),(8,11),(11,13),(12,14),(13,15),(14,16),(15,17),(17,19),(28,22),(29,23),(30,24);
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
INSERT INTO `segue` VALUES (26,28);
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
INSERT INTO `sottoscrive` VALUES (25,0),(26,0),(27,0),(28,0),(29,0),(30,0),(31,0),(25,1),(26,1),(27,1),(28,1),(29,1),(30,1),(31,1),(26,2),(28,2),(29,2),(28,3),(29,3),(25,4),(28,4),(28,5),(26,6),(28,6),(28,7);
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
INSERT INTO `tagperpost` VALUES (25,'2024-02-05 19:22:22',34),(25,'2024-02-05 19:22:46',34),(25,'2024-02-05 19:45:38',36),(25,'2024-02-05 19:45:38',37),(25,'2024-02-05 19:45:38',42),(25,'2024-02-05 19:45:38',43),(26,'2024-02-05 19:26:13',34),(26,'2024-02-05 19:26:13',35),(26,'2024-02-05 19:26:13',36),(26,'2024-02-05 22:11:40',37),(26,'2024-02-05 22:11:40',46),(26,'2024-02-05 22:11:40',47),(27,'2024-02-05 19:28:36',37),(27,'2024-02-05 19:28:36',38),(27,'2024-02-05 19:28:36',39),(28,'2024-02-05 19:33:40',37),(28,'2024-02-05 19:33:40',40),(28,'2024-02-05 19:33:40',41),(28,'2024-02-05 20:09:22',44),(28,'2024-02-05 20:10:08',45);
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
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (34,'qwe'),(35,'piuma'),(36,'leggero'),(37,'wsx'),(38,'piume'),(39,'coraggio'),(40,'cristo'),(41,'fede'),(42,'orsetto'),(43,'okForseNo'),(44,'er'),(45,'aa'),(46,'qaz'),(47,'edc');
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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utente`
--

LOCK TABLES `utente` WRITE;
/*!40000 ALTER TABLE `utente` DISABLE KEYS */;
INSERT INTO `utente` VALUES (7,'admin','admin@tecweb.it','$2y$10$3OlMvmQbXDETNgS8Mqdi6.nIi0ZRT88H0ud2JHL4hWZ3tC1VJcn12','65a25733abf6d_root.jpg',1,'System Admin',0),(25,'jp','JP@JP.com','$2y$10$t3O2zNr7s92.ZVid64YVauSHXRzGujEE2.WGvpj7avPYscqddBrDC','',0,NULL,0),(26,'luca','luca@luca.com','$2y$10$LTZ0SxXAMLV858ARZDn6tOG1tVvIw60SoGy59QJ5cBZ1GoeTsmZxS','',0,NULL,0),(27,'pier','pier@pier.com','$2y$10$F/96DUJGcVIKtaiqx4u.jeeXPgnLBD53wHQWwpxxcLRcKlLIcC7aq','',0,NULL,0),(28,'w','w@w.com','$2y$10$4FI7N9SpPcAJdVGWzjlCDuIQWJElTUeoeJyaMtYz88HrjWpyhocEC','65c12b3e1b754_sigillo1x_xl_zaky.jpg',0,'sono W',0),(29,'a','a@gmail.com','$2y$10$JnQSuCOFvCzSPYE2QLOWqusPSeAtN7Qh5NLVpZuWuAyqQIxp5ykkW','',0,NULL,0),(30,'p','p@gmail.com','$2y$10$tVNmplNU7jQhDmCeeg3PzOb7Rn8/H9ylM3fv6lG450.IGTnQCqSb2','',0,NULL,0),(31,'nome doppio','n@gmail.com','$2y$10$mXy4OZXdjxjz8NmJwYlY8etNEhZbv3jbJhNNknsmqjEtDic.mt/uy','',0,NULL,0);
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

-- Dump completed on 2024-02-06  9:32:46
