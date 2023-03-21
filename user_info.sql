-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 21, 2023 at 01:14 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sslogin`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `user_name` varchar(255) DEFAULT NULL,
  `wagerPlaced` int(10) UNSIGNED NOT NULL,
  `betPlaced` varchar(255) NOT NULL,
  `gameID` varchar(255) NOT NULL,
  `teambeton` varchar(255) NOT NULL,
  `id` bigint(20) DEFAULT NULL,
  `result` tinyint(1) DEFAULT NULL,
  `amountWon` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_name`, `wagerPlaced`, `betPlaced`, `gameID`, `teambeton`, `id`, `result`, `amountWon`) VALUES
('Nalla', 100, '2023-03-14', '19194', '', NULL, NULL, NULL),
('Nalla', 100, '2023-03-14', '19194', '', NULL, NULL, NULL),
('Nalla', 100, '2023-03-14', '19194', 'GS', NULL, NULL, NULL),
('Nalla', 100, '2023-03-14', '19196', 'DET', NULL, NULL, NULL),
('Nalla', 100, '2023-03-15', '19199', 'LAL', NULL, NULL, NULL),
('Nalla', 100, '2023-03-15', '19198', 'DEN', NULL, NULL, NULL),
('Nalla', 100, '2023-03-15', '19198', 'DEN', NULL, NULL, NULL),
('Nalla', 100, '2023-03-15', '19198', 'DEN', NULL, NULL, NULL),
('Nalla', 100, '2023-03-15', '19198', 'DEN', NULL, NULL, NULL),
('Nalla', 100, '2023-03-15', '19198', 'DEN', NULL, NULL, NULL),
('Nalla', 100, '2023-03-15', '19198', 'DEN', NULL, NULL, NULL),
('Nalla', 100, '2023-03-15', '19200', 'ORL', NULL, NULL, NULL),
('Nalla', 100, '2023-03-15', '19199', 'LAL', NULL, NULL, NULL),
('Nalla', 100, '2023-03-15', '19200', 'SA', NULL, NULL, NULL),
('Nalla', 100, '2023-03-15', '19199', 'LAL', NULL, NULL, NULL),
('Nalla', 100, '2023-03-15', '19199', 'LAL', NULL, NULL, NULL),
('Nalla', 100, '2023-03-15', '19199', 'LAL', NULL, NULL, NULL),
('Nalla', 100, '2023-03-15', '19205', 'MIA', NULL, NULL, NULL),
('Nalla', 1000, '2023-03-15', '19205', 'MEM', NULL, NULL, NULL),
('Nalla', 10000, '2023-03-18', '19226', 'PHI', NULL, NULL, NULL),
(NULL, 1004, '2023-03-18', '19226', 'IND', 58, NULL, NULL),
(NULL, 30130, '2023-03-18', '19227', 'TOR', 58, NULL, NULL),
('Nalla', 100, '2023-03-18', '19226', 'PHI', 58, NULL, NULL),
('Nalla', 100, '2023-03-18', '19226', 'PHI', 58, NULL, NULL),
('Nalla', 100, '2023-03-18', '19226', 'PHI', 58, NULL, NULL),
('Nalla', 100, '2023-03-18', '19226', 'PHI', 58, NULL, NULL),
('Nalla', 100, '2023-03-18', '19226', 'PHI', 58, NULL, NULL),
('Nalla', 100, '2023-03-19', '19239', 'LAL', 58, NULL, NULL),
('Nalla', 100, '2023-03-19', '19231', 'BOS', 58, NULL, NULL),
('Nalla', 10000, '2023-03-20', '19239', 'LAL', 58, NULL, NULL),
('Nalla', 100, '2023-03-20', '19240', 'CHI', 58, NULL, NULL),
('Nalla', 1000, '2023-03-21', '19243', 'HOU', 58, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD KEY `user_name` (`user_name`),
  ADD KEY `id` (`id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_info`
--
ALTER TABLE `user_info`
  ADD CONSTRAINT `user_info_ibfk_1` FOREIGN KEY (`user_name`) REFERENCES `users2` (`user_name`),
  ADD CONSTRAINT `user_info_ibfk_2` FOREIGN KEY (`id`) REFERENCES `users2` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
