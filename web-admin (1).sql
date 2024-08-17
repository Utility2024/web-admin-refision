-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 17, 2024 at 10:50 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web-admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `category_tickets`
--

CREATE TABLE `category_tickets` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_tickets`
--

INSERT INTO `category_tickets` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'HR', 'Human Resources related tickets', '2024-08-17 02:02:38', '2024-08-17 02:02:38'),
(2, 'GA', 'General Affairs related tickets', '2024-08-17 02:02:38', '2024-08-17 02:02:38'),
(3, 'Utility Facility', 'Tickets related to facility management and utilities', '2024-08-17 02:02:39', '2024-08-17 02:02:39'),
(4, 'Electrostatic Discharge', 'Tickets related to ESD (Electrostatic Discharge) issues', '2024-08-17 02:02:39', '2024-08-17 02:02:39');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint UNSIGNED NOT NULL,
  `ticket_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `priority` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `assigned_to` bigint UNSIGNED DEFAULT NULL,
  `closed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `ticket_number`, `title`, `description`, `status`, `priority`, `category_id`, `assigned_to`, `closed_at`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(4, 'TC/17-08-2024/0001', 'Test', 'Test', 'Closed', 'Low', 4, 16, '2024-08-17 03:04:00', '2024-08-17 03:02:39', '2024-08-17 03:03:09', '25', '25'),
(5, 'TC/17-08-2024/0002', 'Test', 'Test', 'Closed', 'Low', 4, 16, '2024-08-17 03:17:19', '2024-08-17 03:08:03', '2024-08-17 03:17:19', '25', '25'),
(6, 'TC/17-08-2024/0003', 'Pengukuran dan Verifikasi Ionizer', 'Test', 'Closed', 'Low', 4, 16, '2024-08-17 10:19:02', '2024-08-17 03:18:50', '2024-08-17 03:19:02', '25', '25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category_tickets`
--
ALTER TABLE `category_tickets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_tickets_name_unique` (`name`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tickets_ticket_number_unique` (`ticket_number`),
  ADD KEY `tickets_category_id_foreign` (`category_id`),
  ADD KEY `tickets_assigned_to_foreign` (`assigned_to`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category_tickets`
--
ALTER TABLE `category_tickets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_assigned_to_foreign` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tickets_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `category_tickets` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
