-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 10, 2024 at 02:02 PM
-- Server version: 10.2.44-MariaDB
-- PHP Version: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siejrne_possist`
--

-- --------------------------------------------------------

--
-- Table structure for table `cash_registers`
--

CREATE TABLE `cash_registers` (
  `id` int(10) UNSIGNED NOT NULL,
  `cash_in_hands` double NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Ropa', '2024-01-11 17:34:59', '2024-02-06 03:55:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provious_due` double DEFAULT NULL,
  `account_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `first_name`, `last_name`, `company_name`, `email`, `phone`, `address`, `client_type`, `provious_due`, `account_no`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Comprador', '', 'N/A', 'N/A', 'N/A', 'N/A', 'customer', NULL, NULL, '2022-05-13 19:31:42', NULL, NULL),
(2, 'Proveedor', '', 'N/A', 'N/A', 'N/A', 'N/A', 'purchaser', NULL, NULL, '2022-05-13 19:31:45', NULL, NULL),
(8, 'Juan Perez', '12345', '', NULL, '04121016309', 'Zona Industrial', 'retailer', NULL, NULL, '2024-02-10 13:36:09', '2024-02-10 13:36:09', NULL),
(9, 'Karla Perez', '1234567', '', NULL, '0412', 'Maturin', 'retailer', NULL, NULL, '2024-02-10 14:05:15', '2024-02-10 14:05:15', NULL),
(10, 'Petra Sosa', '1234567', '', NULL, '123456789', 'Carupano', 'retailer', NULL, NULL, '2024-02-10 15:16:21', '2024-02-10 15:16:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `damages`
--

CREATE TABLE `damages` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(10) UNSIGNED NOT NULL,
  `expense_category_id` int(11) DEFAULT NULL,
  `purpose` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `expense_category_id`, `purpose`, `amount`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'ALQUILER', 220, '2022-05-16 00:55:36', '2022-05-24 00:56:00', NULL),
(2, 1, 'NOMINA', 160, '2022-05-28 00:58:26', '2022-05-27 10:55:57', '2022-05-27 10:55:57');

-- --------------------------------------------------------

--
-- Table structure for table `expense_categories`
--

CREATE TABLE `expense_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expense_categories`
--

INSERT INTO `expense_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'GASTOS FIJOS', '2022-05-24 00:54:06', '2022-05-24 00:54:06');

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
(129, '2014_10_12_000000_create_users_table', 1),
(130, '2014_10_12_100000_create_password_resets_table', 1),
(131, '2016_03_04_222133_create_roles_and_permissions', 1),
(132, '2016_05_28_151525_create_categories_table', 1),
(133, '2016_05_28_171103_create_products_table', 1),
(134, '2016_06_01_102127_create_clients_table', 1),
(135, '2016_06_04_051700_create_purchases_table', 1),
(136, '2016_06_04_055308_create_sells_table', 1),
(137, '2016_08_07_171103_create_settings_table', 1),
(138, '2017_04_15_062247_create_subcategories_table', 1),
(139, '2017_04_18_162635_create_transactions_table', 1),
(140, '2017_04_18_163120_create_payments_table', 1),
(141, '2017_05_09_141832_create_expenses_table', 1),
(142, '2017_05_09_163417_create_cash_registers_table', 1),
(143, '2017_07_20_095753_return_transactions', 1),
(144, '2017_09_23_124759_add_total_cost_price_to_transactions', 1),
(145, '2017_09_23_125158_add_unit_cost_price_to_sells', 1),
(146, '2017_09_30_111639_add_product_tax_settings_table', 1),
(147, '2017_09_30_124521_create_taxes_table', 1),
(148, '2017_09_30_174958_add_tax_products_table', 1),
(149, '2017_10_02_113608_add_product_tax_purchases_table', 1),
(150, '2017_10_07_131748_add_product_tax_sells_table', 1),
(151, '2017_12_09_115424_add_invoice_tax_to_settings_table', 1),
(152, '2018_01_16_170527_create_warehouses_table', 1),
(153, '2018_01_23_131658_add_themes_to_settings_table', 1),
(154, '2018_02_02_051610_add_warehouse_id_to_transactions_table', 1),
(155, '2018_02_02_052112_add_warehouse_id_to_users_table', 1),
(156, '2018_02_02_172319_add_warehouse_id_to_sells_table', 1),
(157, '2018_02_02_172424_add_warehouse_id_to_purchases_table', 1),
(158, '2018_03_15_071226_add_previous_due_to_clients_table', 1),
(159, '2018_03_19_114434_add_opening_stocks_to_products', 1),
(160, '2018_04_21_064012_add_pos_invoice_footer_to_settings_table', 1),
(161, '2018_04_21_184205_add_pos_to_transaction_table', 1),
(162, '2019_05_08_180655_add_date_to_transactions_table', 1),
(163, '2019_05_09_102812_add_date_to_sells_table', 1),
(164, '2019_05_09_103021_add_date_to_purchases_table', 1),
(165, '2019_05_09_105630_add_date_to_payments_table', 1),
(166, '2019_07_27_175836_add_alert_quantity_to_products_table', 1),
(167, '2019_12_21_180035_add_return_invoice_to_transactions_table', 1),
(168, '2019_12_23_062352_create_damages_table', 1),
(169, '2020_01_31_171222_create_expense_categories_table', 1),
(170, '2020_01_31_183032_add_expense_category_id_to_expense_table', 1),
(171, '2020_06_23_195458_create_tasas_table', 1),
(172, '2020_06_28_122408_create_ordercs_table', 2),
(173, '2020_06_28_122425_create_ordercds_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `ordercds`
--

CREATE TABLE `ordercds` (
  `id` int(10) UNSIGNED NOT NULL,
  `orderc_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `subtotal` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ordercs`
--

CREATE TABLE `ordercs` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `client_id`, `amount`, `method`, `type`, `reference_no`, `note`, `date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 250, 'cash', 'credit', '2024/02/S-0001', NULL, '2024-02-10 13:58:00', '2024-02-10 13:58:00', '2024-02-10 13:58:00', NULL),
(2, 1, 1500, 'cash', 'credit', '2024/02/S-0002', NULL, '2024-02-10 13:58:24', '2024-02-10 13:58:24', '2024-02-10 13:58:24', NULL),
(3, 8, 2000, 'cash', 'credit', '2024/02/S-0003', NULL, '2024-02-10 14:04:24', '2024-02-10 14:04:24', '2024-02-10 14:04:24', NULL),
(4, 9, 2100, 'cash', 'credit', '2024/02/S-0004', NULL, '2024-02-10 14:05:40', '2024-02-10 14:05:40', '2024-02-10 14:05:40', NULL),
(5, 10, 1625, 'cash', 'credit', '2024/02/S-0005', NULL, '2024-02-10 15:17:17', '2024-02-10 15:17:17', '2024-02-10 15:17:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `type`, `name`) VALUES
(1, 'admin', 'access'),
(2, 'admins', 'manage'),
(3, 'admins', 'create'),
(4, 'category', 'create'),
(5, 'category', 'manage'),
(6, 'product', 'create'),
(7, 'product', 'manage'),
(8, 'product', 'view'),
(9, 'customer', 'create'),
(10, 'customer', 'manage'),
(11, 'customer', 'view'),
(12, 'supplier', 'create'),
(13, 'supplier', 'manage'),
(14, 'supplier', 'view'),
(15, 'user', 'create'),
(16, 'user', 'manage'),
(17, 'sell', 'create'),
(18, 'sell', 'manage'),
(19, 'return', 'create'),
(20, 'purchase', 'create'),
(21, 'purchase', 'manage'),
(22, 'transaction', 'view'),
(23, 'expense', 'create'),
(24, 'expense', 'manage'),
(25, 'settings', 'manage'),
(26, 'acl', 'manage'),
(27, 'acl', 'set'),
(28, 'tax', 'actions'),
(29, 'branch', 'create'),
(30, 'report', 'view'),
(31, 'profit', 'view'),
(32, 'cash', 'view'),
(33, 'profit', 'graph'),
(34, 'tasa', 'actions');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `quantity` double DEFAULT NULL,
  `details` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost_price` double NOT NULL,
  `mrp` double NOT NULL,
  `tax_id` int(11) DEFAULT NULL,
  `minimum_retail_price` double DEFAULT NULL,
  `unit` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opening_stock` double DEFAULT NULL,
  `alert_quantity` int(11) DEFAULT NULL,
  `porcent` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `code`, `category_id`, `subcategory_id`, `quantity`, `details`, `cost_price`, `mrp`, `tax_id`, `minimum_retail_price`, `unit`, `status`, `image`, `opening_stock`, `alert_quantity`, `porcent`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Pantalon', 'TE1800', 1, NULL, 119, NULL, 5, 10, NULL, NULL, 'Und', 1, NULL, 1000, 10, NULL, '2024-01-11 17:36:31', '2024-02-10 15:17:17', NULL),
(3, 'Camisa', 'EE1367', 1, NULL, 750, NULL, 2, 2.5, NULL, NULL, 'Und', 1, NULL, 1000, 5, NULL, '2024-01-29 15:10:11', '2024-02-10 15:17:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` int(10) UNSIGNED NOT NULL,
  `reference_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL DEFAULT 1,
  `quantity` double NOT NULL,
  `sub_total` double NOT NULL,
  `product_tax` double DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quotationds`
--

CREATE TABLE `quotationds` (
  `id` int(10) UNSIGNED NOT NULL,
  `quotation_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `subtotal` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quotations`
--

CREATE TABLE `quotations` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `return_transactions`
--

CREATE TABLE `return_transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `sells_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `return_vat` double(8,2) NOT NULL,
  `sells_reference_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `return_units` int(11) NOT NULL,
  `return_amount` double NOT NULL,
  `returned_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Super User'),
(2, 'Owner'),
(3, 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `role_permission`
--

CREATE TABLE `role_permission` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_permission`
--

INSERT INTO `role_permission` (`role_id`, `permission_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(3, 8),
(3, 9),
(3, 11),
(3, 12),
(3, 14),
(3, 17),
(3, 19),
(4, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(1, 24),
(1, 25),
(1, 26),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(1, 32),
(1, 33),
(1, 34),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 8),
(2, 9),
(2, 10),
(2, 11),
(2, 12),
(2, 13),
(2, 14),
(2, 15),
(2, 16),
(2, 17),
(2, 18),
(2, 19),
(2, 20),
(2, 21),
(2, 22),
(2, 23),
(2, 24),
(2, 25),
(2, 26),
(2, 27),
(2, 28),
(2, 29),
(2, 30),
(2, 31),
(2, 32),
(2, 33),
(2, 34),
(4, 8),
(4, 9),
(4, 11),
(4, 12),
(4, 14),
(4, 19),
(5, 6),
(5, 7),
(5, 8),
(5, 9),
(5, 10),
(5, 11),
(5, 12),
(5, 13),
(5, 14),
(5, 17),
(5, 19),
(5, 20),
(5, 22),
(5, 30),
(5, 32),
(5, 34);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 4),
(3, 1),
(4, 1),
(5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `sells`
--

CREATE TABLE `sells` (
  `id` int(10) UNSIGNED NOT NULL,
  `reference_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL DEFAULT 1,
  `quantity` double NOT NULL,
  `unit_cost_price` double DEFAULT NULL,
  `sub_total` double NOT NULL,
  `product_tax` double DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sells`
--

INSERT INTO `sells` (`id`, `reference_no`, `client_id`, `product_id`, `warehouse_id`, `quantity`, `unit_cost_price`, `sub_total`, `product_tax`, `date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2024/02/S-0001', 1, 3, 1, 100, 2, 250, NULL, '2024-02-10 13:58:00', '2024-02-10 13:58:00', '2024-02-10 13:58:00', NULL),
(2, '2024/02/S-0002', 1, 2, 1, 150, 5, 1500, NULL, '2024-02-10 13:58:24', '2024-02-10 13:58:24', '2024-02-10 13:58:24', NULL),
(3, '2024/02/S-0003', 8, 2, 1, 200, 5, 2000, NULL, '2024-02-10 14:04:24', '2024-02-10 14:04:24', '2024-02-10 14:04:24', NULL),
(4, '2024/02/S-0004', 9, 2, 1, 210, 5, 2100, NULL, '2024-02-10 14:05:40', '2024-02-10 14:05:40', '2024-02-10 14:05:40', NULL),
(5, '2024/02/S-0005', 10, 2, 1, 100, 5, 1000, NULL, '2024-02-10 15:17:17', '2024-02-10 15:17:17', '2024-02-10 15:17:17', NULL),
(6, '2024/02/S-0005', 10, 3, 1, 250, 2, 625, NULL, '2024-02-10 15:17:17', '2024-02-10 15:17:17', '2024-02-10 15:17:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `site_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slogan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `owner_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_logo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_tax` tinyint(1) NOT NULL DEFAULT 0,
  `invoice_tax` tinyint(1) NOT NULL DEFAULT 0,
  `invoice_tax_rate` double NOT NULL DEFAULT 0,
  `theme` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'bg-gradient-9',
  `enable_purchaser` tinyint(1) NOT NULL DEFAULT 1,
  `enable_customer` tinyint(1) NOT NULL DEFAULT 1,
  `invoice_tax_type` int(11) NOT NULL DEFAULT 2,
  `vat_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pos_invoice_footer_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dashboard` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'chart-box',
  `currency_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_name`, `slogan`, `address`, `email`, `phone`, `owner_name`, `site_logo`, `product_tax`, `invoice_tax`, `invoice_tax_rate`, `theme`, `enable_purchaser`, `enable_customer`, `invoice_tax_type`, `vat_no`, `pos_invoice_footer_text`, `dashboard`, `currency_code`, `created_at`, `updated_at`) VALUES
(1, 'SIER Online', NULL, 'ZONA INDUSTRIAL MATURÍN', 'SIERONLINE@GMAIL.COM', '0412-1016309', 'ADMINISTRADOR', 'XxI5iCImd9S4.png', 0, 1, 0, 'bg-gradient-9', 1, 1, 1, NULL, 'Regrese Pronto', 'chart-box', 'USD', '2020-06-24 08:08:50', '2024-02-07 03:31:08');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tasas`
--

CREATE TABLE `tasas` (
  `id` int(10) UNSIGNED NOT NULL,
  `tasa` decimal(20,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasas`
--

INSERT INTO `tasas` (`id`, `tasa`, `created_at`, `updated_at`) VALUES
(2, '36.00', '2020-06-29 04:31:28', '2024-01-29 15:10:55');

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` double NOT NULL,
  `type` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taxes`
--

INSERT INTO `taxes` (`id`, `name`, `rate`, `type`, `created_at`, `updated_at`) VALUES
(1, 'No Tax', 0, 1, '2020-06-29 04:31:27', '2020-06-29 04:31:27'),
(2, 'IVA', 16, 1, '2020-11-10 03:29:28', '2020-11-10 03:29:28');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `reference_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `transaction_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `warehouse_id` int(11) NOT NULL DEFAULT 1,
  `total_cost_price` double DEFAULT NULL,
  `discount` double NOT NULL DEFAULT 0,
  `total` double NOT NULL,
  `invoice_tax` double DEFAULT NULL,
  `total_tax` double DEFAULT NULL,
  `labor_cost` double NOT NULL DEFAULT 0,
  `net_total` double DEFAULT NULL,
  `paid` double NOT NULL,
  `change_amount` double(8,2) DEFAULT NULL,
  `return` tinyint(1) NOT NULL DEFAULT 0,
  `return_invoice` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `return_balance` double DEFAULT NULL,
  `pos` tinyint(1) NOT NULL DEFAULT 0,
  `date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `reference_no`, `client_id`, `user_id`, `transaction_type`, `warehouse_id`, `total_cost_price`, `discount`, `total`, `invoice_tax`, `total_tax`, `labor_cost`, `net_total`, `paid`, `change_amount`, `return`, `return_invoice`, `return_balance`, `pos`, `date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2024/02/S-0001', 1, 1, 'sell', 1, 200, 0, 250, 0, 0, 0, 250, 250, 0.00, 0, NULL, NULL, 1, '2024-02-10 13:58:00', '2024-02-10 13:58:00', '2024-02-10 13:58:00', NULL),
(2, '2024/02/S-0002', 1, 1, 'sell', 1, 750, 0, 1500, 0, 0, 0, 1500, 1500, 0.00, 0, NULL, NULL, 1, '2024-02-10 13:58:24', '2024-02-10 13:58:24', '2024-02-10 13:58:24', NULL),
(3, '2024/02/S-0003', 8, 1, 'sell', 1, 1000, 0, 2000, 0, 0, 0, 2000, 2000, 0.00, 0, NULL, NULL, 1, '2024-02-10 14:04:24', '2024-02-10 14:04:24', '2024-02-10 14:04:24', NULL),
(4, '2024/02/S-0004', 9, 1, 'sell', 1, 1050, 0, 2100, 0, 0, 0, 2100, 2100, 0.00, 0, NULL, NULL, 1, '2024-02-10 14:05:40', '2024-02-10 14:05:40', '2024-02-10 14:05:40', NULL),
(5, '2024/02/S-0005', 10, 1, 'sell', 1, 1000, 0, 1625, 0, 0, 0, 1625, 1625, 0.00, 0, NULL, NULL, 1, '2024-02-10 15:17:17', '2024-02-10 15:17:17', '2024-02-10 15:17:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `warehouse_id` int(11) NOT NULL DEFAULT 1,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `warehouse_id`, `address`, `phone`, `image`, `inactive`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Administrador', 'Admin', 'admin@admin.com', '$2y$10$OWYwLq2LJL/ZjTuCeAU7eONKAf2XUg2kNgNnBCcqqeiNlLl22SMLW', 1, NULL, NULL, NULL, 0, 'op6Zb6qcQUU06RWTdHxJ8yyaGuoDJmZpagJx7T6ATJforseSyIEwyeScCgEZ', '2022-03-30 01:07:16', '2023-06-13 13:33:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `in_charge_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`id`, `name`, `address`, `phone`, `email`, `in_charge_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Tienda Principal', '', '', '', '', '2020-06-29 04:31:27', '2020-06-29 04:31:27', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cash_registers`
--
ALTER TABLE `cash_registers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `damages`
--
ALTER TABLE `damages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_categories`
--
ALTER TABLE `expense_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordercds`
--
ALTER TABLE `ordercds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ordercds_orderc_id_foreign` (`orderc_id`),
  ADD KEY `ordercds_product_id_foreign` (`product_id`);

--
-- Indexes for table `ordercs`
--
ALTER TABLE `ordercs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotationds`
--
ALTER TABLE `quotationds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quotationds_quotation_id_foreign` (`quotation_id`),
  ADD KEY `quotationds_product_id_foreign` (`product_id`);

--
-- Indexes for table `quotations`
--
ALTER TABLE `quotations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `return_transactions`
--
ALTER TABLE `return_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sells`
--
ALTER TABLE `sells`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasas`
--
ALTER TABLE `tasas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cash_registers`
--
ALTER TABLE `cash_registers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `damages`
--
ALTER TABLE `damages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `expense_categories`
--
ALTER TABLE `expense_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT for table `ordercds`
--
ALTER TABLE `ordercds`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ordercs`
--
ALTER TABLE `ordercs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotationds`
--
ALTER TABLE `quotationds`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotations`
--
ALTER TABLE `quotations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `return_transactions`
--
ALTER TABLE `return_transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sells`
--
ALTER TABLE `sells`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tasas`
--
ALTER TABLE `tasas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ordercds`
--
ALTER TABLE `ordercds`
  ADD CONSTRAINT `ordercds_orderc_id_foreign` FOREIGN KEY (`orderc_id`) REFERENCES `ordercs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ordercds_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `quotationds`
--
ALTER TABLE `quotationds`
  ADD CONSTRAINT `quotationds_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `quotationds_quotation_id_foreign` FOREIGN KEY (`quotation_id`) REFERENCES `quotations` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
