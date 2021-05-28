-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 28, 2021 at 09:44 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acetraining`
--
CREATE DATABASE IF NOT EXISTS `acetraining` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `acetraining`;

-- --------------------------------------------------------

--
-- Table structure for table `filedownload`
--

CREATE TABLE `filedownload` (
  `id` int(11) NOT NULL,
  `filename` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `resourcedates`
--

CREATE TABLE `resourcedates` (
  `resourceID` int(11) NOT NULL,
  `resourceOpenDate` date NOT NULL DEFAULT current_timestamp(),
  `resourceCloseDate` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `course` enum('Law','Computer Science','Business Studies','Sports & Exercise Science','Medicine','Economics','Architecture','Accounting & Finance','Biology','History') NOT NULL,
  `password` varchar(255) NOT NULL,
  `userType` varchar(50) NOT NULL,
  `levelType` enum('C','I','H') NOT NULL DEFAULT 'C'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblquizresults`
--

CREATE TABLE `tblquizresults` (
  `userID` int(11) NOT NULL,
  `resourceID` int(11) NOT NULL,
  `score` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblresource`
--

CREATE TABLE `tblresource` (
  `resourceID` int(11) NOT NULL,
  `resourcePath` varchar(256) NOT NULL,
  `resourceName` varchar(64) NOT NULL DEFAULT current_timestamp(),
  `resourceType` enum('quizText','studentResource') NOT NULL DEFAULT 'studentResource',
  `studentsVisible` tinyint(1) NOT NULL DEFAULT 1,
  `visibleToLevelTypes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`visibleToLevelTypes`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `filedownload`
--
ALTER TABLE `filedownload`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblquizresults`
--
ALTER TABLE `tblquizresults`
  ADD PRIMARY KEY (`userID`,`resourceID`),
  ADD KEY `resourceID_tblresource(resourceID)` (`resourceID`);

--
-- Indexes for table `tblresource`
--
ALTER TABLE `tblresource`
  ADD PRIMARY KEY (`resourceID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `filedownload`
--
ALTER TABLE `filedownload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblresource`
--
ALTER TABLE `tblresource`
  MODIFY `resourceID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblquizresults`
--
ALTER TABLE `tblquizresults`
  ADD CONSTRAINT `resourceID_tblresource(resourceID)` FOREIGN KEY (`resourceID`) REFERENCES `tblresource` (`resourceID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userID_students(id)` FOREIGN KEY (`userID`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
