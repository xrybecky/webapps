-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Hostiteľ: localhost
-- Vygenerované: Po 30.Máj 2016, 23:28
-- Verzia serveru: 5.5.44-0ubuntu0.14.04.1
-- Verzia PHP: 5.5.9-1ubuntu4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáza: `spolzadanie`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Sťahujem dáta pre tabuľku `admins`
--

INSERT INTO `admins` (`id`, `login`, `password`) VALUES
(1, 'admin', '$2y$12$ET7kIqiQKkukm6ZvkZqB5e0qu1BSiILrTES7deicb1bbpBB7REw7G'),
(2, 'janci', '$2y$12$xrxHA8Ebkw0nfRDncpW1CuNosuZeH8df7m3BLATCXO9HpUVR99IbW'),
(3, 'root', '$2y$12$Ir/5mc91tdOOQzKfNITbaOdRidfeME37hBmgP3VgPG/3kTnQL37j.'),
(4, 'Andrej', '$2y$12$fHBy8Ov.QSyKPGDERSu1eOoZXnyN7S4s1kZOMaJmR2MHHdx54c7gS'),
(5, 'viktor', '$2y$12$kjFvcT8iVb5AOQ0tM0cy/.hKUhhW1qI9ozhtFE9LP24ENGwTNVO/u');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `apis`
--

