-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2023 at 05:28 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mvc_framework`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `ip` text NOT NULL,
  `name` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip`, `name`, `created_at`) VALUES
(1, '', 'sa', '2023-07-17 07:11:35'),
(2, '', 'ss', '2023-07-17 07:27:16'),
(3, '', 'Sam White', '2019-05-08 15:29:27'),
(4, '', 'Colin Chaplin', '2019-05-08 15:29:27'),
(5, '', 'Ricky Waltz', '2019-05-09 17:16:00'),
(6, '', 'Arnold Hall', '2019-05-09 17:17:00'),
(7, '', 'Toni Adams', '2019-05-09 17:19:00'),
(8, '', 'Donald Perry', '2019-05-09 17:20:00'),
(9, '', 'Joe McKinney', '2019-05-09 17:20:00'),
(10, '', 'Angela Horst', '2019-05-09 17:21:00'),
(11, '', 'James Jameson', '2019-05-09 17:32:00'),
(12, '', 'Daniel Deacon', '2019-05-09 17:33:00'),
(13, '', 'John Doe', '2019-05-08 15:32:00'),
(14, '', 'David Deacon', '2019-05-08 15:28:44'),
(15, '::1', 'user-1689644764', '2023-07-18 01:46:04');

-- --------------------------------------------------------

--
-- Table structure for table `wisdoms`
--

CREATE TABLE `wisdoms` (
  `id` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wisdoms`
--

INSERT INTO `wisdoms` (`id`, `content`, `created_at`, `user_id`) VALUES
(11, '12', '2023-07-23 04:08:38', 15),
(12, '2', '2023-07-23 04:08:46', 15),
(13, '3', '2023-07-23 04:09:25', 15),
(14, '4', '2023-07-23 04:09:33', 15),
(19, 'sa6', '2023-07-24 15:30:00', 15),
(22, 'gjfgjf', '2023-07-24 16:46:07', 15),
(23, 'jhfhjf', '2023-07-24 17:17:02', 15),
(24, 'salah', '2023-07-24 17:17:08', 15),
(25, 'fsggfgfgsss', '2023-07-24 22:48:12', 15);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wisdoms`
--
ALTER TABLE `wisdoms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `wisdoms`
--
ALTER TABLE `wisdoms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `wisdoms`
--
ALTER TABLE `wisdoms`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
