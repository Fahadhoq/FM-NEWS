-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2020 at 06:06 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fm_blogging`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'sports', 'sports', 1, '2020-07-28 10:40:01', '2020-07-28 11:04:40'),
(2, 'news', 'news', 1, '2020-07-28 10:40:22', '2020-07-28 10:40:22'),
(3, 'international', 'international', 1, '2020-07-28 10:40:33', '2020-07-28 10:40:33'),
(4, 'laravel', 'laravel', 1, '2020-07-29 21:48:39', '2020-07-29 21:48:47');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `is_active`, `email`, `body`, `created_at`, `updated_at`) VALUES
(8, 1, 1, 1, 'fahadulhoq@gmail.com', 'true nic pic', '2020-07-29 17:24:24', '2020-07-29 19:25:39'),
(9, 1, 1, 1, 'fahadulhoq@gmail.com', 'what happend', '2020-07-29 17:34:18', '2020-07-29 17:34:18'),
(12, 1, 2, 1, 'tomahoq@gmail.com', 'k bosche?', '2020-07-30 18:22:12', '2020-07-30 18:22:12');

-- --------------------------------------------------------

--
-- Table structure for table `comment_replies`
--

CREATE TABLE `comment_replies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` int(100) NOT NULL,
  `comment_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comment_replies`
--

INSERT INTO `comment_replies` (`id`, `post_id`, `comment_id`, `user_id`, `is_active`, `email`, `body`, `created_at`, `updated_at`) VALUES
(11, 1, 8, 1, 1, 'fahadulhoq@gmail.com', 'nai', '2020-07-29 18:10:37', '2020-07-29 18:10:37'),
(12, 1, 9, 1, 1, 'fahadulhoq@gmail.com', 'nothing', '2020-07-29 18:12:16', '2020-07-29 18:12:16');

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
(9, '2014_10_12_100000_create_password_resets_table', 1),
(10, '2020_06_26_170909_create_users_table', 1),
(11, '2020_06_26_171517_create_categories_table', 1),
(12, '2020_06_26_171831_create_posts_table', 1),
(13, '2020_07_07_080737_create_notifications_table', 1),
(14, '2020_07_24_165813_create_roles_table', 1),
(15, '2020_07_26_231829_create_comments_table', 1),
(16, '2020_07_26_232024_create_comment_replies_table', 1),
(19, '2020_07_30_035610_create_payments_table', 2),
(20, '2020_07_30_040319_create_payment_categories_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('26b9cc89-7fe2-43ce-9bb3-9ebe19cc93dd', 'App\\Notifications\\NewPostNotification', 'App\\User', 3, '{\"PostTittle\":\"sakib is a bad boy\"}', NULL, '2020-07-28 10:41:03', '2020-07-28 10:41:03'),
('36747ae8-6251-41c5-b25a-f51b1517df5c', 'App\\Notifications\\NewPostNotification', 'App\\User', 1, '{\"PostTittle\":\"fahad\"}', '2020-07-29 20:21:21', '2020-07-29 20:16:11', '2020-07-29 20:21:21'),
('37d0dc70-14e3-4f06-99d2-b976754dcef9', 'App\\Notifications\\NewPostNotification', 'App\\User', 2, '{\"PostTittle\":\"cse class\"}', '2020-07-29 20:25:45', '2020-07-29 19:52:21', '2020-07-29 20:25:45'),
('3b021c48-a2d2-4e8e-974d-102c74eb018a', 'App\\Notifications\\NewPostNotification', 'App\\User', 3, '{\"PostTittle\":\"slug test2\"}', NULL, '2020-07-28 10:41:32', '2020-07-28 10:41:32'),
('43dc7e79-900f-4991-ab18-8010df79f7fd', 'App\\Notifications\\NewPostNotification', 'App\\User', 3, '{\"PostTittle\":\"cse class\"}', NULL, '2020-07-29 19:52:21', '2020-07-29 19:52:21'),
('4ba23ca4-17e5-492c-b824-6b3f8cdacdce', 'App\\Notifications\\NewPostNotification', 'App\\User', 3, '{\"PostTittle\":\"fahad\"}', NULL, '2020-07-29 20:16:11', '2020-07-29 20:16:11'),
('821cb66f-0595-4260-90f1-f755507d3a0f', 'App\\Notifications\\NewPostNotification', 'App\\User', 1, '{\"PostTittle\":\"sakib is a bad boy\"}', '2020-07-28 10:57:07', '2020-07-28 10:41:03', '2020-07-28 10:57:07'),
('aa8c2b57-42df-4c95-aef1-6d9c5072a2e5', 'App\\Notifications\\NewPostNotification', 'App\\User', 1, '{\"PostTittle\":\"cse class\"}', '2020-07-29 20:21:21', '2020-07-29 19:52:21', '2020-07-29 20:21:21'),
('bf2f6d7e-ceb3-423f-8266-4f62690f4ddd', 'App\\Notifications\\NewPostNotification', 'App\\User', 2, '{\"PostTittle\":\"slug test2\"}', '2020-07-29 19:38:50', '2020-07-28 10:41:32', '2020-07-29 19:38:50'),
('c28e1fb5-8145-4942-ba2c-ce9ca7d560ee', 'App\\Notifications\\NewPostNotification', 'App\\User', 1, '{\"PostTittle\":\"slug test2\"}', '2020-07-28 10:57:07', '2020-07-28 10:41:32', '2020-07-28 10:57:07'),
('dd4db457-0b39-4b4d-9a44-96acea728ce3', 'App\\Notifications\\NewPostNotification', 'App\\User', 2, '{\"PostTittle\":\"fahad\"}', '2020-07-29 20:25:45', '2020-07-29 20:16:11', '2020-07-29 20:25:45'),
('f2d1b232-5c45-48f8-9a2f-92fb3f8f76b2', 'App\\Notifications\\NewPostNotification', 'App\\User', 2, '{\"PostTittle\":\"sakib is a bad boy\"}', '2020-07-29 19:38:50', '2020-07-28 10:41:03', '2020-07-29 19:38:50');

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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `payment_category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `payment_category_id`, `created_at`, `updated_at`) VALUES
(25, 1, 2, '2020-08-03 23:50:37', '2020-08-03 23:50:37'),
(26, 1, 2, '2020-08-03 23:53:34', '2020-08-03 23:53:34'),
(27, 1, 2, '2020-08-03 23:53:43', '2020-08-03 23:53:43'),
(28, 1, 2, '2020-08-04 00:20:46', '2020-08-04 00:20:46'),
(29, 1, 2, '2020-08-04 00:23:14', '2020-08-04 00:23:14'),
(30, 1, 2, '2020-08-04 00:23:20', '2020-08-04 00:23:20'),
(31, 3, 2, '2020-08-04 00:23:54', '2020-08-04 00:23:54'),
(32, 3, 2, '2020-08-04 00:29:36', '2020-08-04 00:29:36'),
(33, 1, 2, '2020-08-04 00:29:53', '2020-08-04 00:29:53');

