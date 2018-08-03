-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 03, 2018 at 10:00 AM
-- Server version: 5.6.37
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mygithub_calendar`
--
CREATE DATABASE IF NOT EXISTS `mygithub_calendar` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `mygithub_calendar`;

-- --------------------------------------------------------

--
-- Table structure for table `dk_calendar_events`
--

CREATE TABLE IF NOT EXISTS `dk_calendar_events` (
  `ID` int(11) NOT NULL,
  `title` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dk_calendar_events`
--

INSERT INTO `dk_calendar_events` (`ID`, `title`, `start`, `end`, `description`) VALUES
(2, 'test1', '2018-08-04 08:30:00', '2018-08-04 12:30:00', 'test 1'),
(3, 'test 2', '2018-08-06 00:00:00', '2018-08-07 00:00:00', 'test 2'),
(4, 'test 3', '2018-08-08 18:00:00', '2018-08-08 19:00:00', ''),
(5, 'test3', '2018-08-04 18:30:00', '2018-08-04 20:00:00', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dk_calendar_events`
--
ALTER TABLE `dk_calendar_events`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dk_calendar_events`
--
ALTER TABLE `dk_calendar_events`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
