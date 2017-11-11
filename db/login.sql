-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 11, 2017 at 08:02 AM
-- Server version: 5.7.19-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(15) NOT NULL,
  `user_email` varchar(40) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `joining_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_pass`, `joining_date`) VALUES
(1, 'narendra', 'narendra@gmail.com', '$2y$10$1rptGuoI7gAkCLyVyf9QQOUevPyRt6vjgMAbbcsPeZ7h2yjmtnVlS', '2017-11-10 10:12:34'),
(2, 'narendrad', 'narendrad@gmail.com', '$2y$10$Sp92y6bvXAHwxdcrHUau/OB.GZvwhg2KrBK6CF3ffjX7/fyfknnki', '2017-11-10 13:03:00'),
(3, 'test123', 'narendrad1@gmail.com', '$2y$10$/i74t7l.dYHLdjoCmDfK2OP3ZPlkzpgBFGp5scLQ.BQiYGeh70wg.', '2017-11-10 13:47:49'),
(4, 'dev123', 'dev123@gmail.com', '$2y$10$7q4J3g/Gekv4Erlntz6h8eVDGJQ2DLRtdrY9h8a2UnHxSKauGIpGK', '2017-11-10 13:50:48'),
(5, 'devdev', 'devdev@gmail.com', '$2y$10$D9/7MINSrHtxhZSv7HBcOOSZAHXBt7.oDs6OLAcVvMNHIodC2SMJ2', '2017-11-10 13:52:20'),
(6, 'demo', 'demo@gmail.com', '$2y$10$sYEIidELRONPyfpYJD9X6uZ6sHtsn9It2wmzygpwHC5An/vCNNimW', '2017-11-11 02:30:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
