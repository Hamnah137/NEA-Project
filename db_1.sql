-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 13, 2025 at 03:44 PM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
