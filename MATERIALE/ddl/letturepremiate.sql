-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2024 at 04:49 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `letturepremiate`
--

-- --------------------------------------------------------

--
-- Table structure for table `autore`
--

CREATE TABLE `autore` (
  `id` int(8) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `commenti`
--

CREATE TABLE `commenti` (
  `utenteIdPost` int(8) NOT NULL,
  `dataOraPost` date NOT NULL,
  `utenteIdComm` int(8) NOT NULL,
  `dataOraComm` date NOT NULL,
  `commento` varchar(1023) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `compone`
--

CREATE TABLE `compone` (
  `medagliereId` int(8) NOT NULL,
  `libroId` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `libro`
--

CREATE TABLE `libro` (
  `id` int(8) NOT NULL,
  `titolo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medagliere`
--

CREATE TABLE `medagliere` (
  `id` int(8) NOT NULL,
  `titolo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifica`
--

CREATE TABLE `notifica` (
  `id` int(8) NOT NULL,
  `dataOra` date NOT NULL,
  `descrizione` varchar(255) NOT NULL,
  `tipo` char(1) NOT NULL,
  `utenteId` char(1) NOT NULL,
  `utenteIdPost` char(1) DEFAULT NULL,
  `dataOraPost` date DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `utenteId` int(8) NOT NULL,
  `dataOra` date NOT NULL,
  `citazioneTestuale` varchar(255) DEFAULT NULL,
  `fotoCitazione` varchar(127) DEFAULT NULL,
  `riflessione` varchar(2047) NOT NULL,
  `counterMiPiace` decimal(6,0) NOT NULL,
  `counterAdoro` decimal(6,0) NOT NULL,
  `libroId` int(8) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `scrittoda`
--

CREATE TABLE `scrittoda` (
  `libroId` int(8) NOT NULL,
  `autoreId` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `segue`
--

CREATE TABLE `segue` (
  `seguitoId` char(1) NOT NULL,
  `seguenteId` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sottoscrive`
--

CREATE TABLE `sottoscrive` (
  `utenteId` char(1) NOT NULL,
  `medagliereId` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tagperpost`
--

CREATE TABLE `tagperpost` (
  `utenteIdPost` char(1) NOT NULL,
  `dataOraPost` date NOT NULL,
  `tagId` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(8) NOT NULL,
  `testo` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `utente`
--

CREATE TABLE `utente` (
  `id` int(8) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `username` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `pwd` varchar(120) NOT NULL,
  `immagineProfilo` varchar(255) NOT NULL,
  `isAdmin` char(1) NOT NULL,
  `descrizione` varchar(150) DEFAULT NULL,
  `stato` char(1) NOT NULL,
  `numeroFollow` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `autore`
--
ALTER TABLE `autore`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ID_AUTORE_IND` (`id`);

--
-- Indexes for table `commenti`
--
ALTER TABLE `commenti`
  ADD PRIMARY KEY (`utenteIdPost`,`dataOraPost`,`utenteIdComm`,`dataOraComm`),
  ADD UNIQUE KEY `ID_COMMENTI_IND` (`utenteIdPost`,`dataOraPost`,`utenteIdComm`,`dataOraComm`),
  ADD KEY `REF_COMME_UTENT_IND` (`utenteIdComm`);

--
-- Indexes for table `compone`
--
ALTER TABLE `compone`
  ADD PRIMARY KEY (`libroId`,`medagliereId`),
  ADD UNIQUE KEY `ID_Compone_IND` (`libroId`,`medagliereId`),
  ADD KEY `EQU_Compo_MEDAG_IND` (`medagliereId`);

--
-- Indexes for table `libro`
--
ALTER TABLE `libro`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ID_LIBRO_IND` (`id`);

--
-- Indexes for table `medagliere`
--
ALTER TABLE `medagliere`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ID_MEDAGLIERE_IND` (`id`);

--
-- Indexes for table `notifica`
--
ALTER TABLE `notifica`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ID_NOTIFICA_IND` (`id`),
  ADD KEY `REF_NOTIF_UTENT_IND` (`utenteId`),
  ADD KEY `REF_NOTIF_POST_IND` (`utenteIdPost`,`dataOraPost`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`utenteId`,`dataOra`),
  ADD UNIQUE KEY `ID_POST_IND` (`utenteId`,`dataOra`),
  ADD KEY `REF_POST_LIBRO_IND` (`libroId`);

--
-- Indexes for table `scrittoda`
--
ALTER TABLE `scrittoda`
  ADD PRIMARY KEY (`autoreId`,`libroId`),
  ADD UNIQUE KEY `ID_ScrittoDa_IND` (`autoreId`,`libroId`),
  ADD KEY `EQU_Scrit_LIBRO_IND` (`libroId`);

--
-- Indexes for table `segue`
--
ALTER TABLE `segue`
  ADD PRIMARY KEY (`seguitoId`,`seguenteId`),
  ADD UNIQUE KEY `ID_Segue_IND` (`seguitoId`,`seguenteId`),
  ADD KEY `REF_Segue_UTENT_1_IND` (`seguenteId`);

--
-- Indexes for table `sottoscrive`
--
ALTER TABLE `sottoscrive`
  ADD PRIMARY KEY (`medagliereId`,`utenteId`);

--
-- Indexes for table `tagperpost`
--
ALTER TABLE `tagperpost`
  ADD PRIMARY KEY (`utenteIdPost`,`dataOraPost`,`tagId`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);


COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
