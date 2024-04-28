-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 28, 2024 at 09:54 PM
-- Server version: 10.1.48-MariaDB-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `CocoRebus`
--

-- --------------------------------------------------------

--
-- Table structure for table `info_xml`
--

CREATE TABLE `info_xml` (
  `ID` varchar(50) NOT NULL,
  `Niveau` varchar(10) NOT NULL,
  `Élève` varchar(10) NOT NULL,
  `Classe` varchar(10) NOT NULL,
  `Version` varchar(10) NOT NULL,
  `Année` int(11) NOT NULL,
  `Corpus` varchar(10) NOT NULL,
  `Temps` varchar(10) NOT NULL,
  `InterventionEn` varchar(5) NOT NULL,
  `Normalisation` varchar(5) NOT NULL,
  `CatégorieFaute` varchar(10) NOT NULL,
  `LienXml` varchar(50) NOT NULL,
  `Lien jpg` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `info_xml`
--

INSERT INTO `info_xml` (`ID`, `Niveau`, `Élève`, `Classe`, `Version`, `Année`, `Corpus`, `Temps`, `InterventionEn`, `Normalisation`, `CatégorieFaute`, `LienXml`, `Lien jpg`) VALUES
('CO-3-2014-ARG-D1-E3-V2', '3', 'E3', 'ARG', 'V2', 2014, 'ECRISCOL', 'T1', 'Oui', 'Non', '', '', ''),
('CO-3-2014-ARG-D1-E9-V2', '3', 'E9', 'ARG', 'V2', 2014, 'ECRISCOL', 'T1', 'Oui', 'Non', '', '', ''),
('EC-CE1-2014-ABZ1-D1-E1-V1', 'CE1', 'E1', 'ABZ1', 'V1', 2014, 'ECRISCOL', 'T1', 'Oui', 'Non', '', '', ''),
('EC-CE1-2014-ABZ1-D1-E1-V2', 'CE1', 'E1', 'ABZ1', 'V2', 2014, 'ECRISCOL', 'T1', 'Oui', 'Non', '', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
