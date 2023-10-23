-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2023 at 03:17 PM
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
-- Database: `eseo_crm_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'USD', 3, '2023-09-26 12:26:28', '2023-09-26 12:26:28'),
(2, 'INR', 3, '2023-09-26 12:26:34', '2023-09-26 12:26:34');

-- --------------------------------------------------------

--
-- Table structure for table `dummy_users`
--

CREATE TABLE `dummy_users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `dummy_users`
--

INSERT INTO `dummy_users` (`id`, `name`, `email`, `city`, `status`) VALUES
(0, 'a', 'a@gmail.com', 'a1', '0'),
(0, 'b', 'b@gmail.com', 'a2', '1'),
(0, 'c', 'c@gmail.com', 'a3', '0'),
(0, 'd', 'd@gmail.com', 'a4', '1'),
(0, 'e', 'e@gmail.com', 'a5', '1'),
(0, 'f', 'f@gmail.com', 'a6', '0'),
(0, 'g', 'g@gmail.com', 'a7', '1');

-- --------------------------------------------------------

--
-- Table structure for table `guestpost_leads`
--

CREATE TABLE `guestpost_leads` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `payment_mode_id` int(11) DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `agent_email` varchar(255) NOT NULL,
  `blogger_name` varchar(255) NOT NULL,
  `blogger_email` varchar(255) NOT NULL,
  `blogger_phone` varchar(50) NOT NULL,
  `is_flag` tinyint(4) NOT NULL DEFAULT 0,
  `payee_email` varchar(255) DEFAULT NULL,
  `payee_number` varchar(15) DEFAULT NULL,
  `payment_status` tinyint(1) NOT NULL DEFAULT 0,
  `payment_approvel` tinyint(1) NOT NULL DEFAULT 0,
  `reference_number` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guestpost_leads`
--

INSERT INTO `guestpost_leads` (`id`, `user_id`, `role_id`, `project_id`, `payment_mode_id`, `currency_id`, `link`, `amount`, `agent_email`, `blogger_name`, `blogger_email`, `blogger_phone`, `is_flag`, `payee_email`, `payee_number`, `payment_status`, `payment_approvel`, `reference_number`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 1, 1, 1, 'https://www.html.com', '788', 'priyanka@eseo.com', 'testing', 'sharmasiddharth385@gmail.com', '7206771558', 0, 'sharmasiddharth385@gmail.com', '', 1, 0, '', '2023-10-23 15:44:53', '2023-10-23 10:23:00'),
(2, 2, 2, 1, 1, 1, 'https://www.dddww.com', '23233', 'priyanka@eseo.com', 'testing', 'sharmasiddharth385@gmail.com', '7206771558', 0, 'sharmasiddharth385@gmail.com', NULL, 1, 0, '', '2023-10-23 16:03:45', '2023-10-23 16:03:45'),
(3, 2, 2, 1, NULL, NULL, 'https://www.ddfdf.com', NULL, 'priyanka@eseo.com', 'testing', 'sharmasiddharth385@gmail.com', '7206771558', 0, NULL, NULL, 0, 0, NULL, '2023-10-23 17:24:38', '2023-10-23 17:24:38'),
(4, 2, 2, 1, 2, 2, 'https://www.ssshtml.com', '212232', 'priyanka@eseo.com', 'testing', 'sharmasiddharth385@gmail.com', '7206771558', 0, NULL, '7206771558', 1, 0, 'wqq', '2023-10-23 17:25:12', '2023-10-23 17:25:12'),
(5, 2, 2, 1, 3, 2, 'https://www.dddttt.com', '2323', 'priyanka@eseo.com', 'testing', 'sharmasiddharth385@gmail.com', '7206771558', 0, NULL, NULL, 1, 0, NULL, '2023-10-23 17:25:45', '2023-10-23 17:25:45');

-- --------------------------------------------------------

--
-- Table structure for table `payment_details`
--

CREATE TABLE `payment_details` (
  `id` int(11) NOT NULL,
  `guestpost_id` int(11) DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `payment_mode_id` int(11) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `payee_number` varchar(15) DEFAULT NULL,
  `account_no` int(55) DEFAULT NULL,
  `account_name` varchar(55) DEFAULT NULL,
  `ifsc_code` varchar(30) DEFAULT NULL,
  `reference_number` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_details`
--

