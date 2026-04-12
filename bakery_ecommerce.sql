-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th4 12, 2026 lúc 08:51 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `bakery_ecommerce`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(5, 'Bánh Ngọt', 'banh-ngot', '2026-04-06 09:43:53', '2026-04-07 09:17:39'),
(7, 'Bánh mặn', 'banh-man', '2026-04-06 09:47:13', '2026-04-06 09:47:13'),
(9, 'Bánh Kem', 'banh-kem', '2026-04-07 09:17:39', '2026-04-07 09:17:39'),
(10, 'Bánh Mì', 'banh-mi', '2026-04-07 09:17:39', '2026-04-07 09:17:39');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `contacts`
--

INSERT INTO `contacts` (`id`, `user_id`, `fullname`, `email`, `phone`, `subject`, `message`, `is_read`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Phan Hùng Thịnh', 'phanhungthinh0123@gmail.com', '0965050142', 'Góp ý', 'Ngon', 1, '2026-04-05 09:27:57', '2026-04-11 10:56:19'),
(2, NULL, 'Thịnh Phan Hùng', 'thinhph0343@ut.edu.vn', '0965050142', 'Góp ý', 'Món bánh ngọt ngon', 1, '2026-04-05 10:07:11', '2026-04-06 09:13:52'),
(3, NULL, 'Thịnh Phan Hùng', 'thinhph0343@ut.edu.vn', '0965050142', 'Món hấp dẫn', 'Ngon quá', 0, '2026-04-05 10:11:52', '2026-04-05 10:11:52'),
(4, NULL, 'Tài Nguyễn', 'tainguyen@gmail.com', '0989876543', 'Góp ý', 'Món ưng', 1, '2026-04-05 10:13:46', '2026-04-06 09:13:45');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
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
-- Cấu trúc bảng cho bảng `jobs`
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
-- Cấu trúc bảng cho bảng `job_batches`
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
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_04_03_071612_create_categories_table', 1),
(5, '2026_04_03_071613_create_products_table', 1),
(6, '2026_04_03_071614_create_orders_table', 1),
(7, '2026_04_03_071615_create_order_items_table', 1),
(8, '2026_04_03_073513_create_personal_access_tokens_table', 1),
(9, '2026_04_03_111949_add_details_to_users_table', 1),
(10, '2026_04_05_155900_create_contacts_table', 2),
(12, '2026_04_05_170917_add_user_id_to_contacts_table', 3),
(13, '2026_04_05_173630_add_is_active_to_products_table', 4),
(14, '2026_04_06_164830_add_description_to_categories_table', 5),
(15, '2026_04_06_171258_add_sub_images_to_products_table', 6),
(16, '2026_04_08_140507_add_address_fields_to_users_table', 7),
(17, '2026_04_08_141626_create_user_addresses_table', 8),
(18, '2026_04_08_143038_add_alias_and_email_to_user_addresses_table', 9),
(19, '2026_04_08_151848_add_image_to_users_table', 10),
(20, '2026_04_08_152541_drop_redundant_address_fields_from_users_table', 11),
(21, '2026_04_08_155932_add_content_to_products_table', 12),
(22, '2026_04_11_165941_add_is_featured_to_products_table', 13),
(23, '2026_04_11_175022_remove_description_from_categories_table', 14);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_phone` varchar(255) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `customer_name`, `customer_phone`, `customer_address`, `total_amount`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Phan Hùng Thịnh', '0965050142', '201/46/25 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 22220.00, 'delivered', '2026-04-06 11:53:59', '2026-04-08 08:36:07'),
(2, NULL, 'Phan Hùng Thịnh', '0965050142', '201/46/25 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 22220.00, 'cancelled', '2026-04-06 11:54:02', '2026-04-06 12:08:58'),
(3, NULL, 'Phan Hùng Thịnh', '0965050142', '201/46/25 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 22220.00, 'pending', '2026-04-06 11:54:09', '2026-04-06 11:54:09'),
(4, NULL, 'Phan Hùng Thịnh', '0965050142', '201/46/25 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 22220.00, 'cancelled', '2026-04-06 11:54:21', '2026-04-06 12:08:46'),
(5, NULL, 'Phan Hùng Thịnh', '0965050142', '201/46/25 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 22220.00, 'pending', '2026-04-06 11:54:35', '2026-04-06 11:54:35'),
(6, NULL, 'Phan Hùng Thịnh', '0965050142', '564, Xã Vĩnh Phương, Thành phố Nha Trang, Tỉnh Khánh Hòa', 22220.00, 'delivered', '2026-04-06 11:57:01', '2026-04-06 12:04:59'),
(7, 4, 'Phan Hùng Thịnh', '0965050142', '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 90000.00, 'pending', '2026-04-08 08:29:23', '2026-04-08 08:29:23'),
(8, 4, 'Phan Hùng Thịnh', '0965050142', '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 123.00, 'pending', '2026-04-08 08:36:41', '2026-04-08 08:36:41'),
(9, 6, 'Anh Tiến', '098675733', 'quận 2, Phường Bình Chiểu, Thành phố Thủ Đức, Thành phố Hồ Chí Minh', 45000.00, 'pending', '2026-04-11 11:52:03', '2026-04-11 11:52:03');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `price`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 17, '2221', 22220.00, 1, '2026-04-06 11:53:59', '2026-04-06 11:53:59'),
(2, 2, 17, '2221', 22220.00, 1, '2026-04-06 11:54:02', '2026-04-06 11:54:02'),
(3, 3, 17, '2221', 22220.00, 1, '2026-04-06 11:54:09', '2026-04-06 11:54:09'),
(4, 4, 17, '2221', 22220.00, 1, '2026-04-06 11:54:21', '2026-04-06 11:54:21'),
(5, 5, 17, '2221', 22220.00, 1, '2026-04-06 11:54:35', '2026-04-06 11:54:35'),
(6, 6, 17, '2221', 22220.00, 1, '2026-04-06 11:57:01', '2026-04-06 11:57:01'),
(7, 7, 21, 'Macaron Pháp', 45000.00, 2, '2026-04-08 08:29:23', '2026-04-08 08:29:23'),
(8, 8, 10, 'Bánh 1', 123.00, 1, '2026-04-08 08:36:41', '2026-04-08 08:36:41'),
(9, 9, 21, 'Macaron Pháp', 45000.00, 1, '2026-04-11 11:52:03', '2026-04-11 11:52:03');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'auth_token', '322e192c4137e62a4309f0202b145aada9837e868b2557e215f20989a5dfba6e', '[\"*\"]', '2026-04-03 04:54:34', NULL, '2026-04-03 04:54:33', '2026-04-03 04:54:34'),
(2, 'App\\Models\\User', 1, 'auth_token', 'e4674c843f4dfc24c802fdc62f0dbac8b8de6a25a1ba5a7e9c1e227c444116ec', '[\"*\"]', '2026-04-03 04:54:54', NULL, '2026-04-03 04:54:53', '2026-04-03 04:54:54'),
(3, 'App\\Models\\User', 3, 'auth_token', '2214e711925bf9e6403a8a6dc84b330614de3e6aff86a4b2b46d9b8b92f389e4', '[\"*\"]', NULL, NULL, '2026-04-03 04:56:02', '2026-04-03 04:56:02'),
(4, 'App\\Models\\User', 3, 'auth_token', '7c2327ddeee8b0e891c3380170887b05e7277d0be7d752be309fdef0fc0a906a', '[\"*\"]', NULL, NULL, '2026-04-03 08:30:33', '2026-04-03 08:30:33'),
(5, 'App\\Models\\User', 3, 'auth_token', '4b127d8edf7a572a3e25502031bcb242aac02c0ac1e4d29744b79beb3f654ed2', '[\"*\"]', NULL, NULL, '2026-04-03 08:37:27', '2026-04-03 08:37:27'),
(6, 'App\\Models\\User', 3, 'auth_token', 'a0b74569cba678ad10a0d59751a1f310635bf604ba9298e363e7ddae7ba0b240', '[\"*\"]', NULL, NULL, '2026-04-03 10:01:33', '2026-04-03 10:01:33'),
(7, 'App\\Models\\User', 3, 'auth_token', '7c6f717f87a2481c1ada042079ad1b8416b38c97ffeeb427ec6f29a042bea63b', '[\"*\"]', NULL, NULL, '2026-04-03 10:01:56', '2026-04-03 10:01:56'),
(8, 'App\\Models\\User', 4, 'auth_token', '7a7824a423708bc3e4d1bb32581b48b4c71f5f2e0f259a82125171c17371b3e6', '[\"*\"]', NULL, NULL, '2026-04-03 10:04:08', '2026-04-03 10:04:08'),
(9, 'App\\Models\\User', 4, 'auth_token', '94b0738d300cd7f0f0c2af0b1b6edfbb36e12c0f9e8161a626892063192486f0', '[\"*\"]', NULL, NULL, '2026-04-03 10:09:59', '2026-04-03 10:09:59'),
(10, 'App\\Models\\User', 1, 'auth_token', '9095a3e1e48e264c6f7469a2d73b09df251e9c20f2ee9c88d6362c18e812c2ab', '[\"*\"]', '2026-04-05 09:29:46', NULL, '2026-04-05 09:29:45', '2026-04-05 09:29:46'),
(11, 'App\\Models\\User', 1, 'auth_token', 'e20c2ebb65ecb2bcf5f8b48d43c20e1aaebb4ea3afab198cac63305259ab9743', '[\"*\"]', '2026-04-05 09:32:23', NULL, '2026-04-05 09:30:05', '2026-04-05 09:32:23'),
(12, 'App\\Models\\User', 1, 'auth_token', '37d32b9ba4d63f5576cee4b16c928da010a089c80877a9c9f754255dd5509944', '[\"*\"]', '2026-04-05 09:41:34', NULL, '2026-04-05 09:32:48', '2026-04-05 09:41:34'),
(13, 'App\\Models\\User', 4, 'auth_token', '289cd375fc0d0dddc1b4e03ef8804cbcb20e66cf676388b807a42b7da0abe33c', '[\"*\"]', NULL, NULL, '2026-04-05 09:42:05', '2026-04-05 09:42:05'),
(14, 'App\\Models\\User', 1, 'auth_token', 'b49984af66983104539a8ca2f619eb48be716da2a2980a5e153b6aceb5607fe3', '[\"*\"]', '2026-04-05 09:59:07', NULL, '2026-04-05 09:42:23', '2026-04-05 09:59:07'),
(15, 'App\\Models\\User', 4, 'auth_token', '7d4e621e3181f5d3225c24870b775e678e3efe64b79c3fdc56df7f8041e0fafa', '[\"*\"]', NULL, NULL, '2026-04-05 09:59:12', '2026-04-05 09:59:12'),
(16, 'App\\Models\\User', 1, 'auth_token', '57496ebb2b3122b062d8e581452bff1e19dde6123c75dd4f4a54796de5a78130', '[\"*\"]', '2026-04-05 10:05:28', NULL, '2026-04-05 09:59:36', '2026-04-05 10:05:28'),
(17, 'App\\Models\\User', 4, 'auth_token', '9ca944d70638686b094dc9d92ffca1b66f77e981c62678cd88039ea89ef7fbd2', '[\"*\"]', NULL, NULL, '2026-04-05 10:05:49', '2026-04-05 10:05:49'),
(18, 'App\\Models\\User', 4, 'auth_token', '9470d5dc9153b187636c7583c4ec66a89d68b0beb8fb22ee6477d9ffc62e81e1', '[\"*\"]', '2026-04-06 11:58:29', NULL, '2026-04-05 10:06:24', '2026-04-06 11:58:29'),
(19, 'App\\Models\\User', 1, 'auth_token', 'c2ffe1213481cee777cba9b1e4d2b5fa7ffe9c0d4fe4ca83c4f0e97bb770e4d7', '[\"*\"]', '2026-04-05 10:07:15', NULL, '2026-04-05 10:06:37', '2026-04-05 10:07:15'),
(20, 'App\\Models\\User', 1, 'auth_token', 'b3c2b50cebbda906d3e8e6f9d2bd13e5e5df0dbbfb0f6341ae56096ab124f3a3', '[\"*\"]', '2026-04-05 11:04:57', NULL, '2026-04-05 10:14:21', '2026-04-05 11:04:57'),
(21, 'App\\Models\\User', 1, 'auth_token', '082ab4d2c0c1af955dc39647b66d7c26eb64e7a30adcfeb7cdaa18a8e13795db', '[\"*\"]', '2026-04-05 11:13:21', NULL, '2026-04-05 11:08:11', '2026-04-05 11:13:21'),
(22, 'App\\Models\\User', 4, 'auth_token', '081b7130b057a074ca9d3a1c308a71e29809eaf7b6ca207c791e225982d33fb5', '[\"*\"]', NULL, NULL, '2026-04-05 11:13:39', '2026-04-05 11:13:39'),
(23, 'App\\Models\\User', 1, 'auth_token', '847221ede4e4226587b8da93621f1c6c60ea80712edfdb16a1da747d05d063a2', '[\"*\"]', '2026-04-05 11:16:55', NULL, '2026-04-05 11:15:01', '2026-04-05 11:16:55'),
(24, 'App\\Models\\User', 1, 'auth_token', 'f61d98c13cd7e23bbb4c8f2a2b9721119dc5cf93d8b6391e889c2c65584793e9', '[\"*\"]', '2026-04-06 09:13:52', NULL, '2026-04-06 09:13:23', '2026-04-06 09:13:52'),
(25, 'App\\Models\\User', 4, 'auth_token', '69b2ea7f90953cdae26772aa9a0d17b89403e6c0233963e67724974f2e992394', '[\"*\"]', NULL, NULL, '2026-04-06 09:19:21', '2026-04-06 09:19:21'),
(26, 'App\\Models\\User', 1, 'auth_token', '0be6ca7cba2c5e24135f9235c455d0dd7bbd264911e14bb75f546007966b3c11', '[\"*\"]', '2026-04-06 10:56:01', NULL, '2026-04-06 09:43:13', '2026-04-06 10:56:01'),
(27, 'App\\Models\\User', 4, 'auth_token', 'ba7ed43a32ed3855692eaef6582710e2f54b6dcf3887f92b4c9ae891b0e49dae', '[\"*\"]', '2026-04-06 11:54:46', NULL, '2026-04-06 10:56:08', '2026-04-06 11:54:46'),
(28, 'App\\Models\\User', 1, 'auth_token', '77fdf434dae80ae65b512d6a79f84f4f916cb53f3b0f0fc2416e800808753510', '[\"*\"]', '2026-04-06 11:55:36', NULL, '2026-04-06 11:55:24', '2026-04-06 11:55:36'),
(29, 'App\\Models\\User', 4, 'auth_token', '44fd1fc3ca1a8487c544fae7374c590a5e788e4ebbe4cb4898394342ce0c6826', '[\"*\"]', '2026-04-06 11:58:09', NULL, '2026-04-06 11:55:42', '2026-04-06 11:58:09'),
(30, 'App\\Models\\User', 4, 'auth_token', '80c5e6d83f1be8ebb7aa05e184ad3e517cf8739ff0b3f9fadb72bedd61612516', '[\"*\"]', '2026-04-06 12:12:34', NULL, '2026-04-06 11:58:40', '2026-04-06 12:12:34'),
(31, 'App\\Models\\User', 1, 'auth_token', '28b548a8056e97700bf7f9c133d72af50ab1490d08745fb8522025ca81169688', '[\"*\"]', '2026-04-06 12:08:58', NULL, '2026-04-06 11:58:57', '2026-04-06 12:08:58'),
(32, 'App\\Models\\User', 4, 'auth_token', '26117765a744de217959871a42831f21a9d7abc4b7c2afcbc9962821f3701e0f', '[\"*\"]', '2026-04-08 05:34:41', NULL, '2026-04-08 05:34:36', '2026-04-08 05:34:41'),
(33, 'App\\Models\\User', 1, 'auth_token', '5f7d2916c7623e559ed383421bebd7a690f0e7c0f6680befb08261a1ad3ddbd6', '[\"*\"]', '2026-04-08 06:41:01', NULL, '2026-04-08 05:34:49', '2026-04-08 06:41:01'),
(34, 'App\\Models\\User', 4, 'auth_token', 'fe285556511f64e1935dc9318cd6ae88e1c191f122e8fedf7dbb0fb8d20cc479', '[\"*\"]', '2026-04-08 06:43:09', NULL, '2026-04-08 06:43:01', '2026-04-08 06:43:09'),
(35, 'App\\Models\\User', 1, 'auth_token', '119d5747b2e2537127b6789ad17a86861909d41f579c01ca5f988eaac1639696', '[\"*\"]', '2026-04-11 04:08:07', NULL, '2026-04-08 06:44:07', '2026-04-11 04:08:07'),
(36, 'App\\Models\\User', 1, 'auth_token', 'aade721d504e0924ab5fc3b48e7454b448de02ece3e8e886b6e190dda3e519c4', '[\"*\"]', '2026-04-08 06:47:55', NULL, '2026-04-08 06:47:53', '2026-04-08 06:47:55'),
(37, 'App\\Models\\User', 4, 'auth_token', 'd6220770b0236d945fcacf4eebd7f0dd7978c170e3bd7a7a14bb7dd74ef073c5', '[\"*\"]', '2026-04-08 07:05:36', NULL, '2026-04-08 06:48:13', '2026-04-08 07:05:36'),
(38, 'App\\Models\\User', 4, 'auth_token', '5eac56cbbcff8932063b78cba23d3d9297668e7201aaa4342bd7738110dee162', '[\"*\"]', '2026-04-08 07:12:27', NULL, '2026-04-08 07:07:00', '2026-04-08 07:12:27'),
(39, 'App\\Models\\User', 4, 'auth_token', '58b976f055bd009ebad3545c5946eebb4e60158bf56c5fa9c30e0e2e76f8cb25', '[\"*\"]', '2026-04-08 10:38:19', NULL, '2026-04-08 07:12:46', '2026-04-08 10:38:19'),
(40, 'App\\Models\\User', 4, 'auth_token', '3f007faecc2ebca295a7990e15ab577cc0fc504159e9e7ce40eccfc0679ae660', '[\"*\"]', '2026-04-11 05:18:16', NULL, '2026-04-11 04:08:14', '2026-04-11 05:18:16'),
(41, 'App\\Models\\User', 1, 'auth_token', 'e974c68d36d9f54a3a72de02afe2063f298e72e9fa9eb4009181c15265e237e4', '[\"*\"]', '2026-04-11 06:11:48', NULL, '2026-04-11 05:18:22', '2026-04-11 06:11:48'),
(42, 'App\\Models\\User', 4, 'auth_token', 'fccbbb8919f089c95684dbf4bf8d0ce7dae422d2d78564c261a103e5a4c5ff01', '[\"*\"]', '2026-04-11 06:13:00', NULL, '2026-04-11 06:11:58', '2026-04-11 06:13:00'),
(43, 'App\\Models\\User', 1, 'auth_token', 'cd95feb45f834089dae84ec667877c4c5770ad56cdbb1e96d52b8335273117e3', '[\"*\"]', '2026-04-11 06:16:55', NULL, '2026-04-11 06:16:10', '2026-04-11 06:16:55'),
(44, 'App\\Models\\User', 1, 'auth_token', 'd14ca75e7faa35aa4b288e60aae978cdec26430fd7fd3a204fda6fba7d673f5a', '[\"*\"]', '2026-04-11 11:24:12', NULL, '2026-04-11 09:57:52', '2026-04-11 11:24:12'),
(45, 'App\\Models\\User', 3, 'auth_token', 'ceea2d60d4bfc17038b552031df8c9e6a6ecd02d053f5c7d3903f7068ba74171', '[\"*\"]', '2026-04-11 11:26:40', NULL, '2026-04-11 11:26:33', '2026-04-11 11:26:40'),
(46, 'App\\Models\\User', 4, 'auth_token', 'ef3fbbafcbd424f47f1e327bb2376d638a6982160d28d7265674634ff7633980', '[\"*\"]', '2026-04-11 11:35:29', NULL, '2026-04-11 11:26:45', '2026-04-11 11:35:29'),
(47, 'App\\Models\\User', 3, 'auth_token', '8f5c244345d378a45370785ad05f208a75b41a75b5a16d138f7f7152018ef39d', '[\"*\"]', '2026-04-11 11:35:56', NULL, '2026-04-11 11:35:44', '2026-04-11 11:35:56'),
(48, 'App\\Models\\User', 5, 'auth_token', '0b05b87828b30b288065d6151df6327f4a5c6707a1392a35d24ce817b725b712', '[\"*\"]', NULL, NULL, '2026-04-11 11:37:22', '2026-04-11 11:37:22'),
(49, 'App\\Models\\User', 5, 'auth_token', 'd6d7f45435314e505155ff999cd99bf292b06941c839abc7fd75145503e5e4ed', '[\"*\"]', '2026-04-11 11:37:39', NULL, '2026-04-11 11:37:29', '2026-04-11 11:37:39'),
(50, 'App\\Models\\User', 6, 'auth_token', '80c155c6f688d9cb4e386268b7b196e9e4b265da7cb172e1a491d105459e5455', '[\"*\"]', NULL, NULL, '2026-04-11 11:40:18', '2026-04-11 11:40:18'),
(51, 'App\\Models\\User', 6, 'auth_token', '9a7d096f5512971937573b8d7564327ee01a3a176f466508bcea1d45d5fbb054', '[\"*\"]', '2026-04-11 11:40:56', NULL, '2026-04-11 11:40:52', '2026-04-11 11:40:56'),
(52, 'App\\Models\\User', 6, 'auth_token', '148e2597d7bbfeecf4874abf0aaf610c77724e9f43c910e2222553d2e744da0a', '[\"*\"]', '2026-04-11 11:52:05', NULL, '2026-04-11 11:41:08', '2026-04-11 11:52:05'),
(53, 'App\\Models\\User', 6, 'auth_token', 'bbd1710165cb38af3bc340cbf5b6f0a4ba63221730ae28f73a33e9f435d0b073', '[\"*\"]', '2026-04-11 11:52:31', NULL, '2026-04-11 11:52:23', '2026-04-11 11:52:31'),
(54, 'App\\Models\\User', 7, 'auth_token', 'a24244a0b292ea451f1a22a1edf235ff4f5b16c2e430bd92bf999408e601e58d', '[\"*\"]', NULL, NULL, '2026-04-11 11:53:50', '2026-04-11 11:53:50'),
(55, 'App\\Models\\User', 7, 'auth_token', '5aae6cbd35aaf9edf6f5d329bce2a620c46a0f505ce71ff3dae58587b9ea01e6', '[\"*\"]', '2026-04-11 11:54:03', NULL, '2026-04-11 11:53:59', '2026-04-11 11:54:03'),
(56, 'App\\Models\\User', 7, 'auth_token', '456c6e1bd7c1e1060b6e81cf7dc97b2c1d0736286540ada7d59cf6f6d0422aaa', '[\"*\"]', '2026-04-11 11:54:17', NULL, '2026-04-11 11:54:13', '2026-04-11 11:54:17'),
(57, 'App\\Models\\User', 8, 'auth_token', '3b0e6bbd391ce5c37e2003be1c4fa51969d8023b52cbd067f743c7ae4943bc29', '[\"*\"]', NULL, NULL, '2026-04-11 11:56:25', '2026-04-11 11:56:25'),
(58, 'App\\Models\\User', 1, 'auth_token', '44531b5f6751e945e629c8d426c1a46fb47df1cf36bc2f1a74e7b54b0306b844', '[\"*\"]', '2026-04-11 11:57:00', NULL, '2026-04-11 11:56:51', '2026-04-11 11:57:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `sub_images` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `description`, `content`, `price`, `image`, `sub_images`, `is_active`, `is_featured`, `created_at`, `updated_at`) VALUES
(10, 5, 'Bánh 1', 'banh-1', '<p>Ngon</p>', '<h2 class=\"ql-align-justify\">Mô tả bánh</h2><p class=\"ql-align-justify\">Sự rực rỡ bên ngoài như một lời mời gọi đầy háo hức, khiến bạn phải đưa tay xắn nhẹ từng lớp bánh và thưởng thức. Nhưng chầm chậm từng chút để làn hương dịu ngọt mỏng mảnh ấy bao bọc lấy mình và cảm nhận mùi kem sữa, lớp custard sữa bắp đậm đà cùng lớp bánh Charlotte mềm ẩm tan dần êm ái trên đầu lưỡi.</p><p class=\"ql-align-justify\">Mình luôn tin một hương vị đẹp sẽ luôn còn mãi, chúng âm ỉ chảy trong lòng thành thứ kỷ niệm ngọt lành. Để lúc vui bạn hồi tưởng, khi buồn lại khe khẽ mở ra để tìm chút khoái cảm dễ chịu cho mình. Mong rằng chiếc bánh này sẽ được cùng bạn viết nên thật nhiều những êm đềm như thế!</p><ul><li class=\"ql-align-justify\">Size đường kính 16 cm, cao 6.5 cm cho 4-6 người ăn.</li><li class=\"ql-align-justify\">Size đường kính 20 cm, cao 6.5 cm cho 10-12 người ăn.</li></ul><h2 class=\"ql-align-justify\">Cấu trúc bánh:</h2><ul><li class=\"ql-align-justify\">Lớp 1: Bánh bông lan hương vani ngọt dịu</li><li class=\"ql-align-justify\">Lớp 2: Kem custard ngậy béo</li><li class=\"ql-align-justify\">Lớp 3: Bánh bông lan hương vani ngọt dịu</li><li class=\"ql-align-justify\">Lớp 4: Mousse bắp mịn mát</li><li class=\"ql-align-justify\">Lớp 5: Phủ bên ngoài là lớp bánh Charlotte ẩm mềm, tan trong miệng</li></ul><h2 class=\"ql-align-justify\">Phụ kiện tặng kèm:</h2><ul><li class=\"ql-align-justify\">Bộ dao, muỗng gỗ &amp; dĩa ăn kèm</li><li class=\"ql-align-justify\">Hộp nến</li></ul><h2 class=\"ql-align-justify\">Hướng dẫn sử dụng:</h2><ul><li class=\"ql-align-justify\">Nên giữ bánh trong hộp kín và bảo quản bánh trong ngăn mát tủ lạnh.</li><li class=\"ql-align-justify\">Hạn chế để bánh tiếp xúc với ánh nắng trực tiếp và tránh để bánh quá lâu ở nhiệt độ phòng.</li><li class=\"ql-align-justify\">Sử dụng trong vòng 24h.</li></ul><p><br></p>', 123.00, 'http://localhost/Web_banhang/backend/public/uploads/1775494055_banh-3.jpg', '[]', 1, 1, '2026-04-06 09:47:35', '2026-04-11 10:22:17'),
(11, 5, 'Bánh 2', 'banh-2', '<p>Ngon</p>', NULL, 132.00, 'http://localhost/Web_banhang/backend/public/uploads/1775494066_tải xuống (1).jpeg', '[]', 1, 1, '2026-04-06 09:47:46', '2026-04-11 10:22:17'),
(12, 5, 'Bánh 3', 'banh-3', '<p>Ngon</p>', NULL, 12344.00, 'http://localhost/Web_banhang/backend/public/uploads/1775494078_tải xuống (3).jpeg', '[]', 1, 1, '2026-04-06 09:47:58', '2026-04-11 10:14:35'),
(13, 7, 'Bánh 4', 'banh-4', '<p>Ngon</p><p><br></p>', NULL, 123.00, 'http://localhost/Web_banhang/backend/public/uploads/1775494090_tải xuống (6).jpeg', '[]', 1, 1, '2026-04-06 09:48:10', '2026-04-11 10:14:34'),
(14, 7, 'Bánh 6', 'banh-6', '<p>Ngon lắm </p><p><br></p>', NULL, 1235.00, 'http://localhost/Web_banhang/backend/public/uploads/1775494106_tải xuống (5).jpeg', '[]', 1, 1, '2026-04-06 09:48:26', '2026-04-11 10:14:33'),
(17, 5, '2221', '2221', '<p>Ngon</p>', '<p><br></p>', 22220.00, 'http://localhost/Web_banhang/backend/public/uploads/1775496361_tải xuống (2).jpeg', '[\"http:\\/\\/localhost\\/Web_banhang\\/backend\\/public\\/uploads\\/1775496361_sub_0_ta\\u0309i xuo\\u0302\\u0301ng (3).jpeg\",\"http:\\/\\/localhost\\/Web_banhang\\/backend\\/public\\/uploads\\/1775496361_sub_1_ta\\u0309i xuo\\u0302\\u0301ng (4).jpeg\",\"http:\\/\\/localhost\\/Web_banhang\\/backend\\/public\\/uploads\\/1775496361_sub_2_ta\\u0309i xuo\\u0302\\u0301ng (2).jpeg\",\"http:\\/\\/localhost\\/Web_banhang\\/backend\\/public\\/uploads\\/1775496361_sub_3_ta\\u0309i xuo\\u0302\\u0301ng (3).jpeg\"]', 1, 1, '2026-04-06 10:26:01', '2026-04-11 10:12:50'),
(18, 9, 'Bánh Kem Dâu Tây', 'banh-kem-dau-tay', 'Bánh kem tươi hương dâu ngọt ngào, mềm mịn.', '<p><br></p>', 250000.00, 'https://images.unsplash.com/photo-1542826438-bd32f43d626f?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80', '[]', 1, 1, '2026-04-07 09:17:39', '2026-04-11 10:08:11'),
(19, 9, 'Bánh Kem Socola', 'banh-kem-socola', 'Bánh kem socola nguyên chất, đậm vị hấp dẫn.', '<p><br></p>', 280000.00, 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80', '[]', 1, 1, '2026-04-07 09:17:39', '2026-04-11 10:08:11'),
(20, 10, 'Bánh Mì Hoa Cúc', 'banh-mi-hoa-cuc', 'Bánh mì Pháp trứ danh thơm mùi bơ hoa cúc.', '<p><br></p>', 120000.00, 'https://images.unsplash.com/photo-1509440159596-0249088772ff?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80', '[]', 1, 1, '2026-04-07 09:17:39', '2026-04-11 10:03:55'),
(21, 5, 'Macaron Pháp', 'macaron-phap', 'Bánh macaron nhiều vị nhập khẩu thơm lừng.', '<p><br></p>', 45000.00, 'https://images.unsplash.com/photo-1569864358642-9d1684040f43?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80', '[]', 1, 1, '2026-04-07 09:17:39', '2026-04-11 10:03:58');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
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
-- Đang đổ dữ liệu cho bảng `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('o9IzLECNE78hpbfnmALxKhMs98j8mmjvS487yXiJ', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJFWFBhWjVEamtUdk1PYVhtNFZXU0xMRFFJZFNiVlM4OVR1TTJQUEtVIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAxIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1775651327),
('vasFa5oJ9sWGiI1YURvWjk4NuYiExZRDptKyLQVG', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJkUlhVUng2MXg0YzE5UVg3clNqUWc0Q2tBdXVSTmdiVlNYY1JzQmY1IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1775235295);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `image`, `email_verified_at`, `password`, `phone`, `address`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', 'admin@email.com', NULL, NULL, '$2y$12$9HFUuMRApiF1xb3GR8DT.eeUty613OhjOxL6Sz7f0E3G/eUaRwQI.', NULL, NULL, 'admin', NULL, '2026-04-03 04:54:21', '2026-04-07 09:17:39'),
(3, 'thịnh', 'Phan Hùng', 'phanhungthinh0123@gmail.com', NULL, NULL, '$2y$12$ZQD7pjH61OHqcuPFC0xDs.qOjPDa.ut5H92f2hKyi/IsbTnbUe2x6', '0965050142', 'Quận 12', 'user', NULL, '2026-04-03 04:56:02', '2026-04-03 04:56:02'),
(4, 'thinh123', 'Phan Hùng Thịnh', 'phanhungthinh@gmail.com', 'uploads/avatars/1775661856_download.jpg', NULL, '$2y$12$/qCgSLrBGizzzwoIXUPIN.DewdwrI2MbzIB.70VvBVeaY8gYnOjTO', NULL, NULL, 'user', NULL, '2026-04-03 10:04:08', '2026-04-08 08:24:16'),
(6, 'nguyentai', 'Anh Tài', 'tai@gmail.com', NULL, NULL, '$2y$12$BiaD4ZqnGeUZIaJQxq7Uj.Jq2GN7kTDsOLrxIY3kt1fzfHQPKsX2q', '0987867676', 'Quận 10', 'user', NULL, '2026-04-11 11:40:18', '2026-04-11 11:40:18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_addresses`
--

CREATE TABLE `user_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_name` varchar(255) NOT NULL,
  `receiver_phone` varchar(255) NOT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `receiver_email` varchar(255) DEFAULT NULL,
  `province` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `ward` varchar(255) NOT NULL,
  `province_code` varchar(255) NOT NULL,
  `district_code` varchar(255) NOT NULL,
  `ward_code` varchar(255) NOT NULL,
  `detail_address` varchar(255) NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user_addresses`
--

INSERT INTO `user_addresses` (`id`, `user_id`, `receiver_name`, `receiver_phone`, `alias`, `receiver_email`, `province`, `district`, `ward`, `province_code`, `district_code`, `ward_code`, `detail_address`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 4, 'Thịnh', '0965050142', 'Nhà', 'phanhungthinh0123@gmail.com', 'Thành phố Hồ Chí Minh', 'Quận Bình Thạnh', 'Phường 26', '79', '765', '26914', '201 Nguyễn Xí', 1, '2026-04-08 07:43:28', '2026-04-08 08:17:21'),
(3, 6, 'Anh Tiến', '098675733', 'Nhà riêng', 'tt@gmail.com', 'Thành phố Hồ Chí Minh', 'Thành phố Thủ Đức', 'Phường Bình Chiểu', '79', '769', '26797', 'quận 2', 1, '2026-04-11 11:50:18', '2026-04-11 11:50:18');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Chỉ mục cho bảng `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Chỉ mục cho bảng `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Chỉ mục cho bảng `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- Chỉ mục cho bảng `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_addresses_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `user_addresses`
--
ALTER TABLE `user_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD CONSTRAINT `user_addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
