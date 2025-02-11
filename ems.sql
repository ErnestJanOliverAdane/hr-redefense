-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2025 at 02:44 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ems`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_employee`
--

CREATE TABLE `add_employee` (
  `employee_id` int(11) NOT NULL,
  `emp_first_name` varchar(255) NOT NULL,
  `emp_last_name` varchar(255) NOT NULL,
  `emp_email` varchar(255) NOT NULL,
  `emp_phone_number` varchar(20) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `add_employee`
--

INSERT INTO `add_employee` (`employee_id`, `emp_first_name`, `emp_last_name`, `emp_email`, `emp_phone_number`, `department_id`, `created_at`, `updated_at`, `role`) VALUES
(9, 'pabs', 'test', 'pabs@gmail.com', '23232', 3, '2024-10-28 20:46:45', '2024-11-20 05:16:21', 'staff'),
(10, ' sherwin', 'aleonar', 'sherwin@gmail.com', '23232', 10, '2024-10-28 20:47:39', '2024-10-28 20:47:39', 'staff'),
(11, 'sherwin', 'aleonar', 'test@gmail.com', '00999', 8, '2024-10-28 12:54:24', '2024-10-28 12:54:24', 'faculty'),
(12, 'sherwin', 'aleonar', 'sherwin3@gmail.com', '0992992', 7, '2024-10-28 13:01:53', '2024-10-28 13:01:53', 'faculty'),
(13, 'sherwin', 'aleonar2', 'crim@gmail.com', '0992992', 16, '2024-10-28 13:02:57', '2024-10-28 13:02:57', 'staff'),
(14, 'test', 'sherwina', 'hm@gmail.com', '00999', 7, '2024-10-28 13:12:26', '2024-10-28 13:12:26', 'faculty'),
(15, 'aernest', 'babano', 'sad@gma', '00999', 14, '2024-10-28 20:09:51', '2024-10-28 20:09:51', 'staff');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `usertype` varchar(255) NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('c525a5357e97fef8d3db25841c86da1a', 'i:1;', 1736206126),
('c525a5357e97fef8d3db25841c86da1a:timer', 'i:1736206126;', 1736206126);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `children`
--

CREATE TABLE `children` (
  `id` int(11) NOT NULL,
  `personal_information_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `children`
--

INSERT INTO `children` (`id`, `personal_information_id`, `name`, `date_of_birth`, `created_at`, `updated_at`) VALUES
(94, 81, 'Enilk', '2011-01-01', '2025-01-06 06:03:03', '2025-01-06 06:03:03'),
(95, 81, 'Aicrag', '2014-06-01', '2025-01-06 06:03:03', '2025-01-06 06:03:03');

-- --------------------------------------------------------

--
-- Table structure for table `civil_service_eligibilities`
--

CREATE TABLE `civil_service_eligibilities` (
  `id` int(11) NOT NULL,
  `personal_information_id` int(11) NOT NULL,
  `eligibility` varchar(255) DEFAULT NULL,
  `rating` varchar(50) DEFAULT NULL,
  `exam_date` date DEFAULT NULL,
  `exam_place` varchar(255) DEFAULT NULL,
  `license_number` varchar(50) DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `civil_service_eligibilities`
--

INSERT INTO `civil_service_eligibilities` (`id`, `personal_information_id`, `eligibility`, `rating`, `exam_date`, `exam_place`, `license_number`, `release_date`, `created_at`, `updated_at`) VALUES
(89, 81, 'Board Passer', 'G', '2025-01-06', 'secret', '010010', '2026-01-06', '2025-01-06 06:03:03', '2025-01-06 06:03:03');

-- --------------------------------------------------------

--
-- Table structure for table `contructual`
--

CREATE TABLE `contructual` (
  `id` int(20) NOT NULL,
  `masterlist_id` int(20) NOT NULL,
  `date` date NOT NULL,
  `sex` enum('male','female') NOT NULL,
  `eligibility` varchar(255) NOT NULL,
  `workstatus` varchar(255) NOT NULL,
  `yearsofservice` varchar(255) DEFAULT NULL,
  `natureofwork` varchar(255) NOT NULL,
  `specificnatureofwork` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contructual`
--

INSERT INTO `contructual` (`id`, `masterlist_id`, `date`, `sex`, `eligibility`, `workstatus`, `yearsofservice`, `natureofwork`, `specificnatureofwork`, `created_at`, `updated_at`) VALUES
(4, 321, '2024-12-19', 'female', '2nd level', 'Contractual', '10', 'Trades and crafts/laborer', 'test', '2024-12-18 09:58:31', '2024-12-18 09:58:31'),
(5, 321, '2024-12-11', 'female', '3rd level', 'Contractual', '2', 'Teaching services', 'test', '2024-12-18 09:59:44', '2024-12-18 09:59:44'),
(6, 321, '2024-12-12', 'male', '1st level', 'Contractual', NULL, 'Health and allied services', 'test22', '2024-12-19 13:11:52', '2024-12-19 13:11:52');

-- --------------------------------------------------------

--
-- Table structure for table `cos`
--

CREATE TABLE `cos` (
  `id` int(20) NOT NULL,
  `masterlist_id` int(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `sex` enum('male','female') NOT NULL,
  `eligibility` varchar(255) NOT NULL,
  `workstatus` varchar(255) NOT NULL,
  `yearsofservice` varchar(255) DEFAULT NULL,
  `natureofwork` varchar(255) NOT NULL,
  `specificnatureofwork` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cos`
--

INSERT INTO `cos` (`id`, `masterlist_id`, `date`, `sex`, `eligibility`, `workstatus`, `yearsofservice`, `natureofwork`, `specificnatureofwork`, `created_at`, `updated_at`) VALUES
(6, 321, '2024-12-18 16:00:00', 'female', '2nd level', 'Contract of Service', NULL, 'Health and allied services', 'testw', '2024-12-19 13:22:37', '2024-12-19 13:22:37');

-- --------------------------------------------------------

--
-- Table structure for table `educational_backgrounds`
--

CREATE TABLE `educational_backgrounds` (
  `id` int(11) NOT NULL,
  `personal_information_id` int(11) NOT NULL,
  `level` enum('Elementary','Secondary','Vocational','College','Graduate') DEFAULT NULL,
  `school_name` varchar(255) DEFAULT NULL,
  `degree_course` varchar(255) DEFAULT NULL,
  `period_from` year(4) DEFAULT NULL,
  `period_to` year(4) DEFAULT NULL,
  `highest_level_earned` varchar(255) DEFAULT NULL,
  `year_graduated` year(4) DEFAULT NULL,
  `academic_honors` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `educational_backgrounds`
--

INSERT INTO `educational_backgrounds` (`id`, `personal_information_id`, `level`, `school_name`, `degree_course`, `period_from`, `period_to`, `highest_level_earned`, `year_graduated`, `academic_honors`, `created_at`, `updated_at`) VALUES
(353, 81, 'Elementary', 'BUCES', 'wabalo', '2004', '2010', '20', '2010', 'way honors', '2025-01-06 06:03:03', '2025-01-06 06:03:03'),
(354, 81, 'Secondary', 'HCA', 'wabalo', '2010', '2016', '40', '2016', 'di honors', '2025-01-06 06:03:03', '2025-01-06 06:03:03');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `family_backgrounds`
--

CREATE TABLE `family_backgrounds` (
  `id` int(11) NOT NULL,
  `personal_information_id` int(11) NOT NULL,
  `spouse_surname` varchar(100) DEFAULT NULL,
  `spouse_first_name` varchar(100) DEFAULT NULL,
  `spouse_middle_name` varchar(100) DEFAULT NULL,
  `spouse_name_extension` varchar(10) DEFAULT NULL,
  `spouse_occupation` varchar(255) DEFAULT NULL,
  `spouse_employer` varchar(255) DEFAULT NULL,
  `spouse_business_address` text DEFAULT NULL,
  `spouse_telephone` varchar(50) DEFAULT NULL,
  `father_surname` varchar(100) DEFAULT NULL,
  `father_first_name` varchar(100) DEFAULT NULL,
  `father_middle_name` varchar(100) DEFAULT NULL,
  `father_name_extension` varchar(10) DEFAULT NULL,
  `mother_surname` varchar(100) DEFAULT NULL,
  `mother_first_name` varchar(100) DEFAULT NULL,
  `mother_middle_name` varchar(100) DEFAULT NULL,
  `mother_maiden_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `family_backgrounds`
--

INSERT INTO `family_backgrounds` (`id`, `personal_information_id`, `spouse_surname`, `spouse_first_name`, `spouse_middle_name`, `spouse_name_extension`, `spouse_occupation`, `spouse_employer`, `spouse_business_address`, `spouse_telephone`, `father_surname`, `father_first_name`, `father_middle_name`, `father_name_extension`, `mother_surname`, `mother_first_name`, `mother_middle_name`, `mother_maiden_name`, `created_at`, `updated_at`) VALUES
(104, 81, 'Garcia', 'Kline', 'P', NULL, 'Programmer', 'Hams Incorporated', 'Sugbongcogon, Purok 2 Lucaban Compund', '09958150483', 'Bohawe', 'Elden', 'T', NULL, 'Avenido', 'Lutay', 'P', 'Mebrano', '2025-01-06 04:07:14', '2025-01-06 05:04:20');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(10) NOT NULL,
  `masterlist_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `size` bigint(20) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `masterlist_id`, `name`, `path`, `size`, `type`, `created_at`, `updated_at`) VALUES
(7, 329, 'ordinance.jpg', 'uploads/1734536962_ordinance.jpg', 333091, 'image/jpeg', '2024-12-19 23:04:51', '2024-12-18 07:49:22'),
(8, 321, 'ordinance.jpg', 'uploads/1734540366_ordinance.jpg', 333091, 'image/jpeg', '2024-12-18 08:46:06', '2024-12-18 08:46:06'),
(9, 322, 'Screenshot 2024-11-27 121649.png', 'uploads/1735861589_Screenshot 2024-11-27 121649.png', 79121, 'image/png', '2025-01-02 15:46:29', '2025-01-02 15:46:29'),
(10, 321, 'back_id.jpg', 'uploads/1736092035_back_id.jpg', 95560, 'image/jpeg', '2025-01-05 07:47:17', '2025-01-05 07:47:17'),
(11, 343, 'TCC HR ADMIN.pdf', 'uploads/1736125264_TCC HR ADMIN.pdf', 19071, 'application/pdf', '2025-01-05 17:01:05', '2025-01-05 17:01:05');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `learning_developments`
--

CREATE TABLE `learning_developments` (
  `id` int(11) NOT NULL,
  `personal_information_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `hours` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `conducted_by` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `learning_developments`
--

INSERT INTO `learning_developments` (`id`, `personal_information_id`, `title`, `from_date`, `to_date`, `hours`, `type`, `conducted_by`, `created_at`, `updated_at`) VALUES
(20, 81, 'TESDA', '2024-01-01', '2025-01-01', 3000, 'DL', 'Kuya Wil', '2025-01-06 06:03:03', '2025-01-06 06:03:03');

-- --------------------------------------------------------

--
-- Table structure for table `masterlist`
--

CREATE TABLE `masterlist` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL COMMENT '\r\n',
  `first_name` varchar(100) NOT NULL,
  `middle_initial` char(10) DEFAULT NULL,
  `contact_information` varchar(50) NOT NULL,
  `employment_status` enum('Job Order','Permanent','Contract of Service','Casual','Moa','Contractual') NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `job_type` enum('faculty','Staff') NOT NULL,
  `rank` varchar(255) DEFAULT NULL,
  `qualification` varchar(255) DEFAULT NULL,
  `field` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `plain_password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `masterlist`
--

INSERT INTO `masterlist` (`id`, `employee_id`, `full_name`, `last_name`, `first_name`, `middle_initial`, `contact_information`, `employment_status`, `job_title`, `department`, `job_type`, `rank`, `qualification`, `field`, `password`, `plain_password`, `created_at`, `updated_at`, `date`) VALUES
(321, 'S202412001', 'Shenna Faye C. Acuzar', 'Acuzar', 'Shenna Faye', 'C', 'shennafaye@gmail.com', 'Permanent', 'Staff', 'College of Information Technology', 'Staff', NULL, NULL, NULL, '$2y$12$LAklJPK.nKd1xb9T.ncSY.Ji5JxjEo.5o9rxcc83r6T64/vE9051W', 'Acuzar1216', '2024-12-15 17:36:03', '2024-12-18 14:18:07', NULL),
(322, 'F202412001', 'Ernest A. Adane', 'Adane', 'Ernest', 'A', 'Ernest12311@gmail.com', 'Moa', 'Driver', 'College of Engineering Technology', 'faculty', 'Assistant Professor II', 'NCII', '18', '$2y$12$OjRrhsnjpGhnip53O8jLGuX9NFS7tINFrApTqL4GqP9EGqu6wB90e', 'Adane1216', '2024-12-15 18:08:19', '2025-01-05 17:43:17', NULL),
(323, 'F2024120022', 'Juan Z. Dela Cruz', 'Dela Cruz', 'Juan', 'Z', 'tes1t@gmail.com', 'Job Order', 'Maintenance', 'Engineering', 'faculty', NULL, NULL, NULL, NULL, NULL, '2024-12-19 12:46:20', '2024-12-19 12:46:20', NULL),
(324, 'F202412005', 'Rosa H. Torres', 'Torres', 'Rosa', 'H', 'tes1t@gmail.com', 'Permanent', 'Office Staff', 'Engineering', 'faculty', NULL, NULL, NULL, NULL, NULL, '2024-12-19 12:46:20', '2025-01-04 03:52:46', NULL),
(325, 'F202412006', 'Carlos X. Morales', 'Morales', 'Carlos', 'X', 'tes1t@gmail.com', 'Job Order', 'Instructor', 'Transport', 'Staff', NULL, NULL, NULL, NULL, NULL, '2024-12-19 12:46:20', '2024-12-19 12:46:20', NULL),
(326, 'F202412007', 'Pedro R. Gutierrez', 'Gutierrez', 'Pedro', 'R', 'tes1t@gmail.com', 'Permanent', 'Architect', 'Education', 'Staff', NULL, NULL, NULL, NULL, NULL, '2024-12-19 12:46:20', '2024-12-19 12:46:20', NULL),
(327, 'F202412008', 'Maria W. Rivera', 'Rivera', 'Maria', 'W', 'tes1t@gmail.com', 'Job Order', 'Librarian', 'Administration', 'Staff', NULL, NULL, NULL, NULL, NULL, '2024-12-19 12:46:20', '2024-12-19 12:46:20', NULL),
(328, 'F202412009', 'Ramon O. Santos', 'Santos', 'Ramon', 'O', 'tes1t@gmail.com', 'Job Order', 'Architect', 'Security', 'Staff', NULL, NULL, NULL, NULL, NULL, '2024-12-19 12:46:20', '2024-12-19 12:46:20', NULL),
(329, 'F202412010', 'Carmen M. Dela Cruz', 'Dela Cruz', 'Carmen', 'M', 'tes1t@gmail.com', 'Permanent', 'Utility', 'Education', 'Staff', NULL, NULL, NULL, NULL, NULL, '2024-12-19 12:46:20', '2024-12-19 12:46:20', NULL),
(330, 'F202412011', 'Sherwin P. Aleonar', 'Aleonar', 'Sherwin', 'P', 'sherwin@gmail.com', 'Permanent', 'Manager', 'College of Arts and Science', 'faculty', NULL, NULL, NULL, '$2y$12$Tlsc7Oco7N1WMlcyLpt0FuTURpYQCEBGqiwwOMuKY2ZGmTQovGVoq', 'Aleonar1227', '2024-12-27 06:38:25', '2024-12-27 06:38:25', NULL),
(331, 'F202412012', 'Sherwin Victor P. Aleonar', 'Aleonar', 'Sherwin Victor', 'Pablo', 'sherwin1@gmail.com', 'Job Order', 'Manager', 'College of Education', 'faculty', NULL, NULL, NULL, '$2y$12$qsVdQiT9zhWRbXNZGu21IeL.WMIuppk8qsOhG9O4eBTG8VU0fN9DS', 'Aleonar1227', '2024-12-27 06:42:04', '2024-12-29 05:27:24', NULL),
(332, 'F202501001', 'Test P. Aleonar', 'Aleonar', 'Test', 'P', 'testA@gmail.com', 'Contract of Service', 'Manager', 'College of Information Technology', 'faculty', NULL, NULL, NULL, '$2y$12$tytyii6WZOpxiAABbOFeN.mMenbYFM0xE3CFjIU62wmn5DU7NkNKS', 'Aleonar0102', '2025-01-02 02:32:48', '2025-01-02 02:32:48', NULL),
(333, 'F202501002', 'John Rey P. Pabualaan', 'Pabualaan', 'John Rey', 'P', 'Pabualan.johnrey@gmail.com', 'Contractual', 'It', 'College of Information Technology', 'faculty', NULL, NULL, NULL, '$2y$12$DsE.nYE0ff/8Rlmvnhq4V.904zevZicY.1XWhb2RD1RL4TpqhMuEu', 'Pabualaan0103', '2025-01-02 16:24:34', '2025-01-02 16:24:34', NULL),
(334, 'F202501003', 'Kline P. Garcia', 'Garcia', 'Kline', 'P', 'garcia@gmail.com', 'Casual', 'Instructor', 'College of Information Technology', 'faculty', NULL, NULL, NULL, '$2y$12$IFYlL.wIZ6ltoPpUp1nVR.vlUDz.59p6CpqHFsmzbi.rSDGJ.gZWq', 'Garcia0105', '2025-01-04 21:05:12', '2025-01-04 21:05:12', NULL),
(335, 'F202501004', 'Albert P. Serato', 'Serato', 'Albert', 'P', 'serato@gmail.com', 'Casual', 'Instructor', 'College of Information Technology', 'faculty', 'Instructor I', '1', '1', '$2y$12$kxdG4PBJcLGBPGn3x0FC3O24wkRwAalKqP0W.h5y56uIoquDp5cFe', 'Serato0105', '2025-01-04 21:26:26', '2025-01-05 15:15:48', NULL),
(336, 'S202501001', 'Shenny P. Fuentes', 'Fuentes', 'Shenny', 'P', 'shenny@gmail.com', 'Contractual', 'Instructor', 'College of Information Technology', 'Staff', NULL, NULL, NULL, '$2y$12$jMVhtTv9jRxEYsgFzLZbSeg7ETemDjk8WPOSF7BkUaBISNpFuYJ5e', 'Fuentes0105', '2025-01-04 21:27:38', '2025-01-04 21:27:38', NULL),
(337, 'F202501005', 'Elden P. Bohawe', 'Bohawe', 'Elden', 'P', 'bohawe@gmail.com', 'Moa', 'Instructor', 'College of Information Technology', 'faculty', NULL, NULL, NULL, '$2y$12$jb8N12ABJj5U3tiKq5zy6OZS095kqNUZI/eISx6LhM7h2qJMfNKt6', 'Bohawe0105', '2025-01-04 21:29:18', '2025-01-04 21:29:18', NULL),
(338, 'S202501002', 'Alden P. Richards', 'Richards', 'Alden', 'P', 'richards@gmail.com', 'Contract of Service', 'Instructor', 'College of Criminal Justice & Public Safety', 'Staff', NULL, NULL, NULL, '$2y$12$JwqIZB9m/5CnL0pTDlTeXeyBy0A7.UuKpMw7IsM4A/sBCshc.7XaG', 'Richards0105', '2025-01-04 21:29:48', '2025-01-04 21:29:48', NULL),
(339, 'S202501003', 'Rodrigo P. Duterte', 'Duterte', 'Rodrigo', 'P', 'dds@gmail.com', 'Job Order', 'Instructor', 'College of Library Information Science', 'Staff', NULL, NULL, NULL, '$2y$12$mpYNaSyCrsUEDAFqssyqeuCcGSCsiDr3WisMCBMoYn0/6m4taSLbS', 'Duterte0105', '2025-01-04 21:30:21', '2025-01-04 21:30:21', NULL),
(340, 'F202501006', 'Armalyn P. Compas', 'Compas', 'Armalyn', 'P', 'armalyn@gmail.com', 'Job Order', 'Instructor', 'College of Information Technology', 'faculty', 'Instructor II', '2', '2', '$2y$12$UDeNrziMzM/SWI10sOvFeucLQ53relhb3XyXm30YKeXIuXXaX3sqi', 'Compas0105', '2025-01-05 04:25:16', '2025-01-05 05:11:31', NULL),
(341, 'F202501007', 'Jonathan P. Babano', 'Babano', 'Jonathan', 'P', 'babano@gmail.com', 'Job Order', 'Instructor', 'College of Information Technology', 'faculty', 'Instructor II', '2', '2', '$2y$12$9uRGjfZ90Z5AGxD8sJ6AB.w6AR6EehsvdtgAqou9PW4k.4/Wzmcqi', 'Babano0105', '2025-01-05 05:10:33', '2025-01-05 07:39:24', NULL),
(342, 'S202501004', 'Ambot A. Ambot', 'Ambot', 'Ambot', 'A', 'ambot@gmail.com', 'Job Order', 'Ambot', 'College of Information Technology', 'Staff', NULL, NULL, NULL, '$2y$12$sbqJy0X8Mpc6dFCzujBa.uqHc5HPPS8..t2KSvo6/NmgOEB0EJ.yy', 'Ambot0105', '2025-01-05 05:12:28', '2025-01-05 05:12:28', NULL),
(343, 'F202501008', 'Kenneth P. Pabualan', 'Pabualan', 'Kenneth', 'P', 'Kenneth@gmail.com', 'Contract of Service', 'Instructor', 'College of Information Technology', 'faculty', NULL, NULL, NULL, '$2y$12$XQ5Plxm6Zj4X1xc1TCz8xeg5Sb.qNhD8Seu2oKphqbH3IubiIQXAe', 'Pabualan0106', '2025-01-05 16:59:01', '2025-01-05 16:59:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_10_21_065349_add_two_factor_columns_to_users_table', 1),
(5, '2024_10_21_065441_create_personal_access_tokens_table', 1),
(6, '2024_10_11_113404_create_personal_information_table', 2),
(7, '2024_10_11_115434_create_parent_information_table', 2),
(8, '2024_10_11_115720_create_children_information_table', 2),
(9, '2024_10_11_115818_create_education_background_table', 2),
(10, '2024_10_11_115936_create_civil_service_eligibility_table', 2),
(11, '2024_10_11_120058_create_work_experience_table', 2),
(12, '2024_10_11_120227_create_voluntary_work_table', 2),
(13, '2024_10_11_122116_create_other_information_table', 2),
(14, '2024_10_11_122155_create_spouse_information_table', 2),
(15, '2024_10_11_122257_create_training_programs_attended_table', 2),
(16, '2024_12_11_074753_create_admins_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `other_information`
--

CREATE TABLE `other_information` (
  `id` int(11) NOT NULL,
  `personal_information_id` int(11) DEFAULT NULL,
  `special_skills` text DEFAULT NULL,
  `distinctions` text DEFAULT NULL,
  `membership` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `other_information`
--

INSERT INTO `other_information` (`id`, `personal_information_id`, `special_skills`, `distinctions`, `membership`, `created_at`, `updated_at`) VALUES
(36, 81, 'Kaon tae', 'Kaon bilat', 'R-U-N', '2025-01-06 06:03:03', '2025-01-06 06:03:03'),
(37, 81, 'kaon bilat', 'kaon tae', 'r-u-n', '2025-01-06 06:03:03', '2025-01-06 06:03:03');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_informations`
--

CREATE TABLE `personal_informations` (
  `personal_information_id` int(11) NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `name_extension` varchar(10) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `place_of_birth` varchar(255) DEFAULT NULL,
  `sex` enum('Male','Female') DEFAULT NULL,
  `civil_status` enum('Single','Married','Widowed','Separated') DEFAULT NULL,
  `height` decimal(5,2) DEFAULT NULL,
  `weight` decimal(5,2) DEFAULT NULL,
  `blood_type` varchar(5) DEFAULT NULL,
  `gsis_no` varchar(50) DEFAULT NULL,
  `pagibig_no` varchar(50) DEFAULT NULL,
  `philhealth_no` varchar(50) DEFAULT NULL,
  `sss_no` varchar(50) DEFAULT NULL,
  `tin_no` varchar(50) DEFAULT NULL,
  `agency_employee_no` varchar(50) DEFAULT NULL,
  `citizenship` enum('Filipino','Dual Citizenship') DEFAULT NULL,
  `citizenship_type` enum('by birth','by naturalization') DEFAULT NULL,
  `residential_address` text DEFAULT NULL,
  `residential_zip_code` varchar(10) DEFAULT NULL,
  `permanent_address` text DEFAULT NULL,
  `permanent_zip_code` varchar(10) DEFAULT NULL,
  `telephone_no` varchar(50) DEFAULT NULL,
  `mobile_no` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personal_informations`
--

INSERT INTO `personal_informations` (`personal_information_id`, `employee_id`, `surname`, `first_name`, `middle_name`, `name_extension`, `date_of_birth`, `place_of_birth`, `sex`, `civil_status`, `height`, `weight`, `blood_type`, `gsis_no`, `pagibig_no`, `philhealth_no`, `sss_no`, `tin_no`, `agency_employee_no`, `citizenship`, `citizenship_type`, `residential_address`, `residential_zip_code`, `permanent_address`, `permanent_zip_code`, `telephone_no`, `mobile_no`, `email`, `created_at`, `updated_at`) VALUES
(81, 'S202412001', 'Acuzar', 'Shenna Faye', 'C', 'N/A', '2005-12-01', 'NMMC', 'Female', 'Married', 6.00, 65.00, 'O+', '1205', '34534', '12678', '234435', '23421', '235236', 'Filipino', 'by birth', 'P5-Tablon Cagayan De Oro CIty', '9000', 'P5-Tablon Cagayan De Oro City', '9000', '08876', '09533594872', 'shennafaye@gmail.com', '2024-12-15 17:58:27', '2025-01-06 06:01:53'),
(93, 'F202412012', 'Aleonar', 'Sherwin Victor', 'Pablo', 'N/A', NULL, NULL, NULL, 'Single', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Filipino', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-30 06:45:23', '2024-12-30 06:45:23'),
(94, 'F202501001', 'Aleonar', 'Test', 'P', NULL, '2025-01-06', NULL, 'Male', 'Married', 2.00, 4.00, 'b+', '8777', '34534', NULL, '8777', '334', '33', 'Filipino', 'by birth', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-02 10:22:32', '2025-01-02 10:22:32'),
(95, 'F202412001', 'Adane', 'Ernest', 'A', NULL, '2025-01-31', NULL, 'Male', 'Single', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Filipino', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-02 15:57:17', '2025-01-02 15:57:17');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1S46ofwQ1XilGe8dW7NMzhMUkWBD5onBMOQNbbhS', 321, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNjRsUDJpd085dDZuQ2RRUXJvRzE2dEUycVZ1OXExaElJTThlWmZ3RCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNjoiaHR0cDovL2xvY2FsaG9zdDo4MDAwL3JlcXVlc3Qvc3RhdHVzIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9yZXF1ZXN0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1NToibG9naW5fZW1wbG95ZWVfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozMjE7fQ==', 1736225284),
('oraylydv0Fl9Y6O4Dlpg1Oilcu1knC8gepgszqrR', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZlQ3UkkwVzVZaFAxdlRyOUthV1lLdlJKV1ZPdjRCOXNtU2VmTXBYNyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvb3RoZXJzL3JlamVjdGVkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1736225544);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_coe_req`
--

CREATE TABLE `tbl_coe_req` (
  `coe_id` int(11) NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Position` varchar(50) DEFAULT NULL,
  `DateStarted` date DEFAULT NULL,
  `MonthlyCompensationText` varchar(100) DEFAULT NULL,
  `MonthlyCompensationDigits` decimal(10,2) DEFAULT NULL,
  `proof_payment_path` varchar(255) DEFAULT NULL,
  `status` enum('approve','reject','pending') DEFAULT 'pending',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_coe_req`
--

INSERT INTO `tbl_coe_req` (`coe_id`, `employee_id`, `FirstName`, `LastName`, `Email`, `Position`, `DateStarted`, `MonthlyCompensationText`, `MonthlyCompensationDigits`, `proof_payment_path`, `status`, `updated_at`, `created_at`) VALUES
(23, 'F202412001', 'Ernest', 'Adane', 'Ernest12311@gmail.com', 'Driver', '2025-01-23', 'two thousand', 2000.00, 'proof_payments/dXdrHdpx46KR5hFTaYUZpSkOvhpT8avvUe1ZNnH0.png', 'approve', '2025-01-06 16:38:28', '2025-01-05 18:16:33'),
(29, 'S202412001', 'Shenna Faye', 'Acuzar', 'shennafaye@gmail.com', 'Staff', '2025-01-07', 'one thousand', 1000.00, 'proof_payments/MLZXOFpN283hBEiFWjt46xOnSxwNf1LI3qpd6iEm.png', 'approve', '2025-01-06 18:59:30', '2025-01-06 18:56:24');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_departments`
--

CREATE TABLE `tbl_departments` (
  `department_id` int(11) NOT NULL,
  `depart_name` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` enum('staff','faculty') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_departments`
--

INSERT INTO `tbl_departments` (`department_id`, `depart_name`, `updated_at`, `created_at`, `role`) VALUES
(1, 'College of Information Technology', '2024-10-29 02:00:00', '2024-10-29 00:00:00', 'faculty'),
(2, 'College of Criminal Justice & Public Safety', '2024-10-29 02:00:00', '2024-10-29 00:00:00', 'faculty'),
(3, 'College of Library Information Science', '2024-10-29 02:00:00', '2024-10-29 00:00:00', 'faculty'),
(4, 'College of Midwifery', '2024-10-29 02:00:00', '2024-10-29 00:00:00', 'faculty'),
(5, 'College of Engineering Technology', '2024-10-29 02:00:00', '2024-10-29 00:00:00', 'faculty'),
(6, 'College of Education', '2024-10-29 02:00:00', '2024-10-29 00:00:00', 'faculty'),
(7, 'College of Hospitality Management', '2024-10-29 02:00:00', '2024-10-29 00:00:00', 'faculty'),
(8, 'College of Arts and Science', '2024-10-29 02:00:00', '2024-10-29 00:00:00', 'faculty'),
(9, 'College of Business Administration', '2024-10-29 02:00:00', '2024-10-29 00:00:00', 'faculty'),
(10, 'UTILITY', '2024-10-29 00:00:00', '2024-10-29 00:00:00', 'staff'),
(11, 'WATCH MAN', '2024-10-29 00:00:00', '2024-10-29 00:00:00', 'staff'),
(12, 'DRIVER', '2024-10-29 00:00:00', '2024-10-29 00:00:00', 'staff'),
(13, 'OFFICE STAFF', '2024-10-29 00:00:00', '2024-10-29 00:00:00', 'staff'),
(14, 'PROFESSIONALS', '2024-10-29 00:00:00', '2024-10-29 00:00:00', 'staff'),
(15, 'ARCHITECT', '2024-10-29 00:00:00', '2024-10-29 00:00:00', 'staff'),
(16, 'MAINTENANCE', '2024-10-29 00:00:00', '2024-10-29 00:00:00', 'staff'),
(17, 'LIBRARIAN', '2024-10-29 00:00:00', '2024-10-29 00:00:00', 'staff'),
(18, 'Select Staff', '2024-10-28 20:05:50', '2024-10-28 20:05:24', 'staff');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_acc`
--

CREATE TABLE `tbl_employee_acc` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ranking`
--

CREATE TABLE `tbl_ranking` (
  `id` int(11) NOT NULL,
  `masterlist_id` int(11) NOT NULL,
  `field` varchar(255) NOT NULL,
  `current_qua` varchar(225) NOT NULL,
  `current_rank` varchar(255) NOT NULL,
  `updated_field` varchar(255) DEFAULT NULL,
  `updated_qua` varchar(255) DEFAULT NULL,
  `updated_rank` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_ranking`
--

INSERT INTO `tbl_ranking` (`id`, `masterlist_id`, `field`, `current_qua`, `current_rank`, `updated_field`, `updated_qua`, `updated_rank`, `created_at`, `updated_at`) VALUES
(14, 331, '2', '2', 'Instructor I', '1', '1', 'Assistant Professor I', '2025-01-05 05:31:56', '2025-01-04 21:31:56'),
(15, 333, '1', '1', 'instructor-i', '2', '2', 'Instructor II', '2025-01-04 04:07:24', '2025-01-03 20:07:24'),
(16, 322, '1', '1', 'instructor-i', '1', '1', 'Instructor I', '2025-01-04 04:17:04', '2025-01-03 20:17:04'),
(19, 324, '1', '1', 'assistant-professor-i', '2', '2', 'Instructor II', '2025-01-04 05:07:14', '2025-01-03 21:07:14'),
(20, 323, '4', '4', 'assistant-professor-iv', NULL, NULL, NULL, '2025-01-03 21:06:06', '2025-01-03 21:06:06'),
(21, 334, '1', '1', 'instructor-i', NULL, NULL, NULL, '2025-01-04 21:38:01', '2025-01-04 21:38:01');

-- --------------------------------------------------------

--
-- Table structure for table `training_programs_attended`
--

CREATE TABLE `training_programs_attended` (
  `training_programs_id` bigint(20) NOT NULL,
  `training_programs` varchar(100) NOT NULL,
  `number_of_hours` varchar(10) NOT NULL,
  `conducted_sponsored_by` varchar(100) NOT NULL,
  `inclusive_date_of_attendance` varchar(20) NOT NULL,
  `from` date NOT NULL,
  `to` date NOT NULL,
  `person_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `usertype` varchar(255) NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `plain_password` varchar(255) DEFAULT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `usertype`, `email_verified_at`, `password`, `plain_password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', 'admin', NULL, '$2y$12$OX2Z85jtmq7ITKV08y6wzeA4fFSVxCWrSZnu0rFDGenv1juBDZxNK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-21 00:41:25', '2024-10-21 00:41:25'),
(2, 'employee', 'employee@gmail.com', 'user', NULL, '$2y$12$CQIqC9f8Noxul6U4ogWXGeUq.r3Ki.31ZKJJ8.egIF0SlWHGPuPYW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-21 00:42:27', '2024-10-21 00:42:27'),
(4, 'Admin', 'admin@gmail.comss', 'user', NULL, '$2y$12$09BsecQkDuYRzGLuCXb/c.A7Z31GZmNLbzW.kqZmHQvJ0tp6dHM6u', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-29 11:05:34', '2024-10-29 11:05:34'),
(5, 'employee', 'employee@gmail.comss', 'user', NULL, '$2y$12$2VTU7ZJ/LEXDFPEkKWA3fOuoCW6XEDbnFYzGC.oPE1lbDrAuT/TCi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-29 11:05:34', '2024-10-29 11:05:34'),
(6, 'testpabs1', 'testpabs1@gmail.com', 'user', NULL, '$2y$12$UgSD9Qq5jS3jjSoacMbaGuU7nn.CwOLXJzj6Uji5wg0vRRcCLR5R6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-19 20:46:14', '2024-11-19 20:46:14'),
(7, 'janrey1234', 'pabstest@gmail.com', 'user', NULL, '$2y$12$49TfhIFal/G65tTDa96.O.MqNDdhkNw778YGmK807RPpUIkcXhW0i', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-21 05:10:43', '2024-11-21 05:10:43'),
(8, 'testestest', 'testest123@gmail.com', 'user', NULL, '$2y$12$h5ZJCawvNrr3nge4nkn8xePk.MguBBIEBI6rsoZLeFRZQ.TTLBREi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-21 20:02:41', '2024-11-21 20:02:41'),
(9, 'clowny', 'clowny123@gmail.com', 'user', NULL, '$2y$12$J2VSCrVyZVmMOhRkd.DnVOCx.2nI23tJ9dM1Uovm2K2cDhbRRA.oi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-24 22:54:40', '2024-11-24 22:54:40'),
(10, 'john mark', 'johmamamark@gmail.com', 'user', NULL, '$2y$12$NoWSD5ogdFg0gJeyyvBr6eJ0yOHmK1S/bnJL.hdyjT55tZGtknC3i', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-27 22:29:22', '2024-11-27 22:29:22'),
(11, 'janjanjan', 'john@gmail.com', 'user', NULL, '$2y$12$AcP0ngZT1sno.MaUmELWaOWSwAYYcAEFwF/i2U/JyfNPBxkRguzUy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-03 22:15:40', '2024-12-03 22:15:40'),
(12, 'sherwin', 'sherwin@gmail.com', 'user', NULL, '$2y$12$ZBaMRY8ypKMLBiBo7cszV.RB/gxTub6TAxG3lp/eSTfN6cLK6pyL6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-04 09:05:02', '2024-12-04 09:05:02'),
(13, 'sherwin', 'admin1@gmail.com', 'user', NULL, '$2y$12$gDCFuz0Pt7VklAMLcaza9.RiqAd9VAPRTTs9S3O.3bavWX7HOoOvm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-15 12:41:18', '2024-12-15 12:41:18'),
(14, 'Admin', 'admin@example.com', 'user', NULL, '$2y$12$zmwE7d8axgaqeTb9OPQ7zOABVkxfc.Dp6U2xOOWDY0cLQxWE3BNbu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-15 13:13:27', '2024-12-15 13:13:27'),
(15, 'sherwin', 'sherwin1@gmail.com', 'user', NULL, '$2y$12$vLocYM2kvRg4iZcknTHQFO03X8FetSmhhazpWhW6v38yebiqt.6tK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-15 13:23:07', '2024-12-15 13:23:07'),
(16, 'sherwin', 'aleonar@gmail.com', 'user', NULL, '$2y$12$6g4DQqzAgvLLq2CjnkHhz.KRRtkczWMg62NPUmSRUH5Vc/cYEArge', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-15 16:56:21', '2024-12-15 16:56:21');

-- --------------------------------------------------------

--
-- Table structure for table `voluntary_works`
--

CREATE TABLE `voluntary_works` (
  `id` int(11) NOT NULL,
  `personal_information_id` int(11) DEFAULT NULL,
  `organization_name` varchar(255) DEFAULT NULL,
  `organization_address` text DEFAULT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `hours` int(11) NOT NULL,
  `position` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voluntary_works`
--

INSERT INTO `voluntary_works` (`id`, `personal_information_id`, `organization_name`, `organization_address`, `from_date`, `to_date`, `hours`, `position`, `created_at`, `updated_at`) VALUES
(33, 81, 'AKRHO', NULL, '2024-01-01', '2025-01-06', 3000, 'Tigbunal', '2025-01-06 06:03:03', '2025-01-06 06:03:03');

-- --------------------------------------------------------

--
-- Table structure for table `work_experiences`
--

CREATE TABLE `work_experiences` (
  `id` int(11) NOT NULL,
  `personal_information_id` int(11) DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `position_title` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `monthly_salary` decimal(10,2) NOT NULL,
  `salary_grade` varchar(50) DEFAULT NULL,
  `status_of_appointment` varchar(100) DEFAULT NULL,
  `govt_service` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `work_experiences`
--

INSERT INTO `work_experiences` (`id`, `personal_information_id`, `from_date`, `to_date`, `position_title`, `department`, `monthly_salary`, `salary_grade`, `status_of_appointment`, `govt_service`, `created_at`, `updated_at`) VALUES
(74, 81, '2025-01-06', '2025-01-06', 'secret', 'o10', 20000.00, '2', 'secret', 'nope', '2025-01-06 06:03:03', '2025-01-06 06:03:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_employee`
--
ALTER TABLE `add_employee`
  ADD PRIMARY KEY (`employee_id`),
  ADD UNIQUE KEY `emp_email` (`emp_email`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `children`
--
ALTER TABLE `children`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personal_informations_id` (`personal_information_id`);

--
-- Indexes for table `civil_service_eligibilities`
--
ALTER TABLE `civil_service_eligibilities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personal_informations_id` (`personal_information_id`);

--
-- Indexes for table `contructual`
--
ALTER TABLE `contructual`
  ADD PRIMARY KEY (`id`),
  ADD KEY `masterlist_id` (`masterlist_id`);

--
-- Indexes for table `cos`
--
ALTER TABLE `cos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `masterlist_id` (`masterlist_id`);

--
-- Indexes for table `educational_backgrounds`
--
ALTER TABLE `educational_backgrounds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personal_informations_id` (`personal_information_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `family_backgrounds`
--
ALTER TABLE `family_backgrounds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personal_informations_id` (`personal_information_id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `masterlist_id` (`masterlist_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `learning_developments`
--
ALTER TABLE `learning_developments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personal_informations_id` (`personal_information_id`);

--
-- Indexes for table `masterlist`
--
ALTER TABLE `masterlist`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_id` (`employee_id`),
  ADD KEY `idx_employee_id` (`employee_id`),
  ADD KEY `idx_department` (`department`),
  ADD KEY `idx_employment_status` (`employment_status`),
  ADD KEY `idx_job_title` (`job_title`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `other_information`
--
ALTER TABLE `other_information`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personal_informations_id` (`personal_information_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `personal_informations`
--
ALTER TABLE `personal_informations`
  ADD PRIMARY KEY (`personal_information_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tbl_coe_req`
--
ALTER TABLE `tbl_coe_req`
  ADD PRIMARY KEY (`coe_id`);

--
-- Indexes for table `tbl_departments`
--
ALTER TABLE `tbl_departments`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `tbl_employee_acc`
--
ALTER TABLE `tbl_employee_acc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_ranking`
--
ALTER TABLE `tbl_ranking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `masterlist_id` (`masterlist_id`);

--
-- Indexes for table `training_programs_attended`
--
ALTER TABLE `training_programs_attended`
  ADD PRIMARY KEY (`training_programs_id`),
  ADD KEY `training_programs_attended_person_id_foreign` (`person_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `voluntary_works`
--
ALTER TABLE `voluntary_works`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personal_informations_id` (`personal_information_id`);

--
-- Indexes for table `work_experiences`
--
ALTER TABLE `work_experiences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personal_informations_id` (`personal_information_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_employee`
--
ALTER TABLE `add_employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `children`
--
ALTER TABLE `children`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `civil_service_eligibilities`
--
ALTER TABLE `civil_service_eligibilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `contructual`
--
ALTER TABLE `contructual`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cos`
--
ALTER TABLE `cos`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `educational_backgrounds`
--
ALTER TABLE `educational_backgrounds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=355;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `family_backgrounds`
--
ALTER TABLE `family_backgrounds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `learning_developments`
--
ALTER TABLE `learning_developments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `masterlist`
--
ALTER TABLE `masterlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=344;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `other_information`
--
ALTER TABLE `other_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_informations`
--
ALTER TABLE `personal_informations`
  MODIFY `personal_information_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `tbl_coe_req`
--
ALTER TABLE `tbl_coe_req`
  MODIFY `coe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_departments`
--
ALTER TABLE `tbl_departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_employee_acc`
--
ALTER TABLE `tbl_employee_acc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_ranking`
--
ALTER TABLE `tbl_ranking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `voluntary_works`
--
ALTER TABLE `voluntary_works`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `work_experiences`
--
ALTER TABLE `work_experiences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `add_employee`
--
ALTER TABLE `add_employee`
  ADD CONSTRAINT `add_employee_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `tbl_departments` (`department_id`);

--
-- Constraints for table `children`
--
ALTER TABLE `children`
  ADD CONSTRAINT `children_ibfk_1` FOREIGN KEY (`personal_information_id`) REFERENCES `personal_informations` (`personal_information_id`);

--
-- Constraints for table `civil_service_eligibilities`
--
ALTER TABLE `civil_service_eligibilities`
  ADD CONSTRAINT `civil_service_eligibilities_ibfk_1` FOREIGN KEY (`personal_information_id`) REFERENCES `personal_informations` (`personal_information_id`);

--
-- Constraints for table `educational_backgrounds`
--
ALTER TABLE `educational_backgrounds`
  ADD CONSTRAINT `educational_backgrounds_ibfk_1` FOREIGN KEY (`personal_information_id`) REFERENCES `personal_informations` (`personal_information_id`);

--
-- Constraints for table `family_backgrounds`
--
ALTER TABLE `family_backgrounds`
  ADD CONSTRAINT `family_backgrounds_ibfk_1` FOREIGN KEY (`personal_information_id`) REFERENCES `personal_informations` (`personal_information_id`);

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`masterlist_id`) REFERENCES `masterlist` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `learning_developments`
--
ALTER TABLE `learning_developments`
  ADD CONSTRAINT `learning_developments_ibfk_1` FOREIGN KEY (`personal_information_id`) REFERENCES `personal_informations` (`personal_information_id`);

--
-- Constraints for table `other_information`
--
ALTER TABLE `other_information`
  ADD CONSTRAINT `other_information_ibfk_1` FOREIGN KEY (`personal_information_id`) REFERENCES `personal_informations` (`personal_information_id`);

--
-- Constraints for table `tbl_ranking`
--
ALTER TABLE `tbl_ranking`
  ADD CONSTRAINT `tbl_ranking_ibfk_1` FOREIGN KEY (`masterlist_id`) REFERENCES `masterlist` (`id`);

--
-- Constraints for table `voluntary_works`
--
ALTER TABLE `voluntary_works`
  ADD CONSTRAINT `voluntary_works_ibfk_1` FOREIGN KEY (`personal_information_id`) REFERENCES `personal_informations` (`personal_information_id`);

--
-- Constraints for table `work_experiences`
--
ALTER TABLE `work_experiences`
  ADD CONSTRAINT `work_experiences_ibfk_1` FOREIGN KEY (`personal_information_id`) REFERENCES `personal_informations` (`personal_information_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
