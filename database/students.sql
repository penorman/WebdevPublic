-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2021 at 01:40 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

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
  `password` varchar(20) NOT NULL,
  `userType` varchar(50) NOT NULL,
  `levelType` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `firstName`, `lastName`, `email`, `course`, `password`, `userType`, `levelType`) VALUES
(23, 'Kacper', 'Najder', 'email@gmail.com', 'Computer Science', '$2y$10$WezRMLCnWFnwv', 'student', ''),
(24, 'Kacper', 'Najder', 'kacpernajder7@gmail.com', 'Sports & Exercise Science', '$2y$10$UubdSu.Jq.9Pb', 'tutor', ''),
(28, 'Example1', 'Smith', 'example1@gmail.com', 'History', '$2y$10$wN.GDv5Mfb.xH', 'student', ''),
(29, 'Example2', 'Messenger', 'example2@gmail.com', 'Architecture', '$2y$10$HDzyoNTAtY93T', 'student', ''),
(30, 'Example3', 'Broski', 'example3@gmail.com', 'Medicine', '$2y$10$8fYcUsOKZBp1d', 'student', ''),
(31, 'Kacper', 'Najder', 'example4@gmail.com', 'Law', '$2y$10$CmAc9GKdwTuHq', 'student', 'I');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
