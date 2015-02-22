-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 21, 2015 at 07:37 PM
-- Server version: 5.5.41-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.6

SET FOREIGN_KEY_CHECKS=0;
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`CompanyID`, `Description`, `Address`, `Phone`, `Email`, `CompanyName`) VALUES
(1, 'PPG Industries is an American global supplier of paints, coatings, optical products, specialty materials, chemicals, glass, and fiberglass. With headquarters in Pittsburgh, Pennsylvania, PPG operates in more than 70 countries around the globe.', '1 PPG Place\r\nPittsburgh, PA 15222', '412-434-3131', 'help@ppg.com', 'PPG Industries'),
(2, 'The H. J. Heinz Company, or Heinz, is an American food processing company with world headquarters in Pittsburgh, Pennsylvania. It was founded by Henry Heinz in 1888.', '1250 Penn Ave\r\nPittsburgh, PA 15222', '800-959-4432', 'help@heinz.com', 'Heinz'),
(3, 'The Rivers Casino is a casino in Pittsburgh, Pennsylvania, USA. It is owned by Holdings Acquisition Co. L.P., a joint venture of Walton Street Capital LLC and High Pitt Gaming LP', '777 Casino Drive\r\nPittsburgh, PA 15212', '412-777-7777', 'help@riverscasino.com', 'Rivers Casino'),
(4, 'A for profit education company', '1400 Penn Ave\r\nPittsburgh, PA 15222', '866-421-4643', 'help@edmc.edu', 'EDMC'),
(5, 'A hospital providing care for many different areas', '353 5th Ave\r\nPittsburgh, PA 15222', '800-353-9999', 'help@upmc.com', 'UPMC'),
(6, 'PNC Financial Services Group, Inc. is an American financial services corporation, with assets of approximately $271.2 billion.', '4600 5th Ave\r\nPittsburgh, PA 15212', '412-999-5555', 'help@pnc.com', 'PNC Bank'),
(7, 'Grocery store specializing in seafood', '1501 Penn Ave, Pittsburgh, PA', '412-949-3210', 'mike@wholeys.com', 'Wholey''s'),
(8, 'Medical company in the Pittsburgh area.', 'Campbells Run Rd\r\nPittsburgh, PA', '412-949-9911', 'help@bayer.com', 'Bayer'),
(9, 'The Carnegie Library of Pittsburgh is the public library system in Pittsburgh, Pennsylvania. Its main branch is located in the Oakland neighborhood of Pittsburgh, and it has 19 branch locations throughout the city.', '4400 Forbes Ave\r\nPittsburgh, PA', '412-777-9999', 'help@carnegielibrary.com', 'Carnegie Library');

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

--
-- Dumping data for table `companyjobs`
--

