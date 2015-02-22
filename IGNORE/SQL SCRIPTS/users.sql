SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


DROP TABLE IF EXISTS `usercompany`;
CREATE TABLE IF NOT EXISTS `usercompany` (
  `UserID` int(11) NOT NULL,
  `CompanyID` int(11) NOT NULL,
  PRIMARY KEY (`UserID`,`CompanyID`),
  KEY `CompanyID` (`CompanyID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `usercompany` (`UserID`, `CompanyID`) VALUES
(1, 1),
(3, 1);

DROP TABLE IF EXISTS `userroles`;
CREATE TABLE IF NOT EXISTS `userroles` (
  `RoleID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  PRIMARY KEY (`RoleID`,`UserID`),
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `userroles` (`RoleID`, `UserID`) VALUES
(1, 1),
(2, 1),
(1, 2),
(2, 3);

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `Password` text COLLATE latin1_general_ci NOT NULL,
  `Email` text COLLATE latin1_general_ci NOT NULL,
  `Phone` text COLLATE latin1_general_ci,
  `FirstName` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `LastName` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `MiddleInitial` varchar(1) COLLATE latin1_general_ci DEFAULT NULL,
  `Suffix` varchar(6) COLLATE latin1_general_ci DEFAULT NULL COMMENT 'Junior, Senior, Jr, Sr, III, etc',
  `Salt` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`UserID`),
  UNIQUE KEY `Username` (`Username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

INSERT INTO `users` (`UserID`, `Username`, `Password`, `Email`, `Phone`, `FirstName`, `LastName`, `MiddleInitial`, `Suffix`, `Salt`) VALUES
(1, 'dhartenbach', 'ae4085f685e95fa7ac7d517540394d9b03d88ca0', 'deh5021@gmail.com', '7249410932', 'Daniel', 'Hartenbach', 'E', '', '54ea1254d66b5'),
(2, 'amarks', 'ae4085f685e95fa7ac7d517540394d9b03d88ca0', 'armarks@edmc.edu', '9994445454', 'Arthur', 'Marks', '', '', '54ea1254d66b5'),
(3, 'staylor', 'ae4085f685e95fa7ac7d517540394d9b03d88ca0', 'staylor@edmc.edu', '8833383383', 'Sean', 'Taylor', '', '', '54ea1254d66b5'),
(4, 'pgreen', 'ae4085f685e95fa7ac7d517540394d9b03d88ca0', 'pgreen@fake.com', '5555555555', 'Phillip', 'Green', '', 'II', '54ea1254d66b5');


ALTER TABLE `usercompany`
  ADD CONSTRAINT `usercompany_ibfk_2` FOREIGN KEY (`CompanyID`) REFERENCES `companies` (`CompanyID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usercompany_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `userroles`
  ADD CONSTRAINT `userroles_ibfk_1` FOREIGN KEY (`RoleID`) REFERENCES `roles` (`RoleID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userroles_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
