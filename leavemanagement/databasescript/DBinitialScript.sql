-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 20, 2014 at 10:00 PM
-- Server version: 5.5.34
-- PHP Version: 5.3.10-1ubuntu3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `human_resources`
--
CREATE DATABASE `human_resources` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `human_resources`;

-- --------------------------------------------------------

--
-- Table structure for table `leave_days`
--

CREATE TABLE IF NOT EXISTS `leave_days` (
  `userid` int(11) NOT NULL,
  `ndays` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `leave_details`
--

CREATE TABLE IF NOT EXISTS `leave_details` (
  `detailid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `date` date NOT NULL,
  `type` int(11) NOT NULL,
  `datefrom` date NOT NULL,
  `dateto` date NOT NULL,
  `datereturn` date NOT NULL,
  `ndays` int(11) NOT NULL,
  `replacement` varchar(255) NOT NULL,
  `addressinleave` varchar(255) NOT NULL,
  `supervisor` int(11) NOT NULL,
  `approved` varchar(4) NOT NULL,
  PRIMARY KEY (`detailid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `username` varchar(20) NOT NULL,
  `pword` varchar(33) NOT NULL,
  `department` varchar(30) NOT NULL,
  `role` varchar(50) NOT NULL,
  `position` varchar(100) NOT NULL,
  `telephone` varchar(10) NOT NULL,
  `code` varchar(12) NOT NULL,
  `access` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `name`, `username`, `pword`, `department`, `role`, `position`, `telephone`, `code`, `access`) VALUES
(2, 'Supervisor Supervisor', 'supervisor', '21232f297a57a5a743894a0e4a801fc3', 'HIS', 'supervisor', '', '0788529201', '123', 1),
(7, 'User User', 'user', '6ac2470ed8ccf204fd5ff89b32a355cf', 'HIS', 'employee', '', '0788529201', '200', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
