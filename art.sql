-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2024 at 10:59 AM
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
-- Database: `art`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(50) NOT NULL,
  `admin_name` varchar(225) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `cartitem`
--

CREATE TABLE `cartitem` (
  `cartitemID` bigint(20) NOT NULL,
  `userID` int(50) NOT NULL,
  `productID` int(50) NOT NULL,
  `art_name` varchar(50) NOT NULL,
  `artist_name` varchar(50) NOT NULL,
  `art_price` int(50) NOT NULL,
  `createDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `art_image` varchar(50) NOT NULL,
  `Amount` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cartitem`
--

INSERT INTO `cartitem` (`cartitemID`, `userID`, `productID`, `art_name`, `artist_name`, `art_price`, `createDate`, `art_image`, `Amount`) VALUES
(165, 0, 8, 'Sad Lady', 'Zoya Deb', 400, '2024-01-11 10:24:02', 'uploads/img_3.png', 0),
(167, 0, 7, 'Face of War', 'Artist Bipul Singh', 1500, '2024-01-12 14:08:55', 'uploads/img_2.png', 0),
(169, 0, 8, 'Sad Lady', 'Zoya Deb', 400, '2024-01-15 15:24:25', 'uploads/img_3.png', 0),
(190, 0, 7, 'Face of War', 'Artist Bipul Singh', 1500, '2024-02-04 12:18:12', 'uploads/img_2.png', 0),
(191, 0, 8, 'Sad Lady', 'Zoya Deb', 400, '2024-02-04 12:33:08', 'uploads/img_3.png', 0),
(198, 0, 7, 'Face of War', 'Artist Bipul Singh', 1500, '2024-02-12 03:06:40', 'uploads/img_2.png', 0),
(199, 0, 7, 'Face of War', 'Artist Bipul Singh', 1500, '2024-02-12 03:10:17', 'uploads/img_2.png', 0),
(201, 0, 11, 'Power of knowledge', 'Bipul Singh', 800, '2024-03-04 04:53:30', 'uploads/img_6.png', 0),
(202, 0, 9, 'The Artist III', 'Zoya Deb', 1500, '2024-03-04 05:11:43', 'uploads/img_4.png', 0),
(203, 0, 11, 'Power of knowledge', 'Bipul Singh', 800, '2024-03-04 05:44:48', 'uploads/img_6.png', 0),
(208, 0, 10, 'Abstract Floral ', 'Anupa Paul', 600, '2024-03-20 06:20:39', 'uploads/img_5.png', 0),
(209, 0, 10, 'Abstract Floral ', 'Anupa Paul', 600, '2024-03-20 06:20:43', 'uploads/img_5.png', 0),
(211, 1, 9, 'The Artist III', 'Zoya Deb', 1500, '2024-03-20 06:21:21', 'uploads/img_4.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `new_release`
--

CREATE TABLE `new_release` (
  `id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_description` varchar(225) NOT NULL,
  `product_price` varchar(50) NOT NULL,
  `product_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `new_release`
--

INSERT INTO `new_release` (`id`, `product_name`, `product_description`, `product_price`, `product_image`) VALUES
(6, 'Eyes of Hope ', 'Khula Aasmaan', 'Rs. 10,000', 'uploads/img_1.png'),
(7, 'Face of War', 'Artist Bipul Singh', 'Rs. 20,000', 'uploads/img_2.png'),
(8, 'Sad Lady', 'Zoya Deb', 'Rs. 5,000', 'uploads/img_3.png'),
(9, 'The Artist III', 'Zoya Deb', 'Rs. 15,000', 'uploads/img_4.png'),
(10, 'Abstract Floral ', 'Anupa Paul', 'Rs. 5,000', 'uploads/img_5.png'),
(11, 'Power of knowledge', 'Bipul Singh', 'Rs. 20,000', 'uploads/img_6.png');

-- --------------------------------------------------------

--
-- Table structure for table `orderitem`
--

CREATE TABLE `orderitem` (
  `orderitemID` int(50) NOT NULL,
  `orderID` int(50) NOT NULL,
  `productID` int(50) NOT NULL,
  `art_name` varchar(225) NOT NULL,
  `artist_name` varchar(255) NOT NULL,
  `art_price` int(50) NOT NULL,
  `art_image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderitem`
--

INSERT INTO `orderitem` (`orderitemID`, `orderID`, `productID`, `art_name`, `artist_name`, `art_price`, `art_image`) VALUES
(407, 111, 7, 'Face of War', 'Artist Bipul Singh', 1500, 'uploads/img_2.png'),
(408, 111, 8, 'Sad Lady', 'Zoya Deb', 400, 'uploads/img_3.png'),
(409, 111, 7, 'Face of War', 'Artist Bipul Singh', 1500, 'uploads/img_2.png'),
(410, 111, 8, 'Sad Lady', 'Zoya Deb', 400, 'uploads/img_3.png'),
(411, 112, 11, 'Power of knowledge', 'Bipul Singh', 800, 'uploads/img_6.png'),
(412, 112, 10, 'Abstract Floral ', 'Anupa Paul', 600, 'uploads/img_5.png'),
(413, 112, 11, 'Power of knowledge', 'Bipul Singh', 800, 'uploads/img_6.png'),
(414, 112, 10, 'Abstract Floral ', 'Anupa Paul', 600, 'uploads/img_5.png'),
(415, 113, 8, 'Sad Lady', 'Zoya Deb', 400, 'uploads/img_3.png'),
(416, 113, 7, 'Face of War', 'Artist Bipul Singh', 1500, 'uploads/img_2.png'),
(417, 113, 8, 'Sad Lady', 'Zoya Deb', 400, 'uploads/img_3.png'),
(418, 113, 7, 'Face of War', 'Artist Bipul Singh', 1500, 'uploads/img_2.png'),
(419, 114, 9, 'The Artist III', 'Zoya Deb', 1500, 'uploads/img_4.png'),
(420, 114, 9, 'The Artist III', 'Zoya Deb', 1500, 'uploads/img_4.png'),
(421, 115, 7, 'Face of War', 'Artist Bipul Singh', 1500, 'uploads/img_2.png'),
(422, 115, 7, 'Face of War', 'Artist Bipul Singh', 1500, 'uploads/img_2.png'),
(423, 116, 7, 'Face of War', 'Artist Bipul Singh', 1500, 'uploads/img_2.png'),
(424, 116, 7, 'Face of War', 'Artist Bipul Singh', 1500, 'uploads/img_2.png'),
(425, 117, 7, 'Face of War', 'Artist Bipul Singh', 1500, 'uploads/img_2.png'),
(426, 117, 8, 'Sad Lady', 'Zoya Deb', 400, 'uploads/img_3.png'),
(427, 117, 9, 'The Artist III', 'Zoya Deb', 1500, 'uploads/img_4.png'),
(428, 118, 7, 'Face of War', 'Artist Bipul Singh', 1500, 'uploads/img_2.png'),
(429, 119, 11, 'Power of knowledge', 'Bipul Singh', 800, 'uploads/img_6.png'),
(430, 119, 8, 'Sad Lady', 'Zoya Deb', 400, 'uploads/img_3.png'),
(431, 120, 8, 'Sad Lady', 'Zoya Deb', 400, 'uploads/img_3.png'),
(432, 121, 8, 'Sad Lady', 'Zoya Deb', 400, 'uploads/img_3.png'),
(433, 121, 8, 'Sad Lady', 'Zoya Deb', 400, 'uploads/img_3.png'),
(434, 122, 11, 'Power of knowledge', 'Bipul Singh', 800, 'uploads/img_6.png'),
(435, 122, 6, 'Eyes of Hope ', 'Khula Aasmaan', 1000, 'uploads/img_1.png'),
(436, 122, 8, 'Sad Lady', 'Zoya Deb', 400, 'uploads/img_3.png');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int(50) NOT NULL,
  `userID` int(50) NOT NULL,
  `f_name` varchar(50) NOT NULL,
  `l_name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `country` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `zipcode` int(50) NOT NULL,
  `total_amount` int(50) NOT NULL,
  `placed_on` date NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `userID`, `f_name`, `l_name`, `email`, `address`, `country`, `state`, `zipcode`, `total_amount`, `placed_on`, `status`) VALUES
(114, 1, 'Praveen', 'Kumar', 'praveennani963@gmail.com', 'vempalli raod', 'India', '4', 516309, 1770, '2024-01-16', 'pending'),
(115, 1, 'Praveen', 'Kumar', 'praveennani963@gmail.com', 'vempalli raod', 'India', '4', 516309, 1770, '2024-01-16', 'pending'),
(116, 1, 'Praveen', 'Kumar', 'praveennani963@gmail.com', 'vempalli raod', 'India', '4', 516309, 1770, '2024-01-18', 'pending'),
(117, 1, 'Praveen', 'Kumar', 'praveennani963@gmail.com', 'vempalli raod', 'India', '4', 516309, 4012, '2024-01-18', 'pending'),
(118, 1, 'Praveen', 'Kumar', 'praveennani963@gmail.com', 'vempalli raod', 'India', '4', 516309, 1770, '2024-01-18', 'pending'),
(119, 1, 'Praveen', 'Kumar', 'praveennani963@gmail.com', 'vempalli raod', 'India', '4', 516309, 1416, '2024-01-29', 'pending'),
(120, 1, 'Praveen', 'Kumar', 'praveennani963@gmail.com', 'vempalli raod', 'India', '4', 516309, 472, '2024-02-04', 'pending'),
(121, 1, 'Praveen', 'Kumar', 'praveennani963@gmail.com', 'vempalli raod', 'India', '4', 516309, 944, '2024-02-05', 'pending'),
(122, 1, 'Praveen', 'Kumar', 'praveennani963@gmail.com', 'vempalli raod', 'India', '4', 516309, 2596, '2024-03-20', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productID` int(11) NOT NULL,
  `sellerID` int(50) NOT NULL,
  `art_name` varchar(50) NOT NULL,
  `artist_name` varchar(225) NOT NULL,
  `art_price` int(50) NOT NULL,
  `art_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `sellerID`, `art_name`, `artist_name`, `art_price`, `art_image`) VALUES
(6, 2, 'Eyes of Hope ', 'Khula Aasmaan', 1000, 'uploads/img_1.png'),
(7, 2, 'Face of War', 'Artist Bipul Singh', 1500, 'uploads/img_2.png'),
(8, 2, 'Sad Lady', 'Zoya Deb', 400, 'uploads/img_3.png'),
(9, 2, 'The Artist III', 'Zoya Deb', 1500, 'uploads/img_4.png'),
(10, 2, 'Abstract Floral ', 'Anupa Paul', 600, 'uploads/img_5.png'),
(11, 1, 'Power of knowledge', 'Bipul Singh', 800, 'uploads/img_6.png'),
(26, 2, 'product1', 'praveen kumar', 5000, 'uploads/anime-naruto-hinata-hyūga-wallpaper-preview.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `sellerID` int(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`sellerID`, `name`, `email`, `password`) VALUES
(1, 'praveen', 'praveen@gmail.com', '1234'),
(2, 'praveen', 'praveennani963@gmail.com', 'praveen');

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`id`, `name`, `email`, `password`) VALUES
(1, 'praveen', 'praveennani963@gmail.com', 'praveen'),
(2, 'test', 'test@test.com', 'test'),
(10, 'praveen', 'praveennani963@gmail.com', '12345');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `cartitem`
--
ALTER TABLE `cartitem`
  ADD PRIMARY KEY (`cartitemID`);

--
-- Indexes for table `new_release`
--
ALTER TABLE `new_release`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderitem`
--
ALTER TABLE `orderitem`
  ADD PRIMARY KEY (`orderitemID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`sellerID`);

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cartitem`
--
ALTER TABLE `cartitem`
  MODIFY `cartitemID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;

--
-- AUTO_INCREMENT for table `new_release`
--
ALTER TABLE `new_release`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orderitem`
--
ALTER TABLE `orderitem`
  MODIFY `orderitemID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=437;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `sellerID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `signup`
--
ALTER TABLE `signup`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
