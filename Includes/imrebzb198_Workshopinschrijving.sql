-- phpMyAdmin SQL Dump
-- version 4.7.8
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 23, 2018 at 10:43 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `imrebzb198_workshopinschrijving`
--

-- --------------------------------------------------------

--
-- Table structure for table `leider`
--

CREATE TABLE `leider` (
  `ID` int(3) NOT NULL,
  `Gebruikersnaam` varchar(50) NOT NULL,
  `Voornaam` varchar(50) NOT NULL,
  `Achternaam` varchar(50) NOT NULL,
  `Wachtwoord` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leider`
--

INSERT INTO `leider` (`ID`, `Gebruikersnaam`, `Voornaam`, `Achternaam`, `Wachtwoord`) VALUES
(1, 'anl', 'Annemiek', 'Lely', 'anl'),
(2, 'ssb', 'Studenten', 'S&B', 'ssb'),
(3, 'spe', 'SportEvents', '', 'spe'),
(4, 'clb', 'Claartje', 'Bos', 'clb'),
(5, 'rup', 'Ruud', 'Peters', 'rup'),
(6, 'hac', 'Hans', 'Corielje', 'hac'),
(7, 'brg', 'Brenda', 'Gielens', 'brg'),
(8, 'wim', 'Wim', 'Meurs', 'wim'),
(9, 'coh', 'Cornelie', 'de Haan', 'coh'),
(10, 'mal', 'Martijn', 'Laurensen', 'mal'),
(11, 'jas', 'Jacqueline', 'van Seters', 'jas'),
(12, 'kiv', 'Kitty', 'Visser', 'kiv'),
(13, 'edc', 'Edsel', 'Camron', 'edc'),
(14, 'ros', 'Ronnie', 'Stevens', 'ros'),
(15, 'peo', 'Peter', 'Ovink', 'peo'),
(16, 'erv', 'Erik', 'Verberne', 'erv'),
(17, 'onh', 'Onno', 'Hardebol', 'onh'),
(18, 'peh', 'Peter', 'Hogeling', 'peh'),
(19, 'rus', 'Rutgers', 'Stichting', 'rus'),
(20, 'irz', 'IrisZorg', '', 'irz'),
(21, 'tey', 'Teun', 'Ymker', 'tey'),
(22, 'evv', 'Eva', 'Voskamp', 'evv'),
(23, 'riv', 'Rien', 'ter Veen', 'riv');

-- --------------------------------------------------------

--
-- Table structure for table `ronde`
--

CREATE TABLE `ronde` (
  `ID` int(3) NOT NULL,
  `Nummer` int(3) NOT NULL,
  `Aanvangstijd` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ronde`
--

INSERT INTO `ronde` (`ID`, `Nummer`, `Aanvangstijd`) VALUES
(1, 1, '12:30:00'),
(2, 2, '13:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `ruimte`
--

CREATE TABLE `ruimte` (
  `ID` int(11) NOT NULL,
  `Naam` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ruimte`
--

INSERT INTO `ruimte` (`ID`, `Naam`) VALUES
(1, 'N1.01'),
(3, 'Grasveld voor'),
(5, 'N1.02'),
(7, 'Verzamelen schoolplein tussen Arentheem College en Astrum College'),
(9, 'Dumpel, achterste zaal boven'),
(10, 'Dumpel 2/3 van zaal'),
(12, 'Keuken, via aula'),
(13, '1/3 zaal De Dumpel'),
(14, 'Zwembad De Dumpel'),
(15, 'N1.12'),
(16, '2e verdieping voor personeelskamer'),
(17, 'N0.09'),
(18, 'Aula'),
(19, 'Dumpel, voorste zaal boven'),
(20, 'N2.39'),
(21, 'N0.01'),
(22, 'N1.10'),
(23, 'Lokaal met smartbord'),
(24, 'N0.15');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `ID` int(3) NOT NULL,
  `StudentNr` int(11) NOT NULL,
  `Wachtwoord` varchar(50) NOT NULL,
  `Voornaam` varchar(50) NOT NULL,
  `Achternaam` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`ID`, `StudentNr`, `Wachtwoord`, `Voornaam`, `Achternaam`) VALUES
(1, 400025267, 'password', 'Imre', 'Boersma'),
(3, 1234, 'password', 'Root', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `studentinschrijving`
--

CREATE TABLE `studentinschrijving` (
  `ID` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL,
  `WorkShopRondeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentinschrijving`
--

INSERT INTO `studentinschrijving` (`ID`, `StudentID`, `WorkShopRondeID`) VALUES
(1, 1, 5),
(2, 1, 17),
(3, 3, 21),
(4, 3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `workshop`
--

CREATE TABLE `workshop` (
  `ID` int(3) NOT NULL,
  `Naam` varchar(50) NOT NULL,
  `Omschrijving` varchar(250) NOT NULL,
  `MaxDeelnemers` int(11) NOT NULL,
  `LeiderID` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workshop`
--

INSERT INTO `workshop` (`ID`, `Naam`, `Omschrijving`, `MaxDeelnemers`, `LeiderID`) VALUES
(1, 'Maak depressie bespreekbaar', 'Herken je depressies bij een ander?', 20, 1),
(2, 'Step je gek', 'Een super leuke tocht op de step door Velp. Door SportEvent.', 35, 3),
(3, 'Voetbalvariaties', 'Wat kun je allemaal doen met een voetbal? Voetvolley, Flessenvoetbal, paaltjes voetbal, behendigheid. Door SportEvents.', 40, 3),
(4, 'De Afvalclub/ wat eten we vandaag', 'Wat staat er allemaal op voedingsetiketten? Wat betekent dit voor ons en wat hebben wij aan eten mee in onze tas?', 20, 2),
(5, 'Kennismaken met yoga', 'Dru Yoga is een zachte vorm van yoga.\r\nDoor ontspanning,  accepteren en respecteren van je eigen grens, ben je in staat gestagneerde energie los te laten en ruimte te ervaren.', 30, 4),
(6, 'Basketbal', 'Let\'s play basketball! Leuke, actieve workshops door onze directeur en gastdocent.', 30, 5),
(7, 'Gezonde lunch bereiden', 'Laat je lunchpakket thuis en maak een lekkere, gezonde lunch die je natuurlijk na afloop gezamenlijk opeet. ', 12, 6),
(8, 'Trefbal', 'Voor de echte gooispierballen. Wil je wat energie kwijt en kan je goed mikken en vangen? Ga de uitdaging aan met je vrienden/klasgenoten.', 20, 7),
(9, 'Waterpolo', 'Lukt het jou om niet te verzuipen in het water terwijl je de bal in het doel gooit? Neem je zwemkleding mee!', 10, 8),
(10, 'Aquafit', 'Ontspannen in het water liggen maar toch bezig zijn met fitness. Ervaar aquafit gegeven door studenten van Sport en Bewegen. Neem je zwemkleding mee!', 15, 2),
(11, 'Zentangle', 'Je eigen zentangle kunstwerk maken, resultaten zijn super mooi!', 10, 9),
(12, 'Pingpong je suf!', 'Tafeltennis rond de tafel, een actieve en leuke manier van sporten. Door meneer Laurensen.', 20, 10),
(13, 'Schilderen', 'Schilderen; maak je hoofd leeg en schilder de stress van je af. Een leuke creatieve workshop door mevrouw Seters en mevrouw Visser.', 20, 11),
(14, 'Hiphop-Streetdance', 'Een geweldige workshop van de meest gevraagde breakdance docent van Gelderland.\r\nDoor dansdocent Bionic (Edsel Camron).', 30, 13),
(15, 'Aikido', 'Japanse Krijgskunst. Lukt het jou om zonder geweld de agressie tegen jou te voorkomen of te controleren?', 16, 14),
(16, 'E-sport', 'Pakkende tekst vragen aan Erik Verberne', 20, 16),
(17, 'Toneel', 'De vloer op. Kan jij een beetje improviseren?', 16, 18),
(18, 'Seks', 'Weet jij alles over seks? Door Rutgersstichting.', 20, 19),
(19, 'Spuiten en slikken', 'Alles wat je moet weten over drank- en drugsgebruik. Verzorgd door Iriszorg.', 20, 20),
(20, 'Pubquiz', 'Pakkende tekst nog verzinnen.', 20, 22);

-- --------------------------------------------------------

--
-- Table structure for table `workshopronde`
--

CREATE TABLE `workshopronde` (
  `ID` int(3) NOT NULL,
  `WorkShopID` int(3) NOT NULL,
  `RondeID` int(3) NOT NULL,
  `RuimteID` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workshopronde`
--

INSERT INTO `workshopronde` (`ID`, `WorkShopID`, `RondeID`, `RuimteID`) VALUES
(1, 1, 1, 1),
(2, 2, 1, 7),
(3, 1, 2, 1),
(4, 2, 2, 7),
(5, 3, 1, 3),
(6, 3, 2, 3),
(7, 4, 1, 5),
(8, 4, 2, 5),
(9, 5, 1, 9),
(10, 5, 2, 9),
(11, 6, 1, 10),
(12, 6, 2, 10),
(13, 7, 1, 12),
(14, 7, 2, 12),
(15, 8, 1, 13),
(16, 8, 2, 13),
(17, 10, 2, 14),
(18, 9, 2, 14),
(19, 11, 1, 15),
(20, 11, 2, 15),
(21, 12, 1, 16),
(22, 12, 2, 16),
(23, 13, 1, 17),
(24, 13, 2, 17),
(25, 14, 1, 18),
(26, 14, 2, 18);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `leider`
--
ALTER TABLE `leider`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `ronde`
--
ALTER TABLE `ronde`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `ruimte`
--
ALTER TABLE `ruimte`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `studentinschrijving`
--
ALTER TABLE `studentinschrijving`
  ADD PRIMARY KEY (`ID`) USING BTREE,
  ADD KEY `StudentID` (`StudentID`),
  ADD KEY `WorkShopRondeID` (`WorkShopRondeID`);

--
-- Indexes for table `workshop`
--
ALTER TABLE `workshop`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `LeiderID` (`LeiderID`);

--
-- Indexes for table `workshopronde`
--
ALTER TABLE `workshopronde`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `WorkShopID` (`WorkShopID`),
  ADD KEY `RondeID` (`RondeID`),
  ADD KEY `RuimteID` (`RuimteID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `leider`
--
ALTER TABLE `leider`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `ronde`
--
ALTER TABLE `ronde`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ruimte`
--
ALTER TABLE `ruimte`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `studentinschrijving`
--
ALTER TABLE `studentinschrijving`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `workshop`
--
ALTER TABLE `workshop`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `workshopronde`
--
ALTER TABLE `workshopronde`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `studentinschrijving`
--
ALTER TABLE `studentinschrijving`
  ADD CONSTRAINT `StudentInschrijving_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `student` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `StudentInschrijving_ibfk_2` FOREIGN KEY (`WorkShopRondeID`) REFERENCES `workshopronde` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `workshop`
--
ALTER TABLE `workshop`
  ADD CONSTRAINT `WorkShop_ibfk_1` FOREIGN KEY (`LeiderID`) REFERENCES `leider` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `workshopronde`
--
ALTER TABLE `workshopronde`
  ADD CONSTRAINT `WorkShopRonde_ibfk_1` FOREIGN KEY (`RondeID`) REFERENCES `ronde` (`ID`),
  ADD CONSTRAINT `WorkShopRonde_ibfk_2` FOREIGN KEY (`RuimteID`) REFERENCES `ruimte` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `WorkShopRonde_ibfk_3` FOREIGN KEY (`WorkShopID`) REFERENCES `workshop` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
