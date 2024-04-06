-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 28, 2023 at 04:17 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `MariataHomes`
--

-- --------------------------------------------------------

--
-- Table structure for table `Accommodation`
--

CREATE TABLE `Accommodation` (
  `accommodation_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Accommodation`
--

INSERT INTO `Accommodation` (`accommodation_id`, `name`, `street`, `city`, `province`, `country`, `zip`) VALUES
(9, '139', 'Brownspring Drive', 'London', 'NA', 'United Kingdom', 'SE9 3LA'),
(10, '139', 'New test', 'London', 'test', 'United Kingdom', 'SE9 3LA');

-- --------------------------------------------------------

--
-- Table structure for table `Registration`
--

CREATE TABLE `Registration` (
  `reg_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `kin_name` varchar(255) NOT NULL,
  `kin_relationship` varchar(255) NOT NULL,
  `passport` varchar(255) NOT NULL,
  `illness` varchar(255) NOT NULL,
  `last_address` varchar(255) NOT NULL,
  `source` varchar(255) NOT NULL,
  `source_address` varchar(255) NOT NULL,
  `status` enum('PENDING','APPROVED','WITHDRAWN','REJECTED') NOT NULL,
  `accommodation` varchar(4000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Registration`
--

INSERT INTO `Registration` (`reg_id`, `name`, `dob`, `email`, `phone`, `kin_name`, `kin_relationship`, `passport`, `illness`, `last_address`, `source`, `source_address`, `status`, `accommodation`) VALUES
(33, 'Yuman Rai', '0076-08-09', 'newtest@gmail.com', '9871840890', 'Danny', 'Wife', 'ekta_singh_22', 'Diabetes', 'Flat 6E Anne of Cleeves', 'Hospital', '139 Brownspring Drive', 'WITHDRAWN', '1101 A R Reflection rajnagar extension Ghaziabad Near star rameshwaram India 201017'),
(34, 'Ekta Singh', '1998-05-01', 'newtest@gmail.com', '09871840890', 'Akash', 'brother', 'ekta_singh_23', 'Diabetes', '1101', 'Police Station ', 'Flat 6E Anne of Cleeves', 'REJECTED', '139 Brownspring Drive London NA United Kingdom SE9 3LA'),
(35, 'Sherry', '1996-05-04', 'newtest@gmail.com', '+448826005289', 'Nikhil', 'brother', 'ekta_singh_24', 'None', '87 bhim chowk', 'Police Station ', 'Flat 6E Anne of Cleeves', 'WITHDRAWN', '139 Brownspring Drive London NA United Kingdom SE9 3LA'),
(36, 'John patrick', '1998-02-08', 'newtest@gmail.com', '09871840890', 'Akash', 'brother', 'ekta_singh_25', 'None', '1101', 'Police Station ', '87 bhim chowk', 'APPROVED', '139 Brownspring Drive London NA United Kingdom SE9 3LA');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `user_id` int(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_type` enum('ADMIN','USER') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`user_id`, `user_email`, `password`, `user_name`, `user_type`) VALUES
(17, 'ektasinghuk9@gmail.com', 'Ekta@1234', 'Ekta Singh', 'ADMIN'),
(19, 'newtest@gmail.com', 'Ekta@1234', 'New test', 'USER');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Accommodation`
--
ALTER TABLE `Accommodation`
  ADD PRIMARY KEY (`accommodation_id`);

--
-- Indexes for table `Registration`
--
ALTER TABLE `Registration`
  ADD PRIMARY KEY (`reg_id`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Accommodation`
--
ALTER TABLE `Accommodation`
  MODIFY `accommodation_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `Registration`
--
ALTER TABLE `Registration`
  MODIFY `reg_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
