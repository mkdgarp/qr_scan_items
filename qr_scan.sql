-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2024 at 03:05 PM
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
-- Database: `qr_scan`
--

-- --------------------------------------------------------

--
-- Table structure for table `qr_data`
--

CREATE TABLE `qr_data` (
  `id` int(11) NOT NULL,
  `assets_key` varchar(16) NOT NULL,
  `assets_type` varchar(16) NOT NULL,
  `zero_code` varchar(16) NOT NULL,
  `start_depreciation` datetime NOT NULL,
  `address` text NOT NULL,
  `qty` double NOT NULL,
  `unit` varchar(16) NOT NULL,
  `age` varchar(3) NOT NULL,
  `cost_price` double NOT NULL,
  `total_price` double NOT NULL,
  `layout` varchar(16) NOT NULL,
  `user_id` varchar(8) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `qr_data`
--

INSERT INTO `qr_data` (`id`, `assets_key`, `assets_type`, `zero_code`, `start_depreciation`, `address`, `qty`, `unit`, `age`, `cost_price`, `total_price`, `layout`, `user_id`, `created_date`, `updated_date`) VALUES
(1, '123123', 'C0001212', 'C0001212', '2024-03-08 00:00:00', 'C0001212', 1, '1', '1', 1, 1, '1', 'test', '2024-03-06 11:45:54', '2024-03-06 11:45:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` text NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT 0,
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `create_at`) VALUES
(1, 'adminadmin', '$2y$12$PX/6KXzCGkNbhQmSlI7M3OV7g8Z6Y64sLDaqgjTpUr7qPAdTIzDvi', 1, '2024-03-06 13:43:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `qr_data`
--
ALTER TABLE `qr_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `qr_data`
--
ALTER TABLE `qr_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
