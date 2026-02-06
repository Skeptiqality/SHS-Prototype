-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2026 at 04:35 AM
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
(1, 12314124);

-- --------------------------------------------------------

--
-- Table structure for table `employee_websiteaccount`
--

CREATE TABLE `employee_websiteaccount` (
  `account_id` int(11) NOT NULL,
  `employee_id` int(16) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `middle_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) NOT NULL,
  `account_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personnel_info`
--

CREATE TABLE `personnel_info` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `employee_type` varchar(30) NOT NULL,
  `employee_number` varchar(30) NOT NULL,
  `birthdate` date NOT NULL,
  `age` int(11) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `address` text NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `account_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_info`
--

INSERT INTO `student_info` (`id`, `first_name`, `middle_name`, `last_name`, `lrn`, `grade_level`, `section`, `birthdate`, `age`, `sex`, `student_address`, `contact_number`, `email_address`, `parent_guardian`, `parent_guardian_contact`, `relationship`, `profile_picture`, `registration_date`, `account_password`) VALUES
(7, 'Arianney Mae', 'Facunla', 'Facunla', '136548130746', 11, 'Zuckerberg', '2007-08-05', 17, 'female', 'Cariñosa street', '09476252813', 'dezcartesb@gmail.com', 'Floriza Facunla', '09123456789', 'parent', 'uploads/136548130746_30359.jpg', '2025-03-20 10:08:01', '123'),
(13, 'Dezcartes Rey', 'Ferrer', 'Bermudez', '136536130601', 11, 'Zuckerberg', '2004-08-08', 20, 'male', 'Cariñosa street', '09476252813', 'dezcartesb@gmail.com', 'Rebecca Bermudez', '09476252813', 'parent', 'uploads/136536130601_1000014453.jpg', '2025-03-20 14:36:27', ''),
(15, 'Andrei', 'Barerra', 'Santos', '136529140994', 11, 'Zuckerberg', '2007-12-24', 17, 'male', 'GHome address', '09684306616', 'andreisantos241207@gmail.com', 'Elsie B. Santos', '09999999999', 'parent', 'uploads/136529140994_uhmm.jpg', '2025-03-22 08:48:05', ''),
(16, 'John', '', 'Doe', '123456789012', 11, 'Zuckerberg', '2006-01-01', 19, 'male', '123 Chestnut St. Brgy. Greater Lagro, Quezon City', '09992314567', 'abc1234@gmail.com', 'Jane Smith', '09999999999', 'grandparent', 'uploads/123456789012_istockphoto-1763926700-612x612.jpg', '2025-03-23 22:54:13', ''),
(17, 'Andrei', 'Barrera', 'Santos', '136529140555', 11, 'Zuckerberg', '2007-12-24', 17, 'male', 'Bahay home', '09999999999', 'zemail@gmail.com', 'magulang', '09123456789', 'parent', 'uploads/136529140555_pic.jpg', '2025-03-28 08:58:07', ''),
(18, 'sandro', 'conda', 'alegre', '222501120148', 7, 'Rizal', '2010-12-25', 14, 'other', 'sa iris kanan ako naka tira', '09123456789', 'sandrohahaha@gmail.com', 'Shin', '09987654321', 'grandparent', NULL, '2025-03-28 10:04:27', ''),
(19, 'Christian', 'Magbanua', 'Pangantihon', '482749150183', 11, 'Zuckerberg', '2006-12-24', 18, 'male', 'qc lang sa gedli', '09947739569', 'chan24@gmail.com', 'Simother', '09946729351', 'parent', NULL, '2025-03-28 10:07:14', ''),
(21, 'Tommy', '', 'Diones', '136589662836', 11, 'Zuckerberg', '1955-02-08', 70, 'male', '#05 Diamond St. Woodland Hills, Quezon City', '09673345582', 'tdiones@hotmail.com', 'Edeltrudes Advincula', '09996663322', 'grandparent', 'uploads/136589662836_tommy.png', '2025-03-30 10:57:46', ''),
(24, 'Kieran Shin', 'S', 'Junsay', '108599975633', 12, 'Rossum', '2040-10-09', 0, 'male', 'Bahay Lagro', '09996663855', 'kieran@gmail.com', 'Mommy', '09886645722', 'parent', 'uploads/108599975633_shin.jpg', '2025-09-24 14:24:27', ''),
(25, 'Dezcartes Rey', 'Ferrer', 'Bermudez', '136536130602', 12, '12 - Rossum', '2004-08-08', 21, 'male', 'bahay', '09193691288', 'dezcartesb@gmail.com', 'nanay', '09498597674', 'parent', NULL, '2026-02-02 04:52:20', ''),
(26, 'Erwin', '', 'Regicide', '136599990662', 12, 'Rossum', '1891-11-15', 134, 'male', 'Saxony-Anhalt', '09999999999', 'e.regicide@outlook.com', 'Mother', '09498597674', 'parent', 'uploads/136599990662_erwin-regicide.jpg', '2026-02-04 03:32:31', '');

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

-- --------------------------------------------------------

--
-- Table structure for table `student_websiteaccount`
--

CREATE TABLE `student_websiteaccount` (
  `account_id` int(11) NOT NULL,
  `LRN` int(12) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `middle_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) NOT NULL,
  `account_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_websiteaccount`
--

INSERT INTO `student_websiteaccount` (`account_id`, `LRN`, `first_name`, `middle_name`, `last_name`, `account_password`) VALUES
(1, 123, 'Erwin', '', 'Regicide', '123');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_info`
--

CREATE TABLE `teacher_info` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `employee_number` varchar(30) NOT NULL,
  `teacher_reg_number` varchar(30) NOT NULL,
  `birthdate` date NOT NULL,
  `age` int(11) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `address` text NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `email_address` varchar(100) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indexes for table `employee_websiteaccount`
--
ALTER TABLE `employee_websiteaccount`
  ADD PRIMARY KEY (`account_id`),
  ADD UNIQUE KEY `employee_id` (`employee_id`);

--
-- Indexes for table `personnel_info`
--
ALTER TABLE `personnel_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_number` (`employee_number`),
  ADD KEY `employee_number_2` (`employee_number`);

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
-- Indexes for table `student_websiteaccount`
--
ALTER TABLE `student_websiteaccount`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `teacher_info`
--
ALTER TABLE `teacher_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_number` (`employee_number`),
  ADD UNIQUE KEY `teacher_reg_number` (`teacher_reg_number`),
  ADD KEY `employee_number_2` (`employee_number`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employee_websiteaccount`
--
ALTER TABLE `employee_websiteaccount`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personnel_info`
--
ALTER TABLE `personnel_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_info`
--
ALTER TABLE `student_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `student_lrn_list`
--
ALTER TABLE `student_lrn_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student_websiteaccount`
--
ALTER TABLE `student_websiteaccount`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `teacher_info`
--
ALTER TABLE `teacher_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
