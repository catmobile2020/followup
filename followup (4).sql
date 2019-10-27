-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2019 at 01:19 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `followup`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(10) UNSIGNED NOT NULL,
  `survey_id` int(10) UNSIGNED NOT NULL,
  `answer` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `survey_id`, `answer`, `created_at`, `updated_at`) VALUES
(1, 1, 'First Answer', '2019-06-11 01:15:51', '2019-06-11 01:15:51'),
(2, 1, 'second Answer', '2019-06-11 01:16:13', '2019-06-11 01:16:13'),
(4, 2, 'test', '2019-06-15 22:04:24', '2019-06-15 22:04:24'),
(5, 2, 'test 2', '2019-06-15 22:04:31', '2019-06-15 22:04:31'),
(6, 3, 'poll 1', '2019-06-15 22:07:17', '2019-06-15 22:07:17'),
(7, 3, 'poll 2', '2019-06-15 22:07:23', '2019-06-15 22:07:23'),
(8, 6, '3', '2019-06-26 11:57:42', '2019-06-26 11:57:42'),
(10, 6, '16', '2019-06-26 12:05:07', '2019-06-26 12:05:07'),
(13, 6, '6', '2019-06-26 12:26:57', '2019-06-26 12:26:57'),
(15, 6, '1', '2019-06-26 12:41:04', '2019-06-26 12:41:04');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `body` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `body`, `created_at`, `updated_at`) VALUES
(7, 2, 1, 'new comment', '2019-06-23 08:10:14', '2019-06-23 08:10:14');

-- --------------------------------------------------------

--
-- Table structure for table `corporates`
--

