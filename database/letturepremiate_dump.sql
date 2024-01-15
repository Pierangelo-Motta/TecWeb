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
  UNIQUE KEY `ID_LIBRO_IND` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `libro`
--

LOCK TABLES `libro` WRITE;
/*!40000 ALTER TABLE `libro` DISABLE KEYS */;
INSERT INTO `libro` VALUES (0,'default'),(1,'Questo immenso non sapere'),(2,'Sacro minore'),(3,'L\\\' abito di piume'),(4,'Un buon posto in cui fermarsi'),(5,'L\'urlo'),(6,'Della gentilezza e del coraggio'),(7,'L\'uomo che cammina'),(8,'Fede e giustizia'),(9,'Kitchen'),(10,'Il primo caffè della giornata'),(11,'I miei giorni alla libreria Morisaki'),(12,'Le trecce d\'oro dei defunti'),(13,'Il gatto striato miagola tre volte'),(14,'Talenti non fondamentali'),(15,'Il libro di tutte le cose'),(16,'Geai'),(17,'Una parola dopo l\'altra'),(18,'Winnie Pooh'),(19,'Il magnifico studio fotografico di Hirasaka'),(22,'Libro');
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
  `id` int(8) NOT NULL,
  `dataOra` datetime NOT NULL,
  `descrizione` varchar(255) NOT NULL,
  `tipo` char(1) NOT NULL,
  `utenteId` int(8) NOT NULL,
  `utenteIdPost` int(1) DEFAULT NULL,
  `dataOraPost` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ID_NOTIFICA_IND` (`id`),
  UNIQUE KEY `dataOra` (`dataOra`,`descrizione`),
  UNIQUE KEY `dataOra_2` (`dataOra`,`descrizione`),
  KEY `REF_NOTIF_UTENT_IND` (`utenteId`),
  KEY `REF_NOTIF_POST_IND` (`utenteIdPost`,`dataOraPost`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifica`
--

