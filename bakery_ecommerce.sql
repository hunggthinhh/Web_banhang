-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th5 27, 2026 lúc 09:11 AM
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
(9, 'Bánh Kem', 'banh-kem', '2026-04-07 09:17:39', '2026-04-07 09:17:39'),
(11, 'Bánh Tiramisu', 'banh-tiramisu', '2026-04-12 23:57:43', '2026-04-12 23:57:43'),
(12, 'Bánh Mousse', 'banh-mousse', '2026-04-13 00:13:07', '2026-04-13 00:13:07');

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
(3, NULL, 'Thịnh Phan Hùng', 'thinhph0343@ut.edu.vn', '0965050142', 'Món hấp dẫn', 'Ngon quá', 1, '2026-04-05 10:11:52', '2026-04-17 03:25:00'),
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
(23, '2026_04_11_175022_remove_description_from_categories_table', 14),
(24, '2026_04_13_124114_add_cart_to_users_table', 15),
(25, '2026_04_13_152046_add_payment_fields_to_orders_table', 16),
(26, '2026_04_24_140000_add_note_to_orders_table', 17),
(27, '2026_04_24_143000_add_greeting_to_order_items_table', 18),
(28, '2026_05_09_154520_add_customer_email_to_orders_table', 19),
(29, '2026_05_10_034554_create_reviews_table', 20),
(30, '2026_05_10_035332_add_order_item_id_to_reviews_table', 21),
(31, '2026_05_10_121257_add_discount_percent_to_products_table', 22),
(32, '2026_05_10_122256_add_discount_ends_at_to_products_table', 23);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_phone` varchar(255) NOT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `customer_address` varchar(255) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(255) NOT NULL DEFAULT 'cod',
  `payment_status` varchar(255) NOT NULL DEFAULT 'unpaid',
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `note` text DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `delivery_time` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `customer_name`, `customer_phone`, `customer_email`, `customer_address`, `total_amount`, `payment_method`, `payment_status`, `status`, `note`, `delivery_date`, `delivery_time`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Phan Hùng Thịnh', '0965050142', NULL, '201/46/25 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 22220.00, 'cod', 'unpaid', 'cancelled', NULL, NULL, NULL, '2026-04-06 11:53:59', '2026-04-13 11:21:19'),
(2, NULL, 'Phan Hùng Thịnh', '0965050142', NULL, '201/46/25 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 22220.00, 'cod', 'unpaid', 'cancelled', NULL, NULL, NULL, '2026-04-06 11:54:02', '2026-04-06 12:08:58'),
(3, NULL, 'Phan Hùng Thịnh', '0965050142', NULL, '201/46/25 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 22220.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-06 11:54:09', '2026-04-06 11:54:09'),
(4, NULL, 'Phan Hùng Thịnh', '0965050142', NULL, '201/46/25 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 22220.00, 'cod', 'unpaid', 'cancelled', NULL, NULL, NULL, '2026-04-06 11:54:21', '2026-04-06 12:08:46'),
(5, NULL, 'Phan Hùng Thịnh', '0965050142', NULL, '201/46/25 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 22220.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-06 11:54:35', '2026-04-06 11:54:35'),
(6, NULL, 'Phan Hùng Thịnh', '0965050142', NULL, '564, Xã Vĩnh Phương, Thành phố Nha Trang, Tỉnh Khánh Hòa', 22220.00, 'cod', 'unpaid', 'delivered', NULL, NULL, NULL, '2026-04-06 11:57:01', '2026-04-06 12:04:59'),
(7, 4, 'Phan Hùng Thịnh', '0965050142', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 90000.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-08 08:29:23', '2026-04-08 08:29:23'),
(8, 4, 'Phan Hùng Thịnh', '0965050142', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 123.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-08 08:36:41', '2026-04-08 08:36:41'),
(9, NULL, 'Anh Tiến', '098675733', NULL, 'quận 2, Phường Bình Chiểu, Thành phố Thủ Đức, Thành phố Hồ Chí Minh', 45000.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-11 11:52:03', '2026-04-11 11:52:03'),
(10, 4, 'Thịnh', '0965050142', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 350000.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-13 04:44:51', '2026-04-13 04:44:51'),
(11, 4, 'Thịnh', '0965050142', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 300000.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-13 05:33:10', '2026-04-13 05:33:10'),
(12, 4, 'Thịnh', '0965050142', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 350000.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-13 05:35:43', '2026-04-13 05:35:43'),
(13, 4, 'Thịnh', '0965050142', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 830000.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-13 05:51:59', '2026-04-13 05:51:59'),
(14, 4, 'Thịnh', '0965050142', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 300000.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-13 05:52:07', '2026-04-13 05:52:07'),
(15, 4, 'Thịnh', '0965050142', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 300000.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-13 05:53:06', '2026-04-13 05:53:06'),
(16, 4, 'Thịnh', '0965050142', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 580000.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-13 05:53:36', '2026-04-13 05:53:36'),
(17, 4, 'Thịnh', '0965050142', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 530000.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-13 05:58:38', '2026-04-13 05:58:38'),
(18, 4, 'Thịnh', '0965050142', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 580000.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-13 06:32:36', '2026-04-13 06:32:36'),
(19, 4, 'Thịnh', '0965050142', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 530000.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-13 06:34:43', '2026-04-13 06:34:43'),
(21, 4, 'Thịnh', '0965050142', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 350000.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-13 06:41:33', '2026-04-13 06:41:33'),
(22, 4, 'Thịnh', '0965050142', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 530000.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-13 06:42:49', '2026-04-13 06:42:49'),
(23, 11, 'Ngân', '0333594833', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 530000.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-13 07:58:54', '2026-04-13 07:58:54'),
(24, 11, 'Ngân', '0333594833', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 530000.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-13 08:02:28', '2026-04-13 08:02:28'),
(25, 11, 'Ngân', '0333594833', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 350000.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-13 08:30:26', '2026-04-13 08:30:26'),
(26, 11, 'Ngân', '0333594833', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 580000.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-13 08:31:06', '2026-04-13 08:31:06'),
(27, 11, 'Ngân', '0333594833', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 2000.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-13 08:51:16', '2026-04-13 08:51:16'),
(28, 11, 'Ngân', '0333594833', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 2000.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-13 08:51:56', '2026-04-13 08:51:56'),
(29, 11, 'Ngân', '0333594833', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 2000.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-13 09:22:54', '2026-04-13 09:22:54'),
(30, 11, 'Ngân', '0333594833', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 4000.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-13 09:38:09', '2026-04-13 09:38:09'),
(31, 11, 'Ngân', '0333594833', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 2852000.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-13 09:53:30', '2026-04-13 09:53:30'),
(32, 11, 'Ngân', '0333594833', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 2000.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-13 09:59:57', '2026-04-13 09:59:57'),
(33, 11, 'Ngân', '0333594833', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 2000.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-13 10:04:51', '2026-04-13 10:04:51'),
(34, 11, 'Ngân', '0333594833', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 2000.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-13 10:05:22', '2026-04-13 10:05:22'),
(35, 11, 'Ngân', '0333594833', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 2000.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-13 10:06:23', '2026-04-13 10:06:23'),
(36, 11, 'Ngân', '0333594833', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 2000.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-13 10:07:53', '2026-04-13 10:07:53'),
(37, 11, 'Ngân', '0333594833', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 2000.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-13 10:11:40', '2026-04-13 10:11:40'),
(38, 11, 'Ngân', '0333594833', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 2000.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-13 10:15:16', '2026-04-13 10:15:16'),
(39, 11, 'Ngân', '0333594833', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 2000.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-13 10:31:45', '2026-04-13 10:31:45'),
(40, 11, 'Ngân', '0333594833', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 2000.00, 'cod', 'unpaid', 'confirmed', NULL, NULL, NULL, '2026-04-13 10:44:09', '2026-04-13 10:53:09'),
(41, 11, 'Ngân', '0333594833', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 2000.00, 'cod', 'unpaid', 'delivered', NULL, NULL, NULL, '2026-04-13 10:53:43', '2026-04-13 11:58:56'),
(42, 11, 'Ngân', '0333594833', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 4000.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-13 11:22:00', '2026-04-13 11:22:00'),
(43, 11, 'Ngân', '0333594833', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 2000.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-13 11:34:57', '2026-04-13 11:34:57'),
(44, 11, 'Ngân', '0333594833', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 2000.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-13 11:35:12', '2026-04-13 11:35:12'),
(45, 11, 'Ngân', '0333594833', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 2000.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-13 11:37:36', '2026-04-13 11:37:36'),
(46, 11, 'Ngân', '0333594833', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 2000.00, 'cod', 'unpaid', 'confirmed', NULL, NULL, NULL, '2026-04-13 11:37:52', '2026-04-13 11:38:09'),
(47, 11, 'Ngân', '0333594833', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 2000.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-13 11:49:15', '2026-04-13 11:49:15'),
(48, 11, 'Ngân', '0333594833', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 2000.00, 'cod', 'unpaid', 'confirmed', NULL, NULL, NULL, '2026-04-13 11:49:22', '2026-04-13 11:49:42'),
(49, 11, 'Ngân', '0333594833', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 2000.00, 'cod', 'unpaid', 'confirmed', NULL, NULL, NULL, '2026-04-13 11:56:47', '2026-04-13 11:57:37'),
(50, 11, 'Ngân', '0333594833', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 2000.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-13 12:00:12', '2026-04-13 12:00:12'),
(51, 11, 'Ngân', '0333594833', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 2000.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-13 12:00:26', '2026-04-13 12:00:26'),
(52, 11, 'Ngân', '0333594833', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 2000.00, 'cod', 'unpaid', 'confirmed', NULL, NULL, NULL, '2026-04-13 12:02:45', '2026-04-13 12:03:23'),
(53, 11, 'Ngân', '0333594833', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 2000.00, 'bank', 'paid', 'confirmed', NULL, NULL, NULL, '2026-04-13 12:07:03', '2026-04-13 12:07:19'),
(54, 11, 'Ngân', '0333594833', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 2000.00, 'bank', 'paid', 'confirmed', NULL, NULL, NULL, '2026-04-13 12:11:46', '2026-04-13 12:12:04'),
(55, 11, 'Ngân', '0333594833', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 2000.00, 'bank', 'paid', 'confirmed', NULL, NULL, NULL, '2026-04-13 12:31:30', '2026-04-13 12:32:03'),
(56, 11, 'Ngân', '0333594833', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 2000.00, 'bank', 'paid', 'confirmed', NULL, NULL, NULL, '2026-04-13 12:34:15', '2026-04-13 12:34:39'),
(57, 11, 'Ngân', '0333594833', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 2000.00, 'bank', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-13 12:35:05', '2026-04-13 12:35:05'),
(58, 11, 'Ngân', '0333594833', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 2000.00, 'bank', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-13 12:35:19', '2026-04-13 12:35:19'),
(59, 11, 'Ngân', '0333594833', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 4000.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-13 12:35:47', '2026-04-13 12:35:47'),
(60, 11, 'Ngân', '0333594833', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 2000.00, 'bank', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-13 12:35:55', '2026-04-13 12:35:55'),
(61, 11, 'Ngân', '0333594833', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 4000.00, 'bank', 'paid', 'confirmed', NULL, NULL, NULL, '2026-04-13 12:36:09', '2026-04-13 12:36:43'),
(62, 11, 'Ngân', '0333594833', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 2000.00, 'bank', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-13 12:37:07', '2026-04-13 12:37:07'),
(63, 11, 'Ngân', '0333594833', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 2000.00, 'bank', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-13 12:37:18', '2026-04-13 12:37:18'),
(64, 11, 'Ngân', '0333594833', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 4000.00, 'bank', 'paid', 'confirmed', NULL, NULL, NULL, '2026-04-13 12:37:41', '2026-04-21 05:46:21'),
(65, NULL, 'Thịnh cute', '0909000905', NULL, 'Chùa cute, Xã Điền Trung, Huyện Bá Thước, Tỉnh Thanh Hóa', 5000.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-13 23:59:41', '2026-04-13 23:59:41'),
(68, NULL, 'Hùng Thịnh', '0965050142', NULL, '70 Tô ký Quận 12, Phường Giang Biên, Quận Long Biên, Thành phố Hà Nội', 5000.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-21 03:26:24', '2026-04-21 03:26:24'),
(69, NULL, 'Thịnh', '0965050142', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 5000.00, 'cod', 'unpaid', 'delivered', NULL, NULL, NULL, '2026-04-21 05:21:23', '2026-04-21 05:28:13'),
(70, NULL, 'Thịnh', '0965050142', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 300000.00, 'cod', 'paid', 'returned', 'Lý do trả: Sản phẩm bị lỗi', NULL, NULL, '2026-04-23 23:51:41', '2026-04-24 00:10:23'),
(71, NULL, 'Thịnh', '0965050142', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 250000.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-04-24 00:26:10', '2026-04-24 00:26:10'),
(72, NULL, 'Thịnh', '0965050142', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 350000.00, 'cod', 'unpaid', 'pending', 'Tầng 3', '2026-04-27', '08:00 - 10:00', '2026-04-24 00:32:36', '2026-04-24 00:32:36'),
(73, NULL, 'Thịnh', '0965050142', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 5000.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-05-06 04:04:14', '2026-05-06 04:04:14'),
(74, NULL, 'Thịnh', '0965050142', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 5000.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-05-06 06:01:14', '2026-05-06 06:01:14'),
(75, NULL, 'Thịnh', '0965050142', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 5000.00, 'bank', 'unpaid', 'returned', 'Lý do trả: Sản phẩm bị lỗi', NULL, NULL, '2026-05-06 06:01:29', '2026-05-06 06:05:17'),
(76, NULL, 'Thịnh', '0965050142', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 10000.00, 'bank', 'paid', 'delivered', NULL, NULL, NULL, '2026-05-06 06:05:50', '2026-05-09 09:21:36'),
(77, NULL, 'Thịnh', '0965050142', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 5000.00, 'bank', 'paid', 'delivered', NULL, NULL, NULL, '2026-05-09 08:39:12', '2026-05-09 09:21:30'),
(78, NULL, 'Thịnh', '0965050142', NULL, '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 5000.00, 'bank', 'paid', 'delivered', NULL, NULL, NULL, '2026-05-09 08:42:00', '2026-05-09 09:21:23'),
(79, NULL, 'Thịnh', '0965050142', 'phanhungthinh0123@gmail.com', '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 5000.00, 'bank', 'paid', 'delivered', NULL, NULL, NULL, '2026-05-09 08:47:57', '2026-05-09 09:21:08'),
(80, NULL, 'Thịnh', '0965050142', 'phanhungthinh0123@gmail.com', '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 5000.00, 'cod', 'paid', 'delivered', NULL, NULL, NULL, '2026-05-09 08:54:26', '2026-05-09 09:21:01'),
(81, NULL, 'Thịnh', '0965050142', 'phanhungthinh0123@gmail.com', '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 350000.00, 'cod', 'paid', 'returned', 'Lý do trả: loi', NULL, NULL, '2026-05-09 09:26:21', '2026-05-09 10:25:52'),
(82, 4, 'Thịnh', '0965050142', 'phattuan460@gmail.com', '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 2676000.00, 'payos', 'paid', 'delivered', NULL, NULL, NULL, '2026-05-10 09:09:41', '2026-05-10 09:55:42'),
(83, 4, 'Thịnh', '0965050142', 'phattuan460@gmail.com', '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 260000.00, 'cod', 'paid', 'delivered', NULL, NULL, NULL, '2026-05-10 09:10:13', '2026-05-10 09:55:42'),
(84, 4, 'Thịnh', '0965050142', 'phattuan460@gmail.com', '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 100000.00, 'cod', 'paid', 'delivered', NULL, NULL, NULL, '2026-05-10 09:16:26', '2026-05-10 09:55:42'),
(85, 4, 'Thịnh', '0965050142', 'phattuan460@gmail.com', '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 100000.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-05-10 09:17:36', '2026-05-10 09:55:42'),
(86, 4, 'Thịnh', '0965050142', 'phattuan460@gmail.com', '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 530000.00, 'cod', 'paid', 'delivered', NULL, NULL, NULL, '2026-05-10 09:18:08', '2026-05-10 09:55:42'),
(87, NULL, 'Thịnh', '0965050142', 'phanhungthinh0123@gmail.com', '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 300000.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-05-10 09:22:38', '2026-05-10 09:22:38'),
(88, NULL, 'Thịnh', '0965050142', 'phanhungthinh0123@gmail.com', '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 520000.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-05-10 09:23:05', '2026-05-10 09:23:05'),
(89, NULL, 'Thịnh', '0965050142', 'phanhungthinh0123@gmail.com', '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 300000.00, 'cod', 'paid', 'delivered', NULL, NULL, NULL, '2026-05-10 09:26:33', '2026-05-10 10:00:05'),
(90, NULL, 'Thịnh', '0965050142', 'phanhungthinh0123@gmail.com', '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 260000.00, 'cod', 'paid', 'delivered', NULL, NULL, NULL, '2026-05-10 09:28:28', '2026-05-10 09:59:57'),
(91, NULL, 'Thịnh', '0965050142', 'phanhungthinh0123@gmail.com', '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 260000.00, 'cod', 'paid', 'delivered', NULL, NULL, NULL, '2026-05-10 09:30:01', '2026-05-10 09:59:52'),
(92, NULL, 'Thịnh', '0965050142', 'phanhungthinh0123@gmail.com', '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 260000.00, 'cod', 'paid', 'delivered', NULL, NULL, NULL, '2026-05-10 09:32:50', '2026-05-10 09:59:47'),
(93, NULL, 'Thịnh', '0965050142', 'phanhungthinh0123@gmail.com', '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 5000.00, 'cod', 'paid', 'delivered', NULL, NULL, NULL, '2026-05-10 09:51:00', '2026-05-10 09:59:42'),
(94, 4, 'Thịnh', '0965050142', 'phanhungthinh0123@gmail.com', '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 530000.00, 'cod', 'paid', 'delivered', NULL, NULL, NULL, '2026-05-10 09:58:42', '2026-05-10 09:59:09'),
(95, 4, 'Thịnh', '0965050142', 'phanhungthinh0123@gmail.com', '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 5000.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-05-10 10:00:19', '2026-05-10 10:00:19'),
(96, 4, 'Thịnh', '0965050142', 'phattuan460@gmail.com', '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 522000.00, 'cod', 'paid', 'delivered', NULL, NULL, NULL, '2026-05-10 10:01:43', '2026-05-10 10:02:10'),
(97, 4, 'Thịnh', '0965050142', 'phattuan460@gmail.com', '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 522000.00, 'cod', 'paid', 'delivered', NULL, NULL, NULL, '2026-05-10 10:07:45', '2026-05-10 10:08:02'),
(98, 4, 'Thịnh', '0965050142', 'phattuan460@gmail.com', '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 5000.00, 'cod', 'paid', 'delivered', NULL, NULL, NULL, '2026-05-17 08:04:27', '2026-05-17 08:05:13'),
(99, 4, 'Thịnh', '0965050142', 'phattuan460@gmail.com', '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 530000.00, 'cod', 'paid', 'delivered', NULL, NULL, NULL, '2026-05-17 08:10:14', '2026-05-17 08:10:34'),
(100, 4, 'Thịnh', '0965050142', 'phanhungthinh0123@gmail.com', '201 Nguyễn Xí, Phường 26, Quận Bình Thạnh, Thành phố Hồ Chí Minh', 300000.00, 'cod', 'unpaid', 'pending', NULL, NULL, NULL, '2026-05-17 08:37:52', '2026-05-17 08:37:52');

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
  `greeting` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `price`, `quantity`, `greeting`, `created_at`, `updated_at`) VALUES
(10, 10, 25, 'Bánh Blueberry Oreo Cheese', 350000.00, 1, NULL, '2026-04-13 04:44:51', '2026-04-13 04:44:51'),
(11, 11, 24, 'Bánh Kem Pink Drip & Bows', 300000.00, 1, NULL, '2026-04-13 05:33:10', '2026-04-13 05:33:10'),
(12, 12, 25, 'Bánh Blueberry Oreo Cheese', 350000.00, 1, NULL, '2026-04-13 05:35:43', '2026-04-13 05:35:43'),
(13, 13, 24, 'Bánh Kem Pink Drip & Bows', 300000.00, 1, NULL, '2026-04-13 05:51:59', '2026-04-13 05:51:59'),
(14, 13, 34, 'Mousse Xoài', 530000.00, 1, NULL, '2026-04-13 05:51:59', '2026-04-13 05:51:59'),
(15, 14, 24, 'Bánh Kem Pink Drip & Bows', 300000.00, 1, NULL, '2026-04-13 05:52:07', '2026-04-13 05:52:07'),
(16, 15, 24, 'Bánh Kem Pink Drip & Bows', 300000.00, 1, NULL, '2026-04-13 05:53:06', '2026-04-13 05:53:06'),
(17, 16, 31, 'Tiramisu', 580000.00, 1, NULL, '2026-04-13 05:53:36', '2026-04-13 05:53:36'),
(18, 17, 34, 'Mousse Xoài', 530000.00, 1, NULL, '2026-04-13 05:58:38', '2026-04-13 05:58:38'),
(19, 18, 35, 'Mousse Bưởi hồng', 580000.00, 1, NULL, '2026-04-13 06:32:36', '2026-04-13 06:32:36'),
(20, 19, 34, 'Mousse Xoài', 530000.00, 1, NULL, '2026-04-13 06:34:43', '2026-04-13 06:34:43'),
(22, 21, 25, 'Bánh Blueberry Oreo Cheese', 350000.00, 1, NULL, '2026-04-13 06:41:33', '2026-04-13 06:41:33'),
(23, 22, 34, 'Mousse Xoài', 530000.00, 1, NULL, '2026-04-13 06:42:49', '2026-04-13 06:42:49'),
(24, 23, 34, 'Mousse Xoài', 530000.00, 1, NULL, '2026-04-13 07:58:54', '2026-04-13 07:58:54'),
(25, 24, 34, 'Mousse Xoài', 530000.00, 1, NULL, '2026-04-13 08:02:28', '2026-04-13 08:02:28'),
(26, 25, 25, 'Bánh Blueberry Oreo Cheese', 350000.00, 1, NULL, '2026-04-13 08:30:26', '2026-04-13 08:30:26'),
(27, 26, 35, 'Mousse Bưởi hồng', 580000.00, 1, NULL, '2026-04-13 08:31:06', '2026-04-13 08:31:06'),
(28, 27, 27, 'Tiramisu Box', 2000.00, 1, NULL, '2026-04-13 08:51:16', '2026-04-13 08:51:16'),
(29, 28, 27, 'Tiramisu Box', 2000.00, 1, NULL, '2026-04-13 08:51:56', '2026-04-13 08:51:56'),
(30, 29, 27, 'Tiramisu Box', 2000.00, 1, NULL, '2026-04-13 09:22:54', '2026-04-13 09:22:54'),
(31, 30, 27, 'Tiramisu Box', 2000.00, 2, NULL, '2026-04-13 09:38:09', '2026-04-13 09:38:09'),
(32, 31, 35, 'Mousse Bưởi hồng', 580000.00, 4, NULL, '2026-04-13 09:53:30', '2026-04-13 09:53:30'),
(33, 31, 34, 'Mousse Xoài', 530000.00, 1, NULL, '2026-04-13 09:53:30', '2026-04-13 09:53:30'),
(34, 31, 27, 'Tiramisu Box', 2000.00, 1, NULL, '2026-04-13 09:53:30', '2026-04-13 09:53:30'),
(35, 32, 27, 'Tiramisu Box', 2000.00, 1, NULL, '2026-04-13 09:59:57', '2026-04-13 09:59:57'),
(36, 33, 27, 'Tiramisu Box', 2000.00, 1, NULL, '2026-04-13 10:04:51', '2026-04-13 10:04:51'),
(37, 34, 27, 'Tiramisu Box', 2000.00, 1, NULL, '2026-04-13 10:05:22', '2026-04-13 10:05:22'),
(38, 35, 27, 'Tiramisu Box', 2000.00, 1, NULL, '2026-04-13 10:06:23', '2026-04-13 10:06:23'),
(39, 36, 27, 'Tiramisu Box', 2000.00, 1, NULL, '2026-04-13 10:07:53', '2026-04-13 10:07:53'),
(40, 37, 27, 'Tiramisu Box', 2000.00, 1, NULL, '2026-04-13 10:11:40', '2026-04-13 10:11:40'),
(41, 38, 27, 'Tiramisu Box', 2000.00, 1, NULL, '2026-04-13 10:15:16', '2026-04-13 10:15:16'),
(42, 39, 27, 'Tiramisu Box', 2000.00, 1, NULL, '2026-04-13 10:31:45', '2026-04-13 10:31:45'),
(43, 40, 27, 'Tiramisu Box', 2000.00, 1, NULL, '2026-04-13 10:44:09', '2026-04-13 10:44:09'),
(44, 41, 27, 'Tiramisu Box', 2000.00, 1, NULL, '2026-04-13 10:53:43', '2026-04-13 10:53:43'),
(45, 42, 27, 'Tiramisu Box', 2000.00, 2, NULL, '2026-04-13 11:22:00', '2026-04-13 11:22:00'),
(46, 43, 27, 'Tiramisu Box', 2000.00, 1, NULL, '2026-04-13 11:34:57', '2026-04-13 11:34:57'),
(47, 44, 27, 'Tiramisu Box', 2000.00, 1, NULL, '2026-04-13 11:35:12', '2026-04-13 11:35:12'),
(48, 45, 27, 'Tiramisu Box', 2000.00, 1, NULL, '2026-04-13 11:37:36', '2026-04-13 11:37:36'),
(49, 46, 27, 'Tiramisu Box', 2000.00, 1, NULL, '2026-04-13 11:37:52', '2026-04-13 11:37:52'),
(50, 47, 27, 'Tiramisu Box', 2000.00, 1, NULL, '2026-04-13 11:49:15', '2026-04-13 11:49:15'),
(51, 48, 27, 'Tiramisu Box', 2000.00, 1, NULL, '2026-04-13 11:49:22', '2026-04-13 11:49:22'),
(52, 49, 27, 'Tiramisu Box', 2000.00, 1, NULL, '2026-04-13 11:56:47', '2026-04-13 11:56:47'),
(53, 50, 27, 'Tiramisu Box', 2000.00, 1, NULL, '2026-04-13 12:00:12', '2026-04-13 12:00:12'),
(54, 51, 27, 'Tiramisu Box', 2000.00, 1, NULL, '2026-04-13 12:00:26', '2026-04-13 12:00:26'),
(55, 52, 27, 'Tiramisu Box', 2000.00, 1, NULL, '2026-04-13 12:02:45', '2026-04-13 12:02:45'),
(56, 53, 27, 'Tiramisu Box', 2000.00, 1, NULL, '2026-04-13 12:07:03', '2026-04-13 12:07:03'),
(57, 54, 27, 'Tiramisu Box', 2000.00, 1, NULL, '2026-04-13 12:11:46', '2026-04-13 12:11:46'),
(58, 55, 27, 'Tiramisu Box', 2000.00, 1, NULL, '2026-04-13 12:31:30', '2026-04-13 12:31:30'),
(59, 56, 27, 'Tiramisu Box', 2000.00, 1, NULL, '2026-04-13 12:34:15', '2026-04-13 12:34:15'),
(60, 57, 27, 'Tiramisu Box', 2000.00, 1, NULL, '2026-04-13 12:35:05', '2026-04-13 12:35:05'),
(61, 58, 27, 'Tiramisu Box', 2000.00, 1, NULL, '2026-04-13 12:35:19', '2026-04-13 12:35:19'),
(62, 59, 27, 'Tiramisu Box', 2000.00, 2, NULL, '2026-04-13 12:35:47', '2026-04-13 12:35:47'),
(63, 60, 27, 'Tiramisu Box', 2000.00, 1, NULL, '2026-04-13 12:35:55', '2026-04-13 12:35:55'),
(64, 61, 27, 'Tiramisu Box', 2000.00, 2, NULL, '2026-04-13 12:36:09', '2026-04-13 12:36:09'),
(65, 62, 27, 'Tiramisu Box', 2000.00, 1, NULL, '2026-04-13 12:37:07', '2026-04-13 12:37:07'),
(66, 63, 27, 'Tiramisu Box', 2000.00, 1, NULL, '2026-04-13 12:37:18', '2026-04-13 12:37:18'),
(67, 64, 27, 'Tiramisu Box', 2000.00, 2, NULL, '2026-04-13 12:37:41', '2026-04-13 12:37:41'),
(68, 65, 26, 'Classic Tiramisu', 5000.00, 1, NULL, '2026-04-13 23:59:41', '2026-04-13 23:59:41'),
(82, 68, 27, 'Tiramisu Box', 5000.00, 1, NULL, '2026-04-21 03:26:24', '2026-04-21 03:26:24'),
(83, 69, 27, 'Tiramisu Box', 5000.00, 1, NULL, '2026-04-21 05:21:23', '2026-04-21 05:21:23'),
(84, 70, 24, 'Bánh Kem Pink Drip & Bows', 300000.00, 1, NULL, '2026-04-23 23:51:41', '2026-04-23 23:51:41'),
(85, 71, 18, 'Bánh Kem Dâu Tây', 250000.00, 1, NULL, '2026-04-24 00:26:10', '2026-04-24 00:26:10'),
(86, 72, 25, 'Bánh Blueberry Oreo Cheese', 350000.00, 1, '', '2026-04-24 00:32:36', '2026-04-24 00:32:36'),
(87, 73, 26, 'Classic Tiramisu', 5000.00, 1, '', '2026-05-06 04:04:14', '2026-05-06 04:04:14'),
(88, 74, 27, 'Tiramisu Box', 5000.00, 1, '', '2026-05-06 06:01:14', '2026-05-06 06:01:14'),
(89, 75, 26, 'Classic Tiramisu', 5000.00, 1, '', '2026-05-06 06:01:29', '2026-05-06 06:01:29'),
(90, 76, 26, 'Classic Tiramisu', 5000.00, 2, '', '2026-05-06 06:05:50', '2026-05-06 06:05:50'),
(91, 77, 27, 'Tiramisu Box', 5000.00, 1, '', '2026-05-09 08:39:12', '2026-05-09 08:39:12'),
(92, 78, 27, 'Tiramisu Box', 5000.00, 1, '', '2026-05-09 08:42:00', '2026-05-09 08:42:00'),
(93, 79, 27, 'Tiramisu Box', 5000.00, 1, '', '2026-05-09 08:47:57', '2026-05-09 08:47:57'),
(94, 80, 27, 'Tiramisu Box', 5000.00, 1, '', '2026-05-09 08:54:26', '2026-05-09 08:54:26'),
(95, 81, 25, 'Bánh Blueberry Oreo Cheese', 350000.00, 1, '', '2026-05-09 09:26:21', '2026-05-09 09:26:21'),
(96, 82, 35, 'Mousse Bưởi hồng', 522000.00, 3, '', '2026-05-10 09:09:41', '2026-05-10 09:09:41'),
(97, 82, 34, 'Mousse Xoài', 530000.00, 1, '', '2026-05-10 09:09:41', '2026-05-10 09:09:41'),
(98, 82, 32, 'Mousse Dưa lưới', 580000.00, 1, '', '2026-05-10 09:09:41', '2026-05-10 09:09:41'),
(99, 83, 22, 'Bánh Kem Ribbon Red Velvet', 260000.00, 1, '', '2026-05-10 09:10:13', '2026-05-10 09:10:13'),
(100, 84, 28, 'Bánh Matcha Tiramisu', 100000.00, 1, '', '2026-05-10 09:16:26', '2026-05-10 09:16:26'),
(101, 85, 28, 'Bánh Matcha Tiramisu', 100000.00, 1, '', '2026-05-10 09:17:36', '2026-05-10 09:17:36'),
(102, 86, 34, 'Mousse Xoài', 530000.00, 1, '', '2026-05-10 09:18:08', '2026-05-10 09:18:08'),
(103, 87, 24, 'Bánh Kem Pink Drip & Bows', 300000.00, 1, '', '2026-05-10 09:22:38', '2026-05-10 09:22:38'),
(104, 88, 22, 'Bánh Kem Ribbon Red Velvet', 260000.00, 2, '', '2026-05-10 09:23:05', '2026-05-10 09:23:05'),
(105, 89, 24, 'Bánh Kem Pink Drip & Bows', 300000.00, 1, '', '2026-05-10 09:26:33', '2026-05-10 09:26:33'),
(106, 90, 22, 'Bánh Kem Ribbon Red Velvet', 260000.00, 1, '', '2026-05-10 09:28:28', '2026-05-10 09:28:28'),
(107, 91, 22, 'Bánh Kem Ribbon Red Velvet', 260000.00, 1, '', '2026-05-10 09:30:02', '2026-05-10 09:30:02'),
(108, 92, 22, 'Bánh Kem Ribbon Red Velvet', 260000.00, 1, '', '2026-05-10 09:32:50', '2026-05-10 09:32:50'),
(109, 93, 27, 'Tiramisu Box', 5000.00, 1, '', '2026-05-10 09:51:00', '2026-05-10 09:51:00'),
(110, 94, 34, 'Mousse Xoài', 530000.00, 1, '', '2026-05-10 09:58:42', '2026-05-10 09:58:42'),
(111, 95, 26, 'Classic Tiramisu', 5000.00, 1, '', '2026-05-10 10:00:19', '2026-05-10 10:00:19'),
(112, 96, 35, 'Mousse Bưởi hồng', 522000.00, 1, '', '2026-05-10 10:01:43', '2026-05-10 10:01:43'),
(113, 97, 35, 'Mousse Bưởi hồng', 522000.00, 1, '', '2026-05-10 10:07:45', '2026-05-10 10:07:45'),
(114, 98, 26, 'Classic Tiramisu', 5000.00, 1, '', '2026-05-17 08:04:27', '2026-05-17 08:04:27'),
(115, 99, 34, 'Mousse Xoài', 530000.00, 1, '', '2026-05-17 08:10:14', '2026-05-17 08:10:14'),
(116, 100, 24, 'Bánh Kem Pink Drip & Bows', 300000.00, 1, '', '2026-05-17 08:37:52', '2026-05-17 08:37:52');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('phattuan460@gmail.com', '8IJO8alePv4l24oyIYD5GbBkq0ivwW7ckIGY0PTY9ulTOJ1IijWB74KoxueYUCf0', '2026-04-16 22:54:10');

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
(39, 'App\\Models\\User', 4, 'auth_token', '58b976f055bd009ebad3545c5946eebb4e60158bf56c5fa9c30e0e2e76f8cb25', '[\"*\"]', '2026-04-13 08:43:14', NULL, '2026-04-08 07:12:46', '2026-04-13 08:43:14'),
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
(58, 'App\\Models\\User', 1, 'auth_token', '44531b5f6751e945e629c8d426c1a46fb47df1cf36bc2f1a74e7b54b0306b844', '[\"*\"]', '2026-04-12 03:00:54', NULL, '2026-04-11 11:56:51', '2026-04-12 03:00:54'),
(59, 'App\\Models\\User', 4, 'auth_token', '1424b154e1bde74aed367405c86652e9a684c05dd54638e6abc8fd3d8d8381ab', '[\"*\"]', '2026-04-12 01:44:56', NULL, '2026-04-12 01:44:34', '2026-04-12 01:44:56'),
(60, 'App\\Models\\User', 1, 'auth_token', '14ca3558b810a18d168f21696600af1f0f3ccb3bc01e21263e7a71010c036396', '[\"*\"]', NULL, NULL, '2026-04-12 02:53:29', '2026-04-12 02:53:29'),
(61, 'App\\Models\\User', 4, 'auth_token', '4f8ce999ca23771e681485c24326ada5b2f73832513366fbca9f7580a12f110a', '[\"*\"]', NULL, NULL, '2026-04-12 02:53:48', '2026-04-12 02:53:48'),
(62, 'App\\Models\\User', 4, 'auth_token', 'a8bcbb69ead42e708ebf5563a91cf1eea1139b224c1d975d26a1ee5a08356e8a', '[\"*\"]', NULL, NULL, '2026-04-12 02:57:07', '2026-04-12 02:57:07'),
(63, 'App\\Models\\User', 4, 'auth_token', 'b276cf14f8213e74a28de19a4081b590e6de57720b684a5d7bdd9afa5a357e1d', '[\"*\"]', NULL, NULL, '2026-04-12 02:57:20', '2026-04-12 02:57:20'),
(64, 'App\\Models\\User', 4, 'auth_token', '29dde97970c13d58a444cb35358000c36eb104867c3f2aecb5b4e019aae7a486', '[\"*\"]', NULL, NULL, '2026-04-12 02:59:38', '2026-04-12 02:59:38'),
(65, 'App\\Models\\User', 4, 'auth_token', '3a2cd3cecb58c09213bf0300c57cb6c1d25b912bc5ac71a032003835690c721a', '[\"*\"]', NULL, NULL, '2026-04-12 03:03:26', '2026-04-12 03:03:26'),
(66, 'App\\Models\\User', 4, 'auth_token', '9e6d65af2b07285128fd9946c02f9343ac26d63c3a1432b0547184c51e1cb2c9', '[\"*\"]', NULL, NULL, '2026-04-12 03:06:35', '2026-04-12 03:06:35'),
(67, 'App\\Models\\User', 4, 'auth_token', '7420ac5eb7317072a36c153e134b37f190c2ba534400a09a34764a6be0ca289c', '[\"*\"]', '2026-04-12 03:27:58', NULL, '2026-04-12 03:09:44', '2026-04-12 03:27:58'),
(68, 'App\\Models\\User', 4, 'auth_token', '3977c792f498e5b8dc6a4c5479e86531bbdc07272366b3068ce59273b47b2343', '[\"*\"]', '2026-04-12 03:25:51', NULL, '2026-04-12 03:10:08', '2026-04-12 03:25:51'),
(69, 'App\\Models\\User', 9, 'auth_token', '15eb9aac97632991fd5d27ca259ec329a55bd0c43d15fe492e164eb4cffd034e', '[\"*\"]', NULL, NULL, '2026-04-12 03:35:23', '2026-04-12 03:35:23'),
(70, 'App\\Models\\User', 9, 'auth_token', '37a28f70f54cab808e3b3a01b5f4094b2266dd4f8203911c7b95f956603462e9', '[\"*\"]', '2026-04-12 03:37:52', NULL, '2026-04-12 03:35:30', '2026-04-12 03:37:52'),
(71, 'App\\Models\\User', 9, 'auth_token', '6a3984656e2d8a5461efbfa89f062e3120df5272c68f18d86a4141ad840c4667', '[\"*\"]', '2026-04-12 03:36:26', NULL, '2026-04-12 03:36:11', '2026-04-12 03:36:26'),
(72, 'App\\Models\\User', 4, 'auth_token', '58f00fd814f75db27b90ae3a33a0024444b96fa6d4371d30d117e66e17b0abee', '[\"*\"]', '2026-04-12 03:36:48', NULL, '2026-04-12 03:36:38', '2026-04-12 03:36:48'),
(73, 'App\\Models\\User', 9, 'auth_token', '4f6591694ef5b556a40d7648ced12a4a5fe31e02cda0b860db8bd58399429cda', '[\"*\"]', '2026-04-12 03:37:33', NULL, '2026-04-12 03:36:53', '2026-04-12 03:37:33'),
(74, 'App\\Models\\User', 9, 'auth_token', '98e442acf98e017e5f2213c48bed390afe5153de2207cab3a23665f83ec7e802', '[\"*\"]', '2026-04-12 08:58:32', NULL, '2026-04-12 03:48:20', '2026-04-12 08:58:32'),
(75, 'App\\Models\\User', 1, 'auth_token', 'e53dfb619718753e6869c5a0dae8967eb28054117bec0ef97ed0762cf4da8aea', '[\"*\"]', '2026-04-12 07:20:16', NULL, '2026-04-12 07:01:20', '2026-04-12 07:20:16'),
(76, 'App\\Models\\User', 10, 'auth_token', '7c65447cc9e9c095272a9da23c792c802c6aeff17f7c49819d17ba77e3d19163', '[\"*\"]', NULL, NULL, '2026-04-12 07:20:57', '2026-04-12 07:20:57'),
(77, 'App\\Models\\User', 1, 'auth_token', '11ef92e5bb8b9afc5542e461c03bed001f5fd1b934b209a947470bb9372a8a9c', '[\"*\"]', '2026-04-12 09:19:37', NULL, '2026-04-12 07:21:14', '2026-04-12 09:19:37'),
(78, 'App\\Models\\User', 1, 'auth_token', 'feb978985e6ca3b548cebecf5e047cfe4ad3b5323bbd20bca487f8253d4c207a', '[\"*\"]', '2026-04-12 10:36:25', NULL, '2026-04-12 10:36:13', '2026-04-12 10:36:25'),
(79, 'App\\Models\\User', 1, 'auth_token', '9da4d95edca4c5e906e3e6cc3f0082c653320d91bf025943e5dc30ac1df091c9', '[\"*\"]', '2026-04-12 11:18:40', NULL, '2026-04-12 10:38:14', '2026-04-12 11:18:40'),
(80, 'App\\Models\\User', 1, 'auth_token', '7793f1bdef443e19a8113452666533eb3c35a6fd05a298646bc7d49dbd22bd00', '[\"*\"]', '2026-04-13 01:17:12', NULL, '2026-04-12 23:13:20', '2026-04-13 01:17:12'),
(81, 'App\\Models\\User', 4, 'auth_token', '2cdb60e024c00b236a63464b9af9624ccf2637e4126c6c34659d20b28567196a', '[\"*\"]', '2026-04-13 04:50:30', NULL, '2026-04-13 04:41:04', '2026-04-13 04:50:30'),
(82, 'App\\Models\\User', 1, 'auth_token', '45161c10ab7f79acf9ec37ce91986dfdeee55cce6040e9bc2c9d7ff2b64681e2', '[\"*\"]', '2026-04-13 05:14:18', NULL, '2026-04-13 04:57:36', '2026-04-13 05:14:18'),
(83, 'App\\Models\\User', 4, 'auth_token', 'd67086e3e1598985365ce0e72d065805b2dbaf75b01d79f67f5ddc772ad99fde', '[\"*\"]', '2026-04-13 05:37:24', NULL, '2026-04-13 05:14:23', '2026-04-13 05:37:24'),
(84, 'App\\Models\\User', 4, 'auth_token', '0357cd35260c83f17a909625d1dcef62f4b6a0ef7eba52a21ba978a1d9aadf57', '[\"*\"]', '2026-04-13 07:57:11', NULL, '2026-04-13 05:34:35', '2026-04-13 07:57:11'),
(85, 'App\\Models\\User', 1, 'auth_token', '117fcaa3e3e3cece890e3f3bbcd72ea18964df2bf9c77433fa05a558678966cb', '[\"*\"]', '2026-04-13 05:37:38', NULL, '2026-04-13 05:37:35', '2026-04-13 05:37:38'),
(86, 'App\\Models\\User', 4, 'auth_token', '522fd3c39019459453cd0bce43c35ccbcb0fd8fb8b97db969b3c941d7691be87', '[\"*\"]', '2026-04-13 06:07:41', NULL, '2026-04-13 05:37:47', '2026-04-13 06:07:41'),
(87, 'App\\Models\\User', 1, 'auth_token', '6d9a740e30e1f4d7c241d29e8456d32e92f79086e10af09e3cab24b35dff64dc', '[\"*\"]', '2026-04-13 06:08:06', NULL, '2026-04-13 06:07:53', '2026-04-13 06:08:06'),
(88, 'App\\Models\\User', 4, 'auth_token', '11bca20296dc035fefc5ea3035816ab334122d0953db068714559d6e7d548f42', '[\"*\"]', '2026-04-13 06:13:06', NULL, '2026-04-13 06:08:12', '2026-04-13 06:13:06'),
(89, 'App\\Models\\User', 4, 'auth_token', '749c44b8771f3a580fa22c44caf069b4c1875476b2b96c9f9a24827268aebb24', '[\"*\"]', '2026-04-13 06:49:38', NULL, '2026-04-13 06:30:52', '2026-04-13 06:49:38'),
(90, 'App\\Models\\User', 11, 'auth_token', '6d99c0859c32a1215a091726df6e8c78fb480aef94d34f396880106ddd54565a', '[\"*\"]', NULL, NULL, '2026-04-13 06:54:32', '2026-04-13 06:54:32'),
(91, 'App\\Models\\User', 11, 'auth_token', 'd06d8fd062089b29a9cd89028c9ab5700eda7f5d0fe26e925922bbf59005519a', '[\"*\"]', '2026-04-13 06:55:31', NULL, '2026-04-13 06:54:41', '2026-04-13 06:55:31'),
(92, 'App\\Models\\User', 4, 'auth_token', 'cd78e96d56a02f115da51a63410e93001ffa1e5320f37acf2411b7f94385603b', '[\"*\"]', '2026-04-13 07:05:22', NULL, '2026-04-13 06:55:52', '2026-04-13 07:05:22'),
(93, 'App\\Models\\User', 11, 'auth_token', 'b856abf7f0705e582b51011fac411220862bb51c89e0853749317789013e3b90', '[\"*\"]', '2026-05-06 05:07:33', NULL, '2026-04-13 07:57:19', '2026-05-06 05:07:33'),
(94, 'App\\Models\\User', 11, 'auth_token', 'edf769e01a9be7f3c10f4e5e1700cf7b425658cbfd3ea04d49a853f25fd33e90', '[\"*\"]', '2026-04-13 08:41:40', NULL, '2026-04-13 07:57:34', '2026-04-13 08:41:40'),
(95, 'App\\Models\\User', 1, 'auth_token', '87420bfd90a3bb5557f28b9b861500f0960eb9d78d2ad0ccb56ef54c819d4274', '[\"*\"]', '2026-04-13 08:42:06', NULL, '2026-04-13 08:41:52', '2026-04-13 08:42:06'),
(96, 'App\\Models\\User', 4, 'auth_token', 'bed9d65e20c0fbfa0c781515c4849f206c6a7c5f8b6d423e99459e30ad7e83e7', '[\"*\"]', '2026-04-13 08:42:39', NULL, '2026-04-13 08:42:14', '2026-04-13 08:42:39'),
(97, 'App\\Models\\User', 1, 'auth_token', '360764df76e7966e64cae78732202ae91df19214a86e3d37a830cad4100ea074', '[\"*\"]', '2026-04-14 00:19:10', NULL, '2026-04-13 08:43:00', '2026-04-14 00:19:10'),
(98, 'App\\Models\\User', 4, 'auth_token', '97bb8045019fee1a48e8a2e422415d1f545d4e65f270e981b10b63eafde21096', '[\"*\"]', '2026-04-13 08:43:38', NULL, '2026-04-13 08:43:19', '2026-04-13 08:43:38'),
(99, 'App\\Models\\User', 11, 'auth_token', '8725aeae1bbf401c1dcf6c238edb4895d761cd65403c923207948ed9d6b0b714', '[\"*\"]', '2026-04-13 12:10:27', NULL, '2026-04-13 08:43:46', '2026-04-13 12:10:27'),
(100, 'App\\Models\\User', 4, 'auth_token', '5fae88038ed40f2c406f98e386dcc0750be23b1a185887ef621254e0af8024cf', '[\"*\"]', '2026-04-13 11:54:18', NULL, '2026-04-13 11:54:13', '2026-04-13 11:54:18'),
(101, 'App\\Models\\User', 11, 'auth_token', 'aa8518ee1b39113e7445262460b24c3e4484bc2226f4d7354ddf993eaa989d85', '[\"*\"]', '2026-04-13 12:38:22', NULL, '2026-04-13 12:10:41', '2026-04-13 12:38:22'),
(102, 'App\\Models\\User', 1, 'auth_token', '3651bd939be92093bf54d16222613a8d9339641333bee3d38e50856ef55011a9', '[\"*\"]', '2026-04-13 22:18:20', NULL, '2026-04-13 22:04:22', '2026-04-13 22:18:20'),
(103, 'App\\Models\\User', 11, 'auth_token', '52f6e6a6891b89041987b16f7158fb700b36bca0bcdd24a780785373126d44a3', '[\"*\"]', '2026-04-13 22:37:34', NULL, '2026-04-13 22:18:27', '2026-04-13 22:37:34'),
(104, 'App\\Models\\User', 4, 'auth_token', 'd10838d6941b2b53fb00481707f8c66a5f49a8b9e5b98a43a219ca6292c7e911', '[\"*\"]', '2026-04-13 22:38:34', NULL, '2026-04-13 22:37:45', '2026-04-13 22:38:34'),
(105, 'App\\Models\\User', 1, 'auth_token', 'b9ffc89efc5878f6b77d17a00a11165dea9a48dc619d524c820e48713ffac67d', '[\"*\"]', '2026-04-16 21:15:51', NULL, '2026-04-13 22:47:09', '2026-04-16 21:15:51'),
(106, 'App\\Models\\User', 1, 'auth_token', '6b667eb161629624f663348b6a0d2a30745924df54739fc507ac6cfde703dce0', '[\"*\"]', '2026-05-09 08:53:32', NULL, '2026-04-14 00:27:34', '2026-05-09 08:53:32'),
(107, 'App\\Models\\User', 1, 'auth_token', '9d71fda78070d5c294b80931ac8ab8fb88811db4203c0af02c176b7853b6cfc7', '[\"*\"]', '2026-04-16 22:48:29', NULL, '2026-04-16 22:47:40', '2026-04-16 22:48:29'),
(108, 'App\\Models\\User', 1, 'auth_token', '4dfaedb22275de208bb23d3ac4c7972a639681cdcc88e7352ec1a4f736df1db2', '[\"*\"]', '2026-04-17 08:07:49', NULL, '2026-04-17 01:56:06', '2026-04-17 08:07:49'),
(109, 'App\\Models\\User', 4, 'auth_token', '2084949c415fcd9520b72f80f92a6bb8070179f926d5c8eea5a3e84df7f051db', '[\"*\"]', '2026-04-20 03:29:35', NULL, '2026-04-20 03:09:10', '2026-04-20 03:29:35'),
(110, 'App\\Models\\User', 1, 'auth_token', '09c6e0fec3d01f76b64e39a0625fef820ee635bf63e82e537d0b1da74b5fcbde', '[\"*\"]', '2026-04-21 03:02:34', NULL, '2026-04-20 03:30:52', '2026-04-21 03:02:34'),
(111, 'App\\Models\\User', 4, 'auth_token', 'bebc8c115ecb82c7fc3d5d853bf83d1477a58fc2b842e04f093b31a7cfc818bf', '[\"*\"]', '2026-04-21 03:23:15', NULL, '2026-04-21 03:02:44', '2026-04-21 03:23:15'),
(112, 'App\\Models\\User', 12, 'auth_token', '57463ed7ab0e8af468d3bcf9413ad06abecadf8bbf7967bf9e05eb3157703d02', '[\"*\"]', NULL, NULL, '2026-04-21 03:48:32', '2026-04-21 03:48:32'),
(113, 'App\\Models\\User', 4, 'auth_token', '40a71c02e5242dcd039042d14622f1ebf6de728170a1324d9d448cf42d9f7718', '[\"*\"]', '2026-04-21 05:21:32', NULL, '2026-04-21 04:41:25', '2026-04-21 05:21:32'),
(114, 'App\\Models\\User', 1, 'auth_token', '04fe89c54197f704f8d5c842b143268f5b75912c0120cf0feacd16d031b26458', '[\"*\"]', '2026-04-21 05:23:21', NULL, '2026-04-21 05:21:40', '2026-04-21 05:23:21'),
(115, 'App\\Models\\User', 4, 'auth_token', '36435002802f67f2772e902e20ef57aaac47411b4d918acd4a3cd51d4f1281ba', '[\"*\"]', '2026-04-21 05:25:10', NULL, '2026-04-21 05:23:38', '2026-04-21 05:25:10'),
(116, 'App\\Models\\User', 4, 'auth_token', '5b561275f0910c4587dea7e6ddaeabe83bcbc51615d40008d18be47360df81ec', '[\"*\"]', '2026-04-21 05:25:37', NULL, '2026-04-21 05:25:35', '2026-04-21 05:25:37'),
(117, 'App\\Models\\User', 1, 'auth_token', '932dd143b43a34ecbfe946131b7795e6f47a4aa74f54127411f2c55b98b2fe23', '[\"*\"]', '2026-04-23 23:51:13', NULL, '2026-04-21 05:25:45', '2026-04-23 23:51:13'),
(118, 'App\\Models\\User', 4, 'auth_token', 'b6cc260e995742a17cad37b3f31b18317f8233d9eee8643d3ab2f626f9ab86a2', '[\"*\"]', '2026-04-23 23:59:41', NULL, '2026-04-21 05:26:17', '2026-04-23 23:59:41'),
(119, 'App\\Models\\User', 4, 'auth_token', 'efbc186d7b28928500e04df1f576d0acdc1870836b73b502b0aaf18582dbfe93', '[\"*\"]', '2026-04-23 23:51:50', NULL, '2026-04-23 23:51:20', '2026-04-23 23:51:50'),
(120, 'App\\Models\\User', 1, 'auth_token', '3cbb68cb552e87a3968237a043a6c18b62a8a911353923007f48c0c3c6bf96be', '[\"*\"]', '2026-04-26 08:30:38', NULL, '2026-04-23 23:52:07', '2026-04-26 08:30:38'),
(121, 'App\\Models\\User', 4, 'auth_token', 'a331a928ac8ddff2a43539c0cea676dca2a97f8b8e413e5ddcb1d0fbcee53904', '[\"*\"]', '2026-05-06 04:03:04', NULL, '2026-04-23 23:59:51', '2026-05-06 04:03:04'),
(122, 'App\\Models\\User', 4, 'auth_token', 'be365569430609f0dee58d6111325b1eba45f0a3230331d6085525ea2a086306', '[\"*\"]', '2026-05-05 03:41:44', NULL, '2026-05-05 03:17:20', '2026-05-05 03:41:44'),
(123, 'App\\Models\\User', 1, 'auth_token', 'da837ac0ce1a9bb78d30ad0834cf1290889af416202e6e0703d500e6b442dd17', '[\"*\"]', '2026-05-05 03:52:20', NULL, '2026-05-05 03:41:52', '2026-05-05 03:52:20'),
(124, 'App\\Models\\User', 4, 'auth_token', '5be2f94fc7811e051227a56a62587b3c2a85f176d5e1fa2489d2635c03dd8169', '[\"*\"]', '2026-05-05 04:50:54', NULL, '2026-05-05 03:53:47', '2026-05-05 04:50:54'),
(125, 'App\\Models\\User', 1, 'auth_token', '7635076d9c4eecf6f912fa3a6c182b1d4c44361dfce7e3849bf1ba38486ec164', '[\"*\"]', '2026-05-06 04:02:42', NULL, '2026-05-05 04:51:00', '2026-05-06 04:02:42'),
(126, 'App\\Models\\User', 1, 'auth_token', 'd42e76823b0a06f5770de2e87907c4efa815baf7bf22b716ec459393b7d250c5', '[\"*\"]', '2026-05-06 05:59:33', NULL, '2026-05-06 04:02:54', '2026-05-06 05:59:33'),
(127, 'App\\Models\\User', 4, 'auth_token', 'ab9c2b290c6e13bbd7c438cbb32d01b4e897e1a3be5f6fadc933e41181dc21d4', '[\"*\"]', NULL, NULL, '2026-05-06 04:03:11', '2026-05-06 04:03:11'),
(128, 'App\\Models\\User', 4, 'auth_token', 'ccc34ff343f63b52b0e602eab34e670849e436877c020cf40618c0f18a1d181e', '[\"*\"]', '2026-05-09 09:21:57', NULL, '2026-05-06 04:03:11', '2026-05-09 09:21:57'),
(129, 'App\\Models\\User', 4, 'auth_token', 'ef21ce82dab7892773986a86175658bf1cb345c0f7e1c3d57a600ea7c4e10ff5', '[\"*\"]', '2026-05-09 23:05:26', NULL, '2026-05-06 05:07:45', '2026-05-09 23:05:26'),
(130, 'App\\Models\\User', 4, 'auth_token', 'dc555bb0a2205d5632c6e16bf6aaed2cf9a488f035309927ed67187e493ef3c2', '[\"*\"]', '2026-05-06 06:01:49', NULL, '2026-05-06 05:59:38', '2026-05-06 06:01:49'),
(131, 'App\\Models\\User', 4, 'auth_token', 'c7d950247666787649150b19be7fffa696e2034962f81d0902dae3ec39f30d64', '[\"*\"]', '2026-05-06 06:02:37', NULL, '2026-05-06 06:02:17', '2026-05-06 06:02:37'),
(132, 'App\\Models\\User', 1, 'auth_token', 'd3a47f4674f1d95620eb41393ffc2e10c6685ae8fbaba5bc4a84675987874e4d', '[\"*\"]', '2026-05-06 06:03:51', NULL, '2026-05-06 06:02:48', '2026-05-06 06:03:51'),
(133, 'App\\Models\\User', 4, 'auth_token', '9633cc327081e06dcc90b8f3237bd7d6d3727686894c0c3385db9322148e4b67', '[\"*\"]', '2026-05-06 06:04:24', NULL, '2026-05-06 06:04:09', '2026-05-06 06:04:24'),
(134, 'App\\Models\\User', 1, 'auth_token', 'ad822a1255f0188b12ccd3513f7d8b0e4bcd8c135e8752376851245cb02a8fe2', '[\"*\"]', '2026-05-06 06:05:17', NULL, '2026-05-06 06:04:45', '2026-05-06 06:05:17'),
(135, 'App\\Models\\User', 4, 'auth_token', '176304e8dc753b7a392fa7b3ccd1cf5571faf514fa669f3a1aeed13607e7d962', '[\"*\"]', '2026-05-09 09:18:45', NULL, '2026-05-06 06:05:25', '2026-05-09 09:18:45'),
(136, 'App\\Models\\User', 1, 'auth_token', 'cc5a2126e1f3b1bf4614964d8c81b0f1b3f5934da139f3b4a3c1fc2c43eaca0a', '[\"*\"]', '2026-05-09 09:20:17', NULL, '2026-05-09 09:18:55', '2026-05-09 09:20:17'),
(137, 'App\\Models\\User', 4, 'auth_token', '7b126f3f2308920b7da9d7c743bf91437d5f89b2056cec48ab2744bbc04fe381', '[\"*\"]', '2026-05-09 09:20:28', NULL, '2026-05-09 09:20:25', '2026-05-09 09:20:28'),
(138, 'App\\Models\\User', 1, 'auth_token', '30de872e76b0d9fe19aa2933531cfc71b08445d4036191e77e4dcda859007ac2', '[\"*\"]', '2026-05-09 10:30:17', NULL, '2026-05-09 09:20:37', '2026-05-09 10:30:17'),
(139, 'App\\Models\\User', 4, 'auth_token', 'f6d37f072b13b11d6cd65f80793d548e889c68c3e66c1b0c5eca1824dd089ff4', '[\"*\"]', '2026-05-09 09:27:01', NULL, '2026-05-09 09:22:01', '2026-05-09 09:27:01'),
(140, 'App\\Models\\User', 13, 'auth_token', 'c51640d09569afaf0055c033d0fb23c605f62d2055d8ae2f7073a92769aa2f4b', '[\"*\"]', NULL, NULL, '2026-05-09 09:28:22', '2026-05-09 09:28:22'),
(141, 'App\\Models\\User', 13, 'auth_token', '86fd09114352e25d6d5b8bdc878236b0c55952ef3798544603303167e82bdc17', '[\"*\"]', '2026-05-09 09:28:44', NULL, '2026-05-09 09:28:33', '2026-05-09 09:28:44'),
(142, 'App\\Models\\User', 4, 'auth_token', '5535339f163a5e80e2057d2cbea30f7267651d92efdc20492cce0fc0d6710658', '[\"*\"]', '2026-05-09 21:19:52', NULL, '2026-05-09 10:30:21', '2026-05-09 21:19:52'),
(143, 'App\\Models\\User', 1, 'auth_token', '33b165a288749275a000f29c590b4d6d873e07a984cdf253a624a639ae82ee26', '[\"*\"]', '2026-05-17 07:33:06', NULL, '2026-05-09 21:20:03', '2026-05-17 07:33:06'),
(144, 'App\\Models\\User', 4, 'auth_token', '59c04a6b78e5ec75bb13bab8727e1b150af6a09106676b06fb4161e6b80bb6e6', '[\"*\"]', '2026-05-09 21:54:22', NULL, '2026-05-09 21:20:15', '2026-05-09 21:54:22'),
(145, 'App\\Models\\User', 4, 'auth_token', '70cbeaf9fb81813516312c56fa08f0e598a461716d614bee5ab42d1a3afa23b5', '[\"*\"]', '2026-05-09 21:55:32', NULL, '2026-05-09 21:54:31', '2026-05-09 21:55:32'),
(146, 'App\\Models\\User', 4, 'auth_token', '2622945eede9358093bf2939e9c4fe0a84bc76d2f624af5aa0853debf3c92923', '[\"*\"]', '2026-05-10 09:19:46', NULL, '2026-05-09 21:55:36', '2026-05-10 09:19:46'),
(147, 'App\\Models\\User', 4, 'auth_token', '7affafe46ed764ec75762796940a6b4614e698d1002fbb63a7f4c4e52d071089', '[\"*\"]', '2026-05-10 09:16:48', NULL, '2026-05-09 23:05:40', '2026-05-10 09:16:48'),
(148, 'App\\Models\\User', 4, 'auth_token', 'b366800d40e10cdfffe62ddcf7de30aeb0f98fc6e5fe3d70784cc16d0b6fed20', '[\"*\"]', '2026-05-17 07:45:43', NULL, '2026-05-10 09:17:05', '2026-05-17 07:45:43'),
(149, 'App\\Models\\User', 4, 'auth_token', '6f9cf37465d1315766fa15f9cce9a66ecadf71d782cc40176d6fedd3de4566ce', '[\"*\"]', '2026-05-10 09:19:54', NULL, '2026-05-10 09:19:52', '2026-05-10 09:19:54'),
(150, 'App\\Models\\User', 4, 'auth_token', 'f81fedcc13021f57d1879b256e1cf6c2ef1312e3980343d903bc17a06b5f7f06', '[\"*\"]', '2026-05-10 10:08:30', NULL, '2026-05-10 09:19:53', '2026-05-10 10:08:30'),
(151, 'App\\Models\\User', 4, 'auth_token', '83d35d0f56d7627e2fa4ab0f4f802ea40dd1489724a8ef671dd159587406cce3', '[\"*\"]', '2026-05-17 09:28:24', NULL, '2026-05-17 07:56:08', '2026-05-17 09:28:24'),
(152, 'App\\Models\\User', 4, 'auth_token', '820abbbdb80e4d3e30b968c413c6a4622caf903573810a504f7d91f5d72d6753', '[\"*\"]', '2026-05-17 08:04:28', NULL, '2026-05-17 07:57:12', '2026-05-17 08:04:28'),
(153, 'App\\Models\\User', 1, 'auth_token', '2f630478e2cf7ac399c00d0555a97f58aca2bea68c1f0f14649647efa3df274f', '[\"*\"]', '2026-05-17 08:10:34', NULL, '2026-05-17 08:04:52', '2026-05-17 08:10:34'),
(154, 'App\\Models\\User', 4, 'auth_token', '7b4a45ecbfcb994bd74f38f638a5fa406d255320b2fbd4b4ba2c48d00e9939b5', '[\"*\"]', '2026-05-17 08:13:16', NULL, '2026-05-17 08:11:39', '2026-05-17 08:13:16'),
(155, 'App\\Models\\User', 1, 'auth_token', '7b40101d7645bdc6b042df36e204359d25eb1ae822601ed4c73c08adbd8e04ed', '[\"*\"]', '2026-05-17 08:37:23', NULL, '2026-05-17 08:13:38', '2026-05-17 08:37:23'),
(156, 'App\\Models\\User', 4, 'auth_token', '5a69961ba28596bfd67a9c088c96acc182cb968f48ca70c6696eafe471b119b8', '[\"*\"]', '2026-05-17 09:10:38', NULL, '2026-05-17 08:21:47', '2026-05-17 09:10:38'),
(157, 'App\\Models\\User', 4, 'auth_token', 'fa3f06f781d6d0e7e6f55686cc81d4ae1a2ae3f616f7803b5bcbf49521d8d1eb', '[\"*\"]', '2026-05-17 08:38:04', NULL, '2026-05-17 08:37:29', '2026-05-17 08:38:04'),
(158, 'App\\Models\\User', 4, 'auth_token', '8094bde1e1c4e67b587a5b9bb7e01edf9c27ede9bc21c498dba787e8c502c4c5', '[\"*\"]', '2026-05-17 09:28:12', NULL, '2026-05-17 09:05:32', '2026-05-17 09:28:12');

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
  `discount_percent` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `sub_images` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `discount_ends_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `description`, `content`, `price`, `discount_percent`, `image`, `sub_images`, `is_active`, `is_featured`, `created_at`, `updated_at`, `discount_ends_at`) VALUES