INSERT INTO `payment_details` (`id`, `guestpost_id`, `currency_id`, `payment_mode_id`, `amount`, `payee_number`, `account_no`, `account_name`, `ifsc_code`, `reference_number`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, '7889', NULL, NULL, NULL, NULL, NULL, '2023-10-23 15:44:56', '2023-10-23 15:44:56'),
(2, 2, 1, 1, '2323', NULL, NULL, NULL, NULL, '', '2023-10-23 16:03:45', '2023-10-23 16:03:45'),
(3, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-23 17:24:38', '2023-10-23 17:24:38'),
(4, 4, 2, 2, '21299', '7206771558', NULL, NULL, NULL, 'wqq', '2023-10-23 17:25:12', '2023-10-23 17:25:12'),
(5, 5, 2, 3, '23236', NULL, 232332, 'sadada', 'adadad', NULL, '2023-10-23 17:25:45', '2023-10-23 17:25:45');

-- --------------------------------------------------------

--
-- Table structure for table `payment_modes`
--

CREATE TABLE `payment_modes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_modes`
--

INSERT INTO `payment_modes` (`id`, `name`, `user_id`, `currency_id`, `created_at`, `updated_at`) VALUES
(1, 'Paypal', 3, 1, '2023-10-20 13:15:00', '2023-10-20 07:45:00'),
(2, 'UPI', 3, 2, '2023-10-20 13:15:17', '2023-10-20 07:45:17'),
(3, 'Bank Details', 3, 2, '2023-10-20 13:15:27', '2023-10-20 07:45:27');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'siddharthssss', 1, '2023-08-24 12:19:31', '2023-08-24 12:19:31'),
(2, 'second', 1, '2023-09-25 14:28:35', '2023-09-25 14:28:35');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2023-08-09 10:43:53', '2023-08-09 10:43:53'),
(2, 'Agent', '2023-08-09 10:44:01', '2023-08-09 10:44:01'),
(3, 'Manager', '2023-09-14 14:32:17', '2023-09-14 14:32:17');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `phone`, `password`, `created_at`, `updated_at`) VALUES
(1, 1, 'Siddharth', 'admin@eseo.com', '7206771558', '$2y$10$blvDqe8WUWm1LEuXxFJLfehNvfpnPZJmxZ6/2yuS0amkpzjP.lRJi', '2023-08-24 12:08:04', '2023-10-03 08:21:00'),
(2, 2, 'Priyanka', 'priyanka@eseo.com', '7206771558', '$2y$10$x1NLHEZe5e0Bc1Leskh3UexRUlnAcqL9//2EZDIrVQn9qDOJSQMOy', '2023-08-24 12:08:47', '2023-10-03 09:31:00'),
(3, 3, 'Rohit', 'manager@eseo.com', '7206771558', '$2y$10$8NADB56Jm5KGy0Y44.tFj.wVT1uO2/S7l/OiaH1oVXo0FSQelCKC2', '2023-09-14 14:43:59', '2023-10-03 08:46:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkkkk_user_id` (`user_id`);

--
-- Indexes for table `guestpost_leads`
--
ALTER TABLE `guestpost_leads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`),
  ADD KEY `fk_role_id` (`role_id`),
  ADD KEY `fk_project_id` (`project_id`),
  ADD KEY `fk_payment_mode_id` (`payment_mode_id`),
  ADD KEY `fk_currency_id` (`currency_id`);

--
-- Indexes for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guestpost_id` (`guestpost_id`),
  ADD KEY `currency_id` (`currency_id`),
  ADD KEY `payment_mode_id` (`payment_mode_id`);

--
-- Indexes for table `payment_modes`
--
ALTER TABLE `payment_modes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f_user_id` (`user_id`),
  ADD KEY `fkk_currency_id` (`currency_id`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `guestpost_leads`
--
ALTER TABLE `guestpost_leads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment_modes`
--
ALTER TABLE `payment_modes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `currencies`
--
ALTER TABLE `currencies`
  ADD CONSTRAINT `fkkkk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `guestpost_leads`
--
ALTER TABLE `guestpost_leads`
  ADD CONSTRAINT `fk_currency_id` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`),
  ADD CONSTRAINT `fk_payment_mode_id` FOREIGN KEY (`payment_mode_id`) REFERENCES `payment_modes` (`id`),
  ADD CONSTRAINT `fk_project_id` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`),
  ADD CONSTRAINT `fk_role_id` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`),
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD CONSTRAINT `payment_details_ibfk_1` FOREIGN KEY (`guestpost_id`) REFERENCES `guestpost_leads` (`id`),
  ADD CONSTRAINT `payment_details_ibfk_2` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`),
  ADD CONSTRAINT `payment_details_ibfk_3` FOREIGN KEY (`payment_mode_id`) REFERENCES `payment_modes` (`id`);

--
-- Constraints for table `payment_modes`
--
ALTER TABLE `payment_modes`
  ADD CONSTRAINT `f_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fkk_currency_id` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`);

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `fkk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
