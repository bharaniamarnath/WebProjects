-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2014 at 02:05 PM
-- Server version: 5.5.36
-- PHP Version: 5.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `baffoons`
--

-- --------------------------------------------------------

--
-- Table structure for table `bulletin`
--

CREATE TABLE IF NOT EXISTS `bulletin` (
  `UserID` int(11) NOT NULL,
  `Message` varchar(100) NOT NULL,
  `Time` datetime NOT NULL,
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE IF NOT EXISTS `chats` (
  `ChatId` int(11) NOT NULL AUTO_INCREMENT,
  `ChatUserId` int(11) NOT NULL,
  `ChatText` text NOT NULL,
  PRIMARY KEY (`ChatId`),
  KEY `ChatUserId` (`ChatUserId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `UserID` int(11) NOT NULL,
  `Event` varchar(50) NOT NULL,
  `Date` date DEFAULT NULL,
  `Type` varchar(25) NOT NULL,
  `Description` varchar(150) DEFAULT NULL,
  `Included` datetime NOT NULL,
  KEY `UserID` (`UserID`),
  KEY `UserID_2` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE IF NOT EXISTS `favorites` (
  `UserID` int(11) NOT NULL,
  `Activities` varchar(1024) NOT NULL,
  `Foods` varchar(1024) NOT NULL,
  `Movies` varchar(1024) NOT NULL,
  `Music` varchar(1024) NOT NULL,
  `Books` varchar(1024) NOT NULL,
  `Games` varchar(1024) NOT NULL,
  `People` varchar(1024) NOT NULL,
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`UserID`, `Activities`, `Foods`, `Movies`, `Music`, `Books`, `Games`, `People`) VALUES
(466339, '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE IF NOT EXISTS `feedbacks` (
  `ID` int(6) NOT NULL,
  `FeedFrom` varchar(50) NOT NULL,
  `Subject` varchar(75) DEFAULT NULL,
  `Feedback` varchar(200) DEFAULT NULL,
  `Date` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE IF NOT EXISTS `friends` (
  `UserID` int(11) NOT NULL,
  `Friend` int(11) NOT NULL,
  KEY `UserID` (`UserID`),
  KEY `Friend` (`Friend`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `groupmembers`
--

CREATE TABLE IF NOT EXISTS `groupmembers` (
  `ID` int(6) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Date` datetime NOT NULL,
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groupmembers`
--

INSERT INTO `groupmembers` (`ID`, `UserID`, `Date`) VALUES
(244781, 466339, '2014-04-17 15:30:49');

-- --------------------------------------------------------

--
-- Table structure for table `groupmessages`
--

CREATE TABLE IF NOT EXISTS `groupmessages` (
  `ID` int(6) DEFAULT NULL,
  `GroupID` int(6) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Post` varchar(1024) DEFAULT NULL,
  `Date` datetime NOT NULL,
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groupmessages`
--

INSERT INTO `groupmessages` (`ID`, `GroupID`, `UserID`, `Post`, `Date`) VALUES
(854797, 244781, 466339, 'hey', '2014-04-17 15:50:35'),
(175354, 244781, 466339, '<iframe width="420" height="345"\nsrc="http://www.youtube.com/embed/RWLtKYUv6E0">\n</iframe>', '2014-04-17 16:01:30'),
(319488, 244781, 466339, '<img src=''groupphotos/319488.jpg''></img>', '2014-04-17 16:39:45');

-- --------------------------------------------------------

--
-- Table structure for table `groupphotos`
--

CREATE TABLE IF NOT EXISTS `groupphotos` (
  `ID` int(11) NOT NULL,
  `GroupID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Photo` text NOT NULL,
  `Thumb` text NOT NULL,
  `Date` datetime NOT NULL,
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groupphotos`
--

INSERT INTO `groupphotos` (`ID`, `GroupID`, `UserID`, `Photo`, `Thumb`, `Date`) VALUES
(319488, 244781, 466339, 'groupphotos/319488.jpg', 'groupphotos/thumbs/319488.jpg', '2014-04-17 16:39:45');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `ID` int(6) NOT NULL,
  `Name` varchar(225) DEFAULT NULL,
  `Type` varchar(225) DEFAULT NULL,
  `Description` varchar(1024) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Image` varchar(100) DEFAULT NULL,
  `Thumb` varchar(100) DEFAULT NULL,
  `Date` datetime NOT NULL,
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`ID`, `Name`, `Type`, `Description`, `UserID`, `Image`, `Thumb`, `Date`) VALUES
(244781, 'Baffoons Network', 'Community', 'Welcome to Baffoons Network', 466339, 'groups/244781.jpg', 'groups/thumbs/244781.jpg', '2014-04-17 15:17:51');

-- --------------------------------------------------------

--
-- Table structure for table `imagedetails`
--

CREATE TABLE IF NOT EXISTS `imagedetails` (
  `UserID` int(11) NOT NULL,
  `Image` varchar(100) NOT NULL,
  `Thumb` varchar(100) DEFAULT NULL,
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imagedetails`
--

INSERT INTO `imagedetails` (`UserID`, `Image`, `Thumb`) VALUES
(466339, 'album/userprofile.png', 'album/thumbs/userprofile.png');

-- --------------------------------------------------------

--
-- Table structure for table `maildetails`
--

CREATE TABLE IF NOT EXISTS `maildetails` (
  `ID` int(6) DEFAULT NULL,
  `Sender` int(11) NOT NULL,
  `Reciever` int(11) NOT NULL,
  `Subject` varchar(50) DEFAULT NULL,
  `Mail` varchar(150) DEFAULT NULL,
  `Date` datetime NOT NULL,
  `Status` varchar(3) NOT NULL DEFAULT 'U',
  KEY `Sender` (`Sender`),
  KEY `Reciever` (`Reciever`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `UserID` int(11) NOT NULL,
  `Message` varchar(100) NOT NULL,
  `Time` datetime NOT NULL,
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`UserID`, `Message`, `Time`) VALUES
(466339, 'hey', '2014-04-17 07:29:54'),
(466339, 'cool', '2014-04-17 07:30:06'),
(466339, '<iframe width="420" height="345"\nsrc="http://www.youtube.com/embed/y6Sxv-sUYtM">\n</iframe>', '2014-04-17 08:22:21'),
(466339, '<img src=''photos/542938.jpg''></img>', '2014-04-17 17:07:44');

-- --------------------------------------------------------

--
-- Table structure for table `personaldetails`
--

CREATE TABLE IF NOT EXISTS `personaldetails` (
  `UserID` int(11) NOT NULL,
  `Occupation` varchar(25) NOT NULL,
  `Contact` bigint(10) NOT NULL,
  `City` varchar(50) DEFAULT NULL,
  `Country` varchar(30) NOT NULL,
  `School` varchar(75) NOT NULL,
  `Work` varchar(50) NOT NULL,
  `Language` varchar(50) DEFAULT NULL,
  `Marital` varchar(75) DEFAULT NULL,
  `About` varchar(150) DEFAULT NULL,
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `personaldetails`
--

INSERT INTO `personaldetails` (`UserID`, `Occupation`, `Contact`, `City`, `Country`, `School`, `Work`, `Language`, `Marital`, `About`) VALUES
(466339, '', 0, NULL, '', '', '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `photocomments`
--

CREATE TABLE IF NOT EXISTS `photocomments` (
  `ID` varchar(6) NOT NULL,
  `UserID` int(11) NOT NULL,
  `PhotoID` int(11) NOT NULL,
  `Comment` varchar(75) DEFAULT NULL,
  `Date` datetime NOT NULL,
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `photodetails`
--

CREATE TABLE IF NOT EXISTS `photodetails` (
  `ID` varchar(6) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Photo` varchar(100) NOT NULL,
  `Thumb` varchar(100) DEFAULT NULL,
  `Filename` varchar(30) NOT NULL,
  `Description` varchar(75) DEFAULT NULL,
  `Date` datetime NOT NULL,
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `photodetails`
--

INSERT INTO `photodetails` (`ID`, `UserID`, `Photo`, `Thumb`, `Filename`, `Description`, `Date`) VALUES
('747863', 466339, 'photos/747863.jpg', 'photos/thumbs/747863.jpg', '', '', '2014-04-17 16:42:31'),
('542938', 466339, 'photos/542938.jpg', 'photos/thumbs/542938.jpg', '', NULL, '2014-04-17 17:07:44');

-- --------------------------------------------------------

--
-- Table structure for table `publicphotos`
--

CREATE TABLE IF NOT EXISTS `publicphotos` (
  `ID` varchar(6) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Photo` varchar(100) DEFAULT NULL,
  `Thumb` varchar(100) DEFAULT NULL,
  `Filename` varchar(50) DEFAULT NULL,
  `Description` varchar(75) DEFAULT NULL,
  `Date` datetime NOT NULL,
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `publicvotes`
--

CREATE TABLE IF NOT EXISTS `publicvotes` (
  `ID` int(6) DEFAULT NULL,
  `UserID` int(11) NOT NULL,
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE IF NOT EXISTS `reports` (
  `ID` int(10) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Reported` int(11) NOT NULL,
  `Report` varchar(1024) NOT NULL,
  `Location` varchar(225) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE IF NOT EXISTS `requests` (
  `ID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Requested` int(11) DEFAULT NULL,
  `Date` datetime NOT NULL,
  KEY `UserID` (`UserID`),
  KEY `Requested` (`Requested`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE IF NOT EXISTS `userdetails` (
  `UserID` int(11) NOT NULL,
  `Firstname` varchar(20) NOT NULL,
  `Lastname` varchar(20) NOT NULL,
  `Gender` varchar(6) NOT NULL,
  `Dob` date NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Created` datetime NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`UserID`, `Firstname`, `Lastname`, `Gender`, `Dob`, `Username`, `Password`, `Email`, `Created`) VALUES
(466339, 'Bharane', 'Amarnath', 'Male', '1991-02-21', 'bharaneamarnath', 'c9f0039f44332d44592d540cf67f3f0c', 'cephilo@gmail.com', '2014-04-17 07:26:51');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bulletin`
--
ALTER TABLE `bulletin`
  ADD CONSTRAINT `bulletin_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `userdetails` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `chats`
--
ALTER TABLE `chats`
  ADD CONSTRAINT `chats_ibfk_1` FOREIGN KEY (`ChatUserId`) REFERENCES `userdetails` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `userdetails` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `userdetails` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `userdetails` (`UserID`) ON DELETE CASCADE,
  ADD CONSTRAINT `friends_ibfk_2` FOREIGN KEY (`Friend`) REFERENCES `userdetails` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `groupmembers`
--
ALTER TABLE `groupmembers`
  ADD CONSTRAINT `groupmembers_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `userdetails` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `groupmessages`
--
ALTER TABLE `groupmessages`
  ADD CONSTRAINT `groupmessages_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `userdetails` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `groupphotos`
--
ALTER TABLE `groupphotos`
  ADD CONSTRAINT `groupphotos_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `userdetails` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `userdetails` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `imagedetails`
--
ALTER TABLE `imagedetails`
  ADD CONSTRAINT `imagedetails_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `userdetails` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `maildetails`
--
ALTER TABLE `maildetails`
  ADD CONSTRAINT `maildetails_ibfk_1` FOREIGN KEY (`Sender`) REFERENCES `userdetails` (`UserID`) ON DELETE CASCADE,
  ADD CONSTRAINT `maildetails_ibfk_2` FOREIGN KEY (`Reciever`) REFERENCES `userdetails` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `userdetails` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `personaldetails`
--
ALTER TABLE `personaldetails`
  ADD CONSTRAINT `personaldetails_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `userdetails` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `photocomments`
--
ALTER TABLE `photocomments`
  ADD CONSTRAINT `photocomments_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `userdetails` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `photodetails`
--
ALTER TABLE `photodetails`
  ADD CONSTRAINT `photodetails_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `userdetails` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `publicphotos`
--
ALTER TABLE `publicphotos`
  ADD CONSTRAINT `publicphotos_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `userdetails` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `publicvotes`
--
ALTER TABLE `publicvotes`
  ADD CONSTRAINT `publicvotes_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `userdetails` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `userdetails` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `requests_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `userdetails` (`UserID`) ON DELETE CASCADE,
  ADD CONSTRAINT `requests_ibfk_2` FOREIGN KEY (`Requested`) REFERENCES `userdetails` (`UserID`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
