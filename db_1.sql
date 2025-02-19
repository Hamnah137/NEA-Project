-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 19, 2025 at 01:11 PM
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
(2, 1, 6, 1, '15.00'),
(3, 2, 1, 1, '19.99'),
(4, 3, 1, 1, '19.99'),
(5, 4, 1, 1, '19.99'),
(6, 5, 3, 1, '39.99'),
(7, 5, 7, 1, '15.00'),
(8, 6, 1, 1, '19.99'),
(9, 7, 1, 1, '19.99');

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
(23, 1, '19.99', 'Pending', '2025-02-19 10:58:39');

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
  `shop` varchar(255) NOT NULL DEFAULT 'main'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `price`, `image_path`, `created_at`, `shop`) VALUES
(1, 'RED JUMPER WITH A SWAN', 'Keep you warm in this winter season ;)', '19.99', 'https://aidashoreditch.co.uk/cdn/shop/files/EWC409_1_600x.jpg?v=1727880838', '2025-02-05 11:17:16', 'main'),
(2, 'GREEN HOODIE', 'Twin with nature, twin with us :)', '29.99', 'https://aidashoreditch.co.uk/cdn/shop/products/CMC379_GREEN_FLAT_600x.jpg?v=1664882952', '2025-02-05 11:19:24', 'main'),
(3, 'BLUE DENIM JACKET', 'Go with fashion with us', '39.99', 'https://aidashoreditch.co.uk/cdn/shop/files/EWC365_5_600x.jpg?v=1726246127', '2025-02-05 11:21:30', 'main'),
(6, 'Children Overhead Hoodie', 'Go with the fashion:)', '15.00', 'https://assets.ajio.com/medias/sys_master/root/20221101/6Qig/63602143f997ddfdbd4e21ae/-473Wx593H-441589790-blue-MODEL.jpg', '2025-02-13 15:25:52', 'main'),
(7, 'Children Overhead Hoodie', 'Go with the fashion:)', '15.00', 'https://www.tradeprint.co.uk/dam/jcr:e64f5c2d-8100-4508-80d9-b24d519b477f/sun-yellow.webp', '2025-02-13 15:25:52', 'main');

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
(15, 2, 1, 5, 'jasnjwjxd', '2025-02-19 11:24:09'),
(16, 2, 1, 4, 's', '2025-02-19 11:25:23'),
(17, 2, 1, 4, 's', '2025-02-19 11:30:39'),
(18, 1, 6, 4, 'aDFCDA', '2025-02-19 12:12:09');

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
(4, 6, 1, 'hgjb', '2025-02-19 12:11:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `profile_image`, `is_admin`, `created_at`) VALUES
(1, 'linajohn', 'dollyyy', 'linajohn@rrr.com', NULL, 0, '2025-01-29 11:08:31'),
(2, 'evanbravo', 'password', 'evan123@gmail.com', NULL, 0, '2025-01-29 11:26:10'),
(3, 'marvi12', 'raven', 'marvi123@gmail.www', '', 0, '2025-02-05 09:28:07'),
(4, 'minakhan', 'hello', 'minakhan@yahoo.com', '', 0, '2025-02-12 11:49:10'),
(5, 'hhak12', 'home', 'jhajai.ksk@gmail.com', '', 0, '2025-02-19 09:25:06'),
(6, 'humainshah', '$2y$10$sOSQKcnXpN7fgTVs/XJj0.SlJhnBBibgRyQRuluhjuId9mHZpgkuC', 'hassuaui@gmail.com', '', 0, '2025-02-19 12:06:38');

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `search_log`
--
ALTER TABLE `search_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `site_reviews`
--
ALTER TABLE `site_reviews`
  MODIFY `site_review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
