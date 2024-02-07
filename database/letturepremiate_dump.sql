-- MySQL dump 10.13  Distrib 8.0.36, for Linux (x86_64)
--
-- Host: localhost    Database: letturepremiate
-- ------------------------------------------------------
-- Server version	8.0.36-0ubuntu0.22.04.1

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
-- Table structure for table `autore`
--

DROP TABLE IF EXISTS `autore`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `autore` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ID_AUTORE_IND` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `autore`
--

LOCK TABLES `autore` WRITE;
/*!40000 ALTER TABLE `autore` DISABLE KEYS */;
INSERT INTO `autore` VALUES (1,'Chandra Candiani'),(2,'A.A. Milne'),(3,'Flavia de Luce'),(4,'Matteo Bussola'),(5,'Banana Yoshimoto'),(6,'Stacey Halls'),(7,'Franco Faggiani '),(8,'Lucy Foley'),(9,'Michael Connelly'),(10,'Carsten Henn'),(11,'Brianna Wiest'),(12,'Andrea Camilleri'),(13,'Antonio Manzini'),(14,'Andre Agassi'),(15,'Marco Masetti'),(16,'Marco Belinelli'),(17,'Kobe Bryant'),(18,'Francesco Totti'),(19,'Dante Alighieri'),(20,'Alessandro Manzoni'),(21,'Luigi Pirandello'),(22,'Giovanni Boccaccio'),(23,'Giovanni Verga'),(24,'Lev Nikolaevic Tolstoj'),(25,'Franz Kafka'),(26,'Italo Calvino'),(27,'Herman Melville'),(28,'Fedor Michajlovic Dostoevskij'),(29,'Dino Buzzati'),(30,'Thomas Mann'),(31,'Ken Follett'),(32,'Marguerite Yourcenar'),(33,'Gabriel García Márquez'),(34,'Marcel Proust'),(35,'José Saramago'),(36,'Gustave Flaubert'),(37,'Gunter Grass'),(38,'Johann Wolfgang Goethe'),(39,'Patrick Suskind'),(40,'Herman Hesse'),(41,'Jane Austen'),(42,'George Orwell'),(43,'J. K. Rowling');
/*!40000 ALTER TABLE `autore` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commenti`
--

DROP TABLE IF EXISTS `commenti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `commenti` (
  `utenteIdPost` int NOT NULL,
  `dataOraPost` datetime NOT NULL,
  `utenteIdComm` int NOT NULL,
  `dataOraComm` datetime NOT NULL,
  `commento` varchar(1023) COLLATE utf8mb4_general_ci NOT NULL,
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
INSERT INTO `commenti` VALUES (8,'2024-02-06 20:37:33',12,'2024-02-06 20:37:56','bellissimo'),(8,'2024-02-06 20:37:33',15,'2024-02-06 21:48:07','aa'),(8,'2024-02-06 20:38:47',15,'2024-02-06 21:50:36','a'),(10,'2024-02-06 11:38:54',12,'2024-02-06 17:59:53','bellissimo'),(12,'2024-02-06 20:59:35',15,'2024-02-06 21:53:08','a'),(13,'2024-02-06 18:06:33',12,'2024-02-06 18:06:54','bello');
/*!40000 ALTER TABLE `commenti` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compone`
--

DROP TABLE IF EXISTS `compone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `compone` (
  `medagliereId` int NOT NULL,
  `libroId` int NOT NULL,
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
INSERT INTO `compone` VALUES (1,1),(2,1),(2,2),(2,3),(3,5),(4,3),(5,2),(5,5),(6,1),(6,2),(6,3),(6,4),(6,5),(7,6),(7,7),(7,8),(7,9),(7,10),(7,11),(8,12),(8,13),(8,14),(8,15),(8,16),(9,17),(9,18),(9,19),(9,20),(10,21),(10,22),(10,23),(10,24),(10,25),(11,26),(11,27),(11,28),(11,29),(11,30),(12,38),(12,40),(12,42),(12,43),(12,46),(12,48),(13,28),(13,31),(13,32),(13,33),(13,34),(13,35),(13,36),(13,37),(13,39),(13,41),(13,44),(13,45),(13,47),(13,49),(13,50),(13,51),(13,52),(13,53),(13,54),(14,55),(14,56),(14,57),(14,58),(14,59),(14,60),(14,61),(14,62);
/*!40000 ALTER TABLE `compone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `libro`
--

