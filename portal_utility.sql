-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 09, 2024 at 09:22 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portal_utility`
--

-- --------------------------------------------------------

--
-- Table structure for table `meteran_airs`
--

CREATE TABLE `meteran_airs` (
  `id` bigint UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `yesterday` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `today` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `lang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `custom_fields` json DEFAULT NULL,
  `avatar_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nik` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `theme` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'default',
  `theme_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `role`, `remember_token`, `created_at`, `updated_at`, `lang`, `custom_fields`, `avatar_url`, `nik`, `theme`, `theme_color`) VALUES
(1, 'Widi Fajar Satritama', 'widifajarsatritama@gmail.com', '2024-07-17 09:59:25', '$2y$12$fo49ZiQmAPM8U7PPkRWeZ.hTecQJUS6JtenQdRvm4YErLskxaEXnm', NULL, NULL, NULL, 'ADMIN', 'YxeunXWSBg6ltjsmlDZiPdLkJixDsUTIr5PgG6QDhIw5wzAhyAj39JwCDTx8', '2024-06-17 19:34:24', '2024-07-22 03:01:36', 'en', NULL, NULL, '22095652', 'default', NULL),
(2, 'Guest', 'guest@gmail.com', NULL, '$2y$12$92g2mt.NCBVd9CQlAFJ8duB8ajQJK9OllkydOKdWVPCE32Fc.6GdW', NULL, NULL, NULL, 'USER', NULL, '2024-06-18 19:21:09', '2024-06-18 19:21:09', 'en', NULL, NULL, NULL, 'default', NULL),
(3, 'Renata Arthaully', 'aga29604424@gmail.com', NULL, '$2y$12$rtPZo2zwEUbTLC/ulYZcZeHADyEYe2lcU153GsfPmVPoRrwGLkGoS', NULL, NULL, NULL, 'EDITOR', '9WrpqJspsItH8cZPugZiUqt5UNJDITXKY6CXhDLhg2S9J0j8YtINWtmIjMLD', '2024-07-17 02:51:16', '2024-07-17 19:29:58', 'en', NULL, NULL, '23035833', 'default', NULL),
(4, 'Pratama Handika Rudiyanta', 'pratamarudiyanta@gmail.com', NULL, '$2y$12$KYd1JH3IHZsticKhe94Hd.yt/aR2J2YFH95/4eP4kaFvnS8RZ0KWS', NULL, NULL, NULL, 'USER', NULL, '2024-07-17 18:30:30', '2024-07-17 18:51:12', 'en', NULL, NULL, '23105984', 'default', NULL),
(8, 'Ridwan Andriyanto', 'ridwan.andriyanto@siix-global.com', NULL, '$2y$12$S2EIx7pUcODttJPfwa4llOjTAGB3OcRZ/T08fAzqwyx9hb.q4b7k6', NULL, NULL, NULL, 'USER', NULL, '2024-07-17 19:41:28', '2024-07-17 19:41:28', 'en', NULL, NULL, '15052967', 'default', NULL),
(9, 'Super Administrator', 'sek.utility@gmail.com', NULL, '$2y$12$fFo7CuGQkcybbwKatUWhYeeC8xn4tTS0httdQ6hawPjdOryl8s2hy', NULL, NULL, NULL, 'ADMIN', NULL, '2024-07-17 19:45:54', '2024-07-17 20:17:19', 'en', NULL, NULL, '0', 'default', NULL),
(10, 'Heru Agus Kurniawanto', 'heru@gmail.com', NULL, '$2y$12$4YE41iQxwu4EJOc9BSwX1..p0RKuqzcG8jMmihsIBxOUEjWRejZFa', NULL, NULL, NULL, 'EDITOR', NULL, '2024-07-29 23:09:57', '2024-07-29 23:09:57', 'en', NULL, NULL, '20034748', 'default', NULL),
(11, 'Tri', 'test@gmail.com', NULL, '$2y$12$7Mrqh8tKB1BjoGTA60aCpuh0KW6Yv4TYGt3ClxEljxs99QHm2pU6S', NULL, NULL, NULL, 'EDITOR', 'rf7z7UufAMAyTcYFgS4svUQLnUsSVGlTUdWCW50swAaRgKZ5E56IgjbGqqK8', '2024-07-30 00:05:18', '2024-07-30 00:05:18', 'en', NULL, NULL, '14051073', 'default', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `meteran_airs`
--
ALTER TABLE `meteran_airs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `users_email_unique` (`email`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `meteran_airs`
--
ALTER TABLE `meteran_airs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
