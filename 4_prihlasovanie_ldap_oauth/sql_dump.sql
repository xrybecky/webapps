-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Hostiteľ: localhost
-- Vygenerované: Po 14.Mar 2016, 18:46
-- Verzia serveru: 5.5.44-0ubuntu0.14.04.1
-- Verzia PHP: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáza: `authentication`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `logins`
--

CREATE TABLE IF NOT EXISTS `logins` (
  `id_login` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `type` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_login`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=354 ;

--
-- Sťahujem dáta pre tabuľku `logins`
--

INSERT INTO `logins` (`id_login`, `user_login`, `date`, `type`) VALUES
(339, 'ferko', '2016-03-14 16:46:11', 'form'),
(340, 'Viktor Rybecký', '2016-03-14 16:46:41', 'gmail'),
(341, 'xrybeckyv', '2016-03-14 16:46:59', 'ldap'),
(342, 'Viktor Rybecký', '2016-03-14 16:59:12', 'gmail'),
(343, 'xrybeckyv', '2016-03-14 17:01:03', 'ldap'),
(344, 'ferko', '2016-03-14 17:06:39', 'form'),
(345, 'ferko', '2016-03-14 17:09:54', 'form'),
(346, 'ferko', '2016-03-14 17:12:17', 'form'),
(347, 'Viktor Rybecký', '2016-03-14 17:13:32', 'gmail'),
(348, 'Viktor Rybecký', '2016-03-14 17:14:21', 'gmail'),
(349, 'xrybeckyv', '2016-03-14 17:14:39', 'ldap'),
(350, 'Viktor Rybecký', '2016-03-14 17:15:37', 'gmail'),
(351, 'Viktor Rybecký', '2016-03-14 17:16:27', 'gmail'),
(352, 'ferko', '2016-03-14 17:32:15', 'form'),
(353, 'xrybeckyv', '2016-03-14 17:45:34', 'ldap');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `registrations`
--

CREATE TABLE IF NOT EXISTS `registrations` (
  `id_user` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `login` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Sťahujem dáta pre tabuľku `registrations`
--

INSERT INTO `registrations` (`id_user`, `name`, `surname`, `email`, `login`, `password`) VALUES
(16, 'Fero', 'Kôň', 'kon@fero.sk', 'ferko', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oauth_provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `oauth_uid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `gpluslink` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
