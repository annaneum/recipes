-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 04. Apr 2018 um 13:48
-- Server-Version: 10.1.30-MariaDB
-- PHP-Version: 7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `recipe`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `groups`
--

CREATE TABLE `groups` (
  `ID` int(11) NOT NULL,
  `title` text NOT NULL,
  `prio` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `groups`
--

INSERT INTO `groups` (`ID`, `title`, `prio`, `created_on`) VALUES
(1, 'group1', 0, '2018-03-30 15:14:48');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `group_recipe`
--

CREATE TABLE `group_recipe` (
  `ID` int(11) NOT NULL,
  `fk_group_ID` int(11) NOT NULL,
  `fk_recipe_ID` int(11) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `group_recipe`
--

INSERT INTO `group_recipe` (`ID`, `fk_group_ID`, `fk_recipe_ID`, `added_on`) VALUES
(1, 1, 1, '2018-03-30 15:15:54');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `magazine`
--

CREATE TABLE `magazine` (
  `ID` int(11) NOT NULL,
  `title` text NOT NULL,
  `date` date NOT NULL,
  `edition` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `magazine`
--

INSERT INTO `magazine` (`ID`, `title`, `date`, `edition`, `created_on`) VALUES
(1, 'magazine1', '2018-03-01', 69, '2018-03-30 15:14:15'),
(2, 'magazine2', '2018-03-16', 420, '2018-03-30 15:15:22');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `recipe`
--

CREATE TABLE `recipe` (
  `ID` int(11) NOT NULL,
  `title` text NOT NULL,
  `fk_magazine_ID` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `recipe`
--

INSERT INTO `recipe` (`ID`, `title`, `fk_magazine_ID`, `created_on`) VALUES
(1, 'schokopudding', 1, '2018-03-30 15:13:40'),
(2, 'nachoooo', 2, '2018-03-30 15:15:41'),
(3, 'käääsekuchen', 2, '2018-03-30 15:34:10');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`ID`, `username`, `password`, `created_on`) VALUES
(1, 'admin', '$2y$10$0IgCJr75feF.nxCztZSqr.9o0Ii2/nIngloUS.h5ZjgcWHn3jMEMu', '2018-03-29 11:30:17');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `group_recipe`
--
ALTER TABLE `group_recipe`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `magazine`
--
ALTER TABLE `magazine`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `recipe`
--
ALTER TABLE `recipe`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `groups`
--
ALTER TABLE `groups`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `group_recipe`
--
ALTER TABLE `group_recipe`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `magazine`
--
ALTER TABLE `magazine`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `recipe`
--
ALTER TABLE `recipe`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
