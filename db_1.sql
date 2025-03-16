-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 16, 2025 at 10:38 PM
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
(22, 33, 3, 1, '39.99'),
(23, 34, 2, 1, '29.99'),
(24, 35, 2, 1, '29.99'),
(25, 36, 1, 1, '19.99'),
(26, 37, 11, 1, '120.99'),
(27, 37, 2, 1, '29.99'),
(28, 38, 2, 1, '29.99'),
(29, 39, 10, 1, '70.00'),
(30, 40, 1, 1, '19.99'),
(31, 41, 1, 1, '169.99'),
(32, 41, 2, 1, '29.99');

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
(33, 50, '39.99', 'Pending', '2025-03-09 22:47:18'),
(34, 50, '29.99', 'Pending', '2025-03-10 19:17:13'),
(35, 49, '29.99', 'Pending', '2025-03-10 21:28:39'),
(36, 49, '19.99', 'Pending', '2025-03-10 21:31:36'),
(37, 50, '150.98', 'Pending', '2025-03-10 21:34:08'),
(38, 43, '29.99', 'Pending', '2025-03-10 21:57:34'),
(39, 43, '70.00', 'Pending', '2025-03-10 22:19:55'),
(40, 43, '19.99', 'Pending', '2025-03-11 20:48:50'),
(41, 7, '199.98', 'Pending', '2025-03-16 19:34:56');

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
(1, 'ORANGE FREE ALL SWANS SLIPOVER', 'Keep you warm in this winter season ;)', '169.99', 'https://aidashoreditch.co.uk/cdn/shop/files/EWC409_1_600x.jpg?v=1727880838', '2025-02-05 11:17:16', 'main', 'Women', NULL),
(2, 'GREEN HOODIE', 'Twin with nature, twin with us :)', '29.99', 'https://aidashoreditch.co.uk/cdn/shop/products/CMC379_GREEN_FLAT_600x.jpg?v=1664882952', '2025-02-05 11:19:24', 'main', 'Men', NULL),
(3, 'BLUE DENIM JACKET', 'Go with fashion with us', '39.99', 'https://aidashoreditch.co.uk/cdn/shop/files/EWC365_5_600x.jpg?v=1726246127', '2025-02-05 11:21:30', 'main', 'Women', NULL),
(4, 'SOFT JACKET WITH POCKETS', 'Carry yourself with this cute jacket', '47.75', 'https://static.zara.net/assets/public/6019/f29e/717049b8af0c/312b477e54d9/05070469081-e1/05070469081-e1.jpg?ts=1729597716217&w=750', '2025-02-23 22:36:59', 'main', 'Women', NULL),
(5, 'TAILORED LONG COAT', 'Style your day with this coat', '60.00', 'https://static.zara.net/assets/public/d909/32df/b9fd4d4ab211/fdcd863925d6/02170603606-e1/02170603606-e1.jpg?ts=1737471883272&w=1920', '2025-02-23 22:29:07', 'main', 'Women', NULL),
(6, 'MEN\'S CASUAL WINDBREAKER JACKET', 'Lightweight, Polyester, Hooded with Zipper Pockets, Elastic Cuffs & Hem, Machine Washable for Spring & Fall Outdoor Activities', '12.50', 'https://img.kwcdn.com/product/fancy/e56dc187-744d-4e35-b0eb-ee6f3a2dfdf4.jpg?imageView2/2/w/800/q/70/format/webp', '2025-03-14 19:04:15', 'main', 'Men', NULL),
(7, 'CHILDREN OVERHEAD HOODIE', 'Go with the fashion:)', '15.00', 'https://www.tradeprint.co.uk/dam/jcr:e64f5c2d-8100-4508-80d9-b24d519b477f/sun-yellow.webp', '2025-02-13 15:25:52', 'main', 'Kids', NULL),
(8, 'SOFT BUTTON COAT', 'Long sleeve coat with a lapel collar. Front button fastening.', '29.99', 'https://static.zara.net/assets/public/0925/3f61/7437446783f8/ee0fc7bbf510/05070660812-e1/05070660812-e1.jpg?ts=1732623094916&w=750', '2025-02-23 22:36:59', 'main', 'Women', NULL),
(9, 'LONG SLEEVE MEN\'S STAND COLLAR STAND', 'Zip Up Business Jacket With Zipper Pockets for Spring Autumn', '12.65', 'https://img.kwcdn.com/product/fancy/a5cd9476-4ef0-4a2a-907f-880f14f69576.jpg?imageView2/2/w/800/q/70/format/webp', '2025-03-14 19:10:23', 'main', 'Men', NULL),
(10, 'WOOL DOUBLE-BREASTED COAT', 'Wool coat. Lapel collar and long sleeves with pronounced shoulders. Front welt pockets. Double-breasted button fastening.', '70.00', 'https://static.zara.net/assets/public/6b6a/8f0d/cef641399136/1c6e9600462d/09340147800-e1/09340147800-e1.jpg?ts=1728653112732&w=750', '2025-02-23 22:43:13', 'main', 'Women', NULL),
(11, 'TAILORED WOOL BLEND COAT ZW COLLECTION', 'Tailored coat made of a wool blend. Notched lapel collar and long sleeves. Front flap pockets and welt breast pocket. Matching lining. Front button fastening.', '120.99', 'https://static.zara.net/assets/public/7e82/4b9b/70334c3893ad/aa116c815a82/02211806615-e1/02211806615-e1.jpg?ts=1736442418732&w=1920', '2025-02-23 22:41:57', 'main', 'Women', NULL),
(12, 'LONG SLEEVE LIGHTWEIGHT POLYESTER JACKET', 'Casual Zip-Up with Multiple Pockets, Drawstring Hood, Stand Collar - Ideal for Spring Outdoor Activities, Trendy Baseball Jacket, Functional Outerwear', '17.00', 'https://img.kwcdn.com/product/Fancyalgo/VirtualModelMatting/43ae3c95ae19e53962fa43bd00a47fe7.jpg?imageView2/2/w/800/q/70/format/webp', '2025-03-14 18:58:24', 'main', 'Men', NULL),
(13, 'MEN\'S TRENDY COLOR BLOCK ZIP UP HOODED JACKET', 'Zippered Pockets, Coat, Spring Fall', '16.00', 'https://img.kwcdn.com/product/fancy/cd00197c-7518-4503-adcd-b99a11f746c3.jpg?imageView2/2/w/800/q/70/format/webp', '2025-03-14 19:04:15', 'main', 'Men', NULL),
(14, 'SPORTY JACKET\r\n', 'Hooded jacket with long sleeves and cuffed finishes. Zip-up front. Front pockets with heat-sealed zip fastening and a raised slogan print on the chest.', '13.67', 'https://static.zara.net/assets/public/8b94/d318/5ac148b9886b/0faf68095e86/04729669982-e1/04729669982-e1.jpg?ts=1738581022662&w=1024', '2025-03-14 19:10:23', 'main', 'Kids', NULL),
(15, 'PUFFER GILET', 'Sleeveless gilet with a high neck. Zip-up front. Front welt pockets with zip fastening. Elasticated hem.', '27.99', 'https://static.zara.net/assets/public/1c53/41b8/ef7e44febca9/63c5844f5c33/04323763600-e1/04323763600-e1.jpg?ts=1738256287074&w=1126', '2025-03-14 19:13:53', 'main', 'Kids', NULL),
(16, 'PURE COTTON CABLE KNIT ROLL NECK JUMPER', 'Create an effortlessly laidback look with this slouchy jumper by Superdry. It\'s made from soft pure cotton to an easy relaxed fit, with a cosy roll neck and chunky ribbed trims. The cable-knit detailing provides texture, while an embroidered badge on the sleeve adds a signature finishing touch.', '49.99', 'https://assets.digitalcontent.marksandspencer.app/images/w_1024,q_auto,f_auto/MS_10_T08_4389_Y0_X_EC_90/Pure-Cotton-Cable-Knit-Roll-Neck-Jumper', '2025-03-14 19:25:47', 'main', 'Women', NULL),
(17, 'SINGLE BREASTED BLAZER', 'This single-blazer is a versatile piece for work or weekend looks. It’s cut to a regular fit, with two tortoiseshell button fastenings, plus added stretch for comfortable wear. The design includes two front flap pockets and a chest pocket for your essentials, plus a back vent for easy movement.', '69.00', 'https://assets.digitalcontent.marksandspencer.app/images/w_1024,q_auto,f_auto/SD_01_T59_6281J_NZ_X_EC_90/Single-Breasted-Blazer', '2025-03-14 19:28:52', 'main', 'Women', ''),
(18, 'FAUX LEATHER BIKER JACKET \r\n', 'This jacket is crafted from supple faux leather for a contemporary biker look. It\'s cut in a boxy regular fit, with epaulettes and an off-centre zip adding authentic styling. Poppers fasten the collar and waistband, while two zipped pockets provide a secure space for your belongings. ', '49.00', 'https://assets.digitalcontent.marksandspencer.app/images/w_1024,q_auto,f_auto/SD_01_T49_5072_ZS_X_EC_90/Faux-Leather-Biker-Jacket', '2025-03-14 19:32:00', 'main', 'Women', NULL),
(19, 'COTTON RICH DENIM JACKET WITH STRETCH\r\n', 'A fresh take on an essential, this jacket is made from cotton-rich denim with a touch of flexible stretch. It\'s cut to a regular fit with an authentic collared neckline and button-through front Pockets on the front and inside provide handy space for essentials.', '44.99', 'https://assets.digitalcontent.marksandspencer.app/images/w_1024,q_auto,f_auto/SD_01_T49_6232_FD_X_EC_90/Cotton-Rich-Denim-Jacket-with-Stretch', '2025-03-14 19:34:34', 'main', 'Women', NULL),
(20, 'TWEED CHECKED FRINGED JACKET', 'This tweed jacket is a fresh take on the timeless boucle style. It\'s designed in a regular fit, with a neat round neckline and contrast buttons through the front. Patch pockets are a traditional touch, while the fringed trims add sophisticated texture and contemporary detail.', '70.00', 'https://assets.digitalcontent.marksandspencer.app/images/w_1024,q_auto,f_auto/SD_01_T59_4958J_F4_X_EC_90/Tweed-Checked-Fringed-Jacket', '2025-03-14 19:37:43', 'main', 'Women', NULL),
(21, 'RED DENIM JACKET', 'This cotton-rich denim jacket from FatFace is a must-have for casual layering. It\'s made in an easy regular fit with a touch of stretch for flexibility. The collared neckline and button-through front create a timeless look, while pockets on the side and chest add to the authenticity.', '60.00', 'https://assets.digitalcontent.marksandspencer.app/images/w_1024,q_auto,f_auto/SD_10_T83_1648D_B0_X_EC_90/Denim-Jacket', '2025-03-14 19:42:51', 'main', 'Women', NULL),
(22, 'COTTON RICH OVERSIZED UTILITY JACKET \r\n', 'This cotton-rich jacket from Hush is an effortlessly stylish choice for off-duty days. It\'s made in an oversized fit for a casual silhouette. The utility-inspired design features a smart collar and patch pockets on the chest and hips. A button-through front and buttoned cuffs complete the look.', '45.00', 'https://assets.digitalcontent.marksandspencer.app/images/w_1024,q_auto,f_auto/MS_10_T83_9544E_KH_X_EC_90/Cotton-Rich-Oversized-Utility-Jacket', '2025-03-14 19:44:42', 'main', 'Women', NULL),
(23, 'PETITE COTTON RICH DOUBLE BREASTED TRENCH COAT', 'Brave cooler days in this cotton-rich, longline trench coat. This double breasted piece is tailored in a regular fit with neat button fastenings. A detachable belt cinches you in at the waist, while side pockets conveniently store essentials. Plus, this Stormwear piece is made with an innovative finish to protect from light rain showers.', '80.00', 'https://assets.digitalcontent.marksandspencer.app/images/w_1024,q_auto,f_auto/SD_01_T59_3455P_Y0_X_EC_90/Petite-Cotton-Rich-Double-Breasted-Trench-Coat', '2025-03-14 19:47:07', 'main', 'Women', NULL),
(24, 'DENIM DAISY EMBROIDERED BOMBER', 'This long-sleeved denim bomber is a great choice for casual days. It\'s designed in a regular fit, with a round neckline and a button-through front. Pretty embroidered daisies add a floral flourish. This jacket has two patch pockets on the front for a practical finish.', '22.00', 'https://assets.digitalcontent.marksandspencer.app/images/w_1024,q_auto,f_auto/SD_04_T77_1017T_HP_X_EC_90/Denim-Daisy-Embroidered-Bomber-2-8-Yrs-', '2025-03-14 19:49:56', 'main', 'Kids', NULL),
(25, 'WATERPROOF LIGHTWEIGHT HOODED COAT ', 'This kids\' shell coat from Polarn O. Pyret is made from durable fabric that\'s both waterproof and windproof to protect them from the elements. It\'s made in a regular fit, with fully taped seams and a zip-through fastening. A mesh lining ensures breathability. The design is complete with zipped pockets, adjustable cuffs on the long sleeves and a detachable hood for versatility.', '80.00', 'https://assets.digitalcontent.marksandspencer.app/images/w_1024,q_auto,f_auto/MS_10_T94_8789_J1_X_EC_90/Waterproof-Lightweight-Hooded-Coat-9-Mths-10-Yrs-', '2025-03-14 19:55:36', 'main', 'Kids', NULL),
(26, 'ANIMAL RAINY DAY HOODED SPOTTED RAINCOAT ', 'Keep your youngster dry on wet days in this Animal Rainy Day raincoat from Regatta. Cut in a regular fit, it has a hood and a front zip fastening tucked behind a riptape-fastened storm flap. The all-over spot print is complemented by a friendly cheetah face on the chest. Pockets at the hips provide storage, while a fleece lining keeps them snug.\r\n\r\n', '34.09', 'https://assets.digitalcontent.marksandspencer.app/images/w_1024,q_auto,f_auto/SD_10_T08_6515_G0_X_EC_90/Animal-Rainy-Day-Hooded-Spotted-Raincoat-6-Mths-6-Yrs-', '2025-03-14 19:58:22', 'main', 'Kids', NULL),
(27, 'WOOL BLEND CHECKED COAT', 'This wool-blend checked coat from Reiss will add a stylish note to their outerwear. It\'s made in a regular fit to a double breasted design with chunky buttons and a matching fabric belt. A peak lapel collar offers a smart touch.\r\n\r\n', '140.00', 'https://assets.digitalcontent.marksandspencer.app/images/w_1024,q_auto,f_auto/MS_10_T19_9403_N0_X_EC_90/Wool-Blend-Checked-Coat-4-14-Yrs-', '2025-03-14 20:00:21', 'main', 'Kids', NULL),
(28, 'HOODED PADDED HORSE PRINT COAT', 'This horse print coat from Joules is sure to delight young pony fans. The warm, padded piece is made in a regular fit, with a zip fastening and two poppers at the fleece-lined hooded neckline. A showerproof finish will ward off raindrops, while three pockets will house kids\' essentials.\r\n\r\n', '50.00', 'https://assets.digitalcontent.marksandspencer.app/images/w_1024,q_auto,f_auto/MS_10_T94_9372_F4_X_EC_0/Hooded-Padded-Horse-Print-Coat-2-11-Yrs-', '2025-03-14 20:05:57', 'main', 'Kids', NULL),
(29, 'FAUX FUR COAT WITH WOOL', 'Keep kids super snug with this stylish faux fur coat from Reiss, made with a touch of wool for a luxurious feel. This winter warmer features oversized lapels, a double-breasted button closure and a smooth lining. Side pockets are perfect for keeping their hands cosy.\r\n\r\n', '150.00', 'https://assets.digitalcontent.marksandspencer.app/images/w_1024,q_auto,f_auto/MS_10_T19_9847_N0_X_EC_90/Faux-Fur-Coat-with-Wool-4-14-Yrs-', '2025-03-14 20:09:17', 'main', 'Kids', NULL),
(30, 'HEART PRINT BORG JACKET ', 'Keep them cosy on wintery outings in this insulating borg jacket. It\'s made in a comfy regular fit, with a stand-up collar and a practical half-zip fastening. The all-over heart print ensures a playful look, while the kangaroo pocket is handy for keeping hands toasty.\r\n\r\n', '20.00', 'https://assets.digitalcontent.marksandspencer.app/images/w_1024,q_auto,f_auto/SD_04_T77_1060E_Y0_X_EC_90/Heart-Print-Borg-Jacket-12-Mths-8-Yrs-', '2025-03-14 20:12:50', 'main', 'Kids', NULL),
(31, 'UNICORN PRINT HOODED COAT', 'With its whimsical unicorn print, this Monsoon coat brings a touch of magic to outdoor adventures. It\'s made in a regular fit, with a zip-up front and an elasticated belt at the waist. Stretchy cuffs and a snug hood help keep the heat in, while a faux fur collar adds a cosy finish.\r\n\r\n', '38.99', 'https://assets.digitalcontent.marksandspencer.app/images/w_1024,q_auto,f_auto/MS_10_T94_8909_F4_X_EC_2/Unicorn-Print-Hooded-Coat-3-15-Yrs-', '2025-03-14 20:15:05', 'main', 'Kids', NULL),
(32, 'STORMWEAR DISNEY FROZEN PADDED COAT', 'Little fans of Disney Frozen will love this mid-weight padded coat. It\'s designed in a regular fit, with a snug hood and practical zip fastening. The cosy borg lining keeps them warm, while the water-repellent Stormwear finish helps to keep them dry. Anna and Elsa are silhouetted against a snowscape, over an ombre background with silvery stars and snowflakes.', '32.00', 'https://assets.digitalcontent.marksandspencer.app/images/w_1024,q_auto,f_auto/SD_04_T77_5401W_E4_X_EC_90/Stormwear-Disney-Frozen-Padded-Coat-2-8-Yrs-', '2025-03-14 20:17:21', 'main', 'Kids', NULL),
(33, 'PRISM GUIDE INTERACTIVE ZIP UP FLEECE', 'This zip-up fleece jacket from Berghaus is a versatile mid-layer for your outdoor wardrobe. It\'s made in a regular fit from warm Polartec fabric, with a funnel neck and contrast overlay panels across the chest for increased durability. The hem has adjustable toggles to lock in warmth, while four zipped pockets offer plenty of space for your on-the-go essentials.\r\n\r\n', '85.00', 'https://assets.digitalcontent.marksandspencer.app/images/w_1024,q_auto,f_auto/MS_10_T12_8114T_J0_X_EC_90/Prism-Guide-InterActive-Zip-Up-Fleece', '2025-03-14 20:20:44', 'main', 'Men', NULL),
(34, 'MEN\'S DENIM JACKET', 'With its sharp angular collar, this stylish denim jacket showcases a new take on a timeless design classic. It\'s made in a roomy regular fit from soft yet durable pure cotton. The smooth lining ensures extra comfort and easy wear. Two patch pockets on the chest, one detailed with a pair of rivets, help keep your essentials easy to reach. The hanging loop adds the finishing touch of tailoring class to this must-have piece. ', '50.00', 'https://assets.digitalcontent.marksandspencer.app/images/w_1024,q_auto,f_auto/SD_03_T16_5061M_O4_X_EC_90/Denim-Jacket', '2025-03-14 20:29:44', 'main', 'Men', NULL),
(35, 'WANDERMOOR WIND SMOCK HOODED JACKET ', 'Stay protected from the elements during outdoor adventures in this jacket from Berghaus. It\'s made in a neat regular fit, with a hood for coverage and an insulating funnel neckline. Four-way stretch ensures easy movement. The outer is wind-resistant to shut out draughts and has a water-repellent DWR coating that keeps off raindrops. A half-zip fastening at the front lets you wear it your way.\r\n\r\n', '95.00', 'https://assets.digitalcontent.marksandspencer.app/images/w_1024,q_auto,f_auto/MS_10_T12_8110T_J1_X_EC_90/Wandermoor-Wind-Smock-Hooded-Jacket', '2025-03-14 20:33:03', 'main', 'Men', NULL),
(36, 'COLOUR BLOCK HOODED JACKET \r\n', 'Shield yourself from inclement weather with this practical jacket from FatFace. It\'s made in a regular fit, with a generous drawstring hood and a zip-through fastening. The lightweight style features a mesh lining and two front pockets to keep your essentials handy. A colour block design completes this stylish piece.\r\n\r\n', '79.00', 'https://assets.digitalcontent.marksandspencer.app/images/w_1024,q_auto,f_auto/MS_10_T19_1550_KA_X_EC_90/Colour-Block-Hooded-Jacket', '2025-03-14 20:34:50', 'main', 'Men', NULL),
(37, 'UTILITY JACKET \r\n', 'This Hackett utility jacket is a smart choice for casual days. It\'s made in a smart tailored fit with a popper and zip fastening that goes all the way to the top of the neckline for extra cosiness. Four flap pockets at the front add to its authentic look.\r\n\r\n', '257.00', 'https://assets.digitalcontent.marksandspencer.app/images/w_1024,q_auto,f_auto/MS_10_T18_8124_VS_X_EC_90/Utility-Jacket', '2025-03-14 20:38:59', 'main', 'Men', NULL),
(38, 'COTTON RICH CANVAS HARRINGTON JACKET \r\n', 'A modern take on an old-school classic, this cotton-rich canvas Harrington jacket is the perfect between-seasons layer. It\'s made in an easy regular fit from durable fabric for a rugged look, but has smooth lining for your comfort. The polished metal zip fastening and button-up cuffs keep it securely fastened, and you snug.', '65.00', 'https://assets.digitalcontent.marksandspencer.app/images/w_1024,q_auto,f_auto/SD_03_T16_5049M_BE_X_EC_90/Cotton-Rich-Canvas-Harrington-Jacket', '2025-03-14 20:45:07', 'main', 'Men', NULL),
(39, 'BOMBER JACKET WITH STORMWEAR ', 'This bomber jacket crafted from smooth, lightweight fabric is an ultra-contemporary and understated essential for the modern gent. It\'s made in a roomy regular fit so layering up is easy. It\'s also smoothly lined for extra comfort. You can choose your favourite look with the funnel neck, which also helps to retain body heat. Our water-repellent Stormwear finish ensures you stay dry in light rain showers. Two external zipped pockets store your essentials and valuables safely and accessibly. The concealed zip and popper fastening keeps the elements at bay. \r\n\r\n', '65.00', 'https://assets.digitalcontent.marksandspencer.app/images/w_1024,q_auto,f_auto/SD_03_T16_5045M_KE_X_EC_90/Bomber-Jacket-with-Stormwear-', '2025-03-14 20:49:35', 'main', 'Men', NULL),
(40, 'BOXY MAC JACKET \r\n', 'A boxy mac jacket with button-front closure and belted sleeves\r\n', '26.00', 'https://cdn.media.amplience.net/i/primark/991129361112_05?$articleimages-regulardesktop$&fmt=auto', '2025-03-14 21:02:50', 'main', 'Women', NULL),
(41, 'DOUBLE-BREASTED BELTED MAC\r\n', 'A tie-belt mac coat with a lapel collar, button fastenings and slip pockets\r\n', '34.00', 'https://cdn.media.amplience.net/i/primark/991120271414_05?$articleimages-regulardesktop$&fmt=auto', '2025-03-14 21:06:55', 'main', 'Women', NULL),
(42, 'PINK/ORANGE COLLARLESS TEXTURED BOUCLE JACKET\r\n', 'This jacket has a soft boucle textured fabric with a collarless design, a button-up fastening and button pockets, finished with four flap pockets and cut to a regular fit.\r\n\r\n', '62.99', 'https://xcdn.next.co.uk/common/items/default/default/itemimages/3_4Ratio/product/lge/AA9406s7.jpg?im=Resize,width=480', '2025-03-14 21:13:08', 'main', 'Women', NULL),
(43, 'TIE-BELT DENIM JACKET', 'Jacket in rigid cotton denim with a collar, buttons down the front and a yoke at the back. Dropped shoulders, flap chest pockets with a button, open front pockets and a wide, detachable tie belt at the waist. Single back vent.\r\n\r\n', '37.99', 'https://image.hm.com/assets/hm/68/b6/68b62a072475c0d058ded74f7c905c851cb21ccf.jpg?imwidth=2160', '2025-03-14 21:18:16', 'main', 'Women', NULL),
(44, 'SINGLE-BREASTED DARK BEIGE BLAZER', 'Single-breasted blazer with notch lapels and a yoke at the front and back. Buttons down the front and jetted front pockets with a flap. Twill lining.', '49.99', 'https://image.hm.com/assets/hm/99/70/9970bcd5f9867bd643788af5366e64013ef4a62c.jpg?imwidth=2160', '2025-03-14 21:20:20', 'main', 'Women', NULL),
(45, 'QUILTED DENIM JACKET', 'Short, fitted, lightly padded jacket in quilted denim with a frill-trimmed collar and an open front with two pairs of narrow ties. Lined.\r\n\r\n', '39.99', 'https://image.hm.com/assets/hm/18/50/18500669d7c9a65a4a7c1150a7416666e6bcfc20.jpg?imwidth=2160', '2025-03-14 21:22:25', 'main', 'Women', NULL),
(46, 'CHEETAH KNITTED JACKET', 'Jacket in a fine knit with a brushed finish. Round neckline, concealed press-studs down the front and patch front pockets. Shoulder pads and long sleeves. Jersey lining.\r\n', '32.99', 'https://image.hm.com/assets/hm/9b/1a/9b1a87505e3f65da54ae8d11a9e76132b66ffa57.jpg?imwidth=1260', '2025-03-14 22:46:52', 'main', 'Women', NULL),
(47, 'KNITTED JACKET', 'Jacket in a fine knit with a brushed finish. Round neckline, concealed press-studs down the front and patch front pockets. Shoulder pads and long sleeves. Jersey lining.\r\n\r\n', '32.99', 'https://image.hm.com/assets/hm/9b/9e/9b9e786b35b9cdba917a7c75e12d4275feedb29c.jpg?imwidth=1260', '2025-03-14 22:49:23', 'main', 'Women', NULL),
(48, 'CREAM DENIM JACKET', 'Trucker-style jacket in rigid cotton denim with a collar, metal buttons down the front, forward-facing shoulder seams and a yoke at the front and back. Dropped shoulders, buttoned cuffs, flap chest pockets with a button, and welt front pockets.\r\n\r\n', '34.99', 'https://image.hm.com/assets/hm/df/c7/dfc720bca729526fa02cb9f2c3e377253827bd80.jpg?imwidth=2160', '2025-03-14 22:53:00', 'main', 'Women', NULL),
(49, 'OVERSIZED SHACKET', 'Oversized shacket in a soft weave with a collar, metal buttons down the front and flap chest pockets with a button. Gently dropped shoulders and long sleeves with buttoned cuffs. Unlined.', '34.99', 'https://image.hm.com/assets/hm/73/a8/73a806c435b988c530278a2171497f4a456853c0.jpg?imwidth=2160', '2025-03-14 22:56:46', 'main', 'Women', NULL),
(50, 'CORDUROY-COLLAR DENIM JACKET', 'Jacket in sturdy cotton denim with a corduroy collar and buttons down the front. Loose fit with patch chest and front pockets, gently dropped shoulders and buttoned cuffs. Unlined.\r\n\r\n', '44.99', 'https://image.hm.com/assets/hm/ae/02/ae02eac575cd0c38dd1f5c798581c778911bd62b.jpg?imwidth=1260', '2025-03-14 22:58:27', 'main', 'Women', NULL),
(51, 'PUFFER JACKET ', 'Quilted puffer jacket in nylon with a detachable hood and stand-up collar. Zip and wind flap with press-studs down the front and ribbed inner cuffs. Drawstring waist and zip front pockets. Lined.\r\n\r\n', '23.00', 'https://image.hm.com/assets/hm/86/b3/86b3edc5e69dff4c37461e771eac58c5f838d78a.jpg?imwidth=1260', '2025-03-14 23:01:47', 'main', 'Kids', NULL),
(52, 'PEA COAT', 'Double-breasted pea coat in woven fabric with a collar, notch lapels and buttons at the front. Welt front pockets and a tab with a button at the cuffs. Lined.\r\n\r\n', '29.99', 'https://image.hm.com/assets/hm/4c/b6/4cb67314d77bf3166094f488d2e8c714e79477bb.jpg?imwidth=1260', '2025-03-14 23:04:04', 'main', 'Kids', NULL),
(53, 'POINTELLE-KNIT CROPPED TOP', 'Cropped top in an airy pointelle knit with a round, ribbed neckline and long sleeves. Ribbed, scalloped edges at the cuffs and hem.\r\n\r\n', '12.99', 'https://image.hm.com/assets/hm/cf/b7/cfb7c6911f9aee5f74762a797e7fb8c9c7511cc1.jpg?imwidth=1260', '2025-03-14 23:07:00', 'main', 'Kids', NULL),
(54, 'OVERSIZED ONE-SHOULDER SWEATSHIRT', 'Oversized one-shoulder top in printed sweatshirt fabric with a soft brushed inside. Raw-edge trim at the neckline, dropped shoulders and long sleeves. Ribbing at the cuffs and hem.\r\n\r\n', '14.99', 'https://image.hm.com/assets/hm/2e/2e/2e2ee2f16c07292efc8e2eeb66a06d370190e434.jpg?imwidth=1260', '2025-03-14 23:09:30', 'main', 'Kids', NULL),
(55, 'MOTIF-DETAIL SWEATSHIRT', 'Oversized top in sweatshirt fabric with a soft brushed inside and a motif on the front. Round, rib-trimmed neckline, dropped shoulders, long sleeves and ribbing at the cuffs and hem.\r\n\r\n', '14.99', 'https://image.hm.com/assets/hm/37/4b/374ba47380bdc82734f7d4ca90c7857ae562e401.jpg?imwidth=1260', '2025-03-14 23:11:35', 'main', 'Kids', NULL),
(56, 'LIGHT/TURQUOISE INSPIRE SWEATSHIRT', 'Oversized top in sweatshirt fabric with a soft brushed inside and a motif on the front. Round, rib-trimmed neckline, dropped shoulders, long sleeves and ribbing at the cuffs and hem.\r\n\r\n', '15.00', 'https://image.hm.com/assets/hm/4a/b2/4ab28bb2e5e9215788480aa8da944a348610ce9e.jpg?imwidth=1260', '2025-03-14 23:16:07', 'main', 'Kids', NULL),
(57, 'BLACK/SILVER HEART SWEATSHIRT', 'Oversized top in sweatshirt fabric with a soft brushed inside and a motif on the front. Round, rib-trimmed neckline, dropped shoulders, long sleeves and ribbing at the cuffs and hem.\r\n\r\n', '14.99', 'https://image.hm.com/assets/hm/0d/19/0d191b7fb2892e62e489cdfb775d198faed082af.jpg?imwidth=1260', '2025-03-14 23:16:07', 'main', 'Kids', NULL),
(58, 'FRILL-TRIM JUMPER', 'Short jumper in a soft fine-knit with a cable-knit yoke at the front and frill trims. Round, ribbed neckline and long sleeves with ribbed cuffs.\r\n\r\n', '17.99', 'https://image.hm.com/assets/hm/34/d7/34d7d2394aff31caaa35bf5847b497fc62520a77.jpg?imwidth=1260', '2025-03-14 23:18:19', 'main', 'Kids', NULL),
(59, 'EMBELLISHED FINE-KNIT CARDIGAN ', 'Short cardigan in a soft, fine knit embellished with beads on the front. Round, rib-trimmed neckline, spherical buttons down the front and short sleeves. Ribbing at the cuffs and hem.\r\n\r\n', '24.99', 'https://image.hm.com/assets/hm/79/37/7937a07ab81f1559817659685d3c71ebd07a8fb1.jpg?imwidth=1260', '2025-03-14 23:20:32', 'main', 'Kids', NULL),
(60, 'EMBROIDERED-MOTIF SWEATSHIRT', 'A fun-loving and colourful collection with cosy styles, sweet prints and playful accessories. Discover the world of Hello Kitty and all our fuzzy favourites! Top in sweatshirt fabric with a soft brushed inside and an embroidered motif on the front. Round, rib-trimmed neckline, low dropped shoulders and long sleeves. Ribbing at the cuffs and hem.', '14.99', 'https://image.hm.com/assets/hm/d0/6e/d06e08578f957ba69159367a6e1f7145fe2d6bdb.jpg?imwidth=1260', '2025-03-14 23:24:09', 'main', 'Kids', NULL),
(61, 'LOOSE FIT PRINTED HOODIE', 'Hoodie in heavyweight sweatshirt fabric made from a cotton blend with a soft brushed inside and a print motif. Double-layered hood, dropped shoulders and long sleeves. Kangaroo pocket and ribbing at the cuffs and hem. Loose fit for a generous but not oversized silhouette.\r\n\r\n', '21.00', 'https://image.hm.com/assets/hm/b7/c1/b7c142b1673d3facd6dd96f21151db6559565508.jpg?imwidth=1260', '2025-03-14 23:26:39', 'main', 'Men', NULL),
(62, 'OVERSIZED FIT PRINTED HOODIE', 'Hoodie in midweight sweatshirt fabric made from a cotton blend with a soft brushed inside and print motifs. Double-layered wrapover hood, low dropped shoulders, long sleeves, a kangaroo pocket and ribbing at the cuffs and hem. Oversized fit for a baggy, extra-loose silhouette.\r\n\r\n', '37.99', 'https://image.hm.com/assets/hm/01/31/01315f5d97b10536c56ba108dfb9e332a2c6a294.jpg?imwidth=1260', '2025-03-14 23:29:47', 'main', 'Men', NULL),
(63, 'REGULAR FIT TRENCH COAT', 'Knee-length trench coat in woven fabric made from a cotton blend featuring notch lapels, buttons at the front and a detachable belt at the waist. Long sleeves with an adjustable tab at the cuffs, welt side pockets, two inner pockets and a single back vent. Regular fit for comfortable wear and a classic silhouette. Lined.\r\n\r\n', '74.99', 'https://image.hm.com/assets/hm/72/ed/72ed78d7cac9e9ff5ef0f0aab02199c89c4c8bef.jpg?imwidth=1260', '2025-03-14 23:35:26', 'main', 'Men', NULL),
(64, 'SLIM FIT LIGHTWEIGHT PUFFER JACKET', 'Lightweight puffer jacket in windproof, water-repellent quilted nylon with a stand-up collar and a zip down the front with an anti-chafe chin guard. Long sleeves and pockets in the side seams with a concealed zip. Slim fit that hugs the contours of your body, creating a fitted silhouette. Unlined.\r\n\r\n', '37.99', 'https://image.hm.com/assets/hm/b8/65/b86554923f1a202be71448c690ea39e4b033db57.jpg?imwidth=1260', '2025-03-14 23:38:15', 'main', 'Men', NULL),
(65, 'REGULAR FIT TWILL JACKET', 'Jacket in twill with a collar, zip down the front, diagonal welt pockets on the front and an inner pocket. Covered elastication at the cuffs and hem. Regular fit for comfortable wear and a classic silhouette. Lined.\r\n\r\n', '45.00', 'https://image.hm.com/assets/hm/6a/65/6a65e0e7a2f3c99d286aac8036f9f2f7187e3468.jpg?imwidth=1260', '2025-03-14 23:41:14', 'main', 'Men', NULL),
(66, 'LOOSE FIT PADDED UTILITY JACKET', 'Utility jacket in cotton denim with a washed look featuring a corduroy collar. Zip down the front, a yoke at the back and adjustable press-studs at the cuffs and sides of the hem. Patch chest and front pockets and an inner pocket with a concealed press-stud. Loose fit for a generous but not oversized silhouette. Quilted lining.\r\n\r\n', '54.99', 'https://image.hm.com/assets/hm/b4/5d/b45d1c9b385aaf41d165eadc2cc9ccd07ab372df.jpg?imwidth=1260', '2025-03-14 23:43:56', 'main', 'Men', NULL),
(67, 'REGULAR FIT MID LAYER JACKET WITH DRYMOVE ', 'Jacket in stretchy functional fleece made with DryMove™, which helps pull moisture away from your skin, keeping you comfortably dry while moving. Regular fit with a drawstring hood and a zip down the front with an anti-chafe chin guard. Long sleeves, a diagonal zipped chest pocket and zipped side pockets for safe storage of valuables. Elasticated bindings at the cuffs and hem. The jacket can be worn as it is or as an insulating mid layer.\r\n\r\n', '44.99', 'https://image.hm.com/assets/hm/9a/ec/9aecf2678803c58486e21ce3c29dec8eca149a6c.jpg?imwidth=1260', '2025-03-14 23:46:50', 'main', 'Men', NULL);

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
(23, 1, 29, 4, 'best', '2025-02-25 21:02:00'),
(24, 2, 50, 3, '  jj', '2025-03-10 19:34:02'),
(25, 2, 49, 4, 'best hoodie', '2025-03-10 21:28:06'),
(26, 40, 50, 4, 'nn', '2025-03-16 19:44:04'),
(27, 1, 50, 4, 'jj', '2025-03-16 19:50:09');

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
(25, 29, 5, 'm,,', '2025-02-23 13:55:00'),
(26, 50, 4, '', '2025-03-10 19:34:22'),
(27, 50, 3, '', '2025-03-10 19:36:50'),
(28, 50, 4, '', '2025-03-10 19:39:20'),
(29, 50, 5, '', '2025-03-10 19:39:34'),
(30, 49, 4, '', '2025-03-10 21:28:29'),
(31, 43, 4, '', '2025-03-11 20:50:03'),
(32, 44, 4, '', '2025-03-16 20:52:45');

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
(43, 'jane23', 'jane', '$2y$10$3eCqX2s50ePfG5xR3dx4FesOy2nC7vhI8FEPEgRn9Z/3RK15vBnUe', 'jane23@www.hhh', '1741170308_67c826287b245-pf.jpeg', 0, '2025-03-05 10:23:36', 'jane23@www.hhh', '$2y$10$Ufvj3qBWnSGIst96mWpyVe6xYei8MFCcKnn0xkBGdYlX9E6rbN0Bi', NULL, NULL),
(44, 'sara12', 'Sarah Williams', '$2y$10$M0D1xq9Vw3W/XpBskIehmOdZ1DgK8HK2aThFjxH3qnSWGQxNV0JPS', 'sara12@www.hhh', '1741447231_pf.jpeg', 0, '2025-03-05 10:57:20', NULL, NULL, NULL, NULL),
(46, 'james_.', 'James', '$2y$10$NwwApfBkCkwWpamvtBEqK..Iy0OqzbzjVN.oFQruTJ9TbDAjkCuH.', 'james@www.hhh', '1741443243_profile pic.avif', 0, '2025-03-05 11:40:42', 'james@www.hhh', '$2y$10$rDjNls/ZmVcD84sxTK0PVe9F6WE/Z256joHBo/GL2IsDmcBpWaZWy', NULL, NULL),
(49, 'robyn_.', 'Robyn Martin', '$2y$10$jbzu6M65T0I3KhnYLGKH8OHm4qFALOGnif2ARsH8Vw5WrAsFYRcxe', 'robyn@gmail.com', '67cc6a7aae43b-pf.jpeg', 0, '2025-03-08 16:04:10', 'robyn@gmail.com', '$2y$10$r9oDyZpug9XB.nFanjUnz.wbyarsbLgsMvOsLAKZh8o/IL58iwd2m', NULL, NULL),
(50, 'Aaron', 'Aaron Haskell', '$2y$10$L52d69fL4UWZbvSzLpEd5ew/NC9z4kaldiI4QZcrCmJirGJz.UeF6', 'aaron45@gmail.com', '1741635673_profile image.png', 0, '2025-03-08 16:29:35', 'aaron45@gmail.com', '$2y$10$PFePMdxo0FmWeBIaSTVvEekM4Okkgmp2Kl/HPd3tyxOGNp1RhbUqq', '896463db2d87411e527c1d08227181a82c734fb7545e3ccf642f48e553bb6bf277bb5ddb39d23ec22bb431822f3bc2c82333', '2025-03-10 22:32:37');

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
(30, 44, 11),
(31, 50, 2),
(32, 50, 4),
(33, 50, 1),
(34, 50, 5);

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
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `search_log`
--
ALTER TABLE `search_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `site_reviews`
--
ALTER TABLE `site_reviews`
  MODIFY `site_review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
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
