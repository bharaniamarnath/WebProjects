-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2014 at 06:57 AM
-- Server version: 5.5.36
-- PHP Version: 5.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `timetable`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `Id` int(11) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `Password` varchar(512) NOT NULL,
  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Id`, `Username`, `Password`, `Created`) VALUES
(591796, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', '2014-10-21 08:08:59');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE IF NOT EXISTS `branch` (
  `Id` int(6) NOT NULL,
  `Degree` varchar(15) NOT NULL,
  `Department` varchar(255) NOT NULL,
  `Year` varchar(30) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`Id`, `Degree`, `Department`, `Year`) VALUES
(443847, 'UG', 'IT', 'First'),
(882598, 'UG', 'CSE', 'First');

-- --------------------------------------------------------

--
-- Table structure for table `periods`
--

CREATE TABLE IF NOT EXISTS `periods` (
  `bid` int(6) NOT NULL,
  `pday` varchar(15) NOT NULL,
  `period` int(5) NOT NULL,
  `subcode` varchar(10) NOT NULL,
  `staff` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `periods`
--

INSERT INTO `periods` (`bid`, `pday`, `period`, `subcode`, `staff`) VALUES
(443847, 'Monday', 1, 'CS1201', '29724'),
(443847, 'Monday', 2, 'CS1203', '254058'),
(443847, 'Monday', 3, 'IT2101', '147918'),
(443847, 'Monday', 4, 'CS1204', '140502'),
(443847, 'Monday', 5, 'IT2101', '116027'),
(443847, 'Monday', 6, 'CS1202', '506134'),
(443847, 'Monday', 7, 'EC2203', '254058'),
(443847, 'Monday', 8, 'CS1204', '140502'),
(443847, 'Tuesday', 1, 'CS1203', '254058'),
(443847, 'Tuesday', 2, 'CS1204', '140502'),
(443847, 'Tuesday', 3, 'CS1205', '116027'),
(443847, 'Tuesday', 4, '', ''),
(443847, 'Tuesday', 5, '', ''),
(443847, 'Tuesday', 6, '', ''),
(443847, 'Tuesday', 7, '', ''),
(443847, 'Tuesday', 8, '', ''),
(443847, 'Wednesday', 1, 'CS1201', '29724'),
(443847, 'Wednesday', 2, '', ''),
(443847, 'Wednesday', 3, '', ''),
(443847, 'Wednesday', 4, '', ''),
(443847, 'Wednesday', 5, '', ''),
(443847, 'Wednesday', 6, '', ''),
(443847, 'Wednesday', 7, '', ''),
(443847, 'Wednesday', 8, '', ''),
(443847, 'Thursday', 1, '', ''),
(443847, 'Thursday', 2, '', ''),
(443847, 'Thursday', 3, '', ''),
(443847, 'Thursday', 4, '', ''),
(443847, 'Thursday', 5, '', ''),
(443847, 'Thursday', 6, '', ''),
(443847, 'Thursday', 7, '', ''),
(443847, 'Thursday', 8, '', ''),
(443847, 'Friday', 1, '', ''),
(443847, 'Friday', 2, '', ''),
(443847, 'Friday', 3, '', ''),
(443847, 'Friday', 4, '', ''),
(443847, 'Friday', 5, '', ''),
(443847, 'Friday', 6, '', ''),
(443847, 'Friday', 7, '', ''),
(443847, 'Friday', 8, '', ''),
(882598, 'Monday', 1, 'CS1201', '29724'),
(882598, 'Monday', 2, 'CS1202', '140502'),
(882598, 'Monday', 3, '', ''),
(882598, 'Monday', 4, '', ''),
(882598, 'Monday', 5, '', ''),
(882598, 'Monday', 6, '', ''),
(882598, 'Monday', 7, '', ''),
(882598, 'Monday', 8, '', ''),
(882598, 'Tuesday', 1, '', ''),
(882598, 'Tuesday', 2, '', ''),
(882598, 'Tuesday', 3, '', ''),
(882598, 'Tuesday', 4, '', ''),
(882598, 'Tuesday', 5, '', ''),
(882598, 'Tuesday', 6, '', ''),
(882598, 'Tuesday', 7, '', ''),
(882598, 'Tuesday', 8, '', ''),
(882598, 'Wednesday', 1, '', ''),
(882598, 'Wednesday', 2, 'CS1201', '29724'),
(882598, 'Wednesday', 3, '', ''),
(882598, 'Wednesday', 4, '', ''),
(882598, 'Wednesday', 5, '', ''),
(882598, 'Wednesday', 6, '', ''),
(882598, 'Wednesday', 7, '', ''),
(882598, 'Wednesday', 8, '', ''),
(882598, 'Thursday', 1, '', ''),
(882598, 'Thursday', 2, '', ''),
(882598, 'Thursday', 3, '', ''),
(882598, 'Thursday', 4, '', ''),
(882598, 'Thursday', 5, '', ''),
(882598, 'Thursday', 6, '', ''),
(882598, 'Thursday', 7, '', ''),
(882598, 'Thursday', 8, '', ''),
(882598, 'Friday', 1, '', ''),
(882598, 'Friday', 2, '', ''),
(882598, 'Friday', 3, '', ''),
(882598, 'Friday', 4, '', ''),
(882598, 'Friday', 5, '', ''),
(882598, 'Friday', 6, '', ''),
(882598, 'Friday', 7, '', ''),
(882598, 'Friday', 8, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE IF NOT EXISTS `schedule` (
  `period` varchar(20) NOT NULL,
  `pstart` varchar(10) NOT NULL,
  `pend` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`period`, `pstart`, `pend`) VALUES
('1', '08:10', '09:00'),
('2', '09:00', '09:50'),
('Break', '09:50', '10:00'),
('3', '10:00', '10:50'),
('4', '10:50', '11:40'),
('5', '11:40', '12:30'),
('Lunch', '12:30', '13:10'),
('6', '13:10', '14:00'),
('7', '14:00', '14:50'),
('8', '14:50', '15:40');

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE IF NOT EXISTS `staffs` (
  `sid` int(6) NOT NULL,
  `fname` varchar(25) NOT NULL,
  `lname` varchar(25) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dept` varchar(25) NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`sid`, `fname`, `lname`, `gender`, `dept`) VALUES