-- --------------------------------------------------------

--
-- Table structure for table `payment_categories`
--

CREATE TABLE `payment_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_categories`
--

INSERT INTO `payment_categories` (`id`, `name`, `slug`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(2, 'user', 'user', 100, 1, '2020-07-30 19:33:15', '2020-07-30 19:38:05'),
(3, 'author', 'author', 500, 1, '2020-07-30 19:38:52', '2020-07-30 19:38:52');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `tittle` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail_path` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `category_id`, `tittle`, `slug`, `content`, `thumbnail_path`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'sakib is a bad boy', 'sakib-is-a-bad-boy', 'scd mdv', 'post_5f20551e22d122.63714595S31jAMiXdv.JPG', 1, '2020-07-28 10:41:02', '2020-07-29 17:37:01');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'user', NULL, NULL),
(2, 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified` tinyint(4) NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `email_verification_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(96) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` tinyint(4) NOT NULL DEFAULT '1',
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `is_pay` bigint(100) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `full_name`, `user_name`, `image`, `email`, `email_verified`, `email_verified_at`, `email_verification_token`, `password`, `phone`, `role_id`, `active`, `is_pay`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'fahad', 'hoq', 'fahad hoq', 'fahad-hoq', 'user_5f2052d3e837a6.155543119VTjJmHcp9.JPG', 'fahadulhoq@gmail.com', 1, '2020-07-28 10:31:16', NULL, '$2y$10$TYchSyPPubf7xfhX02pq2.mkW65UGabJ6wi7RYValGzupHlnbE/Nm', '01827537225', 2, 1, 0, NULL, NULL, '2020-07-28 10:31:16', '2020-07-29 20:47:53'),
(2, 'Toma', 'hoq', 'Toma hoq', 'toma-hoq', 'user_5f20530bb8f9e4.66634839zFKaYtoeOZ.jpg', 'tomahoq@gmail.com', 1, '2020-07-28 10:31:16', NULL, '$2y$10$K8LtalI7MSEqrGeeRJPrL.ZkwXnZROONJrsI7ORT7ckdcUOGO6F26', '01817109985', 1, 0, 0, NULL, NULL, '2020-07-28 10:32:12', '2020-07-29 21:37:44'),
(3, 'Dr. Fahim', 'hoq', 'Dr. Fahim hoq', 'dr-fahim-hoq', 'user_5f20533c254880.17591051nR0t54wLyU.JPG', 'fahimhoq@gmail.com', 1, '2020-07-28 10:31:16', NULL, '$2y$10$DvegK1884WzSvXAuXwt7gOgL882QvF8vT/DFiKi3xENxqk56YZtbm', '01827537226', 1, 1, 1, NULL, NULL, '2020-07-28 10:33:00', '2020-07-28 10:33:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_post_id_foreign` (`post_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `comment_replies`
--
ALTER TABLE `comment_replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_replies_comment_id_foreign` (`comment_id`),
  ADD KEY `comment_replies_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_user_id_foreign` (`user_id`);

--
-- Indexes for table `payment_categories`
--
ALTER TABLE `payment_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`),
  ADD KEY `posts_user_id_foreign` (`user_id`),
  ADD KEY `posts_category_id_foreign` (`category_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `comment_replies`
--
ALTER TABLE `comment_replies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `payment_categories`
--
ALTER TABLE `payment_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comment_replies`
--
ALTER TABLE `comment_replies`
  ADD CONSTRAINT `comment_replies_comment_id_foreign` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_replies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
