-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 08. Jan 2020 um 19:26
-- Server-Version: 10.4.10-MariaDB
-- PHP-Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `tps`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `aufgabe`
--

CREATE TABLE `aufgabe` (
  `ereignisid` int(11) NOT NULL,
  `beginn` datetime NOT NULL,
  `ende` datetime NOT NULL,
  `bezeichnung` varchar(256) DEFAULT NULL,
  `beschreibung` text DEFAULT NULL,
  `status` varchar(64) DEFAULT NULL,
  `prioritaet` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `benutzer`
--

CREATE TABLE `benutzer` (
  `benutzerid` int(11) NOT NULL,
  `arbeitgeberid` int(11) NOT NULL,
  `rollenid` int(11) NOT NULL,
  `vorname` varchar(64) NOT NULL,
  `nachname` varchar(64) NOT NULL,
  `e-mail` varchar(128) NOT NULL,
  `passwort` varchar(256) NOT NULL,
  `kaz_von` time NOT NULL,
  `kaz_bis` time NOT NULL,
  `max_gesamtstunden` time NOT NULL,
  `max_ueberstunden` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `benutzerereignis`
--

CREATE TABLE `benutzerereignis` (
  `benutzerid` int(11) NOT NULL,
  `ereignisid` int(11) NOT NULL,
  `bestaetigt` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `benutzerrolle`
--

CREATE TABLE `benutzerrolle` (
  `rollenid` int(11) NOT NULL,
  `rolle` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `config`
--

CREATE TABLE `config` (
  `key_id` int(11) NOT NULL,
  `key` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `erfasstearbeitszeit`
--

CREATE TABLE `erfasstearbeitszeit` (
  `arbeitszeitid` int(11) NOT NULL,
  `benutzerid` int(11) NOT NULL,
  `beginn` timestamp NOT NULL DEFAULT current_timestamp(),
  `ende` timestamp NOT NULL DEFAULT current_timestamp(),
  `beschreibung` varchar(256) DEFAULT NULL,
  `istvorlage` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `meeting`
--

CREATE TABLE `meeting` (
  `ereignisid` int(11) NOT NULL,
  `beginn` datetime NOT NULL,
  `ende` datetime NOT NULL,
  `bezeichnung` varchar(256) DEFAULT NULL,
  `beschreibung` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `monatsabrechnung`
--

CREATE TABLE `monatsabrechnung` (
  `monatsabrechnungid` int(11) NOT NULL,
  `benutzerid` int(11) NOT NULL,
  `erfassungsmonat` timestamp NOT NULL DEFAULT current_timestamp(),
  `geleistete_gesamtstunden` time DEFAULT NULL,
  `max_gesamtstunden` time DEFAULT NULL,
  `abgerechnet` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `nichtverfuegbarkeit`
--

CREATE TABLE `nichtverfuegbarkeit` (
  `ereignisid` int(11) NOT NULL,
  `beginn` datetime NOT NULL,
  `ende` datetime NOT NULL,
  `bezeichnung` varchar(256) DEFAULT NULL,
  `beschreibung` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `aufgabe`
--
ALTER TABLE `aufgabe`
  ADD PRIMARY KEY (`ereignisid`);

--
-- Indizes für die Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  ADD PRIMARY KEY (`benutzerid`),
  ADD KEY `arbeitgeberid` (`arbeitgeberid`),
  ADD KEY `rollenid` (`rollenid`);

--
-- Indizes für die Tabelle `benutzerereignis`
--
ALTER TABLE `benutzerereignis`
  ADD PRIMARY KEY (`benutzerid`,`ereignisid`),
  ADD KEY `ereignisid` (`ereignisid`);

--
-- Indizes für die Tabelle `benutzerrolle`
--
ALTER TABLE `benutzerrolle`
  ADD PRIMARY KEY (`rollenid`);

--
-- Indizes für die Tabelle `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`key_id`);

--
-- Indizes für die Tabelle `erfasstearbeitszeit`
--
ALTER TABLE `erfasstearbeitszeit`
  ADD PRIMARY KEY (`arbeitszeitid`),
  ADD KEY `benutzerid` (`benutzerid`);

--
-- Indizes für die Tabelle `meeting`
--
ALTER TABLE `meeting`
  ADD PRIMARY KEY (`ereignisid`);

--
-- Indizes für die Tabelle `monatsabrechnung`
--
ALTER TABLE `monatsabrechnung`
  ADD PRIMARY KEY (`monatsabrechnungid`),
  ADD KEY `benutzerid` (`benutzerid`);

--
-- Indizes für die Tabelle `nichtverfuegbarkeit`
--
ALTER TABLE `nichtverfuegbarkeit`
  ADD PRIMARY KEY (`ereignisid`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  MODIFY `benutzerid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `config`
--
ALTER TABLE `config`
  MODIFY `key_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `erfasstearbeitszeit`
--
ALTER TABLE `erfasstearbeitszeit`
  MODIFY `arbeitszeitid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `monatsabrechnung`
--
ALTER TABLE `monatsabrechnung`
  MODIFY `monatsabrechnungid` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  ADD CONSTRAINT `benutzer_ibfk_1` FOREIGN KEY (`arbeitgeberid`) REFERENCES `benutzer` (`benutzerid`),
  ADD CONSTRAINT `benutzer_ibfk_2` FOREIGN KEY (`rollenid`) REFERENCES `benutzerrolle` (`rollenid`);

--
-- Constraints der Tabelle `benutzerereignis`
--
ALTER TABLE `benutzerereignis`
  ADD CONSTRAINT `benutzerereignis_ibfk_1` FOREIGN KEY (`benutzerid`) REFERENCES `benutzer` (`benutzerid`),
  ADD CONSTRAINT `benutzerereignis_ibfk_2` FOREIGN KEY (`ereignisid`) REFERENCES `nichtverfuegbarkeit` (`ereignisid`),
  ADD CONSTRAINT `benutzerereignis_ibfk_3` FOREIGN KEY (`ereignisid`) REFERENCES `aufgabe` (`ereignisid`),
  ADD CONSTRAINT `benutzerereignis_ibfk_4` FOREIGN KEY (`ereignisid`) REFERENCES `meeting` (`ereignisid`);

--
-- Constraints der Tabelle `erfasstearbeitszeit`
--
ALTER TABLE `erfasstearbeitszeit`
  ADD CONSTRAINT `erfasstearbeitszeit_ibfk_1` FOREIGN KEY (`benutzerid`) REFERENCES `benutzer` (`benutzerid`);

--
-- Constraints der Tabelle `monatsabrechnung`
--
ALTER TABLE `monatsabrechnung`
  ADD CONSTRAINT `monatsabrechnung_ibfk_1` FOREIGN KEY (`benutzerid`) REFERENCES `benutzer` (`benutzerid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
