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
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `user` varchar(255) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(55) NOT NULL DEFAULT 'open',
  `employeeid` varchar(128) NOT NULL,
  `time_estimate` int(128) NOT NULL DEFAULT 0,
  `logged_hours` int(128) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `type`, `description`, `user`, `date`, `status`, `employeeid`, `time_estimate`, `logged_hours`) VALUES
(1, 'Hardware', 'example', 'test3', '2024-08-06', 'open', 'employeeEx', 20, 20),
(2, 'Hardware', 'example', 'jonanasplit', '2024-08-02', 'open', 'employee', 0, 0),
(3, 'Hardware', 'example', 'test3', '2024-08-03', 'open', 'employee', 0, 0),
(4, 'Meow', 'Dennis and dee and chawlee and mac and frank', 'test3', '2024-08-03', 'open', 'employee', 0, 0),
(5, 'Grace ticket', 'Grace\'s ticket', 'grarlixcx', '2024-08-03', 'open', 'employee', 0, 0),
(6, 'Hardware', 'example', 'test3', '2024-08-04', 'open', 'employee', 0, 0),
(7, 'Hardware', 'meow', 'test3', '2024-08-05', 'open', 'employee', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