INSERT INTO `companyjobs` (`CompanyID`, `JobID`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 4),
(2, 5),
(3, 6),
(4, 7),
(4, 8),
(6, 8),
(4, 9),
(4, 10),
(5, 11),
(5, 12),
(5, 13),
(6, 14),
(6, 16),
(2, 17),
(7, 18),
(7, 19),
(7, 20),
(7, 21),
(8, 22),
(8, 23),
(8, 24),
(8, 25),
(8, 26),
(9, 27),
(9, 28),
(9, 29),
(4, 30),
(3, 31);

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
  `Salary` text COLLATE latin1_general_ci NOT NULL,
  `StartDate` datetime DEFAULT NULL,
  `EndDate` datetime DEFAULT NULL,
  `Benefits` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`JobID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=32 ;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`JobID`, `JobTitle`, `Description`, `Requirements`, `Salary`, `StartDate`, `EndDate`, `Benefits`) VALUES
(1, 'Janitor', 'To clean the buildings', 'High school diploma', '$11 per hour', '2015-02-21 16:57:04', '2015-02-28 16:57:04', 'Medical benefits, paid time off, 401k match'),
(2, 'Sales Rep', 'To sell the products of PPG out on the road', '3+ years experience in sales.', '$35,000 per year', '1969-12-31 19:00:00', '2015-05-03 00:00:00', 'Paid training, work vehicle, work cell phone, 401k, paid time off'),
(3, 'Help Desk', 'To provide technical support for all employees of PPG', 'PHP, MySQL, C#', '$40,000 per year', '1969-12-31 19:00:00', '1969-12-31 19:00:00', '401k, vacation, medical'),
(4, 'Help Desk', 'To provide customer service for technical help', 'High school diploma', '35,000 per year', '2015-02-21 00:00:00', '2015-02-23 00:00:00', 'Paid time off, medical, 401k match'),
(5, 'IT Support', 'To provide support and help for customers in technical areas.', 'Associates degree', '$38,000 per year', '1969-12-31 19:00:00', '1969-12-31 19:00:00', 'Paid time off, 401k, medical, dental, work cell phone, work car'),
(6, 'Dealer', 'Dealing poker games', 'Licensed dealer certification', '$44,000 per year', '2015-02-21 17:10:41', '2015-04-21 17:10:41', '401k, paid time off, medical benefits'),
(7, 'Desktop Analyst', 'To provide hands on technical support for employees', '1 year experience in desktop support and a related bachelor''s degree', '$38,000 per year', '2015-02-20 00:00:00', '2015-03-21 00:00:00', 'Paid time off, medical, dental, 401k match'),
(8, 'Support Analyst', 'To provide technical support to customers over the phone and through email.', 'Experience in a similar role and/or a college degree', '$36,000 per year', '1969-12-31 19:00:00', '1969-12-31 19:00:00', 'Vacation, medical, retirement'),
(9, 'Academic Counselor', 'To provide any type of assistance for students.', 'Experience in a similar job and an associates degree', '$32,000', '2015-11-02 00:00:00', '2015-10-04 00:00:00', 'Paid time off, vacation, medical benefits.'),
(10, 'Janitor', 'To clean the buildings', 'High school diploma', '$9.50 per hour', '1969-12-31 19:00:00', '2015-03-03 00:00:00', 'Paid time off, medical benefits'),
(11, 'Network Analyst', 'To support the networks at UPMC', 'Bachelor''s degree', '$44,000 per year', '2015-02-21 00:00:00', '2015-03-01 00:00:00', 'Vacation, health insurance, dental, vision, 401k.'),
(12, 'Help Desk', 'To provide technical support for all employees of UPMC', '2+ years experience, bachelor''s degree', '$42,000 per year', '1969-12-31 19:00:00', '2015-11-03 00:00:00', 'Health benefits, vision, dental, retirement, vacation.'),
(13, 'IT Support', 'To provide IT support for all departments of UPMC', 'Bachelor''s degree', '$39,000 per year', '1969-12-31 19:00:00', '2015-11-06 00:00:00', 'Vacation, health benefits, retirement plan.'),
(14, 'Teller I', 'To provide teller services for all clients in the bank.', 'High school diploma, experience', '$9.75 per hour', '2015-02-21 00:00:00', '2015-02-26 00:00:00', 'Medical, dental, vision, 401k'),
(15, 'Support Analyst', 'To provide technical support to all employees.', 'Associates degree and/or experience', '$37,000 per year', '1969-12-31 19:00:00', '1969-12-31 19:00:00', 'Health benefits, vacation, 401k.'),
(16, 'Financial Advisor', 'To provide financial advise to customers in a one on one setting.', 'Bachelor''s degree in a related field and/or experience', '$46,000 per year', '1969-12-31 19:00:00', '2015-10-03 00:00:00', 'Health benefits, Retirement, Vacation'),
(17, 'HR Rep', 'To work in the HR department', 'Past experience, associates degree', '$24,000 per year', '2015-02-21 00:00:00', '2015-02-27 00:00:00', '401k, health benefits, vacation'),
(18, 'Sushi chef', 'Prepare and cook sushi', 'Past experience, high school diploma', '$10 per hour', '2015-02-21 00:00:00', '2015-02-24 00:00:00', 'Paid time off'),
(19, 'Manager', 'To manage the entire story of Wholey''s.', 'Bachelor''s degree, 5+ years experience in grocery management', '$44,000 per year', '2015-02-19 00:00:00', '2015-05-04 00:00:00', 'Paid time off, 401k, health benefits, company cell phone.'),
(20, 'Cook', 'To prepare and cook meals for customers at Wholey''s.', 'Any cooking experience', '$8.20 per hour', '2015-02-21 00:00:00', '2015-02-27 00:00:00', 'Uniforms'),
(21, 'Help Desk', 'To provide technical support to anyone within Wholey''s company.', 'Past experience, associates degree', '$17.00 per hour', '2015-02-21 00:00:00', '2015-02-21 00:00:00', 'Paid time off, health benefits'),
(22, 'Sales Rep', 'To go out and maintain an outside sales route', 'Sales experience of 2 years + and a bachelor''s degree', '$48,000 per year', '2015-02-23 00:00:00', '2015-02-27 00:00:00', 'Paid time off, health benefits, retirement package'),
(23, 'Delivery Driver', 'To make delivery to different stops in the Pittsburgh area.', 'Delivery driver experience', '$13.50 per hour', '2015-02-25 00:00:00', '2015-03-02 00:00:00', 'Vacation, health benefits, retirement package'),
(24, 'Receptionist', 'To answer phone calls and greet customers as they walk into the establishment', 'Past experience, high school diploma', '$11.20 per hour', '2015-02-21 00:00:00', '2015-02-25 00:00:00', '1 week vacation per year'),
(25, 'Cashier', 'To take payment from customers who are exiting the building.', 'Past experience as a cashier', '$10.25 per hour', '2015-02-21 00:00:00', '2015-04-11 00:00:00', 'Vacation'),
(26, 'Janitor', 'To clean the buildings on the property', 'Past experience', '$11.00 per hour', '2015-02-21 00:00:00', '2015-04-15 00:00:00', 'Vacation'),
(27, 'Librarian', 'To assist visitors to the library with research, purchases, etc.', 'Prior experience, high school diploma.', '$14.00 per hour', '2015-02-21 00:00:00', '2015-07-01 00:00:00', 'Health benefits'),
(28, 'Support Analyst', 'To provide technical support to all employees and customers at the libraries.', 'IT, bachelor''s degree', '$40,000 per year', '2015-02-21 00:00:00', '2016-02-21 00:00:00', '401k match, health benefits, paid vacation'),
(29, 'Security', 'To make sure the libraries are very secure.', 'Security experience and high school diploma', '$14.50 per hour', '2015-02-21 00:00:00', '2015-07-01 00:00:00', 'Paid vacation'),
(30, 'Security', 'To provide security to the buildings for EDMC.', 'Security experience, high school diploma', '$11.00 per hour', '2015-02-21 00:00:00', '2015-04-02 00:00:00', 'Health benefits'),
(31, 'Host', 'To greet guests and provide them with insight and help with their visit.', 'Past experience working as a casino host. High school diploma.', '$46,000 per year', '2015-02-21 00:00:00', '2015-05-19 00:00:00', 'Paid vacation, health benefits, retirement plan, company cell phone.');

-- --------------------------------------------------------

--
-- Table structure for table `jobtags`
--

DROP TABLE IF EXISTS `jobtags`;
CREATE TABLE IF NOT EXISTS `jobtags` (
  `JobID` int(11) NOT NULL,
  `TagID` int(11) NOT NULL,
  PRIMARY KEY (`JobID`,`TagID`),
  KEY `TagID` (`TagID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `jobtags`