(29724, 'Johnny', 'Depp', 'Male', 'CSE'),
(116027, 'Jennifer', 'Lawrence', 'Male', 'IT'),
(140502, 'Jessica', 'Alba', 'Male', 'IT'),
(147918, 'Christian', 'Bale', 'Male', 'IT'),
(254058, 'Katy', 'Perry', 'Male', 'ECE'),
(506134, 'Will', 'Smith', 'Male', 'CSE');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `subid` varchar(6) NOT NULL,
  `subname` varchar(100) NOT NULL,
  PRIMARY KEY (`subid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subid`, `subname`) VALUES
('CS1201', 'Data Structures'),
('CS1202', 'Computer Architecture'),
('CS1203', 'Operating Systems'),
('CS1204', 'Database Management Systems'),
('CS1205', 'Embedded Systems'),
('EC2101', 'Microprocessors and Microcontrollers'),
('EC2203', 'Digital Signal Processing'),
('IT1203', 'Software Project Management'),
('IT2101', 'Software Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `Id` int(6) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `Password` varchar(512) NOT NULL,
  `Added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `Username`, `Password`, `Added`) VALUES
(147918, 'chrisbale', 'f226e3fd5e531be4d65eaa25f9bf8992', '2014-10-21 08:56:10'),
(116027, 'jennilaw', 'a0d323d58f621e74fb7f6007daec2d7e', '2014-10-21 08:58:35'),
(140502, 'jessialba', '9f3c53497ff88271d961857b9a845fdb', '2014-10-21 08:56:51'),
(29724, 'johnnydepp', '18ba3a31fa967ba2ce658cb13fb704f1', '2014-10-21 08:55:29'),
(254058, 'katyperry', '94885de728707e754951092d2d81592e', '2014-10-21 08:57:41'),
(506134, 'willsmith', '7402d37e1431288b190bdeb1a550d698', '2014-10-21 08:54:56');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
