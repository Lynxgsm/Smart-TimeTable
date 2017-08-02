-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2017 at 04:34 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iugm`
--

-- --------------------------------------------------------

--
-- Table structure for table `cours`
--

CREATE TABLE `cours` (
  `ID` int(11) NOT NULL,
  `IDMatiere` varchar(10) NOT NULL,
  `IDFiliere` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cours`
--

INSERT INTO `cours` (`ID`, `IDMatiere`, `IDFiliere`) VALUES
(1, 'CAE', 'FC2'),
(2, 'CAE', 'GRH2');

-- --------------------------------------------------------

--
-- Table structure for table `diplome`
--

CREATE TABLE `diplome` (
  `ID` varchar(10) NOT NULL,
  `Libelle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `diplome`
--

INSERT INTO `diplome` (`ID`, `Libelle`) VALUES
('Licence', 'Licence'),
('Master', 'Master');

-- --------------------------------------------------------

--
-- Table structure for table `enseignant`
--

CREATE TABLE `enseignant` (
  `ID` int(11) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Prenom` varchar(200) NOT NULL,
  `Adresse` text NOT NULL,
  `Phone` varchar(10) NOT NULL,
  `Email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enseignant`
--

INSERT INTO `enseignant` (`ID`, `Nom`, `Prenom`, `Adresse`, `Phone`, `Email`) VALUES
(1, 'M.', 'Arnaud', '', '', ''),
(2, 'M.', 'Laza', '', '', ''),
(3, 'Mme.', 'Adeline', '', '', ''),
(4, 'Mme.', 'Soamaro', '', '', ''),
(5, 'M.', 'Achille', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `filiere`
--

CREATE TABLE `filiere` (
  `ID` varchar(6) NOT NULL,
  `Libelle` varchar(255) NOT NULL,
  `Effectif` int(11) NOT NULL,
  `Annee` int(11) NOT NULL,
  `IDMention` varchar(10) NOT NULL,
  `IDDiplome` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `filiere`
--

INSERT INTO `filiere` (`ID`, `Libelle`, `Effectif`, `Annee`, `IDMention`, `IDDiplome`) VALUES
('FC1', 'Finances et Comptabilités', 250, 1, 'GESCOM', 'Licence'),
('FC2', 'Finances et Comptabilités', 144, 2, 'GESCOM', 'Licence'),
('FC3', 'Finances et Comptabilités', 98, 3, 'GESCOM', 'Licence'),
('GRH1', 'Gestion des Ressources Humaines', 90, 1, 'GESCOM', 'Licence'),
('GRH2', 'Gestion des Ressources Humaines', 79, 2, 'GESCOM', 'Licence'),
('GRH3', 'Gestion des Ressources Humaines', 76, 3, 'GESCOM', 'Licence'),
('PGI1', 'Progiciel de Gestion Intégré', 110, 1, 'GESCOM', 'Licence'),
('PGI2', 'Progiciel de Gestion Intégré', 98, 2, 'GESCOM', 'Licence'),
('PGI3', 'Progiciel de Gestion Intégré', 54, 3, 'GESCOM', 'Licence');

-- --------------------------------------------------------

--
-- Table structure for table `matiere`
--

CREATE TABLE `matiere` (
  `ID` varchar(10) NOT NULL,
  `Libelle` varchar(255) NOT NULL,
  `NbHeures` int(11) NOT NULL,
  `IDEnseignant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `matiere`
--

INSERT INTO `matiere` (`ID`, `Libelle`, `NbHeures`, `IDEnseignant`) VALUES
('CAE', 'Comptabilité Analytique d\'Exploitation', 22, 4),
('DAF', 'Droit des affaires', 23, 3),
('ECONAT', 'Economie Nationale', 40, 2),
('MACRO', 'MacroEconomie', 35, 1),
('PROGICIEL', 'Progiciel', 12, 5);

-- --------------------------------------------------------

--
-- Table structure for table `mention`
--

CREATE TABLE `mention` (
  `ID` varchar(6) NOT NULL,
  `Libelle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mention`
--

INSERT INTO `mention` (`ID`, `Libelle`) VALUES
('ECO-G', 'Economie Générale'),
('GESCOM', 'Gestion et Commerce');

-- --------------------------------------------------------

--
-- Table structure for table `salle`
--

CREATE TABLE `salle` (
  `ID` varchar(10) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Emplacement` text NOT NULL,
  `Capacite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salle`
--

INSERT INTO `salle` (`ID`, `Nom`, `Emplacement`, `Capacite`) VALUES
('GRANDAMPHI', 'GRAND Amphi', 'Ambondrona', 1000),
('KAKAL', 'KAKAL', 'Majunga Be', 60);

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `ID` int(11) NOT NULL,
  `IDMatiere` varchar(10) NOT NULL,
  `IDFiliere` varchar(10) NOT NULL,
  `IDSalle` varchar(10) NOT NULL,
  `DateCours` date NOT NULL,
  `HeureDebut` time NOT NULL,
  `HeureFin` time NOT NULL,
  `Description` varchar(255) NOT NULL,
  `ZoneHeure` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`ID`, `IDMatiere`, `IDFiliere`, `IDSalle`, `DateCours`, `HeureDebut`, `HeureFin`, `Description`, `ZoneHeure`) VALUES
(1, 'CAE', 'FC2', 'GRANDAMPHI', '2017-07-26', '08:00:00', '12:00:00', '', 'am'),
(2, 'DAF', 'FC2', 'KAKAL', '2017-07-26', '09:00:00', '11:00:00', 'Contrôle continu', 'am'),
(3, 'ECONAT', 'GRH2', 'GRANDAMPHI', '2017-08-02', '13:00:00', '16:00:00', '', 'pm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDMatiere` (`IDMatiere`),
  ADD KEY `IDFiliere` (`IDFiliere`);

--
-- Indexes for table `diplome`
--
ALTER TABLE `diplome`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `enseignant`
--
ALTER TABLE `enseignant`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `filiere`
--
ALTER TABLE `filiere`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDMention` (`IDMention`),
  ADD KEY `IDDiplome` (`IDDiplome`);

--
-- Indexes for table `matiere`
--
ALTER TABLE `matiere`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDEnseignant` (`IDEnseignant`);

--
-- Indexes for table `mention`
--
ALTER TABLE `mention`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDMatiere` (`IDMatiere`),
  ADD KEY `IDFiliere` (`IDFiliere`),
  ADD KEY `IDSalle` (`IDSalle`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cours`
--
ALTER TABLE `cours`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `enseignant`
--
ALTER TABLE `enseignant`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `cours`
--
ALTER TABLE `cours`
  ADD CONSTRAINT `cours_ibfk_1` FOREIGN KEY (`IDMatiere`) REFERENCES `matiere` (`ID`),
  ADD CONSTRAINT `cours_ibfk_2` FOREIGN KEY (`IDFiliere`) REFERENCES `filiere` (`ID`);

--
-- Constraints for table `filiere`
--
ALTER TABLE `filiere`
  ADD CONSTRAINT `filiere_ibfk_1` FOREIGN KEY (`IDMention`) REFERENCES `mention` (`ID`);

--
-- Constraints for table `matiere`
--
ALTER TABLE `matiere`
  ADD CONSTRAINT `matiere_ibfk_1` FOREIGN KEY (`IDEnseignant`) REFERENCES `enseignant` (`ID`);

--
-- Constraints for table `timetable`
--
ALTER TABLE `timetable`
  ADD CONSTRAINT `timetable_ibfk_1` FOREIGN KEY (`IDMatiere`) REFERENCES `matiere` (`ID`),
  ADD CONSTRAINT `timetable_ibfk_2` FOREIGN KEY (`IDFiliere`) REFERENCES `filiere` (`ID`),
  ADD CONSTRAINT `timetable_ibfk_3` FOREIGN KEY (`IDSalle`) REFERENCES `salle` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
