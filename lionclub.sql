-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2024 at 06:27 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lionclub`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_menus`
--

CREATE TABLE `admin_menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `type` varchar(191) DEFAULT NULL,
  `path` varchar(191) DEFAULT NULL,
  `icon` varchar(191) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `sorting` int(11) NOT NULL DEFAULT 0,
  `sql_query` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_menus`
--

INSERT INTO `admin_menus` (`id`, `name`, `type`, `path`, `icon`, `parent_id`, `is_active`, `sorting`, `sql_query`, `created_at`, `updated_at`) VALUES
(1, 'Manage Content', 'Route', 'getManageCMS', 'fa fa-th-list', 0, 1, 2, NULL, '2023-11-23 06:21:48', '2024-06-15 02:39:56'),
(2, 'Manage Email Templates', 'Route', 'getIndexEmailTemplate', 'fa fa-envelope', 0, 1, 4, NULL, '2023-11-23 06:21:48', '2024-06-14 06:11:38'),
(3, 'Settings', 'URL', '#', 'ri-settings-2-line', 0, 1, 6, NULL, '2023-11-23 06:21:48', '2024-06-19 03:53:06'),
(4, 'General Settings', 'Route', 'getGeneralSettings', NULL, 3, 1, 1, NULL, '2023-11-23 06:21:48', NULL),
(5, 'Manage Category', 'Route', 'getManageCategory', 'fa fa-th-list', 0, 1, 1, NULL, '2024-06-13 00:08:33', '2024-06-14 02:10:27'),
(6, 'Manage Advertisement', 'Route', 'getManageAdv', 'fa fa-th-list', 0, 1, 2, NULL, '2024-06-14 02:28:52', '2024-06-14 05:53:27'),
(7, 'Manage Member', 'Route', 'getManageMem', 'fa fa-users', 0, 1, 3, NULL, '2024-06-14 06:09:35', '2024-06-14 06:11:06'),
(8, 'Manage Member Group', 'Route', 'getManageGroup', 'fa fa-users', 0, 1, 1, NULL, '2024-06-19 03:52:03', '2024-06-21 22:49:51'),
(9, 'Manage Meeting', 'Route', 'getManageMeeting', 'fa fa-calendar-check-o', 0, 1, 3, NULL, '2024-06-21 23:31:37', '2024-06-22 00:05:56');

-- --------------------------------------------------------

--
-- Table structure for table `admin_privileges`
--

CREATE TABLE `admin_privileges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `is_superadmin` tinyint(4) NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `user_ip` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_privileges`
--

INSERT INTO `admin_privileges` (`id`, `name`, `is_superadmin`, `created_by`, `updated_by`, `user_ip`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 1, 1, 1, '::1', '2023-11-23 06:21:48', '2024-06-21 23:34:27'),
(3, 'Super Admin', 0, 1, 1, '::1', '2024-06-15 02:11:05', '2024-06-15 03:46:42');

-- --------------------------------------------------------

--
-- Table structure for table `admin_privileges_roles`
--

