-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2025 at 12:53 PM
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
-- Table structure for table `shared_lists`
--

CREATE TABLE `shared_lists` (
  `id` int(11) NOT NULL,
  `list_id` int(11) NOT NULL,
  `shared_with_user_id` int(11) NOT NULL,
  `shared_by_user_id` int(11) NOT NULL,
  `permission` varchar(10) DEFAULT 'view'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
ALTER TABLE `shared_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `list_id` (`list_id`),
  ADD KEY `shared_with_user_id` (`shared_with_user_id`),
  ADD KEY `shared_by_user_id` (`shared_by_user_id`);
ALTER TABLE `shared_lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
ALTER TABLE `shared_lists`
  ADD CONSTRAINT `shared_lists_ibfk_1` FOREIGN KEY (`list_id`) REFERENCES `grocery_lists` (`list_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shared_lists_ibfk_2` FOREIGN KEY (`shared_with_user_id`) REFERENCES `user_data` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shared_lists_ibfk_3` FOREIGN KEY (`shared_by_user_id`) REFERENCES `user_data` (`id`) ON DELETE CASCADE;
COMMIT;
--
-- Dumping data for table `shared_lists`
--

INSERT INTO `shared_lists` (`id`, `list_id`, `shared_with_user_id`, `shared_by_user_id`, `permission`) VALUES
(3, 3, 2, 1, 'edit');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `shared_lists`
--

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `shared_lists`
--

--
-- Constraints for dumped tables
--

--
-- Constraints for table `shared_lists`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