CREATE TABLE `corporates` (
  `id` int(10) UNSIGNED NOT NULL,
  `about` longtext COLLATE utf8mb4_unicode_ci,
  `mission` longtext COLLATE utf8mb4_unicode_ci,
  `vision` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `corporates`
--

INSERT INTO `corporates` (`id`, `about`, `mission`, `vision`, `created_at`, `updated_at`) VALUES
(1, '<p>test&nbsp; About</p>', 'test&nbsp; Mission', 'test&nbsp; Vision', NULL, '2019-06-18 11:05:47');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Egypt', 1, '2019-08-19 12:42:26', '2019-08-19 12:43:58');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `user_id`, `title`, `description`, `category`, `path`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'FarmVille Test', 'Our New App test', '3', 'uploads/documents/document1563292252.jpg', 'picture', 0, '2019-07-16 13:50:52', '2019-07-16 13:50:52'),
(2, 1, 'healthy tips', 'We 100 Healthy Tips', '4', 'uploads/documents/document1563364955.csv', 'excel', 0, '2019-07-17 10:02:35', '2019-07-17 10:02:35'),
(3, 1, 'test archive', 'our se demo', '2', 'uploads/documents/document1563372939.zip', 'archive', 0, '2019-07-17 12:15:39', '2019-07-17 12:15:39');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `group_user`
--

CREATE TABLE `group_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ideas`
--

CREATE TABLE `ideas` (
  `id` int(10) UNSIGNED NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ideas`
--

INSERT INTO `ideas` (`id`, `subject`, `description`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'first test', '<p>testing&nbsp;&nbsp;&nbsp;&nbsp;</p>', 1, '2019-05-29 00:02:16', '2019-05-29 00:02:16'),
(2, 'first test', '<p>testing&nbsp;&nbsp;&nbsp;&nbsp;</p>', 1, '2019-05-29 00:02:46', '2019-05-29 00:02:46'),
(3, 'first test', '<p>testing&nbsp;&nbsp;&nbsp;&nbsp;</p>', 1, '2019-05-29 00:03:54', '2019-05-29 00:03:54'),
(4, 'first test', '<p>testing&nbsp;&nbsp;&nbsp;&nbsp;</p>', 1, '2019-05-29 00:16:49', '2019-05-29 00:16:49'),
(5, 'April Salary', '<p><span style=\"font-size: 24px;\"><b><font color=\"#ff0000\">Hello Everyone</font></b></span></p><p><span style=\"font-size: 24px;\"><b><font color=\"#ff0000\"><br></font></b></span></p><p><span style=\"font-size: 24px;\"><b><font color=\"#ff0000\">This new Test</font></b></span></p><p><span style=\"font-size: 24px;\"><b><font color=\"#ff0000\"><br></font></b></span></p><p><span style=\"font-size: 24px;\"><b><font color=\"#ff0000\">please Keep it up</font></b></span></p>', 1, '2019-05-30 08:32:25', '2019-05-30 08:32:25'),
(6, 'test from another account', '<p>testing from another account</p>', 16, '2019-06-09 10:30:57', '2019-06-09 10:30:57'),
(7, 'new data', '<p>hal ahmed keifk</p>', 1, '2019-07-21 12:07:16', '2019-07-21 12:07:16'),
(8, 'test from api', 'testing from api and description', 16, '2019-07-21 12:26:03', '2019-07-21 12:26:03'),
(9, 'test from api', 'testing from api and description', 16, '2019-07-21 12:26:22', '2019-07-21 12:26:22'),
(10, 'test form data', 'test description form data', 16, '2019-07-21 12:28:27', '2019-07-21 12:28:27'),
(11, 'test form data', 'test description form data', 16, '2019-07-21 12:32:14', '2019-07-21 12:32:14'),
(13, 'test form data', 'test description form data', 16, '2019-07-21 12:40:47', '2019-07-21 12:40:47'),
(14, 'test form data', 'test description form data', 16, '2019-07-21 12:40:51', '2019-07-21 12:40:51');

-- --------------------------------------------------------

--
-- Table structure for table `idea_receiver`
--

CREATE TABLE `idea_receiver` (
  `id` int(10) UNSIGNED NOT NULL,
  `idea_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `idea_receiver`
--

INSERT INTO `idea_receiver` (`id`, `idea_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 3, 1, NULL, NULL),
(2, 4, 1, NULL, NULL),
(3, 5, 1, NULL, NULL),
(4, 6, 1, NULL, NULL),
(5, 7, 1, NULL, NULL),
(6, 9, 1, NULL, NULL),
(7, 10, 1, NULL, NULL),
(8, 11, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `idea_replies`
--

CREATE TABLE `idea_replies` (
  `id` int(10) UNSIGNED NOT NULL,
  `idea_id` int(10) UNSIGNED NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `idea_replies`
--

INSERT INTO `idea_replies` (`id`, `idea_id`, `description`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 5, '<p>testing REply</p>', 1, '2019-06-09 08:34:18', '2019-06-09 08:34:18'),
(2, 5, '<p>testing REply</p>', 1, '2019-06-09 08:41:03', '2019-06-09 08:41:03'),
(3, 5, '<p>testing REply</p>', 1, '2019-06-09 08:41:21', '2019-06-09 08:41:21'),
(4, 5, '<p>testing REply</p>', 1, '2019-06-09 08:41:34', '2019-06-09 08:41:34'),
(5, 5, '<p>testing REply</p>', 1, '2019-06-09 08:41:46', '2019-06-09 08:41:46');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `type` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `type` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_format` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `from_user_id`, `to_user_id`, `type`, `file_format`, `file_path`, `message`, `date`, `time`, `ip`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'text', '', '', 'test', '2019-05-19', '11:35 AM', '127.0.0.1', NULL, NULL, NULL),
(2, 1, 6, 'text', '', '', 'kgjkhljgkhg', '2019-05-19', '11:44 AM', '127.0.0.1', NULL, NULL, NULL),
(3, 1, 6, 'text', '', '', 'gfgfgfgfg.g', '2019-05-19', '12:11 PM', '127.0.0.1', NULL, NULL, NULL),
(4, 1, 3, 'text', '', '', 'testing', '2019-05-19', '12:15 PM', '127.0.0.1', NULL, NULL, NULL),
(5, 1, 16, 'text', '', '', 'hi', '2019-05-19', '12:34 PM', '127.0.0.1', NULL, NULL, NULL),
(6, 16, 1, 'text', '', '', 'ahlan', '2019-05-19', '12:35 PM', '127.0.0.1', NULL, NULL, NULL),
(7, 16, 1, 'text', '', '', '?', '2019-05-19', '12:35 PM', '127.0.0.1', NULL, NULL, NULL),
(8, 16, 1, 'text', '', '', 'mn kam sana', '2019-05-19', '12:35 PM', '127.0.0.1', NULL, NULL, NULL),
(9, 1, 16, 'text', '', '', 'wana mayal mAYAL', '2019-05-19', '12:35 PM', '127.0.0.1', NULL, NULL, NULL),
(10, 16, 1, 'text', '', '', 'W F 7OBK ANA', '2019-05-19', '12:35 PM', '127.0.0.1', NULL, NULL, NULL),
(11, 1, 16, 'text', '', '', 'MASH3\'OOL L BAL', '2019-05-19', '12:36 PM', '127.0.0.1', NULL, NULL, NULL),
(12, 16, 1, 'text', '', '', 'L BTTKLMY', '2019-05-19', '12:36 PM', '127.0.0.1', NULL, NULL, NULL),
(13, 1, 16, 'text', '', '', 'WLA', '2019-05-19', '12:36 PM', '127.0.0.1', NULL, NULL, NULL),
(14, 1, 11, 'text', '', '', 'hi', '2019-05-19', '02:30 PM', '127.0.0.1', NULL, NULL, NULL),
(15, 1, 11, 'text', '', '', 'fdfdfdf', '2019-05-27', '11:27 AM', '127.0.0.1', NULL, NULL, NULL),
(16, 3, 1, 'text', '', '', 'wlaaa', '2019-05-27', '11:30 AM', '127.0.0.1', NULL, NULL, NULL),
(17, 1, 3, 'text', '', '', 'bolbol', '2019-05-27', '11:31 AM', '127.0.0.1', NULL, NULL, NULL),
(18, 1, 3, 'text', '', '', 'hi', '2019-05-27', '11:35 AM', '127.0.0.1', NULL, NULL, NULL),
(19, 1, 3, 'text', '', '', 'wlaa', '2019-05-27', '01:20 PM', '127.0.0.1', NULL, NULL, NULL),
(20, 3, 1, 'text', '', '', 'n3m', '2019-05-27', '01:20 PM', '127.0.0.1', NULL, NULL, NULL),
(21, 1, 3, 'text', '', '', 'aaa', '2019-05-27', '01:21 PM', '127.0.0.1', NULL, NULL, NULL),
(22, 1, 3, 'text', '', '', 'test', '2019-05-27', '01:21 PM', '127.0.0.1', NULL, NULL, NULL),
(23, 3, 1, 'text', '', '', 'test', '2019-05-27', '01:21 PM', '127.0.0.1', NULL, NULL, NULL),
(24, 1, 3, 'text', '', '', 'ddd', '2019-05-27', '01:22 PM', '127.0.0.1', NULL, NULL, NULL),
(25, 3, 1, 'text', '', '', 'hi', '2019-05-27', '03:39 PM', '127.0.0.1', NULL, NULL, NULL),
(26, 1, 3, 'text', '', '', 'test', '2019-05-27', '03:40 PM', '127.0.0.1', NULL, NULL, NULL),
(27, 3, 1, 'text', '', '', 'alo', '2019-05-27', '03:40 PM', '127.0.0.1', NULL, NULL, NULL),
(28, 3, 1, 'text', '', '', 'hi', '2019-05-27', '03:45 PM', '127.0.0.1', NULL, NULL, NULL),
(29, 1, 3, 'text', '', '', 'hrll', '2019-05-27', '03:46 PM', '127.0.0.1', NULL, NULL, NULL),
(30, 3, 1, 'text', '', '', 'fddfdfd', '2019-05-27', '03:46 PM', '127.0.0.1', NULL, NULL, NULL),
(31, 1, 3, 'text', '', '', 'fdfdfdfd', '2019-05-27', '03:46 PM', '127.0.0.1', NULL, NULL, NULL),
(32, 3, 1, 'text', '', '', 'فثسف', '2019-05-28', '12:47 PM', '127.0.0.1', NULL, NULL, NULL),
(33, 1, 3, 'text', '', '', 'hughg', '2019-05-28', '12:48 PM', '127.0.0.1', NULL, NULL, NULL),
(34, 3, 1, 'text', '', '', 'gfgfgfg', '2019-05-28', '12:48 PM', '127.0.0.1', NULL, NULL, NULL),
(35, 3, 1, 'text', '', '', 'test', '2019-05-28', '12:49 PM', '127.0.0.1', NULL, NULL, NULL),
(36, 1, 3, 'text', '', '', 'hi', '2019-05-28', '12:49 PM', '127.0.0.1', NULL, NULL, NULL),
(37, 3, 1, 'text', '', '', 'test', '2019-05-28', '12:49 PM', '127.0.0.1', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(27, '2013_01_27_152855_create_teams_table', 1),
(28, '2013_01_27_153631_create_roles_table', 1),
(29, '2014_10_12_000000_create_users_table', 1),
(30, '2014_10_12_100000_create_password_resets_table', 1),
(31, '2018_02_11_102652_create_notifications_table', 1),
(32, '2018_02_19_142720_create_photos_table', 1),
(36, '2019_01_10_121146_create_groups_table', 1),
(37, '2019_01_10_121953_create_group_user_table', 1),
(38, '2019_01_27_152933_create_skills_table', 1),
(39, '2019_01_27_175148_create_user_skill_table', 1),
(40, '2019_01_27_180009_create_team_skill_table', 1),
(41, '2019_01_29_151509_create_notes_table', 2),
(42, '2019_01_29_163920_create_jobs_table', 2),
(43, '2019_02_02_184040_create_ideas_table', 2),
(45, '2019_02_05_124420_create_suppliers_table', 3),
(46, '2019_02_07_140203_create_procurements_table', 4),
(47, '2019_02_10_150750_create_offer_prices_table', 5),
(48, '2019_02_16_224246_create_procurement_logs_table', 6),
(49, '2018_03_28_142141_create_posts_table', 7),
(50, '2018_03_29_084442_create_comments_table', 7),
(51, '2018_03_29_092512_create_likes_table', 7),
(52, '2019_04_01_125609_create_replies_table', 8),
(53, '2018_07_27_092819_create_messages_table', 9),
(54, '2019_05_19_092220_add_socket_to_users_table', 9),
(55, '2019_06_16_145658_create_corporates_table', 10),
(56, '2019_06_24_120341_add_type_to_posts_table', 11),
(60, '2019_07_16_115105_create_documents_table', 12),
(61, '2012_02_27_154352_create_countries_table', 13);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` int(11) DEFAULT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `offer_prices`
--

CREATE TABLE `offer_prices` (
  `id` int(10) UNSIGNED NOT NULL,
  `procurement_id` int(10) UNSIGNED NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `offer_prices`
--

INSERT INTO `offer_prices` (`id`, `procurement_id`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 'this is a test offer price for my first po', '2019-02-11 12:43:04', '2019-02-11 12:43:04'),
(2, 1, 'this is a test offer price for my first po', '2019-02-11 12:44:35', '2019-02-11 12:44:35'),
(3, 1, 'testing again and again', '2019-02-11 12:45:03', '2019-02-11 12:45:03'),
(4, 1, 'testing again and again', '2019-02-11 12:50:44', '2019-02-11 12:50:44'),
(5, 1, 'testing again and again', '2019-02-11 12:50:54', '2019-02-11 12:50:54'),
(6, 1, 'testing again and again', '2019-02-11 12:52:01', '2019-02-11 12:52:01'),
(7, 2, 'please review this file for this po', '2019-02-25 12:04:29', '2019-02-25 12:04:29'),
(8, 2, 'please review this file for this po', '2019-02-25 12:06:37', '2019-02-25 12:06:37'),
(9, 2, 'please review this file for this po', '2019-02-25 12:06:52', '2019-02-25 12:06:52'),
(10, 2, 'please review this file for this po', '2019-02-25 12:07:33', '2019-02-25 12:07:33'),
(11, 2, 'please review this file for this po', '2019-02-25 12:08:25', '2019-02-25 12:08:25');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` int(10) UNSIGNED NOT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imageable_id` int(11) NOT NULL,
  `imageable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `path`, `imageable_id`, `imageable_type`, `created_at`, `updated_at`) VALUES
(1, 'uploads/2gb.png', 1, 'App\\User', '2019-01-27 15:21:42', '2019-01-27 15:21:42'),
(2, 'uploads/131549896303.docx', 3, 'App\\OfferPrice', '2019-02-11 12:45:03', '2019-02-11 12:45:03'),
(3, 'uploads/231549896303.csv', 3, 'App\\OfferPrice', '2019-02-11 12:45:03', '2019-02-11 12:45:03'),
(4, 'uploads/141549896644.docx', 4, 'App\\OfferPrice', '2019-02-11 12:50:44', '2019-02-11 12:50:44'),
(5, 'uploads/241549896644.csv', 4, 'App\\OfferPrice', '2019-02-11 12:50:44', '2019-02-11 12:50:44'),
(6, 'uploads/151549896654.docx', 5, 'App\\OfferPrice', '2019-02-11 12:50:54', '2019-02-11 12:50:54'),
(7, 'uploads/251549896655.csv', 5, 'App\\OfferPrice', '2019-02-11 12:50:55', '2019-02-11 12:50:55'),
(8, 'uploads/161549896721.docx', 6, 'App\\OfferPrice', '2019-02-11 12:52:01', '2019-02-11 12:52:01'),
(9, 'uploads/261549896721.csv', 6, 'App\\OfferPrice', '2019-02-11 12:52:01', '2019-02-11 12:52:01'),
(10, 'uploads/1101551103653.xlsx', 10, 'App\\OfferPrice', '2019-02-25 12:07:33', '2019-02-25 12:07:33'),
(11, 'uploads/2101551103653.png', 10, 'App\\OfferPrice', '2019-02-25 12:07:33', '2019-02-25 12:07:33'),
(12, 'uploads/3101551103654.doc', 10, 'App\\OfferPrice', '2019-02-25 12:07:34', '2019-02-25 12:07:34'),
(13, 'uploads/1111551103705.xlsx', 11, 'App\\OfferPrice', '2019-02-25 12:08:25', '2019-02-25 12:08:25'),
(14, 'uploads/2111551103706.png', 11, 'App\\OfferPrice', '2019-02-25 12:08:26', '2019-02-25 12:08:26'),
(15, 'uploads/3111551103706.doc', 11, 'App\\OfferPrice', '2019-02-25 12:08:26', '2019-02-25 12:08:26'),
(17, 'uploads/image_31561281782.jpg', 3, 'App\\Post', '2019-06-23 07:23:02', '2019-06-23 07:23:02'),
(20, 'uploads/image_61561380480.jpg', 6, 'App\\Post', '2019-06-24 10:48:00', '2019-06-24 10:48:00'),
(21, 'uploads/idea171563718036.jpg', 7, 'App\\Idea', '2019-07-21 12:07:16', '2019-07-21 12:07:16');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `body` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `body`, `created_at`, `updated_at`, `type`) VALUES
(2, 1, 'TEST Reply', '2019-04-01 11:50:56', '2019-04-01 11:50:56', 0),
(3, 1, 'ahmed', '2019-06-23 07:23:02', '2019-06-23 07:23:02', 0),
(6, 1, 'new Corporate Post', '2019-06-24 10:48:00', '2019-06-24 10:48:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `procurements`
--

CREATE TABLE `procurements` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `po_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `items` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `deadline` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `place` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `procurements`
--

INSERT INTO `procurements` (`id`, `company_name`, `po_number`, `supplier_id`, `user_id`, `items`, `details`, `status`, `deadline`, `place`, `created_at`, `updated_at`) VALUES
(1, 'Agreen Point', '123456', 1, 1, 'djkfjdkfjdklfjdkfjdlk', 'fgfgfgfgfgfggfg', 3, '02/14/2019', 'cairo', '2019-02-10 09:49:41', '2019-02-12 10:17:36'),
(2, 'CAT', '321654', 1, 6, 'test again again again', 'test again again again test again again again test again again again', 1, '02/21/2019', 'Cairo', '2019-02-10 13:59:50', '2019-02-25 12:04:29');

-- --------------------------------------------------------

--
-- Table structure for table `procurement_logs`
--

CREATE TABLE `procurement_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `procurement_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `notes` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `id` int(10) UNSIGNED NOT NULL,
  `comment_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `body` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` int(11) DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `active`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Admin will Have all priviliges', 1, NULL, NULL, '2019-02-02 20:30:41'),
(2, 'Employee', 'Normal Privileges', 0, 1, '2019-01-27 19:33:21', '2019-02-02 16:38:42');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` int(11) DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `name`, `description`, `active`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'PHP', NULL, 1, 1, '2019-01-27 18:45:43', '2019-01-27 18:45:43'),
(2, 'HTML', NULL, 1, 1, '2019-01-27 18:46:53', '2019-01-27 18:46:53'),
(3, 'JS/jquery', NULL, 1, 1, '2019-01-27 18:47:07', '2019-02-03 13:18:55'),
(4, 'Negotiation', 'Negotiation Skill', 1, 1, '2019-02-10 10:14:56', '2019-02-10 10:14:56'),
(5, 'Relationship Building', 'Relationship Building skill', 1, 1, '2019-02-10 10:15:37', '2019-02-10 10:15:37');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `active` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `email`, `phone`, `address`, `description`, `user_id`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Ahmed Mahmoud', 'r.ot@hotmail.co.uk', '43745053', '2 Komi St, Mit-Ghamr', 'Admin will Have all priviliges', 1, 1, '2019-02-10 08:03:24', '2019-02-10 08:03:24');

-- --------------------------------------------------------

--
-- Table structure for table `surveys`
--

CREATE TABLE `surveys` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) DEFAULT '1',
  `type` int(11) DEFAULT '0',
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `surveys`
--