(18, 9, 'Bánh Kem Dâu Tây', 'banh-kem-dau-tay', 'Chiếc bánh kem này mang vẻ đẹp thanh tao và tinh tế với tông màu trắng chủ đạo từ lớp kem tươi mịn màng. Điểm nhấn nổi bật nhất chính là những quả dâu tây đỏ mọng được sắp xếp đều đặn vòng quanh, xen kẽ giữa các chóp kem bắt mắt', '<h3><strong>Mô tả bánh</strong></h3><p>Bánh Dưa Lưới Mật (Fuji Melon Cake) là sự kết hợp tinh tế giữa vị ngọt thanh mát của dưa lưới Fuji và độ béo nhẹ từ phô mai tươi, kem sữa. Lớp mousse mịn màng hòa quyện cùng cốt bánh vani mềm xốp, tạo nên trải nghiệm tươi mới, dịu nhẹ – đặc biệt phù hợp trong những ngày nắng nóng.</p><h3><strong>Cấu trúc bánh</strong></h3><p>Bánh gồm 3 lớp:</p><ul><li>Cốt bánh bông lan vani mềm xốp</li><li>Dưa lưới mật tươi cắt hạt lựu, mọng nước</li><li>Lớp mousse dưa lưới thơm béo, tan ngay trong miệng</li></ul><h3><strong>Phụ kiện tặng kèm</strong></h3><ul><li>Bộ dao &amp; muỗng gỗ</li><li>Dĩa cao cấp</li><li>Hộp nến xinh xắn</li></ul><h3><strong>Hướng dẫn sử dụng &amp; bảo quản</strong></h3><ul><li>Bảo quản bánh trong ngăn mát tủ lạnh (đậy kín)</li><li>Ngon nhất khi sử dụng trong vòng <strong>24 giờ</strong></li><li>Tránh để bánh ở nhiệt độ phòng quá lâu hoặc dưới ánh nắng trực tiếp</li></ul><p><br></p>', 250000.00, 0, 'http://localhost/Web_banhang/backend/public/uploads/1776016300_Ảnh màn hình 2026-04-13 lúc 00.49.10.png', '[\"http:\\/\\/localhost\\/Web_banhang\\/backend\\/public\\/uploads\\/1776016300_sub_0_A\\u0309nh ma\\u0300n hi\\u0300nh 2026-04-13 lu\\u0301c 00.49.30.png\",\"http:\\/\\/localhost\\/Web_banhang\\/backend\\/public\\/uploads\\/1776016573_sub_1_A\\u0309nh ma\\u0300n hi\\u0300nh 2026-04-13 lu\\u0301c 00.53.38.png\",\"http:\\/\\/localhost\\/Web_banhang\\/backend\\/public\\/uploads\\/1776016573_sub_2_A\\u0309nh ma\\u0300n hi\\u0300nh 2026-04-13 lu\\u0301c 00.55.36.png\",\"http:\\/\\/localhost\\/Web_banhang\\/backend\\/public\\/uploads\\/1776016695_sub_3_A\\u0309nh ma\\u0300n hi\\u0300nh 2026-04-13 lu\\u0301c 00.53.23.png\"]', 1, 0, '2026-04-07 09:17:39', '2026-04-12 23:49:25', NULL),
(22, 9, 'Bánh Kem Ribbon Red Velvet', 'banh-kem-ribbon-red-velvet', 'Nếu bạn đang tìm kiếm một chiếc bánh mang phong cách hiện đại, thanh lịch nhưng vẫn đầy lãng mạn, thì Ribbon Red Velvet chính là sự lựa chọn hoàn hảo. Chiếc bánh nổi bật với sự đối lập tinh tế giữa lớp kem trắng muốt và những dải nơ đỏ rượu vang sang trọng, tạo nên một vẻ đẹp vừa cổ điển vừa hợp thời.', '<h3><strong>Thông tin sản phẩm:</strong></h3><ul><li><strong>Cấu trúc bánh:</strong></li><li class=\"ql-indent-1\">Cốt bánh: Đỏ nhung (Red Velvet) đặc trưng, ẩm mịn và thơm nhẹ vị cacao.</li><li class=\"ql-indent-1\">Nhân bánh: Lớp kem phô mai (Cream Cheese) béo ngậy, chua nhẹ giúp cân bằng vị ngọt.</li><li class=\"ql-indent-1\">Trang trí: Nơ satin thủ công (phụ kiện không ăn được) và họa tiết kem tươi.</li><li><strong>Phụ kiện tặng kèm:</strong></li><li class=\"ql-indent-1\">Bộ dao, muỗng gỗ &amp; dĩa giấy bảo vệ môi trường.</li><li class=\"ql-indent-1\">Nến sinh nhật cao cấp theo tông màu bánh.</li></ul><h3><strong>Hướng dẫn sử dụng &amp; Bảo quản:</strong></h3><ul><li>Bảo quản: Giữ lạnh trong ngăn mát tủ lạnh ở nhiệt độ từ 3°C - 5°C.</li><li>Lưu ý: Vui lòng tháo dải nơ ruy-băng trước khi cắt bánh.</li><li>Hạn sử dụng: Thưởng thức ngon nhất trong vòng 24h kể từ khi nhận bánh.</li></ul><p><br></p>', 260000.00, 0, 'http://localhost/Web_banhang/backend/public/uploads/1776062206_72bb51b23cf78b03d532234af0e6e9ae.jpg', '[\"http:\\/\\/localhost\\/Web_banhang\\/backend\\/public\\/uploads\\/1776062206_sub_0_57d1b4e445674aba60cc165dc3161061.jpg\",\"http:\\/\\/localhost\\/Web_banhang\\/backend\\/public\\/uploads\\/1776062206_sub_1_72bb51b23cf78b03d532234af0e6e9ae.jpg\",\"http:\\/\\/localhost\\/Web_banhang\\/backend\\/public\\/uploads\\/1776062206_sub_2_17373364ae064822a089a2c367421121.jpg\"]', 1, 1, '2026-04-12 23:36:46', '2026-04-13 00:29:40', NULL),
(24, 9, 'Bánh Kem Pink Drip & Bows', 'banh-kem-pink-drip-bows', 'Mang đậm phong cách Coquette Aesthetics, chiếc bánh này là sự kết hợp hoàn hảo giữa nét trẻ trung, nhẹ nhàng và một chút điệu đà. Với tông màu hồng pastel dịu mắt trên nền kem trắng sứ, đây chắc chắn là món quà khiến bất kỳ cô gái nào cũng phải \"tan chảy\" ngay từ cái nhìn đầu tiên.', '<ul><li><strong>Hương vị gợi ý:</strong></li><li class=\"ql-indent-1\">Cốt bánh: Bông lan Vani truyền thống hoặc Dâu tây thơm mát.</li><li class=\"ql-indent-1\">Lớp phủ: Kem tươi (Whipping Cream) ít ngọt, thanh nhẹ, không gây ngán.</li><li><strong>Cấu trúc trang trí:</strong></li><li class=\"ql-indent-1\">Kem trang trí tông màu Pastel cao cấp.</li><li class=\"ql-indent-1\">Ruy băng lụa hồng (phụ kiện không ăn được).</li><li class=\"ql-indent-1\">Nến cao cấp tông xuyệt tông.</li></ul><h3><strong>Hướng dẫn sử dụng &amp; Bảo quản:</strong></h3><ul><li>Bảo quản: Luôn giữ bánh trong ngăn mát tủ lạnh để lớp kem và họa tiết nơ giữ được hình dáng đẹp nhất.</li><li>Vận chuyển: Bánh có kết cấu cao và phụ kiện ruy băng, vui lòng di chuyển nhẹ tay và tránh để nơi có nhiệt độ cao.</li><li>Hạn sử dụng: Thưởng thức ngon nhất trong vòng 24h.</li></ul><p><br></p>', 300000.00, 0, 'http://localhost/Web_banhang/backend/public/uploads/1776062962_17c843fe09a4203579175d201e973eb8.jpg', '[\"http:\\/\\/localhost\\/Web_banhang\\/backend\\/public\\/uploads\\/1776062962_sub_0_17c843fe09a4203579175d201e973eb8.jpg\",\"http:\\/\\/localhost\\/Web_banhang\\/backend\\/public\\/uploads\\/1776062962_sub_1_4719211150c2187d12adba575f668272.jpg\"]', 1, 0, '2026-04-12 23:49:22', '2026-04-13 00:29:25', NULL),
(25, 9, 'Bánh Blueberry Oreo Cheese', 'banh-blueberry-oreo-cheese', 'Nếu bạn là một tín đồ của phô mai nhưng vẫn yêu thích sự tươi mới của trái cây nhiệt đới, chiếc Blueberry Oreo Cheesecake này chính là câu trả lời hoàn hảo. Không cần trang trí cầu kỳ, chiếc bánh chinh phục người sành ăn bởi vẻ ngoài đầy đặn, chân thực và lớp phủ trái cây tươi mọng nước.', '<ul><li><strong>Cấu trúc bánh:</strong></li><li class=\"ql-indent-1\">Lớp phủ: Việt quất tươi nguyên quả và mứt việt quất thủ công.</li><li class=\"ql-indent-1\">Thân bánh: New York Cheesecake mềm mịn xen vân việt quất.</li><li class=\"ql-indent-1\">Đế bánh: Oreo nghiền và bơ lạt.</li><li><strong>Phụ kiện đi kèm:</strong></li><li class=\"ql-indent-1\">Bộ dao và muỗng gỗ vintage.</li><li class=\"ql-indent-1\">Thiệp chúc mừng thiết kế riêng.</li></ul><h3><strong>Hướng dẫn sử dụng &amp; Bảo quản:</strong></h3><ul><li>Cách dùng: Bánh ngon nhất khi dùng lạnh. Bạn có thể dùng kèm với một tách trà Earl Grey hoặc cà phê không đường để cảm nhận trọn vẹn hương vị.</li><li>Bảo quản: Bắt buộc bảo quản trong ngăn mát tủ lạnh.</li><li>Hạn sử dụng: Do sử dụng hoàn toàn trái cây tươi, bánh nên được thưởng thức trong vòng 48h để đảm bảo chất lượng tốt nhất.</li></ul><p><br></p>', 350000.00, 0, 'http://localhost/Web_banhang/backend/public/uploads/1776063244_2f214494746bef8e958e911ea96c4360.jpg', '[\"http:\\/\\/localhost\\/Web_banhang\\/backend\\/public\\/uploads\\/1776063244_sub_0_2f214494746bef8e958e911ea96c4360.jpg\",\"http:\\/\\/localhost\\/Web_banhang\\/backend\\/public\\/uploads\\/1776063244_sub_1_84d3c6437df72f1756a80bfa023e0338.jpg\",\"http:\\/\\/localhost\\/Web_banhang\\/backend\\/public\\/uploads\\/1776063244_sub_2_84d3c6437df72f1756a80bfa023e0338.jpg\"]', 1, 0, '2026-04-12 23:54:04', '2026-04-13 00:29:24', NULL),
(26, 11, 'Classic Tiramisu', 'classic-tiramisu', 'Đúng như ý nghĩa cái tên \"Pick me up\", món Tiramisu truyền thống này sẽ đánh thức mọi giác quan của bạn ngay từ miếng đầu tiên. Đây không chỉ là một món tráng miệng, mà là sự kết hợp tinh tế giữa vị đắng thanh tao của cà phê, nét nồng nàn của rượu nhẹ và sự béo ngậy đầy mê hoặc của phô mai Mascarpone.', '<ul><li><strong>Thành phần chính:</strong></li><li class=\"ql-indent-1\">Cà phê Espresso nguyên chất.</li><li class=\"ql-indent-1\">Phô mai Mascarpone nhập khẩu.</li><li class=\"ql-indent-1\">Bánh Ladyfingers thủ công.</li><li class=\"ql-indent-1\">Rượu Marsala (hoặc Rum) tạo hương thơm đặc trưng.</li><li><strong>Quy cách đóng gói:</strong></li><li class=\"ql-indent-1\">Hũ đơn (Individual): Dành cho 1 người thưởng thức.</li><li>Phụ kiện đi kèm: Muỗng gỗ và hộp đựng thiết kế tối giản, sang trọng.</li></ul><h3><strong>Hướng dẫn bảo quản &amp; Thưởng thức:</strong></h3><ul><li>Nhiệt độ lý tưởng: Tiramisu ngon nhất khi được giữ lạnh sâu ở ngăn mát tủ lạnh (2°C - 4°C).</li><li>Thưởng thức: Nên dùng ngay sau khi lấy ra khỏi tủ lạnh để cảm nhận được độ mát lạnh và kết cấu kem mịn nhất.</li><li>Hạn sử dụng: Sử dụng tốt nhất trong vòng 36 giờ để đảm bảo hương vị cà phê luôn tươi mới.</li></ul><p><br></p>', 5000.00, 0, 'http://localhost/Web_banhang/backend/public/uploads/1776063619_0ec289492947872976c5c52215280faa.jpg', '[\"http:\\/\\/localhost\\/Web_banhang\\/backend\\/public\\/uploads\\/1776063619_sub_0_0ec289492947872976c5c52215280faa.jpg\",\"http:\\/\\/localhost\\/Web_banhang\\/backend\\/public\\/uploads\\/1776063619_sub_1_007f3a3232e85de6ac23b617720ac0d7.jpg\",\"http:\\/\\/localhost\\/Web_banhang\\/backend\\/public\\/uploads\\/1776063619_sub_2_ac65db648783045069e34d1b14f13d5b.jpg\"]', 1, 1, '2026-04-13 00:00:19', '2026-04-13 22:47:21', NULL),
(27, 11, 'Tiramisu Box', 'tiramisu-box', 'Nếu bạn đang tìm kiếm một món tráng miệng tiện lợi nhưng vẫn giữ trọn vẹn sự tinh tế của ẩm thực Ý, Tiramisu Box chính là sự lựa chọn không thể hoàn hảo hơn. Được đựng trong những chiếc hộp vuông vức, trong suốt, món bánh lộ diện với các tầng lớp bắt mắt, sẵn sàng chinh phục bạn bất cứ lúc nào.', '<ul><li>Cấu trúc tầng lớp:</li><li class=\"ql-indent-1\">Lớp phủ: Bột Cacao nguyên chất 100%.</li><li class=\"ql-indent-1\">Lớp kem: Mascarpone thượng hạng đánh quyện cùng Whipping Cream.</li><li class=\"ql-indent-1\">Lớp cốt: Bánh Ladyfingers nhúng cà phê Espresso đậm đặc.</li><li>Quy cách: * Hộp nhựa thực phẩm cao cấp, có nắp đậy kín.</li><li class=\"ql-indent-1\">Kích thước hộp: (Tùy chỉnh, ví dụ: 7cm x 10cm).</li><li>Phụ kiện: Tặng kèm muỗng gỗ hoặc muỗng nhựa đen cao cấp.</li></ul><h3><strong>Hướng dẫn sử dụng &amp; Bảo quản:</strong></h3><ul><li>Thưởng thức: Ngon nhất khi dùng lạnh ngay sau khi mở nắp.</li><li>Bảo quản: Luôn để trong ngăn mát tủ lạnh. Do thiết kế hộp kín, bánh có thể giữ được độ ẩm và hương vị ổn định hơn so với bánh ổ cắt miếng.</li><li>Hạn sử dụng: Trong vòng 48 giờ để cảm nhận độ tươi mới nhất của lớp kem phô mai.</li></ul><p><br></p>', 5000.00, 0, 'http://localhost/Web_banhang/backend/public/uploads/1776063800_39ae7a372e28361a0c29b6283c12e5d7.jpg', '[\"http:\\/\\/localhost\\/Web_banhang\\/backend\\/public\\/uploads\\/1776063800_sub_0_02b1e316a0507f0cff892825261ee0b5.jpg\",\"http:\\/\\/localhost\\/Web_banhang\\/backend\\/public\\/uploads\\/1776063800_sub_1_df625b184304626e496566a79c3698fd.jpg\",\"http:\\/\\/localhost\\/Web_banhang\\/backend\\/public\\/uploads\\/1776063800_sub_2_15f049a5986045d3141b96a9895483fd.jpg\"]', 1, 0, '2026-04-13 00:03:20', '2026-04-13 22:47:28', NULL),
(28, 11, 'Bánh Matcha Tiramisu', 'banh-matcha-tiramisu', 'Matcha Tiramisu Fusion là sự giao thoa tuyệt vời giữa món tráng miệng Tiramisu cổ điển của Ý và hương vị trà xanh Matcha thượng hạng của Nhật Bản. Chiếc bánh mang đến trải nghiệm vị giác đầy tinh tế, phù hợp cho những ai yêu thích sự thanh tao và không quá ngọt.', '<ul><li><strong>Cấu trúc tầng lớp (4 lớp đặc trưng):</strong></li><li class=\"ql-indent-1\">Lớp phủ: Bột Matcha nguyên chất loại 1, phủ dày tạo vị đắng thanh đặc trưng.</li><li class=\"ql-indent-1\">Lớp kem: Phô mai Mascarpone đánh quyện cùng trà xanh tạo nên kết cấu mịn màng, tan chảy như lụa.</li><li class=\"ql-indent-1\">Lớp cốt: Bánh Ladyfingers (Sampa) nhúng đẫm trong sốt Matcha nồng nàn thay vì Espresso truyền thống.</li><li class=\"ql-indent-1\">Trang trí: 5 viên Chocolate Matcha thủ công tạo điểm nhấn sang trọng.</li><li><strong>Thành phần chính:</strong></li><li class=\"ql-indent-1\">Bột Matcha Nhật Bản (Uji/Shizuoka).</li><li class=\"ql-indent-1\">Phô mai Mascarpone nhập khẩu.</li><li class=\"ql-indent-1\">Whipping Cream nguyên chất.</li><li><strong>Phụ kiện tặng kèm:</strong></li><li class=\"ql-indent-1\">Bộ dao &amp; muỗng gỗ thân thiện môi trường.</li><li class=\"ql-indent-1\">Nến sinh nhật (nếu yêu cầu).</li></ul><h3><strong>Hướng dẫn sử dụng &amp; Bảo quản:</strong></h3><ul><li>Bảo quản: Bắt buộc bảo quản trong ngăn mát tủ lạnh (2°C - 5°C).</li><li>Thưởng thức: Dùng ngay khi vừa lấy ra khỏi tủ lạnh để cảm nhận rõ độ mát lạnh và vị béo thanh của Mascarpone. Rất tuyệt vời khi dùng kèm trà nóng.</li><li>Hạn sử dụng: Sử dụng tốt nhất trong vòng 36 giờ để đảm bảo bột Matcha không bị xuống màu và giữ được hương thơm nguyên bản.</li></ul><p><br></p>', 100000.00, 0, 'http://localhost/Web_banhang/backend/public/uploads/1776064225_96a7470d6eead0c7ac027bcbad8f9ceb.jpg', '[\"http:\\/\\/localhost\\/Web_banhang\\/backend\\/public\\/uploads\\/1776064225_sub_0_2ebd8a4cf9a967659cf12796e342d3fc.jpg\",\"http:\\/\\/localhost\\/Web_banhang\\/backend\\/public\\/uploads\\/1776064225_sub_1_96a7470d6eead0c7ac027bcbad8f9ceb.jpg\",\"http:\\/\\/localhost\\/Web_banhang\\/backend\\/public\\/uploads\\/1776064225_sub_2_e763cb9ed74eaa44ae66c7ab30305bc3.jpg\"]', 1, 1, '2026-04-13 00:10:25', '2026-04-13 08:42:06', NULL),
(29, 12, 'Mousse Nhãn', 'mousse-nhan', 'Là một loại quả mang đậm phong vị xứ sở nhiệt đới, vị ngọt của nhãn vừa đủ để thay thế hoàn toàn cho lượng đường thêm vào bánh, vì thế, chúng tôi hầu như không sử dụng đường để làm loại bánh này. Mousse Nhãn mang vị ngọt thanh nhẹ nhàng và vừa vặn, không như những chiếc bánh ngọt khác, vị ngọt tự nhiên từ nhãn là vô cùng tinh tế, quyện cùng vị béo nhẹ của phô mai và lớp bánh bông lan Nhật Bản mềm mịn.', '<h2 class=\"ql-align-justify\">Mô tả bánh:</h2><p class=\"ql-align-justify\">Cầm một trái nhãn trên tay, và cả một vùng trời ấu thơ ngọt dịu tràn về. Vị nhãn dân dã ấu thơ ấy lại hòa cùng những tinh tế, cầu kỳ của Mousse để cho ra đời chiếc bánh đặc biệt của miền nhiệt đới – Mousse Nhãn.</p><p class=\"ql-align-justify\">Là một loại quả mang đậm phong vị xứ sở nhiệt đới, vị ngọt của nhãn vừa đủ để thay thế hoàn toàn cho lượng đường thêm vào bánh, vì thế, chúng tôi hầu như không sử dụng đường để làm loại bánh này. Mousse Nhãn mang vị ngọt thanh nhẹ nhàng và vừa vặn, không như những chiếc bánh ngọt khác, vị ngọt tự nhiên từ nhãn là vô cùng tinh tế, quyện cùng vị béo nhẹ của phô mai và lớp bánh bông lan Nhật Bản mềm mịn.</p><ul><li class=\"ql-align-justify\">Size đường kính 16cm cao 6.5cm cho 4-6 người ăn.</li><li class=\"ql-align-justify\">Size đường kính 20cm cao 6.5cm cho 10-12 người ăn.</li></ul><h2 class=\"ql-align-justify\">Cấu trúc bánh:</h2><ul><li class=\"ql-align-justify\">Lớp 1: Cốt bánh gato vị vani</li><li class=\"ql-align-justify\">Lớp 2: Mousse nhãn</li><li class=\"ql-align-justify\">Lớp 3: bánh gato vị vani</li><li class=\"ql-align-justify\">Lớp 4: Mousse nhãn</li></ul><h2 class=\"ql-align-justify\">Phụ kiện tặng kèm:</h2><ul><li class=\"ql-align-justify\">Bộ dao, muỗng gỗ &amp; dĩa ăn kèm</li><li class=\"ql-align-justify\">Hộp nến</li></ul><h2 class=\"ql-align-justify\">Hướng dẫn sử dụng:</h2><ul><li class=\"ql-align-justify\">Nên giữ bánh trong hộp kín và bảo quản bánh trong ngăn mát tủ lạnh.</li><li class=\"ql-align-justify\">Hạn chế để bánh tiếp xúc với ánh nắng trực tiếp và tránh để bánh quá lâu ở nhiệt độ phòng.</li><li class=\"ql-align-justify\">Sử dụng trong vòng 24h.</li></ul><p><br></p>', 520000.00, 0, 'http://localhost/Web_banhang/backend/public/uploads/1776064456_NHAN-ko-mam-xoi.jpg', '[\"http:\\/\\/localhost\\/Web_banhang\\/backend\\/public\\/uploads\\/1776064456_sub_0_CT-Banh-nhan.jpg\"]', 1, 0, '2026-04-13 00:14:16', '2026-04-13 00:14:16', NULL),
(30, 12, 'Mousse Bắp', 'mousse-bap', 'Chiếc bánh  mở ra với những lớp mềm mịn đan xen đầy tinh tế: hai tầng bánh bông lan hương vani nhẹ xốp, thơm dịu, xen giữa là lớp custard béo mượt tan chảy nơi đầu lưỡi hòa quyện cùng mousse bắp mịn mát, thanh ngọt tự nhiên, tất cả được ôm trọn trong lớp bánh Charlotte ẩm mềm. Mỗi muỗng bánh là sự hòa quyện vừa đủ giữa độ bông xốp, độ béo và cảm giác mát lành, nhẹ nhàng nhưng vẫn đậm đà dư vị.', '<h2 class=\"ql-align-justify\">Mô tả bánh:</h2><p class=\"ql-align-justify\">Sự rực rỡ bên ngoài như một lời mời gọi đầy háo hức, khiến bạn phải đưa tay xắn nhẹ từng lớp bánh và thưởng thức. Nhưng chầm chậm từng chút để làn hương dịu ngọt mỏng mảnh ấy bao bọc lấy mình và cảm nhận mùi kem sữa, lớp custard sữa bắp đậm đà cùng lớp bánh Charlotte mềm ẩm tan dần êm ái trên đầu lưỡi.</p><p class=\"ql-align-justify\">Mình luôn tin một hương vị đẹp sẽ luôn còn mãi, chúng âm ỉ chảy trong lòng thành thứ kỷ niệm ngọt lành. Để lúc vui bạn hồi tưởng, khi buồn lại khe khẽ mở ra để tìm chút khoái cảm dễ chịu cho mình. Mong rằng chiếc bánh này sẽ được cùng bạn viết nên thật nhiều những êm đềm như thế!</p><ul><li class=\"ql-align-justify\">Size đường kính 16 cm, cao 6.5 cm cho 4-6 người ăn.</li><li class=\"ql-align-justify\">Size đường kính 20 cm, cao 6.5 cm cho 10-12 người ăn.</li></ul><h2 class=\"ql-align-justify\">Cấu trúc bánh:</h2><ul><li class=\"ql-align-justify\">Lớp 1: Bánh bông lan hương vani ngọt dịu</li><li class=\"ql-align-justify\">Lớp 2: Kem custard ngậy béo</li><li class=\"ql-align-justify\">Lớp 3: Bánh bông lan hương vani ngọt dịu</li><li class=\"ql-align-justify\">Lớp 4: Mousse bắp mịn mát</li><li class=\"ql-align-justify\">Lớp 5: Phủ bên ngoài là lớp bánh Charlotte ẩm mềm, tan trong miệng</li></ul><h2 class=\"ql-align-justify\">Phụ kiện tặng kèm:</h2><ul><li class=\"ql-align-justify\">Bộ dao, muỗng gỗ &amp; dĩa ăn kèm</li><li class=\"ql-align-justify\">Hộp nến</li></ul><h2 class=\"ql-align-justify\">Hướng dẫn sử dụng:</h2><ul><li class=\"ql-align-justify\">Nên giữ bánh trong hộp kín và bảo quản bánh trong ngăn mát tủ lạnh.</li><li class=\"ql-align-justify\">Hạn chế để bánh tiếp xúc với ánh nắng trực tiếp và tránh để bánh quá lâu ở nhiệt độ phòng.</li><li class=\"ql-align-justify\">Sử dụng trong vòng 24h.</li></ul><p><br></p>', 550000.00, 0, 'http://localhost/Web_banhang/backend/public/uploads/1776064567_CT-Bap-O-3.jpg', '[\"http:\\/\\/localhost\\/Web_banhang\\/backend\\/public\\/uploads\\/1776064567_sub_0_CT-Bap-O-2.jpg\",\"http:\\/\\/localhost\\/Web_banhang\\/backend\\/public\\/uploads\\/1776064567_sub_1_CT-Bap-O-3.jpg\",\"http:\\/\\/localhost\\/Web_banhang\\/backend\\/public\\/uploads\\/1776064567_sub_2_CT-Bap-O-4.jpg\"]', 1, 0, '2026-04-13 00:16:07', '2026-04-13 00:16:07', NULL),
(31, 12, 'Tiramisu', 'tiramisu', 'Ổ bánh tưởng chừng đơn giản nhưng sự cầu kỳ bên trong từng lớp bánh mới là điều làm xiêu lòng Tiramisu Lovers. Vừa thoảng hương espresso nồng nàn, vừa đượm chút ngây ngất của rượu Rhum, vừa phảng phất vị ngậy béo của Mascarpone, vừa mềm mại của cốt bánh gato.\r\n\r\nBánh được trang trí với những ụ kem nhỏ, thêm ít socola và cacao phủ trên bề mặt. Tất cả đều thu hút và đầy quyến rũ để bạn muốn được thưởng thức ngay tức thì.', '<h2 class=\"ql-align-justify\">Mô tả bánh:</h2><p class=\"ql-align-justify\">Một miếng bánh đủ để bao ấm ức, muộn phiền trong lòng tan ra nhẹ tênh; chẳng cần làm gì, chỉ cần ngồi im thưởng thức từng muỗng bánh nhỏ, êm mượt như ru và thơm nức nở vị cà phê espresso nguyên chất cũng đủ để bạn tủm tỉm cười khẽ một mình. Đó chỉ có thể là Tiramisu.</p><p class=\"ql-align-justify\">Được làm hoàn toàn từ những nguyên liệu cao cấp như bánh Lady Finger nướng thủ công, bột Cacao thượng hạng, Mascarpone nhập khẩu từ Ý hay cà phê Colombia… Tiramisu “made by The 350F” sẽ nâng tầm trải nghiệm của bạn với vị ngọt - đắng được cân bằng hoàn hảo và cấu trúc bánh đan xen nhiều lớp đầy tinh tế.</p><p class=\"ql-align-justify\">Một chiếc bánh quen thuộc nhưng đầy ắp sự bất ngờ, hấp dẫn và khiến vị giác của bạn bùng nổ hơn bao giờ. Hãy sẵn sàng thưởng thức vị của “thiên đường” theo cách mà bạn mong muốn.</p><ul><li class=\"ql-align-justify\">Size đường kính 16cm cao 6.5cm cho 4-6 người ăn.</li><li class=\"ql-align-justify\">Size đường kính 20cm cao 6.5cm cho 10-12 người ăn.</li></ul><h2 class=\"ql-align-justify\">Cấu trúc bánh:</h2><ul><li class=\"ql-align-justify\">Lớp 1: Cốt bánh Lady Fingers</li><li class=\"ql-align-justify\">Lớp 2: Mousse Tiramisu</li><li class=\"ql-align-justify\">Lớp 3: Cốt bánh Lady Fingers</li><li class=\"ql-align-justify\">Lớp 4: Mousse Tiramisu</li></ul><h2 class=\"ql-align-justify\">Phụ kiện tặng kèm:</h2><ul><li class=\"ql-align-justify\">Bộ dao, muỗng gỗ &amp; dĩa ăn kèm</li><li class=\"ql-align-justify\">Hộp nến</li></ul><h2 class=\"ql-align-justify\">Hướng dẫn sử dụng:</h2><ul><li class=\"ql-align-justify\">Nên giữ bánh trong hộp kín và bảo quản bánh trong ngăn mát tủ lạnh.</li><li class=\"ql-align-justify\">Hạn chế để bánh tiếp xúc với ánh nắng trực tiếp và tránh để bánh quá lâu ở nhiệt độ phòng.</li><li class=\"ql-align-justify\">Sử dụng trong vòng 24h.</li></ul><p><br></p>', 580000.00, 0, 'http://localhost/Web_banhang/backend/public/uploads/1776064659_ChiTietTiramisu-1.jpg', '[\"http:\\/\\/localhost\\/Web_banhang\\/backend\\/public\\/uploads\\/1776064659_sub_1_ChiTietTiramisu-5.jpg\"]', 1, 0, '2026-04-13 00:17:39', '2026-04-13 00:17:39', NULL),
(32, 12, 'Mousse Dưa lưới', 'mousse-dua-luoi', 'Bánh có vị thơm và béo nhẹ nhàng từ phô mai tươi kết hợp cùng kem sữa và Dưa Lưới Mật giống Fuji nấu chậm, bên trong là rất nhiều dưa lưới tươi và cốt bánh gato vị vani, cùng với một ít rượu Dưa Lưới nồng nàn. Cũng đơn giản như chính cái tên, Mousse Dưa Lưới vừa đủ gây ấn tượng khi nhìn vào màu xanh mát lành tinh tươm với những cụm dưa tươi mát được trang trí bên ngoài, vừa đủ để bạn có đôi chút ngập ngừng khi chạm dao vào từng miếng bánh mong manh.', '<h2 class=\"ql-align-justify\">Mô tả bánh:</h2><p class=\"ql-align-justify\">Chiếc bánh này ra đời trong những ngày oi ả của Sài Gòn nhưng lại được gói ghém cả một khoảng trời yên vui với rất nhiều những tâm huyết và sự sáng tạo bất tận. Bánh có vị thơm và béo nhẹ nhàng từ phô mai tươi kết hợp cùng kem sữa và Dưa Lưới Mật giống Fuji nấu chậm, bên trong là rất nhiều dưa lưới tươi và cốt bánh gato vị vani, cùng với một ít rượu Dưa Lưới nồng nàn. Cũng đơn giản như chính cái tên, Bánh Dưa Lưới vừa đủ gây ấn tượng khi nhìn vào màu xanh mát lành tinh tươm với những cụm dưa tươi mát được trang trí bên ngoài, vừa đủ để bạn có đôi chút ngập ngừng khi chạm dao vào từng miếng bánh mong manh. Nhưng khi gai lưỡi chạm khẽ vào sự mềm mượt ấy, cảm nhận được vị mát lành chẳng thể trộn lẫn của dưa lưới đong đưa trên vòm họng, bạn sẽ hiểu vì sao mình lại muốn mang hương vị mới mẻ ấy đến cho các bạn như thế.</p><p class=\"ql-align-justify\">Đôi khi sẽ dễ hơn để chấp nhận những điều đã trở nên quen thuộc; nhưng đôi khi mình mong gửi gắm tới các bạn những hương vị mới để chúng mình cùng nếm, cùng trải nghiệm bằng một tâm hồn rộng mở và khoáng đạt.</p><ul><li class=\"ql-align-justify\">Size đường kính 16cm cao 6.5cm cho 4-6 người ăn.</li><li class=\"ql-align-justify\">Size đường kính 20cm cao 6.5cm cho 10-12 người ăn.</li></ul><h2 class=\"ql-align-justify\">Cấu trúc bánh:</h2><ul><li class=\"ql-align-justify\">Lớp 1: Bánh bông lan vị vani</li><li class=\"ql-align-justify\">Lớp 2: Dưa lưới mật tươi thái hạt lựu</li><li class=\"ql-align-justify\">Lớp 3: Mousse Dưa lưới</li></ul><h2 class=\"ql-align-justify\">Phụ kiện tặng kèm:</h2><ul><li class=\"ql-align-justify\">Bộ dao, muỗng gỗ &amp; dĩa ăn kèm</li><li class=\"ql-align-justify\">Hộp nến</li></ul><h2 class=\"ql-align-justify\">Hướng dẫn sử dụng:</h2><ul><li class=\"ql-align-justify\">Nên giữ bánh trong hộp kín và bảo quản bánh trong ngăn mát tủ lạnh.</li><li class=\"ql-align-justify\">Hạn chế để bánh tiếp xúc với ánh nắng trực tiếp và tránh để bánh quá lâu ở nhiệt độ phòng.</li><li class=\"ql-align-justify\">Sử dụng trong vòng 24h.</li></ul><p><br></p>', 580000.00, 0, 'http://localhost/Web_banhang/backend/public/uploads/1776064750_CT-Dua-1.jpg', '[\"http:\\/\\/localhost\\/Web_banhang\\/backend\\/public\\/uploads\\/1776064750_sub_0_CT-Dua-2.jpg\",\"http:\\/\\/localhost\\/Web_banhang\\/backend\\/public\\/uploads\\/1776064750_sub_1_CT-Dua-3.jpg\",\"http:\\/\\/localhost\\/Web_banhang\\/backend\\/public\\/uploads\\/1776064750_sub_2_CT-Dua-4.jpg\"]', 1, 0, '2026-04-13 00:19:10', '2026-04-13 00:19:10', NULL),
(33, 12, 'Mousse Dâu', 'mousse-dau', 'Mousse Dâu mang hương sắc ngọt ngào, trong trẻo và vô cùng dễ thương. Trong đó, lớp mousse được làm từ những trái dâu tây và mâm xôi đỏ căng mọng với điểm nhấn là lớp sữa chua Hy Lạp thơm béo hòa quyện cùng cốt bánh gato socola nồng nàn.\r\n\r\nNhư một trái dâu tươi mọng, thơm lừng còn đẫm sương từ khu vườn, Mousse Dâu được trang trí với sắc đỏ quyến rũ cùng rất nhiều trái cây tươi bên trên hứa hẹn sẽ mang đến cho bạn những trải nghiệm hấp dẫn.', '<h2 class=\"ql-align-justify\">Mô tả bánh:</h2><p class=\"ql-align-justify\">Mousse Dâu thu hút với vị chua ngọt tự nhiên từ các loại trái cây mùa hè như dâu tây, dâu tằm, mâm xôi hòa hợp với vị béo mịn của kem sữa và thoang thoảng chút sánh mịn tự nhiên từ Greek Yogurt. Không biết có phải vì sự kết hợp của những nguyên liệu rất Tây không mà Mousse Dâu để lại trên đầu lưỡi nét vị vừa sang trọng, quyến rũ, vừa tươi mới mà cũng tràn đầy bí ẩn.</p><p class=\"ql-align-justify\">Với 350F, đây là chiếc bánh dành riêng cho những quý cô ngọt ngào, thanh lịch nhưng với cánh mày râu, thử một lần thưởng thức hương vị “nóng bỏng” này biết đâu bạn cũng sẽ thấy xiêu lòng ít nhiều đó nhé!</p><p>Cấu trúc bánh:</p><p>Layer 1: Cốt bánh gato vị socola</p><ul><li class=\"ql-align-justify\">Layer 2: Mousse dâu tây</li><li class=\"ql-align-justify\">Layer 3: Cốt bánh gato vị socola</li><li class=\"ql-align-justify\">Layer 4: Mousse dâu tây</li></ul><p>Phụ kiện tặng kèm:</p><p>Bộ dao, muỗng gỗ &amp; dĩa ăn kèm</p><p>Hộp nến</p><p>Hướng dẫn sử dụng:</p><ul><li class=\"ql-align-justify\">Nên giữ bánh trong hộp kín và bảo quản bánh trong ngăn mát tủ lạnh.</li><li class=\"ql-align-justify\">Hạn chế để bánh tiếp xúc với ánh nắng trực tiếp và tránh để bánh quá lâu ở nhiệt độ phòng.</li><li class=\"ql-align-justify\">Sử dụng trong vòng 24h.</li></ul>', 740000.00, 0, 'http://localhost/Web_banhang/backend/public/uploads/1776064902_CT-Dau-1.jpg', '[\"http:\\/\\/localhost\\/Web_banhang\\/backend\\/public\\/uploads\\/1776064902_sub_0_CT-Dau-2.jpg\",\"http:\\/\\/localhost\\/Web_banhang\\/backend\\/public\\/uploads\\/1776064902_sub_1_CT-Dau-3.jpg\",\"http:\\/\\/localhost\\/Web_banhang\\/backend\\/public\\/uploads\\/1776064902_sub_2_CT-Dau-4.jpg\"]', 1, 0, '2026-04-13 00:21:42', '2026-04-13 00:21:42', NULL),
(34, 12, 'Mousse Xoài', 'mousse-xoai', 'Một bản phối rực rỡ và tươi mát từ các vị trái cây nhiệt đới. Mousse Xoài sử dụng vị ngọt đặc trưng của trái xoài cát Hòa Lộc, kết hợp với thơm tươi ép nước và chanh dây nấu mứt, không thể thiếu lớp Mousse êm mướt từ kem sữa và Yogurt Hy Lạp. Nhờ vậy, ổ bánh khuấy động giác quan bởi hương thơm thanh khiết quyện cùng vị ngọt trong trẻo.', '<h2 class=\"ql-align-justify\">Mô tả bánh:</h2><p class=\"ql-align-justify\">Nếu nhận được một chiếc Mousse Xoài trong một ngày mưa, bạn hãy sẵn sàng nhé, để bước vào những hương vị tươi nguyên của xứ nhiệt đới gió mùa.</p><p class=\"ql-align-justify\">Xoài, Thơm và Chanh Dây – những loại trái cây thân thuộc sẽ “biến hóa” cùng sự mềm mịn lẫn trong vị chua béo nhẹ nhàng của lớp mousse Greek Yogurt, mang đến vị ngọt đằm ẩn chứa trong hương tươi mát. Hãy xắn một muỗng đầy gồm đầy đủ các lớp bánh gato và mousse yogurt và vài miếng trái cây tươi trang trí ngay trên mặt bánh, để cảm nhận trọn vẹn nhất nhé.</p><p class=\"ql-align-justify\">Nếu luôn “mơ” về những chiếc bánh ít ngọt, ít béo nhưng mê đắm các loại mousse trái cây, Mango Mousse chính là sự lựa chọn không thể hoàn hảo hơn.</p><ul><li class=\"ql-align-justify\">Size đường kính 16cm cao 6.5cm cho 4-6 người ăn.</li><li class=\"ql-align-justify\">Size đường kính 20cm cao 6.5cm cho 10-12 người ăn.</li></ul><h2 class=\"ql-align-justify\">Cấu trúc bánh:</h2><ul><li class=\"ql-align-justify\">Lớp 1: Bánh bông lan vị vani</li><li class=\"ql-align-justify\">Lớp 2: Custard xoài &amp; chanh dây</li><li class=\"ql-align-justify\">Lớp 3: Mousse xoài được kết hợp giữa whipping cream , mứt xoài và sữa chua</li></ul><h2 class=\"ql-align-justify\">Phụ kiện tặng kèm:</h2><ul><li class=\"ql-align-justify\">Bộ dao, muỗng gỗ &amp; dĩa ăn kèm</li><li class=\"ql-align-justify\">Hộp nến</li></ul><h2 class=\"ql-align-justify\">Hướng dẫn sử dụng:</h2><ul><li class=\"ql-align-justify\">Nên giữ bánh trong hộp kín và bảo quản bánh trong ngăn mát tủ lạnh.</li><li class=\"ql-align-justify\">Hạn chế để bánh tiếp xúc với ánh nắng trực tiếp và tránh để bánh quá lâu ở nhiệt độ phòng.</li><li class=\"ql-align-justify\">Sử dụng trong vòng 24h.</li></ul><p><br></p>', 530000.00, 0, 'http://localhost/Web_banhang/backend/public/uploads/1776065019_Ban-sao-cua-_IMG2338-copy.jpg', '[\"http:\\/\\/localhost\\/Web_banhang\\/backend\\/public\\/uploads\\/1776065019_sub_0_Ban-sao-cua-_IMG2338-copy.jpg\",\"http:\\/\\/localhost\\/Web_banhang\\/backend\\/public\\/uploads\\/1776065019_sub_1_Ban-sao-cua-_IMG2354-copy.jpg\"]', 1, 1, '2026-04-13 00:23:39', '2026-04-13 00:29:30', NULL),
(35, 12, 'Mousse Bưởi hồng', 'mousse-buoi-hong', 'Chiếc bánh sở hữu tone hồng ngọt ngào được nhấn nhá bằng những tép bưởi thơm mọng. Trong đó, lớp Mousse bưởi da xanh kết hợp cùng sô-cô-la Rubby ghi dấu ấn bởi vị ngọt nhẹ, tươi tắn thì lớp Mousse Trà Ô long Đài Loan lại mang đến cảm giác dìu dặt, thơm mát.\r\n\r\nDù có nhiều tầng vị nhưng Mousse Trà Ô long Bưởi hồng vẫn tạo cảm giác gắn kết, hoà quyện khi thưởng thức. Với sự độc đáo khó lẫn, đây vẫn là chiếc bánh yêu thích nhất của The 350F và lựa chọn tuyệt vời để bạn vỗ về vị giác của mình.', '<h2 class=\"ql-align-justify\">Mô tả bánh:</h2><p class=\"ql-align-justify\">Một ổ bánh với sắc hồng ngọt ngào, gợi lên liên tưởng như đóa hoa nở rộ, nồng nàn và tràn đầy sức sống. Bên trong ổ bánh là tầng tầng lớp lớp hương vị độc đáo, thú vị như tính cách của phái đẹp. Tưởng chừng bí ẩn, khó đoán nhưng càng khám phá, bạn sẽ càng thấu hiểu và say mê hơn ổ bánh xinh xắn này.</p><p class=\"ql-align-justify\">Bên cạnh lớp mousse nồng đượm vị trà Oolong Đài Loan thượng hạng, chiếc bánh còn có sự kết hợp của bưởi hồng da xanh nấu mứt cùng socola Ruby và Zephyr cao cấp từ hãng Barry danh tiếng. Một điểm thú vị hơn cả chính là nhờ socola Ruby – loại socola được làm hoàn toàn từ hạt cacao Ruby nguyên bản, không sử dụng bất kỳ chất tạo màu nào – nên ổ bánh sở hữu sắc hồng vô cùng quyến rũ. Ngoài ra, socola Ruby còn nổi bật với hương vị tươi mới của trái cây chín mọng.</p><ul><li class=\"ql-align-justify\">Size đường kính 16cm cao 6.5cm cho 4-6 người ăn.</li><li class=\"ql-align-justify\">Size đường kính 20cm cao 6.5cm cho 10-12 người ăn.</li></ul><h2 class=\"ql-align-justify\">Cấu trúc bánh:</h2><ul><li class=\"ql-align-justify\">Lớp 1: Cốt bánh gato vị vani</li><li class=\"ql-align-justify\">Lớp 2: Mousse Trà Ô long Đài Loan thượng hạng</li><li class=\"ql-align-justify\">Lớp 3: Mousse bưởi da xanh kết hợp cùng socola Ruby</li><li class=\"ql-align-justify\">Lớp 4: Mousse bưởi</li></ul><h2 class=\"ql-align-justify\">Phụ kiện tặng kèm:</h2><ul><li class=\"ql-align-justify\">Bộ dao, muỗng gỗ &amp; dĩa ăn kèm</li><li class=\"ql-align-justify\">Hộp nến</li></ul><h2 class=\"ql-align-justify\">Hướng dẫn sử dụng:</h2><ul><li class=\"ql-align-justify\">Nên giữ bánh trong hộp kín và bảo quản bánh trong ngăn mát tủ lạnh</li><li class=\"ql-align-justify\">Hạn chế để bánh tiếp xúc với ánh nắng trực tiếp và tránh để bánh quá lâu ở nhiệt độ phòng</li><li class=\"ql-align-justify\">Sử dụng trong vòng 24h.</li></ul><p><br></p>', 580000.00, 10, 'http://localhost/Web_banhang/backend/public/uploads/1776065204_CTBuoiHong-4.jpg', '[\"http:\\/\\/localhost\\/Web_banhang\\/backend\\/public\\/uploads\\/1776065204_sub_0_CTBuoiHong-2.jpg\",\"http:\\/\\/localhost\\/Web_banhang\\/backend\\/public\\/uploads\\/1776065204_sub_1_CTBuoiHong-3.jpg\"]', 1, 1, '2026-04-13 00:26:44', '2026-05-10 05:29:32', '2026-05-11 12:34:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `order_item_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `guest_name` varchar(255) DEFAULT NULL,
  `rating` int(11) NOT NULL DEFAULT 5,
  `comment` text DEFAULT NULL,
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`images`)),
  `videos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`videos`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `order_item_id`, `user_id`, `guest_name`, `rating`, `comment`, `images`, `videos`, `created_at`, `updated_at`) VALUES
(1, 27, 94, 4, 'Phan Hùng Thịnh', 5, 'sản phẩm tốt', '[\"http:\\/\\/equator-skiing-symphony.ngrok-free.dev\\/Web_banhang\\/backend\\/public\\/uploads\\/reviews\\/1778386195_6a000513deb56.jpg\"]', '[]', '2026-05-09 21:09:55', '2026-05-09 21:09:55'),
(2, 26, 90, 4, 'Phan Hùng Thịnh', 5, 'ngon', '[\"http:\\/\\/equator-skiing-symphony.ngrok-free.dev\\/Web_banhang\\/backend\\/public\\/uploads\\/reviews\\/1778387672_6a000ad89926f.png\"]', '[]', '2026-05-09 21:34:32', '2026-05-09 21:34:32'),
(3, 27, 91, 4, 'Phan Hùng Thịnh', 4, 'ngon', '[]', '[\"http:\\/\\/equator-skiing-symphony.ngrok-free.dev\\/Web_banhang\\/backend\\/public\\/uploads\\/reviews\\/1778387924_6a000bd4dc4dc.MOV\"]', '2026-05-09 21:38:44', '2026-05-09 21:38:44'),
(4, 35, 113, 4, 'Phan Hùng Thịnh', 5, 'Ngon', '[]', '[]', '2026-05-17 07:59:12', '2026-05-17 07:59:12'),
(5, 26, 114, 4, 'Phan Hùng Thịnh', 5, 'Sản phẩm ngon', '[]', '[]', '2026-05-17 08:05:29', '2026-05-17 08:05:29'),
(6, 34, 115, 4, 'Phan Hùng Thịnh', 5, 'Sản phẩm ngon', '[]', '[]', '2026-05-17 08:10:53', '2026-05-17 08:10:53');

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
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cart` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `image`, `email_verified_at`, `password`, `phone`, `role`, `remember_token`, `created_at`, `updated_at`, `cart`) VALUES
(1, 'admin', 'Admin', 'admin@email.com', NULL, NULL, '$2y$12$9HFUuMRApiF1xb3GR8DT.eeUty613OhjOxL6Sz7f0E3G/eUaRwQI.', NULL, 'admin', NULL, '2026-04-03 04:54:21', '2026-05-06 05:30:08', '[]'),
(4, 'thinh123', 'Phan Hùng Thịnh', 'phattuan460@gmail.com', 'uploads/avatars/1778395726_1.jpg', NULL, '$2y$12$KWJd0OxeLRDRCyS36i0Zyepy.By1dUHLCb.lHb2L9rOVpd1Ai7Z9G', NULL, 'user', NULL, '2026-04-03 10:04:08', '2026-05-17 09:03:31', '[{\"id\":26,\"name\":\"Classic Tiramisu\",\"price\":5000,\"image\":\"http://localhost/Web_banhang/backend/public/uploads/1776063619_0ec289492947872976c5c52215280faa.jpg\",\"quantity\":1,\"selected\":false,\"greeting\":\"\"},{\"id\":34,\"name\":\"Mousse Xoài\",\"price\":530000,\"image\":\"http://localhost/Web_banhang/backend/public/uploads/1776065019_Ban-sao-cua-_IMG2338-copy.jpg\",\"quantity\":1,\"selected\":false,\"greeting\":\"\"},{\"id\":35,\"name\":\"Mousse Bưởi hồng\",\"price\":522000,\"image\":\"http://localhost/Web_banhang/backend/public/uploads/1776065204_CTBuoiHong-4.jpg\",\"quantity\":2,\"selected\":false,\"greeting\":\"\"}]'),
(11, 'tai', 'Anh Tai', 'huynhthaibaongan.d@gmail.com', NULL, NULL, '$2y$12$E27AR4p6zsh1WXeNA5D.h.NfFb8LBW8biW9EC0VOco.3L7AAPqMQW', '0965050143', 'user', NULL, '2026-04-13 06:54:32', '2026-04-21 04:26:48', '[{\"id\":34,\"name\":\"Mousse Xoài\",\"price\":530000,\"image\":\"http://localhost/Web_banhang/backend/public/uploads/1776065019_Ban-sao-cua-_IMG2338-copy.jpg\",\"quantity\":1,\"selected\":false},{\"id\":27,\"name\":\"Tiramisu Box\",\"price\":2000,\"image\":\"http://localhost/Web_banhang/backend/public/uploads/1776063800_39ae7a372e28361a0c29b6283c12e5d7.jpg\",\"quantity\":1,\"selected\":false},{\"id\":28,\"name\":\"Bánh Matcha Tiramisu\",\"price\":100000,\"image\":\"http://localhost/Web_banhang/backend/public/uploads/1776064225_96a7470d6eead0c7ac027bcbad8f9ceb.jpg\",\"quantity\":1,\"selected\":true}]'),
(13, 'thinh12', 't', 'thinhph0343@gmail.com', NULL, NULL, '$2y$12$TXGsgneQhnbTJy7dir0LxOG6TiSqza.ORkEEedGrPFl4RVzCvSAve', '0987878324', 'user', NULL, '2026-05-09 09:28:22', '2026-05-09 09:28:22', NULL);

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
(1, 4, 'Thịnh', '0965050142', 'Nhà', 'phanhungthinh0123@gmail.com', 'Thành phố Hồ Chí Minh', 'Quận Bình Thạnh', 'Phường 26', '79', '765', '26914', '201 Nguyễn Xí', 1, '2026-04-08 07:43:28', '2026-04-13 06:41:21'),
(4, 11, 'Ngân', '0333594833', 'Nhà riêng', 'huynhthaibaongan.d@gmail.com', 'Thành phố Hồ Chí Minh', 'Quận Bình Thạnh', 'Phường 26', '79', '765', '26914', '201 Nguyễn Xí', 1, '2026-04-13 07:58:21', '2026-04-13 07:58:21');

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
-- Chỉ mục cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_order_item_id_foreign` (`order_item_id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT cho bảng `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `user_addresses`
--
ALTER TABLE `user_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- Các ràng buộc cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_order_item_id_foreign` FOREIGN KEY (`order_item_id`) REFERENCES `order_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD CONSTRAINT `user_addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
