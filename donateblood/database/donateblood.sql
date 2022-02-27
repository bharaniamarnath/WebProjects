-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2015 at 08:42 AM
-- Server version: 5.5.36
-- PHP Version: 5.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `donateblood`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `aid` int(6) NOT NULL,
  `auname` varchar(30) NOT NULL,
  `apasswd` varchar(225) NOT NULL,
  `clog` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `plog` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aid`, `auname`, `apasswd`, `clog`, `plog`) VALUES
(152374, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', '2015-03-08 13:58:05', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `donateblood`
--

CREATE TABLE IF NOT EXISTS `donateblood` (
  `did` int(6) NOT NULL,
  `duname` varchar(30) NOT NULL,
  `dpasswd` varchar(225) NOT NULL,
  `dname` varchar(30) NOT NULL,
  `dgender` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `btype` varchar(10) NOT NULL,
  `demail` varchar(50) NOT NULL,
  `dphone` varchar(11) NOT NULL,
  `daddr` varchar(150) NOT NULL,
  `cdate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `donateblood`
--

INSERT INTO `donateblood` (`did`, `duname`, `dpasswd`, `dname`, `dgender`, `dob`, `btype`, `demail`, `dphone`, `daddr`, `cdate`) VALUES
(403808, 'turing', '81dc9bdb52d04dc20036dbd8313ed055', 'Alan Turing', 'Male', '0000-00-00', 'AB+ve', 'turing@gmail.com', '9840123456', 'No.1, 1st street, London', '2015-03-08 14:44:36'),
(651977, 'holmes', 'd7153de4284c0184fe23f5eed9a552c8', 'Sherlock Holmes', 'Male', '0000-00-00', 'B+ve', 'holmes@gmail.com', '9876543210', '22, Baker Street', '2015-04-02 09:50:59');

-- --------------------------------------------------------

--
-- Table structure for table `donation`
--

CREATE TABLE IF NOT EXISTS `donation` (
  `doid` int(6) NOT NULL,
  `donorun` varchar(50) NOT NULL,
  `venueid` int(6) NOT NULL,
  `donatedate` varchar(11) NOT NULL,
  `verify` varchar(20) NOT NULL,
  `dlog` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`doid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `donation`
--

INSERT INTO `donation` (`doid`, `donorun`, `venueid`, `donatedate`, `verify`, `dlog`) VALUES
(228454, 'holmes', 459991, '06-09-2015', 'Unverified', '2015-04-03 02:21:25');

-- --------------------------------------------------------

--
-- Table structure for table `donors`
--

CREATE TABLE IF NOT EXISTS `donors` (
  `did` int(6) NOT NULL,
  `duname` varchar(30) NOT NULL,
  `dpasswd` varchar(225) NOT NULL,
  `dname` varchar(30) NOT NULL,
  `dgender` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `btype` varchar(10) NOT NULL,
  `demail` varchar(50) NOT NULL,
  `dphone` varchar(11) NOT NULL,
  `daddr` varchar(150) NOT NULL,
  `cdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`did`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `donors`
--

INSERT INTO `donors` (`did`, `duname`, `dpasswd`, `dname`, `dgender`, `dob`, `btype`, `demail`, `dphone`, `daddr`, `cdate`) VALUES
(403808, 'turing', '81dc9bdb52d04dc20036dbd8313ed055', 'Alan Turing', 'Male', '0000-00-00', 'AB+ve', 'turing@gmail.com', '9840123456', 'No.1, 1st street, London', '2015-03-08 14:44:36'),
(651977, 'holmes', 'd7153de4284c0184fe23f5eed9a552c8', 'Sherlock Holmes', 'Male', '0000-00-00', 'B+ve', 'holmes@gmail.com', '9876543210', '22, Baker Street', '2015-04-02 09:50:59');

-- --------------------------------------------------------

--
-- Table structure for table `recievers`
--

CREATE TABLE IF NOT EXISTS `recievers` (
  `did` int(6) NOT NULL,
  `duname` varchar(30) NOT NULL,
  `dpasswd` varchar(225) NOT NULL,
  `dname` varchar(30) NOT NULL,
  `dgender` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `btype` varchar(10) NOT NULL,
  `demail` varchar(50) NOT NULL,
  `dphone` varchar(11) NOT NULL,
  `daddr` varchar(150) NOT NULL,
  `cdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`did`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recievers`
--

INSERT INTO `recievers` (`did`, `duname`, `dpasswd`, `dname`, `dgender`, `dob`, `btype`, `demail`, `dphone`, `daddr`, `cdate`) VALUES
(407714, 'charles', 'a5410ee37744c574ba5790034ea08f79', 'Charles', 'Male', '0000-00-00', 'A+ve', 'charles@gmail.com', '9876543210', 'No 1 Charles Street', '2015-04-03 06:16:12'),
(549194, 'washington', 'f938c93da3eeabf30a6679828dede59c', 'George Washington', 'Male', '0000-00-00', 'A+ve', 'washington@gmail.com', '9876543210', 'No 1 Washington Street', '2015-04-03 04:43:52'),
(678649, 'lincoln', '1f558fcdd8249fac79cde2a7e08852cc', 'Abraham Lincoln', 'Male', '0000-00-00', 'AB+ve', 'lincoln@gmail.com', '9876543210', 'No 1, Washington Street', '2015-04-03 02:34:28'),
(956695, 'charles', 'a5410ee37744c574ba5790034ea08f79', 'Charles', 'Male', '0000-00-00', 'A+ve', 'charles@gmail.com', '9876543210', 'No 1 Charles Street', '2015-04-03 06:13:15');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE IF NOT EXISTS `requests` (
  `reqid` int(6) NOT NULL,
  `recid` int(6) NOT NULL,
  `btype` varchar(5) NOT NULL,
  `rlog` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`reqid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `venues`
--

CREATE TABLE IF NOT EXISTS `venues` (
  `vid` int(6) NOT NULL,
  `vaddr` varchar(100) NOT NULL,
  `vcity` varchar(50) NOT NULL,
  `vstate` varchar(50) NOT NULL,
  `vpin` int(7) NOT NULL,
  `vcon` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `venues`
--

INSERT INTO `venues` (`vid`, `vaddr`, `vcity`, `vstate`, `vpin`, `vcon`) VALUES
(459991, 'No 3, 1st Street', 'Bangalore', 'Karnataka', 400001, '9876543210');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