DROP TABLE IF EXISTS `libro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `libro` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titolo` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ID_LIBRO_IND` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `libro`
--

LOCK TABLES `libro` WRITE;
/*!40000 ALTER TABLE `libro` DISABLE KEYS */;
INSERT INTO `libro` VALUES (1,'Questo immenso non sapere'),(2,'Winnie Puh'),(3,'Il gatto striato miagola tre volte'),(4,'Un buon posto in cui fermarsi'),(5,'L\'abito di piume'),(6,'Mrs England'),(7,'La manutenzione dei sensi'),(8,'L\'appartamento a Parigi'),(9,'Il giorno dell\'innocenza. Un\'indagine di Haller e Bosch'),(10,'L\'uomo che portava a spasso i libri'),(11,'L\'anno che cambierà la tua vita. 365 giorni per diventare la persona che vorresti essere'),(12,'La forma dell\'acqua'),(13,'Il cane di terracotta'),(14,'La voce del violino'),(15,'La gita a Tindari'),(16,'La vampa d\'agosto'),(17,'Pista nera'),(18,'La costola di Adamo'),(19,'Non è stagione'),(20,'Era di Maggio'),(21,'Open. La mia storia'),(22,'Valentino Rossi. Mi sono divertito'),(23,'Pokerface. Da San Giovanni in Persiceto al titolo NBA'),(24,'The Mamba mentality. Il mio basket'),(25,'Un capitano'),(26,'Divina Commedia'),(27,'I promessi sposi'),(28,'Uno, nessuno e centomila'),(29,'Decameron'),(30,'I Malavoglia'),(31,'Guerra e pace'),(32,'Il Processo'),(33,'Il barone rampante'),(34,'Moby Dick'),(35,'Delitto e castigo'),(36,'Il deserto dei Tartari'),(37,'La montagna incantata'),(38,'I pilastri della Terra'),(39,'Memorie di Adriano'),(40,'Le armi della luce'),(41,'Cent\'anni di solitudine'),(42,'La caduta dei giganti'),(43,'Mondo senza fine'),(44,'Alla ricerca del tempo perduto'),(45,'Cecità'),(46,'Per niente al mondo'),(47,'L\'educazione sentimentale'),(48,' La colonna di fuoco'),(49,'Il tamburo di latta'),(50,'Le affinità elettive'),(51,'Il Profumo'),(52,'Narciso e Boccadoro'),(53,'Orgoglio e pregiudizio'),(54,'1984'),(55,'Harry Potter e la pietra filosofale'),(56,'Harry Potter e la camera dei segreti'),(57,'Harry Potter e il prigioniero di Azkaban'),(58,'Harry Potter e il calice di fuoco'),(59,'Harry Potter e l\'Ordine della Fenice'),(60,'Harry Potter e il Principe Mezzosangue'),(61,'Harry Potter e i doni della morte'),(62,'Harry Potter e la maledizione dell\'erede');
/*!40000 ALTER TABLE `libro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medagliere`
--

DROP TABLE IF EXISTS `medagliere`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `medagliere` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titolo` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `descrizione` varchar(800) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Un nuovo medagliere ti aspetta!',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ID_MEDAGLIERE_IND` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medagliere`
--

