-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 14, 2020 at 03:26 PM
-- Server version: 5.7.30-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_sales`
--

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `id` int(11) NOT NULL,
  `model` varchar(200) NOT NULL,
  `producer_id` int(11) NOT NULL,
  `colour` varchar(200) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `car_status` varchar(50) NOT NULL DEFAULT 'Not Sold',
  `published` varchar(50) NOT NULL DEFAULT 'Not Published',
  `sell_price` int(11) NOT NULL,
  `capacity` int(11) NOT NULL,
  `views` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`id`, `model`, `producer_id`, `colour`, `owner_id`, `car_status`, `published`, `sell_price`, `capacity`, `views`) VALUES
(2, '2021', 3, 'Red', 2, 'Sold', 'Published', 10000, 4, 0),
(3, '2020', 1, 'Red', 2, 'Sold', 'Published', 23, 4, 0),
(4, '2020', 1, 'Red', 2, 'Sold', 'Published', 32, 4, 0),
(5, '2020', 1, 'Red', 2, 'Not Sold', 'Published', 312, 4, 0),
(6, '2020', 1, 'Red', 2, 'Sold', 'Published', 312, 4, 0),
(7, '2020', 1, 'Red', 3, 'Sold', 'Published', 312, 4, 111),
(8, '2021', 1, 'Red', 3, 'Not Sold', 'Published', 321, 4, 0),
(9, '2021', 1, 'Red', 3, 'Sold', 'Published', 10000, 4, 0),
(10, '2021', 1, 'Red', 3, 'Sold', 'Published', 10000, 4, 0),
(11, '2021', 1, 'Red', 3, 'Not Sold', 'Published', 10000, 4, 0),
(12, '2021', 1, 'Red', 3, 'Not Sold', 'Published', 10000, 4, 0),
(13, '2019', 3, 'black', 1, 'Not Sold', 'Published', 30000, 4, 0),
(14, '2020', 1, 'Red', 1, 'Not Sold', 'Published', 10000, 4, 0),
(16, 'czx', 3, 'cczx', 5, 'Not Sold', 'Published', 12321, 4, 0),
(17, 'czx', 1, 'bvc', 5, 'Sold', 'Published', 123, 33, 0);

-- --------------------------------------------------------

--
-- Table structure for table `car_producer`
--

CREATE TABLE `car_producer` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `car_producer`
--

INSERT INTO `car_producer` (`id`, `name`) VALUES
(1, 'BMW'),
(3, 'Tesla'),
(4, 'Ferrari'),
(5, 'Mercedes'),
(6, 'dasd'),
(7, 'اهدافنا');

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
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `car_id`, `image`) VALUES
(4, 6, 'dasdasd'),
(5, 6, 'dasdas'),
(6, 7, 'dsadasd'),
(7, 7, 'dasdasd'),
(8, 7, 'dasdas'),
(9, 8, 'dsadasd'),
(10, 8, 'dasdasd'),
(11, 8, 'dasdas'),
(22, 10, 'dsadasd'),
(23, 10, 'dasdasd'),
(24, 10, 'dasdas'),
(25, 11, 'dsadasd'),
(26, 11, 'dasdasd'),
(27, 11, 'dasdas'),
(36, 13, '/uploads/images/store/fi44-900x500.jpg'),
(37, 12, '/uploads/images/store/fi44-900x500.jpg'),
(41, 14, 'dsadasd'),
(42, 14, 'dasdasd'),
(43, 14, 'dasdas'),
(44, 15, '/uploads/images/store/fi44-900x500.jpg'),
(46, 17, '/uploads/images/store/90867974_140336997499828_1439517392299360256_o.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `zoom` int(11) NOT NULL,
  `distrect` varchar(400) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `latitude`, `longitude`, `zoom`, `distrect`, `user_id`) VALUES
(1, 1, 1, 12, 'the distrect', 2),
(2, 1, 1, 12, 'the distrect', 2),
(3, 23.3342, 21.3342, 20, 'the distrect', 3),
(4, 23.3342, 21.3342, 20, 'the distrect', 4);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_03_24_072208_create_biographies_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('user@user.com', '$2y$10$m12qM93647STOYyqnNm7s.fwinRuzrH4PVSz6/C8Xoj2mCAurUcsG', '2020-03-26 06:00:27'),
('user@sample.app', '$2y$10$luRJzQf/DjL2jr.11NggQOYdLFkOTc5U05J3gnWaDg9Cb85WnNgnq', '2020-03-26 06:25:10'),
('sqlrhaf@gmail.com', '$2y$10$btOJjW.RrqSnH3OtR7CNteQ0O2GO1cdWGlBjoCL7WBYzekdqyzZxq', '2020-03-26 06:27:22');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `sale_date` datetime NOT NULL,
  `custome_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Not Active',
  `image` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `status`, `image`) VALUES
(1, 'dasdas', 'admin@admin.com', 'Admin', NULL, '$2y$10$Fn7hF8GG1FOaxRwxFpkE5Ohlz.B7AofNBiVfgW.gTuRl33mi.wnjK', NULL, '2020-04-20 09:00:07', '2020-05-14 09:12:55', 'Active', '/uploads/images/store/Screenshot from 2020-04-25 06-25-56.png'),
(2, 'user sample', 'admin1@admin.com', 'Agency', NULL, '$2y$10$pgBtZB9wrX1n.PGD3oiDOejemrMilBSN34owLCEB.SXgy4vliIy4G', NULL, '2020-05-05 06:16:54', '2020-05-13 06:34:01', 'Susbended', ''),
(3, 'user sample', 'admin5@admin.com', 'Agency', NULL, '$2y$10$hMmeXPZ2Dbhrb0MrNPgPLuITqNqO582G4pWGfgd2JJFoNzTxZCRUG', NULL, '2020-05-06 10:25:23', '2020-05-13 06:30:16', 'Active', ''),
(4, 'user sample yyyyy', 'eee@ddddd.com', 'Agency', NULL, '$2y$10$ecUjtOLydsqdVFnQgCszoObRuZeXfbNcMeai.7O/7qvnyQT1p2IZO', NULL, '2020-05-06 13:36:49', '2020-05-13 06:30:16', 'Active', ''),
(5, 'salahagency', 'salahagency@salah.com', 'Agency', NULL, '$2y$10$H.1KGTulbS8OAVH90f2XOuhhh00FyokJoNPjSyff/kd/xtFcS3VLe', NULL, '2020-05-07 17:24:39', '2020-05-13 06:30:16', 'Active', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `car_producer`
--
ALTER TABLE `car_producer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
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
-- Indexes for table `sales`
--
ALTER TABLE `sales`
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
-- AUTO_INCREMENT for table `car`
--
ALTER TABLE `car`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `car_producer`
--
ALTER TABLE `car_producer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