CREATE TABLE `admin_privileges_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_admin_privileges` bigint(20) UNSIGNED NOT NULL,
  `id_admin_menus` int(11) DEFAULT NULL,
  `is_visible` tinyint(4) DEFAULT NULL,
  `is_create` tinyint(4) DEFAULT NULL,
  `is_read` tinyint(4) DEFAULT NULL,
  `is_edit` tinyint(4) DEFAULT NULL,
  `is_delete` tinyint(4) DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `user_ip` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_privileges_roles`
--

INSERT INTO `admin_privileges_roles` (`id`, `id_admin_privileges`, `id_admin_menus`, `is_visible`, `is_create`, `is_read`, `is_edit`, `is_delete`, `created_by`, `updated_by`, `user_ip`, `created_at`, `updated_at`) VALUES
(119, 1, 4, 1, 1, 1, 1, 0, 1, NULL, NULL, '2024-06-21 23:34:27', NULL),
(118, 1, 9, 1, 1, 1, 1, 0, 1, NULL, NULL, '2024-06-21 23:34:27', NULL),
(117, 1, 3, 1, 1, 1, 1, 0, 1, NULL, NULL, '2024-06-21 23:34:27', NULL),
(116, 1, 2, 1, 1, 1, 1, 1, 1, NULL, NULL, '2024-06-21 23:34:27', NULL),
(115, 1, 7, 1, 1, 1, 1, 0, 1, NULL, NULL, '2024-06-21 23:34:27', NULL),
(43, 3, 7, 1, 1, 1, 1, 0, 1, NULL, NULL, '2024-06-15 03:46:42', NULL),
(114, 1, 6, 1, 1, 1, 1, 1, 1, NULL, NULL, '2024-06-21 23:34:27', NULL),
(113, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL, '2024-06-21 23:34:27', NULL),
(112, 1, 8, 1, 1, 1, 0, 0, 1, NULL, NULL, '2024-06-21 23:34:27', NULL),
(42, 3, 6, 1, 1, 1, 1, 0, 1, NULL, NULL, '2024-06-15 03:46:42', NULL),
(41, 3, 1, 1, 1, 1, 1, 0, 1, NULL, NULL, '2024-06-15 03:46:42', NULL),
(40, 3, 5, 1, 1, 1, 1, 0, 1, NULL, NULL, '2024-06-15 03:46:42', NULL),
(111, 1, 5, 1, 1, 1, 1, 1, 1, NULL, NULL, '2024-06-21 23:34:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_settings`
--

