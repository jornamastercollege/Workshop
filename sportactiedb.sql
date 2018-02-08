-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Gegenereerd op: 08 feb 2018 om 12:41
-- Serverversie: 5.7.19
-- PHP-versie: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sportactiedb`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `ronde`
--

DROP TABLE IF EXISTS `ronde`;
CREATE TABLE IF NOT EXISTS `ronde` (
  `ID` int(11) NOT NULL,
  `nummer` int(11) NOT NULL,
  `aanvangstijd` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `ID` int(11) NOT NULL,
  `StudentNmr` int(11) NOT NULL,
  `Voornaam` text NOT NULL,
  `Achternaam` text NOT NULL,
  `Klas` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `studentinschrijving`
--

DROP TABLE IF EXISTS `studentinschrijving`;
CREATE TABLE IF NOT EXISTS `studentinschrijving` (
  `ID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `workshopRondeID` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `workshop`
--

DROP TABLE IF EXISTS `workshop`;
CREATE TABLE IF NOT EXISTS `workshop` (
  `ID` int(11) NOT NULL,
  `naam` text NOT NULL,
  `omschrijving` text NOT NULL,
  `leider` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `workshopronde`
--

DROP TABLE IF EXISTS `workshopronde`;
CREATE TABLE IF NOT EXISTS `workshopronde` (
  `ID` int(11) NOT NULL,
  `RoundID` int(11) NOT NULL,
  `WorkshopID` int(11) NOT NULL,
  `Ruimte` text NOT NULL,
  `MaxDeelnemers` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
