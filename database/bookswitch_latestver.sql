-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 14, 2020 at 10:35 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookswitch`
--
CREATE DATABASE IF NOT EXISTS `bookswitch` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `bookswitch`;

-- --------------------------------------------------------

--
-- Table structure for table `bookmark`
--

DROP TABLE IF EXISTS `bookmark`;
CREATE TABLE IF NOT EXISTS `bookmark` (
  `userID` varchar(255) NOT NULL,
  `isbn` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `listings`
--

DROP TABLE IF EXISTS `listings`;
CREATE TABLE IF NOT EXISTS `listings` (
  `userID` varchar(255) NOT NULL,
  `isbn` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `listings`
--

INSERT INTO `listings` (`userID`, `isbn`, `status`) VALUES
('amy', '9781465596178', 'NO'),
('amy', '9788804584377', 'NO'),
('amy', '9781416938156', 'NO'),
('amy', '9788482600307', 'NO'),
('amy', '9780671027421', 'NO'),
('amy', '0593071719', 'NO'),
('amy', '9781491458518', 'NO'),
('amy', '9781864718409', 'NO'),
('amy', '1741141788', 'NO'),
('amy', '9781616550547', 'NO'),
('amy', '140954562', 'NO');

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

DROP TABLE IF EXISTS `person`;
CREATE TABLE IF NOT EXISTS `person` (
  `userID` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `bookens` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`userID`, `name`, `password`, `email`, `bookens`) VALUES
('Amy', 'Amy Lim', 'amy123', 'amylim@gmail.com', '800');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

DROP TABLE IF EXISTS `ratings`;
CREATE TABLE IF NOT EXISTS `ratings` (
  `isbn` varchar(100) NOT NULL,
  `totalRate` int(100) NOT NULL,
  `noPpl` int(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`isbn`, `totalRate`, `noPpl`) VALUES
('9781465596178', 20, 5),
('9788804584377', 10, 5),
('9781416938156', 30, 5),
('9788482600307', 25, 5),
('9780671027421', 10, 5),
('0593071719', 14, 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
