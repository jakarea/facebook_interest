-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Oct 02, 2021 at 08:24 AM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `interest`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `keywords`
--

CREATE TABLE `keywords` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `keyword` text COLLATE utf8mb4_unicode_ci,
  `language` text COLLATE utf8mb4_unicode_ci,
  `hit` int(11) NOT NULL DEFAULT '1',
  `type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `keywords`
--

INSERT INTO `keywords` (`id`, `user_id`, `keyword`, `language`, `hit`, `type`, `created_at`, `updated_at`) VALUES
(12, 2, 'realme', NULL, 1, NULL, NULL, NULL),
(13, 2, 'realme', NULL, 1, NULL, NULL, NULL),
(14, 3, 'facebook', NULL, 1, NULL, NULL, NULL),
(15, 3, 'laravel 8', NULL, 1, NULL, NULL, NULL),
(16, 3, 'home', NULL, 1, NULL, NULL, NULL),
(17, 3, 'home', NULL, 1, NULL, NULL, NULL),
(18, 3, 'home', NULL, 1, NULL, NULL, NULL),
(19, 3, 'home', NULL, 1, NULL, NULL, NULL),
(20, 3, 'yes', NULL, 1, NULL, NULL, NULL),
(21, 3, 'dekha ti', NULL, 1, NULL, NULL, NULL),
(22, 3, 'fe', NULL, 1, NULL, NULL, NULL),
(23, 3, 'mouse', NULL, 1, NULL, NULL, NULL),
(32, 3, 'ki sosmoss', 'en_US', 3, NULL, '2021-09-23 10:34:10', '2021-09-23 10:34:24'),
(33, 3, 'Dhaka', 'en_US', 6, NULL, '2021-09-23 18:34:48', '2021-09-23 19:03:39'),
(34, 3, 'Dhaka', 'fr_FR', 4, NULL, '2021-09-23 18:35:26', '2021-09-23 18:38:08'),
(35, 3, 'd', 'en_US', 1, NULL, '2021-09-23 19:03:51', '2021-09-23 19:03:51');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_09_14_045628_create_keywords_table', 1);

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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `facebook_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token` varchar(560) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `facebook_id`, `name`, `email`, `access_token`, `provider_id`, `avatar`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, '', 'Anik Acharjya', 'acharjee180@gmail.com', NULL, '3078103012420805', 'https://graph.facebook.com/v3.3/3078103012420805/picture?type=normal', NULL, NULL, NULL, '2021-09-14 22:44:33', '2021-09-14 22:44:33'),
(3, '4116101975176041', 'Jakarea Parvez', '1632387123jakarea@yopmail.com', 'EAAqYKTWtLV0BAK8vLTJx4j9Qk3E5snPKs4Kbo0S5ZBptvoacds6ZB6lgdVcGgRscU26uZBaNCtgCrlZBOII72dZBf9v5tNzeOl3CNlBXZBvcWSTnIA7djB8hjszGF0QfVZCbyTZCQGGCWFdHsvBWZBaFXsWtZAuxkDeVJHwlWNDLS4oYwIZB8vMcjGom4F9WE1Q6lHPrNEfNPC2cgMeYAb6LZCWQP892F8ZCQ3rLRK3VTdf53Bgbmu6nHS20gtyI8tFGhtdoZD', NULL, 'https://graph.facebook.com/v3.3/4116101975176041/picture?type=normal', NULL, NULL, NULL, '2021-09-23 02:52:03', '2021-09-23 02:52:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keywords`
--
ALTER TABLE `keywords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_avatar_unique` (`avatar`),
  ADD UNIQUE KEY `users_provider_id_unique` (`provider_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keywords`
--
ALTER TABLE `keywords`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
