-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 06, 2024 at 09:10 PM
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
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` int(11) NOT NULL,
  `to_user` varchar(255) NOT NULL,
  `from_user` varchar(255) NOT NULL,
  `time` datetime NOT NULL,
  `ticket_id` int(128) NOT NULL,
  `body` text NOT NULL,
  `subject` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `to_user`, `from_user`, `time`, `ticket_id`, `body`, `subject`) VALUES
(1, 'employee1', 'test3', '2024-08-02 00:00:00', 1, 'hello test', 'subject test'),
(2, 'test3', 'employee1', '2024-08-03 00:00:00', 1, 'hello hello', 'subject line'),
(3, 'employee', 'test3', '2024-08-03 00:00:00', 1, 'meowmoew', 'meow'),
(4, 'employee', 'test3', '2024-08-03 05:56:08', 1, 'meowmoewmeowmeow', 'meow'),
(5, 'employee', 'test3', '2024-08-03 05:28:08', 3, 'help!', 'ticket 3'),
(6, 'employee', 'test3', '2024-08-03 05:27:08', 1, 'testing this thing bla bla bla bla bla bla bla', 'testing'),
(7, 'employee', 'test3', '2024-08-03 06:03:08', 1, 'meowmoewmeowmeow', 'meow'),
(8, 'employee', 'test3', '2024-08-03 06:41:08', 1, 'meowmoewmeowmeow', 'meow'),
(9, 'employee', 'test3', '2024-08-03 06:51:08', 1, 'testing this thing bla bla bla bla bla bla bla', 'hi!'),
(10, 'employee', 'test3', '2024-08-03 06:38:08', 1, 'the chat is working', 'look guys'),
(11, 'employee', 'test3', '2024-08-03 06:55:08', 1, 'goes to the top', 'newest chat'),
(12, 'test3', 'employeeEx', '2024-08-03 06:23:08', 1, 'meowmoew', 'meow'),
(13, 'test3', 'employeeEx', '2024-08-04 12:44:08', 1, 'test', 'meow'),
(14, 'employeeEx', 'test3', '2024-08-04 03:50:08', 1, 'meow meowmeowmeow', 'meow'),
(15, 'test3', 'employeeEx', '2024-08-04 04:31:08', 1, 'meowmoewmeowmeow', 'meow'),
(16, 'employee', 'test3', '2024-08-04 11:38:08', 6, 'hi', 'hi!'),
(17, 'employee', 'test3', '2024-08-05 12:49:08', 7, 'meow', 'meow');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `id_2` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
