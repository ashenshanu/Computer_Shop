-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2024 at 02:18 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mr_pc`
--

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

CREATE TABLE `complaint` (
  `com_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject` text NOT NULL,
  `description` text DEFAULT NULL,
  `kind_of` varchar(20) NOT NULL,
  `related_id` int(11) NOT NULL,
  `create_time` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_item_item_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inquiry`
--

CREATE TABLE `inquiry` (
  `inq_id` int(11) NOT NULL,
  `inq_name` varchar(100) NOT NULL,
  `inq_email` varchar(200) NOT NULL,
  `inq_contact` varchar(20) NOT NULL,
  `inq_msg` text NOT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `inquiry`
--

INSERT INTO `inquiry` (`inq_id`, `inq_name`, `inq_email`, `inq_contact`, `inq_msg`, `create_date`) VALUES
(1, 'Ashen', 'ashenecom@gmail.com', '0756087339', 'adkjh', '2023-12-28 22:15:02');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `item_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `quntity` int(11) NOT NULL,
  `per_price` double NOT NULL,
  `sub_total` double DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `product_product_id` int(11) NOT NULL,
  `order_order_id` int(11) NOT NULL,
  `confirm_code` varchar(6) DEFAULT NULL,
  `de_status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`item_id`, `product_name`, `quntity`, `per_price`, `sub_total`, `create_time`, `product_product_id`, `order_order_id`, `confirm_code`, `de_status`) VALUES
