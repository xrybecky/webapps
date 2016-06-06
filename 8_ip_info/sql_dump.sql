-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Hostiteľ: localhost
-- Vygenerované: Po 25.Apr 2016, 18:03
-- Verzia serveru: 5.5.44-0ubuntu0.14.04.1
-- Verzia PHP: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáza: `ipstat`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `statistics`
--

CREATE TABLE IF NOT EXISTS `statistics` (
  `id_ip` int(11) NOT NULL AUTO_INCREMENT,
  `page` int(11) NOT NULL,
  `ip` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `country_icon` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lon` float DEFAULT NULL,
  `lat` float DEFAULT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id_ip`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=113 ;

--
-- Sťahujem dáta pre tabuľku `statistics`
--

INSERT INTO `statistics` (`id_ip`, `page`, `ip`, `country`, `country_icon`, `city`, `lon`, `lat`, `datetime`) VALUES
(73, 1, '77.48.21.138', 'Czech Republic', 'http://www.geonames.org/flags/x/cz.gif', '664 31 Česká', 16.5648, 49.2814, '2016-04-23 17:28:17'),
(74, 3, '77.48.21.138', 'Czech Republic', 'http://www.geonames.org/flags/x/cz.gif', '664 31 Česká', 16.5648, 49.2814, '2016-04-23 17:28:28'),
(75, 2, '77.48.21.138', 'Czech Republic', 'http://www.geonames.org/flags/x/cz.gif', '664 31 Česká', 16.5648, 49.2814, '2016-04-23 17:28:33'),
(76, 2, '77.48.21.138', 'Czech Republic', 'http://www.geonames.org/flags/x/cz.gif', '664 31 Česká', 16.5648, 49.2814, '2016-04-23 17:28:33'),
(77, 1, '31.13.110.107', 'Sweden', 'http://www.geonames.org/flags/x/se.gif', 'Luleå', 22.1567, 65.5848, '2016-04-23 18:28:21'),
(78, 1, '188.123.110.51', 'Slovakia', 'http://www.geonames.org/flags/x/sk.gif', '033 01 Liptovský Hrádok', 19.7234, 49.0396, '2016-04-23 18:28:56'),
(79, 3, '188.123.110.51', 'Slovakia', 'http://www.geonames.org/flags/x/sk.gif', '033 01 Liptovský Hrádok', 19.7234, 49.0396, '2016-04-23 18:29:08'),
(80, 2, '188.123.110.51', 'Slovakia', 'http://www.geonames.org/flags/x/sk.gif', '033 01 Liptovský Hrádok', 19.7234, 49.0396, '2016-04-23 18:29:25'),
(81, 3, '31.13.110.109', 'Sweden', 'http://www.geonames.org/flags/x/se.gif', 'Luleå', 22.1567, 65.5848, '2016-04-23 18:35:06'),
(82, 3, '31.13.112.116', 'Sweden', 'http://www.geonames.org/flags/x/se.gif', 'Luleå', 22.1567, 65.5848, '2016-04-23 18:37:19'),
(83, 1, '31.13.112.116', 'Sweden', 'http://www.geonames.org/flags/x/se.gif', 'Luleå', 22.1567, 65.5848, '2016-04-23 18:39:37'),
(87, 1, '178.41.223.32', 'Slovakia', 'http://www.geonames.org/flags/x/sk.gif', 'Križovany nad Dudváhom', 17.6497, 48.317, '2016-04-23 18:44:55'),
(88, 2, '178.41.223.32', 'Slovakia', 'http://www.geonames.org/flags/x/sk.gif', 'Križovany nad Dudváhom', 17.6497, 48.317, '2016-04-23 18:45:07'),
(89, 3, '178.41.223.32', 'Slovakia', 'http://www.geonames.org/flags/x/sk.gif', 'Križovany nad Dudváhom', 17.6497, 48.317, '2016-04-23 18:45:13'),
(90, 1, '84.47.37.186', 'Slovakia', 'http://www.geonames.org/flags/x/sk.gif', 'Bratislava', 17.1167, 48.15, '2016-04-23 19:20:26'),
(91, 2, '84.47.37.186', 'Slovakia', 'http://www.geonames.org/flags/x/sk.gif', 'Bratislava', 17.1167, 48.15, '2016-04-23 19:20:35'),
(92, 3, '84.47.37.186', 'Slovakia', 'http://www.geonames.org/flags/x/sk.gif', 'Bratislava', 17.1167, 48.15, '2016-04-23 19:20:42'),
(93, 1, '66.249.93.8', 'USA', 'http://www.geonames.org/flags/x/us.gif', 'Mountain View', -122.085, 37.4229, '2016-04-23 10:27:43'),
(94, 3, '147.175.137.242', 'Slovakia', 'http://www.geonames.org/flags/x/sk.gif', 'Bratislava', 17.1167, 48.15, '2016-04-23 19:36:46'),
(95, 1, '147.175.137.242', 'Slovakia', 'http://www.geonames.org/flags/x/sk.gif', 'Bratislava', 17.1167, 48.15, '2016-04-23 19:36:55'),
(96, 2, '147.175.137.242', 'Slovakia', 'http://www.geonames.org/flags/x/sk.gif', 'Bratislava', 17.1167, 48.15, '2016-04-23 19:36:56'),
(97, 2, '84.47.37.186', 'Slovakia', 'http://www.geonames.org/flags/x/sk.gif', 'Bratislava', 17.1167, 48.15, '2016-04-24 08:00:00'),
(98, 2, '188.123.110.51', 'Slovakia', 'http://www.geonames.org/flags/x/sk.gif', '033 01 Liptovský Hrádok', 19.7234, 49.0396, '2016-04-25 08:29:25'),
(99, 1, '84.47.37.186', 'Slovakia', 'http://www.geonames.org/flags/x/sk.gif', 'Bratislava', 17.1167, 48.15, '2016-04-23 07:20:26'),
(100, 1, '95.154.230.253', 'Nelokalizované', 'http://www.geonames.org/flags/x/gb.gif', '*Nepodarilo sa lokalizovať', 0.871124, 52.5107, '2016-04-24 10:39:04'),
(101, 3, '95.154.230.253', 'Nelokalizované', 'http://www.geonames.org/flags/x/gb.gif', '*Nepodarilo sa lokalizovať', 0.871124, 52.5107, '2016-04-24 10:39:13'),
(102, 2, '95.154.230.253', 'Nelokalizované', 'http://www.geonames.org/flags/x/gb.gif', '*Nepodarilo sa lokalizovať', 0.871124, 52.5107, '2016-04-24 10:39:32'),
(103, 1, '95.102.116.103', 'Slovakia', 'http://www.geonames.org/flags/x/sk.gif', '985 05 Kokava nad Rimavicou', 19.8435, 48.5689, '2016-04-24 13:44:41'),
(104, 2, '95.102.116.103', 'Slovakia', 'http://www.geonames.org/flags/x/sk.gif', '985 05 Kokava nad Rimavicou', 19.8435, 48.5689, '2016-04-24 13:44:59'),
(105, 3, '95.102.116.103', 'Slovakia', 'http://www.geonames.org/flags/x/sk.gif', '985 05 Kokava nad Rimavicou', 19.8435, 48.5689, '2016-04-24 13:45:07'),
(106, 1, '95.105.243.64', 'Slovakia', 'http://www.geonames.org/flags/x/sk.gif', 'Trnava', 17.5872, 48.3774, '2016-04-24 19:15:38'),
(107, 3, '95.105.243.64', 'Slovakia', 'http://www.geonames.org/flags/x/sk.gif', 'Trnava', 17.5872, 48.3774, '2016-04-24 19:16:06'),
(108, 2, '95.105.243.64', 'Slovakia', 'http://www.geonames.org/flags/x/sk.gif', 'Trnava', 17.5872, 48.3774, '2016-04-24 19:16:19'),
(109, 1, '147.175.181.136', 'Slovakia', 'http://www.geonames.org/flags/x/sk.gif', 'Bratislava', 17.1167, 48.15, '2016-04-24 21:15:33'),
(110, 2, '147.175.181.136', 'Slovakia', 'http://www.geonames.org/flags/x/sk.gif', 'Bratislava', 17.1167, 48.15, '2016-04-24 21:15:42'),
(111, 3, '147.175.181.136', 'Slovakia', 'http://www.geonames.org/flags/x/sk.gif', 'Bratislava', 17.1167, 48.15, '2016-04-24 21:15:46'),
(112, 1, '66.249.93.5', 'USA', 'http://www.geonames.org/flags/x/us.gif', 'Mountain View', -122.085, 37.4229, '2016-04-24 23:33:49');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
