-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2025 at 02:44 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `service_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_name` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `admin_email` varchar(250) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_name`, `username`, `admin_email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', 'admin@gmail.com', '$2y$10$U0B944iXdHMsxKiM6jZLEeW9cNGgUD0xz2tps6dp8gpRhmIThLye6', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `availability`
--

CREATE TABLE `availability` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider` int(11) NOT NULL,
  `day` varchar(255) NOT NULL,
  `from_time` varchar(255) NOT NULL,
  `to_time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `availability`
--

INSERT INTO `availability` (`id`, `provider`, `day`, `from_time`, `to_time`) VALUES
(20, 2, '1', '08:00', '17:00'),
(21, 2, '2', '08:00', '17:00'),
(22, 2, '3', '08:00', '17:00'),
(23, 2, '4', '08:00', '17:00'),
(24, 2, '5', '08:00', '17:00'),
(25, 2, '6', '08:00', '17:00'),
(26, 2, '7', '08:00', '17:00');

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text NOT NULL,
  `sub_title` text NOT NULL,
  `banner_image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `title`, `sub_title`, `banner_image`, `created_at`, `updated_at`) VALUES
(1, 'All-in-One Solution for Services Booking', 'Efficient, Reliable, and Tailored to Your Business Needs. Simplify Your Operations and Elevate Your Service Standards', '1524972475pexels-wildlittlethingsphoto-933964.jpg', '2025-10-06 08:14:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service` varchar(255) NOT NULL,
  `user` int(11) NOT NULL,
  `provider` int(11) NOT NULL,
  `location` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT '0',
  `user_status` varchar(255) DEFAULT '0',
  `provider_status` varchar(255) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `service`, `user`, `provider`, `location`, `date`, `status`, `user_status`, `provider_status`, `created_at`, `updated_at`) VALUES
(1, '2', 1, 2, 1, '2025-10-15', '1', '1', '0', '2025-10-05 17:24:13', '2025-10-05 17:24:55'),
(2, '5', 1, 2, 1, '2025-10-28', '1', '1', '0', '2025-10-06 01:52:10', '2025-10-06 01:53:02'),
(3, '6', 1, 2, 1, '2025-10-21', '0', '0', '0', '2025-10-07 03:05:21', '2025-10-07 03:05:21');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `category_name`, `category_slug`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Home Services', 'home-services', 'istockphoto-1361116682-612x612.jpg', 1, '2025-10-05 03:21:32', '2025-10-06 15:30:50'),
(2, 'Electrical', 'electrical', 'pexels-kelly-1179532-2898199.jpg', 1, '2025-10-05 03:22:00', '2025-10-06 15:25:14'),
(3, 'Beauty & Fashion', 'beauty-and-fashion', 'pexels-pixabay-458766.jpg', 1, '2025-10-05 16:08:18', '2025-10-06 17:47:50'),
(4, 'Pet Services', 'pet-services', 'pexels-goochie-poochie-19145898.png', 1, '2025-10-06 15:28:50', '2025-10-06 16:35:05'),
(5, 'Fitness and Training', 'fitness-and-training', 'pexels-olly-863926.jpg', 1, '2025-10-06 15:31:53', '2025-10-06 15:31:53'),
(6, 'Educational', 'educational', 'pexels-ekaterina-bolovtsova-4049793.jpg', 1, '2025-10-06 18:42:40', '2025-10-06 18:42:40');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `city_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`city_id`, `city_name`, `created_at`, `updated_at`) VALUES
(1, 'Multan', '2025-10-06 09:32:04', '2025-10-06 09:32:04'),
(2, 'Lahore', '2025-10-06 09:32:04', '2025-10-06 09:32:04'),
(3, 'Islamabad', '2025-10-06 09:32:04', '2025-10-06 09:32:04'),
(4, 'Rawalpindi', '2025-10-06 09:32:04', '2025-10-06 09:32:04'),
(5, 'Faisalabad', '2025-10-06 09:32:04', '2025-10-06 09:32:04'),
(6, 'Peshawar', '2025-10-06 09:32:04', '2025-10-06 09:32:04'),
(7, 'Quetta', '2025-10-06 09:32:04', '2025-10-06 09:32:04'),
(8, 'Karachi', '2025-10-06 09:32:04', '2025-10-06 09:32:04'),
(9, 'Sialkot', '2025-10-06 09:32:04', '2025-10-06 09:32:04'),
(10, 'Gujranwala', '2025-10-06 09:32:04', '2025-10-06 09:32:04'),
(11, 'Hyderabad', '2025-10-06 09:32:04', '2025-10-06 09:32:04'),
(12, 'Sargodha', '2025-10-06 09:32:04', '2025-10-06 09:32:04'),
(13, 'Bahawalpur', '2025-10-06 09:32:04', '2025-10-06 09:32:04'),
(14, 'Sukkur', '2025-10-06 09:32:04', '2025-10-06 09:32:04'),
(15, 'Larkana', '2025-10-06 09:32:04', '2025-10-06 09:32:04'),
(16, 'Sheikhupura', '2025-10-06 09:32:04', '2025-10-06 09:32:04'),
(17, 'Mardan', '2025-10-06 09:32:04', '2025-10-06 09:32:04'),
(18, 'Kasur', '2025-10-06 09:32:04', '2025-10-06 09:32:04'),
(19, 'Rahim Yar Khan', '2025-10-06 09:32:04', '2025-10-06 09:32:04'),
(20, 'Sahiwal', '2025-10-06 09:32:04', '2025-10-06 09:32:04');

-- --------------------------------------------------------

--
-- Table structure for table `commission`
--

CREATE TABLE `commission` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `commission`
--

INSERT INTO `commission` (`id`, `type`, `value`, `status`) VALUES
(1, 'percentage', '10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `com_name` varchar(255) NOT NULL,
  `com_logo` varchar(255) DEFAULT NULL,
  `com_email` varchar(255) NOT NULL,
  `com_phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `copyright_text` varchar(255) NOT NULL,
  `cur_format` varchar(255) NOT NULL,
  `auto_approve_service` tinyint(4) NOT NULL DEFAULT 1,
  `min_add_amount` int(11) NOT NULL DEFAULT 10,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `com_name`, `com_logo`, `com_email`, `com_phone`, `address`, `description`, `copyright_text`, `cur_format`, `auto_approve_service`, `min_add_amount`, `created_at`, `updated_at`) VALUES
