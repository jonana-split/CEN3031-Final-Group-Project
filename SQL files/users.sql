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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `usertype` varchar(50) NOT NULL,
  `hours` int(55) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password_hash`, `usertype`, `hours`) VALUES
(3, 'jonanasplit', 'jmijares@ufl.edu', '$2y$10$5zIBUly31R9sGDm7H3yzZeaMh72Wf1fMZlIy4ncY45o.UBY0THet6', 'admin', 0),
(4, 'test1', 'meow@meow.com', '$2y$10$lRIe2KTXnmVv0zdkdb/Qv.N1YGY98V8F9/.22vcz.UkDlkbz/PyK6', 'admin', 0),
(6, 'test3', 'test3@gmail.com', '$2y$10$WvhThZAkWJIUfZwOpuDiNOpH27hkErpvOnCrbvA4FJNAE3U6aiV4q', 'user', 0),
(7, 'test4', 'test4@test.com', '$2y$10$ikXgHCbA9ileFqEFyFU.s.uyGQ0qO1eS6caGF1LHDU6AcjKtfUCb6', 'user', 0),
(10, 'meow', 'meow@meow.meow', '$2y$10$RSfPx.8zcG3vX.3.QGVxFeEBO0qNy6jRtXPnOUU0FyfJoQRqmW.Q2', 'user', 0),
(13, 'userExample', 'userexample@user.user', '$2y$10$ptP99c3ibX4Sm0rStWRdWO/h700CboEyH3eO/geuT7H9c2OPAZ536', 'user', 0),
(15, 'example', 'eample@example.com', '$2y$10$BBmYP2LbuwGxyxq73jOKSu6rvFlfhDU2IPNJb6xP4NvbqiwUNG1xy', 'user', 0),
(16, 'test', 'test@test.testtest', '$2y$10$L5ScA1efsz825Lh/1oQbVuDvwTuuqAnZ2K/V9cYp.xBIn4CdAVLi2', 'user', 0),
(17, 'employee', 'employee@employee.com', '$2y$10$ABOtNLwHuXKtPDH8G.lS5OliIVXoJFoAnyk0oiz.fXnRcaqGboV/S', 'employee', 0),
(18, 'employee1', 'emp@loyee.com', '$2y$10$uQ4f6K7LeOFkIfZcD20CqOFecK2xJYcC.sbSM0QHJamk16E440svq', 'employee', 0),
(19, 'adminTest', 'admin@admin.admin', '$2y$10$9021DDzPmlHzmXt5DUyUW.kuDQGqYTlYFrS5.7Vq0Ovy1ocGdHMHy', 'admin', 0),
(20, 'adminTest2', 'admin2@admin2.admin2', '$2y$10$Hn8KHD324XkTH1IFzPjBU.vS1jw8v4F6mazT0yWuzHbBucS3F41iG', 'admin', 0),
(21, 'userTest', 'user@user.user1', '$2y$10$FOmawUiELvlWrdoPubGTWed3r2cEl9cxnhcbgJr9E015qpYVFilw.', 'user', 0),
(26, 'employeeExample', 'example@employee.com', '$2y$10$L.OssftzKEhN8D5ir8icxOWp7yXQb8FBSY6kn/qkzhKVdlMTffEqm', 'employee', 0),
(27, 'employeeEx', '123e@emplo.yee', '$2y$10$gFsZQ3Z5Bz6Tv0ELnFLBsu8WRnrrFi139NrNn9i5hXd1jfCUDE.FK', 'employee', 0),
(28, 'grarlixcx', 'a@a.com', '$2y$10$1SEdsA5mIGLbHt5bqZ2GAek.uqqptzpT2s/frwq9QyH7DIu0UvBfK', 'user', 0),
(30, 'test444', 'test@4.com', '$2y$10$7kHWxPnhUndagRBxlCvz.uMMolVEbZt2jND6oQNs.uQSLvM8kZBra', 'user', 0),
(32, 'useruseruser', 'user@user.usersss', '$2y$10$iK7x80fIbZNE4bb117HbeOe2FHEguDZSI0wRNjwPmZwelwD9lOdlq', 'employee', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
