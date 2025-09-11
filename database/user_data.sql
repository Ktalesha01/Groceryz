-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2025 at 12:54 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `groceryz`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `id` int(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone_no` bigint(10) NOT NULL,
  `email_id` varchar(150) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `password` varchar(255) NOT NULL,
  `profile_pic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unq_phone` (`phone_no`),
  ADD UNIQUE KEY `unq_email` (`email_id`);
ALTER TABLE `user_data`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;
--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`id`, `name`, `phone_no`, `email_id`, `role`, `created_at`, `password`, `profile_pic`) VALUES
(1, 'Kalpesh Talesha', 7208495230, 'kalpeshtalesha01@gmail.com', 'admin', '2025-04-17 05:26:40', '$2y$10$k8cKjUp5MArlbsAkCiFqP..4vxmVGyT8YuzEcfZr2eTULedC5/NPi', ''),
(2, 'Kamlesh', 8356959907, 'kamleshtalesha28@gmail.com', 'admin', '2025-04-17 15:57:01', '$2y$10$IXy4QYvyWlG1Ap.FEk.lFemFSOGemyJiurlze50ObpIDRoFY3j5Gq', ''),
(3, 'Kush', 8928977389, 'kushsmodha04@gmail.com', 'user', '2025-04-18 06:11:36', '$2y$10$dMzYiDXGzHA5m89nEjRE1el9uTr1eK01gWjc0kMsS3CwIIrWBUFpS', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_data`
--

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_data`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
