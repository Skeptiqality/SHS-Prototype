-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2026 at 05:22 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prototype_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `student_lrn` varchar(100) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_id_list`
--

CREATE TABLE `employee_id_list` (
  `id` int(11) NOT NULL,
  `employee_id` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_id_list`
--

INSERT INTO `employee_id_list` (`id`, `employee_id`) VALUES
(1, 12314124),
(2, 3333);

-- --------------------------------------------------------

--
-- Table structure for table `employee_info`
--

CREATE TABLE `employee_info` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `employee_type` varchar(30) NOT NULL,
  `employee_id` varchar(30) NOT NULL,
  `birthdate` date NOT NULL,
  `age` int(11) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `address` text NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `account_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_info`
--

INSERT INTO `employee_info` (`id`, `first_name`, `middle_name`, `last_name`, `employee_type`, `employee_id`, `birthdate`, `age`, `sex`, `address`, `contact_number`, `profile_picture`, `account_password`) VALUES
(1, 'Dezcartes Rey', 'Ferrer', 'Bermudez', 'administrative', '12314124', '0000-00-00', 0, '', '', '', NULL, '123'),
(3, 'Erwin', '', 'Gersherwin', 'librarian', '3333', '0000-00-00', 0, '', '', '', NULL, '3333');

-- --------------------------------------------------------

--
-- Table structure for table `student_info`
--

CREATE TABLE `student_info` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `lrn` varchar(12) NOT NULL,
  `grade_level` int(11) NOT NULL,
  `section` varchar(30) NOT NULL,
  `birthdate` date NOT NULL,
  `age` int(11) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `student_address` text NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `parent_guardian` varchar(100) NOT NULL,
  `parent_guardian_contact` varchar(15) NOT NULL,
  `relationship` varchar(30) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `account_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_info`
--

INSERT INTO `student_info` (`id`, `first_name`, `middle_name`, `last_name`, `lrn`, `grade_level`, `section`, `birthdate`, `age`, `sex`, `student_address`, `contact_number`, `email_address`, `parent_guardian`, `parent_guardian_contact`, `relationship`, `profile_picture`, `account_password`) VALUES
(1, 'Erwin', '', 'Regicide', '5556', 0, '', '0000-00-00', 0, '', '', '', '', '', '', NULL, NULL, '123'),
(3, 'Wilhelm', '', 'TheSecond', '123', 0, '', '0000-00-00', 0, '', '', '', '', '', '', NULL, NULL, '123');

-- --------------------------------------------------------

--
-- Table structure for table `student_lrn_list`
--

CREATE TABLE `student_lrn_list` (
  `id` int(11) NOT NULL,
  `LRN` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_lrn_list`
--

INSERT INTO `student_lrn_list` (`id`, `LRN`) VALUES
(1, 4),
(2, 123),
(3, 666),
(4, 5556);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_id_list`
--
ALTER TABLE `employee_id_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_info`
--
ALTER TABLE `employee_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_number` (`employee_id`),
  ADD KEY `employee_number_2` (`employee_id`);

--
-- Indexes for table `student_info`
--
ALTER TABLE `student_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lrn` (`lrn`),
  ADD KEY `lrn_2` (`lrn`);

--
-- Indexes for table `student_lrn_list`
--
ALTER TABLE `student_lrn_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_id_list`
--
ALTER TABLE `employee_id_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employee_info`
--
ALTER TABLE `employee_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student_info`
--
ALTER TABLE `student_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student_lrn_list`
--
ALTER TABLE `student_lrn_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
