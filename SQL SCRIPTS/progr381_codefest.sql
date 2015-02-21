-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 21, 2015 at 02:57 PM
-- Server version: 5.5.41-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `codefest`
--
CREATE DATABASE IF NOT EXISTS `codefest` DEFAULT CHARACTER SET latin1 COLLATE latin1_general_ci;
USE `codefest`;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
CREATE TABLE IF NOT EXISTS `companies` (
  `CompanyID` int(11) NOT NULL AUTO_INCREMENT,
  `Description` text COLLATE latin1_general_ci NOT NULL,
  `Address` text COLLATE latin1_general_ci NOT NULL,
  `Phone` text COLLATE latin1_general_ci NOT NULL,
  `Email` text COLLATE latin1_general_ci NOT NULL,
  `CompanyName` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`CompanyID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `companyjobs`
--

DROP TABLE IF EXISTS `companyjobs`;
CREATE TABLE IF NOT EXISTS `companyjobs` (
  `CompanyID` int(11) NOT NULL,
  `JobID` int(11) NOT NULL,
  PRIMARY KEY (`CompanyID`,`JobID`),
  KEY `JobID` (`JobID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `JobID` int(11) NOT NULL AUTO_INCREMENT,
  `JobTitle` text COLLATE latin1_general_ci NOT NULL,
  `Description` text COLLATE latin1_general_ci NOT NULL,
  `Requirements` text COLLATE latin1_general_ci NOT NULL,
  `Salary` int(11) NOT NULL,
  `StartDate` datetime DEFAULT NULL,
  `EndDate` datetime DEFAULT NULL,
  `Benefits` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`JobID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `RoleID` int(11) NOT NULL AUTO_INCREMENT,
  `RoleName` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`RoleID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `TagID` int(11) NOT NULL AUTO_INCREMENT,
  `TagText` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`TagID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `userroles`
--

DROP TABLE IF EXISTS `userroles`;
CREATE TABLE IF NOT EXISTS `userroles` (
  `RoleID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `CompanyID` int(11) NOT NULL,
  PRIMARY KEY (`RoleID`,`UserID`),
  KEY `CompanyID` (`CompanyID`),
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `Password` text COLLATE latin1_general_ci NOT NULL,
  `Email` text COLLATE latin1_general_ci NOT NULL,
  `Phone` text COLLATE latin1_general_ci NOT NULL,
  `FirstName` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `LastName` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `MiddleInitial` varchar(1) COLLATE latin1_general_ci NOT NULL,
  `Suffix` varchar(6) COLLATE latin1_general_ci NOT NULL COMMENT 'Junior, Senior, Jr, Sr, III, etc',
  `Salt` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`UserID`),
  UNIQUE KEY `Username` (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `usertags`
--

DROP TABLE IF EXISTS `usertags`;
CREATE TABLE IF NOT EXISTS `usertags` (
  `UserID` int(11) NOT NULL,
  `TagID` int(11) NOT NULL,
  PRIMARY KEY (`UserID`,`TagID`),
  KEY `TagID` (`TagID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `companyjobs`
--
ALTER TABLE `companyjobs`
  ADD CONSTRAINT `companyjobs_ibfk_2` FOREIGN KEY (`JobID`) REFERENCES `jobs` (`JobID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `companyjobs_ibfk_1` FOREIGN KEY (`CompanyID`) REFERENCES `companies` (`CompanyID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `userroles`
--
ALTER TABLE `userroles`
  ADD CONSTRAINT `userroles_ibfk_3` FOREIGN KEY (`CompanyID`) REFERENCES `companies` (`CompanyID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userroles_ibfk_1` FOREIGN KEY (`RoleID`) REFERENCES `roles` (`RoleID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userroles_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usertags`
--
ALTER TABLE `usertags`
  ADD CONSTRAINT `usertags_ibfk_2` FOREIGN KEY (`TagID`) REFERENCES `tags` (`TagID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usertags_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
