-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 26, 2023 at 06:54 AM
-- Server version: 8.0.28
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sanakin_dba`
--

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

DROP TABLE IF EXISTS `complaint`;
CREATE TABLE IF NOT EXISTS `complaint` (
  `com_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `subject` text NOT NULL,
  `description` text,
  `kind_of` varchar(20) NOT NULL,
  `related_id` int NOT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `order_item_item_id` int DEFAULT NULL,
  PRIMARY KEY (`com_id`),
  KEY `fk_complaint_order_item1_idx` (`order_item_item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `complaint`
--

INSERT INTO `complaint` (`com_id`, `user_id`, `subject`, `description`, `kind_of`, `related_id`, `create_time`, `order_item_item_id`) VALUES
(6, 15, '', '', 'Shop', 23, '2023-03-23 16:49:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `inquiry`
--

DROP TABLE IF EXISTS `inquiry`;
CREATE TABLE IF NOT EXISTS `inquiry` (
  `inq_id` int NOT NULL AUTO_INCREMENT,
  `inq_name` varchar(100) NOT NULL,
  `inq_email` varchar(200) NOT NULL,
  `inq_contact` varchar(20) NOT NULL,
  `inq_msg` text NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`inq_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

DROP TABLE IF EXISTS `order_item`;
CREATE TABLE IF NOT EXISTS `order_item` (
  `item_id` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `quntity` int NOT NULL,
  `per_price` double NOT NULL,
  `sub_total` double DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `product_product_id` int NOT NULL,
  `order_order_id` int NOT NULL,
  `confirm_code` varchar(6) DEFAULT NULL,
  `de_status` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`item_id`),
  KEY `fk_order_item_product1_idx` (`product_product_id`),
  KEY `fk_order_item_order1_idx` (`order_order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`item_id`, `product_name`, `quntity`, `per_price`, `sub_total`, `create_time`, `product_product_id`, `order_order_id`, `confirm_code`, `de_status`) VALUES
(14, 'NORMAL JEWELRY', 1, 500, 500, '2023-03-23 18:24:54', 60, 11, NULL, ''),
(15, 'Unisex Clothing (Shorts & T-shirts)', 1, 1000, 1000, '2023-03-23 18:24:54', 41, 11, NULL, ''),
(16, 'Women’s Clothing ( Frocks)', 1, 2290, 2290, '2023-03-23 18:35:51', 40, 12, NULL, ''),
(17, 'Nike T-shirt (Mens)', 1, 2300, 2300, '2023-03-25 02:47:12', 27, 13, NULL, ''),
(19, '120 PGS EXERCISE BOOK', 1, 200, 200, '2023-03-26 01:42:30', 93, 32, NULL, NULL),
(20, 'PENS 3IN ONE', 2, 70, 140, '2023-03-26 01:42:44', 94, 33, NULL, NULL),
(21, 'smart watch 2', 2, 12000, 24000, '2023-03-26 01:44:53', 220, 34, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_request`
--

DROP TABLE IF EXISTS `password_reset_request`;
CREATE TABLE IF NOT EXISTS `password_reset_request` (
  `id_reset` int NOT NULL AUTO_INCREMENT,
  `user_user_id` int NOT NULL,
  `reset_code` text NOT NULL,
  `is_used` tinyint(1) DEFAULT NULL,
  `is_expired` tinyint(1) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_reset`),
  KEY `fk_password_reset_request_user1_idx` (`user_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `password_reset_request`
--

INSERT INTO `password_reset_request` (`id_reset`, `user_user_id`, `reset_code`, `is_used`, `is_expired`, `date_created`, `is_active`) VALUES
(7, 15, '3cd7be17e6d178efa58dc11160ba5ebe434f99bb', 0, 0, '2023-03-22 16:17:25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `quntity` int NOT NULL,
  `per_price` int NOT NULL,
  `description` text,
  `status` varchar(10) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `product_category_cat_id` int NOT NULL,
  `shop_shop_id` int NOT NULL,
  `image_url` text,
  PRIMARY KEY (`product_id`),
  KEY `fk_product_product_category1_idx` (`product_category_cat_id`),
  KEY `fk_product_shop1_idx` (`shop_shop_id`)
) ENGINE=InnoDB AUTO_INCREMENT=221 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `quntity`, `per_price`, `description`, `status`, `is_active`, `create_time`, `product_category_cat_id`, `shop_shop_id`, `image_url`) VALUES
(26, 'Levis T-shirt', 20, 2500, 'Colour- RED\r\nBrand- Levis\r\nAvailable Sizes-XL,Large,Medium,Small\r\n', 'ACTIVE', 1, '2023-03-22 17:23:30', 2, 22, '641b3992c4f7f.jpg'),
(27, 'Nike T-shirt (Mens)', 14, 2300, 'Colour - Black\r\nAvailable Sizes- XL,Large,Medium,Small\r\nBrand - Nike', 'ACTIVE', 1, '2023-03-25 02:47:12', 2, 22, '641b3a911de04.jpg'),
(28, 'Men’s Clothing (T-Shirts)', 10, 2500, 'Brand – Levis\r\nColor – White\r\nSize – S, M, L, XL\r\nMaterial – Cotton & Polyester\r\nIn Stock\r\n', 'ACTIVE', 1, '2023-03-22 17:52:49', 2, 21, '641b40716e283.jpg'),
(29, 'Nike T-shirt(Female)', 10, 2000, 'Colour-Blue \r\nSize-Large,XL,Medium\r\nBrand - Nike', 'ACTIVE', 1, '2023-03-22 18:17:20', 2, 22, '641b4630354e0.jpg'),
(31, 'Shirt (Mens)', 8, 3500, 'LONG Sleve\r\nColour - Grey\r\nSIZES- Large,XL,Medium\r\n', 'ACTIVE', 1, '2023-03-22 18:58:33', 2, 22, '641b4fd98b361.jpg'),
(32, 'Cricket bat', 25, 35000, 'KOKABURA BAT\r\nWHITE GRIPH\r\nENGLISH WILLOW', 'ACTIVE', 1, '2023-03-22 19:52:06', 7, 24, '641b5c66c8b90.jpg'),
(33, 'Gloves(Cricket)', 12, 3500, 'SS cricket gloves\r\nBlue COLOUR', 'ACTIVE', 1, '2023-03-22 20:14:35', 7, 24, '641b61aba5226.jpg'),
(34, 'BALL(CRICKET)', 20, 2500, 'RED BALL\r\n', 'ACTIVE', 1, '2023-03-22 20:15:47', 7, 24, '641b61f33411e.jpg'),
(35, 'FOOTBALL', 15, 8500, 'blue COLOUR\r\nNIKE BRAND', 'ACTIVE', 1, '2023-03-22 20:16:48', 7, 24, '641b623096241.jpg'),
(36, 'bASE BALL BAT', 8, 7500, 'Branded Baseball Bats', 'ACTIVE', 1, '2023-03-22 20:20:14', 7, 24, '641b62fe11ff0.jpg'),
(37, 'Cricket Gloves', 12, 4500, 'Puma Orange coluor Gloves', 'ACTIVE', 1, '2023-03-22 20:21:25', 7, 24, '641b6345e9e9d.jpg'),
(38, 'Cricket Bat', 10, 3500, 'Pro Cricket bat\r\nOrange Colour grip', 'ACTIVE', 1, '2023-03-22 20:23:34', 7, 24, '641b63c685ef2.png'),
(39, 'Men’s Clothing (T-Shirts)', 10, 2000, 'Brand – Nike\r\nColor – Blue, Black\r\nSize – S, M, L, XL\r\nMaterial – 100% Cotton\r\nIn Stock\r\n', 'ACTIVE', 1, '2023-03-23 05:59:17', 2, 21, '641beab57d8b1.jpg'),
(40, 'Women’s Clothing ( Frocks)', 9, 2290, 'Ladies Drop Shoulder T-Shirt\r\nColor – Pink\r\nMaterial - Silk\r\nIn Stock\r\n', 'ACTIVE', 1, '2023-03-23 18:35:51', 2, 21, '641beb1e09ffa.jpg'),
(41, 'Unisex Clothing (Shorts & T-shirts)', 14, 1000, 'Brand – Tommy Hilfiger\r\nColour – Red\r\nSize – S, M, L, XL\r\nMaterial – SUSTAINABLE MODAL (76%), COTTON (18%), ELASTANE (6%)\r\nIn Stock\r\n', 'ACTIVE', 1, '2023-03-23 18:24:54', 2, 21, '641bebc14109a.png'),
(42, 'Unisex Clothing (T-shirts)', 20, 1645, 'Brand – Roadster\r\nColor – Black\r\nSize – S, M, L, XL\r\nMaterial – Cotton\r\nIn Stock\r\n', 'ACTIVE', 1, '2023-03-23 06:23:47', 2, 21, '641bf0730e24b.jpg'),
(43, 'cricket bat', 20, 45000, 'Puma cricket bat\r\nWhite & blue grip', 'ACTIVE', 1, '2023-03-23 14:52:38', 7, 24, '641c67b61cf85.jpg'),
(44, 'cricket pads', 12, 5500, 'yellow colour\r\nbrand - SM', 'ACTIVE', 1, '2023-03-23 15:14:21', 7, 24, '641c6ccd47a96.png'),
(45, 'cricket pads', 10, 2500, 'white batting pads\r\n', 'ACTIVE', 0, '2023-03-23 15:25:07', 7, 24, '641c6f40026dd.jpg'),
(46, 'cricket pads', 10, 2500, 'white batting pads\r\n', 'ACTIVE', 0, '2023-03-23 15:25:16', 7, 24, '641c6f40078ee.jpg'),
(47, 'cricket pads', 10, 2500, 'white batting pads\r\n', 'ACTIVE', 1, '2023-03-23 15:24:48', 7, 24, '641c6f403633f.jpg'),
(48, 'Foot ball', 25, 4500, 'Green  colour \r\n', 'ACTIVE', 1, '2023-03-23 15:26:45', 7, 24, '641c6fb5924a0.jpg'),
(49, 'sports shoes', 25, 15500, 'puma shoes\r\n(cricket)', 'ACTIVE', 1, '2023-03-23 15:27:54', 7, 24, '641c6ffa18929.jpg'),
(50, 'Base ball jersy', 20, 1850, 'new york club jersey', 'ACTIVE', 1, '2023-03-23 15:38:15', 7, 24, '641c7267a7d66.jpg'),
(51, 'Basket ball', 15, 5500, 'colour-orange\r\nbrand-bxm', 'ACTIVE', 1, '2023-03-23 15:41:13', 7, 24, '641c73192a126.jpg'),
(52, 'Volley ball', 12, 4200, 'Yellow & blue colour\r\nbrand -mikasa', 'ACTIVE', 1, '2023-03-23 15:42:12', 7, 24, '641c735403a31.jpg'),
(53, 'Sports shoe', 10, 10500, 'puma red colour shoe', 'ACTIVE', 1, '2023-03-23 15:47:09', 7, 24, '641c747d36170.jpg'),
(54, 'Bathik shirts', 90, 1500, 'Various colours\r\nFor kids and men\r\nSizes -xl,large,medium,small', 'ACTIVE', 1, '2023-03-23 15:57:51', 5, 22, '641c76ffcc63e.jpeg'),
(55, 'Gold Plated chain', 20, 10000, 'Gold plated chain\r\nFor both men & women', 'ACTIVE', 1, '2023-03-23 17:15:22', 9, 26, '641c892a34673.jpg'),
(56, 'wedding Chain', 35, 150000, 'Gold  chain\r\n24 carrot\r\nFor women', 'ACTIVE', 1, '2023-03-23 17:35:52', 9, 26, '641c8df8a9205.jpg'),
(57, 'wedding jwelery', 15, 75000, 'Wedding chain for women ', 'ACTIVE', 1, '2023-03-23 17:43:38', 9, 26, '641c8fca5e32b.jpg'),
(58, 'Fashion JEWELRY', 8, 1850, 'Women normal jewelry', 'ACTIVE', 1, '2023-03-23 17:51:57', 9, 26, '641c91bd90ce0.jpg'),
(59, 'WEDDING JEWELRY', 6, 250000, 'Weeding jewelry for bride\r\nChain with ear rings \r\nGold\r\ndesigned', 'ACTIVE', 1, '2023-03-23 17:54:51', 9, 26, '641c926b27099.jpg'),
(60, 'NORMAL JEWELRY', 29, 500, 'SRI LANKAN MADE NORMAL JEWELRY', 'ACTIVE', 1, '2023-03-23 18:24:54', 5, 26, '641c936a80d4c.jpg'),
(61, 'WRING (WOMEN)', 20, 2850, 'Normal wring for women', 'ACTIVE', 1, '2023-03-23 18:20:00', 9, 26, '641c9850a6d5d.jpg'),
(62, 'FASHION JEWELRY', 10, 3500, 'Gold plated chain with squirrel pendent', 'ACTIVE', 1, '2023-03-23 18:21:48', 9, 26, '641c98bc70798.jpg'),
(63, 'RICE COOKER', 6, 9990, 'PINK COLOLUR\r\nBRAND-RKB', 'ACTIVE', 1, '2023-03-24 00:02:54', 11, 27, '641ce8ae43673.jpg'),
(64, 'RICE COOKER', 20, 10500, 'SINGER BRAND\r\nWHITE COLOUR', 'ACTIVE', 1, '2023-03-24 00:05:00', 11, 27, '641ce92bf30a8.jpg'),
(65, 'CAKE MIXUTER', 8, 8500, 'ABANS BRAND\r\nWHITE COLOUR', 'ACTIVE', 1, '2023-03-24 00:07:40', 11, 27, '641ce9cc1ee94.jpg'),
(66, 'GAS COOKER WITH OVEN', 10, 25000, 'BRAND -IMF\r\nGREY COLOUR', 'ACTIVE', 1, '2023-03-24 00:08:55', 11, 27, '641cea174092e.jpg'),
(67, 'OVEN', 5, 9950, 'ABS BRAND\r\nORANGE COLOUR', 'ACTIVE', 1, '2023-03-24 00:09:52', 11, 27, '641cea5035dbc.jpg'),
(68, 'PRESSURE COOKER', 20, 12500, 'PREMIER BRAND\r\nMADE OF STEEL', 'ACTIVE', 1, '2023-03-24 00:13:15', 11, 27, '641ceb1b158a8.jpg'),
(69, 'REFRIGIRATOR', 10, 12000, 'ABANS BRAND\r\nGREY COLOUR', 'ACTIVE', 1, '2023-03-24 00:16:28', 11, 27, '641cebdc1839f.jpg'),
(70, 'BLENDER', 20, 11500, 'RED COLOUR\r\nCRF BRAND', 'ACTIVE', 1, '2023-03-24 00:17:47', 11, 27, '641cec2b99cef.jpg'),
(71, 'SKIN CARE CREAM', 50, 1500, 'Gentle skin cleanser\r\n Dry to normal ,sensitive skin', 'ACTIVE', 1, '2023-03-24 00:28:30', 10, 28, '641ceeaeac506.jpg'),
(72, 'SKIN CARE CREAM', 50, 1500, 'Gentle skin cleanser\r\n Dry to normal ,sensitive skin', 'ACTIVE', 0, '2023-03-24 00:29:00', 10, 28, '641ceeaf16818.jpg'),
(73, 'SKIN CARE CREAM', 35, 4000, 'Olay  sculpting cream', 'ACTIVE', 1, '2023-03-24 00:30:02', 10, 28, '641cef0abdc41.jpg'),
(74, 'BEAUTY CREAM', 60, 850, '40g skin cream for all skin', 'ACTIVE', 1, '2023-03-24 00:30:54', 10, 28, '641cef3e8e204.jpg'),
(75, 'NAIL ARTS & TOOLS', 100, 500, 'Artificial nails\r\nPink and brown color\r\n12 in one pack', 'ACTIVE', 1, '2023-03-24 00:32:20', 10, 28, '641cef945e3c2.jpg'),
(76, 'MAKEUP BRUSHES', 40, 900, 'Make up brushes \r\n5 in one pack', 'ACTIVE', 1, '2023-03-24 00:33:14', 10, 28, '641cefcabcf81.jpg'),
(77, 'NAIL ARTS & TOOLS', 150, 2250, 'Artificial nails 12 in 1', 'ACTIVE', 1, '2023-03-24 00:34:17', 10, 28, '641cf00937e6f.jpg'),
(78, 'WHITENING CREAM', 75, 3500, 'Brightning gel cream\r\nLotus\r\n50g', 'ACTIVE', 1, '2023-03-24 00:37:57', 10, 28, '641cf0e5bcc15.jpg'),
(79, 'SYNTHETIC HAIR', 100, 850, 'Synthetic hair set', 'ACTIVE', 1, '2023-03-24 00:39:34', 10, 28, '641cf1468ccda.jpg'),
(80, 'WALL DECORATIONS', 40, 650, 'DECORATIN OF SUN MADE IN SRI LANAK', 'ACTIVE', 1, '2023-03-24 00:56:25', 5, 29, '641cf53913d89.jpg'),
(81, 'HAND MADE DESIGNED POTS', 200, 890, 'MADE IN SRI LANKA', 'ACTIVE', 1, '2023-03-24 01:13:22', 6, 29, '641cf93248dba.jpg'),
(82, 'HAND MADE PRODUCTS', 100, 300, 'MADE IN SRI LANKA\r\n', 'ACTIVE', 1, '2023-03-24 01:15:37', 6, 29, '641cf9b90f194.jpg'),
(83, 'CLAY POTS', 200, 750, 'MADE UP  OF CLAY', 'ACTIVE', 1, '2023-03-24 01:16:23', 6, 29, '641cf9e7b761f.jpg'),
(84, 'HAND MADE GOODS', 150, 650, '', 'ACTIVE', 1, '2023-03-24 01:17:46', 6, 29, '641cfa3aa6ffe.jpg'),
(85, 'CLAY MUG', 200, 500, 'MADE IN SRI LANKA', 'ACTIVE', 1, '2023-03-24 01:19:17', 5, 29, '641cfa95b05ba.jpg'),
(86, 'PRODUCT MADE OF COCONUT SHELLS', 300, 450, 'MADE IN SRI LANKA', 'ACTIVE', 1, '2023-03-24 01:21:06', 6, 29, '641cfb02bba50.jpg'),
(87, 'WOODEN STATUES', 250, 1500, 'MADE  UP OF WOOD', 'ACTIVE', 1, '2023-03-24 01:31:27', 5, 29, '641cfd6f4c121.jpg'),
(88, 'HOME MADE BAGS', 150, 250, 'SIMPLE BAG FOR WOMEN', 'ACTIVE', 1, '2023-03-24 01:34:43', 5, 29, '641cfe335207e.jpg'),
(89, 'HAND MADE BAGS', 100, 1550, 'FOR WOMEN', 'ACTIVE', 1, '2023-03-24 01:35:35', 6, 29, '641cfe6795433.jpg'),
(90, 'EXERCISE BOOK', 49, 140, '40 page  cr book', 'ACTIVE', 1, '2023-03-26 01:39:14', 8, 30, '641cfee990adc.jpg'),
(91, 'A4 PACK', 50, 950, 'A4 sheet 100 papers', 'ACTIVE', 1, '2023-03-24 01:38:53', 8, 30, '641cff2d4c3e2.jpg'),
(92, 'GLUE', 35, 450, 'Binder GLUE\r\nATLAS brand', 'ACTIVE', 1, '2023-03-24 01:40:36', 8, 30, '641cff94ebfbf.png'),
(93, '120 PGS EXERCISE BOOK', 79, 200, 'PROMATE 120 PAGE BOOK', 'ACTIVE', 1, '2023-03-26 01:42:30', 8, 30, '641cffe84953f.jpg'),
(94, 'PENS 3IN ONE', 38, 70, '3 pen pack\r\nRed blue black\r\nAtlas chooty', 'ACTIVE', 1, '2023-03-26 01:42:44', 8, 30, '641d0049267a9.png'),
(95, 'A4 SHEET', 30, 700, 'A4 sheets(white)\r\n100papers', 'ACTIVE', 1, '2023-03-24 01:46:44', 8, 30, '641d010462682.jpg'),
(96, 'COLOUR A4 SHEETS', 40, 1200, 'Colour a4 sheet -[100 papers)\r\nVarious colours-orange,red,blue,green', 'ACTIVE', 1, '2023-03-24 01:49:38', 8, 30, '641d01b2aaf83.jpg'),
(97, 'WRITING IMPLEMENT', 50, 1200, '60pen pack bic\r\n(rs20) 1 pc', 'ACTIVE', 1, '2023-03-24 01:52:08', 8, 30, '641d0248dfeb3.jpg'),
(98, 'WHITE  BOARD MARKER', 50, 250, 'White board marker', 'ACTIVE', 1, '2023-03-24 01:54:58', 8, 30, '641d02f2262c6.png'),
(99, 'guitar', 25, 15000, 'yamaha Box guitar', 'ACTIVE', 1, '2023-03-24 02:12:13', 7, 31, '641d06fd0b348.jpg'),
(100, 'piano', 8, 125000, 'black colour\r\nyamaha', 'ACTIVE', 1, '2023-03-24 02:13:09', 7, 31, '641d07358b950.jpg'),
(101, 'drum set', 5, 150000, 'blue colour\r\nmendini brand', 'ACTIVE', 1, '2023-03-24 02:15:27', 7, 31, '641d07bfd9e26.jpg'),
(102, 'violin', 25, 14500, 'std brand', 'ACTIVE', 1, '2023-03-24 02:16:12', 7, 31, '641d07ec9c1fd.jpg'),
(103, 'guitar(electric)', 20, 20000, 'black & white colour\r\netr brand', 'ACTIVE', 1, '2023-03-24 02:17:25', 7, 31, '641d0835d31f0.jpg'),
(104, 'mens watch', 15, 12500, 'Mens watch\r\nBranded\r\nStainless steel', 'ACTIVE', 1, '2023-03-24 02:20:05', 9, 32, '641d08d535d3a.jpg'),
(105, 'mens watch', 15, 5500, 'Mens watch\r\nBllack colour belt stainless steel back cover', 'ACTIVE', 1, '2023-03-24 02:20:53', 9, 32, '641d0905056f3.jpg'),
(106, 'womens watch', 10, 5000, 'Women watch \r\nBronze colour\r\nStainless steel', 'ACTIVE', 1, '2023-03-24 02:21:54', 9, 32, '641d0942cf75a.jpg'),
(107, 'womens watch', 25, 2500, 'Normal women watch wit stainless steel belt', 'ACTIVE', 1, '2023-03-24 02:22:39', 9, 32, '641d096fa0e76.jpg'),
(108, 'Gold plated  watch', 15, 25000, 'Gold plated branded watch for womens', 'ACTIVE', 1, '2023-03-24 02:23:50', 9, 32, '641d09b646e32.jpg'),
(109, 'mens watch', 24, 1800, 'Normal mens watch\r\nLeather  belt \r\nStainless back cover', 'ACTIVE', 1, '2023-03-24 02:24:40', 9, 32, '641d09e84638b.jpg'),
(110, 'mens watch (branded)', 12, 10500, 'Mens watch\r\nBranded\r\nStainless steel back cover\r\nLeather belt', 'ACTIVE', 1, '2023-03-24 02:25:56', 9, 32, '641d0a344eb4c.jpg'),
(111, 'water cotainer', 40, 1000, 'Big size water bottle', 'ACTIVE', 1, '2023-03-24 02:29:00', 11, 33, '641d0aec2abe0.jpg'),
(112, 'water container', 50, 950, 'Wter can', 'ACTIVE', 1, '2023-03-24 02:30:48', 11, 33, '641d0b5883080.jpg'),
(113, 'food sotrage', 50, 3500, '12in 1 pack\r\nPlastic boxes', 'ACTIVE', 1, '2023-03-24 02:31:34', 11, 33, '641d0b8679ee2.jpg'),
(114, 'food container', 35, 1500, '3in 1\r\nboxes', 'ACTIVE', 1, '2023-03-24 02:32:19', 11, 33, '641d0bb337960.jpg'),
(115, 'cutting board', 25, 850, 'wooden cutrting board', 'ACTIVE', 1, '2023-03-24 02:33:28', 11, 33, '641d0bf8ca049.jpg'),
(116, 'Men’s Clothing (T-Shirts)', 20, 2500, 'Brand – Adidas\r\nColor – Blue, Black, Red\r\nSize – S, M, L, XL\r\nMaterial – 100% Cotton\r\nIn Stock\r\n', 'ACTIVE', 1, '2023-03-24 05:14:44', 2, 35, '641d31c49460b.jpg'),
(117, 'Men’s Clothing (T-Shirts)', 25, 1500, 'Color – Red, Blue, Green\r\nSize – S, M, L, XL\r\nMaterial – Fiber cotton & Polyester\r\nRegular Fit\r\nIn Stock\r\n', 'ACTIVE', 1, '2023-03-24 05:16:15', 2, 35, '641d321fd9b4c.png'),
(118, 'Men’s Clothing (T-Shirts)', 15, 1500, 'Brand – Polo\r\nColor – Red\r\nSize – S, M, L, XL\r\nMaterial – Polyester\r\nIn Stock\r\n', 'ACTIVE', 1, '2023-03-24 05:17:08', 2, 35, '641d3254e2a1a.jpg'),
(119, 'Unisex Clothing (T-shirts)', 5, 1745, 'Brand – Roadster\r\nColor – Black\r\nSize – S, M, L, XL\r\nMaterial – Cotton\r\nIn Stock\r\n', 'ACTIVE', 1, '2023-03-24 05:18:44', 2, 35, '641d32b45b291.jpg'),
(120, 'Women’s Clothing ( Sarees)', 10, 8500, 'Brand – Bharatsthali\r\nColor – Blue\r\nMaterial – Silk\r\nIn Stock\r\n', 'ACTIVE', 1, '2023-03-24 05:47:38', 2, 21, '641d397a10193.jpg'),
(121, 'Women’s Clothing ( Sarees)', 5, 9500, 'Brand – Indian Saree\r\nColor – Black & Orange\r\nMaterial – Bathik\r\nIn Stock\r\n', 'ACTIVE', 1, '2023-03-24 05:51:40', 2, 21, '641d3a6c20810.jpg'),
(122, 'Women’s Clothing ( Frocks)', 5, 6500, 'Brand – Kelly Felder\r\nColor – Red\r\nMaterial – Chiffon\r\nIn Stock\r\n', 'ACTIVE', 1, '2023-03-24 06:00:44', 2, 35, '641d3c8ca1dd3.jpg'),
(123, 'Women’s Clothing ( Frocks)', 5, 6500, 'Brand – Kelly Felder\r\nColor – Red\r\nMaterial – Chiffon\r\nIn Stock\r\n', 'ACTIVE', 0, '2023-03-24 06:01:38', 2, 35, '641d3c8cb2e2f.jpg'),
(124, 'Women’s Clothing ( Frocks)', 5, 6500, 'Brand – Kelly Felder\r\nColor – Red\r\nMaterial – Chiffon\r\nIn Stock\r\n', 'ACTIVE', 0, '2023-03-24 06:01:43', 2, 35, '641d3c8cbe82b.jpg'),
(125, 'Women’s Clothing ( Frocks)', 5, 6500, 'Brand – Kelly Felder\r\nColor – Red\r\nMaterial – Chiffon\r\nIn Stock\r\n', 'ACTIVE', 0, '2023-03-24 06:01:48', 2, 35, '641d3c8cc9b04.jpg'),
(126, 'Women’s Clothing ( Frocks)', 5, 6500, 'Brand – Kelly Felder\r\nColor – Red\r\nMaterial – Chiffon\r\nIn Stock\r\n', 'ACTIVE', 0, '2023-03-24 06:01:57', 2, 35, '641d3c8d23dbd.jpg'),
(127, 'Kids Clothing', 10, 4000, 'Brand – Bibi Doll\r\nColor – Blue Sailor\r\nSize – S, M\r\nMaterial – Fabric\r\nIn Stock\r\n', 'ACTIVE', 1, '2023-03-24 06:02:55', 2, 35, '641d3d0f57893.jpg'),
(128, 'Kids Clothing', 12, 2000, 'Brand – Kids\r\nSize – S, M\r\nMaterial – Silk\r\nIn Stock\r\n', 'ACTIVE', 1, '2023-03-24 06:12:46', 2, 35, '641d3f5ead60b.jpg'),
(129, 'Kids Clothing', 15, 800, 'Brand – Kids\r\nColor – Light Blue \r\nSize – S, M\r\nMaterial – Fabric\r\nIn Stock\r\nWeight – 100g\r\n', 'ACTIVE', 1, '2023-03-24 06:14:48', 2, 35, '641d3fd875388.jpg'),
(130, 'Shoes', 10, 11000, 'Brand – Nike\r\nColor – Grey\r\nSize – 7,8,9,10\r\nMaterial – Leather, Fabric, Form, Rubber\r\nIn Stock\r\n', 'ACTIVE', 1, '2023-03-24 06:53:46', 13, 36, '641d48fa4699a.png'),
(131, 'Shoes', 8, 12000, 'Brand – Puma\r\nColor – Grey\r\nSize – 7,8,9,10\r\nMaterial –Leather, Fabric, Rubber\r\nIn Stock\r\n', 'ACTIVE', 1, '2023-03-24 06:58:00', 13, 36, '641d49f860181.jpg'),
(132, 'Shoes', 8, 12000, 'Brand – Puma\r\nColor – Grey\r\nSize – 7,8,9,10\r\nMaterial –Leather, Fabric, Rubber\r\nIn Stock\r\n', 'ACTIVE', 0, '2023-03-24 06:58:13', 13, 36, '641d49f9d79e1.jpg'),
(133, 'Shoes', 8, 12000, 'Brand – Puma\r\nColor – Grey\r\nSize – 7,8,9,10\r\nMaterial –Leather, Fabric, Rubber\r\nIn Stock\r\n', 'ACTIVE', 0, '2023-03-24 06:58:19', 13, 36, '641d49fabaf7f.jpg'),
(134, 'Shoes', 8, 12000, 'Brand – Puma\r\nColor – Grey\r\nSize – 7,8,9,10\r\nMaterial –Leather, Fabric, Rubber\r\nIn Stock\r\n', 'ACTIVE', 0, '2023-03-24 06:58:24', 13, 36, '641d49fb870b5.jpg'),
(135, 'Shoes', 8, 12000, 'Brand – Puma\r\nColor – Grey\r\nSize – 7,8,9,10\r\nMaterial –Leather, Fabric, Rubber\r\nIn Stock\r\n', 'ACTIVE', 0, '2023-03-24 06:58:27', 13, 36, '641d49fc488c6.jpg'),
(136, 'Shoes', 8, 12000, 'Brand – Puma\r\nColor – Grey\r\nSize – 7,8,9,10\r\nMaterial –Leather, Fabric, Rubber\r\nIn Stock\r\n', 'ACTIVE', 0, '2023-03-24 06:58:31', 13, 36, '641d49fd0c9d9.jpg'),
(137, 'Shoe Place', 6, 2000, 'Brand – Style\r\nColor – Purple\r\nSize – 5,6,7,8\r\nMaterial – Rubber & Form\r\nIn Stock\r\n', 'ACTIVE', 1, '2023-03-24 08:39:55', 13, 36, '641d61db3b382.jpg'),
(138, 'Sandals', 5, 2700, 'Brand – Birkenstock\r\nColor – Black\r\nSize – 8, 9, 10\r\nMaterial – Rubber & Leather\r\nIn Stock\r\n', 'ACTIVE', 1, '2023-03-24 08:41:38', 13, 36, '641d6242a4d97.jpg'),
(139, 'Sandals', 9, 2400, 'Brand – DSI\r\nColor – Brown\r\nSize – 5,6,7,8\r\nMaterial – Rubber & Leather\r\nIn Stock\r\n', 'ACTIVE', 1, '2023-03-24 08:42:40', 13, 36, '641d6280caf9d.jpg'),
(140, 'Boots', 15, 4500, 'Brand – DSI\r\nColor – Black\r\nSize – 8,9,10\r\nMaterial – Leather\r\nIn Stock\r\n', 'ACTIVE', 1, '2023-03-24 08:44:05', 13, 36, '641d62d5e9d74.jpg'),
(141, 'Shoes', 15, 9000, 'Brand – New Balance\r\nColor – Blue\r\nSize – 7,8,9,10\r\nMaterial – Leather, Rubber, Form\r\nIn Stock\r\n', 'ACTIVE', 1, '2023-03-24 08:49:50', 13, 37, '641d642e2d3d8.jpg'),
(142, 'Slippers', 20, 1000, 'Brand – Sparx\r\nColor – Blue\r\nSize – 7,8,9,10\r\nMaterial – Rubber\r\nIn Stock\r\n', 'ACTIVE', 1, '2023-03-24 08:52:07', 13, 37, '641d64b7379ae.jpg'),
(143, 'Slippers', 15, 1500, 'Brand – Nike\r\nColor – Black\r\nSize – 7,8,9,10\r\nMaterial – Rubber\r\nIn Stock\r\n', 'ACTIVE', 1, '2023-03-24 10:14:15', 13, 37, '641d77f7c42a9.jpg'),
(144, 'Boots', 16, 6000, 'Brand – DSI\r\nColor – Black\r\nSize – 8,9,10\r\nMaterial – Leather\r\nIn Stock\r\n', 'ACTIVE', 1, '2023-03-24 10:15:21', 13, 37, '641d78395bffa.jpg'),
(145, 'Boots', 20, 6500, 'Brand – TRM\r\nColor – Brown\r\nSize – 8,9,10\r\nMaterial – Rubber & Leather\r\nIn Stock\r\n', 'ACTIVE', 1, '2023-03-24 10:16:30', 13, 37, '641d787e43af4.jpg'),
(146, 'Boots', 5, 6500, 'Brand – Edeals\r\nColor – Black\r\nSize – 6, 7, 8\r\nMaterial – Rubber & Leather\r\nIn Stock\r\n', 'ACTIVE', 1, '2023-03-24 10:17:40', 13, 37, '641d78c40d6a2.jpg'),
(147, 'Home (Sofas)', 10, 115679, 'Brand – HONBAY\r\nColor – Dark Grey\r\nMaterial – Cushions & Fabric\r\nIn Stock\r\n', 'ACTIVE', 1, '2023-03-24 10:30:35', 4, 39, '641d7bcb398d8.jpg'),
(148, 'Home (Sofas)', 8, 120199, 'Brand – Devonshire\r\nColor – Grey\r\nMaterial – Cushions & Fabric\r\nIn Stock\r\n', 'ACTIVE', 1, '2023-03-24 10:34:22', 4, 39, '641d7cae8da71.jpg'),
(161, 'Chair', 6, 60000, 'Brand – Damro\r\nColor – Brown & Black\r\nMaterial – Wood & Cushions\r\nIn Stock\r\n', 'ACTIVE', 1, '2023-03-24 10:36:25', 4, 39, '641d7d29dfeb3.jpg'),
(162, 'Chair', 3, 80275, 'Reagan High Back Chair\r\nBrand – Damro\r\nColor – Brown \r\nMaterial – Cushions\r\nIn Stock\r\n', 'ACTIVE', 1, '2023-03-24 10:37:32', 4, 39, '641d7d6cbdad3.jpg'),
(163, 'Chair', 3, 30775, 'Low Back Chair\r\nBrand – Damro\r\nColor – Blue\r\nMaterial – Cushions\r\nIn Stock\r\n', 'ACTIVE', 1, '2023-03-24 10:38:29', 4, 39, '641d7da5decf4.jpg'),
(164, 'Beds', 2, 350000, 'Brand – Bonaldo\r\nColor – Blue\r\nMaterial – Wood & Cushions\r\nSize – King Size\r\nIn Stock\r\n', 'ACTIVE', 1, '2023-03-24 10:39:35', 4, 39, '641d7de7af40c.jpg'),
(165, 'Home (Sofas)', 4, 118679, 'Brand – HONBAY\r\nColor – Dark Grey\r\nMaterial – Cushions & Fabric\r\nIn Stock\r\n', 'ACTIVE', 1, '2023-03-24 10:44:34', 4, 40, '641d7f1277c70.jpg'),
(166, 'Tables', 6, 60000, 'Brand – Devonshire\r\nColor – Brown\r\nMaterial – Wood \r\nIn Stock\r\n', 'ACTIVE', 1, '2023-03-24 10:46:18', 4, 40, '641d7f7a4cc34.jpg'),
(167, 'Tables', 4, 65000, 'Brand – Damro\r\nColor – Brown\r\nMaterial – Wood \r\nIn Stock\r\n', 'ACTIVE', 1, '2023-03-24 11:06:56', 4, 40, '641d84509481d.jpg'),
(168, 'Chair', 8, 25000, 'Rolling chairs\r\nColor – Brown\r\nMaterial – Wood\r\nIn Stock\r\n', 'ACTIVE', 1, '2023-03-24 11:08:05', 4, 40, '641d8495a6f93.jpg'),
(169, 'Beds', 3, 300000, 'Brand – Arpico\r\nColor – Grey\r\nMaterial – Wood & Cushions\r\nSize - Double\r\nIn Stock\r\n', 'ACTIVE', 1, '2023-03-24 11:09:08', 4, 40, '641d84d4235d6.jpg'),
(170, 'Beds', 6, 320000, 'Brand – Damro\r\nColor – Brown\r\nMaterial – Wood & Cushions\r\nSize – Queen Size\r\nIn Stock\r\n', 'ACTIVE', 1, '2023-03-24 11:10:02', 4, 40, '641d850a138b1.jpg'),
(171, 'Mobile Phones', 12, 237900, 'Samsung Galaxy S22\r\n5G\r\nBrand - Samsung\r\n8GB Ram\r\nStorage 256GB\r\n3700mAh Battery\r\n1-year warranty\r\n', 'ACTIVE', 1, '2023-03-24 11:17:09', 1, 41, '641d86b5bff5e.jpg'),
(172, 'Mobile Phones', 10, 694990, 'Apple iPhone 14 Pro Max\r\n5G\r\nBrand - Apple\r\n6GB Ram\r\nStorage 512GB\r\n4323mAh Battery\r\n1-year warranty\r\n', 'ACTIVE', 1, '2023-03-24 11:17:56', 1, 41, '641d86e43c20f.jpg'),
(173, 'Tablets', 4, 75990, 'TCL Tab 10S\r\n5G\r\nBrand - TCL\r\n3GB Ram\r\nStorage 32GB\r\n8000mAh Battery\r\n1-year warranty\r\n', 'ACTIVE', 1, '2023-03-24 11:18:55', 1, 41, '641d871f66fb8.jpg'),
(174, 'Tablets', 5, 139990, 'GALAXY TAB A8 2022 LTE\r\n5G\r\nBrand - Samsung\r\n4GB Ram\r\nStorage 64GB\r\n7540mAh Battery\r\n1-year warranty\r\n', 'ACTIVE', 1, '2023-03-24 11:19:55', 1, 41, '641d875b1090a.jpg'),
(175, 'Tablets', 20, 74990, 'Huawei MatePad 10.4 2022\r\n5G\r\nBrand - Huawei\r\n4GB Ram\r\nStorage 64GB\r\n7250mAh Battery\r\n1-year warranty\r\nPrice – Rs.74 990/=\r\n', 'ACTIVE', 1, '2023-03-24 11:20:50', 1, 41, '641d87921d5d1.jpg'),
(176, 'Mobile Phones', 4, 64990, 'Huawei Nova Y70\r\n5G\r\nBrand - Huawei\r\n4GB Ram\r\nStorage 128GB\r\n6000mAh Battery\r\n6-month warranty\r\n', 'ACTIVE', 1, '2023-03-24 11:23:17', 1, 42, '641d88255d417.jpg'),
(177, 'Mobile Phones', 10, 36572, 'Xiaomi Redmi A1\r\n4G\r\nBrand - Xiaomi\r\n2GB Ram\r\nStorage 32GB\r\n5000mAh Battery\r\n1-year warranty\r\n', 'ACTIVE', 1, '2023-03-24 11:24:02', 1, 42, '641d8852aa0a6.png'),
(178, 'Mobile Phones', 15, 145572, 'Google Pixel 6a\r\n4G\r\nBrand – Google Pixel\r\n6GB Ram\r\nStorage 128GB\r\n4410mAh Battery\r\n1-year warranty\r\nPrice – Rs.145 572/=\r\n', 'ACTIVE', 1, '2023-03-24 11:24:45', 1, 42, '641d887dc5201.png'),
(179, 'Tablets', 15, 122900, 'Samsung Galaxy Tab S6 Lite 2022\r\n5G\r\nBrand - Samsung\r\n4GB Ram\r\nStorage 64GB\r\n7040mAh Battery\r\n1-year warranty\r\n', 'ACTIVE', 1, '2023-03-24 11:25:42', 1, 42, '641d88b6c6018.jpg'),
(180, 'Computers', 4, 162500, 'AMD RYZEN 7 5700G (8 CORES, 16 THREADS) UP TO 4.6 GHZ DESKTOP PROCESSOR WITH RADEON™ GRAPHICS \r\n\r\nBIOSTAR B550M DDR4 MOTHERBOARD \r\n\r\nCORSAIR VENGEANCE® LPX 8GB (1 x 8GB) DDR4 3200MHz \r\n\r\nOSCOO 256GB M.2 NVME SSD HARD DRIVE \r\n\r\nGAMDIAS AURA GP550 – 550 WATT POWER SUPPLY \r\n\r\nRAIDMAX F01 ARGB ATX MID TOWER CASE WITH 4 ARGB FAN\r\n\r\n', 'ACTIVE', 1, '2023-03-24 11:28:56', 1, 43, '641d8978cf944.png'),
(181, 'Computers', 5, 63500, 'INTEL® CORE™ i7-4790 PROCESSOR (8M Cache, up to 4.00 GHz)\r\n \r\n\r\nASUS B85 MOTHERBOARD \r\n\r\n\r\nSANSUNG 8GB DDR3 1600MHz RAM CARD \r\n\r\n\r\nWESTERN DIGITAL 500GB SSD HARD DRIVE \r\n\r\n\r\nCOLORSIT 450W GAMING POWER SUPPLY  \r\n\r\n\r\nRUIX V8 WHITE GAMING CASING\r\n', 'ACTIVE', 1, '2023-03-24 11:29:58', 1, 43, '641d89b695a89.png'),
(182, 'Computers', 8, 483500, 'INTEL® CORE™ i5 13600KF 14 CORE/20 THREADS \r\n\r\nASUS PRIME Z690M-PLUS D4 MOTHERBOARD \r\n\r\nCORSAIR VENGEANCE RGB RS DDR4 3200MHZ 8GB RAM \r\n\r\nMSI RTX 3050 8GB VENTUS 2X OC \r\n\r\nKINGSTON NV2 250GB PCIe GEN4 NVMe SSD \r\n\r\nSEAGATE 1TB 7200RPM BARRACUDA HARD DRIVE \r\n\r\n\r\nMSI MAG FORGE 100R ARGB GAMING CASING\r\n', 'ACTIVE', 1, '2023-03-24 11:30:46', 1, 43, '641d89e65d9ee.png'),
(183, 'Laptops', 10, 282500, 'ACER A515 LAPTOP, I5-1135G7 \r\nBrand - Acer Aspire \r\nIntel core i5 – 1135G7\r\n8GB DDR4 RAM\r\n15.6” FHD\r\n1TB HDD\r\nMX 350 2GB VGA\r\nWindows 10 Home\r\n2 Years Limited Warranty\r\n', 'ACTIVE', 1, '2023-03-24 11:34:41', 1, 44, '641d8ad1c3b84.png'),
(184, 'Laptops', 6, 443000, 'MSI GF63 THIN 11UC INTEL I5-11400H \r\nBrand - MSI\r\n8GB DDR4 3200MHZ\r\nNVIDIA GeForce RTX 3050 Laptop GPU 4 GB GDDR6\r\nIntel Core i5 11th Gen 11400H (2.70GHz)\r\n512 GB NVMe SSD\r\n', 'ACTIVE', 1, '2023-03-24 11:35:31', 1, 44, '641d8b031467c.png'),
(185, 'Laptops', 12, 360000, 'Apple MacBook Air (MGN63LL/A)\r\nM1 8-Core CPU\r\n8GB RAM\r\n256GB SSD\r\n13.3″  Retine LED Blacklit Display\r\n', 'ACTIVE', 1, '2023-03-24 11:36:11', 1, 44, '641d8b2b16bc5.jpg'),
(186, 'Laptops', 12, 175000, 'DELL Vostro 3510 \r\nIntel Core i3-1115G4 Processor\r\n4GB DDR4 Ram\r\n1TB Hard Drive\r\n15.6″, FHD Display\r\nIntel UHD Graphics\r\nPrice – Rs.175 000/-\r\n', 'ACTIVE', 1, '2023-03-24 11:37:01', 1, 44, '641d8b5de621b.jpg'),
(187, 'TV', 10, 229999, 'TOSHIBA 43 Inch 4K UHD Smart TV\r\nBrand - TOSHIBA\r\nPrice - Rs.229 999/-\r\n3 Years Warranty\r\n', 'ACTIVE', 1, '2023-03-24 11:39:58', 1, 45, '641d8c0e1e1c9.jpg'),
(188, 'TV', 13, 1024999, 'LG 86 Inch UHD Commercial TV\r\nBrand - LG\r\nPrice - Rs.1 024 999/-\r\n3 Years Warranty\r\n', 'ACTIVE', 1, '2023-03-24 11:40:33', 1, 45, '641d8c31b812c.jpg'),
(189, 'TV', 4, 59999, 'WALTON 32\" HD LED TV\r\nBrand - Walton\r\nPrice - Rs.59 999/-\r\n1 Years Warranty\r\n', 'ACTIVE', 1, '2023-03-24 11:41:13', 1, 45, '641d8c5941e72.jpg'),
(190, 'TV', 20, 514999, 'NIKAI Television 65UHD - LED TV\r\n65\" 4K UHD Smart TV\r\nBrand - NIKAI\r\nPrice - Rs.514 999/-\r\n1 Years Warranty\r\n', 'ACTIVE', 1, '2023-03-24 11:41:56', 1, 45, '641d8c84b52d9.jpg'),
(191, 'TV', 6, 2061599, 'Sony 65\" A80J - BRAVIA XR, OLED\r\n4K Ultra HD, HDR, Google Smart TV\r\nRs.2 061 599/-\r\nBrand – Sony\r\n3 Years Warranty\r\n', 'ACTIVE', 1, '2023-03-24 11:42:37', 1, 45, '641d8cad2bc7b.jpg'),
(192, 'Watch', 20, 41300, 'Enticer Men’s MTP-V300B-1AUDF\r\nBrand – Casio\r\nPrice – Rs.41 300/-\r\nBand Colour - Black\r\nBand Material - Leather\r\n', 'ACTIVE', 1, '2023-03-24 11:45:27', 9, 46, '641d8d57e374c.jpg'),
(193, 'Watch', 25, 368000, 'LONGINES\r\nBrand – Longines\r\nPrice – Rs.368 000/-\r\nBand Colour - Silver\r\nMaterial - Steel\r\n', 'ACTIVE', 1, '2023-03-24 11:46:02', 9, 46, '641d8d7a76945.jpg'),
(194, 'Watch', 10, 259000, 'OMEGA\r\nBrand – Longines\r\nPrice – Rs.259 000/-\r\nBand Colour - Silver\r\nMaterial – Steel & Yellow Gold\r\n', 'ACTIVE', 1, '2023-03-24 11:46:47', 9, 46, '641d8da72911b.jpg'),
(195, 'Spinning Toys', 10, 4800, 'Starhig Light Up Spinning Tops\r\nSize - Small\r\nMaterial - PVC\r\nBrand - Starhig\r\nAge Range – Kid\r\nPrice – Rs.4 800/-\r\n', 'ACTIVE', 1, '2023-03-24 14:06:41', 14, 47, '641dae71e80c0.jpg'),
(196, 'Spinning Toys', 12, 6500, 'Original Light Up Rotating Top Toy\r\nSize - Large\r\nMaterial - Plastic\r\nColour - Orange\r\nBrand – ACOUCB\r\nPrice – Rs.6 500/-\r\n', 'ACTIVE', 1, '2023-03-24 14:07:31', 14, 47, '641daea31edfb.jpg'),
(197, 'Spinning Toys', 9, 3300, 'ArtCreativity Light Up Orbiter Spinning Wand\r\n\r\nBrand - ArtCreativity\r\nAge Range - Toddler - kids\r\nMaterial - Plastic\r\nColour - Vr Headset251\r\nPrice – Rs.3 300/-\r\n', 'ACTIVE', 1, '2023-03-24 14:08:19', 14, 47, '641daed38e491.jpg'),
(198, 'Video Games', 3, 21000, 'Hogwarts Legacy Deluxe Edition - Nintendo Switch\r\nPlatform - Nintendo Switch\r\nManufacturer ‏- Warner Bros. Games\r\nCountry of Origin ‏-‎ USA\r\nLanguage ‏-‎ English\r\n', 'ACTIVE', 1, '2023-03-24 14:11:43', 14, 48, '641daf9f95442.jpg'),
(199, 'Video Games', 5, 23000, 'Dead Space - PlayStation 5\r\nPlatform - PlayStation 5\r\nManufacturer ‏ - ‎ Electronic Arts\r\nCountry of Origin ‏ - USA\r\nLanguage ‏-‎ English\r\n', 'ACTIVE', 1, '2023-03-24 14:12:29', 14, 48, '641dafcd4e511.jpg'),
(200, 'Video Games', 2, 15000, 'Fire Emblem™ Engage - Nintendo Switch\r\nPlatform - Nintendo Switch\r\nManufacturer - Nintendo\r\nLanguage – English\r\n', 'ACTIVE', 1, '2023-03-24 14:13:13', 14, 48, '641daff903d8d.jpg'),
(201, 'Electronic Toys', 12, 9500, 'Great Boy Handheld Game Console for Kids\r\nBrand - Great Boy\r\nColour - Black-yellow\r\nTheme - Retro\r\nNumber of Players – 2\r\n', 'ACTIVE', 1, '2023-03-24 14:16:11', 14, 49, '641db0ab4ead7.jpg'),
(202, 'Electronic Toys', 6, 8500, 'Kids Handheld Game Portable Video Game Player\r\nColour - Blue\r\nBrand - EASEGMER\r\nTheme - Retro\r\nNumber of Players – 1\r\n', 'ACTIVE', 1, '2023-03-24 14:17:16', 14, 49, '641db0eca4353.jpg'),
(203, 'Electronic Toys', 3, 26000, 'MOREXIMI Upgraded Kids Camera\r\nBrand- MOREXIMI\r\nColour - D6S PRO-Black\r\nSpecial Feature -Lightweight\r\nScreen Size - 2.4 Inches\r\nCamcorder type - Video\r\nVideo Capture Resolution -4K\r\n', 'ACTIVE', 1, '2023-03-24 14:17:48', 14, 49, '641db10c89a83.jpg'),
(204, 'Educational Toys', 7, 4000, 'HahaGift Educational Toys \r\nBrand - HahaGift\r\nAge Range - Toddler, Kid\r\nMaterial - ABS\r\nColor - Pink\r\nEducational Objective -Literacy & Special Awareness\r\n', 'ACTIVE', 1, '2023-03-24 14:21:36', 14, 50, '641db1f0dcf6d.jpg'),
(205, 'Educational Toys', 6, 6000, 'CoComelon Learning Melon Busy Board\r\n\r\nBrand - Just Play\r\nAge Range - Toddler\r\nTheme - Kids Entertainment Toys\r\nMaterial - Plastic\r\nColor – Green\r\n', 'ACTIVE', 1, '2023-03-24 14:22:28', 14, 50, '641db224577c9.jpg'),
(206, 'Educational Toys', 16, 5000, 'OUTOGO Solar Robot Toys \r\nBrand - OUTOGO\r\nItem Weight - 548 Grams\r\n', 'ACTIVE', 1, '2023-03-24 14:23:24', 14, 50, '641db25c2a5c9.jpg'),
(207, 'Dolls', 23, 4900, 'Barbie Skipper Babysitters\r\n\r\nColor - Multicolour\r\nBrand - Barbie\r\nTheme - Cartoon\r\nMaterial – Plastic\r\n', 'ACTIVE', 1, '2023-03-24 14:26:30', 14, 51, '641db316847de.jpg'),
(208, 'Dolls', 12, 3400, 'Barbie Made to Move Barbie Doll\r\n\r\nBrand - Barbie\r\nToy figure type - Doll\r\nColor - Yellow Top\r\nCartoon Character – Barbie\r\n', 'ACTIVE', 1, '2023-03-24 14:27:15', 14, 51, '641db343f1157.jpg'),
(209, 'Dolls', 1, 8000, 'Soft Body Baby Doll\r\n\r\nBrand - JC Toys\r\nAnimal theme - Elephant\r\nToy figure type - Doll\r\nColor - Pink\r\nMaterial – Vinyl\r\n', 'ACTIVE', 1, '2023-03-24 14:28:02', 14, 51, '641db37277388.jpg'),
(210, 'Drum set', 8, 175000, 'TAMA BRAND\r\nGREEN COLOUR', 'ACTIVE', 1, '2023-03-24 15:11:24', 7, 52, '641dbd9c1a170.jpg'),
(211, 'BOX GUITAR', 20, 12500, 'COLOUR BLACK\r\nYAMAHA BRAND', 'ACTIVE', 1, '2023-03-24 15:18:51', 7, 52, '641dbf5b4bfd9.jpg'),
(212, 'VIOLIN', 15, 8500, 'RT BRAND VIOLIN', 'ACTIVE', 1, '2023-03-24 15:23:41', 7, 52, '641dc07d540c6.jpg'),
(213, 'ORGAN', 12, 15500, 'ORGAN  YAMAHA BRAND', 'ACTIVE', 1, '2023-03-24 15:30:30', 7, 52, '641dc21696d16.jpg'),
(214, 'ORGAN', 10, 6500, 'BT BRAND NORMAL ORGAN', 'ACTIVE', 1, '2023-03-24 15:31:07', 7, 52, '641dc23b6fd66.jpg'),
(215, 'Makeups', 25, 15000, 'Full makeup box with brushes', 'ACTIVE', 1, '2023-03-24 15:34:05', 10, 53, '641dc2edd3900.jpg'),
(216, 'sun cream', 24, 1750, 'Sun cream\r\n50ml', 'ACTIVE', 1, '2023-03-24 17:23:36', 10, 53, '641ddc9809048.jpg'),
(217, 'sun cream', 24, 1750, 'Sun cream\r\n50ml', 'ACTIVE', 0, '2023-03-24 17:24:00', 10, 53, '641ddc9a03fe3.jpg'),
(218, 'skin care pack', 15, 8500, 'Augastinuscream,face oil,embroiless brand cream 3in 1 pack', 'ACTIVE', 1, '2023-03-24 17:29:24', 10, 53, '641dddf4826a5.jpg'),
(219, 'day cream', 60, 5500, 'Aveeno \r\nOat gel\r\nFor sensitive skin\r\n48g\r\n', 'ACTIVE', 1, '2023-03-24 17:39:27', 10, 53, '641de04f7aa46.jpg'),
(220, 'smart watch 2', 3, 12000, 'high quality', 'ACTIVE', 1, '2023-03-26 01:44:53', 1, 23, '641e0591a97be.png');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

DROP TABLE IF EXISTS `product_category`;
CREATE TABLE IF NOT EXISTS `product_category` (
  `cat_id` int NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(45) NOT NULL,
  `cat_img` text,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`cat_id`, `cat_name`, `cat_img`, `create_time`) VALUES
(1, 'Electronic & Tech Gadgets ', 'electronic.png', '2023-03-23 16:10:52'),
(2, 'Fashion & Apparel', 'fasion.png', '2023-03-23 16:11:11'),
(4, 'Homeware & Furniture ', 'home.png', '2023-03-23 16:11:22'),
(5, 'Made in SL', 'srilanka.png', '2023-03-25 00:28:48'),
(6, 'Handy Carfts', 'handcraft.png', '2023-03-25 00:30:08'),
(7, 'Sports & Hobbies ', 'sports.png', '2023-03-23 16:11:42'),
(8, 'Stationeries ', 'stationary.png', '2023-03-25 00:29:29'),
(9, 'Watches & Jewelry ', 'jewel.png', '2023-03-25 00:35:42'),
(10, 'Beauty & Health ', 'beauty.png', '2023-03-23 16:13:00'),
(11, 'Kitchen & Tupperware ', 'kitchen.png', '2023-03-25 00:28:08'),
(13, 'Shoes & Foot Wear', 'shoe.png', '2023-03-25 00:31:17'),
(14, 'Games & Toys', 'toys.png', '2023-03-25 00:35:31');

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

DROP TABLE IF EXISTS `shop`;
CREATE TABLE IF NOT EXISTS `shop` (
  `shop_id` int NOT NULL AUTO_INCREMENT,
  `shop_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tel` varchar(12) NOT NULL,
  `address` varchar(300) NOT NULL,
  `city` varchar(50) NOT NULL,
  `zip_code` varchar(45) NOT NULL,
  `roc_number` varchar(45) DEFAULT NULL,
  `dp_logo` varchar(300) DEFAULT NULL,
  `dp_banner` varchar(300) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_user_id` int NOT NULL,
  `nb_description` text,
  `shop_status` varchar(20) NOT NULL DEFAULT 'ACTIVE',
  PRIMARY KEY (`shop_id`),
  KEY `fk_shop_user1_idx` (`user_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`shop_id`, `shop_name`, `email`, `tel`, `address`, `city`, `zip_code`, `roc_number`, `dp_logo`, `dp_banner`, `is_active`, `create_time`, `user_user_id`, `nb_description`, `shop_status`) VALUES
(21, 'Vibe Check', 'testing3.sanakin@gmail.com', '0763745619', 'horana road , piliyanadala', 'piliyandala', '10555', '', '', '', 1, '2023-03-22 16:59:41', 13, 'We are selling Clothing & Apparel', 'ACTIVE'),
(22, 'Nahinda Stores', 'testing1.sanakin@gmail.com', '0777777752', 'flower road', 'colombo', '07', 'ab/td/123445', '641b3569311fa.png', '', 1, '2023-03-22 17:05:45', 14, 'we are selling all kinds of electrical ,fashion,home appliances etc.', 'ACTIVE'),
(23, '1', 'shashishajanith1@gmail.com', '0763133646', '4', '5', '6', '2', '', '', 1, '2023-03-22 17:12:33', 12, '3', 'ACTIVE'),
(24, 'sports hub', 'testing5.sanakin@gmail.com', '07755415211', '', 'ragama', '', 'ab/db/68u864', '641b5c0333532.png', '', 1, '2023-03-22 19:50:27', 17, 'we sell all kinds of sports items', 'ACTIVE'),
(25, 'sports hub', 'testing5.sanakin@gmail.com', '07755415211', '', 'ragama', '', 'ab/db/68u864', '641b5c0395a15.png', '', 0, '2023-03-23 16:36:12', 17, 'we sell all kinds of sports items', 'DELETED'),
(26, 'ZTE Jwelary', 'testing1.sanakin@gmail.com', '0777777752', '', 'wattala', '', 'ab/bs/41145', '641c88ba14c60.png', '', 1, '2023-03-23 17:13:30', 14, 'we are a fashion jwelary shop', 'ACTIVE'),
(27, 'RDS  STORES', 'sanakin.test6@gmail.com', '07766366666', '', 'negombo', '', 'AB/BS/555555', '641ce7bb268e1.png', '', 1, '2023-03-24 00:01:17', 18, 'WE SELL ALL KINDS OF HOME APPLIANCES', 'ACTIVE'),
(28, 'GPS BEAUTY', 'sanakin.test6@gmail.com', '07766366666', '', 'MAHARAGAMA', '', 'AB/BS/9429303290239', '641cee6de68ce.png', '', 1, '2023-03-24 00:27:25', 18, 'WE SELL ALL KINDS OF BEAUTY PRODUCTS', 'ACTIVE'),
(29, 'DP PRODUCTS', 'sanakin.test7@gmail.com', '07752235635', '', 'ANURADHAPURA', '', 'AB/BS/2828387383', '641cf44f6e2b3.png', '', 1, '2023-03-24 00:52:31', 19, 'WE SELL HAND CRAFTS & SRI LANKAN MADE PRODUCTS', 'ACTIVE'),
(30, 'SUHADA BOOK SHOP', 'sanakin.test7@gmail.com', '07752235635', '', 'MADAWACHCHIYA', '', 'AB/BS/524658', '641cfeb1eaeec.png', '', 1, '2023-03-24 01:36:49', 19, 'WE SELL ALL KIND OF STATIONARY', 'ACTIVE'),
(31, 'music hub', 'sanakin.test9@gmail.com', '047756245463', '', 'kandy', '', 'aab/bs/2873493489238', '641d06bf8fc9f.png', '', 1, '2023-03-24 02:11:11', 21, 'we sell all kinds of musi instruments', 'ACTIVE'),
(32, 'timers', 'sanakin.test9@gmail.com', '047756245463', '', 'matale', '', 'ab/bs/565255666', '641d089aebb66.png', '', 1, '2023-03-24 02:19:06', 21, 'we have all kinds of watches', 'ACTIVE'),
(33, 'the plastic store', 'sanakin.test9@gmail.com', '047756245463', '', 'kandy', '', 'ab/bs/758658858', '641d0abad6c1e.png', '', 1, '2023-03-24 02:28:10', 21, 'we sell all kinds of plastic items', 'ACTIVE'),
(34, 'Panther Styles', 'testing3.sanakin@gmail.com', '0763745619', '159/D, Wethara, Polgasowita', 'Polgasowita', '10320', '', '641d310c1303d.jpg', '641d31523cad3.avif', 0, '2023-03-24 05:13:32', 13, 'We are selling all outfits', 'DELETED'),
(35, 'Panther Styles', 'testing3.sanakin@gmail.com', '0763745619', '15, Maharagama Road, Maharagama', 'Maharagama', '12550', '', '641d310c2ecb5.jpg', '', 1, '2023-03-24 05:11:40', 13, 'We are selling all outfits', 'ACTIVE'),
(36, 'Shoe Place', 'kucassesment@gmail.com', '0759865788', '200, Wethara, Polgasowita', 'Polgasowita', '10320', '', '641db3aad7225.jpg', '', 1, '2023-03-24 14:28:58', 22, 'We are selling Footwear & Shoes', 'ACTIVE'),
(37, 'Shoe Mart', 'kucassesment@gmail.com', '0759865788', '156, Colombo Road, Colombo', 'Colombo', '15660', '', '641d63d197c48.png', '', 1, '2023-03-24 08:48:17', 22, 'We Have The Best Shoes in Sri Lanka', 'ACTIVE'),
(38, 'Shoe Mart', 'kucassesment@gmail.com', '0759865788', '156, Colombo Road, Colombo', 'Colombo', '15660', '', '641d63d1cf91b.png', '', 0, '2023-03-24 08:48:33', 22, 'We Have The Best Shoes in Sri Lanka', 'DELETED'),
(39, 'Living Room', 'testing4.sanakin@gmail.com', '0759898963', '96, Madapatha, Piliyandala', 'Piliyandala', '58900', '', '641d7ad03d98b.png', '', 1, '2023-03-24 10:26:24', 23, 'The Greatest Furniture', 'ACTIVE'),
(40, 'Home Plan', 'testing4.sanakin@gmail.com', '0759898963', '88, Horana Road, Horana', 'Horana', '56400', '', '641d7eb6ce4c2.png', '641d7eb6ce5a9.png', 1, '2023-03-24 10:43:02', 23, 'The Best Home Items', 'ACTIVE'),
(41, 'Cell Mart', 'testing4.sanakin@gmail.com', '0759898963', 'Gangarama Road, Colombo', 'Colombo', '45600', '', '641d86721a94e.png', '', 1, '2023-03-24 11:16:02', 23, 'Best Mobile Phones', 'ACTIVE'),
(42, 'Phone.lk', 'testing4.sanakin@gmail.com', '0759898963', '88, Kottawa Road, Kottawa', 'Kottawa', '8885', '', '641d87f553c8c.png', '', 1, '2023-03-24 11:22:29', 23, 'The Best Phones in Sri Lanka', 'ACTIVE'),
(43, 'Nexcom', 'testing4.sanakin@gmail.com', '0759898963', '63, Galle Road, Colombo', 'Colombo', '656441', '', '641d8925541d9.png', '', 1, '2023-03-24 11:27:33', 23, 'Best Computer Parts', 'ACTIVE'),
(44, 'Laptop.lk', 'testing4.sanakin@gmail.com', '0759898963', '78, Galle Road, Colombo', 'Colombo', '45630', '', '641efc65ed62f.jpg', '', 1, '2023-03-25 13:51:33', 23, 'Best Laptops in Sri Lanka', 'ACTIVE'),
(45, 'Abans', 'testing4.sanakin@gmail.com', '0759898963', '45, Mirissa,Mathara', 'Mathara', '78541', '', '641d8bd715c20.png', '', 1, '2023-03-24 11:39:03', 23, 'Best Products in Sri Lanka', 'ACTIVE'),
(46, 'Wrist Lab', 'kucassesment@gmail.com', '0759865788', 'Kohuwala, Nugegoda', 'Nugegoda', '4120', '', '641d8d33b8a8b.png', '', 1, '2023-03-24 11:44:51', 22, 'The Best Watches', 'ACTIVE'),
(47, 'Kids Zone', 'testing3.sanakin@gmail.com', '0763745619', '45, Kandy Road, Kandy', 'Kandy', '41020', '', '641dae32cb42f.png', '641dae32cb55e.jpg', 1, '2023-03-24 14:05:38', 13, 'We have every kids items', 'ACTIVE'),
(48, 'Game Shop', 'testing3.sanakin@gmail.com', '0763745619', 'Have-lock city, Colombo 05', 'Colombo', '14020', '', '641daf60ae99f.jpg', '641daf60aea62.png', 1, '2023-03-24 14:10:40', 13, 'We have best games in world', 'ACTIVE'),
(49, 'Toys', 'testing3.sanakin@gmail.com', '0763745619', '56, Kahapola, Piliyandala', 'Piliyandala', '10120', '', '641db07c0557a.jpg', '641db07c05670.png', 1, '2023-03-24 14:15:24', 13, 'Best toys for children', 'ACTIVE'),
(50, 'Kids Arcade', 'testing3.sanakin@gmail.com', '0763745619', '15, kottawa, Pannipitiya', 'Pannipitiya', '15420', '', '641db1be5752f.jpg', '', 1, '2023-03-24 14:20:46', 13, 'We have best kids items', 'ACTIVE'),
(51, 'Top Toys', 'kucassesment@gmail.com', '0759865788', '12, Maradana, Colombo 03', 'Colombo', '10205', '', '641db2dc584fb.jpg', '', 1, '2023-03-24 14:25:32', 22, 'The best toys in Sri Lanka', 'ACTIVE'),
(52, 'sarigama', 'testing5.sanakin@gmail.com', '07755415211', '', 'kurunegala', '', 'ab/bs/52455666', '641dbd5e0d8b5.png', '', 1, '2023-03-24 15:10:22', 17, 'we sell all kinds of musical instruments', 'ACTIVE'),
(53, 'RM BEAUTY', 'testing5.sanakin@gmail.com', '07755415211', '', 'GAMAPAHA', '', 'AB/BS/28728838', '641dc2ad8b6d1.png', '', 1, '2023-03-24 15:33:01', 17, 'WE SELL ALL KINDS OF BEAUTY PRODUCTS', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `site_order`
--

DROP TABLE IF EXISTS `site_order`;
CREATE TABLE IF NOT EXISTS `site_order` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `order_number` varchar(10) NOT NULL,
  `cus_order_id` int DEFAULT NULL,
  `de_address` varchar(350) NOT NULL,
  `de_tel` varchar(12) NOT NULL,
  `de_note` text,
  `de_status` varchar(45) NOT NULL,
  `total_bill` double NOT NULL,
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `user_user_id` int NOT NULL,
  `de_city` varchar(20) DEFAULT NULL,
  `de_code` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  UNIQUE KEY `order_number_UNIQUE` (`order_number`),
  KEY `fk_order_user1_idx` (`user_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `site_order`
--

INSERT INTO `site_order` (`order_id`, `order_number`, `cus_order_id`, `de_address`, `de_tel`, `de_note`, `de_status`, `total_bill`, `create_time`, `user_user_id`, `de_city`, `de_code`) VALUES
(11, 'SAI004602', NULL, '42b, buddhaloka mawatha,  suwarapola', '0763133646', 'deliver before 12                 ', 'PROCESSING', 1500, '2023-03-23 18:24:54', 12, 'piliyandala', '159368'),
(12, 'SAI453972', NULL, 'Flat No 1005, Al Khaleej 02,', '07777777777', '                            ', 'CANCEL', 2290, '2023-03-23 18:35:51', 15, 'Al Nadah', '425875'),
(13, 'SAI850171', NULL, 'Church road', '01125554662', '                            ', 'PROCESSING', 2300, '2023-03-25 02:47:12', 16, 'jaela', '360053'),
(32, 'SAI244115', NULL, '34/b, ragama', '0763133646', '                            ', 'PROCESSING', 200, '2023-03-26 07:12:30', 24, 'kolagama', '750926'),
(33, 'SAI951007', NULL, '34/b, ragama', '0763133646', '                            ', 'PROCESSING', 140, '2023-03-26 07:12:44', 24, 'kolagama', '245436'),
(34, 'SAI264072', NULL, '34/b, ragama', '0763133646', '                            ', 'PROCESSING', 24000, '2023-03-26 07:14:53', 24, 'kolagama', '407080');

-- --------------------------------------------------------

--
-- Table structure for table `subscribe`
--

DROP TABLE IF EXISTS `subscribe`;
CREATE TABLE IF NOT EXISTS `subscribe` (
  `sub_id` int NOT NULL AUTO_INCREMENT,
  `sub_email` varchar(200) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`sub_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `acc_type` varchar(10) NOT NULL,
  `acc_status` varchar(10) DEFAULT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `nic` varchar(20) NOT NULL,
  `tel` varchar(12) NOT NULL,
  `gender` varchar(7) NOT NULL,
  `home_address` varchar(350) NOT NULL,
  `home_city` varchar(100) NOT NULL,
  `zip_code` varchar(45) NOT NULL,
  `dp_img` varchar(45) DEFAULT NULL,
  `date_created` datetime DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `email`, `password`, `acc_type`, `acc_status`, `first_name`, `last_name`, `full_name`, `birthday`, `nic`, `tel`, `gender`, `home_address`, `home_city`, `zip_code`, `dp_img`, `date_created`, `date_updated`, `is_active`) VALUES
(9, 'admin@sanakin.lk', '$2y$10$jTuKrSM8.WJEc.0zd3KlMuS.5pWbCPqrKpEky/NWE.3U4P48rHWTG', 'ADMIN', 'VERIFIED', 'ADMIN', 'ADMIN', 'ADMIN', '2000-10-13', 'ADMIN', '0000000000', '', 'ADMIN', 'ADMIN', 'ADMIN', '64187d50de73d.png', '2023-03-12 20:43:54', NULL, 1),
(12, 'shashishajanith1@gmail.com', '$2y$10$w.NMqMfXv3AC6Z6hzyY44u8nt9fsRg7VznIOQxxztPoMqMtnBqYs2', 'SHOPPER', 'ACTIVE', 'shasheesha', 'Dissanayake', 'shasheesha janith dissanayake', '2023-03-23', 'shasheesha', '0763133646', 'male', '42b, buddhaloka mawatha,  suwarapola', 'piliyandala', '10300', NULL, '2023-03-22 16:03:21', NULL, 1),
(13, 'testing3.sanakin@gmail.com', '$2y$10$St.WAIpbPULkWB73V0.26OcF0wK7uzMt6jHj6wfx1OPTA63xUMnVW', 'SHOPPER', 'ACTIVE', 'sachith', 'priyankara', 'sachith priyankara', '2000-06-13', 'sachith', '0763745619', 'male', '159/D, Wethara, Polgasowita', 'Polgasowita', '10320', '641b283f2ed5f.jpg', '2023-03-22 16:09:26', NULL, 1),
(14, 'testing1.sanakin@gmail.com', '$2y$10$30zV.PMgcvruA69HV0Hxyesjwa8HwbrM8uGsPzjdmTjbrlms0Fu9e', 'SHOPPER', 'ACTIVE', 'Nahinda', 'Rajapaksha', 'A.R.Nahinda Rajapaksha', '1992-02-04', 'Nahinda', '0777777752', 'male', 'flower road', 'colombo', '7', '641b28921d7c6.jpg', '2023-03-22 16:10:48', NULL, 1),
(15, 'kariyawasam.dk@gmail.com', '$2y$10$bcX31qDgxFirQVEsvwrpMuzvDz25KXO9i2ODW3TzI1UFHKyJTDWnm', 'CUSTOMER', 'VERIFIED', 'Deshan', 'Kariyawasam', 'Deshan Kariyawasam', '1998-12-11', 'Deshan', '07777777777', 'male', 'Flat No 1005, Al Khaleej 02,', 'Al Nadah', '00000', '641c9b0853035.png', '2023-03-22 16:16:54', NULL, 1),
(16, 'testing2.sanakin@gmail.com', '$2y$10$b8JpswV76wYbfLe2My.EMuEYiaKSpsFDDglwYl5gIvOCDWtCFh2Jy', 'CUSTOMER', 'VERIFIED', 'kasun', 'perera', 'p.k.kasun perera', '1998-02-10', 'kasun', '01125554662', 'male', 'Church road', 'jaela', '0120', NULL, '2023-03-22 19:26:29', NULL, 1),
(17, 'testing5.sanakin@gmail.com', '$2y$10$oq.8CG4T5sL/tRuItPaxDeROgkYJ6kDVr4BQ2B4ROWNaEQIhuWwRC', 'SHOPPER', 'ACTIVE', 'Vinal', 'Senadeera', 'Vinal Senadeera', '1999-07-05', 'Vinal', '07755415211', 'male', 'nawaloka rd', 'Ragama', '0109', '641b5ad0d7915.jpg', '2023-03-22 19:44:38', NULL, 1),
(18, 'sanakin.test6@gmail.com', '$2y$10$DjjLkqPKIr.Z3WIC2H/ovuJklAYzO3Y4d.2ve33Infoj4wSI9K2O2', 'SHOPPER', 'ACTIVE', 'prashan', 'fernando', 'p.a.prashan fernando', '1996-05-07', 'prashan', '07766366666', 'male', '', 'negombo', '', '641ce7055d449.jpg', '2023-03-23 23:55:10', NULL, 1),
(19, 'sanakin.test7@gmail.com', '$2y$10$malOj9uUuGC2Qy0GZAlJAeL1kE8M6SXPOr7pR/Ivkr5sJBeqx6TtK', 'SHOPPER', 'ACTIVE', 'Dasun', 'Shanaka', 'Dasun Shanaka', '1990-02-14', 'Dasun', '07752235635', 'male', '', 'anuradhapura', '', '641cf3e79da6f.jpg', '2023-03-24 00:49:59', NULL, 1),
(20, 'sanakin.test8@gmail.com', '$2y$10$JzUcYL9OrDWdUNp3AahMku4odbv5cRJDwOwKafwjcnVHu9Jfdrd92', 'CUSTOMER', 'ACTIVE', 'daushka', 'gunathilake', 'danushka gunathilake', '2000-10-16', 'daushka', '04445424212', 'male', '', 'galle', '', '641d0534f3934.jpg', '2023-03-24 02:03:18', NULL, 1),
(21, 'sanakin.test9@gmail.com', '$2y$10$2sRAwbUSK90Z9M/AfSFIGuPSHg5Ijr/bUHES5X0klgeUkm0W9FDIG', 'SHOPPER', 'ACTIVE', 'niroshan', 'dickwella', 'niroshan dickwellla', '1990-07-19', 'niroshan', '047756245463', 'male', '', 'kandy', '', '641d0668eaaf5.png', '2023-03-24 02:09:39', NULL, 1),
(22, 'kucassesment@gmail.com', '$2y$10$k0YccQEYah0TgEKLWE/IxeddNwQa12TIW2m.n3WYpM8vFTMA/jOje', 'SHOPPER', 'ACTIVE', 'Kasun', 'Dilshan', 'Kasun Dilshan', '2009-02-18', 'Kasun', '0759865788', 'male', '200, Wethara, Polgasowita', 'Polgasowita', '10320', '641d4774652be.png', '2023-03-24 06:42:24', NULL, 1),
(23, 'testing4.sanakin@gmail.com', '$2y$10$Hb.3BA/LBQAWdci5lIyPa.hvfQ0IZSv70Xrw9tEH9fBir.aNTQ4p.', 'SHOPPER', 'ACTIVE', 'Nithu', 'Sathsarani', 'Nithu Sathsarani', '1999-01-08', 'Nithu', '0759898963', 'female', '78, Galle Road, Colombo', 'Colombo', '45630', '641d7b65b21c1.png', '2023-03-24 10:22:16', NULL, 1),
(24, 'kumeshi@gmail.com', '$2y$10$jTuKrSM8.WJEc.0zd3KlMuS.5pWbCPqrKpEky/NWE.3U4P48rHWTG', 'CUSTOMER', 'ACTIVE', 'Kumeshi', 'Sasanthika', 'Kumeshi Sasanthika', '2023-03-07', '200028702523', '0763133646', 'femal', '34/b, ragama', 'kolagama', '10300', NULL, '2023-03-26 04:44:37', '2023-03-25 23:12:13', 1),
(25, 'shashisha@gmail.com', '$2y$10$jTuKrSM8.WJEc.0zd3KlMuS.5pWbCPqrKpEky/NWE.3U4P48rHWTG', 'SHOPPER', 'ACTIVE', 'Shasheesha', 'Dissanayake', 'Shasheesha Janith Dissanayake', '2023-03-05', '200028702523', '0763133646', 'male', '42b/3, buddhaloka mawatha, suwarapola', 'Piliyandala', '10300', NULL, '2023-03-26 04:47:06', '2023-03-25 23:15:12', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `complaint`
--
ALTER TABLE `complaint`
  ADD CONSTRAINT `fk_complaint_order_item1` FOREIGN KEY (`order_item_item_id`) REFERENCES `order_item` (`item_id`);

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `fk_order_item_order1` FOREIGN KEY (`order_order_id`) REFERENCES `site_order` (`order_id`),
  ADD CONSTRAINT `fk_order_item_product1` FOREIGN KEY (`product_product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `password_reset_request`
--
ALTER TABLE `password_reset_request`
  ADD CONSTRAINT `fk_password_reset_request_user1` FOREIGN KEY (`user_user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_product_category1` FOREIGN KEY (`product_category_cat_id`) REFERENCES `product_category` (`cat_id`),
  ADD CONSTRAINT `fk_product_shop1` FOREIGN KEY (`shop_shop_id`) REFERENCES `shop` (`shop_id`);

--
-- Constraints for table `shop`
--
ALTER TABLE `shop`
  ADD CONSTRAINT `fk_shop_user1` FOREIGN KEY (`user_user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `site_order`
--
ALTER TABLE `site_order`
  ADD CONSTRAINT `fk_order_user1` FOREIGN KEY (`user_user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
