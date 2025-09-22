-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 22, 2025 at 06:02 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-task`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint UNSIGNED NOT NULL,
  `guest_user_id` bigint UNSIGNED DEFAULT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'electronicss', 1, '2025-09-21 19:22:57', '2025-09-21 23:36:32'),
(2, 'Tank top-Blue', 1, '2025-09-21 19:23:06', '2025-09-21 19:23:06');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guest_users`
--

CREATE TABLE `guest_users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guest_users`
--

INSERT INTO `guest_users` (`id`, `name`, `email`, `phone`, `created_at`, `updated_at`) VALUES
(1, 'Abdelrahman Mohamed', 'Eyadomar.ok@gmail.com', '01118038076', '2025-09-22 02:02:50', '2025-09-22 02:02:50');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_09_20_113221_create_products_table', 1),
(6, '2025_09_20_113227_create_product_logs_table', 1),
(7, '2025_09_21_091810_create_guest_users_table', 1),
(8, '2025_09_21_091924_create_orders_table', 1),
(9, '2025_09_21_092209_create_carts_table', 1),
(10, '2025_09_21_094030_create_order_items_table', 1),
(11, '2025_09_21_215014_add_sale_voucher_to_product_log_table', 2),
(12, '2025_09_21_220234_add_description_to_products_table', 3),
(13, '2025_09_21_220606_create_categories_table', 4),
(14, '2025_09_21_221301_add_category_id_to_products_table', 4),
(15, '2025_09_21_224812_add_sale_to_products_table', 5),
(16, '2025_09_21_230035_update_action_column_in_product_logs_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `guest_user_id` bigint UNSIGNED DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `guest_user_id`, `total_amount`, `status`, `address`, `created_at`, `updated_at`) VALUES
(1, 1, 730.00, 'completed', 'العبور الحي التاسع شارع محمد عبدالمطلب متفرع من قوت القلوب', '2025-09-22 02:04:41', '2025-09-22 02:56:22'),
(2, 1, 100.00, 'pending', 'العبور الحي التاسع شارع محمد عبدالمطلب متفرع من قوت القلوب', '2025-09-22 02:07:31', '2025-09-22 02:07:31'),
(3, 1, 100.00, 'pending', 'العبور الحي التاسع شارع محمد عبدالمطلب متفرع من قوت القلوب', '2025-09-22 02:08:40', '2025-09-22 02:08:40'),
(4, 1, 50.00, 'pending', 'العبور الحي التاسع شارع محمد عبدالمطلب متفرع من قوت القلوب', '2025-09-22 02:08:46', '2025-09-22 02:08:46'),
(5, 1, 50.00, 'pending', 'العبور الحي التاسع شارع محمد عبدالمطلب متفرع من قوت القلوب', '2025-09-22 02:16:23', '2025-09-22 02:16:23');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 2, 50.00, '2025-09-22 02:04:41', '2025-09-22 02:04:41'),
(2, 1, 5, 1, 500.00, '2025-09-22 02:04:41', '2025-09-22 02:04:41'),
(3, 1, 4, 1, 80.00, '2025-09-22 02:04:41', '2025-09-22 02:04:41'),
(4, 1, 3, 1, 50.00, '2025-09-22 02:04:42', '2025-09-22 02:04:42'),
(5, 2, 3, 1, 50.00, '2025-09-22 02:07:31', '2025-09-22 02:07:31'),
(6, 2, 2, 1, 50.00, '2025-09-22 02:07:31', '2025-09-22 02:07:31'),
(7, 3, 3, 2, 50.00, '2025-09-22 02:08:40', '2025-09-22 02:08:40'),
(8, 4, 3, 1, 50.00, '2025-09-22 02:08:46', '2025-09-22 02:08:46'),
(9, 5, 2, 1, 50.00, '2025-09-22 02:16:23', '2025-09-22 02:16:23');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `sale` int UNSIGNED DEFAULT NULL,
  `quantity` int UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `image`, `price`, `sale`, `quantity`, `is_active`, `created_at`, `updated_at`, `deleted_at`, `category_id`) VALUES