(1, 'Service Booking', NULL, 'contact@example.com', '03052221517', 'Gulgasht Colony, Multan', 'Efficient service management system for booking and managing various services such as beauty, health, fitness, home, and pet care. Streamline your appointments, manage client data, and enhance customer satisfaction with our user-friendly platform.', 'Copyright © 2025 | Service Booking', 'Rs. ', 1, 10, NULL, NULL);

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
(1, '0001_01_01_000001_admin', 1),
(2, '0001_01_01_000002_banner', 1),
(3, '0001_01_01_000003_general_settings', 1),
(4, '0001_01_01_000004_social-setting', 1),
(5, '0001_01_01_000005_categories', 1),
(6, '0001_01_01_000006_pages', 1),
(7, '0001_01_01_000007_users', 1),
(8, '0001_01_01_000008_user_contact', 1),
(9, '0001_01_01_000009_services', 1),
(10, '0001_01_01_000010_cities', 1),
(11, '0001_01_01_000011_bookings', 1),
(12, '0001_01_01_000012_commission', 1),
(13, '0001_01_01_000013_payout_settings', 1),
(14, '0001_01_01_000014_payout_request', 1),
(15, '0001_01_01_000015_wallet_transactions', 1),
(16, '0001_01_01_000016_user_wallet', 1),
(17, '0001_01_01_000017_payment_methods', 1),
(18, '0001_01_01_000018_availability', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `page_slug` varchar(255) NOT NULL,
  `page_content` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`page_id`, `page_title`, `page_slug`, `page_content`, `status`, `created_at`, `updated_at`) VALUES
(3, 'About Us', 'about-us', '&lt;p&gt;&lt;/p&gt;&lt;h2&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;Welcome to &lt;/span&gt;&lt;strong style=&quot;font-size: 1rem;&quot;&gt;Service Booking&lt;/strong&gt;&lt;span style=&quot;font-size: 1rem;&quot;&gt;, your all-in-one solution for managing and booking services with ease and efficiency. We’re here to simplify how businesses and clients connect — whether it’s for beauty, health, fitness, home maintenance, or pet care services.&lt;/span&gt;&lt;/h2&gt;&lt;p&gt;Our platform is designed to help you &lt;strong&gt;streamline appointments&lt;/strong&gt;, &lt;strong&gt;organize client information&lt;/strong&gt;, and &lt;strong&gt;deliver exceptional experiences&lt;/strong&gt; every time. With an intuitive interface and powerful tools, managing daily operations becomes faster, smarter, and stress-free.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;h3&gt;&lt;strong&gt;Our Mission&lt;/strong&gt;&lt;/h3&gt;&lt;p&gt;Our mission is to &lt;strong&gt;empower service providers and customers&lt;/strong&gt; through technology. We believe booking and managing services should be as simple as a few clicks — saving time, reducing effort, and improving satisfaction for both businesses and their clients.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;h3&gt;&lt;strong&gt;What We Offer&lt;/strong&gt;&lt;/h3&gt;&lt;ul&gt;\r\n&lt;li&gt;\r\n&lt;p&gt;&lt;strong&gt;Smart Scheduling:&lt;/strong&gt; Easily create, view, and manage appointments in real time.&lt;/p&gt;\r\n&lt;/li&gt;\r\n&lt;li&gt;\r\n&lt;p&gt;&lt;strong&gt;Client Management:&lt;/strong&gt; Keep track of customer details, service history, and preferences.&lt;/p&gt;\r\n&lt;/li&gt;\r\n&lt;li&gt;\r\n&lt;p&gt;&lt;strong&gt;Multi-Category Support:&lt;/strong&gt; From beauty salons to home repair — all services, one platform.&lt;/p&gt;\r\n&lt;/li&gt;\r\n&lt;li&gt;\r\n&lt;p&gt;&lt;strong&gt;Seamless Experience:&lt;/strong&gt; Built with modern technology for speed, security, and reliability.&lt;/p&gt;&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;&lt;/p&gt;&lt;ul&gt;&lt;/ul&gt;&lt;p&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;ul&gt;\r\n&lt;/ul&gt;&lt;h3&gt;&lt;strong&gt;Why Choose Us&lt;/strong&gt;&lt;/h3&gt;&lt;p&gt;We’re passionate about building a system that helps businesses grow while keeping customers happy. Our user-friendly design ensures that both professionals and clients can manage bookings without hassle — anytime, anywhere.&lt;/p&gt;', 1, '2025-10-06 08:56:31', '2025-10-06 08:58:13');

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`, `status`) VALUES
(1, 'Paypal', 1),
(2, 'Razorpay', 0);

-- --------------------------------------------------------

--
-- Table structure for table `payout_request`
--

CREATE TABLE `payout_request` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user` int(11) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `completed_on` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payout_request`
--

INSERT INTO `payout_request` (`id`, `user`, `amount`, `status`, `completed_on`, `created_at`, `updated_at`) VALUES
(1, 2, '100', 1, '2025-10-06', '2025-10-06 10:06:11', '2025-10-06 10:07:04'),
(2, 2, '400', 0, NULL, '2025-10-06 10:07:47', '2025-10-06 10:07:47');

-- --------------------------------------------------------

--
-- Table structure for table `payout_settings`
--

CREATE TABLE `payout_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user` int(11) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `account_no` varchar(255) NOT NULL,
  `iban` varchar(255) NOT NULL,
  `bank_address` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payout_settings`
