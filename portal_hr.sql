-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 16, 2024 at 10:04 AM
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
-- Database: `portal_hr`
--

-- --------------------------------------------------------

--
-- Table structure for table `breezy_sessions`
--

CREATE TABLE `breezy_sessions` (
  `id` bigint UNSIGNED NOT NULL,
  `authenticatable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `authenticatable_id` bigint UNSIGNED NOT NULL,
  `panel_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guard` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `expires_at` timestamp NULL DEFAULT NULL,
  `two_factor_secret` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `breezy_sessions`
--

INSERT INTO `breezy_sessions` (`id`, `authenticatable_type`, `authenticatable_id`, `panel_id`, `guard`, `ip_address`, `user_agent`, `expires_at`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, NULL, NULL, NULL, NULL, NULL, 'eyJpdiI6Im5Jcm5YNGVnT25ON0NTS3VSSDZKR2c9PSIsInZhbHVlIjoiODJhSjZvSU0wZTJvUUZrR2x4SHVVUjNadnNaM3VrQTJYeGlVY1pNbVNmaz0iLCJtYWMiOiJkNzAxZWI4YWU5YzdmYTRkMzhmZmYyYzBmYzc1NzEwOWY1NGMxYTUzZmE3YTFjMGM5M2VlZDQ4NzdmMmI0MWM2IiwidGFnIjoiIn0=', 'eyJpdiI6ImVOc1NwdGpRY21kenZWNVIxNlhjSnc9PSIsInZhbHVlIjoicHBQdnA4VHlQN2FrZkU1MC91L0ZPcHhjWlAvTnJkV1ltYUpoTlZJKzBJcmxuREVTd1k0czNaS1UxT1hIRnE4bG5EVHJWRkpNVWt0QlNGNlpoM1RWTHFMenJ2emExU2RIR09ad3JMWUdiQUMzVXJGZlNuSnVuM0JzaFphU2pqcTZWY0xReWVqZlVUekM4SG1ySnBrMy9TSi9RT0hiVjRFcGRyRkpuVUM2K3FZbGFkZXlPR0x1OXdDMHpmT01OWFJpTkh4VjUwdmt6a2NjT04yZk1QeS9jcjVveVRLamFNbXBGc2NoWEovTDFrL3VOdU9FRkVvVnBrNnFlU2RoZ2prT1EvNFA0YmlRZ0pIUXQ1bkt2RmlsWHc9PSIsIm1hYyI6Ijk5Y2FkNjQ4NDUyMjhhYTdlOWFkYTc0YzRiMjVlN2Q1M2UxM2U2ZmYyZmRiZTY2ZDJlMzBlYjJhYWJjYjU5ZDIiLCJ0YWciOiIifQ==', '2024-08-11 05:14:15', '2024-08-11 05:13:49', '2024-08-11 05:14:26');

-- --------------------------------------------------------

--
-- Table structure for table `comelate_employees`
--

CREATE TABLE `comelate_employees` (
  `id` bigint UNSIGNED NOT NULL,
  `nik` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `department` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `shift` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alasan_terlambat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_security` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jam` time DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `comelate_employees`
--

INSERT INTO `comelate_employees` (`id`, `nik`, `name`, `department`, `shift`, `alasan_terlambat`, `nama_security`, `tanggal`, `jam`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 23116001, 'Devi Patma Febrianti', 'PROD.1', '', 'Telat Berangkat', 'Artikah', '2024-07-01', '07:09:00', '12', NULL, '2024-06-30 17:00:00', NULL),
(2, 22015466, 'Prasasti Geomarca Angguni Mala', 'QC', '', 'Macet Lalulintas', 'Muhamad Ridwan', '2024-07-01', '08:01:00', '12', NULL, '2024-06-30 17:00:00', NULL),
(3, 19084481, 'Sugih Yanto', 'NPI', '', 'Macet Lalulintas', 'Muhamad Ridwan', '2024-07-02', '08:02:00', '12', NULL, '2024-07-01 17:00:00', NULL),
(4, 14051082, 'Devi Permatasary', 'WH', '', 'Telat Berangkat', 'Muhamad Ridwan', '2024-07-02', '08:55:00', '12', NULL, '2024-07-01 17:00:00', NULL),
(5, 15052831, 'Dian Fadillah', 'WH', '', 'Telat Berangkat', 'Wahyu Anggoro', '2024-07-02', '15:10:00', '12', NULL, '2024-07-01 17:00:00', NULL),
(6, 23116001, 'Wuwuh Susilo Putro', 'PROD.1', '', 'Macet Lalulintas', 'Yustinus', '2024-07-03', '07:01:00', '12', NULL, '2024-07-02 17:00:00', NULL),
(7, 23116001, 'Widodo', 'PROD.1', '', 'Telat Berangkat', 'Yustinus', '2024-07-03', '07:15:00', '12', NULL, '2024-07-02 17:00:00', NULL),
(8, 21075167, 'Ratnasari', 'NPI', '', 'Telat Berangkat', 'Yustinus', '2024-07-03', '18:35:00', '12', NULL, '2024-07-02 17:00:00', NULL),
(9, 22085616, 'Suhanto', 'WH', '', 'Telat Berangkat', 'Andry Lestyo', '2024-07-05', '12:31:00', '12', NULL, '2024-07-04 17:00:00', NULL),
(10, 23035848, 'Ully Nuha', 'WH', '', 'Macet Lalulintas', 'Yustinus', '2024-07-06', '17:58:00', '12', NULL, '2024-07-05 17:00:00', NULL),
(11, 21085211, 'Annisa Nurfitria', 'PROD.1', '', 'Macet Lalulintas', 'Erik Ricko Suprapto', '2024-07-06', '17:50:00', '12', NULL, '2024-07-05 17:00:00', NULL),
(12, 14040795, 'Fany Laelasari', 'NPI', '', 'Keperluan Keluarga', 'Wahyu Anggoro', '2024-07-09', '08:03:00', '12', NULL, '2024-07-08 17:00:00', NULL),
(13, 14111902, 'Fikri Haikal', 'PROD.2', '', 'Telat Berangkat', 'Eneng Imas Tuti', '2024-07-10', '07:30:00', '12', NULL, '2024-07-09 17:00:00', NULL),
(14, 24016019, 'Ratnasari', 'PROD.1', '', 'Telat Berangkat', 'Yustinus', '2024-07-10', '07:02:00', '12', NULL, '2024-07-09 17:00:00', NULL),
(15, 22015466, 'Nia', 'QC', '', 'Macet Lalulintas', 'Yustinus', '2024-07-10', '08:03:00', '12', NULL, '2024-07-09 17:00:00', NULL),
(16, 19064404, 'Nicky Lauda', 'IT', '', 'Telat Berangkat', 'Erik Ricko Suprapto', '2024-07-12', '08:18:00', '12', NULL, '2024-07-11 17:00:00', NULL),
(17, 21095220, 'Dwi Indriyani', 'WH', '', 'Macet Lalulintas', 'Aldi Apriadi', '2024-07-13', '07:02:00', '12', NULL, '2024-07-12 17:00:00', NULL),
(18, 19114618, 'Santi Juniarti', 'WH', '', 'Telat Berangkat', 'Aldi Apriadi', '2024-07-13', '15:45:00', '12', NULL, '2024-07-12 17:00:00', NULL),
(19, 23115993, 'Reva Nurul Pauziah', 'PROD.1', '', 'Keperluan Keluarga', 'Erik Ricko Suprapto', '2024-07-15', '12:40:00', '12', NULL, '2024-07-14 17:00:00', NULL),
(20, 14081599, 'Dimas Ari Seno', 'WH', '', 'Telat Berangkat', 'Erik Ricko Suprapto', '2024-07-15', '08:02:00', '12', NULL, '2024-07-14 17:00:00', NULL),
(21, 12110032, 'Medi Rofik', 'Accounting', '', 'Keperluan Keluarga', 'Muhamad Ridwan', '2024-07-15', '08:53:00', '12', NULL, '2024-07-14 17:00:00', NULL),
(22, 21125431, 'Retno Pujiastuti', 'PPC', '', 'Telat Berangkat', 'Yustinus', '2024-07-15', '15:20:00', '12', NULL, '2024-07-14 17:00:00', NULL),
(23, 19064404, 'Nurwan Fariedh', 'IT', '', 'Telat Berangkat', 'Yustinus', '2024-07-18', '15:20:00', '12', NULL, '2024-07-17 17:00:00', NULL),
(24, 19064404, 'Nurwan Fariedh', 'IT', '', 'Telat Berangkat', 'Wahyu Anggoro', '2024-07-18', '08:35:00', '12', NULL, '2024-07-17 17:00:00', NULL),
(25, 21125398, 'Aulia Dinda Permata', 'QC', '', 'Keperluan Keluarga', 'Yustinus', '2024-07-19', '15:05:00', '12', NULL, '2024-07-18 17:00:00', NULL),
(26, 21125411, 'Mutiara Violita', 'QC', '', 'Telat Berangkat', 'Yustinus', '2024-07-19', '15:55:00', '12', NULL, '2024-07-18 17:00:00', NULL),
(27, 23015785, 'Wildan Prakoso', 'NPI', '', 'Telat Berangkat', 'Wahyu Anggoro', '2024-07-19', '08:04:00', '12', NULL, '2024-07-18 17:00:00', NULL),
(28, 23075907, 'Dimas Ari Seno', 'WH', '', 'Telat Berangkat', 'Muhamad Ridwan', '2024-07-20', '07:17:00', '12', NULL, '2024-07-19 17:00:00', NULL),
(29, 14111902, 'Inatsa Latvia', 'PROD.2', '', 'Telat Berangkat', 'Yustinus', '2024-07-22', '07:17:00', '12', NULL, '2024-07-21 17:00:00', NULL),
(30, 15042671, 'Binu Hartoko', 'NPI', '', 'Telat Berangkat', 'Wahyu Anggoro', '2024-07-23', '08:21:00', '12', NULL, '2024-07-22 17:00:00', NULL),
(31, 21115296, 'Daniswara Prayitno', 'PPC', '', 'Telat Berangkat', 'Yustinus', '2024-07-24', '08:43:00', '12', NULL, '2024-07-23 17:00:00', NULL),
(32, 22085623, 'Iqbal Mirza', 'PROD.2', '', 'Macet Lalulintas', 'Andry Lestyo', '2024-07-25', '08:10:00', '12', NULL, '2024-07-24 17:00:00', NULL),
(33, 19084481, 'Irma Hermawati', 'NPI', '', 'Telat Berangkat', 'Eneng Imas Tuti', '2024-07-25', '08:01:00', '12', NULL, '2024-07-24 17:00:00', NULL),
(34, 15022496, 'Nicky Lauda', 'PROD.1', '', 'Macet Lalulintas', 'Muhamad Ridwan', '2024-07-25', '08:25:00', '12', NULL, '2024-07-24 17:00:00', NULL),
(35, 23075907, 'Dimas Ari Seno', 'WH', '', 'Telat Berangkat', 'Andry Lestyo', '2024-07-26', '07:17:00', '12', NULL, '2024-07-25 17:00:00', NULL),
(36, 14111902, 'Novalina Purba', 'PROD.2', '', 'Telat Berangkat', 'Erik Ricko Suprapto', '2024-07-27', '07:17:00', '12', NULL, '2024-07-26 17:00:00', NULL),
(37, 21115296, 'Daniswara Prayitno', 'PPC', '', 'Telat Berangkat', 'Yustinus', '2024-07-29', '08:43:00', '12', NULL, '2024-07-28 17:00:00', NULL),
(38, 22085623, 'Iqbal Mirza', 'PROD.2', '', 'Macet Lalulintas', 'Andry Lestyo', '2024-07-31', '08:10:00', '12', NULL, '2024-07-30 17:00:00', NULL),
(39, 19084481, 'Irma Hermawati', 'NPI', '', 'Telat Berangkat', 'Yustinus', '2024-07-31', '08:01:00', '12', NULL, '2024-07-30 17:00:00', NULL),
(40, 15022496, 'Nicky Lauda', 'PROD.1', '', 'Macet Lalulintas', 'Yustinus', '2024-07-31', '08:25:00', '12', NULL, '2024-07-30 17:00:00', NULL),
(41, 18080019, 'Siti Kuraesin', 'SI', '', 'Keperluan Keluarga', 'Aldi Apriadi', '2024-08-01', '08:57:53', '12', NULL, '2024-08-07 18:29:06', '2024-08-07 18:29:06'),
(42, 21125432, 'Indra Dwi Yanto', 'WH', '', 'Macet Lalulintas', 'Aldi Apriadi', '2024-08-03', '07:12:30', '12', NULL, '2024-08-07 18:30:44', '2024-08-07 18:30:44'),
(43, 14061182, 'Jupentinus Y', 'WH', '', 'Telat Berangkat', 'Aldi Apriadi', '2024-08-03', '07:23:00', '12', NULL, '2024-08-07 18:38:32', '2024-08-07 18:38:32'),
(44, 23075914, 'Nurul Aprilia', 'QC', '', 'Telat Berangkat', 'Yustinus', '2024-08-03', '12:31:00', '12', NULL, '2024-08-07 18:39:19', '2024-08-07 18:39:19'),
(45, 15052831, 'Solihin', 'WH', '', 'Keperluan Keluarga', 'Yustinus', '2024-08-03', '18:00:00', '12', NULL, '2024-08-07 18:42:15', '2024-08-07 18:42:15'),
(46, 21055058, 'Reza Maulana', 'PROD.2', '', 'Macet Lalulintas', 'Yustinus', '2024-08-05', '07:04:00', '12', NULL, '2024-08-07 18:43:11', '2024-08-07 18:43:11'),
(47, 13070569, 'Akhmad Fauzi', 'Admin', '', 'Macet Lalulintas', 'Artikah', '2024-08-05', '08:02:00', '12', NULL, '2024-08-07 18:44:01', '2024-08-07 18:44:01'),
(48, 20014730, 'Syarif Chandra Kurniawan', 'FG', '', 'Cuti Setengah Hari', 'Yustinus', '2024-08-08', '10:03:00', '12', NULL, '2024-08-07 20:39:12', '2024-08-07 20:39:12'),
(49, 22085623, 'Iqbal Mirza', 'Production', '', 'Macet Lalu lintas', 'Andri Lestyo', '2024-08-09', '08:06:00', '17', '17', '2024-08-08 18:11:21', '2024-08-08 18:11:54'),
(50, 24016036, 'Nofan Agung Hp', 'IT', '', 'Macet Lalu lintas', 'Yustinus', '2024-08-09', '08:15:00', '17', '17', '2024-08-08 18:16:47', '2024-08-08 18:17:21'),
(51, 13010064, 'Renny kumala', 'Production', '', 'Cuti Setengah Hari', 'Yustinus', '2024-08-09', '11:50:00', '17', NULL, '2024-08-08 21:52:07', '2024-08-08 21:52:07'),
(52, 22125741, 'Fajar Maulana', 'Prod 2', '', 'Telat berangkat', 'Wahyu Anggoro', '2024-08-09', '15:15:00', '17', '17', '2024-08-09 01:20:36', '2024-08-09 01:21:05'),
(53, 21125432, 'Indra Dwi yanto', 'FG', '', 'Cuti Setengah Hari', 'Yustinus', '2024-08-09', '18:50:00', '17', NULL, '2024-08-09 05:30:34', '2024-08-09 05:30:34'),
(54, 23105983, 'zhiva fazrian ilhami', 'PROD.2', '', 'Keperluan keluarga', 'artikah', '2024-08-10', '13:10:00', '17', '12', '2024-08-09 23:15:31', '2024-08-13 19:58:31'),
(55, 22125758, 'M. Nursaiful Anwar', 'IT', 'Shift 2', 'Cuti Setengah Hari', 'Aldi', '2024-08-13', '17:09:00', '17', '12', '2024-08-13 03:15:58', '2024-08-13 22:00:10'),
(56, 19104601, 'ully nuha', 'PROD.2', 'Shift 1', 'Telat berangkat', 'Aldy apriadi', '2024-08-14', '07:40:00', '17', '12', '2024-08-13 17:43:43', '2024-08-13 21:59:49'),
(57, 12110032, 'Ratnasari', 'Accounting', 'Non Shift', 'Cuti Setengah Hari', 'Husen', '2024-08-14', '09:10:00', '17', '17', '2024-08-13 19:13:20', '2024-08-13 20:20:22'),
(59, 23015785, 'Wildan Prakoso', 'NPI', 'Non Shift', 'Telat Berangkat', 'Andri Lestyo', '2024-08-15', '08:03:00', '17', NULL, '2024-08-14 18:06:37', '2024-08-14 18:06:37'),
(60, 21085174, 'Ismail', 'PROD.1', 'Non Shift', 'Cuti Setengah Hari', 'Yustinus', '2024-08-15', '11:38:00', '17', NULL, '2024-08-14 21:41:38', '2024-08-14 21:41:38'),
(61, 14040795, 'Aris Fariastanto Adi Purnomo', 'NPI', 'Non Shift', 'Macet Lalulintas', 'Andri Lestyo', '2024-08-16', '08:01:00', '17', NULL, '2024-08-15 18:09:11', '2024-08-15 18:09:11'),
(62, 21065084, 'Retno Pujiastuti', 'PROD.1', 'Non Shift', 'Macet Lalulintas', 'Andri Lestyo', '2024-08-16', '08:01:00', '17', NULL, '2024-08-15 18:09:48', '2024-08-15 18:09:48'),
(63, 15042671, 'Binu Hartoko', 'PROD.2', 'Non Shift', 'Macet Lalulintas', 'Andri Lestyo', '2024-08-16', '08:01:00', '17', NULL, '2024-08-15 18:10:20', '2024-08-15 18:10:20'),
(64, 20014730, 'Syarif Chandra Kurniawan', 'FG', 'Shift 2', 'Keperluan Pribadi', 'Wahyu Anggoro', '2024-08-16', '15:25:00', '17', NULL, '2024-08-16 02:44:06', '2024-08-16 02:44:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `lang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `custom_fields` json DEFAULT NULL,
  `avatar_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nik` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `theme` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'default',
  `theme_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'USER'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `created_at`, `updated_at`, `lang`, `custom_fields`, `avatar_url`, `nik`, `theme`, `theme_color`, `role`) VALUES
(12, 'Tri Julia Agustin', 'admin@gmail.com', NULL, '$2y$12$VJNz7tcdfAZh08CBEr7bKOuixxJ9mxUUOvdRXgzfrcRLPCcD9c/4G', NULL, NULL, NULL, 'lOQ2wlUBT1rcCf86okpuMBvJrT0z3JgRS9VhJIfIfasHTtXQFxt8Xy77vseg', '2024-08-06 01:27:25', '2024-08-07 21:52:28', 'en', NULL, NULL, '14051073', 'default', NULL, 'ADMINHR'),
(13, 'Pratama Handika Rudiyanta', NULL, NULL, '$2y$10$Fhd75Nh.CXXzVVxcHlMgZ.2TxMCEW7nQyg7jKRwXYIn6d0KWsfUqu', NULL, NULL, NULL, NULL, '2024-08-06 18:41:17', '2024-08-13 02:02:38', 'en', NULL, NULL, '23105984', 'default', NULL, 'USER'),
(14, 'Renata Arthaully Christania Siagian', NULL, NULL, '$2y$10$gTWoIf6dwfgkrj22Q.k8m.5tqzesSAdLGOiOCLYc5cU2d4tWfnyLq', NULL, NULL, NULL, 'AfVRs9hXMsYfF84e8LyKpYZsSdBY8PgdPRAv4en2wC74NOYOo9g4XJs5dqe0', '2024-08-06 21:49:30', '2024-08-11 19:14:52', 'en', NULL, NULL, '23035833', 'default', NULL, 'ADMINGA'),
(15, 'Oki Lesmana', NULL, NULL, '$2y$10$T.rZoDlu3CKJziUv51MEhe98zG64TKHVYiGqD/3RgzVfYqt5D.Jeu', NULL, NULL, NULL, NULL, '2024-08-06 22:25:39', '2024-08-11 19:15:08', 'en', NULL, NULL, '22105657', 'default', NULL, 'ADMINUTILITY'),
(16, 'Heru Agus Kurniawanto', NULL, NULL, '$2y$10$7Y2VnqQwEm0kfswH4I7abeBXKPf24SnvJjWMpEWws/rYaQTRpidF6', NULL, NULL, NULL, NULL, '2024-08-06 22:26:34', '2024-08-11 19:15:31', 'en', NULL, NULL, '20034748', 'default', NULL, 'ADMINUTILITY'),
(17, 'Wahyu', NULL, NULL, '$2y$10$cDJdqpnb5XM0IqFC.jznyONTc1A4lqTiziQqbCnmfgx061w4l8RoW', NULL, NULL, NULL, NULL, '2024-08-07 20:45:20', '2024-08-11 21:45:08', 'en', NULL, NULL, '20230062', 'default', NULL, 'SECURITY'),
(20, 'Oki Lesmana', NULL, NULL, '$2y$10$Hdug6KZ8v5j3JwWlReIvZuv5p96z8bLK9gj/bgMpr.N98a2ee3e/u', NULL, NULL, NULL, NULL, '2024-08-11 01:13:12', '2024-08-11 18:24:19', 'en', NULL, NULL, '22105657', 'default', NULL, 'ADMINUTILITY'),
(24, 'Widi Fajar Satritama', NULL, NULL, '$2y$10$nL8F9fdGk9fs8wvIeZnHVePBXD5VHTwsozcER9.0rUwQPq3vZp7Ou', NULL, NULL, NULL, NULL, '2024-08-11 18:10:24', '2024-08-12 23:07:00', 'en', NULL, NULL, '22095652', 'default', NULL, 'SUPERADMIN'),
(25, 'Super Admin', NULL, NULL, '$2y$10$p09ZYp3eyZA3/H9qrtQpd.uW.8wliqVjPBMjGOf9t8hdxu3UsRhZa', NULL, NULL, NULL, NULL, '2024-08-11 18:24:50', '2024-08-11 18:24:50', 'en', NULL, NULL, '00', 'default', NULL, 'SUPERADMIN'),
(26, 'Dwiki Arief Wicaksana', NULL, NULL, '$2y$10$y42HLQNC1wslIN8e7dbXYOSPaOUS09FEpQfip/AOeKE2coYQgLYy6', NULL, NULL, NULL, NULL, '2024-08-12 02:05:50', '2024-08-12 02:05:50', 'en', NULL, NULL, '23045859', 'default', NULL, 'USER'),
(27, 'Ananda Fauziah', NULL, NULL, '$2y$10$ou91SZvSO8XarKuh.0ZQg.2mdKpl1wwlH1iFiVgjZqJ91.VyTmzDi', NULL, NULL, NULL, NULL, '2024-08-12 20:12:32', '2024-08-13 01:07:11', 'en', NULL, NULL, '24000152', 'default', NULL, 'ADMINGA'),
(28, 'Dwi Kurniati', NULL, NULL, '$2y$10$MReSOvhFTE558tIPavMXKuQEdybfCgwEuBxuCwaYqGOz2bv1JZOFG', NULL, NULL, NULL, NULL, '2024-08-13 01:51:50', '2024-08-13 01:51:50', 'en', NULL, NULL, '18104196', 'default', NULL, 'ADMINGA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `breezy_sessions`
--
ALTER TABLE `breezy_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `breezy_sessions_authenticatable_type_authenticatable_id_index` (`authenticatable_type`,`authenticatable_id`);

--
-- Indexes for table `comelate_employees`
--
ALTER TABLE `comelate_employees`
  ADD PRIMARY KEY (`id`) USING BTREE;

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
-- AUTO_INCREMENT for table `breezy_sessions`
--
ALTER TABLE `breezy_sessions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comelate_employees`
--
ALTER TABLE `comelate_employees`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
