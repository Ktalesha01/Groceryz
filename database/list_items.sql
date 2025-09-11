-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2025 at 12:51 PM
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
-- Table structure for table `list_items`
--

CREATE TABLE `list_items` (
  `item_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `list_id` int(11) DEFAULT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_type` varchar(100) DEFAULT NULL,
  `item_qty` int(11) DEFAULT 1,
  `is_done` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
ALTER TABLE `list_items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `list_id` (`list_id`);
ALTER TABLE `list_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
ALTER TABLE `list_items`
  ADD CONSTRAINT `list_items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_data` (`id`),
  ADD CONSTRAINT `list_items_ibfk_2` FOREIGN KEY (`list_id`) REFERENCES `grocery_lists` (`list_id`);
COMMIT;
--
-- Dumping data for table `list_items`
--

INSERT INTO `list_items` (`item_id`, `user_id`, `list_id`, `item_name`, `item_type`, `item_qty`, `is_done`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'kalpesh', 'fr', 2, 0, '2025-04-17 08:37:14', '2025-04-17 08:37:14'),
(2, 1, 2, 'kalpesh', 'fr', 2, 0, '2025-04-17 08:37:49', '2025-04-17 08:37:49'),
(3, 1, 7, 'kalpesh', 'fr', 4, 0, '2025-04-17 10:27:42', '2025-04-17 10:27:42'),
(4, 1, 7, 'kalpesh', 'fr', 4, 0, '2025-04-17 10:28:17', '2025-04-17 10:28:17'),
(7, 1, 8, 'kalpesh', 'fr', 6, 1, '2025-04-17 10:36:43', '2025-04-17 15:08:45'),
(8, 1, 8, 'kalpesh', 'fr', 6, 0, '2025-04-17 10:45:37', '2025-04-17 10:45:37'),
(9, 1, 8, 'kalpesh', 'fr', 6, 0, '2025-04-17 10:46:17', '2025-04-17 10:46:17'),
(10, 1, 8, 'kalpesh', 'fr', 6, 0, '2025-04-17 10:47:23', '2025-04-17 10:47:23'),
(11, 1, 8, 'kalpesh', 'fr', 6, 0, '2025-04-17 10:48:37', '2025-04-17 10:48:37'),
(12, 1, 8, 'kalpesh', 'fr', 6, 0, '2025-04-17 10:49:01', '2025-04-17 10:49:01'),
(13, 1, 8, 'kalpesh', 'fr', 6, 0, '2025-04-17 10:49:42', '2025-04-17 10:49:42'),
(14, 1, 1, 'kalpesh', 'Vegetables', 2, 0, '2025-04-17 13:37:28', '2025-04-17 19:48:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `list_items`
--

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `list_items`
--

--
-- Constraints for dumped tables
--

--
-- Constraints for table `list_items`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
