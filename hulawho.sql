-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 12, 2014 at 09:49 PM
-- Server version: 5.5.35
-- PHP Version: 5.3.10-1ubuntu3.11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `7arts`
--

-- --------------------------------------------------------

--
-- Table structure for table `flags`
--

CREATE TABLE IF NOT EXISTS `flags` (
  `team_id` int(11) NOT NULL AUTO_INCREMENT,
  `teams` text COLLATE utf8_unicode_ci NOT NULL,
  `flag` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`team_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=33 ;

--
-- Dumping data for table `flags`
--

INSERT INTO `flags` (`team_id`, `teams`, `flag`) VALUES
(1, 'Algeria', 'alg'),
(2, 'Argentina', 'arg'),
(3, 'Australia', 'aus'),
(4, 'Belgium', 'bel'),
(5, 'Bosnia-Herzegovina', 'bih'),
(6, 'Brazil', 'bra'),
(7, 'Chile', 'chi'),
(8, 'Ivory Coast', 'civ'),
(9, 'Cameroon', 'cmr'),
(10, 'Colombia', 'col'),
(11, 'Costa Rica', 'crc'),
(12, 'Croatia', 'cro'),
(13, 'Ecuador', 'ecu'),
(14, 'England', 'eng'),
(15, 'Spain', 'esp'),
(16, 'France', 'fra'),
(17, 'Germany', 'ger'),
(18, 'Ghana', 'gha'),
(19, 'Greece', 'gre'),
(20, 'Honduras', 'hon'),
(21, 'Iran', 'irn'),
(22, 'Italy', 'ita'),
(23, 'Japan', 'jpn'),
(24, 'South Korea', 'kor'),
(25, 'Mexico', 'mex'),
(26, 'Netherlands', 'ned'),
(27, 'Nigeria', 'nga'),
(28, 'Portugal', 'por'),
(29, 'Russia', 'rus'),
(30, 'Switzerland', 'sui'),
(31, 'Uruguay', 'uru'),
(32, 'USA', 'usa');

-- --------------------------------------------------------

--
-- Table structure for table `gameday`
--

CREATE TABLE IF NOT EXISTS `gameday` (
  `gameday` int(11) NOT NULL,
  `time` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE IF NOT EXISTS `matches` (
  `match_id` int(11) NOT NULL AUTO_INCREMENT,
  `time` text COLLATE utf8_unicode_ci NOT NULL,
  `group` text COLLATE utf8_unicode_ci NOT NULL,
  `team_a` text COLLATE utf8_unicode_ci NOT NULL,
  `team_b` text COLLATE utf8_unicode_ci NOT NULL,
  `unix_time` text COLLATE utf8_unicode_ci NOT NULL,
  `is_over` tinyint(1) NOT NULL DEFAULT '0',
  `a_score` int(11) NOT NULL,
  `b_score` int(11) NOT NULL,
  `gameday` int(11) NOT NULL,
  PRIMARY KEY (`match_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=49 ;

--
-- Dumping data for table `matches`
--

INSERT INTO `matches` (`match_id`, `time`, `group`, `team_a`, `team_b`, `unix_time`, `is_over`, `a_score`, `b_score`, `gameday`) VALUES
(1, '6/13/2014 1:00', 'A', 'Brazil', 'Croatia', '1402621200', 1, 3, 0, 1),
(2, '6/13/2014 21:00', 'A', 'Mexico', 'Cameroon', '1402693200', 1, 0, 0, 2),
(3, '6/14/2014 0:00', 'B', 'Spain', 'Netherlands', '1402704000', 0, 0, 0, 2),
(4, '6/14/2014 3:00', 'B', 'Chile', 'Australia', '1402714800', 0, 0, 0, 2),
(5, '6/14/2014 21:00', 'C', 'Colombia', 'Greece', '1402779600', 0, 0, 0, 3),
(6, '6/15/2014 0:00', 'D', 'Uruguay', 'Costa Rica', '1402790400', 0, 0, 0, 3),
(7, '6/15/2014 3:00', 'D', 'England', 'Italy', '1402801200', 0, 0, 0, 3),
(8, '6/15/2014 6:00', 'C', 'Ivory Coast', 'Japan', '1402812000', 0, 0, 0, 3),
(9, '6/15/2014 12:00', 'E', 'Switzerland', 'Ecuador', '1402833600', 0, 0, 0, 4),
(10, '6/16/2014 0:00', 'E', 'France', 'Honduras', '1402876800', 0, 0, 0, 4),
(11, '6/16/2014 3:00', 'F', 'Argentina', 'Bosnia-Herzegovina', '1402887600', 0, 0, 0, 4),
(12, '6/16/2014 21:00', 'G', 'Germany', 'Portugal', '1402952400', 0, 0, 0, 5),
(13, '6/17/2014 0:00', 'F', 'Iran', 'Nigeria', '1402963200', 0, 0, 0, 5),
(14, '6/17/2014 3:00', 'G', 'Ghana', 'USA', '1402974000', 0, 0, 0, 5),
(15, '6/17/2014 21:00', 'H', 'Belgium', 'Algeria', '1403038800', 0, 0, 0, 6),
(16, '6/18/2014 0:00', 'A', 'Brazil', 'Mexico', '1403049600', 0, 0, 0, 6),
(17, '6/18/2014 3:00', 'H', 'Russia', 'South Korea', '1403060400', 0, 0, 0, 6),
(18, '6/18/2014 21:00', 'B', 'Australia', 'Netherlands', '1403125200', 0, 0, 0, 7),
(19, '6/19/2014 0:00', 'B', 'Spain', 'Chile', '1403136000', 0, 0, 0, 7),
(20, '6/19/2014 3:00', 'A', 'Cameroon', 'Croatia', '1403146800', 0, 0, 0, 7),
(21, '6/19/2014 21:00', 'C', 'Colombia', 'Ivory Coast', '1403211600', 0, 0, 0, 8),
(22, '6/20/2014 0:00', 'D', 'Uruguay', 'England', '1403222400', 0, 0, 0, 8),
(23, '6/20/2014 3:00', 'C', 'Japan', 'Greece', '1403233200', 0, 0, 0, 8),
(24, '6/20/2014 21:00', 'D', 'Italy', 'Costa Rica', '1403298000', 0, 0, 0, 9),
(25, '6/21/2014 0:00', 'E', 'Switzerland', 'France', '1403308800', 0, 0, 0, 9),
(26, '6/21/2014 3:00', 'E', 'Honduras', 'Ecuador', '1403319600', 0, 0, 0, 9),
(27, '6/21/2014 21:00', 'F', 'Argentina', 'Iran', '1403384400', 0, 0, 0, 10),
(28, '6/22/2014 0:00', 'G', 'Germany', 'Ghana', '1403395200', 0, 0, 0, 10),
(29, '6/22/2014 3:00', 'F', 'Nigeria', 'Bosnia-Herzegovina', '1403406000', 0, 0, 0, 10),
(30, '6/22/2014 21:00', 'H', 'Belgium', 'Russia', '1403452800', 0, 0, 0, 11),
(31, '6/23/2014 0:00', 'H', 'South Korea', 'Algeria', '1403481600', 0, 0, 0, 11),
(32, '6/23/2014 3:00', 'G', 'USA', 'Portugal', '1403492400', 0, 0, 0, 11),
(33, '6/23/2014 21:00', 'B', 'Australia', 'Spain', '1403557200', 0, 0, 0, 12),
(34, '6/23/2014 21:00', 'B', 'Netherlands', 'Chile', '1403557200', 0, 0, 0, 12),
(35, '6/24/2014 1:00', 'A', 'Cameroon', 'Brazil', '1403571600', 0, 0, 0, 12),
(36, '6/24/2014 1:00', 'A', 'Croatia', 'Mexico', '1403571600', 0, 0, 0, 12),
(37, '6/24/2014 21:00', 'D', 'Costa Rica', 'England', '1403643600', 0, 0, 0, 13),
(38, '6/24/2014 21:00', 'D', 'Italy', 'Uruguay', '1403643600', 0, 0, 0, 13),
(39, '6/25/2014 1:00', 'C', 'Greece', 'Ivory Coast', '1403658000', 0, 0, 0, 13),
(40, '6/25/2014 1:00', 'C', 'Japan', 'Colombia', '1403658000', 0, 0, 0, 13),
(41, '6/25/2014 21:00', 'F', 'Bosnia-Herzegovina', 'Iran', '1403730000', 0, 0, 0, 14),
(42, '6/25/2014 21:00', 'F', 'Nigeria', 'Argentina', '1403730000', 0, 0, 0, 14),
(43, '6/26/2014 1:00', 'E', 'Ecuador', 'France', '1403744400', 0, 0, 0, 14),
(44, '6/26/2014 1:00', 'E', 'Honduras', 'Switzerland', '1403744400', 0, 0, 0, 14),
(45, '6/26/2014 21:00', 'G', 'Portugal', 'Ghana', '1403816400', 0, 0, 0, 15),
(46, '6/26/2014 21:00', 'G', 'USA', 'Germany', '1403816400', 0, 0, 0, 15),
(47, '6/27/2014 1:00', 'H', 'Algeria', 'Russia', '1403830800', 0, 0, 0, 15),
(48, '6/27/2014 1:00', 'H', 'South Korea', 'Belgium', '1403830800', 0, 0, 0, 15);

-- --------------------------------------------------------

--
-- Table structure for table `predictions`
--

CREATE TABLE IF NOT EXISTS `predictions` (
  `entry_id` int(11) NOT NULL AUTO_INCREMENT,
  `match_id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `team_a` int(11) NOT NULL,
  `team_b` int(11) NOT NULL,
  `username` text COLLATE utf8_unicode_ci NOT NULL,
  `is_checked` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`entry_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- Dumping data for table `predictions`
--

INSERT INTO `predictions` (`entry_id`, `match_id`, `time`, `team_a`, `team_b`, `username`, `is_checked`) VALUES
(22, 1, '2014-06-12 16:41:10', 3, 0, 'afmoosa', 0);

-- --------------------------------------------------------

--
-- Table structure for table `rankings`
--

CREATE TABLE IF NOT EXISTS `rankings` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `rank` int(11) DEFAULT NULL,
  `username` text COLLATE utf8_unicode_ci NOT NULL,
  `gd_total` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `rankings`
--

INSERT INTO `rankings` (`user_id`, `rank`, `username`, `gd_total`, `total`) VALUES
(13, NULL, 'afmoosa', 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES
(23, 'afmoosa', '8053c1d2852a39dfbba55e422fb7117f', 'a.f.moosa@gmail.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
