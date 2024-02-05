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
  `id` int(8) NOT NULL,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ID_AUTORE_IND` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `autore`
--

LOCK TABLES `autore` WRITE;
/*!40000 ALTER TABLE `autore` DISABLE KEYS */;
INSERT INTO `autore` VALUES (0,'unknow'),(1,'Christian Bobin'),(2,'A.A. Milne'),(3,'Toshikazu Kawaguchi'),(4,'Chandra Candiani'),(5,'Franco Arminio'),(6,'Sanaka Hiiragi'),(7,'Banana Yoshimoto'),(8,'Matteo Bussola'),(9,'Tahar Ben Jelloun'),(10,'Gianrico Carofiglio'),(11,'Francesco Occhetta'),(13,'Satoshi Yagisawa'),(14,'Alan Bradley'),(15,'Flavia de Luce'),(16,'Elisa Rocchi'),(17,'Guus Kuijer'),(19,'Patricia MacLachlan');
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
INSERT INTO `commenti` VALUES (3,'0000-00-00 00:00:00',8,'2024-01-27 17:49:11','Ciao a tutti belli e brutti'),(3,'2024-01-25 19:16:18',1,'2024-02-01 01:29:08','Confermo 🥶'),(3,'2024-01-25 19:16:18',2,'2024-02-01 01:30:49','Come quando si esce di sti giorni... Bbrrr\n'),(3,'2024-01-25 19:16:18',2,'2024-02-01 01:31:39','A'),(3,'2024-01-25 19:16:18',2,'2024-02-01 01:32:48','B'),(3,'2024-01-25 19:16:18',8,'2024-02-01 01:19:07','Gelai tantissimo quando lessi questo libro!'),(3,'2024-01-26 15:44:57',8,'2024-01-27 17:50:20','qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq'),(3,'2024-01-26 15:44:57',8,'2024-01-27 17:53:03','wwwwwwwwwwwwwwwwwwwwwwwwwww'),(3,'2024-01-26 15:44:57',8,'2024-01-27 17:53:07','rrrrrrrrrrrrrrrrrrrrrrrrrrrr'),(3,'2024-02-03 00:46:57',3,'2024-02-03 02:47:33','aa'),(3,'2024-02-03 00:46:57',3,'2024-02-03 02:47:53','bb'),(3,'2024-02-03 00:46:57',3,'2024-02-03 02:48:52','cc'),(3,'2024-02-03 00:46:57',3,'2024-02-03 02:50:01','dd'),(3,'2024-02-03 00:46:57',3,'2024-02-03 02:53:28','gg'),(3,'2024-02-03 00:46:57',3,'2024-02-03 13:37:04','rr'),(8,'2024-01-27 17:34:41',3,'2024-01-30 22:59:56','WOW'),(8,'2024-01-27 17:34:41',3,'2024-02-01 22:01:08','l\'orsetto pooh spacca!'),(8,'2024-01-27 17:34:41',8,'2024-01-31 02:02:59','FIGHISSIMO'),(9,'0000-00-00 00:00:00',8,'2024-01-27 17:45:43','asdddd'),(9,'0000-00-00 00:00:00',8,'2024-01-27 17:45:45','sdssss'),(9,'0000-00-00 00:00:00',8,'2024-01-27 17:45:47','ewffff'),(14,'2024-01-25 02:17:36',3,'2024-01-30 23:59:57','Ciao a tutti'),(14,'2024-02-01 22:06:13',3,'2024-02-05 16:28:22','aaaa'),(18,'2024-01-26 02:26:48',3,'2024-01-31 00:33:43','Sante paroleSante paroleSante paroleSante paroleSante paroleSante paroleSante paroleSante paroleSante paroleGunaydin askim😘İyi geceler aşkım🥰Puoi visualizzare le clip come colonna singola, basta toccare l\'icona delle impostazioni sopraPuoi visualizzare le clip come colonna singola, basta toccare l\'icona delle impostazioni sopraSante paroleGunaydin askim😘Perché nel testo riportato sul libro la parola \"poesia\" è scritta poesia, Poesia( e POESIA? If the same fields was cultivate using crop rotation and not monoculture, maybe the harvest would be savedCIAO MONDO√3√3/2  Il cavaliere inesistente oppure \n                                               Il visconte dimezzato\nIl romanzo : La ragazza con l’orecchino di perla  di Tracy Chevalier\nPuoi visualizzare le clip come colonna singola, basta toccare l\'icona delle impostazioni sopraGli Appunti ora supportano le immagini e il testoSante parolePuoi visualizzare le clip come colonna singola, basta toccare l\'icona delle imopraSante parole'),(18,'2024-01-26 02:26:48',8,'2024-01-31 00:03:40','tanto coraggio');
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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `libro`
--

LOCK TABLES `libro` WRITE;
/*!40000 ALTER TABLE `libro` DISABLE KEYS */;
INSERT INTO `libro` VALUES (2,'Sacro minore'),(3,'L\' abito di piume'),(4,'Un buon posto in cui fermarsi'),(5,'L\'urlo'),(6,'Della gentilezza e del coraggio'),(7,'L\'uomo che cammina'),(8,'Fede e giustizia'),(9,'Kitchen'),(10,'Il primo caffè della giornata'),(11,'I miei giorni alla libreria Morisaki'),(12,'Le trecce d\'oro dei defunti'),(13,'Il gatto striato miagola tre volte'),(14,'Talenti non fondamentali'),(15,'Il libro di tutte le cose'),(16,'Geai'),(17,'Una parola dopo l\'altra'),(18,'Winnie Pooh'),(19,'Il magico studio fotografico di Hirasaka'),(22,'Libro'),(23,'L\\\'orlo del buratello'),(24,'L\\\'orso Yoghi');
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
) ENGINE=InnoDB AUTO_INCREMENT=214 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifica`
--