LOCK TABLES `notifica` WRITE;
/*!40000 ALTER TABLE `notifica` DISABLE KEYS */;
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
INSERT INTO `post` VALUES (3,'2024-01-12 14:52:14','Ciò che si condivide si moltiplica','jacopo__2024_01_12__14_52_14.jpeg','Mi piace “l’intelligenza del dono”: è proprio, inspiegabilmente, così: “ciò che si condivide si moltiplica”. ',0,0,7),(3,'2024-01-12 15:04:12','Quando ti svegli la mattina, Puh, chiese infine Porcelletto, \"qual è la prima cosa che pensi?\". \"Che cosa c\'è per colazione?\" rispose Puh. \"E tu, Porcelletto?\". \"Io penso: chissà che cosa succederà oggi di emozionante?\" risposte Porcelletto. Puh annuì con','jacopo__2024_01_12__15_04_12.jpeg','La colazione allora è veramente la cosa più importante della giornata!',0,0,18),(3,'2024-01-14 21:57:45','\"Cosa vuoi diventare da grande, Thomas?\". E Thomas rispose: \"Felice. Voglio diventare felice\". Sembrò a tutti una buona idea.','jacopo__2024_01_14__21_57_45.jpeg','Thomas ha ragione',0,0,15),(3,'2024-01-15 22:15:44','cit',NULL,'pen',0,0,7),(4,'2024-01-12 23:31:18','Bellissimo libro',NULL,'Specie perchè eh',0,0,7),(8,'2024-01-14 16:25:01','Oh Rabbia!',NULL,'un\'imprecazione di qualità',0,0,18),(8,'2024-01-14 23:21:08','Stare allerta. Essere attenti. Con le antenne alzate. Ha usato proprio queste parole: con le antenne alzate. \"Abbandonarsi a sdilinquimento o autocommiserazione non è salutara! È necessario essere presenti!\"',NULL,'Mi piace perché mi ricorda che è necessario “essere presenti” per vivere al meglio le nostre giornate!',0,0,14),(8,'2024-01-14 23:23:35',NULL,'nuovo__2024_01_14__23_23_35.jpeg','Questa invece mi fa ridere un sacco. Dio sa le cose e non ce le dice ',0,0,13);
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
INSERT INTO `segue` VALUES (1,3),(2,3),(3,1),(3,4),(3,12),(4,3),(8,3),(8,12);
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
INSERT INTO `sottoscrive` VALUES (1,0),(2,0),(3,0),(4,0),(5,0),(6,0),(8,0),(9,0),(12,0),(1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(8,1),(9,1),(12,1),(3,2),(8,2),(8,3),(8,4),(8,5),(8,6);
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
INSERT INTO `tagperpost` VALUES (3,'2024-01-14 21:57:45',4),(3,'2024-01-14 21:57:45',5),(3,'2024-01-14 21:57:45',6),(3,'2024-01-15 22:15:44',10),(3,'2024-01-15 22:15:44',11),(3,'2024-01-15 22:15:44',12),(3,'2024-01-15 22:15:44',13),(8,'2024-01-14 23:21:08',7),(8,'2024-01-14 23:21:08',8),(8,'2024-01-14 23:23:35',9);
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (4,'voglioDiventareFelice'),(5,'felicità'),(6,'diventareGrandi'),(7,'esserePresenti'),(8,'antenneAlzate'),(9,''),(10,'cheBelLibro'),(11,'ciao'),(12,'come'),(13,'stai');
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
  `numeroFollow` int(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utente`
--

LOCK TABLES `utente` WRITE;
/*!40000 ALTER TABLE `utente` DISABLE KEYS */;
INSERT INTO `utente` VALUES (1,'pier','pier@tecweb.com','$2y$10$gFrPumcEaL5CcXvtGXM9xuMJXNf/UQ01qwAzFXR5XPwsPXbtJV.B6','65a25d1737bf9_Senza_nome.png',0,'Ciao, mi chiamo Pierangelo Motta',0,0),(2,'luca','luca@webtec.it','$2y$10$YU5cUJ4u1mijevPHw6/eA.HpBmhiy.V6b/GQ7Ft9XaYWsIuZKW7He','luca.png',0,'Ciao sono LUCA',0,0),(3,'jacopo','jacopo@webtec.it','$2y$10$42RzrrImDVkkEM3LsluT0ekx6hGZPWod7kTXa/S6.9dhct8TcxskS','659df9bbcb885_incisione.jpg',0,'',0,0),(4,'user1','user1@tecweb.it','$2y$10$xTlnGZDq.deb1ZDaJdrpT.G7amPo1OH74wWkkmX2upyGf1PDcdMeS','',0,NULL,0,0),(5,'sara','sara@tecweb.it','$2y$10$YuoPVQMqbSz390utkBmV6.Csh4aDxGO5fyALnG3/xhDbSGkOSunh.','',0,NULL,0,0),(6,'lory','lory.casa.it','$2y$10$pBfSQJJBR60xqPkhLqi5yuCZC2dagqhc56SPMmRI4qNoEgsfVbLgm','',0,NULL,1,0),(7,'admin','admin@tecweb.it','$2y$10$3OlMvmQbXDETNgS8Mqdi6.nIi0ZRT88H0ud2JHL4hWZ3tC1VJcn12','65a25733abf6d_root.jpg',1,'System Admin',0,0),(8,'nuovo','nuovo@gmail.com','$2y$10$qs0x5.a7igiKKM0fCanPneScTRY86bdlasZbQ65stwTYKysml9Oki','65a3fbb56505e_propic_nuovo.jpg',0,NULL,0,0),(9,'novo','novo@gmail.com','$2y$10$X66ClJRut7T1YW9uNfis8.pZan2NMowVRk5GW8L35lLLUidNlGEnu','',0,NULL,0,0),(12,'nnovo','nnovo@gmail.com','$2y$10$4yS10rMejYIxjZ8NW18WW.a3f6crGuglqgaSrPIQ93WFg1Xv5ZTFC','',0,NULL,0,0);
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

-- Dump completed on 2024-01-16  0:07:07