(22, 'Mouse Alcatroz Asic 3 Usb Optical (6m)', 1, 1050, 1050, '2023-12-28 16:31:13', 223, 35, NULL, NULL),
(23, 'Mouse Alcatroz Asic 9 Rgb Fx Usb (6m)', 1, 1750, 1750, '2023-12-28 16:31:13', 222, 35, NULL, NULL),
(24, 'Keyboard Logitech W/L K400 Plus (6m)', 1, 15600, 15600, '2023-12-28 16:31:13', 241, 35, NULL, NULL),
(25, 'Keyboard Flexible Usb (6m)', 1, 2100, 2100, '2023-12-28 16:31:13', 245, 35, NULL, NULL),
(26, 'Keyboard A4 Tech Fk13 Numeric (1y)', 1, 1300, 1300, '2023-12-28 16:31:13', 248, 35, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_request`
--

CREATE TABLE `password_reset_request` (
  `id_reset` int(11) NOT NULL,
  `user_user_id` int(11) NOT NULL,
  `reset_code` text NOT NULL,
  `is_used` tinyint(1) DEFAULT NULL,
  `is_expired` tinyint(1) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT current_timestamp(),
  `is_active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `password_reset_request`
--

INSERT INTO `password_reset_request` (`id_reset`, `user_user_id`, `reset_code`, `is_used`, `is_expired`, `date_created`, `is_active`) VALUES
(8, 27, '384a65cb544cae181941b71ff4e22008747f77fc', 1, 0, '2023-12-28 15:32:14', 1),
(9, 27, '27c3fb7544ef079e35f3ba048838a34299f95227', 1, 0, '2023-12-28 15:37:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `quntity` int(11) NOT NULL,
  `per_price` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `product_category_cat_id` int(11) NOT NULL,
  `shop_shop_id` int(11) NOT NULL,
  `image_url` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `quntity`, `per_price`, `description`, `status`, `is_active`, `create_time`, `product_category_cat_id`, `shop_shop_id`, `image_url`) VALUES
(221, 'Mouse A4 Tech W/L & B/T Fstyler Fb35s(6m)', 10, 3500, 'Weight: 170.00GM Brands: A4 Tech Warranty: 6 Months (175 Days Carry In Warranty*)Stock: No Model: FB35S Categories:  Mouse ', 'ACTIVE', 0, '2024-01-06 11:54:14', 5, 54, '658d84912bcbb.png'),
(222, 'Mouse Alcatroz Asic 9 Rgb Fx Usb (6m)', 7, 1750, 'Weight: 100.00GM Brands: Alcatroz Warranty: 6 Months (175 Days Carry In Warranty*) Stock: No Model: ASIC 9 RGB FX Categories:  Mouse ', 'ACTIVE', 0, '2024-01-06 11:57:37', 5, 54, '658d84fccdffd.JPG'),
(223, 'Mouse Alcatroz Asic 3 Usb Optical (6m)', 14, 1050, 'Weight: 115.00GM\r\nBrands: Alcatroz\r\nWarranty: 6 Months (175 Days Carry In Warranty*)\r\nStock: No\r\nModel: ASIC 3\r\nCategories:  Mouse ', 'ACTIVE', 1, '2023-12-28 16:31:13', 5, 54, '658d853e8cd50.jpg'),
(224, 'Mouse A4 Tech W/Lg3-200ns Usb Silent(1y)', 20, 2500, ' Weight: 200.00GM\r\nBrands: A4 Tech\r\nWarranty: One Year (350 Days Carry In Warranty*)\r\nStock: No\r\nModel: G3-200NS\r\nCategories:  Mouse ', 'ACTIVE', 0, '2023-12-30 13:31:48', 5, 54, '658d8575bf283.jpg'),
(225, 'Mouse A4 Tech W/L G3-280n Usb(1y)', 5, 3000, 'Weight: 160.00GM\r\nBrands: A4 Tech\r\nWarranty: One Year (350 Days Carry In Warranty*)\r\nStock: No\r\nModel: G3-280N\r\nCategories:  Mouse ', 'ACTIVE', 1, '2023-12-28 14:26:26', 5, 54, '658d85927771a.jpg'),
(226, 'Mouse Asus P305 Tuf Gaming M3 Usb (1y)', 7, 8000, 'Weight: 215.00GM\r\nBrands: Asus\r\nWarranty: One Year (350 Days Carry In Warranty*)\r\nStock: No\r\nModel: P305 TUF GAMING M3\r\nCategories:  Mouse ', 'ACTIVE', 0, '2023-12-30 13:33:36', 5, 54, '658d8655374e3.jpg'),
(227, 'Mouse Gamdias Zeus E3 Gaming Usb (6m)', 1, 2700, ' Weight: 250.00GM\r\nBrands: Gamdias\r\nWarranty: 6 Months (175 Days Carry In Warranty*)\r\nStock: No\r\nModel: ZEUS E3\r\nCategories:  Mouse ', 'ACTIVE', 1, '2023-12-28 14:30:13', 5, 54, '658d8675100ee.JPG'),
(228, 'Mouse Dell Alienware 610m Gaming L/N(6m)', 4, 12800, 'Weight: 420.00GM\r\nBrands: Dell\r\nWarranty: 6 Months (175 Days Carry In Warranty*)\r\nStock: No\r\nModel: AW610M LUNARLI\r\nCategories:  Mouse ', 'ACTIVE', 0, '2023-12-30 13:32:03', 5, 54, '658d869dd249b.JPG'),
(229, 'Mouse Logitech B/T M350 Pebble (1y)', 6, 7600, 'Weight: 125.00GM\r\nBrands: Logitech\r\nWarranty: One Year (350 Days Carry In Warranty*)\r\nStock: Yes\r\nModel: M350\r\nCategories:  Mouse ', 'ACTIVE', 1, '2023-12-28 14:31:23', 5, 54, '658d86bbcc23e.jpg'),
(230, 'Mouse Logitech W/L M170 (1y)', 14, 4000, ' Weight: 100.00GM\r\nBrands: Logitech\r\nWarranty: One Year (350 Days Carry In Warranty*)\r\nStock: Yes\r\nModel: M170\r\nCategories:  Mouse ', 'ACTIVE', 1, '2023-12-28 14:32:02', 5, 54, '658d86e294085.jpg'),
(237, 'Mouse Logitech W/L M331 Silent Plus(1y)', 20, 7550, 'Weight: 150.00GM\r\nBrands: Logitech\r\nWarranty: One Year (350 Days Carry In Warranty*)\r\nStock: Yes\r\nModel: M331 Silent Plus\r\nCategories:  Mouse ', 'ACTIVE', 1, '2023-12-28 14:32:39', 5, 54, '658d870767e97.jpg'),
(238, 'Mouse Logitech W/L M171 (1y)', 10, 3900, ' Weight: 110.00GM\r\nBrands: Logitech\r\nWarranty: One Year (350 Days Carry In Warranty*)\r\nStock: Yes\r\nModel: M171\r\nCategories:  Mouse ', 'ACTIVE', 0, '2023-12-30 13:33:26', 5, 54, '658d8727aec41.jpg'),
(239, 'Mouse Lenovo Gaming M200 Rgb Usb (6m)', 4, 6301, 'Weight: 275.00GM\r\nBrands: Lenovo\r\nWarranty: 6 Months (175 Days Carry In Warranty*)\r\nStock: No\r\nModel: M200 RGB\r\nCategories:  Mouse ', 'ACTIVE', 0, '2023-12-30 13:32:57', 5, 54, '658d8740287be.jpg'),
(240, 'Keyboard Prolink Pccm-2003 Usb Combo(6m)', 15, 3500, 'Weight: 800.00GM\r\nBrands: Prolink\r\nWarranty: 6 Months (175 Days Carry In Warranty*)\r\nStock: No\r\nModel: PCCM-2003\r\nCategories:  Keyboards ', 'ACTIVE', 0, '2023-12-30 13:33:08', 4, 54, '658d9a17e487d.jpg'),
(241, 'Keyboard Logitech W/L K400 Plus (6m)', 4, 15600, 'Weight: 517.00GM\r\nBrands: Logitech\r\nWarranty: 6 Months (175 Days Carry In Warranty*)\r\nStock: Yes\r\nModel: K400\r\nCategories:  Keyboards ', 'ACTIVE', 1, '2023-12-28 16:31:13', 4, 54, '658d9a5ec6e91.jpg'),
(242, 'Keyboard Logitech B/T K380 (6m)', 14, 11400, 'Weight: 600.00GM\r\nBrands: Logitech\r\nWarranty: 6 Months (175 Days Carry In Warranty*)\r\nStock: No\r\nModel: K380\r\nCategories:  Keyboards ', 'ACTIVE', 1, '2023-12-28 15:55:47', 4, 54, '658d9a838ba52.JPG'),
(244, 'Keyboard Logitech B/T K380s Pebble (6m)', 6, 11400, 'Weight: 530.00GM\r\nBrands: Logitech\r\nWarranty: 6 Months (175 Days Carry In Warranty*)\r\nStock: Yes\r\nModel: K380S\r\nCategories:  Keyboards ', 'ACTIVE', 1, '2023-12-28 15:56:23', 4, 54, '658d9aa700f34.jpg'),
(245, 'Keyboard Flexible Usb (6m)', 11, 2100, 'Weight: 151.00GM\r\nBrands: N/Brand\r\nWarranty: 6 Months (175 Days Carry In Warranty*)\r\nStock: Yes\r\nModel: KEYBOARD\r\nCategories:  Keyboards ', 'ACTIVE', 1, '2023-12-28 16:31:13', 4, 54, '658d9ac812857.jpg'),
(246, 'Keyboard A4 Tech Km-720 Usb (1y)', 25, 2750, 'Weight: 635.00GM\r\nBrands: A4 Tech\r\nWarranty: One Year (350 Days Carry In Warranty*)\r\nStock: Yes\r\nModel: KM-720 USB\r\nCategories:  Keyboards ', 'ACTIVE', 1, '2023-12-28 15:58:15', 4, 54, '658d9b17caaed.jpg'),
(247, 'Keyboard Armaggeddon Smk-6c Usb (6m)', 14, 12500, 'Weight: 1.20KG\r\nBrands: Armaggeddon\r\nWarranty: 6 Months (175 Days Carry In Warranty*)\r\nStock: Yes\r\nModel: SMK-6C\r\nCategories:  Keyboards ', 'ACTIVE', 0, '2023-12-30 13:32:30', 4, 54, '658d9b348619b.jpg'),
(248, 'Keyboard A4 Tech Fk13 Numeric (1y)', 14, 1300, 'Weight: 200.00GM\r\nBrands: A4 Tech\r\nWarranty: One Year (350 Days Carry In Warranty*)\r\nStock: Yes\r\nModel: FK13\r\nCategories:  Keyboards ', 'ACTIVE', 1, '2023-12-28 16:31:13', 4, 54, '658d9b590546f.jpg'),
(249, 'Desktop Dell Vos3020 I3/8g/1t/256/Dos(3y)', 20, 190000, '13th Gen Intel(R) Core(TM) i3- 13100 processor (4-Core, 12MB Cache, 3.4 GHz to 4.5 GHz)\r\n8GB, 8Gx1, DDR4, 3200MHz\r\n256GB M.2 PCIe NVMe Solid Stat e Drive + 1TB 7200 rpm 3.5 SAT A Hard Drive\r\nDell Wired Keyboard KB216 Black, Dell Optical Mouse - MS116 (Black)', 'ACTIVE', 1, '2023-12-30 13:37:38', 1, 54, '65901d2294570.JPG'),
(250, 'Desktop Dell Vos3910 I3/8g/1tb/Dos(3y)', 10, 190000, '12th Gen Intel(R) Core(TM) i3- 12100 processor (4-Core= 12M C ache= 3.3GHz to 4.3GHz)<br>8GB= DDR4= 3200MHz<br>1TB 7200RPM 3.5^ SATA HDD<br>Dell MS116 Wired Mouse Black', 'ACTIVE', 0, '2023-12-30 13:48:12', 1, 54, '65901d8354f7d.JPG'),
(251, 'Desktop Hp Pro 280 G9 I3/8gb/1tb(3y)', 24, 167000, 'Intel Core i3-12100 (12M Cache= 3.30 GHz to 4.30 GHz)<br>8GB DDR4 RAM<br>Windows 11 Home<br>1TB HDD<br>HP USB Keyboard= HP USB Mouse', 'ACTIVE', 0, '2023-12-30 13:49:16', 1, 54, '65901dcdd3fb0.jpg'),
(252, 'Desktop Hp Pro 280 G9 I5/8gb/1tb(3y)', 2, 199000, 'Intel 12th Gen Core i5-12500 processor (3.0 GHz to 4.6 GHz= 18 MB)<br><br>8GB DDR4 RAM<br><br>Windows 11 Home<br><br>1TB HDD<br><br>HP USB Keyboard= HP USB Mouse', 'ACTIVE', 0, '2023-12-30 13:50:25', 1, 54, '65901e0c04c93.jpg'),
(253, 'Desktop Lenovo Neo 50t I5/8g/1tb/Dos(3y)', 6, 193750, '1x 12th Generation Intel® Core™ i5-12400 Processor(Core™ i5-12400)\r\n1x 8 GB DDR4-3200\r\n1x 1TB 7200rpm\r\n', 'ACTIVE', 1, '2023-12-30 13:42:18', 1, 54, '65901e3ab4ff5.jpg'),
(254, 'Desktop Lenovo Neo 50t I3/8g/1tb/Dos(3y', 8, 170750, '1x 12th Generation Intel® Core™ i3-12100 Processor(Core™ i3-12100)\r\n1x 8 GB DDR4-3200\r\n1x 1TB 7200rpm\r\n', 'ACTIVE', 1, '2023-12-30 13:43:06', 1, 54, '65901e6a31943.jpg'),
(255, 'Desktop Dell Vos3910 I3/8g/1tb/Dos(3y)', 13, 190000, 'Intel Core i3-12100 (12M Cache, 3.30 GHz to 4.30 GHz)\r\n8GB DDR4 RAM\r\nWindows 11 Home\r\n1TB HDD\r\nHP USB Keyboard, HP USB Mouse', 'ACTIVE', 1, '2023-12-30 13:48:32', 1, 54, '65901fb086086.JPG'),
(256, 'Desktop Hp Pro 280 G9 I3/8gb/1tb(3y)', 5, 167000, 'Intel Core i3-12100 (12M Cache, 3.30 GHz to 4.30 GHz)\r\n8GB DDR4 RAM\r\nWindows 11 Home\r\n1TB HDD\r\nHP USB Keyboard, HP USB Mouse', 'ACTIVE', 1, '2023-12-30 13:49:38', 1, 54, '65901ff25552a.jpg'),
(257, 'Desktop Hp Pro 280 G9 I5/8gb/1tb(3y)', 5, 0, 'Intel 12th Gen Core i5-12500 processor (3.0 GHz to 4.6 GHz, 18 MB)\r\n8GB DDR4 RAM\r\nWindows 11 Home\r\n1TB HDD\r\nHP USB Keyboard, HP USB Mouse', 'ACTIVE', 1, '2023-12-30 13:50:47', 1, 54, '6590203711465.jpg'),
(258, 'Motherboard Afox H110 Ddr4 (11m)', 20, 19950, 'Model Name: IH110D4-MA4-V2\r\nChipset: Intel® H110 \r\nSocket:INTEL Socket 1151\r\nSupports Intel Core™ i7 / Core™ i5 / Core™ i3 / Pentium® / Celeron® processors\r\nSupports Intel 6th, 7th, 8th and 9th Generation (CPU up to 95 watts)\r\nDual channel DDR4 slots\r\n2133MHz Memory up to 32GB', 'ACTIVE', 1, '2023-12-30 13:55:18', 2, 54, '659021462e33a.JPG'),
(259, 'Motherboard Afox H81 Ddr3 (11m)', 15, 18500, 'Model Name: IH81-MA2-V4\r\nChipset: Intel® H81\r\nSocket: INTEL Socket 1150\r\nSupports Intel 4th generation Core™ i7 / Core™ i5 / Core™ i3 /  Pentium® / Celeron® / Xeon® Processors (CPU up to 95 watts)\r\nDual channel DDR3, two memory slots\r\n1066 / 1333 / 1600 / 1860MHz Memory up to 16GB\r\nHigh speed USB interface', 'ACTIVE', 1, '2023-12-30 13:56:13', 2, 54, '6590217d186d9.jpg'),
(260, 'Motherboard Asus H81m-K (1y)', 21, 24200, 'Intel® Socket 1150 for 4th Generation Core™ i7/Core™ i5/Core™ i3/Pentium®/Celeron® Processors<br>2 x DIMM= Max. 16GB= DDR3 1600/1333/1066 MHz Non-ECC= Un-buffered Memory<br>Intel® H81 chipset ', 'ACTIVE', 1, '2024-01-06 12:19:32', 2, 54, '659021c6ca787.png'),
(261, 'Motherboard Asus Prime B660m(3y)', 8, 75600, 'Intel® Socket 1150 for 4th Generation Core™ i7/Core™ i5/Core™ i3/Pentium®/Celeron® Processors\n2 x DIMM, Max. 16GB, DDR3 1600/1333/1066 MHz Non-ECC, Un-buffered Memory\nIntel® H81 chipset ', 'ACTIVE', 1, '2024-01-06 12:19:37', 2, 54, '6590221a00d97.jpg'),
(262, 'Motherboard Asus Prime H410m-E Ddr4 (2y)', 3, 31750, 'Intel® Socket 1200 for 10th Gen Intel® Core™, Pentium® Gold and Celeron® Processors \r\nIntel® H410\r\n2 x DIMM, Max. 64GB, DDR4 2933/2800/2666/2400/2133 MHz Non-ECC, Un-buffered Memory \r\n', 'ACTIVE', 1, '2023-12-30 14:01:54', 2, 54, '659022d2a3e06.jpg'),
(263, 'Motherboard Asus Rog Maximus Z790 Hero(3y)', 2, 277750, 'Intel® Socket LGA1700 for Intel® Core™ 14th & 13th Gen Processors, Intel® Core™ 12th Gen, Pentium® Gold and Celeron® Processors\nIntel® Z790 Chipset\n4 x DIMM, Max. 192GB, DDR5\n256 Mb Flash ROM, UEFI AMI BIOS', 'ACTIVE', 1, '2024-01-06 12:20:16', 2, 54, '659023358f267.jpg'),
(264, 'Laptop Acer A515 I3/8gb/512gb(2y)', 250, 171000, 'Intel Core i3-1305U processor\n39.6 cm (15.6\") Display with Full HD 1920 x 1080, Acer ComfyView™ LED-backlit TFT LCD\n8 GB LPDDR5\n512 GB, PCIe Gen4, 16 Gb/s, NVMe\nBattery : Lithium Ion (Li-Ion) 50Wh', 'ACTIVE', 1, '2024-01-06 12:21:33', 6, 54, '659024c32967e.jpg'),
(265, 'Laptop Asus Fx507z I5/16/512(1y)', 4, 304550, 'FX507ZC4-HN057\nIDIA® GeForce RTX™ 3050 Laptop GPU, 1790MHz* at 95W (1740MHz Boost Clock+50MHz OC, 80W+15W Dynamic Boost), \n4GB GDDR6\n15.6-inch, FHD (1920 x 1080) 16:9, Value IPS-level, Anti-glare display, \nsRGB:62.50%, Adobe:47.34%, \nRefresh Rate:144Hz, Adaptive-Sync, MUX Switch + Optimus\n8GB X 2 DDR4\n512GB PCIe® G3 SSD\n56WHrs, 4S1P, 4-cell Li-ion', 'ACTIVE', 1, '2024-01-06 12:16:28', 6, 54, '65902519cf341.JPG'),
(266, 'Laptop Dell Ins 3511 I5/8/512/2g(2y)', 14, 296000, '11th Generation Intel(R) Core( TM) i5-1135G7 Processor (8MB C ache, up to 4.2 GHz)\r\n512GB M.2 PCIe NVMe Solid Stat e Drive\r\nWindows 11 Home\r\n8GB, 1x8GB, DDR4, 3200MHz\r\n15.6-inch FHD (1920 x 1080) An ti-glare LED Backlight Non-Tou ch Narrow Border WVA Display\r\nNVIDIA(R) GeForce(R) MX350 wit h 2GB GDDR5 graphics memory\r\n3-Cell Battery, 41WHr (Integrated)', 'ACTIVE', 1, '2024-01-06 12:22:02', 6, 54, '6590255b82a6c.JPG'),
(267, 'Laptop Hp15-Dy5131wm I3/8g/256(1y)', 24, 194500, 'i3 processorIntel® Core™ i3-1215U (up to 4.4 GHz with Intel® Turbo Boost Technology= 10 MB L3 cache= 6 cores= 8 threads)<br><br>Windows 11 Home in S mode<br><br>8 GB DDR4-3200 MHz RAM<br><br>256 GB PCIe® NVMe™ M.2 SSD<br><br>15.6^ diagonal= FHD (1920 x 1080)= micro-edge= anti-glare= 250 nits= 45% NTSC<br><br>3-cell= 41 Wh Li-ion', 'ACTIVE', 0, '2023-12-30 14:22:07', 6, 54, '659025b794932.jpg'),
(268, 'Laptop Lenovo 15irh8 I5/16/512(2y)', 6, 282900, '12th Generation Intel® Core™ i5-12450H Processor\nNVIDIA® GeForce RTX™ 2050 4GB\n8 GB DDR5-4800\nWindows 11 Home Single Language 64\n512 GB SSD PCIe\n15.6\"  FHD (1920 x 1080)', 'ACTIVE', 1, '2024-01-06 12:21:16', 6, 54, '65902646ea11e.jpg'),
(269, 'Laptop Macbook A2681 Cpu10 8g(1y)', 7, 489900, 'AppleM2\r\nApple (10-Core)\r\n8 GB RAM\r\n13.6\" Display\r\n1 x 512 GB / Integrated NVMe SSD\r\nLithium-Ion Polymer (LiPo) 52.6 Wh\r\n', 'ACTIVE', 1, '2024-01-06 12:21:54', 6, 54, '659026b453701.jpg'),
(270, 'Laptop Hp 450-G9 I7/8gb/512g (3y)', 6, 382500, 'Intel Core i7 – 1255U Processor\r\n8GB RAM\r\n512GB Storage\r\n15.6\" FHD [1920 x 1080] Display\r\nWindows 11 Home\r\n', 'ACTIVE', 1, '2024-01-06 12:22:26', 6, 54, '659027dd7398a.jpg'),
(271, 'Ssd Kingston 2tb PCIe M.2 2280 Nvme (3y)', 24, 38500, 'Form factor: M.2 2280\nInterface: PCIe 4.0 x4 NVMe\nCapacities: 2TB\nSequential read/write: 2TB – 3,500/2,800MB/s\nNAND: 3D\nEndurance (Total bytes written): 2TB – 640TB\nStorage temperature: -40°C~85°C\nOperating temperature: 0°C~70°C\nDimensions: 22mm x 80mm x 2.2mm\nWeight: 7g (all capacities)\nVibration operating: 2.17G (7-800 Hz)\nVibration non-operating: 20G (20-1000Hz)\nMTBF: 2,000,000 hours', 'ACTIVE', 1, '2024-01-06 12:23:04', 7, 54, '659031dc306bf.jpg'),
(274, 'Ssd Samsung 1tb M.2 (2280) Nvme (2y)', 100, 33750, '1,000GB (1GB,1 Billion byte by IDEMA) \nM.2 (2280)\nInterface\nPCIe Gen 3.0 x4, NVMe 1.4\n 80.15 x 22.15 x 2.38 (mm)\n Max 8.0 g Weight\nSamsung V-NAND 3-bit MLC\nHMB', 'ACTIVE', 1, '2024-01-06 12:18:38', 7, 54, '6590324461405.jpg'),
(275, 'Hard Seagate 2tb Laptop Sata (2y)', 41, 34300, 'Seagate\nBarraCuda\nST2000LM015\nBare Drive\nSATA 6.0Gb/s\n2TB\n128MB\n5400 RPM', 'ACTIVE', 1, '2024-01-06 12:13:51', 7, 54, '659032bfa144f.jpg'),
(276, 'Hard Toshiba 1tb Laptop Sata (2y)', 12, 15750, 'Toshiba\nHDD\n2.5\"\n1 Tb\nSATA III\n128 Mb\n5400rpm', 'ACTIVE', 1, '2024-01-06 12:02:11', 7, 54, '659032f66fa1d.jpg'),
(277, 'Ssd Adata 1tb Su650 Sata (3y)', 250, 16900, 'Brand: ‎ADATA\nperformance up to 520/450MB/s\nItem model number: ‎ASU650SS-1TT-R\nItem Weight: ‎1.76 ounces\nProduct Dimensions: ‎19.69 x 19.69 x 11.02 inches\nItem Dimensions: LxWxH ‎19.69 x 19.69 x 11.02 inches\nColor: ‎SU650\nHard Drive Interface: ‎Serial ATA\nManufacturer: ‎ADATA', 'ACTIVE', 1, '2024-01-06 12:05:16', 7, 54, '6590333777c09.JPG'),
(278, 'Ssd Kingston 480gb A400 Sata (3y)', 250, 13000, 'A400 \r\nSA400S37/480G \r\nInternal Solid State Drive (SSD) \r\nConsumer \r\n480GB \r\nTLC \r\nSATA III \r\n500 MBps ', 'ACTIVE', 1, '2023-12-30 15:14:27', 7, 54, '659033d334c88.jpg'),
(279, 'Hard Disk Seagate 1tb Sv35 Skyhawk (2y)', 21, 16800, 'ST1000VX000\r\nSV35.6\r\n1TB\r\nSATA 6Gbps\r\n7200RPM\r\n64MB\r\n146.99mm\r\n101.6mm\r\n19.98mm\r\n400g\r\n5.90W', 'ACTIVE', 1, '2023-12-30 15:15:27', 7, 54, '6590340fa9615.jpg'),
(280, 'Hard Disk Wd 2tb Sata Purple (2y)', 21, 24600, 'Cache Buffer: 64MB\r\nDrive Interface: SATA 6 Gb/s\r\nDrive Size - Imperial: 3.5\"\r\nDrive Type: Internal\r\nHard Drive Capacity: 2TB', 'ACTIVE', 1, '2023-12-30 15:15:59', 7, 54, '6590342f52596.jpg'),
(281, 'Monitor Asus 27 inch Vz279heg1r Ips (3y)', 24, 53750, 'Panel Size (inch) : 27\r\nAspect Ratio : 16:9\r\nDisplay Viewing Area (H x V) : 597.888 x 336.312 mm\r\nDisplay Surface : Non-Glare\r\nBacklight Type : LED\r\nPanel Type : IPS\r\nViewing Angle (CR?10, H/V) : 178°/ 178°\r\nPixel Pitch : 0.311mm\r\nResolution : 1920x1080\r\nColor Space (sRGB) : 100%\r\nBrightness (Typ.) : 250cd/?\r\nContrast Ratio (Typ.) : 1000:1\r\nASUS Smart Contrast Ratio (ASCR) : 100000000:1\r\nDisplay Colors : 16.7M\r\nResponse Time : 1ms MPRT\r\nRefresh Rate (Max) : 75Hz\r\nFlicker-free : Yes', 'ACTIVE', 1, '2024-01-06 11:49:27', 8, 54, '659037ec54d67.jpg'),
(282, 'Monitor Asus 31.5 inch  Xg32vqr (3y)', 31, 212000, 'Panel Size: Wide Screen 31.5\"(80.1 cm) 16:9\nColor Saturation : 125% sRGB / DCI-P3 90%\nPanel Type : VA\nTrue Resolution : 2560x1440\nDisplay Viewing Area(HxV) : 697.344 x 392.256 mm\nDisplay Surface : Non-glare\nPixel Pitch : 0.2724 mm\nBrightness : 450 cd/? (Typical)\nContrast Ratio (Max) : 3000:1\nViewing Angle (CR?10) : 178°(H)/178°(V)\nResponse Time : 4ms (Gray to Gray)\nFlicker free : Yes\nCurved Panel : 1800R\nHDR (High Dynamic Range) Support : Yes\nRefresh Rate(max) : 144Hz', 'ACTIVE', 1, '2024-01-06 12:14:37', 8, 54, '6590380f6eb7b.jpg'),
(283, 'Monitor Asus Rog Strix 49 inch (3y)', 2, 450000, 'Panel Size (inch) : 49\nAspect Ratio : 32:9\nDisplay Viewing Area (H x V) : 1191.936 (H) x 335.232 (V) mm\nDisplay Surface : Non-Glare\nBacklight Type : LED\nPanel Type : VA\nViewing Angle (CR?10, H/V) : 178°/ 178°\nCurvature : 1800R\nPixel Pitch : 0.233mm\nResolution : 5120x1440\nColor Space (sRGB) : 120%\nColor Space (DCI-P3) : 90%\nBrightness (HDR, Peak) : 550 cd/?\nBrightness (Typ.) : 450cd/?\nContrast Ratio (Typ.) : 3000:1\nDisplay Colors : 1073.7M (10 bit)\nResponse Time : 1ms MPRT\nRefresh Rate (Max) : 165Hz\nFlicker-free : Yes', 'ACTIVE', 1, '2024-01-06 12:04:47', 8, 54, '6590382b8f216.jpg'),
(284, 'Monitor Dell 24 inch  P2418ht Ips Touch (3y)', 3, 115000, 'Device Type : LED-backlit LCD monitor - 24\" - touchscreen\r\nFeatures : USB hub\r\nPanel Type : IPS\r\nAspect Ratio : 16:09\r\nNative Resolution : Full HD (1080p) 1920 x 1080 at 60 Hz\r\nPixel Pitch : 0.275 mm x 0.275 mm\r\nBrightness : 250 cd/m²\r\n \r\nContrast Ratio : 1000:1 / 8000000:1 (dynamic)\r\nResponse Time : 6 ms (gray-to-gray)\r\nColor Support : 16.7 million colors\r\nInput Connectors : HDMI, VGA, DisplayPort\r\nDisplay Position Adjustments : Height, swivel, tilt\r\nScreen Coating : Anti-glare, 3H Hard Coating\r\nDimensions (WxDxH) - with stand : 21.17 in x 2.13 in x 12.65 in\r\nWeight : 6.88 lbs\r\nCompliant Standards : RoHS\r\nTCO Certified\r\nProduct Description : Dell 24 Touch Monitor - P2418HT', 'ACTIVE', 1, '2024-01-06 11:49:09', 8, 54, '65903877a6923.jpg'),
(285, 'Monitor Acer 19.5 inch K202hql Led (3y)', 5, 24600, 'Aspect Ratio : 16:9\r\nResponse Time : 5 ms\r\nBacklight Technology : LED\r\nTilt Angle : -5° to 25°', 'ACTIVE', 1, '2024-01-06 11:49:02', 8, 54, '6590389ecc707.JPG'),
(286, 'Monitor Viewsonic 21.5 inch (3y)', 15, 36500, 'Display Size (in.): 22\nViewable Area (in.): 21.5\nPanel Type: IPS Technology\nResolution: 1920 x 1080\nResolution Type: FHD (Full HD)\nStatic Contrast Ratio: 1,000:1 (typ)\nDynamic Contrast Ratio: 50M:1\nLight Source: LED\nBrightness: 250 cd/m² (typ)\nColors: 16.7M\nColor Space Support: 8 bit (6 bit + FRC)\n\nAspect Ratio: 16:9\n\nResponse Time (Typical GTG): 4ms\n\nViewing Angles: 178º horizontal, 178º vertical\n\nBacklight Life (Hours): 30000 Hrs (Min)\n\nCurvature: Flat\nRefresh Rate (Hz): 75\nAdaptive Sync: Yes\nBlue Light Filter: Yes\nFlicker-Free: Yes\nColor Gamut: NTSC: 72% size (Typ)\nsRGB: 104% size (Typ)\nPixel Size: 0.249 mm (H) x 0.241 mm (V)\nSurface Treatment: Anti-Glare, Hard Coating (3H)', 'ACTIVE', 1, '2024-01-06 12:05:56', 8, 54, '659038bd797ad.jpg'),
(287, 'Ram Adata 8gb Ddr4 3200 (3y)', 245, 7600, 'Model Number\r\n Premier DDR4 3200 U-DIMM Memory\r\nSpecifications\r\nModule Type - U-DIMM\r\nForm Factor - standard 1.23\" height\r\nMemory Type - DDR4\r\nStandard  -JEDEC\r\nPin Count  - 288-pins\r\nDensity - 8GB\r\nSpeed - 3200MHz\r\nDRAM spec/VCC  - DDR4 STD 1.2V\r\nOperating temperature  - 0°C to 85°C', 'ACTIVE', 1, '2023-12-30 15:42:48', 9, 54, '65903a78c42a9.jpg'),
(288, 'Ram Corsair Dominator  Ddr5(3y)', 5, 63800, 'Fan Included: No\nMemory Color: BLACK\nMemory Compatibility: Intel 600 Series,Intel 700 Series\nMemory Detail Compatibility: Intel 600 Series,Intel 700 Series\nHeat Spreader: Aluminum\nLED Lighting: RGB\nMemory Series: DOMINATOR RGB DDR5\nMemory Size: 32GB\nMemory Type: DDR5\nPackage Memory Format: DIMM\nPackage Memory Pin: 288\nPerformance Profile: XMP 3.0\nSPD Latency: 40-40-40-77\n\nSPD Speed: 4800MHz\nSPD Voltage: 1.1V\nTested Speed: 6200 MT/s\nTested Voltage: 1.30V\nInterface: DDR5\nSingle / Multi-Zone Lighting: Dynamic MultiZone\nWeight: 0.244\nPower Draw: Extreme OC PMIC', 'ACTIVE', 1, '2024-01-06 12:06:57', 9, 54, '65903aad8fc86.jpg'),
(289, 'Ram Corsair Vengeance (3y)', 9, 31850, 'Memory Series\nVENGEANCE RGB PRO\nMemory Type \nDDR4 \nMemory Size \n16GB Kit (2 x 8GB)\nTested Latency \n18-22-22-42\nTested Voltage \n1.35V\nTested Speed \n3600MHz\nLED Lighting \nRGB\nSingle Zone / Multi-Zone Lighting \nIndividually Addressable\nSPD Latency \n15-15-15-36\nSPD Speed \n2133MHz\nSPD Voltage \n1.2V\nSpeed Rating \nPC4-28800 (3600MHz)\nCompatibility \nIntel 300 Series,Intel 400 Series,Intel X299,AMD 300 Series,AMD 400 Series,AMD X570\nHeat Spreader \nAnodized Aluminum\nPackage Memory Format \nDIMM\nPerformance Profile \nXMP 2.0\nPackage Memory Pin\n28', 'ACTIVE', 1, '2024-01-06 12:08:17', 9, 54, '65903b042489d.jpg'),
(290, 'Ram Adata 16gb Ddr4 3200 (3y)', 11, 11500, 'Module Type: SODIMM\nMemory Type: DDR4\nStandard: JEDEC\nInterface: 260-pin 1.2V Standard1.18\" height\nCapacity: 8GB/ 16GB / 32GB\nSpeed: 3200MHz\nCAS Latency:\n3200MHz: CL 22-22-22', 'ACTIVE', 1, '2024-01-06 12:11:33', 9, 54, '65903b2377c36.JPG'),
(291, 'Ram Kingston 16gb Ddr4 (3y)', 26, 13620, 'Brand - Kingston\nMemory Capacity  -16GB\nSpeed  - 2666MHz (PC4-21300)\nError Check  - Non-ECC\nModel/Series/Type  - ValueRAM\nModule Type  - SODIMM\nCAS Latency  - CL19\nForm Factor  - DDR4\nRank - 2R (Dual Rank)\nPins  - 260 Pin\nOperating Temperature  - 0°C to 85°C\nMemory Voltage  - 1.2v\nMemory Depth  - 2G', 'ACTIVE', 1, '2024-01-06 12:12:05', 9, 54, '65903b735c0f4.jpg'),
(292, 'Ram Transcend 16gb Ddr5 4800 (2y)', 18, 17500, 'RAM Type : DDR5\nDIMM Type : Unbuffered SO-DIMM\nSpeed : 4800\nCAS Latency : CL40\nCapacity : 16GB\nRank x Org : 1Rx8\nComponent Composition : (2Gx8)x8\nVoltage : 1.1V\nPin Count : 262 pin\nPCB Height : 1.18 inches', 'ACTIVE', 1, '2024-01-06 12:12:35', 9, 54, '65903b9705729.png');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(45) NOT NULL,
  `cat_img` text DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`cat_id`, `cat_name`, `cat_img`, `create_time`) VALUES
