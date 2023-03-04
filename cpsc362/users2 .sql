-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2023 at 06:57 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

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
-- Table structure for table `users2`
--

CREATE TABLE `users2` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `email` varchar(100) NOT NULL,
  `Points` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users2`
--

INSERT INTO `users2` (`id`, `user_id`, `user_name`, `password`, `date`, `email`, `Points`) VALUES
(3, 7613402600654130, 'Nalla', '1234', '2023-02-26 00:44:16', '1111', 0),
(5, 78106457482318, 'Allan', '1234', '2023-02-07 05:49:13', '1111', NULL),
(6, 39517, 'Nalla234', '1234', '2023-02-07 05:19:53', 'allan.cor98@gmail.com', NULL),
(7, 3545273918, 'Nalla2412414', '1234', '2023-02-07 05:20:28', 'allan.cor98@gmail.com', NULL),
(8, 562334958324227765, 'Nalla123', '1234', '2023-02-07 05:21:37', '123123123123', NULL),
(9, 7420808576538, 'Nalla`12`12', '1234', '2023-02-07 05:53:48', 'allan1.cor98@gmail.com', NULL),
(10, 34305574, 'Nalla', '1234', '2023-02-26 00:44:16', 'aa', 0),
(11, 5462411144267247005, 'Nalla', '1234', '2023-02-26 00:44:16', 'aaaa', 0),
(12, 9217155, 'Nalla', '1234', '2023-02-26 00:44:16', 'sss', 0),
(13, 402070711921172441, 'Nalla', '1234', '2023-02-26 00:44:16', '2', 0),
(14, 4824604625395, 'Nalla', '1234', '2023-02-26 00:44:16', '11', 0),
(15, 595080304037, 'Nalla', '1234', '2023-02-26 00:44:16', '3213123', 0),
(16, 18325010580701, 'Nalla', '1234', '2023-02-26 00:44:16', '123123', 0),
(17, 85282, 'Nalla', '1234', '2023-02-26 00:44:16', 'A@a.com', 0),
(21, 83984373864, 'Allan123', '1234', '2023-02-23 08:52:17', 'a@aa.com', 700),
(22, 0, '', '', '2023-02-23 08:37:54', '', 0),
(23, 0, '', '', '2023-02-23 08:37:54', '', 0),
(24, 0, '', '', '2023-02-23 08:37:54', '', 0),
(25, 0, '', '', '2023-02-23 08:37:54', '', 0),
(26, 0, '', '', '2023-02-23 08:37:54', '', 0),
(27, 0, '', '', '2023-02-23 08:37:54', '', 0),
(28, 0, '', '', '2023-02-23 08:37:54', '', 0),
(29, 0, '', '', '2023-02-23 08:37:54', '', 0),
(30, 0, '', '', '2023-02-23 08:37:54', '', 0),
(31, 0, '', '', '2023-02-23 08:42:26', '', -100),
(32, 0, '', '', '2023-02-23 08:42:26', '', -100),
(33, 0, '', '', '2023-02-23 08:42:26', '', -100),
(34, 0, '', '', '2023-02-23 08:42:26', '', -100),
(35, 0, '', '', '2023-02-23 08:42:26', '', -100),
(36, 0, '', '', '2023-02-23 08:42:26', '', -100),
(37, 0, '', '', '2023-02-23 08:42:26', '', -100),
(38, 0, '', '', '2023-02-23 08:42:26', '', -100),
(39, 0, '', '', '2023-02-23 08:42:26', '', -100),
(40, 0, '', '', '2023-02-23 08:42:49', '', 900),
(41, 0, '', '', '2023-02-23 08:42:49', '', 900),
(42, 0, '', '', '2023-02-23 08:42:49', '', 900),
(43, 0, '', '', '2023-02-23 08:42:49', '', 900),
(44, 0, '', '', '2023-02-23 08:42:49', '', 900),
(45, 0, '', '', '2023-02-23 08:42:49', '', 900),
(46, 0, '', '', '2023-02-23 08:42:49', '', 900),
(47, 0, '', '', '2023-02-23 08:42:49', '', 900),
(48, 0, '', '', '2023-02-23 08:42:49', '', 900),
(49, 0, '', '', '2023-02-23 08:43:20', '', 900),
(50, 0, '', '', '2023-02-23 08:43:20', '', 900),
(51, 0, '', '', '2023-02-23 08:43:20', '', 900),
(52, 0, '', '', '2023-02-23 08:43:20', '', 900),
(53, 0, '', '', '2023-02-23 08:43:20', '', 900),
(54, 0, '', '', '2023-02-23 08:43:20', '', 900),
(55, 0, '', '', '2023-02-23 08:43:20', '', 900),
(56, 0, '', '', '2023-02-23 08:43:20', '', 900),
(57, 0, '', '', '2023-02-23 08:43:20', '', 900);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users2`
--
ALTER TABLE `users2`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `date` (`date`),
  ADD KEY `user_name` (`user_name`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users2`
--
ALTER TABLE `users2`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
