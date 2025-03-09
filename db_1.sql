-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 09, 2025 at 10:53 PM
-- Server version: 5.7.11
-- PHP Version: 5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `user_id`) VALUES
(1, 42);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `order_detail_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`order_detail_id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 1, 1, 8, '19.99'),
(3, 2, 1, 1, '19.99'),
(4, 3, 1, 1, '19.99'),
(5, 4, 1, 1, '19.99'),
(6, 5, 3, 1, '39.99'),
(7, 5, 7, 1, '15.00'),
(8, 6, 1, 1, '19.99'),
(9, 7, 1, 1, '19.99'),
(10, 24, 1, 1, '19.99'),
(11, 24, 2, 1, '29.99'),
(12, 25, 2, 1, '29.99'),
(13, 26, 2, 1, '29.99'),
(15, 28, 2, 1, '29.99'),
(16, 29, 8, 1, '29.99'),
(17, 29, 5, 1, '60.00'),
(18, 29, 10, 1, '70.00'),
(19, 30, 4, 1, '47.75'),
(20, 31, 5, 1, '60.00'),
(21, 32, 10, 1, '70.00'),
(22, 33, 3, 1, '39.99');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` enum('Pending','Completed','Cancelled') DEFAULT 'Pending',
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `total`, `status`, `order_date`) VALUES
(1, 3, '174.92', 'Pending', '2025-02-19 10:09:46'),
(2, 3, '19.99', 'Pending', '2025-02-19 10:09:58'),
(3, 3, '19.99', 'Pending', '2025-02-19 10:11:13'),
(4, 3, '19.99', 'Pending', '2025-02-19 10:11:30'),
(5, 4, '54.99', 'Pending', '2025-02-19 10:15:36'),
(6, 4, '19.99', 'Pending', '2025-02-19 10:18:22'),
(7, 4, '19.99', 'Pending', '2025-02-19 10:20:40'),
(8, 1, '74.98', 'Pending', '2025-02-19 10:44:56'),
(9, 1, '0.00', 'Pending', '2025-02-19 10:45:00'),
(10, 1, '19.99', 'Pending', '2025-02-19 10:45:08'),
(11, 1, '0.00', 'Pending', '2025-02-19 10:45:14'),
(12, 1, '0.00', 'Pending', '2025-02-19 10:45:23'),
(13, 1, '19.99', 'Pending', '2025-02-19 10:45:30'),
(14, 1, '19.99', 'Pending', '2025-02-19 10:46:33'),
(15, 1, '0.00', 'Pending', '2025-02-19 10:49:27'),
(16, 1, '19.99', 'Pending', '2025-02-19 10:49:37'),
(17, 1, '49.98', 'Pending', '2025-02-19 10:52:47'),
(18, 1, '0.00', 'Pending', '2025-02-19 10:52:53'),
(19, 1, '0.00', 'Pending', '2025-02-19 10:52:59'),
(20, 1, '29.99', 'Pending', '2025-02-19 10:55:41'),
(21, 1, '0.00', 'Pending', '2025-02-19 10:56:23'),
(22, 1, '19.99', 'Pending', '2025-02-19 10:56:32'),
(23, 1, '19.99', 'Pending', '2025-02-19 10:58:39'),
(24, 7, '49.98', 'Pending', '2025-02-19 17:12:13'),
(25, 7, '29.99', 'Pending', '2025-02-19 17:15:16'),
(26, 7, '29.99', 'Pending', '2025-02-19 17:16:00'),
(27, 7, '15.00', 'Pending', '2025-02-19 18:21:14'),
(28, 7, '29.99', 'Pending', '2025-02-19 20:30:56'),
(29, 44, '159.99', 'Pending', '2025-03-09 22:35:08'),
(30, 44, '47.75', 'Pending', '2025-03-09 22:40:06'),
(31, 50, '60.00', 'Pending', '2025-03-09 22:42:26'),
(32, 50, '70.00', 'Pending', '2025-03-09 22:44:56'),
(33, 50, '39.99', 'Pending', '2025-03-09 22:47:18');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `shop` varchar(255) NOT NULL DEFAULT 'main',
  `category` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `price`, `image_path`, `created_at`, `shop`, `category`, `product_name`) VALUES
(1, 'RED JUMPER WITH A SWAN', 'Keep you warm in this winter season ;)', '19.99', 'https://aidashoreditch.co.uk/cdn/shop/files/EWC409_1_600x.jpg?v=1727880838', '2025-02-05 11:17:16', 'main', 'Women', NULL),
(2, 'GREEN HOODIE', 'Twin with nature, twin with us :)', '29.99', 'https://aidashoreditch.co.uk/cdn/shop/products/CMC379_GREEN_FLAT_600x.jpg?v=1664882952', '2025-02-05 11:19:24', 'main', 'Men', NULL),
(3, 'BLUE DENIM JACKET', 'Go with fashion with us', '39.99', 'https://aidashoreditch.co.uk/cdn/shop/files/EWC365_5_600x.jpg?v=1726246127', '2025-02-05 11:21:30', 'main', 'Women', NULL),
(4, 'SOFT JACKET WITH POCKETS', 'Carry yourself with this cute jacket', '47.75', 'https://static.zara.net/assets/public/6019/f29e/717049b8af0c/312b477e54d9/05070469081-e1/05070469081-e1.jpg?ts=1729597716217&w=750', '2025-02-23 22:36:59', 'main', 'Women', NULL),
(5, 'Tailored Long Coat', 'Style your day with this coat', '60.00', 'https://static.zara.net/assets/public/d909/32df/b9fd4d4ab211/fdcd863925d6/02170603606-e1/02170603606-e1.jpg?ts=1737471883272&w=1920', '2025-02-23 22:29:07', 'main', 'Women', NULL),
(7, 'Children Overhead Hoodie', 'Go with the fashion:)', '15.00', 'https://www.tradeprint.co.uk/dam/jcr:e64f5c2d-8100-4508-80d9-b24d519b477f/sun-yellow.webp', '2025-02-13 15:25:52', 'main', 'Children', NULL),
(8, 'SOFT BUTTON COAT', 'Long sleeve coat with a lapel collar. Front button fastening.', '29.99', 'https://static.zara.net/assets/public/0925/3f61/7437446783f8/ee0fc7bbf510/05070660812-e1/05070660812-e1.jpg?ts=1732623094916&w=750', '2025-02-23 22:36:59', 'main', 'Women', NULL),
(10, 'WOOL DOUBLE-BREASTED COAT', 'Wool coat. Lapel collar and long sleeves with pronounced shoulders. Front welt pockets. Double-breasted button fastening.', '70.00', 'https://static.zara.net/assets/public/6b6a/8f0d/cef641399136/1c6e9600462d/09340147800-e1/09340147800-e1.jpg?ts=1728653112732&w=750', '2025-02-23 22:43:13', 'main', 'Women', NULL),
(11, 'TAILORED WOOL BLEND COAT ZW COLLECTION', 'Tailored coat made of a wool blend. Notched lapel collar and long sleeves. Front flap pockets and welt breast pocket. Matching lining. Front button fastening.', '120.99', 'https://static.zara.net/assets/public/7e82/4b9b/70334c3893ad/aa116c815a82/02211806615-e1/02211806615-e1.jpg?ts=1736442418732&w=1920', '2025-02-23 22:41:57', 'main', 'Women', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `review_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(1) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_reviews`
--

INSERT INTO `product_reviews` (`review_id`, `product_id`, `user_id`, `rating`, `comment`, `created_at`) VALUES
(3, 1, 1, 5, 'The stuff is really nice. If you want to keep yourselves warm, please try this out', '2025-02-12 10:58:45'),
(4, 1, 1, 5, 'It such a nice jumper. I will highly recommend to wear this in this winter.', '2025-02-12 11:05:22'),
(5, 1, 1, 5, 'It such a warm jumper. I highly recommend to wear this in this winter.', '2025-02-12 11:08:19'),
(6, 1, 1, 5, 'Best jumper till date that i have ever worn.', '2025-02-12 11:09:22'),
(7, 1, 1, 5, 'Best jumper I have worn.', '2025-02-12 11:09:55'),
(8, 1, 1, 5, 'Best jumper till date that i have ever worn.', '2025-02-12 11:33:38'),
(9, 1, 1, 5, 'Best jumper till date that i have ever worn.', '2025-02-12 11:39:50'),
(10, 2, 4, 4, 'My all time hoodie is this now. It is really comfortable', '2025-02-12 11:52:23'),
(23, 1, 29, 4, 'best', '2025-02-25 21:02:00');

-- --------------------------------------------------------

--
-- Table structure for table `search_log`
--

CREATE TABLE `search_log` (
  `log_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `search_query` varchar(255) NOT NULL,
  `search_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `site_reviews`
--

CREATE TABLE `site_reviews` (
  `site_review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(1) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `site_reviews`
