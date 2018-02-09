-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2017 at 10:53 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cleaner`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertisment`
--

CREATE TABLE `advertisment` (
  `id` int(20) NOT NULL,
  `pool_id` int(11) DEFAULT NULL,
  `login_user_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `advertisment`
--

INSERT INTO `advertisment` (`id`, `pool_id`, `login_user_id`) VALUES
(30, 24, 32),
(31, 39, 32),
(32, 31, 32);

-- --------------------------------------------------------

--
-- Table structure for table `ad_place`
--

CREATE TABLE `ad_place` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ad_place`
--

INSERT INTO `ad_place` (`id`, `name`, `timestamp`) VALUES
(1, 'One', '2017-04-10 11:46:34'),
(2, 'Two', '2017-04-11 01:15:31'),
(3, 'three', '2017-04-11 09:57:21');

-- --------------------------------------------------------

--
-- Table structure for table `ad_pool`
--

CREATE TABLE `ad_pool` (
  `id` int(11) NOT NULL,
  `cleaner_user_id` int(11) UNSIGNED NOT NULL,
  `ad_place_id` int(11) NOT NULL,
  `subscription_id` int(11) NOT NULL,
  `image` varchar(500) NOT NULL,
  `status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ad_pool`
--

INSERT INTO `ad_pool` (`id`, `cleaner_user_id`, `ad_place_id`, `subscription_id`, `image`, `status`) VALUES
(1, 32, 1, 1, '', 0),
(2, 34, 2, 2, '', 0),
(3, 32, 3, 2, '', 0),
(4, 34, 1, 2, '', 2),
(5, 32, 2, 2, '', 0),
(6, 34, 3, 1, '', 0),
(22, 34, 2, 2, '', 2),
(23, 34, 2, 2, '', 2),
(24, 32, 1, 2, '2.jpg', 2),
(25, 34, 1, 1, '2.jpg', 2),
(26, 32, 1, 1, 'Background5.png', 2),
(27, 32, 2, 2, 'Background5.png', 2),
(28, 34, 1, 1, '2.jpg', 2),
(29, 34, 1, 1, '2.jpg', 2),
(30, 34, 1, 1, '2.jpg', 2),
(31, 32, 3, 2, '2.jpg', 2),
(32, 32, 1, 2, 'afghan.PNG', 0),
(33, 34, 2, 2, 'view.PNG', 0),
(34, 34, 2, 2, 'view.PNG', 1),
(35, 34, 2, 2, 'view.PNG', 2),
(36, 32, 2, 2, 'TcGvLZw8ihrPTFfRgzTndnAww9qm74Te.png', 1),
(37, 32, 2, 2, '9gH-mpt-jcu85-ajNqqv5b5oSPbvskBh.png', 1),
(38, 34, 2, 2, 'nPr9oYhSiAt-0jxmP9KZ6W-CUXnOzojR.PNG', 1),
(39, 32, 2, 2, 'WKNoB13zMs9UaDwADSUs66efTSFY8TdJ.png', 0),
(40, 32, 2, 2, 'hdmsNufyE-WTx-p0Aa5HVE5SI93-nK-W.PNG', 0),
(41, 32, 2, 2, 'rOZxFb_p4TxyYiBOoKSjCuKZ8suXhgeN.png', 2),
(42, 32, 2, 2, 'HEOycjQi86ipxOArbVIqq2wbtqcE_KH-.PNG', 2),
(43, 34, 2, 2, 'NcVuXarHYrlwiarcwLJXkx9vB5Dw1E6J.PNG', 2),
(44, 34, 2, 2, 'K-BBsNm6n_nNmF4fKZfvKVT9Z3J5bQRo.png', 2);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(450) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'parks cleaning');

-- --------------------------------------------------------

--
-- Table structure for table `cleaner`
--

CREATE TABLE `cleaner` (
  `user_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cleaner`
--

INSERT INTO `cleaner` (`user_id`) VALUES
(32),
(34);

-- --------------------------------------------------------

--
-- Table structure for table `cleaner_category`
--

CREATE TABLE `cleaner_category` (
  `id` int(11) NOT NULL,
  `cleaner_user_id` int(11) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cleaner_region`
--

CREATE TABLE `cleaner_region` (
  `id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `cleaner_user_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `user_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`user_id`) VALUES
(33),
(35),
(36);

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `id` int(11) NOT NULL,
  `customer_user_id` int(11) UNSIGNED NOT NULL,
  `region_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(45) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `contact_no` varchar(45) DEFAULT NULL,
  `description` text,
  `image` text,
  `address` varchar(45) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date` date DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `work_options` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`id`, `customer_user_id`, `region_id`, `category_id`, `title`, `price`, `status`, `contact_no`, `description`, `image`, `address`, `timestamp`, `date`, `longitude`, `latitude`, `work_options`) VALUES
(3, 24, 1, 1, 'hello', 1200, 2, NULL, 'Hleoo', '', 'hi', '2017-03-14 09:11:19', '2017-04-18', 0, 0, 0),
(13, 24, 3, 3, 'Clean my gutter', 12000, 1, '0090900229', '', '', 'eee', '2017-04-04 12:25:39', '2017-04-18', 0, 0, 0),
(18, 24, 1, 3, 'Clean my gutter', 12000, 1, '0090900229', '', '', 'eee', '2017-04-04 12:34:29', '2017-04-18', 0, 0, 0),
(19, 24, 1, 3, 'Clean my gutter', 12000, 1, '0090900229', '', '', 'eee', '2017-04-04 12:34:48', '2017-12-12', 0, 0, 0),
(20, 24, 3, 2, 'Clean our home', 12000, 1, '00903433343', 'Please do it.', '', '', '2017-04-05 05:25:48', '2017-12-12', 0, 0, 0),
(21, 24, 2, 1, 'Clean my gutter', 12999, NULL, '00989929929', 'Hello', '', 'Block 4-E', '2017-04-05 12:44:45', '2017-04-06', 0, 0, 0),
(22, 26, 1, 1, 'Garden cleaning', 1200, 1, '5433735', 'Hello there is lot of waste near the garden so want to it clean.', '', 'Defence phase 3', '2017-04-07 10:20:44', '2017-04-10', 0, 0, 0),
(23, 26, 2, 3, 'fdgdfs', 446, 10, 'adgg', 'erwy', '', 'wywyw', '2017-04-17 13:53:15', '2017-04-12', 0, 0, 0),
(24, 26, 2, 3, 'fdgdfs', 446, 10, 'adgg', 'erwy', '', 'wywyw', '2017-04-17 13:58:24', '2017-04-12', 0, 0, 0),
(25, 26, 2, 3, 'fdgdfs', 446, 10, 'adgg', 'erwy', '', 'wywyw', '2017-04-17 14:05:43', '2017-04-12', 0, 0, 0),
(26, 26, 2, 3, 'fdgdfs', 446, 10, 'adgg', 'erwy', '', 'wywyw', '2017-04-17 14:07:03', '2017-04-12', 0, 0, 0),
(27, 26, 2, 3, 'fdgdfs', 446, 10, 'adgg', 'erwy', '', 'wywyw', '2017-04-17 14:11:54', '2017-04-12', 0, 0, 0),
(28, 26, 2, 3, 'fdgdfs', 446, 10, 'adgg', 'erwy', '', 'wywyw', '2017-04-17 14:19:44', '2017-04-12', 0, 0, 0),
(29, 33, 2, 1, 'Park cleaning', 12000, 10, '5737353573', 'this is park cleaning job', '', 'Islamabad', '2017-04-21 05:40:29', '2017-04-19', 0, 0, 0),
(30, 33, 3, 1, 'this is title', 4524, 10, '4662', 'this is discription', '', 'Islamabad', '2017-04-21 12:15:23', '2017-04-26', NULL, NULL, 0),
(31, 33, 3, 1, 'this is title', 3523, 10, '536454', 'this is discription', '', 'Islamabad', '2017-04-21 12:17:32', '2017-04-11', NULL, NULL, 0),
(32, 33, 1, 1, 'this is title', 322, 10, '4662', 'thhhhh', '', 'karachi', '2017-04-21 12:27:11', '2017-04-25', NULL, NULL, 0),
(33, 33, 1, 1, '', NULL, NULL, 'dfdf', '', '', '', '2017-04-21 14:34:40', NULL, 666.99, 778878, 0),
(34, 33, 5, 1, 'this is another title', 675665, 10, '67458484', 'this is another discription', '', 'karachi', '2017-04-24 06:33:18', NULL, 5.5635, 56.5463, 0),
(35, 35, 6, 1, 'gilgat project', 34590, 10, '352326', 'this is gilgat project', '', 'gilgat', '2017-04-24 07:33:09', NULL, 34.3523, 343.34343, 0),
(36, 24, 1, 3, 'title changed', 55444, 20, '462642', 'postman', NULL, 'postman know the address', '2017-05-24 08:05:07', '2017-05-25', 34.45, 45.43, 20),
(37, 32, 1, 3, 'title', 55444, 20, '462642', 'postman', 'dsfds.png,dgd.jpg', 'postman know the address', '2017-05-26 09:58:56', '2017-05-25', 34.45, 45.43, 20),
(38, 32, 1, 3, 'title', 55444, 20, '462642', 'postman', 'dsfds.png,dgd.jpg', 'postman know the address', '2017-05-29 06:15:58', '2017-05-25', 34.45, 45.43, 20),
(39, 32, 1, 3, 'title', 55444, 20, '462642', 'postman', 'dsfds.png,dgd.jpg', 'postman know the address', '2017-05-29 09:57:00', '2017-05-25', 34.45, 45.43, 20),
(40, 32, 1, 3, 'title', 55444, 20, '462642', 'postman', 'dsfds.png,dgd.jpg', 'postman know the address', '2017-05-29 11:46:24', '2017-05-25', 34.45, 45.43, 20);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1488517617),
('m130524_201442_init', 1488517625);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `cleaner_id` int(11) NOT NULL,
  `rating` double DEFAULT NULL,
  `rated_by` int(11) NOT NULL,
  `review` varchar(32) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id`, `job_id`, `user_id`, `cleaner_id`, `rating`, `rated_by`, `review`, `timestamp`) VALUES
(4, 13, 33, 32, 4, 0, 'bye', '2017-04-19 08:35:33'),
(6, 18, 33, 32, 3, 20, 'usaman', '2017-04-19 12:39:42'),
(7, 18, 33, 32, 2, 20, 'usmana', '2017-04-19 12:41:10'),
(14, 13, 33, 34, 4, 10, 'customer rated you', '2017-04-21 07:30:32'),
(17, 13, 33, 34, 3, 10, 'good work', '2017-04-24 12:37:04'),
(20, 29, 35, 32, 3.4, 10, 'rtytryr', '2017-04-25 07:41:34');

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE `region` (
  `id` int(11) NOT NULL,
  `name` varchar(450) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`id`, `name`) VALUES
(1, 'Defence'),
(2, 'Bahria'),
(3, 'B-17'),
(4, 'Airport'),
(5, 'Railway station'),
(6, 'etro Bus Station'),
(8, 'Red Zone'),
(9, 'Texila');

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `days` int(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`id`, `name`, `price`, `timestamp`, `days`) VALUES
(1, 'subscription1', 10000, '2017-04-10 11:34:57', 2),
(2, 'subscription2', 6000, '2017-04-11 01:14:41', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_no` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `profile_pic` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `account_activation_token` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_paid` int(11) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `first_name`, `last_name`, `contact_no`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `profile_pic`, `address`, `role`, `account_activation_token`, `is_paid`, `status`, `created_at`, `updated_at`) VALUES
(26, 'wajid khan ', 'usman', 'alo', '!11111', 'B0mvcGnZ--nTjByxrYHWaYsKzJoqbpOW', '$2y$13$y6KrL9sRE5AqeTzPFisaOuncbjoM9cNmW1yIB/xpNHOUVbMY5jA6q', NULL, 'waji@gmail.com', NULL, 'islamanbd', 10, NULL, NULL, 10, 1491476243, 1495015745),
(29, 'waleed hayat', 'waleed ', 'hayat ', '43543', 'DGzzHM4G2VQk0qYxg4xpj-a1kLSjuhrv', '$2y$13$M2tcf0d86t1oCEnVkU8EVefjP9.s82OKfHituIhrAREu5Cl2mkVIW', NULL, 'waleed@gmail.com', NULL, 'dera', 30, NULL, NULL, 10, 1491484242, 1491484283),
(30, 'naeem khan', 'naeem', 'khan', '546346', 'a-4cUiwcPg7reoKAD7Tq544uSW5uYxSY', '$2y$13$EleXjgcHWkTho6Ae10fbZ.mr4HQlN4FpuhLvJ.dFsV1eWSkP4eki2', NULL, 'naeem@gmail.com', NULL, 'karachi', 30, NULL, NULL, 10, 1491537095, 1491537168),
(31, 'Admin Admin', 'Admin', 'Admin', '9299992', 'iwn8Y0oV-9TpUgBv4JtdggvHnj4PMvzG', '$2y$13$NYvFjcW.xK3zqDvLYbSUku.PnxLLR/Amr1QzEsk1/DM1lSiBe11vS', NULL, 'admin@admin.com', NULL, 'Lahore', 30, NULL, NULL, 10, 1491808118, 1493018200),
(32, 'Faheem Khan', 'Faheem', 'khan', '4536353357', 'cxpyOIqYPa_-qD6YZQ5cnjWC5bkN0uBr', '$2y$13$PPJC2ylTwmn/JDen.HX.VOweTUZ.tkiTWXHBZttGvwbE4AgfHuLmO', NULL, 'faheem@gmail.com', NULL, 'Islamabad', 20, NULL, NULL, 10, 1492590719, 1492590719),
(33, 'hasib hali', 'hasib ', 'hali', '464563', 'aVUuejVDocDXj-rM2LgHZsJE9WG0or7M', '$2y$13$1ZUeH7Fu0fNj6Y1xL0tflO3tZ/V7yPDb0COpjNPvkRZ9ZN.OixLSa', NULL, 'hasib@gmail.com', NULL, 'Islamabad', 10, NULL, NULL, 10, 1492590901, 1492590901),
(34, 'neaam khan', 'naeem', 'khan', '65773573', 'B2I_yGs6J_12M9Ie-O6DyKZ00GQBxcug', '$2y$13$FTskBZp2VVRQZkSRlrggDOo7hkU.Y33heZqOiokmzoITTIcB7hAh2', NULL, 'naee@gmail.com', NULL, 'Islamabad', 20, NULL, NULL, 10, 1492753088, 1492753088),
(35, 'sajid sayeed', 'sajid', 'sayed', '4646462', 'ER29jmuiXshAw5MZpU8aZgZ1YS8uB2SY', '$2y$13$KEzFqxpYuhAzZLgso6EjeuIj/qpD6awAwo2qLL0tbgUnjXLuup1OS', NULL, 'sajid@gmail.com', NULL, 'gilgat', 10, NULL, NULL, 10, 1493019057, 1493020432),
(36, 'younas khan', 'younas', 'khan', '64567868754', 'DParrLzEWRxJBWX9kHz5_R3cfKPj7s3e', '$2y$13$.vr6O4z1f3GSicLlffKrpefh9SAU/34Y2meZbmganmAieAhhSRqqi', NULL, 'younas@gmail.com', NULL, 'karachi', 10, NULL, NULL, 20, 1496043010, 1496043101);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advertisment`
--
ALTER TABLE `advertisment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`login_user_id`),
  ADD KEY `pool_id` (`pool_id`);

--
-- Indexes for table `ad_place`
--
ALTER TABLE `ad_place`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ad_pool`
--
ALTER TABLE `ad_pool`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_add_pool_cleaner1_idx` (`cleaner_user_id`),
  ADD KEY `fk_add_pool_ad_place1_idx` (`ad_place_id`),
  ADD KEY `subscription_id` (`subscription_id`),
  ADD KEY `cleaner_user_id` (`cleaner_user_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cleaner`
--
ALTER TABLE `cleaner`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `fk_cleaner_user_idx` (`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cleaner_category`
--
ALTER TABLE `cleaner_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cleaner_category_cleaner1_idx` (`cleaner_user_id`),
  ADD KEY `fk_cleaner_category_category1_idx` (`category_id`);

--
-- Indexes for table `cleaner_region`
--
ALTER TABLE `cleaner_region`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cleaner_region_region1_idx` (`region_id`),
  ADD KEY `fk_cleaner_region_cleaner1_idx` (`cleaner_user_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_job_customer1_idx` (`customer_user_id`),
  ADD KEY `fk_job_region1_idx` (`region_id`),
  ADD KEY `fk_job_category1_idx` (`category_id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_rating_job1_idx` (`job_id`),
  ADD KEY `fk_rating_user1_idx` (`user_id`),
  ADD KEY `rated by` (`rated_by`);

--
-- Indexes for table `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advertisment`
--
ALTER TABLE `advertisment`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `ad_place`
--
ALTER TABLE `ad_place`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ad_pool`
--
ALTER TABLE `ad_pool`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cleaner_category`
--
ALTER TABLE `cleaner_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cleaner_region`
--
ALTER TABLE `cleaner_region`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `region`
--
ALTER TABLE `region`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `advertisment`
--
ALTER TABLE `advertisment`
  ADD CONSTRAINT `fk_login_user_id` FOREIGN KEY (`login_user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `fk_pool_id` FOREIGN KEY (`pool_id`) REFERENCES `ad_pool` (`id`);

--
-- Constraints for table `ad_pool`
--
ALTER TABLE `ad_pool`
  ADD CONSTRAINT `fk_add_pool_ad_place1` FOREIGN KEY (`ad_place_id`) REFERENCES `ad_place` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_add_pool_cleaner1` FOREIGN KEY (`cleaner_user_id`) REFERENCES `cleaner` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subscription_id` FOREIGN KEY (`subscription_id`) REFERENCES `subscription` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cleaner`
--
ALTER TABLE `cleaner`
  ADD CONSTRAINT `fk_rating_userId` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `cleaner_category`
--
ALTER TABLE `cleaner_category`
  ADD CONSTRAINT `fk_cleaner_category_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cleaner_category_cleaner1` FOREIGN KEY (`cleaner_user_id`) REFERENCES `cleaner` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `cleaner_region`
--
ALTER TABLE `cleaner_region`
  ADD CONSTRAINT `fk_cleaner_region_cleaner1` FOREIGN KEY (`cleaner_user_id`) REFERENCES `cleaner` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cleaner_region_region1` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `fk_customer_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `fk_rating_job1` FOREIGN KEY (`job_id`) REFERENCES `job` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
