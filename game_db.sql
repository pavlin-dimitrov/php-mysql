-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2021 at 11:43 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `game_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `result_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `victories` int(1) NOT NULL,
  `defeats` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`result_id`, `id`, `victories`, `defeats`) VALUES
(1, 85, 1, 0),
(10, 85, 1, 0),
(11, 85, 1, 0),
(12, 85, 1, 0),
(13, 85, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(85, 'hash_proba', '$2y$10$hAty9gVJ1XVzNp4EQfEQ2u9Nv.gN7CWGpsBbp60SbwcuITqcOs5f6'),
(86, 'new_user', '$2y$10$ul5fLeI92LAiQ/84ch1L3.cQZv6FvINFYUUbem7MQfacgMorqaPI2'),
(87, 'second_user', '$2y$10$0e.iD8Pu0RGJRDdG8RiGbuFcVNW3N945S45qLnWac5rdcP/5vnani'),
(95, 'examp1', '$2y$10$fWuXSd8OcDOVlY3pqZsm5.QIKJt8edFrqNzlzJOcTW4vfP/7IktIO'),
(96, 'examp2', '$2y$10$Cwh5QaSGtOhXYFyCi87vjObeLsD0E.FBCPQJqkjU3MiBob9z8/SxG'),
(97, 'examp3', '$2y$10$3xE2FHlpcisIrtstqHw7POQSbHNYiKVfPsysvtPI0pMwaiHt7yCqm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`result_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `results_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
