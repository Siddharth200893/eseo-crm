-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2023 at 11:09 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eseo_crm_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `guestpost_leads`
--

CREATE TABLE `guestpost_leads` (
  `id` int(11) NOT NULL,
  `link` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `payment_status` tinyint(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guestpost_leads`
--

INSERT INTO `guestpost_leads` (`id`, `link`, `amount`, `currency`, `payment_mode`, `payment_status`, `created_at`, `updated_at`) VALUES
(1, 'dfgfdgfdgfdg', '2323', 'inr', 'pending', 0, '2023-08-10 17:50:03', '2023-08-10 17:50:03'),
(2, 'sdfsdfsdf', '1111', 'inr', 'pending', 0, '2023-08-11 10:18:26', '2023-08-11 10:18:26'),
(3, 'fr', '212', 'inr', 'pending', 1, '2023-08-11 11:18:39', '2023-08-11 11:18:39');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2023-08-09 10:43:53', '2023-08-09 10:43:53'),
(2, 'agent', '2023-08-09 10:44:01', '2023-08-09 10:44:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `phone`, `password`, `created_at`, `updated_at`) VALUES
(1, 1, 'siddharth', 'sharmasiddharth385@gmail.com', '', '$2y$10$adkAgLeLJJ1zxZ8fDeaEPeYeSS3.q/FvDyqqCEbmCW8DTTHvt5Eha', '2023-08-09 12:21:40', '2023-08-09 12:21:40'),
(3, NULL, 'siddharth sharma', 'patlu@gmaill.com', '07206771558', '$2y$10$3XwLb1YwJ.DxMQzqpQoEpuc/sci8uaF5EVl5OtErdU9aF8SrszKi6', '2023-08-09 13:16:29', '2023-08-09 13:16:29'),
(4, 2, 'SIDDHARTH SHARMA', 'sharmasiddharth5@gmail.com', '07206771558', '$2y$10$80bMrLfL58s/NvvM/mJ0ruhz1bQQXG.Lzbwg7OuONuj/S2fi0J5AW', '2023-08-11 12:14:26', '2023-08-11 12:14:26'),
(5, 1, 'SIDDHARTH SHARMA', 'sharmasiddh385@gmail.com', '07206771558', '$2y$10$UnjXQqA2IT5VF2zRsfYmZeklGAs8CrIMKZZPP2XHjUwCcSgqPFw5O', '2023-08-11 12:17:32', '2023-08-11 12:17:32'),
(6, 1, 'SIDDHARTH SHARMA', 'sharmarth385@gmail.com', '07206771559', '$2y$10$msll8O10lxynsNyEyq7uW.tiUEHlTk9fCx21m8MWoS8nGEf.2U2Ou', '2023-08-11 12:20:26', '2023-08-11 12:20:26'),
(7, NULL, 'SIDDHARTH SHARMA', 'shh385@gmail.com', '07206771558', '$2y$10$MbFJ1ruDaVUZOxmSD7EMluL9VB8EREoT2tSdug5v8KU9oTlNuOb4m', '2023-08-11 12:24:24', '2023-08-11 12:24:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guestpost_leads`
--
ALTER TABLE `guestpost_leads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guestpost_leads`
--
ALTER TABLE `guestpost_leads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