INSERT INTO `surveys` (`id`, `title`, `status`, `type`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'first test survey updated', 1, 0, 1, '2019-06-11 00:05:04', '2019-06-15 20:09:13'),
(2, 'test new poll', 1, 1, 1, '2019-06-15 22:03:17', '2019-06-15 22:03:17'),
(3, 'second poll', 1, 1, 1, '2019-06-15 22:07:10', '2019-06-15 22:07:10'),
(4, 'poll fix', 1, 1, 1, '2019-06-15 22:08:49', '2019-06-15 22:08:49'),
(5, 'June 2019', 1, 1, 1, '2019-06-25 09:13:12', '2019-06-25 09:13:12'),
(6, 'June 2019', 1, 2, 1, '2019-06-25 09:19:58', '2019-06-25 09:19:59');

-- --------------------------------------------------------

--
-- Table structure for table `survey_answers`
--

CREATE TABLE `survey_answers` (
  `id` int(10) UNSIGNED NOT NULL,
  `answer_id` int(10) UNSIGNED NOT NULL,
  `survey_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `active` int(11) DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `description`, `active`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Management', 'this is responsible for Managerial Areas', 1, 1, '2019-01-10 05:15:11', '2019-02-02 17:37:02'),
(3, 'Mobile Applications', 'Web Apps - Mobile Apps - Management Systems - Augmented Reality Apps', 1, 1, '2019-01-27 19:07:42', '2019-02-02 17:36:55'),
(4, 'Procurement', 'Procurement Department', 1, 1, '2019-02-10 10:17:36', '2019-02-10 10:17:36'),
(5, 'Accounts', 'manage Financial operations', 1, 1, '2019-02-12 10:19:23', '2019-02-17 11:35:44');

-- --------------------------------------------------------

--
-- Table structure for table `team_skill`
--

CREATE TABLE `team_skill` (
  `id` int(10) UNSIGNED NOT NULL,
  `team_id` int(10) UNSIGNED NOT NULL,
  `skill_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `team_skill`
--

INSERT INTO `team_skill` (`id`, `team_id`, `skill_id`, `created_at`, `updated_at`) VALUES
(1, 3, 1, NULL, NULL),
(2, 3, 2, NULL, NULL),
(4, 1, 2, NULL, NULL),
(5, 4, 4, NULL, NULL),
(6, 4, 5, NULL, NULL),
(7, 5, 4, NULL, NULL),
(8, 5, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_profile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `bio` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verified` int(11) NOT NULL DEFAULT '0',
  `verification_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `admin` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'true',
  `player_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `team_id` int(10) UNSIGNED NOT NULL,
  `socket_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `online` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `country_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `phone`, `image_profile`, `address`, `bio`, `remember_token`, `verified`, `verification_token`, `active`, `admin`, `player_id`, `created_by`, `created_at`, `updated_at`, `role_id`, `team_id`, `socket_id`, `online`, `country_id`) VALUES
(1, 'Ahmed Adel', 'admin', 'admin@cat.com', '$2y$10$1GjooKckgtfxT8UZLcfhyuq7K/0G.fkLpaSnqSORH7Ig3yrsiaYmW', '0123652365', NULL, '1207, 1-Lake Plaza, Jumeirah Lakes Towers, Dubai, United Arab Emirates', '<ol><li><span style=\"font-size: 24px; background-color: rgb(255, 0, 0);\"><b><font color=\"#ffffff\">testing</font></b></span></li></ol>', 'JL5UvpprYkHeM1FX9lu7T3eHXHpLl0fNYBbleE9cc26GnkyinFiYcll2ikuA', 1, NULL, 1, 'true', NULL, NULL, NULL, '2019-02-02 20:24:32', 1, 1, '1pXaR76p95FwuFsiAAAA', 'Y', NULL),
(3, 'Ahmed Abdulfatah', 'abdulfatah', 'ta7@cat.com.eg', '$2y$10$K7sBK4Lh/EmsvhePu9SxBuraH8RtvolvoKAsXMKfggCscigm0cZB2', '01121542365', NULL, '‎مكتب 114 - الدور الاول - اويسس مول - طريق الملك عبدالله-جده‎', NULL, NULL, 0, NULL, 1, 'false', NULL, 1, '2019-01-27 20:09:19', '2019-02-03 13:29:42', 2, 3, 'UvKbSGT00jr29SvsAAAK', 'Y', NULL),
(4, 'Test', 'eloraby', 'aya@domain.com', '$2y$10$NvSp0Zw65slWkibjSuZKB.5Jd3G5DKzsUBDiWy5gop783txMaqt1e', '012365482', NULL, '‎مكتب 114 - الدور الاول - اويسس مول - طريق الملك عبدالله-جده‎', NULL, 'F34WOy1KC3WXCVL8utyB5hQuBsk5zstzRhwkdrytpdL8ccTSKVqTwa9lHJIy', 0, NULL, 0, 'false', NULL, 1, '2019-01-27 22:38:40', '2019-05-19 09:04:41', 1, 3, NULL, 'N', NULL),
(6, 'Ahmed', 'test', 'r.ot@hotmail.co.uk', '$2y$10$T1tHJe1P5BBuktPDrT5iKejlztqiUR97QLLO.mOYd5haAuJalWT06', '4546564545', NULL, '123654789', 'fdjfhjkdhfjkdhfjkdhfjkdhkfjdhfkjhdjfhdjk', 'SiILEkXTskAFTtVgu2LvigVd3mf38lcqihYpVahaM7oseJddvVQ01dHRIuvO', 0, NULL, 1, 'false', NULL, 1, '2019-02-02 22:30:00', '2019-02-03 13:29:54', 2, 3, NULL, 'N', NULL),
(11, 'aaaaaaaaaaaaaaaaaa', 'test3', 'r.ot3@hotmail.co.uk', '$2y$10$RmwmofhAI3St78eCZJHHL.4feLn/zQ5Zxe2I6y3COWnSVt0VF.2gK', '4546564545', NULL, '123654789', 'dfdfdfdfd', NULL, 0, NULL, 1, 'false', NULL, 1, '2019-02-02 22:35:25', '2019-02-03 13:29:27', 2, 3, NULL, 'N', NULL),
(16, 'Nagat', 'nagat', 'nagat@cat.com.eg', '$2y$10$YTqHsiUUqV6G6WFGqR/AaOaudp0SR9HYKsz5wnaJSiFYnr1RGqFfe', '0123654255', NULL, 'Cairo Egypt', NULL, 'omWQE4aPRnytmoIoqeIw0ba6uoqBUPQoLob3ySbSNi0e9Eqvrcpl2HxvViDr', 0, NULL, 1, 'true', NULL, NULL, '2019-02-10 10:18:31', '2019-02-10 10:18:38', 1, 4, '', 'N', NULL),
(17, 'Hisham Ahmed', 'hesham', 'hesham@cat.com.eg', '$2y$10$K5Po1vTRCsCZFNWICoS4IOh9Vmat0qr2MHOUe.g7CfvAYSaRIse32', '0123652369', NULL, 'cairo', NULL, '0fVptY0yjvRfjVO8c0kpEDJlhj832lii1K81xBxLhd54EnNLlnXgl4OQz4o4', 0, NULL, 1, 'true', NULL, NULL, '2019-02-12 10:21:33', '2019-02-12 10:21:43', 1, 5, NULL, 'N', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_skill`
--

CREATE TABLE `user_skill` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `skill_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_skill`
--

INSERT INTO `user_skill` (`id`, `user_id`, `skill_id`) VALUES
(3, 3, 3),
(4, 1, 1),
(5, 4, 3),
(6, 6, 1),
(7, 11, 1),
(8, 11, 3),
(9, 16, 4),
(10, 16, 5),
(11, 17, 4),
(12, 17, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `answers_survey_id_index` (`survey_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_post_id_index` (`post_id`);

--
-- Indexes for table `corporates`
--
ALTER TABLE `corporates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `countries_name_unique` (`name`),
  ADD KEY `countries_active_index` (`active`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `documents_user_id_index` (`user_id`),
  ADD KEY `documents_status_index` (`status`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_user`
--
ALTER TABLE `group_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_user_group_id_foreign` (`group_id`),
  ADD KEY `group_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `ideas`
--
ALTER TABLE `ideas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ideas_user_id_index` (`user_id`);

--
-- Indexes for table `idea_receiver`
--
ALTER TABLE `idea_receiver`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idea_receiver_idea_id_index` (`idea_id`),
  ADD KEY `idea_receiver_user_id_index` (`user_id`);

--
-- Indexes for table `idea_replies`
--
ALTER TABLE `idea_replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idea_replies_user_id_foreign` (`user_id`),
  ADD KEY `idea_replies_idea_id_index` (`idea_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `likes_user_id_foreign` (`user_id`),
  ADD KEY `likes_post_id_index` (`post_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notes_user_id_index` (`user_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_id_index` (`notifiable_id`);

--
-- Indexes for table `offer_prices`
--
ALTER TABLE `offer_prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offer_prices_procurement_id_index` (`procurement_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_user_id_index` (`user_id`),
  ADD KEY `posts_type_index` (`type`);

--
-- Indexes for table `procurements`
--
ALTER TABLE `procurements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `procurements_supplier_id_index` (`supplier_id`),
  ADD KEY `procurements_user_id_index` (`user_id`),
  ADD KEY `procurements_status_index` (`status`);

--
-- Indexes for table `procurement_logs`
--
ALTER TABLE `procurement_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `procurement_logs_procurement_id_index` (`procurement_id`),
  ADD KEY `procurement_logs_user_id_index` (`user_id`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `replies_user_id_foreign` (`user_id`),
  ADD KEY `replies_comment_id_index` (`comment_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `suppliers_email_unique` (`email`),
  ADD KEY `suppliers_user_id_foreign` (`user_id`);

--
-- Indexes for table `surveys`
--
ALTER TABLE `surveys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `surveys_user_id_foreign` (`user_id`);

--
-- Indexes for table `survey_answers`
--
ALTER TABLE `survey_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `survey_answers_answer_id_index` (`answer_id`),
  ADD KEY `survey_answers_survey_id_index` (`survey_id`),
  ADD KEY `survey_answers_user_id_index` (`user_id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team_skill`
--
ALTER TABLE `team_skill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `team_skill_skill_id_foreign` (`skill_id`),
  ADD KEY `team_skill_team_id_foreign` (`team_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`),
  ADD KEY `users_team_id_index` (`team_id`);

--
-- Indexes for table `user_skill`
--
ALTER TABLE `user_skill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_skill_skill_id_foreign` (`skill_id`),
  ADD KEY `user_skill_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `corporates`
--
ALTER TABLE `corporates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group_user`
--
ALTER TABLE `group_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ideas`
--
ALTER TABLE `ideas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `idea_receiver`
--
ALTER TABLE `idea_receiver`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `idea_replies`
--
ALTER TABLE `idea_replies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `offer_prices`
--
ALTER TABLE `offer_prices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `procurements`
--
ALTER TABLE `procurements`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `procurement_logs`
--
ALTER TABLE `procurement_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `surveys`
--
ALTER TABLE `surveys`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `survey_answers`
--
ALTER TABLE `survey_answers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `team_skill`
--
ALTER TABLE `team_skill`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_skill`
--
ALTER TABLE `user_skill`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_survey_id_foreign` FOREIGN KEY (`survey_id`) REFERENCES `surveys` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `group_user`
--
ALTER TABLE `group_user`
  ADD CONSTRAINT `group_user_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`),
  ADD CONSTRAINT `group_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `ideas`
--
ALTER TABLE `ideas`
  ADD CONSTRAINT `ideas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `idea_replies`
--
ALTER TABLE `idea_replies`
  ADD CONSTRAINT `idea_replies_idea_id_foreign` FOREIGN KEY (`idea_id`) REFERENCES `ideas` (`id`),
  ADD CONSTRAINT `idea_replies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `procurements`
--
ALTER TABLE `procurements`
  ADD CONSTRAINT `procurements_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`),
  ADD CONSTRAINT `procurements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `procurement_logs`
--
ALTER TABLE `procurement_logs`
  ADD CONSTRAINT `procurement_logs_procurement_id_foreign` FOREIGN KEY (`procurement_id`) REFERENCES `procurements` (`id`),
  ADD CONSTRAINT `procurement_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `replies`
--
ALTER TABLE `replies`
  ADD CONSTRAINT `replies_comment_id_foreign` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`),
  ADD CONSTRAINT `replies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD CONSTRAINT `suppliers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `surveys`
--
ALTER TABLE `surveys`
  ADD CONSTRAINT `surveys_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `survey_answers`
--
ALTER TABLE `survey_answers`
  ADD CONSTRAINT `survey_answers_answer_id_foreign` FOREIGN KEY (`answer_id`) REFERENCES `answers` (`id`),
  ADD CONSTRAINT `survey_answers_survey_id_foreign` FOREIGN KEY (`survey_id`) REFERENCES `surveys` (`id`),
  ADD CONSTRAINT `survey_answers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `team_skill`
--
ALTER TABLE `team_skill`
  ADD CONSTRAINT `team_skill_skill_id_foreign` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`id`),
  ADD CONSTRAINT `team_skill_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `users_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`);

--
-- Constraints for table `user_skill`
--
ALTER TABLE `user_skill`
  ADD CONSTRAINT `user_skill_skill_id_foreign` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`id`),
  ADD CONSTRAINT `user_skill_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