--

INSERT INTO `payout_settings` (`id`, `user`, `bank_name`, `account_no`, `iban`, `bank_address`, `created_at`, `updated_at`) VALUES
(1, 2, 'United Bank Limited (UBL)', '00123456789012', 'PK84UNIL0109001234567890', 'Buch Villas', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `service_slug` varchar(255) NOT NULL,
  `service_description` text NOT NULL,
  `service_images` text DEFAULT NULL,
  `service_amount` varchar(255) NOT NULL,
  `service_start_time` time DEFAULT NULL,
  `service_end_time` time DEFAULT NULL,
  `category` varchar(255) NOT NULL,
  `location` int(11) NOT NULL,
  `provider` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `approved` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `service_name`, `service_slug`, `service_description`, `service_images`, `service_amount`, `service_start_time`, `service_end_time`, `category`, `location`, `provider`, `status`, `approved`, `created_at`, `updated_at`) VALUES
(1, 'Haircut', 'haircut', '&lt;p&gt;Our haircut service is designed to provide you with a personalized and professional haircut experience that enhances your style and suits your unique preferences. Whether you&#039;re looking for a simple trim, a bold new look, or something in between, our experienced hairstylists will work with you to create the perfect hairstyle that complements your features and fits your lifestyle.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;What&#039;s Included:&lt;/strong&gt;&lt;/p&gt;&lt;ul&gt;&lt;li&gt;&lt;strong&gt;Consultation:&lt;/strong&gt; A thorough consultation to discuss your haircut goals, preferences, and any specific needs you may have.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Customized Cut:&lt;/strong&gt; A precision haircut tailored to your hair type, texture, and face shape, ensuring a flattering and stylish result.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Shampoo and Conditioning:&lt;/strong&gt; A relaxing shampoo and conditioning treatment to cleanse and nourish your hair.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Styling:&lt;/strong&gt; Professional styling to finish your haircut and ensure your hair looks its best.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Finishing Touches:&lt;/strong&gt; Final touches and adjustments to ensure your haircut is perfect before you leave the salon.&lt;/li&gt;&lt;li&gt;&lt;br&gt;&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;&lt;strong&gt;Duration:&lt;/strong&gt;\r\nThe duration of the haircut service can vary depending on the complexity of the style and your hair&#039;s length and texture. Typically, a haircut appointment lasts between 30 minutes to an hour.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;Price:&lt;/strong&gt; Starting from PKR 800&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;Why Choose Us:&lt;/strong&gt;&lt;/p&gt;&lt;ul&gt;&lt;li&gt;&lt;strong&gt;Experienced Hairstylists:&lt;/strong&gt; Our team consists of skilled and experienced hairstylists who stay updated with the latest trends and techniques.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Quality Products:&lt;/strong&gt; We use high-quality hair care products to ensure the health and vitality of your hair.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Attention to Detail:&lt;/strong&gt; We pay close attention to detail to ensure that every aspect of your haircut meets your expectations.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Customer Satisfaction:&lt;/strong&gt; Your satisfaction is our top priority, and we strive to exceed your expectations with every haircut.&lt;/li&gt;&lt;li&gt;&lt;br&gt;&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;Book your haircut appointment with us today and enjoy a refreshing and stylish new look!&lt;/p&gt;', '17182764611.jpg,17182764614.jpg', '800', '09:00:00', '20:00:00', '3', 2, 2, 1, 1, '2025-10-05 16:10:17', '2025-10-07 05:46:05'),
(2, 'Cleaning', 'cleaning', '&lt;p&gt;Our professional house cleaning service is designed to keep your home sparkling clean and fresh. Whether you need a one-time deep clean or regular maintenance, our skilled and trustworthy cleaners will handle all your cleaning needs with utmost care and attention to detail. We use eco-friendly products to ensure a safe environment for you and your family.&lt;/p&gt;\r\n    &lt;p&gt;&lt;br&gt;&lt;/p&gt;\r\n    &lt;p&gt;&lt;span style=&quot;font-weight: bolder;&quot;&gt;What&#039;s Included:-&lt;/span&gt;&lt;/p&gt;\r\n    &lt;p&gt;&lt;span style=&quot;font-weight: bolder;&quot;&gt;Dusting:&lt;/span&gt;&amp;nbsp;Comprehensive dusting of all surfaces, including furniture, shelves, and decorations.&lt;/p&gt;\r\n    &lt;p&gt;&lt;span style=&quot;font-weight: bolder;&quot;&gt;Vacuuming:&lt;/span&gt;&amp;nbsp;Thorough vacuuming of carpets, rugs, and upholstery.&lt;/p&gt;\r\n    &lt;p&gt;&lt;span style=&quot;font-weight: bolder;&quot;&gt;Mopping:&lt;/span&gt;&amp;nbsp;Mopping of all hard floors to remove dirt and stains.&lt;/p&gt;\r\n    &lt;p&gt;&lt;span style=&quot;font-weight: bolder;&quot;&gt;Kitchen Cleaning:&lt;/span&gt;&amp;nbsp;Wiping down countertops, cleaning appliances, and sanitizing sinks.&lt;/p&gt;\r\n    &lt;p&gt;&lt;span style=&quot;font-weight: bolder;&quot;&gt;Bathroom Cleaning:&lt;/span&gt;&amp;nbsp;Scrubbing toilets, sinks, showers, and bathtubs, along with mirror cleaning.&lt;/p&gt;\r\n    &lt;p&gt;&lt;span style=&quot;font-weight: bolder;&quot;&gt;Trash Removal:&lt;/span&gt;&amp;nbsp;Emptying of all trash bins and disposal of garbage.&lt;/p&gt;\r\n    &lt;p&gt;&lt;span style=&quot;font-weight: bolder;&quot;&gt;Additional Services:&lt;/span&gt;&amp;nbsp;Available upon request, such as window cleaning, oven cleaning, and fridge cleaning.&lt;/p&gt;\r\n    &lt;p&gt;&lt;br&gt;&lt;/p&gt;\r\n    &lt;p&gt;&lt;span style=&quot;font-weight: bolder;&quot;&gt;Duration:&lt;/span&gt;&lt;/p&gt;\r\n    &lt;p&gt;Our standard house cleaning service typically takes around 120 minutes, but the exact time may vary depending on the size and condition of your home.&lt;/p&gt;\r\n    &lt;p&gt;&lt;br&gt;&lt;/p&gt;\r\n    &lt;p&gt;&lt;span style=&quot;font-weight: bolder;&quot;&gt;Price:&lt;/span&gt;&amp;nbsp;Rs. 5000 per session&lt;/p&gt;\r\n    &lt;p&gt;&lt;br&gt;&lt;/p&gt;\r\n    &lt;p&gt;&lt;span style=&quot;font-weight: bolder;&quot;&gt;Why Choose Us:&lt;/span&gt;&lt;/p&gt;\r\n    &lt;p&gt;&lt;br&gt;&lt;/p&gt;\r\n    &lt;p&gt;&lt;span style=&quot;font-weight: bolder;&quot;&gt;Experienced Cleaners:&lt;/span&gt;&amp;nbsp;Our team consists of trained professionals with extensive cleaning experience.&lt;/p&gt;\r\n    &lt;p&gt;&lt;span style=&quot;font-weight: bolder;&quot;&gt;Customized Cleaning Plans:&lt;/span&gt;&amp;nbsp;We tailor our services to meet your specific needs and preferences.&lt;/p&gt;\r\n    &lt;p&gt;&lt;span style=&quot;font-weight: bolder;&quot;&gt;Reliable and Trustworthy:&lt;/span&gt;&amp;nbsp;We ensure punctuality, respect for your property, and confidentiality.&lt;/p&gt;\r\n    &lt;p&gt;&lt;span style=&quot;font-weight: bolder;&quot;&gt;Satisfaction Guaranteed:&lt;/span&gt;&amp;nbsp;If you&#039;re not completely satisfied, we&#039;ll make it right.&lt;/p&gt;\r\n    &lt;p&gt;&lt;br&gt;&lt;/p&gt;\r\n    &lt;p&gt;Book your house cleaning service today and enjoy a pristine home without the&amp;nbsp;&lt;/p&gt;', '171826813311.jpg', '5000', '07:00:00', '15:00:00', '1', 1, 2, 1, 1, '2025-10-05 16:35:32', '2025-10-06 16:29:12'),
(3, 'Dog Grooming', 'dog-grooming', '&lt;p&gt;Dog grooming service is dedicated to keeping your furry friend looking and feeling their best. We provide a range of grooming options tailored to meet the specific needs of your dog, ensuring a safe, comfortable, and enjoyable experience for them.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;What&#039;s Included:&lt;/strong&gt;&lt;/p&gt;&lt;ul&gt;&lt;li&gt;&lt;strong&gt;Bathing:&lt;/strong&gt; Thorough bathing with high-quality, dog-safe shampoos and conditioners to clean and refresh your dog&#039;s coat.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Haircut and Styling:&lt;/strong&gt; Customized haircuts and styling to match your dog&#039;s breed and your preferences.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Brushing:&lt;/strong&gt; Comprehensive brushing to remove tangles, mats, and loose fur, leaving your dog&#039;s coat smooth and shiny.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Nail Trimming:&lt;/strong&gt; Safe and precise nail trimming to maintain proper paw health and comfort.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Ear Cleaning:&lt;/strong&gt; Gentle cleaning of ears to prevent infections and remove debris.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Teeth Brushing:&lt;/strong&gt; Optional teeth brushing to promote good oral hygiene and fresh breath.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Additional Services:&lt;/strong&gt; Available upon request, such as de-shedding treatments, flea treatments, and specialized care for puppies or senior dogs.&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;&lt;strong&gt;Duration:&lt;/strong&gt;\r\nOur dog grooming service typically takes around 90 minutes, but the exact time may vary depending on the size, breed, and condition of your dog.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;b&gt;Price&lt;/b&gt;&lt;strong&gt;:&lt;/strong&gt;&amp;nbsp;Rs. 1000 per session&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;Why Choose Us:&lt;/strong&gt;&lt;/p&gt;&lt;ul&gt;&lt;li&gt;&lt;strong&gt;Experienced Groomers:&lt;/strong&gt; Our team consists of skilled and caring groomers with extensive experience in handling dogs of all breeds and temperaments.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Comfort and Safety:&lt;/strong&gt; We prioritize your dog&#039;s comfort and safety, using gentle techniques and high-quality products.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Customized Care:&lt;/strong&gt; We tailor our grooming services to meet the unique needs of each dog, ensuring a personalized experience.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Convenient Scheduling:&lt;/strong&gt; Flexible booking options to fit your busy schedule.&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;Book your dog&#039;s grooming session today and give them the pampering they deserve!&lt;/p&gt;', '171827093050.jpg,171827093014.jpg,171827136156.jpg,171827136121.jpg', '1000', '08:00:00', '19:00:00', '4', 1, 2, 1, 1, '2025-10-06 16:06:10', '2025-10-06 16:36:01'),
(4, 'Pet Training', 'pet-training', '&lt;p&gt;Our professional pet training service is dedicated to helping your pets learn essential skills and behaviors to ensure a harmonious and happy relationship between you and your furry companions. Whether you have a new puppy, an adult dog, or any other pet in need of training, our experienced trainers use positive reinforcement techniques to achieve the best results.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;What&#039;s Included:&lt;/strong&gt;&lt;/p&gt;&lt;ul&gt;&lt;li&gt;&lt;strong&gt;Basic Obedience Training:&lt;/strong&gt; Teaching fundamental commands such as sit, stay, come, heel, and down.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Behavioral Training:&lt;/strong&gt; Addressing and correcting common behavioral issues like jumping, barking, chewing, and digging.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Puppy Training:&lt;/strong&gt; Specialized training programs for puppies, including housebreaking, socialization, and basic commands.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Advanced Training:&lt;/strong&gt; Advanced obedience and trick training for pets who have mastered the basics and are ready for more.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Agility Training:&lt;/strong&gt; Fun and engaging agility courses to improve your pet’s physical fitness, coordination, and confidence.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Socialization Classes:&lt;/strong&gt; Helping pets develop positive interactions with other animals and people to reduce anxiety and aggression.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Leash Training:&lt;/strong&gt; Teaching pets to walk calmly on a leash without pulling or lunging.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Customized Training Plans:&lt;/strong&gt; Personalized training programs tailored to meet the specific needs and goals of you and your pet.&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;&lt;strong&gt;Duration:&lt;/strong&gt;\r\nTraining sessions are available in various formats, including one-on-one sessions, group classes, and intensive training camps. Session lengths and total program duration can be customized based on your pet&#039;s progress and specific needs.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;Price:&lt;/strong&gt; Starting at $50 per session&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;Why Choose Us:&lt;/strong&gt;&lt;/p&gt;&lt;ul&gt;&lt;li&gt;&lt;strong&gt;Experienced Trainers:&lt;/strong&gt; Our team consists of certified and experienced trainers with a deep understanding of animal behavior.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Positive Reinforcement:&lt;/strong&gt; We use humane, reward-based training methods to ensure a positive and enjoyable learning experience for your pets.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Flexible Scheduling:&lt;/strong&gt; Convenient scheduling options to fit your busy lifestyle.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Ongoing Support:&lt;/strong&gt; Continuous support and guidance even after the training program is complete to ensure lasting results.&lt;/li&gt;&lt;li&gt;&lt;br&gt;&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;Book our pet training service today and take the first step towards a well-behaved and happy pet!&lt;/p&gt;', '171827175998.jpg', '3000', '05:00:00', '15:00:00', '4', 2, 2, 1, 1, '2025-10-06 16:42:39', '2025-10-06 16:42:39'),
(5, 'Facial', 'facial', '&lt;p&gt;Indulge in a luxurious facial treatment designed to rejuvenate your skin and leave you feeling refreshed and radiant. Our facial service is tailored to address your specific skin concerns and goals, whether you&#039;re looking to improve skin texture, reduce signs of aging, or simply relax and unwind. Using premium skincare products and techniques, our skilled estheticians will pamper your skin and provide you with a revitalizing experience.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;What&#039;s Included:&lt;/strong&gt;&lt;/p&gt;&lt;ul&gt;&lt;li&gt;&lt;strong&gt;Skin Analysis:&lt;/strong&gt; A thorough analysis of your skin to determine its type, condition, and specific needs.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Cleansing:&lt;/strong&gt; Gentle cleansing to remove impurities, makeup, and excess oil from your skin&#039;s surface.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Exfoliation:&lt;/strong&gt; Exfoliation to slough off dead skin cells and reveal smoother, brighter skin underneath.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Extraction:&lt;/strong&gt; Optional extraction of blackheads and whiteheads to unclog pores and improve skin clarity.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Facial Massage:&lt;/strong&gt; Relaxing facial massage to improve circulation and promote lymphatic drainage, reducing puffiness and enhancing skin tone.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Mask:&lt;/strong&gt; Application of a customized mask to address your skin concerns, such as hydration, firming, or brightening.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Moisturization:&lt;/strong&gt; Hydrating moisturizer to nourish and protect your skin, leaving it soft and supple.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Sunscreen:&lt;/strong&gt; Application of sunscreen to protect your skin from harmful UV rays and prevent premature aging.&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;&lt;strong&gt;&lt;br&gt;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;Duration:&lt;/strong&gt;\r\nFacial service durations can vary depending on the type of facial and additional treatments included. Typically, a facial appointment lasts between 60 to 90 minutes.&lt;/p&gt;&lt;p&gt;&lt;strong&gt;&lt;br&gt;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;Price:&lt;/strong&gt; Starting from PKR 2,000&lt;/p&gt;&lt;p&gt;&lt;strong&gt;&lt;br&gt;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;Why Choose Us:&lt;/strong&gt;&lt;/p&gt;&lt;ul&gt;&lt;li&gt;&lt;strong&gt;Professional Estheticians:&lt;/strong&gt; Our team consists of skilled and licensed estheticians with expertise in skincare and facial treatments.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Customized Treatments:&lt;/strong&gt; We tailor our facials to meet your unique skin needs and concerns, ensuring optimal results.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Relaxing Environment:&lt;/strong&gt; Enjoy a serene and comfortable environment designed to enhance your relaxation and rejuvenation.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Quality Products:&lt;/strong&gt; We use high-quality, dermatologist-approved skincare products to deliver effective and safe treatments.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Visible Results:&lt;/strong&gt; Experience immediate and long-term benefits, including improved skin texture, tone, and overall appearance.&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;Treat yourself to a revitalizing facial experience and reveal healthier, more radiant skin&lt;/p&gt;', '171827755581.jpg', '2000', '08:00:00', '17:00:00', '3', 1, 2, 1, 1, '2025-10-06 18:19:15', '2025-10-06 18:19:15'),
(6, 'Yoga', 'yoga', '&lt;p&gt;Our yoga classes offer a rejuvenating and holistic approach to fitness and well-being, suitable for practitioners of all levels. Led by experienced yoga instructors, our classes focus on enhancing flexibility, strength, and mindfulness through a combination of yoga poses, breathing techniques, and meditation. Whether you&#039;re a beginner or an experienced yogi, our classes provide a peaceful and supportive environment to explore the benefits of yoga.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;What&#039;s Included:&lt;/strong&gt;&lt;/p&gt;&lt;ul&gt;&lt;li&gt;&lt;strong&gt;Gentle Warm-Up:&lt;/strong&gt; A gentle warm-up to prepare your body for the practice ahead, focusing on stretching and mobility.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Yoga Poses (Asanas):&lt;/strong&gt; A series of yoga poses designed to improve flexibility, strength, and balance, with variations to suit different levels.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Breathing Techniques (Pranayama):&lt;/strong&gt; Instruction on various breathing techniques to enhance relaxation, focus, and energy flow.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Meditation:&lt;/strong&gt; Guided meditation to calm the mind, reduce stress, and promote mental clarity and emotional well-being.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Cool Down and Relaxation:&lt;/strong&gt; A soothing cool-down sequence followed by relaxation techniques to help you unwind and integrate the benefits of your practice.&lt;/li&gt;&lt;li&gt;&lt;br&gt;&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;&lt;strong&gt;Duration:&lt;/strong&gt;\r\nOur yoga classes typically last 60 minutes, providing a comprehensive and balanced practice.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;Price:&lt;/strong&gt; Starting from PKR 500 per class&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;Why Choose Us:&lt;/strong&gt;&lt;/p&gt;&lt;ul&gt;&lt;li&gt;&lt;strong&gt;Experienced Instructors:&lt;/strong&gt; Our instructors are certified and experienced in teaching yoga, ensuring safe and effective guidance.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Accessible Classes:&lt;/strong&gt; Classes are open to all levels, with modifications and adjustments provided to accommodate individual needs.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Focus on Mind-Body Connection:&lt;/strong&gt; Emphasis on the mind-body connection to promote holistic well-being and inner balance.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Community Atmosphere:&lt;/strong&gt; Join a community of like-minded individuals seeking health, wellness, and self-improvement.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Stress Relief:&lt;/strong&gt; Experience the stress-relieving benefits of yoga, promoting relaxation and a sense of inner peace.&lt;/li&gt;&lt;li&gt;&lt;br&gt;&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;Join our yoga classes and embark on a journey to improve your physical health, mental clarity, and overall well-being through the transformative practice of yoga&lt;/p&gt;', '171827796092.jpg', '500', '09:00:00', '15:00:00', '5', 1, 2, 1, 1, '2025-10-06 18:26:00', '2025-10-06 18:26:00'),
(7, 'Weight Loss', 'weight-loss', '&lt;p&gt;Our weight loss program is designed to help you achieve your weight loss goals in a safe, sustainable, and effective manner. Whether you&#039;re looking to lose a few pounds or make a significant lifestyle change, our program combines personalized diet plans, exercise routines, and lifestyle modifications to help you reach and maintain a healthy weight.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;What&#039;s Included:&lt;/strong&gt;&lt;/p&gt;&lt;ul&gt;&lt;li&gt;&lt;strong&gt;Initial Consultation:&lt;/strong&gt; A comprehensive evaluation of your current health, weight loss goals, and lifestyle habits.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Customized Diet Plan:&lt;/strong&gt; A personalized diet plan tailored to your dietary preferences, nutritional needs, and weight loss goals.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Exercise Guidance:&lt;/strong&gt; Expert guidance on exercise routines that are effective for weight loss and suitable for your fitness level.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Behavioral Counseling:&lt;/strong&gt; Behavioral counseling to help you develop healthy habits, overcome barriers, and stay motivated.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Progress Monitoring:&lt;/strong&gt; Regular monitoring of your progress, with adjustments made to your plan as needed.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Supportive Environment:&lt;/strong&gt; A supportive and encouraging environment to help you stay motivated and accountable.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Education and Resources:&lt;/strong&gt; Access to educational materials and resources to help you make informed choices about your health and lifestyle.&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;&lt;strong&gt;&lt;br&gt;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;Duration:&lt;/strong&gt;\r\nThe duration of the weight loss program varies depending on your individual goals and progress. Programs can range from a few weeks to several months.&lt;/p&gt;&lt;p&gt;&lt;strong&gt;&lt;br&gt;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;Price:&lt;/strong&gt; Starting from PKR 5,000&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;Why Choose Us:&lt;/strong&gt;&lt;/p&gt;&lt;ul&gt;&lt;li&gt;&lt;strong&gt;Professional Guidance:&lt;/strong&gt; Our team consists of experienced professionals, including dietitians, fitness trainers, and counselors, who are dedicated to helping you achieve your weight loss goals.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Evidence-Based Approach:&lt;/strong&gt; Our program is based on the latest scientific evidence and best practices for weight loss.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Customization:&lt;/strong&gt; We tailor our program to meet your individual needs, taking into account your preferences, lifestyle, and health status.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Long-Term Success:&lt;/strong&gt; We focus on sustainable lifestyle changes that promote long-term weight management and overall health.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Supportive Community:&lt;/strong&gt; Join a community of individuals who are also on their weight loss journey, providing support, motivation, and encouragement.&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;Embark on your weight loss journey with us and take the first step towards a healthier, happier you!&lt;/p&gt;', '17182780555.jpg,171827805556.jpg,171827805518.jpg,171827805529.jpg', '5000', '05:00:00', '19:00:00', '5', 1, 2, 1, 1, '2025-10-06 18:27:35', '2025-10-06 18:27:35'),
(8, 'Solar Panel Installation', 'solar-panel-installation', '&lt;p&gt;Our solar panel installation service is designed to provide you with a reliable and sustainable energy solution that helps you save on electricity bills while reducing your carbon footprint. Whether you&#039;re looking to install solar panels for your home or business, our expert team will work with you to design and install a system that meets your energy needs and budget.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;What&#039;s Included:&lt;/strong&gt;&lt;/p&gt;&lt;ul&gt;&lt;li&gt;&lt;strong&gt;Initial Consultation:&lt;/strong&gt; A detailed assessment of your property and energy needs to determine the best solar panel system for you.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Customized System Design:&lt;/strong&gt; Designing a solar panel system tailored to your roof size, energy consumption, and budget.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Permitting and Approvals:&lt;/strong&gt; Handling all necessary permits and approvals required for solar panel installation.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Installation:&lt;/strong&gt; Professional installation of solar panels, inverters, and other necessary components.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Connection to Grid:&lt;/strong&gt; Connecting your solar panel system to the electrical grid or setting up a battery storage system for off-grid use.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Monitoring System:&lt;/strong&gt; Setting up a monitoring system to track the performance of your solar panel system.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Maintenance and Support:&lt;/strong&gt; Providing ongoing maintenance and support to ensure your solar panel system operates efficiently.&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;&lt;strong&gt;&lt;br&gt;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;Duration:&lt;/strong&gt;\r\nThe duration of the solar panel installation process can vary depending on the size of the system and complexity of the installation. Typically, installations can be completed in a few days to a few weeks.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;Price:&lt;/strong&gt; Starting from PKR 150,000 for a basic residential installation&lt;/p&gt;&lt;p&gt;&lt;strong&gt;&lt;br&gt;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;Why Choose Us:&lt;/strong&gt;&lt;/p&gt;&lt;ul&gt;&lt;li&gt;&lt;strong&gt;Experienced Installers:&lt;/strong&gt; Our team consists of experienced and certified installers with a proven track record in solar panel installations.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Quality Products:&lt;/strong&gt; We use high-quality solar panels, inverters, and mounting systems from reputable manufacturers.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Energy Savings:&lt;/strong&gt; Enjoy significant savings on your electricity bills by harnessing solar energy.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Environmental Benefits:&lt;/strong&gt; Reduce your carbon footprint and contribute to a greener, more sustainable future.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Financial Incentives:&lt;/strong&gt; Take advantage of government incentives and tax credits available for solar panel installations.&lt;/li&gt;&lt;li&gt;&lt;br&gt;&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;Go solar with us and start enjoying the benefits of clean, renewable energy today!&lt;/p&gt;', '171827854277.jpg,171827854213.jpg,171827854273.jpg,171827854266.jpg,171827854225.jpg,171827854292.jpg', '150000', '06:00:00', '21:00:00', '2', 1, 2, 1, 1, '2025-10-06 18:35:42', '2025-10-06 18:35:42'),
(9, 'Tutoring', 'tutoring', '&lt;p&gt;Our tutoring services offer personalized academic support to students of all ages and levels, helping them achieve their learning goals and excel in their studies. Whether your child needs help with a specific subject, exam preparation, or overall academic improvement, our experienced tutors are dedicated to providing the guidance and assistance needed for success.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;What&#039;s Included:&lt;/strong&gt;&lt;/p&gt;&lt;ul&gt;&lt;li&gt;&lt;strong&gt;Customized Tutoring:&lt;/strong&gt; One-on-one or group tutoring sessions tailored to the student&#039;s needs, focusing on subjects such as Math, Science, English, and more.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Exam Preparation:&lt;/strong&gt; Specialized tutoring for standardized tests, entrance exams, and school exams, with strategies to help students perform their best.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Homework Assistance:&lt;/strong&gt; Support with understanding homework assignments, completing tasks accurately, and developing effective study habits.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Study Skills Development:&lt;/strong&gt; Guidance on time management, note-taking, and other study skills to enhance academic performance.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Progress Tracking:&lt;/strong&gt; Regular assessment of the student&#039;s progress and adjustment of tutoring strategies as needed.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Feedback and Communication:&lt;/strong&gt; Updates and feedback provided to parents to keep them informed of their child&#039;s progress and areas for improvement.&lt;/li&gt;&lt;li&gt;&lt;br&gt;&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;&lt;strong&gt;Duration:&lt;/strong&gt;\r\nTutoring sessions typically last 1-2 hours and can be scheduled based on the student&#039;s needs and availability.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;Price:&lt;/strong&gt; Starting from PKR 500 per hour&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;Why Choose Us:&lt;/strong&gt;&lt;/p&gt;&lt;ul&gt;&lt;li&gt;&lt;strong&gt;Qualified Tutors:&lt;/strong&gt; Our tutors are experienced professionals with expertise in their subjects and a passion for teaching.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Personalized Approach:&lt;/strong&gt; We tailor our tutoring sessions to meet the individual learning styles and needs of each student.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Flexible Scheduling:&lt;/strong&gt; We offer flexible scheduling options to accommodate busy student schedules.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Proven Results:&lt;/strong&gt; Our tutoring services have a track record of helping students improve their grades, confidence, and overall academic performance.&lt;/li&gt;&lt;li&gt;&lt;strong&gt;Supportive Environment:&lt;/strong&gt; We provide a supportive and encouraging learning environment where students can feel comfortable asking questions and exploring new concepts.&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;Invest in your child&#039;s academic success with our tutoring services and help them reach their full potential!&lt;/p&gt;', '171827950425.jpg', '500', '08:00:00', '16:00:00', '6', 1, 2, 1, 1, '2025-10-06 18:51:44', '2025-10-06 18:51:44');

