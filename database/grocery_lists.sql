-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2025 at 12:44 PM
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
-- Table structure for table `grocery_lists`
--

CREATE TABLE `grocery_lists` (
  `list_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `list_name` varchar(255) NOT NULL,
  `shared` tinyint(1) DEFAULT 0,
  `shared_with` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `shared_permissions` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
ALTER TABLE `grocery_lists`
  ADD PRIMARY KEY (`list_id`),
  ADD KEY `user_id` (`user_id`);
ALTER TABLE `grocery_lists`
  MODIFY `list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
ALTER TABLE `grocery_lists`
  ADD CONSTRAINT `grocery_lists_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_data` (`id`);
COMMIT;
--
-- Dumping data for table `grocery_lists`
--

INSERT INTO `grocery_lists` (`list_id`, `user_id`, `list_name`, `shared`, `shared_with`, `created_at`, `shared_permissions`, `updated_at`) VALUES
(1, 1, 'list', 0, '', '2025-04-17 05:40:32', '', '2025-04-17 13:44:12'),
(2, 1, 'fv', 0, '', '2025-04-17 08:22:29', '', '2025-04-17 08:22:29'),
(3, 1, 'new list', 0, '', '2025-04-17 09:04:26', 'edit', '2025-04-17 09:04:26'),
(4, 1, 'new list', 0, '', '2025-04-17 09:05:30', 'edit', '2025-04-17 09:05:30'),
(5, 1, 'fv', 0, '', '2025-04-17 09:06:33', 'edit', '2025-04-17 09:06:33'),
(6, 1, 'gf', 0, '', '2025-04-17 09:07:02', 'edit', '2025-04-17 09:07:08'),
(7, 1, 'new list', 0, '', '2025-04-17 09:16:41', 'edit', '2025-04-17 09:16:41'),
(8, 1, 'zx', 0, '', '2025-04-17 10:29:07', '', '2025-04-17 10:29:07'),
(9, 2, 'New list', 0, '', '2025-04-17 16:04:00', '', '2025-04-17 16:04:00'),
(10, 2, 'fv', 0, '', '2025-04-17 16:09:06', '', '2025-04-17 16:09:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grocery_lists`
--

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `grocery_lists`
--

--
-- Constraints for dumped tables
--

--
-- Constraints for table `grocery_lists`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