--

INSERT INTO `jobtags` (`JobID`, `TagID`) VALUES
(1, 2),
(2, 2),
(3, 2),
(1, 3),
(2, 3),
(3, 3),
(4, 3),
(5, 3),
(6, 3),
(7, 3),
(8, 3),
(9, 3),
(10, 3),
(11, 3),
(12, 3),
(13, 3),
(17, 3),
(30, 3),
(31, 3);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `RoleID` int(11) NOT NULL AUTO_INCREMENT,
  `RoleName` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`RoleID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`RoleID`, `RoleName`) VALUES
(1, 'Candidate'),
(2, 'Employer');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `TagID` int(11) NOT NULL AUTO_INCREMENT,
  `TagText` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`TagID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`TagID`, `TagText`) VALUES
(1, 'call_center'),
(2, 'helpdesk'),
(3, 'customer_service');

-- --------------------------------------------------------

--
-- Table structure for table `usercompany`
--

DROP TABLE IF EXISTS `usercompany`;
CREATE TABLE IF NOT EXISTS `usercompany` (
  `UserID` int(11) NOT NULL,
  `CompanyID` int(11) NOT NULL,
  PRIMARY KEY (`UserID`,`CompanyID`),
  KEY `CompanyID` (`CompanyID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userroles`
--

DROP TABLE IF EXISTS `userroles`;
CREATE TABLE IF NOT EXISTS `userroles` (
  `RoleID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  PRIMARY KEY (`RoleID`,`UserID`),
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
-- Constraints for table `jobtags`
--
ALTER TABLE `jobtags`
  ADD CONSTRAINT `jobtags_ibfk_2` FOREIGN KEY (`TagID`) REFERENCES `tags` (`TagID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jobtags_ibfk_1` FOREIGN KEY (`JobID`) REFERENCES `jobs` (`JobID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usercompany`
--
ALTER TABLE `usercompany`
  ADD CONSTRAINT `usercompany_ibfk_2` FOREIGN KEY (`CompanyID`) REFERENCES `companies` (`CompanyID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usercompany_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `userroles`
--
ALTER TABLE `userroles`
  ADD CONSTRAINT `userroles_ibfk_1` FOREIGN KEY (`RoleID`) REFERENCES `roles` (`RoleID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userroles_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usertags`
--
ALTER TABLE `usertags`
  ADD CONSTRAINT `usertags_ibfk_2` FOREIGN KEY (`TagID`) REFERENCES `tags` (`TagID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usertags_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