-- --------------------------------------------------------

--
-- Table structure for table `social-setting`
--

CREATE TABLE `social-setting` (
  `social_id` bigint(20) UNSIGNED NOT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `you_tube` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social-setting`
--

INSERT INTO `social-setting` (`social_id`, `facebook`, `twitter`, `instagram`, `you_tube`, `created_at`, `updated_at`) VALUES
(1, 'https://www.facebook.com/', 'https://www.twitter.com/', 'https://www.instagram.com/', 'https://www.youtube.com/', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_image` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `user_address` varchar(255) DEFAULT NULL,
  `user_city` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_image`, `user_email`, `user_password`, `user_phone`, `user_type`, `user_address`, `user_city`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Noman Wazir', '1759824443team2.jpg', 'noman@gmail.com', '$2y$10$U0B944iXdHMsxKiM6jZLEeW9cNGgUD0xz2tps6dp8gpRhmIThLye6', '03058948347', 'user', '', 1, 1, '2025-10-05 03:15:21', '2025-10-07 03:07:23'),
(2, 'Abdul Rahman', '17598243801717442340258.jpg', 'abdul@gmail.com', '$2y$10$U0B944iXdHMsxKiM6jZLEeW9cNGgUD0xz2tps6dp8gpRhmIThLye6', '03052221517', 'provider', '', 1, 1, '2025-10-05 16:32:18', '2025-10-07 03:06:20');

-- --------------------------------------------------------

--
-- Table structure for table `user_contact`
--

CREATE TABLE `user_contact` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_contact`
--

INSERT INTO `user_contact` (`id`, `user_name`, `email`, `phone`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Abdul Rahman', 'chabdulrahmaan@gmail.com', '03052221517', 'Hello,\r\nI hope you’re doing well. I wanted to inquire about your services and pricing details. Could you please provide more information or share a brochure if available?\r\n\r\nThank you!\r\n— Abdul Rahman', '2025-10-06 10:11:22', '2025-10-06 10:11:22');

-- --------------------------------------------------------

--
-- Table structure for table `user_wallet`
--

CREATE TABLE `user_wallet` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user` int(11) NOT NULL,
  `balance` varchar(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_wallet`
--

INSERT INTO `user_wallet` (`id`, `user`, `balance`, `created_at`, `updated_at`) VALUES
(1, 1, '36900', '2025-10-05 03:23:33', '2025-10-05 03:23:33'),
(2, 2, '44890', '2025-10-05 16:42:35', '2025-10-06 10:07:04');

-- --------------------------------------------------------

--
-- Table structure for table `wallet_transactions`
--

CREATE TABLE `wallet_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user` int(11) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `add_payment_id` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `reason` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallet_transactions`
--

INSERT INTO `wallet_transactions` (`id`, `user`, `amount`, `type`, `add_payment_id`, `status`, `reason`, `created_at`, `updated_at`) VALUES
(1, 2, '100', 'debit', NULL, 1, 'Wallet Payout', '2025-10-06 10:07:04', '2025-10-06 10:07:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `availability`
--
ALTER TABLE `availability`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `commission`
--
ALTER TABLE `commission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payout_request`
--
ALTER TABLE `payout_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payout_settings`
--
ALTER TABLE `payout_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `social-setting`
--
ALTER TABLE `social-setting`
  ADD PRIMARY KEY (`social_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_contact`
--
ALTER TABLE `user_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_wallet`
--
ALTER TABLE `user_wallet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `availability`
--
ALTER TABLE `availability`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `city_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `commission`
--
ALTER TABLE `commission`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `page_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payout_request`
--
ALTER TABLE `payout_request`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payout_settings`
--
ALTER TABLE `payout_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `social-setting`
--
ALTER TABLE `social-setting`
  MODIFY `social_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_contact`
--
ALTER TABLE `user_contact`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_wallet`
--
ALTER TABLE `user_wallet`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;
