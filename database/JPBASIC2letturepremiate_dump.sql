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
INSERT INTO `autore` VALUES (0,'unknow'),(1,'Christian Bobin'),(2,'A.A. Milne'),(3,'Toshikazu Kawaguchi');
/*!40000 ALTER TABLE `autore` ENABLE KEYS */;
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
INSERT INTO `compone` VALUES (0,10007),(1,10007),(1,10010),(1,10018),(2,10018);
/*!40000 ALTER TABLE `compone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `libro`
--

DROP TABLE IF EXISTS `libro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `libro` (
  `id` int(8) NOT NULL,
  `titolo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ID_LIBRO_IND` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `libro`
--

LOCK TABLES `libro` WRITE;
/*!40000 ALTER TABLE `libro` DISABLE KEYS */;
INSERT INTO `libro` VALUES (0,'default1'),(10007,'L\'uomo che cammina'),(10010,'Il primo caffè della giornata'),(10018,'Winnie Puh');
/*!40000 ALTER TABLE `libro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medagliere`
--

DROP TABLE IF EXISTS `medagliere`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medagliere` (
  `id` int(8) NOT NULL,
  `titolo` varchar(255) NOT NULL,
  `descrizione` varchar(1023) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Un nuovo medagliere ti aspetta!',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ID_MEDAGLIERE_IND` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medagliere`
--

LOCK TABLES `medagliere` WRITE;
/*!40000 ALTER TABLE `medagliere` DISABLE KEYS */;
INSERT INTO `medagliere` VALUES (0,'Benvenuto!','Ti diamo il benvenuto nel nostro social con questo primissimo medagliere facilissimo da completare, infatti ti basterà leggere soltanto 1 libro. Vedi qui sotto per scoprire quale!'),(1,'Continua così!','Se ti è piaciuta la scorsa sfida, sicuramente amerai anche questa! Ti sfidiamo ad arricchire il medagliere di benvenuto leggendo questi nuovi 2 libri!'),(2,'debug1','debug1debug1debug1');
/*!40000 ALTER TABLE `medagliere` ENABLE KEYS */;
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
INSERT INTO `post` VALUES (3,'2024-01-11 16:53:44','Esercitarsi a non sapere e a meravigliarsi','jacopo__2024_01_11__16_53_44.jpeg','Leggendo questa frase ho meditato su quanto fosse importante questo banale aspetto della vita che ci permette di essere felici con poco e che non lo si dà così per scontato',0,0,0),(3,'2024-01-11 16:54:38','al mio funerale vengano un sacco di animali, che gli umani restino a bocca aperta, spinti di qua e di là da un bel gruppetto folto di animali','jacopo__2024_01_11__16_54_38.jpeg','Questa mi è piaciuta perché vorrei che il mio funerale fosse così!',0,0,0),(3,'2024-01-11 16:57:33','Una buona pratica, preliminare a qualunque altra, è la pratica della meraviglia. La pratica della meraviglia è una pratica che cura anche il cuore più ferito della terra',NULL,'Mi è piaciuta perché vorrei imparare la pratica della meraviglia',0,0,0),(3,'2024-01-11 16:58:32',NULL,'jacopo__2024_01_11__16_58_32.jpeg','Mi è piaciuta perché così non dimentico le persone a cui volevo bene e che non sono più qui',0,0,0),(3,'2024-01-11 22:36:18','aa','jacopo__2024_01_11__22_36_18.jpeg','aa',0,0,0),(3,'2024-01-12 14:52:14','Ciò che si condivide si moltiplica','jacopo__2024_01_12__14_52_14.jpeg','Mi piace “l’intelligenza del dono”: è proprio, inspiegabilmente, così: “ciò che si condivide si moltiplica”. ',0,0,10007),(3,'2024-01-12 15:04:12','Quando ti svegli la mattina, Puh, chiese infine Porcelletto, \"qual è la prima cosa che pensi?\". \"Che cosa c\'è per colazione?\" rispose Puh. \"E tu, Porcelletto?\". \"Io penso: chissà che cosa succederà oggi di emozionante?\" risposte Porcelletto. Puh annuì con','jacopo__2024_01_12__15_04_12.jpeg','La colazione allora è veramente la cosa più importante della giornata!',0,0,10018);
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
INSERT INTO `scrittoda` VALUES (10007,1),(10018,2),(10010,3);
/*!40000 ALTER TABLE `scrittoda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sottoscrive`
--

DROP TABLE IF EXISTS `sottoscrive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sottoscrive` (
  `utenteId` char(1) NOT NULL,
  `medagliereId` int(8) NOT NULL,
  PRIMARY KEY (`medagliereId`,`utenteId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sottoscrive`
--

LOCK TABLES `sottoscrive` WRITE;
/*!40000 ALTER TABLE `sottoscrive` DISABLE KEYS */;
INSERT INTO `sottoscrive` VALUES ('3',0),('3',1),('3',2);
/*!40000 ALTER TABLE `sottoscrive` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-01-12 15:32:23