CREATE TABLE IF NOT EXISTS `apis` (
  `id_key` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `api_key` varchar(200) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

--
-- Sťahujem dáta pre tabuľku `apis`
--

INSERT INTO `apis` (`id_key`, `email`, `api_key`) VALUES
(3, 'rybeckyv@gmail.com', '7f24d240521d99071c93af3917215ef7'),
(4, 'peter@novy.sk', '82cec96096d4281b7c95cd7e74623496'),
(5, 'niekto@gmail.com', '9824f9c1543628a85bb51d2dd6fcf8a3');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(15) NOT NULL,
  `country` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Sťahujem dáta pre tabuľku `location`
--

INSERT INTO `location` (`id`, `ip`, `country`, `city`, `latitude`, `longitude`) VALUES
(1, '147.175.181.136', 'Slovak Republic', 'Bratislava', 48.15, 17.1167),
(2, '147.175.181.234', 'Slovak Republic', 'Bratislava', 48.15, 17.1167),
(3, '195.12.142.153', 'Slovak Republic', 'Bratislava', 48.15, 17.1167),
(4, '95.103.146.163', 'Slovak Republic', 'Žilina', 49.2231, 18.7394);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '""',
  `title_en` varchar(100) COLLATE utf8_bin NOT NULL,
  `text_sk` longtext COLLATE utf8_bin NOT NULL,
  `text_en` longtext COLLATE utf8_bin NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=11 ;

--
-- Sťahujem dáta pre tabuľku `news`
--

INSERT INTO `news` (`id`, `title`, `title_en`, `text_sk`, `text_en`, `date`) VALUES
(1, 'AAAA', 'BBBB', 'CCCC', 'DDDDD', '2016-05-28 16:47:43'),
(2, 'EEEE', 'FFFFF', 'GGGGGG', 'HHHHHH', '2016-05-28 16:47:43'),
(3, 'AAAA', 'BBBB', 'CCCC', 'DDDDD', '2016-05-28 16:47:47'),
(4, 'EEEE', 'FFFFF', 'GGGGGG', 'HHHHHH', '2016-05-28 16:47:47'),
(5, 'Zelený jačmeň', 'Green barley', 'Zelený jačmeň nie je liek, a predsa lieči. Pomoc v širokej škále chorôb ukazuje, že rastlinná miazga podporuje optimálne fungovanie tela a nezameriava sa na určité ochorenia ako lieky. Je zrejmé, že produkt pôsobiaci proti obezite a ekzémom, rovnako ako proti srdcovým chorobám a rakovine, je buď neuveriteľne zázračný liek, alebo liek vôbec žiadny. Mladý jačmeň vykoná skutočný zázrak – pomôže telu, aby sa liečilo samo.', 'Green barley is not a medicine, and cures. Assistance in a wide range of diseases, shows that the optimal functioning of the body and is not intended to support the SAP of the plant for a certain disease as medication. It is clear that the product is active against obesity and eczema, as well as against heart disease and cancer, it is either incredibly miracle cure or medicine No. Sprouted barley performs the actual miracle – will help the body to be treated with itself.', '2016-05-29 19:48:21'),
(6, 'q', '(q)', 'q', '(q)', '2016-05-29 19:50:36'),
(7, 'Skusam aktuality', 'Skusam news', 'Ide toto pridavanie?', 'It is this pridavanie?', '2016-05-29 21:21:57'),
(8, 'Dvere', 'The door', 'Dvere sú zväčša hranaté dosky (pôvodne dve, odtiaľ dve re) vyrobené z lisovaného dreva... a ani z toho niekedy nie. Dvere sú zvesené do rámu (slovensky zárubňa, či firštók) na dva alebo tri pánty (slovensky aj závesy).\r\n\r\nDvere sú jedným z tých vynálezov, ktoré tu boli asi skôr ako okno a počas niekoľkých tisícročí vyvíjali rovnako, ako sa vyvíjali aj napr. ľudia, hudba, ľadový hokej a pokémoni.', 'The doors are mostly angular plates (originally two, hence the two re) made from pressed wood ... and even that sometimes is not. The doors are drooping into the frame (the zárubňa, or firštók) to two or three hinges (English and hinges).\r\n\r\nThe door is one of those inventions that there were probably more than a window and over the millennia evolved as well, as for example, evolved. people, music, hockey, and pokemon.', '2016-05-29 21:32:56'),
(9, 'Bicykel', 'Bike', 'Bicykel je dopravný prostriedok poháňaný pedálmi. S dvomi za sebou umiestnenými kolesami pripevnenými na rám. Prvýkrát bol predstavený v 19. storočí v Európe. Rýchlo sa vyvinul do dnešnej podoby. Bicykel je v mnohých regiónoch jeden zo základných dopravných prostriedkov. Inde je zas jazda na bicykli obľúbenou formou relaxu, ale aj športového vyžitia alebo pretekov.', 'The bicycle is a means of transport powered by pedals. With two wheels attached to a frame located behind. It was first introduced in the 19th century. century in Europe. Quickly evolved into what it is today. The bike is one of the basic means of transport in many regions. Elsewhere is a popular form of relaxation, but also cycling sports or races.', '2016-05-29 21:44:49'),
(10, 'Counter Strike', 'Counter Strike', 'Counter-Strike (skratka CS) je 3D počítačová hra. Je nadstavbou hry Half-Life od spoločnosti Valve Software a Sierra Studios. Táto hra sa môže smelo radiť ku tzv. kultovým hrám. Nie len preto, že vznikla už v roku 1999 (a engine o rok skôr), no najmä preto, lebo komunita tejto hry patrí medzi najväčšie aj v dnešnej dobe a je konkurenciou pre grafické trháky ako Battlefield a Call of Duty.', 'Counter-Strike (CS) is a 3D computer game. The superstructure of the game half-life from Valve Software and the Sierra Studios. This game can be boldly sort to. iconic games. Not just because it was created back in 1999 (and the year before), but mainly because the community of this game belongs to the largest even nowadays and is the competition for blockbusters like the Battlefield and Call of Duty graphics.', '2016-05-29 21:51:30');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `newsusers`
--

CREATE TABLE IF NOT EXISTS `newsusers` (
  `id` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `lang` varchar(5) COLLATE utf8_bin DEFAULT 'sk',
  `hash` varchar(70) COLLATE utf8_bin DEFAULT NULL,
  `verified` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Sťahujem dáta pre tabuľku `newsusers`
--

INSERT INTO `newsusers` (`id`, `email`, `lang`, `hash`, `verified`) VALUES
(0, '', 'sk', 'f63f65b503e22cb970527f23c9ad7db1', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
