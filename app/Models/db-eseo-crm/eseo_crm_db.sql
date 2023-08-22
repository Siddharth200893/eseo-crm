-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2023 at 02:20 PM
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
  `user_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `link` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `payment_status` tinyint(255) NOT NULL,
  `payment_approvel` tinyint(4) NOT NULL,
  `reference_number` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guestpost_leads`
--

INSERT INTO `guestpost_leads` (`id`, `user_id`, `role_id`, `project_id`, `link`, `amount`, `currency`, `payment_mode`, `payment_status`, `payment_approvel`, `reference_number`, `created_at`, `updated_at`) VALUES
(1, 3, 2, 1, 'https://www.html.com', '21212', 'inr', 'upi', 1, 1, '', '2023-08-19 15:21:02', '2023-08-19 15:21:02'),
(2, 3, 2, 9, 'https://www.ksjdfdfed.com', '121212', 'usd', 'paypal', 1, 1, 'sdfe333', '2023-08-21 15:49:56', '2023-08-21 15:49:56'),
(3, 3, 2, 2, 'https://www.htmddddl.com', '121', 'inr', 'upi', 1, 1, '', '2023-08-21 18:35:22', '2023-08-21 18:35:22'),
(4, 3, 2, 2, 'https://www.htmdl.com', '2323', 'usd', 'paypal', 1, 1, '', '2023-08-21 18:36:10', '2023-08-21 18:36:10'),
(5, 3, 2, 1, 'https://www.s.com', '2121', 'na', 'paypal', 0, 0, 'ww', '2023-08-22 12:08:23', '2023-08-22 12:08:23'),
(6, 3, 2, 2, 'https://www.htmjl.com', '121', 'na', 'na', 1, 1, 'dg', '2023-08-22 14:26:11', '2023-08-22 14:26:11'),
(7, 3, 2, 2, 'https://www.maggi.com', '12', 'na', 'na', 0, 0, '', '2023-08-22 15:45:15', '2023-08-22 15:45:15');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'eseo', 1, '2023-08-19 11:08:00', '2023-08-19 11:08:00'),
(2, 'fjgk', 1, '2023-08-19 12:11:25', '2023-08-19 12:11:25'),
(9, 'xyx', 1, '2023-08-19 15:20:02', '2023-08-19 15:20:02'),
(10, 'aditya', 1, '2023-08-19 15:23:48', '2023-08-19 15:23:48'),
(11, 'rajat', 1, '2023-08-19 15:34:48', '2023-08-19 15:34:48'),
(12, 'www', 1, '2023-08-19 15:35:48', '2023-08-19 15:35:48'),
(13, 'rohit singh', 1, '2023-08-19 15:36:12', '2023-08-19 15:36:12');

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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guestpost_leads`
--
ALTER TABLE `guestpost_leads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`),
  ADD KEY `fk_role_id` (`role_id`),
  ADD KEY `fk_project_id` (`project_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkk_user_id` (`user_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guestpost_leads`
--
ALTER TABLE `guestpost_leads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `guestpost_leads`
--
ALTER TABLE `guestpost_leads`
  ADD CONSTRAINT `fk_project_id` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`),
  ADD CONSTRAINT `fk_role_id` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`),
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `fkk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
