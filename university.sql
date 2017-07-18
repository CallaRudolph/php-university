-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Jul 19, 2017 at 01:40 AM
-- Server version: 5.5.42-log
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `university`
--
CREATE DATABASE IF NOT EXISTS `university` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `university`;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) unsigned NOT NULL,
  `course_name` varchar(255) DEFAULT NULL,
  `number` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_name`, `number`) VALUES
(5, 'Turd inspection', '666'),
(6, 'Books', '101'),
(7, 'Big apple', '33333');

-- --------------------------------------------------------

--
-- Table structure for table `courses_students`
--

CREATE TABLE `courses_students` (
  `id` bigint(20) unsigned NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses_students`
--

INSERT INTO `courses_students` (`id`, `course_id`, `student_id`) VALUES
(7, 5, 6),
(8, 6, 8),
(9, 5, 8),
(10, 5, 8),
(11, 6, 7),
(12, 6, 7),
(13, 6, 7),
(14, 6, 7),
(15, 6, 7),
(17, 5, 7),
(19, 7, 8);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `date`) VALUES
(8, 'goober', 'the future'),
(9, 'Apple Eye', 'today'),
(10, 'apple', ''),
(11, 'gooober', ''),
(12, 'gooober', ''),
(13, 'cheese', ''),
(14, 'burger', ''),
(15, 'eggs', ''),
(16, 'michelle', ''),
(17, 'michelle', ''),
(18, 'max', ''),
(19, 'hank aaron', 'now'),
(20, 'zack', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `courses_students`
--
ALTER TABLE `courses_students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `courses_students`
--
ALTER TABLE `courses_students`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
