-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2023 at 03:59 AM
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
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users2`
--

INSERT INTO `users2` (`id`, `user_id`, `user_name`, `password`, `date`, `email`) VALUES
(3, 7613402600654130, 'Nalla', '1234', '2023-02-07 05:49:11', '1111'),
(5, 78106457482318, 'Allan', '1234', '2023-02-07 05:49:13', '1111'),
(6, 39517, 'Nalla234', '1234', '2023-02-07 05:19:53', 'allan.cor98@gmail.com'),
(7, 3545273918, 'Nalla2412414', '1234', '2023-02-07 05:20:28', 'allan.cor98@gmail.com'),
(8, 562334958324227765, 'Nalla123', '1234', '2023-02-07 05:21:37', '123123123123'),
(9, 7420808576538, 'Nalla`12`12', '1234', '2023-02-07 05:53:48', 'allan1.cor98@gmail.com'),
(10, 34305574, 'Nalla', '1234', '2023-02-07 06:21:21', 'aa'),
(11, 5462411144267247005, 'Nalla', '1234', '2023-02-07 06:21:31', 'aaaa'),
(12, 9217155, 'Nalla', '1234', '2023-02-07 06:22:00', 'sss'),
(13, 402070711921172441, 'Nalla', '1234', '2023-02-14 02:58:04', '2'),
(14, 4824604625395, 'Nalla', '1234', '2023-02-14 02:58:07', '11'),
(15, 595080304037, 'Nalla', '1234', '2023-02-14 02:58:33', '3213123');

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