LOCK TABLES `notifica` WRITE;
/*!40000 ALTER TABLE `notifica` DISABLE KEYS */;
INSERT INTO `notifica` VALUES (117,'2024-01-26 00:56:24','V',3,2,'2024-01-25 19:16:18'),(120,'2024-01-26 01:00:46','V',3,2,'2024-01-25 15:27:40'),(123,'2024-01-26 01:00:56','V',3,2,'2024-01-25 15:28:13'),(124,'2024-01-26 01:00:59','V',13,2,'2024-01-24 23:21:41'),(125,'2024-01-26 01:01:00','V',13,2,'2024-01-24 23:21:17'),(136,'2024-01-26 01:01:26','V',3,2,'2024-01-24 23:06:22'),(137,'2024-01-26 01:01:28','V',8,2,'2024-01-24 22:14:33'),(138,'2024-01-26 01:25:26','F',17,2,'2024-01-26 01:25:26'),(141,'2024-01-26 02:50:54','V',8,18,'2024-01-24 22:14:33'),(142,'2024-01-26 02:51:11','V',3,8,'2024-01-26 02:21:36'),(144,'2024-01-26 15:43:48','F',2,3,'2024-01-26 15:43:48'),(145,'2024-01-26 15:43:49','F',2,3,'2024-01-26 15:43:49'),(148,'2024-01-27 15:39:45','K',3,7,'2024-01-26 02:21:16'),(149,'2024-01-27 15:39:46','V',3,7,'2024-01-26 02:21:16'),(150,'2024-01-31 00:32:18','V',8,3,'2024-01-27 17:34:41'),(151,'2024-01-31 00:42:14','V',13,3,'2024-01-24 23:21:17'),(152,'2024-01-31 00:48:24','K',13,8,'2024-01-24 23:21:06'),(153,'2024-01-31 00:48:25','V',13,8,'2024-01-24 23:20:57'),(154,'2024-01-31 00:48:26','K',13,8,'2024-01-24 23:21:17'),(155,'2024-01-31 02:04:34','V',8,3,'2024-01-24 22:14:33'),(156,'2024-01-31 02:04:35','K',14,3,'2024-01-25 02:17:36'),(157,'2024-01-31 02:10:11','K',20,20,'2024-01-31 02:09:20'),(158,'2024-01-31 02:10:12','V',20,20,'2024-01-31 02:09:20'),(159,'2024-01-31 02:18:16','K',8,20,'2024-01-27 17:34:41'),(160,'2024-01-31 02:18:18','V',8,20,'2024-01-27 17:34:41'),(161,'2024-01-31 02:18:20','K',3,20,'2024-01-26 15:44:57'),(162,'2024-01-31 02:18:21','V',3,20,'2024-01-26 15:44:57'),(163,'2024-01-31 02:18:23','K',18,20,'2024-01-26 02:26:48'),(164,'2024-01-31 02:18:25','V',18,20,'2024-01-26 02:26:48'),(165,'2024-01-31 02:18:27','K',3,20,'2024-01-26 02:21:36'),(166,'2024-01-31 02:18:28','V',3,20,'2024-01-26 02:21:36'),(167,'2024-01-31 02:18:30','K',3,20,'2024-01-26 02:21:16'),(168,'2024-01-31 02:18:31','V',3,20,'2024-01-26 02:21:16'),(169,'2024-01-31 02:18:32','K',16,20,'2024-01-25 19:23:41'),(170,'2024-01-31 02:18:36','V',16,20,'2024-01-25 19:23:41'),(171,'2024-01-31 02:18:38','K',3,20,'2024-01-25 19:16:18'),(172,'2024-01-31 02:18:39','V',3,20,'2024-01-25 19:16:18'),(173,'2024-01-31 02:18:41','K',3,20,'2024-01-25 15:30:10'),(174,'2024-01-31 02:18:42','V',3,20,'2024-01-25 15:30:10'),(175,'2024-01-31 02:18:45','K',3,20,'2024-01-25 15:29:28'),(176,'2024-01-31 02:18:46','V',3,20,'2024-01-25 15:29:28'),(177,'2024-01-31 02:18:47','K',3,20,'2024-01-25 15:28:41'),(178,'2024-01-31 02:18:48','V',3,20,'2024-01-25 15:28:41'),(179,'2024-01-31 02:18:50','K',3,20,'2024-01-25 15:28:13'),(180,'2024-01-31 02:18:51','V',3,20,'2024-01-25 15:28:13'),(181,'2024-02-01 01:16:03','F',19,3,'2024-02-01 01:16:03'),(183,'2024-02-03 00:15:33','F',5,1,'2024-02-03 00:15:33'),(184,'2024-02-03 00:15:34','F',5,1,'2024-02-03 00:15:34'),(185,'2024-02-03 00:15:36','F',5,1,'2024-02-03 00:15:36'),(186,'2024-02-03 00:15:36','F',5,1,'2024-02-03 00:15:36'),(187,'2024-02-03 00:15:36','F',5,1,'2024-02-03 00:15:36'),(188,'2024-02-03 00:15:37','F',5,1,'2024-02-03 00:15:37'),(189,'2024-02-03 00:15:37','F',5,1,'2024-02-03 00:15:37'),(190,'2024-02-03 00:15:37','F',5,1,'2024-02-03 00:15:37'),(191,'2024-02-03 00:15:38','F',5,1,'2024-02-03 00:15:38'),(192,'2024-02-03 00:15:38','F',5,1,'2024-02-03 00:15:38'),(193,'2024-02-03 00:15:38','F',5,1,'2024-02-03 00:15:38'),(194,'2024-02-03 00:15:39','F',5,1,'2024-02-03 00:15:39'),(195,'2024-02-03 00:15:39','F',5,1,'2024-02-03 00:15:39'),(196,'2024-02-03 00:15:39','F',5,1,'2024-02-03 00:15:39'),(197,'2024-02-03 00:15:39','F',5,1,'2024-02-03 00:15:39'),(198,'2024-02-03 00:15:40','F',5,1,'2024-02-03 00:15:40'),(199,'2024-02-03 00:15:40','F',5,1,'2024-02-03 00:15:40'),(201,'2024-02-03 02:53:28','C',3,NULL,'2024-02-03 00:46:57'),(202,'2024-02-03 12:05:47','F',3,21,'2024-02-03 12:05:47'),(203,'2024-02-03 13:37:04','C',3,NULL,'2024-02-03 00:46:57'),(204,'2024-02-03 16:42:33','C',3,NULL,'2024-01-25 19:23:41'),(205,'2024-02-03 23:31:46','F',3,21,'2024-02-03 23:31:46'),(206,'2024-02-04 00:00:56','K',3,8,'2024-02-03 19:09:05'),(207,'2024-02-04 11:55:47','C',24,NULL,'2024-02-03 18:44:23'),(208,'2024-02-05 11:02:50','K',3,24,'2024-02-03 00:46:57'),(209,'2024-02-05 11:03:08','K',14,3,'2024-02-01 22:06:13'),(210,'2024-02-05 14:58:59','K',1,3,'2024-02-03 00:12:16'),(211,'2024-02-05 14:59:21','K',3,24,'2024-02-03 19:09:05'),(212,'2024-02-05 14:59:22','V',3,24,'2024-02-03 19:09:05'),(213,'2024-02-05 16:28:22','C',3,NULL,'2024-02-01 22:06:13');
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
INSERT INTO `post` VALUES (1,'2024-02-03 00:12:16','a',NULL,'a',1,0,7),(3,'2024-01-23 23:35:40','Quando ti svegli la mattina, Puh, chiese infine Porcelletto, \"qual è la prima cosa che pensi?\". \"Che cosa c\'è per colazione?\" rispose Puh. \"E tu, Porcelletto?\". \"Io penso: chissà che cosa succederà oggi di emozionante?\" risposte Porcelletto. Puh annuì con','jacopo__2024_01_23__23_35_40.jpeg','La colazione allora è veramente la cosa più importante della giornata!',1,0,18),(3,'2024-01-24 18:57:51',NULL,'jacopo__2024_01_24__18_57_51.jpg','Che bel tramonto',1,1,16),(3,'2024-01-24 23:06:22','a','jacopo__2024_01_24__23_06_22.jpeg','a',0,1,2),(3,'2024-01-24 23:06:47','alfa','jacopo__2024_01_24__23_06_47.jpeg','betaa',0,0,0),(3,'2024-01-24 23:19:29','questo immenso',NULL,'non sapere',0,0,1),(3,'2024-01-25 15:27:40','prova1','jacopo__2024_01_25__15_27_40.jpeg','prova1',0,1,1),(3,'2024-01-25 15:28:13','prova2',NULL,'prova2',1,3,3),(3,'2024-01-25 15:28:41',NULL,'jacopo__2024_01_25__15_28_41.jpeg','prova3',1,1,16),(3,'2024-01-25 15:29:28','prova4','jacopo__2024_01_25__15_29_28.jpeg','prova4',1,2,8),(3,'2024-01-25 15:30:10','alfa','jacopo__2024_01_25__15_30_10.jpeg','omega',2,1,12),(3,'2024-01-25 19:16:18','Gelai','jacopo__2024_01_25__19_16_18.jpg','Frescai',1,3,16),(3,'2024-01-26 02:21:16','a','jacopo__2024_01_26__02_21_16.png','a',2,2,1),(3,'2024-01-26 02:21:36','a',NULL,'s',1,2,6),(3,'2024-01-26 15:44:57','a',NULL,'a',1,1,1),(3,'2024-02-01 22:08:53','immenso',NULL,'no',0,0,1),(3,'2024-02-02 23:33:43','pr1',NULL,'pr1',0,0,2),(3,'2024-02-03 00:46:57','a','jacopo__2024_02_03__00_46_57.png','a',1,0,9),(3,'2024-02-03 18:44:23','a',NULL,'b',0,0,2),(3,'2024-02-03 19:09:05','q',NULL,'w',2,1,18),(8,'2024-01-24 22:14:33','Questo',NULL,'immenso',1,4,1),(8,'2024-01-27 17:34:41','a',NULL,'a',1,2,18),(13,'2024-01-24 23:20:57','questo immens',NULL,'non sap',0,1,1),(13,'2024-01-24 23:21:06','ge',NULL,'ai',1,0,16),(13,'2024-01-24 23:21:17','pollo',NULL,'cotto',1,2,9),(13,'2024-01-24 23:21:41','l\'uomo',NULL,'che cammin',0,2,7),(13,'2024-02-02 23:34:00','pr1',NULL,'pr1',0,0,1),(13,'2024-02-02 23:34:32','pr2',NULL,'pr2',0,0,18),(13,'2024-02-02 23:35:14','pr3',NULL,'pr3',0,0,7),(13,'2024-02-02 23:36:39','primissimo',NULL,'kafè',0,0,10),(14,'2024-01-25 02:17:36','A','c2__2024_01_25__02_17_36.jpg','B',2,0,2),(14,'2024-02-01 22:05:53','yp',NULL,'ghi',0,0,24),(14,'2024-02-01 22:06:13','qqq',NULL,'eee',1,0,1),(16,'2024-01-25 19:23:41','a','c10_fi__2024_01_25__19_23_41.jpeg','a',1,1,6),(18,'2024-01-26 02:26:48','ci vuole un coraggio','nome doppio__2024_01_26__02_26_48.png','bestiale',1,1,6),(20,'2024-01-31 02:09:20','A mia immagine e somiglianza','paolo__2024_01_31__02_09_20.jpg','Certo che rispetto al nostro creatore siamo migliorati',1,1,0);
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
INSERT INTO `scrittoda` VALUES (7,1),(16,1),(18,2),(10,3),(1,4),(2,5),(9,6),(19,6),(3,7),(4,8),(5,9),(6,10),(8,11),(11,13),(12,14),(13,15),(14,16),(15,17),(17,19);
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
INSERT INTO `segue` VALUES (3,1),(3,8),(3,16),(5,1),(8,1),(8,3),(14,3),(17,2),(19,3);
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
INSERT INTO `sottoscrive` VALUES (1,0),(2,0),(3,0),(4,0),(5,0),(6,0),(8,0),(9,0),(12,0),(13,0),(14,0),(15,0),(16,0),(17,0),(18,0),(19,0),(20,0),(21,0),(22,0),(23,0),(24,0),(1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(8,1),(9,1),(12,1),(13,1),(14,1),(15,1),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1),(22,1),(23,1),(24,1),(3,2),(13,2),(17,2),(13,3),(17,3),(13,4),(3,5),(13,5),(3,6),(13,6);
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
INSERT INTO `tagperpost` VALUES (1,'2024-02-03 00:12:16',10),(3,'2024-01-24 23:06:22',3),(3,'2024-01-24 23:06:47',4),(3,'2024-01-25 15:27:40',5),(3,'2024-01-25 15:28:13',6),(3,'2024-01-25 15:29:28',5),(3,'2024-01-25 15:29:28',6),(3,'2024-01-25 15:29:28',7),(3,'2024-01-25 15:29:28',8),(3,'2024-01-25 15:30:10',5),(3,'2024-01-25 15:30:10',6),(3,'2024-01-25 15:30:10',7),(3,'2024-01-25 15:30:10',8),(3,'2024-01-25 19:16:18',9),(3,'2024-01-26 02:21:16',10),(3,'2024-01-26 02:21:36',11),(3,'2024-02-01 22:08:53',10),(3,'2024-02-01 22:08:53',18),(3,'2024-02-01 22:08:53',19),(3,'2024-02-01 22:08:53',20),(3,'2024-02-01 22:08:53',21),(3,'2024-02-01 22:08:53',22),(3,'2024-02-01 22:08:53',23),(3,'2024-02-03 18:44:23',17),(3,'2024-02-03 19:09:05',32),(8,'2024-01-24 22:14:33',2),(8,'2024-01-27 17:34:41',10),(13,'2024-02-02 23:34:32',10),(13,'2024-02-02 23:35:14',24),(13,'2024-02-02 23:35:14',25),(13,'2024-02-02 23:35:14',26),(13,'2024-02-02 23:35:14',27),(13,'2024-02-02 23:35:14',28),(13,'2024-02-02 23:36:39',29),(13,'2024-02-02 23:36:39',30),(13,'2024-02-02 23:36:39',31),(14,'2024-02-01 22:05:53',14),(14,'2024-02-01 22:05:53',15),(14,'2024-02-01 22:05:53',16),(14,'2024-02-01 22:06:13',14),(14,'2024-02-01 22:06:13',17),(16,'2024-01-25 19:23:41',10),(20,'2024-01-31 02:09:20',12),(20,'2024-01-31 02:09:20',13);
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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (2,'nonSapere'),(3,'c'),(4,'gamma'),(5,'prova1'),(6,'prova2'),(7,'prova3'),(8,'prova4'),(9,'tantoFrio'),(10,'a'),(11,'d'),(12,'Alieni'),(13,'dio'),(14,'qwe'),(15,'qwr'),(16,'qwt'),(17,'qaz'),(18,'a\''),(19,'a{'),(20,'a_'),(21,'a*'),(22,'a£'),(23,'aò'),(24,'che'),(25,'figo'),(26,'di'),(27,'libro'),(28,'che_figo_di_libro'),(29,'il'),(30,'primo'),(31,'c_a'),(32,'plm');
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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utente`
--

LOCK TABLES `utente` WRITE;
/*!40000 ALTER TABLE `utente` DISABLE KEYS */;
INSERT INTO `utente` VALUES (1,'pier','pier@tecweb.com','$2y$10$gFrPumcEaL5CcXvtGXM9xuMJXNf/UQ01qwAzFXR5XPwsPXbtJV.B6','65a25d1737bf9_Senza_nome.png',0,'Ciao, mi chiamo Pierangelo Motta',0),(2,'luca','luca@webtec.it','$2y$10$YU5cUJ4u1mijevPHw6/eA.HpBmhiy.V6b/GQ7Ft9XaYWsIuZKW7He','luca.png',0,'Ciao sono LUCA',0),(3,'jacopo','jacopo@webtec.it','$2y$10$J.Rq0Lo1Copo.zN9QLSUtuZMWFWPPOEx8g77.aMBMxBJkfyist3xW','65bc09b850eeb_17068220641977962036564689073481.jpg',1,'ciao a tutti sono Jacopo, studente di 3 anno di Ingegneria e Scienze Informatiche. Non mi fa impazzire leggere libri, ma rimango sempre affascinato da',0),(4,'user1','user1@tecweb.it','$2y$10$xTlnGZDq.deb1ZDaJdrpT.G7amPo1OH74wWkkmX2upyGf1PDcdMeS','',0,NULL,0),(5,'sara','sara@tecweb.it','$2y$10$YuoPVQMqbSz390utkBmV6.Csh4aDxGO5fyALnG3/xhDbSGkOSunh.','',0,NULL,0),(6,'lory','lory.casa.it','$2y$10$pBfSQJJBR60xqPkhLqi5yuCZC2dagqhc56SPMmRI4qNoEgsfVbLgm','',0,NULL,1),(7,'admin','admin@tecweb.it','$2y$10$3OlMvmQbXDETNgS8Mqdi6.nIi0ZRT88H0ud2JHL4hWZ3tC1VJcn12','65a25733abf6d_root.jpg',1,'System Admin',0),(8,'nuovo','nuovo@gmail.com','$2y$10$qs0x5.a7igiKKM0fCanPneScTRY86bdlasZbQ65stwTYKysml9Oki','65a3fbb56505e_propic_nuovo.jpg',0,NULL,0),(9,'novo','novo@gmail.com','$2y$10$X66ClJRut7T1YW9uNfis8.pZan2NMowVRk5GW8L35lLLUidNlGEnu','',0,NULL,0),(12,'nnovo','nnovo@gmail.com','$2y$10$4yS10rMejYIxjZ8NW18WW.a3f6crGuglqgaSrPIQ93WFg1Xv5ZTFC','',0,NULL,0),(13,'c1','c1@gmail.com','$2y$10$TS94P3bchfpJYoRh2CaBAO4x4YEnhWeE.UjjqA5v6iw185pUrECLa','',0,NULL,0),(14,'c2','c2@gmial.com','$2y$10$bLhcbcWxgEwf93LL2JdvBudQohp9pXzOQIa2tCQ2w54FEgn1yMV9a','',0,NULL,0),(15,'123456789123456789','12@gmail.com','$2y$10$iLsSkuX2xojLyNnFF6UQduSvftkzXdORiZNNZpUrWrRajzgEd/Yoy','',0,NULL,0),(16,'c10_fi','c10@g','$2y$10$vBNkux6VusA5SCIP4GJav.HDaN7Jja5LMCXOoAJZ0IuSiESa7QMEO','',0,NULL,0),(17,'simo99','simofigo99@gmail.cum','$2y$10$Hm5IZMb05BBkteoeuz9Vv.14oTEK1Xm/1M27RgzSAJ/oJFkZd.z4q','',0,NULL,0),(18,'nome doppio','nome@a','$2y$10$YxAjYLdrGY4sqRdMfZSQ7Om6LiFL1ZBky5xlZYYyeijbbcWBxkBMC','65b30fd9103ca_Immagine.png',0,'ciao sono l\'utente che ha il nome doppio ahahah',0),(19,'ho un nome molto lungo lunghissimo','a@gmail.com','$2y$10$0p7BbewSWxQTcs2PTLJHhuklmX19qWQOQek8OoYoemxsYS2iFV8R2','',0,NULL,0),(20,'paolo','redpps@libero.it','$2y$10$.4tLF90LdeknyIVBUb.tSulUCbcoyoSJAhKv/FdApKCsV3nC968sW','65b99f68de222_alieno_icona.bmp',0,'Sono bello',0),(21,'carmelinalab','carmelinalab@libero.it','$2y$10$6C.jVvW88n48ZotTtZMnFeHlzqLIHqtexN5BfSa5Zb9KBzsJvBT/m','',0,NULL,0),(22,'a','a@gmail.com','$2y$10$cfVHGrrqlAIZP9omb1TJQOX7eXJvyAWv05orEN7pGz/yFOH5RZMwO','',0,NULL,0),(23,'b','b@gmail.com','$2y$10$rLcdFjuvDk1THJgg2fFtneMqDr.nGCkkziGHKJ0mndc9ZC8CQFmC6','',0,NULL,0),(24,'bb','bb@gmail.com','$2y$10$QjSrRFXUQ4jOSg5Rfe2kn.VeVp5EQu1H2TLYHjMaP2YT/6J3jtR5K','',0,NULL,0);
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

-- Dump completed on 2024-02-05 17:23:02