(1, 'mustafa', 'da', 'products/zMchT0XasPTtPYxvUQF5eQQ90MzNimFQbuBFB3wE.png', 50.00, 50, 100, 0, '2025-09-21 19:42:31', '2025-09-22 01:31:48', NULL, 1),
(2, 'mustafa', 'da', 'products/OU93SvkuV6PjiCeP9qIDK4HEGxboovdaPkzFBbAs.png', 50.00, 50, 66, 1, '2025-09-21 19:42:44', '2025-09-22 02:16:23', NULL, 1),
(3, 'Tank top-Blue', 'dada', 'products/WJK2jIyTDqf1ROgMgAj0po8HS1wsJnZbR9EqdPRf.jpg', 50.00, NULL, 75, 1, '2025-09-21 23:33:59', '2025-09-22 02:08:46', NULL, 1),
(4, 'Abdelrahman Mohamed', 'sda', 'products/hPZFPt46OgXX9kUouUOXrds4cV3i0MoWdk4taLJo.png', 80.00, NULL, 79, 1, '2025-09-21 23:34:20', '2025-09-22 02:04:41', NULL, 1),
(5, 'cairo', 'drfbvad', 'products/m01pmYw6egr22eHJDUOxMEhubgoFYSkFvo3PbAsb.jpg', 500.00, NULL, 4, 1, '2025-09-22 00:14:33', '2025-09-22 02:04:41', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_logs`
--

CREATE TABLE `product_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `action` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `changed_by` bigint UNSIGNED DEFAULT NULL,
  `changes` json DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `sale` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_logs`
--

INSERT INTO `product_logs` (`id`, `product_id`, `action`, `changed_by`, `changes`, `name`, `image`, `price`, `sale`, `created_at`, `updated_at`) VALUES
(1, 1, 'created', 1, '{\"id\": 1, \"name\": \"mustafa\", \"image\": \"products/zMchT0XasPTtPYxvUQF5eQQ90MzNimFQbuBFB3wE.png\", \"price\": \"50\", \"created_at\": \"2025-09-21T22:42:31.000000Z\", \"updated_at\": \"2025-09-21T22:42:31.000000Z\", \"category_id\": \"1\", \"description\": \"da\"}', 'mustafa', 'products/zMchT0XasPTtPYxvUQF5eQQ90MzNimFQbuBFB3wE.png', 50.00, NULL, '2025-09-21 19:42:31', '2025-09-21 19:42:31'),
(2, 2, 'created', 1, '{\"id\": 2, \"name\": \"mustafa\", \"image\": \"products/OU93SvkuV6PjiCeP9qIDK4HEGxboovdaPkzFBbAs.png\", \"price\": \"50\", \"created_at\": \"2025-09-21T22:42:44.000000Z\", \"updated_at\": \"2025-09-21T22:42:44.000000Z\", \"category_id\": \"1\", \"description\": \"da\"}', 'mustafa', 'products/OU93SvkuV6PjiCeP9qIDK4HEGxboovdaPkzFBbAs.png', 50.00, NULL, '2025-09-21 19:42:44', '2025-09-21 19:42:44'),
(3, 1, 'deactivated', 1, '{\"id\": 1, \"name\": \"mustafa\", \"sale\": 50, \"image\": \"products/zMchT0XasPTtPYxvUQF5eQQ90MzNimFQbuBFB3wE.png\", \"price\": \"50.00\", \"quantity\": 0, \"is_active\": false, \"created_at\": \"2025-09-21T22:42:31.000000Z\", \"deleted_at\": null, \"updated_at\": \"2025-09-21T23:01:21.000000Z\", \"category_id\": 1, \"description\": \"da\"}', 'mustafa', 'products/zMchT0XasPTtPYxvUQF5eQQ90MzNimFQbuBFB3wE.png', 50.00, '50', '2025-09-21 20:01:21', '2025-09-21 20:01:21'),
(4, 1, 'activated', 1, '{\"id\": 1, \"name\": \"mustafa\", \"sale\": 50, \"image\": \"products/zMchT0XasPTtPYxvUQF5eQQ90MzNimFQbuBFB3wE.png\", \"price\": \"50.00\", \"quantity\": 0, \"is_active\": true, \"created_at\": \"2025-09-21T22:42:31.000000Z\", \"deleted_at\": null, \"updated_at\": \"2025-09-21T23:01:43.000000Z\", \"category_id\": 1, \"description\": \"da\"}', 'mustafa', 'products/zMchT0XasPTtPYxvUQF5eQQ90MzNimFQbuBFB3wE.png', 50.00, '50', '2025-09-21 20:01:43', '2025-09-21 20:01:43'),
(5, 1, 'deactivated', 1, '{\"id\": 1, \"name\": \"mustafa\", \"sale\": 50, \"image\": \"products/zMchT0XasPTtPYxvUQF5eQQ90MzNimFQbuBFB3wE.png\", \"price\": \"50.00\", \"quantity\": 0, \"is_active\": false, \"created_at\": \"2025-09-21T22:42:31.000000Z\", \"deleted_at\": null, \"updated_at\": \"2025-09-21T23:01:51.000000Z\", \"category_id\": 1, \"description\": \"da\"}', 'mustafa', 'products/zMchT0XasPTtPYxvUQF5eQQ90MzNimFQbuBFB3wE.png', 50.00, '50', '2025-09-21 20:01:51', '2025-09-21 20:01:51'),
(6, 2, 'deactivated', 1, '{\"id\": 2, \"name\": \"mustafa\", \"sale\": 50, \"image\": \"products/OU93SvkuV6PjiCeP9qIDK4HEGxboovdaPkzFBbAs.png\", \"price\": \"50.00\", \"quantity\": 0, \"is_active\": false, \"created_at\": \"2025-09-21T22:42:44.000000Z\", \"deleted_at\": null, \"updated_at\": \"2025-09-21T23:01:54.000000Z\", \"category_id\": 1, \"description\": \"da\"}', 'mustafa', 'products/OU93SvkuV6PjiCeP9qIDK4HEGxboovdaPkzFBbAs.png', 50.00, '50', '2025-09-21 20:01:54', '2025-09-21 20:01:54'),
(7, 1, 'activated', 1, '{\"id\": 1, \"name\": \"mustafa\", \"sale\": 50, \"image\": \"products/zMchT0XasPTtPYxvUQF5eQQ90MzNimFQbuBFB3wE.png\", \"price\": \"50.00\", \"quantity\": 0, \"is_active\": true, \"created_at\": \"2025-09-21T22:42:31.000000Z\", \"deleted_at\": null, \"updated_at\": \"2025-09-21T23:02:06.000000Z\", \"category_id\": 1, \"description\": \"da\"}', 'mustafa', 'products/zMchT0XasPTtPYxvUQF5eQQ90MzNimFQbuBFB3wE.png', 50.00, '50', '2025-09-21 20:02:06', '2025-09-21 20:02:06'),
(8, 2, 'activated', 1, '{\"id\": 2, \"name\": \"mustafa\", \"sale\": 50, \"image\": \"products/OU93SvkuV6PjiCeP9qIDK4HEGxboovdaPkzFBbAs.png\", \"price\": \"50.00\", \"quantity\": 0, \"is_active\": true, \"created_at\": \"2025-09-21T22:42:44.000000Z\", \"deleted_at\": null, \"updated_at\": \"2025-09-21T23:03:07.000000Z\", \"category_id\": 1, \"description\": \"da\"}', 'mustafa', 'products/OU93SvkuV6PjiCeP9qIDK4HEGxboovdaPkzFBbAs.png', 50.00, '50', '2025-09-21 20:03:07', '2025-09-21 20:03:07'),
(9, 1, 'deactivated', 1, '{\"id\": 1, \"name\": \"mustafa\", \"sale\": 50, \"image\": \"products/zMchT0XasPTtPYxvUQF5eQQ90MzNimFQbuBFB3wE.png\", \"price\": \"50.00\", \"quantity\": 0, \"is_active\": false, \"created_at\": \"2025-09-21T22:42:31.000000Z\", \"deleted_at\": null, \"updated_at\": \"2025-09-21T23:03:09.000000Z\", \"category_id\": 1, \"description\": \"da\"}', 'mustafa', 'products/zMchT0XasPTtPYxvUQF5eQQ90MzNimFQbuBFB3wE.png', 50.00, '50', '2025-09-21 20:03:09', '2025-09-21 20:03:09'),
(10, 1, 'activated', 1, '{\"id\": 1, \"name\": \"mustafa\", \"sale\": 50, \"image\": \"products/zMchT0XasPTtPYxvUQF5eQQ90MzNimFQbuBFB3wE.png\", \"price\": \"50.00\", \"quantity\": 0, \"is_active\": true, \"created_at\": \"2025-09-21T22:42:31.000000Z\", \"deleted_at\": null, \"updated_at\": \"2025-09-21T23:04:04.000000Z\", \"category_id\": 1, \"description\": \"da\"}', 'mustafa', 'products/zMchT0XasPTtPYxvUQF5eQQ90MzNimFQbuBFB3wE.png', 50.00, '50', '2025-09-21 20:04:04', '2025-09-21 20:04:04'),
(11, 1, 'deactivated', 1, '{\"id\": 1, \"name\": \"mustafa\", \"sale\": 50, \"image\": \"products/zMchT0XasPTtPYxvUQF5eQQ90MzNimFQbuBFB3wE.png\", \"price\": \"50.00\", \"quantity\": 0, \"is_active\": false, \"created_at\": \"2025-09-21T22:42:31.000000Z\", \"deleted_at\": null, \"updated_at\": \"2025-09-21T23:04:06.000000Z\", \"category_id\": 1, \"description\": \"da\"}', 'mustafa', 'products/zMchT0XasPTtPYxvUQF5eQQ90MzNimFQbuBFB3wE.png', 50.00, '50', '2025-09-21 20:04:06', '2025-09-21 20:04:06'),
(12, 3, 'created', 1, '{\"id\": 3, \"name\": \"Tank top-Blue\", \"image\": \"products/WJK2jIyTDqf1ROgMgAj0po8HS1wsJnZbR9EqdPRf.jpg\", \"price\": \"50\", \"created_at\": \"2025-09-22T02:33:59.000000Z\", \"updated_at\": \"2025-09-22T02:33:59.000000Z\", \"category_id\": \"1\", \"description\": \"dada\"}', 'Tank top-Blue', 'products/WJK2jIyTDqf1ROgMgAj0po8HS1wsJnZbR9EqdPRf.jpg', 50.00, NULL, '2025-09-21 23:33:59', '2025-09-21 23:33:59'),
(13, 4, 'created', 1, '{\"id\": 4, \"name\": \"Abdelrahman Mohamed\", \"image\": \"products/hPZFPt46OgXX9kUouUOXrds4cV3i0MoWdk4taLJo.png\", \"price\": \"80\", \"created_at\": \"2025-09-22T02:34:20.000000Z\", \"updated_at\": \"2025-09-22T02:34:20.000000Z\", \"category_id\": \"1\", \"description\": \"sda\"}', 'Abdelrahman Mohamed', 'products/hPZFPt46OgXX9kUouUOXrds4cV3i0MoWdk4taLJo.png', 80.00, NULL, '2025-09-21 23:34:20', '2025-09-21 23:34:20'),
(14, 2, 'deactivated', 1, '{\"id\": 2, \"name\": \"mustafa\", \"sale\": 50, \"image\": \"products/OU93SvkuV6PjiCeP9qIDK4HEGxboovdaPkzFBbAs.png\", \"price\": \"50.00\", \"quantity\": 0, \"is_active\": false, \"created_at\": \"2025-09-21T22:42:44.000000Z\", \"deleted_at\": null, \"updated_at\": \"2025-09-22T02:36:53.000000Z\", \"category_id\": 1, \"description\": \"da\"}', 'mustafa', 'products/OU93SvkuV6PjiCeP9qIDK4HEGxboovdaPkzFBbAs.png', 50.00, '50', '2025-09-21 23:36:53', '2025-09-21 23:36:53'),
(15, 2, 'activated', 1, '{\"id\": 2, \"name\": \"mustafa\", \"sale\": 50, \"image\": \"products/OU93SvkuV6PjiCeP9qIDK4HEGxboovdaPkzFBbAs.png\", \"price\": \"50.00\", \"quantity\": 0, \"is_active\": true, \"created_at\": \"2025-09-21T22:42:44.000000Z\", \"deleted_at\": null, \"updated_at\": \"2025-09-22T02:36:56.000000Z\", \"category_id\": 1, \"description\": \"da\"}', 'mustafa', 'products/OU93SvkuV6PjiCeP9qIDK4HEGxboovdaPkzFBbAs.png', 50.00, '50', '2025-09-21 23:36:56', '2025-09-21 23:36:56'),
(16, 1, 'updated', 1, '{\"created_at\": \"2025-09-21T22:42:31.000000Z\", \"updated_at\": \"2025-09-21T23:04:06.000000Z\"}', 'mustafa', 'products/zMchT0XasPTtPYxvUQF5eQQ90MzNimFQbuBFB3wE.png', 50.00, '50', '2025-09-21 23:42:49', '2025-09-21 23:42:49'),
(17, 1, 'updated', 1, '{\"created_at\": \"2025-09-21T22:42:31.000000Z\", \"updated_at\": \"2025-09-21T23:04:06.000000Z\"}', 'mustafa', 'products/zMchT0XasPTtPYxvUQF5eQQ90MzNimFQbuBFB3wE.png', 50.00, '50', '2025-09-21 23:43:20', '2025-09-21 23:43:20'),
(18, 2, 'updated', 1, '{\"created_at\": \"2025-09-21T22:42:44.000000Z\", \"updated_at\": \"2025-09-22T02:36:56.000000Z\"}', 'mustafa', 'products/OU93SvkuV6PjiCeP9qIDK4HEGxboovdaPkzFBbAs.png', 50.00, '50', '2025-09-21 23:43:31', '2025-09-21 23:43:31'),
(19, 1, 'updated', 1, '{\"created_at\": \"2025-09-21T22:42:31.000000Z\", \"updated_at\": \"2025-09-21T23:04:06.000000Z\"}', 'mustafa', 'products/zMchT0XasPTtPYxvUQF5eQQ90MzNimFQbuBFB3wE.png', 50.00, '50', '2025-09-22 00:06:55', '2025-09-22 00:06:55'),
(20, 1, 'updated', 1, '{\"created_at\": \"2025-09-21T22:42:31.000000Z\", \"updated_at\": \"2025-09-21T23:04:06.000000Z\"}', 'mustafa', 'products/zMchT0XasPTtPYxvUQF5eQQ90MzNimFQbuBFB3wE.png', 50.00, '50', '2025-09-22 00:09:22', '2025-09-22 00:09:22'),
(21, 1, 'updated', 1, '{\"created_at\": \"2025-09-21T22:42:31.000000Z\", \"updated_at\": \"2025-09-21T23:04:06.000000Z\"}', 'mustafa', 'products/zMchT0XasPTtPYxvUQF5eQQ90MzNimFQbuBFB3wE.png', 50.00, '50', '2025-09-22 00:09:42', '2025-09-22 00:09:42'),
(22, 1, 'updated', 1, '{\"created_at\": \"2025-09-21T22:42:31.000000Z\", \"updated_at\": \"2025-09-21T23:04:06.000000Z\"}', 'mustafa', 'products/zMchT0XasPTtPYxvUQF5eQQ90MzNimFQbuBFB3wE.png', 50.00, '50', '2025-09-22 00:10:31', '2025-09-22 00:10:31'),
(23, 1, 'updated', 1, '{\"created_at\": \"2025-09-21T22:42:31.000000Z\", \"updated_at\": \"2025-09-21T23:04:06.000000Z\"}', 'mustafa', 'products/zMchT0XasPTtPYxvUQF5eQQ90MzNimFQbuBFB3wE.png', 50.00, '50', '2025-09-22 00:11:41', '2025-09-22 00:11:41'),
(24, 5, 'created', 1, '{\"id\": 5, \"name\": \"cairo\", \"image\": \"products/m01pmYw6egr22eHJDUOxMEhubgoFYSkFvo3PbAsb.jpg\", \"price\": \"500\", \"quantity\": \"5\", \"created_at\": \"2025-09-22T03:14:33.000000Z\", \"updated_at\": \"2025-09-22T03:14:33.000000Z\", \"category_id\": \"1\", \"description\": \"drfbvad\"}', 'cairo', 'products/m01pmYw6egr22eHJDUOxMEhubgoFYSkFvo3PbAsb.jpg', 500.00, NULL, '2025-09-22 00:14:33', '2025-09-22 00:14:33'),
(25, 4, 'updated', 1, '{\"quantity\": \"80\", \"created_at\": \"2025-09-22T02:34:20.000000Z\", \"updated_at\": \"2025-09-22T03:14:41.000000Z\"}', 'Abdelrahman Mohamed', 'products/hPZFPt46OgXX9kUouUOXrds4cV3i0MoWdk4taLJo.png', 80.00, NULL, '2025-09-22 00:14:41', '2025-09-22 00:14:41'),
(26, 2, 'updated', 1, '{\"quantity\": \"70\", \"created_at\": \"2025-09-21T22:42:44.000000Z\", \"updated_at\": \"2025-09-22T03:14:47.000000Z\"}', 'mustafa', 'products/OU93SvkuV6PjiCeP9qIDK4HEGxboovdaPkzFBbAs.png', 50.00, '50', '2025-09-22 00:14:47', '2025-09-22 00:14:47'),
(27, 3, 'updated', 1, '{\"quantity\": \"80\", \"created_at\": \"2025-09-22T02:33:59.000000Z\", \"updated_at\": \"2025-09-22T04:31:41.000000Z\"}', 'Tank top-Blue', 'products/WJK2jIyTDqf1ROgMgAj0po8HS1wsJnZbR9EqdPRf.jpg', 50.00, NULL, '2025-09-22 01:31:41', '2025-09-22 01:31:41'),
(28, 1, 'updated', 1, '{\"quantity\": \"100\", \"created_at\": \"2025-09-21T22:42:31.000000Z\", \"updated_at\": \"2025-09-22T04:31:48.000000Z\"}', 'mustafa', 'products/zMchT0XasPTtPYxvUQF5eQQ90MzNimFQbuBFB3wE.png', 50.00, '50', '2025-09-22 01:31:48', '2025-09-22 01:31:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Abdelrahman Mohamed', 'eyadomar.ok@gmail.com', NULL, '$2y$12$9.YfEITXkHIT8meTw3NH4OyEXyu9AHR30zsVkRZf8GSTZboMxWB4q', NULL, '2025-09-21 10:20:56', '2025-09-21 10:20:56'),
(2, 'Abdelrahman Mohamed', 'mustafa.ok@gmail.com', NULL, '$2y$12$MTz3om1jUrJeqdTYrkwM/uOXZHn7ifG.o/0QfgPUrTEkQ9o7u2qdq', NULL, '2025-09-22 00:00:47', '2025-09-22 00:00:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_guest_user_id_foreign` (`guest_user_id`),
  ADD KEY `carts_product_id_foreign` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `guest_users`
--
ALTER TABLE `guest_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_guest_user_id_foreign` (`guest_user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_logs`
--
ALTER TABLE `product_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_logs_product_id_foreign` (`product_id`);

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
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guest_users`
--
ALTER TABLE `guest_users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_logs`
--
ALTER TABLE `product_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_guest_user_id_foreign` FOREIGN KEY (`guest_user_id`) REFERENCES `guest_users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_guest_user_id_foreign` FOREIGN KEY (`guest_user_id`) REFERENCES `guest_users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `product_logs`
--
ALTER TABLE `product_logs`
  ADD CONSTRAINT `product_logs_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
