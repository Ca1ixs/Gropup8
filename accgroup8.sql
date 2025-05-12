-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2025 at 06:21 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `accgroup8`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `failed_attempts` int(11) NOT NULL DEFAULT 0,
  `last_failed_login` datetime DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `failed_attempts`, `last_failed_login`, `reset_token`, `reset_expires`) VALUES
(1, 'Calix', 'obcianakurt12@gmail.com', '$2y$10$jcvq77WjgVc96DGpOOZ7JOq7Xxi974TtmOhSu/d6HaLnJIpL.qGLy', '2025-05-11 17:20:13', 0, NULL, NULL, NULL),
(3, 'Ramborat', 'rambaarde@gmail.com', '$2y$10$wp6eDiI4LFmqmcaeJXdRrOyEnIQAd05I4a4y.Imb/lwEinLRbd2te', '2025-05-11 17:22:04', 6, '2025-05-12 22:33:26', '77f04e76dbab07ed4763d9b7853a0515', '2025-05-11 20:27:29'),
(4, 'IgyB30', 'asd@gmail.com', '$2y$10$WQL.jTbKfKKZForjTBYYCOXEibd4tRZGPOR2yzMvbkqzwsEFlP9xi', '2025-05-12 14:16:28', 0, NULL, NULL, NULL),
(5, 'KurtObciana', 'kurtobciana@yahoo.com', '$2y$10$GeCOHi7JkkF23Q/xa4H67OZ8gTKQhsvgLojqmR3vUq6Qry7buBNY.', '2025-05-12 14:18:05', 0, NULL, NULL, NULL),
(7, 'Tester12345', 'Tester12345@gmail.com', '$2y$10$NwMiLi28ofcNQsLSzb74nupaUV4JUe/3ZIshio9.CYfZb5w/X7QUi', '2025-05-12 14:28:00', 5, '2025-05-12 22:31:50', 'ee624fc42c91d939d5824b141309596d', '2025-05-13 01:02:10'),
(8, 'Test12345', 'kurtest@gmail.com', '$2y$10$7ZxIOE6BrgIQZMvC7DBLs.BqrG7RxGC6O9wOHP08HmHDmPt5/v3ky', '2025-05-12 14:53:11', 0, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
