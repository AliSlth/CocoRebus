-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 28, 2024 at 05:54 PM
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
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `identifiant` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL COMMENT 'ES-IT-FR',
  `prenom` varchar(30) NOT NULL COMMENT 'ES-IT-FR',
  `mail` varchar(50) DEFAULT NULL,
  `tel` varchar(30) DEFAULT NULL,
  `login` varchar(11) NOT NULL,
  `mdp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`identifiant`, `nom`, `prenom`, `mail`, `tel`, `login`, `mdp`) VALUES
(1, 'DU', 'Xinyi', 'abcwcwgie@gmail.com', '237463247329', 'xinyi', 123),
(2, 'SOU', 'Alissa', 'sgfwegfiuw@outlook.com', '27353826599732', '0', 0),
(3, 'Tom', 'CHARED', NULL, NULL, '0', 0),
(4, 'Brad', 'PITT', 'bradpitt@gamil.com', '745625692', '0', 0),
(5, 'Zeki', 'YEWFI', NULL, '271341264', '0', 0),
(6, 'Hannan', 'DBFFEWUF', 'dbewhfibiubc@yahou.com', '12743264997', '0', 0),
(7, 'Harry', 'Poter', 'shbdhjbjsabd@gmail.com', '666666666666', '0', 0),
(8, 'Lord', 'OFRING', 'vdcydcjdhch@yahou.com', '17364638562', '0', 0),
(9, '', '', NULL, NULL, 'du', 224);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`identifiant`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `identifiant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