CREATE TABLE `admin_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appname` varchar(191) NOT NULL,
  `logo` varchar(191) DEFAULT NULL,
  `favicon` varchar(191) DEFAULT NULL,
  `site_email` varchar(191) DEFAULT NULL,
  `site_address` varchar(191) DEFAULT NULL,
  `site_phone_number` varchar(191) DEFAULT NULL,
  `site_about` text DEFAULT NULL,
  `facebook_link` varchar(191) DEFAULT NULL,
  `instagram_link` varchar(191) DEFAULT NULL,
  `twitter_link` varchar(191) DEFAULT NULL,
  `linkedin_link` varchar(191) DEFAULT NULL,
  `youtube_link` varchar(191) DEFAULT NULL,
  `maintenance_mode` tinyint(4) NOT NULL DEFAULT 0,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `user_ip` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_settings`
--

INSERT INTO `admin_settings` (`id`, `appname`, `logo`, `favicon`, `site_email`, `site_address`, `site_phone_number`, `site_about`, `facebook_link`, `instagram_link`, `twitter_link`, `linkedin_link`, `youtube_link`, `maintenance_mode`, `created_by`, `updated_by`, `user_ip`, `created_at`, `updated_at`) VALUES
(1, 'Lions Club', NULL, NULL, 'admin@email.com', 'kolkata', '1236547896', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 1, NULL, '2023-11-23 06:21:48', '2024-06-13 09:16:35');

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `member_category_id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `photo` varchar(191) DEFAULT NULL,
  `email` varchar(191) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `password` varchar(191) DEFAULT NULL,
  `id_admin_privileges` bigint(20) UNSIGNED NOT NULL,
  `spouse_name` varchar(255) DEFAULT NULL,
  `contact_info` text NOT NULL,
  `other_information` text DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `date_of_weding` date DEFAULT NULL,
  `member_type` tinyint(4) NOT NULL DEFAULT 3 COMMENT '1=super admin,2=admin,3=member',
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `user_ip` varchar(45) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `member_category_id`, `name`, `photo`, `email`, `mobile`, `password`, `id_admin_privileges`, `spouse_name`, `contact_info`, `other_information`, `date_of_birth`, `date_of_weding`, `member_type`, `created_by`, `updated_by`, `user_ip`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Admin', 'uploads/images/profile/img-1700740854.jpg', 'admin@gmail.com', '', '$2y$12$eVP/F8u5922rsS1Q/ZUuheZCba5.96b0f14cGG0SlXchWrpp2RxCS', 1, NULL, '', '', NULL, NULL, 1, 1, 1, NULL, 1, '2023-11-23 06:21:48', '2023-11-23 06:30:54'),
(2, 1, 'Jone Doe', 'admin/uploads/images/profile_image/15-06-2024/profile_image-1718432569.jpg', 'john.dev@gmail.com', '9903350980', NULL, 0, 'Nila Doe', 'Akshya Nagar 1st Block 1st Cross, Rammurthy nagar, Bangalore-560016', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,', '2024-06-11', '2024-06-18', 3, 1, 1, '::1', 1, '2024-06-14 22:52:17', '2024-06-15 01:55:55'),
(3, 3, 'Joy Dev', 'admin/uploads/images/profile_image/15-06-2024/profile_image-1718436511.png', 'johndev@gmail.com', '9903350934', NULL, 0, 'Nila Doe', 'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem', NULL, '2024-06-12', '2000-10-17', 3, 1, 1, '::1', 1, '2024-06-15 01:02:40', '2024-06-21 23:11:12'),
(4, 1, 'Chandan Dhar', '', 'superadmin@gmail.com', '2389658745', '$2y$12$CBJGMUKzznoA6.otU0o2GeCDRkEa1P8Oj0Eg3Jaw6LEpcPyn2htSm', 3, 'Nila Doe', 'wb,kolkata', NULL, '2003-10-28', '2020-06-23', 2, 1, 1, '::1', 1, '2024-06-15 02:31:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `advertisement`
--

CREATE TABLE `advertisement` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `banner_image` varchar(255) NOT NULL,
  `short_description` text NOT NULL,
  `description` longtext NOT NULL,
  `doc_link` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `publish_date` date DEFAULT NULL,
  `ip_address` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `advertisement`
--

INSERT INTO `advertisement` (`id`, `title`, `banner_image`, `short_description`, `description`, `doc_link`, `status`, `slug`, `publish_date`, `ip_address`, `created_at`, `updated_at`, `updated_by`, `created_by`) VALUES
(3, 'What is Lorem Ipsum?', 'admin/uploads/images/advertisement/14-06-2024/featured-image-1718362108.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', NULL, 0, 'what-is-lorem-ipsum', '2024-06-23', '::1', '2024-06-14 10:48:28', '2024-06-19 05:34:41', 1, 1),
(4, 'What is Lorem Ipsum2', 'admin/uploads/images/advertisement/19-06-2024/featured-image-1718781698.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', NULL, 1, 'what-is-lorem-ipsum2', '2024-06-28', '::1', '2024-06-19 04:56:15', '2024-06-19 07:21:38', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cms_email_templates`
--

CREATE TABLE `cms_email_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(250) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `subject` varchar(250) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `from_name` varchar(250) DEFAULT NULL,
  `from_email` varchar(250) DEFAULT NULL,
  `cc_email` varchar(250) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cms_logs`
--

CREATE TABLE `cms_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ipaddress` varchar(45) NOT NULL,
  `useragent` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `id_cms_users` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_logs`
--

INSERT INTO `cms_logs` (`id`, `ipaddress`, `useragent`, `url`, `description`, `details`, `id_cms_users`, `created_at`, `updated_at`) VALUES
(1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/logout', 'admin@gmail.com logout', '', 1, '2023-11-23 06:33:55', NULL),
(2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/logout', 'admin@gmail.com logout', '', 1, '2023-11-23 06:35:47', NULL),
(3, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'http://localhost/lionclub/public/admin/logout', 'admin@gmail.com logout', '', 1, '2024-06-13 06:20:33', NULL),
(4, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'http://localhost/lionclub/public/admin/manage-cms/action-selected', 'Updated data 1 by Admin ip: ::1', '', 1, '2024-06-14 02:11:42', NULL),
(5, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'http://localhost/lionclub/public/admin/manage-cms/action-selected', 'Updated data 1 by Admin ip: ::1', '', 1, '2024-06-14 02:11:49', NULL),
(6, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'http://localhost/lionclub/public/admin/manage-category/action-selected', 'Updated data 1 by Admin ip: ::1', '', 1, '2024-06-14 02:15:40', NULL),
(7, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'http://localhost/lionclub/public/admin/manage-category/action-selected', 'Updated data 1 by Admin ip: ::1', '', 1, '2024-06-14 02:15:46', NULL),
(8, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'http://localhost/lionclub/public/admin/manage-category/action-selected', 'Updated data 1 by Admin ip: ::1', '', 1, '2024-06-14 02:15:55', NULL),
(9, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'http://localhost/lionclub/public/admin/manage-advertisement/action-selected', 'Updated data 2,1 by Admin ip: ::1', '', 1, '2024-06-14 05:10:04', NULL),
(10, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'http://localhost/lionclub/public/admin/manage-advertisement/action-selected', 'Updated data 2,1 by Admin ip: ::1', '', 1, '2024-06-14 05:10:12', NULL),
(11, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'http://localhost/lionclub/public/admin/logout', 'admin@gmail.com logout', '', 1, '2024-06-14 08:49:44', NULL),
(12, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'http://localhost/lionclub/public/admin/logout', 'admin@gmail.com logout', '', 1, '2024-06-14 09:01:32', NULL),
(13, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'http://localhost/lionclub/public/admin/logout', 'admin@gmail.com logout', '', 1, '2024-06-14 09:03:42', NULL),
(14, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'http://localhost/lionclub/public/admin/logout', 'admin@gmail.com logout', '', 1, '2024-06-14 09:11:06', NULL),
(15, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'http://localhost/lionclub/public/admin/manage-category/action-selected', 'Updated data 1 by Admin ip: ::1', '', 1, '2024-06-15 00:20:21', NULL),
(16, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'http://localhost/lionclub/public/admin/manage-member/action-selected', 'Updated data 2 by Admin ip: ::1', '', 1, '2024-06-15 00:40:48', NULL),
(17, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'http://localhost/lionclub/public/admin/manage-member/action-selected', 'Updated data 2 by Admin ip: ::1', '', 1, '2024-06-15 00:40:54', NULL),
(18, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'http://localhost/lionclub/public/admin/manage-member/action-selected', 'Updated data 3,2 by Admin ip: ::1', '', 1, '2024-06-15 01:55:18', NULL),
(19, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'http://localhost/lionclub/public/admin/manage-member/action-selected', 'Updated data 3,2 by Admin ip: ::1', '', 1, '2024-06-15 01:55:35', NULL),
(20, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'http://localhost/lionclub/public/admin/manage-member/action-selected', 'Updated data 3,2 by Admin ip: ::1', '', 1, '2024-06-15 01:55:55', NULL),
(21, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'http://localhost/lionclub/public/admin/logout', 'admin@gmail.com logout', '', 1, '2024-06-15 03:46:45', NULL),
(22, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'http://localhost/lionclub/public/admin/logout', 'superadmin@gmail.com logout', '', 4, '2024-06-15 03:52:07', NULL),
(23, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'http://localhost/lionclub/public/admin/logout', 'admin@gmail.com logout', '', 1, '2024-06-15 03:53:05', NULL),
(24, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'http://localhost/lionclub/public/admin/logout', 'admin@gmail.com logout', '', 1, '2024-06-18 01:16:25', NULL),
(25, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'http://localhost/lionclub/public/admin/manage-advertisement/action-selected', 'Updated data 4,3 by Admin ip: ::1', '', 1, '2024-06-19 00:03:31', NULL),
(26, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'http://localhost/lionclub/public/admin/manage-advertisement/action-selected', 'Updated data 4,3 by Admin ip: ::1', '', 1, '2024-06-19 00:03:48', NULL),
(27, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'http://localhost/lionclub/public/admin/manage-advertisement/action-selected', 'Updated data 4,3 by Admin ip: ::1', '', 1, '2024-06-19 00:04:41', NULL),
(28, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'http://localhost/lionclub/public/admin/logout', 'admin@gmail.com logout', '', 1, '2024-06-19 03:46:00', NULL),
(29, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'http://localhost/lionclub/public/admin/logout', 'admin@gmail.com logout', '', 1, '2024-06-19 04:24:05', NULL),
(30, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'http://localhost/lionclub/public/admin/manage-category/action-selected', 'Updated data 1 by Admin ip: ::1', '', 1, '2024-06-19 08:27:36', NULL),
(31, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'http://localhost/lionclub/public/admin/manage-group/action-selected', 'Updated data 2,1 by Admin ip: ::1', '', 1, '2024-06-19 09:43:34', NULL),
(32, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'http://localhost/lionclub/public/admin/manage-group/action-selected', 'Updated data 2,1 by Admin ip: ::1', '', 1, '2024-06-19 09:43:40', NULL),
(33, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'http://localhost/lionclub/public/admin/logout', 'admin@gmail.com logout', '', 1, '2024-06-19 09:53:06', NULL),
(34, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'http://localhost/lionclub/public/admin/logout', 'admin@gmail.com logout', '', 1, '2024-06-20 06:22:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cms_meeting`
--

CREATE TABLE `cms_meeting` (
  `id` int(11) NOT NULL,
  `meeting_title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `feature_image` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `agenda` longtext DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `meeting_date` date NOT NULL,
  `meeting_time` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `user_ip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cms_meeting`
--

INSERT INTO `cms_meeting` (`id`, `meeting_title`, `slug`, `feature_image`, `location`, `agenda`, `description`, `meeting_date`, `meeting_time`, `created_at`, `updated_at`, `created_by`, `updated_by`, `status`, `user_ip`) VALUES
(1, 'What is Lorem Ipsum', 'what-is-lorem-ipsum-2', 'admin/uploads/images/meeting_image/22-06-2024/profile_image-1719059050.jpg', 'California', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<ol>\r\n	<li><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry.</li>\r\n	<li><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry.</li>\r\n	<li><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry.</li>\r\n</ol>', '2024-06-29', '09:25 PM', '2024-06-22 11:42:18', '2024-06-22 15:37:35', 1, 1, 1, '::1'),
(2, 'Annual Sports Meeting', 'annual-sports-meeting', '', 'Dumdum', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<ol>\r\n	<li>&nbsp;<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry</li>\r\n	<li><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry</li>\r\n	<li><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry</li>\r\n</ol>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '2024-08-23', '06:00 PM', '2024-06-22 16:11:14', '2024-06-22 16:11:14', 1, 1, 0, '::1');

-- --------------------------------------------------------

--
-- Table structure for table `cms_pages`
--

CREATE TABLE `cms_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_title` varchar(191) NOT NULL,
  `page_slug` varchar(191) NOT NULL,
  `page_content` longtext DEFAULT NULL,
  `featured_image` varchar(191) DEFAULT NULL,
  `meta_title` varchar(191) NOT NULL,
  `meta_keywords` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `user_ip` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cms_page_contents`
--

CREATE TABLE `cms_page_contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cms_pages_id` bigint(20) UNSIGNED NOT NULL,
  `section` varchar(191) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_settings`
--

CREATE TABLE `email_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email_sender` varchar(191) NOT NULL,
  `mail_driver` varchar(191) NOT NULL,
  `smtp_host` varchar(191) NOT NULL,
  `smtp_port` varchar(191) NOT NULL,
  `smtp_username` varchar(191) NOT NULL,
  `smtp_password` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groupwise_member_list`
--

CREATE TABLE `groupwise_member_list` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meeting_attachment`
--

CREATE TABLE `meeting_attachment` (
  `id` int(11) NOT NULL,
  `meeting_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_url` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meeting_attandence`
--

CREATE TABLE `meeting_attandence` (
  `id` int(11) NOT NULL,
  `meeting_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0=absent,1=present',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` bigint(20) NOT NULL,
  `created_by` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meeting_email`
--

CREATE TABLE `meeting_email` (
  `id` int(11) NOT NULL,
  `meeting_id` int(11) NOT NULL,
  `email_template_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `date` date NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `create_at` datetime NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0=not sent,1=sent'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meeting_email_log`
--

CREATE TABLE `meeting_email_log` (
  `id` int(11) NOT NULL,
  `meeting_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `email_template_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1=sent,0=not sent',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meeting_question`
--

CREATE TABLE `meeting_question` (
  `id` int(11) NOT NULL,
  `meeting_id` tinyint(4) NOT NULL,
  `question_id` tinyint(4) NOT NULL,
  `crated_by` tinyint(4) NOT NULL,
  `updated_by` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member_category`
--

CREATE TABLE `member_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` bigint(11) NOT NULL,
  `updated_by` bigint(11) NOT NULL,
  `user_ip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member_category`
--

INSERT INTO `member_category` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`, `user_ip`) VALUES
(1, 'Widow', 'widow', 1, '2024-06-14 04:53:44', '2024-06-19 14:42:20', 1, 1, '::1'),
(2, 'Divorced', 'divorced', 1, '2024-06-19 13:58:06', '2024-06-19 14:41:39', 1, 1, '::1'),
(3, 'Unmarried', 'unmarried', 1, '2024-06-19 13:58:15', '2024-06-19 14:41:13', 1, 1, '::1'),
(4, 'Married', 'married-2', 1, '2024-06-19 13:58:25', '2024-06-19 14:58:27', 1, 1, '::1');

-- --------------------------------------------------------

--
-- Table structure for table `member_group`
--

CREATE TABLE `member_group` (
  `id` int(11) NOT NULL,
  `member_category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `user_ip` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` bigint(20) NOT NULL,
  `created_by` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member_group`
--

INSERT INTO `member_group` (`id`, `member_category_id`, `name`, `slug`, `status`, `user_ip`, `created_at`, `updated_at`, `updated_by`, `created_by`) VALUES
(1, 1, 'Silver', '2', 1, '::1', '2024-06-19 14:43:20', '2024-06-19 15:13:40', 1, 1),
(2, 4, 'Gold', '4', 1, '::1', '2024-06-19 14:44:12', '2024-06-19 15:13:40', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `member_polling_feedbacks`
--

CREATE TABLE `member_polling_feedbacks` (
  `id` int(11) NOT NULL,
  `meeting_questionId` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `select_option` int(11) NOT NULL,
  `polling_feedback` text NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_08_04_092124_create_admin_privileges_table', 1),
(6, '2022_08_04_092144_create_admin_privileges_roles_table', 1),
(7, '2022_08_04_092257_create_admin_users_table', 1),
(8, '2022_08_04_100101_create_admin_settings_table', 1),
(9, '2022_08_08_071054_create_email_settings_table', 1),
(10, '2022_08_08_073736_create_cms_pages_table', 1),
(11, '2022_08_08_073833_create_cms_page_contents_table', 1),
(12, '2023_11_23_110856_create_admin_menus_table', 1),
(13, '2023_11_23_114521_create_cms_email_templates_table', 1),
(14, '2023_11_23_120145_create_cms_logs_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `question_description` text NOT NULL,
  `question_type` tinyint(4) NOT NULL COMMENT '1=single choice,2=multi choice,3=fill in the blank',
  `option1` text NOT NULL,
  `option2` text NOT NULL,
  `option3` text NOT NULL,
  `option4` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` tinyint(4) NOT NULL,
  `updated_by` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `ip_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_menus`
--
ALTER TABLE `admin_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_privileges`
--
ALTER TABLE `admin_privileges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_privileges_roles`
--
ALTER TABLE `admin_privileges_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_settings`
--
ALTER TABLE `admin_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_users_email_unique` (`email`),
  ADD KEY `mobile` (`mobile`(250)),
  ADD KEY `member_category_id` (`member_category_id`);

--
-- Indexes for table `advertisement`
--
ALTER TABLE `advertisement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_email_templates`
--
ALTER TABLE `cms_email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_logs`
--
ALTER TABLE `cms_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_meeting`
--
ALTER TABLE `cms_meeting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_pages`
--
ALTER TABLE `cms_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_page_contents`
--
ALTER TABLE `cms_page_contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_settings`
--
ALTER TABLE `email_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `groupwise_member_list`
--
ALTER TABLE `groupwise_member_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meeting_attachment`
--
ALTER TABLE `meeting_attachment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meeting_id` (`meeting_id`);

--
-- Indexes for table `meeting_attandence`
--
ALTER TABLE `meeting_attandence`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_meetingID` (`meeting_id`),
  ADD KEY `FK_meeting_userID` (`member_id`);

--
-- Indexes for table `meeting_email`
--
ALTER TABLE `meeting_email`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meeting_id` (`meeting_id`),
  ADD KEY `email_template_id` (`email_template_id`);

--
-- Indexes for table `meeting_email_log`
--
ALTER TABLE `meeting_email_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meeting_question`
--
ALTER TABLE `meeting_question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_category`
--
ALTER TABLE `member_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_group`
--
ALTER TABLE `member_group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_categoryID` (`member_category_id`);

--
-- Indexes for table `member_polling_feedbacks`
--
ALTER TABLE `member_polling_feedbacks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meeting_questionId` (`meeting_questionId`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_menus`
--
ALTER TABLE `admin_menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `admin_privileges`
--
ALTER TABLE `admin_privileges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admin_privileges_roles`
--
ALTER TABLE `admin_privileges_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `admin_settings`
--
ALTER TABLE `admin_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `advertisement`
--
ALTER TABLE `advertisement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cms_email_templates`
--
ALTER TABLE `cms_email_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cms_logs`
--
ALTER TABLE `cms_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `cms_meeting`
--
ALTER TABLE `cms_meeting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cms_pages`
--
ALTER TABLE `cms_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cms_page_contents`
--
ALTER TABLE `cms_page_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_settings`
--
ALTER TABLE `email_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groupwise_member_list`
--
ALTER TABLE `groupwise_member_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meeting_attachment`
--
ALTER TABLE `meeting_attachment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meeting_attandence`
--
ALTER TABLE `meeting_attandence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meeting_email`
--
ALTER TABLE `meeting_email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meeting_email_log`
--
ALTER TABLE `meeting_email_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meeting_question`
--
ALTER TABLE `meeting_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member_category`
--
ALTER TABLE `member_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `member_group`
--
ALTER TABLE `member_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `member_polling_feedbacks`
--
ALTER TABLE `member_polling_feedbacks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `meeting_attachment`
--
ALTER TABLE `meeting_attachment`
  ADD CONSTRAINT `meeting_attachment_ibfk_1` FOREIGN KEY (`meeting_id`) REFERENCES `cms_meeting` (`id`);

--
-- Constraints for table `meeting_attandence`
--
ALTER TABLE `meeting_attandence`
  ADD CONSTRAINT `FK_meetingID` FOREIGN KEY (`meeting_id`) REFERENCES `cms_meeting` (`id`),
  ADD CONSTRAINT `FK_meeting_userID` FOREIGN KEY (`member_id`) REFERENCES `admin_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `meeting_email`
--
ALTER TABLE `meeting_email`
  ADD CONSTRAINT `meeting_email_ibfk_1` FOREIGN KEY (`meeting_id`) REFERENCES `cms_meeting` (`id`),
  ADD CONSTRAINT `meeting_email_ibfk_2` FOREIGN KEY (`email_template_id`) REFERENCES `cms_email_templates` (`id`);

--
-- Constraints for table `member_group`
--
ALTER TABLE `member_group`
  ADD CONSTRAINT `FK_categoryID` FOREIGN KEY (`member_category_id`) REFERENCES `member_category` (`id`);

--
-- Constraints for table `member_polling_feedbacks`
--
ALTER TABLE `member_polling_feedbacks`
  ADD CONSTRAINT `member_polling_feedbacks_ibfk_1` FOREIGN KEY (`meeting_questionId`) REFERENCES `meeting_question` (`id`),
  ADD CONSTRAINT `member_polling_feedbacks_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
