-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 06, 2024 at 09:11 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login_it`
--

-- --------------------------------------------------------

--
-- Table structure for table `livechats`
--

CREATE TABLE `livechats` (
  `id` int(11) NOT NULL,
  `to_user` varchar(255) NOT NULL,
  `from_user` varchar(255) NOT NULL,
  `time` datetime NOT NULL,
  `body` text NOT NULL,
  `subject` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `livechats`
--

INSERT INTO `livechats` (`id`, `to_user`, `from_user`, `time`, `body`, `subject`) VALUES
(1, 'root', 'employeeEx', '2024-08-04 10:50:08', 'meowmoew', 'meow'),
(2, 'root', 'employeeEx', '2024-08-04 10:18:08', 'testing', 'hello'),
(3, 'root', 'test444', '2024-08-04 10:31:08', 'help with issue', 'hello'),
(4, 'root', 'test444', '2024-08-04 10:48:08', 'computer', 'help with'),
(5, 'root', 'employeeEx', '2024-08-04 10:34:08', 'turn it on and off again', 'ok you have to'),
(6, 'root', 'test444', '2024-08-04 10:42:08', 'thank you!\r\n', 'ohhhh'),
(7, 'root', 'test3', '2024-08-04 10:26:08', 'no problem!\r\n', 'you\'re welcome'),
(8, 'root', 'test3', '2024-08-04 11:16:08', 'help', 'hi'),
(9, 'root', 'test3', '2024-08-04 11:02:08', 'example', 'hi'),
(10, 'root', 'test444', '2024-08-04 11:41:08', 'im awesome', 'hello'),
(11, 'root', 'test3', '2024-08-04 11:57:08', 'so cool', 'wow'),
(12, 'root', 'test3', '2024-08-05 12:40:08', 'test', 'test'),
(13, 'root', 'test3', '2024-08-06 06:42:08', 'test', 'test');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `livechats`
--
ALTER TABLE `livechats`
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `id_2` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `livechats`
--
ALTER TABLE `livechats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