LOCK TABLES `medagliere` WRITE;
/*!40000 ALTER TABLE `medagliere` DISABLE KEYS */;
INSERT INTO `medagliere` VALUES (1,'Benvenuto!','Ti diamo il benvenuto nel nostro social con questo primissimo medagliere facilissimo da completare, infatti ti basterà leggere soltanto 1 libro. Vedi qui sotto per scoprire quale!'),(2,'Continua così!','Se ti è piaciuta la scorsa sfida, sicuramente amerai anche questa! Ti sfidiamo ad arricchire il medagliere di benvenuto leggendo questi nuovi 2 libri!'),(3,'Intro all\'oriente','Vieni con noi a visitare l\'oriente! Leggi questo libro per iniziare l\'avventura!'),(4,'test 1','test 1'),(5,'test2','test dell\'anno'),(6,'Iscritti gennaio 2024','Un nuovo medagliere ti aspetta!'),(7,'Best sellers 2022 1','Alcuni dei best-sellers del 2022: vediamo se riesci a leggerli tutti!'),(8,'Gialli di Camilleri - parte 1','Alcuni imperdibili gialli di Camilleri'),(9,'Gialli di Manzini - parte 1','Imperdibili gialli di Manzini con Schiavone come protagonista'),(10,'Biografie sportive','Alcune delle migliori biografie sportive'),(11,'Chicche di scuola 1','Un piccolo medagliere dedicato ai libri più famosi che si conoscono sui banchi di scuola ma che ce li ricorderemo per tutta la vita'),(12,'Best of Ken Follett','Alcuni tra i migliori libri di Ken Follett'),(13,'Mondadori: gli \"assolutamente dai leggere\"','Un medaglia difficile da ottenere, ma secondo \"Mondadori\" questa è una collezione di libri assolutamente da leggere!'),(14,'Harry Potter','Tutti i libri di Harry Potter');
/*!40000 ALTER TABLE `medagliere` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifica`
--

DROP TABLE IF EXISTS `notifica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifica` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dataOra` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tipo` char(1) COLLATE utf8mb4_general_ci NOT NULL,
  `utenteId` int NOT NULL,
  `utenteIdPost` int DEFAULT NULL,
  `dataOraPost` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ID_NOTIFICA_IND` (`id`),
  KEY `REF_NOTIF_UTENT_IND` (`utenteId`),
  KEY `REF_NOTIF_POST_IND` (`utenteIdPost`,`dataOraPost`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifica`
--

LOCK TABLES `notifica` WRITE;
/*!40000 ALTER TABLE `notifica` DISABLE KEYS */;
INSERT INTO `notifica` VALUES (1,'2024-02-05 23:21:22','F',8,9,'2024-02-05 23:21:22'),(2,'2024-02-05 23:22:37','F',9,8,'2024-02-05 23:22:37'),(6,'2024-02-05 23:25:30','C',9,8,'2024-02-05 23:22:27'),(7,'2024-02-05 23:25:40','C',9,8,'2024-02-05 23:22:27'),(8,'2024-02-05 23:29:04','C',9,8,'2024-02-05 23:22:27'),(9,'2024-02-06 08:35:50','C',9,8,'2024-02-05 23:22:27'),(10,'2024-02-06 09:35:16','F',9,10,'2024-02-06 09:35:16'),(12,'2024-02-06 11:37:34','F',10,8,'2024-02-06 11:37:34'),(13,'2024-02-06 17:59:27','F',10,12,'2024-02-06 17:59:27'),(14,'2024-02-06 17:59:41','K',10,12,'2024-02-06 11:38:54'),(15,'2024-02-06 17:59:53','C',10,12,'2024-02-06 11:38:54'),(16,'2024-02-06 18:06:54','C',13,12,'2024-02-06 18:06:33'),(17,'2024-02-06 18:06:59','K',13,12,'2024-02-06 18:06:33'),(18,'2024-02-06 18:13:26','K',13,14,'2024-02-06 18:06:33'),(19,'2024-02-06 20:35:03','V',10,12,'2024-02-06 11:38:54'),(20,'2024-02-06 20:35:33','F',11,8,'2024-02-06 20:35:33'),(21,'2024-02-06 20:35:33','F',11,8,'2024-02-06 20:35:33'),(22,'2024-02-06 20:35:33','F',11,8,'2024-02-06 20:35:33'),(23,'2024-02-06 20:35:33','F',11,8,'2024-02-06 20:35:33'),(24,'2024-02-06 20:35:33','F',11,8,'2024-02-06 20:35:33'),(25,'2024-02-06 20:35:33','F',11,8,'2024-02-06 20:35:33'),(26,'2024-02-06 20:35:34','F',11,8,'2024-02-06 20:35:34'),(27,'2024-02-06 20:35:34','F',11,8,'2024-02-06 20:35:34'),(28,'2024-02-06 20:35:35','F',11,8,'2024-02-06 20:35:35'),(29,'2024-02-06 20:35:36','F',11,8,'2024-02-06 20:35:36'),(30,'2024-02-06 20:35:36','F',11,8,'2024-02-06 20:35:36'),(31,'2024-02-06 20:35:37','F',11,8,'2024-02-06 20:35:37'),(32,'2024-02-06 20:35:37','F',11,8,'2024-02-06 20:35:37'),(33,'2024-02-06 20:35:37','F',11,8,'2024-02-06 20:35:37'),(34,'2024-02-06 20:35:38','F',11,8,'2024-02-06 20:35:38'),(35,'2024-02-06 20:35:39','F',11,8,'2024-02-06 20:35:39'),(36,'2024-02-06 20:37:47','K',8,12,'2024-02-06 20:37:33'),(37,'2024-02-06 20:37:56','C',8,12,'2024-02-06 20:37:33'),(38,'2024-02-06 20:41:39','V',10,8,'2024-02-06 11:38:54'),(39,'2024-02-06 20:44:47','F',15,8,'2024-02-06 20:44:47'),(40,'2024-02-06 20:48:38','K',8,12,'2024-02-06 20:38:47'),(43,'2024-02-06 20:48:57','F',8,12,'2024-02-06 20:48:57'),(44,'2024-02-06 20:54:41','V',13,15,'2024-02-06 18:06:33'),(45,'2024-02-06 21:48:07','C',8,15,'2024-02-06 20:37:33'),(46,'2024-02-06 21:48:19','C',8,15,'2024-02-06 20:38:47'),(47,'2024-02-06 21:48:21','C',8,15,'2024-02-06 20:38:47'),(48,'2024-02-06 21:48:36','C',8,15,'2024-02-06 20:38:47'),(49,'2024-02-06 21:48:47','C',8,15,'2024-02-06 20:38:47'),(50,'2024-02-06 21:49:22','C',8,15,'2024-02-06 20:38:47'),(51,'2024-02-06 21:50:36','C',8,15,'2024-02-06 20:38:47'),(52,'2024-02-06 21:51:09','C',12,15,'2024-02-06 20:59:35'),(53,'2024-02-06 21:51:25','C',12,15,'2024-02-06 20:59:35'),(54,'2024-02-06 21:51:32','C',12,15,'2024-02-06 20:59:35'),(55,'2024-02-06 21:53:05','C',12,15,'2024-02-06 20:59:35'),(56,'2024-02-06 21:53:08','C',12,15,'2024-02-06 20:59:35'),(57,'2024-02-06 21:56:07','C',9,8,'2024-02-05 23:22:27'),(58,'2024-02-06 21:56:11','C',9,8,'2024-02-05 23:22:27'),(59,'2024-02-06 21:56:17','C',9,8,'2024-02-05 23:22:27'),(60,'2024-02-06 21:56:20','C',9,8,'2024-02-05 23:22:27'),(61,'2024-02-06 21:56:32','C',9,8,'2024-02-05 23:22:27'),(62,'2024-02-06 21:56:36','C',9,8,'2024-02-05 23:22:27'),(63,'2024-02-06 21:56:42','C',9,8,'2024-02-05 23:22:27'),(64,'2024-02-06 21:56:58','C',9,8,'2024-02-05 23:22:27'),(65,'2024-02-06 21:57:34','C',9,8,'2024-02-05 23:22:27'),(66,'2024-02-06 21:57:48','C',9,8,'2024-02-05 23:22:27'),(67,'2024-02-06 22:01:32','C',9,8,'2024-02-05 23:22:27'),(68,'2024-02-06 22:01:42','C',9,8,'2024-02-05 23:22:27'),(69,'2024-02-06 22:01:47','C',9,8,'2024-02-05 23:22:27'),(70,'2024-02-06 22:03:28','C',9,8,'2024-02-05 23:22:27'),(71,'2024-02-06 22:20:24','K',10,15,'2024-02-06 22:19:49'),(72,'2024-02-06 22:20:33','F',10,15,'2024-02-06 22:20:33'),(73,'2024-02-06 23:23:08','F',15,10,'2024-02-06 23:23:08');
/*!40000 ALTER TABLE `notifica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `post` (
  `utenteId` int NOT NULL,
  `dataOra` datetime NOT NULL,
  `citazioneTestuale` varchar(1023) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fotoCitazione` varchar(127) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `riflessione` varchar(2047) COLLATE utf8mb4_general_ci NOT NULL,
  `counterMiPiace` int NOT NULL,
  `counterAdoro` int NOT NULL,
  `libroId` int NOT NULL,
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
INSERT INTO `post` VALUES (8,'2024-02-06 20:37:33','miao','jp__2024_02_06__20_37_33.jpeg','miao',1,0,3),(8,'2024-02-06 20:38:47','a','jp__2024_02_06__20_38_47.jpeg','a',1,0,2),(8,'2024-02-06 22:59:57','c',NULL,'c',0,0,7),(9,'2024-02-05 23:22:27','a',NULL,'a',0,0,1),(10,'2024-02-06 11:38:54','immenso','pier__2024_02_06__11_38_54.jpeg','grandissimo',1,2,1),(10,'2024-02-06 21:59:30','tutti!','pier__2024_02_06__21_59_30.jpg','e riflettere',0,0,4),(10,'2024-02-06 22:19:49','struggente romanzo,','pier__2024_02_06__22_19_49.jpg','Il titolo originale del romanzo \"Hagoromo\" (letteralmente: abito di piume) indica un particolare tipo di kimono leggerissimo con dei lunghi nastri indossato dalle tennyo, sorta di donne-angelo, che serviva per volare tra il mondo terreno e l\'aldilà. Il ritorno di Hotaru, la protagonista di questo struggente romanzo, nel paese natale rappresenta il suo hagoromo, un vestito che le permette di librarsi in volo alleggerita dal dolore per la perdita della persona amata',1,0,5),(10,'2024-02-06 23:15:31','Semisepolto in mezzo a una pista sciistica sopra Champoluc, in Val d\'Aosta, viene rinvenuto un cadavere. Sul corpo è passato un cingolato in uso per spianare la neve, smembrandolo e rendendolo irriconoscibile','pier__2024_02_06__23_15_31.jpg','Intrigante lettura',0,0,17),(10,'2024-02-06 23:20:21','Il primo omicidio letterario in terra di mafia della seconda repubblica','pier__2024_02_06__23_20_21.jpg','Libro intrigante, coinvolgente, di una Sicilia che affascina e fa riflettere.',0,0,12),(10,'2024-02-06 23:28:34',' \"E, di colpo, si sentì un quaquaraquà, un uomo da niente, capace di nessun rispetto.\"','pier__2024_02_06__23_28_34.jpg','Camilleri é unico nel suo genere',0,0,13),(12,'2024-02-06 20:59:35','p','luca__2024_02_06__20_59_35.jpeg','p',0,0,2),(13,'2024-02-06 18:06:33','cit','liuk__2024_02_06__18_06_33.jpg','pen',2,1,2);
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `scrittoda`
--

DROP TABLE IF EXISTS `scrittoda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `scrittoda` (
  `libroId` int NOT NULL,
  `autoreId` int NOT NULL,
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
INSERT INTO `scrittoda` VALUES (1,1),(2,2),(3,3),(4,4),(5,5),(6,6),(7,7),(8,8),(9,9),(10,10),(11,11),(12,12),(13,12),(14,12),(15,12),(16,12),(17,13),(18,13),(19,13),(20,13),(21,14),(22,15),(23,16),(24,17),(25,18),(26,19),(27,20),(28,21),(29,22),(30,23),(31,24),(32,25),(33,26),(34,27),(35,28),(36,29),(37,30),(38,31),(39,32),(40,31),(41,33),(42,31),(43,31),(44,34),(45,35),(46,31),(47,36),(48,31),(49,37),(50,38),(51,39),(52,40),(53,41),(54,42),(55,43),(56,43),(57,43),(58,43),(59,43),(60,43),(61,43),(62,43);
/*!40000 ALTER TABLE `scrittoda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `segue`
--

DROP TABLE IF EXISTS `segue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `segue` (
  `seguitoId` int NOT NULL,
  `seguenteId` int NOT NULL,
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
INSERT INTO `segue` VALUES (9,8),(10,8),(15,8),(8,9),(9,10),(15,10),(8,12),(10,12),(10,15);
/*!40000 ALTER TABLE `segue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sottoscrive`
--

DROP TABLE IF EXISTS `sottoscrive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sottoscrive` (
  `utenteId` int NOT NULL,
  `medagliereId` int NOT NULL,
  PRIMARY KEY (`medagliereId`,`utenteId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sottoscrive`
--

LOCK TABLES `sottoscrive` WRITE;
/*!40000 ALTER TABLE `sottoscrive` DISABLE KEYS */;
INSERT INTO `sottoscrive` VALUES (8,0),(9,0),(10,0),(11,0),(12,0),(13,0),(14,0),(15,0),(16,0),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(9,2),(13,2),(15,2),(8,3),(15,5),(10,8),(10,9),(12,10),(8,13);
/*!40000 ALTER TABLE `sottoscrive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tagperpost`
--

DROP TABLE IF EXISTS `tagperpost`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tagperpost` (
  `utenteIdPost` int NOT NULL,
  `dataOraPost` datetime NOT NULL,
  `tagId` int NOT NULL,
  PRIMARY KEY (`utenteIdPost`,`dataOraPost`,`tagId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tagperpost`
--

LOCK TABLES `tagperpost` WRITE;
/*!40000 ALTER TABLE `tagperpost` DISABLE KEYS */;
INSERT INTO `tagperpost` VALUES (8,'2024-02-06 20:37:33',7),(8,'2024-02-06 20:38:47',8),(8,'2024-02-06 22:59:57',12),(9,'2024-02-05 23:22:27',1),(9,'2024-02-05 23:22:27',2),(10,'2024-02-06 11:38:54',3),(10,'2024-02-06 21:59:30',10),(10,'2024-02-06 22:19:49',11),(10,'2024-02-06 23:15:31',13),(10,'2024-02-06 23:20:21',14),(10,'2024-02-06 23:20:21',15),(10,'2024-02-06 23:20:21',16),(10,'2024-02-06 23:28:34',14),(10,'2024-02-06 23:28:34',15),(10,'2024-02-06 23:28:34',17),(12,'2024-02-06 20:59:35',9),(13,'2024-02-06 18:06:33',4),(13,'2024-02-06 18:06:33',5),(13,'2024-02-06 18:06:33',6);
/*!40000 ALTER TABLE `tagperpost` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tags` (
  `id` int NOT NULL AUTO_INCREMENT,
  `testo` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (1,'as'),(2,'se'),(3,'nonSapere'),(4,'wow'),(5,'bellissimo'),(6,'winnipuh'),(7,'miao'),(8,'a'),(9,'p'),(10,'borghi'),(11,'bello'),(12,'c'),(13,'Schiavone'),(14,'Montalbano'),(15,'Sicilia'),(16,'Sellerio'),(17,'Camilleri');
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utente`
--

DROP TABLE IF EXISTS `utente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `utente` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(80) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(80) COLLATE utf8mb4_general_ci NOT NULL,
  `pwd` varchar(120) COLLATE utf8mb4_general_ci NOT NULL,
  `immagineProfilo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `isAdmin` int NOT NULL DEFAULT '0',
  `descrizione` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `stato` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utente`
--

LOCK TABLES `utente` WRITE;
/*!40000 ALTER TABLE `utente` DISABLE KEYS */;
INSERT INTO `utente` VALUES (7,'admin','admin@tecweb.it','$2y$10$3OlMvmQbXDETNgS8Mqdi6.nIi0ZRT88H0ud2JHL4hWZ3tC1VJcn12','65c2b02d6f271_root.jpg',1,'System Administrator',0),(8,'jp','jp@gmail.com','$2y$10$pbML..zXOVmqtmHxnPH8h.lhFdr7bflD2vDHZU1ZuDmk9HJmwGAHG','65c2a73fd2055_PenroseTriangle.gif',1,NULL,0),(9,'chicca','chicca@gmail.com','$2y$10$OMzXzUGrKTESbbJtJzjmS.6dWObtDYX1x1lCnEI7/Zh3X3zNBSRze',NULL,0,NULL,0),(10,'pier','pierangelo.motta@gmail.com','$2y$10$fqpjiaCxgyZSua2TlV.nseE8AvBkb.MIihTuOhAUrW/JLtg31tQ1q','65c2b018d3477_Screenshot_3.jpg',0,'Ciao, mi chiamo Pierangelo e mi piace molto leggere libri di tutti i tipi! ;)',0),(11,'test1','pierangelo.motta@icloud.com','$2y$10$vJSUwXnTLZ7F/U2Ct9C.OeOzwgQ4zihGVd0YWPtxH4UynyPisPZwa','65c21d3bcd8ea_5.jpg',0,NULL,0),(12,'luca','l@l','$2y$10$.YBgmI5o1N5RsThHxiy5M.8RgXhrMCZ5jeeZAcrxzOenZhamygVIG','65c29852f0470_273754719_4856560301129833_2961398596313220444_n.jpg',0,NULL,0),(13,'liuk','k@k','$2y$10$NuANii/UxS6Uw0Cct4HFOeGzq566tXQiJQlQOj1Op0SqYg0QMIFrq',NULL,0,NULL,0),(14,'luco','luco@g','$2y$10$x2b3pkjTDa7mp.9c5lZjHuJjDAAI5bn1hKz8pvcCKD.2TaJVykfc.',NULL,0,NULL,0),(15,'c2','c2@gmail.com','$2y$10$WJHsJPPn/2ra52HcgiNcLuDkGo/GdKlY74kJ1W0RFeYJGtREujVHy','65c2b0a1e7c2e_Senza_nome.png',0,'c2 è un bel nomeee',0),(16,'lory','lory@gmail.com','$2y$10$d3hw6AV1m01fYyjDkoKTsOrlzbl21c372uCYQZDLd91.JOG.MFMXO',NULL,0,NULL,1);
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

-- Dump completed on 2024-02-06 23:44:25
