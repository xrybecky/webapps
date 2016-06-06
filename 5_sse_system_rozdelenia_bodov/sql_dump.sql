-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Hostiteľ: localhost
-- Vygenerované: Po 21.Mar 2016, 20:36
-- Verzia serveru: 5.5.44-0ubuntu0.14.04.1
-- Verzia PHP: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáza: `teamproject`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `hodnotenie`
--

CREATE TABLE IF NOT EXISTS `hodnotenie` (
  `id_group` int(11) NOT NULL AUTO_INCREMENT,
  `points` int(11) NOT NULL,
  `cpt` int(11) unsigned DEFAULT NULL,
  `approval` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_group`),
  KEY `cpt` (`cpt`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Sťahujem dáta pre tabuľku `hodnotenie`
--

INSERT INTO `hodnotenie` (`id_group`, `points`, `cpt`, `approval`) VALUES
(1, 52, 4, 0),
(2, 36, 6, 0);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `osoby`
--

CREATE TABLE IF NOT EXISTS `osoby` (
  `id_person` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_role` int(11) NOT NULL,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `login` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `points` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `id_group` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_person`),
  KEY `id_role` (`id_role`,`id_group`),
  KEY `group` (`id_group`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Sťahujem dáta pre tabuľku `osoby`
--

INSERT INTO `osoby` (`id_person`, `id_role`, `name`, `surname`, `login`, `password`, `points`, `status`, `id_group`) VALUES
(1, 2, 'Peter', 'Hochschorner', 'peter', 'stu123stu', 18, 0, 1),
(2, 2, 'Pavol', 'Hochschorner', 'pavol', 'stu123stu', 10, 1, 1),
(3, 2, 'Elena', 'Kaliská', 'elena', 'stu123stu', 18, 0, 1),
(4, 2, 'Anastasiya', 'Kuzmina', 'nasta', 'stu123stu', 20, 1, 1),
(5, 2, 'Michal', 'Martikán', 'michal', 'stu123stu', 22, NULL, 1),
(6, 2, 'Ondrej', 'Nepela', 'ondrej', 'stu123stu', 3, 1, 2),
(7, 2, 'Jozef', 'Pribilinec', 'jozef', 'stu123stu', NULL, NULL, 2),
(8, 2, 'Anton', 'Tkáč', 'anton', 'stu123stu', NULL, 0, 2),
(9, 2, 'Ján', 'Zachara', 'jano', 'stu123stu', NULL, NULL, 2),
(10, 2, 'Ján', 'Torma', 'julo', 'stu123stu', NULL, NULL, 2),
(11, 1, 'Miloslav', 'Mečíř', 'milo', 'stu123stu', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int(11) NOT NULL,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Sťahujem dáta pre tabuľku `role`
--

INSERT INTO `role` (`id_role`, `name`) VALUES
(1, 'admin'),
(2, 'student');

--
-- Obmedzenie pre exportované tabuľky
--

--
-- Obmedzenie pre tabuľku `hodnotenie`
--
ALTER TABLE `hodnotenie`
  ADD CONSTRAINT `hodnotenie_ibfk_1` FOREIGN KEY (`cpt`) REFERENCES `osoby` (`id_person`);

--
-- Obmedzenie pre tabuľku `osoby`
--
ALTER TABLE `osoby`
  ADD CONSTRAINT `osoby_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`),
  ADD CONSTRAINT `osoby_ibfk_2` FOREIGN KEY (`id_group`) REFERENCES `hodnotenie` (`id_group`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
