-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 20, 2018 at 01:59 PM
-- Server version: 10.2.7-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `imrebzb198_Workshopinschrijving`
--

-- --------------------------------------------------------

--
-- Table structure for table `Leider`
--

CREATE TABLE `Leider` (
  `ID` int(3) NOT NULL,
  `Voornaam` varchar(50) NOT NULL,
  `Achternaam` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Ronde`
--

CREATE TABLE `Ronde` (
  `ID` int(3) NOT NULL,
  `Nummer` int(3) NOT NULL,
  `Aanvangstijd` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Ruimte`
--

CREATE TABLE `Ruimte` (
  `ID` int(11) NOT NULL,
  `Naam` int(11) NOT NULL,
  `MaxDeelnemers` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Student`
--

CREATE TABLE `Student` (
  `ID` int(3) NOT NULL,
  `StudentNr` int(11) NOT NULL,
  `Wachtwoord` varchar(50) NOT NULL,
  `Voornaam` varchar(50) NOT NULL,
  `Achternaam` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `StudentInschrijving`
--

CREATE TABLE `StudentInschrijving` (
  `ID` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL,
  `WorkShopRondeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `WorkShop`
--

CREATE TABLE `WorkShop` (
  `ID` int(3) NOT NULL,
  `Naam` varchar(50) NOT NULL,
  `Omschrijving` varchar(250) NOT NULL,
  `LeiderID` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `WorkShopRonde`
--

CREATE TABLE `WorkShopRonde` (
  `ID` int(3) NOT NULL,
  `WorkShopID` int(3) NOT NULL,
  `RondeID` int(3) NOT NULL,
  `RuimteID` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Leider`
--
ALTER TABLE `Leider`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Ronde`
--
ALTER TABLE `Ronde`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Ruimte`
--
ALTER TABLE `Ruimte`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Student`
--
ALTER TABLE `Student`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `StudentInschrijving`
--
ALTER TABLE `StudentInschrijving`
  ADD PRIMARY KEY (`ID`) USING BTREE,
  ADD KEY `StudentID` (`StudentID`),
  ADD KEY `WorkShopRondeID` (`WorkShopRondeID`);

--
-- Indexes for table `WorkShop`
--
ALTER TABLE `WorkShop`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `LeiderID` (`LeiderID`);

--
-- Indexes for table `WorkShopRonde`
--
ALTER TABLE `WorkShopRonde`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `WorkShopID` (`WorkShopID`),
  ADD KEY `RondeID` (`RondeID`),
  ADD KEY `RuimteID` (`RuimteID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Leider`
--
ALTER TABLE `Leider`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Ronde`
--
ALTER TABLE `Ronde`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Ruimte`
--
ALTER TABLE `Ruimte`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Student`
--
ALTER TABLE `Student`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `StudentInschrijving`
--
ALTER TABLE `StudentInschrijving`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `WorkShop`
--
ALTER TABLE `WorkShop`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `WorkShopRonde`
--
ALTER TABLE `WorkShopRonde`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `StudentInschrijving`
--
ALTER TABLE `StudentInschrijving`
  ADD CONSTRAINT `StudentInschrijving_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `Student` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `StudentInschrijving_ibfk_2` FOREIGN KEY (`WorkShopRondeID`) REFERENCES `WorkShopRonde` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `WorkShop`
--
ALTER TABLE `WorkShop`
  ADD CONSTRAINT `WorkShop_ibfk_1` FOREIGN KEY (`LeiderID`) REFERENCES `Leider` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `WorkShopRonde`
--
ALTER TABLE `WorkShopRonde`
  ADD CONSTRAINT `WorkShopRonde_ibfk_1` FOREIGN KEY (`RondeID`) REFERENCES `Ronde` (`ID`),
  ADD CONSTRAINT `WorkShopRonde_ibfk_2` FOREIGN KEY (`RuimteID`) REFERENCES `Ruimte` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `WorkShopRonde_ibfk_3` FOREIGN KEY (`WorkShopID`) REFERENCES `WorkShop` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