--

INSERT INTO `site_reviews` (`site_review_id`, `user_id`, `rating`, `comment`, `created_at`) VALUES
(1, 3, 4, 'It\\\'s an exceptional website.', '2025-02-06 15:18:45'),
(2, 1, 5, 'The products are really amazing.', '2025-02-12 11:01:06'),
(3, 4, 5, 'The stuff of the products is really cool of this website.', '2025-02-12 11:50:29'),
(25, 29, 5, 'm,,', '2025-02-23 13:55:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `confirm_email` varchar(255) DEFAULT NULL,
  `confirm_password` varchar(255) DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `name`, `password`, `email`, `profile_image`, `is_admin`, `created_at`, `confirm_email`, `confirm_password`, `reset_token`, `reset_expires`) VALUES
(1, 'linajohn', '', 'dollyyy', 'linajohn@rrr.com', NULL, 0, '2025-01-29 11:08:31', NULL, NULL, NULL, NULL),
(2, 'evanbravo', '', 'password', 'evan123@gmail.com', NULL, 0, '2025-01-29 11:26:10', NULL, NULL, NULL, NULL),
(3, 'marvi12', '', 'raven', 'marvi123@gmail.www', '', 0, '2025-02-05 09:28:07', NULL, NULL, NULL, NULL),
(4, 'minakhan', '', 'hello', 'minakhan@yahoo.com', '', 0, '2025-02-12 11:49:10', NULL, NULL, NULL, NULL),
(5, 'hhak12', '', 'home', 'jhajai.ksk@gmail.com', '', 0, '2025-02-19 09:25:06', NULL, NULL, NULL, NULL),
(6, 'humainshah', '', '$2y$10$sOSQKcnXpN7fgTVs/XJj0.SlJhnBBibgRyQRuluhjuId9mHZpgkuC', 'hassuaui@gmail.com', '', 0, '2025-02-19 12:06:38', NULL, NULL, '96a85765316df91f3cf3425c37624a847d853f6db75bce43d26ff2675064912fb1c876729b50eadbe0fc79da62f986e12775', '2025-03-09 15:29:21'),
(7, 'alister_.', '', '$2y$10$d7q1tsudB986MHbIC0mytOzdSL2dN3bvXJ34b/J3k4M/.NBjdbtoG', 'hjagag@gmasn.ck', '', 0, '2025-02-19 16:37:33', NULL, NULL, NULL, NULL),
(29, 'fatima', '', '$2y$10$3D4tN/D43OVzV2SayAZHLOxhvP2o.eId.rYjkfgQSYYFRDHSxpMBS', 'fat_ima@hhh.mam', '', 0, '2025-02-22 15:34:16', NULL, NULL, NULL, NULL),
(32, 'hannah_.', '', '$2y$10$QE7d7QqqL9I4QIWaKy8kPOar6qjtWKhYWE87oZXywmw9RUPBEFocO', 'hannah@gmail.com', '', 0, '2025-02-23 18:09:26', 'hannah@gmail.com', '$2y$10$rrPrADDV5sjeiFNbfOLIrOUTv9dp1zhh1NwqN8JFbFXfPTthbVOOK', NULL, NULL),
(33, 'eve_edwards', '', '$2y$10$bzHH9lfYLwfbSsLpLgvy5uW8CvR.6GAmz7aSeYVW5GyihJIv58rLy', 'eve@hotmail.com', '', 0, '2025-02-24 12:32:23', 'eve@hotmail.com', '$2y$10$MrxOsN6lyxUVMuIqZre1a.Rbog0p.dD5zFYJQS.JW0hJzCRJdnTP6', NULL, NULL),
(35, 'evanbravo12', '', '$2y$10$7jKdJzh8X4Wc8wDJrInn/eSanqVAkAfOV5iIBvqRs1QqC3k3U7Gh.', 'evanbravo@www.hh', '', 0, '2025-02-24 16:16:41', 'evanbravo@www.hh', '$2y$10$IhGvfCItLtOFcVgdPDbpjOrgaKsUO82vw2aPpz707wgHIbEYYQP/6', NULL, NULL),
(37, 'Hamnah13', 'Hamnah Aziz', '$2y$10$MY3QQHK1Q6TisA73PUPea.MxdGyACFxuqrWjuox0D830ugtDko5PC', 'hamnah13@gmail.com', '1741442823_profile image.png', 0, '2025-02-25 16:57:53', 'hamnah@gmail.com', '$2y$10$plShLa5a94KoIh/L1evCBe6EeoniCEKWqRaIRqASrI2PlUFGc0tCy', NULL, NULL),
(42, 'Tara', 'Tara Raheem', '$2y$10$HkfUf4.p1UvmMN.RmKHelOBjZYZ1aJNQdo1A1GyJsaUQXqI7THyv.', 'tara@gmail.com', '', 1, '2025-02-27 18:17:20', 'tara@gmail.com', '$2y$10$yKOd2a/9yH7JzgQ3btdaRe6Z/Fxf5kQEk7BYzHMISOWIF0C15ZhPS', NULL, NULL),
(43, 'jane23', 'jane', '$2y$10$JSv0SmbGaAdzsDWPznILy.4d.e0D58V5NlB8vIpmozVovnGyDzyPO', 'jane23@www.hhh', '1741170308_67c826287b245-pf.jpeg', 0, '2025-03-05 10:23:36', 'jane23@www.hhh', '$2y$10$Ufvj3qBWnSGIst96mWpyVe6xYei8MFCcKnn0xkBGdYlX9E6rbN0Bi', '3f63e0a404ae9a239e5554ca45243dc071c32a390de3d04d30fb7d753fc3ac3d4888c88f0a1d5ed881d1404ee5ecaffefbf7', '2025-03-09 16:01:42'),
(44, 'sara12', 'Sarah Williams', '$2y$10$M0D1xq9Vw3W/XpBskIehmOdZ1DgK8HK2aThFjxH3qnSWGQxNV0JPS', 'sara12@www.hhh', '1741447231_pf.jpeg', 0, '2025-03-05 10:57:20', NULL, NULL, NULL, NULL),
(46, 'james_.', 'James', '$2y$10$NwwApfBkCkwWpamvtBEqK..Iy0OqzbzjVN.oFQruTJ9TbDAjkCuH.', 'james@www.hhh', '1741443243_profile pic.avif', 0, '2025-03-05 11:40:42', 'james@www.hhh', '$2y$10$rDjNls/ZmVcD84sxTK0PVe9F6WE/Z256joHBo/GL2IsDmcBpWaZWy', NULL, NULL),
(49, 'robyn_.', 'Robyn Martin', '$2y$10$jbzu6M65T0I3KhnYLGKH8OHm4qFALOGnif2ARsH8Vw5WrAsFYRcxe', 'robyn@gmail.com', '67cc6a7aae43b-pf.jpeg', 0, '2025-03-08 16:04:10', 'robyn@gmail.com', '$2y$10$r9oDyZpug9XB.nFanjUnz.wbyarsbLgsMvOsLAKZh8o/IL58iwd2m', NULL, NULL),
(50, 'Aaron', 'Aaron Haskell', '$2y$10$L52d69fL4UWZbvSzLpEd5ew/NC9z4kaldiI4QZcrCmJirGJz.UeF6', 'aaron45@gmail.com', '67cc706f5d296-pf.jpeg', 0, '2025-03-08 16:29:35', 'aaron45@gmail.com', '$2y$10$PFePMdxo0FmWeBIaSTVvEekM4Okkgmp2Kl/HPd3tyxOGNp1RhbUqq', '425ab65139b9c04baa7d57f909fe2c01310fae2d76220b332c894409fb385b70cc896da8dc0564bb29508887225ad9ab1449', '2025-03-09 17:36:01');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wishlist_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`wishlist_id`, `user_id`, `product_id`) VALUES
(5, 37, 5),
(12, 7, 3),
(13, 7, 5),
(14, 7, 7),
(16, 7, 1),
(25, 7, 8),
(26, 7, 2),
(27, 7, 10),
(28, 43, 1),
(29, 44, 2),
(30, 44, 11);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`order_detail_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `search_log`
--
ALTER TABLE `search_log`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `site_reviews`
--
ALTER TABLE `site_reviews`
  ADD PRIMARY KEY (`site_review_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlist_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `search_log`
--
ALTER TABLE `search_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `site_reviews`
--
ALTER TABLE `site_reviews`
  MODIFY `site_review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `orderdetails_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orderdetails_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `product_reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `search_log`
--
ALTER TABLE `search_log`
  ADD CONSTRAINT `search_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `site_reviews`
--
ALTER TABLE `site_reviews`
  ADD CONSTRAINT `site_reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