(1, 'Desktop Pc', 'Desktop Pc.png', '2023-12-18 17:42:24'),
(2, 'Motherboard', 'motherboard.png', '2023-12-18 17:42:50'),
(4, 'Keyboard', 'keyboard.png', '2023-12-18 17:43:11'),
(5, 'Mouse', 'mouse.png', '2023-12-18 17:43:34'),
(6, 'Laptop', 'laptop.png', '2023-12-18 17:43:58'),
(7, 'Hard Disk & Storage', 'Hard Disk & Storage.png', '2023-12-20 17:56:14'),
(8, 'Monitor', 'Monitor.png', '2023-12-20 17:56:56'),
(9, 'RAM', 'Ram.png', '2023-12-30 14:26:02');

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `shop_id` int(11) NOT NULL,
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
  `create_time` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_user_id` int(11) NOT NULL,
  `nb_description` text DEFAULT NULL,
  `shop_status` varchar(20) NOT NULL DEFAULT 'ACTIVE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`shop_id`, `shop_name`, `email`, `tel`, `address`, `city`, `zip_code`, `roc_number`, `dp_logo`, `dp_banner`, `is_active`, `create_time`, `user_user_id`, `nb_description`, `shop_status`) VALUES
(54, 'Mr.PC', 'shop@mrpc.lk', '0 756087339', 'Shop', 'Shop', 'Shop', 'pv-12345678', '', '', 1, '2023-12-18 07:38:35', 24, '', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `site_order`
--

CREATE TABLE `site_order` (
  `order_id` int(11) NOT NULL,
  `order_number` varchar(10) NOT NULL,
  `cus_order_id` int(11) DEFAULT NULL,
  `de_address` varchar(350) NOT NULL,
  `de_tel` varchar(12) NOT NULL,
  `de_note` text DEFAULT NULL,
  `de_status` varchar(45) NOT NULL,
  `total_bill` double NOT NULL,
  `create_time` datetime DEFAULT current_timestamp(),
  `user_user_id` int(11) NOT NULL,
  `de_city` varchar(20) DEFAULT NULL,
  `de_code` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `site_order`
--

INSERT INTO `site_order` (`order_id`, `order_number`, `cus_order_id`, `de_address`, `de_tel`, `de_note`, `de_status`, `total_bill`, `create_time`, `user_user_id`, `de_city`, `de_code`) VALUES
(35, 'SAI874506', NULL, '79/7 Polhena Madapatha Piliyanadala', '0756087339', 'Ilove you             ', 'DELIVERED', 21800, '2023-12-28 22:01:13', 27, 'Piliyandala', '458484');

-- --------------------------------------------------------

--
-- Table structure for table `subscribe`
--

CREATE TABLE `subscribe` (
  `sub_id` int(11) NOT NULL,
  `sub_email` varchar(200) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
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
  `date_created` datetime DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `email`, `password`, `acc_type`, `acc_status`, `first_name`, `last_name`, `full_name`, `birthday`, `nic`, `tel`, `gender`, `home_address`, `home_city`, `zip_code`, `dp_img`, `date_created`, `date_updated`, `is_active`) VALUES
(9, 'admin@mrpc.lk', '$2y$10$E8QBDFs.e0NSApBkB4i2WuE1Wdzslnytirs93yH7tBXdyosirhrG6', 'ADMIN', 'VERIFIED', 'ADMIN', 'ADMIN', 'ADMIN', '2000-10-13', 'ADMIN', '0000000000', '', 'ADMIN', 'ADMIN', 'ADMIN', NULL, '2023-03-12 20:43:54', NULL, 1),
(24, 'shop@mrpc.lk', '$2y$10$E8QBDFs.e0NSApBkB4i2WuE1Wdzslnytirs93yH7tBXdyosirhrG6', 'SHOPPER', 'ACTIVE', 'Shop', 'MrPC', 'Shop Mr.PC', '2023-03-07', '200028702523', '0763133646', '', 'SHOP', 'SHOP', 'SHOP', NULL, '2023-03-26 04:44:37', '2023-03-25 23:12:13', 1),
(27, 'ashenecom@gmail.com', '$2y$10$gb8DE6qlqyN6Q0Zgdphkpe8T8zWo6rSt4JpbX.NcvpNWY8a4Sxeiq', 'CUSTOMER', 'ACTIVE', 'Ashen', 'Shanuka', 'Ashen Shanuka', '2000-11-03', 'Ashen', '0756087339', 'male', '79/7 Polhena Madapatha Piliyanadala', 'Piliyandala', '10300', NULL, '2023-12-28 21:01:09', NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `complaint`
--
ALTER TABLE `complaint`
  ADD PRIMARY KEY (`com_id`),
  ADD KEY `fk_complaint_order_item1_idx` (`order_item_item_id`);

--
-- Indexes for table `inquiry`
--
ALTER TABLE `inquiry`
  ADD PRIMARY KEY (`inq_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `fk_order_item_product1_idx` (`product_product_id`),
  ADD KEY `fk_order_item_order1_idx` (`order_order_id`);

--
-- Indexes for table `password_reset_request`
--
ALTER TABLE `password_reset_request`
  ADD PRIMARY KEY (`id_reset`),
  ADD KEY `fk_password_reset_request_user1_idx` (`user_user_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `fk_product_product_category1_idx` (`product_category_cat_id`),
  ADD KEY `fk_product_shop1_idx` (`shop_shop_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`shop_id`),
  ADD KEY `fk_shop_user1_idx` (`user_user_id`);

--
-- Indexes for table `site_order`
--
ALTER TABLE `site_order`
  ADD PRIMARY KEY (`order_id`),
  ADD UNIQUE KEY `order_number_UNIQUE` (`order_number`),
  ADD KEY `fk_order_user1_idx` (`user_user_id`);

--
-- Indexes for table `subscribe`
--
ALTER TABLE `subscribe`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `complaint`
--
ALTER TABLE `complaint`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `inquiry`
--
ALTER TABLE `inquiry`
  MODIFY `inq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `password_reset_request`
--
ALTER TABLE `password_reset_request`
  MODIFY `id_reset` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=293;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `shop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `site_order`
--
ALTER TABLE `site_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `subscribe`
--
ALTER TABLE `subscribe`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

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
