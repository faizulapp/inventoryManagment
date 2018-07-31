-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2018 at 09:04 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 5.6.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_managment`
--

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer`
--

CREATE TABLE `manufacturer` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `manufacturer`
--

INSERT INTO `manufacturer` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Tata', '2018-07-28 00:14:00', '2018-07-27 18:44:00'),
(2, 'Maruti', '2018-07-28 00:14:00', '2018-07-27 18:44:00'),
(3, 'Bajaj', '2018-07-28 00:14:00', '2018-07-27 18:44:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `color` varchar(32) NOT NULL,
  `manufacturing_year` varchar(50) NOT NULL,
  `registration_number` varchar(50) NOT NULL,
  `image_1` varchar(100) NOT NULL,
  `image_2` varchar(100) NOT NULL,
  `manufacturer_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `quantity`, `color`, `manufacturing_year`, `registration_number`, `image_1`, `image_2`, `manufacturer_id`, `created`, `modified`) VALUES
(4, 'Nano', 'demo', 6000000, 11, 'Red', '07/2018', '2323', '1532925963.png', '1532925963.', 1, '2018-07-30 06:46:03', '2018-07-30 04:46:03'),
(2, 'Honda', '', 120000, 9, 'White', '07/2018', '254556', '', '', 3, '2018-07-29 17:25:53', '2018-07-29 15:25:53'),
(3, 'Swift', 'test data', 6000000, 5, 'Red', '07/2018', '4558566', '1532880506.jfif', '1532880506.jfif', 2, '2018-07-29 18:08:26', '2018-07-29 16:08:27'),
(5, 'Ace', 'this is demo', 1200000, 12, 'Blue', '07/2018', '458766', '74-1532933341.png', '23483-1532933341.png', 1, '2018-07-30 08:49:01', '2018-07-30 06:49:01'),
(6, 'Van', 'demo cars', 6000000, 11, 'White', '07/2016', 'hj4775', '14552-1532933584.png', '13361-1532933584.png', 2, '2018-07-30 08:53:04', '2018-07-30 06:53:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `manufacturer`
--
ALTER TABLE `manufacturer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `manufacturer`
--
ALTER TABLE `manufacturer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
